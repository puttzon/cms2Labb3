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

  public function test_function($strangen_som_ska_testas, $forvantat_returvarde)
  {
    $newtest = new counter();
    $test = $newtest->is_seven_letters_long($strangen_som_ska_testas);

    if ($test == $forvantat_returvarde) {
      echo '<p>Lyckat test!</p>';
    } else {
      echo '<p class="error">Test misslyckades</p>';
    }
  }

  public function run_test()
  {
    $six = 'asdfgh';
    $seven = 'asdfghj';
    $nine = 'asdfghjkl';
    $this->test_function($six, false);
    $this->test_function($seven, true);
    $this->test_function($nine, false);
  }
  public function __construct()
  {
    add_action('wp_head', [$this, 'run_test']);
  }
}
$runtestone = new test_app();

?>

<style>
  .error {
    color: red;
    font-size: 1.5em;
  }
</style>