<?php

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_get_vc_map_html_block' ) ) {
	function omniverse_get_vc_map_html_block() {
		return array(
			'name'        => esc_html__( 'HTML Block', 'omniverse' ),
			'base'        => 'html_block',
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Display pre-built HTML block', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/html-block.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_dropdown',
					'heading'    => esc_html__( 'Select block', 'omniverse' ),
					'param_name' => 'id',
					'callback'   => 'omniverse_get_html_blocks_array_with_empty',
				),
			),
		);
	}
}
