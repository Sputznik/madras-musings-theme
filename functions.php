<?php

/*  CONSTANTS */
if( !defined( 'MMUS_THEME_VERSION' ) ) {
  define( 'MMUS_THEME_VERSION', time() );
}

if( !defined( 'MMUS_THEME_URI' ) ) {
  define( 'MMUS_THEME_URI', get_stylesheet_directory_uri() );
}

if( !defined( 'MMUS_THEME_PATH' ) ) {
  define( 'MMUS_THEME_PATH', get_stylesheet_directory() );
}

// INCLUDE FILES
$inc_files = array(
  'lib/class-mmus-theme.php',
  'lib/class-customize-theme.php'
);

foreach( $inc_files as $inc_file ){ require_once( $inc_file ); }
