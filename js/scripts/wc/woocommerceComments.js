/* global omniverse_settings */
(function($) {
	omniverseThemeModule.woocommerceComments = function() {
		var hash = window.location.hash;
		var url = window.location.href;

		if (hash.toLowerCase().indexOf('comment-') >= 0 || hash === '#reviews' || hash === '#tab-reviews' || url.indexOf('comment-page-') > 0 || url.indexOf('cpage=') > 0 || hash === '#tab-wd_additional_tab' || hash === '#tab-wd_custom_tab') {
			setTimeout(function() {
				window.scrollTo(0, 0);
			}, 1);

			// When reviews separate section need open first tab.
			if ( $('.single-product-page').hasClass('reviews-location-separate') && ( hash === '#reviews' || hash === '#tab-reviews' || hash.toLowerCase().indexOf('comment-') >= 0 || url.indexOf('comment-page-') > 0 || url.indexOf('cpage=') > 0 ) ) {
				omniverseThemeModule.$body.find('.wc-tabs, ul.tabs').first().find('li:first a').click();
			}

			setTimeout(function() {
				if ($(hash).length > 0) {
					var $link = $('.woocommerce-tabs a[href=' + hash + ']');

					if ( $link.length ) {
						$link.trigger('click');
					}
					setTimeout(function() {
						$('html, body').stop().animate({
							scrollTop: $(hash).offset().top - omniverse_settings.ajax_scroll_offset
						}, 400);
					}, 400);
				}
			}, 10);
		}

		$('.wd-builder-on .woocommerce-review-link').on('click', function () {
			var $tabReviews = $('.wd-single-tabs .wd-accordion .wd-accordion-title.tab-title-reviews');

			if ( !$tabReviews.length ) {
				return;
			}

			$tabReviews.trigger('click');

			setTimeout(function() {
				$('html, body').stop().animate({
					scrollTop: $tabReviews.offset().top - omniverse_settings.ajax_scroll_offset
				}, 400);
			}, 400);
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.woocommerceComments();
	});
})(jQuery);
