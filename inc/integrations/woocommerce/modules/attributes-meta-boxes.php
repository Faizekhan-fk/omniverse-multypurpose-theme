<?php
/**
 * Add meta boxes to attributes interface for woocommerce.
 *
 * @package Omniverse.
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_wc_attribute_update' ) ) {
	/**
	 * This function save woocommerce attribute data after push 'update' button.
	 *
	 * @param mixed $attribute_id .
	 * @param mixed $attribute .
	 * @param mixed $old_attribute_name .
	 */
	function omniverse_wc_attribute_update( $attribute_id, $attribute, $old_attribute_name ) {
		$attribute_swatch_size = isset( $_POST['attribute_swatch_size'] ) ? $_POST['attribute_swatch_size'] : ''; // phpcs:ignore.
		update_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_swatch_size', sanitize_text_field( $attribute_swatch_size ), false );

		$attribute_swatch_bg_style = isset( $_POST['attribute_swatch_style'] ) ? $_POST['attribute_swatch_style'] : ''; // phpcs:ignore.
		update_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_swatch_style', sanitize_text_field( $attribute_swatch_bg_style ), false );

		$attribute_swatch_dis_style = isset( $_POST['attribute_swatch_dis_style'] ) ? $_POST['attribute_swatch_dis_style'] : ''; // phpcs:ignore.
		update_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_swatch_dis_style', sanitize_text_field( $attribute_swatch_dis_style ), false );

		$attribute_swatch_shape = isset( $_POST['attribute_swatch_shape'] ) ? $_POST['attribute_swatch_shape'] : ''; // phpcs:ignore.
		update_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_swatch_shape', sanitize_text_field( $attribute_swatch_shape ), false );

		$attribute_show_on_product = isset( $_POST['attribute_show_on_product'] ) ? $_POST['attribute_show_on_product'] : ''; // phpcs:ignore.
		update_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_show_on_product', sanitize_text_field( $attribute_show_on_product ), false );

		$attribute_thumbnail = isset( $_POST['product_attr_thumbnail_id'] ) ? $_POST['product_attr_thumbnail_id'] : ''; // phpcs:ignore.
		update_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_thumbnail', sanitize_text_field( $attribute_thumbnail ), false );

		$attribute_hint = isset( $_POST['attribute_hint'] ) ? $_POST['attribute_hint'] : ''; // phpcs:ignore.
		update_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_hint', sanitize_text_field( $attribute_hint ), false );

		$attribute_change_image = isset( $_POST['attribute_change_image'] ) ? $_POST['attribute_change_image'] : ''; // phpcs:ignore.
		update_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_change_image', sanitize_text_field( $attribute_change_image ), false );
	}

	add_action( 'woocommerce_attribute_updated', 'omniverse_wc_attribute_update', 20, 3 );
}

