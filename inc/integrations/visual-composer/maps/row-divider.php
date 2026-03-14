<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
* Section divider element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_row_divider' ) ) {
	function omniverse_get_vc_map_row_divider() {
		return array(
			'name' => esc_html__( 'Section divider', 'omniverse'),
			'base' => 'omniverse_row_divider',
			'category' => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Divider for sections', 'omniverse' ),
			'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/section-divider.svg',
			'params' => array(
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'General options', 'omniverse' ),
					'param_name' => 'general_divider'
				),
				array(
					'type' => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id'
				),
				array(
					'type' => 'omniverse_button_set',
					'heading' => esc_html__( 'Position', 'omniverse' ),
					'param_name' => 'position',
					'value' => array(
						esc_html__( 'Top', 'omniverse' ) => 'top',
						esc_html__( 'Bottom', 'omniverse' ) => 'bottom'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_image_select',
					'heading' => esc_html__( 'Button style', 'omniverse' ),
					'param_name' => 'style',
					'value' => array(
						esc_html__( 'Waves Small', 'omniverse' ) => 'waves-small',
						esc_html__( 'Waves Wide', 'omniverse' ) => 'waves-wide',
						esc_html__( 'Curved Line', 'omniverse' ) => 'curved-line',
						esc_html__( 'Triangle', 'omniverse' ) => 'triangle',
						esc_html__( 'Clouds', 'omniverse' ) => 'clouds',
						esc_html__( 'Diagonal Right', 'omniverse' ) => 'diagonal-right',
						esc_html__( 'Diagonal Left', 'omniverse' ) => 'diagonal-left',
						esc_html__( 'Half Circle', 'omniverse' ) => 'half-circle',
						esc_html__( 'Paint Stroke', 'omniverse' ) => 'paint-stroke',
						esc_html__( 'Sweet wave', 'omniverse' ) => 'sweet-wave'
					),
					'images_value' => array(
						'waves-small' => OMNIVERSE_ASSETS_IMAGES . '/settings/dividers/waves-small.png',
						'waves-wide' => OMNIVERSE_ASSETS_IMAGES . '/settings/dividers/waves-wide.png',
						'curved-line' => OMNIVERSE_ASSETS_IMAGES . '/settings/dividers/curved-line.png',
						'triangle' => OMNIVERSE_ASSETS_IMAGES . '/settings/dividers/triangle.png',
						'clouds' => OMNIVERSE_ASSETS_IMAGES . '/settings/dividers/clouds.png',
						'diagonal-right' => OMNIVERSE_ASSETS_IMAGES . '/settings/dividers/diagonal-right.png',
						'diagonal-left' => OMNIVERSE_ASSETS_IMAGES . '/settings/dividers/diagonal-left.png',
						'half-circle' => OMNIVERSE_ASSETS_IMAGES . '/settings/dividers/half-circle.png',
						'paint-stroke' => OMNIVERSE_ASSETS_IMAGES . '/settings/dividers/paint-stroke.png',
						'sweet-wave' => OMNIVERSE_ASSETS_IMAGES . '/settings/dividers/sweet-wave.png',
					),
					'omni_tooltip' => true,
					'std' => 'waves-small',
					'edit_field_class' => 'vc_col-xs-12 vc_column divider',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Custom height', 'omniverse' ),
					'param_name' => 'custom_height',
					'dependency' => array(
						'element' => 'style',
						'value' => array( 'curved-line', 'diagonal-right', 'half-circle', 'diagonal-left', 'sweet-wave' )
					),
					'hint' => esc_html__( 'Enter divider height (Note: CSS measurement units allowed).', 'omniverse' )
				),
				array(
					'type' => 'omniverse_switch',
					'heading' => esc_html__( 'Overlap', 'omniverse' ),
					'param_name' => 'content_overlap',
					'true_state' => 'enable',
					'false_state' => 'disable',
					'default' => 'disable',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_colorpicker',
					'heading' => esc_html__( 'Color', 'omniverse' ),
					'hint' => esc_html__( 'We recommend you to set the same color as your row’s background color for the best effect.', 'omniverse' ),
					'param_name' => 'color',
					'css_args' => array(
						'fill' => array(
							' svg',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_divider'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' )
				),
			),
		);
	}
}
