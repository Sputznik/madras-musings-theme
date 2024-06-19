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

/**
 * HANDLES CATEGORY PDF EVENTS
 */
jQuery.fn.mmus_taxonomy_pdf = function() {
	return this.each(function() {

		var $el = jQuery(this),
			$pdf_container = jQuery('#category-pdf-container'),
			$delete_btn = $el.next(),
			$text = jQuery(document.createElement('p'));

		$el.click(function(e){
			e.preventDefault();

			mmus_tax_media = wp.media({
				title: 'Category PDF',
				button: {
					text: 'Select this PDF'
				},
			 	multiple: false,
				library: {
					post_mime_type: ['application/pdf'],
    		},
			}).on('select', function() {
				var attachment = mmus_tax_media.state().get('selection').first().toJSON();
				jQuery('#mmus_category_pdf').val(attachment.url);
				$text.html(attachment.url);
				$pdf_container.html($text);
				$delete_btn.show();
			})
			.open();

		});

		$delete_btn.click(function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();

			jQuery('#mmus_category_pdf').val('');
			jQuery('#category-pdf-container').hide();
			$delete_btn.hide();
		});
	});
};

jQuery( document ).ready( function(){
	jQuery('[data-behaviour~=mmus-taxonomy-pdf]').mmus_taxonomy_pdf();
	jQuery('[data-behaviour~=mmus-taxonomy-image]').mmus_taxonomy_image();
});
