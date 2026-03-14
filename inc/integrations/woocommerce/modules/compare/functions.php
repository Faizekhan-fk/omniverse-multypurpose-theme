<?php
/**
 * Compare helpers functions.
 *
 * @package omniverse
 */

use DN\Modules\Compare;
use DN\Modules\Compare\Ui;

if ( ! function_exists( 'omniverse_get_compare_page_url' ) ) {
	/**
	 * Get compare page ID.
	 *
	 * @since 3.3
	 */
	function omniverse_get_compare_page_url() {
		$page_id = omniverse_get_opt( 'compare_page' );

		if ( defined( 'ICL_SITEPRESS_VERSION' ) && function_exists( 'wpml_object_id_filter' ) ) {
			$page_id = wpml_object_id_filter( $page_id, 'page', true );
		}

		return get_permalink( $page_id );
	}
}

if ( ! function_exists( 'omniverse_get_compare_count' ) ) {
	/**
	 * Get compare number.
	 */
	function omniverse_get_compare_count() {
		return Compare::get_instance()->get_compare_count();
	}
}

if ( ! function_exists( 'omniverse_add_to_compare_loop_btn' ) ) {
	/**
	 * Add to compare button on loop product.
	 */
	function omniverse_add_to_compare_loop_btn() {
		$classes = '';

		if ( 'buttons-on-hover' === omniverse_loop_prop( 'product_hover' ) && 'list' !== omniverse_loop_prop( 'products_view' )  ) {
			$classes .= ' wd-tooltip';
		}

		if ( omniverse_get_opt( 'compare' ) && omniverse_get_opt( 'compare_on_grid' ) ) {
			Ui::get_instance()->add_to_compare_btn( 'wd-action-btn wd-style-icon wd-compare-icon' . $classes );
		}

		if ( ! class_exists( 'YITH_Woocompare' ) || 'yes' !== get_option( 'yith_woocompare_compare_button_in_products_list' ) ) {
			return;
		}

		global $product;
		$product_id = $product->get_id();

		if ( ! isset( $button_text ) || 'default' === $button_text ) {
			$button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'omniverse' ) );
		}

		?>
		<div class="product-compare-button wd-action-btn wd-style-icon wd-compare-icon<?php echo esc_attr( $classes ); ?>">
			<?php if ( $product_id || ! apply_filters( 'yith_woocompare_remove_compare_link_by_cat', false, $product_id ) ) : ?>
				<a href="<?php echo esc_url( omniverse_compare_add_product_url( $product_id ) ); ?>" class="compare" data-product_id="<?php echo esc_attr( $product_id ); ?>" rel="nofollow noopener">
					<?php echo esc_html( $button_text ); ?>
				</a>
			<?php endif; ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'omniverse_compare_add_product_url' ) ) {
	/**
	 * The URL to add the product into the comparison table YITH.
	 *
	 * @param integer $product_id ID of the product to add.
	 * @return string
	 */
	function omniverse_compare_add_product_url( $product_id ) {
		$url_args = array(
			'action' => 'yith-woocompare-add-product',
			'id'     => $product_id,
		);

		$lang = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : false;
		if ( $lang ) {
			$url_args['lang'] = isset( $_GET['lang'] ) ? $_GET['lang'] : $lang; //phpcs:ignore
		}

		return apply_filters( 'yith_woocompare_add_product_url', esc_url_raw( add_query_arg( $url_args, site_url() ) ), 'yith-woocompare-add-product', $url_args );
	}
}

if ( ! function_exists( 'omniverse_compare_available_fields' ) ) {
	/**
	 * All available fields for Theme Settings sorter option.
	 *
	 * @param bool $new New options.
	 *
	 * @return mixed
	 */
	function omniverse_compare_available_fields() {
		return Compare::get_instance()->compare_available_fields( true );
	}
}
