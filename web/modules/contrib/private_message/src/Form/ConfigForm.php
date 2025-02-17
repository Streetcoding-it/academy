<?php

namespace Drupal\private_message\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Config\TypedConfigManagerInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\private_message\PluginManager\PrivateMessageConfigFormManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines the configuration form for the private message module.
 */
class ConfigForm extends ConfigFormBase {

  /**
   * Ban types.
   *
   * @todo Move to Enum.
   */
  const PASSIVE = 'passive';
  const ACTIVE = 'active';

  /**
   * The private message config form plugin manager.
   *
   * @var \Drupal\private_message\PluginManager\PrivateMessageConfigFormManager
   */
  protected $privateMessageConfigFormManager;

  public function __construct(
    ConfigFactoryInterface $configFactory,
    TypedConfigManagerInterface $typedConfigManager,
    PrivateMessageConfigFormManager $privateMessageConfigFormManager,
  ) {
    parent::__construct($configFactory, $typedConfigManager);
    $this->privateMessageConfigFormManager = $privateMessageConfigFormManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('config.typed'),
      $container->get('private_message.private_message_config_form_manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'private_message_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $formState) {
    $config = $this->config('private_message.settings');

    $form['pm_core'] = [
      '#type' => 'details',
      '#title' => $this->t('Private message core'),
      '#open' => TRUE,
    ];

    $form['pm_core']['notifications'] = [
      '#type' => 'details',
      '#title' => $this->t('Notifications'),
      '#open' => TRUE,
    ];

    $form['pm_core']['notifications']['enable_notifications'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable notifications'),
      '#default_value' => $config->get('enable_notifications'),
    ];

    $form['pm_core']['notifications']['notify_by_default'] = [
      '#type' => 'radios',
      '#title' => $this->t('Default action'),
      '#options' => [
        $this->t('Do not send notifications (users can opt-in)'),
        $this->t('Send notifications (users can opt-out)'),
      ],
      '#default_value' => (int) $config->get('notify_by_default'),
      '#states' => [
        'visible' => [
          ':input[name="enable_notifications"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['pm_core']['notifications']['notify_when_using'] = [
      '#type' => 'radios',
      '#title' => $this->t('Send notifications of new messages in a thread'),
      '#options' => [
        'yes' => $this->t('For every private message'),
        'no' => $this->t('Only when the user is not viewing the thread'),
      ],
      '#default_value' => $config->get('notify_when_using'),
      '#description' => $this->t("Whether or not notifications should be sent when the user is viewing a given thread. Users will be able to override this value on their profile settings page."),
      '#states' => [
        'visible' => [
          ':input[name="enable_notifications"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['pm_core']['notifications']['number_of_seconds_considered_away'] = [
      '#type' => 'number',
      '#title' => $this->t('The number of seconds after which a user should be considered as not viewing a thread'),
      '#default_value' => $config->get('number_of_seconds_considered_away'),
      '#description' => $this->t('When users have a private message thread open, calls to the server update the last time they have accessed the thread. This setting determines how many seconds after they have closed the thread, they should be considered as not accessing the thread anymore. Users will be able to override this value on their profile settings page.'),
      '#states' => [
        'visible' => [
          ':input[name="enable_notifications"]' => ['checked' => TRUE],
          ':input[name="notify_when_using"]' => ['value' => 'no'],
        ],
      ],
    ];

    $form['pm_core']['hide_recipient_field_when_prefilled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide recipient field when recipient is in the URL'),
      '#description' => $this->t('Links can be created to the private message page, passing the recipient in the URL. If this box is checked, the recipient field will be hidden when the recipient is passed in the URL.'),
      '#default_value' => (int) $config->get('hide_recipient_field_when_prefilled'),
    ];

    $form['pm_core']['autofocus_enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable autofocus'),
      '#description' => $this->t('This option allows you to put the autofocus in the message textarea.'),
      '#default_value' => (int) $config->get('autofocus_enable'),
    ];

    $form['pm_core']['keys_send'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Key that sends the message when pressed'),
      '#description' => $this->t(
        'This field allows you to set up some keys that will send the message instead of pressing the submit button. Just enter the <a href="@key-list">KeyboardEvent.key</a> or the deprecated <a href="@keycode-list">KeyboardEvent.keyCode</a> for compatibility. You can separate entrees by a comma in order to support multiple keys. This feature doesn\'t work with wysiwyg, you have to use a simple textarea as a text editor.',
        [
          '@key-list' => 'https://developer.mozilla.org/en-US/docs/Web/API/KeyboardEvent/key/Key_Values',
          '@keycode-list' => 'https://developer.mozilla.org/en-US/docs/Web/API/KeyboardEvent/keyCode',
        ]),
      '#default_value' => $config->get('keys_send'),
    ];

    $form['pm_core']['remove_css'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Remove the default CSS of the module'),
      '#description' => $this->t('This option can break the features of the module and it is only for developers who want to override the styles more easily.'),
      '#default_value' => (int) $config->get('remove_css'),
    ];

    $form['pm_labels'] = [
      '#type' => 'details',
      '#title' => $this->t('Private message labels'),
      '#open' => TRUE,
    ];

    $form['pm_labels']['create_message_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Text To Create Private Message"),
      '#default_value' => $config->get('create_message_label'),
    ];

    $form['pm_labels']['save_message_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Text to submit a new message"),
      '#default_value' => $config->get('save_message_label'),
      '#description' => $this->t('The label of the button to send a new message.'),
    ];

    $form['pm_block'] = [
      '#type' => 'details',
      '#title' => $this->t('Private Message Bans'),
      '#open' => TRUE,
    ];

    $form['pm_block']['ban_mode'] = [
      '#type' => 'radios',
      '#title' => $this->t("Blocking mode"),
      '#default_value' => $config->get('ban_mode') ?: self::PASSIVE,
      '#options' => [
        self::PASSIVE => $this
          ->t('Passive'),
        self::ACTIVE => $this
          ->t('Active'),
      ],
      self::PASSIVE => [
        '#description' => $this->t('Blocked members do not know they are blocked and can message the user that blocked them. The user who blocked them will not see the message.'),
      ],
      self::ACTIVE => [
        '#description' => $this->t('Blocked members cannot message users that blocked them and instead a message is shown.'),
      ],
    ];

    $form['pm_block']['ban_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Button label to ban a user"),
      '#default_value' => $config->get('ban_label'),
    ];

    $form['pm_block']['unban_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Button label to unban a user"),
      '#default_value' => $config->get('unban_label'),
    ];

    $form['pm_block']['ban_page_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Text to go to the ban page"),
      '#default_value' => $config->get('ban_page_label'),
    ];

    $form['pm_block']['ban_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Text to show when a blocked user tries to send a message."),
      '#default_value' => $config->get('ban_message'),
    ];

    $definitions = $this->privateMessageConfigFormManager->getDefinitions();
    foreach ($definitions as $definition) {
      $instance = $this->privateMessageConfigFormManager->createInstance($definition['id']);
      $form[$instance->getId()] = [
        '#type' => 'details',
        '#title' => $instance->getName(),
        '#tree' => TRUE,
        '#open' => TRUE,
      ];
      foreach ($instance->buildForm($formState) as $key => $element) {
        $form[$instance->getId()][$key] = $element;
      }
    }

    return parent::buildForm($form, $formState);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $formState) {
    $definitions = $this->privateMessageConfigFormManager->getDefinitions();
    foreach ($definitions as $definition) {
      $instance = $this->privateMessageConfigFormManager->createInstance($definition['id']);
      $instance->validateForm($form, $formState);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $formState) {
    $this->config('private_message.settings')
      ->set('enable_notifications', (bool) $formState->getValue('enable_notifications'))
      ->set('notify_by_default', (bool) $formState->getValue('notify_by_default'))
      ->set('notify_when_using', (string) $formState->getValue('notify_when_using'))
      ->set('number_of_seconds_considered_away', (int) $formState->getValue('number_of_seconds_considered_away'))
      ->set('hide_recipient_field_when_prefilled', (bool) $formState->getValue('hide_recipient_field_when_prefilled'))
      ->set('create_message_label', $formState->getValue('create_message_label'))
      ->set('save_message_label', $formState->getValue('save_message_label'))
      ->set('ban_mode', $formState->getValue('ban_mode'))
      ->set('ban_label', $formState->getValue('ban_label'))
      ->set('unban_label', $formState->getValue('unban_label'))
      ->set('ban_page_label', $formState->getValue('ban_page_label'))
      ->set('ban_message', $formState->getValue('ban_message'))
      ->set('autofocus_enable', (bool) $formState->getValue('autofocus_enable'))
      ->set('keys_send', $formState->getValue('keys_send'))
      ->set('remove_css', (bool) $formState->getValue('remove_css'))
      ->save();

    $definitions = $this->privateMessageConfigFormManager->getDefinitions();
    foreach ($definitions as $definition) {
      $instance = $this->privateMessageConfigFormManager->createInstance($definition['id']);
      $instance->submitForm($formState->getValue($instance->getId()));
    }

    parent::submitForm($form, $formState);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'private_message.settings',
    ];
  }

}
