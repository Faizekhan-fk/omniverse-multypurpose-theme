<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

/**
 * ------------------------------------------------------------------------------------------------
 * Function returns quick view of the product by ID
 * ------------------------------------------------------------------------------------------------
 */

if( ! function_exists( 'omniverse_quick_view' ) ) {
	function omniverse_quick_view($id = false) {
		if( isset($_GET['id']) ) {
			$id = sanitize_text_field( (int) $_GET['id'] );
		}
		if( ! $id || ! omniverse_woocommerce_installed() ) {
			return;
		}

		if ( class_exists('WPBMap') ) {
			WPBMap::addAllMappedShortcodes();
		}

		global $post, $product;


		$args = apply_filters(
			'omniverse_quick_view_posts_args',
			array(
				'post__in'  => array( $id ),
				'post_type' => array( 'product', 'product_variation' ),
			)
		);

		$quick_posts = get_posts( $args );

		$quick_view_variable = omniverse_get_opt( 'quick_view_variable' );
		$quick_view_layout   = ( omniverse_get_opt( 'quick_view_layout' ) ) ? omniverse_get_opt( 'quick_view_layout' ) : 'horizontal';

		omniverse_enqueue_inline_style( 'woo-opt-quick-view' );
		omniverse_enqueue_inline_style( 'woo-single-prod-el-gallery' );
		omniverse_enqueue_inline_style( 'woo-single-prod-el-base' );
		omniverse_enqueue_inline_style( 'woo-single-prod-and-quick-view-predefined' );
		omniverse_enqueue_inline_style( 'woo-mod-stock-status' );
		omniverse_enqueue_inline_style( 'woo-mod-quantity' );

		echo '<div class="mfp-with-anim wd-popup popup-quick-view wd-close-btn-inset">';

		foreach( $quick_posts as $post ) :
			setup_postdata($post);
			$product = wc_get_product($post);
        	remove_action( 'woocommerce_single_product_summary', 'omniverse_before_compare_button', 33 );
        	remove_action( 'woocommerce_single_product_summary', 'omniverse_add_to_compare_single_btn', 33 );
			remove_action( 'woocommerce_single_product_summary', 'omniverse_after_compare_button', 37 );

			if ( omniverse_get_opt( 'attr_after_short_desc' ) ) {
				add_action( 'woocommerce_single_product_summary', 'omniverse_display_product_attributes', 21 );
				add_filter( 'woocommerce_product_tabs', 'omniverse_single_product_remove_additional_information_tab', 98 );
			}

			// Remove wishlist.
			if ( class_exists( 'DN\WC_Wishlist\UI' ) ) {
				remove_action( 'woocommerce_single_product_summary', array( DN\WC_Wishlist\UI::get_instance(), 'add_to_wishlist_single_btn' ), 33 );
			}

			// Remove compare.
			if ( class_exists( 'DN\Modules\Compare\UI' ) ) {
				remove_action( 'woocommerce_single_product_summary', array( DN\Modules\Compare\UI::get_instance(), 'add_to_compare_single_btn' ), 33 );
			}

			//Remove before and after add to cart button text
			remove_action( 'woocommerce_single_product_summary', 'omniverse_before_add_to_cart_area', 25 );
			remove_action( 'woocommerce_single_product_summary', 'omniverse_after_add_to_cart_area', 31 );

        	remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );

        	// Add brand image
        	add_action( 'woocommerce_single_product_summary', 'omniverse_product_brand', 8 );

        	// Disable add to cart button for catalog mode
			if( omniverse_get_opt( 'catalog_mode' ) ) {
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
			} elseif( ! $quick_view_variable ) {
				// If no needs to show variations
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
				add_action( 'woocommerce_single_product_summary', 'woocommerce_template_loop_add_to_cart', 30 );
			}

			if( omniverse_get_opt( 'product_share' ) ) add_action( 'woocommerce_single_product_summary', 'omniverse_product_share_buttons', 45 );
			get_template_part('woocommerce/content', 'quick-view-' . $quick_view_layout );
		endforeach;

		echo '</div>';

		wp_reset_postdata();

		die();
	}

	add_action( 'wp_ajax_omniverse_quick_view', 'omniverse_quick_view' );
	add_action( 'wp_ajax_nopriv_omniverse_quick_view', 'omniverse_quick_view' );

}

if( ! function_exists( 'omniverse_product_images_slider' ) ) {
	function omniverse_product_images_slider() {
		wc_get_template( 'quick-view/product-images.php' );
	}
}

if( ! function_exists( 'omniverse_quick_view_btn' ) ) {
	function omniverse_quick_view_btn( $id = false ) {
		if ( ! omniverse_get_opt( 'quick_view' ) ) {
			return;
		}

		if ( ! $id ) {
			$id = get_the_ID();
		}

		$classes        = '';
		$data_attribute = '';

		if ( 'buttons-on-hover' === omniverse_loop_prop( 'product_hover' ) && 'list' !== omniverse_loop_prop( 'products_view' ) ) {
			$classes .= ' wd-tooltip';
		}

		$classes .= omniverse_get_old_classes( ' wd-quick-view-btn' );

		if ( omniverse_get_opt( 'show_single_variation' ) ) {
			$product = wc_get_product( $id );

			if ( $product->get_parent_id() ) {
				$data_attribute = 'data-attribute=\'' . wp_json_encode( $product->get_variation_attributes(), true ) . '\'';
			}
		}

		omniverse_enqueue_js_library( 'swiper' );
		omniverse_enqueue_js_script( 'swiper-carousel' );

		omniverse_enqueue_js_library( 'magnific' );
		omniverse_enqueue_inline_style( 'mfp-popup' );
		omniverse_enqueue_js_script( 'product-images-gallery' );
		omniverse_enqueue_js_script( 'quick-view' );
		omniverse_enqueue_js_library( 'tooltips' );
		omniverse_enqueue_js_script( 'btns-tooltips' );
		omniverse_enqueue_js_script( 'swatches-variations' );
		omniverse_enqueue_js_script( 'add-to-cart-all-types' );
		omniverse_enqueue_js_script( 'woocommerce-quantity' );
		wp_enqueue_script( 'wc-add-to-cart-variation' );
		wp_enqueue_script( 'imagesloaded' );

		if ( omniverse_get_opt( 'single_product_swatches_limit' ) ) {
			omniverse_enqueue_js_script( 'swatches-limit' );
		}

		?>
		<div class="quick-view wd-action-btn wd-style-icon wd-quick-view-icon<?php echo esc_attr( $classes ); ?>">
			<a
				href="<?php echo esc_url( get_the_permalink( $id ) ); ?>"
				class="open-quick-view quick-view-button"
				rel="nofollow"
				data-id="<?php echo esc_attr( $id ); ?>"
				<?php echo wp_kses( $data_attribute, true ); ?>><?php esc_html_e( 'Quick view', 'omniverse' ); ?></a>
		</div>
		<?php
	}
}
