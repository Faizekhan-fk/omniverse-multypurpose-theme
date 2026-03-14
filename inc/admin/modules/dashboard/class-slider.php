<?php

namespace DN\Admin\Modules\Dashboard;

use DN\Singleton;

class Slider extends Singleton {
	/**
	 * Constructor.
	 */
	public function init() {
		$this->hooks();
	}

	/**
	 * Hooks.
	 */
	public function hooks() {
		add_action( 'omniverse_slider_term_edit_form_top', [ $this, 'add_slides_to_slider_page' ], 9 );
		add_action( 'wp_ajax_omniverse_get_slides_data', [ $this, 'get_slides_data' ] );
		add_action( 'post_edit_form_tag', [ $this, 'enqueue_script' ] );
	}

	/**
	 * Enqueue script.
	 *
	 * @param object $post Post.
	 */
	public function enqueue_script( $post ) {
		if ( ! $post || $post->post_type !== 'omniverse_slide' ) {
			return;
		}
		wp_enqueue_script( 'wd-sliders-ui', OMNIVERSE_ASSETS . '/js/sliders-ui.js', array(), OMNIVERSE_VERSION, true );
	}

	/**
	 * Add slides to slider list.
	 */
	public function get_slides_data() {
		check_ajax_referer( 'omniverse-get-slides-nonce', 'security' );
		$output     = array();
		$taxonomies = get_terms( 'omniverse_slider', array( 'hide_empty' => false ) );

		if ( ! $taxonomies ) {
			wp_send_json_error();
		}

		foreach ( $taxonomies as $taxonomy ) {
			$slider_id = $taxonomy->term_id;

			$output[ $slider_id ]['slider_edit_link'] = get_edit_term_link( $slider_id, 'omniverse_slider' );
			$output[ $slider_id ]['slider_edit_text'] = esc_html__( 'Slider settings', 'omniverse' );
		}

		if ( empty( $_GET['slider_id'] ) ) {
			wp_send_json_success( $output );
		}

		$args = array(
			'posts_per_page' => -1,
			'post_type'      => 'omniverse_slide',
			'tax_query'      => array(
				'relation' => 'OR',
			),
		);

		$slider_ids = $_GET['slider_id']; //phpcs:ignore

		foreach ( $slider_ids as $id ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'omniverse_slider',
				'field'    => 'term_id',
				'terms'    => (int) $id,
			);
		}

		$slides = new \WP_Query( $args );

		if ( $slides->posts ) {
			foreach ( $slides->posts as $slide ) {
				$bg_image_desktop      = has_post_thumbnail( $slide->ID ) ? wp_get_attachment_url( get_post_thumbnail_id( $slide->ID ) ) : '';
				$meta_bg_image_desktop = get_post_meta( $slide->ID, 'bg_image_desktop', true );

				if ( is_array( $meta_bg_image_desktop ) ) {
					$meta_bg_image_desktop = $meta_bg_image_desktop['url'];
				}

				if ( $meta_bg_image_desktop ) {
					$bg_image_desktop = $meta_bg_image_desktop;
				}

				$slider_term = wp_get_post_terms( $slide->ID, 'omniverse_slider' );

				if ( ! $slider_term ) {
					continue;
				}

				foreach ( $slider_term as $term ) {
					$slider_id = $term->term_id;

					$output[ $slider_id ]['slides'][ $slide->ID ] = array(
						'id'       => $slide->ID,
						'title'    => $slide->post_title,
						'link'     => get_edit_post_link( $slide->ID, 'url' ),
						'img_url'  => $bg_image_desktop,
						'bg_color' => get_post_meta( $slide->ID, 'bg_color', true ),
					);
				}
			}
		}

