/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdProductsTabsLoaded wdSearchFullScreenContentLoaded wdShopPageInit wdRecentlyViewedProductLoaded', function () {
		omniverseThemeModule.shopMasonry();
	});

	$.each([
		'frontend/element_ready/wd_products.default',
		'frontend/element_ready/wd_products_tabs.default',
		'frontend/element_ready/wd_products_brands.default'
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.shopMasonry();
		});
	});

	omniverseThemeModule.shopMasonry = function() {
		if (typeof ($.fn.isotope) == 'undefined' || typeof ($.fn.packery) == 'undefined' || typeof ($.fn.imagesLoaded) == 'undefined') {
			return;
		}

		var $container = $('.wd-products.grid-masonry');
		$container.imagesLoaded(function() {
			$container.isotope({
				isOriginLeft: !omniverseThemeModule.$body.hasClass('rtl'),
				itemSelector: '.product-category.product, .wd-product, .wd-products > .element-title',
				masonry: {
					columnWidth: '.product-category.product, .wd-product'
				}
			});
		});

		omniverseThemeModule.$window.on('resize', function() {
			initMasonry();
		});

		initMasonry();

		function initMasonry() {
			var $catsContainer = $('.wd-cats-element .wd-masonry');
			$catsContainer.imagesLoaded(function() {
				$catsContainer.packery({
					resizable   : false,
					isOriginLeft: !omniverseThemeModule.$body.hasClass('rtl'),
					packery     : {
						gutter     : 0,
						columnWidth: '.product-category.product'
					},
					itemSelector: '.product-category.product'
				});
			});
		}
	};

	$(document).ready(function() {
		omniverseThemeModule.shopMasonry();
	});
})(jQuery);
