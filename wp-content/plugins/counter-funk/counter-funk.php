<?php
/*
 * Plugin Name: Counter-funk
 * Author: Putte 
 * Description: Detta är ett plugin som erbjuder en räknefunktion: "is_seven_letters_long".
 */

class counter
{

  public function is_seven_letters_long($string)
  {
    $x = strlen($string);
    $bool = false;
    if ($x === 7) {
      $bool = true;
    }
    return $bool;
  }
  public function __construct()
  {
    add_action('wp_footer', [$this, 'is_seven_letters_long']);
  }
}

$newcounter = new counter();
