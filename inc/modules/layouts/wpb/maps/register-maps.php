<?php
/**
 * Register vc elements maps for Omniverse layout.
 *
 * @package Omniverse
 */

use DN\Modules\Layouts\Main;

if ( ! function_exists( 'omniverse_vc_register_layouts_maps' ) ) {
	function omniverse_vc_register_layouts_maps() {
		if ( ! omniverse_is_core_installed() || ! omniverse_woocommerce_installed() ) {
			return;
		}

		$maps = array();

		$cart_maps = array(
			'omniverse_cart_table'  => 'omniverse_get_vc_map_cart_table',
			'omniverse_cart_totals' => 'omniverse_get_vc_map_cart_totals',
		);

		$checkout_form_maps = array(
			'omniverse_checkout_billing_details_form'  => 'omniverse_get_vc_map_checkout_billing_details_form',
			'omniverse_checkout_order_review'          => 'omniverse_get_vc_map_checkout_order_review',
			'omniverse_checkout_payment_methods'       => 'omniverse_get_vc_map_checkout_payment_methods',
			'omniverse_checkout_shipping_details_form' => 'omniverse_get_vc_map_checkout_shipping_details_form',
		);

		$checkout_content_maps = array(
			'omniverse_checkout_coupon_form' => 'omniverse_get_vc_map_checkout_coupon_form',
			'omniverse_checkout_login_form'  => 'omniverse_get_vc_map_checkout_login_form',
		);

		$archive_maps = array(
			'omniverse_shop_archive_active_filters'    => 'omniverse_get_vc_map_archive_active_filters',
			'omniverse_shop_archive_description'       => 'omniverse_get_vc_map_shop_archive_description',
			'omniverse_shop_archive_products'          => 'omniverse_get_vc_map_shop_archive_products',
			'omniverse_shop_archive_extra_description' => 'omniverse_get_vc_map_archive_extra_description',
			'omniverse_shop_archive_filters_area'      => 'omniverse_get_vc_map_shop_archive_filters_area',
			'omniverse_shop_archive_filters_area_btn'  => 'omniverse_get_vc_map_shop_archive_filters_area_btn',
			'omniverse_shop_archive_orderby'           => 'omniverse_get_vc_map_shop_archive_orderby',
			'omniverse_shop_archive_per_page'          => 'omniverse_get_vc_map_shop_archive_per_page',
			'omniverse_shop_archive_result_count'      => 'omniverse_get_vc_map_shop_archive_result_count',
			'omniverse_shop_archive_view'              => 'omniverse_get_vc_map_shop_archive_view',
			'omniverse_shop_archive_woocommerce_title' => 'omniverse_get_vc_map_shop_archive_woocommerce_title',
		);

		$single_product_maps = array(
			'omniverse_single_product_add_to_cart'        => 'omniverse_get_vc_map_single_product_add_to_cart',
			'omniverse_single_product_additional_info_table' => 'omniverse_get_vc_map_single_product_additional_info_table',
			'omniverse_single_product_brand_information'  => 'omniverse_get_vc_map_single_product_brand_information',
			'omniverse_single_product_brands'             => 'omniverse_get_vc_map_single_product_brands',
			'omniverse_single_product_compare_button'     => 'omniverse_get_vc_map_single_product_compare_button',
			'omniverse_single_product_content'            => 'omniverse_get_vc_map_single_product_content',
			'omniverse_single_product_countdown'          => 'omniverse_get_vc_map_single_product_countdown',
			'omniverse_single_product_dynamic_discounts_table' => 'omniverse_get_vc_map_single_product_dynamic_discounts_table',
			'omniverse_single_product_extra_content'      => 'omniverse_get_vc_map_single_product_extra_content',
			'omniverse_single_product_fbt_products'       => 'omniverse_get_vc_map_single_product_fbt_products',
			'omniverse_single_product_gallery'            => 'omniverse_get_vc_map_single_product_gallery',
			'omniverse_single_product_linked_variations'  => 'omniverse_get_vc_map_single_product_linked_variations',
			'omniverse_single_product_meta'               => 'omniverse_get_vc_map_single_product_product_meta',
			'omniverse_single_product_meta_value'         => 'omniverse_get_vc_map_single_product_meta_value',
			'omniverse_single_product_nav'                => 'omniverse_get_vc_map_single_product_nav',
			'omniverse_single_product_price'              => 'omniverse_get_vc_map_single_product_price',
			'omniverse_single_product_rating'             => 'omniverse_get_vc_map_single_product_rating',
			'omniverse_single_product_reviews'            => 'omniverse_get_vc_map_single_product_reviews',
			'omniverse_single_product_short_description'  => 'omniverse_get_vc_map_single_product_short_description',
			'omniverse_single_product_size_guide_button'  => 'omniverse_get_vc_map_single_product_size_guide_button',
			'omniverse_single_product_sold_counter'       => 'omniverse_get_vc_map_single_product_sold_counter',
			'omniverse_single_product_stock_progress_bar' => 'omniverse_get_vc_map_single_product_stock_progress_bar',
			'omniverse_single_product_stock_status'       => 'omniverse_get_vc_map_single_product_stock_status',
			'omniverse_single_product_tabs'               => 'omniverse_get_vc_map_single_product_tabs',
			'omniverse_single_product_title'              => 'omniverse_get_vc_map_single_product_title',
			'omniverse_single_product_visitor_counter'    => 'omniverse_get_vc_map_single_product_visitor_counter',
			'omniverse_single_product_wishlist_button'    => 'omniverse_get_vc_map_single_product_wishlist_button',
		);

		$woocommerce_maps = array(
			'omniverse_woocommerce_breadcrumb' => 'omniverse_get_vc_map_woocommerce_breadcrumb',
			'omniverse_woocommerce_hook'       => 'omniverse_get_vc_map_woocommerce_hook',
			'omniverse_woocommerce_notices'    => 'omniverse_get_vc_map_woocommerce_notices',
			'omniverse_page_title'             => 'omniverse_get_vc_map_page_title',
			'omniverse_shipping_progress_bar'  => 'omniverse_get_vc_map_shipping_progress_bar',
		);

		if ( Main::is_layout_type( 'shop_archive' ) ) {
			$maps = array_merge( $maps, $archive_maps );
		}

		if ( Main::is_layout_type( 'single_product' ) ) {
			$maps = array_merge( $maps, $single_product_maps );
		}

		if ( Main::is_layout_type( 'cart' ) ) {
			$maps = array_merge( $maps, $cart_maps );
		}

		if ( Main::is_layout_type( 'checkout_form' ) ) {
			$maps = array_merge( $maps, $checkout_form_maps );
		}

		if ( Main::is_layout_type( 'checkout_content' ) ) {
			$maps = array_merge( $maps, $checkout_content_maps );
		}

		if ( Main::is_layout_type( 'checkout_form' ) || Main::is_layout_type( 'cart' ) || Main::is_layout_type( 'checkout_content' ) ) {
			$maps = array_merge( $maps, array( 'omniverse_woocommerce_checkout_steps' => 'omniverse_get_vc_map_checkout_steps' ) );
		}

		$maps = array_merge( $maps, $woocommerce_maps );

		foreach ( $maps as $key => $callback ) {
			omniverse_vc_map( $key, $callback );
		}
	}

	add_action( 'vc_mapper_init_after', 'omniverse_vc_register_layouts_maps', 11 );
}
