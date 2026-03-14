<?php
/**
 * Imagify.
 *
 * @package Omniverse
 */

if ( ! defined( 'IMAGIFY_VERSION' ) ) {
	return;
}

if ( ! function_exists( 'omniverse_single_product_gallery_images_webp' ) ) {
	/**
	 * Single product change class with webp.
	 *
	 * @param string $class CSS Class.
	 *
	 * @return string
	 */
	function omniverse_single_product_gallery_images_webp( $class ) {
		$class .= ' imagify-no-webp';

		return $class;
	}

	add_filter( 'omniverse_single_product_gallery_image_class', 'omniverse_single_product_gallery_images_webp' );
}
