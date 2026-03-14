/* global omniverse_settings */
(function($) {
	$.each([
		'frontend/element_ready/wd_popup.default',
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.contentPopup();
		});
	});

	omniverseThemeModule.$document.on('wdShopPageInit', function() {
		omniverseThemeModule.contentPopup();
	});

	omniverseThemeModule.contentPopup = function() {
		if ('undefined' === typeof $.fn.magnificPopup) {
			return;
		}

		$('.wd-open-popup').magnificPopup({
			type        : 'inline',
			removalDelay: 500, //delay removal by X to allow out-animation
			tClose      : omniverse_settings.close,
			tLoading    : omniverse_settings.loading,
			callbacks   : {
				beforeOpen: function() {
					this.st.mainClass = 'mfp-move-horizontal content-popup-wrapper';
				},
				open      : function() {
					omniverseThemeModule.$document.trigger('omni-images-loaded');
					omniverseThemeModule.$document.trigger('wdOpenPopup');
				}
			}
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.contentPopup();
	});
})(jQuery);
