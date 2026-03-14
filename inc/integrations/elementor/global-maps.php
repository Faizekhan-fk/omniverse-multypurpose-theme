<?php
/**
 * Global map file.
 *
 * @package dn
 */

use Elementor\Controls_Manager;

if ( ! function_exists( 'omniverse_get_animation_map' ) ) {
	/**
	 * Get animation map
	 *
	 * @since 1.0.0
	 *
	 * @param object $element Element object.
	 * @param array  $condition Element condition. Default empty.
	 */
	function omniverse_get_animation_map( $element, $condition = array() ) {
		$wd_animation = array(
			'label'        => esc_html__( 'Animations', 'omniverse' ),
			'description'  => esc_html__( 'Use custom theme animations if you want to run them in the slider element.', 'omniverse' ),
			'type'         => Controls_Manager::SELECT2,
			'label_block'  => true,
			'options'      => array(
				''                       => esc_html__( 'None', 'omniverse' ),
				'slide-from-top'         => esc_html__( 'Slide from top', 'omniverse' ),
				'slide-from-bottom'      => esc_html__( 'Slide from bottom', 'omniverse' ),
				'slide-from-left'        => esc_html__( 'Slide from left', 'omniverse' ),
				'slide-from-right'       => esc_html__( 'Slide from right', 'omniverse' ),
				'slide-short-from-left'  => esc_html__( 'Slide short from left', 'omniverse' ),
				'slide-short-from-right' => esc_html__( 'Slide short from right', 'omniverse' ),
				'bottom-flip-x'          => esc_html__( 'Flip X bottom', 'omniverse' ),
				'top-flip-x'             => esc_html__( 'Flip X top', 'omniverse' ),
				'left-flip-y'            => esc_html__( 'Flip Y left', 'omniverse' ),
				'right-flip-y'           => esc_html__( 'Flip Y right', 'omniverse' ),
				'zoom-in'                => esc_html__( 'Zoom in', 'omniverse' ),
			),
			'default'      => '',
			'render_type'  => 'template',
			'prefix_class' => 'wd-animation-',
		);

		if ( ! empty( $condition ) ) {
			$wd_animation['condition'] = $condition;
		}

		$element->add_control(
			'wd_animation',
			$wd_animation
		);

		$element->add_control(
			'wd_animation_duration',
			array(
				'label'        => esc_html__( 'Animation duration', 'omniverse' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'normal',
				'options'      => array(
					'slow'   => esc_html__( 'Slow', 'omniverse' ),
					'normal' => esc_html__( 'Normal', 'omniverse' ),
					'fast'   => esc_html__( 'Fast', 'omniverse' ),
				),
				'condition'    => array_merge(
					array(
						'wd_animation!' => '',
					),
					$condition
				),
				'render_type'  => 'template',
				'prefix_class' => 'wd-animation-',
			)
		);

		$element->add_control(
			'wd_animation_delay',
			array(
				'label'        => esc_html__( 'Animation delay', 'omniverse' ) . ' (ms)',
				'type'         => Controls_Manager::NUMBER,
				'default'      => 100,
				'min'          => 0,
				'step'         => 100,
				'condition'    => array_merge(
					array(
						'wd_animation!' => '',
					),
					$condition
				),
				'render_type'  => 'template',
				'prefix_class' => 'wd_delay_',
			)
		);
	}
}

if ( ! function_exists( 'omniverse_elementor_add_carousel_maps' ) ) {
	/**
	 * Added carousel maps for elements.
	 *
	 * @param object $element Element object class.
	 * @return void
	 */
	function omniverse_elementor_add_carousel_maps( $element ) {
		$condition = array();

		if ( in_array( $element->get_name(), array( 'wd_products', 'wd_products_tabs', 'wd_portfolio' ), true ) ) {
			$condition = array(
				'condition' => array(
					'layout' => 'carousel',
				),
			);
		} elseif ( in_array( $element->get_name(), array( 'wd_product_categories', 'wd_products_brands' ), true ) ) {
			$condition = array(
				'condition' => array(
					'style' => array( 'carousel' ),
				),
			);
		} elseif ( 'wd_blog' === $element->get_name() ) {
			$condition = array(
				'condition' => array(
					'blog_design' => 'carousel',
				),
			);
		} elseif ( 'wd_images_gallery' === $element->get_name() ) {
			$condition = array(
				'condition' => array(
					'view' => array( 'carousel' ),
				),
			);
		} elseif ( 'wd_instagram' === $element->get_name() ) {
			$condition = array(
				'condition' => array(
					'design' => array( 'slider' ),
				),
			);
		} elseif ( 'wd_testimonials' === $element->get_name() ) {
			$condition = array(
				'condition' => array(
					'layout' => 'slider',
				),
			);
		}

		/**
		 * Carousel settings.
		 */
		$element->start_controls_section(
			'carousel_style_section',
			array_merge(
				array(
					'label' => esc_html__( 'Carousel', 'omniverse' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				),
				$condition
			)
		);

		if ( 'wd_instagram' !== $element->get_name() ) {
			$element->add_responsive_control(
				'slides_per_view',
				array(
					'label'       => esc_html__( 'Slides per view', 'omniverse' ),
					'description' => esc_html__( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode.', 'omniverse' ),
					'type'        => Controls_Manager::SLIDER,
					'default'     => array(
						'size' => 3,
					),
					'devices'     => array( 'desktop', 'tablet', 'mobile' ),
					'classes'     => 'wd-hide-custom-breakpoints',
					'size_units'  => '',
					'range'       => array(
						'px' => array(
							'min'  => 1,
							'max'  => 8,
							'step' => 0.5,
						),
					),
				)
			);
		}

		if ( in_array( $element->get_name(), array( 'wd_infobox_carousel', 'wd_banner_carousel', 'wd_nested_carousel' ), true ) ) {
			$element->add_responsive_control(
				'slider_spacing',
				array(
					'label'   => esc_html__( 'Space between', 'omniverse' ),
					'type'    => Controls_Manager::SELECT,
					'options' => array(
						0  => esc_html__( '0 px', 'omniverse' ),
						2  => esc_html__( '2 px', 'omniverse' ),
						6  => esc_html__( '6 px', 'omniverse' ),
						10 => esc_html__( '10 px', 'omniverse' ),
						20 => esc_html__( '20 px', 'omniverse' ),
						30 => esc_html__( '30 px', 'omniverse' ),
					),
					'devices' => array( 'desktop', 'tablet', 'mobile' ),
					'classes' => 'wd-hide-custom-breakpoints',
					'default' => 30,
				)
			);
		}

		$element->add_control(
			'scroll_per_page',
			array(
				'label'        => esc_html__( 'Scroll per page', 'omniverse' ),
				'description'  => esc_html__( 'Scroll per page not per item. This affect next/prev buttons and mouse/touch dragging.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$element->add_control(
			'center_mode',
			array(
				'label'        => esc_html__( 'Center mode', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
				'condition'    => array(
					'scroll_per_page!' => 'yes',
				),
			)
		);

		$element->add_control(
			'wrap',
			array(
				'label'        => esc_html__( 'Slider loop', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$element->add_control(
			'autoheight',
			array(
				'label'        => esc_html__( 'Auto height', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$element->add_control(
			'autoplay',
			array(
				'label'        => esc_html__( 'Slider autoplay', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$element->add_control(
			'speed',
			array(
				'label'       => esc_html__( 'Slider speed', 'omniverse' ),
				'description' => esc_html__( 'Duration of animation between slides (in ms)', 'omniverse' ),
				'default'     => '5000',
				'type'        => Controls_Manager::NUMBER,
				'condition'   => array(
					'autoplay' => 'yes',
				),
			)
		);

		$element->add_control(
			'scroll_carousel_init',
			array(
				'label'        => esc_html__( 'Init carousel on scroll', 'omniverse' ),
				'description'  => esc_html__( 'This option allows you to init carousel script only when visitor scroll the page to the slider. Useful for performance optimization.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$element->add_control(
			'disable_overflow_carousel',
			array(
				'label'        => esc_html__( 'Disabled overflow', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$element->add_control(
			'carousel_arrow',
			array(
				'label'     => esc_html__( 'Arrows', 'omniverse' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$element->add_control(
			'hide_prev_next_buttons',
			array(
				'label'        => esc_html__( 'Hide prev/next buttons', 'omniverse' ),
				'description'  => esc_html__( 'If "YES" prev/next control will be removed', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$element->add_control(
			'carousel_arrows_position_popover',
			array(
				'label'     => esc_html__( 'Position', 'omniverse' ),
				'type'      => Controls_Manager::POPOVER_TOGGLE,
				'condition' => array(
					'hide_prev_next_buttons!' => 'yes',
				),
			)
		);

		$element->start_popover();

		$element->add_control(
			'carousel_arrows_position',
			array(
				'label'     => esc_html__( 'Position', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''         => esc_html__( 'Inherit from Theme Settings', 'omniverse' ),
					'sep'      => esc_html__( 'Separate', 'omniverse' ),
					'together' => esc_html__( 'Together', 'omniverse' ),
				),
				'condition' => array(
					'hide_prev_next_buttons!'           => 'yes',
					'carousel_arrows_position_popover!' => '',
				),
			)
		);

		$element->add_responsive_control(
			'carousel_arrows_offset_h',
			array(
				'label'      => esc_html__( 'Offset horizontal', 'omniverse' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'custom' ),
				'range'      => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wd-nav-arrows' => '--wd-arrow-offset-h: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'hide_prev_next_buttons!'           => 'yes',
					'carousel_arrows_position_popover!' => '',
				),
			)
		);

		$element->add_responsive_control(
			'carousel_arrows_offset_v',
			array(
				'label'      => esc_html__( 'Offset vertical', 'omniverse' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'custom' ),
				'range'      => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wd-nav-arrows' => '--wd-arrow-offset-v: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'hide_prev_next_buttons!'           => 'yes',
					'carousel_arrows_position_popover!' => '',
				),
			)
		);

		$element->end_popover();

		$element->add_control(
			'carousel_pagination',
			array(
				'label'     => esc_html__( 'Pagination', 'omniverse' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$element->add_responsive_control(
			'hide_pagination_control',
			array(
				'label'          => esc_html__( 'Hide pagination control', 'omniverse' ),
				'description'    => esc_html__( 'If "YES" pagination control will be removed.', 'omniverse' ),
				'type'           => Controls_Manager::SWITCHER,
				'default'        => 'no',
				'tablet_default' => 'yes',
				'mobile_default' => 'yes',
				'devices'        => array( 'desktop', 'tablet', 'mobile' ),
				'classes'        => 'wd-hide-custom-breakpoints',
				'label_on'       => esc_html__( 'Yes', 'omniverse' ),
				'label_off'      => esc_html__( 'No', 'omniverse' ),
				'return_value'   => 'yes',
			)
		);

		$element->add_control(
			'dynamic_pagination_control',
			array(
				'label'        => esc_html__( 'Dynamic pagination control', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$element->add_responsive_control(
			'hide_scrollbar',
			array(
				'label'          => esc_html__( 'Hide scrollbar', 'omniverse' ),
				'description'    => esc_html__( 'If "YES" scrollbar will be removed.', 'omniverse' ),
				'type'           => Controls_Manager::SWITCHER,
				'default'        => 'yes',
				'tablet_default' => 'yes',
				'mobile_default' => 'yes',
				'label_on'       => esc_html__( 'Yes', 'omniverse' ),
				'label_off'      => esc_html__( 'No', 'omniverse' ),
				'devices'        => array( 'desktop', 'tablet', 'mobile' ),
				'classes'        => 'wd-hide-custom-breakpoints',
				'separator'      => 'before',
				'return_value'   => 'yes',
				'condition'      => array(
					'wrap!' => 'yes',
				),
			)
		);

		$element->add_control(
			'carousel_sync_heading',
			array(
				'label'     => esc_html__( 'Synchronization', 'omniverse' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$element->add_control(
			'carousel_sync',
			array(
				'label'   => esc_html__( 'Synchronization', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					''       => esc_html__( 'Disabled', 'omniverse' ),
					'parent' => esc_html__( 'As parent', 'omniverse' ),
					'child'  => esc_html__( 'As child', 'omniverse' ),
				),
				'default' => '',
			)
		);

		$element->add_control(
			'sync_parent_id',
			array(
				'label'     => esc_html__( 'ID', 'omniverse' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'wd_' . uniqid(),
				'ai'        => array(
					'active' => false,
				),
				'condition' => array(
					'carousel_sync' => array( 'parent' ),
				),
			)
		);

		$element->add_control(
			'sync_child_id',
			array(
				'label'     => esc_html__( 'ID', 'omniverse' ),
				'type'      => Controls_Manager::TEXT,
				'ai'        => array(
					'active' => false,
				),
				'condition' => array(
					'carousel_sync' => array( 'child' ),
				),
			)
		);

		$element->end_controls_section();
	}

	add_filter( 'elementor/element/wd_products/layout_style_section/after_section_end', 'omniverse_elementor_add_carousel_maps', 10, 2 );
	add_filter( 'elementor/element/wd_products_tabs/products_layout_style_section/after_section_end', 'omniverse_elementor_add_carousel_maps', 10, 2 );
	add_filter( 'elementor/element/wd_product_categories/layout_style_section/after_section_end', 'omniverse_elementor_add_carousel_maps', 10, 2 );
	add_filter( 'elementor/element/wd_blog/general_style_section/after_section_end', 'omniverse_elementor_add_carousel_maps', 10, 2 );
	add_filter( 'elementor/element/wd_images_gallery/layout_style_section/after_section_end', 'omniverse_elementor_add_carousel_maps', 10, 2 );
	add_filter( 'elementor/element/wd_instagram/layout_content_section/after_section_end', 'omniverse_elementor_add_carousel_maps', 10, 2 );
	add_filter( 'elementor/element/wd_portfolio/general_style_section/after_section_end', 'omniverse_elementor_add_carousel_maps', 10, 2 );
	add_filter( 'elementor/element/wd_infobox_carousel/hover_style_section/after_section_end', 'omniverse_elementor_add_carousel_maps', 10, 2 );
	add_filter( 'elementor/element/wd_banner_carousel/general_style_section/after_section_end', 'omniverse_elementor_add_carousel_maps', 10, 2 );
	add_filter( 'elementor/element/wd_products_brands/general_style_section/after_section_end', 'omniverse_elementor_add_carousel_maps', 10, 2 );
	add_filter( 'elementor/element/wd_testimonials/layout_style_section/after_section_end', 'omniverse_elementor_add_carousel_maps', 10, 2 );
	add_filter( 'elementor/element/wd_nested_carousel/general_section/after_section_end', 'omniverse_elementor_add_carousel_maps', 10, 2 );
}
