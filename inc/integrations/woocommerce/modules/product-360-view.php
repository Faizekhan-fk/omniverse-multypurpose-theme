<?php if ( ! defined('OMNIVERSE_THEME_DIR')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------------------------------
 * Add 360 product view images option
 * ------------------------------------------------------------------------------------------------
 */

if( ! function_exists( 'omniverse_360_metabox_output' ) ) {
	function omniverse_360_metabox_output( $post ) {
		?>
		<div id="product_360_images_container">
			<ul class="product_360_images">
				<?php
					$product_image_gallery = array();

					if ( metadata_exists( 'post', $post->ID, '_product_360_image_gallery' ) ) {
						$product_image_gallery = get_post_meta( $post->ID, '_product_360_image_gallery', true );
					} else {
						// Backwards compat
						$attachment_ids = get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids&meta_key=_woocommerce_360_image&meta_value=1' );
						$attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id() ) );
						$product_image_gallery = implode( ',', $attachment_ids );
					}

					$attachments         = array_filter( explode( ',', $product_image_gallery ) );
					$update_meta         = false;
					$updated_gallery_ids = array();

					if ( ! empty( $attachments ) ) {
						foreach ( $attachments as $attachment_id ) {
							$attachment = wp_get_attachment_image( $attachment_id, 'thumbnail' );

							// if attachment is empty skip
							if ( empty( $attachment ) ) {
								$update_meta = true;
								continue;
							}

							echo '<li class="image" data-attachment_id="' . esc_attr( $attachment_id ) . '">
								' . $attachment . '
								<ul class="actions">
									<li><a href="#" rel="nofollow" class="delete tips" data-tip="' . esc_html__( 'Delete image', 'omniverse' ) . '">' . esc_html__( 'Delete', 'omniverse' ) . '</a></li>
								</ul>
							</li>';

							// rebuild ids to be saved
							$updated_gallery_ids[] = $attachment_id;
						}

						// need to update product meta to set new gallery ids
						if ( $update_meta ) {
							update_post_meta( $post->ID, '_product_360_image_gallery', implode( ',', $updated_gallery_ids ) );
						}
					}
				?>
			</ul>

			<input type="hidden" id="product_360_image_gallery" name="product_360_image_gallery" value="<?php echo esc_attr( $product_image_gallery ); ?>" />

		</div>
		<p class="add_product_360_images hide-if-no-js">
			<a href="#" rel="nofollow" data-choose="<?php esc_attr_e( 'Add Images to Product 360 view Gallery', 'omniverse' ); ?>" data-update="<?php esc_attr_e( 'Add to gallery', 'omniverse' ); ?>" data-delete="<?php esc_attr_e( 'Delete image', 'omniverse' ); ?>" data-text="<?php esc_attr_e( 'Delete', 'omniverse' ); ?>"><?php esc_html_e( 'Add product 360 view gallery images', 'omniverse' ); ?></a>
		</p>
		<?php

	}
}


/**
 * ------------------------------------------------------------------------------------------------
 * Save metaboxes
 * ------------------------------------------------------------------------------------------------
 */
if( ! function_exists( 'omniverse_proccess_360_view_metabox' ) ) {
	add_action( 'woocommerce_process_product_meta', 'omniverse_proccess_360_view_metabox', 50, 2 );
	function omniverse_proccess_360_view_metabox( $post_id, $post ) {
		$attachment_ids = isset( $_POST['product_360_image_gallery'] ) ? array_filter( explode( ',', wc_clean( $_POST['product_360_image_gallery'] ) ) ) : array();

		update_post_meta( $post_id, '_product_360_image_gallery', implode( ',', $attachment_ids ) );
	}
}


/**
 * ------------------------------------------------------------------------------------------------
 * Returns the 360 view gallery attachment ids.
 * ------------------------------------------------------------------------------------------------
 */
if( ! function_exists( 'omniverse_get_360_gallery_attachment_ids' ) ) {
	function omniverse_get_360_gallery_attachment_ids() {
		global $post;

		if( ! $post ) return;

		$product_image_gallery = get_post_meta( $post->ID, '_product_360_image_gallery', true);

		return apply_filters( 'woocommerce_product_360_gallery_attachment_ids', array_filter( array_filter( (array) explode( ',', $product_image_gallery ) ), 'wp_attachment_is_image' ) );
	}
}

if( ! function_exists( 'omniverse_product_360_view' ) ) {
	function omniverse_product_360_view() {
		$images = omniverse_get_360_gallery_attachment_ids();
		if( empty( $images ) ) return;

		$id = rand(100,999);

		$title = '';

		omniverse_enqueue_js_library( 'threesixty' );
		omniverse_enqueue_js_library( 'magnific' );
		omniverse_enqueue_inline_style( 'mfp-popup' );
		omniverse_enqueue_js_script( 'product-360-button' );
		omniverse_enqueue_inline_style( '360degree' );

		if ( count( $images ) < 1 ) {
			return;
		}
		
		$image_data = wp_get_attachment_image_src( $images[0], 'full' );
		
		$args = [
			'frames_count' => count( $images ),
			'images'       => [],
			'width'        => $image_data[1],
			'height'       => $image_data[2],
		];
		
		foreach ( $images as $key => $image ) {
			$args['images'][] = wp_get_attachment_image_url( $image, 'full' );
		}

		?>
			<div class="product-360-button wd-action-btn wd-gallery-btn wd-style-icon-bg-text">
				<a href="#product-360-view" rel="nofollow"><span><?php esc_html_e('360 product view', 'omniverse'); ?></span></a>
			</div>
			<div id="product-360-view" class="product-360-view-wrapper mfp-hide mfp-with-anim">
				<div class="wd-threed-view wd-product-threed threed-id-<?php echo esc_attr( $id ); ?>" data-args='<?php echo wp_json_encode( $args ); ?>'>
					<?php if ( ! empty( $title ) ): ?>
						<h3 class="threed-title"><span><?php echo wp_kses( $title, omniverse_get_allowed_html() ); ?></span></h3>
					<?php endif ?>
					<ul class="threed-view-images"></ul>
				    <div class="spinner">
				        <span>0%</span>
				    </div>
				</div>
			</div>
		<?php
	}
}
