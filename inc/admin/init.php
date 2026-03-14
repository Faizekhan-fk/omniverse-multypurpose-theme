<?php
/**
 * This file enqueue scripts and styles for admin.
 *
 * @package Omniverse
 */

use DN\Admin\Modules\Options;
use DN\Admin\Modules\Options\Google_Fonts;
use DN\Admin\Modules\Import\Helpers;
use DN\Modules\Styles_Storage;

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_get_theme_settings_search_data' ) ) {
	/**
	 * Get theme settings search data.
	 */
	function omniverse_get_theme_settings_search_data() {
		check_ajax_referer( 'omniverse-get-theme-settings-data-nonce', 'security' );

		$all_fields   = Options::get_fields();
		$all_sections = Options::get_sections();

		$options_data = array();
		foreach ( $all_fields as $field ) {
			$section_id = $field->args['section'];
			$section    = $all_sections[ $section_id ];

			if ( isset( $section['parent'] ) ) {
				$path = $all_sections[ $section['parent'] ]['name'] . ' -> ' . $section['name'];
			} else {
				$path = $section['name'];
			}

			$text = isset( $field->args['name'] ) ? $field->args['name'] : '';
			if ( isset( $field->args['description'] ) ) {
				$text .= ' ' . $field->args['description'];
			}
			if ( isset( $field->args['tags'] ) ) {
				$text .= ' ' . $field->args['tags'];
			}

			$options_data[] = array(
				'id'         => $field->args['id'],
				'title'      => isset( $field->args['name'] ) ? $field->args['name'] : '',
				'text'       => $text,
				'section_id' => $section['id'],
				'icon'       => isset( $section['icon'] ) ? $section['icon'] : $all_sections[ $section['parent'] ]['icon'],
				'path'       => $path,
			);
		}

		wp_send_json(
			array(
				'theme_settings' => $options_data,
			)
		);
	}

	add_action( 'wp_ajax_omniverse_get_theme_settings_search_data', 'omniverse_get_theme_settings_search_data' );
}

if ( ! function_exists( 'omniverse_get_theme_settings_typography_data' ) ) {
	/**
	 * Get theme settings typography data.
	 */
	function omniverse_get_theme_settings_typography_data() {
		check_ajax_referer( 'omniverse-get-theme-settings-data-nonce', 'security' );

		$custom_fonts_data = omniverse_get_opt( 'multi_custom_fonts' );
		$custom_fonts      = array();
		if ( isset( $custom_fonts_data['{{index}}'] ) ) {
			unset( $custom_fonts_data['{{index}}'] );
		}

		if ( is_array( $custom_fonts_data ) ) {
			foreach ( $custom_fonts_data as $font ) {
				if ( ! $font['font-name'] ) {
					continue;
				}

				$custom_fonts[ $font['font-name'] ] = $font['font-name'];
			}
		}

		$typekit_fonts = omniverse_get_opt( 'typekit_fonts' );

		if ( $typekit_fonts ) {
			$typekit = explode( ',', $typekit_fonts );
			foreach ( $typekit as $font ) {
				$custom_fonts[ ucfirst( trim( $font ) ) ] = trim( $font );
			}
		}

		wp_send_json(
			array(
				'typography' => array(
					'stdfonts'    => omniverse_get_config( 'standard-fonts' ),
					'googlefonts' => Google_Fonts::$all_google_fonts,
					'customFonts' => $custom_fonts,
				),
			)
		);
	}

	add_action( 'wp_ajax_omniverse_get_theme_settings_typography_data', 'omniverse_get_theme_settings_typography_data' );
}

