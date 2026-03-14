<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$isotope                   = omniverse_loop_prop( 'products_masonry' );
$different_sizes           = omniverse_loop_prop( 'products_different_sizes' );
$categories_design         = omniverse_loop_prop( 'product_categories_design' );
$product_categories_shadow = omniverse_loop_prop( 'product_categories_shadow' );
$product_categories_style  = omniverse_loop_prop( 'product_categories_style' );
$desktop_columns           = omniverse_loop_prop( 'products_columns' );
$tablet_columns            = omniverse_loop_prop( 'products_columns_tablet' );
$mobile_columns            = omniverse_loop_prop( 'products_columns_mobile' );
$classes                   = array();
$hide_product_count        = omniverse_get_opt( 'hide_categories_product_count' );
$grid_different_sizes      = omniverse_loop_prop( 'grid_items_different_sizes' );

if ( $different_sizes ) {
	$isotope = true;
}

// Increase loop count
omniverse_set_loop_prop( 'woocommerce_loop', omniverse_loop_prop( 'woocommerce_loop' ) + 1 );

$woocommerce_loop = omniverse_loop_prop( 'woocommerce_loop' );

$items_wide = omniverse_get_wide_items_array( $different_sizes );

$is_double_size = $different_sizes && in_array( $woocommerce_loop, $items_wide );

omniverse_set_loop_prop( 'double_size', $is_double_size );

if ( 'carousel' !== $product_categories_style ) {
	$classes[] = 'wd-col';

	if ( $is_double_size || $grid_different_sizes && in_array( $woocommerce_loop, $grid_different_sizes ) ) {
		$classes[] = 'wd-wider';
	}
}

if ( omniverse_loop_prop( 'old_structure' ) ) {
	$classes[] = 'category-grid-item';
} else {
	$classes[] = 'wd-cat';
}

$classes[]      = 'cat-design-' . $categories_design;
$sub_categories = '';

if ( $product_categories_shadow != 'disable' && ( $categories_design == 'alt' || $categories_design == 'default' ) ) {
	$classes[] = 'categories-with-shadow';
}

if ( $hide_product_count ) {
	$classes[] = 'without-product-count';
}

$template = omniverse_is_old_category_structure( $categories_design ) ? 'default' : $categories_design;

if ( omniverse_loop_prop( 'product_categories_is_element' ) && 'inherit' !== omniverse_loop_prop( 'product_categories_design' ) ) {
	if ( ( 'mask-subcat' === omniverse_loop_prop( 'product_categories_design' ) || 'default' === omniverse_loop_prop( 'product_categories_design' ) ) && 'default' !== omniverse_loop_prop( 'product_categories_color_scheme' ) ) {
		$classes[] = 'color-scheme-' . omniverse_loop_prop( 'product_categories_color_scheme' );
	}
} else {
	if ( ( 'mask-subcat' === omniverse_get_opt( 'categories_design' ) || 'default' === omniverse_get_opt( 'categories_design' ) ) && 'default' !== omniverse_get_opt( 'categories_color_scheme' ) ) {
		$classes[] = 'color-scheme-' . omniverse_get_opt( 'categories_color_scheme' );
	}
}

wc_get_template(
	'content-product-cat-' . $template . '.php',
	array(
		'woocommerce_loop'   => $woocommerce_loop,
		'classes'            => $classes,
		'category'           => $category,
		'hide_product_count' => $hide_product_count,
	)
);
