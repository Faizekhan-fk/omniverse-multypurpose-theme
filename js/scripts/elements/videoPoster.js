/* global omniverse_settings */
(function($) {
	omniverseThemeModule.videoPoster = function() {
		$('.wd-video-poster-wrapper').on('click', function() {
			var videoWrapper = $(this),
			    video        = videoWrapper.parent().find('iframe'),
			    videoScr     = video.attr('src'),
			    videoNewSrc  = videoScr + '&autoplay=1';

			if (videoScr.indexOf('vimeo.com') + 1) {
				videoNewSrc = videoScr + '?autoplay=1';
			}

			video.attr('src', videoNewSrc);
			videoWrapper.addClass('hidden-poster');
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.videoPoster();
	});
})(jQuery);
