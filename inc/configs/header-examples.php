<?php if ( ! defined("OMNIVERSE_THEME_DIR")) exit("No direct script access allowed");

/**
 * ------------------------------------------------------------------------------------------------
 * Header builder premade example layouts
 * ------------------------------------------------------------------------------------------------
 */

$header_examples = array(
    'empty' => array(
        'name' => 'Empty header',
        'preview' =>  OMNIVERSE_ASSETS_IMAGES . '/header-builder/header-examples/header-empty.png'
    ),
    'advanced' => array(
        'name' => 'Advanced',
        'preview' =>  OMNIVERSE_ASSETS_IMAGES . '/header-builder/header-examples/header-advanced.png'
    ),
    'base' => array(
        'name' => 'Base',
        'preview' =>  OMNIVERSE_ASSETS_IMAGES . '/header-builder/header-examples/header-base.png'
    ),
    'double-menu' => array(
        'name' => 'Double menu',
        'preview' =>  OMNIVERSE_ASSETS_IMAGES . '/header-builder/header-examples/header-double-menu.png'
    ),
    'ecommerce' => array(
        'name' => 'eCommerce',
        'preview' =>  OMNIVERSE_ASSETS_IMAGES . '/header-builder/header-examples/header-ecommerce.png'
    ),
    'logo-center' => array(
        'name' => 'Logo center',
        'preview' =>  OMNIVERSE_ASSETS_IMAGES . '/header-builder/header-examples/header-logo-center.png'
    ),
    'menu-topbar' => array(
        'name' => 'Menu in topbar',
        'preview' =>  OMNIVERSE_ASSETS_IMAGES . '/header-builder/header-examples/header-menu-topbar.png'
    ),
    'simplified' => array(
        'name' => 'Simplified',
        'preview' =>  OMNIVERSE_ASSETS_IMAGES . '/header-builder/header-examples/header-simplified.png'
    ),
    'with-categories' => array(
        'name' => 'With categories menu',
        'preview' =>  OMNIVERSE_ASSETS_IMAGES . '/header-builder/header-examples/header-with-categories.png'
    ),
    'base-dark' => array(
        'name' => 'Base Dark',
        'preview' =>  OMNIVERSE_ASSETS_IMAGES . '/header-builder/header-examples/header-base-dark.png'
    ),
);

return apply_filters( 'omniverse_header_examples', $header_examples );