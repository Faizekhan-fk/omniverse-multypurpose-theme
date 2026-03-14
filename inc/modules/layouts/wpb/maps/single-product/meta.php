<?php
/**
 * Meta map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_single_product_product_meta' ) ) {
	/**
	 * Meta map.
	 */
	function omniverse_get_vc_map_single_product_product_meta() {
		$typography = array();

		if ( function_exists( 'omniverse_get_typography_map' ) ) {
			$typography = omniverse_get_typography_map(
				array(
					'key'      => 'label',
					'selector' => '{{WRAPPER}} .meta-label',
					'group'    => esc_html__( 'Style', 'js_composer' ),
				)
			);
		}

		return array(
			'base'        => 'omniverse_single_product_meta',
			'name'        => esc_html__( 'Product meta', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Single product elements', 'omniverse' ), 'single_product' ),
			'description' => esc_html__( 'SKU, category, and tags', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sp-icons/sp-meta.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
					'group'      => esc_html__( 'Style', 'js_composer' ),
				),
				/**
				 * Style tab.
				 */
				// General.
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'General', 'omniverse' ),
					'param_name' => 'style_general_divider',
					'group'      => esc_html__( 'Style', 'js_composer' ),
				),
				array(
					'heading'          => esc_html__( 'Show SKU', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'js_composer' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'show_sku',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'yes',
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Show categories', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'js_composer' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'show_categories',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'yes',
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Show tags', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'js_composer' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'show_tags',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'yes',
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Layout', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'layout',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Inline', 'omniverse' )  => 'inline',
						esc_html__( 'Justify', 'omniverse' ) => 'justify',
					),
					'omni_tooltip'     => true,
					'group'            => esc_html__( 'Style', 'js_composer' ),
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
					'dependency'       => array(
						'element'            => 'layout',
						'value_not_equal_to' => 'justify',
					),
					'group'            => esc_html__( 'Style', 'js_composer' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				// Label.
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Label', 'omniverse' ),
					'param_name' => 'style_label_divider',
					'group'      => esc_html__( 'Style', 'js_composer' ),
				),
				function_exists( 'omniverse_get_typography_map' ) ? $typography['font_family'] : '',
				function_exists( 'omniverse_get_typography_map' ) ? $typography['font_size'] : '',
				function_exists( 'omniverse_get_typography_map' ) ? $typography['font_weight'] : '',
				function_exists( 'omniverse_get_typography_map' ) ? $typography['text_transform'] : '',
				function_exists( 'omniverse_get_typography_map' ) ? $typography['font_style'] : '',
				function_exists( 'omniverse_get_typography_map' ) ? $typography['line_height'] : '',
				array(
					'heading'          => esc_html__( 'Label color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'label_color',
					'selectors'        => array(
						'{{WRAPPER}} .meta-label' => array(
							'color: {{VALUE}};',
						),
					),
					'group'            => esc_html__( 'Style', 'js_composer' ),
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
