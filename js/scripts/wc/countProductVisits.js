/* global omniverse_settings */
(function($) {
	omniverseThemeModule.countProductVisits = function () {
		var live_duration = 10000;

		if ( 'undefined' !== typeof omniverse_settings.counter_visitor_live_duration ) {
			live_duration = omniverse_settings.counter_visitor_live_duration;
		}

		if ('yes' === omniverse_settings.counter_visitor_ajax_update) {
			omniverseThemeModule.updateCountProductVisits();
		} else if ( 'yes' === omniverse_settings.counter_visitor_live_mode) {
			setInterval(omniverseThemeModule.updateCountProductVisits, live_duration);
		}
	}

	omniverseThemeModule.updateCountProductVisits = function() {
		$('.wd-visits-count').each( function () {
			var $this = $(this);
			var productId = $this.data('product-id');
			var $count = $this.find('.wd-count-number');

			if ( ! productId ) {
				return;
			}

			$.ajax({
				url     : omniverse_settings.ajaxurl,
				data    : {
					action    : 'omniverse_update_count_product_visits',
					product_id: productId,
					count     : $count.text(),
				},
				method  : 'POST',
				success : function(response) {
					if (response) {
						$count.text(response.count);

						if (!response.count) {
							$this.addClass('wd-hide');
						} else {
							$this.removeClass('wd-hide');
						}
					}
				},
				error   : function() {
					console.log('ajax error');
				},
				complete: function() {}
			});
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.countProductVisits();
	});
})(jQuery);
