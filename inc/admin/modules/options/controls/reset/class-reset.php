<?php
/**
 * Reset control.
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
class Reset extends Field {
	/**
	 * Displays the field control HTML.
	 *
	 * @since 1.0.0
	 *
	 * @return void.
	 */
	public function render_control() {
		?>
		<button class="dn-reset-options-btn dn-i-round-right dn-btn" name="dn-omniverse-options[reset-defaults]" value="1"><?php esc_html_e( 'Reset all settings', 'omniverse' ); ?></button>
		<?php
	}
}


