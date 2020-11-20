<?php

/** 
 * Plugin Name: Form
 * Author: Putte
 * Description: * Detta plugin skall kunna skriva ut ett kontaktformulär. Vid inskickat svar så sparas svaret i en lista som går att nå ifrån wp admin.
 * (Ungefär som pluginet Contactform7 med Flamingo.)
 * Tips: Formulär/ajax/register_posttype/insert_post/post_meta
 */
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  function form()
  { ?>
    <section id="formsection">

      <form action="" method="post">
        <label for="name">Name</label>
        <input type="text" name="name" id="">
        <label for="mail">Mail</label>
        <input type="email" name="mail" id="">
        <label for="message">Message</label>
        <textarea name="message" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="Send">
      </form>

    </section>
  <?php }
  ?>
</body>

</html>

<?php
add_action('woocommerce_account_content', 'form', 20);
