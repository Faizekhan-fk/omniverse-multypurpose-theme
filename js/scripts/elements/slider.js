omniverseThemeModule.$document.on('wdShopPageInit', function() {
	omniverseThemeModule.sliderAnimations();
	omniverseThemeModule.sliderLazyLoad();
});

[
	'frontend/element_ready/wd_slider.default'
].forEach( function (value) {
	omniverseThemeModule.wdElementorAddAction(value, function() {
		omniverseThemeModule.sliderAnimations();
		omniverseThemeModule.sliderLazyLoad();
	});
});

omniverseThemeModule.sliderClearAnimations = function($activeSlide, firstLoad) {
	// WPB clear on first load first slide.
	if (firstLoad) {
		$activeSlide.querySelectorAll('[class*="wpb_animate"]').forEach( function (animateElement) {
			var classes = Array.from(animateElement.classList);
			var name;

			for (var index = 0; index < classes.length; index++) {
				if (classes[index].indexOf('wd-anim-name_') >= 0) {
					name = classes[index].split('_')[1];
				}
			}

			if ( animateElement.classList.contains('wpb_start_animation') ) {
				animateElement.classList.remove('wpb_start_animation')
			}
			if ( animateElement.classList.contains('animated') ) {
				animateElement.classList.remove('animated')
			}
			if ( animateElement.classList.contains(name) ) {
				animateElement.classList.remove(name)
			}
		});
	}

	// WPB clear all siblings slides.
	$activeSlide.parentNode.querySelectorAll('[class*="wpb_animate"]').forEach( function (animateElement) {
		var classes = Array.from(animateElement.classList);
		var delay = 0;
		var name;

		for (var index = 0; index < classes.length; index++) {
			if (classes[index].indexOf('wd-anim-delay_') >= 0) {
				delay = parseInt(classes[index].split('_')[1]);
			}

			if (classes[index].indexOf('wd-anim-name_') >= 0) {
				name = classes[index].split('_')[1];
			}
		}

		setTimeout(function() {
			if ( animateElement.classList.contains('wpb_start_animation') ) {
				animateElement.classList.remove('wpb_start_animation')
			}
			if ( animateElement.classList.contains('animated') ) {
				animateElement.classList.remove('animated')
			}
			if ( animateElement.classList.contains(name) ) {
				animateElement.classList.remove(name)
			}
		}, delay);
	});
};

omniverseThemeModule.sliderAnimations = function() {
	document.querySelectorAll('.wd-slider > .wd-carousel-inner > .wd-carousel').forEach( function (sliderWrapper) {
		sliderWrapper.querySelectorAll('[class*="wd-animation"]').forEach( function (slide) {
			slide.classList.add('wd-animation-ready');
		});

		runAnimations(sliderWrapper.querySelector('.wd-slide'), true);

		sliderWrapper.addEventListener('wdSlideChange', function (e) {
			var slide = Array.prototype.filter.call(
				e.target.swiper.wrapperEl.children,
				(element) => e.detail.activeIndex == element.dataset.swiperSlideIndex,
			).shift();

			runAnimations(slide);
		});

		function runAnimations(slide, firstLoad = false) {
			omniverseThemeModule.sliderClearAnimations(slide, firstLoad);
			omniverseThemeModule.runAnimations(slide, firstLoad);
		}

	});
};

omniverseThemeModule.runAnimations = function($activeSlide, firstLoad) {
	// Elementor.
	$activeSlide.parentElement.querySelectorAll('[class*="wd-animation"]').forEach( function (animateElement) {
		animateElement.classList.remove('wd-animated');
	});

	$activeSlide.querySelectorAll('[class*="wd-animation"]').forEach( function (animateElement) {
		var classes = animateElement.classList;
		var delay = 0;

		for (var index = 0; index < classes.length; index++) {
			if (classes[index].indexOf('wd_delay_') >= 0) {
				delay = parseInt(classes[index].split('_')[2]);
			}
		}

		// if (firstLoad) {
		// 	delay += 500;
		// }

		setTimeout(function() {
			animateElement.classList.add('wd-animated');
		}, delay);
	});

	// WPB.
	$activeSlide.querySelectorAll('[class*="wpb_animate"]').forEach( function (animateElement) {
		var classes = animateElement.classList;
		var delay = 0;
		var name;

		for (var index = 0; index < classes.length; index++) {
			if (classes[index].indexOf('wd-anim-delay_') >= 0) {
				delay = parseInt(classes[index].split('_')[1]);
			}

			if (classes[index].indexOf('wd-anim-name_') >= 0) {
				name = classes[index].split('_')[1];
			}
		}

		// if (firstLoad) {
		// 	delay += 500;
		// }

		setTimeout(function() {
			animateElement.classList.remove('wd-off-anim');
			animateElement.classList.add('wpb_start_animation');
			animateElement.classList.add('animated');
		}, delay);
	});
};

omniverseThemeModule.sliderLazyLoad = function() {
	document.querySelectorAll('.wd-slider > .wd-carousel-inner > .wd-carousel').forEach( function (carousel) {
		load(carousel.querySelector('.wd-carousel-wrap').firstElementChild);

		carousel.addEventListener('wdSlideChange', function (e) {
			var slide = Array.prototype.filter.call(
				e.target.swiper.wrapperEl.children,
				(element) => e.detail.activeIndex == element.dataset.swiperSlideIndex,
			).shift();

			load(slide);
		});
	});

	function load(activeSlide) {
		if (activeSlide && activeSlide.nextElementSibling) {
			activeSlide.nextElementSibling.classList.add('omniverse-loaded');
		}

		activeSlide.classList.add('omniverse-loaded');

		activeSlide.closest('.wd-carousel').querySelectorAll('[id="' + activeSlide.id + '"]').forEach( function (slide) {
			slide.classList.add('omniverse-loaded');
		});
	}
};

window.addEventListener('load',function() {
	omniverseThemeModule.sliderAnimations();
	omniverseThemeModule.sliderLazyLoad();
});
