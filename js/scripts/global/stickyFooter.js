/* global omniverse_settings */
(function($) {
	omniverseThemeModule.stickyFooter = function() {
		if (!omniverseThemeModule.$body.hasClass('sticky-footer-on') || omniverseThemeModule.$window.width() <= 1024) {
			return;
		}

		var $footer    = $('.footer-container'),
		    $page      = $('.main-page-wrapper'),
		    $prefooter = $('.wd-prefooter'),
		    $window    = omniverseThemeModule.$window;

		if ($prefooter.length > 0) {
			$page = $prefooter;
		}

		var footerOffset = function() {
			$page.css({
				marginBottom: $footer.outerHeight()
			});
		};

		$window.on('resize', footerOffset);

		$footer.imagesLoaded(function() {
			footerOffset();
		});

		//Safari fix
		var footerSafariFix = function() {
			if (!$('html').hasClass('browser-Safari')) {
				return;
			}

			var windowScroll = $window.scrollTop();
			var footerOffsetTop = omniverseThemeModule.$document.outerHeight() - $footer.outerHeight();

			if (footerOffsetTop < windowScroll + $footer.outerHeight() + $window.outerHeight()) {
				$footer.addClass('visible-footer');
			} else {
				$footer.removeClass('visible-footer');
			}
		};

		footerSafariFix();
		$window.on('scroll', footerSafariFix);
	};

	$(document).ready(function() {
		omniverseThemeModule.stickyFooter();
	});
})(jQuery);
