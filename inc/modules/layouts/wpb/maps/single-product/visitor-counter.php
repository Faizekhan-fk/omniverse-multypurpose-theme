<?php
/**
 * Count product visits map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_single_product_visitor_counter' ) ) {
	/**
	 * Count product visits map.
	 */
	function omniverse_get_vc_map_single_product_visitor_counter() {
		$visitor_counter_typography = omniverse_get_typography_map(
			array(
				'key'      => 'typography',
				'selector' => '{{WRAPPER}}.wd-visits-count',
				'group'    => esc_html__( 'Style', 'omniverse' ),
			)
		);

		return array(
			'base'        => 'omniverse_single_product_visitor_counter',
			'name'        => esc_html__( 'Product visitor counter', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Single product elements', 'omniverse' ), 'single_product' ),
			'description' => esc_html__( 'Show number of visitors for the product', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sp-icons/sp-product-visitor-counter.svg',
			'params'      => array(
				array(
					'param_name'       => 'style',
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Style', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Default', 'omniverse' )         => 'default',
						esc_html__( 'With background', 'omniverse' ) => 'with-bg',
					),
					'std'              => 'default',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Text settings.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Text', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'title_divider_text',
				),
				$visitor_counter_typography['font_family'],
				$visitor_counter_typography['font_size'],
				$visitor_counter_typography['font_weight'],
				$visitor_counter_typography['text_transform'],
				$visitor_counter_typography['font_style'],
				$visitor_counter_typography['line_height'],
				array(
					'heading'          => esc_html__( 'Text color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'text_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-count-number, {{WRAPPER}} .wd-count-msg' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Icon settings.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'title_divider_icon',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Icon type', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'icon_type',
					'value'            => array(
						esc_html__( 'Default icon', 'omniverse' ) => 'default',
						esc_html__( 'Custom icon', 'omniverse' ) => 'icon',
						esc_html__( 'Custom image', 'omniverse' ) => 'image',
					),
					'std'              => 'default',
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Image', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'image',
					'value'            => '',
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => 'image',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'img_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x50 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => 'image',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x50\'.', 'omniverse' ),
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Icon library', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'icon_library',
					'value'            => array(
						esc_html__( 'Font Awesome', 'omniverse' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'omniverse' ) => 'openiconic',
						esc_html__( 'Typicons', 'omniverse' ) => 'typicons',
						esc_html__( 'Entypo', 'omniverse' ) => 'entypo',
						esc_html__( 'Linecons', 'omniverse' ) => 'linecons',
						esc_html__( 'Mono Social', 'omniverse' ) => 'monosocial',
						esc_html__( 'Material', 'omniverse' ) => 'material',
					),
					'hint'             => esc_html__( 'Select icon library.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => 'icon',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_html__( 'Icon', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'icon_fontawesome',
					'value'            => 'far fa-bell',
					'settings'         => array(
						'emptyIcon'    => false,
						'iconsPerPage' => 50,
					),
					'dependency'       => array(
						'element' => 'icon_library',
						'value'   => 'fontawesome',
					),
					'hint'             => esc_html__( 'Select icon from library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_html__( 'Icon', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'icon_openiconic',
					'settings'         => array(
						'emptyIcon'    => false,
						'type'         => 'openiconic',
						'iconsPerPage' => 50,
					),
					'dependency'       => array(
						'element' => 'icon_library',
						'value'   => 'openiconic',
					),
					'hint'             => esc_html__( 'Select icon from library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_html__( 'Icon', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'icon_typicons',
					'settings'         => array(
						'emptyIcon'    => false,
						'type'         => 'typicons',
						'iconsPerPage' => 50,
					),
					'dependency'       => array(
						'element' => 'icon_library',
						'value'   => 'typicons',
					),
					'hint'             => esc_html__( 'Select icon from library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_html__( 'Icon', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'icon_entypo',
					'settings'         => array(
						'emptyIcon'    => false,
						'type'         => 'entypo',
						'iconsPerPage' => 50,
					),
					'dependency'       => array(
						'element' => 'icon_library',
						'value'   => 'entypo',
					),
					'hint'             => esc_html__( 'Select icon from library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_html__( 'Icon', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'icon_linecons',
					'settings'         => array(
						'emptyIcon'    => false,
						'type'         => 'linecons',
						'iconsPerPage' => 50,
					),
					'dependency'       => array(
						'element' => 'icon_library',
						'value'   => 'linecons',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'hint'             => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_html__( 'Icon', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'icon_monosocial',
					'settings'         => array(
						'emptyIcon'    => false,
						'type'         => 'monosocial',
						'iconsPerPage' => 50,
					),
					'dependency'       => array(
						'element' => 'icon_library',
						'value'   => 'monosocial',
					),
					'hint'             => esc_html__( 'Select icon from library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_html__( 'Icon', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'icon_material',
					'settings'         => array(
						'emptyIcon'    => false,
						'type'         => 'material',
						'iconsPerPage' => 50,
					),
					'dependency'       => array(
						'element' => 'icon_library',
						'value'   => 'material',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'hint'             => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'heading'    => esc_html__( 'Icon size', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'wd_slider',
					'param_name' => 'icon_size',
					'selectors'  => array(
						'{{WRAPPER}} .wd-count-icon' => array(
							'font-size: {{VALUE}}px;',
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
							'min'  => 0,
							'max'  => 50,
							'step' => 1,
						),
					),
					'dependency' => array(
						'element'            => 'icon_type',
						'value_not_equal_to' => 'image',
					),
				),
				array(
					'heading'          => esc_html__( 'Icon color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'icon_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-count-icon' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency' => array(
						'element'            => 'icon_type',
						'value_not_equal_to' => 'image',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
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
			),
		);
	}
}
