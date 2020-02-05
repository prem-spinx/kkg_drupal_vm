<?php
/**
 * @file
 * Contains \Drupal\article\Plugin\Block\XaiBlock.
 */

namespace Drupal\article\Plugin\Block;

use Drupal\Core\Block\BlockBase;


/**
 * Provides a 'article' block.
 *
 * @Block(
 *   id = "article_block",
 *   admin_label = @Translation("Article block"),
 *   category = @Translation("Custom article block example")
 * )
 */
class ArticleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
   
  public function build() {
	  static $name = null;
	  static $node = null;
	  $node = \Drupal::routeMatch()->getParameter('node');
      if ($node instanceof \Drupal\node\NodeInterface) {
      $nid = $node->id();
	  $name = $node->get('title')->value; 
      $id_name = array("id" => $nid, "name" => $name);  
}
    return array(
      '#type' => 'markup',
	  '#markup' => $nid
    );
  }
}
