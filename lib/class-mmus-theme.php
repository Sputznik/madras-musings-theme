<?php

/**
 * BOOTSTRAPS THEME SPECIFIC FUNCTIONALITIES
 */
class MMUS_THEME {

  private $sidebars;

  public function __construct() {
    add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );  // LOAD ASSETS

    // COMMENT FORM FIELDS
    add_filter('comment_form_default_fields',function( $fields ){
      unset( $fields['url'] );
      return $fields;
    } );

    add_filter( 'comment_form_defaults', function( $defaults ){
      $defaults['title_reply'] = __( 'Comments', 'madras-musings-theme' );
      return $defaults;
    } );

  }

  function assets() {

    // ENQUEUE STYLES
    wp_enqueue_style('mmus-core-css', MMUS_THEME_URI.'/assets/css/main.css', array('sp-core-style'), MMUS_THEME_VERSION );

  }

}

new MMUS_THEME;
