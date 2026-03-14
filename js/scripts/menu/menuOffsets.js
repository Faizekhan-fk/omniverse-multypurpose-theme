/* global omniverse_settings */
(function($) {
	omniverseThemeModule.menuOffsets = function() {
		var setOffset = function(li) {
			var $dropdown = li.find(' > .wd-dropdown-menu');
			var dropdownWidth = $dropdown.outerWidth();
			var dropdownOffset = $dropdown.offset();
			var toRight;
			var viewportWidth;
			var dropdownOffsetRight;

			$dropdown.attr('style', '');

			if (!dropdownWidth || !dropdownOffset) {
				return;
			}

			if ($dropdown.hasClass('wd-design-full-width') || $dropdown.hasClass('wd-design-aside')) {
				viewportWidth = omniverseThemeModule.$window.width();

				if (omniverseThemeModule.$body.hasClass('rtl')) {
					dropdownOffsetRight = viewportWidth - dropdownOffset.left - dropdownWidth;

					if (dropdownOffsetRight + dropdownWidth >= viewportWidth) {
						toRight = dropdownOffsetRight + dropdownWidth - viewportWidth;

						$dropdown.css({
							right: -toRight
						});
					}
				} else {
					if (dropdownOffset.left + dropdownWidth >= viewportWidth) {
						toRight = dropdownOffset.left + dropdownWidth - viewportWidth;

						$dropdown.css({
							left: -toRight
						});
					}
				}
			} else if ($dropdown.hasClass('wd-design-sized') || $dropdown.hasClass('wd-design-full-height')) {
				viewportWidth = omniverse_settings.site_width;

				if (omniverseThemeModule.$window.width() < viewportWidth || ! viewportWidth || li.parents('.whb-header').hasClass('whb-full-width')) {
					viewportWidth = omniverseThemeModule.$window.width();
				}

				dropdownOffsetRight = viewportWidth - dropdownOffset.left - dropdownWidth;

				var extraSpace = 15;
				var containerOffset = (omniverseThemeModule.$window.width() - viewportWidth) / 2;
				var dropdownOffsetLeft;
				var $stickyCat = $('.wd-sticky-nav');

				if (omniverseThemeModule.$body.hasClass('wd-sticky-nav-enabled') && $stickyCat.length) {
					extraSpace -= $stickyCat.width() / 2;
				}

				if (omniverseThemeModule.$body.hasClass('rtl')) {
					dropdownOffsetLeft = containerOffset + dropdownOffsetRight;

					if (dropdownOffsetLeft + dropdownWidth >= viewportWidth) {
						toRight = dropdownOffsetLeft + dropdownWidth - viewportWidth;

						$dropdown.css({
							right: -toRight - extraSpace
						});
					}
				} else {
					dropdownOffsetLeft = dropdownOffset.left - containerOffset;

					if (dropdownOffsetLeft + dropdownWidth >= viewportWidth) {
						toRight = dropdownOffsetLeft + dropdownWidth - viewportWidth;

						$dropdown.css({
							left: -toRight - extraSpace
						});
					}
				}
			}
		};

		$('.wd-header-main-nav ul.menu > li, .wd-header-secondary-nav ul.menu > li, .widget_nav_mega_menu ul.menu:not(.wd-nav-vertical) > li, .wd-header-main-nav .wd-dropdown.wd-design-aside ul > li').each(function() {
			var $menu = $(this);

			if ($menu.hasClass('menu-item')) {
				$menu = $(this).parent();
			}

			function recalc() {
				if ($menu.hasClass('wd-offsets-calculated') || $menu.parents('.wd-design-aside').length) {
					return;
				}

				$menu.find(' > .menu-item-has-children').each(function() {
					setOffset($(this));
				});

				omniverseThemeModule.$document.trigger('resize.vcRowBehaviour');

				$menu.addClass('wd-offsets-calculated');
			}

			$menu.on('mouseenter mousemove', function() {
				recalc()
			});

			omniverseThemeModule.$window.on('wdHeaderBuilderStickyChanged', recalc);

			if ('yes' === omniverse_settings.clear_menu_offsets_on_resize) {
				setTimeout(function() {
					omniverseThemeModule.$window.on('resize', omniverseThemeModule.debounce(function() {
						$menu.removeClass('wd-offsets-calculated');
						$menu.find(' > .menu-item-has-children > .wd-dropdown-menu').attr('style', '');
					}, 300));
				}, 2000);
			}
		});
	};

	omniverseThemeModule.menuDropdownAside = function() {
		$('.wd-nav .wd-design-aside, .wd-header-cats.wd-open-dropdown .wd-nav').each( function () {
			var $links = $(this).find('.menu-item');

			if (!$links.length) {
				return;
			}

			var $firstLink = $links.first();

			if (!$firstLink.hasClass('menu-item-has-children')) {
				$firstLink.parents('.wd-sub-menu-wrapp').addClass('wd-empty-item');
			}

			$firstLink.addClass('wd-opened').find('.wd-dropdown').addClass('wd-opened');

			$links.on('mouseover', function () {
				var $this = $(this);
				var $wrap = $this.parents('.wd-sub-menu-wrapp');

				if ($this.hasClass('wd-opened')) {
					return;
				}

				if ( $this.hasClass('item-level-1') ) {
					if (!$this.hasClass('menu-item-has-children')) {
						$wrap.addClass('wd-empty-item');
					} else {
						$wrap.removeClass('wd-empty-item');
					}
				}

				$this.siblings().removeClass('wd-opened').find('.wd-dropdown').removeClass('wd-opened');
				$this.addClass('wd-opened').find('.wd-dropdown').addClass('wd-opened');
			});
		});
	}

	window.addEventListener('wdEventStarted', function () {
		setTimeout(function () {
			omniverseThemeModule.menuDropdownAside();
			omniverseThemeModule.menuOffsets();
		}, 100);
	});
})(jQuery);
