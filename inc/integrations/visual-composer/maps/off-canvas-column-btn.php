<?php
/**
 * Maps for off canvas button element.
 *
 * @package Elements.
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_get_vc_map_off_canvas_btn' ) ) {
	/**
	 * Displays the shortcode settings fields in the admin.
	 */
	function omniverse_get_vc_map_off_canvas_btn() {
		return array(
			'base'        => 'omniverse_off_canvas_btn',
			'name'        => esc_html__( 'Off canvas column button', 'omniverse' ),
			'description' => esc_html__( 'Button for off canvas column', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/off-canvas-column-button.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				/**
				 * General settings.
				 */
				array(
					'param_name' => 'button_text',
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Button text', 'omniverse' ),
					'std'        => 'Show column',
				),
				array(
					'param_name'       => 'sticky',
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Sticky', 'omniverse' ),
					'hint'             => esc_html__( 'Make the off canvas sidebar button sticky.', 'omniverse' ),
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'std'              => 'no',
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				/**
				 * Icon settings.
				 */
				array(
					'param_name' => 'icon_style_section',
					'type'       => 'omniverse_title_divider',
					'title'      => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
				),
				array(
					'param_name'       => 'icon_type',
					'type'             => 'omniverse_dropdown',
					'heading'          => esc_html__( 'Type', 'omniverse' ),
					'std'              => 'default',
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
					'value'            => array(
						esc_html__( 'Without icon', 'omniverse' ) => 'without',
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Custom image', 'omniverse' ) => 'custom',
					),
				),
				array(
					'param_name'       => 'img_id',
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Image', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'custom' ),
					),
				),
				array(
					'param_name'       => 'img_size',
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'20x20\' size.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'custom' ),
					),
				),
				// Design Options tab.
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				omniverse_get_vc_responsive_spacing_map(),

				/**
				 * Advanced tab.
				 */
				omniverse_get_vc_responsive_visible_map( 'responsive_tabs_hide' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_desktop' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_tablet' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_mobile' ),

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
