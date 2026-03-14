/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdPortfolioLoadMoreLoaded wdPortfolioPjaxComplete', function () {
		omniverseThemeModule.portfolioEffects();
	});

	$.each([
		'frontend/element_ready/wd_portfolio.default',
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.portfolioEffects();
		});
	});

	omniverseThemeModule.portfolioEffects = function() {
		if (typeof ($.fn.panr) === 'undefined') {
			return;
		}

		$('.wd-projects .portfolio-parallax').panr({
			sensitivity         : 15,
			scale               : false,
			scaleOnHover        : true,
			scaleTo             : 1.12,
			scaleDuration       : 0.45,
			panY                : true,
			panX                : true,
			panDuration         : 0.5,
			resetPanOnMouseLeave: true
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.portfolioEffects();
	});
})(jQuery);
