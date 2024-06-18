<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title('');?></title>
		<?php wp_head();?>
	</head>
	<body <?php body_class(); ?>>
		<?php do_action('sp_header');?>
		<div class="container">
			<div class="sub-header">
				<div class="col-left">
					<?php
						global $mmus_customize;
						echo $mmus_customize->get_header_field('secondary_desc');
					?>
				</div>
				<div class="col-right">
					<?php _e(	do_shortcode('[mmus_latest_post_category_name]')	);?>
				</div>
			</div>
		</div>
