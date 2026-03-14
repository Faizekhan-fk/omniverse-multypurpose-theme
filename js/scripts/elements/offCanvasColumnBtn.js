(function($) {
	omniverseThemeModule.$document.on('wdShopPageInit', function () {
		omniverseThemeModule.offCanvasColumnBtn();
	});

	$.each([
		'frontend/element_ready/column',
		'frontend/element_ready/container',
		'frontend/element_ready/wd_builder_off_canvas_column_btn.default'
	], function(index, value) {
		omniverseThemeModule.wdElementorAddAction(value, function() {
			omniverseThemeModule.offCanvasColumnBtn();
		});
	});

	omniverseThemeModule.offCanvasColumnBtn = function() {
		var $closeSide = $('.wd-close-side');
		var $colOffCanvas = $('[class*="wd-col-offcanvas"]');
		var alignment = $colOffCanvas.hasClass('wd-alignment-left') ? 'left' : 'right';
		var $openButton = $('.wd-off-canvas-btn, .wd-off-canvas-btn ~ .wd-sidebar-opener, .wd-sidebar-opener.wd-on-toolbar');
		var innerWidth = omniverseThemeModule.$window.width();

		var offCanvassInit = function() {
			$colOffCanvas.removeClass('wd-left wd-right').addClass('wd-side-hidden wd-' + alignment + ' wd-inited');

			if (0 === $colOffCanvas.find('.wd-heading').length) {
				$colOffCanvas.prepend(
					'<div class="wd-heading"><div class="close-side-widget wd-action-btn wd-style-text wd-cross-icon"><a href="#" rel="nofollow">' + omniverse_settings.off_canvas_column_close_btn_text + '</a></div></div>'
				);
			}

			$openButton.on('click', function(e) {
				e.preventDefault();

				$colOffCanvas.addClass('wd-scroll wd-opened');
				$closeSide.addClass('wd-close-side-opened');
				$openButton.addClass('wd-opened');

				$colOffCanvas.find(' .elementor-widget-wrap').first().addClass('wd-scroll-content');
			});
		};

		if ('elementor' === omniverse_settings.current_page_builder && (($colOffCanvas.hasClass('wd-col-offcanvas-lg') && innerWidth >= 1024) || ($colOffCanvas.hasClass('wd-col-offcanvas-md-sm') && 768 <= innerWidth && innerWidth <= 1024) || ($colOffCanvas.hasClass('wd-col-offcanvas-sm') && innerWidth <= 767))) {
			offCanvassInit();
		} else if ('wpb' === omniverse_settings.current_page_builder && (($colOffCanvas.hasClass('wd-col-offcanvas-lg') && innerWidth >= 1200) || ($colOffCanvas.hasClass('wd-col-offcanvas-md-sm') && 769 <= innerWidth && innerWidth <= 1199) || ($colOffCanvas.hasClass('wd-col-offcanvas-sm') && innerWidth <= 768))) {
			offCanvassInit();
		} else if ( $colOffCanvas.hasClass( 'wd-opened' ) ) {
			$openButton.off('click');
			$('.elementor-column, .e-con').removeClass('wd-side-hidden wd-inited wd-scroll wd-opened wd-left wd-right');
			$('.wpb_column').removeClass('wd-side-hidden wd-inited wd-scroll wd-opened wd-left wd-right');
			$closeSide.removeClass('wd-close-side-opened');
			$openButton.removeClass('wd-opened');
			$colOffCanvas.find(' .elementor-widget-wrap').first().removeClass('wd-scroll-content');
			$colOffCanvas.find('.wd-heading').remove();
		}

		$openButton.on('click', function(e) {
			e.preventDefault();
		});

		omniverseThemeModule.$body.on('pjax:beforeSend', function() {
			$('.wd-close-side, .close-side-widget').trigger('click');
		});

		omniverseThemeModule.$body.on('click touchstart', '.wd-close-side, .close-side-widget', function(e) {
			e.preventDefault();

			$colOffCanvas.removeClass('wd-opened');
			$closeSide.removeClass('wd-close-side-opened');
			$openButton.removeClass('wd-opened');
		});
	};

	omniverseThemeModule.$window.on('resize', omniverseThemeModule.debounce(function() {
		omniverseThemeModule.offCanvasColumnBtn();
	}, 300));

	$(document).ready(function() {
		omniverseThemeModule.offCanvasColumnBtn();
	});
})(jQuery);