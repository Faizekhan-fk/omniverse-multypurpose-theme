<?php
/**
 * View element.
 *
 * @package Omniverse
 */

namespace DN\Modules\Layouts;

use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 */
class View extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_shop_archive_view';
	}

	/**
	 * Get widget content.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Products view', 'omniverse' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'wd-icon-sa-product-view';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'wd-shop-archive-elements' );
	}

	/**
	 * Show in panel.
	 *
	 * @return bool Whether to show the widget in the panel or not.
	 */
	public function show_in_panel() {
		return Main::is_layout_type( 'shop_archive' );
	}

	/**
	 * Register the widget controls.
	 */
	protected function register_controls() {

		/**
		 * Content tab
		 */

		/**
		 * General settings
		 */
		$this->start_controls_section(
			'general_content_section',
			array(
				'label' => esc_html__( 'General', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'css_classes',
			array(
				'type'         => 'wd_css_class',
				'default'      => 'wd-shop-view',
				'prefix_class' => '',
			)
		);

		$this->add_control(
			'products_columns_variations',
			array(
				'label'    => esc_html__( 'Products columns', 'omniverse' ),
				'type'     => Controls_Manager::SELECT2,
				'multiple' => true,
				'options'  => array(
					'2'    => esc_html__( '2', 'omniverse' ),
					'3'    => esc_html__( '3', 'omniverse' ),
					'4'    => esc_html__( '4', 'omniverse' ),
					'5'    => esc_html__( '5', 'omniverse' ),
					'6'    => esc_html__( '6', 'omniverse' ),
					'list' => esc_html__( 'List', 'omniverse' ),
				),
				'default'  => array( 2, 3, 4 ),
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
				'products_columns_variations' => array( 2, 3, 4 ),
			)
		);

		$settings['products_view']    = omniverse_new_get_shop_view( '', true );
		$settings['products_columns'] = omniverse_new_get_products_columns_per_row( '', true );

		Main::setup_preview();

		omniverse_enqueue_inline_style( 'woo-shop-el-products-view' );

		omniverse_products_view_select( false, $settings );

		Main::restore_preview();
	}
}

Plugin::instance()->widgets_manager->register( new View() );
