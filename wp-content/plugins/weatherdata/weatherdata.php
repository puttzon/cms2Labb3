<?php

/**
 * Plugin Name: Weatherdata
 * Author: Putte
 * Description:  Ett plugin som hämtar väderdata för vald plats, som presenteras med lämpliga      bilder och färger.
 * Detta plugin har en inställningssida med minst fem olika alternativ för var på sidan det ska placeras:
 * Produktsida, shop-sida, cart, checkout eller på en specifik produkt.
 * Se till att cachea den hämtade datan så att inte api:et tillfrågas mer än ca en gång per timme, oavsett hur många sidträffar som sker.
 */


//Funktionen för att hämta API

function get_weather()
{
  $response = wp_remote_get('https://api.met.no/weatherapi/locationforecast/2.0/compact?lat=57.70716&lon=11.96679');
  $body = wp_remote_retrieve_body($response);
  $api_response = json_decode($body, true);
  return $api_response['properties']['timeseries'][0]['data']['instant']['details'];
}

// Skriver ut väderdatan
function print_weather($data)
{
  echo "<p>Dagens väder i Götlaborg</p>";
  echo '<p>Temp: ' . $data['air_temperature'] . ' C</p>';
  echo '<p>Vind: ' . $data['wind_speed'] . ' m/s</p>';
}

// Funktion för transients
function trans()
{
  $transient = get_transient('weather_data');

  if ($transient) {
    $wd = get_transient('weather_data');
  } else {
    $wd = get_weather();
    set_transient('weather_data', $wd, 3600);
  }
  print_weather($wd);
}

//Options
function option_page()
{
  acf_add_options_page([
    'page_title' => 'Väder plugin',
    'menu_title' => 'Väder plugin',
    'menu_slug' => 'Väder-settings',
    'capability' => 'edit_posts',
    'redirect' => false
  ]);
}

add_action('acf/init', 'option_page');
add_action('woocommerce_before_shop_loop_item', 'trans'); // Shop 
add_action('woocommerce_before_single_product', 'trans'); // Single product
add_action('woocommerce_cart_is_empty', 'trans'); // Cart empty
add_action('woocommerce_account_content', 'trans'); // My account
add_action('woocommerce_review_order_before_payment', 'trans', 15); // My account
