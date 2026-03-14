<?php
/**
 * Wishlist button map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_single_product_wishlist_button' ) ) {
	/**
	 * Wishlist button map.
	 */
	function omniverse_get_vc_map_single_product_wishlist_button() {
		$typography = omniverse_get_typography_map(
			array(
				'key'        => 'button',
				'selector'   => '{{WRAPPER}} .wd-wishlist-btn > a span',
				'dependency' => array(
					'element' => 'style',
					'value'   => 'text',
				),
			)
		);

		return array(
			'base'        => 'omniverse_single_product_wishlist_button',
			'name'        => esc_html__( 'Add to wishlist button', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Single product elements', 'omniverse' ), 'single_product' ),
			'description' => esc_html__( 'Add the product to wishlist', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sp-icons/sp-add-to-wishlist-button.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),

				// Button.
				array(
					'title'      => esc_html__( 'Button', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'button_divider',
				),

				array(
					'heading'          => esc_html__( 'Alignment', 'omniverse' ),
					'type'             => 'wd_select',
					'param_name'       => 'alignment',
					'style'            => 'images',
					'selectors'        => array(),
					'devices'          => array(
						'desktop' => array(
							'value' => 'left',
						),
					),
					'value'            => array(
						esc_html__( 'Left', 'omniverse' )   => 'left',
						esc_html__( 'Center', 'omniverse' ) => 'center',
						esc_html__( 'Right', 'omniverse' )  => 'right',
					),
					'images'           => array(
						'left'   => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
						'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
						'right'  => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'omniverse_image_select',
					'param_name'       => 'style',
					'value'            => array(
						esc_html__( 'Icon with text', 'omniverse' )   => 'text',
						esc_html__( 'Icon only', 'omniverse' )  => 'icon',
					),
					'images_value'     => array(
						'text' => OMNIVERSE_ASSETS_IMAGES . '/settings/icon-style/icon-with-text.jpg',
						'icon' => OMNIVERSE_ASSETS_IMAGES . '/settings/icon-style/only-icon.jpg',
					),
					'wood_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				// Text.
				array(
					'title'      => esc_html__( 'Text', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'text_divider',
					'dependency' => array(
						'element' => 'style',
						'value'   => 'text',
					),
				),

				array(
					'heading'          => esc_html__( 'Idle color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'text_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-wishlist-btn > a span' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'style',
						'value'   => 'text',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Hover color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'text_color_hover',
					'selectors'        => array(
						'{{WRAPPER}} .wd-wishlist-btn > a:hover span' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'style',
						'value'   => 'text',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				$typography['font_family'],
				$typography['font_size'],
				$typography['font_weight'],
				$typography['text_transform'],
				$typography['font_style'],
				$typography['line_height'],

				// Icon.
				array(
					'title'      => esc_html__( 'Icon', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'icon_divider',
				),

				array(
					'heading'    => esc_html__( 'Icon size', 'omniverse' ),
					'type'       => 'wd_slider',
					'param_name' => 'icon_size',
					'selectors'  => array(
						'{{WRAPPER}} .wd-wishlist-btn[class*="wd-style-"] > a:before, {{WRAPPER}} .wd-wishlist-btn[class*="wd-style-"] > a:after' => array(
							'font-size: {{VALUE}}px;',
						),
					),
					'devices'    => array(
						'desktop' => array(
							'value' => '',
							'unit'  => 'px',
						),
						'tablet'  => array(
							'value' => '',
							'unit'  => 'px',
						),
						'mobile'  => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'      => array(
						'px' => array(
							'min'  => 0,
							'max'  => 50,
							'step' => 1,
						),
					),
				),

				array(
					'heading'          => esc_html__( 'Idle color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'icon_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-wishlist-btn > a:before' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Hover color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'icon_color_hover',
					'selectors'        => array(
						'{{WRAPPER}} .wd-wishlist-btn > a:hover:before' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
					'type'       => 'css_editor',
					'param_name' => 'css',
				),
				omniverse_get_vc_responsive_spacing_map(),

				// Width option (with dependency Columns option, responsive).
				omniverse_get_responsive_dependency_width_map( 'responsive_tabs' ),
				omniverse_get_responsive_dependency_width_map( 'width_desktop' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_desktop' ),
				omniverse_get_responsive_dependency_width_map( 'width_tablet' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_tablet' ),
				omniverse_get_responsive_dependency_width_map( 'width_mobile' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_mobile' ),
			),
		);
	}
}
