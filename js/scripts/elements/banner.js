/* global omniverse_settings */
(function($) {
	$.each([
		'frontend/element_ready/wd_banner_carousel.default',
		'frontend/element_ready/wd_banner.default',
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.bannersHover();
		});
	});

	omniverseThemeModule.bannersHover = function() {
		if (typeof ($.fn.panr) === 'undefined') {
			return;
		}

		$('.promo-banner.banner-hover-parallax').panr({
			sensitivity         : 20,
			scale               : false,
			scaleOnHover        : true,
			scaleTo             : 1.15,
			scaleDuration       : .34,
			panY                : true,
			panX                : true,
			panDuration         : 0.5,
			resetPanOnMouseLeave: true
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.bannersHover();
	});
})(jQuery);
