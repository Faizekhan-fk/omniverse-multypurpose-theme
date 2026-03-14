/* global omniverse_settings */
(function($) {
	omniverseThemeModule.checkoutQuantity = function() {
		var timeout;

		omniverseThemeModule.$document.on('change input', '.woocommerce-checkout-review-order-table .quantity .qty', function() {
			var input = $(this);
			var qtyVal = input.val();
			var itemName = input.attr('name');
			var itemID = itemName.substring(itemName.indexOf('[') + 1, itemName.indexOf(']') );
			var maxValue = input.attr('max');
			var cart_hash_key = omniverse_settings.cart_hash_key;
			var fragment_name = omniverse_settings.fragment_name;

			clearTimeout(timeout);

			if (parseInt(qtyVal) > parseInt(maxValue)) {
				qtyVal = maxValue;
			}

			timeout = setTimeout(function() {
				$.ajax({
					url     : omniverse_settings.ajaxurl,
					data    : {
						action : 'omniverse_update_cart_item',
						item_id: itemID,
						qty    : qtyVal
					},
					success : function( data ) {
						if (data && data.fragments) {
							$.each(data.fragments, function(key, value) {
								$(key).replaceWith(value);
							});

							if (omniverseThemeModule.supports_html5_storage) {
								sessionStorage.setItem(fragment_name, JSON.stringify(data.fragments));
								localStorage.setItem(cart_hash_key, data.cart_hash);
								sessionStorage.setItem(cart_hash_key, data.cart_hash);

								if (data.cart_hash) {
									sessionStorage.setItem('wc_cart_created', (new Date()).getTime());
								}
							}

							omniverseThemeModule.$body.trigger( 'wc_fragments_refreshed' );
						}

						$('form.checkout').trigger( 'update' );
					},
					dataType: 'json',
					method  : 'GET'
				});
			}, 500);
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.checkoutQuantity();
	});
})(jQuery);
