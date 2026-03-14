/* global omniverse_settings */
(function($) {
	omniverseThemeModule.onRemoveFromCart = function() {
		if ('no' === omniverse_settings.woocommerce_ajax_add_to_cart) {
			return;
		}

		omniverseThemeModule.$document.on('click', '.widget_shopping_cart .remove', function(e) {
			e.preventDefault();
			$(this).parent().addClass('removing-process');
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.onRemoveFromCart();
	});
})(jQuery);
