<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}
/**
* ------------------------------------------------------------------------------------------------
* Information box element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_info_box_carousel' ) ) {
	function omniverse_get_vc_map_info_box_carousel() {
		return array(
			'name'                    => esc_html__( 'Information box carousel', 'omniverse' ),
			'base'                    => 'omniverse_info_box_carousel',
			'as_parent'               => array( 'only' => 'omniverse_info_box' ),
			'content_element'         => true,
			'show_settings_on_create' => true,
			'category'                => function_exists( 'omniverse_get_tab_title_category_for_wpb' ) ? omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ) : esc_html__( 'Theme elements', 'omniverse' ),
			'description'             => esc_html__( 'Show your brief information as a carousel', 'omniverse' ),
			'icon'                    => OMNIVERSE_ASSETS . '/images/vc-icon/infobox-slider.svg',
			'params'                  => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				/**
				 * Slider
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Carousel', 'omniverse' ),
					'param_name' => 'slider_divider',
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				function_exists( 'omniverse_get_vc_responsive_spacing_map' ) ? omniverse_get_vc_responsive_spacing_map() : '',
				/**
				 * Extra
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Extra options', 'omniverse' ),
					'group'      => esc_html__( 'Advanced', 'omniverse' ),
					'param_name' => 'extra_divider',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'group'      => esc_html__( 'Advanced', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
			),
			'js_view'                 => 'VcColumnView',
		);
	}
}

if ( ! function_exists( 'omniverse_get_omniverse_info_box_shortcode_args' ) ) {
	function omniverse_get_omniverse_info_box_shortcode_args() {
		return array(
			'name'            => esc_html__( 'Information box', 'omniverse' ),
			'base'            => 'omniverse_info_box',
			'content_element' => true,
			'category'        => function_exists( 'omniverse_get_tab_title_category_for_wpb' ) ? omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ) : esc_html__( 'Theme elements', 'omniverse' ),
			'description'     => esc_html__( 'Show some brief information', 'omniverse' ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/information-box.svg',
			'params'          => omniverse_get_info_box_shortcode_params(),
		);
	}
}

if ( ! function_exists( 'omniverse_get_info_box_shortcode_params' ) ) {
	function omniverse_get_info_box_shortcode_params() {
		$secondary_font = omniverse_get_opt( 'secondary-font' );
		$text_font      = omniverse_get_opt( 'text-font' );
		$primary_font   = omniverse_get_opt( 'primary-font' );

		$secondary_font_title = isset( $secondary_font[0] ) ? esc_html__( 'Secondary font', 'omniverse' ) . ' (' . $secondary_font[0]['font-family'] . ')' : esc_html__( 'Secondary font', 'omniverse' );
		$text_font_title      = isset( $text_font[0] ) ? esc_html__( 'Text font', 'omniverse' ) . ' (' . $text_font[0]['font-family'] . ')' : esc_html__( 'Text', 'omniverse' );
		$primary_font_title   = isset( $primary_font[0] ) ? esc_html__( 'Title font', 'omniverse' ) . ' (' . $primary_font[0]['font-family'] . ')' : esc_html__( 'Title font', 'omniverse' );

		return apply_filters(
			'omniverse_get_info_box_shortcode_params',
			array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				/**
				 * Icon
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_divider',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Icon style', 'omniverse' ),
					'param_name'       => 'icon_style',
					'value'            => array(
						esc_html__( 'Simple', 'omniverse' ) => 'simple',
						esc_html__( 'With background', 'omniverse' ) => 'with-bg',
						esc_html__( 'With border', 'omniverse' ) => 'with-border',
					),
					'omni_tooltip'     => true,
					'images_value'     => array(
						'simple'      => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/style/simple.png',
						'with-bg'     => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/style/with-bg.png',
						'with-border' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/style/with-border.png',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column info-icon',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Icon type', 'omniverse' ),
					'hint'             => esc_html__( 'You can display icon based on image or just write some text like 01., 02., M, X etc.', 'omniverse' ),
					'param_name'       => 'icon_type',
					'value'            => array(
						esc_html__( 'Icon', 'omniverse' ) => 'icon',
						esc_html__( 'Text', 'omniverse' ) => 'text',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Icon background color', 'omniverse' ),
					'param_name'       => 'icon_bg_color',
					'css_args'         => array(
						'background-color' => array(
							' .info-box-icon',
						),
					),
					'dependency'       => array(
						'element' => 'icon_style',
						'value'   => array( 'with-bg' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Icon background color on hover', 'omniverse' ),
					'param_name'       => 'icon_bg_hover_color',
					'css_args'         => array(
						'background-color' => array(
							':hover .info-box-icon',
						),
					),
					'dependency'       => array(
						'element' => 'icon_style',
						'value'   => array( 'with-bg' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Icon border color', 'omniverse' ),
					'param_name'       => 'icon_border_color',
					'css_args'         => array(
						'border-color' => array(
							' .info-box-icon',
						),
					),
					'dependency'       => array(
						'element' => 'icon_style',
						'value'   => array( 'with-border' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Icon border color on hover', 'omniverse' ),
					'param_name'       => 'icon_border_hover_color',
					'css_args'         => array(
						'border-color' => array(
							':hover .info-box-icon',
						),
					),
					'dependency'       => array(
						'element' => 'icon_style',
						'value'   => array( 'with-border' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Icon text', 'omniverse' ),
					'param_name'       => 'icon_text',
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'text' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Icon text size', 'omniverse' ),
					'param_name'       => 'icon_text_size',
					'value'            => array(
						esc_html__( 'Default (52px)', 'omniverse' ) => 'default',
						esc_html__( 'Small (38px)', 'omniverse' ) => 'small',
						esc_html__( 'Large (74px)', 'omniverse' ) => 'large',
					),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'text' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Icon text color', 'omniverse' ),
					'param_name'       => 'icon_text_color',
					'css_args'         => array(
						'color' => array(
							' .box-with-text',
						),
					),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'text' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Image', 'omniverse' ),
					'param_name'       => 'image',
					'value'            => '',
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'icon' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'param_name'       => 'img_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'icon' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
				),
				array(
					'heading'          => esc_html__( 'Spacing', 'omniverse' ),
					'type'             => 'wd_slider',
					'param_name'       => 'icon_spacing',
					'devices'          => array(
						'desktop' => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'            => array(
						'px' => array(
							'min'  => 5,
							'max'  => 50,
							'step' => 1,
						),
					),
					'selectors'        => array(
						'{{WRAPPER}}.wd-info-box' => array(
							'--ib-icon-sp: {{VALUE}}px;',
						),
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				/**
				 * Box style
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Box style', 'omniverse' ),
					'param_name' => 'style_divider',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Box style', 'omniverse' ),
					'param_name'       => 'style',
					'value'            => array(
						esc_html__( 'Base', 'omniverse' )   => 'base',
						esc_html__( 'Bordered', 'omniverse' ) => 'border',
						esc_html__( 'Shadow', 'omniverse' ) => 'shadow',
						esc_html__( 'Background on hover', 'omniverse' ) => 'bg-hover',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'       => esc_html__( 'Rounding', 'omniverse' ),
					'type'          => 'wd_select',
					'param_name'    => 'rounding_size',
					'style'         => 'select',
					'selectors'     => array(
						'{{WRAPPER}}' => array(
							'--wd-brd-radius: {{VALUE}}px;',
						),
					),
					'devices'       => array(
						'desktop' => array(
							'value' => '',
						),
					),
					'value'         => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( '0', 'omniverse' )      => '0',
						esc_html__( '5', 'omniverse' )      => '5',
						esc_html__( '8', 'omniverse' )      => '8',
						esc_html__( '12', 'omniverse' )     => '12',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'dependency'    => array(
						'element' => 'icon_type',
						'value'   => array( 'icon' ),
					),
					'generate_zero' => true,
				),
				array(
					'heading'       => esc_html__( 'Custom rounding', 'omniverse' ),
					'type'          => 'wd_slider',
					'param_name'    => 'custom_rounding_size',
					'selectors'     => array(
						'{{WRAPPER}}' => array(
							'--wd-brd-radius: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'       => array(
						'desktop' => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'         => array(
						'px' => array(
							'min'  => 0,
							'max'  => 300,
							'step' => 1,
						),
						'%'  => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					),
					'dependency'    => array(
						'element' => 'rounding_size',
						'value'   => function_exists( 'omniverse_compress' ) ? omniverse_compress(
							wp_json_encode(
								array(
									'devices' => array(
										'desktop' => array(
											'value' => 'custom',
										),
									),
								)
							)
						) : '',
					),
					'generate_zero' => true,
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Color scheme', 'omniverse' ),
					'param_name'       => 'omniverse_color_scheme',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Light', 'omniverse' ) => 'light',
						esc_html__( 'Dark', 'omniverse' )  => 'dark',
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Background', 'omniverse' ),
					'param_name' => 'hover_divider',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Background type', 'omniverse' ),
					'param_name'       => 'bg_hover_colorpicker',
					'value'            => array(
						esc_html__( 'Color or image', 'omniverse' ) => 'colorpicker',
						esc_html__( 'Gradient', 'omniverse' ) => 'gradient',
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'heading'    => esc_html__( 'Background color', 'omniverse' ),
					'type'       => 'wd_colorpicker',
					'param_name' => 'bg_color',
					'selectors'  => array(
						'{{WRAPPER}}.wd-info-box' => array(
							'background-color: {{VALUE}};',
						),
					),
					'dependency' => array(
						'element' => 'bg_hover_colorpicker',
						'value'   => array( 'colorpicker' ),
					),
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Background image', 'omniverse' ),
					'param_name'       => 'bg_image_box',
					'value'            => '',
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'bg_hover_colorpicker',
						'value'   => array( 'colorpicker' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Background image size', 'omniverse' ),
					'param_name'       => 'bg_image_box_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'bg_hover_colorpicker',
						'value'   => array( 'colorpicker' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Background position', 'omniverse' ),
					'param_name'       => 'bg_image_box_position',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => '',
						esc_html__( 'Center Center', 'omniverse' ) => 'center center',
						esc_html__( 'Center Left', 'omniverse' ) => 'center left',
						esc_html__( 'Center Right', 'omniverse' ) => 'center right',
						esc_html__( 'Top Center', 'omniverse' ) => 'top center',
						esc_html__( 'Top Left', 'omniverse' ) => 'top left',
						esc_html__( 'Top Right', 'omniverse' ) => 'top right',
						esc_html__( 'Bottom Center', 'omniverse' ) => 'bottom center',
						esc_html__( 'Bottom Left', 'omniverse' ) => 'bottom left',
						esc_html__( 'Bottom Right', 'omniverse' ) => 'bottom right',
					),
					'dependency'       => array(
						'element' => 'bg_hover_colorpicker',
						'value'   => array( 'colorpicker' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Background repeat', 'omniverse' ),
					'param_name'       => 'bg_image_box_repeat',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => '',
						esc_html__( 'No-repeat', 'omniverse' ) => 'no-repeat',
						esc_html__( 'Repeat', 'omniverse' ) => 'repeat',
						esc_html__( 'Repeat-x', 'omniverse' ) => 'repeat-x',
						esc_html__( 'Repeat-y', 'omniverse' ) => 'repeat-y',
					),
					'dependency'       => array(
						'element' => 'bg_hover_colorpicker',
						'value'   => array( 'colorpicker' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Background size', 'omniverse' ),
					'param_name'       => 'bg_image_box_sizes',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => '',
						esc_html__( 'Cover', 'omniverse' ) => 'cover',
						esc_html__( 'Contain', 'omniverse' ) => 'contain',
					),
					'dependency'       => array(
						'element' => 'bg_hover_colorpicker',
						'value'   => array( 'colorpicker' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Hover background color', 'omniverse' ),
					'param_name'       => 'bg_hover_color',
					'css_args'         => array(
						'background-color' => array(
							':after',
						),
					),
					'wd_dependency'    => array(
						'element' => 'style',
						'value'   => array( 'bg-hover' ),
					),
					'dependency'       => array(
						'element' => 'bg_hover_colorpicker',
						'value'   => array( 'colorpicker' ),
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Hover background image', 'omniverse' ),
					'param_name'       => 'bg_hover_image',
					'value'            => '',
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'bg_hover_colorpicker',
						'value'   => array( 'colorpicker' ),
					),
					'wd_dependency'    => array(
						'element' => 'style',
						'value'   => array( 'bg-hover' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Hover background image size', 'omniverse' ),
					'param_name'       => 'bg_hover_image_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'bg_hover_colorpicker',
						'value'   => array( 'colorpicker' ),
					),
					'wd_dependency'    => array(
						'element' => 'style',
						'value'   => array( 'bg-hover' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Hover background position', 'omniverse' ),
					'param_name'       => 'bg_hover_image_position',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => '',
						esc_html__( 'Center Center', 'omniverse' ) => 'center center',
						esc_html__( 'Center Left', 'omniverse' ) => 'center left',
						esc_html__( 'Center Right', 'omniverse' ) => 'center right',
						esc_html__( 'Top Center', 'omniverse' ) => 'top center',
						esc_html__( 'Top Left', 'omniverse' ) => 'top left',
						esc_html__( 'Top Right', 'omniverse' ) => 'top right',
						esc_html__( 'Bottom Center', 'omniverse' ) => 'bottom center',
						esc_html__( 'Bottom Left', 'omniverse' ) => 'bottom left',
						esc_html__( 'Bottom Right', 'omniverse' ) => 'bottom right',
					),
					'dependency'       => array(
						'element' => 'bg_hover_colorpicker',
						'value'   => array( 'colorpicker' ),
					),
					'wd_dependency'    => array(
						'element' => 'style',
						'value'   => array( 'bg-hover' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Hover background repeat', 'omniverse' ),
					'param_name'       => 'bg_hover_image_repeat',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => '',
						esc_html__( 'No-repeat', 'omniverse' ) => 'no-repeat',
						esc_html__( 'Repeat', 'omniverse' ) => 'repeat',
						esc_html__( 'Repeat-x', 'omniverse' ) => 'repeat-x',
						esc_html__( 'Repeat-y', 'omniverse' ) => 'repeat-y',
					),
					'dependency'       => array(
						'element' => 'bg_hover_colorpicker',
						'value'   => array( 'colorpicker' ),
					),
					'wd_dependency'    => array(
						'element' => 'style',
						'value'   => array( 'bg-hover' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Hover background size', 'omniverse' ),
					'param_name'       => 'bg_hover_image_sizes',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => '',
						esc_html__( 'Auto', 'omniverse' )  => 'auto',
						esc_html__( 'Cover', 'omniverse' ) => 'cover',
						esc_html__( 'Contain', 'omniverse' ) => 'contain',
					),
					'dependency'       => array(
						'element' => 'bg_hover_colorpicker',
						'value'   => array( 'colorpicker' ),
					),
					'wd_dependency'    => array(
						'element' => 'style',
						'value'   => array( 'bg-hover' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'omniverse_gradient',
					'heading'    => esc_html__( 'Background gradient', 'omniverse' ),
					'param_name' => 'bg_color_gradient',
					'dependency' => array(
						'element' => 'bg_hover_colorpicker',
						'value'   => array( 'gradient' ),
					),
				),
				array(
					'type'          => 'omniverse_gradient',
					'heading'       => esc_html__( 'Hover background gradient', 'omniverse' ),
					'param_name'    => 'bg_hover_color_gradient',
					'wd_dependency' => array(
						'element' => 'bg_hover_colorpicker',
						'value'   => array( 'gradient' ),
					),
					'dependency'    => array(
						'element' => 'style',
						'value'   => array( 'bg-hover' ),
					),
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Color scheme on hover', 'omniverse' ),
					'param_name'       => 'omniverse_hover_color_scheme',
					'value'            => array(
						esc_html__( 'Light', 'omniverse' ) => 'light',
						esc_html__( 'Dark', 'omniverse' )  => 'dark',
					),
					'dependency'       => array(
						'element' => 'style',
						'value'   => array( 'bg-hover' ),
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
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
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Text alignment', 'omniverse' ),
					'param_name'       => 'alignment',
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
					'std'              => 'left',
					'omni_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'type'       => 'omniverse_empty_space',
					'param_name' => 'omniverse_empty_space',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Image alignment', 'omniverse' ),
					'param_name'       => 'image_alignment',
					'value'            => array(
						esc_html__( 'Left', 'omniverse' )  => 'left',
						esc_html__( 'Top', 'omniverse' )   => 'top',
						esc_html__( 'Right', 'omniverse' ) => 'right',
					),
					'images_value'     => array(
						'top'   => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/top.png',
						'left'  => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/left.png',
						'right' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/right.png',
					),
					'std'              => 'top',
					'omni_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Vertical alignment', 'omniverse' ),
					'param_name'       => 'image_vertical_alignment',
					'value'            => array(
						esc_html__( 'Top', 'omniverse' )    => 'top',
						esc_html__( 'Middle', 'omniverse' ) => 'middle',
						esc_html__( 'Bottom', 'omniverse' ) => 'bottom',
					),
					'images_value'     => array(
						'top'    => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/vertical-position/top.png',
						'middle' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/vertical-position/middle.png',
						'bottom' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/vertical-position/bottom.png',
					),
					'std'              => 'top',
					'omni_tooltip'     => true,
					'dependency'       => array(
						'element' => 'image_alignment',
						'value'   => array( 'left', 'right' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Title
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Title', 'omniverse' ),
					'group'      => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name' => 'title_divider',
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Title text', 'omniverse' ),
					'param_name' => 'title',
					'holder'     => 'div',
					'group'      => esc_html__( 'Title and Subtitle', 'omniverse' ),
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Font', 'omniverse' ),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name'       => 'title_font',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => '',
						$text_font_title      => 'text',
						$primary_font_title   => 'primary',
						$secondary_font_title => 'alt',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Title tag', 'omniverse' ),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name'       => 'title_tag',
					'value'            => array(
						'h1'   => 'h1',
						'h2'   => 'h2',
						'h3'   => 'h3',
						'h4'   => 'h4',
						'h5'   => 'h5',
						'h6'   => 'h6',
						'p'    => 'p',
						'div'  => 'div',
						'span' => 'span',
					),
					'std'              => 'h4',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Predefined title size', 'omniverse' ),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name'       => 'title_size',
					'value'            => array(
						esc_html__( 'Default (18px)', 'omniverse' ) => 'default',
						esc_html__( 'Small (16px)', 'omniverse' ) => 'small',
						esc_html__( 'Large (26px)', 'omniverse' ) => 'large',
						esc_html__( 'Extra Large (36px)', 'omniverse' ) => 'extra-large',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Font weight', 'omniverse' ),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name'       => 'title_font_weight',
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
					'selectors'        => array(
						'{{WRAPPER}} .info-box-title' => array(
							'font-weight: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Custom font size', 'omniverse' ),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name'       => 'title_font_size',
					'css_args'         => array(
						'font-size' => array(
							' .info-box-title',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Custom line height', 'omniverse' ),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name'       => 'title_line_height',
					'css_args'         => array(
						'line-height' => array(
							' .info-box-title',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'omniverse_empty_space',
					'param_name' => 'omniverse_empty_space',
					'group'      => esc_html__( 'Title and Subtitle', 'omniverse' ),
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Title style', 'omniverse' ),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name'       => 'title_style',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Underline', 'omniverse' ) => 'underlined',
					),
					'images_value'     => array(
						'default'    => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/title-style/default.png',
						'underlined' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/title-style/underlined.png',
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Color', 'omniverse' ),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name'       => 'title_color',
					'css_args'         => array(
						'color' => array(
							' .info-box-title',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Subtitle
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Subtitle', 'omniverse' ),
					'group'      => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name' => 'subtitle_divider',
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Sub title text', 'omniverse' ),
					'param_name' => 'subtitle',
					'group'      => esc_html__( 'Title and Subtitle', 'omniverse' ),
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Font', 'omniverse' ),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name'       => 'subtitle_font',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => '',
						$text_font_title      => 'text',
						$primary_font_title   => 'primary',
						$secondary_font_title => 'alt',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Font weight', 'omniverse' ),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name'       => 'subtitle_font_weight',
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
					'selectors'        => array(
						'{{WRAPPER}} .info-box-subtitle' => array(
							'--wd-font-weight: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Size', 'omniverse' ),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name'       => 'subtitle_font_size',
					'css_args'         => array(
						'font-size' => array(
							' .info-box-subtitle',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Line height', 'omniverse' ),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name'       => 'subtitle_line_height',
					'css_args'         => array(
						'line-height' => array(
							' .info-box-subtitle',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'omniverse_empty_space',
					'param_name' => 'omniverse_empty_space',
					'group'      => esc_html__( 'Title and Subtitle', 'omniverse' ),
				),
				array(
					'type'             => 'omniverse_dropdown',
					'heading'          => esc_html__( 'Predefined subtitle color', 'omniverse' ),
					'param_name'       => 'subtitle_color',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Primary', 'omniverse' ) => 'primary',
						esc_html__( 'Alternative', 'omniverse' ) => 'alt',
					),
					'style'            => array(
						'default' => '#f3f3f3',
						'primary' => omniverse_get_color_value( 'primary-color', '#7eb934' ),
						'alt'     => omniverse_get_color_value( 'secondary-color', '#fbbc34' ),
					),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Custom color', 'omniverse' ),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name'       => 'subtitle_custom_color',
					'css_args'         => array(
						'color' => array(
							' .info-box-subtitle',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Subtitle style', 'omniverse' ),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name'       => 'subtitle_style',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Background', 'omniverse' ) => 'background',
					),
					'images_value'     => array(
						'default'    => OMNIVERSE_ASSETS_IMAGES . '/settings/subtitle-style/default.png',
						'background' => OMNIVERSE_ASSETS_IMAGES . '/settings/subtitle-style/background.png',
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Background color', 'omniverse' ),
					'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
					'param_name'       => 'subtitle_custom_bg_color',
					'css_args'         => array(
						'background-color' => array(
							' .info-box-subtitle',
						),
					),
					'dependency'       => array(
						'element' => 'subtitle_style',
						'value'   => array( 'background' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Content
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Content', 'omniverse' ),
					'group'      => esc_html__( 'Content', 'omniverse' ),
					'param_name' => 'style_divider',
				),
				array(
					'type'       => 'textarea_html',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Brief content', 'omniverse' ),
					'group'      => esc_html__( 'Content', 'omniverse' ),
					'param_name' => 'content',
				),
				array(
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Size', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'param_name'       => 'custom_text_size',
					'css_args'         => array(
						'font-size' => array(
							' .info-box-inner',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Line height', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'param_name'       => 'custom_text_line_height',
					'css_args'         => array(
						'line-height' => array(
							' .info-box-inner',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'omniverse_empty_space',
					'param_name' => 'omniverse_empty_space',
					'group'      => esc_html__( 'Content', 'omniverse' ),
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Color', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'param_name'       => 'custom_text_color',
					'css_args'         => array(
						'color' => array(
							' .info-box-inner',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Button
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Button', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'button_divider',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Button text', 'omniverse' ),
					'param_name'       => 'btn_text',
					'group'            => esc_html__( 'Button', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Button position', 'omniverse' ),
					'param_name'       => 'btn_position',
					'value'            => array(
						esc_html__( 'Show on hover', 'omniverse' ) => 'hover',
						esc_html__( 'Static', 'omniverse' ) => 'static',
					),
					'group'            => esc_html__( 'Button', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_dropdown',
					'group'            => esc_html__( 'Button', 'omniverse' ),
					'heading'          => esc_html__( 'Predefined button color', 'omniverse' ),
					'param_name'       => 'btn_color',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Primary color', 'omniverse' ) => 'primary',
						esc_html__( 'Alternative color', 'omniverse' ) => 'alt',
						esc_html__( 'White', 'omniverse' ) => 'white',
						esc_html__( 'Black', 'omniverse' ) => 'black',
					),
					'style'            => array(
						'default' => '#f3f3f3',
						'primary' => omniverse_get_color_value( 'primary-color', '#7eb934' ),
						'alt'     => omniverse_get_color_value( 'secondary-color', '#fbbc34' ),
						'black'   => '#212121',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Button size', 'omniverse' ),
					'param_name'       => 'btn_size',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Extra Small', 'omniverse' ) => 'extra-small',
						esc_html__( 'Small', 'omniverse' ) => 'small',
						esc_html__( 'Large', 'omniverse' ) => 'large',
						esc_html__( 'Extra Large', 'omniverse' ) => 'extra-large',
					),
					'group'            => esc_html__( 'Button', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Button style', 'omniverse' ),
					'group'            => esc_html__( 'Button', 'omniverse' ),
					'param_name'       => 'btn_style',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Bordered', 'omniverse' ) => 'bordered',
						esc_html__( 'Link button', 'omniverse' ) => 'link',
						esc_html__( '3D', 'omniverse' ) => '3d',
					),
					'images_value'     => array(
						'default'  => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/default.png',
						'bordered' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/bordered.png',
						'link'     => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/link.png',
						'3d'       => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/3d.png',
					),
					'title'            => false,
					'std'              => 'default',
					'edit_field_class' => 'vc_col-xs-12 vc_column button-style',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Button shape', 'omniverse' ),
					'group'            => esc_html__( 'Button', 'omniverse' ),
					'param_name'       => 'btn_shape',
					'value'            => array(
						esc_html__( 'Rectangle', 'omniverse' ) => 'rectangle',
						esc_html__( 'Circle', 'omniverse' ) => 'round',
						esc_html__( 'Round', 'omniverse' )  => 'semi-round',
					),
					'images_value'     => array(
						'rectangle'  => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/shape/rectangle.jpeg',
						'round'      => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/shape/circle.jpeg',
						'semi-round' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/shape/round.jpeg',
					),
					'dependency'       => array(
						'element'            => 'btn_style',
						'value_not_equal_to' => array( 'round', 'link' ),
					),
					'title'            => false,
					'std'              => 'rectangle',
					'edit_field_class' => 'vc_col-xs-12 vc_column button-shape',
				),
				/**
				 * Button icon
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'btn_icon_divider',
				),
				array(
					'type'       => 'omniverse_button_set',
					'heading'    => esc_html__( 'Type', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'btn_icon_type',
					'value'      => array(
						esc_html__( 'Icon', 'omniverse' )  => 'icon',
						esc_html__( 'Image', 'omniverse' ) => 'image',
					),
					'default'    => 'icon',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Image', 'omniverse' ),
					'group'            => esc_html__( 'Button', 'omniverse' ),
					'param_name'       => 'btn_image',
					'value'            => '',
					'dependency'       => array(
						'element' => 'btn_icon_type',
						'value'   => 'image',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'group'            => esc_html__( 'Button', 'omniverse' ),
					'param_name'       => 'btn_img_size',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'btn_icon_type',
						'value'   => 'image',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon library', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'value'      => array(
						esc_html__( 'Font Awesome', 'omniverse' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'omniverse' ) => 'openiconic',
						esc_html__( 'Typicons', 'omniverse' ) => 'typicons',
						esc_html__( 'Entypo', 'omniverse' ) => 'entypo',
						esc_html__( 'Linecons', 'omniverse' ) => 'linecons',
						esc_html__( 'Mono Social', 'omniverse' ) => 'monosocial',
						esc_html__( 'Material', 'omniverse' ) => 'material',
					),
					'param_name' => 'icon_library',
					'hint'       => esc_html__( 'Select icon library.', 'omniverse' ),
					'dependency' => array(
						'element' => 'btn_icon_type',
						'value'   => 'icon',
					),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'icon_fontawesome',
					'value'      => '',
					'settings'   => array(
						'emptyIcon'    => true,
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'fontawesome' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'icon_openiconic',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'openiconic',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'openiconic' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'icon_typicons',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'typicons',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'typicons' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'icon_entypo',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'entypo',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'entypo' ),
					),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'icon_linecons',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'linecons',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'linecons' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'icon_monosocial',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'monosocial',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'monosocial' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'icon_material',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'material',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'material' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Button icon position', 'omniverse' ),
					'group'            => esc_html__( 'Button', 'omniverse' ),
					'param_name'       => 'btn_icon_position',
					'value'            => array(
						esc_html__( 'Left', 'omniverse' )  => 'left',
						esc_html__( 'Right', 'omniverse' ) => 'right',
					),
					'std'              => 'right',
					'edit_field_class' => 'vc_col-xs-12 vc_column button-style',
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
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'SVG animation', 'omniverse' ),
					'param_name'       => 'svg_animation',
					'hint'             => esc_html__( 'By default, your SVG files will not be animated.', 'omniverse' ),
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Information box inline', 'omniverse' ),
					'param_name'       => 'info_box_inline',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'vc_link',
					'heading'          => esc_html__( 'Link', 'omniverse' ),
					'param_name'       => 'link',
					'hint'             => esc_html__( 'Enter URL if you want this box to have a link.', 'omniverse' ),
					'edit_field_class' => 'vc_col-xs-12 vc_column',
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				function_exists( 'omniverse_get_vc_responsive_spacing_map' ) ? omniverse_get_vc_responsive_spacing_map() : '',
				( function_exists( 'vc_map_add_css_animation' ) ) ? vc_map_add_css_animation( true ) : '',

				function_exists( 'omniverse_get_vc_animation_map' ) ? omniverse_get_vc_animation_map( 'wd_animation' ) : '',
				function_exists( 'omniverse_get_vc_animation_map' ) ? omniverse_get_vc_animation_map( 'wd_animation_delay' ) : '',
				function_exists( 'omniverse_get_vc_animation_map' ) ? omniverse_get_vc_animation_map( 'wd_animation_duration' ) : '',

				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Background position', 'omniverse' ),
					'param_name'       => 'omniverse_bg_position',
					'group'            => esc_html__( 'Design Options', 'js_composer' ),
					'value'            => array(
						esc_html__( 'None', 'omniverse' ) => '',
						esc_html__( 'Left top', 'omniverse' ) => 'left-top',
						esc_html__( 'Left center', 'omniverse' ) => 'left-center',
						esc_html__( 'Left bottom', 'omniverse' ) => 'left-bottom',
						esc_html__( 'Right top', 'omniverse' ) => 'right-top',
						esc_html__( 'Right center', 'omniverse' ) => 'right-center',
						esc_html__( 'Right bottom', 'omniverse' ) => 'right-bottom',
						esc_html__( 'Center top', 'omniverse' ) => 'center-top',
						esc_html__( 'Center center', 'omniverse' ) => 'center-center',
						esc_html__( 'Center bottom', 'omniverse' ) => 'center-bottom',
					),
					'edit_field_class' => 'vc_col-xs-5',
				),
				/**
				 * Advanced.
				 */
				array(
					'type'             => 'omniverse_switch',
					'param_name'       => 'wd_z_index',
					'heading'          => esc_html__( 'Z Index', 'omniverse' ),
					'hint'             => esc_html__( 'Enable this option if you would like to display this element above other elements on the page. You can specify a custom value as well.', 'omniverse' ),
					'group'            => esc_html__( 'Advanced', 'omniverse' ),
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'wd_number',
					'param_name'       => 'wd_z_index_custom',
					'group'            => esc_html__( 'Advanced', 'omniverse' ),
					'devices'          => array(
						'desktop' => array(
							'value' => 35,
						),
					),
					'min'              => -1,
					'max'              => 1000,
					'step'             => 1,
					'selectors'        => array(
						'{{WRAPPER}}' => array(
							'z-index: {{VALUE}}',
						),
					),
					'dependency'       => array(
						'element' => 'wd_z_index',
						'value'   => array( 'yes' ),
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				function_exists( 'omniverse_get_vc_responsive_visible_map' ) ? omniverse_get_vc_responsive_visible_map( 'responsive_tabs_hide' ) : '',
				function_exists( 'omniverse_get_vc_responsive_visible_map' ) ? omniverse_get_vc_responsive_visible_map( 'wd_hide_on_desktop' ) : '',
				function_exists( 'omniverse_get_vc_responsive_visible_map' ) ? omniverse_get_vc_responsive_visible_map( 'wd_hide_on_tablet' ) : '',
				function_exists( 'omniverse_get_vc_responsive_visible_map' ) ? omniverse_get_vc_responsive_visible_map( 'wd_hide_on_mobile' ) : '',
			)
		);
	}
}

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_omniverse_info_box_carousel extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_omniverse_info_box extends WPBakeryShortCode {}
}
