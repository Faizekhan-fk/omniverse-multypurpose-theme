/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdPjaxStart wdBackHistory', function() {
		omniverseThemeModule.hideShopSidebar();
	});
	window.addEventListener('popstate', function() {
		omniverseThemeModule.hideShopSidebar();
	});

	omniverseThemeModule.$document.on('wdShopPageInit', function() {
		omniverseThemeModule.hiddenSidebar();
	});

	omniverseThemeModule.hiddenSidebar = function() {
		var position = omniverseThemeModule.$body.hasClass('rtl') ? 'right' : 'left';

		if (omniverseThemeModule.$body.hasClass('offcanvas-sidebar-desktop') && omniverseThemeModule.windowWidth > 1024 || omniverseThemeModule.$body.hasClass('offcanvas-sidebar-tablet') && omniverseThemeModule.windowWidth <= 1024 ) {
			$('.area-sidebar-shop').addClass('wd-side-hidden wd-' + position + ' wd-inited wd-scroll');
			$('.area-sidebar-shop .widget-area').addClass('wd-scroll-content');
		}

		if (omniverseThemeModule.$body.hasClass('offcanvas-sidebar-mobile') && omniverseThemeModule.windowWidth <= 768) {
			$('.sidebar-container').addClass('wd-side-hidden wd-' + position + ' wd-inited wd-scroll');
			$('.sidebar-container .widget-area').addClass('wd-scroll-content');
		}

		omniverseThemeModule.$body.off('click', '.wd-show-sidebar-btn, .wd-sidebar-opener').on('click', '.wd-show-sidebar-btn, .wd-sidebar-opener', function(e) {
			e.preventDefault();
			var $btn = $('.wd-show-sidebar-btn, .wd-sidebar-opener');

			if ($('.sidebar-container').hasClass('wd-opened')) {
				$btn.removeClass('wd-opened');
				omniverseThemeModule.hideShopSidebar();
			} else {
				$btn.addClass('wd-opened');
				showSidebar();
			}
		});

		omniverseThemeModule.$body.on('click touchstart', '.wd-close-side, .close-side-widget', function(e) {
			e.preventDefault();

			omniverseThemeModule.hideShopSidebar();
		});

		var showSidebar = function() {
			$('.sidebar-container').addClass('wd-opened');
			$('.wd-close-side').addClass('wd-close-side-opened');
		};

		omniverseThemeModule.$document.trigger('wdHiddenSidebarsInited');
	};

	omniverseThemeModule.hideShopSidebar = function() {
		$('.sidebar-container').removeClass('wd-opened');
		$('.wd-close-side').removeClass('wd-close-side-opened');
	};

	$(document).ready(function() {
		omniverseThemeModule.hiddenSidebar();
	});
})(jQuery);