if ( ! function_exists( 'omniverse_wc_attribute_add' ) ) {
	/**
	 * This function save woocommerce attribute data after push 'Add attribute' button.
	 *
	 * @param mixed $attribute_id .
	 * @param mixed $attribute .
	 */
	function omniverse_wc_attribute_add( $attribute_id, $attribute ) {
		$attribute_swatch_size = isset( $_POST['attribute_swatch_size'] ) ? $_POST['attribute_swatch_size'] : ''; // phpcs:ignore.
		add_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_swatch_size', sanitize_text_field( $attribute_swatch_size ), '', false );

		$attribute_swatch_bg_style = isset( $_POST['attribute_swatch_style'] ) ? $_POST['attribute_swatch_style'] : ''; // phpcs:ignore.
		add_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_swatch_style', sanitize_text_field( $attribute_swatch_bg_style ), '', false );

		$attribute_swatch_dis_style = isset( $_POST['attribute_swatch_dis_style'] ) ? $_POST['attribute_swatch_dis_style'] : ''; // phpcs:ignore.
		add_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_swatch_dis_style', sanitize_text_field( $attribute_swatch_dis_style ), '', false );

		$attribute_swatch_shape = isset( $_POST['attribute_swatch_shape'] ) ? $_POST['attribute_swatch_shape'] : ''; // phpcs:ignore.
		add_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_swatch_shape', sanitize_text_field( $attribute_swatch_shape ), '', false );

		$attribute_show_on_product = isset( $_POST['attribute_show_on_product'] ) ? $_POST['attribute_show_on_product'] : ''; // phpcs:ignore.
		add_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_show_on_product', sanitize_text_field( $attribute_show_on_product ), '', false );

		$attribute_thumbnail = isset( $_POST['product_attr_thumbnail_id'] ) ? $_POST['product_attr_thumbnail_id'] : ''; // phpcs:ignore.
		add_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_thumbnail', sanitize_text_field( $attribute_thumbnail ), '', false );

		$attribute_hint = isset( $_POST['attribute_hint'] ) ? $_POST['attribute_hint'] : ''; // phpcs:ignore.
		add_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_hint', sanitize_text_field( $attribute_hint ), '', false );

		$attribute_change_image = isset( $_POST['attribute_change_image'] ) ? $_POST['attribute_change_image'] : ''; // phpcs:ignore.
		add_option( 'omniverse_pa_' . $attribute['attribute_name'] . '_change_image', sanitize_text_field( $attribute_change_image ), '', false );
	}

	add_action( 'woocommerce_attribute_added', 'omniverse_wc_attribute_add', 20, 2 );
}

if ( ! function_exists( 'omniverse_wc_get_attribute_term' ) ) {

	/**
	 * Get attribute term.
	 *
	 * @param mixed $attribute_name .
	 * @param mixed $term .
	 * @return false|mixed|void
	 */
	function omniverse_wc_get_attribute_term( $attribute_name, $term, $default = false ) {
		return get_option( 'omniverse_' . $attribute_name . '_' . $term, $default );
	}
}

