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

/* SHORTCODE TO RETURN AUTHOR POSTS LINK */
add_shortcode( 'mmus_author_posts_link', function(){
  $html = '<span class="coauthors-link">by ';

  if ( function_exists('coauthors_posts_links') ) {
    $html .= coauthors_posts_links( null, null, null, null, false );
  } else {
    $html .= get_the_author_posts_link();
  }

  $html .= '</span>';
  return $html;
} );
