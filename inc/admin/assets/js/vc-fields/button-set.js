(function($) {
	$('#vc_ui-panel-edit-element').on('vcPanel.shown', function() {
		$('.omniverse-vc-button-set').each(function() {
			var $this = $(this);
			var currentValue = $this.find('.omniverse-vc-button-set-value').val();

			$this.find('[data-value="' + currentValue + '"]').addClass('dn-active');
		});

		$('.vc-button-set-item').on('click', function() {
			var $this = $(this);
			var value = $this.data('value');

			$this.addClass('dn-active');
			$this.siblings().removeClass('dn-active');
			$this.parents('.omniverse-vc-button-set').find('.omniverse-vc-button-set-value').val(value).trigger('change');
		});
	});
})(jQuery);
