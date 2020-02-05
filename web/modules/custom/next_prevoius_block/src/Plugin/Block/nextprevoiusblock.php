<?php
/**
 * @file
 * Contains \Drupal\next_prevoius_block\Plugin\Block\XaiBlock.
 */

namespace Drupal\next_prevoius_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;


class Next_Prevoius_Block extends BlockBase {

  /**
   * {@inheritdoc}
   */
    public function build() {
    return array(
      '#type' => 'markup',
      '#markup' => 'This block list the article.',
    );
  }
}