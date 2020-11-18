<?php
/*
 * Plugin Name: Counter-funk
 * Author: Putte 
 * Description: Detta är ett plugin som erbjuder en räknefunktion: "is_seven_letters_long".
 */



function is_seven_letters_long($string)
{
  $x = strlen($string);
  $bool = false;
  if ($x === 7) {
    $bool = true;
  }
  return $bool;
}

// is_seven_letters_long('asdfghj');

// add_action('wp_footer', 'funkis');

// function funkis()
// {
//   var_dump(is_seven_letters_long('asdfghj'));
// }
