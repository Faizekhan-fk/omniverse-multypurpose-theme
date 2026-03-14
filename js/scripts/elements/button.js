/* global omniverse_settings */
(function($) {
	omniverseThemeModule.buttonSmoothScroll = function() {
		$('.wd-button-wrapper.wd-smooth-scroll a').on('click', function(e) {
			e.stopPropagation();
			e.preventDefault();

			var $button = $(this);
			var time = $button.parent().data('smooth-time');
			var offset = $button.parent().data('smooth-offset');
			var hash = $button.attr('href').split('#')[1];

			var $anchor = $('#' + hash);

			if ($anchor.length < 1) {
				return;
			}

			var position = $anchor.offset().top;

			$('html, body').animate({
				scrollTop: position - offset
			}, time);
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.buttonSmoothScroll();
	});
})(jQuery);
