<?php
/**
 * Product brands map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_single_product_brands' ) ) {
	/**
	 * Product brands map.
	 */
	function omniverse_get_vc_map_single_product_brands() {
		$typography = omniverse_get_typography_map(
			array(
				'key'        => 'tabs_title',
				'selector'   => '{{WRAPPER}} .wd-label',
				'dependency' => array(
					'element' => 'show_label',
					'value'   => 'yes',
				),
			)
		);

		return array(
			'base'        => 'omniverse_single_product_brands',
			'name'        => esc_html__( 'Product brands', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Single product elements', 'omniverse' ), 'single_product' ),
			'description' => esc_html__( 'Brands assigned to the product', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sp-icons/sp-brands.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),

				// Label.
				array(
					'title'      => esc_html__( 'Label', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'label_divider',
				),

				array(
					'heading'          => esc_html__( 'Show label', 'omniverse' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'show_label',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Label text', 'omniverse' ),
					'type'             => 'textfield',
					'param_name'       => 'label_text',
					'value'            => esc_html__( 'Brands: ', 'omniverse' ),
					'dependency'       => array(
						'element' => 'show_label',
						'value'   => 'yes',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Label color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-label' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'show_label',
						'value'   => 'yes',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				$typography['font_family'],
				$typography['font_size'],
				$typography['font_weight'],
				$typography['text_transform'],
				$typography['font_style'],
				$typography['line_height'],

				// General.
				array(
					'title'      => esc_html__( 'General', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'label_divider',
				),

				array(
					'heading'          => esc_html__( 'Layout', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'layout',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' )  => 'default',
						esc_html__( 'Justify', 'omniverse' )  => 'justify',
						esc_html__( 'Inline', 'omniverse' )   => 'inline',
					),
					'dependency'       => array(
						'element'            => 'show_label',
						'value_not_equal_to' => 'no',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Alignment', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_select',
					'param_name'       => 'alignment',
					'style'            => 'images',
					'selectors'        => array(),
					'devices'          => array(
						'desktop' => array(
							'value' => 'left',
						),
					),
					'value'            => array(
						esc_html__( 'Left', 'omniverse' )   => 'left',
						esc_html__( 'Center', 'omniverse' ) => 'center',
						esc_html__( 'Right', 'omniverse' )  => 'right',
					),
					'images'           => array(
						'left'   => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
						'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
						'right'  => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				// Image.
				array(
					'title'      => esc_html__( 'Image', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'label_divider',
				),

				array(
					'heading'    => esc_html__( 'Style', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'dropdown',
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Shadow', 'omniverse' )  => 'shadow',
					),
				),

				array(
					'heading'    => esc_html__( 'Width', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'wd_slider',
					'param_name' => 'vertical_gap',
					'selectors'  => array(
						'{{WRAPPER}} img' => array(
							'max-width: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'    => array(
						'desktop' => array(
							'value' => '',
							'unit'  => 'px',
						),
						'tablet'  => array(
							'value' => '',
							'unit'  => 'px',
						),
						'mobile'  => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'      => array(
						'px' => array(
							'min'  => 0,
							'max'  => 300,
							'step' => 1,
						),
					),
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
