<?php
/**
 * Enqueue functions.
 *
 * @package omniverse
 */

use Automattic\WooCommerce\Blocks\Utils\CartCheckoutUtils;
use Elementor\Plugin;
use DN\Modules\Checkout_Order_Table;
use DN\Modules\Layouts\Main;
use DN\Modules\Parts_Css_Files;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_is_combined_needed' ) ) {
	/**
	 * Is combined needed.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Combined key.
	 * @param mixed  $default Default value.
	 *
	 * @return bool
	 */
	function omniverse_is_combined_needed( $key, $default = false ) {
		return apply_filters( 'omniverse_enqueue_' . $key, $default ) || ( omniverse_is_elementor_installed() && ( omniverse_elementor_is_edit_mode() || omniverse_elementor_is_preview_mode() ) ) || is_singular( 'omniverse_layout' );
	}
}

if ( ! function_exists( 'omniverse_is_minified_needed' ) ) {
	/**
	 * Is minified JS files needed.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	function omniverse_is_minified_needed() {
		return apply_filters( 'omniverse_enqueue_minified_js_files', ! defined( 'SCRIPT_DEBUG' ) || ! SCRIPT_DEBUG );
	}
}

if ( ! function_exists( 'omniverse_register_libraries_scripts' ) ) {
	/**
	 * Register libraries scripts.
	 *
	 * @since 1.0.0
	 */
	function omniverse_register_libraries_scripts() {
		$config   = omniverse_get_config( 'js-libraries' );
		$minified = omniverse_is_minified_needed() ? '.min' : '';
		$version  = omniverse_get_theme_info( 'Version' );

		if ( omniverse_is_combined_needed( 'combined_js_libraries' ) ) {
			return;
		}

		foreach ( $config as $key => $libraries ) {
			foreach ( $libraries as $library ) {
				$src = OMNIVERSE_THEME_DIR . $library['file'] . $minified . '.js';

				wp_register_script( 'wd-' . $key . '-library', $src, $library['dependency'], $version, $library['in_footer'] );
			}
		}
	}

	add_action( 'wp_enqueue_scripts', 'omniverse_register_libraries_scripts', 10 );
}

if ( ! function_exists( 'omniverse_register_scripts' ) ) {
	/**
	 * Register scripts.
	 *
	 * @since 1.0.0
	 */
	function omniverse_register_scripts() {
		$config   = omniverse_get_config( 'js-scripts' );
		$minified = omniverse_is_minified_needed() ? '.min' : '';
		$version  = omniverse_get_theme_info( 'Version' );

		if ( omniverse_is_combined_needed( 'combined_js' ) ) {
			return;
		}

		foreach ( $config as $scripts ) {
			foreach ( $scripts as $script ) {
				$src = OMNIVERSE_THEME_DIR . $script['file'] . $minified . '.js';
				$deps = array();

				if ( 'omniverse-theme' !== $script['name'] ) {
					if ( 'scrollbar' !== $script['name'] ) {
						$deps = array( 'omniverse-theme' );
					}

					$name = 'wd-' . $script['name'];
				} else {
					$name = $script['name'];
				}

				wp_register_script( $name, $src, $deps, $version, $script['in_footer'] );
			}
		}
	}

	add_action( 'wp_enqueue_scripts', 'omniverse_register_scripts', 20 );
}

if ( ! function_exists( 'omniverse_enqueue_base_scripts' ) ) {
	/**
	 * Enqueue base scripts.
	 *
	 * @since 1.0.0
	 */
	function omniverse_enqueue_base_scripts() {
		$minified = omniverse_is_minified_needed() ? '.min' : '';
		$version  = omniverse_get_theme_info( 'Version' );

		// General.
		wp_enqueue_script( 'wpb_composer_front_js', false, array(), $version ); // phpcs:ignore
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		if ( omniverse_is_elementor_installed() && apply_filters( 'omniverse_enqueue_elementor_scripts', true ) ) {
			Elementor\Plugin::$instance->frontend->enqueue_scripts();
		}

		// Libraries.
		if ( omniverse_is_combined_needed( 'combined_js_libraries' ) ) {
			wp_enqueue_script( 'wd-libraries', OMNIVERSE_THEME_DIR . '/js/libs/combine' . $minified . '.js', array( 'jquery' ), $version, true );
		} else {
			omniverse_enqueue_js_library( 'device' );

			if ( omniverse_get_opt( 'ajax_shop' ) && omniverse_is_shop_archive() && ( function_exists( 'omniverse_elementor_has_location' ) && ! omniverse_elementor_has_location( 'archive' ) || ! function_exists( 'omniverse_elementor_has_location' ) ) ) {
				omniverse_enqueue_js_library( 'pjax' );
			}

			if ( ( omniverse_get_opt( 'ajax_portfolio' ) && omniverse_is_portfolio_archive() ) ) {
				omniverse_enqueue_js_library( 'pjax' );
			}

			if ( ! omniverse_woocommerce_installed() ) {
				omniverse_enqueue_js_library( 'cookie' );
			}

			$config = omniverse_get_config( 'js-libraries' );
			foreach ( $config as $key => $libraries ) {
				foreach ( $libraries as $library ) {
					if ( 'always' === omniverse_get_opt( $library['name'] . '_library' ) ) {
						omniverse_enqueue_js_library( $key );
					}
				}
			}
		}

		if ( 'always' === omniverse_get_opt( 'swiper_library' ) && ! omniverse_get_opt( 'elementor_frontend' ) ) {
			wp_enqueue_script( 'swiper' );
		}

		if ( 'always' === omniverse_get_opt( 'el_waypoints_library' ) && ! omniverse_get_opt( 'elementor_frontend' ) ) {
			wp_enqueue_script( 'elementor-waypoints' );
		}

		// Scripts.
		if ( omniverse_is_combined_needed( 'combined_js' ) ) {
			wp_enqueue_script( 'imagesloaded' );
			wp_enqueue_script( 'omniverse-theme', OMNIVERSE_THEME_DIR . '/js/scripts/combine' . $minified . '.js', array(), $version, true );
		} else {
			omniverse_enqueue_js_script( 'omniverse-theme' );
			omniverse_enqueue_js_script( 'woocommerce-notices' );
			omniverse_enqueue_js_script( 'scrollbar' );

			if ( is_admin_bar_showing() ) {
				omniverse_enqueue_js_script( 'admin-bar-slider-menu' );
			}

			if ( omniverse_woocommerce_installed() ) {
				if ( is_cart() || is_checkout() || is_account_page() ) {
					omniverse_enqueue_js_script( 'woocommerce-wrapp-table' );
				}

				if ( is_cart() || is_checkout() ) {
					wp_enqueue_script( 'wc-cart-fragments' );
				}

				if ( omniverse_get_opt( 'update_cart_quantity_change' ) && is_cart() && ! WC()->cart->is_empty() ) {
					omniverse_enqueue_js_script( 'cart-quantity' );
				}
			}

			if ( omniverse_get_opt( 'widget_toggle' ) ) {
				omniverse_enqueue_js_script( 'widgets-hidable' );
			}

			if ( ( omniverse_get_opt( 'ajax_shop' ) && omniverse_is_shop_archive() ) ) {
				omniverse_enqueue_js_script( 'ajax-filters' );
				omniverse_enqueue_js_script( 'shop-page-init' );
				omniverse_enqueue_js_script( 'back-history' );
			}

			if ( 'disable' !== omniverse_get_opt( 'shop_widgets_collapse', 'disable' ) && omniverse_is_shop_archive() ) {
				omniverse_enqueue_js_script( 'widget-collapse' );
			}

			if ( ( omniverse_get_opt( 'ajax_portfolio' ) && omniverse_is_portfolio_archive() ) ) {
				omniverse_enqueue_js_script( 'ajax-portfolio' );
			}

			$scripts_always = omniverse_get_opt( 'scripts_always_use' );
			if ( is_array( $scripts_always ) ) {
				foreach ( $scripts_always as $script ) {
					omniverse_enqueue_js_script( $script );
				}
			}
		}

		if ( omniverse_is_elementor_installed() && ( omniverse_elementor_is_edit_mode() || omniverse_elementor_is_preview_mode() ) ) {
			wp_enqueue_script( 'wd-google-map-api', 'https://maps.google.com/maps/api/js?libraries=geometry&callback=omniverseThemeModule.googleMapsCallback&v=weekly&key=' . omniverse_get_opt( 'google_map_api_key' ), array( 'omniverse-theme' ), $version, true );
			wp_enqueue_script( 'wd-maplace', OMNIVERSE_THEME_DIR . '/js/libs/maplace' . $minified . '.js', array( 'wd-google-map-api' ), $version, true );
		}

		wp_add_inline_script( 'omniverse-theme', omniverse_settings_js() );
		wp_localize_script( 'omniverse-theme', 'omniverse_settings', omniverse_get_localized_string_array() );

		wp_register_style( 'omniverse-inline-css', '' );
	}

	add_action( 'wp_enqueue_scripts', 'omniverse_enqueue_base_scripts', 30 );
}

