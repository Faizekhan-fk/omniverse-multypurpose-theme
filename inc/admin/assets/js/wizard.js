/* global jQuery, omniverseConfig, omniverseAdmin */

(function($) {
	'use strict';

	function wizardInstallPlugins() {
		var checkPlugin = function($link, callback) {
			setTimeout(function() {
				$.ajax({
					url    : omniverseConfig.ajaxUrl,
					method : 'POST',
					data   : {
						action     : 'omniverse_check_plugins',
						zs_plugin : $link.data('plugin'),
						zs_builder: $link.data('builder'),
						security   : omniverseConfig.check_plugins_nonce
					},
					success: function(response) {
						if ('success' === response.status) {
							changeNextButtonStatus(response.data.required_plugins);
							changePageStatus(response.data.is_all_activated);
						} else {
							omniverseAdmin.addNotice($('.dn-plugin-response'), 'warning', response.message);
							removeLinkClasses($link);
							omniverseAdmin.hideNotice();
						}
						if (response.data.status === 'deactivate') {
							reloadPage($link);
						}
						callback(response);
					}
				});
			}, 1000);
		};

		var activatePlugin = function($link, callback) {
			$.ajax({
				url    : dnPluginsData[$link.data('plugin')]['activate_url'].replaceAll('&amp;', '&'),
				method : 'GET',
				success: function() {
					checkPlugin($link, function(response) {
						if ('success' === response.status) {
							if ('activate' === response.data.status) {
								activatePlugin($link, callback);
							} else {
								removeLinkClasses($link);
								changeLinkAction('activate', 'deactivate', $link, response);
								changeLinkAction('install', 'deactivate', $link, response);
								changeLinkAction('update', 'deactivate', $link, response);
								callback();
							}
						}
					});
				}
			});
		};

		var deactivatePlugin = function($link) {
			$.ajax({
				url    : omniverseConfig.ajaxUrl,
				method : 'POST',
				data   : {
					action     : 'omniverse_deactivate_plugin',
					zs_plugin : $link.data('plugin'),
					zs_builder: $link.data('builder'),
					security   : omniverseConfig.deactivate_plugin_nonce
				},
				success: function(response) {
					if ('error' === response.status) {
						omniverseAdmin.addNotice($('.dn-plugin-response'), 'warning', response.message);
						removeLinkClasses($link);
						omniverseAdmin.hideNotice();
						return;
					}

					checkPlugin($link, function(response) {
						if ('success' === response.status) {
							if ('activate' === response.data.status) {
								removeLinkClasses($link);
								changeLinkAction('deactivate', 'activate', $link, response);
								reloadPage($link);
							} else {
								deactivatePlugin($link);
							}
						}
					});
				}
			});
		};

		function parsePlugins($link, callback) {
			$.ajax({
				url    : $link.attr('href'),
				method : 'POST',
				success: function() {
					setTimeout(function() {
						checkPlugin($link, function(response) {
							if ('success' === response.status) {
								if ('activate' === response.data.status) {
									activatePlugin($link, callback);
								} else {
									removeLinkClasses($link);
									changeLinkAction('activate', 'deactivate', $link, response);
									callback();
								}
							}
						});
					}, 1000);
				}
			});
		}

		function reloadPage($link) {
			if ($link.parents('.omniverse-compatible-plugins').length) {
				location.reload();
			}
		}

		function addLinkClasses($link) {
			$link.parents('.dn-plugin-wrapper').addClass('dn-loading');
			$link.parents('.dn-plugin-wrapper').siblings().addClass('dn-disabled');
			$('.dn-wizard-footer').addClass('dn-disabled');

			$link.text(omniverseConfig[$link.data('action') + '_process_plugin_btn_text']);
		}

		function removeLinkClasses($link) {
			$link.parents('.dn-plugin-wrapper').removeClass('dn-loading');
			$link.parents('.dn-plugin-wrapper').siblings().removeClass('dn-disabled');
			$('.dn-wizard-footer').removeClass('dn-disabled');
		}

		function changeNextButtonStatus(status) {
			var $nextBtn = $('.dn-next');
			if ('has_required' === status) {
				$nextBtn.addClass('dn-disabled');
			} else {
				$nextBtn.removeClass('dn-disabled');
			}
		}

		function changePageStatus(status) {
			var $page = $('.dn-plugins');
			if ('yes' === status) {
				$page.addClass('dn-all-active');
			} else {
				$page.removeClass('dn-all-active');
			}
		}

		function changeLinkAction(actionBefore, actionAfter, $link, response) {
			if (response && response.data.version) {
				$link.parents('.dn-plugin-wrapper').find('.dn-plugin-version span').text(response.data.version);
			}

			$link.removeClass('dn-' + actionBefore).addClass('dn-' + actionAfter);
			$link.attr('href', dnPluginsData[$link.data('plugin')][actionAfter + '_url'].replaceAll('&amp;', '&'));
			$link.data('action', actionAfter);
			$link.text(omniverseConfig[actionAfter + '_plugin_btn_text']);
		}

		$(document).on('click', '.dn-ajax-plugin:not(.dn-deactivate)', function(e) {
			e.preventDefault();

			var $link = $(this);
			addLinkClasses($link);
			parsePlugins($link, function() {});
		});

		$(document).on('click', '.dn-ajax-plugin.dn-deactivate', function(e) {
			e.preventDefault();

			var $link = $(this);
			addLinkClasses($link);
			deactivatePlugin($link);
		});

		$(document).on('click', '.dn-wizard-all-plugins', function(e) {
			e.preventDefault();

			var itemQueue = [];

			function activationAction() {
				if (itemQueue.length) {
					var $link = $(itemQueue.shift());

					if ($link.parents('.omniverse-compatible-plugins').length) {
						return;
					}

					addLinkClasses($link);

					parsePlugins($link, function() {
						activationAction();
					});
				}
			}

			$('.dn-plugin-wrapper .dn-ajax-plugin:not(.dn-deactivate)').each(function() {
				itemQueue.push($(this));
			});

			activationAction();
		});
	}

	function wizardBuilderSelect() {
		$('.dn-wizard-builder-select > div').on('click', function() {
			var $this = $(this);
			var builder = $(this).data('builder');
			
			$this.addClass('dn-active');
			$this.siblings().removeClass('dn-active');
			$('.dn-btn.dn-' + builder).removeClass('dn-hidden').addClass('dn-shown').siblings('.dn-next').addClass('dn-hidden').removeClass('dn-shown');
		});
	}

	function wizardInstallChildTheme() {
		$('.dn-install-child-theme').on('click', function(e) {
			e.preventDefault();
			var $btn = $(this);
			var $responseSelector = $('.dn-child-theme-response');

			$btn.addClass('dn-loading');

			$.ajax({
				url     : omniverseConfig.ajaxUrl,
				method  : 'POST',
				data    : {
					action  : 'omniverse_install_child_theme',
					security: omniverseConfig.install_child_theme_nonce
				},
				dataType: 'json',
				success : function(response) {
					$btn.removeClass('dn-loading');

					if (response && 'success' === response.status) {
						$('.dn-wizard-child-theme').addClass('dn-installed');
					} else if (response && 'dir_not_exists' === response.status) {
						omniverseAdmin.addNotice($responseSelector, 'error', 'The directory can\'t be created on the server. Please, install the child theme manually or contact our support for help.');
					} else {
						omniverseAdmin.addNotice($responseSelector, 'error', 'The child theme can\'t be installed. Skip this step and install the child theme manually via Appearance -> Themes.');
					}
				},
				error   : function() {
					$btn.removeClass('dn-loading');

					omniverseAdmin.addNotice($responseSelector, 'error', 'The child theme can\'t be installed. Skip this step and install the child theme manually via Appearance -> Themes.');
				}
			});
		});
	}

	jQuery(document).ready(function() {
		wizardInstallPlugins();
		wizardBuilderSelect();
		wizardInstallChildTheme();
	});
})(jQuery);