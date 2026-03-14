<?php
/**
 * Frequently bought together map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_single_product_fbt_products' ) ) {
	/**
	 * Frequently bought together map.
	 */
	function omniverse_get_vc_map_single_product_fbt_products() {
		$typography = omniverse_get_typography_map(
			array(
				'key'      => 'title',
				'selector' => '{{WRAPPER}} .element-title',
			)
		);

		return array(
			'base'        => 'omniverse_single_product_fbt_products',
			'name'        => esc_html__( 'Frequently bought together', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Single product elements', 'omniverse' ), 'single_product' ),
			'description' => esc_html__( 'Bought together table', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sp-icons/sp-frequently-bought-together.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),

				array(
					'title'      => esc_html__( 'Title', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'title_divider',
				),

				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Element title', 'omniverse' ),
					'param_name' => 'title',
				),

				array(
					'heading'          => esc_html__( 'Color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'title_color',
					'selectors'        => array(
						'{{WRAPPER}} .element-title' => array(
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
					'title'      => esc_html__( 'Carousel', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'carousel_divider',
				),

				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Products columns', 'omniverse' ),
					'param_name'       => 'slides_per_view_tabs',
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
					'param_name'       => 'slides_per_view',
					'value'            => array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					),
					'std'              => '3',
					'wd_dependency'    => array(
						'element' => 'slides_per_view_tabs',
						'value'   => array( 'desktop' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'slides_per_view_tablet',
					'value'            => array(
						esc_html__( 'Auto', 'omniverse' ) => 'auto',
						'1' => '1',
						'2' => '2',
						'3' => '3',
					),
					'std'              => 'auto',
					'wd_dependency'    => array(
						'element' => 'slides_per_view_tabs',
						'value'   => array( 'tablet' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'slides_per_view_mobile',
					'value'            => array(
						esc_html__( 'Auto', 'omniverse' ) => 'auto',
						'1' => '1',
						'2' => '2',
					),
					'std'              => 'auto',
					'wd_dependency'    => array(
						'element' => 'slides_per_view_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),

				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Hide pagination control', 'omniverse' ),
					'param_name'       => 'hide_pagination_control',
					'hint'             => esc_html__( 'If "YES" pagination control will be removed', 'omniverse' ),
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Hide prev/next buttons', 'omniverse' ),
					'param_name'       => 'hide_prev_next_buttons',
					'hint'             => esc_html__( 'If "YES" prev/next control will be removed', 'omniverse' ),
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'title'      => esc_html__( 'Settings', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'settings_divider',
				),

				array(
					'heading'    => esc_html__( 'Form width', 'omniverse' ),
					'type'       => 'wd_slider',
					'param_name' => 'form_width',
					'selectors'  => array(
						'{{WRAPPER}} .wd-fbt.wd-design-side' => array( '--wd-form-width: {{VALUE}}{{UNIT}};' ),
					),
					'devices'    => array(
						'desktop' => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'      => array(
						'px' => array(
							'min'  => 250,
							'max'  => 600,
							'step' => 1,
						),
						'%'  => array(
							'min'  => 0,
							'max'  => 100,
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
			),
		);
	}
}
