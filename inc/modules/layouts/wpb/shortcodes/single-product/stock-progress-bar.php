<?php
/**
 * Stock progress bar shortcode.
 *
 * @package Omniverse
 */

use DN\Modules\Layouts\Main;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_shortcode_single_product_stock_progress_bar' ) ) {
	/**
	 * Stock progress bar shortcode.
	 *
	 * @param array $settings Shortcode attributes.
	 */
	function omniverse_shortcode_single_product_stock_progress_bar( $settings ) {
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

		if ( ! get_post_meta( get_the_ID(), 'omniverse_total_stock_quantity', true ) || 0 >= round( (int) get_post_meta( get_the_ID(), '_stock', true ) ) ) {
			return '';
		}

		?>
		<div class="wd-single-stock-bar wd-wpb<?php echo esc_attr( $wrapper_classes ); ?>">
			<?php omniverse_stock_progress_bar(); ?>
		</div>
		<?php

		Main::restore_preview();

		return ob_get_clean();
	}
}
