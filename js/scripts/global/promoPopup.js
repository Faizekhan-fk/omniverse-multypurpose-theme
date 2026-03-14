/* global omniverse_settings */
(function($) {
	omniverseThemeModule.promoPopup = function() {
		var promo_version = omniverse_settings.promo_version;

		if ( typeof Cookies === 'undefined' ) {
			return;
		}

		if (omniverseThemeModule.$body.hasClass('page-template-maintenance') || omniverse_settings.enable_popup !== 'yes' || (omniverse_settings.promo_popup_hide_mobile === 'yes' && omniverseThemeModule.windowWidth < 768) || (Cookies.get('omniverse_age_verify') !== 'confirmed' && omniverse_settings.age_verify === 'yes')) {
			return;
		}

		var shown = false,
		    pages = Cookies.get('omniverse_shown_pages');

		var showPopup = function() {
			$.magnificPopup.open({
				items       : {
					src: '.wd-promo-popup'
				},
				type        : 'inline',
				removalDelay: 500, //delay removal by X to allow out-animation
				tClose      : omniverse_settings.close,
				tLoading    : omniverse_settings.loading,
				callbacks   : {
					beforeOpen: function() {
						this.st.mainClass = 'mfp-move-horizontal wd-promo-popup-wrapper';
					},
					close     : function() {
						Cookies.set('omniverse_popup_' + promo_version, 'shown', {
							expires: parseInt(omniverse_settings.promo_version_cookie_expires),
							path   : '/',
							secure : omniverse_settings.cookie_secure_param
						});
					}
				}
			});

			omniverseThemeModule.$document.trigger('omni-images-loaded');
		};

		$('.omniverse-open-newsletter').on('click', function(e) {
			e.preventDefault();
			showPopup();
		});

		if (!pages) {
			pages = 0;
		}

		if (pages < omniverse_settings.popup_pages) {
			pages++;

			Cookies.set('omniverse_shown_pages', pages, {
				expires: 7,
				path   : '/',
				secure : omniverse_settings.cookie_secure_param
			});

			return false;
		}

		if (Cookies.get('omniverse_popup_' + promo_version) !== 'shown') {
			if (omniverse_settings.popup_event === 'scroll') {
				omniverseThemeModule.$window.on('scroll', function() {
					if (shown) {
						return false;
					}

					if (omniverseThemeModule.$document.scrollTop() >= omniverse_settings.popup_scroll) {
						showPopup();
						shown = true;
					}
				});
			} else {
				setTimeout(function() {
					showPopup();
				}, omniverse_settings.popup_delay);
			}
		}
	};

	$(document).ready(function() {
		omniverseThemeModule.promoPopup();
	});
})(jQuery);
