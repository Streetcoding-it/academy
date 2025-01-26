<?php

namespace Drupal\rust_playground\Plugin\Field\FieldWidget;

use Drupal\Core\Field\Annotation\FieldWidget;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Definizione del Widget per il campo Rust Code.
 *
 * @FieldWidget(
 *   id = "rust_code_widget",
 *   label = @Translation("Rust Code Widget"),
 *   field_types = {
 *     "rust_code"
 *   }
 * )
 */
class RustCodeWidget extends WidgetBase {

  /**
   * Costruisce il form del widget.
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['value'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Codice Rust'),
      '#default_value' => isset($items[$delta]) ? $items[$delta]->value : '',
      '#description' => $this->t('Inserisci il codice Rust'),
    ];
    return ['value' => $element];
  }
}

