/* global omniverse_settings */
(function($) {
	omniverseThemeModule.headerBanner = function() {
		var banner_version = omniverse_settings.header_banner_version;

		if ( typeof Cookies === 'undefined' ) {
			return;
		}

		if ('closed' === Cookies.get('omniverse_tb_banner_' + banner_version) || 'no' === omniverse_settings.header_banner_close_btn || 'no' === omniverse_settings.header_banner_enabled) {
			return;
		}

		if (!omniverseThemeModule.$body.hasClass('page-template-maintenance')) {
			omniverseThemeModule.$body.addClass('header-banner-display');
		}

		$('.header-banner').on('click', '.close-header-banner', function(e) {
			e.preventDefault();
			closeBanner();
		});

		var closeBanner = function() {
			omniverseThemeModule.$body.removeClass('header-banner-display').addClass('header-banner-hide');

			Cookies.set('omniverse_tb_banner_' + banner_version, 'closed', {
				expires: parseInt(omniverse_settings.banner_version_cookie_expires),
				path   : '/',
				secure : omniverse_settings.cookie_secure_param
			});
		};
	};

	$(document).ready(function() {
		omniverseThemeModule.headerBanner();
	});
})(jQuery);
