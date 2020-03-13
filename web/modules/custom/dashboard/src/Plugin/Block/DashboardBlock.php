<?php
/**
 * @file
 * Contains \Drupal\dashboard\Plugin\Block\DashboardBlock.
 */

namespace Drupal\dashboard\Plugin\Block;

use Drupal\node\NodeInterface;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides a 'dashboard' block.
 *
 * @Block(
 *   id = "D_block",
 *   admin_label = @Translation("D  block"),
 *   category = @Translation("Custom Dashboard Block example")
 * )
 **/
class DashboardBlock extends BlockBase {

  /**
   * {@inheritdoc}
   **/
   
  public function build() 
  {
	$query = db_select('node','n');
	$query->fields('n');
	$query->condition('n.type',attorney);
	$result = $query->execute()->fetchAll();
	
	$a_count = null;
	foreach ($result as $a) {
		foreach ($a as $b) {
			$a_count++;
		}
	}
	
	$strPager ='<h1>total:='.$a_count.'</h1>';
	  
		
    return [
      '#markup' => $strPager,
      '#cache' => [
        'max-age' => 0,
      ],
    ];
  }
}
