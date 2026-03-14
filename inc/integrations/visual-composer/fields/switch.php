<?php
/**
 * This file creates html for the omniverse_switch field in WPBakery.
 *
 * @package Omniverse.
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

/**
* Omniverse switch param
*/
if ( ! function_exists( 'omniverse_get_switch_param' ) ) {
	/**
	 * This function creates html for the omniverse_switch field in WPBakery.
	 *
	 * @param array $settings .
	 * @param array $value .
	 * @return string
	 */
	function omniverse_get_switch_param( $settings, $value ) {
		if ( '0' === $value ) {
			$value = 0;
		} elseif ( empty( $value ) && isset( $settings['default'] ) ) {
			$value = $settings['default'];
		}

		$settings['true_text']  = isset( $settings['true_text'] ) ? $settings['true_text'] : esc_html__( 'Yes', 'omniverse' );
		$settings['false_text'] = isset( $settings['false_text'] ) ? $settings['false_text'] : esc_html__( 'No', 'omniverse' );

		ob_start();
		?>
		<div class="dn-switcher-btn<?php echo esc_attr( (string) $value === (string) $settings['true_state'] ? ' dn-active' : '' ); ?>" data-on="<?php echo esc_attr( $settings['true_state'] ); ?>" data-off="<?php echo esc_attr( $settings['false_state'] ); ?>">
			<input type="hidden" class="switch-field-value wpb_vc_param_value" name="<?php echo esc_attr( $settings['param_name'] ); ?>" value="<?php echo esc_attr( $value ); ?>">
			<div class="dn-switcher-dot-wrap">
				<div class="dn-switcher-dot"></div>
			</div>
			<div class="dn-switcher-labels">
				<span class="dn-switcher-label dn-on">
					<?php echo esc_html( $settings['true_text'] ); ?>
				</span>

				<span class="dn-switcher-label dn-off">
					<?php echo esc_html( $settings['false_text'] ); ?>
				</span>
			</div>
		</div>
		<?php

		return ob_get_clean();
	}
}
