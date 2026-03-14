<?php
/**
 * Product price table map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_single_product_dynamic_discounts_table' ) ) {
	/**
	 * Content map.
	 */
	function omniverse_get_vc_map_single_product_dynamic_discounts_table() {
		$price_typography = omniverse_get_typography_map(
			array(
				'key'      => 'price_typography',
				'title'    => esc_html__( 'Price typography', 'omniverse' ),
				'group'    => esc_html__( 'Style', 'omniverse' ),
				'selector' => '{{WRAPPER}}.wd-dynamic-discounts .amount',
			)
		);

		$discount_typography = omniverse_get_typography_map(
			array(
				'key'      => 'discount_typography',
				'title'    => esc_html__( 'Discount typography', 'omniverse' ),
				'group'    => esc_html__( 'Style', 'omniverse' ),
				'selector' => '{{WRAPPER}}.wd-dynamic-discounts tr td:last-child',
			)
		);

		return array(
			'base'        => 'omniverse_single_product_dynamic_discounts_table',
			'name'        => esc_html__( 'Product dynamic discounts table', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Single product elements', 'omniverse' ), 'single_product' ),
			'description' => esc_html__( 'Shows the current discount relative to the product quantity', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sp-icons/sp-dynamic-discounts.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
					'group'      => esc_html__( 'Style', 'omniverse' ),
				),

				array(
					'heading'          => esc_html__( 'Price color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'price_color',
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'selectors'        => array(
						'{{WRAPPER}}.wd-dynamic-discounts .amount' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				// Price typography.
				$price_typography['font_family'],
				$price_typography['font_size'],
				$price_typography['font_weight'],
				$price_typography['text_transform'],
				$price_typography['font_style'],
				$price_typography['line_height'],

				array(
					'heading'          => esc_html__( 'Discount color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'discount_color',
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'selectors'        => array(
						'{{WRAPPER}}.wd-dynamic-discounts tr td:last-child' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				// Discount typography.
				$discount_typography['font_family'],
				$discount_typography['font_size'],
				$discount_typography['font_weight'],
				$discount_typography['text_transform'],
				$discount_typography['font_style'],
				$discount_typography['line_height'],
				// Design options.
				array(
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'group'      => esc_html__( 'Design Options', 'omniverse' ),
					'type'       => 'css_editor',
					'param_name' => 'css',
				),
				omniverse_get_vc_responsive_spacing_map(),
			),
		);
	}
}
