<?php

namespace Drupal\private_message\Service;

use Drupal\Core\Database\Connection;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\private_message\Entity\PrivateMessageBanInterface;

/**
 * The Private Message Ban manager service.
 */
class PrivateMessageBanManager implements PrivateMessageBanManagerInterface {

  use StringTranslationTrait;

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected AccountProxyInterface $currentUser;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The database.
   *
   * @var \Drupal\Core\Database\Connection
   */
  private Connection $database;

  /**
   * The messenger service.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  private MessengerInterface $messenger;

  /**
   * Constructs a PrivateMessageBanManager object.
   *
   * @param \Drupal\Core\Session\AccountProxyInterface $currentUser
   *   The current user.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager interface.
   * @param \Drupal\Core\Database\Connection $database
   *   The database.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger service.
   */
  public function __construct(
    AccountProxyInterface $currentUser,
    EntityTypeManagerInterface $entityTypeManager,
    Connection $database,
    MessengerInterface $messenger,
  ) {
    $this->currentUser = $currentUser;
    $this->entityTypeManager = $entityTypeManager;
    $this->database = $database;
    $this->messenger = $messenger;
  }

  /**
   * {@inheritdoc}
   */
  public function isBanned(int $user_id): bool {
    $select = $this
      ->database
      ->select('private_message_ban', 'pmb');
    $select
      ->addExpression('1');

    return (bool) $select->condition('pmb.owner', $this->currentUser->id())
      ->condition('pmb.target', $user_id)
      ->execute()
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function isCurrentUserBannedByUser(int $user_id): bool {
    $select = $this
      ->database
      ->select('private_message_ban', 'pmb');
    $select
      ->addExpression('1');

    return (bool) $select->condition('pmb.owner', $user_id)
      ->condition('pmb.target', $this->currentUser->id())
      ->execute()
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function getBannedUsers(int $user_id): array {
    return $this
      ->database
      ->select('private_message_ban', 'pmb')
      ->fields('pmb', ['target'])
      ->condition('pmb.owner', $user_id)
      ->execute()
      ->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function unbanUser(int $user_id) {
    $ban = $this->findBanEntity($this->currentUser->id(), $user_id);
    if (!$ban) {
      // The user is not banned; just return.
      return;
    }

    // Delete the ban and display a message.
    $ban->delete();
  }

  /**
   * {@inheritdoc}
   */
  public function banUser(int $user_id) {
    $ban = $this->findBanEntity($this->currentUser->id(), $user_id);
    if ($ban) {
      // The user is already banned; just return.
      return;
    }

    // Create the ban and display a message.
    $this->entityTypeManager
      ->getStorage('private_message_ban')
      ->create([
        'owner' => $this->currentUser->id(),
        'target' => $user_id,
      ])
      ->save();
  }

  /**
   * Finds the ban entity for the given owner and target.
   *
   * @param int $owner
   *   The ban entity owner.
   * @param int $user_id
   *   The ID of user being banned.
   *
   * @return \Drupal\private_message\Entity\PrivateMessageBanInterface|null
   *   The ban entity or NULL if not found.
   */
  protected function findBanEntity(int $owner, int $user_id): ?PrivateMessageBanInterface {
    // Find the ban entity.
    $bans = $this->entityTypeManager
      ->getStorage('private_message_ban')
      ->loadByProperties([
        'owner' => $owner,
        'target' => $user_id,
      ]);

    // reset() returns the first element of the array or FALSE if the array is
    // empty, but we want the return value to be NULL if the array is empty.
    return reset($bans) ?: NULL;
  }

}
