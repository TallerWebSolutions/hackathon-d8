<?php
/**
 * @file
 * Contains \Drupal\ticket\ticketInterface.
 */

namespace Drupal\ticket;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface defining a ticket entity.
 *
 * We have this interface so we can join the other interfaces it extends.
 *
 * @ingroup ticket
 */
interface TicketInterface extends ContentEntityInterface {

}
