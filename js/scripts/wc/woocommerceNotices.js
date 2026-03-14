/* global omniverse_settings */
(function($) {
	omniverseThemeModule.woocommerceNotices = function() {
		var notices = '.woocommerce-error, .woocommerce-info, .woocommerce-message, div.wpcf7-response-output, #yith-wcwl-popup-message, .mc4wp-alert, .dokan-store-contact .alert-success, .yith_ywraq_add_item_product_message';

		omniverseThemeModule.$body.on('click', notices, function() {
			hideMessage($(this));
		});

		var hideMessage = function($msg) {
			$msg.removeClass('shown-notice').addClass('hidden-notice');
		};
	};

	$(document).ready(function() {
		omniverseThemeModule.woocommerceNotices();
	});
})(jQuery);
