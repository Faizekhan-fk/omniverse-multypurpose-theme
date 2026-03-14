<?php
/**
 * Elementor accordion custom controls
 *
 * @package dn
 */

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_add_accordion_custom_controls' ) ) {
	/**
	 * Accordion custom controls
	 *
	 * @since 1.0.0
	 *
	 * @param object $element The control.
	 */
	function omniverse_add_accordion_custom_controls( $element ) {
		$element->add_control(
			'wd_theme_style',
			[
				'label'        => esc_html__( 'Theme style', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'theme-style',
				'prefix_class' => 'wd-accordion-',
				'render_type'  => 'template',
			]
		);
	}

	add_action( 'elementor/element/accordion/section_title_style/after_section_start', 'omniverse_add_accordion_custom_controls' );
}
