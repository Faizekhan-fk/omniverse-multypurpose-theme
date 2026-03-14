<?php
/**
 * Page title shortcode.
 *
 * @package Omniverse
 */

use DN\Modules\Layouts\Global_Data as Builder_Data;
use DN\Modules\Layouts\Main;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_shortcode_page_title' ) ) {
	/**
	 * Page title shortcode.
	 *
	 * @param array $settings Shortcode attributes.
	 */
	function omniverse_shortcode_page_title( $settings ) {
		$default_settings = array(
			'css'                => '',
			'enable_title'       => 'yes',
			'enable_breadcrumbs' => 'yes',
			'enable_categories'  => 'yes',
		);

		$settings = wp_parse_args( $settings, $default_settings );

		$wrapper_classes = apply_filters( 'vc_shortcodes_css_class', '', '', $settings );

		if ( $settings['css'] ) {
			$wrapper_classes .= ' ' . vc_shortcode_custom_css_class( $settings['css'] );
		}

		ob_start();

		Builder_Data::get_instance()->set_data( 'builder', true );
		Builder_Data::get_instance()->set_data( 'layout_id', get_the_ID() );

		Main::setup_preview();

		omniverse_enqueue_inline_style( 'el-page-title-builder' );

		if ( is_product_taxonomy() || is_shop() || is_product_category() || is_product_tag() || omniverse_is_product_attribute_archive() ) {
			omniverse_enqueue_inline_style( 'woo-shop-page-title' );

			if ( ! omniverse_get_opt( 'shop_title' ) ) {
				omniverse_enqueue_inline_style( 'woo-shop-opt-without-title' );
			}

			if ( omniverse_get_opt( 'shop_categories' ) ) {
				omniverse_enqueue_inline_style( 'shop-title-categories' );
				omniverse_enqueue_inline_style( 'woo-categories-loop-nav-mobile-accordion' );
			}
		}

		?>
		<div class="wd-page-title-el wd-wpb<?php echo esc_attr( $wrapper_classes ); ?>">
			<?php omniverse_page_title(); ?>
		</div>
		<?php

		Main::restore_preview();

		return ob_get_clean();
	}
}
