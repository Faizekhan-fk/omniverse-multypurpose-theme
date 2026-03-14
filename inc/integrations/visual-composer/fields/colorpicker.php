<?php
/**
 * Color picker.
 *
 * @package Omniverse
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_get_colorpicker_param' ) ) {
	/**
	 * Color picker.
	 *
	 * @param array  $settings Settings.
	 * @param string $value    Value.
	 *
	 * @return string
	 */
	function omniverse_get_colorpicker_param( $settings, $value ) {
		ob_start();
		?>
		<div class="omniverse-vc-colorpicker" id="<?php echo esc_attr( uniqid() ); ?>">
			<input name="color" class="omniverse-vc-colorpicker-input" type="text">
			<input type="hidden" class="omniverse-vc-colorpicker-value wpb_vc_param_value" name="<?php echo esc_attr( $settings['param_name'] ); ?>" data-css_args="<?php echo esc_attr( wp_json_encode( $settings['css_args'] ) ); ?>" value="<?php echo esc_attr( $value ); ?>">
		</div>
		<?php
		return ob_get_clean();
	}
}
