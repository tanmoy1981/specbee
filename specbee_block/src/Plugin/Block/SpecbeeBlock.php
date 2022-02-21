<?php

namespace Drupal\specbee_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Specbee' Block.
 *
 * @Block(
 *   id = "specbee_block",
 *   admin_label = @Translation("Specbee block"),
 * )
 */
class SpecbeeBlock extends BlockBase {

  /**
   * {@inheritdoc}
   *
   * @return build array
   */
  public function build() {
    $placeholder = 'spacbee_special_lazybuild_placeholder';
    $build['specbee_content'] = [
      '#theme' => 'specbee_block',
      '#country' => 'India',
      '#city' => 'Mumbai',
      '#lazy_builder_var' => $placeholder,
    ];

    $build['#attached']['placeholders'][$placeholder] = [
      '#lazy_builder' => ['specbee_block.calculate_date_time:getDateTime', []],
    ];

    return $build;
  }

}
