/* global omniverse_settings */
(function($) {
	$.each([
		'frontend/element_ready/wd_single_product_add_to_cart.default',
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.variationsPrice();
		});
	});

	omniverseThemeModule.variationsPrice = function() {
		if ('no' === omniverse_settings.single_product_variations_price) {
			return;
		}

		$('.variations_form').each(function() {
			var $form = $(this);
			var $price = $form.parent().find('> .price, > div > .price, > .price > .price');

			if ( $('.site-content').hasClass('wd-builder-on') ) {
				$price = $form.parents('.single-product-page').find('.wd-single-price .price');
			}

			var priceOriginalHtml = $price.html();

			$form.on('show_variation', function(e, variation) {
				if (variation.price_html.length > 1) {
					$price.html(variation.price_html);
				}
			});

			$form.on('hide_variation', function() {
				$price.html(priceOriginalHtml);
			});
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.variationsPrice();
	});
})(jQuery);
