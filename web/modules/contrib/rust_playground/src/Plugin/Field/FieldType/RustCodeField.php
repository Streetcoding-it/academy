<?php

namespace Drupal\rust_playground\Plugin\Field\FieldType;

use Drupal\Core\Field\Annotation\FieldType;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Definizione del FieldType per Rust Code.
 *
 * @FieldType(
 *   id = "rust_code",
 *   label = @Translation("Rust Code"),
 *   description = @Translation("Campo per memorizzare codice Rust."),
 *   category = @Translation("Testo"),
 *   default_widget = "rust_code_widget",
 *   default_formatter = "rust_code_formatter"
 * )
 */
class RustCodeField extends FieldItemBase {

  /**
   * Definisce lo schema del database per il campo.
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value' => [
          'type' => 'text',
          'size' => 'big',
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * Definizione dei dati.
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Rust Code'))
      ->setRequired(TRUE);
    return $properties;
  }

  /**
   * Controlla se il campo è vuoto.
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return empty($value);
  }
}

