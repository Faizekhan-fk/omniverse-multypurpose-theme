<?php
/**
 * Product Loop Start
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.3.0
 */

use DN\Modules\Layouts\Global_Data;
use DN\Modules\Layouts\Main;

$class        = '';
$current_view = omniverse_loop_prop( 'products_view' );
$is_slider    = omniverse_loop_prop( 'is_slider' );
$is_shortcode = omniverse_loop_prop( 'is_shortcode' );
$shop_view    = omniverse_get_opt( 'shop_view' );
$is_builder   = Main::get_instance()->has_custom_layout( 'shop_archive' );
$attributes   = '';

if ( ( 'grid' === $shop_view || 'list' === $shop_view ) && ! $is_builder ) {
	$current_view = $shop_view;
}

if ( $is_slider ) {
	$current_view = 'grid';
}

if ( $is_shortcode ) {
	$current_view = omniverse_loop_prop( 'products_view' );
}

if ( omniverse_loop_prop( 'products_masonry' ) ) {
	$class .= ' grid-masonry';
	wp_enqueue_script( 'imagesloaded' );
	omniverse_enqueue_js_library( 'isotope-bundle' );
	omniverse_enqueue_js_script( 'shop-masonry' );
}

if ( omniverse_loop_prop( 'products_masonry' ) || omniverse_loop_prop( 'products_different_sizes' ) ) {
	$class .= ' wd-grid-f-col';
} else {
	$class .= ' wd-grid-g';
}

if ( 'list' === $current_view ) {
	$class .= ' elements-list';
} else {
	$class .= ' grid-columns-' . omniverse_loop_prop( 'products_columns' );
	$class .= ' elements-grid';
}

if ( ( omniverse_loop_prop( 'products_bordered_grid' ) || 'enable' === omniverse_loop_prop( 'products_bordered_grid' ) ) && 'disable' !== omniverse_loop_prop( 'products_bordered_grid' ) ) {
	omniverse_enqueue_inline_style( 'bordered-product' );

	if ( 'outside' === omniverse_loop_prop( 'products_bordered_grid_style' ) ) {
		$class .= ' products-bordered-grid';
	} elseif ( 'inside' === omniverse_loop_prop( 'products_bordered_grid_style' ) ) {
		$class .= ' products-bordered-grid-ins';
	}
}

if ( omniverse_get_opt( 'quick_shop_variable' ) ) {
	if ( 'variation_form' === omniverse_get_opt( 'quick_shop_variable_type', 'select_options' ) ) {
		omniverse_enqueue_js_script( 'quick-shop-with-form' );
	} else {
		omniverse_enqueue_js_script( 'quick-shop' );
		omniverse_enqueue_js_script( 'swatches-variations' );
	}

	omniverse_enqueue_js_script( 'add-to-cart-all-types' );
	wp_enqueue_script( 'wc-add-to-cart-variation' );
}

if ( omniverse_get_opt( 'product_quantity' ) ) {
	$class .= ' wd-quantity-enabled';
}

if ( Global_Data::get_instance()->get_data( 'shop_pagination' ) ) {
	$pagination_type = Global_Data::get_instance()->get_data( 'shop_pagination' );
} else {
	$pagination_type = omniverse_get_opt( 'shop_pagination' );
}

if ( $pagination_type ) {
	$class .= ' pagination-' . $pagination_type;
}

if ( 'none' !== omniverse_get_opt( 'product_title_lines_limit' ) && 'list' !== $current_view ) {
	omniverse_enqueue_inline_style( 'woo-opt-title-limit' );
	$class .= ' title-line-' . omniverse_get_opt( 'product_title_lines_limit' );
}

// fix for price filter ajax
$min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : '';
$max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : '';

$product_design    = omniverse_loop_prop( 'product_hover' );
$categories_design = omniverse_loop_prop( 'product_categories_design' );

if ( 'list' === $current_view ) {
	$product_design = 'list';
}

if ( omniverse_is_old_category_structure( $categories_design ) ) {
	omniverse_set_loop_prop( 'old_structure', true );
}

omniverse_enqueue_product_loop_styles( $product_design );
if ( 'alt' !== $categories_design && 'inherit' !== $categories_design ) {
	omniverse_enqueue_inline_style( 'categories-loop-' . $categories_design );
}

if ( 'center' === $categories_design ) {
	omniverse_enqueue_inline_style( 'categories-loop-center' );
}

if ( 'replace-title' === $categories_design ) {
	omniverse_enqueue_inline_style( 'categories-loop-replace-title' );
}

if ( 'mask-subcat' === $categories_design ) {
	omniverse_enqueue_inline_style( 'woo-categories-loop-mask-subcat' );
}

