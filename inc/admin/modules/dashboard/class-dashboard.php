<?php

namespace DN\Admin\Modules;

use DN\Modules\Dynamic_Discounts\Manager as Dynamic_Discounts_Manager;
use DN\Modules\Patcher\Client;
use DN\Admin\Modules\Options;
use DN\Admin\Modules\Options\Presets;
use DN\Admin\Modules\Setup_Wizard;
use DN\Singleton;

class Dashboard extends Singleton {
	/**
	 * Constructor.
	 */
	public function init() {
		add_filter( 'views_edit-omniverse_layout', array( $this, 'print_header' ), 9 );
		add_filter( 'views_edit-omniverse_slide', array( $this, 'print_header' ), 9 );
		add_filter( 'views_edit-omniverse_sidebar', array( $this, 'print_header' ), 9 );
		add_filter( 'omniverse_slider_pre_add_form', array( $this, 'print_header' ), 9 );
		add_filter( 'views_edit-cms_block', array( $this, 'print_header' ), 9 );
		add_filter( 'cms_block_cat_pre_add_form', array( $this, 'print_header' ), 9 );
		add_action( 'admin_menu', array( $this, 'add_pages_to_dashboard_menu' ) );
		add_filter( 'admin_body_class', array( $this, 'admin_body_classes' ) );

		if ( current_user_can( apply_filters( 'omniverse_dashboard_theme_links_access', 'administrator' ) ) ) {
			add_action( 'admin_bar_menu', array( $this, 'add_pages_to_admin_bar_menu' ), 100 );
		}
	}

	/**
	 * Get logo url.
	 *
	 * @return string
	 */
	protected function get_logo_url() {
		$logo_url = '';

		$white_label_logo = omniverse_get_opt( 'white_label_sidebar_icon_logo', array( 'url' => '' ) );
		if ( omniverse_get_opt( 'white_label' ) && ! empty( $white_label_logo['url'] ) ) {
			$image_data = omniverse_get_opt( 'white_label_sidebar_icon_logo' );

			if ( isset( $image_data['url'] ) && $image_data['url'] ) {
				$logo_url = wp_get_attachment_image_url( $image_data['id'], 'full' );
			}
		}

		return $logo_url;
	}

