<?php
/**
 * View shortcode.
 *
 * @package Omniverse
 */

use DN\Modules\Layouts\Main;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_shortcode_shop_archive_view' ) ) {
	/**
	 * View shortcode.
	 *
	 * @param array $settings Shortcode attributes.
	 */
	function omniverse_shortcode_shop_archive_view( $settings ) {
		$default_settings = array(
			'css'                         => '',
			'products_columns_variations' => array( 2, 3, 4 ),
		);

		$settings = wp_parse_args( $settings, $default_settings );

		$wrapper_classes = apply_filters( 'vc_shortcodes_css_class', '', '', $settings );

		if ( $settings['css'] ) {
			$wrapper_classes .= ' ' . vc_shortcode_custom_css_class( $settings['css'] );
		}

		$settings['products_view']    = omniverse_new_get_shop_view( '', true );
		$settings['products_columns'] = omniverse_new_get_products_columns_per_row( '', true );

		if ( ! is_array( $settings['products_columns_variations'] ) ) {
			$settings['products_columns_variations'] = omniverse_vc_get_control_data( $settings['products_columns_variations'], 'desktop' );
		}

		ob_start();

		Main::setup_preview();

		omniverse_enqueue_inline_style( 'woo-shop-el-products-view' );
		?>
		<div class="wd-shop-view wd-wpb<?php echo esc_attr( $wrapper_classes ); ?>">
			<?php omniverse_products_view_select( false, $settings ); ?>
		</div>
		<?php

		Main::restore_preview();

		return ob_get_clean();
	}
}
