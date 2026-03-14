<?php
/**
 * Archive products map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_shop_archive_products' ) ) {
	/**
	 * Archive products map.
	 */
	function omniverse_get_vc_map_shop_archive_products() {
		return array(
			'base'        => 'omniverse_shop_archive_products',
			'name'        => esc_html__( 'Archive products', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Products archive', 'omniverse' ), 'shop_archive' ),
			'description' => esc_html__( 'Show WooCommerce product grid', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sa-icons/sa-archive-products.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),

				array(
					'heading'          => esc_html__( 'Products view', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'products_view',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Grid', 'omniverse' ) => 'grid',
						esc_html__( 'List', 'omniverse' ) => 'list',
					),
					'std'              => 'inherit',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Products columns', 'omniverse' ),
					'hint'             => esc_html__( 'How many products you want to show per row.', 'omniverse' ),
					'type'             => 'wd_select',
					'param_name'       => 'products_columns',
					'style'            => 'select',
					'selectors'        => array(),
					'devices'          => array(
						'desktop' => array(
							'value' => 'inherit',
						),
						'tablet'  => array(
							'value' => 'inherit',
						),
						'mobile'  => array(
							'value' => 'inherit',
						),
					),
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( '1', 'omniverse' ) => '1',
						esc_html__( '2', 'omniverse' ) => '2',
						esc_html__( '3', 'omniverse' ) => '3',
						esc_html__( '4', 'omniverse' ) => '4',
						esc_html__( '5', 'omniverse' ) => '5',
						esc_html__( '6', 'omniverse' ) => '6',
					),
					'dependency'       => array(
						'element'            => 'products_view',
						'value_not_equal_to' => 'list',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Space between products', 'omniverse' ),
					'hint'             => esc_html__( 'You can set different spacing between blocks on shop page.', 'omniverse' ),
					'type'             => 'wd_select',
					'param_name'       => 'products_spacing',
					'style'            => 'select',
					'selectors'        => array(),
					'devices'          => array(
						'desktop' => array(
							'value' => 'inherit',
						),
						'tablet'  => array(
							'value' => 'inherit',
						),
						'mobile'  => array(
							'value' => 'inherit',
						),
					),
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( '0', 'omniverse' )  => '0',
						esc_html__( '2', 'omniverse' )  => '2',
						esc_html__( '6', 'omniverse' )  => '6',
						esc_html__( '10', 'omniverse' ) => '10',
						esc_html__( '20', 'omniverse' ) => '20',
						esc_html__( '30', 'omniverse' ) => '30',
					),
					'dependency'       => array(
						'element'            => 'products_view',
						'value_not_equal_to' => 'list',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Products pagination', 'omniverse' ),
					'hint'             => esc_html__( 'Choose a type for the pagination on your shop page.', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'shop_pagination',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' )    => 'inherit',
						esc_html__( 'Pagination', 'omniverse' ) => 'pagination',
						__( '"Load more" button', 'omniverse' ) => 'more-btn',
						esc_html__( 'Infinite scrolling', 'omniverse' ) => 'infinit',
					),
					'std'              => 'inherit',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'      => esc_html__( 'Hover on product', 'omniverse' ),
					'group'        => esc_html__( 'Design', 'omniverse' ),
					'hint'         => esc_html__( 'Choose one of those hover effects for products', 'omniverse' ),
					'type'         => 'omniverse_image_select',
					'param_name'   => 'product_hover',
					'value'        => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Full info on hover', 'omniverse' ) => 'info-alt',
						esc_html__( 'Full info on image', 'omniverse' ) => 'info',
						esc_html__( 'Icons and "add to cart" on hover', 'omniverse' ) => 'alt',
						esc_html__( 'Icons on hover', 'omniverse' ) => 'icons',
						esc_html__( 'Quick', 'omniverse' ) => 'quick',
						esc_html__( 'Show button on hover on image', 'omniverse' ) => 'button',
						esc_html__( 'Show summary on hover', 'omniverse' ) => 'base',
						esc_html__( 'Standard button', 'omniverse' ) => 'standard',
						esc_html__( 'Tiled', 'omniverse' ) => 'tiled',
						esc_html__( 'Full width button', 'omniverse' ) => 'fw-button',
						esc_html__( 'Buttons on hover', 'omniverse' ) => 'buttons-on-hover',
					),
					'images_value' => array(
						'inherit'          => OMNIVERSE_ASSETS_IMAGES . '/settings/empty.jpg',
						'info-alt'         => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/info-alt.jpg',
						'info'             => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/info.jpg',
						'alt'              => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/alt.jpg',
						'icons'            => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/icons.jpg',
						'quick'            => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/quick.jpg',
						'button'           => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/button.jpg',
						'base'             => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/base.jpg',
						'standard'         => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/standard.jpg',
						'tiled'            => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/tiled.jpg',
						'fw-button'        => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/fw-button.jpg',
						'buttons-on-hover' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/buttons-on-hover.jpg',
					),
					'dependency'   => array(
						'element'            => 'products_view',
						'value_not_equal_to' => 'list',
					),
				),

				array(
					'heading'          => esc_html__( 'Images size', 'omniverse' ),
					'group'            => esc_html__( 'Design', 'omniverse' ),
					'type'             => 'textfield',
					'param_name'       => 'img_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'    => esc_html__( 'Products color scheme', 'omniverse' ),
					'group'      => esc_html__( 'Design', 'omniverse' ),
					'type'       => 'dropdown',
					'param_name' => 'products_color_scheme',
					'std'        => 'inherit',
					'value'      => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Dark', 'omniverse' )  => 'dark',
						esc_html__( 'Light', 'omniverse' ) => 'light',
					),
				),

				array(
					'heading'          => esc_html__( 'Bordered grid', 'omniverse' ),
					'group'            => esc_html__( 'Design', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'products_bordered_grid',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Enable', 'omniverse' ) => 'enable',
						esc_html__( 'Disable', 'omniverse' ) => 'disable',
					),
					'std'              => 'inherit',
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),

				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Bordered grid style', 'omniverse' ),
					'param_name'       => 'products_bordered_grid_style',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Outside', 'omniverse' ) => 'outside',
						esc_html__( 'Inside', 'omniverse' ) => 'inside',
					),
					'std'              => 'inherit',
					'group'            => esc_html__( 'Design', 'omniverse' ),
					'dependency'       => array(
						'element' => 'products_bordered_grid',
						'value'   => 'enable',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'    => esc_html__( 'Products background', 'omniverse' ),
					'hint'       => esc_html__( 'Add a background to the products in your grid.', 'omniverse' ),
					'group'      => esc_html__( 'Design', 'omniverse' ),
					'type'       => 'dropdown',
					'param_name' => 'products_with_background',
					'std'        => 'inherit',
					'value'      => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Yes', 'omniverse' ) => 'yes',
						esc_html__( 'No', 'omniverse' )  => 'no',
					),
				),

				array(
					'heading'    => esc_html__( 'Custom products background color', 'omniverse' ),
					'hint'       => esc_html__( 'Set custom background color for products.', 'omniverse' ),
					'group'      => esc_html__( 'Design', 'omniverse' ),
					'type'       => 'wd_colorpicker',
					'param_name' => 'products_background',
					'selectors'  => array(
						'{{WRAPPER}} .wd-products-with-bg, {{WRAPPER}}.wd-products-with-bg, {{WRAPPER}} .wd-products-with-bg .wd-product, {{WRAPPER}}.wd-products-with-bg .wd-product' => array(
							'--wd-prod-bg:{{VALUE}}; --wd-bordered-bg:{{VALUE}};',
						),
					),
					'dependency' => array(
						'element' => 'products_with_background',
						'value'   => array( 'yes' ),
					),
				),

				array(
					'heading'    => esc_html__( 'Products shadow', 'omniverse' ),
					'hint'       => esc_html__( 'Add a shadow to products if the initial product style did not have one.', 'omniverse' ),
					'group'      => esc_html__( 'Design', 'omniverse' ),
					'type'       => 'dropdown',
					'param_name' => 'products_shadow',
					'default'    => 'inherit',
					'value'      => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Yes', 'omniverse' ) => 'yes',
						esc_html__( 'No', 'omniverse' )  => 'no',
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
