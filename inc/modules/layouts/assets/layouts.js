/* global omniverseConfig */
(function($) {
	'use strict';

	var $wrapper = $('.wd-layout, #wd-layout-conditions');
	var $template = $wrapper.find('.dn-layout-condition-template');
	var $form = $wrapper.find('form');
	var $popup = $wrapper.find('.dn-popup');
	var allowSubmit = true;

	// Change status.
	$(document).on('click', '.column-wd_layout_status .dn-switcher-btn', function() {
		var $switcher = $(this);

		$switcher.addClass('dn-loading');

		$.ajax({
			url     : omniverseConfig.ajaxUrl,
			method  : 'POST',
			data    : {
				action  : 'wd_layout_change_status',
				id      : $switcher.data('id'),
				status  : 'publish' === $switcher.data('status') ? 'draft' : 'publish',
				security: omniverseConfig.get_new_template_nonce
			},
			dataType: 'json',
			success : function(response) {
				$switcher.replaceWith(response.new_html);
			},
			error   : function() {
				$popup.find('.dn-layout-popup-notices').text('');
				$popup.find('.dn-layout-popup-notices').append('<div class="dn-notice dn-warning">Something went wrong with the creation of the layout!</div>');
				$popup.removeClass('dn-loading');
			}
		});
	});

	// Form.
	$form.on('submit', function(e) {
		e.preventDefault();

		if (allowSubmit) {
			allowSubmit = false;
		} else {
			return false;
		}

		var data = [];
		var layoutType = $form.find('.dn-layout-type').val();
		var layoutName = $form.find('.dn-layout-name').val();

		$form.find('.dn-layout-condition').each(function() {
			var $condition = $(this);
			data.push({
				condition_comparison: $condition.find('.dn-layout-condition-comparison').val(),
				condition_type      : $condition.find('.dn-layout-condition-type').val(),
				condition_query     : $condition.find('.dn-layout-condition-query').val()
			});
		});

		$popup.addClass('dn-loading');

		$.ajax({
			url     : omniverseConfig.ajaxUrl,
			method  : 'POST',
			data    : {
				action         : 'wd_layout_create',
				data           : data,
				type           : layoutType,
				name           : layoutName,
				predefined_name: $form.find('.dn-layout-predefined-layout.dn-active').data('name'),
				security       : omniverseConfig.get_new_template_nonce
			},
			dataType: 'json',
			success : function(response) {
				window.location.href = response.redirect_url;
			},
			error   : function() {
				$popup.find('.dn-layout-popup-notices').text('');
				$popup.find('.dn-layout-popup-notices').append('<div class="dn-notice dn-warning">Something went wrong with the creation of the layout!</div>');
				$popup.removeClass('dn-loading');
			}
		});
	});

	// Change layout type.
	$form.find('.dn-layout-type').on('change', function() {
		var layoutType = $(this).val();

		$form.find('.dn-layout-condition').remove();

		$('.dn-layout-predefined-layouts').addClass('dn-hidden');
		$('.dn-layout-predefined-layout').removeClass('dn-active');

		if (!layoutType) {
			$wrapper.find('.dn-layout-condition-add').addClass('dn-hidden');
			$wrapper.find('.dn-layout-submit').addClass('dn-disabled');
			$wrapper.find('.dn-layout-conditions-title').addClass('dn-hidden');
		} else {
			$wrapper.find('.dn-layout-condition-add').removeClass('dn-hidden');
			$wrapper.find('.dn-layout-conditions-title').removeClass('dn-hidden');
			$wrapper.find('.dn-layout-submit').removeClass('dn-disabled');
			$wrapper.find('.dn-layout-condition-add').trigger('click');

			$('.dn-layout-predefined-layouts[data-type="' + layoutType + '"]').removeClass('dn-hidden');
		}

		if ('cart' === layoutType || 'checkout_form' === layoutType || 'checkout_content' === layoutType) {
			$wrapper.find('.dn-layout-condition-add').addClass('dn-hidden');
			$wrapper.find('.dn-layout-conditions-title').addClass('dn-hidden');
			$form.find('.dn-layout-condition').addClass('dn-hidden');
		}
	});

	// Change condition type.
	$(document).on('change', '.dn-layout-condition-type', function() {
		var $this = $(this);
		var conditionType = $this.val();
		var $querySelect = $this.siblings('.dn-layout-condition-query');

		if ($querySelect.data('select2')) {
			$querySelect.val('');
			$querySelect.select2('destroy');
		}

		if ('all' === conditionType || 'shop_page' === conditionType || 'product_search' === conditionType || 'product_cats' === conditionType || 'product_tags' === conditionType || 'checkout_form' === conditionType || 'checkout_content' === conditionType || 'cart' === conditionType || 'filtered_product_term_any' === conditionType) {
			$querySelect.addClass('dn-hidden');
			$querySelect.removeAttr('data-query-type');
		} else {
			$querySelect.removeClass('dn-hidden');
			$querySelect.attr('data-query-type', conditionType);
			conditionQuerySelect2($querySelect);
		}
	});

	// Condition query select2.
	function conditionQuerySelect2($field) {
		$field.select2({
			ajax             : {
				url     : omniverseConfig.ajaxUrl,
				data    : function(params) {
					return {
						action    : 'wd_layout_conditions_query',
						security  : omniverseConfig.get_new_template_nonce,
						query_type: $field.attr('data-query-type'),
						search    : params.term
					};
				},
				method  : 'POST',
				dataType: 'json'
			},
			theme            : 'dn',
			dropdownAutoWidth: false,
			width            : 'resolve'
		});
	}

	// Condition add.
	$wrapper.find('.dn-layout-condition-add').on('click', function() {
		var layoutType = $form.find('.dn-layout-type').val();
		var $templateClone = $template.clone();

		$templateClone.find('.dn-layout-condition-type[data-type="' + layoutType + '"]').siblings('.dn-layout-condition-type').remove();

		$wrapper.find('.dn-layout-conditions .dn-layout-conditions-title').after($templateClone.html());
	});

	// Conditions edit add.
	$(document).on('click', '.dn-layout-conditions-edit-add', function() {
		var $this = $(this);
		var $wrapper = $this.parent();
		var layoutType = $wrapper.data('type');
		var $templateClone = $template.clone();

		$templateClone.find('.dn-layout-condition-type[data-type="' + layoutType + '"]').siblings('.dn-layout-condition-type').remove();

		$this.before($templateClone.html());
	});

	// Conditions edit.
	$(document).on('click', '.dn-layout-conditions-edit', function() {
		var $this = $(this);
		var $wrapper = $this.parents('.dn-popup-holder').find('.dn-layout-conditions');

		$this.parents('.dn-popup-holder').find('.dn-layout-popup-notices').text('');

		if ($wrapper.hasClass('dn-inited')) {
			return;
		}

		var conditions = $wrapper.data('conditions');
		var layoutType = $wrapper.data('type');

		if (conditions) {
			conditions.forEach(function(condition) {
				var $templateClone = $template.clone();

				$templateClone.find('.dn-layout-condition-type[data-type="' + layoutType + '"]').siblings('.dn-layout-condition-type').remove();

				$templateClone.find('.dn-layout-condition').attr('data-condition', JSON.stringify(condition));

				$wrapper.find('.dn-layout-conditions-edit-add').before($templateClone.html());
			});
		}

		$wrapper.find('.dn-layout-condition').each(function() {
			var $this = $(this);
			var condition = $this.data('condition');

			if (condition) {
				$this.find('.dn-layout-condition-comparison').val(condition.condition_comparison).trigger('change');
				$this.find('.dn-layout-condition-type').val(condition.condition_type).trigger('change');

				if (condition.condition_query_text) {
					$this.find('.dn-layout-condition-query').append('<option value="' + condition.condition_query + '">' + condition.condition_query_text + '</option>').val(condition.condition_query).trigger('change');
				}
			}
		});

		$wrapper.find('.dn-layout-conditions-edit-save').removeClass('dn-hidden');
		$wrapper.find('.dn-layout-conditions-edit-add').removeClass('dn-hidden');
		$wrapper.addClass('dn-inited');
	});

	// Conditions save.
	$(document).on('click', '.dn-layout-conditions-edit-save', function() {
		var $this = $(this);
		var $wrapper = $this.parents('.wd_layout_conditions, #wd-layout-conditions');
		var $popup = $wrapper.find('.dn-popup');
		var $conditionsWrapper = $wrapper.find('.dn-layout-conditions');

		var data = [];

		$wrapper.find('.dn-popup-holder .dn-layout-condition').each(function() {
			var $condition = $(this);
			data.push({
				condition_comparison: $condition.find('.dn-layout-condition-comparison').val(),
				condition_type      : $condition.find('.dn-layout-condition-type').val(),
				condition_query     : $condition.find('.dn-layout-condition-query').val()
			});
		});

		$popup.addClass('dn-loading');

		$.ajax({
			url     : omniverseConfig.ajaxUrl,
			method  : 'POST',
			data    : {
				action  : 'wd_layout_edit',
				data    : data,
				id      : $conditionsWrapper.data('id'),
				security: omniverseConfig.get_new_template_nonce
			},
			dataType: 'json',
			success : function() {
				$popup.find('.dn-layout-popup-notices').text('');
				$popup.find('.dn-layout-popup-notices').append('<div class="dn-notice dn-success">Conditions has been successfully saved!</div>');
				$popup.removeClass('dn-loading');
			},
			error   : function() {
				$popup.find('.dn-layout-popup-notices').text('');
				$popup.find('.dn-layout-popup-notices').append('<div class="dn-notice dn-warning">Something went wrong with editing the layout!</div>');
				$popup.removeClass('dn-loading');
			}
		});
	});

	// Condition remove.
	$(document).on('click', '.dn-layout-condition-remove', function() {
		$(this).parent().remove();
	});

	// Predefined.
	$('.dn-layout-predefined-layout').on('click', function() {
		var $this = $(this);
		$this.siblings().removeClass('dn-active');
		$this.toggleClass('dn-active');
	});

	// Popup.
	$('.page-title-action, .menu-icon-omniverse_layout li:not(.current) a').on('click', function(event) {
		event.preventDefault();
		$wrapper.find('.dn-popup-holder').addClass('dn-opened');
		$('html').addClass('dn-popup-opened');
		$form.find('.dn-layout-type').trigger('change');

		setTimeout(function() {
			var $input = $form.find('.dn-layout-name');
			var strLength = $input.val().length;
			$input.trigger('focus');
			$input[0].setSelectionRange(strLength, strLength);
		}, 100);
	});
	$(document).on('click', '.dn-popup-opener', function() {
		$(this).parent().addClass('dn-opened');
		$('html').addClass('dn-popup-opened');
	});
	$(document).on('click', '.dn-popup-close, .dn-popup-overlay', function() {
		$('.dn-popup-holder').removeClass('dn-opened');
		$('html').removeClass('dn-popup-opened');
	});
})(jQuery);