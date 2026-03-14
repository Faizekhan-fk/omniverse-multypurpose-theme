<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}
/**
* ------------------------------------------------------------------------------------------------
* Testimonials element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_testimonials' ) ) {
	function omniverse_get_vc_map_testimonials() {
		return array(
			'name'                    => esc_html__( 'Testimonials', 'omniverse' ),
			'base'                    => 'testimonials',
			'as_parent'               => array( 'only' => 'testimonial' ),
			'content_element'         => true,
			'show_settings_on_create' => false,
			'category'                => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description'             => esc_html__( 'User testimonials slider or grid', 'omniverse' ),
			'icon'                    => OMNIVERSE_ASSETS . '/images/vc-icon/testimonials.svg',
			'params'                  => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Title', 'omniverse' ),
					'param_name' => 'title_divider',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Element title', 'omniverse' ),
					'param_name' => 'title',
					'value'      => '',
				),
				/**
				 * Layout
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Layout', 'omniverse' ),
					'param_name' => 'layout_divider',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Layout', 'omniverse' ),
					'param_name'       => 'layout',
					'value'            => array(
						esc_html__( 'Carousel', 'omniverse' ) => 'slider',
						esc_html__( 'Grid', 'omniverse' ) => 'grid',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Columns', 'omniverse' ),
					'param_name'       => 'columns_tabs',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'dependency'       => array(
						'element' => 'layout',
						'value'   => array( 'grid' ),
					),
					'default'          => 'desktop',
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'columns',
					'value'            => array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					),
					'std'              => '3',
					'dependency'       => array(
						'element' => 'layout',
						'value'   => array( 'grid' ),
					),
					'wd_dependency'    => array(
						'element' => 'columns_tabs',
						'value'   => array( 'desktop' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'columns_tablet',
					'value'            => array(
						esc_html__( 'Auto', 'omniverse' ) => 'auto',
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					),
					'std'              => 'auto',
					'dependency'       => array(
						'element' => 'layout',
						'value'   => array( 'grid' ),
					),
					'wd_dependency'    => array(
						'element' => 'columns_tabs',
						'value'   => array( 'tablet' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'columns_mobile',
					'value'            => array(
						esc_html__( 'Auto', 'omniverse' ) => 'auto',
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					),
					'std'              => 'auto',
					'dependency'       => array(
						'element' => 'layout',
						'value'   => array( 'grid' ),
					),
					'wd_dependency'    => array(
						'element' => 'columns_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),

				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Space between testimonial', 'omniverse' ),
					'param_name'       => 'spacing_tabs',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'default'          => 'desktop',
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'spacing',
					'value'            => array(
						30,
						20,
						10,
						6,
						2,
						0,
					),
					'wd_dependency'    => array(
						'element' => 'spacing_tabs',
						'value'   => array( 'desktop' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'spacing_tablet',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						'30' => '30',
						'20' => '20',
						'10' => '10',
						'6'  => '6',
						'2'  => '2',
						'0'  => '0',
					),
					'std'              => '',
					'wd_dependency'    => array(
						'element' => 'spacing_tabs',
						'value'   => array( 'tablet' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'spacing_mobile',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						'30' => '30',
						'20' => '20',
						'10' => '10',
						'6'  => '6',
						'2'  => '2',
						'0'  => '0',
					),
					'std'              => '',
					'wd_dependency'    => array(
						'element' => 'spacing_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				/**
				 * Slider
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Carousel', 'omniverse' ),
					'group'      => esc_html__( 'Carousel', 'omniverse' ),
					'param_name' => 'slider_divider',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'slider' ),
					),
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
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Color Scheme', 'omniverse' ),
					'param_name'       => 'omniverse_color_scheme',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Light', 'omniverse' )   => 'light',
						esc_html__( 'Dark', 'omniverse' )    => 'dark',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'style',
					'value'            => array(
						esc_html__( 'Standard', 'omniverse' ) => 'standard',
						esc_html__( 'Boxed', 'omniverse' ) => 'boxed',
						esc_html__( 'Information top', 'omniverse' ) => 'info-top',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Text size', 'omniverse' ),
					'param_name'       => 'text_size',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => '',
						esc_html__( 'Small (14px)', 'omniverse' ) => 'small',
						esc_html__( 'Medium (16px)', 'omniverse' ) => 'medium',
						esc_html__( 'Large (18px)', 'omniverse' ) => 'large',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Text background color', 'omniverse' ),
					'param_name'       => 'text_background_color_normal',
					'css_args'         => array(
						'background-color'    => array(
							' .wd-testimon-text',
						),
						'border-bottom-color' => array(
							' .wd-testimon-text:before',
						),
					),
					'dependency'       => array(
						'element' => 'style',
						'value'   => array( 'info-top' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Text color', 'omniverse' ),
					'param_name'       => 'text_color_normal',
					'css_args'         => array(
						'color' => array(
							' .wd-testimon-text',
						),
					),
					'dependency'       => array(
						'element' => 'style',
						'value'   => array( 'info-top' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
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
					'dependency'       => array(
						'element'            => 'style',
						'value_not_equal_to' => array( 'info-top' ),
					),
					'std'              => 'center',
					'wood_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Display stars rating', 'omniverse' ),
					'param_name'       => 'stars_rating',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'yes',
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
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				function_exists( 'omniverse_get_vc_responsive_spacing_map' ) ? omniverse_get_vc_responsive_spacing_map() : '',
			),
			'js_view'                 => 'VcColumnView',
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_testimonial' ) ) {
	function omniverse_get_vc_map_testimonial() {
		return array(
			'name'            => esc_html__( 'Testimonial', 'omniverse' ),
			'base'            => 'testimonial',
			'class'           => '',
			'as_child'        => array( 'only' => 'testimonials' ),
			'content_element' => true,
			'category'        => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description'     => esc_html__( 'User testimonial', 'omniverse' ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/testimonials.svg',
			'params'          => array(
				/**
				 * Image
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Image', 'omniverse' ),
					'param_name' => 'image_divider',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'User Avatar', 'omniverse' ),
					'param_name'       => 'image',
					'value'            => '',
					'hint'             => esc_html__( 'Enter the person’s title or job position. For example: CEO or Senior Developer.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'param_name'       => 'img_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
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
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Name', 'omniverse' ),
					'param_name'       => 'name',
					'value'            => '',
					'hint'             => esc_html__( 'Enter the person’s name.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Title', 'omniverse' ),
					'param_name'       => 'title',
					'value'            => '',
					'hint'             => esc_html__( 'User title', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'textarea_html',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Text', 'omniverse' ),
					'param_name' => 'content',
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
			),
		);
	}
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_testimonials extends WPBakeryShortCodesContainer {

	}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_testimonial extends WPBakeryShortCode {

	}
}
