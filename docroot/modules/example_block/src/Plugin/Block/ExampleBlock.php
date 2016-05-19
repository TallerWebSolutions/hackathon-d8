<?php

/**
 * Provides a 'Hello' Block
 *
 * @Block(
 *   id = "example_block",
 *   admin_label = @Translation("Example Block"),
 * )
 */

namespace Drupal\example_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

class ExampleBlock extends BlockBase {
  public function build() {
    return array(
      '#markup' => $this->t('Hello, World!'),
    );
  }
}
