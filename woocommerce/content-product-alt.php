<?php 
	global $product;


	do_action( 'woocommerce_before_shop_loop_item' ); 
?>

<div class="product-wrapper">
	<div class="product-element-top wd-quick-shop">
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="product-image-link">
			<?php
			/**
			 * Hook woocommerce_before_shop_loop_item_title.
			 *
			 * @hooked omniverse_template_loop_product_thumbnails_gallery - 5
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked omniverse_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
		</a>

		<?php
		if ( ! omniverse_loop_prop( 'grid_gallery' ) || ( ! omniverse_get_opt( 'grid_gallery' ) && empty( omniverse_loop_prop( 'grid_gallery_control', 'hover' ) ) && empty( omniverse_loop_prop( 'grid_gallery_enable_arrows', 'none' ) ) ) ) {
			omniverse_hover_image();
		}
		?>

		<div class="wd-buttons wd-pos-r-t<?php echo omniverse_get_old_classes( ' omniverse-buttons' ); ?>">
			<?php omniverse_add_to_compare_loop_btn(); ?>
			<?php omniverse_quick_view_btn( get_the_ID() ); ?>
			<?php do_action( 'omniverse_product_action_buttons' ); ?>
		</div>
	</div>

	<?php if ( omniverse_loop_prop( 'stretch_product_desktop' ) || omniverse_loop_prop( 'stretch_product_tablet' ) || omniverse_loop_prop( 'stretch_product_mobile' ) ) : ?>
	<div class="product-element-bottom">
	<?php endif; ?>
		<div class="wd-product-header">
			<?php
				/**
				 * woocommerce_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_product_title - 10
				 */
				do_action( 'woocommerce_shop_loop_item_title' );
			?>
			<?php echo wp_kses_post( omniverse_get_product_rating( 'simple', 1 ) ); ?>
		</div>
		<?php
			omniverse_product_categories();
			omniverse_product_brands_links();
			omniverse_product_sku();
			omniverse_stock_status_after_title();
		?>
		<div class="wrap-price">
			<div class="swap-wrapp">
				<div class="swap-elements">
					<?php
						/**
						 * woocommerce_after_shop_loop_item_title hook
						 *
						 * @hooked woocommerce_template_loop_rating - 5
						 * @hooked woocommerce_template_loop_price - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item_title' );
					?>
					<div class="wd-add-btn<?php echo omniverse_get_old_classes( ' omniverse-add-btn' ); ?>">
						<?php do_action( 'omniverse_add_loop_btn' ); ?>
					</div>
				</div>
			</div>
			<?php 
				echo omniverse_swatches_list();
			?>
		</div>

		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

		<?php if ( omniverse_loop_prop( 'progress_bar' ) ): ?>
			<?php omniverse_stock_progress_bar(); ?>
		<?php endif ?>

		<?php if ( omniverse_loop_prop( 'timer' ) ): ?>
			<?php omniverse_product_sale_countdown( array( 'products_hover' => 'alt' ) ); ?>
		<?php endif ?>
	<?php if ( omniverse_loop_prop( 'stretch_product_desktop' ) || omniverse_loop_prop( 'stretch_product_tablet' ) || omniverse_loop_prop( 'stretch_product_mobile' ) ) : ?>
	</div>
	<?php endif; ?>
</div>