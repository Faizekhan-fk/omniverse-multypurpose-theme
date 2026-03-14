<?php

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_get_vc_map_text_block' ) ) {
	function omniverse_get_vc_map_text_block() {
		$secondary_font = omniverse_get_opt( 'secondary-font' );
		$primary_font   = omniverse_get_opt( 'primary-font' );

		$secondary_font_title = isset( $secondary_font[0] ) ? esc_html__( 'Secondary font', 'omniverse' ) . ' (' . $secondary_font[0]['font-family'] . ')' : esc_html__( 'Secondary font', 'omniverse' );
		$primary_font_title   = isset( $primary_font[0] ) ? esc_html__( 'Title font', 'omniverse' ) . ' (' . $primary_font[0]['font-family'] . ')' : esc_html__( 'Title font', 'omniverse' );

		return array(
			'name'        => esc_html__( 'Text block', 'omniverse' ),
			'base'        => 'omniverse_text_block',
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'A block of text', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/text-block.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				/**
				 * Content.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Content', 'omniverse' ),
					'param_name' => 'content_divider',
				),
				array(
					'type'       => 'textarea_html',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Text', 'omniverse' ),
					'param_name' => 'content',
					'std'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Color Scheme', 'omniverse' ),
					'param_name'       => 'text_color_scheme',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => 'inherit',
						esc_html__( 'Light', 'omniverse' ) => 'light',
						esc_html__( 'Dark', 'omniverse' ) => 'dark',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Paragraph.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Paragraph', 'omniverse' ),
					'param_name' => 'paragraph_divider',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Text font', 'omniverse' ),
					'param_name'       => 'text_font_family',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						$primary_font_title   => 'primary',
						$secondary_font_title => 'alt',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Font size', 'omniverse' ),
					'param_name'       => 'text_font_size',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Extra Small (14px)', 'omniverse' ) => 'xs',
						esc_html__( 'Small (16px)', 'omniverse' ) => 's',
						esc_html__( 'Medium (18px)', 'omniverse' ) => 'm',
						esc_html__( 'Large (22px)', 'omniverse' ) => 'l',
						esc_html__( 'Extra Large (26px)', 'omniverse' ) => 'xl',
						esc_html__( 'XXL (36px)', 'omniverse' ) => 'xxl',
						esc_html__( 'XXXL (46px)', 'omniverse' ) => 'xxxl',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Size', 'omniverse' ),
					'param_name'       => 'text_font_size_custom',
					'css_args'         => array(
						'font-size' => array(
							'.wd-text-block',
						),
					),
					'dependency'       => array(
						'element' => 'text_font_size',
						'value'   => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Line height', 'omniverse' ),
					'param_name'       => 'text_line_height_custom',
					'css_args'         => array(
						'line-height' => array(
							'.wd-text-block',
						),
					),
					'dependency'       => array(
						'element' => 'text_font_size',
						'value'   => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'omniverse_empty_space',
					'param_name' => 'omniverse_empty_space',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Font weight', 'omniverse' ),
					'param_name'       => 'text_font_weight',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
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
					'type'             => 'omniverse_dropdown',
					'heading'          => esc_html__( 'Color', 'omniverse' ),
					'param_name'       => 'text_color',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Title', 'omniverse' ) => 'title',
						esc_html__( 'Primary', 'omniverse' ) => 'primary',
						esc_html__( 'Alternative', 'omniverse' ) => 'alt',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'omniverse_colorpicker',
					'heading'    => esc_html__( 'Custom Color', 'omniverse' ),
					'param_name' => 'text_color_custom',
					'css_args'   => array(
						'color' => array(
							'.wd-text-block',
						),
					),
					'dependency' => array(
						'element' => 'text_color',
						'value'   => array( 'custom' ),
					),
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
					'heading'          => esc_html__( 'Text align', 'omniverse' ),
					'param_name'       => 'text_align',
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
					'omni_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Content width', 'omniverse' ),
					'param_name'       => 'content_width',
					'value'            => array(
						'100%' => '100',
						'90%'  => '90',
						'80%'  => '80',
						'70%'  => '70',
						'60%'  => '60',
						'50%'  => '50',
						'40%'  => '40',
						'30%'  => '30',
						'20%'  => '20',
						'10%'  => '10',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Custom content width', 'omniverse' ),
					'param_name'       => 'custom_content_width',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'default'          => 'desktop',
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
					'dependency'       => array(
						'element' => 'content_width',
						'value'   => array( 'custom' ),
					),
				),
				array(
					'type'             => 'omniverse_slider',
					'param_name'       => 'content_desktop_width',
					'min'              => '0',
					'max'              => '1000',
					'step'             => '1',
					'default'          => '600',
					'units'            => 'px',
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
					'css_args'         => array(
						'--wd-max-width' => array(
							'',
						),
					),
					'css_params'       => array(
						'device' => 'desktop',
					),
					'wd_dependency'    => array(
						'element' => 'custom_content_width',
						'value'   => array( 'desktop' ),
					),
					'dependency'       => array(
						'element' => 'content_width',
						'value'   => array( 'custom' ),
					),
				),
				array(
					'type'             => 'omniverse_slider',
					'param_name'       => 'content_tablet_width',
					'min'              => '0',
					'max'              => '1000',
					'step'             => '1',
					'default'          => '0',
					'units'            => 'px',
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
					'css_args'         => array(
						'--wd-max-width' => array(
							'',
						),
					),
					'css_params'       => array(
						'device' => 'tablet',
					),
					'wd_dependency'    => array(
						'element' => 'custom_content_width',
						'value'   => array( 'tablet' ),
					),
					'dependency'       => array(
						'element' => 'content_width',
						'value'   => array( 'custom' ),
					),
				),
				array(
					'type'             => 'omniverse_slider',
					'param_name'       => 'content_mobile_width',
					'min'              => '0',
					'max'              => '1000',
					'step'             => '1',
					'default'          => '0',
					'units'            => 'px',
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
					'css_args'         => array(
						'--wd-max-width' => array(
							'',
						),
					),
					'css_params'       => array(
						'device' => 'mobile',
					),
					'wd_dependency'    => array(
						'element' => 'custom_content_width',
						'value'   => array( 'mobile' ),
					),
					'dependency'       => array(
						'element' => 'content_width',
						'value'   => array( 'custom' ),
					),
				),
				omniverse_get_vc_display_inline_map(),
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
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				omniverse_get_vc_responsive_spacing_map(),

				omniverse_parallax_scroll_map( 'parallax_scroll' ),
				omniverse_parallax_scroll_map( 'scroll_x' ),
				omniverse_parallax_scroll_map( 'scroll_y' ),
				omniverse_parallax_scroll_map( 'scroll_z' ),
				omniverse_parallax_scroll_map( 'scroll_smooth' ),

				omniverse_get_vc_animation_map( 'wd_animation' ),
				omniverse_get_vc_animation_map( 'wd_animation_delay' ),
				omniverse_get_vc_animation_map( 'wd_animation_duration' ),

				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'extra_classes',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),

				omniverse_get_vc_responsive_visible_map( 'responsive_tabs_hide' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_desktop' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_tablet' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_mobile' ),
			),
		);
	}
}
