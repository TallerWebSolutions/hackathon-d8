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
class TicketTest extends EntityKernelTestBase {
  public static $modules = ['user', 'system', 'field', 'text', 'filter', 'ticket'];

  protected function setUp() {
    parent::setUp();
    $this->installEntitySchema('ticket');
  }

  private function newTicket($title) {
    $entity = $this->container->get('entity_type.manager')
      ->getStorage('ticket')
      ->create(array('title' => $title));

    return $entity->save();
  }

  public function testTicketCrud() {
    $this->newTicket('test');
    $this->newTicket('test');
    $this->newTicket('test');

    $actual_tickets = array_values(entity_load_multiple_by_properties('ticket', array('title' => 'test')));

    $expected_length = 3;
    $actual_length   = count($actual_tickets);

    $this->assertEquals($expected_length, $actual_length);
    //$this->assertTrue(!empty($entity->uuid), 'The ticket was not properly created.');
  }
}
