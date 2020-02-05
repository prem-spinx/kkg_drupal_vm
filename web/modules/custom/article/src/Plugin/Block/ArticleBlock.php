<?php
/**
 * @file
 * Contains \Drupal\article\Plugin\Block\XaiBlock.
 */

namespace Drupal\article\Plugin\Block;

use Drupal\node\NodeInterface;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;


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
   
  public function build() 
  {
	  global $base_url;
	  
	  $node = \Drupal::routeMatch()->getParameter('node');
	  
	  
      if ($node instanceof \Drupal\node\NodeInterface) {
      $nid = $node->id();
	  $type = $node->bundle();
	  $ctype = 'attorney';
	  $class ='next-prev container';
	  
	  $pre = '';
      $next = '';
	  // fetch the nodes based on the content type ( $ ctype="--content type name--")
	  // sort the data by created time.
	  
	  $n_ids = \Drupal::entityQuery('node')
        ->condition('status', 1)
        ->condition('type', $ctype)
        ->sort('created')
        ->execute();
		
	// for count the node 	
	 $node_count = 0;
	 // store the order of nodes by created time
	 $node_order = [];
	 foreach ($n_ids as $key => $new_value) {
        $node_order[$node_count] = $new_value;
        $node_count++;
      }
	  // next and previous value set 
	  $c_node = array_search($nid,$node_order);
	  $n_node_k = $c_node + 1;
	  $p_node_k = $c_node - 1;
	  // fetch the  value of key 
	  $p_node = $node_order[$p_node_k];
      $n_node= $node_order[$n_node_k];
	  //get the url alias 
	  $p_alias = \Drupal::service('path.alias_manager')->getAliasByPath('/node/'.$p_node);
      $n_alias = \Drupal::service('path.alias_manager')->getAliasByPath('/node/'.$n_node);
	  
	  //name and id of node 
	  $p_node_id = \Drupal::entityTypeManager()->getStorage('node')->load($p_node);
      $p_node_name = isset($p_node_id) ? $p_node_id->get('title')->getValue() : '';
	  
	  $n_node_id = \Drupal::entityTypeManager()->getStorage('node')->load($n_node);
      $n_node_name = isset($n_node_id) ? $n_node_id->get('title')->getValue() : '';
	  
	  // get the actual link
	  $pre_link = $p_node_name[0]['value'];
      $next_link = $n_node_name[0]['value'];
	  // for both node inactive
	  if(empty($p_node_id) && empty($n_node_id)){
      	$strPager = '
              <div class="'.$class.'">
			  <h1>Sorry....... </h1>
              </div>';
	  //for  next node active
      } elseif (empty($p_node_id) && !empty($n_node_id)) {
      	$strPager = '
              <div class="'.$class.'">
              <a class="np-next btn btn-primary" href="'.$base_url.'/'. $n_alias .' ">'.$next_link.'</a>
              </div>';
	  // for pervious node active
      } elseif (!empty($p_node_id) && empty($n_node_id)) {

      	$strPager = '
              <div class="'.$class.'">
              <a class="np-prev btn btn-primary" href="'.$base_url.'/'. $p_alias .' ">'.$pre_link.'</a>
            <a></a></div>';
	  // both node active
      } elseif (!empty($p_node_id) && !empty($n_node_id)) {

      	$strPager = '
              <div class="'.$class.'">
              
              <a class="np-prev btn btn-primary" href="'.$base_url.'/' . $p_alias . '">'.$pre_link.'</a>
			  <a class="np-next btn btn-primary" href="'.$base_url.'/'. $n_alias .' ">'.$next_link.'</a>
            </div>';
      }      
	 
}
    return [
      '#markup' => $strPager,
      '#cache' => [
        'max-age' => 0,
      ],
    ];
  }
}
