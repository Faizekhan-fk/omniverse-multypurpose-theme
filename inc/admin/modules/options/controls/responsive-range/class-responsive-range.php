<?php
/**
 * Responsive Range slider.
 *
 * @package dn
 */

namespace DN\Admin\Modules\Options\Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use DN\Admin\Modules\Options\Field;

/**
 * Responsive Range slider control.
 */
class Responsive_Range extends Field {
	/**
	 * Displays the field control HTML.
	 *
	 * @since 1.0.0
	 *
	 * @return void.
	 */
	public function render_control() {
		$value = $this->get_field_value();
		$data  = array();

		if ( ! empty( $value ) ) {
			if ( function_exists( 'omniverse_decompress' ) && omniverse_is_compressed_data( $value ) ) {
				$data = json_decode( omniverse_decompress( $value ), true );
			} else {
				$data['devices'] = array_replace_recursive(
					$this->args['devices'],
					array(
						'desktop' => array(
							'value' => $value,
						),
					)
				);
			}
		} else {
			$data['devices'] = $this->args['devices'];
		}
		$data['devices'] = array_merge( $this->args['devices'], $data['devices'] );

		?>
			<div class="dn-responsive-range-wrapper">
				<?php if ( $data['devices'] ) : ?>
					<div class="dn-control-tabs-nav dn-responsive-range-devices">
						<?php if ( 1 < count( $data['devices'] ) ) : ?>
							<?php foreach ( $data['devices'] as $device => $device_settings ) : ?>
								<span class="dn-control-tab-nav-item dn-device<?php echo esc_attr( ' wd-' . $device ); ?><?php echo array_key_first( $data['devices'] ) === $device ? esc_attr( ' dn-active' ) : ''; ?>" data-value="<?php echo esc_attr( $device ); ?>" title="<?php echo esc_attr( ucfirst( $device ) ); ?>">
									<span><?php echo esc_attr( $device ); ?></span>
								</span>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<?php foreach ( $data['devices'] as $device => $device_settings ) : ?>
						<?php
						$device_value = isset( $device_settings['value'] ) ? $device_settings['value'] : '';
						$device_unit  = isset( $device_settings['unit'] ) ? $device_settings['unit'] : '-';
						?>
						<div class="dn-control-tab-content dn-responsive-range dn-range-slider-wrap <?php echo array_key_first( $data['devices'] ) === $device ? esc_attr( ' dn-active' ) : ''; ?>"  data-device="<?php echo esc_attr( $device ); ?>" data-value="<?php echo esc_attr( $device_value ); ?>" data-unit="<?php echo esc_attr( $device_unit ); ?>">
							<div class="dn-responsive-range-slider dn-range-slider"></div>
							<span class="dn-range-field-value-input">
								<input type="number" class="dn-range-field-value" value="<?php echo esc_attr( $device_value ); ?>">
							</span>

							<?php if ( ! empty( $this->args['range'] ) ) : ?>
								<span class="dn-slider-units">
									<?php foreach ( $this->args['range'] as $unit => $value ) : ?>
										<?php if ( '-' === $unit ) : ?>
											<?php continue; ?>
										<?php endif; ?>

										<span class="wd-slider-unit-control<?php echo esc_attr( $unit === $device_unit ? ' dn-active' : '' ); ?>" data-unit="<?php echo esc_attr( $unit ); ?>">
											<?php echo esc_html( $unit ); ?>
										</span>
									<?php endforeach; ?>
								</span>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>

			<input type="hidden" class="dn-responsive-range-value" name="<?php echo esc_attr( $this->get_input_name() ); ?>" value="<?php echo function_exists( 'omniverse_compress' ) ? omniverse_compress( wp_json_encode( $data ) ) : ''; ?>" data-settings="<?php echo esc_attr( wp_json_encode( $this->args ) ); ?>">

		<?php
	}

	/**
	 * Output field's css code based on the settings.
	 *
	 * @since 1.0.0
	 *
	 * @return array $output Generated CSS code.
	 */
	public function css_output() {
		if ( empty( $this->args['selectors'] ) || empty( $this->get_field_value() ) || ! function_exists( 'omniverse_decompress' ) ) {
			return array();
		}

		if ( ! empty( $this->args['requires'] ) ) {
			foreach ( $this->args['requires'] as $require ) {
				if ( isset( $this->options[ $require['key'] ] ) ) {
					if ( 'equals' === $require['compare'] && ( ( is_array( $require['value'] ) && ! in_array( $this->options[ $require['key'] ], $require['value'], true ) ) || ( ! is_array( $require['value'] ) && $this->options[ $require['key'] ] !== $require['value'] ) ) ) {
						return array();
					} elseif ( 'not_equals' === $require['compare'] && ( ( is_array( $require['value'] ) && in_array( $this->options[ $require['key'] ], $require['value'], true ) ) || ( ! is_array( $require['value'] ) && $this->options[ $require['key'] ] === $require['value'] ) ) ) {
						return array();
					}
				}
			}
		}

		$value      = json_decode( omniverse_decompress( $this->get_field_value() ), true );
		$output_css = array();

		if ( empty( $value['devices'] ) ) {
			return array();
		}

		foreach ( $value['devices'] as $device => $device_value ) {
			if ( ! $device_value || ( ! empty( $this->args['generate_zero'] ) && '' === $device_value['value'] ) || ( empty( $this->args['generate_zero'] ) && ! $device_value['value'] ) ) {
				continue;
			}

			if ( ! $device ) {
				$device = 'desktop';
			}

			foreach ( $this->args['selectors'] as $selector => $css_data ) {
				foreach ( $css_data as $css ) {
					$result = str_replace( '{{VALUE}}', $device_value['value'], $css );

					if ( isset( $device_value['unit'] ) ) {
						$result = str_replace( '{{UNIT}}', $device_value['unit'], $result );
					}

					$output_css[ $device ][ $selector ][] = $result . "\n";
				}
			}
		}

		return $output_css;
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


