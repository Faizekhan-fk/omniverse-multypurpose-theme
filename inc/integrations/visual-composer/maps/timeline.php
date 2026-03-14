<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
* Timeline element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_timeline' ) ) {
	function omniverse_get_vc_map_timeline() {
		return array(
			'name' => esc_html__( 'Timeline', 'omniverse' ),
			'base' => 'omniverse_timeline',
			'as_parent' => array( 'only' => 'omniverse_timeline_item, omniverse_timeline_breakpoint' ),
			'content_element' => true,
			'show_settings_on_create' => true,
			'description' => esc_html__( 'Timeline for the history of your product', 'omniverse' ),
			'category' => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/timeline.svg',
			'params' => array(
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Genaral options', 'omniverse' ),
					'param_name' => 'general_divider'
				),
				array(
					'type' => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id'
				),
				array(
					'type' => 'omniverse_button_set',
					'heading' => esc_html__( 'Line style', 'omniverse' ),
					'param_name' => 'line_style',
					'value' => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Dashed', 'omniverse' ) => 'dashed'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_button_set',
					'heading' => esc_html__( 'Item style', 'omniverse' ),
					'param_name' => 'item_style',
					'value' => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'With shadow', 'omniverse' ) => 'shadow'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_colorpicker',
					'heading' => esc_html__( 'Color of line', 'omniverse' ),
					'param_name' => 'line_color',
					'css_args' => array(
						'background-color' => array(
							' .dot-start',
							' .dot-end',
						),
						'border-color' => array(
							' .omniverse-timeline-line',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_colorpicker',
					'heading' => esc_html__( 'Color of dots', 'omniverse' ),
					'param_name' => 'dots_color',
					'css_args' => array(
						'background-color' => array(
							' .omniverse-timeline-dot',
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
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				omniverse_get_vc_responsive_spacing_map(),
			),
			'js_view' => 'VcColumnView'
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_timeline_item' ) ) {
	function omniverse_get_vc_map_timeline_item() {
		return array(
			'name' => esc_html__( 'Timeline item', 'omniverse'),
			'base' => 'omniverse_timeline_item',
			'as_child' => array( 'only' => 'omniverse_timeline' ),
			'content_element' => true,
			'category' => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/timeline-item.svg',
			'params' => array(
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Genaral options', 'omniverse' ),
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
						esc_html__( 'Left', 'omniverse' ) => 'left',
						esc_html__( 'Right', 'omniverse' ) => 'right',
						esc_html__( 'Full Width', 'omniverse' ) => 'full-width'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_colorpicker',
					'heading' => esc_html__( 'Background color ', 'omniverse' ),
					'css_args' => array(
						'background-color' => array(
							'.wd-timeline-item',
							' .timeline-col-primary',
							' .timeline-col-secondary',
						),
						'color' => array(
							' .timeline-arrow',
						),
					),
					'param_name' => 'color_bg',
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
				/**
				 * Image
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Image', 'omniverse' ),
					'group' => esc_html__( 'Primary section', 'omniverse' ),
					'param_name' => 'primary_image_divider'
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image Primary', 'omniverse' ),
					'group' => esc_html__( 'Primary section', 'omniverse' ),
					'param_name' => 'image_primary',
					'value' => '',
					'hint' => esc_html__( 'Select image from media library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Image size', 'omniverse' ),
					'group' => esc_html__( 'Primary section', 'omniverse' ),
					'param_name' => 'img_size_primary',
					'hint' => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description' => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
				),
				/**
				 * Content
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Content', 'omniverse' ),
					'group' => esc_html__( 'Primary section', 'omniverse' ),
					'param_name' => 'primary_content_divider'
				),
				array(
					'type' => 'textarea',
					'holder' => 'div',
					'heading' => esc_html__( 'Title Primary', 'omniverse' ),
					'param_name' => 'title_primary',
					'group' => esc_html__( 'Primary section', 'omniverse' ),
					'hint' => esc_html__( 'Provide the title for primary timeline item.', 'omniverse' )
				),
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'Content Primary', 'omniverse' ),
					'group' => esc_html__( 'Primary section', 'omniverse' ),
					'param_name' => 'content',
					'hint' => esc_html__( 'Provide the description for primary timeline item.', 'omniverse' )
				),
				/**
				 * Image
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Image', 'omniverse' ),
					'group' => esc_html__( 'Secondary section', 'omniverse' ),
					'param_name' => 'secondary_image_divider'
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image Secondary', 'omniverse' ),
					'group' => esc_html__( 'Secondary section', 'omniverse' ),
					'param_name' => 'image_secondary',
					'value' => '',
					'hint' => esc_html__( 'Select image from media library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Image size', 'omniverse' ),
					'group' => esc_html__( 'Secondary section', 'omniverse' ),
					'param_name' => 'img_size_secondary',
					'hint' => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description' => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
				),
				/**
				 * Content
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Content', 'omniverse' ),
					'group' => esc_html__( 'Secondary section', 'omniverse' ),
					'param_name' => 'secondary_content_divider'
				),
				array(
					'type' => 'textarea',
					'holder' => 'div',
					'heading' => esc_html__( 'Title Secondary', 'omniverse' ),
					'group' => esc_html__( 'Secondary section', 'omniverse' ),
					'param_name' => 'title_secondary',
					'hint' => esc_html__( 'Provide the title for secondary timeline item.', 'omniverse' ),
				),
				array(
					'type' => 'textarea',
					'heading' => esc_html__( 'Content Secondary', 'omniverse' ),
					'group' => esc_html__( 'Secondary section', 'omniverse' ),
					'param_name' => 'content_secondary',
					'hint' => esc_html__( 'Provide the description for secondary timeline item.', 'omniverse' )
				)
			),
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_timeline_breakpoint' ) ) {
	function omniverse_get_vc_map_timeline_breakpoint() {
		return array(
			'name' => esc_html__( 'Timeline breakpoint', 'omniverse'),
			'base' => 'omniverse_timeline_breakpoint',
			'as_child' => array( 'only' => 'omniverse_timeline' ),
			'content_element' => true,
			'category' => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/timeline-breakpoint.svg',
			'params' => array(
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Genaral options', 'omniverse' ),
					'param_name' => 'general_divider'
				),
				array(
					'type' => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id'
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'heading' => esc_html__( 'Title', 'omniverse' ),
					'param_name' => 'title',
					'hint' => esc_html__( 'Provide the title for this timeline item.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_colorpicker',
					'heading' => esc_html__( 'Background color ', 'omniverse' ),
					'param_name' => 'color_bg',
					'css_args' => array(
						'background-color' => array(
							' .omniverse-timeline-breakpoint-title',
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
				)
			),
		);
	}
}

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if( class_exists( 'WPBakeryShortCodesContainer' ) ){
	class WPBakeryShortCode_omniverse_timeline extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if( class_exists( 'WPBakeryShortCode' ) ){
	class WPBakeryShortCode_omniverse_timeline_item extends WPBakeryShortCode {}
}
