<?php
/**
 * WooCommerce notices map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_woocommerce_notices' ) ) {
	/**
	 * WooCommerce notices map.
	 */
	function omniverse_get_vc_map_woocommerce_notices() {
		return array(
			'base'        => 'omniverse_woocommerce_notices',
			'name'        => esc_html__( 'WooCommerce notices', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'WooCommerce', 'omniverse' ) ),
			'description' => esc_html__( 'WooCommerce notices area', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sp-icons/sp-notices.svg',
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
