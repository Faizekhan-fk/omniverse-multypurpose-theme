/* global omniverseConfig */
(function($) {
	'use strict';

	$(document).on('click', '.dn-popup-product-gallery .dn-save-submit, .dn-popup-product-gallery .dn-popup-close, .dn-popup-product-gallery .dn-popup-overlay', function(e) {
		e.preventDefault();

		var $popup   = $(this).parents('.dn-popup-product-gallery');
		var $btn     = $('.dn-product-gallery-video.dn-active');
		var settings = {};

		$popup.find('input').each(function () {
			var $input = $(this);
			var value  = $input.val();
			var key    = $input.data('name');

			settings[ $input.data('name') ] = $input.val();

			if ( value && ( 'custom_url' === key || 'upload_video_id' === key ) ) {
				$btn.removeClass('dn-add-video').addClass('dn-edit-video');
			}
		});

		if ( 'undefined' !== typeof settings.video_type ) {
			if ( 'youtube' === settings.video_type && settings.youtube_url || 'vimeo' === settings.video_type && settings.vimeo_url || 'mp4' === settings.video_type && settings.upload_video_id ) {
				$btn.removeClass('dn-add-video').addClass('dn-edit-video');
			} else {
				$btn.removeClass('dn-edit-video').addClass('dn-add-video');
			}

			$btn.siblings('input').val( JSON.stringify( settings ) );
		} else {
			$btn.removeClass('dn-edit-video').addClass('dn-add-video');
		}

		$btn.removeClass('dn-active');
		$popup.removeClass('dn-opened');
		$('html').removeClass('dn-popup-opened');
	});

	$(document).on('click', '.dn-product-gallery-video', function(e) {
		e.preventDefault();

		var $btn     = $(this);
		var settings = $btn.siblings('input').val();
		var $popup   = $('.dn-popup-holder.dn-popup-product-gallery');

		if ( ! settings ) {
			settings = $popup.data('default-settings');
		} else {
			settings = JSON.parse( settings );
		}

		$btn.addClass('dn-active');
		$popup.addClass( 'dn-loading' );

		if ( settings ) {
			$.each( settings, function ( key, setting ) {
				var $input = $popup.find('input[data-name=' + key + ']');

				if ( $input.siblings('.dn-btns-set').length ) {
					$popup.find('.dn-gallery_' + key + '-field .dn-set-item[data-value=' + setting + ']').trigger('click');
				} else if ( $input.siblings('.dn-switcher-btn').length ) {
					if ( $input.val() !== setting ) {
						$popup.find('.dn-gallery_' + key + '-field .dn-switcher-btn').trigger('click');
					}
				} else {
					$input.val( setting ).trigger('change');
				}

				if ( 'upload_video_id' === key ) {
					var $removeBtn = $popup.find('.dn-gallery_upload_video-field .dn-remove-upload-btn');

					if ( setting ) {
						$removeBtn.addClass('dn-active');
					} else {
						$removeBtn.removeClass('dn-active');
					}
				}
			});
		}

		$(document).trigger('zs_section_changed');

		$popup.addClass( 'dn-opened' );
		$('html').addClass('dn-popup-opened');

		setTimeout( function () {
			$popup.removeClass( 'dn-loading' );
		}, 250 );
	});

	var inputImage = document.querySelector('input#product_image_gallery');

	if ( inputImage ) {
		var observer = new MutationObserver((changes) => {
			changes.forEach( change => {
				if (change.attributeName.includes('value')){
					addVideoGalleryButton();
				}
			});
		});
		observer.observe(inputImage, {attributes : true});
	}

	function addVideoGalleryButton() {
		$('#product_images_container ul.product_images > li').each(function () {
			var $image = $(this);

			if ( $image.find('.dn-product-gallery-video').length ) {
				return;
			}

			$image.append(`
				<div class="dn-product-video-wrapp">
					<a href="#" class="dn-btn dn-color-primary dn-product-gallery-video dn-i-add dn-add-video">
						${omniverseConfig.product_gallery_video_text}
					</a>
					<input type="hidden" name="dn-product-gallery-video[${$image.data('attachment_id')}]">
				</div>
			`);
		});
	}
})(jQuery);