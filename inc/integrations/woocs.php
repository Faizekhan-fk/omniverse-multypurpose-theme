<?php
/**
 * FOX — Currency Switcher Professional for WooCommerce.
 *
 * @package omniverse
 */

if ( ! defined( 'WOOCS_VERSION' ) ) {
	return;
}

if ( ! function_exists( 'omniverse_woocs_convert_product_bundle_in_cart' ) ) {
	/**
	 * Back convector bundle product price.
	 *
	 * @param float  $price Product price.
	 * @param object $cart_item Product cart data.
	 * @return mixed|string
	 */
	function omniverse_woocs_convert_product_bundle_in_cart( $price, $cart_item ) {
		global $WOOCS;

		return $WOOCS->woocs_back_convert_price( $price );
	}

	add_filter( 'omniverse_fbt_set_product_cart_price', 'omniverse_woocs_convert_product_bundle_in_cart', 10, 2 );
	add_filter( 'omniverse_pricing_before_calculate_discounts', 'omniverse_woocs_convert_product_bundle_in_cart', 10, 2 );
}

if ( ! function_exists( 'omniverse_woocs_shipping_progress_bar_amount' ) ) {
	/**
	 * Converse shipping progress bar limit
	 *
	 * @param float $limit
	 * @return float
	 */
	function omniverse_woocs_shipping_progress_bar_amount( $limit ) {
		global $WOOCS;

		$limit *= $WOOCS->get_sign_rate( array( 'sign' => $WOOCS->current_currency ) );

		return $limit;
	}

	add_filter( 'omniverse_fbt_set_product_price_cart', 'omniverse_woocs_shipping_progress_bar_amount' );
	add_filter( 'omniverse_shipping_progress_bar_amount', 'omniverse_woocs_shipping_progress_bar_amount' );
}

if ( ! function_exists( 'omniverse_woocs_convert_price' ) ) {
	/**
	 * Convector bundle product price.
	 *
	 * @param float $price Product price.
	 * @return mixed|string
	 */
	function omniverse_woocs_convert_price( $price ) {
		global $WOOCS; // phpcs:ignore.

		return $WOOCS->woocs_convert_price( $price ); // phpcs:ignore.
	}

	// Discount product price table.
	add_filter( 'omniverse_pricing_amount_discounts_value', 'omniverse_woocs_convert_price', 10, 1 );
}