	/**
	 * Get theme name.
	 *
	 * @return string
	 */
	protected function get_theme_name() {
		$theme_name = esc_html__( 'OmniVerse', 'omniverse' );

		if ( omniverse_get_opt( 'white_label' ) && omniverse_get_opt( 'white_label_theme_name' ) ) {
			$theme_name = omniverse_get_opt( 'white_label_theme_name' );
		}

		return $theme_name;
	}
	/**
	 * Add theme settings links to the admin bar.
	 *
	 * @since 1.0.0
	 *
	 * @param object $admin_bar Admin bar object.
	 */
	public function add_pages_to_admin_bar_menu( $admin_bar ) {
		if ( ! omniverse_get_opt( 'theme_admin_bar_menu', true ) ) {
			return;
		}

		$theme_name       = $this->get_theme_name();
		$admin_bar_img    = '';
		$product          = omniverse_woocommerce_installed() ? wc_get_product() : false;
		$active_discounts = omniverse_get_opt( 'discounts_enabled', 0 ) && ! empty( $product ) ? Dynamic_Discounts_Manager::get_instance()->get_discount_rules( $product ) : array();

		if ( $this->get_logo_url() ) {
			$admin_bar_img = '<img src="' . esc_url( $this->get_logo_url() ) . '" alt="icon">';
		}

		$admin_bar->add_node(
			array(
				'id'    => 'zs_dashboard',
				'title' => $admin_bar_img . $theme_name,
				'href'  => admin_url( 'admin.php?page=zs_dashboard' ),
				'meta'  => array(
					'title' => $theme_name,
				),
			)
		);

		$admin_bar->add_node(
			array(
				'id'     => 'zs_theme_settings',
				'title'  => '<i class="dn-i-theme-settings"></i>' . esc_html__( 'Theme Options', 'omniverse' ),
				'href'   => admin_url( 'admin.php?page=zs_theme_settings' ),
				'parent' => 'zs_dashboard',
				'meta'   => array(
					'title' => esc_html__( 'Theme Options', 'omniverse' ),
				),
			)
		);

		foreach ( Options::get_sections() as $key => $section ) {
			if ( isset( $section['parent'] ) ) {
				continue;
			}

			$admin_bar->add_node(
				array(
					'id'     => 'wd_' . $section['id'],
					'title'  => '<i class="' . $section['icon'] . '"></i>' . $section['name'],
					'href'   => admin_url( 'admin.php?page=zs_theme_settings&tab=' . $key ),
					'parent' => 'zs_theme_settings',
				)
			);
		}

		$active_presets = Presets::get_active_presets();
		if ( $active_presets ) {
			$admin_bar->add_node(
				array(
					'id'     => 'zs_theme_settings_presets_active',
					'title'  => '<i class="dn-i-cog"></i>' . esc_html__( 'Active presets', 'omniverse' ),
					'href'   => admin_url( 'admin.php?page=zs_theme_settings_presets' ),
					'parent' => 'zs_dashboard',
					'meta'   => array(
						'title' => esc_html__( 'Active theme settings presets', 'omniverse' ),
					),
				)
			);

			foreach ( $active_presets as $preset_id ) {
				$all_presets = Presets::get_all();

				$admin_bar->add_node(
					array(
						'id'     => 'zs_theme_settings_presets_active_' . $preset_id,
						'title'  => $all_presets[ $preset_id ]['name'],
						'href'   => admin_url( 'admin.php?page=zs_theme_settings&preset=' . $preset_id ),
						'parent' => 'zs_theme_settings_presets_active',
						'meta'   => array(
							'title' => $all_presets[ $preset_id ]['name'],
						),
					)
				);
			}
		}

		if ( ! empty( $active_discounts ) ) {
			$admin_bar->add_node(
				array(
					'id'     => 'wd_woo_discounts_active',
					'title'  => '<i class="dn-i-cog"></i>' . esc_html__( 'Active discount', 'omniverse' ),
					'href'   => admin_url( 'edit.php?post_type=wd_woo_discounts' ),
					'parent' => 'zs_dashboard',
					'meta'   => array(
						'title' => esc_html__( 'Active discounts', 'omniverse' ),
					),
				)
			);

			$admin_bar->add_node(
				array(
					'id'     => 'wd_woo_discounts_active_' . $active_discounts['post_id'],
					'title'  => $active_discounts['title'],
					'href'   => get_edit_post_link( $active_discounts['post_id'] ),
					'parent' => 'wd_woo_discounts_active',
					'meta'   => array(
						'title' => $active_discounts['title'],
					),
				)
			);
		}

		$admin_bar->add_node(
			array(
				'id'     => 'zs_header_builder',
				'title'  => '<i class="dn-i-header-builder"></i>' . esc_html__( 'Header builder', 'omniverse' ),
				'href'   => admin_url( 'admin.php?page=zs_header_builder' ),
				'parent' => 'zs_dashboard',
				'meta'   => array(
					'title' => esc_html__( 'Header builder', 'omniverse' ),
				),
			)
		);

		$header_object = whb_get_header();

		if ( $header_object && ! is_admin() ) {
			$admin_bar->add_node(
				array(
					'id'     => 'zs_header_builder_edit',
					'title'  => esc_html__( 'Edit current header', 'omniverse' ),
					'href'   => admin_url( 'admin.php?page=zs_header_builder#/builder/' . $header_object->get_id() ),
					'parent' => 'zs_header_builder',
					'meta'   => array(
						'title' => $header_object->get_name(),
					),
				)
			);
		}

		if ( omniverse_get_opt( 'dummy_import', '1' ) ) {
			$admin_bar->add_node(
				array(
					'id'     => 'zs_prebuilt_websites',
					'title'  => '<i class="dn-i-dummy-content"></i>' . esc_html__( 'Prebuilt websites', 'omniverse' ),
					'href'   => admin_url( 'admin.php?page=zs_prebuilt_websites' ),
					'parent' => 'zs_dashboard',
					'meta'   => array(
						'title' => esc_html__( 'Prebuilt websites', 'omniverse' ),
					),
				)
			);
		}

		$admin_bar->add_node(
			array(
				'id'     => 'zs_layouts',
				'title'  => '<i class="dn-i-layouts"></i>' . esc_html__( 'Layouts', 'omniverse' ),
				'href'   => admin_url( 'edit.php?post_type=omniverse_layout' ),
				'parent' => 'zs_dashboard',
				'meta'   => array(
					'title' => esc_html__( 'Layouts', 'omniverse' ),
				),
			)
		);

		$admin_bar->add_node(
			array(
				'id'     => 'zs_sliders',
				'title'  => '<i class="dn-i-slides"></i>' . esc_html__( 'Sliders', 'omniverse' ),
				'href'   => admin_url( 'edit-tags.php?taxonomy=omniverse_slider&post_type=omniverse_slide' ),
				'parent' => 'zs_dashboard',
				'meta'   => array(
					'title' => esc_html__( 'Sliders', 'omniverse' ),
				),
			)
		);

		$admin_bar->add_node(
			array(
				'id'     => 'zs_slides',
				'title'  => esc_html__( 'Slides', 'omniverse' ),
				'href'   => admin_url( 'edit.php?post_type=omniverse_slide' ),
				'parent' => 'zs_sliders',
				'meta'   => array(
					'title' => esc_html__( 'Slides', 'omniverse' ),
				),
			)
		);

		$admin_bar->add_node(
			array(
				'id'     => 'zs_slides_add',
				'title'  => esc_html__( 'Add new slide', 'omniverse' ),
				'href'   => admin_url( 'post-new.php?post_type=omniverse_slide' ),
				'parent' => 'zs_sliders',
				'meta'   => array(
					'title' => esc_html__( 'Add new', 'omniverse' ),
				),
			)
		);

		$admin_bar->add_node(
			array(
				'id'     => 'zs_html_block',
				'title'  => '<i class="dn-i-html-block"></i>' . esc_html__( 'HTML Block', 'omniverse' ),
				'href'   => admin_url( 'edit.php?post_type=cms_block' ),
				'parent' => 'zs_dashboard',
				'meta'   => array(
					'title' => esc_html__( 'HTML Block', 'omniverse' ),
				),
			)
		);

		$admin_bar->add_node(
			array(
				'id'     => 'zs_html_block_category',
				'title'  => esc_html__( 'Categories', 'omniverse' ),
				'href'   => admin_url( 'edit-tags.php?taxonomy=cms_block_cat&post_type=cms_block' ),
				'parent' => 'zs_html_block',
				'meta'   => array(
					'title' => esc_html__( 'Add new', 'omniverse' ),
				),
			)
		);

		$admin_bar->add_node(
			array(
				'id'     => 'zs_html_block_add',
				'title'  => esc_html__( 'Add new', 'omniverse' ),
				'href'   => admin_url( 'post-new.php?post_type=cms_block' ),
				'parent' => 'zs_html_block',
				'meta'   => array(
					'title' => esc_html__( 'Add new', 'omniverse' ),
				),
			)
		);

		$admin_bar->add_node(
			array(
				'id'     => 'zs_sidebars',
				'title'  => '<i class="dn-i-sidebars"></i>' . esc_html__( 'Sidebars', 'omniverse' ),
				'href'   => admin_url( 'edit.php?post_type=omniverse_sidebar' ),
				'parent' => 'zs_dashboard',
				'meta'   => array(
					'title' => esc_html__( 'Sidebars', 'omniverse' ),
				),
			)
		);

		$admin_bar->add_node(
			array(
				'id'     => 'zs_sidebars_add',
				'title'  => esc_html__( 'Add new', 'omniverse' ),
				'href'   => admin_url( 'post-new.php?post_type=omniverse_sidebar' ),
				'parent' => 'zs_sidebars',
				'meta'   => array(
					'title' => esc_html__( 'Add new', 'omniverse' ),
				),
			)
		);

		$admin_bar->add_group(
			array(
				'parent' => 'zs_dashboard',
				'id'     => 'zs_dashboard_external',
				'meta'   => array(
					'class' => 'ab-sub-secondary',
				),
			)
		);

		if ( omniverse_get_opt( 'white_label_theme_license_tab', '1' ) ) {
			$admin_bar->add_node(
				array(
					'parent' => 'zs_dashboard_external',
					'id'     => 'zs_license',
					'title'  => '<i class="dn-i-key"></i>' . esc_html__( 'Theme license', 'omniverse' ),
					'href'   => admin_url( 'admin.php?page=zs_license' ),
				)
			);
		}

		$admin_bar->add_node(
			array(
				'parent' => 'zs_dashboard_external',
				'id'     => 'zs_plugins',
				'title'  => '<i class="dn-i-puzzle"></i>' . esc_html__( 'Plugins', 'omniverse' ),
				'href'   => admin_url( 'admin.php?page=zs_plugins' ),
			)
		);

		$patches_count = class_exists( 'DN\Modules\Patcher\Client' ) ? Client::get_instance()->get_count_patches_map() : '';

		$admin_bar->add_node(
			array(
				'parent' => 'zs_dashboard_external',
				'id'     => 'zs_patcher',
				'title'  => '<i class="dn-i-cog"></i>' . esc_html__( 'Patcher', 'omniverse' ) . $patches_count,
				'href'   => admin_url( 'admin.php?page=zs_patcher' ),
			)
		);
	}

