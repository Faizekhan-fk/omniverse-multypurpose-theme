/* global omniverse_settings */
(function($) {
	omniverseThemeModule.cookiesPopup = function() {
		var cookies_version = omniverse_settings.cookies_version;

		if ( typeof Cookies === 'undefined' ) {
			return;
		}

		if (Cookies.get('omniverse_cookies_' + cookies_version) === 'accepted') {
			return;
		}

		var popup = $('.wd-cookies-popup');

		setTimeout(function() {
			popup.addClass('popup-display');
			popup.on('click', '.cookies-accept-btn', function(e) {
				e.preventDefault();
				acceptCookies();
			});
		}, 2500);

		var acceptCookies = function() {
			popup.removeClass('popup-display').addClass('popup-hide');
			Cookies.set('omniverse_cookies_' + cookies_version, 'accepted', {
				expires: 60,
				path   : '/',
				secure : omniverse_settings.cookie_secure_param
			});
		};
	};

	$(document).ready(function() {
		omniverseThemeModule.cookiesPopup();
	});
})(jQuery);
