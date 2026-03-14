/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdShopPageInit', function() {
		omniverseThemeModule.sortByWidget();
	});

	omniverseThemeModule.sortByWidget = function() {
		if (!omniverseThemeModule.$body.hasClass('omniverse-ajax-shop-on') || typeof ($.fn.pjax) == 'undefined') {
			return;
		}

		var $wcOrdering = $('.woocommerce-ordering');

		$wcOrdering.on('change', 'select.orderby', function() {
			var $form = $(this).closest('form');
			$form.find('[name="_pjax"]').remove();

			$.pjax({
				container: '.main-page-wrapper',
				timeout  : omniverse_settings.pjax_timeout,
				url      : '?' + $form.serialize(),
				scrollTo : false,
				renderCallback: function(context, html, afterRender) {
					omniverseThemeModule.removeDuplicatedStylesFromHTML(html, function(html) {
						context.html(html);
						afterRender();
						omniverseThemeModule.$document.trigger('wdShopPageInit');
						omniverseThemeModule.$document.trigger('omni-images-loaded');
					});
				}
			});
		});

		$wcOrdering.on('submit', function(e) {
			e.preventDefault(e);
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.sortByWidget();
	});

	window.addEventListener('popstate', function() {
		omniverseThemeModule.sortByWidget();
	});
})(jQuery);
