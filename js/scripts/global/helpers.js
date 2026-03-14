var omniverseThemeModule = {};
/* global omniverse_settings */

(function($) {
	omniverseThemeModule.supports_html5_storage = false;

	try {
		omniverseThemeModule.supports_html5_storage = ('sessionStorage' in window && window.sessionStorage !== null);
		window.sessionStorage.setItem('wd', 'test');
		window.sessionStorage.removeItem('wd');
	}
	catch (err) {
		omniverseThemeModule.supports_html5_storage = false;
	}

	omniverseThemeModule.$window = $(window);

	omniverseThemeModule.$document = $(document);

	omniverseThemeModule.$body = $('body');

	omniverseThemeModule.windowWidth = omniverseThemeModule.$window.width();

	omniverseThemeModule.removeURLParameter = function(url, parameter) {
		var urlParts = url.split('?');

		if (urlParts.length >= 2) {
			var prefix = encodeURIComponent(parameter) + '=';
			var pars = urlParts[1].split(/[&;]/g);

			for (var i = pars.length; i-- > 0;) {
				if (pars[i].lastIndexOf(prefix, 0) !== -1) {
					pars.splice(i, 1);
				}
			}

			return urlParts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');
		}

		return url;
	};

	omniverseThemeModule.removeDuplicatedStylesFromHTML = function(html, callback) {
		var $data = $('<div class="temp-wrapper"></div>').append(html);
		var $links = $data.find('link');
		var counter = 0;
		var timeout = false;

		if (0 === $links.length) {
			callback(html);
			return;
		}

		setTimeout(function() {
			if (counter <= $links.length && !timeout) {
				callback($($data.html()));
				timeout = true;
			}
		}, 500);

		$links.each(function() {
			if ( 'undefined' !== typeof $(this).attr('id') && $(this).attr('id').indexOf('theme_settings_') !== -1) {
				$('head').find('link[id*="theme_settings_"]:not([id*="theme_settings_default"])').remove();
			}
		});

		$links.each(function() {
			var $link = $(this);
			var id = $link.attr('id');
			var href = $link.attr('href');

			if ( 'undefined' === typeof id ) {
				return;
			}

			var isThemeSettings = id.indexOf('theme_settings_') !== -1;
			var isThemeSettingsDefault = id.indexOf('theme_settings_default') !== -1;

			$link.remove();

			if ('undefined' === typeof omniverse_page_css[id] && ! isThemeSettingsDefault) {
				$('head').append($link.on('load', function() {
					counter++;

					if (!isThemeSettings) {
						omniverse_page_css[id] = href;
					}

					if (counter >= $links.length && !timeout) {
						callback($($data.html()));
						timeout = true;
					}
				}));
			} else {
				counter++;

				if (counter >= $links.length && !timeout) {
					callback($($data.html()));
					timeout = true;
				}
			}
		});
	};

	omniverseThemeModule.debounce = function(func, wait, immediate) {
		var timeout;
		return function() {
			var context = this;
			var args = arguments;
			var later = function() {
				timeout = null;

				if (!immediate) {
					func.apply(context, args);
				}
			};
			var callNow = immediate && !timeout;

			clearTimeout(timeout);
			timeout = setTimeout(later, wait);

			if (callNow) {
				func.apply(context, args);
			}
		};
	};

	omniverseThemeModule.wdElementorAddAction = function(name, callback) {
		omniverseThemeModule.$window.on('elementor/frontend/init', function() {
			if (!elementorFrontend.isEditMode()) {
				return;
			}

			elementorFrontend.hooks.addAction(name, callback);
		});
	};

	omniverseThemeModule.wdElementorAddAction('frontend/element_ready/global', function($wrapper) {
		if ($wrapper.attr('style') && $wrapper.attr('style').indexOf('transform:translate3d') === 0 && !$wrapper.hasClass('wd-parallax-on-scroll')) {
			$wrapper.attr('style', '');
		}
		$wrapper.removeClass('wd-animated');
		$wrapper.data('wd-waypoint', '');
		$wrapper.removeClass('wd-anim-ready');
		omniverseThemeModule.$document.trigger('wdElementorGlobalReady');
	});

	$.each([
		'frontend/element_ready/column',
		'frontend/element_ready/container'
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function($wrapper) {
			if ($wrapper.attr('style') && $wrapper.attr('style').indexOf('transform:translate3d') === 0 && !$wrapper.hasClass('wd-parallax-on-scroll')) {
				$wrapper.attr('style', '');
			}
			$wrapper.removeClass('wd-animated');
			$wrapper.data('wd-waypoint', '');
			$wrapper.removeClass('wd-anim-ready');

			setTimeout(function() {
				omniverseThemeModule.$document.trigger('wdElementorColumnReady');
			}, 100);
		});
	});

	omniverseThemeModule.setupMainCarouselArg = function() {
		omniverseThemeModule.$mainCarouselWrapper = $('.woocommerce-product-gallery');
		var items = 1;

		if ( omniverseThemeModule.$mainCarouselWrapper.hasClass('thumbs-position-centered') || omniverseThemeModule.$mainCarouselWrapper.hasClass('thumbs-position-carousel_two_columns') ) {
			items = 2;
		}

		omniverseThemeModule.mainCarouselArg = {
			slidesPerView  : items,
			loop           : omniverse_settings.product_slider_autoplay,
			centeredSlides : omniverseThemeModule.$mainCarouselWrapper.hasClass('thumbs-position-centered'),
			initialSlide   : omniverseThemeModule.$mainCarouselWrapper.hasClass('thumbs-position-centered') ? omniverse_settings.centered_gallery_start : 0,
			autoHeight     : omniverse_settings.product_slider_auto_height === 'yes',
			grabCursor            : true,
			a11y                  : {
				enabled: false
			},
			slideClass            : 'wd-carousel-item',
			slideActiveClass      : 'wd-active',
			slideVisibleClass     : 'wd-slide-visible',
			slideNextClass        : 'wd-next',
			slidePrevClass        : 'wd-prev',
			containerModifierClass: 'wd-',
			wrapperClass          : 'wd-carousel-wrap',
			on                    : {
				slideChange: function() {
					document.querySelector('.woocommerce-product-gallery__wrapper.wd-carousel').dispatchEvent(new CustomEvent('wdSlideChange', { activeIndex: this.activeIndex}));

					omniverseThemeModule.$document.trigger('omni-images-loaded');
				}
			}
		};

		if ( document.querySelector('.woocommerce-product-gallery__wrapper.wd-carousel') && document.querySelector('.woocommerce-product-gallery__wrapper.wd-carousel').parentElement.querySelector('.wd-btn-arrow.wd-next') ) {
			omniverseThemeModule.mainCarouselArg.navigation = {
				nextEl       : document.querySelector('.woocommerce-product-gallery__wrapper.wd-carousel').parentElement.querySelector('.wd-btn-arrow.wd-next'),
				prevEl       : document.querySelector('.woocommerce-product-gallery__wrapper.wd-carousel').parentElement.querySelector('.wd-btn-arrow.wd-prev'),
				disabledClass: 'wd-disabled',
				lockClass    : 'wd-lock',
				hiddenClass  : 'wd-hide'
			};
		}


		if (omniverse_settings.product_slider_autoplay) {
			omniverseThemeModule.mainCarouselArg.autoplay = {
				delay: 3000,
				pauseOnMouseEnter: true
			};
		}

		if (omniverseThemeModule.$mainCarouselWrapper.find('.wd-nav-pagin-wrap').length) {
			omniverseThemeModule.mainCarouselArg.pagination = {
				el                     : document.querySelector('.woocommerce-product-gallery .wd-nav-pagin'),
				type                   : 'bullets',
				clickable              : true,
				bulletClass            : 'wd-nav-pagin-item',
				bulletActiveClass      : 'wd-active',
				modifierClass          : 'wd-type-',
				lockClass              : 'wd-lock',
				currentClass           : 'wd-current',
				totalClass             : 'wd-total',
				hiddenClass            : 'wd-hidden',
				clickableClass         : 'wd-clickable',
				horizontalClass        : 'wd-horizontal',
				verticalClass          : 'wd-vertical',
				paginationDisabledClass: 'wd-disabled',
				renderBullet           : function(index, className) {
					var innerContent = '';

					if (omniverseThemeModule.$mainCarouselWrapper.find('.wd-nav-pagin-wrap').hasClass('wd-style-number-2')) {
						innerContent = index + 1;

						if ( 9 >= innerContent ) {
							innerContent = '0' + innerContent;
						}
					}

					return '<li class="' + className + '"><span>' + innerContent + '</span></li>';
				}
			};
		}
	}

	omniverseThemeModule.shopLoadMoreBtn = '.wd-products-load-more.load-on-scroll';

	omniverseThemeModule.$window.on('elementor/frontend/init', function() {
		if (!elementorFrontend.isEditMode()) {
			return;
		}

		if ('enabled' === omniverse_settings.elementor_no_gap) {
			$.each([
				'frontend/element_ready/section',
				'frontend/element_ready/container'
			], function(index, value) {
				omniverseThemeModule.wdElementorAddAction(value, function($wrapper) {
					if ($wrapper.attr('style') && $wrapper.attr('style').indexOf('transform:translate3d') === 0 && !$wrapper.hasClass('wd-parallax-on-scroll')) {
						$wrapper.attr('style', '');
					}

					$wrapper.removeClass('wd-animated');
					$wrapper.data('wd-waypoint', '');
					$wrapper.removeClass('wd-anim-ready');
					omniverseThemeModule.$document.trigger('wdElementorSectionReady');
				});

				elementorFrontend.hooks.addAction(value, function($wrapper) {
					var cid = $wrapper.data('model-cid');

					if (typeof elementorFrontend.config.elements.data[cid] !== 'undefined') {
						var size = '';

						if ('undefined' !== typeof elementorFrontend.config.elements.data[cid].attributes.elType) {
							if ('container' === elementorFrontend.config.elements.data[cid].attributes.elType) {
								if ( 'boxed' === elementorFrontend.config.elements.data[cid].attributes.content_width ) {
									size = elementorFrontend.config.elements.data[cid].attributes.boxed_width.size;
								} else {
									size = true;
								}
							} else if ('section' === elementorFrontend.config.elements.data[cid].attributes.elType) {
								size = elementorFrontend.config.elements.data[cid].attributes.content_width.size;
							}
						}

						if (!size) {
							$wrapper.addClass('wd-negative-gap');
						}
					}
				});
			});

			elementor.channels.editor.on('change:section change:container', function(view) {
				var changed = view.elementSettingsModel.changed;
				if (typeof changed.content_width !== 'undefined' || typeof changed.boxed_width !== 'undefined') {
					var size = [];

					if ('container' === view.elementSettingsModel.attributes.elType ) {
						if ( typeof changed.boxed_width !== 'undefined' ) {
							size = changed.boxed_width.size;
						}
					} else if (typeof changed.content_width !== 'undefined') {
						size = changed.content_width.size;
					}

					var sectionId = view._parent.model.id;
					var $section = $('.elementor-element-' + sectionId);

					if (size) {
						$section.removeClass('wd-negative-gap');
					} else {
						$section.addClass('wd-negative-gap');
					}
				}
			});
		}
	});

	omniverseThemeModule.$window.on('load', function() {
		$('.wd-preloader').delay(parseInt(omniverse_settings.preloader_delay)).addClass('preloader-hide');
		$('.wd-preloader-style').remove();
		setTimeout(function() {
			$('.wd-preloader').remove();
		}, 200);
	});

	omniverseThemeModule.googleMapsCallback = function () {
		return '';
	};
})(jQuery);

