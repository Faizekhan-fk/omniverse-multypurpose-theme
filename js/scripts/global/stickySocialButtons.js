/* global omniverse_settings */
(function($) {
	omniverseThemeModule.stickySocialButtons = function() {
		$('.wd-sticky-social').addClass('buttons-loaded');
	};

	$(document).ready(function() {
		omniverseThemeModule.stickySocialButtons();
	});
})(jQuery);
