<?php

namespace Drupal\doa_custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Utility;
use \Drupal\node\Entity\Node;

/**
 * MediaAdd Class. Contains the methods for playlist/timeline/quote creation.
 */
class Scraper extends ControllerBase {

  /**
   * Adds the media item to playlist/timeline depending on the parametrs.
   */
  public function scraper($scraper_id) {

    $mainurl = "https://courttribunalfinder.service.gov.uk/courts/".$scraper_id;
    $mainch = curl_init();
    curl_setopt ($mainch, CURLOPT_URL, $mainurl);
    curl_setopt ($mainch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt ($mainch, CURLOPT_RETURNTRANSFER, true);
    $maincontents = curl_exec($mainch);
    if (curl_errno($mainch)) {
      echo curl_error($mainch);
      echo "\n<br />";
      $maincontents = '';
    } else {
      curl_close($mainch);
    }

    if (!is_string($maincontents) || !strlen($maincontents)) {
      $maincontents = '';
    }

    $maincontents = explode( '<h2 class="clear letterheader">Names starting with' , $maincontents );
    $maincontents = explode( '<nav role="navigation"' , $maincontents[1] );
    $courtlist = $maincontents[0];

    $courtlist = explode( '<li>' , $courtlist );

    print_r($courtlist);
    die();




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
    $maincontent = $contents;
    $contents = explode( '<h1>' , $contents );
    $contents = explode( '</h1>' , $contents[1] );
    $title = $contents[0];

    $contents = explode( '<span property="streetAddress">' , $contents[1] );
    $contents = explode( '</span>' , $contents[1] );
    $streetAddress = $contents[0];

    $contents = explode( '<span property="addressLocality">' , $maincontent );
    $contents = explode( '</span>' , $contents[1] );
    $addressLocality = $contents[0];

    $contents = explode( '<span property="addressRegion">' , $maincontent );
    $contents = explode( '</span>' , $contents[1] );
    $addressRegion = $contents[0];

    $contents = explode( '<span property="postalCode">' , $maincontent );
    $contents = explode( '</span>' , $contents[1] );
    $postalCode = $contents[0];

    $contents = explode( '<p id="map-link">' , $maincontent );
    $contents = explode( '</p>' , $contents[1] );
    $map_full_content = $contents[0];
    $map_full_content = explode( '<a href="' , $map_full_content );
    $map_full_content = explode( '" target="_blank"' , $map_full_content[1] );
    $mapAddress = $map_full_content[0];

    $contents = explode( '<div id="left">' , $maincontent );
    $contents = explode( '<div id="areas_of_law">' , $contents[1] );
    $content = preg_replace("/<img[^>]+\>/i", "", $contents[0]);
    $body = $content;

    $contents = explode( '<div id="areas_of_law">' , $maincontent );
    $contents = explode( '</div>' , $contents[1] );
    $casesHeard = $contents[0];

    $arrayName = [
      '$title' => $title,
      '$streetAddress' => $streetAddress,
      '$addressLocality' => $addressLocality,
      '$addressRegion' => $addressRegion,
      '$postalCode' => $postalCode,
      '$mapAddress' => $mapAddress,
      '$body' => $body,
      '$casesHeard' => $casesHeard

    ];

    // $node = Node::create([
    //   'type' => 'courts',
    //   'title' => $title,
    //   'field_address_locality' => $addressLocality,
    //   'field_address_region' => $addressRegion,
    //   'field_map_link' => $mapAddress,
    //   'field_postal_code' => $postalCode,
    //   'field_street_address' => [
    //     'value' => $streetAddress,
    //     'format' => 'basic_html',
    //   ],
    //   'field_cases_heard' => [
    //     'value' => $casesHeard,
    //     'format' => 'full_html',
    //   ],
    //   'body' => [
    //     'value' => $body,
    //     'format' => 'full_html',
    //   ]
    // ]);
    // $node->save();

    $element = array(
      '#markup' => "saved",
    );
    return $element;
  }
}
