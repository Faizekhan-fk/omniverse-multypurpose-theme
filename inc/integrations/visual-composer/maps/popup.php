<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
* Popup element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_popup' ) ) {
	function omniverse_get_vc_map_popup() {
		$omniverse_popup_params = vc_map_integrate_shortcode( omniverse_get_omniverse_button_shortcode_args(), '', 'Button', array(
			'exclude' => array(
				'link',
				'el_class',
				'smooth_divider',
				'button_smooth_scroll',
				'button_smooth_scroll_time',
				'button_smooth_scroll_offset',
				'collapsible_content_divider',
				'wd_button_collapsible_content',
				'wd_button_collapsible_content_id',
			),
		) );

		return array(
			'name' => esc_html__( 'Popup', 'omniverse' ),
			'base' => 'omniverse_popup',
			'content_element' => true,
			'as_parent' => array( 'except' => 'testimonial' ),
			'category' => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Button that shows a popup on click', 'omniverse' ),
			'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/popup.svg',
			'params' => array_merge( array(
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'General options', 'omniverse' ),
					'param_name' => 'general_divider',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'ID', 'omniverse' ),
					'hint' => esc_html__( 'If you are using multiple popups elements, be sure that all elements have unique IDs values.', 'omniverse' ),
					'param_name' => 'id',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_slider',
					'heading' => esc_html__( 'Width', 'omniverse' ),
					'param_name' => 'width',
					'min' => '150',
					'max' => '2000',
					'step' => '10',
					'default' => '800',
					'units' => 'px',
					'hint' => esc_html__( 'Popup width in pixels.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'       => esc_html__( 'Padding', 'omniverse' ),
					'type'          => 'wd_slider',
					'param_name'    => 'padding',
					'selectors'     => array(),
					'devices'       => array(
						'desktop' => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'         => array(
						'px' => array(
							'min'  => 0,
							'max'  => 200,
							'step' => 1,
						),
					),
					'generate_zero' => true,
				),
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_divider',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra button class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra content class name', 'omniverse' ),
					'param_name' => 'content_class',
				)
			), $omniverse_popup_params ),
			'js_view' => 'VcColumnView',
		);
	}
}

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if( class_exists( 'WPBakeryShortCodesContainer' ) ){
    class WPBakeryShortCode_omniverse_popup extends WPBakeryShortCodesContainer {

    }
}
