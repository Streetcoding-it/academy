<?php

namespace Drupal\opigno_social\RouteProvider;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\Routing\AdminHtmlRouteProvider;
use Symfony\Component\Routing\Route;

/**
 * Provides routes for the Opigno community entity.
 *
 * @see \Drupal\Core\Entity\Routing\AdminHtmlRouteProvider
 * @see \Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider
 */
class OpignoSocialHtmlRouteProvider extends AdminHtmlRouteProvider {

  /**
   * {@inheritdoc}
   */
  public function getRoutes(EntityTypeInterface $entity_type) {
    $collection = parent::getRoutes($entity_type);
    $entity_type_id = $entity_type->id();

    if ($settings_form_route = $this->getSettingsFormRoute($entity_type)) {
      $collection->add("$entity_type_id.settings", $settings_form_route);
    }

    return $collection;
  }

  /**
   * Gets the settings form route.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   The entity type.
   *
   * @return \Symfony\Component\Routing\Route|null
   *   The generated route, if available.
   */
  protected function getSettingsFormRoute(EntityTypeInterface $entity_type): ?Route {
    $type_id = str_replace('_', '-', $entity_type->id());
    $route = new Route("/admin/structure/$type_id/settings");
    $route
      ->setDefaults([
        '_controller' => '\Drupal\system\Controller\SystemController::systemAdminMenuBlockPage',
        '_title' => "{$entity_type->getLabel()} settings",
      ])
      ->setRequirement('_permission', $entity_type->getAdminPermission())
      ->setOption('_admin_route', TRUE);

    return $route;
  }

}
