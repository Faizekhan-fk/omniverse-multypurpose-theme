(function($) {
	var $panel = $('#vc_ui-panel-edit-element');
	// Dependency.
	$panel.on('vcPanel.shown', function() {
		$panel.find('.wpb_edit_form_elements').addClass('dn-loaded');

		var $fieldValue = $('.vc_shortcode-param .wpb_vc_param_value');

		$fieldValue.on('change', function() {
			checkDependency($(this));
		});

		$fieldValue.each(function() {
			checkDependency($(this));
		});

		function checkDependency($this) {
			var name = $this.attr('name');
			var value = $this.val();

			$('.vc_shortcode-param').each(function() {
				var $this = $(this);
				var param = $this.data('param_settings');

				if (param.wd_dependency) {
					if (param.wd_dependency.element === name) {
						if ('undefined' !== typeof param.wd_dependency.value) {
							if (param.wd_dependency.value.includes(value)) {
								$this.show();
								if ($this.parents('.wd-typography-wrapper')) {
									$this.parents('.wd-typography-wrapper').show();
								}
							} else {
								$this.hide();
								if ($this.parents('.wd-typography-wrapper')) {
									$this.parents('.wd-typography-wrapper').hide();
								}
							}
						}

						if ('undefined' !== typeof param.wd_dependency.value_not_equal_to) {
							if (param.wd_dependency.value_not_equal_to.includes(value)) {
								$this.hide();

								if ($this.parents('.wd-typography-wrapper')) {
									$this.parents('.wd-typography-wrapper').hide();
								}
							} else {
								$this.show();

								if ($this.parents('.wd-typography-wrapper')) {
									$this.parents('.wd-typography-wrapper').show();
								}
							}
						}
					}
				}

				if (param.dependency) {
					if (param.dependency.element === name) {
						if ('undefined' !== typeof param.dependency.value) {
							if (param.dependency.value.includes(value)) {
								if ($this.parents('.wd-typography-wrapper')) {
									$this.parents('.wd-typography-wrapper').removeClass('vc_dependent-hidden');
								}
							} else {
								if ($this.parents('.wd-typography-wrapper')) {
									$this.parents('.wd-typography-wrapper').addClass('vc_dependent-hidden');
								}
							}
						}

						if ('undefined' !== typeof param.dependency.value_not_equal_to) {
							if (param.dependency.value_not_equal_to.includes(value)) {
								if ($this.parents('.wd-typography-wrapper')) {
									$this.parents('.wd-typography-wrapper').addClass('vc_dependent-hidden');
								}
							} else {
								if ($this.parents('.wd-typography-wrapper')) {
									$this.parents('.wd-typography-wrapper').removeClass('vc_dependent-hidden');
								}
							}
						}
					}
				}
			});
		}
	});

	//Tooltips
	$panel.on('vcPanel.shown', function() {
		var $tooltips = $('.omniverse-css-tooltip');

		$tooltips.each(function() {
				var $label = $(this).find('.omniverse-tooltip-label');

				$label.remove();
				$(this).addClass('omniverse-tltp').prepend('<span class="omniverse-tooltip-label">' + $(this).data('text') + '</span>');
				$label.trigger('mouseover');
			})
			.off('mouseover.tooltips')
			.on('mouseover.tooltips', function() {
				var $label = $(this).find('.omniverse-tooltip-label'),
				    width  = $label.outerWidth();

				if ($('body').hasClass('rtl')) {
					$label.css({
						marginRight: -parseInt(width / 2)
					});
				} else {
					$label.css({
						marginLeft: -parseInt(width / 2)
					});
				}
			});
	});

	//Hint
	$panel.on('vcPanel.shown', function() {
		var $panel = $(this);

		$panel.find('.vc_shortcode-param').each(function() {
			var $this = $(this);
			var settings = $this.data('param_settings');

			if (typeof settings != 'undefined' && typeof settings.hint != 'undefined') {
				$this.find('.wpb_element_label').addClass('dn-with-hint').append('<div class="dn-hint"><div class="dn-tooltip">' + settings.hint + '</div></div>');
			}
		});

		$panel.find('.dn-hint').on('hover mouseover', function() {
			var $hint = $(this).find('.dn-tooltip');

			$hint.removeClass('dn-right dn-left');

			var hintPos = $hint.parent().offset().left - $panel.offset().left + $hint.outerWidth();
			var panelPos = $panel.find('.vc_ui-panel-content-container').width();

			if (hintPos < panelPos) {
				$hint.addClass('dn-right');
			} else {
				$hint.addClass('dn-left');
			}
		});

	});

	setTimeout( function () {
		$('#vc_add-new-element, #vc_no-content-add-element, #vc_not-empty-add-element, .vc_controls .vc_control[data-vc-control="add"]').on('click', function () {
			if ( ! omniverseConfig.wd_layout_type ) {
				return;
			}

			var $panel = $('#vc_ui-panel-add-element');

			if ($panel.hasClass('vc_active')){
				return;
			}

			var $tab = $('.dn-wpb-tab-title.dn-layout-' + omniverseConfig.wd_layout_type).parent();
			$panel.css('opacity', '0');

			setTimeout(function () {
				if ( 'none' !== $tab.parent('li').css('display') ) {
					$tab.trigger('click');
					$panel.find('#vc_elements_name_filter').trigger('focus');
				}
			}, 10);

			setTimeout(function () {
				$panel.css('opacity', '1');
			}, 350);
		});
	}, 1000);

})(jQuery);
