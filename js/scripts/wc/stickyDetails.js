/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdHeaderBuilderInited', function () {
		omniverseThemeModule.stickyDetails();
	});

	omniverseThemeModule.stickyDetails = function() {
		if (!omniverseThemeModule.$body.hasClass('omniverse-product-sticky-on') || omniverseThemeModule.$window.width() <= 1024) {
			return;
		}

		var details = $('.entry-summary');

		details.each(function() {
			var $column = $(this),
			    offset  = parseInt(omniverse_settings.sticky_product_details_offset),
			    $inner  = $column.find('.summary-inner'),
			    $images = $column.parent().find('.woocommerce-product-gallery');

			$inner.trigger('sticky_kit:detach');
			$images.trigger('sticky_kit:detach');

			$images.imagesLoaded(function() {
				var diff = $inner.outerHeight() - $images.outerHeight();

				if (diff < -100) {
					$inner.stick_in_parent({
						offset_top: offset
					});
				} else if (diff > 100) {
					$images.stick_in_parent({
						offset_top: offset
					});
				}

				omniverseThemeModule.$window.on('resize', omniverseThemeModule.debounce(function() {
					if (omniverseThemeModule.$window.width() <= 1024) {
						$inner.trigger('sticky_kit:detach');
						$images.trigger('sticky_kit:detach');
					} else if ($inner.outerHeight() < $images.outerHeight()) {
						$inner.stick_in_parent({
							offset_top: offset
						});
					} else {
						$images.stick_in_parent({
							offset_top: offset
						});
					}
				}, 300));
			});
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.stickyDetails();
	});
})(jQuery);
