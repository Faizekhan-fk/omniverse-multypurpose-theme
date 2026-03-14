<?php

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_get_vc_map_image' ) ) {
	function omniverse_get_vc_map_image() {
		return array(
			'name'        => esc_html__( 'Image or SVG', 'omniverse' ),
			'base'        => 'omniverse_image',
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/image-or-svg.svg',
			'description' => esc_html__( 'Display JPG, PNG or SVG image', 'omniverse' ),
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),

				/**
				 * Image Option Section.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Image', 'omniverse' ),
					'param_name' => 'extra_divider',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Image', 'omniverse' ),
					'param_name'       => 'img_id',
					'hint'             => esc_html__( 'Select images from media library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'param_name'       => 'img_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Image alignment', 'omniverse' ),
					'param_name'       => 'img_align',
					'value'            => array(
						esc_html__( 'Left', 'omniverse' )   => 'left',
						esc_html__( 'Center', 'omniverse' ) => 'center',
						esc_html__( 'Right', 'omniverse' )  => 'right',
					),
					'images_value'     => array(
						'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
						'left'   => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
						'right'  => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					),
					'wood_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
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
						esc_html__( '0', 'omniverse' )  => '0',
						esc_html__( '5', 'omniverse' )  => '5',
						esc_html__( '8', 'omniverse' )  => '8',
						esc_html__( '12', 'omniverse' ) => '12',
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
				 * Extra Option Section.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_divider',
				),

				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Display inline', 'omniverse' ),
					'param_name'       => 'display_inline',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),

				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'On click action', 'omniverse' ),
					'param_name'       => 'click_action',
					'value'            => array(
						esc_html__( 'None', 'omniverse' ) => 'none',
						esc_html__( 'Lightbox', 'omniverse' ) => 'lightbox',
						esc_html__( 'Custom link', 'omniverse' ) => 'custom_link',
					),
					'hint'             => esc_html__( 'Select action for click action.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Link', 'omniverse' ),
					'param_name' => 'img_link',
					'hint'       => esc_html__( 'Enter URL if you want this image to have a link.', 'omniverse' ),
					'dependency' => array(
						'element' => 'click_action',
						'value'   => 'custom_link',
					),
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Open in new tab', 'omniverse' ),
					'param_name'       => 'img_link_blank',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'dependency'       => array(
						'element' => 'click_action',
						'value'   => 'custom_link',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				omniverse_get_vc_animation_map( 'wd_animation' ),
				omniverse_get_vc_animation_map( 'wd_animation_delay' ),
				omniverse_get_vc_animation_map( 'wd_animation_duration' ),

				omniverse_parallax_scroll_map( 'parallax_scroll' ),
				omniverse_parallax_scroll_map( 'scroll_x' ),
				omniverse_parallax_scroll_map( 'scroll_y' ),
				omniverse_parallax_scroll_map( 'scroll_z' ),
				omniverse_parallax_scroll_map( 'scroll_smooth' ),

				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'extra_classes',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),

				/**
				 * Design Option Tab.
				 */
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				omniverse_get_vc_responsive_spacing_map(),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Box Shadow', 'omniverse' ),
					'param_name'       => 'omniverse_box_shadow',
					'group'            => esc_html__( 'Design Options', 'js_composer' ),
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'wd_box_shadow',
					'param_name'       => 'wd_box_shadow',
					'group'            => esc_html__( 'Design Options', 'js_composer' ),
					'selectors'        => array(
						'{{WRAPPER}}' => array(
							'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
					'dependency'       => array(
						'element' => 'omniverse_box_shadow',
						'value'   => array( 'yes' ),
					),
					'default'          => array(
						'horizontal' => '0',
						'vertical'   => '0',
						'blur'       => '9',
						'spread'     => '0',
						'color'      => 'rgba(0, 0, 0, .15)',
					),
				),

				/**
				 * Advanced Tab.
				 */
				omniverse_get_vc_responsive_visible_map( 'responsive_tabs_hide' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_desktop' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_tablet' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_mobile' ),
			),
		);
	}
}
