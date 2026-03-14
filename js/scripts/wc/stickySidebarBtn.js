/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdShopPageInit', function () {
		omniverseThemeModule.stickySidebarBtn();
	});

	omniverseThemeModule.stickySidebarBtn = function() {
		var $trigger = $('.wd-show-sidebar-btn,.wd-off-canvas-btn');
		var $stickyBtn = $('.wd-sidebar-opener.wd-on-shop:not(.toolbar)');

		if ($stickyBtn.length <= 0 || $trigger.length <= 0 || omniverseThemeModule.$window.width() >= 1024) {
			return;
		}

		var stickySidebarBtnToggle = function() {
			var btnOffset = $trigger.offset().top + $trigger.outerHeight();
			var windowScroll = omniverseThemeModule.$window.scrollTop();

			if (btnOffset < windowScroll) {
				$stickyBtn.addClass('wd-shown');
			} else {
				$stickyBtn.removeClass('wd-shown');
			}
		};

		stickySidebarBtnToggle();

		omniverseThemeModule.$window.on('scroll', stickySidebarBtnToggle);
		omniverseThemeModule.$window.on('resize', stickySidebarBtnToggle);
	};

	$(document).ready(function() {
		omniverseThemeModule.stickySidebarBtn();
	});
})(jQuery);
