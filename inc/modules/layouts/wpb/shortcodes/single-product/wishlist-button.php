<?php
/**
 * Wishlist button shortcode.
 *
 * @package Omniverse
 */

use DN\Modules\Layouts\Main;
use DN\WC_Wishlist\Ui;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_shortcode_single_product_wishlist_button' ) ) {
	/**
	 * Wishlist button shortcode.
	 *
	 * @param array $settings Shortcode attributes.
	 */
	function omniverse_shortcode_single_product_wishlist_button( $settings ) {
		$default_settings = array(
			'alignment' => 'left',
			'css'       => '',
			'style'     => 'text',
		);

		$settings = wp_parse_args( $settings, $default_settings );

		if ( ! omniverse_get_opt( 'wishlist' ) || ! is_user_logged_in() && omniverse_get_opt( 'wishlist_logged' ) ) {
			return '';
		}

		if ( 'icon' === $settings['style'] ) {
			omniverse_enqueue_js_library( 'tooltips' );
			omniverse_enqueue_js_script( 'btns-tooltips' );
		}

		$wrapper_classes = apply_filters( 'vc_shortcodes_css_class', '', '', $settings );

		if ( $settings['css'] ) {
			$wrapper_classes .= ' ' . vc_shortcode_custom_css_class( $settings['css'] );
		}

		$wrapper_classes .= ' text-' . omniverse_vc_get_control_data( $settings['alignment'], 'desktop' );

		$classes  = 'wd-action-btn wd-wishlist-icon';
		$classes .= ' wd-style-' . $settings['style'];

		ob_start();

		Main::setup_preview();

		?>
		<div class="wd-single-action-btn wd-single-wishlist-btn wd-wpb<?php echo esc_attr( $wrapper_classes ); ?>">
			<?php Ui::get_instance()->add_to_wishlist_btn( $classes ); ?>
		</div>
		<?php

		Main::restore_preview();

		return ob_get_clean();
	}
}
