<?php
/**
 * The template for displaying related posts based on post-tags.
 */
$post_id = get_the_ID();
$tags = wp_get_post_tags( $post_id, ['slug'] );
$tag_str = implode(',', wp_list_pluck( $tags, 'slug' ) );

$shortcode_str = do_shortcode("[orbit_query posts_per_page='4' style='grid4' tag='".$tag_str."' post__not_in='".$post_id."']");
if( $tag_str && strlen( $shortcode_str ) > 0 ): ?>
  <div class="related-posts">
    <h2 class="headline title decorator mmus-dec-af">Related reads</h2>
    <?php echo $shortcode_str;?>
  </div>
<?php endif;?>
