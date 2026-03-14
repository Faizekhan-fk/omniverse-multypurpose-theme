<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}
/**
* ------------------------------------------------------------------------------------------------
* Animated counter element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_animated_counter' ) ) {
	function omniverse_get_vc_map_animated_counter() {
		return array(
			'name'        => esc_html__( 'Animated Counter', 'omniverse' ),
			'description' => esc_html__( 'Shows animated counter with label', 'omniverse' ),
			'base'        => 'omniverse_counter',
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/animated-counter.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				/**
				 * Text
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Text', 'omniverse' ),
					'param_name' => 'text_divider',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Label', 'omniverse' ),
					'param_name'       => 'label',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Actual value', 'omniverse' ),
					'param_name'       => 'value',
					'hint'             => esc_html__( 'Our final point. For ex.: 95', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Style
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'style_divider',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Size', 'omniverse' ),
					'param_name'       => 'size',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => '',
						esc_html__( 'Small', 'omniverse' )  => 'small',
						esc_html__( 'Large', 'omniverse' )  => 'large',
						esc_html__( 'Extra large', 'omniverse' ) => 'extra-large',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Custom font size', 'omniverse' ),
					'param_name'       => 'custom_value_size',
					'css_args'         => array(
						'font-size' => array(
							' .counter-value',
						),
					),
					'dependency'       => array(
						'element' => 'size',
						'value'   => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Custom line height', 'omniverse' ),
					'param_name'       => 'custom_value_line_height',
					'css_args'         => array(
						'line-height' => array(
							' .counter-value',
						),
					),
					'dependency'       => array(
						'element' => 'size',
						'value'   => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Countdown number font weight', 'omniverse' ),
					'param_name'       => 'font_weight',
					'value'            => array(
						'' => '',
						esc_html__( 'Ultra-Light 100', 'omniverse' ) => 100,
						esc_html__( 'Light 200', 'omniverse' ) => 200,
						esc_html__( 'Book 300', 'omniverse' ) => 300,
						esc_html__( 'Normal 400', 'omniverse' ) => 400,
						esc_html__( 'Medium 500', 'omniverse' ) => 500,
						esc_html__( 'Semi-Bold 600', 'omniverse' ) => 600,
						esc_html__( 'Bold 700', 'omniverse' ) => 700,
						esc_html__( 'Extra-Bold 800', 'omniverse' ) => 800,
						esc_html__( 'Ultra-Bold 900', 'omniverse' ) => 900,
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Align', 'omniverse' ),
					'param_name'       => 'align',
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
					'std'              => 'center',
					'omni_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Color scheme', 'omniverse' ),
					'param_name'       => 'color_scheme',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Light', 'omniverse' )  => 'light',
						esc_html__( 'Dark', 'omniverse' )   => 'dark',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'omniverse_colorpicker',
					'heading'    => esc_html__( 'Custom color', 'omniverse' ),
					'param_name' => 'color',
					'css_args'   => array(
						'color' => array(
							'.omniverse-counter',
						),
					),
					'dependency' => array(
						'element' => 'color_scheme',
						'value'   => array( 'custom' ),
					),
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
				( function_exists( 'vc_map_add_css_animation' ) ) ? vc_map_add_css_animation( true ) : '',
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				omniverse_get_vc_responsive_spacing_map(),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
				/**
				 * Advanced
				 */

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
