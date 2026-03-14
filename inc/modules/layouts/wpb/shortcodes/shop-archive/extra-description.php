<?php
/**
 * Archive description shortcode.
 *
 * @package Omniverse
 */

use DN\Modules\Layouts\Main;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_shortcode_shop_category_extra_description' ) ) {
	/**
	 * Archive description shortcode.
	 *
	 * @param array $settings Shortcode attributes.
	 */
	function omniverse_shortcode_shop_category_extra_description( $settings ) {
		$default_settings = array(
			'alignment' => 'left',
			'css'       => '',
		);

		$settings = wp_parse_args( $settings, $default_settings );

		$wrapper_classes = apply_filters( 'vc_shortcodes_css_class', '', '', $settings );

		if ( $settings['css'] ) {
			$wrapper_classes .= ' ' . vc_shortcode_custom_css_class( $settings['css'] );
		}

		$wrapper_classes .= ' text-' . omniverse_vc_get_control_data( $settings['alignment'], 'desktop' );

		ob_start();

		Main::setup_preview();

		?>
		<div class="wd-shop-desc wd-wpb<?php echo esc_attr( $wrapper_classes ); ?>"><?php // Must be in one line.
			omniverse_get_extra_description_category();
			?></div>
		<?php

		Main::restore_preview();

		return ob_get_clean();
	}
}
