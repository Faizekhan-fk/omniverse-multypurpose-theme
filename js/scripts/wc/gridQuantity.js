/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdShopPageInit wdProductsTabsLoaded wdSearchFullScreenContentLoaded wdArrowsLoadProducts wdLoadMoreLoadProducts wdUpdateWishlist wdRecentlyViewedProductLoaded', function () {
		omniverseThemeModule.gridQuantity();
	});

	$.each([
		'frontend/element_ready/wd_products.default',
		'frontend/element_ready/wd_products_tabs.default'
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.gridQuantity();
		});
	});

	omniverseThemeModule.gridQuantity = function() {
		$('.wd-product').on('change input', '.quantity .qty', function() {
			var $this = $(this);
			var add_to_cart_button = $this.parent().parent().find('.add_to_cart_button');

			add_to_cart_button.attr('data-quantity', $this.val());
			add_to_cart_button.attr('href', '?add-to-cart=' + add_to_cart_button.attr('data-product_id') + '&quantity=' + $this.val());
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.gridQuantity();
	});
})(jQuery);