if ( ! function_exists( 'omniverse_enqueue_js_script' ) ) {
	/**
	 * Enqueue js script.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key        Script name.
	 * @param string $responsive Responsive key.
	 */
	function omniverse_enqueue_js_script( $key, $responsive = '' ) {
		$config          = omniverse_get_config( 'js-scripts' );
		$scripts_not_use = omniverse_get_opt( 'scripts_not_use' );

		if ( ! isset( $config[ $key ] ) || omniverse_is_combined_needed( 'combined_js' ) ) {
			return;
		}

		foreach ( $config[ $key ] as $data ) {
			if ( ( 'only_mobile' === $responsive && ! wp_is_mobile() ) || ( 'only_desktop' === $responsive && wp_is_mobile() ) || ( is_array( $scripts_not_use ) && in_array( $data['name'], $scripts_not_use ) ) ) { // phpcs:ignore
				continue;
			}

			$name = 'omniverse-theme' !== $data['name'] ? 'wd-' . $data['name'] : $data['name'];
			wp_enqueue_script( $name );
		}
	}
}

if ( ! function_exists( 'omniverse_enqueue_js_library' ) ) {
	/**
	 * Enqueue js library.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key        Script name.
	 * @param string $responsive Responsive key.
	 */
	function omniverse_enqueue_js_library( $key, $responsive = '' ) {
		$config = omniverse_get_config( 'js-libraries' );

		if ( ! isset( $config[ $key ] ) || omniverse_is_combined_needed( 'combined_js_libraries' ) ) {
			return;
		}

		foreach ( $config[ $key ] as $data ) {
			if ( ( 'only_mobile' === $responsive && ! wp_is_mobile() ) || ( 'only_desktop' === $responsive && wp_is_mobile() ) || 'not_use' === omniverse_get_opt( $data['name'] . '_library' ) ) {
				continue;
			}

			wp_enqueue_script( 'wd-' . $key . '-library' );
		}
	}
}

if ( ! function_exists( 'omniverse_dequeue_scripts' ) ) {
	/**
	 * Dequeue scripts.
	 *
	 * @since 1.0.0
	 */
	function omniverse_dequeue_scripts() {
		$dequeue_scripts = explode( ',', omniverse_get_opt( 'dequeue_scripts' ) );

		if ( is_array( $dequeue_scripts ) ) {
			foreach ( $dequeue_scripts as $script ) {
				wp_deregister_script( trim( $script ) );
				wp_dequeue_script( trim( $script ) );
			}
		}

		wp_dequeue_script( 'flexslider' );
		wp_dequeue_script( 'photoswipe-ui-default' );
		wp_dequeue_script( 'prettyPhoto-init' );
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_style( 'photoswipe-default-skin' );

		// Remove CF7.
		if ( ! omniverse_get_opt( 'cf7_js', '1' ) ) {
			wp_deregister_script( 'contact-form-7' );
			wp_dequeue_script( 'contact-form-7' );
		}

		// Remove animations.
		if ( ! omniverse_get_opt( 'elementor_animations', '1' ) ) {
			wp_deregister_style( 'elementor-animations' );
			wp_dequeue_style( 'elementor-animations' );
		}

		// Remove icons.
		if ( ! omniverse_get_opt( 'elementor_icons', '1' ) && ( ! is_user_logged_in() || ( is_user_logged_in() && ! current_user_can( 'administrator' ) ) ) ) {
			wp_deregister_style( 'elementor-icons' );
			wp_dequeue_style( 'elementor-icons' );
		}

		// Remove dialog.
		if ( ! omniverse_get_opt( 'elementor_dialog_library' ) && omniverse_is_elementor_installed() ) {
			$scripts = wp_scripts();
			if ( ! ( $scripts instanceof WP_Scripts ) ) {
				return;
			}

			$handles_to_remove = array(
				'elementor-dialog',
			);

			$handles_updated = false;

			foreach ( $scripts->registered as $dependency_object_id => $dependency_object ) {
				if ( 'elementor-frontend' === $dependency_object_id ) {
					if ( ! ( $dependency_object instanceof _WP_Dependency ) || empty( $dependency_object->deps ) ) {
						return;
					}

					foreach ( $dependency_object->deps as $dep_key => $handle ) {
						if ( in_array( $handle, $handles_to_remove ) ) { // phpcs:ignore
							unset( $dependency_object->deps[ $dep_key ] );
							$dependency_object->deps = array_values( $dependency_object->deps );
							$handles_updated         = true;
						}
					}
				}
			}

			if ( $handles_updated && ! omniverse_elementor_is_edit_mode() && ! omniverse_elementor_is_preview_mode() ) {
				wp_deregister_script( 'elementor-dialog' );
				wp_dequeue_script( 'elementor-dialog' );
			}
		}

		// Elementor frontend.
		if ( ! omniverse_get_opt( 'elementor_frontend', '1' ) && omniverse_is_elementor_installed() && ! omniverse_elementor_is_edit_mode() && ! omniverse_elementor_is_preview_mode() ) {
			wp_deregister_script( 'elementor-frontend' );
			wp_dequeue_script( 'elementor-frontend' );
		}

		// Zoom.
		if ( 'zoom' !== omniverse_get_opt( 'image_action' ) ) {
			wp_deregister_script( 'zoom' );
			wp_dequeue_script( 'zoom' );
		}

		// Gutenberg.
		if ( omniverse_get_opt( 'disable_gutenberg_css' ) ) {
			wp_deregister_style( 'wp-block-library' );
			wp_dequeue_style( 'wp-block-library' );

			wp_deregister_style( 'wc-block-style' );
			wp_dequeue_style( 'wc-block-style' );

			wp_deregister_style( 'wc-blocks-style' );
			wp_dequeue_style( 'wc-blocks-style' );

			wp_deregister_style( 'wc-blocks-packages-style' );
			wp_dequeue_style( 'wc-blocks-packages-style' );

			wp_dequeue_style( 'classic-theme-styles' );

			if ( omniverse_woocommerce_installed() && ! empty( wp_styles()->registered ) ) {
				foreach ( wp_styles()->registered as $key => $data ) {
					if ( false !== strpos( $key, 'wc-blocks-style-' ) ) {
						wp_deregister_style( $key );
						wp_dequeue_script( $key );
					}
				}
			}
		}
	}

	add_action( 'wp_enqueue_scripts', 'omniverse_dequeue_scripts', 2000 );
}

