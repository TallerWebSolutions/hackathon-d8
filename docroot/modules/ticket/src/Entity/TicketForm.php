<?php
/**
* @file
* Contains Drupal\ticket\Entity\TicketForm.
*/

namespace Drupal\ticket\Entity;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
* Form controller for the ticket entity edit forms.
*/

class TicketForm extends ContentEntityForm {

  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\ticket\Entity\TicketForm */
    $form = parent::buildForm($form, $form_state);

    $ticket = $this->entity;

    return $form;
  }

}
