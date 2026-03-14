<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
* Menu price elements map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_menu_price' ) ) {
	function omniverse_get_vc_map_menu_price() {
		return array(
			'name' => esc_html__( 'Menu price', 'omniverse' ),
			'base' => 'omniverse_menu_price',
			'class' => '',
			'category' => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Showcase your menu', 'omniverse' ),
			'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/menu-price.svg',
			'params' => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				/**
				 * Content
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Content', 'omniverse' ),
					'param_name' => 'content_divider'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'omniverse' ),
					'param_name' => 'title',
					'holder' => 'div',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Description', 'omniverse' ),
					'param_name' => 'description',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Price', 'omniverse' ),
					'param_name' => 'price',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'vc_link',
					'heading' => esc_html__( 'Link', 'omniverse'),
					'param_name' => 'link',
					'hint' => esc_html__( 'Enter URL if you want this box to have a link.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image', 'omniverse' ),
					'param_name' => 'img_id',
					'hint' => esc_html__( 'Select images from media library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Extra
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_divider'
				),
				( function_exists( 'vc_map_add_css_animation' ) ) ? vc_map_add_css_animation( true ) : '',
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				omniverse_get_vc_responsive_spacing_map(),
			)
		);
	}
}