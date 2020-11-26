<?php

/**
 * Plugin Name: Addon/Test
 * Author: Putte
 * Description:  Test-pluginet innehåller en testfunktion för att testa räknefunktionen "is_seven_letters_long" ifrån uppgift 2.
 * Denna funktion tar emot två parametrar: $strängen_som_ska_testas och (bool) $förväntat_returvärde
 * Om räknefunktionen returnerar det förväntade värdet så skriver testfunktionen ut: "Lyckat test"
 * Om räknefunktionen inte returnerar det förväntade värdet så skriver testfunktionen ut: "Test misslyckades", gärna i rött.
 * I bägge fall skriver testfunktionen ut teststrängen, förväntade värdet samt räknefunktionens returnerade värde.
 *Testpluginet innehåller också tre hårdkodade strängar på respektive 6, 7 och 9 tecken.
 *Dessa skall alla testas med varsitt anrop till testfunktionen.
 *Gör dessa anrop så att två stycken genererer "Lyckat test" och den sista genererer "Misslyckat test"
 * Anropen till testfunktionen körs endast om url-parametern "testrun" är satt till "yes"
 */


class test_app
{

  public function test_function($string, $förväntat_returvärde)
  {
    $newtest = new counter();
    $test = $newtest->is_seven_letters_long($string);

    if ($test == $förväntat_returvärde) {
      echo '<p>Lyckat test!</p>';
    } else {
      echo '<p class="error">Test misslyckades</p>';
    }
  }
  public function __construct()
  {
    add_action('wp_head', [$this, 'testforsevenletter']);
  }
}
$runtest = new test_app();
//Får inte denna att fungera. Får varning: Warning: call_user_func_array() expects parameter 1 to be a valid callback, class 'test_app' does not have a method 'testforsevenletter' in /Applications/MAMP/htdocs/CMS2/labb3/wp-includes/class-wp-hook.php on line 287. Men jag har testat olika saker fram och tillbaka.
?>

<style>
  .error {
    color: red;
    font-size: 1.5em;
  }
</style>