/* global omniverse_settings */
(function($) {
	omniverseThemeModule.ajaxFilters = function() {
		if (!omniverseThemeModule.$body.hasClass('omniverse-ajax-shop-on') || typeof ($.fn.pjax) === 'undefined' || omniverseThemeModule.$body.hasClass('single-product') || omniverseThemeModule.$body.hasClass('elementor-editor-active') || $('.products[data-source="main_loop"]').length === 0) {
			return;
		}

		var that         = this,
		    filtersState = false;

		omniverseThemeModule.$body.on('click', '.post-type-archive-product .products-footer .woocommerce-pagination a', function() {
			scrollToTop(true);
		});

		omniverseThemeModule.$document.pjax(omniverse_settings.ajax_links, '.main-page-wrapper', {
			timeout       : omniverse_settings.pjax_timeout,
			scrollTo      : false,
			renderCallback: function(context, html, afterRender) {
				omniverseThemeModule.removeDuplicatedStylesFromHTML(html, function(html) {
					context.html(html);
					afterRender();
					omniverseThemeModule.$document.trigger('wdShopPageInit');
					omniverseThemeModule.$document.trigger('wood-images-loaded');
				});
			}
		});

		if (omniverse_settings.price_filter_action === 'click') {
			omniverseThemeModule.$document.on('click', '.widget_price_filter form .button', function() {
				var form = $('.widget_price_filter form');
				$.pjax({
					container: '.main-page-wrapper',
					timeout  : omniverse_settings.pjax_timeout,
					url      : form.attr('action'),
					data     : form.serialize(),
					scrollTo : false,
					renderCallback: function(context, html, afterRender) {
						omniverseThemeModule.removeDuplicatedStylesFromHTML(html, function(html) {
							context.html(html);
							afterRender();
							omniverseThemeModule.$document.trigger('wdShopPageInit');
							omniverseThemeModule.$document.trigger('wood-images-loaded');
						});
					}
				});

				return false;
			});
		} else if (omniverse_settings.price_filter_action === 'submit') {
			omniverseThemeModule.$document.on('submit', '.widget_price_filter form', function(event) {
				$.pjax.submit(event, '.main-page-wrapper');
			});
		}

		omniverseThemeModule.$document.on('pjax:error', function(xhr, textStatus, error) {
			console.log('pjax error ' + error);
		});

		omniverseThemeModule.$document.on('pjax:start', function() {
			var $siteContent = $('.site-content');

			$siteContent.removeClass('wd-loaded');
			$siteContent.addClass('wd-loading');

			omniverseThemeModule.$document.trigger('wdPjaxStart');
			omniverseThemeModule.$window.trigger('scroll.loaderVerticalPosition');
		});

		omniverseThemeModule.$document.on('pjax:complete', function() {
			omniverseThemeModule.$window.off('scroll.loaderVerticalPosition');

			scrollToTop(false);

			omniverseThemeModule.$document.trigger('wood-images-loaded');

			$('.wd-scroll-content').on('scroll', function() {
				omniverseThemeModule.$document.trigger('wood-images-loaded');
			});

			if (typeof omniverse_wpml_js_data !== 'undefined' && omniverse_wpml_js_data.languages) {
				$.each(omniverse_wpml_js_data.languages, function(index, language) {
					$('.wpml-ls-item-' + language.code + ' .wpml-ls-link').attr('href', language.url);
				});
			}
		});

		omniverseThemeModule.$document.on('pjax:beforeReplace', function() {
			if ($('.filters-area').hasClass('filters-opened') && omniverse_settings.shop_filters_close === 'yes') {
				filtersState = true;
				omniverseThemeModule.$body.addClass('body-filters-opened');
			}
		});

		omniverseThemeModule.$document.on('wdShopPageInit', function() {
			var $siteContent = $('.site-content');

			if (filtersState) {
				$('.filters-area').css('display', 'block');
				omniverseThemeModule.openFilters(200);
				filtersState = false;
			}

			$siteContent.removeClass('wd-loading');
			$siteContent.addClass('wd-loaded');
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
		omniverseThemeModule.ajaxFilters();
	});

	window.addEventListener('popstate', function() {
		omniverseThemeModule.ajaxFilters();
	});
})(jQuery);
