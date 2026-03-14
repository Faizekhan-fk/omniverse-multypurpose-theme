/* global omniverse_settings */
(function($) {
	$.each([
		'frontend/element_ready/wd_products.default',
		'frontend/element_ready/wd_products_tabs.default'
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.quickShop();
		});
	});

	omniverseThemeModule.quickShop = function() {
		if ('no' === omniverse_settings.quick_shop) {
			return;
		}

		var btnSelector = '.wd-product.product-type-variable .add_to_cart_button';

		omniverseThemeModule.$document.on('click', btnSelector, function(e) {
				e.preventDefault();

				var $this        = $(this),
				    $product     = $this.parents('.product').first(),
				    $content     = $product.find('.wd-quick-shop'),
				    id           = $product.data('id'),
				    loadingClass = 'btn-loading';

				if ($this.hasClass(loadingClass)) {
					return;
				}

				// Simply show quick shop form if it is already loaded with AJAX previously
				if ($product.hasClass('quick-shop-loaded')) {
					$product.addClass('quick-shop-shown');
					omniverseThemeModule.$body.trigger('omniverse-quick-view-displayed');
					return;
				}

				$this.addClass(loadingClass);
				$product.addClass('wd-loading-quick-shop');

				$.ajax({
					url     : omniverse_settings.ajaxurl,
					data    : {
						action: 'omniverse_quick_shop',
						id    : id
					},
					method  : 'get',
					success : function(data) {
						omniverseThemeModule.removeDuplicatedStylesFromHTML(data, function(html) {
							$content.append(html);

							initVariationForm($product);
							omniverseThemeModule.$document.trigger('wdQuickShopSuccess');

							$this.removeClass(loadingClass);
							$product.removeClass('wd-loading-quick-shop');
							$product.addClass('quick-shop-shown quick-shop-loaded');
							omniverseThemeModule.$body.trigger('omniverse-quick-view-displayed');
						});
					},
				});
			})
			.on('click', '.quick-shop-close', function(e) {
				e.preventDefault();

				var $this    = $(this),
				    $product = $this.parents('.product');

				$product.removeClass('quick-shop-shown');
			});

		omniverseThemeModule.$body.on('added_to_cart', function() {
			$('.product').removeClass('quick-shop-shown');
		});

		function initVariationForm($product) {
			$product.find('.variations_form').wc_variation_form().find('.variations select:eq(0)').trigger('change');
			$product.find('.variations_form').trigger('wc_variation_form');
		}
	};

	$(document).ready(function() {
		omniverseThemeModule.quickShop();
	});
})(jQuery);
