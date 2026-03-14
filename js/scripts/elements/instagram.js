/* global omniverse_settings */
(function($) {
	omniverseThemeModule.instagramAjaxQuery = function() {
		$('.wd-insta').each(function() {
			var $instagram = $(this);

			if (!$instagram.hasClass('wd-error')) {
				return;
			}

			var username = $instagram.data('username');
			var atts = $instagram.data('atts');
			var request_param = username.indexOf('#') > -1 ? 'explore/tags/' + username.substr(1) : username;
			var url = 'https://www.instagram.com/' + request_param + '/';

			$instagram.addClass('loading');

			$.ajax({
				url    : url,
				success: function(response) {
					$.ajax({
						url     : omniverse_settings.ajaxurl,
						data    : {
							action: 'omniverse_instagram_ajax_query',
							body  : response,
							atts  : atts
						},
						dataType: 'json',
						method  : 'POST',
						success : function(response) {
							$instagram.parent().html(response);
							omniverseThemeModule.$document.trigger('wdInstagramAjaxSuccess');
						},
						error   : function() {
							console.log('instagram ajax error');
						}
					});
				},
				error  : function() {
					console.log('instagram ajax error');
				}
			});
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.instagramAjaxQuery();
	});
})(jQuery);
