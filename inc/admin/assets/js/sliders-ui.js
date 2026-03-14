/* global jQuery, omniverseConfig */

(function($) {
	'use strict';

	function slidersUi() {
		var $sliderdiv = $('#omniverse_sliderdiv')
		var $sliderAll = $('#omniverse_slider-all');
		var $currentID = $('#post_ID').val();
		var sliderId = [];

		$sliderAll.find('input[checked="checked"]').each( function () {
			sliderId.push($(this).val());
		});

		$sliderdiv.addClass('dn-loading');

		$.ajax({
			url    : omniverseConfig.ajaxUrl,
			data   : {
				action   : 'omniverse_get_slides_data',
				slider_id: sliderId,
				security : omniverseConfig.get_slides_nonce
			},
			error  : function() {
				$sliderdiv.removeClass('dn-loading');
			},
			success: function(response) {
				$sliderdiv.removeClass('dn-loading');

				if (!response.data) {
					return false;
				}

				$('#omniverse_slider-all [id*="omniverse_slider-"]').each(function() {
					var $this = $(this);
					var slider_id = $this.attr('id').replace('omniverse_slider-', '');

					if ( 'undefined' === typeof response.data[slider_id] ) {
						return;
					}

					var data = response.data[slider_id];

					$this.append('<a class="dn-inline-btn dn-style-icon dn-i-cog dn-tooltip-mirror" href="' + data['slider_edit_link'] + '"><span class="dn-tooltip dn-left">' + data['slider_edit_text'] + '</span></a>');

					if ( 'undefined' === typeof data['slides'] ) {
						return;
					}

					$this.append('<ul class="children"></ul>');

					var $ul = $this.find('ul');

					for (const key in data['slides']) {
						var slide = data['slides'][key];
						var img = slide.img_url ? `<img src="${slide.img_url}" alt="slide">` : '';
						var classes = parseInt($currentID) === parseInt(slide.id) ? 'dn-current' : '';

						if ( !img && slide.bg_color ) {
							img = `<span class="dn-slider-bg-color" style="background-color: ${slide.bg_color}"></span>`
						}

						$ul.append(`<li class="${classes}"><a href="${slide.link}">${img}${slide.title}</a></li>`);
					}
				});

				var activeSlider = '';
				var params = new URLSearchParams(window.location.search)

				if ( params ) {
					for (let param of params) {
						if ( param[0] === 'slider_id' ) {
							activeSlider = param[1];
						}
					}
				}

				if ( activeSlider ) {
					$sliderAll.find('#in-omniverse_slider-' + activeSlider).prop('checked', true);
				}
			}
		});
	}

	jQuery(document).ready(function() {
		slidersUi();
	});
})(jQuery);