if ( ! function_exists( 'omniverse_admin_wpb_scripts' ) ) {
	/**
	 * Add scripts for WPB fields.
	 */
	function omniverse_admin_wpb_scripts() {
		if ( 'wpb' !== omniverse_get_current_page_builder() ) {
			return;
		}

		if ( apply_filters( 'omniverse_gradients_enabled', true ) ) {
			wp_enqueue_script( 'wd-wpb-colorpicker-gradient', OMNIVERSE_ASSETS . '/js/libs/colorpicker.min.js', array(), OMNIVERSE_VERSION, true );
			wp_enqueue_script( 'wd-wpb-gradient', OMNIVERSE_ASSETS . '/js/libs/gradX.min.js', array(), OMNIVERSE_VERSION, true );
		}

		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-datetimepicker', OMNIVERSE_ASSETS . '/js/libs/datetimepicker.min.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wp-color-picker-alpha', OMNIVERSE_ASSETS . '/js/libs/wp-color-picker-alpha.js', array( 'wp-color-picker' ), omniverse_get_theme_info( 'Version' ), true );

		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'wd-wpb-slider', OMNIVERSE_ASSETS . '/js/vc-fields/slider.js', array(), OMNIVERSE_VERSION, true );

		wp_enqueue_script( 'wd-wpb-image-hotspot', OMNIVERSE_ASSETS . '/js/vc-fields/image-hotspot.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-title-divider', OMNIVERSE_ASSETS . '/js/vc-fields/title-divider.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-responsive-size', OMNIVERSE_ASSETS . '/js/vc-fields/responsive-size.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-responsive-spacing', OMNIVERSE_ASSETS . '/js/vc-fields/responsive-spacing.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-image-select', OMNIVERSE_ASSETS . '/js/vc-fields/image-select.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-colorpicker', OMNIVERSE_ASSETS . '/js/vc-fields/colorpicker.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-datepicker', OMNIVERSE_ASSETS . '/js/vc-fields/datepicker.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-switch', OMNIVERSE_ASSETS . '/js/vc-fields/switch.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-button-set', OMNIVERSE_ASSETS . '/js/vc-fields/button-set.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-functions', OMNIVERSE_ASSETS . '/js/vc-fields/vc-functions.js', array(), OMNIVERSE_VERSION, true );

		wp_enqueue_script( 'wd-wpb-slider-responsive', OMNIVERSE_ASSETS . '/js/vc-fields/slider-responsive.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-number', OMNIVERSE_ASSETS . '/js/vc-fields/number.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-colorpicker-new', OMNIVERSE_ASSETS . '/js/vc-fields/wd-colorpicker.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-box-shadow', OMNIVERSE_ASSETS . '/js/vc-fields/box-shadow.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-select', OMNIVERSE_ASSETS . '/js/vc-fields/select.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-dimensions', OMNIVERSE_ASSETS . '/js/vc-fields/dimensions.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-list-element', OMNIVERSE_ASSETS . '/js/vc-fields/list-element.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-templates', OMNIVERSE_ASSETS . '/js/vc-templates.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-upload', OMNIVERSE_ASSETS . '/js/vc-fields/upload.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_script( 'wd-wpb-gradient-scripts', OMNIVERSE_ASSETS . '/js/vc-fields/gradient.js', array( 'wd-wpb-gradient' ), OMNIVERSE_VERSION, true );
	}

	add_action( 'vc_backend_editor_render', 'omniverse_admin_wpb_scripts' );
	add_action( 'vc_frontend_editor_render', 'omniverse_admin_wpb_scripts' );
}

if ( ! function_exists( 'omniverse_admin_wpb_styles' ) ) {
	/**
	 * Add styles for WPB fields.
	 */
	function omniverse_admin_wpb_styles() {
		if ( apply_filters( 'omniverse_gradients_enabled', true ) ) {
			wp_enqueue_style( 'wd-wpb-colorpicker-gradient', OMNIVERSE_ASSETS . '/css/colorpicker.css', array(), OMNIVERSE_VERSION );
			wp_enqueue_style( 'wd-wpb-gradient', OMNIVERSE_ASSETS . '/css/gradX.css', array(), OMNIVERSE_VERSION );
		}

		wp_enqueue_style( 'wd-jquery-ui', OMNIVERSE_ASSETS . '/css/jquery-ui.css', array(), OMNIVERSE_VERSION );
	}

	add_action( 'vc_backend_editor_render', 'omniverse_admin_wpb_styles' );
	add_action( 'vc_frontend_editor_render', 'omniverse_admin_wpb_styles' );
}


if ( ! function_exists( 'omniverse_wpb_frontend_editor_enqueue_scripts' ) ) {
	/**
	 * WPB frontend editor scripts.
	 */
	function omniverse_wpb_frontend_editor_enqueue_scripts() {
		omniverse_enqueue_js_library( 'cookie' );
		wp_enqueue_script( 'wd-wpb-frontend-editor', OMNIVERSE_ASSETS . '/js/vc-fields/frontend-editor-functions.js', array(), OMNIVERSE_VERSION, true );
	}

	add_action( 'vc_frontend_editor_enqueue_js_css', 'omniverse_wpb_frontend_editor_enqueue_scripts' );
}

