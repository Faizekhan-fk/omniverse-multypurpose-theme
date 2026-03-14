<?php
if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

/**
* ------------------------------------------------------------------------------------------------
*  Compare element map
* ------------------------------------------------------------------------------------------------
*/
if ( ! function_exists( 'omniverse_get_vc_shortcode_compare' ) ) {
	function omniverse_get_vc_shortcode_compare() {
		return array(
			'name'        => esc_html__( 'Compare', 'omniverse' ),
			'base'        => 'omniverse_compare',
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Required for the compare table page.', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/compare.svg',
			'params' => array(
				array(
					'type' => 'wd_notice',
					'param_name' => 'notice',
					'notice_type' => 'info',
					'value' => esc_html__(
						'This element is created for the compare page and you can find all its configuration in Theme Settings.',
						'omniverse'
					),
				)
			),
		);
	}
}


