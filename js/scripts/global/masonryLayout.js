/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdPortfolioPjaxComplete', function () {
		omniverseThemeModule.masonryLayout();
	});

	$.each([
		'frontend/element_ready/wd_blog.default',
		'frontend/element_ready/wd_portfolio.default',
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.masonryLayout();
		});
	});

	omniverseThemeModule.masonryLayout = function() {
		if (typeof ($.fn.isotope) === 'undefined' || typeof ($.fn.imagesLoaded) === 'undefined') {
			return;
		}

		var $container = $('.wd-masonry');

		$container.imagesLoaded(function() {
			$container.isotope({
				gutter      : 0,
				isOriginLeft: !omniverseThemeModule.$body.hasClass('rtl'),
				itemSelector: '.blog-design-masonry, .blog-design-mask, .masonry-item'
			});
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.masonryLayout();
	});
})(jQuery);
