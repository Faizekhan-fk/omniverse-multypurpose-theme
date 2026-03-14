/* global omniverse_settings */
(function($) {
	omniverseThemeModule.scrollTop = function() {
		var $scrollTop = $('.scrollToTop');

		omniverseThemeModule.$window.on('scroll', function() {
			if ($(this).scrollTop() > 100) {
				$scrollTop.addClass('button-show');
			} else {
				$scrollTop.removeClass('button-show');
			}
		});

		$scrollTop.on('click', function() {
			$('html, body').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.scrollTop();
	});
})(jQuery);
