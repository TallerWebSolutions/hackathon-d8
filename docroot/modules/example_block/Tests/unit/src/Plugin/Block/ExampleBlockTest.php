<?php

namespace Drupal\Tests\Core\Block;

use Drupal\Tests\UnitTestCase;
use Drupal\example_block\Plugin\Block\ExampleBlock;

/**
 * @coversDefaultClass \Drupal\Core\Block\BlockBase
 * @group block
 */
class ExampleBlockTest extends UnitTestCase {
  private $transliteration, $config, $block_id;

  public function setUp() {
    $this->config = array();
    $module_handler = $this->getMock('Drupal\Core\Extension\ModuleHandlerInterface');

    $this->block_id = 'example_block';
    $this->transliteration = $this->getMockBuilder('Drupal\Core\Transliteration\PhpTransliteration')
      ->setConstructorArgs(array(NULL, $module_handler))
      ->setMethods(array('readLanguageOverrides'))
      ->getMock();
  }

  /**
   * Tests the machine name suggestion.
   *
   * @see \Drupal\Core\Block\BlockBase::getMachineNameSuggestion().
   */
  public function testGetMachineNameSuggestion() {
    $definition = array(
      'admin_label' => 'Admin label',
      'provider' => 'block_test',
    );

    $block_base = new ExampleBlock($this->config, $this->block_id, $definition);
    $block_base->setTransliteration($this->transliteration);
    $this->assertEquals('adminlabel', $block_base->getMachineNameSuggestion());

    // Test with more unicodes.
    $definition = array(
      'admin_label' => 'über åwesome',
      'provider' => 'block_test',
    );

    $block_base = new ExampleBlock($this->config, $this->block_id, $definition);
    $block_base->setTransliteration($this->transliteration);
    $this->assertEquals('uberawesome', $block_base->getMachineNameSuggestion());
  }

  /**
   * Tests the machine name suggestion with more Unicodes.
   *
   * @see \Drupal\Core\Block\BlockBase::getMachineNameSuggestion().
   */
  public function testGetMachineNameSuggestionWithMoreUnicodes() {
    $definition = array(
      'admin_label' => 'über åwesome',
      'provider' => 'block_test',
    );

    $block_base = new ExampleBlock($this->config, $this->block_id, $definition);
    $block_base->setTransliteration($this->transliteration);
    $this->assertEquals('uberawesome', $block_base->getMachineNameSuggestion());
  }
}
