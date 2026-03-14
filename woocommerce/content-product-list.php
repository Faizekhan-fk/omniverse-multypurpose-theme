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
				<?php omniverse_quick_view_btn( get_the_ID() ); ?>
				<?php omniverse_add_to_compare_loop_btn(); ?>
				<?php do_action( 'omniverse_product_action_buttons' ); ?>
			</div>
		</div>

		<div class="product-list-content wd-scroll">
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
			?>
			<?php echo wp_kses_post( omniverse_get_product_rating() ); ?>
			<?php omniverse_stock_status_after_title(); ?>
			<?php woocommerce_template_loop_price(); ?>
			<?php
				echo omniverse_swatches_list();
			?>
			<?php
			if ( omniverse_get_opt( 'base_hover_content' ) == 'additional_info' ) {
				wc_display_product_attributes( $product );
			} else {
				woocommerce_template_single_excerpt();
			}
			?>
			<?php omniverse_swatches_list(); ?>

			<?php if ( omniverse_loop_prop( 'progress_bar' ) ) : ?>
				<?php omniverse_stock_progress_bar(); ?>
			<?php endif ?>

			<?php if ( omniverse_loop_prop( 'timer' ) ) : ?>
				<?php omniverse_product_sale_countdown(); ?>
			<?php endif ?>

			<div class="wd-add-btn wd-add-btn-replace<?php echo omniverse_get_old_classes( ' omniverse-add-btn' ); ?>">
				<?php if ( omniverse_loop_prop( 'product_quantity' ) ): ?>
					<?php omniverse_product_quantity( $product ); ?>
				<?php endif ?>

				<?php do_action( 'omniverse_add_loop_btn' ); ?>
			</div>

			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
		</div>
	</div>
