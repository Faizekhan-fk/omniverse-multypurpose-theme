<?php
/**
 * Sidebar map.
 *
 * @package Omniverse
 */

use DN\Modules\Layouts\Main;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}
if ( ! function_exists( 'omniverse_get_vc_map_sidebar' ) ) {
	/**
	 * Sidebar map.
	 */
	function omniverse_get_vc_map_sidebar() {
		return array(
			'base'        => 'omniverse_sidebar',
			'name'        => esc_html__( 'Sidebar', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Shows any sidebar with widgets', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sa-icons/sa-sidebar.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),

				array(
					'heading'          => esc_html__( 'Choose Sidebar', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'sidebar_name',
					'value'            => omniverse_get_sidebars_for_builder_in_shop_page(),
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

if ( ! function_exists( 'omniverse_get_sidebars_for_builder_in_shop_page' ) ) {
	/**
	 * Get all sidebars for shop page builder.
	 *
	 * @return array
	 */
	function omniverse_get_sidebars_for_builder_in_shop_page() {
		global $wp_registered_sidebars;

		$options = array();

		if ( ! $wp_registered_sidebars ) {
			$options[ esc_html__( 'No sidebars were found', 'omniverse' ) ] = '';
		} else {
			$options[ esc_html__( 'Choose Sidebar', 'omniverse' ) ] = '';

			foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
				$options[ $sidebar['name'] ] = $sidebar_id;
			}
		}

		return $options;
	}
}
