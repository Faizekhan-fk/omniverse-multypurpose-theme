<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}
use DN\Admin\Modules\Options;

/**
 * Custom CSS section.
 */
Options::add_field(
	array(
		'id'       => 'custom_css',
		'name'     => esc_html__('Global custom CSS', 'omniverse' ),
		'type'     => 'editor',
		'language' => 'css',
		'section'  => 'custom_css',
		'priority' => 10,
	)
);

Options::add_field(
	array(
		'id'       => 'css_desktop',
		'name'     =>  esc_html__('Custom CSS for desktop', 'omniverse'),
		'type'     => 'editor',
		'language' => 'css',
		'section'  => 'custom_css',
		'priority' => 20,

	)
);

Options::add_field(
	array(
		'id'       => 'css_tablet',
		'name'     => esc_html__('Custom CSS for tablet', 'omniverse'),
		'type'     => 'editor',
		'language' => 'css',
		'section'  => 'custom_css',
		'priority' => 30,

	)
);

Options::add_field(
	array(
		'id'       => 'css_wide_mobile',
		'name'     => esc_html__('Custom CSS for mobile landscape', 'omniverse'),
		'type'     => 'editor',
		'language' => 'css',
		'section'  => 'custom_css',
		'priority' => 40,

	)
);

Options::add_field(
	array(
		'id'       => 'css_mobile',
		'name'     => esc_html__('Custom CSS for mobile', 'omniverse'),
		'type'     => 'editor',
		'language' => 'css',
		'section'  => 'custom_css',
		'priority' => 50,

	)
);

Options::add_field(
	array(
		'id'       => 'css_backend',
		'name'     => esc_html__( 'Custom CSS for admin dashboard', 'omniverse' ),
		'type'     => 'editor',
		'language' => 'css',
		'section'  => 'custom_css',
		'priority' => 60,
	)
);
