<?php
/**
 * Enqueue script and styles for child theme
 */
function omniverse_child_enqueue_styles() {
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'omniverse-style' ), omniverse_get_theme_info( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'omniverse_child_enqueue_styles', 10010 );
