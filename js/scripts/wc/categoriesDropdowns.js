/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdShopPageInit', function() {
		omniverseThemeModule.categoriesDropdowns();
	});

	omniverseThemeModule.categoriesDropdowns = function() {
		$('.dropdown_product_cat').on('change', function() {
			var $this = $(this);

			if ('' !== $this.val()) {
				var this_page;
				var home_url = omniverse_settings.home_url;

				if (home_url.indexOf('?') > 0) {
					this_page = home_url + '&product_cat=' + $this.val();
				} else {
					this_page = home_url + '?product_cat=' + $this.val();
				}

				location.href = this_page;
			} else {
				location.href = omniverse_settings.shop_url;
			}
		});

		$('.widget_product_categories').each(function() {
			var $select = $(this).find('select');

			if ($().selectWoo) {
				$select.selectWoo({
					minimumResultsForSearch: 5,
					width                  : '100%',
					allowClear             : true,
					placeholder            : omniverse_settings.product_categories_placeholder,
					language               : {
						noResults: function() {
							return omniverse_settings.product_categories_no_results;
						}
					}
				});
			}
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.categoriesDropdowns();
	});
})(jQuery);
