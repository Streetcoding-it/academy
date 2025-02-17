<?php

namespace Drupal\opigno_mobile_app\Plugin\rest\resource;

use Drupal\jwt\Authentication\Event\JwtAuthEvents;
use Drupal\jwt\Authentication\Event\JwtAuthGenerateEvent;
use Drupal\jwt\JsonWebToken\JsonWebToken;
use Drupal\jwt\Transcoder\JwtTranscoder;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\user\Entity\User;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Provides a resource to get a JWT token.
 *
 * @RestResource(
 *   id = "token_rest_resource",
 *   label = @Translation("Token rest resource"),
 *   uri_paths = {
 *     "create" = "/api/v1/token"
 *   }
 * )
 */
class TokenRestResource extends ResourceBase {
  /**
   * The JWT Transcoder service.
   *
   * @var \Drupal\jwt\Transcoder\JwtTranscoderInterface
   */
  protected $transcoder;

  /**
   * The event dispatcher.
   *
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $eventDispatcher;

  /**
   * Constructs a Drupal\rest\Plugin\rest\resource\EntityResource object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param array $serializer_formats
   *   The available serialization formats.
   * @param \Psr\Log\LoggerInterface $logger
   *   A logger instance.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    $serializer_formats,
    LoggerInterface $logger) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);
    $this->eventDispatcher = \Drupal::service('event_dispatcher');
    $this->transcoder = new JwtTranscoder();
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static($configuration, $plugin_id, $plugin_definition, $container
      ->getParameter('serializer.formats'), $container
      ->get('logger.factory')
      ->get('rest'));
  }

  /**
   * Responds to entity POST requests.
   *
   * @return \Drupal\rest\ResourceResponse
   *   Responds to entity POST requests.
   */
  public function post() {
    $user = \Drupal::currentUser();
    if ($user->isAnonymous()) {
      $data['message'] = $this->t("Login failed. If you don't have an account register. If you forgot your credentials please reset your password.");
      return new ResourceResponse($data, Response::HTTP_FORBIDDEN);
    }
    else {
      $account = User::load($user->id());
      user_login_finalize($account);
      $session = \Drupal::service('session');
      $data['session_id'] = $session->getName() . '=' . $session->getId();

      $data['uid'] = $user->id();
      $data['roles'] = $user->getRoles();
      $data['token'] = $this->generateToken();
    }

    return new ResourceResponse($data);
  }

  /**
   * Generates a new JWT.
   */
  public function generateToken() {
    $event = new JwtAuthGenerateEvent(new JsonWebToken());
    $this->eventDispatcher->dispatch(JwtAuthEvents::GENERATE, $event);
    $jwt = $event->getToken();
    return $this->transcoder->encode($jwt);
  }

}
