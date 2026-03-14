/* global omniverse_settings */
(function($) {
	omniverseThemeModule.ajaxPortfolio = function() {
		if ('no' === omniverse_settings.ajax_portfolio || 'undefined' === typeof ($.fn.pjax)) {
			return;
		}

		var ajaxLinks = '.wd-type-links .wd-nav-portfolio a, .tax-project-cat .wd-pagination a, .post-type-archive-portfolio .wd-pagination a';

		omniverseThemeModule.$body.on('click', '.tax-project-cat .wd-pagination a, .post-type-archive-portfolio .wd-pagination a', function() {
			scrollToTop(true);
		});

		omniverseThemeModule.$document.pjax(ajaxLinks, '.main-page-wrapper', {
			timeout : omniverse_settings.pjax_timeout,
			scrollTo: false,
			renderCallback: function(context, html, afterRender) {
				omniverseThemeModule.removeDuplicatedStylesFromHTML(html, function(html) {
					context.html(html);
					afterRender();
					omniverseThemeModule.$document.trigger('wdPortfolioPjaxComplete');
					omniverseThemeModule.$document.trigger('omni-images-loaded');
				});
			}
		});

		omniverseThemeModule.$document.on('pjax:start', function() {
			var $siteContent = $('.site-content');

			$siteContent.removeClass('wd-loaded');
			$siteContent.addClass('wd-loading');

			omniverseThemeModule.$document.trigger('wdPortfolioPjaxStart');
			omniverseThemeModule.$window.trigger('scroll.loaderVerticalPosition');
		});

		omniverseThemeModule.$document.on('pjax:end', function() {
			$('.site-content').removeClass('wd-loading');
		});

		omniverseThemeModule.$document.on('pjax:complete', function() {
			if (!omniverseThemeModule.$body.hasClass('tax-project-cat') && !omniverseThemeModule.$body.hasClass('post-type-archive-portfolio')) {
				return;
			}

			omniverseThemeModule.$document.trigger('omni-images-loaded');

			scrollToTop(false);

			$('.wd-ajax-content').removeClass('wd-loading');
		});

		var scrollToTop = function(type) {
			if (omniverse_settings.ajax_scroll === 'no' && type === false) {
				return false;
			}

			var $scrollTo = $(omniverse_settings.ajax_scroll_class),
			    scrollTo  = $scrollTo.offset().top - omniverse_settings.ajax_scroll_offset;

			$('html, body').stop().animate({
				scrollTop: scrollTo
			}, 400);
		};
	};

	$(document).ready(function() {
		omniverseThemeModule.ajaxPortfolio();
	});
})(jQuery);
