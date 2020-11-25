<?php

/**
 * Plugin Name: Weatherdata
 * Author: Putte
 * Description:  Ett plugin som hämtar väderdata för vald plats, som presenteras med lämpliga      bilder och färger.
 * Detta plugin har en inställningssida med minst fem olika alternativ för var på sidan det ska placeras:
 * Produktsida, shop-sida, cart, checkout eller på en specifik produkt.
 * Se till att cachea den hämtade datan så att inte api:et tillfrågas mer än ca en gång per timme, oavsett hur många sidträffar som sker.
 */

require 'weather-acf.php';

//Funktionen för att hämta API
class weather_app
{

  public function get_weather()
  {
    $response = wp_remote_get('https://api.met.no/weatherapi/locationforecast/2.0/compact?lat=57.70716&lon=11.96679');
    $body = wp_remote_retrieve_body($response);
    $api_response = json_decode($body, true);
    return $api_response['properties']['timeseries'][0]['data']['instant']['details'];
  }

  // Skriver ut väderdatan
  public function print_weather($data)
  {
    echo '<div id="vdiv">';
    echo "<p>Dagens väder i Götlaborg</p>";
    echo '<p>Temp: ' . $data['air_temperature'] . ' C</p>';
    echo '<p>Vind: ' . $data['wind_speed'] . ' m/s</p>';
    echo '</div>';
  }

  // Funktion för transients
  public function trans()
  {
    $transient = get_transient('weather_data');

    if ($transient) {
      $wd = get_transient('weather_data');
    } else {
      $wd = $this->get_weather();
      set_transient('weather_data', $wd, 3600);
    }
    $this->print_weather($wd);
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

  // Funktion för radioknappar
  //add_action('wp_head', 'page_view');

  public function page_view()
  {
    $plats = get_field('options', 'option');

    if ($plats === 'Shop') {
      add_action('woocommerce_before_shop_loop_item', [$this, 'trans']);
    }
    if ($plats === 'Single') {
      add_action('woocommerce_before_single_product', [$this, 'trans']);
    }
    if ($plats === 'Cart') {
      add_action('woocommerce_cart_is_empty', [$this, 'trans']);
    }
    if ($plats === 'Account') {
      add_action('woocommerce_account_content', [$this, 'trans']);
    }
    if ($plats === 'Checkout') {
      add_action('woocommerce_review_order_before_payment', [$this, 'trans'], 15);
    }
  }
  public function __construct()
  {
    add_action('wp_head', [$this, 'page_view']);
    add_action('acf/init', [$this, 'option_page']);
  }
}

$weater = new weather_app();
?>

<style>
  #vdiv {
    background: lightblue;
    padding: 1em;
    color: white;
    margin-bottom: .5em;
  }
</style>