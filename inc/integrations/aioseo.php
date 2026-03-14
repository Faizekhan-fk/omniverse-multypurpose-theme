<?php
/**
 * AIOSEO.
 *
 * @package omniverse
 */

if ( ! function_exists( 'aioseo' ) ) {
	return;
}

add_action( 'wp_head', 'omniverse_page_css_files_disable', 0 );
add_action( 'wp_head', 'omniverse_page_css_files_enable', 2 );