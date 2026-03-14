/* global dnAdminWishlistSettings */
(function($) {
	const omniverseWishlist = function() {
		function selectControl() {
			if ( typeof ($.fn.select2) === 'undefined' ) {
				return;
			}

			var $select = $('.wc-product-search');

			if ($select.length > 0) {
				$select.each(function() {
					var $field = $(this);

					if ($field.hasClass('dn-field-inited')) {
						return;
					}

					$field.select2({
						theme: 'dn',
						placeholder: 'Select a product',
						allowClear: true,
						ajax: {
							url: ajaxurl,
							data: function (params) {
								return {
									term : params.term,
									action : 'woocommerce_json_search_products_and_variations',
									security: $(this).attr('data-security'),
								};
							},
							processResults: function( data ) {
								var terms = [];
								if ( data ) {
									$.each( data, function( id, text ) {
										terms.push( { id: id, text: text } );
									});
								}
								return {
									results: terms
								};
							},
							cache: true
						},
						minimumInputLength: 3,
					});

					$field.addClass('dn-field-inited');
				});
			}
		}

		function userSelectControl() {
			if ( typeof ($.fn.select2) === 'undefined' ) {
				return;
			}

			var $select = $('.dn-users-search');

			if ($select.length > 0) {
				$select.each(function() {
					var $field = $(this);

					if ($field.hasClass('dn-field-inited')) {
						return;
					}

					$field.select2({
						theme: 'dn',
						placeholder: 'Select a user',
						allowClear: true,
						ajax: {
							url: ajaxurl,
							data: function (params) {
								return {
									term : params.term,
									action : 'omniverse_json_search_users',
									security : $(this).attr('data-security'),
								};
							},
							processResults: function(data) {
								var terms = [];

								if (data) {
									$.each( data, function( id, text ) {
										terms.push( { id: id, text: text } );
									});
								}

								return {
									results: terms
								};
							},
							cache: true
						},
						minimumInputLength: 3,
					});

					$field.addClass('dn-field-inited');
				});
			}
		}

		function dateControl() {
			if ( typeof ($.fn.datepicker) === 'undefined' ) {
				return;
			}

			var $dateInput = $('.date-picker');

			if ($dateInput.length > 0) {
				$dateInput.each(function(  ) {
					$(this).datepicker();
				});
			}
		}

		function createPromotion() {
			$('#doaction, #doaction2').on('click', function( e ) {
				if ( 'create-promotion' !== $('#bulk-action-selector-top').val() ) {
					return;
				}

				if ( ! confirm( dnAdminWishlistSettings.send_promotional_confirm_text ) ) {
					e.preventDefault();
				}
			});

			$('.wd-create-promotion').on('click', function(e) {
				if ( $(this).hasClass('dn-disabled') || ! confirm( dnAdminWishlistSettings.send_promotional_confirm_text ) ) {
					e.preventDefault();
				}
			});
		}

		return {
			init: function() {
				selectControl();
				userSelectControl();
				dateControl();
				createPromotion();
			}
		}
	}

	$(document).ready(function() {
		omniverseWishlist().init();
	});
})(jQuery);
