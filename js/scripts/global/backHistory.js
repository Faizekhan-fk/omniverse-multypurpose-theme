/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdShopPageInit wdBackHistory', function () {
		omniverseThemeModule.backHistory();
	});

	omniverseThemeModule.backHistory = function() {
		$('.wd-back-btn > a').on('click', function(e) {
			e.preventDefault();

			history.go(-1);

			setTimeout(function() {
				$('.filters-area').removeClass('filters-opened').stop().hide();
				if (omniverseThemeModule.$window.width() <= 1024) {
					$('.wd-nav-product-cat').removeClass('categories-opened').stop().hide();
				}

				omniverseThemeModule.$document.trigger('wdBackHistory');
			}, 20);
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.backHistory();
	});
})(jQuery);
