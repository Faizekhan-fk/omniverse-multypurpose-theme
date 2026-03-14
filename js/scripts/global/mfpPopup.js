/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdPortfolioLoadMoreLoaded', function () {
		omniverseThemeModule.mfpPopup();
	});

	omniverseThemeModule.mfpPopup = function() {
		if ('undefined' === typeof $.fn.magnificPopup) {
			return;
		}

		$('.gallery').magnificPopup({
			delegate    : 'a:not([data-elementor-open-lightbox]), a[data-elementor-open-lightbox=no]',
			type        : 'image',
			removalDelay: 500,
			tClose      : omniverse_settings.close,
			tLoading    : omniverse_settings.loading,
			callbacks   : {
				beforeOpen: function() {
					this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
					this.st.mainClass = 'mfp-move-horizontal';
				}
			},
			image       : {
				verticalFit: true
			},
			gallery     : {
				enabled           : true,
				navigateByImgClick: true
			}
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.mfpPopup();
	});
})(jQuery);
