<?php
/**
 * Textarea with text or HTML control.
 *
 * @package dn
 */

namespace DN\Admin\Modules\Options\Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use DN\Admin\Modules\Options\Field;

/**
 * Textarea field control.
 */
class Textarea extends Field {


	/**
	 * Displays the field control HTML.
	 *
	 * @since 1.0.0
	 *
	 * @return void.
	 */
	public function render_control() {
		if ( ! $this->args['wysiwyg'] ) :
			?>
				<textarea placeholder="<?php echo esc_attr( $this->_get_placeholder() ); ?>" class="dn-textarea-<?php echo esc_attr( ( $this->args['wysiwyg'] ) ? 'wysiwyg' : 'plain' ); ?>" name="<?php echo esc_attr( $this->get_input_name() ); ?>"><?php echo esc_textarea( $this->get_field_value() ); ?></textarea>
			<?php
		else :
			wp_editor(
				$this->get_field_value(),
				'text-' . $this->args['id'],
				array(
					'textarea_name' => $this->get_input_name(),
					'textarea_rows' => 8,
				)
			);
		endif;
	}

	/**
	 * Get textarea's placeholder text from arguments.
	 *
	 * @since 1.0.0
	 */
	private function _get_placeholder() {
		return isset( $this->args['placeholder'] ) ? $this->args['placeholder'] : '';
	}
}


