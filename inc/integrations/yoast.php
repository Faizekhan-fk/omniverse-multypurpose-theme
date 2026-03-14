<?php
/**
 * Yoast.
 *
 * @package omniverse
 */

if ( ! function_exists( 'YoastSEO' ) ) {
	return;
}

add_action( 'category_description', 'omniverse_page_css_files_disable', 9 );
add_action( 'term_description', 'omniverse_page_css_files_disable', 9 );

add_action( 'category_description', 'omniverse_page_css_files_enable', 11 );
add_action( 'term_description', 'omniverse_page_css_files_enable', 11 );

if ( ! function_exists( 'omniverse_layout_post_type_filter' ) ) {
	/**
	 * Exclude omniverse layout from Optimize SEO.
	 *
	 * @param array $post_types Post type.
	 * @return mixed
	 */
	function omniverse_layout_post_type_filter( $post_types ) {
		if ( isset( $post_types['omniverse_layout'] ) ) {
			unset( $post_types['omniverse_layout'] );
		}

		return $post_types;
	}

	add_filter( 'wpseo_accessible_post_types', 'omniverse_layout_post_type_filter' );
}

if ( ! function_exists( 'omniverse_indexable_excluded_post_types' ) ) {
	/**
	 * Exclude omniverse layout from Optimize SEO.
	 *
	 * @param array $post_types Post type.
	 * @return mixed
	 */
	function omniverse_indexable_excluded_post_types( $post_types ) {
		$post_types[] = 'omniverse_layout';

		return $post_types;
	}

	add_filter( 'wpseo_indexable_excluded_post_types', 'omniverse_indexable_excluded_post_types' );
}
