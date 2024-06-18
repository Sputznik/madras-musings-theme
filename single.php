<?php
/**
 * The template for displaying all single posts
 */
get_header();
?>
<div id="mmus-single-post">
  <?php if( have_posts()  ): while( have_posts() ): the_post(); ?>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="single-post-header">
            <h1 class="post-title mmus-dec-af"><?php the_title();?></h1>
            <div class="post-meta">
              <span>by <?php the_author_link();?></span>
              <?php if( has_tag() ):?>
                <span class="post-tags">| Tagged in <?php the_tags( '', ', ', '' ); ?></span>
              <?php endif;?>
              <?php if( has_category() ):?>
                <span class="post-categories"><span>| Issue:</span> <?php the_category( ', ', '', '' ); ?></span>
              <?php endif;?>
            </div>
          </div>
          <div class="post-content">
            <?php the_content();?>
          </div>
          <div class="entry-comments">
            <?php // SHOW COMMENTS TEMPLATE IF COMMENTS ARE OPEN OR AT LEAST ONE COMMENT EXISTS
              if( comments_open() || get_comments_number() ){ comments_template(); }
            ?>
          </div>
          <?php get_template_part( 'partials/post/related-posts-by-cats' ); ?>
          <?php get_template_part( 'partials/post/related-posts-by-tags' ); ?>
        </div>
      </div>
    </div>
  <?php endwhile; endif; ?>
</div>
<?php get_footer();?>
