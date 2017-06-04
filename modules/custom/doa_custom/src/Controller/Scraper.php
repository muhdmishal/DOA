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

    $contents = explode( '<h1>' , $contents );
    $contents = explode( '</h1>' , $contents[1] );
    $title = $contents[0];

    $contents = explode( '<span property="streetAddress">' , $contents[1] );
    $contents = explode( '</span>' , $contents[1] );
    $streetAddress = $contents[0];

    $contents = explode( '<span property="addressLocality">' , $contents[1] );
    $contents = explode( '</span>' , $contents[1] );
    $addressLocality = $contents[0];

    $contents = explode( '<span property="addressRegion">' , $contents[1] );
    $contents = explode( '</span>' , $contents[1] );
    $addressRegion = $contents[0];

    $contents = explode( '<span property="postalCode">' , $contents[1] );
    $contents = explode( '</span>' , $contents[1] );
    $postalCode = $contents[0];

    $contents = explode( '<p id="map-link">' , $contents[1] );
    $contents = explode( '</p>' , $contents[1] );
    $map_full_content = $contents[0];
    $map_full_content = explode( '<a href="' , $map_full_content );
    $map_full_content = explode( '" target="_blank"' , $map_full_content[1] );
    $mapAddress = $map_full_content[0];

    $contents = explode( '<div id="left">' , $contents[1] );
    $contents = explode( '<div id="areas_of_law">' , $contents[1] );
    $body = $contents[0];

    $arrayName = [
      '$title' => $title,
      '$streetAddress' => $streetAddress,
      '$addressLocality' => $addressLocality,
      '$addressRegion' => $addressRegion,
      '$postalCode' => $postalCode,
      '$mapAddress' => $mapAddress,
      '$body' => $body,

    ];
    print_r($title . $streetAddress);
    die();
    $element = array(
      '#markup' => $contents,
    );
    return $element;
  }
}
