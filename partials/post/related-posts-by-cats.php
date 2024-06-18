<?php
/**
 * The template for displaying related posts based on post-categories.
 */
$post_id = get_the_ID();
$categories = wp_get_post_categories( $post_id, ['ids'] );

$shortcode_str = do_shortcode("[orbit_query posts_per_page='4' style='grid4' cat='".$categories[0]."' post__not_in='".$post_id."']");
if( !empty( $categories ) && strlen( $shortcode_str ) > 0 ): ?>
  <div class="related-posts">
    <h2 class="headline cat-headline">
      <span class="title">Also in this issue</span>
      <a href="<?php _e( get_category_link( $categories[0] ) );?>" class="view-all"><span>View all <i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
    </h2>
    <div class="decorator mmus-dec-af" aria-hidden="true"></div>
    <?php echo $shortcode_str;?>
  </div>
<?php endif;?>
