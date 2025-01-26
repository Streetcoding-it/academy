<?php

namespace Drupal\rust_playground\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormBuilderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Fornisce un blocco con il form Rust Playground.
 *
 * @Block(
 *   id = "rust_playground_block",
 *   admin_label = @Translation("Rust Playground Block")
 * )
 */

class RustPlaygroundBlock extends BlockBase implements ContainerFactoryPluginInterface {
   
   /**
   * Il servizio formBuilder di Drupal.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;

  /**
   * Costruttore per l'iniezione delle dipendenze.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $form_builder) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $form_builder;
  }

  /**
   * Metodo per creare il blocco con il form.
   */
  public function build() {
    return $this->formBuilder->getForm('Drupal\rust_playground\Form\RustPlaygroundForm');
  }

  /**
   * Metodo per costruire il container di dipendenze.
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('form_builder')
    );
  }
}

