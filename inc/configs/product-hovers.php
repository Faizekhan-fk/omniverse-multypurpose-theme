<?php if ( ! defined('OMNIVERSE_THEME_DIR')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------------------------------
 * Products hover effects
 * ------------------------------------------------------------------------------------------------
 */

return apply_filters( 'omniverse_get_product_hovers', array(
    'info-alt' => array(
        'title' => esc_html__( 'Full info on hover', 'omniverse' ),
        'img' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/info-alt.jpg',
    ),
    'info' => array(
        'title' => esc_html__( 'Full info on image', 'omniverse' ),
        'img' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/info.jpg',
    ),
    'alt' => array(
        'title' => esc_html__( 'Icons and "add to cart" on hover', 'omniverse' ),
        'img' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/alt.jpg',
    ),
    'icons' => array(
        'title' => esc_html__( 'Icons on hover', 'omniverse' ),
        'img' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/icons.jpg',
    ),
    'quick' => array(
        'title' => esc_html__( 'Quick', 'omniverse' ),
        'img' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/quick.jpg',
    ),
    'button' => array(
        'title' => esc_html__( 'Show button on hover on image', 'omniverse' ),
        'img' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/button.jpg',
    ),
    'base' => array(
        'title' => esc_html__( 'Show summary on hover', 'omniverse' ),
        'img' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/base.jpg',
    ),
    'standard' => array(
        'title' => esc_html__( 'Standard button', 'omniverse' ),
        'img' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/standard.jpg',
    ),
    'tiled' => array(
        'title' => esc_html__( 'Tiled', 'omniverse' ),
        'img' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/tiled.jpg',
    ),
	'fw-button' => array(
		'title' => esc_html__( 'Full width button', 'omniverse' ),
		'img' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/fw-button.jpg',
	),
) );