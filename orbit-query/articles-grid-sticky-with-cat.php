<div>
	<?php if( count( $this->query->posts ) ): $categories = wp_get_post_categories( $this->query->posts[0]->ID, ['ids'] ); ?>
		<div class="related-posts">
			<h2 class="headline cat-headline">
	      <span class="title">Latest Issue</span>
	      <a href="<?php _e( get_category_link( $categories[0] ) );?>" class="view-all"><span>View all <i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
	    </h2>
			<div class="decorator mmus-dec-af" aria-hidden="true"></div>
		</div>
	<?php endif;?>
	<ul id="<?php _e( $atts['id'] );?>" data-target="<?php _e('li.orbit-article-db');?>" data-url="<?php _e( $atts['url'] );?>" class="articles-grid articles-grid-sticky orbit-list-db">
		<?php $i = 1; while( $this->query->have_posts() ) : $this->query->the_post();?>
		<li class="orbit-article-db <?php if( $i == 1){ echo 'sticky'; }?>">
			<?php get_template_part('partials/orbit/post-common');?>
		</li>
		<?php $i++; endwhile;?>
	</ul>
</div>
