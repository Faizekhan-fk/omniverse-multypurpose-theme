/* global omniverse_settings */
(function($) {
	omniverseThemeModule.$document.on('wdShopPageInit wdUpdateWishlist wdArrowsLoadProducts wdLoadMoreLoadProducts wdProductsTabsLoaded wdSearchFullScreenContentLoaded wdBackHistory wdRecentlyViewedProductLoaded', function() {
		omniverseThemeModule.omniverseCompareUpdateState();
	});

	omniverseThemeModule.omniverseCompare = function() {
		var cookiesName = 'omniverse_compare_list';

		if (omniverse_settings.is_multisite) {
			cookiesName += '_' + omniverse_settings.current_blog_id;
		}

		if ( typeof Cookies === 'undefined' ) {
			return;
		}

		var $body         = omniverseThemeModule.$body,
		    $widget       = $('.wd-header-compare'),
		    compareCookie = Cookies.get(cookiesName);

		if ($widget.length > 0) {
			if ('undefined' !== typeof compareCookie) {
				try {
					var ids = JSON.parse(compareCookie);
					$widget.find('.wd-tools-count').text(ids.length);
				}
				catch (e) {
					console.log('cant parse cookies json');
				}
			} else {
				$widget.find('.wd-tools-count').text(0);
			}

			if ( 'undefined' !== typeof omniverse_settings.compare_by_category && 'yes' === omniverse_settings.compare_by_category ) {
				try {
					getProductsCategory();
				}
				catch (e) {
					getAjaxProductCategory();
				}
			}
		}

		$body.on('click', '.wd-compare-btn a', function(e) {
			var $this     = $(this),
			    id        = $this.data('id'),
			    $widget = $('.wd-header-compare');

			if ($this.hasClass('added')) {
				return true;
			}

			e.preventDefault();

			if ( ! $widget.find('.wd-dropdown-compare').length ) {
				var products = [];
				var productsCookies = Cookies.get(cookiesName);

				if ( 'undefined' !== typeof productsCookies && productsCookies ) {
					products = Object.values( JSON.parse(productsCookies) );
				}

				if ( ! products.length || -1 === products.indexOf(id.toString()) ) {
					products.push( id.toString() );
				}

				var count = products.length;

				updateCountWidget(count);

				Cookies.set(cookiesName, JSON.stringify(products), {
					expires: 7,
					path   : omniverse_settings.cookie_path,
					secure : omniverse_settings.cookie_secure_param
				});

				updateButton( $this );

				return;
			}

			$this.addClass('loading');

			jQuery.ajax({
				url     : omniverse_settings.ajaxurl,
				data    : {
					action: 'omniverse_add_to_compare',
					id    : id
				},
				dataType: 'json',
				method  : 'GET',
				success : function(response) {
					if ( response.count ) {
						var $widget = $('.wd-header-compare');

						if ($widget.length > 0) {
							$widget.find('.wd-tools-count').text(response.count);
						}

						updateButton( $this );
					} else {
						console.log('something wrong loading compare data ', response);
					}

					if (response.fragments) {
						$.each( response.fragments, function( key, value ) {
							$( key ).replaceWith(value);
						});

						sessionStorage.setItem( cookiesName + '_fragments', JSON.stringify( response.fragments ) );
					}
				},
				error   : function() {
					console.log('We cant add to compare. Something wrong with AJAX response. Probably some PHP conflict.');
				},
				complete: function() {
					$this.removeClass('loading');
				}
			});
		});

		$body.on('click', '.wd-compare-remove', function(e) {
			e.preventDefault();
			var $this      = $(this),
			    id         = $this.data('id'),
				categoryId = '';

			if ('undefined' !== typeof omniverse_settings.compare_by_category && 'yes' === omniverse_settings.compare_by_category) {
				categoryId = $this.parents('.wd-compare-table').data('category-id');

				if ( categoryId && 1 >= $this.parents('.compare-value').siblings().length ) {
					removeProductCategory( categoryId, $this.parents('.wd-compare-page') );
					return;
				}
			}

			$this.addClass('loading');

			jQuery.ajax({
				url     : omniverse_settings.ajaxurl,
				data    : {
					action     : 'omniverse_remove_from_compare',
					id         : id,
					category_id: categoryId,
					key        : omniverse_settings.compare_page_nonce,
				},
				dataType: 'json',
				method  : 'GET',
				success : function(response) {
					if (response.table) {
						updateCompare(response);

						if (response.fragments) {
							$.each( response.fragments, function( key, value ) {
								$( key ).replaceWith(value);
							});

							sessionStorage.setItem( cookiesName + '_fragments', JSON.stringify( response.fragments ) );
						}
					} else {
						console.log('something wrong loading compare data ', response);
					}
				},
				error   : function() {
					console.log('We cant remove product compare. Something wrong with AJAX response. Probably some PHP conflict.');
				},
				complete: function() {
					$this.remove('loading');
				}
			});
		});

		$body.on('change', '.wd-compare-select', function (e) {
			e.preventDefault();

			var $this = $(this);
			var $wrapper = $this.parents('.wd-compare-page');
			var $activeCompareTable = $wrapper.find('.wd-compare-table[data-category-id=' + $this.val() + ']');
			var $oldActiveCompareTable = $wrapper.find('.wd-compare-table.wd-active');
			var animationTime = 100;

			$wrapper.find('.wd-compare-cat-link').attr( 'href', $activeCompareTable.data('category-url') );

			$oldActiveCompareTable.removeClass('wd-in');

			setTimeout(function() {
				$oldActiveCompareTable.removeClass('wd-active');
			}, animationTime);

			setTimeout(function() {
				$activeCompareTable.addClass('wd-active');
			}, animationTime);

			setTimeout(function() {
				$activeCompareTable.addClass('wd-in');
				omniverseThemeModule.$document.trigger('omni-images-loaded');
			}, animationTime * 2);
		});

		$body.on('click', '.wd-compare-remove-cat', function (e) {
			e.preventDefault();

			var $this = $(this);
			var activeCategory = $this.parents('.wd-compare-header').find('.wd-compare-select').val();
			var $wrapper = $this.parents('.wd-compare-page');

			removeProductCategory( activeCategory, $wrapper );
		});

		function removeProductCategory( activeCategory, $wrapper ) {
			var $loader = $wrapper.find('.wd-loader-overlay');

			$loader.addClass('wd-loading');

			jQuery.ajax({
				url     : omniverse_settings.ajaxurl,
				data    : {
					action     : 'omniverse_remove_category_from_compare',
					category_id: activeCategory,
					key        : omniverse_settings.compare_page_nonce,
				},
				dataType: 'json',
				method  : 'GET',
				success : function(response) {
					if (response.table) {
						updateCompare(response);

						if (response.fragments) {
							$.each( response.fragments, function( key, value ) {
								$( key ).replaceWith(value);
							});

							sessionStorage.setItem( cookiesName + '_fragments', JSON.stringify( response.fragments ) );
						}
					} else {
						console.log('something wrong loading compare data ', response);
					}
				},
				error   : function() {
					console.log('We cant remove product compare. Something wrong with AJAX response. Probably some PHP conflict.');
				},
				complete: function() {
					$loader.removeClass('wd-loading');

					var $compareTable = $('.wd-compare-table').first();

					setTimeout(function() {
						$compareTable.addClass('wd-active');
					}, 100);

					setTimeout(function() {
						$compareTable.addClass('wd-in');
						omniverseThemeModule.$document.trigger('omni-images-loaded');
					}, 200);
				}
			});
		}

		function updateCompare(data) {
			var $widget = $('.wd-header-compare');

			if ($widget.length > 0) {
				$widget.find('.wd-tools-count').text(data.count);
			}

			omniverseThemeModule.removeDuplicatedStylesFromHTML(data.table, function(html) {
				var $wcCompareWrapper = $('.wd-compare-page');
				var $wcCompareTable = $('.wd-compare-table');

				if ($wcCompareWrapper.length > 0) {
					$wcCompareWrapper.replaceWith(html);
				} else if ($wcCompareTable.length > 0) {
					$wcCompareTable.replaceWith(html);
				}
			});

			if ('undefined' !== typeof omniverse_settings.compare_by_category && 'yes' === omniverse_settings.compare_by_category) {
				omniverseThemeModule.$document.trigger('wdTabsInit');
			}
		}

		function getProductsCategory() {
			if ( omniverseThemeModule.supports_html5_storage ) {
				var fragmentProductCategory = JSON.parse( sessionStorage.getItem( cookiesName + '_fragments' ) );

				if ( 'undefined' !== typeof actions && ( actions.is_lang_switched === '1' || actions.force_reset === '1' ) ) {
					fragmentProductCategory = '';
				}

				if ( fragmentProductCategory ) {
					$.each( fragmentProductCategory, function( key, value ) {
						$( key ).replaceWith(value);
					});
				} else {
					getAjaxProductCategory();
				}
			} else {
				getAjaxProductCategory();
			}
		}

		function getAjaxProductCategory() {
			jQuery.ajax({
				url     : omniverse_settings.ajaxurl,
				data    : {
					action : 'omniverse_get_fragment_product_category_compare',
				},
				dataType: 'json',
				method  : 'GET',
				success : function(response) {
					if (response.fragments) {
						$.each( response.fragments, function( key, value ) {
							$( key ).replaceWith(value);
						});

						sessionStorage.setItem( cookiesName + '_fragments', JSON.stringify( response.fragments ) );
					} else {
						console.log('something wrong loading compare data ', response);
					}
				},
				error   : function() {
					console.log('We cant remove product compare. Something wrong with AJAX response. Probably some PHP conflict.');
				},
			});
		}

		function updateButton( $button ) {
			var addedText = $button.data('added-text');

			if ($button.find('span').length > 0) {
				$button.find('span').text(addedText);
			} else {
				$button.text(addedText);
			}

			$button.addClass('added');

			omniverseThemeModule.$document.trigger('added_to_compare');
			omniverseThemeModule.$document.trigger('wdUpdateTooltip', $button);
		}

		function updateCountWidget(count) {
			var $widget = $('.wd-header-compare');

			if ($widget.length > 0) {
				$widget.find('.wd-tools-count').text(count);
			}
		}
	};

	omniverseThemeModule.omniverseCompareUpdateState = function() {
		if ( 'undefined' === typeof omniverse_settings.compare_save_button_state || 'yes' !== omniverse_settings.compare_save_button_state || 'undefined' === typeof Cookies ) {
			return;
		}

		var cookiesName = 'omniverse_compare_list';
		var products = [];

		if (omniverse_settings.is_multisite) {
			cookiesName += '_' + omniverse_settings.current_blog_id;
		}

		var productsCookies = Cookies.get(cookiesName);

		if ( 'undefined' !== typeof productsCookies && productsCookies ) {
			products = Object.values( JSON.parse(productsCookies) );
		}

		if ( ! products.length ) {
			return;
		}

		$.each(products, function( index, id ) {
			var $button = $('.wd-compare-btn a[data-id=' + id + ']');

			if ( ! $button.length || $button.hasClass('added') ) {
				return;
			}

			$button.addClass('added');

			var addedText = $button.data('added-text');

			if ($button.find('span').length > 0) {
				$button.find('span').text(addedText);
			} else {
				$button.text(addedText);
			}
		});
	};

	$(document).ready(function() {
		omniverseThemeModule.omniverseCompare();
		omniverseThemeModule.omniverseCompareUpdateState();
	});
})(jQuery);
