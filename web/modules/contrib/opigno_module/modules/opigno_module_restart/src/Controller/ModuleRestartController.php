<?php

namespace Drupal\opigno_module_restart\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\AppendCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\RedirectCommand;
use Drupal\Core\Ajax\RemoveCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityFormBuilderInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\Core\Logger\LoggerChannelInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Url;
use Drupal\group\Entity\GroupInterface;
use Drupal\opigno_group_manager\OpignoGroupContext;
use Drupal\opigno_learning_path\LearningPathContent;
use Drupal\opigno_learning_path\LPStatusInterface;
use Drupal\opigno_module\Entity\OpignoActivityInterface;
use Drupal\opigno_module\Entity\OpignoAnswer;
use Drupal\opigno_module\Entity\OpignoModule;
use Drupal\opigno_module\Entity\OpignoModuleInterface;
use Drupal\opigno_module\Entity\UserModuleStatusInterface;
use Drupal\opigno_module_restart\Services\ModuleRestartManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Defines the controller for module restart routes.
 *
 * @package Drupal\opigno_module_restart\Controller
 */
class ModuleRestartController extends ControllerBase {

  /**
   * User module status entity storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected EntityStorageInterface $moduleStatusStorage;

  /**
   * The logger service.
   *
   * @var \Drupal\Core\Logger\LoggerChannelInterface
   */
  protected LoggerChannelInterface $logger;

  /**
   * The module restart manager service.
   *
   * @var \Drupal\opigno_module_restart\Services\ModuleRestartManager
   */
  protected ModuleRestartManager $restartManager;

  /**
   * ModuleRestartController constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager service.
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $logger
   *   The logger service.
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The current user account.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger service.
   * @param \Drupal\opigno_module_restart\Services\ModuleRestartManager $module_restart_manager
   *   The module restart manager service.
   * @param \Drupal\Core\Entity\EntityFormBuilderInterface $entity_form_builder
   *   The entity form builder service.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function __construct(
    EntityTypeManagerInterface $entity_type_manager,
    LoggerChannelFactoryInterface $logger,
    AccountInterface $account,
    MessengerInterface $messenger,
    ModuleRestartManager $module_restart_manager,
    EntityFormBuilderInterface $entity_form_builder
  ) {
    $this->entityTypeManager = $entity_type_manager;
    $this->moduleStatusStorage = $entity_type_manager->getStorage('user_module_status');
    $this->loggerFactory = $logger;
    $this->logger = $logger->get('opigno_module_restart');
    $this->currentUser = $account;
    $this->messenger = $messenger;
    $this->restartManager = $module_restart_manager;
    $this->entityFormBuilder = $entity_form_builder;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('logger.factory'),
      $container->get('current_user'),
      $container->get('messenger'),
      $container->get('opigno_module_restart.manager'),
      $container->get('entity.form_builder')
    );
  }

  /**
   * AJAX callback to show confirmation popup to restart module.
   *
   * @param \Drupal\opigno_module\Entity\OpignoModuleInterface $opigno_module
   *   The module entity to create a new attempt for.
   * @param \Drupal\group\Entity\GroupInterface $group
   *   The group entity to create a new module attempt for.
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   *   The redirect response.
   */
  public function restartConfirmation(OpignoModuleInterface $opigno_module, GroupInterface $group): AjaxResponse {
    $response = new AjaxResponse();

    $build = [
      '#theme' => 'opigno_module_restart_confirmation_popup',
      '#restart_button' => [
        '#type' => 'link',
        '#title' => $this->t('Yes, restart module'),
        '#url' => Url::fromRoute('opigno_module_restart.restart_module',
          ['opigno_module' => $opigno_module->id(), 'group' => $group->id()]
        ),
        '#attributes' => [
          'class' => [
            'use-ajax',
            'btn',
            'primary-btn',
            'btn-rounded',
            'btn-restart',
          ],
        ],
      ],
    ];

    $response->addCommand(new RemoveCommand('.modal-ajax'));
    $response->addCommand(new AppendCommand('body', $build));
    $response->addCommand(new InvokeCommand('.modal-ajax', 'modal', ['show']));

    return $response;
  }

