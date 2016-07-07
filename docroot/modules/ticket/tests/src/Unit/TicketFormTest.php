<?php

namespace Drupal\Tests\ticket\Unit;

use Drupal\ticket\Entity\Ticket;
use Drupal\ticket\TicketInterface;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;

/**
 * Tests generation of ticket.
 *
 * @group ticket
 */
class TicketFormTest extends EntityKernelTestBase {
  public static $modules = ['user', 'system', 'field', 'text', 'filter', 'ticket', 'file'];

  public function testTicketForm() {
    $form = \Drupal::formBuilder()->getForm('Drupal\ticket\Entity\TicketForm');
    $this->assertNotEmpty($form);
  }

}
