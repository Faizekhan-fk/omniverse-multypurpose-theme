/* global omniverse_settings */
(function($) {
	omniverseThemeModule.menuDropdownsAJAX = function() {
		omniverseThemeModule.$body.on('mousemove', function(){
			$('.menu').has('.dropdown-load-ajax').each(function() {
				var $menu = $(this);

				if ($menu.hasClass('dropdowns-loading') || $menu.hasClass('dropdowns-loaded')) {
					return;
				}

				loadDropdowns($menu);
			});
		});

		function loadDropdowns($menu) {
			$menu.addClass('dropdowns-loading');

			var storageKey = omniverse_settings.menu_storage_key + '_' + $menu.attr('id');
			var storedData = false;

			var $items = $menu.find('.dropdown-load-ajax'),
			    ids    = [];

			$items.each(function() {
				ids.push($(this).find('.dropdown-html-placeholder').data('id'));
			});

			if (omniverse_settings.ajax_dropdowns_save && omniverseThemeModule.supports_html5_storage) {
				var unparsedData = localStorage.getItem(storageKey);

				try {
					storedData = JSON.parse(unparsedData);
				}
				catch (e) {
					console.log('cant parse Json', e);
				}
			}
			if (storedData) {
				renderResults(storedData);
			} else {
				$.ajax({
					url     : omniverse_settings.ajaxurl,
					data    : {
						action: 'omniverse_load_html_dropdowns',
						ids   : ids
					},
					dataType: 'json',
					method  : 'POST',
					success : function(response) {
						if (response.status === 'success') {
							renderResults(response.data);
							if (omniverse_settings.ajax_dropdowns_save && omniverseThemeModule.supports_html5_storage) {
								try {
									localStorage.setItem(storageKey, JSON.stringify(response.data));
								} catch (e) {}
							}
						} else {
							console.log('loading html dropdowns returns wrong data - ', response.message);
						}
					},
					error   : function() {
						console.log('loading html dropdowns ajax error');
					}
				});
			}

			function renderResults(data) {
				Object.keys(data).forEach(function(id) {
					omniverseThemeModule.removeDuplicatedStylesFromHTML(data[id], function(html) {
						$menu.find('[data-id="' + id + '"]').replaceWith(html);

						$menu.addClass('dropdowns-loaded');
						setTimeout(function() {
							$menu.removeClass('dropdowns-loading');
						}, 1000);
					});
				});

				omniverseThemeModule.$document.trigger('wdLoadDropdownsSuccess');
			}
		}
	};

	$(document).ready(function() {
		omniverseThemeModule.menuDropdownsAJAX();
	});
})(jQuery);
