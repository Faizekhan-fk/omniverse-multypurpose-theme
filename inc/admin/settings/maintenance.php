<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use DN\Admin\Modules\Options;

Options::add_field(
	array(
		'id'          => 'maintenance_mode',
		'name'        => esc_html__( 'Enable maintenance mode', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'enable-maintenance-mode.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'If enabled you need to create maintenance page in Dashboard - Pages - Add new. Choose "Template" to be "Maintenance" in "Page attributes". Or you can import the page from our demo in "Prebuilt websites" page', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'maintenance',
		'default'     => false,
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'maintenance_access_key',
		'name'        => esc_html__( 'Access key for maintenance mode', 'omniverse' ),
		'description' => esc_html__( 'You can pass a special GET parameter to suppress the maintenance mode. For example, https://website.com/?suppress_maintenance', 'omniverse' ),
		'type'        => 'text_input',
		'section'     => 'maintenance',
		'requires'    => array(
			array(
				'key'     => 'maintenance_mode',
				'compare' => 'equals',
				'value'   => true,
			),
		),
		'default'     => '',
		'priority'    => 20,
	)
);
