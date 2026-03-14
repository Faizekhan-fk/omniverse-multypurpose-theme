/* global zs_settings */
(function($) {
	omniverseThemeModule.$document.on('wdLoadDropdownsSuccess', function() {
		omniverseThemeModule.videoElementClick();
	});

	omniverseThemeModule.wdElementorAddAction('frontend/element_ready/wd_video.default', function() {
		omniverseThemeModule.videoElementClick();
	});

	omniverseThemeModule.videoElementClick = function() {
		$('.wd-el-video-btn-overlay:not(.wd-el-video-lightbox):not(.wd-el-video-hosted)').on('click', function(e) {
			e.preventDefault();

			var $this = $(this);
			var $video = $this.parents('.wd-el-video').find('iframe');
			var videoScr = $video.data('lazy-load');
			var videoNewSrc = videoScr + '&autoplay=1&rel=0&mute=1';

			if (videoScr.indexOf('vimeo.com') + 1) {
				videoNewSrc = videoScr.replace('#t=', '') + '&autoplay=1';
			}

			$video.attr('src', videoNewSrc);
			$this.parents('.wd-el-video').addClass('wd-playing');
		});

		$('.wd-el-video-btn-overlay.wd-el-video-hosted:not(.wd-el-video-lightbox)').on('click', function(e) {
			e.preventDefault();

			var $this = $(this);
			var $video = $this.parents('.wd-el-video').find('video');
			var videoScr = $video.data('lazy-load');

			$video.attr('src', videoScr);
			$video[0].play();
			$this.parents('.wd-el-video').addClass('wd-playing');
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.videoElementClick();
	});
})(jQuery);