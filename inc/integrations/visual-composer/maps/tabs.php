<?php
/**
 * Maps for tabs element.
 *
 * @package Elements.
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_get_vc_map_tabs' ) ) {
	/**
	 * Displays the shortcode settings fields in the admin.
	 */
	function omniverse_get_vc_map_tabs() {
		$typography = omniverse_get_typography_map(
			array(
				'title'    => esc_html__( 'Title typography', 'omniverse' ),
				'group'    => esc_html__( 'General', 'omniverse' ),
				'key'      => 'heading_title',
				'selector' => '{{WRAPPER}}.wd-tabs .tabs-name',
			)
		);

		$secondary_font = omniverse_get_opt( 'secondary-font' );
		$primary_font   = omniverse_get_opt( 'primary-font' );
		$text_font      = omniverse_get_opt( 'text-font' );

		$secondary_font_title = isset( $secondary_font[0] ) ? esc_html__( 'Secondary font', 'omniverse' ) . ' (' . $secondary_font[0]['font-family'] . ')' : esc_html__( 'Secondary font', 'omniverse' );
		$text_font_title      = isset( $text_font[0] ) ? esc_html__( 'Text font', 'omniverse' ) . ' (' . $text_font[0]['font-family'] . ')' : esc_html__( 'Text', 'omniverse' );
		$primary_font_title   = isset( $primary_font[0] ) ? esc_html__( 'Title font', 'omniverse' ) . ' (' . $primary_font[0]['font-family'] . ')' : esc_html__( 'Title font', 'omniverse' );

		return array(
			'base'            => 'omniverse_tabs',
			'name'            => esc_html__( 'Tabs', 'omniverse' ),
			'description'     => esc_html__( 'Tabbed content', 'omniverse' ),
			'category'        => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/tabs.svg',
			'as_parent'       => array( 'only' => 'omniverse_tab' ),
			'content_element' => true,
			'js_view'         => 'VcColumnView',
			'default_content' => '[omniverse_tab title="Tab #1"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/omniverse_tab][omniverse_tab title="Tab #2"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. 2[/omniverse_tab]',
			'params'          => array(
				array(
					'param_name' => 'omniverse_css_id',
					'type'       => 'omniverse_css_id',
					'group'      => esc_html__( 'General', 'omniverse' ),
				),
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Heading', 'omniverse' ),
					'group'      => esc_html__( 'General', 'omniverse' ),
					'param_name' => 'title_divider',
				),
				array(
					'heading'          => esc_html__( 'Design', 'omniverse' ),
					'group'            => esc_html__( 'General', 'omniverse' ),
					'type'             => 'omniverse_image_select',
					'param_name'       => 'design',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Simple', 'omniverse' ) => 'simple',
						esc_html__( 'Alternative', 'omniverse' ) => 'alt',
						esc_html__( 'Aside', 'omniverse' ) => 'aside',
					),
					'images_value'     => array(
						'default' => OMNIVERSE_ASSETS_IMAGES . '/settings/ajax-tabs/default.png',
						'simple'  => OMNIVERSE_ASSETS_IMAGES . '/settings/ajax-tabs/simple.png',
						'alt'     => OMNIVERSE_ASSETS_IMAGES . '/settings/ajax-tabs/alternative.png',
						'aside'   => OMNIVERSE_ASSETS_IMAGES . '/settings/ajax-tabs/aside.png',
					),
					'std'              => 'default',
					'wood_tooltip'     => true,
					'edit_field_class' => 'vc_col-xs-12 vc_column tab-design',
				),
				array(
					'heading'          => esc_html__( 'Title color', 'omniverse' ),
					'group'            => esc_html__( 'General', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'tabs_title_color',
					'selectors'        => array(
						'{{WRAPPER}} .tabs-name' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				$typography['font_family'],
				$typography['font_size'],
				$typography['font_weight'],
				$typography['text_transform'],
				$typography['font_style'],
				$typography['line_height'],
				array(
					'heading'          => esc_html__( 'Description color', 'omniverse' ),
					'group'            => esc_html__( 'General', 'omniverse' ),
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
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Border color', 'omniverse' ),
					'group'            => esc_html__( 'General', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'tabs_border_color',
					'selectors'        => array(
						'{{WRAPPER}}.wd-tabs.tabs-design-simple .tabs-name' => array(
							'border-color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'design',
						'value'   => array( 'simple' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'wd_slider',
					'param_name'       => 'tabs_side_width',
					'heading'          => esc_html__( 'Side heading width', 'omniverse' ),
					'group'            => esc_html__( 'General', 'omniverse' ),
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
						'{{WRAPPER}} .wd-tabs.tabs-design-aside' => array(
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
					'group'            => esc_html__( 'General', 'omniverse' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'enable_heading_bg',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'heading'          => esc_html__( 'Custom background color', 'omniverse' ),
					'group'            => esc_html__( 'General', 'omniverse' ),
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
					'group'       => esc_html__( 'General', 'omniverse' ),
					'type'       => 'omniverse_empty_space',
					'param_name' => 'omniverse_empty_space',
				),
				array(
					'param_name'       => 'tabs_title_alignment',
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Alignment', 'omniverse' ),
					'group'            => esc_html__( 'General', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Left', 'omniverse' ) => 'left',
						esc_html__( 'Center', 'omniverse' ) => 'center',
						esc_html__( 'Right', 'omniverse' ) => 'right',
					),
					'images_value'     => array(
						'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
						'left'   => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
						'right'  => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					),
					'std'              => 'center',
					'dependency'       => array(
						'element' => 'design',
						'value'   => array( 'default' ),
					),
					'wood_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				/**
				 * Title
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Heading content', 'omniverse' ),
					'group'      => esc_html__( 'General', 'omniverse' ),
					'param_name' => 'title_divider',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'omniverse' ),
					'group'      => esc_html__( 'General', 'omniverse' ),
					'param_name' => 'title',
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Description', 'omniverse' ),
					'group'      => esc_html__( 'General', 'omniverse' ),
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
					'group'      => esc_html__( 'General', 'omniverse' ),
					'param_name' => 'image_divider',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Icon image', 'omniverse' ),
					'group'            => esc_html__( 'General', 'omniverse' ),
					'param_name'       => 'image',
					'value'            => '',
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Images size', 'omniverse' ),
					'group'            => esc_html__( 'General', 'omniverse' ),
					'param_name'       => 'img_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
				),
				/**
				 * Tabs Layout.
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
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'icon_position',
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Icon position', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Left', 'omniverse' ) => 'left',
						esc_html__( 'Top', 'omniverse' ) => 'top',
						esc_html__( 'Right', 'omniverse' ) => 'right',
					),
					'images_value'     => array(
						'top'   => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/top.png',
						'left'  => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/left.png',
						'right' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/right.png',
					),
					'std'              => 'left',
					'wood_tooltip'     => true,
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
				/**
				 * Tabs Typography.
				 */
				array(
					'param_name' => 'tabs_layout_divider',
					'type'       => 'omniverse_title_divider',
					'title'      => esc_html__( 'Typography', 'omniverse' ),
					'group'      => esc_html__( 'Tab title', 'omniverse' ),
					'holder'     => 'div',
				),
				array(
					'param_name'       => 'tabs_title_font_family',
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Font family', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'value'            => array(
						$primary_font_title   => 'primary',
						$text_font_title      => 'text',
						$secondary_font_title => 'alt',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'tabs_title_font_weight',
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Font weight', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
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
					'std'              => 600,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'tabs_title_font_size',
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Predefined size', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Small (16px)', 'omniverse' ) => 's',
						esc_html__( 'Extra Small (14px)', 'omniverse' ) => 'xs',
						esc_html__( 'Medium (18px)', 'omniverse' ) => 'm',
						esc_html__( 'Large (22px)', 'omniverse' ) => 'l',
						esc_html__( 'Extra Large (26px)', 'omniverse' ) => 'xl',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'tabs_title_custom_font_size',
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Custom font size', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'css_args'         => array(
						'font-size' => array(
							' .wd-fontsize-custom',
						),
					),
					'dependency'       => array(
						'element' => 'tabs_title_font_size',
						'value'   => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'tabs_title_line_height',
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Custom line height', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'css_args'         => array(
						'line-height' => array(
							' .wd-fontsize-custom',
						),
					),
					'dependency'       => array(
						'element' => 'tabs_title_font_size',
						'value'   => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'tabs_title_color_scheme',
					'type'             => 'omniverse_dropdown',
					'heading'          => esc_html__( 'Color scheme', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => 'inherit',
						esc_html__( 'Dark', 'omniverse' ) => 'dark',
						esc_html__( 'Light', 'omniverse' ) => 'light',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'style'            => array(
						'dark' => '#2d2a2a',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'tabs_title_text_color',
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Text color', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'css_args'         => array(
						'color' => array(
							' .wd-nav > li > a',
						),
					),
					'dependency'       => array(
						'element' => 'tabs_title_color_scheme',
						'value'   => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'tabs_text_hover_color',
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Text hover color', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'css_args'         => array(
						'color' => array(
							' .wd-nav > li:hover > a',
						),
					),
					'dependency'       => array(
						'element' => 'tabs_title_color_scheme',
						'value'   => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'tabs_text_active_color',
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Text active color', 'omniverse' ),
					'group'            => esc_html__( 'Tab title', 'omniverse' ),
					'css_args'         => array(
						'color' => array(
							'.wd-tabs:not(.wd-inited) .wd-nav-tabs li:first-child a',
							' .wd-nav-tabs > li.wd-active > a',
						),
					),
					'dependency'       => array(
						'element' => 'tabs_title_color_scheme',
						'value'   => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Content Settings.
				 */
				array(
					'param_name' => 'content_typography_divider',
					'type'       => 'omniverse_title_divider',
					'title'      => esc_html__( 'Typography', 'omniverse' ),
					'group'      => esc_html__( 'Content', 'omniverse' ),
					'holder'     => 'div',
				),
				array(
					'param_name'       => 'content_font_family',
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Font family', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						$primary_font_title   => 'primary',
						$text_font_title      => 'text',
						$secondary_font_title => 'alt',
					),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'content_font_size',
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Predefined size', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Small (16px)', 'omniverse' ) => 's',
						esc_html__( 'Extra Small (14px)', 'omniverse' ) => 'xs',
						esc_html__( 'Medium (18px)', 'omniverse' ) => 'm',
						esc_html__( 'Large (22px)', 'omniverse' ) => 'l',
						esc_html__( 'Extra Large (26px)', 'omniverse' ) => 'xl',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'content_custom_font_size',
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Custom font size', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'css_args'         => array(
						'font-size' => array(
							' .wd-fontsize-custom',
						),
					),
					'dependency'       => array(
						'element' => 'content_font_size',
						'value'   => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'content_line_height',
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Custom line height', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'css_args'         => array(
						'line-height' => array(
							' .wd-fontsize-custom',
						),
					),
					'dependency'       => array(
						'element' => 'content_font_size',
						'value'   => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'content_font_weight',
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Font weight', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
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
					'param_name'       => 'content_text_color_scheme',
					'type'             => 'omniverse_dropdown',
					'heading'          => esc_html__( 'Color scheme', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => 'inherit',
						esc_html__( 'Dark', 'omniverse' ) => 'dark',
						esc_html__( 'Light', 'omniverse' ) => 'light',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'style'            => array(
						'dark' => '#2d2a2a',
					),
					'std'              => 'inherit',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name' => 'content_text_color_custom',
					'type'       => 'omniverse_colorpicker',
					'heading'    => esc_html__( 'Custom Color', 'omniverse' ),
					'group'      => esc_html__( 'Content', 'omniverse' ),
					'css_args'   => array(
						'color' => array(
							' .wd-tab-content',
						),
					),
					'dependency' => array(
						'element' => 'content_text_color_scheme',
						'value'   => array( 'custom' ),
					),

				),

				/**
				 * Design Options.
				 */
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				omniverse_get_vc_responsive_spacing_map(),

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
						esc_html__( 'None', 'omniverse' )       => '',
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
						esc_html__( 'Zoom in', 'omniverse' )    => 'zoom-in',
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
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_tab' ) ) {
	function omniverse_get_vc_map_tab() {
		return array(
			'base'            => 'omniverse_tab',
			'name'            => esc_html__( 'Tab', 'omniverse' ),
			'description'     => esc_html__( 'Add tab in tabs area', 'omniverse' ),
			'category'        => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/tab.svg',
			'as_child'        => array( 'only' => 'omniverse_tabs' ),
			'content_element' => true,
			'params'          => array(
				/**
				 * Title.
				 */
				array(
					'param_name' => 'title',
					'type'       => 'textarea',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'omniverse' ),
				),
				/**
				 * Content.
				 */
				array(
					'param_name' => 'tabs_content_divider',
					'type'       => 'omniverse_title_divider',
					'title'      => esc_html__( 'Content', 'omniverse' ),
				),
				array(
					'param_name'       => 'content_type',
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Content type', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Text', 'omniverse' ) => 'text',
						esc_html__( 'HTML Block', 'omniverse' ) => 'html_block',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name' => 'content',
					'type'       => 'textarea_html',
					'heading'    => esc_html__( 'Content', 'omniverse' ),
					'dependency' => array(
						'element' => 'content_type',
						'value'   => array( 'text' ),
					),
				),
				array(
					'param_name' => 'html_block_id',
					'type'       => 'omniverse_dropdown',
					'heading'    => esc_html__( 'Select block', 'omniverse' ),
					'callback'   => 'omniverse_get_html_blocks_array_with_empty',
					'dependency' => array(
						'element' => 'content_type',
						'value'   => array( 'html_block' ),
					),
				),

				/**
				 * Icon.
				 */
				array(
					'param_name' => 'icon_divider',
					'type'       => 'omniverse_title_divider',
					'title'      => esc_html__( 'Icon settings', 'omniverse' ),
					'holder'     => 'div',
				),
				array(
					'param_name'       => 'tabs_title_icon_type',
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'List type', 'omniverse' ),
					'value'            => array(
						esc_html__( 'With icon', 'omniverse' ) => 'icon',
						esc_html__( 'With image', 'omniverse' ) => 'image',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'tabs_image',
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Image', 'omniverse' ),
					'value'            => '',
					'dependency'       => array(
						'element' => 'tabs_title_icon_type',
						'value'   => array( 'image' ),
					),
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'tabs_image_size',
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'dependency'       => array(
						'element' => 'tabs_title_icon_type',
						'value'   => array( 'image' ),
					),
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'tabs_icon_libraries',
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Icon library', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Font Awesome', 'omniverse' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'omniverse' )  => 'openiconic',
						esc_html__( 'Typicons', 'omniverse' )     => 'typicons',
						esc_html__( 'Entypo', 'omniverse' )       => 'entypo',
						esc_html__( 'Linecons', 'omniverse' )     => 'linecons',
						esc_html__( 'Mono Social', 'omniverse' )  => 'monosocial',
						esc_html__( 'Material', 'omniverse' )     => 'material',
					),
					'dependency'       => array(
						'element' => 'tabs_title_icon_type',
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
			),
		);
	}
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	/**
	 * Create omniverse tabs wrapper.
	 */
	class WPBakeryShortCode_omniverse_tabs extends WPBakeryShortCodesContainer {}
}
