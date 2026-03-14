(function ($) {
	$(document).ready(function() {
		let urlParams  = new URLSearchParams(window.location.search);
		let currentTab = urlParams.has('tab') ? urlParams.get('tab') : 'billing';

		$('table.dn-ui-sortable tbody').sortable({
			handle: ".dn-ui-sortable-handle",
			cursor: "move",
			axis: "y",
			scrollSensitivity: 40,
			stop: function( event, ui ) {
				let $fieldsList = $(this);
				let $table = $fieldsList.closest('table');
				let sortedFields = [];

				$fieldsList.children().each( function(key, element) {
					let $element = $(element);

					sortedFields.push($element.data('field-id'));
				});

				$table.addClass('dn-loading');

				$.ajax({
					url      : omniverseConfig.ajaxUrl,
					method   : 'POST',
					data     : {
						'action'        : 'save_fields_order',
						'sorted_fields' : sortedFields,
						'current_tab'   : currentTab,
						'security'      : omniverseConfig.checkout_fields_manager_nonce
					},
					dataType : 'json',
					error    : function(error) {
						console.error(error);
					},
					complete: function() {
						$table.removeClass('dn-loading');
					}
				});
			}
		});

		$(document).on('click', '.required .dn-switcher-btn, .status .dn-switcher-btn', function(e) {
			e.preventDefault();

			let $switcher = $(this);
			let $column   = $switcher.parent();
			let action    = '';

			if ( $column.hasClass('required') ) {
				action = 'save_fields_required';
			} else if ( $column.hasClass('status') ) {
				action = 'save_fields_status';
			}

			if ( 0 === action.length ) {
				return;
			}

			$switcher.addClass('dn-loading');

			$.ajax({
				url    : omniverseConfig.ajaxUrl,
				method : 'POST',
				data   : {
					'action'      : action,
					'field_name'  : $switcher.data('id'),
					'status'      : $switcher.data('status') ? '0' : '1',
					'current_tab' : currentTab,
					'security'    : omniverseConfig.checkout_fields_manager_nonce
				},
				dataType: 'json',
				success : function(response) {
					$switcher.replaceWith(response.new_html);
				},
				error   : function(error) {
					console.error(error);
				}
			});
		});

		$(document).on('change', '.position select', function(e) {
			e.preventDefault();

			let $select   = $(this);
			let $table    = $select.closest('table');
			let $position = $select.val();

			$table.addClass('dn-loading');

			$.ajax({
				url    : omniverseConfig.ajaxUrl,
				method : 'POST',
				data   : {
					'action'      : 'save_fields_position',
					'field_name'  : $select.data('id'),
					'position'    : $position,
					'current_tab' : currentTab,
					'security'    : omniverseConfig.checkout_fields_manager_nonce
				},
				dataType: 'json',
				success : function(response) {
					$select.replaceWith(response.new_html);
				},
				error   : function(error) {
					console.error(error);
				},
				complete: function() {
					$table.removeClass('dn-loading');
				}
			});
		});
	});
})(jQuery);