if ( 'zoom-out' === $categories_design ) {
	omniverse_enqueue_inline_style( 'woo-categories-loop-zoom-out' );
}

if ( omniverse_loop_prop( 'old_structure' ) ) {
	omniverse_enqueue_inline_style( 'categories-loop' );
} else {
	omniverse_enqueue_inline_style( 'woo-categories-loop' );
}

if ( ( omniverse_loop_prop( 'stretch_product_desktop' ) || omniverse_loop_prop( 'stretch_product_tablet' ) || omniverse_loop_prop( 'stretch_product_mobile' ) ) && in_array( $product_design, array( 'icons', 'alt', 'button', 'standard', 'tiled', 'quick', 'base', 'fw-button', 'buttons-on-hover' ), true ) ) {
	omniverse_enqueue_inline_style( 'woo-opt-stretch-cont' );
	if ( omniverse_loop_prop( 'stretch_product_desktop' ) ) {
		$class .= ' wd-stretch-cont-lg';
	}
	if ( omniverse_loop_prop( 'stretch_product_tablet' ) ) {
		$class .= ' wd-stretch-cont-md';
	}
	if ( omniverse_loop_prop( 'stretch_product_mobile' ) ) {
		$class .= ' wd-stretch-cont-sm';
	}
}

if ( 'default' !== omniverse_loop_prop( 'products_color_scheme', 'default' ) && ( omniverse_loop_prop( 'products_bordered_grid' ) || 'enable' === omniverse_loop_prop( 'products_bordered_grid' ) ) && 'disable' !== omniverse_loop_prop( 'products_bordered_grid' ) && 'outside' === omniverse_loop_prop( 'products_bordered_grid_style' ) ) {
	$class .= ' wd-bordered-' . omniverse_loop_prop( 'products_color_scheme' );
}

if ( omniverse_loop_prop( 'products_with_background' ) ) {
	omniverse_enqueue_inline_style( 'woo-opt-products-bg' );

	$class .= ' wd-products-with-bg';
}

if ( omniverse_loop_prop( 'products_shadow' ) ) {
	omniverse_enqueue_inline_style( 'woo-opt-products-shadow' );

	$class .= ' wd-products-with-shadow';
}

if ( ! empty( $GLOBALS['omniverse_loop'] ) && $is_builder && ( 'more-btn' === $pagination_type || 'infinit' === $pagination_type ) ) {
	$loop_settings = array();
	$attr_keys     = array( 'img_size', 'img_size_custom', 'products_view', 'products_columns', 'products_columns_tablet', 'products_columns_mobile', 'products_spacing', 'products_spacing_tablet', 'products_spacing_mobile', 'product_hover', 'products_bordered_grid', 'products_bordered_grid_style', 'products_color_scheme', 'products_with_background', 'products_shadow' );

	foreach ( $attr_keys as $key ) {
		$value = omniverse_loop_prop( $key );

		$loop_settings[ $key ] = is_bool( $value ) ? (int) $value : $value;
	}

	if ( $loop_settings ) {
		$attributes .= ' data-atts=\'' . wp_json_encode( $loop_settings ) . '\'';
	}
}

if ( 'grid' === $current_view ) {
	$attributes .= ' style="' . omniverse_get_grid_attrs(
		array(
			'columns'        => omniverse_loop_prop( 'products_columns' ),
			'columns_tablet' => omniverse_loop_prop( 'products_columns_tablet' ),
			'columns_mobile' => omniverse_loop_prop( 'products_columns_mobile' ),
			'spacing'        => omniverse_loop_prop( 'products_spacing' ),
			'spacing_tablet' => omniverse_loop_prop( 'products_spacing_tablet' ),
			'spacing_mobile' => omniverse_loop_prop( 'products_spacing_mobile' ),
		)
	) . '"';
} else {
	$attributes .= ' style="' . omniverse_get_grid_attrs(
		array(
			'columns'        => 1,
			'columns_tablet' => 1,
			'columns_mobile' => 1,
		)
	) . '"';
}
?>
<?php if ( ! $is_builder ) : ?>
	<?php omniverse_sticky_loader( ' wd-content-loader' ); ?>
<?php endif; ?>

<div class="products wd-products<?php echo esc_attr( $class ); ?>" data-source="main_loop" data-min_price="<?php echo esc_attr( $min_price ); ?>" data-max_price="<?php echo esc_attr( $max_price ); ?>" data-columns="<?php echo esc_attr( omniverse_loop_prop( 'products_columns' ) ); ?>"<?php echo wp_kses( $attributes, true ); ?>>
