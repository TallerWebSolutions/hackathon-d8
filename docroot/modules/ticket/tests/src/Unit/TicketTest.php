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

  private function newTicket($title, $message = '') {
    $entity = $this->container->get('entity_type.manager')
      ->getStorage('ticket')
      ->create(array(
        'title'   => $title,
        'message' => $message
      ));

    $entity->save();
    return $entity;
  }

  protected function assertActualDate($date) {
    $current_date  = date('y/m/d');
    $expected_date = date('y/m/d', $date);
    $this->assertEquals($current_date, $expected_date);
  }

  protected function searchTicket($params) {
    return entity_load_multiple_by_properties('ticket', $params);
  }

  public function testTicketCrud() {
    $ticket_title   = 'Ticket for Test';
    $ticket_message = 'Description for test';

    $this->newTicket($ticket_title, $ticket_message);
    $this->newTicket($ticket_title, $ticket_message);
    $this->newTicket($ticket_title, $ticket_message);

    $actual_tickets = $this->searchTicket(['title' => $ticket_title]); //

    $expected_length = 3;
    $this->assertCount($expected_length, $actual_tickets);
  }

  public function testSaveTicket() {
    $ticket_title   = 'Ticket for Test';
    $ticket_message = 'Description for test';

    $this->newTicket($ticket_title, $ticket_message);

    $tickets_loaded = $this->searchTicket(['title' => $ticket_title]); //
    $ticket_saved   = 1;
    $this->assertCount($ticket_saved, $tickets_loaded);

    $ticket = array_pop($tickets_loaded);

    $this->assertEquals($ticket_title,   $ticket->title->value);
    $this->assertEquals($ticket_message, $ticket->message->value);
    $this->assertActualDate($ticket->created->value);
  }
}