if ( ! function_exists( 'omniverse_enqueue_widgets_admin_scripts' ) ) {
	/**
	 * Enqueue a scripts.
	 */
	function omniverse_enqueue_widgets_admin_scripts() {
		wp_enqueue_script( 'select2', OMNIVERSE_ASSETS . '/js/libs/select2.full.min.js', array(), omniverse_get_theme_info( 'Version' ), true );
		wp_enqueue_script( 'omniverse-admin-options', OMNIVERSE_ASSETS . '/js/options.js', array(), OMNIVERSE_VERSION, true );
	}

	add_action( 'widgets_admin_page', 'omniverse_enqueue_widgets_admin_scripts' );
}

if ( ! function_exists( 'omniverse_enqueue_admin_scripts' ) ) {
	/**
	 * Enqueue a scripts.
	 */
	function omniverse_enqueue_admin_scripts() {
		global $pagenow;

		wp_enqueue_script( 'omniverse-admin-scripts', OMNIVERSE_ASSETS . '/js/admin.js', array(), OMNIVERSE_VERSION, true );

		$localize_data = array(
			'searchOptionsPlaceholder'           => esc_js( __( 'Search for options', 'omniverse' ) ),
			'ajaxUrl'                            => admin_url( 'admin-ajax.php' ),
			'demoAjaxUrl'                        => OMNIVERSE_DEMO_URL . 'wp-admin/admin-ajax.php',
			'activate_plugin_btn_text'           => esc_html__( 'Activate', 'omniverse' ),
			'update_plugin_btn_text'             => esc_html__( 'Update', 'omniverse' ),
			'deactivate_plugin_btn_text'         => esc_html__( 'Deactivate', 'omniverse' ),
			'install_plugin_btn_text'            => esc_html__( 'Install', 'omniverse' ),
			'activate_process_plugin_btn_text'   => esc_html__( 'Activating', 'omniverse' ),
			'update_process_plugin_btn_text'     => esc_html__( 'Updating', 'omniverse' ),
			'deactivate_process_plugin_btn_text' => esc_html__( 'Deactivating', 'omniverse' ),
			'install_process_plugin_btn_text'    => esc_html__( 'Installing', 'omniverse' ),
			'animate_it_btn_text'                => esc_html__( 'Animate it', 'omniverse' ),
			'remove_backup_text'                 => esc_html__( 'Are you sure you want to remove backup? This process cannot be undone. Continue?', 'omniverse' ),
			'apply_backup_text'                  => esc_html__( 'Are you sure you want to apply backup? This process cannot be undone. Continue?', 'omniverse' ),
			'wd_layout_type'                     => 'post.php' === $pagenow && isset( $_GET['post'] ) ? get_post_meta( omniverse_clean( $_GET['post'] ),'wd_layout_type', true ) : '', // phpcs:ignore
			'current_page_builder'               => omniverse_get_current_page_builder(),
			'import_base_versions_name'          => implode( ',', Helpers::get_instance()->get_base_version() ),
			'checkout_fields_manager_nonce'      => wp_create_nonce( 'checkout_fields_manager_nonce' ),
		);

		if ( current_user_can( 'administrator' ) ) {
			$localize_data = array_merge(
				$localize_data,
				array(
					'deactivate_plugin_nonce'          => wp_create_nonce( 'omniverse_deactivate_plugin_nonce' ),
					'check_plugins_nonce'              => wp_create_nonce( 'omniverse_check_plugins_nonce' ),
					'install_child_theme_nonce'        => wp_create_nonce( 'omniverse_install_child_theme_nonce' ),
					'get_builder_elements_nonce'       => wp_create_nonce( 'omniverse-get-builder-elements-nonce' ),
					'get_builder_element_nonce'        => wp_create_nonce( 'omniverse-get-builder-element-nonce' ),
					'builder_load_header_nonce'        => wp_create_nonce( 'omniverse-builder-load-header-nonce' ),
					'builder_save_header_nonce'        => wp_create_nonce( 'omniverse-builder-save-header-nonce' ),
					'builder_remove_header_nonce'      => wp_create_nonce( 'omniverse-builder-remove-header-nonce' ),
					'builder_set_default_header_nonce' => wp_create_nonce( 'omniverse-builder-set-default-header-nonce' ),
					'presets_nonce'                    => wp_create_nonce( 'zs_presets_nonce' ),
					'import_nonce'                     => wp_create_nonce( 'omniverse-import-nonce' ),
					'backup_nonce'                     => wp_create_nonce( 'zs_backup_nonce' ),
					'import_remove_nonce'              => wp_create_nonce( 'omniverse-import-remove-nonce' ),
					'mega_menu_added_thumbnail_nonce'  => wp_create_nonce( 'omniverse-mega-menu-added-thumbnail-nonce' ),
					'get_hotspot_image_nonce'          => wp_create_nonce( 'omniverse-get-hotspot-image-nonce' ),
					'get_theme_settings_data_nonce'    => wp_create_nonce( 'omniverse-get-theme-settings-data-nonce' ),
					'get_new_template_nonce'           => wp_create_nonce( 'wd-new-template-nonce' ),
					'patcher_nonce'                    => wp_create_nonce( 'patcher_nonce' ),
					'bought_together_nonce'            => wp_create_nonce( 'bought_together_nonce' ),
					'get_slides_nonce'                 => wp_create_nonce( 'omniverse-get-slides-nonce' ),
				)
			);
		}

		wp_localize_script( 'omniverse-admin-scripts', 'omniverseConfig', apply_filters( 'omniverse_admin_localized_string_array', $localize_data ) );
	}

	add_action( 'admin_init', 'omniverse_enqueue_admin_scripts', 100 );
}

