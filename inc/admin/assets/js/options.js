var omniverseOptions;

/* global jQuery, wp, dnTypography, WebFont */

(function($) {
	'use strict';

	omniverseOptions = (function() {

		var omniverseOptionsAdmin = {
			optionsPage: function() {
				var $options = $('.dn-options'),
				    $lastTab = $options.find('.dn-last-tab-input');

				$options.on('click', '.dn-nav-vertical a', function(e) {
					e.preventDefault();
					var $btn = $(this),
					    id   = $btn.data('id');

					$options.find('.dn-active-nav').removeClass('dn-active-nav');

					$options.find('.dn-section.dn-section').removeClass('dn-active-section').addClass('dn-hidden');

					if ($btn.parent().hasClass('dn-has-child')) {
						$btn.parent().addClass('dn-active-nav');

						id = $btn.parent().find('.dn-sub-menu-item').first().find('> a').data('id');
					}

					$options.find('.dn-section[data-id="' + id + '"]').addClass('dn-active-section').removeClass('dn-hidden');

					$options.find('a[data-id="' + id + '"]').parent().addClass('dn-active-nav');

					if ($btn.parent().hasClass('dn-sub-menu-item')) {
						$btn.parent().parent().parent().addClass('dn-active-nav');
					}

					$lastTab.val(id);

					omniverseOptionsAdmin.editorControl();

					$(document).trigger('zs_section_changed');
				});
				$(document).trigger('zs_section_changed');

				omniverseOptionsAdmin.editorControl();

				$options.on('click', '.dn-reset-options-btn', function(e) {
					return confirm(
						'Are you sure you want to reset ALL settings (not only this section) to default values? This process cannot be undone. Continue?');
				});

				$('.toplevel_page_zs_theme_settings').parent().find('li a').on('click', function(e) {
					var $this   = $(this),
					    href    = $this.attr('href'),
					    section = false;

					if (href) {
						var hrefParts = href.split('tab=');
						if (hrefParts[1]) {
							section = hrefParts[1];
						}
					}

					if (!section) {
						return true;
					}

					var $sectionLink = $('.dn-nav-vertical [data-id="' + section + '"]');

					if ($sectionLink.length == 0) {
						return true;
					}

					e.preventDefault();

					$sectionLink.trigger('click');

					$this.parent().parent().find('.current').removeClass('current');
					$this.parent().addClass('current');

				});
			},

			switcherControl: function() {
				var $switchers = $('.dn-active-section .dn-switcher-control, .dn-active-section .dn-checkbox-control');

				if ($switchers.length <= 0) {
					return;
				}

				$switchers.each(function() {
					var $field    = $(this),
					    $switcher = $field.find('.dn-switcher-btn'),
					    $input    = $field.find('input[type="hidden"]'),
					    $notice   = $switcher.siblings('.dn-field-notice');


					if ($field.hasClass('dn-field-inited')) {
						return;
					}

					$switcher.on('click', function() {
						if ($switcher.hasClass('dn-active')) {
							$input.val($switcher.data('off')).trigger('change');
							$switcher.removeClass('dn-active');
							$notice.addClass('dn-hidden');
						} else {
							$input.val($switcher.data('on')).trigger('change');
							$switcher.addClass('dn-active');
							$notice.removeClass('dn-hidden');
						}
					});

					$field.addClass('dn-field-inited');
				});
			},

			buttonsControl: function() {
				var $sets = $('.dn-buttons-control');

				$sets.each(function() {
					var $set   = $(this),
					    $input = $set.find('input[type="hidden"]');

					if ($set.hasClass('dn-field-inited')) {
						return;
					}

					$set.addClass('dn-field-inited');

					$set.on('click', '.dn-set-item', function() {
						var $btn = $(this);

						if ($btn.hasClass('dn-active') && $btn.parent().hasClass('dn-with-deselect') ) {
							$btn.removeClass('dn-active');
							$input.val('').trigger('change');

							return;
						}
						if ($btn.hasClass('dn-active')) {
							return;
						}
						var val = $btn.data('value');

						$set.find('.dn-active').removeClass('dn-active');

						$btn.addClass('dn-active');

						$input.val(val).trigger('change');
					});
				});
			},

			colorControl: function() {
				var $colors = $('.dn-active-section .dn-color-control');

				if ($colors.length <= 0) {
					return;
				}

				$colors.each(function() {
					var $color = $(this),
					    $input = $color.find('input[type="text"]');

					if ($color.hasClass('dn-field-inited')) {
						return;
					}

					$input.wpColorPicker();

					$color.addClass('dn-field-inited');
				});
			},

			uploadControl: function(force_init) {
				var $uploads = $('.dn-active-section .dn-upload-control, .form-table .dn-upload-control');

				if (force_init) {
					$uploads = $('.widget-content .dn-upload-control');
				}

				if ($uploads.length <= 0) {
					return;
				}

				$uploads.each(function() {
					var $upload       = $(this),
					    $removeBtn    = $upload.find('.dn-remove-upload-btn'),
					    $inputURL     = $upload.find('input.dn-upload-input-url'),
					    $inputID      = $upload.find('input.dn-upload-input-id'),
					    $preview      = $upload.find('.dn-upload-preview'),
					    $previewInput = $upload.find('.dn-upload-preview-input');

					if ($upload.hasClass('dn-field-inited') && !force_init || $upload.parents('.dn-custom-fonts-template.hide').length) {
						return;
					}

					$upload.off('click').on('click', '.dn-upload-btn, img', function(e) {
						e.preventDefault();

						var custom_uploader = wp.media({
							title   : 'Insert file',
							button  : {
								text: 'Use this file' // button label text
							},
							multiple: false // for multiple image selection set
							// to true
						}).on('select', function() { // it also has "open" and "close" events
							var attachment = custom_uploader.state().get('selection').first().toJSON();
							$inputID.val(attachment.id);
							$inputURL.val(attachment.url).trigger('change');
							$preview.find('img').remove();
							$previewInput.val(attachment.url);
							$preview.prepend(
								'<img src="' + attachment.url + '" />');
							$removeBtn.addClass('dn-active');
						}).open();
					});

					$removeBtn.on('click', function(e) {
						e.preventDefault();

						if ($preview.find('img').length == 1) {
							$preview.find('img').remove();
						}

						$previewInput.val('');
						$inputID.val('');
						$inputURL.val('');
						$removeBtn.removeClass('dn-active');
					});

					$upload.addClass('dn-field-inited');
				});
			},

			uploadListControl: function(force_init) {
				var $uploads = $('.dn-active-section .dn-upload_list-control');

				if (force_init) {
					$uploads = $('.widget-content .dn-upload_list-control');
				}

				if ($uploads.length <= 0) {
					return;
				}

				$uploads.each(function() {
					var $upload = $(this);
					var $inputID = $upload.find('input.dn-upload-input-id');
					var $preview = $upload.find('.dn-upload-preview');
					var $clearBtn = $upload.find('.dn-btn-remove');

					if ($upload.hasClass('dn-field-inited') && !force_init) {
						return;
					}

					$upload.off('click').on('click', '.dn-upload-btn, img', function(e) {
						e.preventDefault();

						var custom_uploader = wp.media({
							title   : 'Insert file',
							button  : {
								text: 'Use this file' // button label text
							},
							multiple: true // for multiple image selection set
							// to true
						}).on('select', function() { // it also has "open" and "close" events
							var attachments = custom_uploader.state().get('selection');
							var inputIdValue = $inputID.val();

							attachments.map(function(attachment) {
								attachment = attachment.toJSON();

								if (attachment.id) {
									var attachment_image = attachment.sizes &&
									attachment.sizes.thumbnail
										? attachment.sizes.thumbnail.url
										: attachment.url;
									inputIdValue = inputIdValue ? inputIdValue +
										',' + attachment.id : attachment.id;

									$preview.append(
										'<div data-attachment_id="' +
										attachment.id + '"><img src="' +
										attachment_image +
										'"><a href="#" class="dn-remove"><span class="dn-i-close"></span></a></div>');
								}
							});

							$inputID.val(inputIdValue).trigger('change');
							$clearBtn.addClass('dn-active');
						}).open();
					});

					$preview.on('click', '.dn-remove', function(e) {
						e.preventDefault();
						$(this).parent().remove();

						var attachmentIds = '';

						$preview.find('div').each(function() {
							var attachmentId = $(this).attr('data-attachment_id');
							attachmentIds = attachmentIds + attachmentId + ',';
						});

						$inputID.val(attachmentIds).trigger('change');

						if (!attachmentIds) {
							$clearBtn.removeClass('dn-active');
						}
					});

					$clearBtn.on('click', function(e) {
						e.preventDefault();
						$preview.empty();
						$inputID.val('').trigger('change');
						$clearBtn.removeClass('dn-active');
					});

					$upload.addClass('dn-field-inited');
				});
			},

			selectControl: function(force_init) {
				if ( typeof ($.fn.select2) === 'undefined' ) {
					return;
				}

				var $select = $('.dn-active-section .dn-select.dn-select2:not(.dn-autocomplete)');

				if (force_init) {
					$select = $('.widget-content .dn-select.dn-select2:not(.dn-autocomplete)');
				}

				if ($select.length > 0) {
					var select2Defaults = {
						width      : '100%',
						allowClear : true,
						theme      : 'dn',
						tags       : true,
						placeholder: 'Select'
					};

					$select.each(function() {
						var $select2 = $(this);

						if ($select2.hasClass('dn-field-inited')) {
							return;
						}

						if ($select2.attr('multiple')) {
							$select2.on('select2:select', function(e) {
								var $elm = $(e.params.data.element);

								$(this).find('option[value=""]')
									.prop('selected', false);

								$elm.attr('selected', 'selected');
								$select2.append($elm);
								$select2.trigger('change.select2');
							});

							$select2.on('select2:unselect', function(e) {
								var $this = $(this);
								var $elm  = $(e.params.data.element);

								$elm.removeAttr('selected');
								$select2.trigger('change.select2');

								if ( 0 === $this.find('option[selected="selected"]').length ) {
									$this.find('option[value=""]')
										.prop('selected', 'selected');
								}
							});

							$select2.parent().find('.dn-select2-all').on('click', function(e) {
								e.preventDefault();

								$select2.select2('destroy')
									.find('option')
									.each( function (key, option) {
										var $option = $(option);

										if ( 0 === $option.val().length ) {
											$option.prop('selected', false);
										} else {
											$option.attr('selected', 'selected');
											$option.prop('selected', 'selected');
										}
									})
									.end()
									.select2(select2Defaults);
							});

							$select2.parent().find('.dn-unselect2-all').on('click', function(e) {
								e.preventDefault();

								$select2.select2('destroy')
									.find('option')
									.each( function (key, option) {
										var $option = $(option);

										if ( 0 === $option.val().length ) {
											$option.prop('selected', 'selected');
										} else {
											$option.attr('selected', false);
											$option.prop('selected', false);
										}
									})
									.end()
									.select2(select2Defaults);
							});
						}

						if ($select2.parents('#widget-list').length > 0) {
							return;
						}

						$select2.select2(select2Defaults);

						$select2.addClass('dn-field-inited');
					});
				}

				$('.dn-active-section .dn-select.dn-select2.dn-autocomplete').each(function() {
					var $field = $(this);
					var type = $field.data('type');
					var value = $field.data('value');
					var search = $field.data('search');

					if ($field.hasClass('dn-field-inited') || $field.parents('.dn-item-template').length) {
						return;
					}

					$field.select2({
						theme            : 'dn',
						allowClear       : true,
						placeholder      : 'Select',
						dropdownAutoWidth: false,
						width            : 'resolve',
						ajax             : {
							url           : omniverseConfig.ajaxUrl,
							data          : function(params) {
								return {
									action: search,
									type  : type,
									value : value,
									selected : $field.val(),
									params: params
								};
							},
							method        : 'POST',
							dataType      : 'json',
							delay         : 250,
							processResults: function(data) {
								$.each(data, function ( $key, $item ) {
									$item['text'] = $item['text'].replace('&amp;', '&');
									data[$key] = $item;
								});
								return {
									results: data
								};
							},
							cache         : true
						}
					}).on('select2:select select2:unselect', function(e) {
						// $(e.currentTarget).find('option').each(function(e) {
						// 	$(this).removeAttr('selected');
						// });
					});

					$field.addClass('dn-field-inited');
				});

				var $selectWithAnimation = $('.dn-active-section .dn-select.dn-animation-preview');

				if ( ! $selectWithAnimation.length ) {
					return;
				}

				$selectWithAnimation.each( function () {
					var $select  = $(this);
					var value    = $select.val();
					var $wrapper = $select.parent();

					if ( ! $wrapper.find('.dn-animation-preview-wrap').length ) {
						var classes = '';

						if ( value && 'none' !== value ) {
							classes = ' wd-animated wd-animation-ready wd-animation-' + value;
						}

						$wrapper.append(`
							<div class="dn-animation-preview-wrap">
								<button class="dn-btn dn-color-primary${classes}">${omniverseConfig.animate_it_btn_text}</button>
							</div>
						`);
					}

					$select.on('change', function () {
						var $this = $(this);
						var $preview = $this.siblings('.dn-animation-preview-wrap').find('.dn-btn');

						$preview.removeClass(function (index, css) {
							return (css.match(/(^|\s)wd-animat\S+/g) || []).join(' ');
						});

						$preview.addClass('wd-animation-ready wd-animation-' + $this.val() );

						setTimeout( function () {
							$preview.addClass('wd-animated');
						}, 100);
					});

					$wrapper.find('.dn-animation-preview-wrap .dn-btn').on('click', function (e) {
						e.preventDefault();
						var $this = $(this);

						$this.removeClass('wd-animated');

						setTimeout( function () {
							$this.addClass('wd-animated');
						}, 100);
					});
				});
			},

			selectWithTableControl: function () {
				if ( typeof ($.fn.select2) === 'undefined' ) {
					return;
				}

				$('.dn-active-section .dn-select_with_table-control').each( function () {
					var $control = $(this);

					$control.on('click', '.dn-remove-item', function (e) {
						e.preventDefault();

						$(this).parent().parent().remove();
					});

					$control.find('.dn-add-row').on('click', function (e) {
						e.preventDefault();

						var $content = $control.find('.dn-controls-wrapper');
						var $template = $control.find('.dn-item-template').clone();

						$template.find('[name]').each(( $id, $input ) => {
							$input.disabled = false;
						});

						$template = $template.html().replace( /{{index}}/gi, Date.now() );

						$content.append($template);

						omniverseOptionsAdmin.selectControl(true);
					});
				});
			},

			backgroundControl: function() {
				if ( typeof ($.fn.select2) === 'undefined' ) {
					return;
				}

				var $bgs = $('.dn-active-section .dn-background-control');

				if ($bgs.length <= 0) {
					return;
				}

				$bgs.each(function() {
					var $bg               = $(this),
					    $uploadBtn        = $bg.find('.dn-upload-btn'),
					    $removeBtn        = $bg.find('.dn-remove-upload-btn'),
					    $inputURL         = $bg.find('input.dn-upload-input-url'),
					    $inputID          = $bg.find('input.dn-upload-input-id'),
					    $preview          = $bg.find('.dn-upload-preview'),
					    $colorInput       = $bg.find(
						    '.dn-bg-color input[type="text"]'),
					    $bgPreview        = $bg.find('.dn-bg-preview'),
					    $repeatSelect     = $bg.find('.dn-bg-repeat'),
					    $sizeSelect       = $bg.find('.dn-bg-size'),
					    $imageOptions     = $bg.find('.dn-bg-image-options'),
					    $attachmentSelect = $bg.find('.dn-bg-attachment'),
					    $positionSelect   = $bg.find('.dn-bg-position'),
					    data              = {};

					if ($bg.hasClass('dn-field-inited')) {
						return;
					}

					$colorInput.wpColorPicker({
						change: function(e) {
							updatePreview();
						},
						clear: function() {
							updatePreview();
						}
					});

					$bg.find('select').select2({
						allowClear: true,
						theme     : 'dn'
					});

					$bg.on('click', '.dn-upload-btn, img', function(e) {
						e.preventDefault();

						var custom_uploader = wp.media({
							title   : 'Insert image',
							library : {
								// uncomment the next line if you want to
								// attach image to the current post uploadedTo
								// : wp.media.view.settings.post.id,
								type: 'image'
							},
							button  : {
								text: 'Use this image' // button label text
							},
							multiple: false // for multiple image selection set
							// to true
						}).on('select', function() { // it also has "open" and "close" events
							var attachment = custom_uploader.state().get('selection').first().toJSON();
							$inputID.val(attachment.id);
							$inputURL.val(attachment.url);
							$preview.find('img').remove();
							$preview.prepend(
								'<img src="' + attachment.url + '" />');
							$removeBtn.addClass('dn-active');
							$imageOptions.removeClass('dn-hidden');
							updatePreview();
						}).open();
					});

					$removeBtn.on('click', function(e) {
						e.preventDefault();
						$preview.find('img').remove();
						$inputID.val('');
						$inputURL.val('');
						$removeBtn.removeClass('dn-active');
						$imageOptions.addClass('dn-hidden');
						updatePreview();
					});

					$bg.on('change', 'select', function() {
						updatePreview();
					});

					function updatePreview() {
						data.backgroundColor = $colorInput.val();
						data.backgroundImage = 'url(' + $inputURL.val() + ')';
						data.backgroundRepeat = $repeatSelect.val();
						data.backgroundSize = $sizeSelect.val();
						data.backgroundAttachment = $attachmentSelect.val();
						data.backgroundPosition = $positionSelect.val();
						data.height = 100;

						console.log($colorInput);
						if (data.backgroundColor || $inputURL.val()) {
							$bgPreview.css(data).show();
						} else {
							$bgPreview.hide();
						}
					}

					$bg.addClass('dn-field-inited');
				});
			},

			customFontsControl: function() {
				$('.dn-custom-fonts').each(function() {
					var $parent = $(this);

					$parent.on('click', '.dn-custom-fonts-btn-add',
						function(e) {
							e.preventDefault();

							var $template = $parent.find(
								'.dn-custom-fonts-template').clone();
							var key = $parent.data('key') + 1;

							$parent.find('.dn-custom-fonts-sections').append($template);
							var regex = /{{index}}/gi;
							$template.removeClass('dn-custom-fonts-template hide').html($template.html().replace(regex, key)).attr('data-id', $template.attr('data-id').replace(regex, key));

							$parent.data('key', key);

							omniverseOptionsAdmin.uploadControl( false );
						});

					$parent.on('click', '.dn-custom-fonts-btn-remove',
						function(e) {
							e.preventDefault();

							$(this).parent().remove();
						});
				});
			},

			typographyControlInit: function() {
				var $typography = $('.dn-active-section .dn-advanced-typography-field');

				if ($typography.length <= 0) {
					return;
				}

				$.ajax({
					url     : omniverseConfig.ajaxUrl,
					method  : 'POST',
					data    : {
						action: 'omniverse_get_theme_settings_typography_data',
						security: omniverseConfig.get_theme_settings_data_nonce,
					},
					dataType: 'json',
					success : function(response) {
						omniverseOptionsAdmin.typographyControl(response.typography);
					},
					error   : function() {
						console.log('AJAX error');
					}
				});
			},

			typographyControl: function(typographyData) {
				if ( typeof ($.fn.select2) === 'undefined' ) {
					return;
				}

				var $typography = $('.dn-active-section .dn-advanced-typography-field');
				var isSelecting     = false,
				    selVals         = [],
				    select2Defaults = {
					    width     : '100%',
					    allowClear: true,
					    theme     : 'dn'
				    },
				    defaultVariants = {
					    '100'      : 'Thin 100',
					    '200'      : 'Light 200',
					    '300'      : 'Regular 300',
					    '400'      : 'Normal 400',
					    '500'      : 'Medium 500',
					    '600'      : 'Semi Bold 600',
					    '700'      : 'Bold 700',
					    '800'      : 'Extra Bold 800',
					    '900'      : 'Black 900',
					    '100italic': 'Thin 100 Italic',
					    '200italic': 'Light 200 Italic',
					    '300italic': 'Regular 300 Italic',
					    '400italic': 'Normal 400 Italic',
					    '500italic': 'Medium 500 Italic',
					    '600italic': 'Semi Bold 600 Italic',
					    '700italic': 'Bold 700 Italic',
					    '800italic': 'Extra Bold 800 Italic',
					    '900italic': 'Black 900 Italic'
				    };

				$typography.each(function() {
					var $parent = $(this);

					if ($parent.hasClass('dn-field-inited')) {
						return;
					}

					$parent.find('.dn-typography-section:not(.dn-typography-template)').each(function() {
						var $section = $(this),
						    id       = $section.data('id');

						initTypographySection($parent, id);
					});

					$parent.on('click', '.dn-typography-btn-add', function(e) {
						e.preventDefault();

						var $template = $parent.find('.dn-typography-template').clone(),
						    key       = $parent.data('key') + 1;

						$parent.find('.dn-typography-sections').append($template);
						var regex = /{{index}}/gi;

						$template.removeClass('dn-typography-template hide').html($template.html().replace(regex, key)).attr('data-id',
							$template.attr('data-id').replace(regex, key));

						$parent.data('key', key);

						initTypographySection($parent, $template.attr('data-id'));
					});

					$parent.on('click', '.dn-typography-btn-remove',
						function(e) {
							e.preventDefault();

							$(this).parent().remove();
						});

					$parent.addClass('dn-field-inited');
				});

				function initTypographySection($parent, id) {
					var $section            = $parent.find('[data-id="' + id + '"]'),
					    $family             = $section.find('.dn-typography-family'),
					    $familyInput        = $section.find(
						    '.dn-typography-family-input'),
					    $googleInput        = $section.find(
						    '.dn-typography-google-input'),
					    $customInput        = $section.find(
						    '.dn-typography-custom-input'),
					    $customSelector     = $section.find(
						    '.dn-typography-custom-selector'),
					    $selector           = $section.find('.dn-typography-selector'),
					    $transform          = $section.find('.dn-typography-transform'),
					    $color              = $section.find('.dn-typography-color'),
					    $colorHover         = $section.find(
						    '.dn-typography-color-hover'),
					    $responsiveControls = $section.find(
						    '.dn-typography-responsive-controls'),
						$background         = $section.find('.dn-typography-background'),
						$backgroundHover    = $section.find(
							'.dn-typography-background-hover');

					if ($family.data('value') !== '') {
						$family.val($family.data('value'));
					}

					syncronizeFontVariants($section, true, false);

					//init when value is changed
					$section.find(
						'.dn-typography-family, .dn-typography-style, .dn-typography-subset').on(
						'change',
						function() {
							syncronizeFontVariants($section, false, false);
						}
					);

					var fontFamilies = [
						    {
							    id  : '',
							    text: ''
						    }
					    ],
					    customFonts  = {
						    text    : 'Custom fonts',
						    children: []
					    },
					    stdFonts     = {
						    text    : 'Standard fonts',
						    children: []
					    },
					    googleFonts  = {
						    text    : 'Google fonts',
						    children: []
					    };

					$.map(typographyData.stdfonts, function(val, i) {
						stdFonts.children.push({
							id      : i,
							text    : val,
							selected: (i == $family.data('value'))
						});
					});

					$.map(typographyData.googlefonts, function(val, i) {
						googleFonts.children.push({
							id      : i,
							text    : i,
							google  : true,
							selected: (i == $family.data('value'))
						});
					});

					$.map(typographyData.customFonts, function(val, i) {
						customFonts.children.push({
							id      : i,
							text    : i,
							selected: (i == $family.data('value'))
						});
					});

					if (customFonts.children.length > 0) {
						fontFamilies.push(customFonts);
					}

					fontFamilies.push(stdFonts);
					fontFamilies.push(googleFonts);

					if ( ! $family.hasClass('dn-field-inited')) {
						$family.addClass('dn-field-inited');

						$family.empty();

						$family.select2({
							data             : fontFamilies,
							allowClear       : true,
							theme            : 'dn',
							dropdownAutoWidth: false,
							width            : 'resolve'
						}).on(
							'select2:selecting',
							function(e) {
								var data = e.params.args.data;
								var fontName = data.text;

								$familyInput.attr('value', fontName);

								// option values
								selVals = data;
								isSelecting = true;

								syncronizeFontVariants($section, false, true);
							}
						).on(
							'select2:unselecting',
							function(e) {
								$(this).one('select2:opening', function(ev) {
									ev.preventDefault();
								});
							}
						).on(
							'select2:unselect',
							function(e) {
								$familyInput.val('');

								$googleInput.val('false');

								$family.val(null).trigger('change');

								syncronizeFontVariants($section, false, true);
							}
						);

						$family.hide();
					}

					// CSS selector multi select field
					$selector.select2({
						width     : '100%',
						theme     : 'dn',
						allowClear: true,
						templateSelection: function (state) {
							if ( !state.id || !state.element || !$(state.element).data('hint-src') ) {
								return state.text;
							}

							return $('<span>' + state.text + '</span>' + '<span class="dn-hint"><span class="dn-tooltip dn-top"><img data-src="' + $(state.element).data('hint-src') + '"></span></span>');
						},
					}).on(
						'select2:select',
						function(e) {
							var val = e.params.data.id;
							if (val != 'custom') {
								return;
							}
							$customInput.val(true);
							$customSelector.removeClass('hide');

						}
					).on(
						'select2:unselect',
						function(e) {
							var val = e.params.data.id;
							if (val != 'custom') {
								return;
							}
							$customInput.val('');
							$customSelector.val('').addClass('hide');
						}
					);

					$transform.select2(select2Defaults);

					// Color picker fields
					$color.wpColorPicker({
						change: function(event, ui) {
							// needed for palette click
							setTimeout(function() {
								updatePreview($section);
							}, 5);
						}
					});
					$colorHover.wpColorPicker();

					$background.wpColorPicker({
						change: function(event, ui) {
							// needed for palette click
							setTimeout(function() {
								updatePreview($section);
							}, 5);
						}
					});
					$backgroundHover.wpColorPicker();

					// Responsive font size and line height
					$responsiveControls.on('click',
						'.dn-typography-responsive-opener', function() {
							var $this = $(this);
							$this.parent().find(
								'.dn-typography-control-tablet, .dn-typography-control-mobile').toggleClass('show hide');
						}).on('change', 'input', function() {
						updatePreview($section);
					});
				}

				function updatePreview($section) {
					var sectionFields = {
						familyInput    : $section.find(
							'.dn-typography-family-input'),
						weightInput    : $section.find(
							'.dn-typography-weight-input'),
						preview        : $section.find('.dn-typography-preview'),
						sizeInput      : $section.find(
							'.dn-typography-size-container .dn-typography-control-desktop input'),
						heightInput    : $section.find(
							'.dn-typography-height-container .dn-typography-control-desktop input'),
						colorInput     : $section.find('.dn-typography-color'),
						backgroundInput: $section.find('.dn-typography-background')
					};

					var size       = sectionFields.sizeInput.val(),
					    height     = sectionFields.heightInput.val(),
					    weight     = sectionFields.weightInput.val(),
					    color      = sectionFields.colorInput.val(),
					    family     = sectionFields.familyInput.val(),
					    background = sectionFields.backgroundInput.val();

					if (!height) {
						height = size;
					}

					//show in the preview box the font
					sectionFields.preview.css('font-weight', weight).css('font-family', family + ', sans-serif').css('font-size', size + 'px').css('line-height', height + 'px');

					if (family === 'none' && family === '') {
						//if selected is not a font remove style "font-family"
						// at preview box
						sectionFields.preview.css('font-family', 'inherit');
					}

					if (color) {
						var bgVal = '#444444';
						if (color !== '') {
							// Replace the hash with a blank.
							color = color.replace('#', '');

							var r = parseInt(color.substr(0, 2), 16);
							var g = parseInt(color.substr(2, 2), 16);
							var b = parseInt(color.substr(4, 2), 16);
							var res = ((r * 299) + (g * 587) + (b * 114)) /
								1000;
							bgVal = (res >= 128) ? '#444444' : '#ffffff';
						}

						if (!color.indexOf('gb(')) {
							color = '#' + color;
						}
						sectionFields.preview.css('color', color).css('background-color', bgVal);
					}

					if (background) {
						if (background !== '') {
							background = background.replace('#', '');
						}

						if (!background.indexOf('gb(')) {
							background = '#' + background;
						}
						sectionFields.preview.css('background-color', background);
					}

					sectionFields.preview.slideDown();
				}

				function loadGoogleFont(family, style, script) {

					if (family == null || family == 'inherit') {
						return;
					}

					//add reference to google font family
					//replace spaces with "+" sign
					var link = family.replace(/\s+/g, '+');

					if (style && style !== '') {
						link += ':' + style.replace(/\-/g, ' ');
					}

					if (script && script !== '') {
						link += '&subset=' + script;
					}

					if (typeof (WebFont) !== 'undefined' && WebFont) {
						WebFont.load({
							google: {
								families: [link]
							}
						});
					}
				}

				function syncronizeFontVariants($section, init, changeFamily) {

					var sectionFields = {
						family     : $section.find('.dn-typography-family'),
						familyInput: $section.find(
							'.dn-typography-family-input'),
						style      : $section.find('select.dn-typography-style'),
						styleInput : $section.find(
							'.dn-typography-style-input'),
						weightInput: $section.find(
							'.dn-typography-weight-input'),
						subsetInput: $section.find(
							'.dn-typography-subset-input'),
						subset     : $section.find('select.dn-typography-subset'),
						googleInput: $section.find(
							'.dn-typography-google-input'),
						preview    : $section.find('.dn-typography-preview'),
						sizeInput  : $section.find(
							'.dn-typography-size-container .dn-typography-control-desktop input'),
						heightInput: $section.find(
							'.dn-typography-height-container .dn-typography-control-desktop input'),
						colorInput : $section.find('.dn-typography-color')
					};

					// Set all the variables to be checked against
					var family = sectionFields.familyInput.val();

					if (!family) {
						family = null; //"inherit";
					}

					var style = sectionFields.style.val();
					var script = sectionFields.subset.val();

					// Is selected font a google font?
					var google;
					if (isSelecting === true) {
						google = selVals.google;
						sectionFields.googleInput.val(google);
					} else {
						google = omniverseOptionsAdmin.makeBool(
							sectionFields.googleInput.val()
						); // Check if font is a google font
					}

					// Page load. Speeds things up memory wise to offload to
					// client
					if (init) {
						style = sectionFields.style.data('value');
						script = sectionFields.subset.data('value');

						if (style !== '') {
							style = String(style);
						}

						if (typeof (script) !== undefined) {
							script = String(script);
						}
					}

					// Something went wrong trying to read google fonts, so
					// turn google off
					if (typographyData.googlefonts === undefined) {
						google = false;
					}

					// Get font details
					var details = '';
					if (google === true &&
						(family in typographyData.googlefonts)) {
						details = typographyData.googlefonts[family];
					} else {
						details = defaultVariants;
					}

					sectionFields.subsetInput.val(script);

					// If we changed the font. Selecting variable is set to
					// true only when family field is opened
					if (isSelecting || init || changeFamily) {
						var html = '<option value=""></option>';

						// Google specific stuff
						if (google === true) {

							// STYLES
							var selected = '';
							$.each(
								details.variants,
								function(index, variant) {
									if (variant.id === style ||
										omniverseOptionsAdmin.size(
											details.variants) === 1) {
										selected = ' selected="selected"';
										style = variant.id;
									} else {
										selected = '';
									}

									html += '<option value="' + variant.id +
										'"' + selected + '>' +
										variant.name.replace(
											/\+/g, ' '
										) + '</option>';
								}
							);

							// destroy select2
							if (sectionFields.subset.data('select2')) {
								sectionFields.style.select2('destroy');
							}

							// Instert new HTML
							sectionFields.style.html(html);

							// Init select2
							sectionFields.style.select2(select2Defaults);

							// SUBSETS
							selected = '';
							html = '<option value=""></option>';

							$.each(
								details.subsets,
								function(index, subset) {
									if (subset.id === script ||
										omniverseOptionsAdmin.size(
											details.subsets) === 1) {
										selected = ' selected="selected"';
										script = subset.id;
										sectionFields.subset.val(script);
									} else {
										selected = '';
									}

									if ( subset.hasOwnProperty('name') && null !== subset.name ) {
										html += '<option value="' + subset.id +
											'"' + selected + '>' +
											subset.name.replace(
												/\+/g, ' '
											) + '</option>';
									}
								}
							);

							// Destroy select2
							if (sectionFields.subset.data('select2')) {
								sectionFields.subset.select2('destroy');
							}

							// Inset new HTML
							sectionFields.subset.html(html);

							// Init select2
							sectionFields.subset.select2(select2Defaults);

							sectionFields.subset.parent().fadeIn('fast');
							// $( '#' + mainID + ' .typography-family-backup'
							// ).fadeIn( 'fast' );
						} else {
							if (details) {
								$.each(
									details,
									function(index, value) {
										if (index === style || index ===
											'normal') {
											selected = ' selected="selected"';
											sectionFields.style.find(
												'.select2-chosen').text(value);
										} else {
											selected = '';
										}

										html += '<option value="' + index +
											'"' + selected + '>' +
											value.replace(
												'+', ' '
											) + '</option>';
									}
								);

								// Destory select2
								if (sectionFields.subset.data('select2')) {
									sectionFields.style.select2('destroy');
								}

								// Insert new HTML
								sectionFields.style.html(html);

								// Init select2
								sectionFields.style.select2(select2Defaults);

								// Prettify things
								sectionFields.subset.parent().fadeOut('fast');
							}
						}

						sectionFields.familyInput.val(family);
					}

					// Check if the selected value exists. If not, empty it.
					// Else, apply it.
					if (sectionFields.style.find(
						'option[value=\'' + style + '\']').length === 0) {
						style = '';
						sectionFields.style.val('');
					} else if (style === '400') {
						sectionFields.style.val(style);
					}

					// Weight and italic
					if (style.indexOf('italic') !== -1) {
						sectionFields.preview.css('font-style', 'italic');
						sectionFields.styleInput.val('italic');
						style = style.replace('italic', '');
					} else {
						sectionFields.preview.css('font-style', 'normal');
						sectionFields.styleInput.val('');
					}

					sectionFields.weightInput.val(style);

					// Handle empty subset select
					if (sectionFields.subset.find(
						'option[value=\'' + script + '\']').length === 0) {
						script = '';
						sectionFields.subset.val('');
						sectionFields.subsetInput.val(script);
					}

					if (google) {
						loadGoogleFont(family, style, script);
					}

					if (!init) {
						updatePreview($section);
					}

					isSelecting = false;
				}
			},

			sorterControl: function () {
				$('.dn-sorter-control').each( function () {
					var $this = $(this);
					var $lists = $this.find('.dn-sorter-wrapper ul');

					$lists.sortable({
						connectWith: '.' + $lists.attr('class'),
						update: function () {
							var orders = {};

							$this.find('.dn-sorter-wrapper').each( function () {
								var $wrapper = $(this);
								var wrapperKey = $wrapper.data('key');
								var currentOrder = [];

								$wrapper.find('li').each( function () {
									currentOrder.push($(this).data('id'));
								});

								orders[wrapperKey] = currentOrder;
							})

							$this.find('input[type=hidden]').val(JSON.stringify(orders));
						}
					}).disableSelection();
				})
			},

			themeSettingsTooltips: function () {
				$(document).on('mouseenter mousemove', '.dn-hint:not(.dn-loaded)', function () {
					var $wrapper = $(this);
					var $attachment = $wrapper.find('img');

					if ( ! $attachment.length ) {
						$attachment = $wrapper.find('video');
					}

					if ( ! $attachment.length || $wrapper.hasClass('dn-loaded')) {
						return;
					}

					$wrapper.addClass('dn-loaded dn-loading');

					$attachment.each( function () {
						var $this = $(this);

						if ( $this.attr('src') ) {
							return;
						}

						$this.attr('src', $this.data('src') );
					});

					$attachment.on('load play', function () {
						$wrapper.removeClass('dn-loading');
					});
				});
			},

			makeBool: function(val) {
				if (val == 'false' || val == '0' || val === false || val ===
					0) {
					return false;
				} else if (val == 'true' || val == '1' || val === true || val ==
					1) {
					return true;
				}
			},

			size: function(obj) {
				var size = 0,
				    key;

				for (key in obj) {
					if (obj.hasOwnProperty(key)) {
						size++;
					}
				}

				return size;
			},

			rangeControl: function() {
				var $ranges = $('.dn-active-section .dn-range-control');

				if ($ranges.length <= 0) {
					return;
				}

				$ranges.each(function() {
					var $range  = $(this),
					    $input  = $range.find('.dn-range-value'),
					    $slider = $range.find('.dn-range-slider'),
					    $text   = $range.find('.dn-range-field-value-text'),
					    data    = $input.data();

					$slider.slider({
						range: 'min',
						value: data.start,
						min  : data.min,
						max  : data.max,
						step : data.step,
						slide: function(event, ui) {
							$input.val(ui.value).trigger('change');
							$text.text(ui.value);
						}
					});

					// Initiate the display
					$input.val($slider.slider('value')).trigger('change');
					$text.text($slider.slider('value'));

					$range.addClass('dn-field-inited');
				});

			},

			responsiveRangeControl: function() {
				var $ranges = $('.dn-active-section .dn-responsive_range-control');

				if ($ranges.length <= 0) {
					return;
				}

				$ranges.each(function() {
					$(this).find('.dn-responsive-range').each(function () {
						initSlider($(this));
					});
				});

				$ranges.find('.dn-device').on('click', function () {
					var $this = $(this);
					var $wrapper = $this.parents('.dn-responsive-range-wrapper');

					$this.siblings('.dn-active').removeClass('dn-active');
					$this.addClass('dn-active');

					$wrapper.find('.dn-responsive-range').removeClass('dn-active').siblings('[data-device=' + $this.data('value') + ']').addClass('dn-active');
				});

				$ranges.find('.wd-slider-unit-control').on('click', function () {
					var $this = $(this);
					var $wrapper = $this.parents('.dn-responsive-range');

					if( !$this.siblings().length ) {
						return;
					}

					$this.siblings('.dn-active').removeClass('dn-active');
					$this.addClass('dn-active');

					$wrapper.attr('data-unit', $this.data('unit') );
					initSlider($wrapper);
				});

				$ranges.find('.dn-range-field-value').on('change', function () {
					var $this = $(this);
					var $wrapper = $this.parents('.dn-responsive-range');
					var $mainInput = $wrapper.parent().siblings('.dn-responsive-range-value');
					var $deviceRangeSettings = $mainInput.data('settings');
					var rangeSettings = $deviceRangeSettings.range[$wrapper.data('unit')];
					var valueNew = $this.val();

					if ( valueNew.length ) {
						if ( valueNew >= rangeSettings.max ) {
							valueNew = rangeSettings.max;
							$this.val(valueNew);
						}
						if ( valueNew <= rangeSettings.min ) {
							valueNew = rangeSettings.min;
							$this.val(valueNew);
						}
					}

					$wrapper.attr('data-value', valueNew );
					setMainValue( $mainInput );
					initSlider($wrapper);
				});

				function setMainValue( $input ) {
					let $results = {
						devices: {}
					};

					var changeValue = false;

					$input.siblings('.dn-responsive-range-wrapper').find('.dn-responsive-range').each(function() {
						let $this = $(this);

						if ($this.attr('data-value')) {
							changeValue = true;
						}

						$results.devices[$this.attr('data-device')] = {
							unit : $this.attr('data-unit'),
							value: $this.attr('data-value')
						};
					});

					if (changeValue) {
						$input.attr('value', window.btoa(JSON.stringify($results)));
					} else {
						$input.attr('value', '');
					}
				}

				function initSlider( $deviceRange ) {
					var $slider              = $deviceRange.find('.dn-range-slider');
					var $wrapper             = $deviceRange.parents('.dn-responsive-range-wrapper');
					var $input               = $wrapper.siblings('.dn-responsive-range-value');
					var $deviceRangeSettings = $input.data('settings');
					var device               = $deviceRange.data('device');
					var unit                 = $deviceRange.attr('data-unit');
					var data                 = $deviceRangeSettings['range'][unit];
					var $inputNumber         = $deviceRange.find('.dn-range-field-value');

					if ($deviceRange.attr('data-value')) {
						data.start = $deviceRange.attr('data-value');
					} else {
						data.start = $deviceRangeSettings.devices[device].value;
					}

					if ('undefined' !== typeof $slider.slider()) {
						$slider.slider('destroy');
					}

					$slider.slider({
						range: 'min',
						value: data.start,
						min  : data.min,
						max  : data.max,
						step : data.step,
						slide: function(event, ui) {
							$slider.parent().attr('data-value', ui.value)
							$inputNumber.val(ui.value);
							setMainValue($input);
						}
					});
				}
			},

			dimensionControl: function() {
				var $dimensions = $('.dn-active-section .dn-dimensions-control');

				if ($dimensions.length <= 0) {
					return;
				}

				$dimensions.find('.dn-control-tab-content.dn-active .dn-dimensions-field.dn-range-slider-wrap').each(function(){
					initSlider($(this));
				});

				$dimensions.find('.dn-device').on('click', function () {
					var $this = $(this);
					var $wrapper = $this.parents('.dn-option-control');

					$this.siblings('.dn-active').removeClass('dn-active');
					$this.addClass('dn-active');

					$wrapper.find('.dn-control-tab-content').removeClass('dn-active').siblings('[data-device=' + $this.data('value') + ']').addClass('dn-active');
				});

				$dimensions.find('.wd-slider-unit-control').on('click', function () {
					var $this = $(this);
					var $wrapper = $this.parents('.dn-option-control');

					if( !$this.siblings().length ) {
						return;
					}

					$this.siblings('.dn-active').removeClass('dn-active');
					$this.addClass('dn-active');

					$wrapper.attr('data-unit', $this.data('unit') );
				});

				$dimensions.find('.dn-dimensions-field input').on('change', function () {
					var $this = $(this);
					var $wrapper = $this.parents('.dn-option-control');
					var $mainInput = $wrapper.find('.dn-dimensions-value');
					var settings = $mainInput.data('settings');

					var valueNew = $this.val();

					if ( valueNew.length && 'undefined' !== typeof settings.range ) {
						var unit = $this.parents('.dn-control-tab-content').data('unit');
						var rangeSettings = settings.range[unit];

						if ( 'undefined' !== typeof rangeSettings[ $this.data('key') ] ) {
							rangeSettings = rangeSettings[ $this.data('key') ];
						} else if ( 'undefined' !== typeof rangeSettings['-'] ) {
							rangeSettings = rangeSettings['-'];
						}

						if ( 'undefined' !== typeof rangeSettings.max && valueNew >= rangeSettings.max ) {
							valueNew = rangeSettings.max;
							$this.val(valueNew);
						}
						if ( 'undefined' !== typeof rangeSettings.max && valueNew <= rangeSettings.min ) {
							valueNew = rangeSettings.min;
							$this.val(valueNew);
						}
					}
					setMainValue( $mainInput );
					initSlider( $this.parents('.dn-dimensions-field') );
				});

				function initSlider( $field ) {
					var $slider       = $field.find('.dn-dimensions-slider');
					var $wrapper      = $field.parents('.dn-dimensions.dn-field-type-slider');
					var $input        = $wrapper.siblings('.dn-dimensions-value');
					var fieldSettings = $input.data('settings');
					var $deviceFields = $field.parents('.dn-control-tab-content');
					var device        = $deviceFields.data('device');
					var unit          = $deviceFields.attr('data-unit');
					var data          = fieldSettings['range'][unit];
					var $inputNumber  = $field.find('.dn-dimensions-field-value-input input');

					if ( 'undefined' !== typeof data[ $inputNumber.data('key') ] ) {
						data = data[ $inputNumber.data('key') ];
					} else if ( 'undefined' !== typeof data['-'] ) {
						data = data['-'];
					}

					if ($inputNumber.val()) {
						data.start = $inputNumber.val();
					} else {
						if ( 'undefined' !== typeof fieldSettings['devices'][device][$inputNumber.data('key')] ) {
							data.start = fieldSettings['devices'][device][$inputNumber.data('key')];
						} else {
							data.start = 0;
						}
					}

					if ('undefined' !== typeof $slider.slider()) {
						$slider.slider('destroy');
					}

					$slider.slider({
						range: 'min',
						value: data.start,
						min  : data.min,
						max  : data.max,
						step : data.step,
						slide: function(event, ui) {
							$inputNumber.val(ui.value);
							setMainValue($input);
						}
					});
				}

				function setMainValue( $input ) {
					var $results = {
						devices: {}
					};

					var hasValue = false;

					$input.siblings('.dn-dimensions').find('.dn-control-tab-content').each(function() {
						let $wrapper = $(this);

						$results.devices[$wrapper.attr('data-device')] = {
							unit : $wrapper.attr('data-unit'),
						};

						$wrapper.find('.dn-dimensions-field input').each(function() {
							var $this = $(this);

							if ($this.val()) {
								hasValue = true;
							}

							$results.devices[$wrapper.attr('data-device')][$this.data('key')] = $this.val();
						});
					});

					if (hasValue) {
						$input.attr('value', window.btoa(JSON.stringify($results)));
					} else {
						$input.attr('value', '');
					}
				}
			},

			uploadIconControl: function () {
				$('.dn-active-section .dn-icon-font-select, .dn-active-section .dn-icon-weight-select').on('change', function () {
					var $wrapper = $(this).parents( '.dn-fields-group' );
					var $preview = $wrapper.find('.dn-icons-preview');
					var font = $wrapper.find('.dn-icon-font-select').val();
					var weight = $wrapper.find('.dn-icon-weight-select').val();

					if ( ! font || ! weight ) {
						return;
					}

					$preview.addClass('dn-loading');
					$wrapper.addClass('dn-loading');

					$.ajax({
						url     : omniverseConfig.ajaxUrl,
						method  : 'GET',
						data    : {
							action  : 'omniverse_get_enqueue_custom_icon_fonts',
							security: omniverseConfig.get_theme_settings_data_nonce,
							font    : font,
							weight  : weight,
						},
						dataType: 'json',
						success : function(response) {
							if ( response.enqueue ) {
								$('style#wd-icon-font').replaceWith(response.enqueue);
							}
						},
						error   : function() {
							console.log('AJAX error');
						},
						complete: function() {
							$preview.removeClass('dn-loading');
							$wrapper.removeClass('dn-loading');
						}
					});
				});
			},

			dropdownControl: function () {
				var fields = document.querySelectorAll('.dn-active-section .dn-field.dn-group-control');
				var openDropdown = document.querySelectorAll('.dn-field.dn-group-control .dn-dropdown-options.dn-show');

				if ( openDropdown ) {
					openDropdown.forEach( function (dropdown) {
						dropdown.classList.remove('dn-show');
						dropdown.classList.add('dn-hidden');
					});

					document.removeEventListener('click', outsideClickListener);
				}

				if ( fields ) {
					fields.forEach( function (field) {
						var dropdownBtn = field.querySelector('.dn-dropdown-open:not(.dn-init)');
						var resetButton = field.querySelector('.dn-reset-group:not(.dn-init)');

						if ( resetButton && ! resetButton.classList.contains('dn-init') ) {
							resetButton.classList.add('dn-init');

							resetButton.addEventListener('click', function(e) {
								e.preventDefault();

								var btn = this;
								var inputsName = JSON.parse(btn.dataset.settings);

								btn.classList.remove('dn-show');
								btn.classList.add('dn-hidden');

								inputsName.forEach( function (inputName) {
									if ( document.querySelector('[name="' + inputName + '"]') ) {
										document.querySelector('[name="' + inputName + '"]').disabled = true;
									}
								});
							});
						}

						if ( ! dropdownBtn || dropdownBtn.classList.contains('dn-init') ) {
							return;
						}

						dropdownBtn.classList.add('dn-init');

						dropdownBtn.addEventListener('click', function(e) {
							e.preventDefault();

							var dropdown = this.nextElementSibling;
							var resetButton = dropdown.parentElement.previousElementSibling.querySelector('.dn-reset-group');

							if ( resetButton && resetButton.classList.contains('dn-hidden') ) {
								resetButton.classList.remove('dn-hidden');
								resetButton.classList.add('dn-show');

								var inputsName = JSON.parse(resetButton.dataset.settings);

								inputsName.forEach( function (inputName) {
									if ( document.querySelector('[name="' + inputName + '"]') ) {
										document.querySelector('[name="' + inputName + '"]').disabled = false;
									}
								});
							}

							if (dropdown.classList.contains('dn-show')) {
								dropdown.classList.remove('dn-show');
								dropdown.classList.add('dn-hidden');

								document.removeEventListener('click', outsideClickListener);
							} else {
								var previousDropdown = document.querySelector('.dn-field.dn-group-control .dn-dropdown-options.dn-show');

								if ( previousDropdown ) {
									document.removeEventListener('click', outsideClickListener);

									previousDropdown.classList.remove('dn-show');
									previousDropdown.classList.add('dn-hidden');
								}

								dropdown.classList.remove('dn-hidden');
								dropdown.classList.add('dn-show');

								setTimeout( function () {
									document.addEventListener('click', outsideClickListener);
								}, 50);
							}
						});
					});
				}

				function outsideClickListener(event) {
					if (!event.target.closest('.dn-dropdown-options') && !event.target.classList.contains('dn-dropdown-options') && 'BODY' !== event.target.tagName ) {
						var dropdown = document.querySelector('.dn-field.dn-group-control .dn-dropdown-options.dn-show');

						dropdown.classList.remove('dn-show');
						dropdown.classList.add('dn-hidden');

						document.removeEventListener('click', outsideClickListener);
					}
				}
			},

			editorControl: function() {
				var $editors = $('.dn-active-section .dn-editor-control');

				$editors.each(function() {
					var $editor  = $(this),
					    $field   = $editor.find('textarea'),
					    language = $field.data('language');

					if ($editor.hasClass('dn-editor-initiated')) {
						return;
					}

					var editorSettings = wp.codeEditor.defaultSettings
						? _.clone(wp.codeEditor.defaultSettings)
						: {};

					editorSettings.codemirror = _.extend(
						{},
						editorSettings.codemirror,
						{
							indentUnit: 2,
							tabSize   : 2,
							mode      : language
						}
					);

					var editor = wp.codeEditor.initialize($field,
						editorSettings);

					$editor.addClass('dn-editor-initiated');

				});

			},

			fieldsDependencies: function() {
				var $fields = $('.dn-field[data-dependency], .dn-tabs[data-dependency]');

				$fields.each(function() {
					var $field       = $(this),
					    dependencies = $field.data('dependency').split(';');

					dependencies.forEach(function(dependency) {
						if (dependency.length == 0) {
							return;
						}
						var data = dependency.split(':');

						var $parentField = $('.dn-' + data[0] + '-field');

						$parentField.on('change', 'input, select', function(e) {
							testFieldDependency($field, dependencies);
						});

						$parentField.find('input, select').trigger('change');
					});

				});

				function testFieldDependency($field, dependencies) {
					var show = true;
					dependencies.forEach(function(dependency) {
						if (dependency.length == 0 || show == false) {
							return;
						}
						var data         = dependency.split(':'),
						    $parentField = $('.dn-' + data[0] + '-field'),
						    value        = $parentField.find('.dn-option-control input, .dn-option-control select').val();

						switch (data[1]) {
							case 'equals':
								var values = data[2].split(',');
								show = false;
								for (let i = 0; i < values.length; i++) {
									const element = values[i];
									if (value == element) {
										show = true;
									}
								}
								break;
							case 'not_equals':
								var values = data[2].split(',');
								show = true;
								for (let i = 0; i < values.length; i++) {
									const element = values[i];
									if (value == element) {
										show = false;
									}
								}
								break;
						}

					});

					if (show) {
						$field.addClass('dn-shown').removeClass('dn-hidden');
					} else {
						$field.addClass('dn-hidden').removeClass('dn-shown');
					}
				}

			},

			settingsSearch: function() {
				var $searchForm  = $('.dn-options-search');
				var $searchInput = $searchForm.find('input');
				var themeSettingsData;

				if (0 === $searchForm.length) {
					return;
				}

				$.ajax({
					url     : omniverseConfig.ajaxUrl,
					method  : 'POST',
					data    : {
						action: 'omniverse_get_theme_settings_search_data',
						security: omniverseConfig.get_theme_settings_data_nonce,
					},
					dataType: 'json',
					success : function(response) {
						themeSettingsData = response.theme_settings
					},
					error   : function() {
						console.log('AJAX error');
					}
				});

				$searchForm.find('form').submit(function(e) {
					e.preventDefault();
				});

				var $autocomplete = $searchInput.autocomplete({
					source: function(request, response) {
						response(themeSettingsData.filter(function(value) {
							return -1 !== value.text.search(new RegExp(request.term, 'i'));
						}));
					},

					select: function(event, ui) {
						var $field = $('.dn-' + ui.item.id + '-field');

						$('.dn-nav-vertical a[data-id="' + ui.item.section_id + '"]').click();

						$('.dn-highlight-field').removeClass('dn-highlight-field');
						$field.addClass('dn-highlight-field');

						setTimeout(function() {
							if (!isInViewport($field)) {
								$('html, body').animate({
									scrollTop: $field.offset().top - 200
								}, 400);
							}
						}, 300);
					},

					open: function( event, ui ) {
						$searchForm.addClass('dn-searched');
					},

					close: function( event, ui ) {
						$searchForm.removeClass('dn-searched');
					}

				}).data('ui-autocomplete');

				$autocomplete._renderItem = function(ul, item) {
					var $itemContent = '<i class="el ' + item.icon + '"></i><span class="setting-title">' + item.title + '</span><br><span class="settting-path">' + item.path + '</span>';
					return $('<li>')
						.append($itemContent)
						.appendTo(ul);
				};

				$autocomplete._renderMenu = function(ul, items) {
					var that = this;

					$.each(items, function(index, item) {
						that._renderItemData(ul, item);
					});

					$(ul).addClass('dn-settings-result');
				};

				var isInViewport = function($el) {
					var elementTop = $el.offset().top;
					var elementBottom = elementTop + $el.outerHeight();
					var viewportTop = $(window).scrollTop();
					var viewportBottom = viewportTop + $(window).height();
					return elementBottom > viewportTop && elementTop < viewportBottom;
				};
			},

			widgetDependency: function() {
				if ( ! $(document.body).hasClass('widgets-php') ) {
					return;
				}

				if ( ! $(document.body).hasClass('wp-embed-responsive') ) {
					$('.widget').each( function () {
						initWidgetField( $(this) );
					});
				}

				$(document).on('widget-added', function ( e, $element ) {
					initWidgetField( $element );
				});

				function initWidgetField( $element ) {
					$element.find('.wd-widget-field').each( function () {
						var $this = $(this);
						var value = $this.data( 'value' );

						if ( 'undefined' === typeof value || ! $this.data( 'param_name' ) ) {
							return;
						}

						process($this, value);

						$this.find('.widefat').on( 'change', function () {
							var $thisInput = $(this);
							var $parent = $thisInput.parent('.wd-widget-field');
							var value = $thisInput.val();

							$parent.attr( 'data-value', value);

							process($parent, value);
						});
					});
				}

				function process( $element, value ) {
					$element.siblings().each( function () {
						var $this = $(this);
						var dependency = $this.data( 'dependency' );

						if ( 'undefined' !== typeof dependency && dependency.element === $element.data('param_name') ) {
							if ( 'undefined' !== typeof dependency.value ) {
								if ( dependency.value.includes( value ) ) {
									$this.show();
								} else {
									$this.hide();
								}
							}
							if ( 'undefined' !== typeof dependency.value_not_equal_to ) {
								if ( dependency.value_not_equal_to.includes( value ) ) {
									$this.hide();
								} else {
									$this.show();
								}
							}
						}
					});
				}
			},

			presetsActive: function() {
				function checkAll() {
					$('.dn-nav-vertical li').each(function() {
						var $li = $(this);
						var sectionId = $li.find('a').data('id');

						$('.dn-section[data-id="' + sectionId + '"]').find('.dn-inherit-checkbox-wrapper input').each(function() {
							if (!$(this).prop('checked')) {
								$li.addClass('dn-not-inherit');
							}
						});
					});
				}

				function checkChild() {
					$('.dn-nav-vertical .dn-has-child').each(function() {
						var $this  = $(this);
						var $child = $this.find('.dn-not-inherit');
						var checked = false;

						if ($child.length > 0) {
							checked = true;
						}

						if (checked) {
							$this.addClass('dn-not-inherit');
						} else {
							$this.removeClass('dn-not-inherit');
						}
					});
				}

				checkAll();
				checkChild();

				$('.dn-inherit-checkbox-wrapper input').on('change', function() {
					var $this  = $(this);
					var sectionId = $this.parents('.dn-section').data('id');
					var checked = false;
					var $parent = $('.dn-nav-vertical li a[data-id="' + sectionId + '"]').parent();

					$this.parents('.dn-section').find('.dn-inherit-checkbox-wrapper input').each(function() {
						if (!$(this).prop('checked')) {
							checked = true;
						}
					});

					if (checked) {
						$parent.addClass('dn-not-inherit');
					} else {
						$parent.removeClass('dn-not-inherit');
					}

					checkChild();
					checkAll();
				});
			},

			optionsPresetsCheckbox: function() {
				var $options = $('.dn-options');
				var $fieldsToSave = $options.find('.dn-fields-to-save');
				var $checkboxes = $options.find('.dn-inherit-checkbox-wrapper input');

				$checkboxes.on('change', function() {
					var $checkbox = $(this);
					var $field = $checkbox.closest('.dn-field');
					var checked = $checkbox.prop('checked');
					var name = $checkbox.data('name');

					var addField = function(name) {
						var current     = $fieldsToSave.val();
						var fieldsArray = current.split(',');
						var index       = fieldsArray.indexOf(name);

						if (index > -1) {
							return;
						}

						if (current.length === 0) {
							fieldsArray = [name];
						} else {
							fieldsArray.push(name);
						}

						$fieldsToSave.val(fieldsArray.join(','));
					}

					var removeField = function(name) {
						var current     = $fieldsToSave.val();
						var fieldsArray = current.split(',');
						var index       = fieldsArray.indexOf(name);

						if (index > -1) {
							fieldsArray.splice(index, 1);
							$fieldsToSave.val(fieldsArray.join(','));
						}
					}

					if (!checked) {
						$field.removeClass('dn-field-disabled');

						if ( $field.hasClass('dn-group-control') ) {
							var innerInputID = $field.find('.dn-group-settings').data('inputs-id')

							if ( innerInputID ) {
								$.each(innerInputID, function(index, value) {
									addField(value);
								});
							}
						}
						addField(name);
					} else {
						if ( $field.hasClass('dn-group-control') ) {

							if ( $field.hasClass('dn-group-control') ) {
								var innerInputID = $field.find('.dn-group-settings').data('inputs-id')

								if ( innerInputID ) {
									$.each(innerInputID, function(index, value) {
										removeField(value);
									});
								}
							}
						}

						$field.addClass('dn-field-disabled');
						removeField(name);
					}
				});
			}
		};

		return {
			init: function() {
				$(document).ready(function() {
					omniverseOptionsAdmin.optionsPage();
					omniverseOptionsAdmin.optionsPresetsCheckbox();
					omniverseOptionsAdmin.presetsActive();
					omniverseOptionsAdmin.switcherControl();
					omniverseOptionsAdmin.buttonsControl();
					omniverseOptionsAdmin.fieldsDependencies();
					omniverseOptionsAdmin.customFontsControl();
					omniverseOptionsAdmin.settingsSearch();
					omniverseOptionsAdmin.widgetDependency();
					omniverseOptionsAdmin.sorterControl();
					omniverseOptionsAdmin.themeSettingsTooltips();
					omniverseOptionsAdmin.selectWithTableControl();

					omniverse_media_init();
					omniverseOptionsAdmin.selectControl(true);
					omniverseOptionsAdmin.uploadControl(true);
					omniverseOptionsAdmin.uploadListControl(true);
				});

				$(document).on('widget-updated widget-added', function(e, widget) {
					omniverse_media_init();
					omniverseOptionsAdmin.selectControl(true);
					omniverseOptionsAdmin.uploadControl(true);
					omniverseOptionsAdmin.uploadListControl(true);
				});

				$(document).on('zs_section_changed', function() {
					setTimeout(function() {
						omniverseOptionsAdmin.typographyControlInit();
					});
					omniverseOptionsAdmin.buttonsControl();
					omniverseOptionsAdmin.selectControl(false);
					omniverseOptionsAdmin.uploadControl(false);
					omniverseOptionsAdmin.uploadListControl(false);
					omniverseOptionsAdmin.colorControl();
					omniverseOptionsAdmin.backgroundControl();
					omniverseOptionsAdmin.switcherControl();
					omniverseOptionsAdmin.rangeControl();
					omniverseOptionsAdmin.responsiveRangeControl();
					omniverseOptionsAdmin.dimensionControl();
					omniverseOptionsAdmin.uploadIconControl();
					omniverseOptionsAdmin.dropdownControl();
				});
			}
		};
	}());
})(jQuery);

jQuery(document).ready(function() {
	omniverseOptions.init();
});
