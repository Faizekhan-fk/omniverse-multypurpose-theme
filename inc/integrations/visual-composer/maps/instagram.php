<?php
if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}
/**
* ------------------------------------------------------------------------------------------------
* Instagram element map
* ------------------------------------------------------------------------------------------------
*/
if ( ! function_exists( 'omniverse_get_vc_map_instagram' ) ) {
	function omniverse_get_vc_map_instagram() {
		return array(
			'name'        => esc_html__( 'Instagram', 'omniverse' ),
			'base'        => 'omniverse_instagram',
			'category'    => function_exists( 'omniverse_get_tab_title_category_for_wpb' ) ?
				omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ) : esc_html__( 'Theme elements', 'omniverse' ),
			'description' => esc_html__( 'Instagram photos', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/instagram.svg',
			'params'      => omniverse_get_instagram_params(),
		);
	}
}

if ( ! function_exists( 'omniverse_get_instagram_params' ) ) {
	function omniverse_get_instagram_params() {
		$typography = array(
			'font_family'    => '',
			'font_size'      => '',
			'font_weight'    => '',
			'text_transform' => '',
			'font_style'     => '',
			'line_height'    => '',
		);

		if ( 'wpb' === omniverse_get_current_page_builder() ) {
			$typography = omniverse_get_typography_map(
				array(
					'title'    => esc_html__( 'Typography', 'omniverse' ),
					'key'      => 'content_typography',
					'selector' => '{{WRAPPER}} .wd-insta-cont-inner',
				)
			);
		}

		return apply_filters(
			'omniverse_get_instagram_params',
			array(
				/**
				 * Data
				 */
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Data', 'omniverse' ),
					'param_name' => 'data_divider',
				),
				array(
					'type'       => 'omniverse_button_set',
					'heading'    => esc_html__( 'Source type', 'omniverse' ),
					'param_name' => 'data_source',
					'value'      => array(
						esc_html__( 'API', 'omniverse' )    => 'api',
						esc_html__( 'Images', 'omniverse' ) => 'images',
						esc_html__( 'Scrape (deprecated)', 'omniverse' ) => 'scrape',
						esc_html__( 'AJAX (deprecated)', 'omniverse' ) => 'ajax',
					),
					'std'        => 'scrape',
					'hint'       => 'API request type<br>
Scrape - parse Instagram page and take photos by username. Now deprecated and may be blocked by Instagram.<br>
AJAX - send AJAX request to the Instagram page on frontend. Works more stable then simple scrape.<br>
API - the best safe and legal option to obtain Instagram photos. Requires Instagram APP configuration. <br>
Follow our documentation <a href="https://zynxsol.com/docs/omniverse/faq-guides/setup-instagram-api/" target="_blank">here</a>',
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
					'dependency'       => array(
						'element' => 'data_source',
						'value'   => array( 'images' ),
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'param_name'       => 'images_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\'. Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'data_source',
						'value'   => array( 'images' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Images link', 'omniverse' ),
					'param_name'       => 'images_link',
					'dependency'       => array(
						'element' => 'data_source',
						'value'   => array( 'images' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Likes limit', 'omniverse' ),
					'param_name'       => 'images_likes',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'default'          => '1000-10000',
					'description'      => 'Example: 1000-10000',
					'dependency'       => array(
						'element' => 'data_source',
						'value'   => array( 'images' ),
					),
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Comments limit', 'omniverse' ),
					'param_name'       => 'images_comments',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'default'          => '0-1000',
					'description'      => 'Example: 0-1000',
					'dependency'       => array(
						'element' => 'data_source',
						'value'   => array( 'images' ),
					),
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Rounded corners for images', 'omniverse' ),
					'skip_in'          => 'widget',
					'param_name'       => 'rounded',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 0,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Hide likes and comments', 'omniverse' ),
					'skip_in'          => 'widget',
					'param_name'       => 'hide_mask',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 0,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
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
				* Content
				*/
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Content', 'omniverse' ),
					'param_name' => 'content_divider',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'omniverse' ),
					'param_name' => 'title',
				),
				array(
					'type'             => 'omniverse_slider',
					'heading'          => esc_html__( 'Number of photos', 'omniverse' ),
					'param_name'       => 'number',
					'value'            => array(
						'9'  => '9',
						'12' => '12',
						'11' => '11',
						'10' => '10',
						'8'  => '8',
						'7'  => '7',
						'6'  => '6',
						'5'  => '5',
						'4'  => '4',
						'3'  => '3',
						'2'  => '2',
						'1'  => '1',
					),
					'min'              => '1',
					'max'              => '30',
					'step'             => '1',
					'default'          => '9',
					'units'            => '',
					'dependency'       => array(
						'element'            => 'data_source',
						'value_not_equal_to' => array( 'images' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Photo size', 'omniverse' ),
					'param_name'       => 'size',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\'. Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'dependency'       => array(
						'element'            => 'data_source',
						'value_not_equal_to' => array( 'images' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'textarea_html',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Instagram text', 'omniverse' ),
					'param_name' => 'content',
					'skip_in'    => 'widget',
					'hint'       => esc_html__( 'Add here few words about your instagram profile.', 'omniverse' ),
				),

				array(
					'type'             => 'wd_slider',
					'param_name'       => 'content_width',
					'heading'          => esc_html__( 'Content width', 'omniverse' ),
					'devices'          => array(
						'desktop' => array(
							'unit'  => 'px',
							'value' => '',
						),
						'tablet'  => array(
							'unit'  => 'px',
							'value' => '',
						),
						'mobile'  => array(
							'unit'  => 'px',
							'value' => '',
						),
					),
					'range'            => array(
						'%'  => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
						'px' => array(
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						),
					),
					'selectors'        => array(
						'{{WRAPPER}} .wd-insta-cont-inner' => array(
							'max-width: {{VALUE}}{{UNIT}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Color Scheme', 'omniverse' ),
					'param_name'       => 'content_color_scheme',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Light', 'omniverse' ) => 'light',
						esc_html__( 'Dark', 'omniverse' )  => 'dark',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Text color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'content_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-insta-cont-inner' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Background color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'content_bg_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-insta-cont-inner' => array(
							'background-color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				$typography['font_family'],
				$typography['font_size'],
				$typography['font_weight'],
				$typography['text_transform'],
				$typography['font_style'],
				$typography['line_height'],
				/**
				* Link
				*/
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Link', 'omniverse' ),
					'param_name' => 'link_divider',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Username', 'omniverse' ),
					'hint'       => esc_html__( 'Enter your Instagram username. For example: asos', 'omniverse' ),
					'param_name' => 'username',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Open link in', 'omniverse' ),
					'param_name'       => 'target',
					'value'            => array(
						esc_html__( 'Current window (_self)', 'omniverse' ) => '_self',
						esc_html__( 'New window (_blank)', 'omniverse' ) => '_blank',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Link text', 'omniverse' ),
					'param_name'       => 'link',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
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
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Layout', 'omniverse' ),
					'param_name'       => 'design',
					'skip_in'          => 'widget',
					'value'            => array(
						esc_html__( 'Grid', 'omniverse' ) => 'grid',
						esc_html__( 'Carousel', 'omniverse' ) => 'slider',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Photos per row', 'omniverse' ),
					'hint'             => esc_html__( 'Number of photos per row for grid design or items in slider per view.', 'omniverse' ),
					'param_name'       => 'per_row_tabs',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'default'          => 'desktop',
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
					'skip_in'          => 'widget',
				),
				array(
					'type'             => 'omniverse_slider',
					'param_name'       => 'per_row',
					'min'              => '1',
					'max'              => '8',
					'step'             => '1',
					'default'          => '4',
					'units'            => 'col',
					'wd_dependency'    => array(
						'element' => 'per_row_tabs',
						'value'   => array( 'desktop' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
					'skip_in'          => 'widget',
				),
				array(
					'type'             => 'omniverse_slider',
					'param_name'       => 'per_row_tablet',
					'min'              => '1',
					'max'              => '8',
					'step'             => '1',
					'default'          => '',
					'units'            => 'col',
					'wd_dependency'    => array(
						'element' => 'per_row_tabs',
						'value'   => array( 'tablet' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
					'skip_in'          => 'widget',
				),
				array(
					'type'             => 'omniverse_slider',
					'param_name'       => 'per_row_mobile',
					'min'              => '1',
					'max'              => '8',
					'step'             => '1',
					'default'          => '',
					'units'            => 'col',
					'wd_dependency'    => array(
						'element' => 'per_row_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
					'skip_in'          => 'widget',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Add spaces between photos', 'omniverse' ),
					'skip_in'          => 'widget',
					'param_name'       => 'spacing',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 0,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Space between images', 'omniverse' ),
					'param_name'       => 'spacing_custom_tabs',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'default'          => 'desktop',
					'dependency'       => array(
						'element' => 'spacing',
						'value'   => array( '1' ),
					),
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
					'skip_in'          => 'widget',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'spacing_custom',
					'skip_in'          => 'widget',
					'value'            => array(
						0,
						2,
						6,
						10,
						20,
						30,
					),
					'std'              => 6,
					'wd_dependency'    => array(
						'element' => 'spacing_custom_tabs',
						'value'   => array( 'desktop' ),
					),
					'dependency'       => array(
						'element' => 'spacing',
						'value'   => array( '1' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'spacing_custom_tablet',
					'skip_in'          => 'widget',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						'0'  => 0,
						'2'  => 2,
						'6'  => 6,
						'10' => 10,
						'20' => 20,
						'30' => 30,
					),
					'std'              => '',
					'wd_dependency'    => array(
						'element' => 'spacing_custom_tabs',
						'value'   => array( 'tablet' ),
					),
					'dependency'       => array(
						'element' => 'spacing',
						'value'   => array( '1' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'spacing_custom_mobile',
					'skip_in'          => 'widget',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						'0'  => 0,
						'2'  => 2,
						'6'  => 6,
						'10' => 10,
						'20' => 20,
						'30' => 30,
					),
					'std'              => '',
					'wd_dependency'    => array(
						'element' => 'spacing_custom_tabs',
						'value'   => array( 'mobile' ),
					),
					'dependency'       => array(
						'element' => 'spacing',
						'value'   => array( '1' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Carousel', 'omniverse' ),
					'group'      => esc_html__( 'Carousel', 'omniverse' ),
					'param_name' => 'carousel_divider',
					'dependency' => array(
						'element' => 'design',
						'value'   => array( 'slider' ),
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
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'skip_in'    => 'widget',
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
			)
		);
	}
}
