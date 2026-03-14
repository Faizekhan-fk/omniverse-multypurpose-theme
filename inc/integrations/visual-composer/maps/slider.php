<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}
/**
* ------------------------------------------------------------------------------------------------
* OmniVerse slider element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_slider' ) ) {
	function omniverse_get_vc_map_slider() {
		return array(
			'name'        => esc_html__( 'Slider', 'omniverse' ),
			'base'        => 'omniverse_slider',
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'OmniVerse theme slider', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/slider.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_dropdown',
					'heading'    => esc_html__( 'Slider', 'omniverse' ),
					'param_name' => 'slider',
					'callback'   => 'omniverse_get_sliders_for_vc',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Synchronization', 'omniverse' ),
					'param_name'       => 'carousel_sync',
					'value'            => array(
						esc_html__( 'Disabled', 'omniverse' )  => '',
						esc_html__( 'As parent', 'omniverse' ) => 'parent',
						esc_html__( 'As child', 'omniverse' )  => 'child',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'ID', 'omniverse' ),
					'param_name'       => 'sync_parent_id',
					'std'              => 'wd_' . uniqid(),
					'save_always'      => true,
					'wd_dependency'    => array(
						'element' => 'carousel_sync',
						'value'   => array( 'parent' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'ID', 'omniverse' ),
					'param_name'       => 'sync_child_id',
					'wd_dependency'    => array(
						'element' => 'carousel_sync',
						'value'   => array( 'child' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
			),
		);
	}
}

if ( ! function_exists( 'omniverse_get_sliders_for_vc' ) ) {
	function omniverse_get_sliders_for_vc() {
		$args    = array(
			'taxonomy'   => 'omniverse_slider',
			'hide_empty' => false,
		);
		$sliders = get_terms( $args );

		if ( is_wp_error( $sliders ) || empty( $sliders ) ) {
			return array();
		}

		$data = array();

		foreach ( $sliders as $slider ) {
			$data[ $slider->name ] = $slider->slug;
		}

		return $data;
	}
}
