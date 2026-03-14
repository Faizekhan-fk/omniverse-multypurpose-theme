/* global omniverseConfig */
(function($) {
	'use strict';

	var $importWrapper = $('.dn-import');
	var $boxContent = $('.dn-box-content');
	var $noticesArea = $boxContent.find('.dn-import-notices');
	var $noticesAreaRemove = $('.dn-popup').find('.dn-import-remove-notices');
	var $wizardFooter = $('.dn-wizard-footer');
	var $wizardWrapper = $('.dn-wizard-dummy');

	// Lazy loading.
	$boxContent.on('scroll', function() {
		$(document).trigger('wood-images-loaded');
	});

	// Import.
	$('.dn-import-item').each(function() {
		var $this = $(this);
		var $importBtn = $this.find('.dn-import-item-btn');
		var $progressBar = $this.find('.dn-import-progress-bar');
		var $progressBarPercent = $this.find('.dn-import-progress-bar-percent');
		var $wrapper = $('.dn-import-items');

		var noticeTimeout;
		var interval;

		$importBtn.on('click', async function(e) {
			e.preventDefault();
			
			var currentBase = $importWrapper.data('current-base');
			var clickBase = $this.data('base');
			var clickVersion = $this.data('version');
			var clickType = $this.data('type');
			var businessType = $this.data('business');
			var version;
			var type;
			var action = $(this).hasClass('dn-color-alt') ? 'activate' : 'import';
			var confirmRemove = 'none';
			

			if (clickBase && clickBase !== currentBase && $importWrapper.hasClass('dn-base-imported')) {
				confirmRemove = confirm('WARNING! To import this demo version you need to remove all the previously imported content with all pages, products, and images. Do you want to remove the content and import this version?');
			}

			if (!confirmRemove) {
				return;
			} else if ('none' !== confirmRemove) {
				$importWrapper.removeClass('dn-base-imported');
			}

			$this.addClass('dn-loading-item');
			$wrapper.addClass('dn-loading');
			$wizardFooter.addClass('dn-disabled');

			clearNotices();

			if (!$importWrapper.hasClass('dn-base-imported') && 'version' === clickType) {
				startProgressBar('base');
				version = clickBase;
				type = 'base';
			} else {
				startProgressBar('version');
				version = clickVersion;
				type = clickType;
			}

			if (confirmRemove && 'none' !== confirmRemove) {
				await removeBeforeImport();
				runImport();
			} else if ('none' === confirmRemove) {
				runImport();
			}

			function runImport() {
				var requests = [
					'xml',
					'images1',
					'images2',
					'images3',
					'images4',
					'other'
				];

				runRequest();

				function runRequest() {
					var baseVersionAll = omniverseConfig.import_base_versions_name.split(',');

					if (requests.length) {
						var process = requests.shift();
						if (process.includes('images') && ! baseVersionAll.includes(version)) {
							runRequest();

							return;
						}

						updateProgressBar( type, process );

						$.ajax({
							url    : omniverseConfig.ajaxUrl,
							data   : {
								action  : 'omniverse_import_action',
								version : version,
								type    : type,
								businessType   : businessType,
								process : process,
								security: omniverseConfig.import_nonce
							},
							timeout: 1000000,
							error  : function() {
								$this.removeClass('dn-loading-item');
								$wrapper.removeClass('dn-loading');
								$wizardFooter.removeClass('dn-disabled');

								endProgress();
								clearProgressBar();
								clearNotices();
								printNotice('error', 'The import could not be completed due to a low timeout limit on the server. You need to contact your hosting provider and ask them to increase it to 300 seconds.');
							},
							success: function(response) {
								if (process === 'other') {
									$this.find('.dn-view-item-btn').attr('href', response.preview_url);
									$('.dn-import-remove-form-wrap').html(response.remove_html);
								}
							}
						}).then(runRequest);
					} else {
						initRemove();
						afterRemove();

						if (baseVersionAll.includes(version)) {
							$importWrapper.data('current-base', version);
							$importWrapper.attr('data-current-base', version);

							version = clickVersion;
							type = clickType;
							runImport();

							$importWrapper.addClass('dn-base-imported');
							$wizardWrapper.addClass('imported-base');
						} else {
							updateProgress(100);
							clearNotices();

							if ('activate' === action) {
								printNotice('success', 'Demo version has been successfully activated!');
							} else {
								printNotice('success', 'Content has been successfully imported!');
							}

							$this.addClass('dn-imported');
							$this.addClass('dn-view-page');
							$this.siblings().removeClass('dn-view-page');
							$wrapper.removeClass('dn-loading');
							$wizardFooter.removeClass('dn-disabled');

							setTimeout(function() {
								endProgress();
								clearProgressBar();
								$this.removeClass('dn-loading-item');
							}, 1000);
						}

						$importWrapper.addClass('dn-has-data');
					}
				}
			}
		});

		function removeBeforeImport() {
			return new Promise(resolve => {
				$.ajax({
					url    : omniverseConfig.ajaxUrl,
					data   : {
						action  : 'omniverse_import_remove_action',
						security: omniverseConfig.import_remove_nonce,
						data    : [
							{
								'name' : 'page',
								'value': 'on'
							},
							{
								'name' : 'rev_sliders',
								'value': 'on'
							},
							{
								'name' : 'product',
								'value': 'on'
							},
							{
								'name' : 'mc4wp-form',
								'value': 'on'
							},
							{
								'name' : 'post',
								'value': 'on'
							},
							{
								'name' : 'omniverse_layout',
								'value': 'on'
							},
							{
								'name' : 'omniverse_slider',
								'value': 'on'
							},
							{
								'name' : 'portfolio',
								'value': 'on'
							},
							{
								'name' : 'presets',
								'value': 'on'
							},
							{
								'name' : 'cms_block',
								'value': 'on'
							},
							{
								'name' : 'headers',
								'value': 'on'
							},
							{
								'name' : 'attachment',
								'value': 'on'
							},
							{
								'name' : 'nav_menu',
								'value': 'on'
							},
							{
								'name' : 'wpcf7_contact_form',
								'value': 'on'
							}
						]
					},
					timeout: 1000000,
					error  : function() {
						clearNotices();
						printNotice('error', 'Something wrong with removing data. Please, try to remove data manually or contact our support center for further assistance.', 'remove');
					},
					success: function(response) {
						$('.dn-import-remove-form-wrap').html(response.content);
						initRemove();
						afterRemove();
					}
				}).then(function(response) {
					resolve(response);
				});
			});
		}

		function updateProgressBar( type, process ) {
			if ( 'base' === type ) {
				if ( 'xml' === process ) {
					updateProgress(15);
				}
				if ( process.indexOf('images') + 1 ) {
					updateProgress(15 + ( 15 * process.substr(6) ) );
				}
				if ( 'other' === process ) {
					updateProgress(80);
				}
			} else if ( 'xml' === process ) {
				updateProgress(90);
			} else if ( 'other' === process ) {
				updateProgress(95);
			}
		}

		function startProgressBar(type) {
			noticeTimeout = setTimeout(function() {
				printNotice('info', 'Please, wait. The theme needs a bit more time than expected to import all the attachments.');
			}, 150000);
		}

		function updateProgress(progress) {
			var timeout = 400;

			function update(value) {
				$progressBar.attr('data-progress', value);
				$progressBar.css('width', value + '%');
				$progressBarPercent.text(value + '%');
			}

			if (progress === 100) {
				timeout = 20;
			}

			var from = $progressBar.attr('data-progress');

			clearInterval(interval);

			interval = setInterval(function() {
				from++;

				update(from);

				if (from >= progress) {
					clearInterval(interval);
				}
			}, timeout);
		}

		function endProgress() {
			clearTimeout(noticeTimeout);
			clearInterval(interval);
		}

		function clearProgressBar() {
			$progressBar.attr('data-progress', '0');
			$progressBar.css('width', '0%');
			$progressBarPercent.text('0%');
		}
	});

	// Search.
	$('.dn-import-search input').on('keyup', function() {
		var val = $(this).val().toLowerCase();

		$('.dn-import-item-wrap.dn-active.dn-cat-show').each(function() {
			var $this = $(this);
			var $data = $this.find('.dn-import-item-title').text().toLowerCase();

			if ($data.indexOf(val) > -1 || $this.find('.dn-import-item').data('tags').indexOf(val) > -1) {
				$this.removeClass('dn-search-hide').addClass('dn-search-show');
			} else {
				$this.addClass('dn-search-hide').removeClass('dn-search-show');
			}
		});

		$(document).trigger('wood-images-loaded');

		if (0 === $('.dn-search-show').length) {
			clearNotices();
			printNotice('info', 'Apologies, but no results were found.');
		} else {
			clearNotices();
		}
	});

	// Filters.
	$('.dn-import-cats-set .dn-set-item').on('click', function() {
		var $catItem = $(this);
		var type = $catItem.data('type');
		var $items = $('.dn-import-item-wrap');
		var $input = $('.dn-import-search input');

		$('.dn-import-cats-list ul[data-type="' + type + '"]').addClass('dn-active').siblings().removeClass('dn-active');

		$catItem.addClass('dn-active');
		$catItem.siblings().removeClass('dn-active');

		$(document).trigger('wood-images-loaded');

		// Reset.
		$input.val('');
		clearNotices();
		$items.removeClass('dn-search-hide dn-search-show');
		$('.dn-import-cats-list li[data-cat="*"]').trigger('click');

		$items.each(function() {
			var $item = $(this);
			var itemType = $item.find('.dn-import-item').data('type');

			if (type === itemType || (type === 'page' && itemType === 'element')) {
				$item.addClass('dn-active');
			} else {
				$item.removeClass('dn-active');
			}
		});
	});

	// Cats.
	$('.dn-import-cats-list li').on('click', function() {
		var $listItem = $(this);
		var category = $listItem.data('cat');
		var $items = $('.dn-import-item-wrap.dn-active');

		$listItem.addClass('dn-active');
		$listItem.siblings().removeClass('dn-active');
		$(document).trigger('wood-images-loaded');

		$items.each(function() {
			var $item = $(this);
			var itemCats = $item.find('.dn-import-item').data('cats');

			if (itemCats.indexOf(category) > -1 || category === '*') {
				$item.removeClass('dn-cat-hide').addClass('dn-cat-show');
			} else {
				$item.addClass('dn-cat-hide').removeClass('dn-cat-show');
			}
		});
	});

	// Remove.
	function initRemove() {
		$('.dn-import-remove input').off('change').on('change', function() {
			var flag = false;
			$('.dn-import-remove input').each(function() {
				if ($(this).prop('checked')) {
					flag = true;
				}
			});
			if (flag) {
				$('.dn-import-remove-btn').removeClass('dn-disabled');
			} else {
				$('.dn-import-remove-btn').addClass('dn-disabled');
			}
		});
		$('.dn-import-remove-select').off('click').on('click', function(e) {
			e.preventDefault();

			$('.dn-import-remove input').each(function() {
				var $input = $(this);
				if ('disabled' !== $input.attr('disabled')) {
					$input.prop('checked', true);
				}
			});
			$('.dn-import-remove-btn').removeClass('dn-disabled');
		});
		$('.dn-import-remove-deselect').off('click').on('click', function(e) {
			e.preventDefault();

			$('.dn-import-remove input').prop('checked', false);
			$('.dn-import-remove-btn').addClass('dn-disabled');
		});
		$('.dn-import-remove-opener').off('click').on('click', function(e) {
			e.preventDefault();

			$('.dn-import-remove').addClass('dn-opened');
			$('html').addClass('dn-popup-opened');
		});
		$('.dn-popup-close, .dn-popup-overlay').off('click').on('click', function(e) {
			e.preventDefault();

			$('.dn-import-remove').removeClass('dn-opened');
			$('html').removeClass('dn-popup-opened');
		});
		$('.dn-import-remove-btn').off('click').on('click', function(e) {
			e.preventDefault();
			var $holder = $('.dn-popup-holder');
			var data = $('.dn-import-remove-form').serializeArray();

			if (!data.length) {
				clearNotices();
				printNotice('info', 'Please, select what exactly do you want to remove from the content.', 'remove');
				return;
			}

			var choice = confirm('Are you sure you want to remove the content? All the changes you made in pages, products, posts, etc. will be lost.');

			if (!choice) {
				return;
			}

			clearNotices();
			$holder.addClass('dn-loading');

			$.ajax({
				url    : omniverseConfig.ajaxUrl,
				data   : {
					action  : 'omniverse_import_remove_action',
					security: omniverseConfig.import_remove_nonce,
					data    : data
				},
				timeout: 1000000,
				error  : function() {
					clearNotices();
					printNotice('error', 'Something wrong with removing data. Please, try to remove data manually or contact our support center for further assistance.', 'remove');
					$holder.removeClass('dn-loading');
				},
				success: function(response) {
					clearNotices();
					printNotice('success', 'Content has been successfully removed!', 'remove');
					$('.dn-import-remove-form-wrap').html(response.content);
					$holder.removeClass('dn-loading');
					initRemove();
					afterRemove();
				}
			});
		});
	}

	initRemove();

	function afterRemove() {
		var flag = false;

		$('.dn-import-remove input').each(function() {
			var $input = $(this);
			var name = $input.attr('name');

			if ('page' === name && 'disabled' === $input.attr('disabled')) {
				$('.dn-imported').removeClass('dn-imported');
				$('.dn-view-page').removeClass('dn-view-page');
			}

			if ('disabled' !== $input.attr('disabled')) {
				flag = true;
			}
		});

		if (!flag) {
			$('.dn-base-imported').removeClass('dn-base-imported');
			$('.dn-has-data').removeClass('dn-has-data');
		}
	}

	// Wizard.
	function wizardDone() {
		var $dummy = $('.dn-setup-wizard').find('.dn-wizard-dummy');

		if ($dummy.length === 0) {
			return;
		}

		$('.dn-next, .dn-skip').on('click', function(e) {
			e.preventDefault();

			$('.dn-setup-wizard').addClass('dn-done');
			$('.dn-wizard-nav li[data-slug="done"]').removeClass('dn-disabled').addClass('dn-active');
			$('.dn-wizard-nav li[data-slug="dummy-content"]').removeClass('dn-active');
		});
	}

	wizardDone();

	// Helpers.
	function printNotice(type, text, location = 'import') {
		if ('remove' === location) {
			$noticesAreaRemove.append('<div class="dn-notice dn-' + type + '">' + text + '</div>');
		} else {
			$noticesArea.append('<div class="dn-notice dn-' + type + '">' + text + '</div>');
		}
	}

	function clearNotices() {
		$noticesArea.text('');
		$noticesAreaRemove.text('');
	}
})(jQuery);