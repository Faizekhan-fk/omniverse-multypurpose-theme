<?php
/**
 * Stock progress bar map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_single_product_stock_progress_bar' ) ) {
	/**
	 * Stock progress bar map.
	 */
	function omniverse_get_vc_map_single_product_stock_progress_bar() {
		return array(
			'base'        => 'omniverse_single_product_stock_progress_bar',
			'name'        => esc_html__( 'Product stock progress bar', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Single product elements', 'omniverse' ), 'single_product' ),
			'description' => esc_html__( 'Shows number of products left in stock', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sp-icons/sp-stock-progress-bar.svg',
			'params'      => array(
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
				function_exists( 'omniverse_get_vc_responsive_spacing_map' ) ? omniverse_get_vc_responsive_spacing_map() : '',

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
