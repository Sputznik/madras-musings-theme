<?php
/**
 * The template for displaying author page
 */
get_header();
$author        = $wp_query->get_queried_object();
$shortcode_str = "[orbit_query posts_per_page='9' style='grid3-with-cat' ";

if( isset( $author->type ) && $author->type == 'wpuser' ){
  $shortcode_str .= "author='".$author->ID."'";
} else {
  $shortcode_str .= "tax_query='author:cap-".$author->user_nicename."'";
}

$shortcode_str .= "]";
?>
<div class="author-header archive-header">
  <div class="container">
    <h1 class="page-title text-capitalize text-center mmus-dec-af"><?php _e( $author->display_name ); ?></h1>
    <div class="page-description text-center"><?php _e( $author->description ); ?></div>
  </div>
</div>
<?php $shortcode_str = do_shortcode( $shortcode_str ); ?>
<?php if( strlen( $shortcode_str ) > 0 ): ?>
  <div class="container">
    <h3 class="text-center author-posts-headline">Articles by the author</h3>
    <div class="articles-post-list-wrap">
      <?php echo $shortcode_str; ?>
    </div>
  </div>
<?php endif; ?>
<?php get_footer(); ?>