if ( ! function_exists( 'omniverse_dequeue_elementor_frontend' ) ) {
	/**
	 * Dequeue elementor frontend.
	 *
	 * @since 1.0.0
	 */
	function omniverse_dequeue_elementor_frontend() {
		$version = omniverse_get_theme_info( 'Version' );
		$is_rtl  = is_rtl() ? '-rtl' : '';

		if ( omniverse_is_elementor_installed() && omniverse_get_opt( 'load_elementor_optimized_css' ) && ! omniverse_elementor_is_edit_mode() && ! omniverse_elementor_is_preview_mode() ) {
			$frontend_dependencies = [];

			if ( ! Plugin::$instance->experiments->is_feature_active( 'e_dom_optimization' ) ) {
				$frontend_dependencies[] = 'elementor-frontend-legacy';
			}

			wp_deregister_style( 'elementor-frontend' );
			wp_dequeue_style( 'elementor-frontend' );

			wp_register_style( 'elementor-frontend', OMNIVERSE_STYLES . '/elementor-optimized' . $is_rtl . '.min.css', $frontend_dependencies, $version );
			wp_enqueue_style( 'elementor-frontend' );
		}
	}

	add_action( 'wp_enqueue_scripts', 'omniverse_dequeue_elementor_frontend', 6 );
}

if ( ! function_exists( 'omniverse_clear_menu_transient' ) ) {
	/**
	 * Clear menu session storage key hash on save menu/html block.
	 *
	 * @since 1.0.0
	 */
	function omniverse_clear_menu_transient() {
		delete_transient( 'omniverse-menu-hash-time' );
	}

	add_action( 'wp_update_nav_menu_item', 'omniverse_clear_menu_transient', 11, 1 );
	add_action( 'save_post_cms_block', 'omniverse_clear_menu_transient', 30, 3 );
}

