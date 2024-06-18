<?php
/**
 * The template for displaying category page
 */
get_header();
$category = $wp_query->get_queried_object();
$grid_three_posts_count = 0;
$grid_sticky_posts_count = 7;

// CALCULATE TOTAL POSTS TO BE SHOWN IN 3 COLUMN GRID
if( $category->count > 7 ){
  $grid_three_posts_count = $category->count - $grid_sticky_posts_count;
} else {
  $grid_three_posts_count = $grid_sticky_posts_count - $category->count;
} ?>
<div class="category-header archive-header">
  <div class="container">
    <h1 class="page-title text-capitalize text-center mmus-dec-af"><?php _e( $category->name ); ?></h1>
  </div>
</div>
<div class="container">
  <div class="articles-post-list-wrap">
    <?php echo do_shortcode("[orbit_query posts_per_page='".$grid_sticky_posts_count."' style='grid-sticky' cat='".$category->term_id."']"); ?>
    <?php echo do_shortcode("[orbit_query offset='7' posts_per_page='".$grid_three_posts_count."' style='grid3' cat='".$category->term_id."']"); ?>
  </div>
</div>
<?php get_footer(); ?>
