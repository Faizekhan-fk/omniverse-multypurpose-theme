/* global zs_settings */
(function($) {
	omniverseThemeModule.$document.on('wdLoadDropdownsSuccess', function() {
		omniverseThemeModule.videoElementPopup();
	});

	omniverseThemeModule.wdElementorAddAction('frontend/element_ready/wd_video.default', function() {
		omniverseThemeModule.videoElementPopup();
	});

	omniverseThemeModule.videoElementPopup = function() {
		if ('undefined' === typeof ($.fn.magnificPopup)) {
			return;
		}

		$.magnificPopup.close();

		$('.wd-el-video-btn:not(.wd-el-video-hosted), .wd-el-video-btn-overlay.wd-el-video-lightbox:not(.wd-el-video-hosted), .wd-el-video.wd-action-button:not(.wd-video-hosted) a, .wd-el-video.wd-action-action_button:not(.wd-video-hosted) a').magnificPopup({
			tClose         : omniverse_settings.close,
			tLoading       : omniverse_settings.loading,
			removalDelay   : 500,
			type           : 'iframe',
			preloader      : false,
			iframe         : {
				markup  : '<div class="wd-popup mfp-with-anim wd-video-popup"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" allowfullscreen frameborder="0"></iframe></div>',
				patterns: {
					youtube: {
						index: 'youtube.com/',
						id   : 'v=',
						src  : '//www.youtube.com/embed/%id%?rel=0&autoplay=1&mute=1'
					},
					vimeo  : {
						index: 'vimeo.com/',
						id   : '/',
						src  : '//player.vimeo.com/video/%id%?transparent=0&autoplay=1&muted=1'
					}
				}
			},
			callbacks      : {
				beforeOpen: function() {
					this.st.mainClass = 'mfp-move-horizontal';
				}
			}
		});

		$('.wd-el-video-btn-overlay.wd-el-video-lightbox.wd-el-video-hosted,.wd-el-video-btn.wd-el-video-hosted, .wd-el-video.wd-action-button.wd-video-hosted a, .wd-el-video.wd-action-action_button.wd-video-hosted a').magnificPopup({
			type        : 'inline',
			tClose      : omniverse_settings.close,
			tLoading    : omniverse_settings.loading,
			removalDelay: 500,
			preloader   : false,
			callbacks   : {
				beforeOpen  : function() {
					this.st.mainClass = 'mfp-move-horizontal';
				},
				elementParse: function(item) {
					var $video = $(item.src).find('video');

					if ( ! $video.attr('src') ) {
						$video.attr('src', $video.data('lazy-load'));
					}

					$video[0].play();
				},
				open        : function() {
					omniverseThemeModule.$document.trigger('wood-images-loaded');
					omniverseThemeModule.$window.resize();
				},
				close       : function(e) {
					var magnificPopup = $.magnificPopup.instance;
					var $video = $(magnificPopup.st.el[0]).parents('.wd-el-video').find('video');
					$video[0].pause();
				}
			}
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.videoElementPopup();
	});
})(jQuery);