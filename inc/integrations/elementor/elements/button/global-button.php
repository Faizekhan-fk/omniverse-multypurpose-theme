<?php
/**
 * Banner global map file.
 *
 * @package dn
 */

use Elementor\Controls_Manager;
	use Elementor\Group_Control_Image_Size;

	if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_button_content_general_map' ) ) {
	/**
	 * Get button map.
	 *
	 * @param  object $element  Element object.
	 * @param  array  $custom_args  Custom args.
	 *
	 * @since 1.0.0
	 */
	function omniverse_get_button_content_general_map( $element, $custom_args = array() ) {
		$default_args = array(
			'link'                => true,
			'smooth_scroll'       => true,
			'collapsible_content' => true,
			'text'                => 'Read more',
		);

		$args = wp_parse_args( $custom_args, $default_args );

		$element->add_control(
			'text',
			[
				'label'   => esc_html__( 'Text', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => $args['text'],
			]
		);

		if ( $args['link'] ) {
			$element->add_control(
				'link',
				[
					'label'   => esc_html__( 'Link', 'omniverse' ),
					'type'    => Controls_Manager::URL,
					'default' => [
						'url'         => '#',
						'is_external' => false,
						'nofollow'    => false,
					],
				]
			);
		}

		if ( $args['smooth_scroll'] ) {
			$element->add_control(
				'button_smooth_scroll',
				[
					'label'        => esc_html__( 'Smooth scroll', 'omniverse' ),
					'description'  => esc_html__(
						'When you turn on this option you need to specify this button link with a hash symbol. For example #section-id
Then you need to have a section with an ID of "section-id" and this button click will smoothly scroll the page to that section.',
						'omniverse'
					),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'no',
					'label_on'     => esc_html__( 'Yes', 'omniverse' ),
					'label_off'    => esc_html__( 'No', 'omniverse' ),
					'return_value' => 'yes',
					'separator'    => 'before',
				]
			);

			$element->add_control(
				'button_smooth_scroll_time',
				[
					'label'     => esc_html__( 'Smooth scroll time (ms)', 'omniverse' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 100,
					'condition' => [
						'button_smooth_scroll' => [ 'yes' ],
					],
				]
			);

			$element->add_control(
				'button_smooth_scroll_offset',
				[
					'label'     => esc_html__( 'Smooth scroll offset (px)', 'omniverse' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 100,
					'condition' => [
						'button_smooth_scroll' => [ 'yes' ],
					],
				]
			);
		}

		if ( $args['collapsible_content'] ) {
			$element->add_control(
				'button_collapsible_content',
				array(
					'label'        => esc_html__( 'Use for collapsible content', 'omniverse' ),
					'description'  => esc_html__( 'Enable this option when you place this button inside the container with the "Collapsible content" option turned on.', 'omniverse' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => '',
					'label_on'     => esc_html__( 'Yes', 'omniverse' ),
					'label_off'    => esc_html__( 'No', 'omniverse' ),
					'return_value' => 'yes',
					'separator'    => 'before',
				)
			);
		}
	}
}

if ( ! function_exists( 'omniverse_get_button_style_general_map' ) ) {
	/**
	 * Get button map.
	 *
	 * @param  object $element  Element object.
	 *
	 * @since 1.0.0
	 */
	function omniverse_get_button_style_general_map( $element ) {
		$element->add_control(
			'style',
			[
				'label'   => esc_html__( 'Style', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'default'  => esc_html__( 'Flat', 'omniverse' ),
					'bordered' => esc_html__( 'Bordered', 'omniverse' ),
					'link'     => esc_html__( 'Link button', 'omniverse' ),
					'3d'       => esc_html__( '3D', 'omniverse' ),
				],
				'default' => 'default',
			]
		);

		$element->add_control(
			'color',
			[
				'label'   => esc_html__( 'Predefined color', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Grey', 'omniverse' ),
					'primary' => esc_html__( 'Primary', 'omniverse' ),
					'alt'     => esc_html__( 'Alternative', 'omniverse' ),
					'black'   => esc_html__( 'Black', 'omniverse' ),
					'white'   => esc_html__( 'White', 'omniverse' ),
					'custom'  => esc_html__( 'Custom', 'omniverse' ),
				],
				'default' => 'default',
			]
		);

		$element->start_controls_tabs(
			'button_tabs_style',
			[
				'condition' => [
					'color' => [ 'custom' ],
				],
			]
		);

		$element->start_controls_tab(
			'button_tab_normal',
			[
				'label' => esc_html__( 'Normal', 'omniverse' ),
			]
		);

		$element->add_control(
			'bg_color',
			[
				'label'     => esc_html__( 'Background color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wd-button-wrapper a' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$element->add_control(
			'color_scheme',
			[
				'label'   => esc_html__( 'Text color scheme', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'inherit' => esc_html__( 'Inherit', 'omniverse' ),
					'dark'    => esc_html__( 'Dark', 'omniverse' ),
					'light'   => esc_html__( 'Light', 'omniverse' ),
					'custom'  => esc_html__( 'Custom', 'omniverse' ),
				],
				'default' => 'inherit',
			]
		);

		$element->add_control(
			'custom_color_scheme',
			[
				'label'     => esc_html__( 'Custom text color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wd-button-wrapper a' => 'color: {{VALUE}};',
				],
				'condition' => array(
					'color_scheme' => 'custom',
				),
			]
		);

		$element->end_controls_tab();

		$element->start_controls_tab(
			'button_tab_hover',
			[
				'label' => esc_html__( 'Hover', 'omniverse' ),
			]
		);

		$element->add_control(
			'bg_color_hover',
			[
				'label'     => esc_html__( 'Background color hover', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wd-button-wrapper:hover a' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$element->add_control(
			'color_scheme_hover',
			[
				'label'   => esc_html__( 'Text color scheme on hover', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'inherit' => esc_html__( 'Inherit', 'omniverse' ),
					'dark'    => esc_html__( 'Dark', 'omniverse' ),
					'light'   => esc_html__( 'Light', 'omniverse' ),
					'custom'  => esc_html__( 'Custom', 'omniverse' ),
				],
				'default' => 'inherit',
			]
		);

		$element->add_control(
			'custom_color_scheme_hover',
			[
				'label'     => esc_html__( 'Custom text color on hover', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wd-button-wrapper:hover a' => 'color: {{VALUE}};',
				],
				'condition' => array(
					'color_scheme_hover' => 'custom',
				),
			]
		);

		$element->end_controls_tab();

		$element->end_controls_tabs();

		$element->add_control(
			'size',
			[
				'label'   => esc_html__( 'Predefined size', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'default'     => esc_html__( 'Default', 'omniverse' ),
					'extra-small' => esc_html__( 'Extra Small', 'omniverse' ),
					'small'       => esc_html__( 'Small', 'omniverse' ),
					'large'       => esc_html__( 'Large', 'omniverse' ),
					'extra-large' => esc_html__( 'Extra Large', 'omniverse' ),
				],
				'default' => 'default',
			]
		);

		$element->add_control(
			'shape',
			[
				'label'   => esc_html__( 'Shape', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'rectangle'  => esc_html__( 'Rectangle', 'omniverse' ),
					'round'      => esc_html__( 'Circle', 'omniverse' ),
					'semi-round' => esc_html__( 'Round', 'omniverse' ),
				],
				'condition' => [
					'style!' => [ 'link' ],
				],
				'default' => 'rectangle',
			]
		);
	}
}

if ( ! function_exists( 'omniverse_get_button_style_layout_map' ) ) {
	/**
	 * Get button map.
	 *
	 * @param  object $element  Element object.
	 *
	 * @since 1.0.0
	 */
	function omniverse_get_button_style_layout_map( $element ) {
		$element->add_control(
			'align',
			[
				'label'   => esc_html__( 'Align', 'omniverse' ),
				'type'    => 'wd_buttons',
				'options' => [
					'left'   => [
						'title' => esc_html__( 'Left', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					],
				],
				'default' => 'center',
			]
		);

		$element->add_control(
			'full_width',
			[
				'label'        => esc_html__( 'Full width', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			]
		);
	}
}

if ( ! function_exists( 'omniverse_get_button_style_icon_map' ) ) {
	/**
	 * Get button map.
	 *
	 * @param  object $element  Element object.
	 *
	 * @since 1.0.0
	 */
	function omniverse_get_button_style_icon_map( $element, $prefix_key = '' ) {
		$element->add_control(
			$prefix_key . 'icon_type',
			[
				'label'   => esc_html__( 'Type', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'icon'  => esc_html__( 'Icon', 'omniverse' ),
					'image' => esc_html__( 'Image', 'omniverse' ),
				],
				'default' => 'icon',
			]
		);

		$element->add_control(
			$prefix_key . 'image',
			array(
				'label'     => esc_html__( 'Choose image', 'omniverse' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => array(
					$prefix_key . 'icon_type' => 'image',
				),
			)
		);

		$element->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => $prefix_key . 'image',
				'default'   => 'thumbnail',
				'separator' => 'none',
				'condition' => array(
					$prefix_key . 'icon_type' => 'image',
				),
			)
		);

		$element->add_control(
			$prefix_key . 'icon',
			[
				'label'     => esc_html__( 'Icon', 'omniverse' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => array(
					$prefix_key . 'icon_type' => 'icon',
				),
			]
		);

		$element->add_control(
			$prefix_key . 'icon_position',
			[
				'label'   => esc_html__( 'Icon position', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'right' => esc_html__( 'Right', 'omniverse' ),
					'left'  => esc_html__( 'Left', 'omniverse' ),
				],
				'default' => 'right',
			]
		);
	}
}

