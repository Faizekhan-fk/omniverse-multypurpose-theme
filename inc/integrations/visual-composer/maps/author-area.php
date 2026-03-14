<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
* Author area element map
* ------------------------------------------------------------------------------------------------
*/

if( ! function_exists( 'omniverse_get_vc_map_author_area' ) ) {
	function omniverse_get_vc_map_author_area() {
		return array(
			'name' => esc_html__( 'Author area', 'omniverse' ),
			'base' => 'author_area',
			'category' => function_exists( 'omniverse_get_tab_title_category_for_wpb' ) ? omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ) : esc_html__( 'Theme elements', 'omniverse' ),
			'description' => esc_html__( 'Widget for author information', 'omniverse' ),
			'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/author-area.svg',
			'params' =>  omniverse_get_author_area_params()
		);
	}
}

if( ! function_exists( 'omniverse_get_author_area_params' ) ) {
	function omniverse_get_author_area_params() {
		return apply_filters( 'omniverse_get_author_area_params', array(
			array(
				'param_name' => 'omniverse_css_id',
				'type'       => 'omniverse_css_id',
			),
			/**
			* Image
			*/
			array(
				'type' => 'omniverse_title_divider',
				'holder' => 'div',
				'title' => esc_html__( 'Image', 'omniverse' ),
				'param_name' => 'image_divider'
			),	
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'omniverse' ),
				'param_name' => 'image',
				'value' => '',
				'hint' => esc_html__( 'Select image from media library.', 'omniverse' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Image size', 'omniverse' ),
				'param_name' => 'img_size',
				'hint' => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
				'description' => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
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
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Author name', 'omniverse' ),
				'param_name' => 'author_name',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => esc_html__( 'Author bio', 'omniverse' ),
				'param_name' => 'content',
				'hint' => esc_html__( 'Write down a few words about the author.', 'omniverse' )
			),
			/**
			* Style
			*/
			array(
				'type' => 'omniverse_title_divider',
				'holder' => 'div',
				'title' => esc_html__( 'Style', 'omniverse' ),
				'param_name' => 'style_divider'
			),
			array(
				'type' => 'omniverse_image_select',
				'heading' => esc_html__( 'Text alignment', 'omniverse' ),
				'param_name' => 'alignment',
				'value' => array( 
					esc_html__( 'Left', 'omniverse' ) => 'left',
					esc_html__( 'Center', 'omniverse' ) => 'center',
					esc_html__( 'Right', 'omniverse' ) => 'right',
				),
				'images_value' => array(
					'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
					'left' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
					'right' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
				),
				'std' => 'left',
				'omni_tooltip' => true,
				'hint' => esc_html__( 'Select image alignment.', 'omniverse' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
			),
			array(
				'type' => 'omniverse_button_set',
				'heading' => esc_html__( 'Color Scheme', 'omniverse' ),
				'param_name' => 'omniverse_color_scheme',
				'value' => array(
					esc_html__( 'Inherit', 'omniverse' ) => '',
					esc_html__( 'Light', 'omniverse' ) => 'light',
					esc_html__( 'Dark', 'omniverse' ) => 'dark',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			/**
			* Link
			*/
			array(
				'type' => 'omniverse_title_divider',
				'holder' => 'div',
				'title' => esc_html__( 'Link', 'omniverse' ),
				'param_name' => 'link_divider'
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Author link', 'omniverse'),
				'param_name' => 'link',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Link text', 'omniverse'),
				'param_name' => 'link_text',
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
			function_exists( 'omniverse_get_vc_responsive_spacing_map' ) ? omniverse_get_vc_responsive_spacing_map() : '',
		) );
	}
}
