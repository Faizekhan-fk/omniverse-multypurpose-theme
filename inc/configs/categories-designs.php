<?php if ( ! defined('OMNIVERSE_THEME_DIR')) exit('No direct script access allowed');

/**
 * -------------------------------------------------------------------------------
 * Designs for categories
 * -----------------------------------------------------------------------------
 */

return apply_filters( 'omniverse_get_categories_designs', array(
	'default' => array(
		'title' => esc_html__( 'Default', 'omniverse' ),
		'img' => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/default.jpg',
	),
	'alt' => array(
        'title' => esc_html__( 'Alternative', 'omniverse' ),
        'img' => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/alt.jpg',
	),
	'center' => array(
        'title' => esc_html__( 'Center title', 'omniverse' ),
        'img' => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/center.jpg',
	),
	'replace-title' => array(
        'title' => esc_html__( 'Replace title', 'omniverse' ),
        'img' => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/replace-title.jpg',
    ),
) );