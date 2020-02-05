<?php

namespace Drupal\drupalup_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

class DrupalupBlock extends BlockBase {

  public function build() {
    return [
      '#markup' => $this->getRandQuote(),
      '#cache' => [
        'max-age' => 0
      ],
    ];
  }
  private function getRandQuote() {
    $quotes = [
      '<i>Whoever is happy will make others happy too.</i> Anne Frank',
      '<i>The secret of getting ahead is getting started.</i> Mark Twain',
      '<i>You can\'t blame gravity for falling in love.</i> Albert Einstein',
      '<i>The weak can never forgive. Forgiveness is the attribute of the strong.</i> Mahatma Gandhi'
    ];
    return $quotes[array_rand($quotes)];
  }

}
