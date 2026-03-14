/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdShopPageInit wdLoadMoreLoadProducts wdArrowsLoadProducts wdProductsTabsLoaded wdSearchFullScreenContentLoaded wdUpdateWishlist wdRecentlyViewedProductLoaded', function () {
		omniverseThemeModule.productMoreDescription();
	});

	$.each([
		'frontend/element_ready/wd_products.default',
		'frontend/element_ready/wd_products_tabs.default'
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.productMoreDescription();
		});
	});

	omniverseThemeModule.productMoreDescription = function() {
		$('.wd-hover-with-fade, .wd-image-hotspot.hotspot-type-product').on('mouseenter touchstart', function() {
			var $content = $(this).find('.wd-more-desc');
			var $inner = $content.find('.wd-more-desc-inner');
			var $moreBtn = $content.find('.wd-more-desc-btn');

			if ($content.hasClass('wd-more-desc-calculated')) {
				return;
			}

			var contentHeight = $content.outerHeight();
			var innerHeight = $inner.outerHeight();
			var delta = innerHeight - contentHeight;

			if (delta > 30) {
				$moreBtn.addClass('wd-shown');
			} else if (delta > 0) {
				$content.css('height', contentHeight + delta);
			}

			$content.addClass('wd-more-desc-calculated');
		});

		omniverseThemeModule.$body.on('click', '.wd-more-desc-btn', function(e) {
			e.preventDefault();
			var $this = $(this);

			$this.parent().addClass('wd-more-desc-full');

			omniverseThemeModule.$document.trigger('wdProductMoreDescriptionOpen', [$this.parents('.wd-hover-with-fade')]);
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.productMoreDescription();
	});
})(jQuery);
