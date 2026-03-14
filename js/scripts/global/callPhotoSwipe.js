/* global omniverse_settings */
(function($) {
	omniverseThemeModule.callPhotoSwipe = function(index, items) {
		if (omniverseThemeModule.$body.hasClass('rtl')) {
			index = items.length - index - 1;
			items = items.reverse();
		}

		var options = {
			index        : index,
			shareButtons : [
				{
					id   : 'facebook',
					label: omniverse_settings.share_fb,
					url  : 'https://www.facebook.com/sharer/sharer.php?u={{url}}'
				},
				{
					id   : 'twitter',
					label: omniverse_settings.tweet,
					url  : 'https://x.com/intent/tweet?text={{text}}&url={{url}}'
				},
				{
					id   : 'pinterest',
					label: omniverse_settings.pin_it,
					url  : 'http://www.pinterest.com/pin/create/button/' +
						'?url={{url}}&media={{image_url}}&description={{text}}'
				},
				{
					id      : 'download',
					label   : omniverse_settings.download_image,
					url     : '{{raw_image_url}}',
					download: true
				}
			],
			closeOnScroll: omniverse_settings.photoswipe_close_on_scroll,
			isClickableElement: function (el) {
				return el.tagName === 'A' || $(el).hasClass('wd-play-video')|| $(el).hasClass('wd-product-video');
			},
			getDoubleTapZoom: function (isMouseClick, item) {
				if (isMouseClick || 'undefined' !== typeof item.html) {
					return 1;
				} else {
					return item.initialZoomLevel < 0.7 ? 1 : 1.33;
				}
			}
		};

		omniverseThemeModule.$body.find('.pswp').remove();
		omniverseThemeModule.$body.append(omniverse_settings.photoswipe_template);
		var pswpElement = document.querySelectorAll('.pswp')[0];

		// Initializes and opens PhotoSwipe
		var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);

		omniverseThemeModule.$document.trigger('wdPhotoSwipeBeforeInited', gallery );

		gallery.init();
	};
})(jQuery);