if ( ! function_exists( 'omniverse_enqueue_admin_styles' ) ) {
	/**
	 * Enqueue a CSS stylesheets.
	 */
	function omniverse_enqueue_admin_styles() {
		wp_enqueue_style( 'wd-admin-base', OMNIVERSE_ASSETS . '/css/parts/base.min.css', array(), OMNIVERSE_VERSION );
		
		if ( 'wpb' === omniverse_get_current_page_builder() ) {
			wp_enqueue_style( 'wd-admin-int-wpbakery', OMNIVERSE_ASSETS . '/css/parts/int-wpbakery.min.css', array(), OMNIVERSE_VERSION );
		}

		if ( isset( $_GET['taxonomy'] ) && 'omniverse_slider' === $_GET['taxonomy'] ) { //phpcs:ignore
			wp_enqueue_style( 'wd-admin-page-slider', OMNIVERSE_ASSETS . '/css/parts/page-slider.min.css', array(), OMNIVERSE_VERSION );
		}

		if ( isset( $_GET['tab'] ) && 'wizard' === $_GET['tab'] || 'zs_business_type' === @$_GET['page'] ) { //phpcs:ignore
			wp_enqueue_style( 'wd-admin-page-setup-wizard', OMNIVERSE_ASSETS . '/css/parts/page-setup-wizard.min.css', array(), OMNIVERSE_VERSION );
		}

		if ( isset( $_GET['page'] ) && 'zs_license' === $_GET['page'] || isset( $_GET['tab'], $_GET['step'] ) && 'activation' === $_GET['step'] ) { //phpcs:ignore
			wp_enqueue_style( 'wd-admin-page-theme-license', OMNIVERSE_ASSETS . '/css/parts/page-theme-license.min.css', array(), OMNIVERSE_VERSION );
		}

		if ( isset( $_GET['page'] ) && 'zs_plugins' === $_GET['page'] || isset( $_GET['tab'], $_GET['step'] ) && 'plugins' === $_GET['step'] ) { //phpcs:ignore
			wp_enqueue_style( 'wd-admin-page-plugins', OMNIVERSE_ASSETS . '/css/parts/page-plugins.min.css', array(), OMNIVERSE_VERSION );
		}

		if ( isset( $_GET['page'] ) && 'zs_prebuilt_websites' === $_GET['page'] || isset( $_GET['tab'], $_GET['step'] ) && 'prebuilt-websites' === $_GET['step'] ) { //phpcs:ignore
			wp_enqueue_style( 'wd-admin-page-dummy-content', OMNIVERSE_ASSETS . '/css/parts/page-dummy-content.min.css', array(), OMNIVERSE_VERSION );
		}

		if ( isset( $_GET['page'] ) && 'product_attributes' === $_GET['page'] || isset( $_GET['post_type'], $_GET['taxonomy'] ) && 'product' === $_GET['post_type'] && 'product_cat' !== $_GET['taxonomy'] ) { //phpcs:ignore
			wp_enqueue_style( 'wd-admin-int-woo-page-attributes', OMNIVERSE_ASSETS . '/css/parts/int-woo-page-attributes.min.css', array(), OMNIVERSE_VERSION );
		}

		if ( isset( $_GET['post_type'], $_GET['taxonomy'] ) && ( 'product_cat' === $_GET['taxonomy'] || 'cms_block_cat' === $_GET['taxonomy'] ) ) { //phpcs:ignore
			wp_enqueue_style( 'wd-admin-int-woo-page-categories', OMNIVERSE_ASSETS . '/css/parts/int-woo-page-categories.min.css', array(), OMNIVERSE_VERSION );
		}

		if ( ! isset( $_GET['page'] ) ) { //phpcs:ignore
			return;
		}

		if ( 'zs_dashboard' === $_GET['page'] ) { //phpcs:ignore
			wp_enqueue_style( 'wd-admin-page-welcome', OMNIVERSE_ASSETS . '/css/parts/page-welcome.min.css', array(), OMNIVERSE_VERSION );
		}

		if ( 'zs_theme_settings' === $_GET['page'] ) { //phpcs:ignore
			wp_enqueue_style( 'wd-admin-page-theme-settings', OMNIVERSE_ASSETS . '/css/parts/page-theme-settings.min.css', array(), OMNIVERSE_VERSION );
		}

		if ( 'zs_theme_settings_presets' === $_GET['page'] ) { //phpcs:ignore
			wp_enqueue_style( 'wd-admin-page-presets', OMNIVERSE_ASSETS . '/css/parts/page-presets.min.css', array(), OMNIVERSE_VERSION );
		}

		if ( 'zs_theme_settings_backup' === $_GET['page'] ) { //phpcs:ignore
			wp_enqueue_style( 'wd-admin-page-backup', OMNIVERSE_ASSETS . '/css/parts/page-backup.min.css', array(), OMNIVERSE_VERSION );
		}

		if ( 'zs_patcher' === $_GET['page'] ) { //phpcs:ignore
			wp_enqueue_style( 'wd-admin-page-patcher', OMNIVERSE_ASSETS . '/css/parts/page-patcher.min.css', array(), OMNIVERSE_VERSION );
		}

		if ( 'zs_status' === $_GET['page'] ) { //phpcs:ignore
			wp_enqueue_style( 'wd-admin-page-status', OMNIVERSE_ASSETS . '/css/parts/page-status.min.css', array(), OMNIVERSE_VERSION );
		}

		if ( 'zs_wpb_css_generator' === $_GET['page'] ) { //phpcs:ignore
			wp_enqueue_style( 'wd-admin-page-css-generator', OMNIVERSE_ASSETS . '/css/parts/page-css-generator.min.css', array(), OMNIVERSE_VERSION );
		}

		if ( 'zs_header_builder' === $_GET['page'] ) { //phpcs:ignore
			wp_enqueue_style( 'wd-admin-page-header-builder', OMNIVERSE_ASSETS . '/css/parts/page-header-builder.min.css', array(), OMNIVERSE_VERSION );
		}
	}

	add_action( 'admin_enqueue_scripts', 'omniverse_enqueue_admin_styles' );
}

