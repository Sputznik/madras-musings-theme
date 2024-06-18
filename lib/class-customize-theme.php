<?php

class MMUS_THEME_CUSTOMIZE {

  function __construct(){

    add_action('customize_register', function( $wp_customize ){
      global $sp_customize;
      $sp_customize->section( $wp_customize, 'sp_theme_panel', 'mmus_header_section',  "MMUS Header", "MMUS Header" );
      $sp_customize->text( $wp_customize, 'mmus_header_section', '[mmus_header][secondary_desc]', 'Secondary Description', '');
    } );

  }

  function get_header_field( $name ){
   global $sp_customize;
   $field = $sp_customize->get_one_option( 'mmus_header' , '' );
   if( !empty( $field ) && isset( $field[$name] ) && $field[$name] ){
     return $field[$name];
   }
   return "Add field value";
 }

}

global $mmus_customize;

$mmus_customize = new MMUS_THEME_CUSTOMIZE;
