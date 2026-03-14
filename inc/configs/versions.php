<?php

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

/**
 * ------------------------------------------------------------------------------------------------
 * Array of versions for dummy content import section
 * ------------------------------------------------------------------------------------------------
 */
return apply_filters(
	'omniverse_get_versions_to_import',
	[
		'lms'                  => [
			'title'      => 'LMS Theme',
			'process'    => 'xml,home,options,widgets,headers,images',
			'type'       => 'version',
			'b_type'     => 'lms',
			'base'       => 'lms_base',
			'link'       => 'https://omniverse.zynxsol.com/lms/',
			'categories' => [
				[
					'name' => 'Education',
					'slug' => 'education',
				],
			],
		],
		'leather'                  => [
			'title'      => 'Leather Theme',
			'process'    => 'xml,home,options,widgets,headers,images',
			'type'       => 'version',
			'b_type'     => 'ecommerce',
			'base'       => 'leather_base',
			'link'       => 'https://omniverse.zynxsol.com/leather/',
			'categories' => [
				[
					'name' => 'Fashion',
					'slug' => 'fashion',
				],
			],
		],
		'health-machinery' => [
			'title'      => 'Health Machinery',
			'process'    => 'xml,home,options,widgets,headers,images',
			'type'       => 'version',
			'b_type'     => 'ecommerce',
			'base'       => 'health-machinery_base',
			'link'       => 'https://omniverse.zynxsol.com/healthcare/',
			'categories' => [
				[
					'name' => 'Health',
					'slug' => 'health',
				],
			],
		],
		'lms_base' => [
			'title'   => 'Base content lms (required)',
			'process' => 'xml,xml_images,widgets,options,headers',
			'type'    => 'base',
		],
		'leather_base' => [
			'title'   => 'Base content lms (required)',
			'process' => 'xml,xml_images,widgets,options,headers',
			'type'    => 'base',
		],
		'health-machinery_base' => [
			'title'   => 'Base content lms (required)',
			'process' => 'xml,xml_images,widgets,options,headers',
			'type'    => 'base',
		],
	]
);
