<?php

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_get_vc_map_mega_menu' ) ) {
	function omniverse_get_vc_map_mega_menu() {
		$item_typography = omniverse_get_typography_map(
			array(
				'title'    => esc_html__( 'Typography', 'omniverse' ),
				'key'      => 'item_typography',
				'selector' => '{{WRAPPER}} .wd-nav > .menu-item > a',
			)
		);

		return array(
			'name'        => esc_html__( 'Mega Menu widget', 'omniverse' ),
			'base'        => 'omniverse_mega_menu',
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Categories mega menu widget', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/mega-menu-widget.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'General options', 'omniverse' ),
					'param_name' => 'general_divider',
				),
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Title', 'omniverse' ),
					'param_name'       => 'title',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency'       => array(
						'element' => 'design',
						'value'   => array( 'vertical' ),
					),
				),
				array(
					'type'             => 'omniverse_dropdown',
					'heading'          => esc_html__( 'Choose Menu', 'omniverse' ),
					'param_name'       => 'nav_menu',
					'callback'         => 'omniverse_get_menus_array',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Orientation', 'omniverse' ),
					'param_name'       => 'design',
					'value'            => array(
						esc_html__( 'Vertical', 'omniverse' ) => 'vertical',
						esc_html__( 'Horizontal', 'omniverse' ) => 'horizontal',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Design', 'omniverse' ),
					'param_name'       => 'dropdown_design',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'With background', 'omniverse' ) => 'with-bg',
						esc_html__( 'Simple', 'omniverse' ) => 'simple',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency'       => array(
						'element' => 'design',
						'value'   => array( 'vertical' ),
					),
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Items gap', 'omniverse' ),
					'param_name'       => 'vertical_items_gap',
					'value'            => array(
						esc_html__( 'Small', 'omniverse' )  => 's',
						esc_html__( 'Medium', 'omniverse' ) => 'm',
						esc_html__( 'Large', 'omniverse' )  => 'l',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency'       => array(
						'element' => 'dropdown_design',
						'value'   => array( 'simple' ),
					),
					'wd_dependency'    => array(
						'element' => 'design',
						'value'   => array( 'vertical' ),
					),
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'style',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' )    => 'default',
						esc_html__( 'Underline', 'omniverse' )  => 'underline',
						esc_html__( 'Bordered', 'omniverse' )   => 'bordered',
						esc_html__( 'Separated', 'omniverse' )  => 'separated',
						esc_html__( 'Background', 'omniverse' ) => 'bg',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency'       => array(
						'element' => 'design',
						'value'   => array( 'horizontal' ),
					),
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Items gap', 'omniverse' ),
					'param_name'       => 'items_gap',
					'value'            => array(
						esc_html__( 'Small', 'omniverse' )  => 's',
						esc_html__( 'Medium', 'omniverse' ) => 'm',
						esc_html__( 'Large', 'omniverse' )  => 'l',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency'       => array(
						'element' => 'design',
						'value'   => array( 'horizontal' ),
					),
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Alignment', 'omniverse' ),
					'param_name'       => 'alignment',
					'value'            => array(
						esc_html__( 'Left', 'omniverse' )  => 'left',
						esc_html__( 'Center', 'omniverse' ) => 'center',
						esc_html__( 'Right', 'omniverse' ) => 'right',
					),
					'images_value'     => array(
						'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
						'left'   => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
						'right'  => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					),
					'dependency'       => array(
						'element' => 'design',
						'value'   => array( 'horizontal' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				$item_typography['font_family'],
				$item_typography['font_size'],
				$item_typography['font_weight'],
				$item_typography['text_transform'],
				$item_typography['font_style'],
				$item_typography['line_height'],
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Icon alignment', 'omniverse' ),
					'param_name'       => 'icon_alignment',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'inherit',
						esc_html__( 'Left', 'omniverse' )    => 'left',
						esc_html__( 'Right', 'omniverse' )   => 'right',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Title options', 'omniverse' ),
					'param_name' => 'title_divider',
					'dependency' => array(
						'element' => 'design',
						'value'   => array( 'vertical' ),
					),
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
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Title background color', 'omniverse' ),
					'param_name'       => 'color',
					'css_args'         => array(
						'background-color' => array(
							' .widget-title',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
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
				omniverse_get_vc_responsive_spacing_map(),
				/**
				 * Advanced
				 */

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
