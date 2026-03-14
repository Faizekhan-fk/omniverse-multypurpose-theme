<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use DN\Admin\Modules\Options;

Options::add_field(
	array(
		'id'       => 'import_export',
		'name'     => esc_html__( 'Import / Export', 'omniverse' ),
		'type'     => 'import',
		'section'  => 'import_export',
		'priority' => 10,
	)
);

Options::add_field(
	array(
		'id'       => 'reset',
		'name'     => esc_html__( 'Reset to default', 'omniverse' ),
		'type'     => 'reset',
		'section'  => 'import_export',
		'priority' => 20,
	)
);

Options::add_field(
	array(
		'id'       => 'reset_notice',
		'type'     => 'notice',
		'style'    => 'warning',
		'name'     => '',
		'content'  => esc_html__( 'Warning: all your Theme Settings will be reset to default values. We recommend you export your current settings as a backup before doing this.', 'omniverse' ),
		'section'  => 'import_export',
		'priority' => 30,
	)
);
