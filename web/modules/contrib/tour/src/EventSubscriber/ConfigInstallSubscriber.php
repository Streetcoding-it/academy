<?php

namespace Drupal\tour\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Messenger\MessengerTrait;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Config install subscriber for config update on config install.
 *
 * @internal
 */
class ConfigInstallSubscriber implements EventSubscriberInterface {

  use MessengerTrait;
  use StringTranslationTrait;

  /**
   * Constructs a ConfigInstallSubscriber object.
   *
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $moduleHandler
   *   The module handler service.
   */
  public function __construct(protected ModuleHandlerInterface $moduleHandler) {
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents(): array {
    $events[ConfigEvents::SAVE][] = ['onConfigSave'];
    return $events;
  }

  /**
   * Responds to the config save event.
   *
   * @param \Drupal\Core\Config\ConfigCrudEvent $event
   *   The configuration event.
   */
  public function onConfigSave(ConfigCrudEvent $event): void {
    if (!$this->moduleHandler->moduleExists('navigation')) {
      return;
    }
    $this->messenger()->addWarning($this->t('Currently, <em>Tour</em> module does not have integration with <em>Navigation</em>, recommend following <a href="https://www.drupal.org/project/tour/issues/3489075">https://www.drupal.org/project/tour/issues/3489075</a> for when that does. For now use the Tour block.'));
  }

}