if ( ! function_exists( 'omniverse_get_localized_string_array' ) ) {
	/**
	 * Get localize array
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function omniverse_get_localized_string_array() {
		$version             = omniverse_get_theme_info( 'Version' );
		$menu_hash_transient = get_transient( 'omniverse-menu-hash-time' );
		if ( false === $menu_hash_transient ) {
			$menu_hash_transient = time();
			set_transient( 'omniverse-menu-hash-time', $menu_hash_transient );
		}

		$site_custom_width     = omniverse_get_opt( 'site_custom_width' );
		$predefined_site_width = omniverse_get_opt( 'site_width' );

		$site_width = '';

		if ( 'full-width' === $predefined_site_width ) {
			$site_width = 1222;
		} elseif ( 'boxed' === $predefined_site_width ) {
			$site_width = 1160;
		} elseif ( 'boxed-2' === $predefined_site_width ) {
			$site_width = 1160;
		} elseif ( 'wide' === $predefined_site_width ) {
			$site_width = 1600;
		} elseif ( 'custom' === $predefined_site_width ) {
			$site_width = $site_custom_width;
		}

		return apply_filters(
			'omniverse_localized_string_array',
			array(
				'menu_storage_key'                       => apply_filters( 'omniverse_menu_storage_key', 'omniverse_' . md5( get_current_blog_id() . '_' . get_site_url( get_current_blog_id(), '/' ) . get_template() . $menu_hash_transient . $version ) ),
				'ajax_dropdowns_save'                    => apply_filters( 'zs_ajax_dropdowns_save', true ),
				'photoswipe_close_on_scroll'             => apply_filters( 'omniverse_photoswipe_close_on_scroll', true ),
				'woocommerce_ajax_add_to_cart'           => get_option( 'woocommerce_enable_ajax_add_to_cart' ),
				'variation_gallery_storage_method'       => omniverse_get_opt( 'variation_gallery_storage_method', 'old' ),
				'elementor_no_gap'                       => omniverse_get_opt( 'negative_gap', 'enabled' ),
				'adding_to_cart'                         => esc_html__( 'Processing', 'omniverse' ),
				'added_to_cart'                          => esc_html__( 'Product was successfully added to your cart.', 'omniverse' ),
				'continue_shopping'                      => esc_html__( 'Continue shopping', 'omniverse' ),
				'view_cart'                              => esc_html__( 'View Cart', 'omniverse' ),
				'go_to_checkout'                         => esc_html__( 'Checkout', 'omniverse' ),
				'loading'                                => esc_html__( 'Loading...', 'omniverse' ),
				'countdown_days'                         => esc_html__( 'days', 'omniverse' ),
				'countdown_hours'                        => esc_html__( 'hr', 'omniverse' ),
				'countdown_mins'                         => esc_html__( 'min', 'omniverse' ),
				'countdown_sec'                          => esc_html__( 'sc', 'omniverse' ),
				'cart_url'                               => ( omniverse_woocommerce_installed() ) ? esc_url( wc_get_cart_url() ) : '',
				'ajaxurl'                                => admin_url( 'admin-ajax.php' ),
				'add_to_cart_action'                     => ( omniverse_get_opt( 'add_to_cart_action' ) ) ? esc_js( omniverse_get_opt( 'add_to_cart_action' ) ) : 'widget',
				'added_popup'                            => ( omniverse_get_opt( 'added_to_cart_popup' ) ) ? 'yes' : 'no',
				'categories_toggle'                      => ( omniverse_get_opt( 'categories_toggle' ) ) ? 'yes' : 'no',
				'enable_popup'                           => ( omniverse_get_opt( 'promo_popup' ) ) ? 'yes' : 'no',
				'popup_delay'                            => ( omniverse_get_opt( 'promo_timeout' ) ) ? (int) omniverse_get_opt( 'promo_timeout' ) : 1000,
				'popup_event'                            => omniverse_get_opt( 'popup_event' ),
				'popup_scroll'                           => ( omniverse_get_opt( 'popup_scroll' ) ) ? (int) omniverse_get_opt( 'popup_scroll' ) : 1000,
				'popup_pages'                            => ( omniverse_get_opt( 'popup_pages' ) ) ? (int) omniverse_get_opt( 'popup_pages' ) : 0,
				'promo_popup_hide_mobile'                => ( omniverse_get_opt( 'promo_popup_hide_mobile' ) ) ? 'yes' : 'no',
				'product_images_captions'                => ( omniverse_get_opt( 'product_images_captions' ) ) ? 'yes' : 'no',
				'ajax_add_to_cart'                       => ( apply_filters( 'omniverse_ajax_add_to_cart', true ) ) ? omniverse_get_opt( 'single_ajax_add_to_cart' ) : false,
				'all_results'                            => esc_html__( 'View all results', 'omniverse' ),
				'zoom_enable'                            => ( omniverse_get_opt( 'image_action' ) === 'zoom' ) ? 'yes' : 'no',
				'ajax_scroll'                            => ( omniverse_get_opt( 'ajax_scroll' ) ) ? 'yes' : 'no',
				'ajax_scroll_class'                      => apply_filters( 'omniverse_ajax_scroll_class', '.main-page-wrapper' ),
				'ajax_scroll_offset'                     => apply_filters( 'omniverse_ajax_scroll_offset', 100 ),
				'infinit_scroll_offset'                  => apply_filters( 'omniverse_infinit_scroll_offset', 300 ),
				'product_slider_auto_height'             => ( omniverse_get_opt( 'product_slider_auto_height' ) ) ? 'yes' : 'no',
				'price_filter_action'                    => ( apply_filters( 'price_filter_action', 'click' ) === 'submit' ) ? 'submit' : 'click',
				'product_slider_autoplay'                => apply_filters( 'omniverse_product_slider_autoplay', false ),
				'close'                                  => esc_html__( 'Close (Esc)', 'omniverse' ),
				'share_fb'                               => esc_html__( 'Share on Facebook', 'omniverse' ),
				'pin_it'                                 => esc_html__( 'Pin it', 'omniverse' ),
				'tweet'                                  => esc_html__( 'Share on X', 'omniverse' ),
				'download_image'                         => esc_html__( 'Download image', 'omniverse' ),
				'off_canvas_column_close_btn_text'       => esc_html__( 'Close', 'omniverse' ),
				'cookies_version'                        => ( omniverse_get_opt( 'cookies_version' ) ) ? (int) omniverse_get_opt( 'cookies_version' ) : 1,
				'header_banner_version'                  => ( omniverse_get_opt( 'header_banner_version' ) ) ? (int) omniverse_get_opt( 'header_banner_version' ) : 1,
				'promo_version'                          => ( omniverse_get_opt( 'promo_version' ) ) ? (int) omniverse_get_opt( 'promo_version' ) : 1,
				'header_banner_close_btn'                => omniverse_get_opt( 'header_close_btn' ) ? 'yes' : 'no',
				'header_banner_enabled'                  => omniverse_get_opt( 'header_banner' ) ? 'yes' : 'no',
				'whb_header_clone'                       => omniverse_get_config( 'header-clone-structure' ),
				'pjax_timeout'                           => apply_filters( 'omniverse_pjax_timeout', 5000 ),
				'split_nav_fix'                          => apply_filters( 'omniverse_split_nav_fix', false ),
				'shop_filters_close'                     => omniverse_get_opt( 'shop_filters_close' ) ? 'yes' : 'no',
				'woo_installed'                          => omniverse_woocommerce_installed(),
				'base_hover_mobile_click'                => omniverse_get_opt( 'base_hover_mobile_click' ) ? 'yes' : 'no',
				'centered_gallery_start'                 => apply_filters( 'omniverse_centered_gallery_start', 1 ),
				'quickview_in_popup_fix'                 => apply_filters( 'omniverse_quickview_in_popup_fix', false ),
				'one_page_menu_offset'                   => apply_filters( 'omniverse_one_page_menu_offset', 150 ),
				'hover_width_small'                      => apply_filters( 'omniverse_hover_width_small', true ),
				'is_multisite'                           => is_multisite(),
				'current_blog_id'                        => get_current_blog_id(),
				'swatches_scroll_top_desktop'            => omniverse_get_opt( 'swatches_scroll_top_desktop' ) ? 'yes' : 'no',
				'swatches_scroll_top_mobile'             => omniverse_get_opt( 'swatches_scroll_top_mobile' ) ? 'yes' : 'no',
				'lazy_loading_offset'                    => omniverse_get_opt( 'lazy_loading_offset' ),
				'add_to_cart_action_timeout'             => omniverse_get_opt( 'add_to_cart_action_timeout' ) ? 'yes' : 'no',
				'add_to_cart_action_timeout_number'      => omniverse_get_opt( 'add_to_cart_action_timeout_number' ),
				'single_product_variations_price'        => omniverse_get_opt( 'single_product_variations_price' ) ? 'yes' : 'no',
				'google_map_style_text'                  => esc_html__( 'Custom style', 'omniverse' ),
				'quick_shop'                             => omniverse_get_opt( 'quick_shop_variable' ) ? 'yes' : 'no',
				'sticky_product_details_offset'          => apply_filters( 'omniverse_sticky_product_details_offset', 150 ),
				'preloader_delay'                        => apply_filters( 'omniverse_preloader_delay', 300 ),
				'comment_images_upload_size_text'        => sprintf( esc_html__( 'Some files are too large. Allowed file size is %s.', 'omniverse' ), size_format( (int) omniverse_get_opt( 'single_product_comment_images_upload_size' ) * MB_IN_BYTES ) ), // phpcs:ignore
				'comment_images_count_text'              => sprintf( esc_html__( 'You can upload up to %s images to your review.', 'omniverse' ), omniverse_get_opt( 'single_product_comment_images_count' ) ), // phpcs:ignore
				'single_product_comment_images_required' => omniverse_get_opt( 'single_product_comment_images_required' ) ? 'yes' : 'no', // phpcs:ignore
				'comment_required_images_error_text'     => esc_html__( 'Image is required.', 'omniverse' ), // phpcs:ignore
				'comment_images_upload_mimes_text'       => sprintf( esc_html__( 'You are allowed to upload images only in %s formats.', 'omniverse' ), apply_filters( 'zs_comment_images_upload_mimes', 'png, jpeg' ) ), // phpcs:ignore
				'comment_images_added_count_text'        => esc_html__( 'Added %s image(s)', 'omniverse' ), // phpcs:ignore
				'comment_images_upload_size'             => (int) omniverse_get_opt( 'single_product_comment_images_upload_size' ) * MB_IN_BYTES,
				'comment_images_count'                   => omniverse_get_opt( 'single_product_comment_images_count' ),
				'search_input_padding'                   => apply_filters( 'wd_search_input_padding', false ) ? 'yes' : 'no',
				'comment_images_upload_mimes'            => apply_filters(
					'omniverse_comment_images_upload_mimes',
					array(
						'jpg|jpeg|jpe' => 'image/jpeg',
						'png'          => 'image/png',
					)
				),
				'home_url'                               => home_url( '/' ),
				'shop_url'                               => omniverse_woocommerce_installed() ? esc_url( wc_get_page_permalink( 'shop' ) ) : '',
				'age_verify'                             => ( omniverse_get_opt( 'age_verify' ) ) ? 'yes' : 'no',
				'banner_version_cookie_expires'          => apply_filters( 'omniverse_banner_version_cookie_expires', 60 ),
				'promo_version_cookie_expires'           => apply_filters( 'omniverse_promo_version_cookie_expires', 7 ),
				'age_verify_expires'                     => apply_filters( 'omniverse_age_verify_expires', 30 ),
				'cart_redirect_after_add'                => get_option( 'woocommerce_cart_redirect_after_add' ),
				'swatches_labels_name'                   => omniverse_get_opt( 'swatches_labels_name' ) ? 'yes' : 'no',
				'product_categories_placeholder'         => esc_html__( 'Select a category', 'woocommerce' ),
				'product_categories_no_results'          => esc_html__( 'No matches found', 'woocommerce' ),
				'cart_hash_key'                          => apply_filters( 'woocommerce_cart_hash_key', 'wc_cart_hash_' . md5( get_current_blog_id() . '_' . get_site_url( get_current_blog_id(), '/' ) . get_template() ) ),
				'fragment_name'                          => apply_filters( 'woocommerce_cart_fragment_name', 'wc_fragments_' . md5( get_current_blog_id() . '_' . get_site_url( get_current_blog_id(), '/' ) . get_template() ) ),
				'photoswipe_template'                    => '<div class="pswp" aria-hidden="true" role="dialog" tabindex="-1"><div class="pswp__bg"></div><div class="pswp__scroll-wrap"><div class="pswp__container"><div class="pswp__item"></div><div class="pswp__item"></div><div class="pswp__item"></div></div><div class="pswp__ui pswp__ui--hidden"><div class="pswp__top-bar"><div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="' . esc_html__( 'Close (Esc)', 'woocommerce' ) . '"></button> <button class="pswp__button pswp__button--share" title="' . esc_html__( 'Share', 'woocommerce' ) . '"></button> <button class="pswp__button pswp__button--fs" title="' . esc_html__( 'Toggle fullscreen', 'woocommerce' ) . '"></button> <button class="pswp__button pswp__button--zoom" title="' . esc_html__( 'Zoom in/out', 'woocommerce' ) . '"></button><div class="pswp__preloader"><div class="pswp__preloader__icn"><div class="pswp__preloader__cut"><div class="pswp__preloader__donut"></div></div></div></div></div><div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap"><div class="pswp__share-tooltip"></div></div><button class="pswp__button pswp__button--arrow--left" title="' . esc_html__( 'Previous (arrow left)', 'woocommerce' ) . '"></button> <button class="pswp__button pswp__button--arrow--right" title="' . esc_html__( 'Next (arrow right)', 'woocommerce' ) . '>"></button><div class="pswp__caption"><div class="pswp__caption__center"></div></div></div></div></div>',
				'load_more_button_page_url'              => apply_filters( 'omniverse_load_more_button_page_url', true ) ? 'yes' : 'no',
				'load_more_button_page_url_opt'          => omniverse_get_opt( 'load_more_button_page_url', true ) ? 'yes' : 'no',
				'menu_item_hover_to_click_on_responsive' => apply_filters( 'omniverse_menu_item_hover_to_click_on_responsive', false ) ? 'yes' : 'no',
				'clear_menu_offsets_on_resize'           => apply_filters( 'omniverse_clear_menu_offsets_on_resize', true ) ? 'yes' : 'no',
				'three_sixty_framerate'                  => apply_filters( 'omniverse_three_sixty_framerate', 60 ),
				'three_sixty_prev_next_frames'           => apply_filters( 'omniverse_three_sixty_prev_next_frames', 5 ),
				'ajax_search_delay'                      => apply_filters( 'omniverse_ajax_search_delay', 300 ),
				'animated_counter_speed'                 => apply_filters( 'omniverse_animated_counter_speed', 3000 ),
				'site_width'                             => $site_width,
				'cookie_secure_param'                    => omniverse_cookie_secure_param(),
				'cookie_path'                            => COOKIEPATH,
				'slider_distortion_effect'               => 'sliderWithNoise',
				'current_page_builder'                   => omniverse_get_current_page_builder(),
				'collapse_footer_widgets'                => omniverse_get_opt( 'collapse_footer_widgets' ) ? 'yes' : 'no',
				'carousel_breakpoints'                   => omniverse_get_carousel_breakpoints(),
				'ajax_fullscreen_content'                => omniverse_get_opt( 'ajax_fullscreen_content', true ) ? 'yes' : 'no',
				'grid_gallery_control'                   => omniverse_get_opt( 'grid_gallery_control', 'hover' ),
				'grid_gallery_enable_arrows'             => omniverse_get_opt( 'grid_gallery_enable_arrows', 'none' ),
				'add_to_cart_text'                       => esc_html__( 'Add to cart', 'omniverse' ),
				// translators: %s The name of the previous menu.
				'mobile_navigation_drilldown_back_to'    => esc_html__( 'Back to %s', 'omniverse' ),
				'mobile_navigation_drilldown_back_to_main_menu' => esc_html__( 'Back to menu', 'omniverse' ),
				'ajax_links'                             => apply_filters( 'omniverse_ajax_links', '.wd-nav-product-cat a, .website-wrapper .widget_product_categories a, .widget_layered_nav_filters a, .woocommerce-widget-layered-nav a, .filters-area:not(.custom-content) a, body.post-type-archive-product:not(.woocommerce-account) .woocommerce-pagination a, body.tax-product_cat:not(.woocommerce-account) .woocommerce-pagination a, .wd-shop-tools a:not(.breadcrumb-link), .omniverse-woocommerce-layered-nav a, .omniverse-price-filter a, .wd-clear-filters a, .omniverse-woocommerce-sort-by a, .woocommerce-widget-layered-nav-list a, .wd-widget-stock-status a, .widget_nav_mega_menu a, .wd-products-shop-view a, .wd-products-per-page a, .category-grid-item a, .wd-cat a, body[class*="tax-pa_"] .woocommerce-pagination a' ),
			)
		);
	}
}

// CSS.
if ( ! function_exists( 'omniverse_enqueue_base_styles' ) ) {
	function omniverse_enqueue_base_styles() {
		$uploads = wp_upload_dir();
		$version = omniverse_get_theme_info( 'Version' );
		$is_rtl  = is_rtl() ? '-rtl' : '';

		if ( omniverse_is_elementor_installed() ) {
			Elementor\Plugin::$instance->frontend->enqueue_styles();
		}

		wp_deregister_style( 'font-awesome' );
		wp_dequeue_style( 'font-awesome' );

		wp_dequeue_style( 'vc_pageable_owl-carousel-css' );
		wp_dequeue_style( 'vc_pageable_owl-carousel-css-theme' );

		if ( ! defined( 'YITH_WCWL' ) ) {
			wp_deregister_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
		}

		if ( defined( 'WC_STRIPE_VERSION' ) ) {
			wp_deregister_style( 'stripe_styles' );
			wp_dequeue_style( 'stripe_styles' );
		}

		wp_deregister_style( 'contact-form-7' );
		wp_dequeue_style( 'contact-form-7' );
		wp_deregister_style( 'contact-form-7-rtl' );
		wp_dequeue_style( 'contact-form-7-rtl' );

		$wpbfile = get_option( 'omniverse-generated-wpbcss-file' );
		if ( isset( $wpbfile['name'] ) && 'wpb' === omniverse_get_opt( 'builder', 'wpb' ) ) {
			$wpbfile_path = set_url_scheme( $uploads['basedir'] . $wpbfile['name'] );
			$wpbfile_url  = set_url_scheme( $uploads['baseurl'] . $wpbfile['name'] );

			$wpbfile_data    = file_exists( $wpbfile_path ) ? get_file_data( $wpbfile_path, array( 'Version' => 'Version' ) ) : array();
			$wpbfile_version = isset( $wpbfile_data['Version'] ) ? $wpbfile_data['Version'] : '';
			if ( $wpbfile_version && version_compare( OMNIVERSE_WPB_CSS_VERSION, $wpbfile_version, '==' ) ) {
				$inline_styles = wp_styles()->get_data( 'js_composer_front', 'after' );

				wp_deregister_style( 'js_composer_front' );
				wp_dequeue_style( 'js_composer_front' );
				wp_register_style( 'js_composer_front', $wpbfile_url, array(), $version );
				if ( ! empty( $inline_styles ) ) {
					$inline_styles = implode( "\n", $inline_styles );
					wp_add_inline_style( 'js_composer_front', $inline_styles );
				}
			}
		}

		wp_enqueue_style( 'js_composer_front', false, array(), $version );

		if ( 'always' === omniverse_get_opt( 'font_awesome_css' ) ) {
			if ( 'wpb' === omniverse_get_current_page_builder() ) {
				wp_enqueue_style( 'vc_font_awesome_5' );
				wp_enqueue_style( 'vc_font_awesome_5_shims' );
			} else {
				wp_enqueue_style( 'elementor-icons-fa-solid' );
				wp_enqueue_style( 'elementor-icons-fa-brands' );
				wp_enqueue_style( 'elementor-icons-fa-regular' );
			}
		}

		wp_enqueue_style( 'bootstrap', OMNIVERSE_STYLES . '/bootstrap-light.min.css', array(), $version );

		if ( omniverse_is_combined_needed( 'combined_css' ) ) {
			if ( 'elementor' === omniverse_get_current_page_builder() ) {
				$style_url = OMNIVERSE_STYLES . '/style' . $is_rtl . '-elementor.min.css';
			} else {
				$style_url = OMNIVERSE_THEME_DIR . '/style.min.css';

				if ( $is_rtl ) {
					$style_url = OMNIVERSE_STYLES . '/style' . $is_rtl . '.min.css';
				}
			}

			wp_enqueue_style( 'omniverse-style', $style_url, array( 'bootstrap' ), $version );
		} else {
			wp_enqueue_style( 'omniverse-style', OMNIVERSE_THEME_DIR . '/css/parts/base' . $is_rtl . '.min.css', array( 'bootstrap' ), $version );
		}

		// Frontend admin bar.
		if ( is_admin_bar_showing() ) {
			wp_enqueue_style( 'omniverse-frontend-admin-bar', OMNIVERSE_ASSETS . '/css/parts/base-adminbar.min.css', array(), $version );
		}

		// load typekit fonts.
		$typekit_id = omniverse_get_opt( 'typekit_id' );

		if ( $typekit_id ) {
			$project_ids = explode( ',', $typekit_id );

			foreach ( $project_ids as $id ) {
				wp_enqueue_style( 'omniverse-typekit-' . $id, 'https://use.typekit.net/' . esc_attr( $id ) . '.css', array(), $version );
			}
		}

		if ( omniverse_is_elementor_installed() && function_exists( 'omniverse_elementor_is_edit_mode' ) && ( omniverse_elementor_is_edit_mode() || omniverse_elementor_is_preview_page() || omniverse_elementor_is_preview_mode() ) ) {
			wp_enqueue_style( 'omniverse-elementor-editor', OMNIVERSE_THEME_DIR . '/inc/integrations/elementor/assets/css/editor.css', array(), $version );
		}

		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}

	add_action( 'wp_enqueue_scripts', 'omniverse_enqueue_base_styles', 10000 );
}

if ( ! function_exists( 'omniverse_force_enqueue_styles' ) ) {
	/**
	 * Force enqueue styles.
	 */
	function omniverse_force_enqueue_styles() {
		$styles_always = omniverse_get_opt( 'styles_always_use' );
		if ( is_array( $styles_always ) ) {
			foreach ( $styles_always as $style ) {
				omniverse_force_enqueue_style( $style );
			}
		}

		$predefined_site_width = omniverse_get_opt( 'site_width' );

		if ( 'boxed' === $predefined_site_width || 'boxed-2' === $predefined_site_width ) {
			omniverse_force_enqueue_style( 'layout-wrapper-boxed' );
		}

		$header_settings = whb_get_settings();

		if ( ( isset( $header_settings['overlap'] ) && $header_settings['overlap'] ) && ( isset( $header_settings['boxed'] ) && $header_settings['boxed'] ) ) {
			omniverse_force_enqueue_style( 'header-boxed' );
		}

		if ( is_active_widget( 0, 0, 'calendar' ) ) {
			omniverse_force_enqueue_style( 'widget-calendar' );
		}

		if ( is_active_widget( 0, 0, 'rss' ) ) {
			omniverse_force_enqueue_style( 'widget-rss' );
		}

		if ( is_active_widget( 0, 0, 'woocommerce_product_tag_cloud' ) || is_active_widget( 0, 0, 'tag_cloud' ) ) {
			omniverse_force_enqueue_style( 'widget-tag-cloud' );
		}

		if ( is_active_widget( 0, 0, 'recent-comments' ) || is_active_widget( 0, 0, 'recent-posts' ) ) {
			omniverse_force_enqueue_style( 'widget-recent-post-comments' );
		}

		if ( is_active_widget( 0, 0, 'omniverse-recent-posts' ) ) {
			omniverse_force_enqueue_style( 'widget-wd-recent-posts' );
		}

		if ( is_active_widget( 0, 0, 'nav_mega_menu' ) ) {
			omniverse_force_enqueue_style( 'widget-nav-mega-menu' );
		}

		if ( is_active_widget( 0, 0, 'categories' ) || is_active_widget( 0, 0, 'pages' ) || is_active_widget( 0, 0, 'archives' ) || is_active_widget( 0, 0, 'nav_menu' ) ) {
			omniverse_force_enqueue_style( 'widget-nav' );
		}

		if ( is_active_widget( 0, 0, 'omniverse-woocommerce-layered-nav' ) ) {
			omniverse_force_enqueue_style( 'widget-wd-layered-nav' );
			omniverse_force_enqueue_style( 'woo-mod-swatches-base' );
			omniverse_force_enqueue_style( 'woo-mod-swatches-filter' );
		}

		if ( is_active_widget( 0, 0, 'woocommerce_product_categories' ) ) {
			omniverse_force_enqueue_style( 'widget-product-cat' );
		}

		if ( is_active_widget( 0, 0, 'woocommerce_layered_nav' ) || is_active_widget( 0, 0, 'wd-widget-stock-status' ) ) {
			omniverse_force_enqueue_style( 'widget-layered-nav-stock-status' );
		}

		if ( is_active_widget( 0, 0, 'woocommerce_layered_nav_filters' ) ) {
			omniverse_force_enqueue_style( 'widget-active-filters' );
		}

		if ( is_active_widget( 0, 0, 'omniverse-price-filter' ) ) {
			omniverse_force_enqueue_style( 'widget-price-filter' );
		}

		if ( is_active_widget( 0, 0, 'woocommerce_products' ) || is_active_widget( 0, 0, 'woocommerce_top_rated_products' ) ) {
			omniverse_force_enqueue_style( 'widget-product-list' );
		}

		if ( is_active_widget( 0, 0, 'woocommerce_widget_cart' ) ) {
			omniverse_force_enqueue_style( 'widget-shopping-cart' );
		}

		if ( is_active_widget( 0, 0, 'woocommerce_price_filter' ) ) {
			omniverse_force_enqueue_style( 'widget-slider-price-filter' );
		}

		if ( is_active_widget( 0, 0, 'omniverse-user-panel' ) ) {
			omniverse_force_enqueue_style( 'widget-user-panel' );
		}

		if ( is_active_widget( 0, 0, 'woocommerce_rating_filter' ) || is_active_widget( 0, 0, 'woocommerce_recent_reviews' ) || is_active_widget( 0, 0, 'omniverse-woocommerce-sort-by' ) ) {
			omniverse_force_enqueue_style( 'widget-woo-other' );
		}

		if ( is_singular( 'post' ) ) {
			omniverse_force_enqueue_style( 'blog-single-base' );
		}

		if ( omniverse_get_opt( 'sticky_footer' ) ) {
			omniverse_force_enqueue_style( 'footer-sticky' );
		}

		if ( omniverse_get_opt( 'lazy_loading' ) ) {
			omniverse_force_enqueue_style( 'lazy-loading' );
		}

		if ( is_singular( 'post' ) || omniverse_is_blog_archive() ) {
			omniverse_force_enqueue_style( 'blog-base' );
		}

		if ( is_singular( 'portfolio' ) || omniverse_is_portfolio_archive() ) {
			omniverse_force_enqueue_style( 'portfolio-base' );
		}

		if ( is_404() ) {
			omniverse_force_enqueue_style( 'page-404' );
		}

		if ( is_search() ) {
			omniverse_force_enqueue_style( 'page-search-results' );
		}

		if ( ! omniverse_get_opt( 'disable_gutenberg_css' ) ) {
			omniverse_force_enqueue_style( 'wp-gutenberg' );
		}

		if ( class_exists( 'ANR' ) ) {
			omniverse_force_enqueue_style( 'advanced-nocaptcha', true );
		}

		if ( defined( 'WPCF7_VERSION' ) && omniverse_get_opt( 'cf7_css_js', '1' ) ) {
			omniverse_force_enqueue_style( 'wpcf7', true );
		}

		if ( function_exists( '_mc4wp_load_plugin' ) && ! get_option( 'wd_import_theme_version' ) ) {
			omniverse_force_enqueue_style( 'mc4wp', true );
		}

		if ( class_exists( 'bbPress' ) ) {
			omniverse_force_enqueue_style( 'bbpress', true );
		}

		if ( class_exists( 'WOOCS_STARTER' ) ) {
			omniverse_force_enqueue_style( 'woo-curr-switch', true );
		}

		if ( class_exists( 'WeDevs_Dokan' ) ) {
			omniverse_force_enqueue_style( 'woo-dokan-vend', true );
		}

		if ( class_exists( 'WooCommerce_Germanized' ) ) {
			omniverse_force_enqueue_style( 'woo-germanized', true );
		}

		if ( defined( 'WC_GATEWAY_PPEC_VERSION' ) ) {
			omniverse_force_enqueue_style( 'woo-paypal-express', true );
		}

		if ( defined( 'RS_REVISION' ) ) {
			omniverse_force_enqueue_style( 'revolution-slider', true );
		}

		if ( defined( 'WC_STRIPE_VERSION' ) && omniverse_woocommerce_installed() && ( is_product() || is_cart() || is_checkout() || is_account_page() ) ) {
			omniverse_force_enqueue_style( 'woo-stripe', true );
		}

		if ( defined( 'WCPAY_PLUGIN_FILE' ) ) {
			omniverse_force_enqueue_style( 'woo-payments', true );
		}

		if ( defined( 'KCO_WC_VERSION' ) || defined( 'WC_KLARNA_PAYMENTS_VERSION' ) ) {
			omniverse_force_enqueue_style( 'woo-klarna', true );
		}

		if ( defined( 'PAYPAL_API_URL' ) ) {
			omniverse_force_enqueue_style( 'woo-paypal-payments', true );
		}

		if ( class_exists( 'WCFM_Dependencies' ) ) {
			omniverse_force_enqueue_style( 'woo-wcfm-fm', true );
			omniverse_force_enqueue_style( 'colorbox-popup', true );
			omniverse_force_enqueue_style( 'select2' );
		}

		if ( class_exists( 'WC_Dependencies_Product_Vendor' ) ) {
			omniverse_force_enqueue_style( 'woo-multivendorx', true );
		}

		if ( class_exists( 'WC_Vendors' ) ) {
			omniverse_force_enqueue_style( 'woo-wc-vendors', true );
		}

		if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
			omniverse_force_enqueue_style( 'wpml', true );
		}

		if ( defined( 'YITH_WOOCOMPARE_VERSION' ) ) {
			omniverse_force_enqueue_style( 'woo-yith-compare', true );
			omniverse_force_enqueue_style( 'colorbox-popup' );
		}

		if ( defined( 'YITH_WPV_VERSION' ) ) {
			omniverse_force_enqueue_style( 'woo-yith-vendor', true );
		}

		if ( defined( 'YITH_YWRAQ_VERSION' ) ) {
			omniverse_force_enqueue_style( 'woo-yith-req-quote', true );

			omniverse_force_enqueue_style( 'woo-mod-grid' );
			omniverse_force_enqueue_style( 'woo-mod-quantity' );
			omniverse_force_enqueue_style( 'woo-mod-shop-table' );
			omniverse_force_enqueue_style( 'select2' );
		}

		if ( defined( 'YITH_WCWL' ) ) {
			omniverse_force_enqueue_style( 'woo-yith-wishlist', true );
			omniverse_force_enqueue_style( 'page-my-account' );
		}

		if ( omniverse_is_elementor_installed() ) {
			omniverse_force_enqueue_style( 'elementor-base' );
		}

		if ( defined( 'ELEMENTOR_PRO_VERSION' ) ) {
			omniverse_force_enqueue_style( 'elementor-pro-base', true );
		}

		if ( defined( 'WPB_VC_VERSION' ) ) {
			omniverse_force_enqueue_style( 'wpbakery-base' );
			omniverse_force_enqueue_style( 'wpbakery-base-deprecated', true );
		}

		if ( defined( 'THWEPOF_VERSION' ) || defined( 'THWEPO_VERSION' ) ) {
			omniverse_force_enqueue_style( 'woo-extra-prod-opt' );
		}

		if ( omniverse_get_opt( 'sticky_notifications' ) ) {
			omniverse_force_enqueue_style( 'notices-fixed' );
		}

		if ( omniverse_woocommerce_installed() ) {
			omniverse_force_enqueue_style( 'woocommerce-base' );
			omniverse_force_enqueue_style( 'mod-star-rating' );
			omniverse_force_enqueue_style( 'woo-el-track-order' );
			omniverse_force_enqueue_style( 'woocommerce-block-notices' );

			if ( ! omniverse_get_opt( 'disable_gutenberg_css' ) ) {
				omniverse_force_enqueue_style( 'woo-gutenberg' );
			}

			if ( is_lost_password_page() ) {
				omniverse_force_enqueue_style( 'woo-page-lost-password' );
			}

			if ( is_cart() || is_checkout() || is_account_page() ) {
				omniverse_force_enqueue_style( 'select2' );
				omniverse_force_enqueue_style( 'woo-mod-shop-table' );
			}

			if ( is_checkout() || is_account_page() ) {
				omniverse_force_enqueue_style( 'woo-mod-grid' );
			}

			if ( is_cart() ) {
				omniverse_force_enqueue_style( 'page-cart' );

				if ( Main::get_instance()->has_custom_layout( 'cart' ) ) {
					omniverse_force_enqueue_style( 'woo-page-cart-builder' );
				} else {
					omniverse_force_enqueue_style( 'woo-page-cart-predefined' );
				}
			}

			if ( is_cart() || is_product() || ( is_active_widget( 0, 0, 'woocommerce_widget_cart' ) && omniverse_get_opt( 'mini_cart_quantity' ) ) ) {
				omniverse_force_enqueue_style( 'woo-mod-quantity' );
			}

			if ( is_checkout() ) {
				omniverse_force_enqueue_style( 'page-checkout' );
				omniverse_force_enqueue_style( 'page-checkout-payment-methods' );

				if ( ! Main::get_instance()->has_custom_layout( 'checkout_content' ) && ! Main::get_instance()->has_custom_layout( 'checkout_form' ) ) {
					omniverse_force_enqueue_style( 'woo-page-checkout-predefined' );
				} else {
					omniverse_force_enqueue_style( 'woo-page-checkout-builder' );
				}

				if ( Checkout_Order_Table::get_instance()->is_enable_omniverse_product_table_template() ) {
					omniverse_force_enqueue_style( 'woo-opt-manage-checkout-prod' );
				}
			}

			if ( defined( 'WC_STRIPE_VERSION' ) && is_account_page() ) {
				omniverse_force_enqueue_style( 'page-checkout-payment-methods' );
			}

			if ( omniverse_get_opt( 'shipping_progress_bar_enabled' ) ) {
				if ( omniverse_get_opt( 'shipping_progress_bar_location_mini_cart' )
					|| is_checkout() && omniverse_get_opt( 'shipping_progress_bar_location_checkout' ) && ! Main::get_instance()->has_custom_layout( 'checkout_content' )
					|| is_cart() && omniverse_get_opt( 'shipping_progress_bar_location_card_page' ) && ! Main::get_instance()->has_custom_layout( 'cart' )
					|| is_product() && omniverse_get_opt( 'shipping_progress_bar_location_single_product' ) && ! Main::get_instance()->has_custom_layout( 'single_product' ) ) {
					omniverse_force_enqueue_style( 'woo-opt-free-progress-bar' );
					omniverse_force_enqueue_style( 'woo-mod-progress-bar' );
				}
			}

			if ( is_order_received_page() ) {
				omniverse_force_enqueue_style( 'woo-page-order-complete' );
			}

			if ( is_order_received_page() || is_account_page() ) {
				omniverse_force_enqueue_style( 'woo-mod-order-details' );
			}

			if ( is_wc_endpoint_url( 'order-pay' ) ) {
				omniverse_force_enqueue_style( 'woo-page-checkout-predefined' );
			}

			if ( is_account_page() ) {
				omniverse_force_enqueue_style( 'page-my-account' );
			}

			if ( is_product() ) {
				omniverse_force_enqueue_style( 'woo-single-prod-el-base' );
				omniverse_force_enqueue_style( 'woo-mod-stock-status' );
			}

			if ( is_product_taxonomy() || is_shop() || is_product_category() || is_product_tag() || omniverse_is_product_attribute_archive() ) {
				omniverse_force_enqueue_style( 'widget-active-filters' );

				if ( 'disable' !== omniverse_get_opt( 'shop_widgets_collapse', 'disable' ) ) {
					omniverse_force_enqueue_style( 'widget-collapse' );
				}

				if ( Main::get_instance()->has_custom_layout( 'shop_archive' ) ) {
					omniverse_force_enqueue_style( 'woo-shop-builder' );
				} else {
					omniverse_force_enqueue_style( 'woo-shop-predefined' );
				}

				if ( omniverse_get_opt( 'shop_categories' ) && ! Main::get_instance()->has_custom_layout( 'shop_archive' ) ) {
					omniverse_force_enqueue_style( 'shop-title-categories' );
					omniverse_force_enqueue_style( 'woo-categories-loop-nav-mobile-accordion' );
				}
			}

			if ( ! Main::get_instance()->has_custom_layout( 'shop_archive' ) && ( is_product_taxonomy() || is_shop() || is_product_category() || is_product_tag() || omniverse_is_product_attribute_archive() || ( function_exists( 'wcfm_is_store_page' ) && wcfm_is_store_page() ) ) ) {
				omniverse_force_enqueue_style( 'woo-shop-el-products-per-page' );
				omniverse_force_enqueue_style( 'woo-shop-page-title' );
				omniverse_force_enqueue_style( 'woo-mod-shop-loop-head' );

				if ( ! omniverse_get_opt( 'shop_filters' ) ) {
					omniverse_force_enqueue_style( 'woo-shop-el-order-by' );
				}

				if ( omniverse_get_opt( 'per_row_columns_selector' ) && omniverse_get_opt( 'products_columns_variations' ) ) {
					omniverse_force_enqueue_style( 'woo-shop-el-products-view' );
				}

				if ( ! omniverse_get_opt( 'shop_title' ) ) {
					omniverse_force_enqueue_style( 'woo-shop-opt-without-title' );
				}
			}

			if ( omniverse_get_opt( 'bought_together_enabled', 1 ) && ( is_cart() || is_checkout() ) ) {
				omniverse_force_enqueue_style( 'woo-opt-fbt-cart' );
			}

			$compare_page  = function_exists( 'wpml_object_id_filter' ) ? wpml_object_id_filter( omniverse_get_opt( 'compare_page' ), 'page', true ) : omniverse_get_opt( 'compare_page' );
			$wishlist_page = function_exists( 'wpml_object_id_filter' ) ? wpml_object_id_filter( omniverse_get_opt( 'wishlist_page' ), 'page', true ) : omniverse_get_opt( 'wishlist_page' );

			if ( $compare_page && (int) omniverse_get_the_ID() === (int) $compare_page ) {
				omniverse_force_enqueue_style( 'page-compare' );
				omniverse_force_enqueue_style( 'woo-mod-stock-status' );
			}

			if ( $wishlist_page && (int) omniverse_get_the_ID() === (int) $wishlist_page ) {
				omniverse_force_enqueue_style( 'page-wishlist' );
				omniverse_force_enqueue_style( 'page-my-account' );
			}

			if ( omniverse_get_opt( 'hide_larger_price' ) ) {
				omniverse_force_enqueue_style( 'woo-opt-hide-larger-price' );
			}

			if ( omniverse_get_opt( 'attr_after_short_desc' ) || 'additional_info' === omniverse_get_opt( 'base_hover_content' ) || is_product() ) {
				omniverse_force_enqueue_style( 'woo-mod-shop-attributes' );
			}
		}

		if ( omniverse_get_opt( 'disable_owl_mobile_devices' ) ) {
			omniverse_force_enqueue_style( 'opt-carousel-disable' );
		}

		if ( 'underlined' === omniverse_get_opt( 'form_fields_style' ) ) {
			omniverse_force_enqueue_style( 'opt-form-underline' );
		}

		if ( class_exists( 'WeDevs_Dokan' ) && ( dokan_is_store_page() || dokan_is_store_listing() || dokan_is_seller_dashboard() ) ) {
			omniverse_force_enqueue_style( 'select2' );
		}
	}

	add_action( 'wp_enqueue_scripts', 'omniverse_force_enqueue_styles', 10001 );
}

