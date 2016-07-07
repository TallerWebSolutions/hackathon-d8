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

/**
 * @ContentEntityType(
 *   id = "ticket",
 *   label = @Translation("Ticket"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider",
 *     },
 *     "form" = {
 *       "add" = "Drupal\ticket\Entity\TicketForm"
 *     },
 *   },
 *   list_cache_contexts = { "user" },
 *   base_table = "ticket",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "title",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/ticket/{ticket}"
 *   }
 * )
 */
class Ticket extends ContentEntityBase implements TicketInterface {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Ticket Entity'))
      ->setReadOnly(TRUE);

    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Ticket entity.'))
      ->setReadOnly(TRUE);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setDescription(t('The title of the Ticket Entity'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ));

    $fields['message'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Message'))
      ->setDescription(t('The message of the Ticket Entity'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 600,
        'text_processing' => 0,
      ));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('Date created of Ticket Entity'));

    $fields['file'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('File'))
      ->setDescription(t('The attached file of the Ticket Entity'))
      ->setSettings(array(
        'target_type' => 'file',
      ));

    return $fields;
  }
}
