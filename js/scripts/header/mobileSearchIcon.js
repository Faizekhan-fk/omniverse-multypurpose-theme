/* global omniverse_settings */
(function($) {
	omniverseThemeModule.mobileSearchIcon = function() {
		omniverseThemeModule.$body.on('click', '.wd-header-search-mobile:not(.wd-display-full-screen, .wd-display-full-screen-2)', function(e) {
			e.preventDefault();
			var $nav = $('.mobile-nav');

			if (!$nav.hasClass('wd-opened')) {
				$(this).addClass('wd-opened');
				$nav.addClass('wd-opened');
				$('.wd-close-side').addClass('wd-close-side-opened');
				$('.mobile-nav .searchform').find('input[type="text"]').trigger('focus');
			}
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.mobileSearchIcon();
	});
})(jQuery);
