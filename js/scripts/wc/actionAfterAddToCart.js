/* global omniverse_settings */
(function($) {
	$.each([
		'frontend/element_ready/wd_products.default',
		'frontend/element_ready/wd_products_tabs.default'
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.addToCart();
		});
	});

	omniverseThemeModule.addToCart = function() {
		var that = this;
		var timeoutNumber = 0;
		var timeout;

		omniverseThemeModule.$body.on('added_to_cart', function(e, data) {
			if (data.stop_reload || data.e_manually_triggered) {
				return false;
			}

			if (omniverse_settings.add_to_cart_action === 'popup') {
				var html = [
					'<div class="added-to-cart">',
					'<h3>' + omniverse_settings.added_to_cart + '</h3>',
					'<a href="#" class="btn btn-style-link btn-color-default close-popup">' + omniverse_settings.continue_shopping + '</a>',
					'<a href="' + omniverse_settings.cart_url + '" class="btn btn-color-primary view-cart">' + omniverse_settings.view_cart + '</a>',
					'</div>'
				].join('');

				$.magnificPopup.open({
					removalDelay: 500, //delay removal by X to allow out-animation
					tClose      : omniverse_settings.close,
					tLoading    : omniverse_settings.loading,
					callbacks   : {
						beforeOpen: function() {
							this.st.mainClass = 'mfp-move-horizontal cart-popup-wrapper';
						}
					},
					items       : {
						src : '<div class="mfp-with-anim wd-popup popup-added_to_cart wd-close-btn-inset">' + html + '</div>',
						type: 'inline'
					}
				});

				$('.popup-added_to_cart').on('click', '.close-popup', function(e) {
					e.preventDefault();
					$.magnificPopup.close();
				});

				closeAfterTimeout();
			} else if (omniverse_settings.add_to_cart_action === 'widget') {
				clearTimeout(timeoutNumber);
				var $selector = $('.act-scroll .wd-header-cart .wd-dropdown-cart, .whb-sticked .wd-header-cart .wd-dropdown-cart');

				if ($selector.length > 0) {
					$selector.addClass('wd-opened');
				} else {
					$('.whb-header .wd-header-cart .wd-dropdown-cart').addClass('wd-opened');
				}

				var $cartOpener = $('.cart-widget-opener');
				if ($cartOpener.length > 0) {
					$cartOpener.first().trigger('click');
				}

				timeoutNumber = setTimeout(function() {
					$('.wd-dropdown-cart').removeClass('wd-opened');
				}, 3500);

				closeAfterTimeout();
			}

			omniverseThemeModule.$document.trigger('wdActionAfterAddToCart');
		});

		var closeAfterTimeout = function() {
			if ('yes' !== omniverse_settings.add_to_cart_action_timeout) {
				return false;
			}

			clearTimeout(timeout);

			timeout = setTimeout(function() {
				$('.wd-close-side').trigger('click');
				$.magnificPopup.close();
			}, parseInt(omniverse_settings.add_to_cart_action_timeout_number) * 1000);
		};
	};

	$(document).ready(function() {
		omniverseThemeModule.addToCart();
	});
})(jQuery);
