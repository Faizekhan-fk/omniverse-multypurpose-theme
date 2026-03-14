<?php
/**
 * Omniverse dimensions param.
 *
 * @package Omniverse
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}


if ( ! function_exists( 'omniverse_get_dimensions_responsive_param' ) ) {
	/**
	 * Omniverse slider param.
	 *
	 * @param array  $settings Settings.
	 * @param string $value    Value.
	 *
	 * @return string
	 */
	function omniverse_get_dimensions_responsive_param( $settings, $value ) {
		$param_name = $settings['param_name'];

		$data = json_decode( omniverse_decompress( $value ), true );

		if ( isset( $data['devices'] ) ) {
			$settings['devices'] = $data['devices'];
		}

		ob_start();
		?>
		<div class="wd-dimensions-wrapp">
			<?php if ( 1 < count( $settings['devices'] ) ) : ?>
				<div class="wd-field-devices">
					<?php foreach ( $settings['devices'] as $device => $device_settings ) : ?>
						<?php
						$device_classes = ' wd-' . $device;

						if ( array_key_first( $settings['devices'] ) === $device ) {
							$device_classes .= ' dn-active';
						}
						?>

						<span class="wd-device<?php echo esc_attr( $device_classes ); ?>" data-value="<?php echo esc_attr( $device ); ?>" title="<?php echo esc_attr( ucfirst( $device ) ); ?>">
							<span><?php echo esc_attr( $device ); ?></span>
						</span>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php foreach ( $settings['devices'] as $device => $device_settings ) : ?>
				<?php echo omniverse_render_dimension_responsive( $device, $settings, $device_settings ); // phpcs:ignore ?>
			<?php endforeach; ?>

			<input type="hidden" class="wpb_vc_param_value" data-param_type="<?php echo esc_attr( $settings['type'] ); ?>" name="<?php echo esc_attr( $param_name ); ?>" id="<?php echo esc_attr( $param_name ); ?>" value="<?php echo esc_attr( $value ); ?>" data-settings="<?php echo esc_attr( wp_json_encode( $settings ) ); ?>">
		</div>
		<?php
		return ob_get_clean();
	}
}

if ( ! function_exists( 'omniverse_render_dimension_responsive' ) ) {
	/**
	 * This function render slider responsive.
	 *
	 * @param string $device          Device name ( 'desktop', 'tablet', 'mobile' ).
	 * @param array  $settings        All slider responsive settings.
	 * @param array  $device_settings Device settings.
	 *
	 * @return false|string
	 */
	function omniverse_render_dimension_responsive( $device, $settings, $device_settings ) {
		$default_settings = array(
			'top'    => '',
			'right'  => '',
			'bottom' => '',
			'left'   => '',
			'unit'   => '',
		);

		$device_settings = wp_parse_args( $device_settings, $default_settings );

		ob_start();

		$slider_classes = '';

		if ( array_key_first( $settings['devices'] ) === $device ) {
			$slider_classes .= ' dn-active';
		}

		?>
		<div class="wd-dimensions<?php echo esc_attr( $slider_classes ); ?>" data-device="<?php echo esc_attr( $device ); ?>" data-unit="<?php echo esc_attr( $device_settings['unit'] ); ?>">
			<div class="wd-dimension">
				<span class="wd-dimension-field-value">
					<input type="number" id="wd-dimension-value-top" class="wd-dimension-field-value-display" data-id="top" value="<?php echo esc_attr( $device_settings['top'] ); ?>">
					<label for="wd-dimension-value-top">
						<?php esc_html_e( 'Top', 'omniverse' ); ?>
					</label>
				</span>
				<span class="wd-dimension-field-value">
					<input type="number" id="wd-dimension-value-right" class="wd-dimension-field-value-display" data-id="right" value="<?php echo esc_attr( $device_settings['right'] ); ?>">
					<label for="wd-dimension-value-right">
						<?php esc_html_e( 'Right', 'omniverse' ); ?>
					</label>
				</span>
				<span class="wd-dimension-field-value">
					<input type="number" id="wd-dimension-value-bottom" class="wd-dimension-field-value-display" data-id="bottom" value="<?php echo esc_attr( $device_settings['bottom'] ); ?>">
					<label for="wd-dimension-value-bottom">
						<?php esc_html_e( 'Bottom', 'omniverse' ); ?>
					</label>
				</span>
				<span class="wd-dimension-field-value">
					<input type="number" id="wd-dimension-value-left" class="wd-dimension-field-value-display" data-id="left" value="<?php echo esc_attr( $device_settings['left'] ); ?>">
					<label for="wd-dimension-value-left">
						<?php esc_html_e( 'Left', 'omniverse' ); ?>
					</label>
				</span>
			</div>

			<span class="dn-slider-units">
			<?php foreach ( $settings['range'] as $unit => $value ) : ?>
				<?php if ( '-' !== $unit ) : ?>
					<?php

					$unit_classes = '';

					if ( $unit === $settings['devices'][ $device ]['unit'] ) {
						$unit_classes .= ' dn-active';
					}
					?>
					<span class="wd-dimension-unit-control wd-slider-unit-control<?php echo esc_attr( $unit_classes ); ?>" data-unit="<?php echo esc_attr( $unit ); ?>">
						<?php echo esc_html( $unit ); ?>
					</span>
				<?php endif; ?>
			<?php endforeach; ?>
		</span>
		</div>
		<?php
		return ob_get_clean();
	}
}
