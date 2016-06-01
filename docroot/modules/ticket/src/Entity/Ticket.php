<?php

/**
 * @file
 * Contains \Drupal\ticket\Entity\TicketEntity.
 */

namespace Drupal\ticket\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\ticket\TicketInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

class Ticket extends ContentEntityBase implements TicketInterface {
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Ticket Entity'))
      ->setReadOnly(TRUE);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setDescription(t('The title of the Ticket Entity'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ));
  }
}
