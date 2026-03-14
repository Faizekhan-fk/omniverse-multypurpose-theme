<?php
/**
 * Elementor column custom controls
 *
 * @package dn
 */

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_column_before_render' ) ) {
	/**
	 * Column before render.
	 *
	 * @since 1.0.0
	 *
	 * @param object $widget Element.
	 */
	function omniverse_column_before_render( $widget ) {
		$settings = $widget->get_settings_for_display();

		if ( isset( $settings['column_sticky'] ) && $settings['column_sticky'] ) {
			omniverse_enqueue_js_library( 'sticky-kit' );
			omniverse_enqueue_js_script( 'sticky-column' );
		}

		if ( isset( $settings['column_parallax'] ) && $settings['column_parallax'] ) {
			omniverse_enqueue_js_library( 'parallax-scroll-bundle' );
		}

		if ( isset( $settings['wd_animation'] ) && $settings['wd_animation'] ) {
			omniverse_enqueue_inline_style( 'animations' );
			omniverse_enqueue_js_script( 'animations' );
			omniverse_enqueue_js_library( 'waypoints' );
		}

		if ( isset( $settings['wd_collapsible_content_switcher'] ) && $settings['wd_collapsible_content_switcher'] ) {
			omniverse_enqueue_inline_style( 'collapsible-content' );
		}

		if ( isset( $settings['wd_column_role'] ) && $settings['wd_column_role'] ) {
			omniverse_enqueue_inline_style( 'int-elem-opt-off-canvas-column' );
		}
	}

	add_action( 'elementor/frontend/column/before_render', 'omniverse_column_before_render', 10 );
}

