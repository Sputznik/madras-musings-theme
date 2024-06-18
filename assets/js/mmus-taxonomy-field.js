/**
 * HANDLES CATEGORY FEATURED IMAGE EVENTS
 */
jQuery.fn.mmus_taxonomy_image = function() {
	return this.each(function() {

		var $el = jQuery(this),
			$image_container = jQuery('#category-image-container'),
			$delete_btn = $el.next(),
			$image = jQuery(document.createElement('img'));

		$image.attr('style', 'max-width:100%');

		$el.click(function(e){
			e.preventDefault();

			mmus_tax_media = wp.media({
				title: 'Category Featured Image',
				button: {
					text: 'Select this image'
				},
				multiple: false
			}).on('select', function() {
				var attachment = mmus_tax_media.state().get('selection').first().toJSON();

				jQuery('#mmus_category_image').val(attachment.url);

				$image.attr('src', attachment.url);
				$image_container.show().html($image);
				$delete_btn.show();
			})
			.open();

		});

		$delete_btn.click(function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();

			jQuery('#mmus_category_image').val('');
			jQuery('#category-image-container').hide();
			$delete_btn.hide();
		});
	});
};

jQuery( document ).ready( function(){
	jQuery('[data-behaviour~=mmus-taxonomy-image]').mmus_taxonomy_image();
});
