<?php

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_get_vc_map_list' ) ) {
	function omniverse_get_vc_map_list() {
		$typography = omniverse_get_typography_map(
			array(
				'key'      => 'typography',
				'selector' => '{{WRAPPER}} .list-content',
			)
		);

		return array(
			'name'        => esc_html__( 'List', 'omniverse' ),
			'base'        => 'omniverse_list',
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Display a list with icon', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/list.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				// General.
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'General settings', 'omniverse' ),
					'param_name' => 'general_divider',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'List items font size', 'omniverse' ),
					'param_name'       => 'size',
					'value'            => array(
						esc_html__( 'Default (14px)', 'omniverse' ) => 'default',
						esc_html__( 'Medium (16px)', 'omniverse' ) => 'medium',
						esc_html__( 'Large (18px)', 'omniverse' ) => 'large',
						esc_html__( 'Extra Large (22px)', 'omniverse' ) => 'extra-large',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Color scheme', 'omniverse' ),
					'param_name'       => 'color_scheme',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Light', 'omniverse' ) => 'light',
						esc_html__( 'Dark', 'omniverse' )  => 'dark',
						esc_html__( 'Custom', 'omniverse' )  => 'custom',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Text color', 'omniverse' ),
					'param_name'       => 'text_color',
					'css_args'         => array(
						'color' => array(
							' li',
						),
					),
					'dependency'       => array(
						'element' => 'color_scheme',
						'value'   => array( 'custom' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Text color hover', 'omniverse' ),
					'param_name'       => 'text_color_hover',
					'css_args'         => array(
						'color' => array(
							' li:hover',
						),
					),
					'dependency'       => array(
						'element' => 'color_scheme',
						'value'   => array( 'custom' ),
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
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Align', 'omniverse' ),
					'param_name'       => 'align',
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
					'std'              => 'left',
					'wood_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'type'             => 'wd_slider',
					'param_name'       => 'list_items_gap',
					'heading'          => esc_html__( 'List items gap', 'omniverse' ),
					'devices'          => array(
						'desktop' => array(
							'unit'  => 'px',
							'value' => 15,
						),
						'tablet'  => array(
							'unit'  => 'px',
							'value' => 0,
						),
						'mobile'  => array(
							'unit'  => 'px',
							'value' => 0,
						),
					),
					'range'            => array(
						'px' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					),
					'selectors'        => array(
						'{{WRAPPER}}.wd-list' => array(
							'--li-mb: {{VALUE}}{{UNIT}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Extra settings', 'omniverse' ),
					'param_name' => 'extra_divider',
				),
				( function_exists( 'vc_map_add_css_animation' ) ) ? vc_map_add_css_animation( true ) : '',
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
				// List.
				array(
					'type'       => 'param_group',
					'param_name' => 'list',
					'group'      => esc_html__( 'List', 'omniverse' ),
					'params'     => array(
						array(
							'type'       => 'vc_link',
							'heading'    => esc_html__( 'Link', 'omniverse' ),
							'param_name' => 'link',
						),
						array(
							'type'       => 'textarea',
							'heading'    => esc_html__( 'Content', 'omniverse' ),
							'param_name' => 'list-content',
						),
						array(
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Item icon type', 'omniverse' ),
							'value'            => array(
								esc_html__( 'Inherit', 'omniverse' ) => 'inherit',
								esc_html__( 'With image', 'omniverse' ) => 'image',
							),
							'param_name'       => 'item_type',
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'attach_image',
							'heading'          => esc_html__( 'Custom image', 'omniverse' ),
							'param_name'       => 'image_id',
							'value'            => '',
							'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
							'dependency'       => array(
								'element' => 'item_type',
								'value'   => array( 'image' ),
							),
						),
						array(
							'type'             => 'textfield',
							'heading'          => esc_html__( 'Image size', 'omniverse' ),
							'param_name'       => 'item_image_size',
							'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x50 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
							'dependency'       => array(
								'element' => 'item_type',
								'value'   => array( 'image' ),
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
							'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x50\'.', 'omniverse' ),
						),
					),
				),
				// Icon.
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Icon settings', 'omniverse' ),
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_divider',
				),
				array(
					'type'             => 'dropdown',
					'group'            => esc_html__( 'Icon', 'omniverse' ),
					'heading'          => esc_html__( 'List icon type', 'omniverse' ),
					'value'            => array(
						esc_html__( 'With icon', 'omniverse' ) => 'icon',
						esc_html__( 'With image', 'omniverse' ) => 'image',
						esc_html__( 'Ordered', 'omniverse' ) => 'ordered',
						esc_html__( 'Unordered', 'omniverse' ) => 'unordered',
						esc_html__( 'Without icon', 'omniverse' ) => 'without',
					),
					'param_name'       => 'list_type',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'group'            => esc_html__( 'Icon', 'omniverse' ),
					'heading'          => esc_html__( 'List style', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Rounded', 'omniverse' ) => 'rounded',
						esc_html__( 'Square', 'omniverse' ) => 'square',
					),
					'param_name'       => 'list_style',
					'dependency'       => array(
						'element' => 'list_type',
						'value'   => array( 'icon', 'ordered', 'unordered' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Image', 'omniverse' ),
					'group'            => esc_html__( 'Icon', 'omniverse' ),
					'param_name'       => 'image',
					'value'            => '',
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'list_type',
						'value'   => array( 'image' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'group'            => esc_html__( 'Icon', 'omniverse' ),
					'param_name'       => 'img_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x50 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'list_type',
						'value'   => array( 'image' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x50\'.', 'omniverse' ),
				),
				array(
					'type'       => 'dropdown',
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'heading'    => esc_html__( 'Icon library', 'omniverse' ),
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
						'element' => 'list_type',
						'value'   => 'icon',
					),
				),
				array(
					'type'       => 'iconpicker',
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_fontawesome',
					'value'      => 'far fa-bell',
					'settings'   => array(
						'emptyIcon'    => false,
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => 'fontawesome',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_openiconic',
					'settings'   => array(
						'emptyIcon'    => false,
						'type'         => 'openiconic',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => 'openiconic',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_typicons',
					'settings'   => array(
						'emptyIcon'    => false,
						'type'         => 'typicons',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => 'typicons',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_entypo',
					'settings'   => array(
						'emptyIcon'    => false,
						'type'         => 'entypo',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => 'entypo',
					),
				),
				array(
					'type'       => 'iconpicker',
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_linecons',
					'settings'   => array(
						'emptyIcon'    => false,
						'type'         => 'linecons',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => 'linecons',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_monosocial',
					'settings'   => array(
						'emptyIcon'    => false,
						'type'         => 'monosocial',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => 'monosocial',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_material',
					'settings'   => array(
						'emptyIcon'    => false,
						'type'         => 'material',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => 'material',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'group'            => esc_html__( 'Icon', 'omniverse' ),
					'heading'          => esc_html__( 'Icons color', 'omniverse' ),
					'param_name'       => 'icons_color',
					'css_args'         => array(
						'color' => array(
							' .wd-icon',
						),
					),
					'dependency'       => array(
						'element' => 'list_type',
						'value'   => array( 'icon', 'ordered', 'unordered' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'group'            => esc_html__( 'Icon', 'omniverse' ),
					'heading'          => esc_html__( 'Icons color hover', 'omniverse' ),
					'param_name'       => 'icons_color_hover',
					'css_args'         => array(
						'color' => array(
							' li:hover .wd-icon',
						),
					),
					'dependency'       => array(
						'element' => 'list_type',
						'value'   => array( 'icon', 'ordered', 'unordered' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'group'            => esc_html__( 'Icon', 'omniverse' ),
					'heading'          => esc_html__( 'Icons background color', 'omniverse' ),
					'param_name'       => 'icons_bg_color',
					'css_args'         => array(
						'background-color' => array(
							' .wd-icon',
						),
					),
					'dependency'       => array(
						'element' => 'list_style',
						'value'   => array( 'rounded', 'square' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'group'            => esc_html__( 'Icon', 'omniverse' ),
					'heading'          => esc_html__( 'Icons background color hover', 'omniverse' ),
					'param_name'       => 'icons_bg_color_hover',
					'css_args'         => array(
						'background-color' => array(
							' li:hover .wd-icon',
						),
					),
					'dependency'       => array(
						'element' => 'list_style',
						'value'   => array( 'rounded', 'square' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'    => esc_html__( 'Icon size', 'omniverse' ),
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'type'       => 'wd_slider',
					'param_name' => 'icon_size',
					'selectors'  => array(
						'{{WRAPPER}}.wd-list .wd-icon' => array(
							'font-size: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'    => array(
						'desktop' => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'      => array(
						'px' => array(
							'min'  => 1,
							'max'  => 100,
							'step' => 1,
						),
					),
					'dependency' => array(
						'element' => 'list_type',
						'value'   => array( 'icon' ),
					),
				),
				// Style.
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				omniverse_get_vc_responsive_spacing_map(),
			),
		);
	}
}