if ( ! function_exists( 'omniverse_admin_custom_css_file' ) ) {
	/**
	 * This function creates and includes a custom CSS for the WordPress admin panel when the css_backend option is passed.
	 *
	 * @return void
	 */
	function omniverse_admin_custom_css_file() {
		$css_backend = omniverse_get_opt( 'css_backend' );

		if ( ! $css_backend ) {
			return;
		}

		$storage = new Styles_Storage( 'admin-custom' );
		$storage->write( $css_backend, false );
		$storage->inline_css();
	}

	add_action( 'admin_print_styles', 'omniverse_admin_custom_css_file', 30000 );
}

if ( ! function_exists( 'omniverse_get_html_block_links' ) ) {
	/**
	 * Get html block links.
	 *
	 * @return false|string
	 */
	function omniverse_get_html_block_links() {
		wp_enqueue_script( 'omniverse-admin-html-block-edit-link', OMNIVERSE_ASSETS . '/js/htmlBlockEditLink.js', array(), OMNIVERSE_VERSION, true );

		ob_start();
		?>
		<span class="dn-block-link-wrap">
			<a href="<?php echo esc_url( admin_url( 'post.php?post=' ) ); ?>" class="dn-block-link dn-edit-block-link dn-i-edit-write" style="display:none;" target="_blank">
				<?php esc_html_e( 'Edit this block with Page Builder', 'omniverse' ); ?>
			</a>
			<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=cms_block' ) ); ?>" class="dn-block-link dn-add-block-link dn-i-expand" target="_blank">
				<?php esc_html_e( 'Create new HTML Block', 'omniverse' ); ?>
			</a>
		</span>
		<?php
		return ob_get_clean();
	}
}

