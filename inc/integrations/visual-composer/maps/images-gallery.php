<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}
/**
* ------------------------------------------------------------------------------------------------
* Images gallery element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_gallery' ) ) {
	function omniverse_get_vc_map_gallery() {
		return array(
			'name'        => esc_html__( 'Images gallery', 'omniverse' ),
			'base'        => 'omniverse_gallery',
			'class'       => '',
			'category'    => function_exists( 'omniverse_get_tab_title_category_for_wpb' ) ? omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ) : esc_html__( 'Theme elements', 'omniverse' ),
			'description' => esc_html__( 'Images grid/carousel', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/images-gallery.svg',
			'params'      => array(
				array(
					'param_name' => 'omniverse_css_id',
					'type'       => 'omniverse_css_id',
				),
				/**
				 * Images
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Images', 'omniverse' ),
					'param_name' => 'images_divider',
				),
				array(
					'type'             => 'attach_images',
					'heading'          => esc_html__( 'Images', 'omniverse' ),
					'param_name'       => 'images',
					'value'            => '',
					'hint'             => esc_html__( 'Select images from media library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'param_name'       => 'img_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
				),
				array(
					'heading'       => esc_html__( 'Rounding', 'omniverse' ),
					'type'          => 'wd_select',
					'param_name'    => 'rounding_size',
					'style'         => 'select',
					'selectors'     => array(
						'{{WRAPPER}}' => array(
							'--wd-brd-radius: {{VALUE}}px;',
						),
					),
					'devices'       => array(
						'desktop' => array(
							'value' => '',
						),
					),
					'value'         => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( '0', 'omniverse' )      => '0',
						esc_html__( '5', 'omniverse' )      => '5',
						esc_html__( '8', 'omniverse' )      => '8',
						esc_html__( '12', 'omniverse' )     => '12',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'generate_zero' => true,
				),
				array(
					'heading'       => esc_html__( 'Custom rounding', 'omniverse' ),
					'type'          => 'wd_slider',
					'param_name'    => 'custom_rounding_size',
					'selectors'     => array(
						'{{WRAPPER}}' => array(
							'--wd-brd-radius: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'       => array(
						'desktop' => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'         => array(
						'px' => array(
							'min'  => 0,
							'max'  => 300,
							'step' => 1,
						),
						'%'  => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					),
					'dependency'    => array(
						'element' => 'rounding_size',
						'value'   => function_exists( 'omniverse_compress' ) ? omniverse_compress(
							wp_json_encode(
								array(
									'devices' => array(
										'desktop' => array(
											'value' => 'custom',
										),
									),
								)
							)
						) : '',
					),
					'generate_zero' => true,
				),
				/**
				 * Layout
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Layout', 'omniverse' ),
					'param_name' => 'layout_divider',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'View', 'omniverse' ),
					'param_name'  => 'view',
					'save_always' => true,
					'value'       => array(
						esc_html__( 'Default grid', 'omniverse' ) => 'grid',
						esc_html__( 'Masonry grid', 'omniverse' ) => 'masonry',
						esc_html__( 'Carousel', 'omniverse' ) => 'carousel',
						esc_html__( 'Justified gallery', 'omniverse' ) => 'justified',
					),
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Space between images', 'omniverse' ),
					'param_name'       => 'spacing_tabs',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'dependency'       => array(
						'element'            => 'view',
						'value_not_equal_to' => array( 'justified' ),
					),
					'default'          => 'desktop',
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'spacing',
					'value'            => array(
						0,
						2,
						6,
						10,
						20,
						30,
					),
					'dependency'       => array(
						'element'            => 'view',
						'value_not_equal_to' => array( 'justified' ),
					),
					'wd_dependency'    => array(
						'element' => 'spacing_tabs',
						'value'   => array( 'desktop' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'spacing_tablet',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						'0'  => '0',
						'2'  => '2',
						'6'  => '6',
						'10' => '10',
						'20' => '20',
						'30' => '30',
					),
					'std'              => '',
					'dependency'       => array(
						'element'            => 'view',
						'value_not_equal_to' => array( 'justified' ),
					),
					'wd_dependency'    => array(
						'element' => 'spacing_tabs',
						'value'   => array( 'tablet' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'spacing_mobile',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						'0'  => '0',
						'2'  => '2',
						'6'  => '6',
						'10' => '10',
						'20' => '20',
						'30' => '30',
					),
					'std'              => '',
					'dependency'       => array(
						'element'            => 'view',
						'value_not_equal_to' => array( 'justified' ),
					),
					'wd_dependency'    => array(
						'element' => 'spacing_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Columns', 'omniverse' ),
					'hint'             => esc_html__( 'Number of columns in the grid.', 'omniverse' ),
					'param_name'       => 'columns_tabs',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'dependency'       => array(
						'element' => 'view',
						'value'   => array( 'grid', 'masonry' ),
					),
					'default'          => 'desktop',
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'columns',
					'value'            => array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					),
					'std'              => '3',
					'dependency'       => array(
						'element' => 'view',
						'value'   => array( 'grid', 'masonry' ),
					),
					'wd_dependency'    => array(
						'element' => 'columns_tabs',
						'value'   => array( 'desktop' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'columns_tablet',
					'value'            => array(
						esc_html__( 'Auto', 'omniverse' ) => 'auto',
						'1'                              => '1',
						'2'                              => '2',
						'3'                              => '3',
						'4'                              => '4',
						'5'                              => '5',
						'6'                              => '6',
					),
					'std'              => 'auto',
					'dependency'       => array(
						'element' => 'view',
						'value'   => array( 'grid', 'masonry' ),
					),
					'wd_dependency'    => array(
						'element' => 'columns_tabs',
						'value'   => array( 'tablet' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'columns_mobile',
					'value'            => array(
						esc_html__( 'Auto', 'omniverse' ) => 'auto',
						'1'                              => '1',
						'2'                              => '2',
						'3'                              => '3',
						'4'                              => '4',
						'5'                              => '5',
						'6'                              => '6',
					),
					'std'              => 'auto',
					'dependency'       => array(
						'element' => 'view',
						'value'   => array( 'grid', 'masonry' ),
					),
					'wd_dependency'    => array(
						'element' => 'columns_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'       => 'omniverse_empty_space',
					'param_name' => 'omniverse_empty_space',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Horizontal  align', 'omniverse' ),
					'param_name'       => 'horizontal_align',
					'value'            => array(
						esc_html__( 'Left', 'omniverse' )   => 'left',
						esc_html__( 'Center', 'omniverse' ) => 'center',
						esc_html__( 'Right', 'omniverse' )  => 'right',
					),
					'images_value'     => array(
						'left'   => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/horizontal/left.png',
						'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/horizontal/center.png',
						'right'  => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/horizontal/right.png',
					),
					'std'              => 'center',
					'wood_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column content-position',
					'dependency'       => array(
						'element' => 'view',
						'value'   => array( 'grid', 'masonry', 'carousel' ),
					),
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Vertical align', 'omniverse' ),
					'param_name'       => 'vertical_align',
					'value'            => array(
						esc_html__( 'Top', 'omniverse' )    => 'top',
						esc_html__( 'Middle', 'omniverse' ) => 'middle',
						esc_html__( 'Bottom', 'omniverse' ) => 'bottom',
					),
					'images_value'     => array(
						'top'    => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/vertical/top.png',
						'middle' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/vertical/middle.png',
						'bottom' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/vertical/bottom.png',
					),
					'std'              => 'middle',
					'wood_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column content-position',
					'dependency'       => array(
						'element' => 'view',
						'value'   => array( 'grid', 'masonry', 'carousel' ),
					),
				),
				/**
				 * Carousel
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Carousel', 'omniverse' ),
					'group'      => esc_html__( 'Carousel', 'omniverse' ),
					'param_name' => 'carousel_divider',
					'dependency' => array(
						'element' => 'view',
						'value'   => array( 'carousel' ),
					),
				),
				/**
				 * Click action
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Click action', 'omniverse' ),
					'param_name' => 'click_divider',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'On click action', 'omniverse' ),
					'param_name'       => 'on_click',
					'value'            => array(
						esc_html__( 'Lightbox', 'omniverse' ) => 'lightbox',
						esc_html__( 'Custom link', 'omniverse' ) => 'links',
						esc_html__( 'None', 'omniverse' ) => 'none',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Open in new tab', 'omniverse' ),
					'param_name'       => 'target_blank',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 0,
					'dependency'       => array(
						'element' => 'on_click',
						'value'   => array( 'links' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Images captions', 'omniverse' ),
					'hint'             => esc_html__( 'Display images captions below the images when you open them in lightbox. Captions are based on titles of your photos and can be edited in Dashboard -> Media.', 'omniverse' ),
					'param_name'       => 'caption',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 0,
					'dependency'       => array(
						'element' => 'on_click',
						'value'   => array( 'lightbox' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'exploded_textarea_safe',
					'heading'    => esc_html__( 'Custom links', 'omniverse' ),
					'param_name' => 'custom_links',
					'hint'       => esc_html__( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'omniverse' ),
					'dependency' => array(
						'element' => 'on_click',
						'value'   => array( 'links' ),
					),
				),
				/**
				 * Extra
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_divider',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Lazy loading for images', 'omniverse' ),
					'hint'             => esc_html__( 'Enable lazy loading for images for this element.', 'omniverse' ),
					'param_name'       => 'lazy_loading',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				( function_exists( 'vc_map_add_css_animation' ) ) ? vc_map_add_css_animation( true ) : '',

				function_exists( 'omniverse_get_vc_animation_map' ) ? omniverse_get_vc_animation_map( 'wd_animation' ) : '',
				function_exists( 'omniverse_get_vc_animation_map' ) ? omniverse_get_vc_animation_map( 'wd_animation_delay' ) : '',
				function_exists( 'omniverse_get_vc_animation_map' ) ? omniverse_get_vc_animation_map( 'wd_animation_duration' ) : '',

				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				function_exists( 'omniverse_get_vc_responsive_spacing_map' ) ? omniverse_get_vc_responsive_spacing_map() : '',

				// Width option (with dependency Columns option, responsive).
				omniverse_get_responsive_dependency_width_map( 'responsive_tabs' ),
				omniverse_get_responsive_dependency_width_map( 'width_desktop' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_desktop' ),
				omniverse_get_responsive_dependency_width_map( 'width_tablet' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_tablet' ),
				omniverse_get_responsive_dependency_width_map( 'width_mobile' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_mobile' ),
			),
		);
	}
}
