<?php
/**
 * Elementor common custom controls
 *
 * @package dn
 */

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_common_before_render' ) ) {
	/**
	 * Common before render.
	 *
	 * @since 1.0.0
	 *
	 * @param object $widget Element.
	 */
	function omniverse_common_before_render( $widget ) {
		$settings = $widget->get_settings_for_display();

		if ( isset( $settings['element_parallax'] ) && $settings['element_parallax'] ) {
			omniverse_enqueue_js_library( 'parallax-scroll-bundle' );
		}

		if ( isset( $settings['_animation'] ) && $settings['_animation'] ) {
			omniverse_enqueue_inline_style( 'mod-animations-keyframes' );
		}

		if ( isset( $settings['wd_animation'] ) && $settings['wd_animation'] ) {
			omniverse_enqueue_inline_style( 'animations' );
			omniverse_enqueue_js_script( 'animations' );
			omniverse_enqueue_js_library( 'waypoints' );
		}

		if ( 'woocommerce-cart' === $widget->get_name() && 'yes' === $settings['update_cart_automatically'] ) {
			omniverse_enqueue_js_script( 'cart-quantity' );
		}
	}

	add_action( 'elementor/frontend/widget/before_render', 'omniverse_common_before_render', 10 );
}

if ( ! function_exists( 'omniverse_add_element_custom_controls' ) ) {
	/**
	 * Elements custom controls
	 *
	 * @since 1.0.0
	 *
	 * @param object $element The control.
	 */
	function omniverse_add_elements_custom_controls( $element ) {
		$element->start_controls_section(
			'wd_extra',
			[
				'label' => esc_html__( '[Zynxsol] Extra', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			]
		);

		/**
		 * Element parallax on scroll
		 */
		$element->add_control(
			'element_parallax',
			[
				'label'        => esc_html__( 'Parallax on scroll', 'omniverse' ),
				'description'  => esc_html__( 'Smooth element movement when you scroll the page to create beautiful parallax effect.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'parallax-on-scroll',
				'render_type'  => 'template',
				'prefix_class' => 'wd-',
			]
		);

		$element->add_control(
			'scroll_x',
			[
				'label'        => esc_html__( 'X axis translation', 'omniverse' ),
				'description'  => esc_html__( 'Recommended -200 to 200', 'omniverse' ),
				'type'         => Controls_Manager::TEXT,
				'default'      => 0,
				'render_type'  => 'template',
				'prefix_class' => 'wd_scroll_x_',
				'condition'    => [
					'element_parallax' => [ 'parallax-on-scroll' ],
				],
			]
		);

		$element->add_control(
			'scroll_y',
			[
				'label'        => esc_html__( 'Y axis translation', 'omniverse' ),
				'description'  => esc_html__( 'Recommended -200 to 200', 'omniverse' ),
				'type'         => Controls_Manager::TEXT,
				'default'      => - 80,
				'render_type'  => 'template',
				'prefix_class' => 'wd_scroll_y_',
				'condition'    => [
					'element_parallax' => [ 'parallax-on-scroll' ],
				],
			]
		);

		$element->add_control(
			'scroll_z',
			[
				'label'        => esc_html__( 'Z axis translation', 'omniverse' ),
				'description'  => esc_html__( 'Recommended -200 to 200', 'omniverse' ),
				'type'         => Controls_Manager::TEXT,
				'default'      => 0,
				'render_type'  => 'template',
				'prefix_class' => 'wd_scroll_z_',
				'condition'    => [
					'element_parallax' => [ 'parallax-on-scroll' ],
				],
			]
		);

		$element->add_control(
			'scroll_smoothness',
			[
				'label'        => esc_html__( 'Parallax smoothness', 'omniverse' ),
				'description'  => esc_html__( 'Define the parallax smoothness on mouse scroll. By default - 30', 'omniverse' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => [
					'10'  => '10',
					'20'  => '20',
					'30'  => '30',
					'40'  => '40',
					'50'  => '50',
					'60'  => '60',
					'70'  => '70',
					'80'  => '80',
					'90'  => '90',
					'100' => '100',
				],
				'default'      => '30',
				'render_type'  => 'template',
				'prefix_class' => 'wd_scroll_smoothness_',
				'condition'    => [
					'element_parallax' => [ 'parallax-on-scroll' ],
				],
			]
		);

		$element->add_control(
			'element_parallax_hr',
			[
				'type'  => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		/**
		 * Animations
		 */
		omniverse_get_animation_map( $element );

		$element->end_controls_section();
	}

	add_action( 'elementor/element/common/_section_style/after_section_end', 'omniverse_add_elements_custom_controls' );
}
