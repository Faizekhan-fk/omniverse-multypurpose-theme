/* global omniverseConfig */

(function($) {
	'use strict';

	$(document).on('change', '.dn-bought-together-controls select', function(e) {
		var $this = $(this);
		var $wrapper = $this.parents('.dn-bought-together');
		var $input = $this.siblings('.dn-product-bundles-id');
		var bundlesID = $input.val();
		var value = $this.val();

		if ( bundlesID ) {
			var $ids = bundlesID.split(',');

			if ( $ids.includes( value ) ) {
				$this.val('').trigger('change.select2');

				return;
			}

			bundlesID += ',' + value;
		} else {
			bundlesID = value;
		}

		$wrapper.addClass('dn-loading');

		$.ajax({
			url    : omniverseConfig.ajaxUrl,
			method : 'POST',
			data   : {
				action    : 'zs_get_bundles_settings_content',
				bundles_id: bundlesID,
				product_id: $input.data('product-id'),
				security  : $input.data('nonce'),
			},
			success: function(response) {
				$wrapper.find('.wp-list-table tbody').html(response.content);
				$this.val('').trigger('change.select2');
				$input.val(bundlesID);
				$wrapper.removeClass('dn-loading');
			}
		});
	});

	$(document).on('click', '.dn-bought-together .dn-delete-bundle', function(e) {
		e.preventDefault();

		var $this = $(this);
		var $wrapper = $this.parents('.dn-bought-together');
		var $input = $wrapper.find('.dn-product-bundles-id');
		var bundlesID = $input.val();
		var id = $this.data('id').toString();

		if ( bundlesID ) {
			var $ids = bundlesID.split(',');
			var index = $ids.indexOf(id);

			if (index > -1) {
				$ids.splice(index, 1);
				bundlesID = $ids.join(',');

				$wrapper.addClass('dn-loading');

				$.ajax({
					url    : omniverseConfig.ajaxUrl,
					method : 'POST',
					data   : {
						action    : 'zs_get_bundles_settings_content',
						bundles_id: bundlesID,
						product_id: $input.data('product-id'),
						security  : $input.data('nonce'),
					},
					success: function(response) {
						$wrapper.find('.wp-list-table tbody').html(response.content);
						$wrapper.removeClass('dn-loading');
						$input.val(bundlesID);
					}
				});
			}
		}
	});

})(jQuery);