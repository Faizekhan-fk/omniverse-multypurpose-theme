<?php
/**
 * Page title map.
 *
 * @package Omniverse
 */

namespace DN\Modules\Layouts;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use DN\Modules\Layouts\Global_Data as Builder_Data;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 */
class Page_Title extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_page_title';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Page title', 'omniverse' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'wd-icon-wc-page-title';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'wd-woocommerce-elements' );
	}

	/**
	 * Show in panel.
	 *
	 * @return bool Whether to show the widget in the panel or not.
	 */
	public function show_in_panel() {
		return omniverse_woocommerce_installed();
	}

	/**
	 * Register the widget controls.
	 */
	protected function register_controls() {
		/**
		 * Style settings.
		 */
		$this->start_controls_section(
			'general_style_section',
			array(
				'label' => esc_html__( 'General', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'css_classes',
			array(
				'type'         => 'wd_css_class',
				'default'      => 'wd-page-title-el',
				'prefix_class' => '',
			)
		);

		$this->add_control(
			'full_width',
			array(
				'label'   => esc_html__( 'Full width', 'omniverse' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 */
	protected function render() {
		$settings = wp_parse_args(
			$this->get_settings_for_display(),
			array(
				'enable_title'       => 'yes',
				'enable_breadcrumbs' => 'yes',
				'enable_categories'  => 'yes',
				'full_width'         => '',
			)
		);

		$title_classes = '';

		if ( $settings['full_width'] ) {
			$title_classes .= ' wd-section-stretch';
		}

		Builder_Data::get_instance()->set_data( 'builder', true );
		Builder_Data::get_instance()->set_data( 'title_classes', $title_classes );
		Builder_Data::get_instance()->set_data( 'layout_id', get_the_ID() );

		Main::setup_preview();

		omniverse_enqueue_inline_style( 'el-page-title-builder' );

		if ( is_product_taxonomy() || is_shop() || is_product_category() || is_product_tag() || omniverse_is_product_attribute_archive() ) {
			omniverse_enqueue_inline_style( 'woo-shop-page-title' );

			if ( ! omniverse_get_opt( 'shop_title' ) ) {
				omniverse_enqueue_inline_style( 'woo-shop-opt-without-title' );
			}

			if ( omniverse_get_opt( 'shop_categories' ) ) {
				omniverse_enqueue_inline_style( 'shop-title-categories' );
				omniverse_enqueue_inline_style( 'woo-categories-loop-nav-mobile-accordion' );
			}
		}

		omniverse_page_title();

		Main::restore_preview();
	}
}

Plugin::instance()->widgets_manager->register( new Page_Title() );
