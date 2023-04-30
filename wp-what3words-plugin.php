<?php
/**
 * Plugin Name: Lat Long to What3Words WP Plugin Geo Added Calling - v2.2
 * Description: Converts geolocation data to What3Words address for WP Job Manager location posts.
 * Version: 1.0
 * Author: Joel Gratcyk & MacGPT
 * Author URI: https://joel.gr
 */

require_once("Geocoder.php");

function convert_geo_to_what3words($post_id) {
  // Check if post is a job listing
  if (get_post_type($post_id) !== 'job_listing') {
    return;
  }

  // Check if What3Words meta is already set
  $what3words = get_post_meta($post_id, '_what3words', true);
  if (!empty($what3words)) {
    return;
  }

  // Get latitude and longitude
  $lat = get_post_meta($post_id, 'geolocation_lat', true);
  $long = get_post_meta($post_id, 'geolocation_long', true);

  // Check if lat and long are set
  if (empty($lat) || empty($long)) {
    return;
  }

  // Make API request to convert to What3Words
  $url = 'https://api.what3words.com/v3/convert-to-3wa?key=YOUR_API_KEY&coordinates='.$lat.','.$long.'&language=en&format=json';
  $response = wp_remote_get($url);

  if (is_wp_error($response)) {
    // Handle error
    return;
  }

  $body = json_decode(wp_remote_retrieve_body($response));
  if (isset($body->map)) {
    // Save What3Words meta
    update_post_meta($post_id, '_what3words', $body->map);
  }
}

add_action('save_post', 'convert_geo_to_what3words');
