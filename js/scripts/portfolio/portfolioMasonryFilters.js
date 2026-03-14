/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdPortfolioPjaxComplete', function () {
		omniverseThemeModule.portfolioMasonryFilters();
	});

	$.each([
		'frontend/element_ready/wd_portfolio.default',
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.portfolioMasonryFilters();
		});
	});

	omniverseThemeModule.portfolioMasonryFilters = function() {
		var $filer = $('.wd-nav-portfolio');
		$filer.on('click', 'li', function(e) {
			e.preventDefault();
			var $this = $(this);
			var filterValue = $this.attr('data-filter');

			setTimeout(function() {
				omniverseThemeModule.$document.trigger('wood-images-loaded');
			}, 300);

			$filer.find('.wd-active').removeClass('wd-active');
			$this.addClass('wd-active');
			$this.parents('.portfolio-filter').siblings('.wd-masonry.wd-projects').isotope({
				filter: filterValue
			});
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.portfolioMasonryFilters();
	});
})(jQuery);
