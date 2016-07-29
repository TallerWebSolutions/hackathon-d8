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

    $entity = $this->container->get('entity_type.manager')->getStorage('ticket')->create();
    $form = \Drupal::service('entity.form_builder')->getForm($entity, 'add');

    $this->assertNotEmpty($form['title']);
    $this->assertNotEmpty($form['message']);
  }

}
