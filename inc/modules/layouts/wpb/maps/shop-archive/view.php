<?php
/**
 * View map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_shop_archive_view' ) ) {
	/**
	 * View map.
	 */
	function omniverse_get_vc_map_shop_archive_view() {
		return array(
			'base'        => 'omniverse_shop_archive_view',
			'name'        => esc_html__( 'Products view', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Products archive', 'omniverse' ), 'shop_archive' ),
			'description' => esc_html__( 'Product columns switcher', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sa-icons/sa-product-view.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),

				array(
					'heading'          => esc_html__( 'Products columns', 'omniverse' ),
					'type'             => 'wd_select',
					'param_name'       => 'products_columns_variations',
					'style'            => 'select2',
					'multiple'         => true,
					'selectors'        => array(),
					'devices'          => array(
						'desktop' => array(
							'value' => array( 2, 3, 4 ),
						),
					),
					'value'            => array(
						esc_html__( '2', 'omniverse' ) => '2',
						esc_html__( '3', 'omniverse' ) => '3',
						esc_html__( '4', 'omniverse' ) => '4',
						esc_html__( '5', 'omniverse' ) => '5',
						esc_html__( '6', 'omniverse' ) => '6',
						esc_html__( 'List', 'omniverse' ) => 'list',
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

				/**
				 * Advanced Tab.
				 */
				omniverse_get_vc_responsive_visible_map( 'responsive_tabs_hide' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_desktop' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_tablet' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_mobile' ),

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
