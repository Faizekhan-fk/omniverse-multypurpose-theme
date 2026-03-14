/* global omniverse_settings */
(function($) {
	$.each([
		'frontend/element_ready/wd_images_gallery.default'
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.imagesGalleryMasonry();
			omniverseThemeModule.imagesGalleryJustified();
		});
	});

	omniverseThemeModule.imagesGalleryMasonry = function() {
		if (typeof ($.fn.isotope) == 'undefined' || typeof ($.fn.imagesLoaded) == 'undefined') {
			return;
		}

		var $container = $('.wd-images-gallery .wd-masonry');

		$container.imagesLoaded(function() {
			$container.isotope({
				gutter      : 0,
				isOriginLeft: !omniverseThemeModule.$body.hasClass('rtl'),
				itemSelector: '.wd-gallery-item'
			});
		});
	};

	omniverseThemeModule.imagesGalleryJustified = function() {
		$('.wd-images-gallery .wd-justified').each(function() {
			$(this).justifiedGallery({
				margins     : 1,
				cssAnimation: true
			});
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.imagesGalleryMasonry();
		omniverseThemeModule.imagesGalleryJustified();
	});
})(jQuery);
