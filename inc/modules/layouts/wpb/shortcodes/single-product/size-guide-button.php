<?php
/**
 * Size guide button shortcode.
 *
 * @package Omniverse
 */

use DN\Modules\Layouts\Main;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_shortcode_single_product_size_guide_button' ) ) {
	/**
	 * Size guide button shortcode.
	 *
	 * @param array $settings Shortcode attributes.
	 */
	function omniverse_shortcode_single_product_size_guide_button( $settings ) {
		$default_settings = array(
			'alignment' => 'left',
			'css'       => '',
			'style'     => 'text',
		);

		$settings = wp_parse_args( $settings, $default_settings );

		if ( 'icon' === $settings['style'] ) {
			omniverse_enqueue_js_library( 'tooltips' );
			omniverse_enqueue_js_script( 'btns-tooltips' );
		}

		$wrapper_classes = apply_filters( 'vc_shortcodes_css_class', '', '', $settings );

		if ( $settings['css'] ) {
			$wrapper_classes .= ' ' . vc_shortcode_custom_css_class( $settings['css'] );
		}

		$wrapper_classes .= ' text-' . omniverse_vc_get_control_data( $settings['alignment'], 'desktop' );

		$classes = ' wd-style-' . $settings['style'];

		ob_start();

		Main::setup_preview();

		?>
		<div class="wd-single-action-btn wd-single-size-guide-btn wd-wpb<?php echo esc_attr( $wrapper_classes ); ?>"><?php omniverse_sguide_display( false, array( 'builder_classes' => $classes ) ); // Must be in one line. ?></div>
		<?php

		Main::restore_preview();

		return ob_get_clean();
	}
}
