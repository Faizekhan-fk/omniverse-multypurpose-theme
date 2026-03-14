<?php
/**
 * Custom JS options
 *
 * @package dn
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use DN\Admin\Modules\Options;

Options::add_field(
	array(
		'id'       => 'custom_js',
		'name'     => esc_html__( 'Global custom JS', 'omniverse' ),
		'type'     => 'editor',
		'language' => 'javascript',
		'section'  => 'custom_js',
		'priority' => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'js_ready',
		'name'        => esc_html__( 'On document ready', 'omniverse' ),
		'description' => esc_html__( 'Will be executed on $(document).ready()', 'omniverse' ),
		'type'        => 'editor',
		'language'    => 'javascript',
		'section'     => 'custom_js',
		'priority'    => 20,
	)
);
