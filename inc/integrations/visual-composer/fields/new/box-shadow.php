<?php
/**
 * Box shadow.
 *
 * @package Omniverse
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_get_box_shadow_param' ) ) {
	/**
	 * Box shadow.
	 *
	 * @param array  $settings Settings.
	 * @param string $value    Value.
	 *
	 * @return string
	 */
	function omniverse_get_box_shadow_param( $settings, $value ) {
		$data = json_decode( omniverse_decompress( $value ), true );

		if ( ! isset( $data['devices']['desktop'] ) ) {
			$data['devices']['desktop'] = $settings['default'];
		}

		$desktop = wp_parse_args(
			$data['devices']['desktop'],
			array(
				'horizontal' => '0',
				'vertical'   => '0',
				'blur'       => '9',
				'spread'     => '0',
				'color'      => 'rgba(0, 0, 0, .15)',
			)
		);

		ob_start();
		?>
		<div class="dn-box-shadow">
			<div class="dn-box-shadow-item dn-input-append-wrap">
				<label for="horizontal">
					<?php esc_html_e( 'Horizontal', 'omniverse' ); ?>
				</label>

				<div class="dn-input-append">
					<input name="horizontal" id="horizontal" type="number" class="wd-text-input" value="<?php echo esc_attr( $desktop['horizontal'] ); ?>" aria-label="<?php esc_attr_e( 'Horizontal', 'omniverse' ); ?>">

					<span class="add-on">px</span>
				</div>
			</div>

			<div class="dn-box-shadow-item dn-input-append-wrap">
				<label for="vertical">
					<?php esc_html_e( 'Vertical', 'omniverse' ); ?>
				</label>

				<div class="dn-input-append">
					<input name="vertical" id="vertical" type="number" class="wd-text-input" value="<?php echo esc_attr( $desktop['vertical'] ); ?>" aria-label="<?php esc_attr_e( 'Vertical', 'omniverse' ); ?>">

					<span class="add-on">px</span>
				</div>
			</div>

			<div class="dn-box-shadow-item dn-input-append-wrap">
				<label for="blur_radius">
					<?php esc_html_e( 'Blur radius', 'omniverse' ); ?>
				</label>

				<div class="dn-input-append">
					<input name="blur_radius" id="blur" type="number" class="wd-text-input" value="<?php echo esc_attr( $desktop['blur'] ); ?>" aria-label="<?php esc_attr_e( 'Blur radius', 'omniverse' ); ?>">

					<span class="add-on">px</span>
				</div>
			</div>

			<div class="dn-box-shadow-item dn-input-append-wrap">
				<label for="spread_radius">
					<?php esc_html_e( 'Spread radius', 'omniverse' ); ?>
				</label>

				<div class="dn-input-append dn-input-append-wrap">
					<input name="spread_radius" id="spread" type="number" class="wd-text-input" value="<?php echo esc_attr( $desktop['spread'] ); ?>" aria-label="<?php esc_attr_e( 'Spread radius', 'omniverse' ); ?>">

					<span class="add-on">px</span>
				</div>
			</div>

			<div class="dn-box-shadow-item dn-input-append-wrap wd-color">
				<label for="color">
					<?php esc_html_e( 'Color', 'omniverse' ); ?>
				</label>

				<input name="color" id="color" type="text" data-alpha-enabled="true" class="wd-color-input" value="<?php echo esc_attr( $desktop['color'] ); ?>">
			</div>

			<input type="hidden" class="wpb_vc_param_value" name="<?php echo esc_attr( $settings['param_name'] ); ?>" value="<?php echo esc_attr( $value ); ?>" data-settings="<?php echo esc_attr( wp_json_encode( $settings ) ); ?>">
		</div>
		<?php

		return ob_get_clean();
	}
}