	/**
	 * Add pages to dashboard menu.
	 */
	public function add_pages_to_dashboard_menu() {
		global $menu, $submenu;

		$theme_name = $this->get_theme_name();

		$separator_position = '31.1';

		if ( isset( $menu[ $separator_position ] ) ) {
			$separator_position = $separator_position + base_convert( substr( md5( 'separator-zs_dashboard-wp-menu-separator dn-dashboard' ), -4 ), 16, 10 ) * 0.00001;
		}

		$menu[ $separator_position ] = array( '', 'read', 'separator-zs_dashboard', '', 'wp-menu-separator dn-dashboard' );

		add_menu_page(
			$theme_name,
			$theme_name,
			apply_filters( 'omniverse_capability_menu_page', 'manage_options', 'zs_dashboard' ),
			'zs_dashboard',
			array( $this, 'page_content' ),
			$this->get_logo_url(),
			31.2
		);

		add_submenu_page(
			'zs_dashboard',
			esc_html__( 'Theme Options', 'omniverse' ),
			esc_html__( 'Theme Options', 'omniverse' ),
			apply_filters( 'omniverse_capability_menu_page', 'manage_options', 'zs_theme_settings' ),
			'zs_theme_settings',
			array( $this, 'page_content' ),
			1
		);

		add_submenu_page(
			'zs_dashboard',
			esc_html__( 'Theme Options backup', 'omniverse' ),
			esc_html__( 'Theme Options backup', 'omniverse' ),
			'manage_options',
			'zs_theme_settings_backup',
			array( $this, 'page_content' ),
			1
		);

		add_submenu_page(
			'zs_dashboard',
			esc_html__( 'Theme Options presets', 'omniverse' ),
			esc_html__( 'Theme Options presets', 'omniverse' ),
			'manage_options',
			'zs_theme_settings_presets',
			array( $this, 'page_content' ),
			2
		);

		add_submenu_page(
			'zs_dashboard',
			esc_html__( 'Header builder', 'omniverse' ),
			esc_html__( 'Header builder', 'omniverse' ),
			apply_filters( 'omniverse_capability_menu_page', 'manage_options', 'zs_header_builder' ),
			'zs_header_builder',
			array( $this, 'page_content' ),
			3
		);

		if ( omniverse_get_opt( 'dummy_import', '1' ) ) {
			add_submenu_page(
				'zs_dashboard',
				esc_html__( 'Business Type', 'omniverse' ),
				esc_html__( 'Business Type', 'omniverse' ),
				apply_filters( 'omniverse_capability_menu_page', 'manage_options', 'zs_business_type' ),
				'zs_business_type',
				array( $this, 'page_content' ),
				4
			);
		}

		if ( omniverse_get_opt( 'dummy_import', '1' ) ) {
			add_submenu_page(
				'zs_dashboard',
				esc_html__( 'Prebuilt websites', 'omniverse' ),
				esc_html__( 'Prebuilt websites', 'omniverse' ),
				apply_filters( 'omniverse_capability_menu_page', 'manage_options', 'zs_prebuilt_websites' ),
				'zs_prebuilt_websites',
				array( $this, 'page_content' ),
				5
			);
		}

		if ( omniverse_get_opt( 'white_label_theme_license_tab', '1' ) ) {
			add_submenu_page(
				'zs_dashboard',
				esc_html__( 'Theme license', 'omniverse' ),
				esc_html__( 'Theme license', 'omniverse' ),
				apply_filters( 'omniverse_capability_menu_page', 'manage_options', 'zs_license' ),
				'zs_license',
				array( $this, 'page_content' ),
				6
			);
		}

		add_submenu_page(
			'zs_dashboard',
			esc_html__( 'Plugins', 'omniverse' ),
			esc_html__( 'Plugins', 'omniverse' ),
			apply_filters( 'omniverse_capability_menu_page', 'manage_options', 'plugins' ),
			'zs_plugins',
			array( $this, 'page_content' ),
			7
		);

		$patches_count = class_exists( 'DN\Modules\Patcher\Client' ) ? Client::get_instance()->get_count_patches_map() : '';

		add_submenu_page(
			'zs_dashboard',
			esc_html__( 'Status', 'omniverse' ),
			esc_html__( 'Status', 'omniverse' ),
			apply_filters( 'omniverse_capability_menu_page', 'manage_options', 'zs_status' ),
			'zs_status',
			array( $this, 'page_content' ),
			9
		);

		if ( omniverse_get_opt( 'white_label_changelog_tab', '1' ) ) {
			add_submenu_page(
				'zs_dashboard',
				esc_html__( 'Changelog', 'omniverse' ),
				esc_html__( 'Changelog', 'omniverse' ),
				apply_filters( 'omniverse_capability_menu_page', 'manage_options', 'zs_changelog' ),
				'zs_changelog',
				array( $this, 'page_content' ),
				10
			);
		}

		add_menu_page(
			esc_html__( 'Theme Options', 'omniverse' ),
			esc_html__( 'Theme Options', 'omniverse' ),
			'manage_options',
			'zs_theme_settings',
			array( $this, 'page_content' ),
			'',
			31.3
		);

		foreach ( Options::get_sections() as $key => $section ) {
			if ( isset( $section['parent'] ) ) {
				continue;
			}

			add_submenu_page(
				'zs_theme_settings',
				$section['name'],
				$section['name'],
				'manage_options',
				'zs_theme_settings&tab=' . $key,
				array( $this, 'page_content' )
			);
		}

		if ( current_user_can( 'manage_options' ) ) {
			// Hide submenu pages in omniverse dashboard menu.
			$hide_submenu = array( 'zs_theme_settings_backup', 'zs_theme_settings_presets' );

			foreach ( $submenu['zs_dashboard'] as $key => $zs_dashboard_submenu ) {
				if ( in_array( $zs_dashboard_submenu[2], $hide_submenu, true ) ) {
					$submenu['zs_dashboard'][ $key ][4] = 'dn-hidden'; // phpcs:ignore.
				}
			}
		}
	}

