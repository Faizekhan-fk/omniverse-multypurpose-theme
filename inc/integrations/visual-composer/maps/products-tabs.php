<?php

use DN\Modules\Layouts\Main;

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}
/**
* ------------------------------------------------------------------------------------------------
* AJAX Products tabs element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_products_tabs' ) ) {
	function omniverse_get_vc_map_products_tabs() {
		$heading_typography = omniverse_get_typography_map(
			array(
				'title'    => esc_html__( 'Title typography', 'omniverse' ),
				'key'      => 'heading_title',
				'selector' => '{{WRAPPER}}.wd-tabs .tabs-name',
			)
		);

		$tabs_typography = omniverse_get_typography_map(
			array(
				'title'    => esc_html__( 'Typography', 'omniverse' ),
				'key'      => 'tabs_title',
				'group'    => esc_html__( 'Tab title', 'omniverse' ),
				'selector' => '{{WRAPPER}} .wd-nav.wd-nav-tabs .wd-nav-link',
			)
		);

		return array(
			'name'                    => esc_html__( 'AJAX Products tabs', 'omniverse' ),
			'base'                    => 'products_tabs',
			'as_parent'               => array( 'only' => 'products_tab' ),
			'content_element'         => true,
			'show_settings_on_create' => true,
			'category'                => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description'             => esc_html__( 'Product tabs for your marketplace', 'omniverse' ),
			'icon'                    => OMNIVERSE_ASSETS . '/images/vc-icon/ajax-products-tabs.svg',
			'params'                  => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				/**
				 * Style
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'HEADING', 'omniverse' ),
					'param_name' => 'style_divider',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Design', 'omniverse' ),
					'param_name'       => 'design',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Simple', 'omniverse' ) => 'simple',
						esc_html__( 'Alternative', 'omniverse' ) => 'alt',
						esc_html__( 'Aside', 'omniverse' )  => 'aside',
					),
					'images_value'     => array(
						'default' => OMNIVERSE_ASSETS_IMAGES . '/settings/ajax-tabs/default.png',
						'simple'  => OMNIVERSE_ASSETS_IMAGES . '/settings/ajax-tabs/simple.png',
						'alt'     => OMNIVERSE_ASSETS_IMAGES . '/settings/ajax-tabs/alternative.png',
						'aside'   => OMNIVERSE_ASSETS_IMAGES . '/settings/ajax-tabs/aside.png',
					),
					'std'              => 'default',
					'omni_tooltip'     => true,
					'edit_field_class' => 'vc_col-xs-12 vc_column tab-design',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Tabs primary color', 'omniverse' ),
					'param_name'       => 'color',
					'css_args'         => array(
						'color'            => array(
							'.wd-tabs .wd-nav-tabs.wd-style-default li.wd-active a',
							'.wd-tabs .wd-nav-tabs.wd-style-default li:hover a',
						),
						'border-color'     => array(
							'.tabs-design-simple .tabs-name',
						),
						'background-color' => array(
							'.wd-tabs .wd-nav-tabs.wd-style-underline .nav-link-text:after',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Title color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'tabs_title_color',
					'selectors'        => array(
						'{{WRAPPER}} .tabs-name' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				$heading_typography['font_family'],
				$heading_typography['font_size'],
				$heading_typography['font_weight'],
				$heading_typography['text_transform'],
				$heading_typography['font_style'],
				$heading_typography['line_height'],
				array(
					'heading'          => esc_html__( 'Description color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'tabs_description_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-tabs-desc' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'design',
						'value'   => array( 'default', 'aside' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'wd_slider',
					'param_name'       => 'tabs_side_width',
					'heading'          => esc_html__( 'Side heading width', 'omniverse' ),
					'devices'          => array(
						'desktop' => array(
							'unit' => 'px',
						),
					),
					'range'            => array(
						'px' => array(
							'min'  => 100,
							'max'  => 500,
							'step' => 1,
						),
						'%'  => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					),
					'selectors'        => array(
						'{{WRAPPER}}.wd-tabs.tabs-design-aside' => array(
							'--wd-side-width: {{VALUE}}{{UNIT}};',
						),
					),
					'dependency'       => array(
						'element' => 'design',
						'value'   => array( 'aside' ),
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Heading background', 'omniverse' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'enable_heading_bg',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'heading'          => esc_html__( 'Custom background color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'heading_bg',
					'selectors'        => array(
						'{{WRAPPER}}.wd-tabs.wd-header-with-bg .wd-tabs-header' => array(
							'background-color:{{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'enable_heading_bg',
						'value'   => array( 'yes' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'type'       => 'omniverse_empty_space',
					'param_name' => 'omniverse_empty_space',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Alignment', 'omniverse' ),
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
					'dependency'       => array(
						'element' => 'design',
						'value'   => array( 'default' ),
					),
					'std'              => 'center',
					'omni_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				/**
				 * Heading
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Heading content', 'omniverse' ),
					'param_name' => 'title_divider',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'omniverse' ),
					'param_name' => 'title',
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Description', 'omniverse' ),
					'param_name' => 'description',
					'dependency' => array(
						'element' => 'design',
						'value'   => array( 'default', 'aside' ),
					),
				),
				/**
				 * Image
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Icon settings', 'omniverse' ),
					'param_name' => 'image_divider',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Icon image', 'omniverse' ),
					'param_name'       => 'image',
					'value'            => '',
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Images size', 'omniverse' ),
					'param_name'       => 'img_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
				),
				/**
				 * Other
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Other', 'omniverse' ),
					'param_name' => 'image_divider',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
				/**
				 * Tabs Layout
				 */
				array(
					'param_name' => 'tabs_layout_divider',
					'type'       => 'omniverse_title_divider',
					'title'      => esc_html__( 'Layout', 'omniverse' ),
					'group'      => esc_html__( 'Tab title', 'omniverse' ),
					'holder'     => 'div',
				),
				array(
					'param_name'       => 'tabs_style',
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Style', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Underline', 'omniverse' ) => 'underline',
					),
					'std'              => 'underline',
					'dependency'       => array(
						'element'            => 'design',
						'value_not_equal_to' => 'simple',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'icon_position',
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Icon position', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
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
					'std'              => 'left',
					'omni_tooltip'     => true,
					'dependency'       => array(
						'element'            => 'design',
						'value_not_equal_to' => 'default',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'param_name'       => 'icon_position_design_default',
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Icon position', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
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
					'dependency'       => array(
						'element' => 'design',
						'value'   => 'default',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'type'             => 'wd_slider',
					'param_name'       => 'tabs_title_space_between_vertical',
					'heading'          => esc_html__( 'Vertical spacing', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'devices'          => array(
						'desktop' => array(
							'unit' => 'px',
						),
						'tablet'  => array(
							'unit' => 'px',
						),
						'mobile'  => array(
							'unit' => 'px',
						),
					),
					'range'            => array(
						'px' => array(
							'min'  => 0,
							'max'  => 150,
							'step' => 1,
						),
					),
					'selectors'        => array(
						'body {{WRAPPER}}.wd-tabs' => array(
							'--wd-header-sp: {{VALUE}}{{UNIT}};',
						),
					),
					'dependency'       => array(
						'element'            => 'design',
						'value_not_equal_to' => array( 'aside' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'wd_slider',
					'param_name'       => 'tabs_title_space_between_horizontal',
					'heading'          => esc_html__( 'Horizontal spacing', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'devices'          => array(
						'desktop' => array(
							'unit' => 'px',
						),
						'tablet'  => array(
							'unit' => 'px',
						),
						'mobile'  => array(
							'unit' => 'px',
						),
					),
					'range'            => array(
						'px' => array(
							'min'  => 0,
							'max'  => 150,
							'step' => 1,
						),
					),
					'selectors'        => array(
						'{{WRAPPER}} .wd-nav-tabs > li:not(:last-child)' => array(
							'margin-inline-end: {{VALUE}}{{UNIT}};',
						),
					),
					'dependency'       => array(
						'element'            => 'design',
						'value_not_equal_to' => array( 'aside' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name' => 'tabs_layout_divider',
					'type'       => 'omniverse_title_divider',
					'title'      => esc_html__( 'Typography', 'omniverse' ),
					'group'      => esc_html__( 'Tab title', 'omniverse' ),
					'holder'     => 'div',
				),
				$tabs_typography['font_family'],
				$tabs_typography['font_size'],
				$tabs_typography['font_weight'],
				$tabs_typography['text_transform'],
				$tabs_typography['font_style'],
				$tabs_typography['line_height'],
				array(
					'param_name'       => 'tabs_title_color_scheme',
					'type'             => 'omniverse_dropdown',
					'heading'          => esc_html__( 'Color scheme', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => 'inherit',
						esc_html__( 'Dark', 'omniverse' )   => 'dark',
						esc_html__( 'Light', 'omniverse' )  => 'light',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'style'            => array(
						'dark' => '#2d2a2a',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Text color', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'tabs_title_text_color',
					'selectors'        => array(
						'{{WRAPPER}}.wd-tabs .wd-nav-wrapper .wd-nav > li > a' => array(
							'color: {{VALUE}} !important;',
						),
					),
					'dependency'       => array(
						'element' => 'tabs_title_color_scheme',
						'value'   => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Text hover color', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'tabs_text_hover_color',
					'selectors'        => array(
						'{{WRAPPER}}.wd-tabs .wd-nav-wrapper .wd-nav > li:hover > a' => array(
							'color: {{VALUE}} !important;',
						),
					),
					'dependency'       => array(
						'element' => 'tabs_title_color_scheme',
						'value'   => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Text active color', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'tabs_text_hover_active',
					'selectors'        => array(
						'{{WRAPPER}}.wd-tabs:not(.wd-inited) .wd-nav.wd-nav-tabs li:first-child a' => array(
							'color: {{VALUE}} !important;',
						),
						'{{WRAPPER}}.wd-tabs .wd-nav-wrapper .wd-nav > li.wd-active > a' => array(
							'color: {{VALUE}} !important;',
						),
					),
					'dependency'       => array(
						'element' => 'tabs_title_color_scheme',
						'value'   => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				// Design options.
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

				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Theme Animation', 'omniverse' ),
					'hint'             => esc_html__( 'Use custom theme animations if you want to run them in the slider element.' ),
					'param_name'       => 'wd_animation',
					'group'            => esc_html__( 'Advanced', 'omniverse' ),
					'admin_label'      => true,
					'value'            => array(
						esc_html__( 'None', 'omniverse' ) => '',
						esc_html__( 'Slide from top', 'omniverse' ) => 'slide-from-top',
						esc_html__( 'Slide from bottom', 'omniverse' ) => 'slide-from-bottom',
						esc_html__( 'Slide from left', 'omniverse' ) => 'slide-from-left',
						esc_html__( 'Slide from right', 'omniverse' ) => 'slide-from-right',
						esc_html__( 'Slide short from left', 'omniverse' ) => 'slide-short-from-left',
						esc_html__( 'Slide short from right', 'omniverse' ) => 'slide-short-from-right',
						esc_html__( 'Flip X bottom', 'omniverse' ) => 'bottom-flip-x',
						esc_html__( 'Flip X top', 'omniverse' ) => 'top-flip-x',
						esc_html__( 'Flip Y left', 'omniverse' ) => 'left-flip-y',
						esc_html__( 'Flip Y right', 'omniverse' ) => 'right-flip-y',
						esc_html__( 'Zoom in', 'omniverse' ) => 'zoom-in',
					),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Theme Animation Delay (ms)', 'omniverse' ),
					'param_name'       => 'wd_animation_delay',
					'group'            => esc_html__( 'Advanced', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
					'dependency'       => array(
						'element'            => 'wd_animation',
						'value_not_equal_to' => array( '' ),
					),
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Theme Animation duration', 'omniverse' ),
					'param_name'       => 'wd_animation_duration',
					'group'            => esc_html__( 'Advanced', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
					'value'            => array(
						esc_html__( 'Slow', 'omniverse' )   => 'slow',
						esc_html__( 'Normal', 'omniverse' ) => 'normal',
						esc_html__( 'Fast', 'omniverse' )   => 'fast',
					),
					'dependency'       => array(
						'element'            => 'wd_animation',
						'value_not_equal_to' => array( '' ),
					),
					'std'              => 'normal',
				),

				omniverse_get_vc_responsive_visible_map( 'responsive_tabs_hide' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_desktop' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_tablet' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_mobile' ),
			),
			'js_view'                 => 'VcColumnView',
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_products_tab' ) ) {
	function omniverse_get_vc_map_products_tab() {
		$omniverse_prdoucts_params = vc_map_integrate_shortcode(
			omniverse_get_products_shortcode_map_params(),
			'',
			'',
			array(
				'exclude' => array(
					'highlighted_products',
					'title_divider',
					'element_title',
					'source_divider',
					'shop_tools',
					'css',
					'responsive_spacing',
					'responsive_tabs',
					'width_desktop',
					'width_tablet',
					'width_mobile',
					'custom_width_desktop',
					'custom_width_tablet',
					'custom_width_mobile',
					'post_type',
					'title_color',
					'title_font_family',
					'title_font_size',
					'title_font_weight',
					'title_text_transform',
					'title_font_style',
					'title_line_height',
				),
			)
		);

		$post_type_array            = array(
			esc_html__( 'All Products', 'omniverse' )       => 'product',
			esc_html__( 'Featured Products', 'omniverse' )  => 'featured',
			esc_html__( 'Sale Products', 'omniverse' )      => 'sale',
			esc_html__( 'Products with NEW label', 'omniverse' ) => 'new',
			esc_html__( 'Bestsellers', 'omniverse' )        => 'bestselling',
			esc_html__( 'List of IDs', 'omniverse' )        => 'ids',
			esc_html__( 'Top Rated Products', 'omniverse' ) => 'top_rated_products',
		);
		$post_type_additional_array = array(
			'single_product' => array(
				esc_html__( 'Related (Single product)', 'omniverse' ) => 'related',
				esc_html__( 'Upsells (Single product)', 'omniverse' ) => 'upsells',
			),
			'cart'           => array(
				esc_html__( 'Cross Sells', 'omniverse' ) => 'cross-sells',
			),
		);

		foreach ( $post_type_additional_array as $needed_builder => $additional_options ) {
			if ( Main::is_layout_type( $needed_builder ) ) {
				$post_type_array = array_merge( $post_type_array, $additional_options );
			}
		}

		return array(
			'name'            => esc_html__( 'Products tab', 'omniverse' ),
			'base'            => 'products_tab',
			'as_child'        => array( 'only' => 'products_tabs' ),
			'content_element' => true,
			'category'        => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description'     => esc_html__( 'Products block', 'omniverse' ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/product-categories.svg',
			'params'          => array_merge(
				array(
					array(
						'type'       => 'omniverse_title_divider',
						'holder'     => 'div',
						'title'      => esc_html__( 'Title', 'omniverse' ),
						'param_name' => 'image_divider',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__( 'Title for the tab', 'omniverse' ),
						'param_name' => 'title',
					),
					/**
					 * Icon
					 */
					array(
						'type'       => 'omniverse_title_divider',
						'holder'     => 'div',
						'title'      => esc_html__( 'Icon setting', 'omniverse' ),
						'param_name' => 'icon_divider',
					),

					array(
						'heading'          => esc_html__( 'Icon type', 'omniverse' ),
						'param_name'       => 'title_icon_type',
						'type'             => 'dropdown',
						'value'            => array(
							esc_html__( 'With icon', 'omniverse' ) => 'icon',
							esc_html__( 'With image', 'omniverse' ) => 'image',
						),
						'std'              => 'image',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'type'             => 'attach_image',
						'heading'          => esc_html__( 'Icon for the tab', 'omniverse' ),
						'param_name'       => 'icon',
						'hint'             => esc_html__( 'Select icon from media library.', 'omniverse' ),
						'dependency'       => array(
							'element' => 'title_icon_type',
							'value'   => array( 'image' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'type'             => 'textfield',
						'heading'          => esc_html__( 'Icon size', 'omniverse' ),
						'param_name'       => 'icon_size',
						'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
						'dependency'       => array(
							'element' => 'title_icon_type',
							'value'   => array( 'image' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					),
					array(
						'param_name'       => 'tabs_icon_libraries',
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Icon library', 'omniverse' ),
						'value'            => array(
							esc_html__( 'Font Awesome', 'omniverse' ) => 'fontawesome',
							esc_html__( 'Open Iconic', 'omniverse' ) => 'openiconic',
							esc_html__( 'Typicons', 'omniverse' ) => 'typicons',
							esc_html__( 'Entypo', 'omniverse' ) => 'entypo',
							esc_html__( 'Linecons', 'omniverse' ) => 'linecons',
							esc_html__( 'Mono Social', 'omniverse' ) => 'monosocial',
							esc_html__( 'Material', 'omniverse' ) => 'material',
						),
						'dependency'       => array(
							'element' => 'title_icon_type',
							'value'   => 'icon',
						),
						'hint'             => esc_html__( 'Select icon library.', 'omniverse' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name' => 'icon_fontawesome',
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'omniverse' ),
						'settings'   => array(
							'emptyIcon'    => true,
							'iconsPerPage' => 50,
						),
						'dependency' => array(
							'element' => 'tabs_icon_libraries',
							'value'   => 'fontawesome',
						),
						'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
					),
					array(
						'param_name' => 'icon_openiconic',
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'omniverse' ),
						'settings'   => array(
							'emptyIcon'    => true,
							'type'         => 'openiconic',
							'iconsPerPage' => 50,
						),
						'dependency' => array(
							'element' => 'tabs_icon_libraries',
							'value'   => 'openiconic',
						),
						'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
					),
					array(
						'param_name' => 'icon_typicons',
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'omniverse' ),
						'settings'   => array(
							'emptyIcon'    => true,
							'type'         => 'typicons',
							'iconsPerPage' => 50,
						),
						'dependency' => array(
							'element' => 'tabs_icon_libraries',
							'value'   => 'typicons',
						),
						'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
					),
					array(
						'param_name' => 'icon_entypo',
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'omniverse' ),
						'settings'   => array(
							'emptyIcon'    => true,
							'type'         => 'entypo',
							'iconsPerPage' => 50,
						),
						'dependency' => array(
							'element' => 'tabs_icon_libraries',
							'value'   => 'entypo',
						),
					),
					array(
						'param_name' => 'icon_linecons',
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'omniverse' ),
						'settings'   => array(
							'emptyIcon'    => true,
							'type'         => 'linecons',
							'iconsPerPage' => 50,
						),
						'dependency' => array(
							'element' => 'tabs_icon_libraries',
							'value'   => 'linecons',
						),
						'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
					),
					array(
						'param_name' => 'icon_monosocial',
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'omniverse' ),
						'settings'   => array(
							'emptyIcon'    => true,
							'type'         => 'monosocial',
							'iconsPerPage' => 50,
						),
						'dependency' => array(
							'element' => 'tabs_icon_libraries',
							'value'   => 'monosocial',
						),
						'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
					),
					array(
						'param_name' => 'icon_material',
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'omniverse' ),
						'settings'   => array(
							'emptyIcon'    => true,
							'type'         => 'material',
							'iconsPerPage' => 50,
						),
						'dependency' => array(
							'element' => 'tabs_icon_libraries',
							'value'   => 'material',
						),
						'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
					),
					array(
						'type'       => 'omniverse_title_divider',
						'holder'     => 'div',
						'title'      => esc_html__( 'Product source', 'omniverse' ),
						'param_name' => 'product_source_divider',
					),
					array(
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Data source', 'omniverse' ),
						'param_name'       => 'post_type',
						'value'            => $post_type_array,
						'hint'             => esc_html__( 'Select content type for your grid.', 'omniverse' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
				),
				$omniverse_prdoucts_params
			),
		);
	}
}

// Necessary hooks for blog autocomplete fields
add_filter( 'vc_autocomplete_products_tab_include_callback', 'omniverse_productIdAutocompleteSuggester_new', 10, 1 );
add_filter( 'vc_autocomplete_products_tab_include_render', 'omniverse_productIdAutocompleteRender', 10, 1 );

// Narrow data taxonomies
add_filter( 'vc_autocomplete_products_tab_taxonomies_callback', 'omniverse_vc_autocomplete_taxonomies_field_search', 10, 1 );
add_filter( 'vc_autocomplete_products_tab_taxonomies_render', 'omniverse_vc_autocomplete_taxonomies_field_render', 10, 1 );

// Narrow data taxonomies for exclude_filter
add_filter( 'vc_autocomplete_products_tab_exclude_filter_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1 );
add_filter( 'vc_autocomplete_products_tab_exclude_filter_render', 'vc_autocomplete_taxonomies_field_render', 10, 1 );

add_filter( 'vc_autocomplete_products_tab_exclude_callback', 'vc_exclude_field_search', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_products_tab_exclude_render', 'vc_exclude_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_products_tabs extends WPBakeryShortCodesContainer {

	}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_products_tab extends WPBakeryShortCode {

	}
}
