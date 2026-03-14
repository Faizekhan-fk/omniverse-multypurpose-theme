/* global jQuery, omniverseConfig */

(function($) {
	'use strict';

	function optionsPresets() {
		$('.dn-preset').each(function() {
			var $preset = $(this);
			var presetID = $preset.data('id');

			$preset.on('click', '.dn-preset-edit', function(e) {
				e.preventDefault();

				$preset.toggleClass('dn-opened');
			});

			$preset.on('click', '.dn-preset-save', function(e) {
				e.preventDefault();

				var data = [];

				$preset.find('.dn-condition').each(function() {
					var $condition = $(this);

					data.push({
						type      : $condition.find('.dn-condition-type select').val(),
						comparison: $condition.find('.dn-condition-comparison select').val(),
						post_type : $condition.find('.dn-condition-post-type select').val(),
						taxonomy  : $condition.find('.dn-condition-taxonomy select').val(),
						custom    : $condition.find('.dn-condition-custom select').val(),
						value_id  : $condition.find('.dn-condition-value-id').val(),
						user_role : $condition.find('.dn-condition-user-role select').val()
					});
				});

				$preset.addClass('dn-loading');

				$.ajax({
					url     : omniverseConfig.ajaxUrl,
					method  : 'POST',
					data    : {
						action   : 'zs_save_preset_action',
						data     : data,
						priority : $preset.find('.dn-priority').val(),
						name     : $preset.find('.dn-preset-name input').val(),
						preset_id: presetID,
						security : omniverseConfig.presets_nonce
					},
					dataType: 'json',
					success : function(response) {
						$('.dn-notices-wrapper').html('<div class="dn-notice dn-success">' + response.data.message + '</div>');
						$preset.removeClass('dn-loading');
					}
				});
			});

			$preset.on('submit', '.dn-preset-remove-form', function(e){
				var choice = confirm('Are you sure you want to remove the this preset?');

				if (!choice) {
					e.preventDefault();
				}
			});

			$preset.on('click', '.dn-preset-add-condition', function(e) {
				e.preventDefault();
				var $template = $('.dn-condition-template').clone();

				$template.find('.dn-condition').removeClass('dn-hidden');
				$preset.find('.dn-preset-add-condition').before($template.html());
				initSelect2();
			});

			$preset.on('click', '.dn-condition-remove', function(e) {
				e.preventDefault();
				$(this).parent().remove();
			});

			$preset.on('change', '.dn-condition-type select', function() {
				var $type = $(this);
				var $condition = $type.parents('.dn-condition');
				var $postType = $condition.find('.dn-condition-post-type');
				var $taxonomy = $condition.find('.dn-condition-taxonomy');
				var $custom = $condition.find('.dn-condition-custom');
				var $valueID = $condition.find('.dn-condition-value-wrapper');
				var $userRole = $condition.find('.dn-condition-user-role');
				var type = $type.val();

				switch (type) {
					case 'post_type':
						$postType.removeClass('dn-hidden');
						$taxonomy.addClass('dn-hidden');
						$custom.addClass('dn-hidden');
						$valueID.addClass('dn-hidden');
						$userRole.addClass('dn-hidden');
						break;
					case 'taxonomy':
						$postType.addClass('dn-hidden');
						$taxonomy.removeClass('dn-hidden');
						$custom.addClass('dn-hidden');
						$valueID.addClass('dn-hidden');
						$userRole.addClass('dn-hidden');
						break;
					case 'post_id':
					case 'term_id':
					case 'single_posts_term_id':
						$postType.addClass('dn-hidden');
						$taxonomy.addClass('dn-hidden');
						$custom.addClass('dn-hidden');
						$valueID.removeClass('dn-hidden');
						$userRole.addClass('dn-hidden');
						break;
					case 'custom':
						$postType.addClass('dn-hidden');
						$taxonomy.addClass('dn-hidden');
						$custom.removeClass('dn-hidden');
						$valueID.addClass('dn-hidden');
						$userRole.addClass('dn-hidden');
						break;
					case 'user_role':
						$postType.addClass('dn-hidden');
						$taxonomy.addClass('dn-hidden');
						$custom.addClass('dn-hidden');
						$valueID.addClass('dn-hidden');
						$userRole.removeClass('dn-hidden');
						break;

					case '':
						$postType.addClass('dn-hidden');
						$taxonomy.addClass('dn-hidden');
						$custom.addClass('dn-hidden');
						$valueID.addClass('dn-hidden');
						$userRole.addClass('dn-hidden');
						break;
				}
			});

			initSelect2();

			function initSelect2() {
				if (typeof ($.fn.select2) === 'undefined') {
					return;
				}

				$preset.find('.dn-preset-conditions .dn-condition').each(function() {
					var $condition = $(this);

					$condition.find('.dn-condition-value-id').select2({
						ajax             : {
							url     : omniverseConfig.ajaxUrl,
							data    : function(params) {
								return {
									action  : 'zs_get_entity_ids_action',
									type    : $condition.find('.dn-condition-type select').val(),
									security: omniverseConfig.presets_nonce,
									name    : params.term
								};
							},
							method  : 'POST',
							dataType: 'json'
						},
						theme            : 'dn',
						dropdownAutoWidth: false,
						width            : 'resolve'
					});
				});
			}
		});
	}

	jQuery(document).ready(function() {
		optionsPresets();
	});
})(jQuery);