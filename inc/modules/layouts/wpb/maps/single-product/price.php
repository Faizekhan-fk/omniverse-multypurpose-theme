<?php
/**
 * Price map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_single_product_price' ) ) {
	/**
	 * Price map.
	 */
	function omniverse_get_vc_map_single_product_price() {
		$typography_price = omniverse_get_typography_map(
			array(
				'key'           => 'price',
				'selector'      => '{{WRAPPER}} .price, {{WRAPPER}} .amount',
				'wd_dependency' => array(
					'element' => 'price_style_tabs',
					'value'   => array( 'main_price' ),
				),
			)
		);

		$typography_old_price = omniverse_get_typography_map(
			array(
				'key'           => 'old_price',
				'selector'      => '{{WRAPPER}} .price del, {{WRAPPER}} del .amount',
				'wd_dependency' => array(
					'element' => 'price_style_tabs',
					'value'   => array( 'old_price' ),
				),
			)
		);

		$typography_suffix = omniverse_get_typography_map(
			array(
				'key'           => 'suffix',
				'selector'      => '{{WRAPPER}} .woocommerce-price-suffix',
				'wd_dependency' => array(
					'element' => 'price_style_tabs',
					'value'   => array( 'suffix' ),
				),
			)
		);

		return array(
			'base'        => 'omniverse_single_product_price',
			'name'        => esc_html__( 'Product price', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Single product elements', 'omniverse' ), 'single_product' ),
			'description' => esc_html__( 'Regular and sale price', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sp-icons/sp-price.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),

				array(
					'heading'          => esc_html__( 'Alignment', 'omniverse' ),
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

				// Price.
				array(
					'title'      => esc_html__( 'Price', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'label_divider',
				),

				array(
					'heading'          => '',
					'type'             => 'omniverse_button_set',
					'param_name'       => 'price_style_tabs',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Regular price', 'omniverse' ) => 'main_price',
						esc_html__( 'Old price', 'omniverse' )  => 'old_price',
						esc_html__( 'Suffix', 'omniverse' )     => 'suffix',
					),
					'default'          => 'main_price',
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),

				$typography_price['font_family'],
				$typography_price['font_size'],
				$typography_price['font_weight'],
				$typography_price['text_transform'],
				$typography_price['font_style'],
				$typography_price['line_height'],

				array(
					'heading'          => esc_html__( 'Text color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'main_price_text_color',
					'selectors'        => array(
						'{{WRAPPER}} .price, {{WRAPPER}} .amount, {{WRAPPER}} del' => array(
							'color: {{VALUE}};',
						),
					),
					'wd_dependency'    => array(
						'element' => 'price_style_tabs',
						'value'   => array( 'main_price' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				$typography_old_price['font_family'],
				$typography_old_price['font_size'],
				$typography_old_price['font_weight'],
				$typography_old_price['text_transform'],
				$typography_old_price['font_style'],
				$typography_old_price['line_height'],

				array(
					'heading'          => esc_html__( 'Text color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'old_price_text_color',
					'selectors'        => array(
						'{{WRAPPER}} .price del, {{WRAPPER}} del .amount' => array(
							'color: {{VALUE}};',
						),
					),
					'wd_dependency'    => array(
						'element' => 'price_style_tabs',
						'value'   => array( 'old_price' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				$typography_suffix['font_family'],
				$typography_suffix['font_size'],
				$typography_suffix['font_weight'],
				$typography_suffix['text_transform'],
				$typography_suffix['font_style'],
				$typography_suffix['line_height'],

				array(
					'heading'          => esc_html__( 'Text color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'suffix_text_color',
					'selectors'        => array(
						'{{WRAPPER}} .woocommerce-price-suffix' => array(
							'color: {{VALUE}};',
						),
					),
					'wd_dependency'    => array(
						'element' => 'price_style_tabs',
						'value'   => array( 'suffix' ),
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

add_filter( 'vc_autocomplete_omniverse_single_product_price_product_id_callback', 'omniverse_productIdAutocompleteSuggester_new', 10, 1 );
add_filter( 'vc_autocomplete_omniverse_single_product_price_product_id_render', 'omniverse_productIdAutocompleteRender', 10, 1 );
