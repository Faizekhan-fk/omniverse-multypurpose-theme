(function($) {
	var $panel = $('#vc_ui-panel-edit-element');
	$panel.on('vcPanel.shown', function() {
		$wrapperPanel = $(this);

		$('.vc_wrapper-param-type-css_editor .vc_layout-onion').addClass('dn-active');
		$('.dn-layout-onion-tabs > span').on('click', function() {
			var $this = $(this);
			var device = $this.data('value');

			$this.siblings().removeClass('dn-active');
			$this.addClass('dn-active');
			if ('desktop' === device) {
				$wrapperPanel.find('.vc_layout-onion').removeClass('dn-active');
				$wrapperPanel.find('.vc_wrapper-param-type-css_editor .vc_layout-onion').addClass('dn-active');
			} else {
				$wrapperPanel.find('.vc_layout-onion').removeClass('dn-active');
				$wrapperPanel.find('.vc_layout-onion[data-device="' + device + '"]').addClass('dn-active');
			}
		});

		$('.wd-responsive-spacing-wrapper').each(function() {
			var $this = $(this);
			setInputsValue($this);
			setMainValue($this);
		});

		$('.wd-responsive-spacing input').on('change', function() {
			var $wrapper = $(this).parents('.wd-responsive-spacing-wrapper');
			setMainValue($wrapper);
		});

		function setMainValue($this) {
			var $mainInput = $this.find('.wd-responsive-spacing-value');
			var results = {
				param_type : 'omniverse_responsive_spacing',
				selector_id: $('.omniverse-css-id').val(),
				shortcode  : $panel.attr('data-vc-shortcode'),
				data       : {}
			};

			$this.find('.wd-responsive-spacing').each(function() {
				var $this = $(this);
				var device = $this.data('device');

				results.data[device] = {};

				$this.find('input').each(function(index, elm) {
					var $elm = $(elm);
					var value = $elm.val();
					var name = $elm.data('name');

					if (value) {
						Object.assign(results.data[device], {
							[name]: value
						});
					}
				});
			});

			if ($.isEmptyObject(results.data)) {
				results = '';
			} else {
				results = window.btoa(JSON.stringify(results));
			}

			$mainInput.val(results).trigger('change');
		}

		function setInputsValue($this) {
			var $mainInput = $this.find('.wd-responsive-spacing-value');
			var mainInputVal = $mainInput.val();

			if (mainInputVal) {
				var parseVal = JSON.parse(window.atob(mainInputVal));

				$.each(parseVal.data, function(key, value) {
					var device = key;
					if (value) {
						$.each(value, function(key, value) {
							if (!value.includes('px') && !value.includes('%') && !value.includes('vh') && !value.includes('vw')) {
								value += 'px';
							}

							$this.find('[data-device="' + device + '"]').find('[data-name="' + key + '"]').val(value);
						});
					}
				});
			}
		}
	});

})(jQuery);
