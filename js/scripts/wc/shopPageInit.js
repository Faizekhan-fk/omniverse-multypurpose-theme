/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdShopPageInit', function () {
		omniverseThemeModule.shopPageInit();
	});

	omniverseThemeModule.shopPageInit = function() {
		omniverseThemeModule.clickOnScrollButton(omniverseThemeModule.shopLoadMoreBtn, false, omniverse_settings.infinit_scroll_offset);

		$('body > .tooltip').remove();

		omniverseThemeModule.$body.on('updated_wc_div', function() {
			omniverseThemeModule.$document.trigger('omni-images-loaded');
		});

		omniverseThemeModule.$document.trigger('resize.vcRowBehaviour');
	};
})(jQuery);
