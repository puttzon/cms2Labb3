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
    if (strlen($string) === 7) {
      return true;
    } else {
      return false;
    }
  }
  public function __construct()
  {
    add_action('wp_head', [$this, 'is_seven_letters_long']);
  }
}

$newcounter = new counter();


// Utan OOP
// function is_seven_letters_long($seven)
// {
//   if (strlen($seven) === 7) {
//     return true;
//   } else {
//     return false;
//   }
// }

// add_action('wp_head', 'is_seven_letters_long');
// var_export(is_seven_letters_long('asdfghj'));
