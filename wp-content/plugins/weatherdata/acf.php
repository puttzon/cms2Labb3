<?php

if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array(
    'key' => 'group_5fb6688f4ea4c',
    'title' => 'Pages for plugin',
    'fields' => array(
      array(
        'key' => 'field_5fb668a46b7d2',
        'label' => 'Options',
        'name' => 'options',
        'type' => 'checkbox',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'Shop' => 'Shop',
          'Single product' => 'Single product',
          'Cart Empty' => 'Cart Empty',
          'My account' => 'My account',
          'Checkout' => 'Checkout',
        ),
        'allow_custom' => 0,
        'default_value' => array(
        ),
        'layout' => 'vertical',
        'toggle' => 0,
        'return_format' => 'value',
        'save_custom' => 0,
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'Väder-settings',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
  ));
  
  endif;
