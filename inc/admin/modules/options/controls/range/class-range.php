<?php
/**
 * Range slider.
 *
 * @package dn
 */

namespace DN\Admin\Modules\Options\Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use DN\Admin\Modules\Options\Field;

/**
 * Range slider control.
 */
class Range extends Field {


	/**
	 * Displays the field control HTML.
	 *
	 * @since 1.0.0
	 *
	 * @return void.
	 */
	public function render_control() {
		?>
			<div class="dn-range-slider-wrap">
				<div class="dn-range-slider"></div>
				<input type="hidden" class="dn-range-value" data-start="<?php echo esc_attr( $this->get_field_value() ); ?>" data-min="<?php echo esc_attr( $this->args['min'] ); ?>" data-max="<?php echo esc_attr( $this->args['max'] ); ?>" data-step="<?php echo esc_attr( $this->args['step'] ); ?>" name="<?php echo esc_attr( $this->get_input_name() ); ?>" value="<?php echo esc_attr( $this->get_field_value() ); ?>">
				<span class="dn-range-field-value-display"><span class="dn-range-field-value-text"></span></span>
				<?php if ( ! empty( $this->args['unit'] ) ) : ?>
					<span class="dn-slider-units"><span class="wd-slider-unit-control dn-active"><?php echo esc_attr( $this->args['unit'] ); ?></span></span>
				<?php endif; ?>
			</div>
		<?php
	}

	/**
	 * Enqueue slider jquery ui.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_style( 'dn-jquery-ui', OMNIVERSE_ASSETS . '/css/jquery-ui.css', array(), omniverse_get_theme_info( 'Version' ) );
	}
}


