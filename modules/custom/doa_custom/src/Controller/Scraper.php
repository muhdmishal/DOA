<?php

namespace Drupal\doa_custom\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * MediaAdd Class. Contains the methods for playlist/timeline/quote creation.
 */
class Scraper extends ControllerBase {

  /**
   * Adds the media item to playlist/timeline depending on the parametrs.
   */
  public function scraper() {
    $element = array(
      '#markup' => 'Hello, world',
    );
    return $element;
  }
}