	/**
	 * Get page content callback.
	 */
	public function page_content() {
		$current_page = isset( $_GET['page'] ) ? wp_unslash( $_GET['page'] ) : ''; // phpcs:ignore
		$wizard       = Setup_Wizard::get_instance();

		if ( ! in_array( $current_page, $this->get_allowed_pages(), true ) ) {
			return;
		}

		if ( $wizard->is_setup() && 'done' !== get_option( 'omniverse_setup_status' ) ) {
			$wizard->setup_wizard_template();
			$this->print_footer();
			return;
		}

		do_action( 'zs_dashboard_before_page' );

		$this->print_header();
		$this->print_template( str_replace( 'zs_', '', $current_page ) );
		$this->print_footer();
	}

	/**
	 * Get allowed pages.
	 *
	 * @return array
	 */
	protected function get_allowed_pages() {
		return array(
			'zs_dashboard',
			'zs_theme_settings_backup',
			'zs_theme_settings_presets',
			'zs_theme_settings',
			'zs_prebuilt_websites',
			'zs_header_builder',
			'zs_business_type',
			'zs_license',
			'zs_wpb_css_generator',
			'zs_patcher',
			'zs_changelog',
			'zs_plugins',
			'zs_status',
		);
	}

	/**
	 * Get allowed post types.
	 *
	 * @return array
	 */
	protected function get_allowed_post_types() {
		return array(
			'omniverse_layout',
			'omniverse_slide',
			'omniverse_sidebar',
			'cms_block',
		);
	}

