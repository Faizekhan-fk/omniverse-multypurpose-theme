<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
*  360 View element map
* ------------------------------------------------------------------------------------------------
*/

if( ! function_exists( 'omniverse_get_vc_map_3d_view' ) ) {
	function omniverse_get_vc_map_3d_view() {
		return array(
			'name'        => esc_html__( '360 degree view', 'omniverse' ),
			'base'        => 'omniverse_3d_view',
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Showcase your product as 3D model', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/360-degree.svg',
			'params'      => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'omniverse' ),
					'param_name' => 'title',
				),
				array(
					'type'       => 'attach_images',
					'heading'    => esc_html__( 'Images', 'omniverse' ),
					'param_name' => 'images',
					'value'      => '',
					'hint'       => esc_html__( 'Select images from media library. All images should represent your product from different angles of view.', 'omniverse' )
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' )
				),
			),
		);
	}
}
