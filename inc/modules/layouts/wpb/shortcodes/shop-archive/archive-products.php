<?php
/**
 * Archive products shortcode.
 *
 * @package Omniverse
 */

use DN\Modules\Layouts\Global_Data;
use DN\Modules\Layouts\Main;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_shortcode_shop_archive_products' ) ) {
	/**
	 * Archive products shortcode.
	 *
	 * @param array $settings Shortcode attributes.
	 */
	function omniverse_shortcode_shop_archive_products( $settings ) {
		$default_settings = array(
			'css'                          => '',
			'img_size'                     => '',
			'products_view'                => 'inherit',
			'products_columns'             => 'inherit',
			'products_spacing'             => 'inherit',
			'shop_pagination'              => 'inherit',
			'product_hover'                => 'inherit',
			'products_bordered_grid'       => 'inherit',
			'products_bordered_grid_style' => 'inherit',
			'products_color_scheme'        => 'inherit',
			'products_with_background'     => 'inherit',
			'products_shadow'              => 'inherit',
		);

		$settings = wp_parse_args( $settings, $default_settings );

		if ( 'yes' === $settings['products_with_background'] ) {
			$products_with_background = '1';
		} else if ( 'no' === $settings['products_with_background'] ) {
			$products_with_background = '0';
		}

		if ( 'yes' === $settings['products_shadow'] ) {
			$products_shadow = '1';
		} else if ( 'no' === $settings['products_shadow'] ) {
			$products_shadow = '0';
		}

		$wrapper_classes = apply_filters( 'vc_shortcodes_css_class', '', '', $settings );

		if ( $settings['css'] ) {
			$wrapper_classes .= ' ' . vc_shortcode_custom_css_class( $settings['css'] );
		}

		if ( 'inherit' !== $settings['products_view'] ) {
			omniverse_set_loop_prop( 'products_view', omniverse_new_get_shop_view( $settings['products_view'], true ) );
		}

		$products_columns = omniverse_vc_get_control_data( $settings['products_columns'], 'desktop' );
		if ( 'inherit' !== $products_columns ) {
			omniverse_set_loop_prop( 'products_columns', omniverse_new_get_products_columns_per_row( $products_columns, true ) );
		}

		$products_columns_tablet = omniverse_vc_get_control_data( $settings['products_columns'], 'tablet' );
		if ( 'inherit' !== $products_columns_tablet ) {
			omniverse_set_loop_prop( 'products_columns_tablet', $products_columns_tablet );
		}

		$products_columns_mobile = omniverse_vc_get_control_data( $settings['products_columns'], 'mobile' );
		if ( 'inherit' !== $products_columns_mobile ) {
			omniverse_set_loop_prop( 'products_columns_mobile', $products_columns_mobile );
		}

		$products_spacing = omniverse_vc_get_control_data( $settings['products_spacing'], 'desktop' );
		if ( 'inherit' !== $products_spacing ) {
			omniverse_set_loop_prop( 'products_spacing', $products_spacing );
		}

		$products_spacing_tablet = omniverse_vc_get_control_data( $settings['products_spacing'], 'tablet' );
		if ( $products_spacing_tablet && 'inherit' !== $products_spacing_tablet ) {
			omniverse_set_loop_prop( 'products_spacing_tablet', $products_spacing_tablet );
		}

		$products_spacing_mobile = omniverse_vc_get_control_data( $settings['products_spacing'], 'mobile' );
		if ( $products_spacing_mobile && 'inherit' !== $products_spacing_mobile ) {
			omniverse_set_loop_prop( 'products_spacing_mobile', $products_spacing_mobile );
		}

		if ( 'inherit' !== $settings['product_hover'] ) {
			omniverse_set_loop_prop( 'product_hover', $settings['product_hover'] );
		}

		if ( 'inherit' !== $settings['shop_pagination'] ) {
			Global_Data::get_instance()->set_data( 'shop_pagination', $settings['shop_pagination'] );
		}

		if ( 'inherit' !== $settings['products_bordered_grid'] ) {
			omniverse_set_loop_prop( 'products_bordered_grid', $settings['products_bordered_grid'] );
		}

		if ( 'inherit' !== $settings['products_bordered_grid_style'] ) {
			omniverse_set_loop_prop( 'products_bordered_grid_style', $settings['products_bordered_grid_style'] );
		}

		if ( $settings['img_size'] ) {
			omniverse_set_loop_prop( 'img_size', $settings['img_size'] );
		}

		if ( $settings['products_color_scheme'] && 'inherit' !== $settings['products_color_scheme'] ) {
			omniverse_set_loop_prop( 'products_color_scheme', $settings['products_color_scheme'] );
		}

		if ( isset( $products_with_background ) ) {
			omniverse_set_loop_prop( 'products_with_background', $products_with_background );
		}

		if ( isset( $products_shadow ) ) {
			omniverse_set_loop_prop( 'products_shadow', $products_shadow );
		}

		ob_start();

		Main::setup_preview();

		?>
		<div class="wd-shop-product wd-products-element wd-wpb<?php echo esc_attr( $wrapper_classes ); ?>">
			<?php omniverse_sticky_loader( ' wd-content-loader' ); ?>
			<?php do_action( 'omniverse_woocommerce_main_loop' ); ?>
		</div>
		<?php

		Main::restore_preview();

		return ob_get_clean();
	}
}
