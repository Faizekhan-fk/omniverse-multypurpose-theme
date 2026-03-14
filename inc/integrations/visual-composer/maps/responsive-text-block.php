<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
* Promo Banner element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_responsive_text_block' ) ) {
	function omniverse_get_vc_map_responsive_text_block() {
		$secondary_font = omniverse_get_opt( 'secondary-font' );
		$primary_font = omniverse_get_opt( 'primary-font' );
		$text_font = omniverse_get_opt( 'text-font' );

		$secondary_font_title = isset( $secondary_font[0] ) ? esc_html__( 'Secondary font', 'omniverse' ) . ' (' . $secondary_font[0]['font-family'] . ')' : esc_html__( 'Secondary font', 'omniverse' );
		$text_font_title = isset( $text_font[0] ) ? esc_html__( 'Text font', 'omniverse' ) . ' (' . $text_font[0]['font-family'] . ')' : esc_html__( 'Text', 'omniverse' );
		$primary_font_title = isset( $primary_font[0] ) ? esc_html__( 'Title font', 'omniverse' ) . ' (' . $primary_font[0]['font-family'] . ')' : esc_html__( 'Title font', 'omniverse' );

		return array(
			'name' => esc_html__( 'Responsive text block (old)', 'omniverse' ),
			'base' => 'omniverse_responsive_text_block',
			'category' => omniverse_get_tab_title_category_for_wpb(  esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'New responsive text block', 'omniverse' ),
			'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/text-blox-res.svg',
			'params' => array(
				array(
					'type' => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id'
				),
				/**
				 * Text
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Text', 'omniverse' ),
					'param_name' => 'text_divider'
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'heading' => esc_html__( 'Text', 'omniverse' ),
					'param_name' => 'content'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Text font', 'omniverse' ),
					'param_name' => 'font',
					'value' => array(
						$primary_font_title => 'primary',
						$text_font_title => 'text',
						$secondary_font_title => 'alt'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Font size', 'omniverse' ),
					'param_name' => 'size',
					'value' => array(
						esc_html__( 'Default (22px)', 'omniverse' ) => 'default',
						esc_html__( 'Small (18px)', 'omniverse' ) => 'small',
						esc_html__( 'Medium (26px)', 'omniverse' ) => 'medium',
						esc_html__( 'Large (36px)', 'omniverse' ) => 'large',
						esc_html__( 'Extra Large (46px)', 'omniverse' ) => 'extra-large',
						esc_html__( 'Custom', 'omniverse' ) => 'custom'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_responsive_size',
					'heading' => esc_html__( 'Size', 'omniverse' ),
					'param_name' => 'text_font_size',
					'css_args' => array(
						'font-size' => array(
							' .omniverse-text-block',
						),
					),
					'dependency' => array(
						'element' => 'size',
						'value' => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_responsive_size',
					'heading' => esc_html__( 'Line height', 'omniverse' ),
					'param_name' => 'text_line_height',
					'css_args' => array(
						'line-height' => array(
							' .omniverse-text-block',
						),
					),
					'dependency' => array(
						'element' => 'size',
						'value' => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_empty_space',
					'param_name' => 'omniverse_empty_space',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Font weight', 'omniverse' ),
					'param_name' => 'font_weight',
					'value' => array(
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
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_dropdown',
					'heading' => esc_html__( 'Color scheme', 'omniverse' ),
					'param_name' => 'color_scheme',
					'value' => array(
						'' => '',
						esc_html__( 'Light', 'omniverse' ) => 'light',
						esc_html__( 'Dark', 'omniverse' ) => 'dark',
						esc_html__( 'Custom', 'omniverse' ) => 'custom'
					),
					'style' => array(
						'dark' => '#2d2a2a',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_colorpicker',
					'heading' => esc_html__( 'Custom Color', 'omniverse' ),
					'param_name' => 'color',
					'css_args' => array(
						'color' => array(
							' .omniverse-text-block',
						),
					),
					'dependency' => array(
						'element' => 'color_scheme',
						'value' => array( 'custom' )
					),
				),
				/**
				 * Layout
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Layout', 'omniverse' ),
					'param_name' => 'layout_divider'
				),
				array(
					'type' => 'omniverse_image_select',
					'heading' => esc_html__( 'Text align', 'omniverse' ),
					'param_name' => 'align',
					'value' => array(
						esc_html__( 'Left', 'omniverse' ) => 'left',
						esc_html__( 'Center', 'omniverse' ) => 'center',
						esc_html__( 'Right', 'omniverse' ) => 'right',
					),
					'images_value' => array(
						'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
						'left' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
						'right' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					),
					'std' => 'center',
					'wood_tooltip' => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'type' => 'omniverse_slider',
					'heading' => esc_html__( 'Content width', 'omniverse' ),
					'param_name' => 'content_width',
					'min' => '10',
					'max' => '100',
					'step' => '10',
					'default' => '100',
					'units' => '%',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Extra
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_divider'
				),
				array(
					'type' => 'omniverse_switch',
					'heading' => esc_html__( 'Display inline', 'omniverse' ),
					'param_name' => 'inline',
					'true_state' => 'yes',
					'false_state' => 'no',
					'default' => 'no',
				),
				( function_exists( 'vc_map_add_css_animation' ) ) ? vc_map_add_css_animation( true ) : '',
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' )
				),
				array(
					'type' => 'css_editor',
					'heading' => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group' => esc_html__( 'Design Options', 'js_composer' )
				),
				omniverse_get_vc_responsive_spacing_map(),
				/**
				 * Custom sizes
				 */
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Desktop text size ( > 1024px )', 'omniverse' ),
					'param_name' => 'desktop_text_size',
					'hint' => esc_html__( 'Only number without px.', 'omniverse' ),
					'group' => esc_html__( 'Custom size', 'omniverse' ),
					'dependency' => array(
						'element' => 'size',
						'value' => array( 'custom' )
					)
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Tablet text size ( < 1024px )', 'omniverse' ),
					'param_name' => 'tablet_text_size',
					'hint' => esc_html__( 'Only number without px.', 'omniverse' ),
					'group' => esc_html__( 'Custom size', 'omniverse' ),
					'dependency' => array(
						'element' => 'size',
						'value' => array( 'custom' )
					)
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Mobile text size ( < 767px )', 'omniverse' ),
					'param_name' => 'mobile_text_size',
					'hint' => esc_html__( 'Only number without px.', 'omniverse' ),
					'group' => esc_html__( 'Custom size', 'omniverse' ),
					'dependency' => array(
						'element' => 'size',
						'value' => array( 'custom' )
					)
				),
				/**
				 * Advanced.
				 */
				omniverse_get_vc_animation_map( 'wd_animation' ),
				omniverse_get_vc_animation_map( 'wd_animation_delay' ),
				omniverse_get_vc_animation_map( 'wd_animation_duration' ),
			),
		);
	}
}
