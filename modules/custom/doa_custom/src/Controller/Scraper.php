<?php

namespace Drupal\doa_custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Utility;

/**
 * MediaAdd Class. Contains the methods for playlist/timeline/quote creation.
 */
class Scraper extends ControllerBase {

  /**
   * Adds the media item to playlist/timeline depending on the parametrs.
   */
  public function scraper() {

    $url = "https://courttribunalfinder.service.gov.uk/courts/aberdeen-employment-tribunal";
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    $contents = curl_exec($ch);
    if (curl_errno($ch)) {
      echo curl_error($ch);
      echo "\n<br />";
      $contents = '';
    } else {
      curl_close($ch);
    }

    if (!is_string($contents) || !strlen($contents)) {
    echo "Failed to get contents.";
    $contents = '';
    }

    //echo $contents;

    $doc = new \DOMDocument();

    // We don't want to bother with white spaces
    $doc->preserveWhiteSpace = false;

    // Most HTML Developers are chimps and produce invalid markup...
    $doc->strictErrorChecking = false;
    $doc->recover = true;

    $doc->loadHTMLFile($contents);

    $xpath = new DOMXPath($doc);

    $query = "//div[@id='visiting']";

    $entries = $xpath->query($query);
    //var_dump($entries->item(0)->textContent);

    $element = array(
      '#markup' => $entries->item(0)->textContent,
    );
    return $element;
  }
}
