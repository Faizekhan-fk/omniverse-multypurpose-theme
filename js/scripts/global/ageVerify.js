/* global omniverse_settings */
(function($) {
	omniverseThemeModule.ageVerify = function() {
		if ( typeof Cookies === 'undefined' ) {
			return;
		}

		if (omniverse_settings.age_verify !== 'yes' || Cookies.get('omniverse_age_verify') === 'confirmed') {
			return;
		}

		$.magnificPopup.open({
			items          : {
				src: '.wd-age-verify'
			},
			type           : 'inline',
			closeOnBgClick : false,
			closeBtnInside : false,
			showCloseBtn   : false,
			enableEscapeKey: false,
			removalDelay   : 500,
			tClose         : omniverse_settings.close,
			tLoading       : omniverse_settings.loading,
			callbacks      : {
				beforeOpen: function() {
					this.st.mainClass = 'mfp-move-horizontal wd-age-verify-wrapper';
				}
			}
		});

		$('.wd-age-verify-allowed').on('click', function(e) {
			e.preventDefault();
			Cookies.set('omniverse_age_verify', 'confirmed', {
				expires: parseInt(omniverse_settings.age_verify_expires),
			 	path   : '/',
				secure : omniverse_settings.cookie_secure_param
			});

			$.magnificPopup.close();
		});

		$('.wd-age-verify-forbidden').on('click', function(e) {
			e.preventDefault();
			$('.wd-age-verify').addClass('wd-forbidden');
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.ageVerify();
	});
})(jQuery);
