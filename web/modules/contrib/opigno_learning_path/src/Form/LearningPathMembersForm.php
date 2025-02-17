<?php

namespace Drupal\opigno_learning_path\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormBuilder;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Pager\PagerManagerInterface;
use Drupal\Core\Render\Markup;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Url;
use Drupal\opigno_learning_path\LearningPathAccess;
use Drupal\opigno_learning_path\LearningPathValidator;
use Drupal\views\Views;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Group overview form.
 */
class LearningPathMembersForm extends FormBase {

  /**
   * The Entity Type Manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected EntityTypeManagerInterface $entityTypeManager;

  /**
   * Service "request_stack" definition.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack|null
   */
  protected ?Request $currentRequest;

  /**
   * Form builder.
   *
   * @var \Drupal\Core\Form\FormBuilder
   */
  protected FormBuilder $formBuilder;

  /**
   * The renderer service.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected RendererInterface $renderer;

  /**
   * The pager manager.
   *
   * @var \Drupal\Core\Pager\PagerManagerInterface
   */
  protected PagerManagerInterface $pagerManager;

  /**
   * The route match service.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * Group content entity storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface|null
   */
  protected $groupContentStorage = NULL;

  /**
   * Creates a LearningPathMembersForm object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The Entity Type Manager.
   * @param \Symfony\Component\HttpFoundation\RequestStack|null $request_stack
   *   Service "request_stack" definition.
   * @param \Drupal\Core\Form\FormBuilder $form_builder
   *   Form builder.
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer service.
   * @param \Drupal\Core\Pager\PagerManagerInterface $pager_manager
   *   The pager manager.
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The route match service.
   */
  public function __construct(
    EntityTypeManagerInterface $entity_type_manager,
    ?RequestStack $request_stack,
    FormBuilder $form_builder,
    RendererInterface $renderer,
    PagerManagerInterface $pager_manager,
    RouteMatchInterface $route_match
  ) {
    $this->entityTypeManager = $entity_type_manager;
    $this->currentRequest = $request_stack->getCurrentRequest();
    $this->formBuilder = $form_builder;
    $this->renderer = $renderer;
    $this->pagerManager = $pager_manager;
    $this->routeMatch = $route_match;
    $this->groupContentStorage = $this->entityTypeManager->getStorage('group_content');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('request_stack'),
      $container->get('form_builder'),
      $container->get('renderer'),
      $container->get('pager.manager'),
      $container->get('current_route_match')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'learning_path_members_form';
  }

  /**
   * Ajax callback for the members list pager.
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   *   AJAX response to update the member list.
   */
  public function updateMembers(): AjaxResponse {
    $response = new AjaxResponse();
    $page = $this->currentRequest->query->get('page');
    $form = $this->formBuilder->getForm(static::class, $page);
    $response->addCommand(new ReplaceCommand('#group_members_list', $form));
    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, ?int $page = NULL) {
    $student_manager_role = 'learning_path-user_manager';
    $content_manager_role = 'learning_path-content_manager';
    $class_manager_role = 'opigno_class-class_manager';

    /** @var \Drupal\group\Entity\Group $group */
    $group = $this->routeMatch->getParameter('group');
    $group_bundle = $group->bundle();

    // Check if user has uncompleted steps.
    $validation = LearningPathValidator::stepsValidate($group);
    if ($validation instanceof RedirectResponse) {
      return $validation;
    }

    // If not a learning_path or class, returns
    // default '/group/{group}/members' view.
    if (!in_array($group_bundle, [
      'opigno_class',
      'learning_path',
    ])) {
      $view = Views::getView('group_members');

      if (!$view || !$view->access('page_1')) {
        return $form;
      }

      $form[] = [
        '#type' => 'view',
        '#name' => 'group_members',
        '#display_id' => 'page_1',
        '#title' => $view->getTitle(),
        '#arguments' => [
          $group->id(),
        ],
      ];

      return $form;
    }

    if ($group_bundle == 'learning_path') {
      $form['#prefix'] = '<div id="group_members_list">';
      $form['#suffix'] = '</div>';

      $content_types = [
        'group_content_type_27efa0097d858',
        'group_content_type_af9d804582e19',
        'learning_path-group_membership',
      ];

      $group_content_ids = $this->groupContentStorage
        ->getQuery()
        ->condition('gid', $group->id())
        ->condition('type', $content_types, 'IN')
        ->sort('changed', 'DESC')
        ->accessCheck()
        ->execute();
      $content = $this->groupContentStorage->loadMultiple($group_content_ids);
    }
    else {
      $content = $group->getContent();
    }

    $users = [];
    $classes = [];

    /** @var \Drupal\group\Entity\GroupContentInterface $item */
    foreach ($content as $item) {
      $entity = $item->getEntity();
      if ($entity === NULL) {
        continue;
      }

      $type = $entity->getEntityTypeId();
      $bundle = $entity->bundle();

      if ($type === 'user') {
        $users[$entity->id()] = [
          'group content' => $item,
          'entity' => $entity,
        ];
      }
      elseif ($type === 'group' && $bundle === 'opigno_class') {
        $classes[$entity->id()] = [
          'group content' => $item,
          'entity' => $entity,
        ];
      }
    }

    $individual_members = $users;

    if ($group_bundle != 'opigno_class') {
      $form[] = [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['class'],
        ],
        'search' => [
          '#type' => 'textfield',
          '#autocomplete_route_name' => 'opigno_learning_path.membership.find_users_in_group_autocomplete',
          '#autocomplete_route_parameters' => [
            'group' => $group->id(),
          ],
          '#placeholder' => $this->t('Search a user'),
          '#attributes' => [
            'id' => 'class_members_search',
            'class' => [
              'class_members_search',
            ],
          ],
        ],
      ];
    }

