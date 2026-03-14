<?php
/**
 * Add to cart map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_single_product_add_to_cart' ) ) {
	/**
	 * Content map.
	 */
	function omniverse_get_vc_map_single_product_add_to_cart() {
		$button_typography = omniverse_get_typography_map(
			array(
				'key'      => 'button',
				'selector' => '{{WRAPPER}} .single_add_to_cart_button',
			)
		);

		$main_price_typography = omniverse_get_typography_map(
			array(
				'key'           => 'main_price',
				'selector'      => '{{WRAPPER}} .price',
				'group'         => esc_html__( 'Style', 'omniverse' ),
				'wd_dependency' => array(
					'element' => 'price_style_tabs',
					'value'   => array( 'main_price' ),
				),
			)
		);

		$old_price_typography = omniverse_get_typography_map(
			array(
				'key'           => 'old_price',
				'selector'      => '{{WRAPPER}} .price del, {{WRAPPER}} del .amount',
				'group'         => esc_html__( 'Style', 'omniverse' ),
				'wd_dependency' => array(
					'element' => 'price_style_tabs',
					'value'   => array( 'old_price' ),
				),
			)
		);

		$suffix_typography = omniverse_get_typography_map(
			array(
				'key'           => 'suffix',
				'selector'      => '{{WRAPPER}} .woocommerce-price-suffix',
				'group'         => esc_html__( 'Style', 'omniverse' ),
				'wd_dependency' => array(
					'element' => 'price_style_tabs',
					'value'   => array( 'suffix' ),
				),
			)
		);

		return array(
			'base'        => 'omniverse_single_product_add_to_cart',
			'name'        => esc_html__( 'Product add to cart', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Single product elements', 'omniverse' ), 'single_product' ),
			'description' => esc_html__( 'Add to cart form and button', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sp-icons/sp-add-to-cart.svg',
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

				// Button.
				array(
					'title'      => esc_html__( 'Button', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'button_style_divider',
				),

				array(
					'heading'          => esc_html__( 'Design', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'button_design',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Full width button', 'omniverse' ) => 'full',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				$button_typography['font_family'],
				$button_typography['font_size'],
				$button_typography['font_weight'],
				$button_typography['text_transform'],
				$button_typography['font_style'],
				$button_typography['line_height'],

				// Variable product.
				array(
					'title'      => esc_html__( 'Variable product', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'variable_product_style_divider',
				),

				array(
					'heading'          => esc_html__( 'Design', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'design',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Justify', 'omniverse' ) => 'justify',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Swatches layout', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'swatch_layout',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Inline', 'omniverse' ) => 'inline',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Clear button position', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_select',
					'param_name'       => 'reset_button_position',
					'style'            => 'select',
					'selectors'        => array(),
					'devices'          => array(
						'desktop' => array(
							'value' => 'side',
						),
						'mobile'  => array(
							'value' => 'side',
						),
					),
					'value'            => array(
						esc_html__( 'Side', 'omniverse' ) => 'side',
						esc_html__( 'Bottom', 'omniverse' ) => 'bottom',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Swatch label position', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_select',
					'param_name'       => 'label_position',
					'style'            => 'select',
					'selectors'        => array(),
					'devices'          => array(
						'desktop' => array(
							'value' => 'side',
						),
						'mobile'  => array(
							'value' => 'side',
						),
					),
					'value'            => array(
						esc_html__( 'Side', 'omniverse' ) => 'side',
						esc_html__( 'Top', 'omniverse' )  => 'top',
						esc_html__( 'Hide', 'omniverse' ) => 'hide',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				// Price.
				array(
					'title'      => esc_html__( 'Price', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'price_style_divider',
				),

				array(
					'heading'          => '',
					'group'            => esc_html__( 'Style', 'omniverse' ),
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

				$main_price_typography['font_family'],
				$main_price_typography['font_size'],
				$main_price_typography['font_weight'],
				$main_price_typography['text_transform'],
				$main_price_typography['font_style'],
				$main_price_typography['line_height'],

				array(
					'heading'          => esc_html__( 'Text color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
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

				$old_price_typography['font_family'],
				$old_price_typography['font_size'],
				$old_price_typography['font_weight'],
				$old_price_typography['text_transform'],
				$old_price_typography['font_style'],
				$old_price_typography['line_height'],

				array(
					'heading'          => esc_html__( 'Text color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
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

				$suffix_typography['font_family'],
				$suffix_typography['font_size'],
				$suffix_typography['font_weight'],
				$suffix_typography['text_transform'],
				$suffix_typography['font_style'],
				$suffix_typography['line_height'],

				array(
					'heading'          => esc_html__( 'Text color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
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

				// Stock status.
				array(
					'title'      => esc_html__( 'Stock status', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'stock_status_style_divider',
				),

				array(
					'heading'     => esc_html__( 'Enable stock status', 'omniverse' ),
					'group'       => esc_html__( 'Style', 'omniverse' ),
					'type'        => 'omniverse_switch',
					'param_name'  => 'enable_stock_status',
					'hint'        => esc_html__( 'If "NO" stock status will be removed.', 'omniverse' ),
					'true_state'  => 'yes',
					'false_state' => 'no',
					'default'     => 'yes',
				),

				// Design options.
				array(
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'group'      => esc_html__( 'Design Options', 'omniverse' ),
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

add_filter( 'vc_autocomplete_omniverse_single_product_add_to_cart_product_id_callback', 'omniverse_productIdAutocompleteSuggester_new', 10, 1 );
add_filter( 'vc_autocomplete_omniverse_single_product_add_to_cart_product_id_render', 'omniverse_productIdAutocompleteRender', 10, 1 );