if ( ! function_exists( 'omniverse_enqueue_product_loop_styles' ) ) {
	/**
	 * Enqueue product loop style files.
	 *
	 * @param string $design Design.
	 */
	function omniverse_enqueue_product_loop_styles( $design ) {
		omniverse_enqueue_inline_style( 'product-loop' );

		if ( 'button' === $design || 'info-alt' === $design ) {
			omniverse_enqueue_inline_style( 'product-loop-button-info-alt' );
		} else {
			omniverse_enqueue_inline_style( 'product-loop-' . $design );
		}

		if ( in_array( $design, array( 'standard', 'button', 'base', 'info-alt', 'quick', 'list', 'fw-button', 'buttons-on-hover' ), true ) && ! omniverse_get_opt( 'catalog_mode' ) ) {
			omniverse_enqueue_inline_style( 'woo-mod-add-btn-replace' );
		}

		if ( omniverse_loop_prop( 'product_quantity' ) ) {
			omniverse_enqueue_inline_style( 'woo-mod-quantity' );
			omniverse_enqueue_inline_style( 'woo-mod-quantity-overlap' );
		}

		if ( omniverse_get_opt( 'grid_swatches_attribute' ) ) {
			omniverse_enqueue_inline_style( 'woo-mod-swatches-base' );
		}

		if ( 'base' === $design || 'fw-button' === $design ) {
			omniverse_enqueue_inline_style( 'mod-more-description' );
		}
	}
}