if ( ! function_exists( 'omniverse_update_tgmpa_link' ) ) {
	/**
	 * Update tgmpa link actions.
	 *
	 * @param string $action_link Action link.
	 * @return string|void
	 */
	function omniverse_update_tgmpa_link( $action_link ) {
		return admin_url( 'admin.php?page=zs_plugins' );
	}

	add_filter( 'omniverse_tgmpa_install_link', 'omniverse_update_tgmpa_link' );
	add_filter( 'omniverse_tgmpa_update_link', 'omniverse_update_tgmpa_link' );
	add_filter( 'omniverse_tgmpa_activate_link', 'omniverse_update_tgmpa_link' );
}

if ( ! function_exists( 'omniverse_get_compatible_plugin_btn' ) ) {
	/**
	 * Get data button action from plugins status.
	 *
	 * @param string $plugin Plugins slug.
	 * @return array
	 */
	function omniverse_get_compatible_plugin_btn( $plugin ) {
		include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

		$btn_text = esc_html__( 'Install', 'omniverse' );
		$btn_url  = '#';
		$classes  = 'dn-install';
		$status   = install_plugin_install_status(
			plugins_api(
				'plugin_information',
				array(
					'slug'   => $plugin,
					'fields' => array(
						'sections' => false,
					),
				)
			)
		);

		switch ( $status['status'] ) {
			case 'install':
				if ( $status['url'] ) {
					$btn_url = $status['url'];
				}
				break;

			case 'update_available':
				if ( $status['url'] ) {
					$btn_text = esc_html__( 'Update', 'omniverse' );
					$btn_url  = $status['url'];
					$classes  = 'dn-update';
				}
				break;

			case 'latest_installed':
			case 'newer_installed':
				if ( is_plugin_active( $status['file'] ) ) {
					$btn_text = esc_html__( 'Deactivate', 'omniverse' );
					$btn_url  = add_query_arg(
						array(
							'_wpnonce' => wp_create_nonce( 'deactivate-plugin_' . $status['file'] ),
							'action'   => 'deactivate',
							'plugin'   => $status['file'],
						),
						network_admin_url( 'plugins.php' )
					);
					$classes  = 'dn-deactivate';
				} elseif ( current_user_can( 'activate_plugin', $status['file'] ) ) {
					$btn_text = esc_html__( 'Activate', 'omniverse' );
					$btn_url  = add_query_arg(
						array(
							'_wpnonce' => wp_create_nonce( 'activate-plugin_' . $status['file'] ),
							'action'   => 'activate',
							'plugin'   => $status['file'],
						),
						network_admin_url( 'plugins.php' )
					);
					$classes  = 'dn-activate';

					if ( is_network_admin() ) {
						$btn_text = esc_html__( 'Network Activate' );
						$btn_url  = add_query_arg( array( 'networkwide' => 1 ), $btn_url );
					}
				}
				break;
		}

		return array(
			'name'        => $btn_text,
			'url'         => $btn_url,
			'extra-class' => $classes,
		);
	}
}

if ( ! function_exists( 'omniverse_get_update_enqueue_icons_fonts' ) ) {
	/**
	 * AJAX update enqueue icon fonts.
	 *
	 * @return void
	 */
	function omniverse_get_update_enqueue_icons_fonts() {
		check_ajax_referer( 'omniverse-get-theme-settings-data-nonce', 'security' );

		$enqueue = '';
		$font    = sanitize_text_field( $_GET['font'] );
		$weight  = sanitize_text_field( $_GET['weight'] );

		if ( $font && $weight ) {
			$icon_font_name = 'omniverse-font-' . $font . '-' . $weight;

			ob_start();
			?>
			<style id="wd-icon-font">
				@font-face {
					font-weight: normal;
					font-style: normal;
					font-family: "omniverse-font";
					src: url("<?php echo esc_url( omniverse_remove_https( OMNIVERSE_THEME_DIR . '/fonts/' . $icon_font_name . '.woff2' ) . '?v=' . omniverse_get_theme_info( 'Version' ) ); ?>") format("woff2");
				}
			</style>
			<?php

			$enqueue = ob_get_clean();
		}

		wp_send_json(
			array(
				'enqueue' => $enqueue,
			)
		);

	}

	add_action( 'wp_ajax_omniverse_get_enqueue_custom_icon_fonts', 'omniverse_get_update_enqueue_icons_fonts' );
}
