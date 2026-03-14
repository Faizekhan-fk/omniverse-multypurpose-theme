/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdReplaceMainGalleryNotQuickView wdShowVariationNotQuickView wdResetVariation', function () {
		omniverseThemeModule.initZoom();
	});

	$.each([
		'frontend/element_ready/wd_single_product_gallery.default'
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.initZoom();
		});
	});

	omniverseThemeModule.initZoom = function() {
		var $mainGallery = $('.woocommerce-product-gallery__wrapper:not(.quick-view-gallery)');

		if (omniverse_settings.zoom_enable !== 'yes') {
			return false;
		}

		var zoomOptions = {
			touch: false
		};

		if ('ontouchstart' in window) {
			zoomOptions.on = 'click';
		}

		var $productGallery = $('.woocommerce-product-gallery');
		if ($productGallery.hasClass('thumbs-position-bottom') || $productGallery.hasClass('thumbs-position-left')) {
			document.querySelector('.woocommerce-product-gallery__wrapper:not(.quick-view-gallery)').addEventListener('wdSlideChange', function (e) {
				var $wrapper = $mainGallery.find('.wd-carousel-item').eq(e.target.swiper.activeIndex).find('.woocommerce-product-gallery__image');

				init($wrapper);
			});

			init($mainGallery.find('.wd-carousel-item').eq(0).find('.woocommerce-product-gallery__image'));
		} else {
			$mainGallery.find('.wd-carousel-item').each(function() {
				var $wrapper = $(this).find('.woocommerce-product-gallery__image');

				init($wrapper);
			});
		}

		function init($wrapper) {
			var image = $wrapper.find('img');
			if (image.data('large_image_width') > $wrapper.width() ) {
				$wrapper.trigger('zoom.destroy');
				$wrapper.zoom(zoomOptions);
			}
		}
	};

	$(document).ready(function() {
		omniverseThemeModule.initZoom();
	});
})(jQuery);
