<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
* Countdown timer element map
* ------------------------------------------------------------------------------------------------
*/

if( ! function_exists( 'omniverse_get_vc_map_countdown_timer' ) ) {
	function omniverse_get_vc_map_countdown_timer() {
		return array(
			'name' => esc_html__( 'Countdown timer', 'omniverse' ),
			'base' => 'omniverse_countdown_timer',
			'category' => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Shows countdown timer', 'omniverse' ),
			'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/countdown-timer.svg',
			'params' => array(
				array(
					'param_name' => 'omniverse_css_id',
					'type'       => 'omniverse_css_id',
				),
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Date', 'omniverse' ),
					'param_name' => 'date_divider'
				),
				array(
					'type' => 'omniverse_datepicker',
					'heading' => esc_html__( 'Date', 'omniverse' ),
					'param_name' => 'date',
					'hint' => esc_html__( 'Final date in the format Y/m/d. For example 2020/12/12 13:00', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Hide countdown on finish', 'omniverse' ),
					'param_name'       => 'hide_on_finish',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				/**
				 * Style
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'style_divider'
				),
				array(
					'type' => 'omniverse_dropdown',
					'heading' => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'style',
					'value' => array(
						esc_html__( 'Standard', 'omniverse' ) => 'standard',
						esc_html__( 'Transparent', 'omniverse' ) => 'transparent',
						esc_html__( 'Primary color', 'omniverse' ) => 'active',
						esc_html__( 'Simple', 'omniverse' ) => 'simple',
					),
					'style' => array(
						'active' => omniverse_get_color_value( 'primary-color', '#7eb934' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_button_set',
					'heading' => esc_html__( 'Color Scheme', 'omniverse' ),
					'param_name' => 'omniverse_color_scheme',
					'value' => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Light', 'omniverse' ) => 'light',
						esc_html__( 'Dark', 'omniverse' ) => 'dark',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_image_select',
					'heading' => esc_html__( 'Align', 'omniverse' ),
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
					'omni_tooltip' => true,
					'hint' => esc_html__( 'Select image alignment.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Size', 'omniverse' ),
					'param_name' => 'size',
					'value' => array(
						esc_html__( 'Medium (24px)', 'omniverse' ) => 'medium',
						esc_html__( 'Small (20px)', 'omniverse' ) => 'small',
						esc_html__( 'Large (28px)', 'omniverse' ) => 'large',
						esc_html__( 'Extra Large (42px)', 'omniverse' ) => 'xlarge',
					),
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
				( function_exists( 'vc_map_add_css_animation' ) ) ? vc_map_add_css_animation( true ) : '',
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				omniverse_get_vc_responsive_spacing_map(),
			)
		);
	}
}
