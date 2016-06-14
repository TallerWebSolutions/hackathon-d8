<?php

namespace Drupal\Tests\ticket\Unit;

use Drupal\ticket\Entity\Ticket;
use Drupal\ticket\TicketInterface;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
// use Drupal\Tests\UnitTestCase;
// use Drupal\entity_test\Entity\EntityTest;

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
  public function testTicketCrud() {
    $entity = $this->container->get('entity_type.manager')
      ->getStorage('ticket')
      ->create(array('title' => 'test'));
    $entity->save();
    $entity = $this->container->get('entity_type.manager')
      ->getStorage('ticket')
      ->create(array('title' => 'test'));
    $entity->save();

    $tickets = array_values(entity_load_multiple_by_properties('ticket', array('title' => 'test')));
    $this->assertEqual(count($tickets), 1);
    // $this->assertTrue(!empty($entity->uuid), 'The ticket was not properly created.');
  }
}
