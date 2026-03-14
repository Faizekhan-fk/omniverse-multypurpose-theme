<?php
/**
 * Order by map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_shop_archive_orderby' ) ) {
	/**
	 * Order by map.
	 */
	function omniverse_get_vc_map_shop_archive_orderby() {
		return array(
			'base'        => 'omniverse_shop_archive_orderby',
			'name'        => esc_html__( 'Order by', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Products archive', 'omniverse' ), 'shop_archive' ),
			'description' => esc_html__( 'WooCommerce order by dropdown', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sa-icons/sa-order-by.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),

				array(
					'heading'          => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'style',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Underline', 'omniverse' )  => 'underline',
					),
					'std'              => 'default',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Icon on mobile', 'omniverse' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'mobile_icon',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
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
