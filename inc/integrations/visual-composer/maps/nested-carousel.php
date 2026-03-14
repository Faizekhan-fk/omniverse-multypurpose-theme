<?php
/**
 * Nested carousel map.
 *
 * @package Elements
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_get_vc_map_nested_carousel' ) ) {
	/**
	 * Displays the shortcode settings fields in the admin.
	 */
	function omniverse_get_vc_map_nested_carousel() {
		return array(
			'base'            => 'omniverse_nested_carousel',
			'name'            => esc_html__( 'Nested carousel', 'omniverse' ),
			'description'     => esc_html__( 'Custom carousel that can contain other elements', 'omniverse' ),
			'category'        => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/carousel.svg',
			'as_parent'       => array( 'only' => 'omniverse_nested_carousel_item' ),
			'content_element' => true,
			'is_container'    => true,
			'js_view'         => 'VcColumnView',
			'params'          => array(
				array(
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'omniverse_css_id',
					'type'       => 'omniverse_css_id',
				),
				/**
				 * Carousel
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Carousel', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'carousel_divider',
				),
				/**
				 * Design Options.
				 */
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				function_exists( 'omniverse_get_vc_responsive_spacing_map' ) ? omniverse_get_vc_responsive_spacing_map() : '',
			),
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_nested_carousel_item' ) ) {
	/**
	 * Displays the shortcode settings fields in the admin.
	 */
	function omniverse_get_vc_map_nested_carousel_item() {
		return array(
			'base'            => 'omniverse_nested_carousel_item',
			'name'            => esc_html__( 'Nested carousel item', 'omniverse' ),
			'description'     => esc_html__( 'Custom carousel item', 'omniverse' ),
			'category'        => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/carousel-item.svg',
			'as_child'        => array( 'only' => 'omniverse_nested_carousel' ),
			'content_element' => true,
			'is_container'    => true,
			'js_view'         => 'VcColumnView',
			'params'          => array(
				/**
				 * Settings.
				 */
				array(
					'type'        => 'wd_notice',
					'param_name'  => 'notice',
					'notice_type' => 'info',
					'value'       => esc_html__( 'This element have not options', 'omniverse' ),
				),
			),
		);
	}
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	/**
	 * Create omniverse nested carousel wrapper.
	 */
	class WPBakeryShortCode_omniverse_nested_carousel extends WPBakeryShortCodesContainer {} // phpcs:ignore.

	/**
	 * Create omniverse nested carousel item.
	 */
	class WPBakeryShortCode_omniverse_nested_carousel_item extends WPBakeryShortCodesContainer {} // phpcs:ignore.
}