if ( ! function_exists( 'omniverse_add_column_color_scheme_control' ) ) {
	/**
	 * Column custom controls
	 *
	 * @since 1.0.0
	 *
	 * @param object $element The control.
	 */
	function omniverse_add_column_color_scheme_control( $element ) {
		$element->start_controls_section(
			'wd_extra_style',
			array(
				'label' => esc_html__( '[Zynxsol] Extra', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		/**
		 * Color scheme.
		 */
		$element->add_control(
			'wd_color_scheme',
			array(
				'label'        => esc_html__( 'Color Scheme', 'omniverse' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					''      => esc_html__( 'Inherit', 'omniverse' ),
					'light' => esc_html__( 'Light', 'omniverse' ),
					'dark'  => esc_html__( 'Dark', 'omniverse' ),
				),
				'default'      => '',
				'render_type'  => 'template',
				'prefix_class' => 'color-scheme-',
			)
		);

		$element->end_controls_section();
	}

	add_action( 'elementor/element/column/section_style/after_section_end', 'omniverse_add_column_color_scheme_control' );
}

if ( ! function_exists( 'omniverse_add_column_custom_controls' ) ) {
	/**
	 * Column custom controls
	 *
	 * @since 1.0.0
	 *
	 * @param object $element The control.
	 */
	function omniverse_add_column_custom_controls( $element ) {
		$element->start_controls_section(
			'wd_extra',
			array(
				'label' => esc_html__( '[Zynxsol] Extra', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			)
		);

		/**
		 * Column role.
		 */
		$element->add_control(
			'wd_column_role_heading',
			array(
				'label'     => esc_html__( 'Off canvas column ', 'omniverse' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$element->add_control(
			'wd_column_role',
			array(
				'label'       => __( 'Column role for "off-canvas layout"', 'omniverse' ),
				'description' => esc_html__( 'You can create your page layout with an off-canvas sidebar. In this case, you need to have two columns: one will be set as the off-canvas sidebar and another as the content. NOTE: you need to also display the Off-canvas button element somewhere in your content column to open the sidebar. Also, you need to enable them on specific devices synchronously.', 'omniverse' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					''          => esc_html__( 'None', 'omniverse' ),
					'offcanvas' => esc_html__( 'Off canvas column', 'omniverse' ),
					'content'   => esc_html__( 'Content column', 'omniverse' ),
				),
				'render_type' => 'template',
				'default'     => '',
			)
		);

		$element->add_control(
			'wd_column_role_offcanvas_desktop',
			array(
				'label'        => esc_html__( 'Desktop', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'lg',
				'prefix_class' => 'wd-col-offcanvas-',
				'condition'    => array(
					'wd_column_role' => 'offcanvas',
				),
				'render_type'  => 'template',
			)
		);

		$element->add_control(
			'wd_column_role_offcanvas_tablet',
			array(
				'label'        => esc_html__( 'Tablet', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'md-sm',
				'prefix_class' => 'wd-col-offcanvas-',
				'condition'    => array(
					'wd_column_role' => 'offcanvas',
				),
				'render_type'  => 'template',
			)
		);

		$element->add_control(
			'wd_column_role_offcanvas_mobile',
			array(
				'label'        => esc_html__( 'Mobile', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'sm',
				'prefix_class' => 'wd-col-offcanvas-',
				'condition'    => array(
					'wd_column_role' => 'offcanvas',
				),
				'render_type'  => 'template',
			)
		);

		$element->add_control(
			'wd_column_role_content_desktop',
			array(
				'label'        => esc_html__( 'Desktop', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'lg',
				'prefix_class' => 'wd-col-content-',
				'condition'    => array(
					'wd_column_role' => 'content',
				),
				'render_type'  => 'template',
			)
		);

		$element->add_control(
			'wd_column_role_content_tablet',
			array(
				'label'        => esc_html__( 'Tablet', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'md-sm',
				'prefix_class' => 'wd-col-content-',
				'condition'    => array(
					'wd_column_role' => 'content',
				),
				'render_type'  => 'template',
			)
		);

		$element->add_control(
			'wd_column_role_content_mobile',
			array(
				'label'        => esc_html__( 'Mobile', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'sm',
				'prefix_class' => 'wd-col-content-',
				'condition'    => array(
					'wd_column_role' => 'content',
				),
				'render_type'  => 'template',
			)
		);

		$element->add_control(
			'wd_off_canvas_alignment',
			array(
				'label'        => esc_html__( 'Off canvas alignment', 'omniverse' ),
				'type'         => 'wd_buttons',
				'options'      => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					),
				),
				'condition'    => array(
					'wd_column_role' => 'offcanvas',
				),
				'render_type'  => 'template',
				'default'      => 'left',
				'prefix_class' => 'wd-alignment-',
			)
		);

		$element->add_control(
			'wd_column_role_hr',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'style' => 'thick',
			)
		);

		/**
		 * Sticky column
		 */
		$element->add_control(
			'column_sticky',
			array(
				'label'        => esc_html__( 'Sticky column', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'sticky-column',
				'prefix_class' => 'wd-elementor-',
				'render_type'  => 'template',
				'condition'    => array(
					'wd_column_role' => array( '' ),
				),
			)
		);

		$element->add_control(
			'column_sticky_offset',
			array(
				'label'        => esc_html__( 'Sticky column offset (px)', 'omniverse' ),
				'type'         => Controls_Manager::TEXT,
				'default'      => 50,
				'render_type'  => 'template',
				'prefix_class' => 'wd_sticky_offset_',
				'condition'    => array(
					'column_sticky'  => array( 'sticky-column' ),
					'wd_column_role' => array( '' ),
				),
			)
		);

		$element->add_control(
			'column_sticky_hr',
			array(
				'type'      => Controls_Manager::DIVIDER,
				'style'     => 'thick',
				'condition' => array(
					'wd_column_role' => array( '' ),
				),
			)
		);

		/**
		 * Column parallax on scroll
		 */
		$element->add_control(
			'column_parallax',
			array(
				'label'        => esc_html__( 'Parallax on scroll', 'omniverse' ),
				'description'  => esc_html__( 'Smooth element movement when you scroll the page to create beautiful parallax effect.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'parallax-on-scroll',
				'prefix_class' => 'wd-',
				'render_type'  => 'template',
				'condition'    => array(
					'wd_column_role' => array( '' ),
				),
			)
		);

		$element->add_control(
			'scroll_x',
			array(
				'label'        => esc_html__( 'X axis translation', 'omniverse' ),
				'description'  => esc_html__( 'Recommended -200 to 200', 'omniverse' ),
				'type'         => Controls_Manager::TEXT,
				'default'      => 0,
				'render_type'  => 'template',
				'prefix_class' => 'wd_scroll_x_',
				'condition'    => array(
					'column_parallax' => array( 'parallax-on-scroll' ),
					'wd_column_role'  => array( '' ),
				),
			)
		);

		$element->add_control(
			'scroll_y',
			array(
				'label'        => esc_html__( 'Y axis translation', 'omniverse' ),
				'description'  => esc_html__( 'Recommended -200 to 200', 'omniverse' ),
				'type'         => Controls_Manager::TEXT,
				'default'      => - 80,
				'render_type'  => 'template',
				'prefix_class' => 'wd_scroll_y_',
				'condition'    => array(
					'column_parallax' => array( 'parallax-on-scroll' ),
					'wd_column_role'  => array( '' ),
				),
			)
		);

		$element->add_control(
			'scroll_z',
			array(
				'label'        => esc_html__( 'Z axis translation', 'omniverse' ),
				'description'  => esc_html__( 'Recommended -200 to 200', 'omniverse' ),
				'type'         => Controls_Manager::TEXT,
				'default'      => 0,
				'render_type'  => 'template',
				'prefix_class' => 'wd_scroll_z_',
				'condition'    => array(
					'column_parallax' => array( 'parallax-on-scroll' ),
					'wd_column_role'  => array( '' ),
				),
			)
		);

		$element->add_control(
			'scroll_smoothness',
			array(
				'label'        => esc_html__( 'Parallax smoothness', 'omniverse' ),
				'description'  => esc_html__( 'Define the parallax smoothness on mouse scroll. By default - 30', 'omniverse' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
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
				),
				'default'      => '30',
				'render_type'  => 'template',
				'prefix_class' => 'wd_scroll_smoothness_',
				'condition'    => array(
					'column_parallax' => array( 'parallax-on-scroll' ),
					'wd_column_role'  => array( '' ),
				),
			)
		);

		$element->add_control(
			'column_parallax_hr',
			array(
				'type'      => Controls_Manager::DIVIDER,
				'style'     => 'thick',
				'condition' => array(
					'wd_column_role' => array( '' ),
				),
			)
		);

		/**
		 * Hidden column content switcher.
		 */
		$element->add_control(
			'wd_collapsible_content_switcher',
			array(
				'label'        => esc_html__( 'Collapsible content', 'omniverse' ),
				'description'  => esc_html__( 'Limit the column height and add the "Read more" button. IMPORTANT: you need to add our "Button" element to the end of this column and enable an appropriate option there as well.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'collapsible-content',
				'prefix_class' => 'wd-',
				'condition'    => array(
					'wd_column_role' => array( '' ),
				),
			)
		);

		$element->add_responsive_control(
			'wd_collapsible_content_height',
			array(
				'label'     => esc_html__( 'Column content height', 'omniverse' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}}.wd-collapsible-content > .elementor-column-wrap > .elementor-widget-wrap, {{WRAPPER}}.wd-collapsible-content > .elementor-widget-wrap' => 'max-height: {{SIZE}}px',
				),
				'default'   => array(
					'size' => 300,
				),
				'condition' => array(
					'wd_collapsible_content_switcher' => array( 'collapsible-content' ),
					'wd_column_role'                  => array( '' ),
				),
			)
		);

		$element->add_control(
			'wd_collapsible_content_fade_out_color',
			array(
				'label'     => esc_html__( 'Fade out color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}.wd-collapsible-content:not(.wd-opened) > .elementor-column-wrap > .elementor-widget-wrap:after, {{WRAPPER}}.wd-collapsible-content:not(.wd-opened) > .elementor-widget-wrap:after' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'wd_collapsible_content_switcher' => array( 'collapsible-content' ),
					'wd_column_role'                  => array( '' ),
				),
			)
		);

		/**
		 * Animations.
		 */
		omniverse_get_animation_map(
			$element,
			array(
				'wd_column_role' => '',
			)
		);

		$element->end_controls_section();
	}

	add_action( 'elementor/element/column/section_advanced/after_section_end', 'omniverse_add_column_custom_controls' );
}