	/**
	 * Print header.
	 *
	 * @param array $views Views.
	 *
	 * @return array|false
	 */
	public function print_header( $views = false ) {
		$this->print_template( 'header' );

		return $views;
	}

	/**
	 * Print footer.
	 */
	public function print_footer() {
		$this->print_template( 'footer' );
	}

	/**
	 * Print template file.
	 *
	 * @param string $name Template name.
	 */
	public function print_template( $name ) {
		include_once get_parent_theme_file_path( OMNIVERSE_FRAMEWORK . '/admin/modules/dashboard/templates/' . $name . '.php' );
	}

	/**
	 * Add custom class to body.
	 *
	 * @param string $classes Body classes.
	 *
	 * @return string
	 */
	public function admin_body_classes( $classes ) {
		global $hook_suffix;

		$current_page      = isset( $_GET['page'] ) ? wp_unslash( $_GET['page'] ) : ''; // phpcs:ignore
		$current_post_type = isset( $_GET['post_type'] ) ? wp_unslash( $_GET['post_type'] ) : ''; // phpcs:ignore

		if ( in_array( $current_page, $this->get_allowed_pages(), true ) || ( ( 'edit.php' === $hook_suffix || 'edit-tags.php' === $hook_suffix ) && in_array( $current_post_type, $this->get_allowed_post_types(), true ) ) ) {
			$classes = wd_add_cssclass( 'dn-pages', $classes );
		}

		if ( Setup_Wizard::get_instance()->is_setup() && 'done' !== get_option( 'omniverse_setup_status' ) ) {
			$classes = wd_add_cssclass( 'dn-wizard', $classes );
		}

		$white_label_logo = omniverse_get_opt( 'white_label_sidebar_icon_logo', array( 'url' => '' ) );

		if ( omniverse_get_opt( 'white_label' ) && ! empty( $white_label_logo['url'] ) ) {
			$classes = wd_add_cssclass( 'wd-white-label-img', $classes );
		}

		if ( omniverse_get_current_page_builder() ) {
			$classes .= ' dn-builder-' . omniverse_get_current_page_builder();
		}

		return $classes;
	}
}

Dashboard::get_instance();
