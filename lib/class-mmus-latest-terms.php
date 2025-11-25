<?php

class MMUS_LATEST_TERMS {

  function __construct(){
    add_filter( 'wp_get_nav_menu_items', array( $this, 'nav_filter'), 10, 2 );
  }

  private function get_menu_slug(){
    return 'header';
  }

  private function get_total_terms_count(){
    return 5;
  }

  private function get_mmus_latest_terms(){
    $atts = array(
      'number'      => $this->get_total_terms_count(),
      'order'       => 'DESC',
      'orderby'     => 'term_id',
      'taxonomy'    => 'category',
      'hide_empty'	=> true
    );

    $terms = get_terms($atts);

    return is_wp_error( $terms ) || empty( $terms ) ? array() : array_values( $terms );

  }

  function nav_filter( $items, $menu ){

    if( is_admin() || $this->get_menu_slug() !== $menu->slug  ){
      return $items;
    }

    $current_index    = 1;
    $latest_terms     = $this->get_mmus_latest_terms();
    $max_latest_terms = $this->get_total_terms_count();

    foreach( $items as $nav_item ){

      // EXIT THE LOOP IF CURRENT INDEX IS > TOTAL ALLOWED LATEST TERMS
      if( $current_index > $max_latest_terms ){
        break;
      }

      if( empty( $nav_item->classes ) || !in_array( 'mmus-latest-term', $nav_item->classes ) ){
        continue;
      }

      $nav_item->url   =  get_term_link( $latest_terms[$current_index - 1] );
      $nav_item->title = $latest_terms[$current_index - 1]->name;
      $current_index++;

    }

    return $items;

  }

}

new MMUS_LATEST_TERMS();