  /**
   * Creates a new module attempt to restart the module.
   *
   * @param \Drupal\opigno_module\Entity\OpignoModuleInterface $opigno_module
   *   The module entity to create a new attempt for.
   * @param \Drupal\group\Entity\GroupInterface $group
   *   The group entity to create a new module attempt for.
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   *   The redirect response.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public function restartModule(OpignoModuleInterface $opigno_module, GroupInterface $group): AjaxResponse {
    $response = new AjaxResponse();

    $module_id = $opigno_module->id();
    $gid = $group->id();
    $uid = $this->currentUser->id();

    // Check if the user can create a new attempt for the module.
    $can_create_attempt = $this->checkNewAttemptCreation($opigno_module, $gid, $uid, TRUE);

    if ($can_create_attempt instanceof AjaxResponse) {
      return $can_create_attempt;
    }

    // Check if there are any not finished attempts.
    if ($this->restartManager->isNotFinishedAttemptsExist($opigno_module, $group, $this->currentUser)) {
      $this->messenger->addError($this->t('You have to finish your current attempt for the module @module.', [
        '@module' => $opigno_module->label(),
      ]));
    }
    else {
      $lp_attempt = OpignoModule::getLastTrainingAttempt($uid, $gid, TRUE);
      // Reopen the last LP attempt if the user restarts the module when it's
      // already finished.
      if ($lp_attempt instanceof LPStatusInterface && $lp_attempt->isFinished()) {
        $lp_attempt->setFinalized(FALSE)->save();
      }

      $attempt = $this->moduleStatusStorage->create([
        'module' => $module_id,
        'learning_path' => $gid,
        'user_id' => $uid,
        'finished' => 0,
        'lp_status' => $lp_attempt->id(),
      ]);
      $attempt->save();
    }

    $redirect_url = Url::fromRoute('opigno_module.take_module', [
      'group' => $gid,
      'opigno_module' => $module_id,
    ]);

    return $response->addCommand(new RedirectCommand($redirect_url->toString()));
  }

  /**
   * Restarts the activity inside the LP.
   *
   * @param \Drupal\group\Entity\GroupInterface $group
   *   The LP group.
   * @param \Drupal\opigno_module\Entity\OpignoModuleInterface $opigno_module
   *   The module the activity belongs to.
   * @param \Drupal\opigno_module\Entity\OpignoActivityInterface $opigno_activity
   *   The activity to be restarted.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|array
   *   The redirect response.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   * @throws \Drupal\Core\TempStore\TempStoreException
   */
  public function restartActivity(GroupInterface $group, OpignoModuleInterface $opigno_module, OpignoActivityInterface $opigno_activity): RedirectResponse|array {
    $gid = (int) $group->id();
    $uid = (int) $this->currentUser->id();
    $module_id = (int) $opigno_module->id();
    $activity_id = (int) $opigno_activity->id();

    $can_create_attempt = $this->checkNewAttemptCreation($opigno_module, $gid, $uid);
    if ($can_create_attempt instanceof RedirectResponse) {
      return $can_create_attempt;
    }

    // Set the actual group content ID.
    $cid = OpignoGroupContext::getGroupContentId($gid, $module_id);
    if ($cid) {
      OpignoGroupContext::setCurrentContentId($cid);
    }
    else {
      // In some cases, such as when a group contains courses, the function
      // getGroupContentId called with module_id param will not return the
      // $cid. This is because, technically, a module is contained within a
      // course, which has a different gid.
      $steps = LearningPathContent::getAllStepsOnlyModules($gid);
      if ($steps) {
        foreach ($steps as $step) {
          if ($step['id'] == $module_id) {
            // Update content cid.
            OpignoGroupContext::setCurrentContentId($step['cid']);
            break;
          }
        }
      }
    }

    // Check if the activity is answered in the latest module attempt.
    $module_attempt = $opigno_module->getModuleActiveAttempt($this->currentUser, NULL, $gid);
    if (!$module_attempt instanceof UserModuleStatusInterface) {
      // In case module attempt doesn't exist redirect to the lp start route.
      return $this->redirect('opigno_learning_path.steps.type_start', [
        'group' => $gid,
      ]);
    }

    $answer_storage = $this->entityTypeManager->getStorage('opigno_answer');
    $answers = $answer_storage->getQuery()
      ->condition('activity', $activity_id)
      ->condition('module', $module_id)
      ->condition('user_id', $uid)
      ->condition('user_module_status', $module_attempt->id())
      ->sort('id', 'DESC')
      ->range(0, 1)
      ->accessCheck()
      ->execute();
    $answer_id = reset($answers);

    if (!$answer_id
      || !($answer = $answer_storage->load($answer_id))
      || !$answer instanceof OpignoAnswer
    ) {
      // In case activity answer doesn't exist redirect to the lp start route.
      return $this->redirect('opigno_learning_path.steps.type_start', [
        'group' => $gid,
      ]);
    }

    // Render the activity form.
    return [
      '#theme' => 'opigno_module_activity_from',
      'activity_title' => ['#markup' => $opigno_module->label()],
      'activity_build' => $this->entityTypeManager
        ->getViewBuilder('opigno_activity')
        ->view($opigno_activity, 'activity'),
      'form' => $this->entityFormBuilder->getForm($answer),
    ];
  }

  /**
   * Checks if the new module attempt can be created.
   *
   * @param \Drupal\opigno_module\Entity\OpignoModuleInterface $module
   *   The module to check the attempt creation for.
   * @param int $gid
   *   The LP group ID.
   * @param int $uid
   *   The user ID to check the attempt creation for.
   * @param bool $ajax
   *   Use AJAX redirect response.
   *
   * @return mixed
   *   The redirect response if the attempt can not be created.
   *
   * @throws \Exception
   */
  protected function checkNewAttemptCreation(OpignoModuleInterface $module, int $gid, int $uid, bool $ajax = FALSE) {
    $module_id = (int) $module->id();
    if ($module->canCreateNewAttempt()) {
      return NULL;
    }

    $this->logger->notice($this->t('The user @user tried to create a new attempt for the module @module (LP @lp), but the limit of attempts is already reached.', [
      '@user' => $uid,
      '@module' => $module_id,
      '@lp' => $gid,
    ]));
    $this->messenger->addError($this->t('You have already reached the limit of attempts for the module @module.', [
      '@module' => $module->label(),
    ]));

    if (!$ajax) {
      return $this->redirect('entity.group.canonical', [
        'group' => $gid,
      ]);
    }
    else {
      $redirect_url = Url::fromRoute('entity.group.canonical', [
        'group' => $gid,
      ])->toString();
      $response = new AjaxResponse();
      return $response->addCommand(new RedirectCommand($redirect_url));
    }
  }

}
