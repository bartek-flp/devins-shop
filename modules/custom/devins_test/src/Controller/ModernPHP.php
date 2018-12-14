<?php

namespace Drupal\devins_test\Controller;

use Drupal\Core\StringTranslation\StringTranslationTrait;

class ModernPHP {

  use StringTranslationTrait;

  /**
   * @array $odds
   */
  private $odds;

  public function content() {

    $arr = [1,2,3,4,5,6,7,8];

    $filtered = array_filter($arr, function($item) {
      return ($item%2) == 0;
    });


    return array(
      '#theme' => 'modern_php',
      '#title' => $this->t('SOme title'),
      '#data' => $this->odd($arr),
    );

  }

  private function odd($data) {
    return function($item) use ($data) {
      $this->odds = ($item%2) == 0;
      return $this->odds;
    };
  }

}
