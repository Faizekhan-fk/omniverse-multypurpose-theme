(function($) {
	omniverseThemeModule.$document.on('wdShopPageInit', function () {
		omniverseThemeModule.buttonShowMore();
	});

	$.each([
		'frontend/element_ready/wd_button.default',
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.buttonShowMore();
		});
	});

	omniverseThemeModule.buttonShowMore = function () {
		$('.wd-collapsible-content').each(function() {
			var $this = $(this);
			var $button = $this.find('.wd-collapsible-button');


			$button.on('click', function(e) {
				e.preventDefault();

				$this.toggleClass('wd-opened');
			});
		});
	}

	$(document).ready(function() {
		omniverseThemeModule.buttonShowMore();
	});
})(jQuery);