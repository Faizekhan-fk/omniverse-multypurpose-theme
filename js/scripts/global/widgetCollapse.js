/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdShopPageInit', function() {
		omniverseThemeModule.widgetCollapse();
	});

	omniverseThemeModule.$window.on('resize', omniverseThemeModule.debounce(function() {
		omniverseThemeModule.widgetCollapse();
	}, 300));

	omniverseThemeModule.widgetCollapse = function() {
		var $footer = $('.main-footer .footer-widget');

		if ('yes' === omniverse_settings.collapse_footer_widgets && 0 < $footer.length) {
			if (omniverseThemeModule.$window.innerWidth() <= 575) {
				$footer.addClass('wd-widget-collapse');
			} else {
				$footer.removeClass('wd-widget-collapse');
				$footer.find('> *:not(.widget-title)').show();
			}
		}

		$('.wd-widget-collapse .widget-title').off('click').on('click', function() {
			var $title = $(this);
			var $widget = $title.parent();
			var $content = $widget.find('> *:not(.widget-title)');

			if ($widget.hasClass('wd-opened')) {
				$widget.removeClass('wd-opened');
				$content.stop().slideUp(200);
			} else {
				$widget.addClass('wd-opened');
				$content.stop().slideDown(200);
				omniverseThemeModule.$document.trigger('wood-images-loaded');
			}
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.widgetCollapse();
	});

	window.addEventListener('popstate', function() {
		omniverseThemeModule.widgetCollapse();
	});
})(jQuery);
