<?php
/**
 * Upload media library control.
 *
 * @package dn
 */

namespace DN\Admin\Modules\Options\Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use DN\Admin\Modules\Options\Field;

/**
 * Upload button.
 */
class Upload extends Field {

	/**
	 * Displays the field control HTML.
	 *
	 * @since 1.0.0
	 *
	 * @return void.
	 */
	public function render_control() {
		$value          = $this->get_field_value();
		$type           = isset( $this->args['data_type'] ) ? $this->args['data_type'] : 'array';
		$url_input_name = 'url' === $type ? $this->get_input_name() : $this->get_input_name( 'url' );

		if ( 'url' === $type ) {
			$value_url = $value;
		} else {
			$value_url = isset( $value['url'] ) ? $value['url'] : $value;
		}

		?>
			<div class="dn-upload-preview<?php echo ( ! empty( $value_url ) ) ? ' dn-preview-shown' : ''; ?>">
				<?php if ( ! empty( $value_url ) ) : ?>
					<img src="<?php echo esc_url( $value_url ); ?>">
				<?php endif ?>
			</div>
			<div class="dn-upload-btns">
				<a class="dn-btn dn-upload-btn dn-i-import"><?php esc_html_e( 'Upload', 'omniverse' ); ?></a>
				<a class="dn-btn dn-color-warning dn-remove-upload-btn dn-i-trash<?php echo ( ! empty( $value_url ) ) ? ' dn-active' : ''; ?>"><?php esc_html_e( 'Remove', 'omniverse' ); ?></a>
				<input type="hidden" class="dn-upload-input-url" name="<?php echo esc_attr( $url_input_name ); ?>" value="<?php echo esc_attr( $value_url ); ?>" />
				<?php if ( 'array' === $type ) : ?>	
					<input type="hidden" class="dn-upload-input-id" name="<?php echo esc_attr( $this->get_input_name( 'id' ) ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'id' ) ); ?>" />
				<?php endif; ?>	
			</div>
		<?php
	}

	/**
	 * Check value URl and ID fields.
	 *
	 * @since 1.0.0
	 *
	 * @param  string or array $value Field value.
	 */
	public function validate( $value ) {
		if ( isset( $value['id'] ) ) {
			$attachment = wp_get_attachment_url( $value['id'] );

			if ( $attachment ) {
				$value['url'] = $attachment;
			}
		}

		return $value;
	}

	/**
	 * Enqueue media lib.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {
		wp_enqueue_media();
	}
}
