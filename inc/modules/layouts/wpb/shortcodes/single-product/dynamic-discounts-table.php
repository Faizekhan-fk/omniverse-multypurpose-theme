<?php
/**
 * Product price table shortcode.
 *
 * @package Omniverse
 */

use DN\Modules\Layouts\Main;
use DN\Modules\Dynamic_Discounts\Frontend as Dynamic_Discounts_Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_shortcode_single_product_dynamic_discounts_table' ) ) {
	/**
	 * Single product price table shortcode.
	 */
	function omniverse_shortcode_single_product_dynamic_discounts_table( $settings ) {
		$default_settings = array(
			'css' => '',
		);

		if ( ! omniverse_get_opt( 'discounts_enabled', 0 ) ) {
			return '';
		}

		$settings         = wp_parse_args( $settings, $default_settings );
		$wrapper_classes  = apply_filters( 'vc_shortcodes_css_class', '', '', $settings );
		$wrapper_classes .= ' wd-wpb';

		if ( $settings['css'] ) {
			$wrapper_classes .= ' ' . vc_shortcode_custom_css_class( $settings['css'] );
		}
		ob_start();

		Main::setup_preview();

		Dynamic_Discounts_Module::get_instance()->render_dynamic_discounts_table( false, $wrapper_classes );

		Main::restore_preview();

		return ob_get_clean();
	}
}

