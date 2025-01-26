<?php

namespace Drupal\rust_playground\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\rust_playground\Form\RustPlaygroundForm;

/**
 * Controller per mostrare il form Rust Playground.
 */
class RustPlaygroundController extends ControllerBase {

  /**
   * Mostra il form nella pagina.
   */
  public function content() {
    $form = \Drupal::formBuilder()->getForm(RustPlaygroundForm::class);
    return [
      '#markup' => '<h2>Rust Playground</h2>',
      $form,
    ];
  }
}

