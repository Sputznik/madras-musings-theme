<?php

/* SHORTCODE TO RETURN CATEGORY NAME OF LATEST POST */
add_shortcode( 'mmus_latest_post_category_name', function(){
  $post = get_posts( array( 'fields' => 'ids', 'numberposts' => 1 ) );
  ob_start();
  if( !empty( $post ) ){
    $category = get_the_category( $post[0] );
    if( !empty( $category ) ){
      echo('<span class="latest-post-issue">'.$category[0]->name.'</span>');
    }
  }
  return ob_get_clean();
} );
