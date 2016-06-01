<?php

namespace Drupal\Tests\ticket\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\ticket\Entity\Ticket;
use Drupal\ticket\TicketInterface;

/**
 * Tests generation of ticket.
 *
 * @group ticket
 */
class TicketTest extends UnitTestCase {
  public function testTicketType() {
    $mock = $this->getMock('Drupal\ticket\TicketInterface');
    print_r($mock);
    $this->assertTrue($mock instanceof TicketInterface);
  }
}
