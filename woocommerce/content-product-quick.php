<?php 
	global $product;


	do_action( 'woocommerce_before_shop_loop_item' ); 
?>

<div class="product-wrapper">
	<div class="product-element-top wd-quick-shop">
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="product-image-link">
			<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked omniverse_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
		</a>

		<?php
		if ( 'no' === omniverse_loop_prop( 'grid_gallery' ) || ! omniverse_loop_prop( 'grid_gallery' ) ) {
			omniverse_hover_image();
		}
		?>
		<div class="wd-buttons wd-pos-r-t<?php echo omniverse_get_old_classes( ' omniverse-buttons' ); ?>">
			<?php omniverse_enqueue_js_script( 'btns-tooltip' ); ?>
			<?php omniverse_add_to_compare_loop_btn(); ?>
			<?php omniverse_quick_view_btn( get_the_ID() ); ?>
			<?php do_action( 'omniverse_product_action_buttons' ); ?>
		</div>

		<?php if ( has_action( 'omniverse_add_loop_btn' ) ) : ?>
			<div class="wd-add-btn wd-add-btn-replace<?php echo omniverse_get_old_classes( ' omniverse-add-btn' ); ?>">
				<?php if ( omniverse_loop_prop( 'product_quantity' )): ?>
					<?php omniverse_product_quantity( $product ); ?>
				<?php endif ?>

				<?php do_action( 'omniverse_add_loop_btn' ); ?>
				<?php echo omniverse_get_thumbnails_gallery_pagin(); ?>
			</div>
		<?php else : ?>
			<?php echo omniverse_get_thumbnails_gallery_pagin(); ?>
		<?php endif; ?>
	</div>
	<?php if ( omniverse_loop_prop( 'stretch_product_desktop' ) || omniverse_loop_prop( 'stretch_product_tablet' ) || omniverse_loop_prop( 'stretch_product_mobile' ) ) : ?>
	<div class="product-element-bottom">
	<?php endif; ?>
	<?php 
		echo omniverse_swatches_list();
	?>
	<?php
		/**
		 * woocommerce_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );
	?>

	<?php
		omniverse_product_categories();
		omniverse_product_brands_links();
		omniverse_product_sku();
		omniverse_stock_status_after_title();
	?>
	<?php if ( 0 < $product->get_average_rating() || omniverse_get_opt( 'show_empty_star_rating' ) ) : ?>
		<?php echo wp_kses_post( omniverse_get_product_rating() ); ?>
	<?php endif; ?>
	<?php
		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
	?>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

	<?php if ( omniverse_loop_prop( 'progress_bar' ) ): ?>
		<?php omniverse_stock_progress_bar(); ?>
	<?php endif ?>

	<?php if ( omniverse_loop_prop( 'timer' ) ): ?>
		<?php omniverse_product_sale_countdown( array( 'products_hover' => 'quick' ) ); ?>
	<?php endif ?>
	<?php if ( omniverse_loop_prop( 'stretch_product_desktop' ) || omniverse_loop_prop( 'stretch_product_tablet' ) || omniverse_loop_prop( 'stretch_product_mobile' ) ) : ?>
	</div>
	<?php endif; ?>
</div>
