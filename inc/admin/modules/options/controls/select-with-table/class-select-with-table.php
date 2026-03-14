<?php
/**
 * HTML dropdown select control.
 *
 * @package omniverse
 */

namespace DN\Admin\Modules\Options\Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use DN\Admin\Modules\Options\Field;

/**
 * Switcher field control.
 */
class Select_With_Table extends Field {
	/**
	 * Displays the field control HTML.
	 *
	 * @since 1.0.0
	 *
	 * @return void.
	 */
	public function render_control() {
		$value = $this->get_field_value();

		?>
		<div class="dn-item-template dn-hidden">
			<div class="dn-table-controls dn-bundle">
				<div class="dn-bundle-name">
					<?php $this->get_select( '', $this->get_input_name() . '[{{index}}][id]' ); ?>
				</div>
				<div class="dn-bundle-discount">
					<div class="dn-input-append">
						<input type="number" min="0" max="100" name="<?php echo esc_attr( $this->get_input_name() . '[{{index}}][discount]' ); ?>">
						<span class="add-on">%</span>
					</div>
				</div>
				<div class="dn-bundle-close">
					<a href="#" class="dn-remove-item dn-bordered-btn dn-color-warning dn-style-icon dn-i-close"></a>
				</div>
			</div>
		</div>
		<div class="dn-controls-wrapper">
			<div class="dn-table-controls dn-bundle">
				<div class="dn-bundle-name">
					<label><?php esc_html_e( 'Products', 'omniverse' ); ?></label>
				</div>
				<div class="dn-bundle-discount">
				<label><?php esc_html_e( 'Discount', 'omniverse' ); ?></label>
				</div>
			</div>
			<?php if ( $value ) : ?>
				<?php foreach ( $value as $id => $product ) : ?>
					<div class="dn-table-controls dn-bundle">
						<div class="dn-bundle-name">
							<?php $this->get_select( $product['id'], $this->get_input_name() . '[' . $id . '][id]' ); ?>
						</div>
						<div class="dn-bundle-discount">
							<div class="dn-input-append">
								<input type="number" min="0" max="100" step="0.01" name="<?php echo esc_attr( $this->get_input_name() . '[' . $id . '][discount]' ); ?>" value="<?php echo esc_attr( $product['discount'] ); ?>">
								<span class="add-on">%</span>
							</div>
						</div>
						<div class="dn-bundle-close">
							<a href="#" class="dn-remove-item dn-bordered-btn dn-color-warning dn-style-icon dn-i-close"></a>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<a href="#" class="dn-add-row dn-inline-btn dn-color-primary dn-i-add">
			<?php esc_html_e( 'Add new product', 'omniverse' ); ?>
		</a>

		<?php
	}

	/**
	 * Get select control.
	 *
	 * @param string $value Value.
	 * @param string $name Name.
	 *
	 * @return void
	 */
	protected function get_select( $value, $name ) {
		$classes = ' dn-select2';

		$autocomplete_type   = $this->args['autocomplete']['type'];
		$autocomplete_value  = $this->args['autocomplete']['value'];
		$autocomplete_search = $this->args['autocomplete']['search'];

		$classes    .= ' dn-autocomplete';
		$attributes  = ' data-type="' . $autocomplete_type . '"';
		$attributes .= ' data-value=\'' . $autocomplete_value . '\'';
		$attributes .= ' data-search="' . $autocomplete_search . '"';

		$options = $this->args['autocomplete']['render']( $value );

		?>
		<select class="dn-select<?php echo esc_attr( $classes ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php echo $attributes; // phpcs:ignore ?> aria-label="<?php echo esc_attr( $this->get_input_name() ); ?>">
			<?php foreach ( $options as $option ) : ?>
				<?php
				$selected = false;

				if ( is_array( $value ) && in_array( $option['value'], $value, false ) ) { // phpcs:ignore
					$selected = true;
				} elseif ( ! is_array( $value ) && strval( $value ) === strval( $option['value'] ) ) {
					$selected = true;
				}

				?>
				<option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( true, $selected ); ?>><?php echo esc_html( $option['name'] ); ?></option>
			<?php endforeach ?>
		</select>
		<?php
	}

	/**
	 * Enqueue lib.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {
		wp_enqueue_script( 'select2', OMNIVERSE_ASSETS . '/js/libs/select2.full.min.js', array(), omniverse_get_theme_info( 'Version' ), true );
	}
}
