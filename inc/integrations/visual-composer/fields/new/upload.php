<?php
/**
 * Omniverse attachment param.
 *
 * @package Omniverse
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}


if ( ! function_exists( 'omniverse_get_upload_param' ) ) {
	/**
	 * Omniverse attachment param.
	 *
	 * @param array  $settings Settings.
	 * @param string $value    Value.
	 *
	 * @return string
	 */
	function omniverse_get_upload_param( $settings, $value ) {
		ob_start();

		$file_name = '';

		if ( ! empty( $value ) ) {
			$path = get_attached_file( $value );

			if ( $path ) {
				$file_name = wp_basename( $path );
			}
		}

		wp_enqueue_media();
		?>
		<div class="dn-upload-preview">
			<?php if ( $file_name ) : ?>
				<?php echo esc_attr( $file_name ); ?>
			<?php endif; ?>
		</div>
		<div class="dn-upload-btns">
			<button class="dn-btn dn-upload-btn dn-i-import" data-id="<?php echo esc_attr( uniqid() ); ?>">
				<?php esc_html_e( 'Upload', 'omniverse' ); ?>
			</button>
			<button class="dn-btn dn-color-warning dn-remove-upload-btn dn-i-trash<?php echo ( ! empty( $value ) ) ? ' dn-active' : ''; ?>">
				<?php esc_html_e( 'Remove', 'omniverse' ); ?>
			</button>

			<input type="hidden" class="wpb_vc_param_value dn-upload-input-id" data-param_type="<?php echo esc_attr( $settings['type'] ); ?>" name="<?php echo esc_attr( $settings['param_name'] ); ?>" id="<?php echo esc_attr( $settings['param_name'] ); ?>" value="<?php echo esc_attr( $value ); ?>" data-settings="<?php echo esc_attr( wp_json_encode( $settings ) ); ?>">
		</div>
		<?php
		return ob_get_clean();
	}
}