		wp_send_json_success( $output );
	}

	/**
	 * Add slides list to slider.
	 *
	 * @param object $tag Term object.
	 */
	public function add_slides_to_slider_page( $tag ) {
		$args = array(
			'posts_per_page' => -1,
			'post_type'      => 'omniverse_slide',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'tax_query'      => array( // phpcs:ignore
				array(
					'taxonomy' => 'omniverse_slider',
					'field'    => 'id',
					'terms'    => $tag->term_id,
				),
			),
		);

		$slides = new \WP_Query( $args );

		?>
		<div class="dn-edit-slider-slides-wrap">
			<div class="dn-edit-slider-slides">
				<div class="dn-wp-add-heading">
					<h1 class="wp-heading-inline">
						<?php esc_html_e( 'Slides', 'omniverse' ); ?>
					</h1>

					<a class="page-title-action" href="<?php echo esc_url( admin_url( 'post-new.php?post_type=omniverse_slide&slider_id=' . $tag->term_id ) ); ?>">
						<?php esc_html_e( 'Add new', 'omniverse' ); ?>
					</a>
				</div>

				<?php if ( $slides->posts ) : ?>
					<div class="dn-wp-table">
						<div class="dn-wp-row dn-wp-row-heading">
							<div class="dn-wp-table-img"></div>
							<div class="dn-wp-table-title"><?php esc_html_e( 'Title', 'omniverse' ); ?></div>
							<div class="dn-wp-table-date"><?php esc_html_e( 'Date', 'omniverse' ); ?></div>
						</div>
						<?php foreach ( $slides->posts as $slide ) : ?>
							<?php
							$bg_image_desktop      = has_post_thumbnail( $slide->ID ) ? wp_get_attachment_url( get_post_thumbnail_id( $slide->ID ) ) : '';
							$meta_bg_image_desktop = get_post_meta( $slide->ID, 'bg_image_desktop', true );
							$bg_slide_color        = get_post_meta( $slide->ID, 'bg_color', true );

							if ( is_array( $meta_bg_image_desktop ) ) {
								$meta_bg_image_desktop = $meta_bg_image_desktop['url'];
							}

							if ( $meta_bg_image_desktop ) {
								$bg_image_desktop = $meta_bg_image_desktop;
							}

							$duplicate_url = wp_nonce_url(
								add_query_arg(
									array(
										'action' => 'omniverse_duplicate_post_as_draft',
										'post'   => $slide->ID,
									),
									'admin.php'
								),
								'omniverse_duplicate_post_as_draft',
								'duplicate_nonce'
							);

							?>
							<div class="dn-wp-row">
								<div class="dn-wp-table-img">
									<?php if ( $bg_image_desktop ) : ?>
										<img src="<?php echo esc_url( $bg_image_desktop ); ?>" alt="slide image">
									<?php elseif ( $bg_slide_color ) : ?>
										<div class="dn-slider-bg-color" style="background-color: <?php echo esc_attr( $bg_slide_color ); ?>"></div>
									<?php endif; ?>
								</div>

								<div class="dn-wp-table-title">
									<a href="<?php echo esc_url( get_edit_post_link( $slide->ID, 'url' ) ); ?>">
										<?php echo esc_html( $slide->post_title ); ?>
									</a>
									<div class="dn-actions">
										<a href="<?php echo esc_url( get_edit_post_link( $slide->ID, 'url' ) ); ?>">
											<?php esc_html_e( 'Edit', 'omniverse' ); ?>
										</a>

										<a class="dn-bin" href="<?php echo esc_url( get_delete_post_link( $slide->ID ) ); ?>">
											<?php esc_html_e( 'Trash', 'omniverse' ); ?>
										</a>

										<a href="<?php echo esc_url( get_preview_post_link( $slide->ID ) ); ?>">
											<?php esc_html_e( 'View', 'omniverse' ); ?>
										</a>

										<a href="<?php echo esc_url( $duplicate_url ); ?>">
											<?php esc_html_e( 'Duplicate', 'omniverse' ); ?>
										</a>
									</div>
								</div>

								<div class="dn-wp-table-date">
									<span><?php esc_html_e( 'Published', 'omniverse' ); ?></span>
									<br>
									<span>
										<?php echo esc_html( $slide->post_modified ); ?>
									</span>
								</div>
							</div>
						<?php endforeach; ?>
						<div class="dn-wp-row dn-wp-row-heading">
							<div class="dn-wp-table-img"></div>
							<div class="dn-wp-table-title"><?php esc_html_e( 'Title', 'omniverse' ); ?></div>
							<div class="dn-wp-table-date"><?php esc_html_e( 'Date', 'omniverse' ); ?></div>
						</div>
					</div>
				<?php else : ?>
					<div class="dn-notice dn-info">
						<?php esc_html_e( 'There are no slides yet.', 'omniverse' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}

Slider::get_instance();
