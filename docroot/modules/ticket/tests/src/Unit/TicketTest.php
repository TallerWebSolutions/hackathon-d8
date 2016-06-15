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
    $this->assertCount($expected_length, $actual_tickets);
  }

  public function testSaveTicket() {
    $ticket_title   = 'Ticket for Test';
    $ticket_message = 'Description for test';

    $entity = $this->container->get('entity_type.manager')
      ->getStorage('ticket')
      ->create(array(
        'title'   => $ticket_title,
        'message' => $ticket_message
      ));
    $entity->save();

    $tickets_loaded = entity_load_multiple_by_properties('ticket', array('title' => $ticket_title));
    $ticket_saved   = 1;
    $this->assertCount($ticket_saved, $tickets_loaded);

    $ticket = $tickets_loaded[1];

    $this->assertEquals($ticket_title,   $ticket->title->value);
    $this->assertEquals($ticket_message, $ticket->message->value);

    $expected_created = date('y/m/d');
    $actual_created   = date('y/m/d', $ticket->created->value);

    $this->assertEquals($expected_created, $actual_created);
  }
}