omniverseThemeModule.slideUp = function ( target, duration = 400 ) {
	target.style.transitionProperty = 'height, margin, padding';
	target.style.transitionDuration = duration + 'ms';
	target.style.boxSizing = 'border-box';
	target.style.height = target.offsetHeight + 'px';
	target.offsetHeight;
	target.style.overflow = 'hidden';
	target.style.height = 0;
	target.style.paddingTop = 0;
	target.style.paddingBottom = 0;
	target.style.marginTop = 0;
	target.style.marginBottom = 0;

	window.setTimeout( () => {
		target.style.display = 'none';
		target.style.removeProperty('height');
		target.style.removeProperty('padding-top');
		target.style.removeProperty('padding-bottom');
		target.style.removeProperty('margin-top');
		target.style.removeProperty('margin-bottom');
		target.style.removeProperty('overflow');
		target.style.removeProperty('transition-duration');
		target.style.removeProperty('transition-property');
	}, duration);
}

omniverseThemeModule.slideDown = function ( target, duration = 400 ) {
	target.style.removeProperty('display');
	let display = window.getComputedStyle(target).display;

	if ('none' === display) {
		display = 'block';
	}

	target.style.display = display;
	let height = target.offsetHeight;
	target.style.overflow = 'hidden';
	target.style.height = 0;
	target.style.paddingTop = 0;
	target.style.paddingBottom = 0;
	target.style.marginTop = 0;
	target.style.marginBottom = 0;
	target.offsetHeight;
	target.style.boxSizing = 'border-box';
	target.style.transitionProperty = "height, margin, padding";
	target.style.transitionDuration = duration + 'ms';
	target.style.height = height + 'px';
	target.style.removeProperty('padding-top');
	target.style.removeProperty('padding-bottom');
	target.style.removeProperty('margin-top');
	target.style.removeProperty('margin-bottom');

	window.setTimeout( () => {
		target.style.removeProperty('height');
		target.style.removeProperty('overflow');
		target.style.removeProperty('transition-duration');
		target.style.removeProperty('transition-property');
	}, duration);
}

omniverseThemeModule.slideToggle = function (target, duration = 400) {
	if (window.getComputedStyle(target).display === 'none') {
		return omniverseThemeModule.slideDown(target, duration);
	} else {
		return omniverseThemeModule.slideUp(target, duration);
	}
}

window.addEventListener('load',function() {
	var events = [
		'keydown',
		'scroll',
		'mouseover',
		'touchmove',
		'touchstart',
		'mousedown',
		'mousemove'
	];

	var triggerListener = function(e) {
		window.dispatchEvent(new CustomEvent('wdEventStarted'));
		removeListener();
	};

	var removeListener = function() {
		events.forEach(function(eventName) {
			window.removeEventListener(eventName, triggerListener);
		});
	};

	var addListener = function(eventName) {
		window.addEventListener(eventName, triggerListener);
	};

	events.forEach(function(eventName) {
		addListener(eventName);
	});
});