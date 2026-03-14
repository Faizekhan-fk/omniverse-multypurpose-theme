(function($) {
	'use strict';

	$(document).on('mouseenter', '.dn-popup .dn-hint', function () {
		var $wrapper = $(this);
		var offset = $wrapper.offset();
		var top = offset.top - $(window).scrollTop();
		var content = '';

		if ( ! $wrapper.hasClass( 'dn-loaded' ) ) {
			var $attachment = $wrapper.find('img');

			if ( ! $attachment.length ) {
				$attachment = $wrapper.find('video');
			}

			if ( ! $attachment.length || $wrapper.hasClass('dn-loaded')) {
				return;
			}

			$wrapper.addClass('dn-loaded dn-loading');

			$attachment.each( function () {
				var $this = $(this);

				if ( $this.attr('src') ) {
					return;
				}

				$this.attr('src', $this.data('src') );
			});

			$attachment.on('load play', function () {
				$wrapper.removeClass('dn-loading');
			});
		}

		if ( 350 >= top ) {
			$wrapper.find('.dn-tooltip').removeClass('dn-top').addClass('dn-bottom')
			content = $wrapper.html();
			$wrapper.find('.dn-tooltip').removeClass('dn-bottom').addClass('dn-top')
		} else {
			content = $wrapper.html();
		}

		$wrapper.find('.dn-tooltip').addClass('dn-hidden');

		setTimeout( function () {
			$('body').append(`
				<div class="dn-hint-wrapper" style="top: ${top}px; left: ${offset.left}px">
					${content}
				</div>
			`);
		}, 100);
	});

	$(document).on('mouseleave', '.dn-hint', function () {
		$('.dn-hint-wrapper').remove();

		$(this).find('.dn-tooltip').removeClass('dn-hidden');
	});
})(jQuery);