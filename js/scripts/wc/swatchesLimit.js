/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdShopPageInit wdArrowsLoadProducts wdLoadMoreLoadProducts wdProductsTabsLoaded wdSearchFullScreenContentLoaded wdRecentlyViewedProductLoaded wdQuickViewOpen', function () {
		omniverseThemeModule.swatchesLimit();
	});

	omniverseThemeModule.swatchesLimit = function() {
		$('.wd-swatch-divider, .wd-product .wd-swatches-product:not(.wd-all-shown) .wd-swatch').on('click', function() {
			var $this = $(this).parent();

			if ( $this.parents('.wd-swatches-single').length || $this.hasClass('wd-swatches-single') ) {
				var $form = $this.parents('.variations_form');

				$form.find('.wd-swatches-single').removeClass('wd-swatches-limited').addClass('wd-all-shown');
				$form.find('.wd-swatch').removeClass('wd-hidden');
			} else {
				$this.addClass('wd-all-shown');
				$this.find('.wd-swatch').removeClass('wd-hidden');
			}

			if ( $this.parents('.wd-products.grid-masonry').length && 'undefined' !== typeof ($.fn.isotope) ) {
				$this.parents('.wd-products.grid-masonry').isotope('layout');
			}

			omniverseThemeModule.$document.trigger('omni-images-loaded');
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.swatchesLimit();
	});
})(jQuery);
