(function($) {
	$('#vc_ui-panel-edit-element').on('vcPanel.shown', function() {
		$('.dn-numbers').each(function() {
			let $wrapper = $(this);

			$wrapper.find('.wd-device').on('click', function() {
				let $this = $(this);

				updateActiveClass($this);
				updateActiveClass($wrapper.find('.dn-number[data-device="' + $this.data('value') + '"]'));
			});

			$wrapper.find('.dn-number').each(function() {
				let $this = $(this);

				$this.on('change', function() {
					setMainValue();
				}).trigger('change');
			});

			function setMainValue() {
				let $valueInput = $wrapper.find('.wpb_vc_param_value');
				let sliderSettings = $valueInput.data('settings');

				if ('undefined' === typeof sliderSettings.selectors) {
					return;
				}

				let $results = {
					devices : {}
				};

				var flag = false;

				$wrapper.find('.dn-number').each(function() {
					let $this = $(this);

					if ( $this.val() ) {
						flag = true;
					}

					$results.devices[$this.attr('data-device')] = {
						value: $this.val()
					};
				});

				if ( flag ) {
					$valueInput.attr('value', window.btoa(JSON.stringify($results)));
				} else {
					$valueInput.attr('value', '');
				}
			}
		});

		function updateActiveClass($this) {
			$this.siblings().removeClass('dn-active');
			$this.addClass('dn-active');
		}
	});
})(jQuery);
