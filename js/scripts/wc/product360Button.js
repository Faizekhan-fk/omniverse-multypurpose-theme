/* global omniverse_settings */
(function($) {
	omniverseThemeModule.product360Button = function() {
		if ('undefined' === typeof $.fn.magnificPopup) {
			return;
		}

		$('.product-360-button a').magnificPopup({
			type           : 'inline',
			mainClass      : 'mfp-fade',
			preloader      : false,
			tClose         : omniverse_settings.close,
			tLoading       : omniverse_settings.loading,
			fixedContentPos: false,
			removalDelay   : 500,
			callbacks      : {
				beforeOpen: function() {
					this.st.mainClass = 'mfp-move-horizontal';
				},
				open      : function() {
					omniverseThemeModule.$window.trigger('resize');
				}
			}
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.product360Button();
	});
})(jQuery);
