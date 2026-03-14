/* global omniverse_settings */
(function($) {
	$.each([
		'frontend/element_ready/wd_counter.default'
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.visibleElements();
		});
	});

	omniverseThemeModule.counterShortcode = function(counter) {
		if (counter.attr('data-state') === 'done' || parseInt(counter.text()) !== counter.data('final')) {
			return;
		}

		counter.prop('Counter', 0).animate({
			Counter: counter.text()
		}, {
			duration: parseInt(omniverse_settings.animated_counter_speed),
			easing  : 'swing',
			step    : function(now) {
				if (now >= counter.data('final')) {
					counter.attr('data-state', 'done');
				}

				counter.text(Math.ceil(now));
			}
		});
	};

	omniverseThemeModule.visibleElements = function() {
		$('.omniverse-counter .counter-value').each(function() {
			var $this = $(this);

			$this.waypoint(function() {
				omniverseThemeModule.counterShortcode($this);
			}, {offset: '100%'});
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.visibleElements();
	});
})(jQuery);
