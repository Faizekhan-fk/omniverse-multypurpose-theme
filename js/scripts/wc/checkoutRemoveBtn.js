/* global omniverse_settings */
(function($) {
	omniverseThemeModule.checkoutRemove = function() {
		omniverseThemeModule.$document.on('click', '.wd-checkout-remove-btn', function() {
			$(this)
				.closest('.woocommerce-checkout-review-order-table')
				.append('<div class="wd-loader-overlay wd-fill wd-loading"></div>');
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.checkoutRemove();
	});
})(jQuery);
