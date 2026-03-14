<?php
/**
 * Countdown map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_single_product_countdown' ) ) {
	/**
	 * Countdown map.
	 */
	function omniverse_get_vc_map_single_product_countdown() {
		$typography = omniverse_get_typography_map(
			array(
				'key'      => 'title',
				'selector' => '{{WRAPPER}}.wd-single-countdown .element-title',
			)
		);

		return array(
			'base'        => 'omniverse_single_product_countdown',
			'name'        => esc_html__( 'Product countdown', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Single product elements', 'omniverse' ), 'single_product' ),
			'description' => esc_html__( 'Sale price end date countdown', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sp-icons/sp-countdown.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),

				array(
					'title'      => esc_html__( 'Title', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'title_divider',
				),

				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Element title', 'omniverse' ),
					'param_name' => 'title',
				),

				array(
					'heading'          => esc_html__( 'Color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'title_color',
					'selectors'        => array(
						'{{WRAPPER}}.wd-single-countdown .element-title' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				$typography['font_family'],
				$typography['font_size'],
				$typography['font_weight'],
				$typography['text_transform'],
				$typography['font_style'],
				$typography['line_height'],

				array(
					'title'      => esc_html__( 'Layout', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'settings_divider',
				),

				array(
					'type'             => 'omniverse_dropdown',
					'heading'          => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'timer_style',
					'value'            => array(
						esc_html__( 'Standard', 'omniverse' ) => 'standard',
						esc_html__( 'Transparent', 'omniverse' ) => 'transparent',
						esc_html__( 'Primary color', 'omniverse' ) => 'active',
						esc_html__( 'Simple', 'omniverse' ) => 'simple',
					),
					'style'            => array(
						'active' => omniverse_get_color_value( 'primary-color', '#7eb934' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Color Scheme', 'omniverse' ),
					'param_name'       => 'omniverse_color_scheme',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Light', 'omniverse' ) => 'light',
						esc_html__( 'Dark', 'omniverse' )  => 'dark',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
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
