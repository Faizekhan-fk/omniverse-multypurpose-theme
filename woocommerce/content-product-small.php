<?php
/**
 * Render file for 'Small' product design.
 * Products(grid or carousel) element.
 *
 * @package Omniverse
 */

global $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

?>

<?php do_action( 'omniverse_before_shop_loop_thumbnail' ); ?>


<div class="product-wrapper">
	<div class="product-element-top">
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="product-image-link">
			<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
		</a>
	</div>

	<div class="product-element-bottom">
	<?php
		do_action( 'woocommerce_shop_loop_item_title' );
		echo wp_kses_post( omniverse_get_product_rating() );
		do_action( 'woocommerce_after_shop_loop_item_title' );
	?>
	</div>
</div>

