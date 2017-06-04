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
      $contents = '';
    }

    $path=new \DOMXpath($contents);
    $dom=$path->query("*/div[@id='visiting']");
    if (!$dom==0) {
       foreach ($dom as $dom) {
          print "
    The Type of the element is: ". $dom->nodeName. "
    <b><pre><code>";
          $getContent = $dom->childNodes;
          foreach ($getContent as $attr) {
             print $attr->nodeValue. "</code></pre></b>";
          }
       }
    }
    die();
    $element = array(
      '#markup' => $contents,
    );
    return $element;
  }
}
