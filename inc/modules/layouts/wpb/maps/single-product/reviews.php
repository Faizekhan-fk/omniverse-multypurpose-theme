<?php
/**
 * Reviews map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_single_product_reviews' ) ) {
	/**
	 * Reviews map.
	 */
	function omniverse_get_vc_map_single_product_reviews() {
		return array(
			'base'        => 'omniverse_single_product_reviews',
			'name'        => esc_html__( 'Product reviews', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Single product elements', 'omniverse' ), 'single_product' ),
			'description' => esc_html__( 'Reviews and review form', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sp-icons/sp-reviews.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),

				array(
					'heading'          => esc_html__( 'Reviews section columns', 'omniverse' ),
					'type'             => 'wd_select',
					'param_name'       => 'layout',
					'style'            => 'select',
					'selectors'        => array(),
					'devices'          => array(
						'desktop' => array(
							'value' => 'one-column',
						),
					),
					'value'            => array(
						esc_html__( 'One column', 'omniverse' ) => 'one-column',
						esc_html__( 'Two columns', 'omniverse' ) => 'two-column',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Reviews columns', 'omniverse' ),
					'type'             => 'wd_select',
					'param_name'       => 'reviews_columns',
					'style'            => 'select',
					'selectors'        => array(),
					'devices'          => array(
						'desktop' => array(
							'value' => '1',
						),
						'tablet'  => array(
							'value' => '1',
						),
						'mobile'  => array(
							'value' => '1',
						),
					),
					'value'            => array(
						esc_html__( '1', 'omniverse' ) => '1',
						esc_html__( '2', 'omniverse' ) => '2',
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
			),
		);
	}
}
