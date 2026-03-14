<?php
/**
 * This file has function for rendering dropdown field.
 *
 * @package Omniverse.
 */

use DN\Admin\Modules\Options\Google_Fonts;

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_get_fonts_param' ) ) {
	/**
	 * This function rendering dropdown field.
	 *
	 * @param array  $settings Settings.
	 * @param string $value    Value.
	 *
	 * @return false|string
	 */
	function omniverse_get_fonts_param( $settings, $value ) {
		$settings['style']         = 'select';
		$settings['devices']       = array(
			'desktop' => array(
				'value' => '',
			),
		);
		$settings['value']         = array(
			esc_html__( 'Default', 'omniverse' ) => '',
		);
		$settings['options_group'] = array();

		// From theme settings.
		$secondary_font = omniverse_get_opt( 'secondary-font' );
		$primary_font   = omniverse_get_opt( 'primary-font' );

		if ( isset( $secondary_font[0] ) ) {
			$secondary_font_title = isset( $secondary_font[0]['font-family'] ) ? esc_html__( 'Secondary font', 'omniverse' ) . ' (' . $secondary_font[0]['font-family'] . ')' : esc_html__( 'Secondary font', 'omniverse' );

			$settings['options_group'][ esc_html__( 'Theme fonts', 'omniverse' ) ][ $secondary_font_title ] = $secondary_font[0]['font-family'];
		}

		if ( isset( $primary_font[0] ) ) {
			$primary_font_title = isset( $primary_font[0]['font-family'] ) ? esc_html__( 'Title font', 'omniverse' ) . ' (' . $primary_font[0]['font-family'] . ')' : esc_html__( 'Title', 'omniverse' );

			$settings['options_group'][ esc_html__( 'Theme fonts', 'omniverse' ) ][ $primary_font_title ] = $primary_font[0]['font-family'];
		}

		// Custom fonts.
		$custom_fonts_data = omniverse_get_opt( 'multi_custom_fonts' );

		if ( isset( $custom_fonts_data['{{index}}'] ) ) {
			unset( $custom_fonts_data['{{index}}'] );
		}

		if ( is_array( $custom_fonts_data ) ) {
			foreach ( $custom_fonts_data as $font ) {
				if ( ! $font['font-name'] ) {
					continue;
				}

				$settings['options_group'][ esc_html__( 'Custom fonts', 'omniverse' ) ][ $font['font-name'] ] = $font['font-name'];
			}
		}

		// System fonts.
		$system_fonts = omniverse_get_config( 'standard-fonts' );

		foreach ( $system_fonts as $font => $title ) {
			$settings['options_group'][ esc_html__( 'System fonts', 'omniverse' ) ][ $title ] = $font;
		}

		// Typekit fonts.
		$typekit_fonts = omniverse_get_opt( 'typekit_fonts' );

		if ( $typekit_fonts ) {
			$typekit = explode( ',', $typekit_fonts );
			foreach ( $typekit as $font ) {
				$settings['options_group'][ esc_html__( 'Adobe fonts', 'omniverse' ) ][ ucfirst( trim( $font ) ) ] = trim( $font );
			}
		}

		// Google fonts.
		$google_fonts = Google_Fonts::$all_google_fonts;

		if ( $google_fonts ) {
			foreach ( $google_fonts as $font => $data ) {
				$settings['options_group'][ esc_html__( 'Google fonts', 'omniverse' ) ][ ucfirst( trim( $font ) ) ] = trim( $font );
			}
		}

		return omniverse_get_select_param( $settings, $value );
	}
}