if ( ! function_exists( 'omniverse_render_product_attrs_admin_options' ) ) {
	/**
	 * Add product attribute labels options
	 *
	 * @since 1.0.0
	 */
	function omniverse_render_product_attrs_admin_options() {
		wp_enqueue_media();
		wp_enqueue_script( 'omniverse-admin-options', OMNIVERSE_ASSETS . '/js/options.js', array(), OMNIVERSE_VERSION, true );

		$swatch_shape_list     = array(
			'round'   => esc_html__( 'Round', 'omniverse' ),
			'rounded' => esc_html__( 'Rounded', 'omniverse' ),
			'square'  => esc_html__( 'Square', 'omniverse' ),
		);
		$swatch_size_list      = array(
			'xs'      => esc_html__( 'XS', 'omniverse' ),
			'default' => esc_html__( 'S', 'omniverse' ),
			'm'       => esc_html__( 'M', 'omniverse' ),
			'large'   => esc_html__( 'L', 'omniverse' ),
			'xlarge'  => esc_html__( 'XL', 'omniverse' ),
			'xxl'     => esc_html__( 'XXL', 'omniverse' ),
		);
		$swatch_style_list     = array(
			'1' => esc_html__( 'Style 1', 'omniverse' ),
			'2' => esc_html__( 'Style 2', 'omniverse' ),
			'3' => esc_html__( 'Style 3', 'omniverse' ),
			'4' => esc_html__( 'Style 4', 'omniverse' ),
		);
		$swatch_dis_style_list = array(
			'1' => esc_html__( 'Style 1', 'omniverse' ),
			'2' => esc_html__( 'Style 2', 'omniverse' ),
			'3' => esc_html__( 'Style 3', 'omniverse' ),
		);

		$show_on_product      = '';
		$thumb_id             = '';
		$attribute_hint       = '';
		$change_image_product = '';

		if ( ! empty( $_GET['edit'] ) ) { // phpcs:ignore
			$attribute_id   = sanitize_text_field( wp_unslash( $_GET['edit'] ) ); // phpcs:ignore
			$taxonomy_ids   = wc_get_attribute_taxonomy_ids();
			$attribute_name = 'pa_' . array_search( $attribute_id, $taxonomy_ids, false ); // phpcs:ignore

			$swatch_shape         = omniverse_wc_get_attribute_term( $attribute_name, 'swatch_shape' );
			$swatch_size          = omniverse_wc_get_attribute_term( $attribute_name, 'swatch_size' );
			$swatch_style         = omniverse_wc_get_attribute_term( $attribute_name, 'swatch_style' );
			$swatch_dis_style     = omniverse_wc_get_attribute_term( $attribute_name, 'swatch_dis_style' );
			$show_on_product      = omniverse_wc_get_attribute_term( $attribute_name, 'show_on_product' );
			$thumb_id             = omniverse_wc_get_attribute_term( $attribute_name, 'thumbnail' );
			$attribute_hint       = omniverse_wc_get_attribute_term( $attribute_name, 'hint' );
			$change_image_product = omniverse_wc_get_attribute_term( $attribute_name, 'change_image' );
		}

		$swatch_shape     = ! empty( $swatch_shape ) ? $swatch_shape : 'round';
		$swatch_size      = ! empty( $swatch_size ) ? $swatch_size : 'default';
		$swatch_style     = ! empty( $swatch_style ) ? $swatch_style : '1';
		$swatch_dis_style = ! empty( $swatch_dis_style ) ? $swatch_dis_style : '1';

		?>
		<div class="dn-box dn-options dn-metaboxes dn-theme-style">
			<div class="dn-box-content">
				<div class="dn-fields-tabs">
					<div class="dn-sections">
						<div class="dn-section dn-active-section" data-id="general">
							<div class="dn-fields">
								<div class="dn-group-title">
									<span><?php esc_html_e( 'Swatch', 'omniverse' ); ?></span>
								</div>
								<div class="dn-fields-group dn-group">
									<div class="dn-field dn-settings-field dn-buttons-control dn-images-set">
										<div class="dn-option-title">
											<label>
												<span>
													<?php esc_html_e( 'Swatch style', 'omniverse' ); ?>
												</span>
											</label>
										</div>
										<div class="dn-option-control">
											<div class="dn-btns-set">
												<?php foreach ( $swatch_style_list as $value => $label ) : ?>
													<div class="dn-set-item dn-set-btn-img<?php echo (string) $value === $swatch_style ? ' dn-active' : ''; ?>" data-value="<?php echo esc_attr( $value ); ?>">
														<img src="<?php echo esc_url( OMNIVERSE_ASSETS_IMAGES . '/settings/swatches/swatches-style-' . $value . '.jpg' ); ?>" title="<?php echo esc_attr( $label ); ?>" alt="<?php echo esc_attr( $label ); ?>">
														<span class="dn-images-set-lable"><?php echo esc_html( $label ); ?></span>
													</div>
												<?php endforeach; ?>
											</div>
											<input type="hidden" name="attribute_swatch_style" value="<?php echo esc_attr( $swatch_style ); ?>">
										</div>
									</div>
									<div class="dn-field dn-settings-field dn-buttons-control dn-images-set">
										<div class="dn-option-title">
											<label>
												<span>
													<?php esc_html_e( 'Disabled swatch style', 'omniverse' ); ?>
												</span>
											</label>
										</div>
										<div class="dn-option-control">
											<div class="dn-btns-set">
												<?php foreach ( $swatch_dis_style_list as $value => $label ) : ?>
													<div class="dn-set-item dn-set-btn-img<?php echo (string) $value === $swatch_dis_style ? ' dn-active' : ''; ?>" data-value="<?php echo esc_attr( $value ); ?>">
														<img src="<?php echo esc_url( OMNIVERSE_ASSETS_IMAGES . '/settings/swatches/disable-swatches-style-' . $value . '.jpg' ); ?>" title="<?php echo esc_attr( $label ); ?>" alt="<?php echo esc_attr( $label ); ?>">
														<span class="dn-images-set-lable"><?php echo esc_html( $label ); ?></span>
													</div>
												<?php endforeach; ?>
											</div>
											<input type="hidden" name="attribute_swatch_dis_style" value="<?php echo esc_attr( $swatch_dis_style ); ?>">
										</div>
									</div>
									<div class="dn-field dn-settings-field dn-buttons-control dn-images-set">
										<div class="dn-option-title">
											<label>
												<span>
													<?php esc_html_e( 'Swatch shape', 'omniverse' ); ?>
												</span>
											</label>
										</div>
										<div class="dn-option-control">
											<div class="dn-btns-set">
												<?php foreach ( $swatch_shape_list as $value => $label ) : ?>
													<div class="dn-set-item dn-set-btn-img<?php echo $value === $swatch_shape ? ' dn-active' : ''; ?>" data-value="<?php echo esc_attr( $value ); ?>">
														<img src="<?php echo esc_url( OMNIVERSE_ASSETS_IMAGES . '/settings/swatches/swatch-form-' . $value . '.jpg' ); ?>" title="<?php echo esc_attr( $label ); ?>" alt="<?php echo esc_attr( $label ); ?>">
														<span class="dn-images-set-lable"><?php echo esc_html( $label ); ?></span>
													</div>
												<?php endforeach; ?>
											</div>
											<input type="hidden" name="attribute_swatch_shape" value="<?php echo esc_attr( $swatch_shape ); ?>">
										</div>
									</div>
									<div class="dn-field dn-settings-field dn-buttons-control">
										<div class="dn-option-title">
											<label>
												<span>
													<?php esc_html_e( 'Swatch size', 'omniverse' ); ?>
												</span>
											</label>
										</div>
										<div class="dn-option-control">
											<div class="dn-btns-set">
												<?php foreach ( $swatch_size_list as $value => $label ) : ?>
													<div class="dn-set-item dn-set-btn<?php echo $value === $swatch_size ? ' dn-active' : ''; ?>" data-value="<?php echo esc_attr( $value ); ?>">
														<span class="dn-images-set-lable"><?php echo esc_html( $label ); ?></span>
													</div>
												<?php endforeach; ?>
											</div>
											<input type="hidden" name="attribute_swatch_size" value="<?php echo esc_attr( $swatch_size ); ?>">
										</div>
									</div>
								</div>
								<div class="dn-group-title">
									<span><?php esc_html_e( 'Extra', 'omniverse' ); ?></span>
								</div>
								<div class="dn-fields-group dn-group">
									<div class="dn-field dn-settings-field dn-switcher-control">
										<div class="dn-option-title">
											<label>
												<span>
													<?php esc_html_e( 'Show attribute label on products', 'omniverse' ); ?>
												</span>
											</label>
											<div class="dn-hint">
												<div class="dn-tooltip dn-top"><img data-src="<?php echo esc_url( OMNIVERSE_TOOLTIP_URL . 'show-attribute-label-on-products.jpg' ); ?>" alt=""></div>
											</div>
										</div>
										<div class="dn-option-control">
											<div class="dn-switcher-btn<?php echo esc_attr( 'on' === $show_on_product ? ' dn-active' : '' ); ?>" data-on="on" data-off="off">
												<div class="dn-switcher-dot-wrap">
													<div class="dn-switcher-dot"></div>
												</div>
												<div class="dn-switcher-labels">
													<span class="dn-switcher-label dn-on">
														<?php esc_html_e( 'Yes', 'omniverse' ); ?>
													</span>
													<span class="dn-switcher-label dn-off">
														<?php esc_html_e( 'No', 'omniverse' ); ?>
													</span>
												</div>
											</div>
											<input type="hidden" name="attribute_show_on_product" value="<?php echo esc_attr( $show_on_product ); ?>" >
										</div>
										<p class="dn-field-description">
											<?php esc_html_e( 'Enable this option to show an attribute label on the product image.', 'omniverse' ); ?>
										</p>
									</div>
									<div class="dn-field dn-settings-field dn-switcher-control">
										<div class="dn-option-title">
											<label>
												<span>
													<?php esc_html_e( 'Change product image on attribute click', 'omniverse' ); ?>
												</span>
											</label>
											<div class="dn-hint dn-loaded">
												<div class="dn-tooltip dn-top">
													<div class="dn-tooltip-inner"><video data-src="https://omniverse.zynxsol.com/theme-settings-tooltips/change-product-image-attribute-click.mp4" autoplay="" loop="" muted="" src="https://omniverse.zynxsol.com/theme-settings-tooltips/change-product-image-attribute-click.mp4"></video></div>
												</div>
											</div>
										</div>
										<div class="dn-option-control">
											<div class="dn-switcher-btn<?php echo esc_attr( 'on' === $change_image_product ? ' dn-active' : '' ); ?>" data-on="on" data-off="off">
												<div class="dn-switcher-dot-wrap">
													<div class="dn-switcher-dot"></div>
												</div>
												<div class="dn-switcher-labels">
													<span class="dn-switcher-label dn-on">
														<?php esc_html_e( 'Yes', 'omniverse' ); ?>
													</span>
													<span class="dn-switcher-label dn-off">
														<?php esc_html_e( 'No', 'omniverse' ); ?>
													</span>
												</div>
											</div>
											<input type="hidden" name="attribute_change_image" value="<?php echo esc_attr( $change_image_product ); ?>" >
										</div>
									</div>
									<div class="dn-field dn-settings-field dn-upload-control">
										<div class="dn-option-title">
											<label>
												<span>
													<?php esc_html_e( 'Attribute icon', 'woocommerce' ); ?>
												</span>
											</label>
											<div class="dn-hint">
												<div class="dn-tooltip dn-top"><img data-src="<?php echo esc_url( OMNIVERSE_TOOLTIP_URL . 'attribute-icon.jpg' ); ?>" alt=""></div>
											</div>
										</div>
										<div class="dn-option-control">
											<div class="dn-upload-preview">
												<?php if ( ! empty( $thumb_id ) ) : ?>
													<img src="<?php echo esc_attr( wp_get_attachment_image_url( $thumb_id ) ); ?>" alt="">
												<?php endif; ?>
											</div>
											<div class="dn-upload-btns">
												<a class="dn-btn dn-upload-btn dn-i-import">
													<?php esc_html_e( 'Upload', 'omniverse' ); ?>
												</a>
												<a class="dn-btn dn-color-warning dn-remove-upload-btn dn-i-trash<?php echo ( isset( $thumb_id ) && ! empty( $thumb_id ) ) ? ' dn-active' : ''; ?>">
													<?php esc_html_e( 'Remove', 'omniverse' ); ?>
												</a>

												<input id="product_attr_thumbnail_id" type="hidden" class="dn-upload-input-id" name="product_attr_thumbnail_id" value="<?php echo esc_attr( $thumb_id ); ?>" />
											</div>
										</div>
										<p class="dn-field-description">
											<?php esc_html_e( 'Upload an icon that will be displayed on the additional information table.', 'omniverse' ); ?>
										</p>
									</div>
									<div class="dn-field dn-settings-field">
										<div class="dn-option-title">
											<label for="attribute_hint">
												<span>
													<?php esc_html_e( 'Attribute hint content', 'omniverse' ); ?>
												</span>
											</label>
											<div class="dn-hint">
												<div class="dn-tooltip dn-top"><img data-src="<?php echo esc_url( OMNIVERSE_TOOLTIP_URL . 'attribute-hint.gif' ); ?>" alt=""></div>
											</div>
										</div>
										<div class="dn-option-control">
											<textarea id="attribute_hint" class="dn-textarea-plain" rows="5" name="attribute_hint"><?php echo esc_textarea( $attribute_hint ); ?></textarea>
										</div>
										<p class="dn-field-description">
											<?php esc_html_e( 'Enter the text that will be displayed as a hint on the additional information table.', 'omniverse' ); ?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	add_action( 'woocommerce_after_edit_attribute_fields', 'omniverse_render_product_attrs_admin_options' );
	add_action( 'woocommerce_after_add_attribute_fields', 'omniverse_render_product_attrs_admin_options' );
}
