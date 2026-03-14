<?php
/**
 * Content shortcode.
 *
 * @package Omniverse
 */

use DN\Modules\Layouts\Main;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_shortcode_single_product_extra_content' ) ) {
	/**
	 * Single product content shortcode.
	 *
	 * @param array $settings Shortcode attributes.
	 */
	function omniverse_shortcode_single_product_extra_content( $settings ) {
		$default_settings = array(
			'css' => '',
		);

		$settings = wp_parse_args( $settings, $default_settings );

		$wrapper_classes = apply_filters( 'vc_shortcodes_css_class', '', '', $settings );

		if ( $settings['css'] ) {
			$wrapper_classes .= ' ' . vc_shortcode_custom_css_class( $settings['css'] );
		}

		ob_start();

		Main::setup_preview();

		$shortcode_id = get_post_meta( get_the_ID(), '_omniverse_extra_content', true );

		if ( ! $shortcode_id ) {
			return '';
		}

		?>
		<div class="wd-single-ex-content wd-wpb<?php echo esc_attr( $wrapper_classes ); ?>">
			<?php echo omniverse_html_block_shortcode( array( 'id' => $shortcode_id ) ); // phpcs:ignore ?>
		</div>
		<?php

		Main::restore_preview();

		return ob_get_clean();
	}
}
