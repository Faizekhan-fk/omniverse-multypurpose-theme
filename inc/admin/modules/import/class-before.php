<?php
/**
 * Import before.
 *
 * @package Omniverse
 */

namespace DN\Admin\Modules\Import;

use DN\Singleton;

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

/**
 * Import before.
 */
class Before extends Singleton {
	private $business_type;
	/**
	 * Init.
	 */
	public function init($business_type = null) {
		$this->remove_shop_page();
		$this->import_attributes($business_type);
	}

	/**
	 * Import.
	 */
	private function import_attributes($business_type = null) {		
		
		if ( get_option( 'omniverse_import_attributes' ) ) {
			return;
		}

		$attrs = array(
			'color' => array(
				'name'         => 'Color',
				'slug'         => 'color',
				'has_archives' => false,
			),
			'brand' => array(
				'name'         => 'Brand',
				'slug'         => 'brand',
				'has_archives' => false,
			),
			'size'  => array(
				'name'         => 'Size',
				'slug'         => 'size',
				'has_archives' => false,
			),
		);

		foreach ( $attrs as $attr ) {
			wc_create_attribute(
				array(
					'name'         => $attr['name'],
					'slug'         => $attr['slug'],
					'type'         => 'select',
					'order_by'     => 'menu_order',
					'has_archives' => $attr['has_archives'],
				)
			);

			register_taxonomy(
				'pa_' . $attr['slug'],
				'product',
				array(
					'labels' => array(
						'name' => $attr['name'],
					),
				)
			);
		}

		flush_rewrite_rules();
		wp_cache_flush();
		delete_transient( 'wc_attribute_taxonomies' );

		update_option( 'omniverse_import_attributes', 'imported', false );
	}

	/**
	 * Remove default shop page
	 *
	 * @return void
	 */
	private function remove_shop_page() {
		$shop_page_id = get_option( 'woocommerce_shop_page_id' );

		if ( $shop_page_id ) {
			wp_delete_post( $shop_page_id, true );
		}
	}
}
