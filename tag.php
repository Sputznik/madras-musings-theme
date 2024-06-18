<?php
/**
 * The template for displaying tag page
 */
get_header();
$tag = get_queried_object();
?>
<div class="tag-header archive-header">
  <div class="container-fluid">
    <h1 class="page-title text-capitalize text-center mmus-dec-af"><?php _e( $tag->name ); ?></h1>
  </div>
</div>
<div class="container">
  <div class="articles-post-list-wrap">
    <?php echo do_shortcode("[orbit_query posts_per_page='9' style='grid3-with-cat' tag='".$tag->slug."' pagination='1']"); ?>
  </div>
</div>
<?php get_footer(); ?>