if ( ! function_exists( 'omniverse_enqueue_portfolio_loop_styles' ) ) {
	/**
	 * Enqueue product loop style files.
	 *
	 * @param string $design Design.
	 */
	function omniverse_enqueue_portfolio_loop_styles( $design ) {
		if ( 'hover' === $design ) {
			omniverse_enqueue_inline_style( 'project-text-hover' );
		}

		if ( 'hover-inverse' === $design ) {
			omniverse_enqueue_inline_style( 'project-alt' );
		}

		if ( 'text-shown' === $design ) {
			omniverse_enqueue_inline_style( 'project-under' );
		}

		if ( 'parallax' === $design ) {
			omniverse_enqueue_inline_style( 'project-parallax' );
		}
	}
}

if ( ! function_exists( 'omniverse_enqueue_inline_style' ) ) {
	/**
	 * Enqueue inline style by key.
	 *
	 * @param string $key File slug.
	 */
	function omniverse_enqueue_inline_style( $key, $ignore_combined = false ) {
		if ( function_exists( 'wc' ) && ( wc()->is_rest_api_request() || omniverse_is_woocommerce_legacy_rest_api() ) ) {
			return;
		}

		Parts_Css_Files::get_instance()->enqueue_inline_style( $key, $ignore_combined );
	}
}

if ( ! function_exists( 'omniverse_force_enqueue_style' ) ) {
	/**
	 * Enqueue style by key.
	 *
	 * @param string $key File slug.
	 */
	function omniverse_force_enqueue_style( $key, $ignore_combined = false ) {
		Parts_Css_Files::get_instance()->enqueue_style( $key, $ignore_combined );
	}
}

if ( ! function_exists( 'omniverse_enqueue_inline_style_anchor' ) ) {
	function omniverse_enqueue_inline_style_anchor() {
		wp_enqueue_style( 'omniverse-inline-css' );
	}

	add_action( 'wp_footer', 'omniverse_enqueue_inline_style_anchor', 10 );
}
