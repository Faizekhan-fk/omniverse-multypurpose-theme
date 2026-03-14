<?php
/**
 * Cart totals map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_cart_totals' ) ) {
	function omniverse_get_vc_map_cart_totals() {
		$title_typography = omniverse_get_typography_map(
			array(
				'key'      => 'title_typography',
				'group'    => esc_html__( 'Style', 'omniverse' ),
				'selector' => '{{WRAPPER}} .cart-totals-inner > h2',
				'dependency' => array(
					'element' => 'show_title',
					'value' => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			)
		);

		return array(
			'base'        => 'omniverse_cart_totals',
			'name'        => esc_html__( 'Cart totals', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Cart elements', 'omniverse' ), 'cart' ),
			'description' => esc_html__( 'Totals and checkout button', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/ct-icons/ct-cart-totals.svg',
			'params'      => array(
				array(
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				array(
					'title'      => esc_html__( 'Title', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'title_style_section',
				),
				array(
					'heading'     => esc_html__( 'Enable title', 'omniverse' ),
					'group'       => esc_html__( 'Style', 'omniverse' ),
					'type'        => 'omniverse_switch',
					'param_name'  => 'show_title',
					'true_state'  => 'yes',
					'false_state' => 'no',
					'default'     => 'yes',
				),
				$title_typography['font_family'],
				$title_typography['font_size'],
				$title_typography['font_weight'],
				$title_typography['text_transform'],
				$title_typography['font_style'],
				$title_typography['line_height'],
				array(
					'heading'          => esc_html__( 'Color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'title_color',
					'selectors'        => array(
						'{{WRAPPER}} .cart-totals-inner > h2' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'show_title',
						'value'   => 'yes',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Alignment', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'title_alignment',
					'type'             => 'omniverse_image_select',
					'value'            => array(
						esc_html__( 'Left', 'omniverse' )   => 'left',
						esc_html__( 'Center', 'omniverse' ) => 'center',
						esc_html__( 'Right', 'omniverse' )  => 'right',
					),
					'images_value'     => array(
						'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
						'left'   => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
						'right'  => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					),
					'std'              => 'left',
					'omni_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
					'dependency'       => array(
						'element' => 'show_title',
						'value'   => 'yes',
					),
				),
				array(
					'title'      => esc_html__( 'Button', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'general_style_section',
				),
				array(
					'heading'    => esc_html__( 'Button position', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'wd_select',
					'param_name' => 'button_alignment',
					'style'      => 'select',
					'selectors'  => array(),
					'devices'    => array(
						'desktop' => array(
							'value' => 'left',
						),
					),
					'value'      => array(
						esc_html__( 'Left', 'omniverse' )       => 'left',
						esc_html__( 'Center', 'omniverse' )     => 'center',
						esc_html__( 'Right', 'omniverse' )      => 'right',
						esc_html__( 'Full width', 'omniverse' ) => 'full-width',
					),
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
