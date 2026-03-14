<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
*  AJAX search element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_ajax_search' ) ) {
	function omniverse_get_vc_map_ajax_search() {
		return array(
			'name'        => esc_html__( 'AJAX Search', 'omniverse' ),
			'description' => esc_html__( 'Shows AJAX search form', 'omniverse' ),
			'base'        => 'omniverse_ajax_search',
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/ajax-search.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				/**
				 * Search results
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Search results', 'omniverse' ),
					'param_name' => 'results_divider',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Number results to show', 'omniverse' ),
					'param_name'       => 'number',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Search post type', 'omniverse' ),
					'param_name'       => 'search_post_type',
					'value'            => array(
						esc_html__( 'Product', 'omniverse' ) => 'product',
						esc_html__( 'Post', 'omniverse' ) => 'post',
						esc_html__( 'Portfolio', 'omniverse' ) => 'portfolio',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Show price', 'omniverse' ),
					'param_name'       => 'price',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 1,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Show thumbnail', 'omniverse' ),
					'param_name'       => 'thumbnail',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 1,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Show category', 'omniverse' ),
					'param_name'       => 'category',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 1,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Categories selector style', 'omniverse' ),
					'param_name'       => 'cat_selector_style',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Bordered', 'omniverse' ) => 'bordered',
						esc_html__( 'Separated', 'omniverse' ) => 'separated',
					),
					'std'              => 'bordered',
					'dependency'       => array(
						'element' => 'category',
						'value'   => '1',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Style
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Form', 'omniverse' ),
					'param_name' => 'style_divider',
				),
				array(
					'heading'          => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'omniverse_image_select',
					'param_name'       => 'form_style',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'With background', 'omniverse' ) => 'with-bg',
						esc_html__( 'With background 2', 'omniverse' ) => 'with-bg-2',
						esc_html__( 'Fourth', 'omniverse' ) => '4',
					),
					'images_value'     => array(
						'default'   => OMNIVERSE_ASSETS_IMAGES . '/header-builder/search/default.jpg',
						'with-bg'   => OMNIVERSE_ASSETS_IMAGES . '/header-builder/search/with-bg.jpg',
						'with-bg-2' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/search/with-bg-2.jpg',
						'4'         => OMNIVERSE_ASSETS_IMAGES . '/header-builder/search/fourth.jpg',
					),
					'std'              => 'default',
					'omni_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-12 vc_column wd-form-style',
				),
				array(
					'heading'          => esc_html__( 'Form height', 'omniverse' ),
					'type'             => 'wd_slider',
					'param_name'       => 'form_height',
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
						'px' => array(
							'min'  => 30,
							'max'  => 100,
							'step' => 1,
						),
					),
					'selectors'        => array(
						'{{WRAPPER}} .searchform' => array(
							'--wd-form-height: {{VALUE}}{{UNIT}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'       => 'omniverse_button_set',
					'heading'    => esc_html__( 'Color Scheme', 'omniverse' ),
					'param_name' => 'omniverse_color_scheme',
					'value'      => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Light', 'omniverse' ) => 'light',
						esc_html__( 'Dark', 'omniverse' )  => 'dark',
					),
				),
				array(
					'heading'          => esc_html__( 'Text color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'form_color',
					'selectors'        => array(
						'{{WRAPPER}} .searchform' => array(
							'--wd-form-color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Placeholder color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'form_placeholder_color',
					'selectors'        => array(
						'{{WRAPPER}} .searchform' => array(
							'--wd-form-placeholder-color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Border color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'form_brd_color',
					'selectors'        => array(
						'{{WRAPPER}} .searchform' => array(
							'--wd-form-brd-color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Border color focus', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'form_brd_color_focus',
					'selectors'        => array(
						'{{WRAPPER}} .searchform' => array(
							'--wd-form-brd-color-focus: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Background color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'form_bg',
					'selectors'        => array(
						'{{WRAPPER}} .searchform' => array(
							'--wd-form-bg: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'       => esc_html__( 'Form shape', 'omniverse' ),
					'type'          => 'wd_select',
					'param_name'    => 'form_shape',
					'selectors'     => array(
						'{{WRAPPER}}' => array(
							'--wd-form-brd-radius: {{VALUE}}px;',
						),
					),
					'devices'       => array(
						'desktop' => array(
							'value' => '',
						),
					),
					'value'         => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Square', 'omniverse' ) => '0',
						esc_html__( 'Rounded', 'omniverse' ) => '5',
						esc_html__( 'Round', 'omniverse' )   => '35',
					),
					'generate_zero' => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_options_divider',
				),
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
				omniverse_get_vc_responsive_spacing_map(),
			),
		);
	}
}
