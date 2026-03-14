/* global omniverse_settings */
(function($) {
	omniverseThemeModule.filtersArea = function() {
		var filters = $('.filters-area'),
		    time    = 200;

		omniverseThemeModule.$body.on('click', '.open-filters', function(e) {
			e.preventDefault();

			if (isOpened()) {
				closeFilters();
			} else {
				omniverseThemeModule.openFilters(time);
				setTimeout(function() {
					omniverseThemeModule.$document.trigger('wdFiltersOpened');
				}, time);
			}
		});

		if (omniverse_settings.shop_filters_close === 'no') {
			omniverseThemeModule.$body.on('click', omniverse_settings.ajax_links, function() {
				if (isOpened()) {
					closeFilters();
				}
			});
		}

		var isOpened = function() {
			filters = $('.filters-area');
			return filters.hasClass('filters-opened');
		};

		var closeFilters = function() {
			filters = $('.filters-area');
			filters.removeClass('filters-opened');
			filters.stop().slideUp(time);
		};
	};

	omniverseThemeModule.openFilters = function(time) {
		var filters = $('.filters-area');
		filters.stop().slideDown(time);

		setTimeout(function() {
			filters.addClass('filters-opened');
			omniverseThemeModule.$document.trigger('wdFiltersOpened');

			omniverseThemeModule.$body.removeClass('body-filters-opened');
			omniverseThemeModule.$document.trigger('wood-images-loaded');
		}, time);
	};

	$(document).ready(function() {
		omniverseThemeModule.filtersArea();
	});
})(jQuery);
