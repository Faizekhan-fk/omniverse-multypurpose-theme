<?php
/**
 * WooCommerce breadcrumb shortcode.
 *
 * @package Omniverse
 */

use DN\Modules\Layouts\Main;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_shortcode_woocommerce_breadcrumb' ) ) {
	/**
	 * WooCommerce breadcrumb shortcode.
	 *
	 * @param array $settings Shortcode attributes.
	 */
	function omniverse_shortcode_woocommerce_breadcrumb( $settings ) {
		$default_settings = array(
			'css'       => '',
			'alignment' => 'left',
			'nowrap_md' => 'no',
		);

		$settings = wp_parse_args( $settings, $default_settings );

		$wrapper_classes = apply_filters( 'vc_shortcodes_css_class', '', '', $settings );

		if ( $settings['css'] ) {
			$wrapper_classes .= ' ' . vc_shortcode_custom_css_class( $settings['css'] );
		}

		if ( 'yes' === $settings['nowrap_md'] ) {
			$wrapper_classes .= ' wd-nowrap-md';
		}

		$wrapper_classes .= ' text-' . omniverse_vc_get_control_data( $settings['alignment'], 'desktop' );

		ob_start();

		Main::setup_preview();

		if ( 'yes' === $settings['nowrap_md'] ) {
			omniverse_enqueue_inline_style( 'woo-el-breadcrumbs-builder' );
		}

		?>
		<div class="wd-single-breadcrumbs wd-breadcrumbs wd-wpb<?php echo esc_attr( $wrapper_classes ); ?>">
			<?php omniverse_current_breadcrumbs( 'shop' ); ?>
		</div>
		<?php

		Main::restore_preview();

		return ob_get_clean();
	}
}
