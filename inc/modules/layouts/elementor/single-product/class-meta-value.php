<?php
/**
 * Product meta value map.
 *
 * @package Omniverse
 */

namespace DN\Modules\Layouts;

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 */
class Meta_Value extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_single_product_meta_value';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Product meta value', 'omniverse' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'wd-icon-sp-meta-value';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'wd-single-product-elements' );
	}

	/**
	 * Show in panel.
	 *
	 * @return bool Whether to show the widget in the panel or not.
	 */
	public function show_in_panel() {
		return Main::is_layout_type( 'single_product' );
	}

	/**
	 * Register the widget controls.
	 */
	protected function register_controls() {

		/**
		 * Style tab.
		 */

		/**
		 * General settings
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
				'default'      => 'wd-single-meta-value',
				'prefix_class' => '',
			)
		);

		$this->add_control(
			'meta_key',
			array(
				'label'   => esc_html__( 'Meta key', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$this->add_control(
			'alignment',
			array(
				'label'        => esc_html__( 'Alignment', 'omniverse' ),
				'type'         => 'wd_buttons',
				'options'      => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					),
				),
				'prefix_class' => 'text-',
				'default'      => 'left',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label'    => esc_html__( 'Typography', 'omniverse' ),
				'name'     => 'typography',
				'selector' => '{{WRAPPER}}',
			)
		);

		$this->add_control(
			'color',
			array(
				'label'     => esc_html__( 'Color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => 'color: {{VALUE}}',
				),
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
				'meta_key' => '', // phpcs:ignore.
			)
		);

		Main::setup_preview();

		if ( ! empty( $settings['meta_key'] ) ) {
			echo get_post_meta( get_the_ID(), $settings['meta_key'], true ); // phpcs:ignore
		}

		Main::restore_preview();
	}
}

Plugin::instance()->widgets_manager->register( new Meta_Value() );
