<?php

namespace Drupal\calendar;

use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\views\Views;

/**
 * The trait.
 */
trait CalendarViewsTrait {

  /**
   * {@inheritdoc}
   */
  protected function getTableEntityType($table) {
    static $recursion = 0;
    if ($table = Views::viewsData()->get($table)) {
      if (!empty($table['table']['entity type'])) {
        // Reset recursion when we found a value.
        $recursion = 0;
        return $table['table']['entity type'];
      }
      elseif (!empty($table['table']['join']) && count($table['table']['join']) == 1) {
        if (empty($recursion)) {
          $join_table = array_pop(array_keys($table['table']['join']));
          $recursion++;
          return $this->getTableEntityType($join_table);
        }
      }
    }
    return NULL;
  }

  /**
   * Determine if this field is an Entity Reference field.
   *
   * Checks if the field references a taxonomy term.
   *
   * @todo Change to a more generic is Content Entity Reference.
   *
   * @param array $field_info
   *   The field information array.
   * @param \Drupal\Core\Entity\EntityFieldManagerInterface $field_manager
   *   The entity field manager service.
   *
   * @return bool
   *   TRUE if the field is a taxonomy term reference, FALSE otherwise.
   */
  protected function isTermReferenceField($field_info, EntityFieldManagerInterface $field_manager) {
    if (!empty($field_info['type']) && $field_info['type'] == 'entity_reference_label') {
      if ($entity_type = $this->getTableEntityType($field_info['table'])) {
        $field_definitions = $field_manager->getFieldStorageDefinitions($entity_type);
        $field_definition = $field_definitions[$field_info['field']];
        $target_type = $field_definition->getSetting('target_type');
        return $target_type == 'taxonomy_term';
      }
    }
    return FALSE;
  }

}
