<?php
/**
 * Single Product Up-Sells
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$position = omniverse_get_opt( 'upsells_position' );

if ( $upsells && 'hide' !== omniverse_get_opt( 'upsells_position' ) ) : ?>

	<?php if ( 'sidebar' === $position ) : ?>
		<?php omniverse_enqueue_inline_style( 'widget-product-upsells' ); ?>
		<div class="upsells-widget widget sidebar-widget">
			<<?php echo esc_html( omniverse_get_widget_title_tag() ); ?> class="widget-title"><?php echo esc_html__( 'You may also like&hellip;', 'woocommerce' ); ?></<?php echo esc_html( omniverse_get_widget_title_tag() ); ?>>

			<?php omniverse_products_widget_template( $upsells, true ); ?>
		</div>
	<?php else : ?>
		<?php
		$product_ids = array();

		foreach ( $upsells as $upsell_product ) {
			$product_ids[] = $upsell_product->get_id();
		}

		$products_atts = array(
			'element_title'                => esc_html__( 'You may also like&hellip;', 'woocommerce' ),
			'layout'                       => 'slider' === omniverse_get_opt( 'related_product_view' ) ? 'carousel' : 'grid',
			'post_type'                    => 'ids',
			'include'                      => $product_ids,
			'slides_per_view'              => omniverse_get_opt( 'related_product_columns', 4 ),
			'slides_per_view_tablet'       => omniverse_get_opt( 'related_product_columns_tablet' ),
			'slides_per_view_mobile'       => omniverse_get_opt( 'related_product_columns_mobile' ),
			'columns'                      => omniverse_get_opt( 'related_product_columns', 4 ),
			'columns_tablet'               => omniverse_get_opt( 'related_product_columns_tablet' ),
			'columns_mobile'               => omniverse_get_opt( 'related_product_columns_mobile' ),
			'img_size'                     => 'woocommerce_thumbnail',
			'products_bordered_grid'       => omniverse_get_opt( 'products_bordered_grid' ),
			'products_bordered_grid_style' => omniverse_get_opt( 'products_bordered_grid_style' ),
			'products_with_background'     => omniverse_get_opt( 'products_with_background' ),
			'products_shadow'              => omniverse_get_opt( 'products_shadow' ),
			'products_color_scheme'        => omniverse_get_opt( 'products_color_scheme' ),
			'custom_sizes'                 => apply_filters( 'omniverse_product_related_custom_sizes', false ),
			'product_quantity'             => omniverse_get_opt( 'product_quantity' ),
			'spacing'                      => omniverse_get_opt( 'products_spacing' ),
			'spacing_tablet'               => omniverse_get_opt( 'products_spacing_tablet', '' ),
			'spacing_mobile'               => omniverse_get_opt( 'products_spacing_mobile', '' ),
			'wrapper_classes'              => ' upsells-carousel',
		);

		if ( omniverse_is_elementor_installed() ) {
			$products_atts['columns']         = array( 'size' => $products_atts['columns'] );
			$products_atts['slides_per_view'] = array( 'size' => $products_atts['slides_per_view'] );
			echo omniverse_elementor_products_template( $products_atts ); //phpcs:ignore
		} else {
			$products_atts['include'] = implode( ',', $products_atts['include'] );
			echo omniverse_shortcode_products( $products_atts ); //phpcs:ignore
		}
		?>
	<?php endif ?>

	<?php
endif;
