<?php
if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

/**
 * ------------------------------------------------------------------------------------------------
 * Size guide element map
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'omniverse_get_vc_map_size_guide' ) ) {
	function omniverse_get_vc_map_size_guide() {
		return array(
			'name'        => esc_html__( 'Size guide', 'omniverse' ),
			'base'        => 'omniverse_size_guide',
			'class'       => '',
			'category'    => function_exists( 'omniverse_get_tab_title_category_for_wpb' ) ?
				omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ) : esc_html__( 'Theme elements', 'omniverse' ),
			'description' => esc_html__( 'Display size guide table anywhere', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/size-guide.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				/**
				 * Content
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Content', 'omniverse' ),
					'param_name' => 'content_divider',
				),
				array(
					'type'       => 'omniverse_dropdown',
					'heading'    => esc_html__( 'Select size guide', 'omniverse' ),
					'param_name' => 'id',
					'callback'   => 'omniverse_get_size_guides_array',
				),
				array(
					'type' => 'omniverse_switch',
					'heading' => esc_html__( 'Show title', 'omniverse' ),
					'param_name' => 'title',
					'true_state' => 1,
					'false_state' => 0,
					'default' => 1,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_switch',
					'heading' => esc_html__( 'Show description', 'omniverse' ),
					'param_name' => 'description',
					'true_state' => 1,
					'false_state' => 0,
					'default' => 1,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Extra
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_divider',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
				array(
					'type' => 'css_editor',
					'heading' => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group' => esc_html__( 'Design Options', 'js_composer' )
				),
				function_exists( 'omniverse_get_vc_responsive_spacing_map' ) ? omniverse_get_vc_responsive_spacing_map() : '',
			),
		);
	}
}
