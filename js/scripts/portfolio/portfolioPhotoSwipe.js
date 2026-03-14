/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdPortfolioPjaxComplete', function () {
		omniverseThemeModule.portfolioPhotoSwipe();
	});

	$.each([
		'frontend/element_ready/wd_portfolio.default',
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.portfolioPhotoSwipe();
		});
	});

	omniverseThemeModule.portfolioPhotoSwipe = function() {
		omniverseThemeModule.$document.on('click', '.portfolio-enlarge', function(e) {
			e.preventDefault();
			var $this = $(this);
			var $parent = $this.parents('.wd-carousel-item');

			if ($parent.length === 0) {
				$parent = $this.parents('.portfolio-entry');
			}

			var index = $parent.index();
			var items = getPortfolioImages();

			omniverseThemeModule.callPhotoSwipe(index, items);
		});

		var getPortfolioImages = function() {
			var items = [];

			$('.portfolio-entry').find('figure a img').each(function() {
				var $this = $(this);

				items.push({
					src: $this.attr('src'),
					w  : $this.attr('width') ? $this.attr('width') : '300',
					h  : $this.attr('height') ? $this.attr('height') : '300',
				});
			});

			return items;
		};
	};

	$(document).ready(function() {
		omniverseThemeModule.portfolioPhotoSwipe();
	});
})(jQuery);
