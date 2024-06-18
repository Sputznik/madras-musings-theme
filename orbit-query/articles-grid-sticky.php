<ul id="<?php _e( $atts['id'] );?>" data-target="<?php _e('li.orbit-article-db');?>" data-url="<?php _e( $atts['url'] );?>" class="articles-grid articles-grid-sticky orbit-list-db">
	<?php $i = 1; while( $this->query->have_posts() ) : $this->query->the_post();?>
	<li class="orbit-article-db <?php if( $i == 1){ echo 'sticky'; }?>">
		<?php get_template_part('partials/orbit/post-common');?>
	</li>
	<?php $i++; endwhile;?>
</ul>
