<?php
/**
 * Woocommerce title map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_shop_archive_woocommerce_title' ) ) {
	/**
	 * Woocommerce title map.
	 */
	function omniverse_get_vc_map_shop_archive_woocommerce_title() {
		$typography = omniverse_get_typography_map(
			array(
				'key'      => 'title',
				'selector' => '{{WRAPPER}} .title',
			)
		);

		return array(
			'base'        => 'omniverse_shop_archive_woocommerce_title',
			'name'        => esc_html__( 'WooCommerce title', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Products archive', 'omniverse' ), 'shop_archive' ),
			'description' => esc_html__( 'Show current archive page title', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sa-icons/sa-woocommerce-title.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),

				array(
					'heading'          => esc_html__( 'Alignment', 'omniverse' ),
					'type'             => 'wd_select',
					'param_name'       => 'text_alignment',
					'style'            => 'images',
					'selectors'        => array(),
					'devices'          => array(
						'desktop' => array(
							'value' => 'left',
						),
					),
					'value'            => array(
						esc_html__( 'Left', 'omniverse' ) => 'left',
						esc_html__( 'Center', 'omniverse' ) => 'center',
						esc_html__( 'Right', 'omniverse' ) => 'right',
					),
					'images'           => array(
						'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
						'left'   => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
						'right'  => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Tag', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'tag',
					'value'            => array(
						esc_html__( 'h1', 'omniverse' ) => 'h1',
						esc_html__( 'h2', 'omniverse' ) => 'h2',
						esc_html__( 'h3', 'omniverse' ) => 'h3',
						esc_html__( 'h4', 'omniverse' ) => 'h4',
						esc_html__( 'h5', 'omniverse' ) => 'h5',
						esc_html__( 'h6', 'omniverse' ) => 'h6',
						esc_html__( 'p', 'omniverse' )  => 'p',
						esc_html__( 'div', 'omniverse' ) => 'div',
						esc_html__( 'span', 'omniverse' ) => 'span',
					),
					'std'              => 'span',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				$typography['font_family'],
				$typography['font_size'],
				$typography['font_weight'],
				$typography['text_transform'],
				$typography['font_style'],
				$typography['line_height'],

				array(
					'heading'          => esc_html__( 'Text color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'text_color',
					'selectors'        => array(
						'{{WRAPPER}} .title' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
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
