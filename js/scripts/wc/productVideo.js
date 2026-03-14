/* global omniverse_settings */
(function($) {
	omniverseThemeModule.productVideo = function() {
		if ('undefined' === typeof $.fn.magnificPopup) {
			return;
		}

		$('.product-video-button a').magnificPopup({
			tClose         : omniverse_settings.close,
			tLoading       : omniverse_settings.loading,
			type           : 'iframe',
			removalDelay   : 500,
			iframe         : {
				markup  : '<div class="mfp-iframe-scaler mfp-with-anim">' +
					'<div class="mfp-close"></div>' +
					'<iframe class="mfp-iframe" src="//about:blank" allowfullscreen></iframe>' +
					'</div>',
				patterns: {
					youtube: {
						index: 'youtube.com/',
						id   : 'v=',
						src  : '//www.youtube.com/embed/%id%?rel=0&autoplay=1'
					}
				}
			},
			preloader      : false,
			fixedContentPos: false,
			callbacks      : {
				beforeOpen: function() {
					this.st.mainClass = 'mfp-move-horizontal';
				}
			}
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.productVideo();
	});
})(jQuery);
