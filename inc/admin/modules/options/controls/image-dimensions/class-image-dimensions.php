<?php
/**
 * Image dimensions control.
 *
 * @package dn
 */

namespace DN\Admin\Modules\Options\Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use DN\Admin\Modules\Options\Field;

/**
 * Input type text field control.
 */
class Image_Dimensions extends Field {
	/**
	 * Displays the field control HTML.
	 *
	 * @since 1.0.0
	 *
	 * @return void.
	 */
	public function render_control() {
		?>
			<div class="dn-image-dimensions-field">
				<label>
					<?php esc_html_e( 'Width', 'omniverse' ); ?>
				</label>
				<input type="text" name="<?php echo esc_attr( $this->get_input_name( 'width' ) ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'width' ) ); ?>">
			</div>
			<div class="dn-image-dimensions-separator">x</div>
			<div class="dn-image-dimensions-field">
				<label>
					<?php esc_html_e( 'Height', 'omniverse' ); ?>
				</label>
				<input type="text" name="<?php echo esc_attr( $this->get_input_name( 'height' ) ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'height' ) ); ?>">
			</div>
		<?php
	}
}


