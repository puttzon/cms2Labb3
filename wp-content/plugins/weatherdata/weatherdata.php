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

function print_weather($weatherdata)
{
  echo "<p>Dagens väder i Götlaborg</p>";
  echo '<p>Temp: ' . $weatherdata['air_temperature'] . ' C</p>';
  echo '<p>Vind: ' . $weatherdata['wind_speed'] . ' m/s</p>';
}

$wdata = get_weather();
print_weather($wdata);