    // Set members data for users in group classes.
    foreach ($classes as $class) {
      $member_count = 0;

      $members = array_filter($users, function ($user) use ($class) {
        /** @var \Drupal\group\Entity\Group $class_entity */
        $class_entity = $class['entity'];
        return $class_entity->getMember($user['entity']) !== FALSE;
      });

      $individual_members = array_diff_key($individual_members, $members);

      // Get class members view as renderable array.
      $class_id = $class['entity']->id();
      $args = [$class_id];
      $view_id = 'opigno_group_members_table';
      $display = 'group_members_block';
      $members_view = Views::getView($view_id);
      if (is_object($members_view)) {
        $members_view->storage->set('group_members', array_keys($users));
        $members_view->setArguments($args);
        $members_view->setDisplay($display);
        $members_view->preExecute();
        $members_view->execute();
        $members_view_renderable = $members_view->buildRenderable($display, $args);

        $member_count = $members_view->total_rows;
      }

      /** @var \Drupal\group\Entity\GroupContentInterface $class_group_content */
      $class_group_content = $class['group content'];
      $member_since_value = $class_group_content
        ->get('created')
        ->getValue()[0]['value'];
      $member_since = date('d/m/Y', $member_since_value);

      /** @var \Drupal\group\Entity\Group $class_entity */
      $class_entity = $class['entity'];

      $form[] = [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['class'],
        ],
        'class_delete' => [
          '#type' => 'submit',
          '#value' => $this->t('Remove this class'),
          '#submit' => [],
          '#attributes' => [
            'id' => 'class_delete_' . $class_entity->id(),
            'class' => ['btn', 'btn-rounded', 'class_delete'],
          ],
        ],
        'title' => [
          '#type' => 'html_tag',
          '#tag' => 'h2',
          '#value' => $class_entity->label(),
        ],
        'member_since' => [
          '#type' => 'html_tag',
          '#tag' => 'p',
          '#value' => $this->t('In the learning path since : @date', [
            '@date' => $member_since,
          ]),
          '#attributes' => [
            'class' => ['class_member_since'],
          ],
        ],
        'members' => [
          '#type' => 'table',
          '#attributes' => [
            'class' => ['class_members'],
          ],
          '#header' => [
            $this->t('<span class="class_members_count">@count</span> Members', [
              '@count' => $member_count,
            ]),
          ],
        ],
        'members_table' => !empty($members_view_renderable) ? [
          '#type' => 'html_tag',
          '#tag' => 'div',
          '#value' => $this->renderer->render($members_view_renderable),
          '#attributes' => [
            'id' => 'class-' . $class_entity->id(),
            'class' => ['class_members', 'class_members_row'],
            'data-class' => $class_entity->id(),
            'style' => 'display:none;',
          ],
        ] : [],
        'hide' => [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['class_hide'],
          ],
          [
            '#type' => 'html_tag',
            '#tag' => 'span',
            '#value' => Markup::create($this->t('Hide') . '<i class="fi fi-rr-eye-crossed"></i>'),
            '#attributes' => [
              'class' => ['class_hide_text'],
            ],
          ],
        ],
        'show' => [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['class_show'],
          ],
          [
            '#type' => 'html_tag',
            '#tag' => 'span',
            '#value' => Markup::create($this->t('Show') . '<i class="fi fi-rr-eye"></i>'),
            '#attributes' => [
              'class' => ['class_show_text'],
            ],
          ],
        ],
      ];
    }

    if (!empty($individual_members)) {
      $rows = array_map(function ($member_info) use ($group, $student_manager_role, $content_manager_role, $class_manager_role) {
        /** @var \Drupal\group\Entity\GroupContentInterface $user_group_content */
        $user_group_content = $member_info['group content'];
        $member_since_value = $user_group_content
          ->get('created')
          ->getValue()[0]['value'];

        /** @var \Drupal\user\Entity\User $user_entity */
        $user_entity = $member_info['entity'];
        $member = $group->getMember($user_entity);
        $roles = $member->getRoles();
        $has_sm_role = isset($roles[$student_manager_role]);
        $has_cm_role = isset($roles[$content_manager_role]);
        $has_class_manager_role = isset($roles[$class_manager_role]);
        $member_pending = FALSE;

        if ($group->hasField('field_learning_path_visibility')) {
          $member_pending = !LearningPathAccess::statusGroupValidation($group, $user_entity);
        }

        if ($member_pending) {
          $text = $this->t('Waiting for validation');
          $member_since = ['#markup' => $text];
        }
        else {
          $member_since = date('d/m/Y', $member_since_value);
          $member_since = ['#markup' => $member_since];
        }

        $gid = $group->id();
        $cid = $user_group_content->id();
        $delete_url = Url::fromUri("internal:/group/$gid/content/$cid/delete");

        return [
          'class' => 'class_members_row',
          'id' => 'individual_' . $user_entity->id(),
          'data' => [
            $user_entity->getDisplayName(),
            [
              'class' => 'class_member_since' . ($member_pending
                ? ' class_member_since_pending' : ''),
              'id' => 'class_member_validate_' . $user_entity->id(),
              'data' => $member_since,
            ],
            [
              'data' => [
                '#type' => 'submit',
                '#value' => $this->t('Toggle Student Manager'),
                '#submit' => [],
                '#attributes' => [
                  'id' => 'class_member_toggle_sm_' . $user_entity->id(),
                  'class' => array_merge(['class_member_toggle_sm'],
                    $has_sm_role ? ['class_member_toggle_sm_active'] : []
                  ),
                ],
              ],
            ],
            [
              'data' => [
                '#type' => 'submit',
                '#value' => $this->t('Toggle Content Manager'),
                '#submit' => [],
                '#attributes' => [
                  'id' => 'class_member_toggle_cm_' . $user_entity->id(),
                  'class' => array_merge(['class_member_toggle_cm'],
                    $has_cm_role ? ['class_member_toggle_cm_active'] : []),
                ],
              ],
            ],
            [
              'data' => [
                '#type' => 'submit',
                '#value' => $this->t('Toggle Class Manager'),
                '#submit' => [],
                '#attributes' => [
                  'id' => 'class_member_toggle_class_manager_' . $user_entity->id(),
                  'class' => array_merge(['class_member_toggle_class_manager'],
                    $has_class_manager_role ? ['class_member_toggle_class_manager_active'] : []),
                ],
              ],
            ],
            [
              'class' => 'class_member_delete_wrapper',
              'data' => [
                '#type' => 'link',
                '#title' => ['data' => ['#markup' => '<i class="fi fi-rr-trash"></i>']],
                '#url' => $delete_url,
                '#attributes' => [
                  'id' => 'class_member_delete_' . $user_entity->id(),
                  'class' => ['class_member_delete'],
                ],
              ],
            ],
          ],
        ];
      }, $individual_members);
      $member_count = count($individual_members);

      // Number of members on the one page.
      $per_page = 50;
      $pager = $this->pagerManager->createPager(count($rows), $per_page);
      $current_page = $pager->getCurrentPage();
      $chunks = array_chunk($rows, $per_page, TRUE);

      $form[] = [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['class'],
        ],
        'title' => [
          '#type' => 'html_tag',
          '#tag' => 'h2',
          '#value' => $this->t('Learners not in a class'),
        ],
        'search' => [
          '#type' => 'textfield',
          '#autocomplete_route_name' => 'opigno_learning_path.membership.find_users_in_group_autocomplete',
          '#autocomplete_route_parameters' => [
            'group' => $group->id(),
          ],
          '#placeholder' => $this->t('Search a user'),
          '#attributes' => [
            'id' => 'individual_members_search',
            'class' => [
              'class_members_search',
            ],
          ],
        ],
        'members' => [
          '#type' => 'table',
          '#attributes' => [
            'class' => [
              'class_members',
              isset($page) ? 'show_pager' : 'hide_pager',
            ],
          ],
          '#header' => [
            [
              'class' => 'class_members_header_member_count',
              'data' => $this->t('<span class="class_members_count">@count</span> Members', [
                '@count' => $member_count,
              ]),
            ],
            [
              'class' => 'class_members_header_member_since',
              'data' => $this->t('Enrolled Since'),
            ],
            $this->t('Student Manager'),
            $this->t('Content Manager'),
            $this->t('Class Manager'),
            '',
          ],
          '#rows' => $chunks[$current_page],
        ],
        'ajax_pager' => [
          '#type' => 'pager',
          '#element' => 0,
          '#route_name' => 'opigno_learning_path.members.pager',
          '#route_parameters' => [
            'group' => $group->id(),
          ],
        ],
        'hide' => [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['class_hide'],
          ],
          [
            '#type' => 'html_tag',
            '#tag' => 'span',
            '#value' => Markup::create($this->t('Hide') . '<i class="fi fi-rr-eye-crossed"></i>'),
            '#attributes' => [
              'class' => ['class_hide_text'],
            ],
          ],
        ],
        'show' => [
          '#type' => 'container',
          '#attributes' => [
            'class' => ['class_show'],
          ],
          [
            '#type' => 'html_tag',
            '#tag' => 'span',
            '#value' => Markup::create($this->t('Show') . '<i class="fi fi-rr-eye"></i>'),
            '#attributes' => [
              'class' => ['class_show_text'],
            ],
          ],
        ],
      ];
    }

    // Remove not needed roles for classes.
    if ($group_bundle == 'opigno_class' && !empty($form[0])) {
      unset($form[0]['title']);
      if (isset($form[0]['members']['#rows'])) {
        foreach ($form[0]['members']['#rows'] as $key => $row) {
          unset($form[0]['members']['#rows'][$key]['data'][2]);
          unset($form[0]['members']['#rows'][$key]['data'][3]);
        }
      }
      unset($form[0]['members']['#header'][2]);
      unset($form[0]['members']['#header'][3]);
    }
    // Remove not needed roles for learning paths.
    elseif ($group_bundle == 'learning_path') {
      $form_array_keys = array_keys($form);
      $last_key = end($form_array_keys);
      if (isset($form[$last_key]['members']['#rows'])) {
        foreach ($form[$last_key]['members']['#rows'] as $key => $row) {
          unset($form[$last_key]['members']['#rows'][$key]['data'][4]);
        }
      }
      unset($form[$last_key]['members']['#header'][4]);

    }

    $form['#attached']['library'][] = 'opigno_learning_path/member_overview';
    $form['#attached']['library'][] = 'opigno_learning_path/member_add';
    $form['#attached']['drupalSettings']['opigno_learning_path']['gid'] = $group->id();
    $form['#attached']['drupalSettings']['opigno_learning_path']['student_manager_role'] = $student_manager_role;
    $form['#attached']['drupalSettings']['opigno_learning_path']['content_manager_role'] = $content_manager_role;
    $form['#attached']['drupalSettings']['opigno_learning_path']['class_manager_role'] = $class_manager_role;
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
