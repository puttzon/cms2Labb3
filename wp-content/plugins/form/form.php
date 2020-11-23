<?php

/** 
 * Plugin Name: Form
 * Author: Putte
 * Description: * Detta plugin skall kunna skriva ut ett kontaktformulär. Vid inskickat svar så sparas svaret i en lista som går att nå ifrån wp admin.
 * (Ungefär som pluginet Contactform7 med Flamingo.)
 * Tips: Formulär/ajax/register_posttype/insert_post/post_meta
 */

class form
{
  // Kör alla action i construct
  public function __construct()
  {
    add_action('woocommerce_account_content', [$this, 'formdata'], 20);
    add_action('init', [$this, 'messages']);
    add_action('wp_ajax_kontaktformular', [$this, 'get_posts']);
  }

  //Formulär
  public function formdata()
  { ?>
    <form action="
    <?php echo admin_url('admin-ajax.php');
    echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

      <label for="name">Name</label>
      <input type="text" name="name">
      <label for="email">Email</label>
      <input type="email" name="email">
      <label for="message">Message</label>
      <textarea name="message" cols="30" rows="10"></textarea>
      <input type="submit" value="Send" style="margin-top: .5em;">
      <input type="hidden" name="action" value="kontaktformular">
    </form>

    <?php
    //Returnerar tack om redirect sent är satt
    if (isset($_REQUEST['sent'])) {
      echo 'Tack för ditt meddeland.';
    }
    ?>
<?php }

  //Egen posttype
  public function messages()
  {
    register_post_type('meddelanden', [
      'labels' => [
        'name' => __('Meddelanden'),
        'singular_name' => __('Meddelande')
      ],
      'public' => true,
      'has_archive' => true
    ]);
  }
  // Tar emot formulär data och skickar till Meddelande
  public function get_posts()
  {
    $post_id = wp_insert_post(array(
      'post_title' => $_REQUEST['name'],
      'post_content' => $_REQUEST['message'],
      'post_type' => 'Meddelanden'
    ));
    //Hämtar email, visar mail med acf
    update_post_meta($post_id, 'email', $_REQUEST['email']);
    //Redirect efter skickat formulär
    wp_redirect($_SERVER['HTTP_REFERER'] . '?sent=true');
    die();
  }
}

$newform = new form();
?>