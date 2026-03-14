<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
* Portfolio element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_portfolio' ) ) {
	function omniverse_get_vc_map_portfolio() {
		return array(
			'name' => esc_html__( 'Portfolio', 'omniverse' ),
			'base' => 'omniverse_portfolio',
			'category' => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Showcase your projects or gallery', 'omniverse' ),
			'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/portfolio.svg',
			'params' => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				/**
				 * Layout
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Layout', 'omniverse' ),
					'param_name' => 'layout_divider'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Layout', 'omniverse' ),
					'param_name' => 'layout',
					'value' => array(
						esc_html__( 'Grid', 'omniverse' ) => 'grid',
						esc_html__( 'Carousel', 'omniverse' ) => 'carousel',
					),
					'save_always' => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of projects per page', 'omniverse' ),
					'param_name' => 'posts_per_page',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
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
						'element' => 'layout',
						'value'   => 'grid',
					),
					'default'          => 'desktop',
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
				),
				array(
					'type' => 'dropdown',
					'param_name' => 'columns',
					'value' => array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					),
					'std' => '3',
					'dependency'       => array(
						'element' => 'layout',
						'value' => 'grid',
					),
					'wd_dependency'    => array(
						'element' => 'columns_tabs',
						'value'   => array( 'desktop' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type' => 'dropdown',
					'param_name' => 'columns_tablet',
					'value' => array(
						esc_html__( 'Auto', 'omniverse' ) => 'auto',
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					),
					'std' => 'auto',
					'dependency'       => array(
						'element' => 'layout',
						'value' => 'grid',
					),
					'wd_dependency'    => array(
						'element' => 'columns_tabs',
						'value'   => array( 'tablet' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type' => 'dropdown',
					'param_name' => 'columns_mobile',
					'value' => array(
						esc_html__( 'Auto', 'omniverse' ) => 'auto',
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					),
					'std' => 'auto',
					'dependency'       => array(
						'element' => 'layout',
						'value' => 'grid',
					),
					'wd_dependency'    => array(
						'element' => 'columns_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Space between projects', 'omniverse' ),
					'param_name'       => 'spacing_tabs',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'default'          => 'desktop',
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
				),
				array(
					'type' => 'dropdown',
					'param_name' => 'spacing',
					'value' => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => '',
						0  => 0,
						2  => 2,
						6  => 6,
						10 => 10,
						20 => 20,
						30 => 30,
					),
					'std'              => '',
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
						0  => 0,
						2  => 2,
						6  => 6,
						10 => 10,
						20 => 20,
						30 => 30,
					),
					'std'              => '',
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
						0  => 0,
						2  => 2,
						6  => 6,
						10 => 10,
						20 => 20,
						30 => 30,
					),
					'std'              => '',
					'wd_dependency'    => array(
						'element' => 'spacing_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type' => 'omniverse_switch',
					'heading' => esc_html__( 'Show categories filters', 'omniverse' ),
					'param_name' => 'filters',
					'true_state' => 1,
					'false_state' => 0,
					'default' => 0,
					'dependency'       => array(
						'element' => 'layout',
						'value' => 'grid',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_button_set',
					'heading' => esc_html__( 'Filters type', 'omniverse' ),
					'param_name' => 'filters_type',
					'value' => array(
						esc_html__( 'Links', 'omniverse' ) => 'links',
						esc_html__( 'Masonry', 'omniverse' ) => 'masonry',
					),
					'save_always' => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'default' => 'masonry',
					'dependency'       => array(
						'element' => 'filters',
						'value' => '1',
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
						'element' => 'layout',
						'value'   => array( 'carousel' ),
					),
				),
				/**
				 * Data settings
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Data settings', 'omniverse' ),
					'param_name' => 'data_divider'
				),
				array(
					'type' => 'omniverse_dropdown',
					'heading' => esc_html__( 'Categories', 'omniverse' ),
					'param_name' => 'categories',
					'callback' => 'omniverse_get_projects_cats_array',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Order by', 'omniverse' ),
					'param_name' => 'orderby',
					'value' => array(
						'',
						esc_html__( 'Date', 'omniverse' ) => 'date',
						esc_html__( 'ID', 'omniverse' ) => 'ID',
						esc_html__( 'Title', 'omniverse' ) => 'title',
						esc_html__( 'Modified', 'omniverse' ) => 'modified',
						esc_html__( 'Menu order', 'omniverse' ) => 'menu_order',
					),
					'save_always' => true,
					'hint' => sprintf( wp_kses(  __( 'Select how to sort retrieved projects. More at %s.', 'omniverse' ), array(
						'a' => array(
							'href' => array(),
							'target' => array()
						)
					)), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_button_set',
					'heading' => esc_html__( 'Sort order', 'omniverse' ),
					'param_name' => 'order',
					'value' => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Descending', 'omniverse' ) => 'DESC',
						esc_html__( 'Ascending', 'omniverse' ) => 'ASC',
					),
					'save_always' => true,
					'hint' => sprintf( wp_kses(  __( 'Designates the ascending or descending order. More at %s.', 'omniverse' ), array(
						'a' => array(
							'href' => array(),
							'target' => array()
						)
					)), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Pagination', 'omniverse' ),
					'param_name' => 'pagination',
					'value' => array(
						'' => '',
						esc_html__( 'Pagination', 'omniverse' ) => 'pagination',
						wp_kses( __( 'Load more button', 'omniverse' ), 'entities' ) => 'load_more',
						esc_html__( 'Infinit', 'omniverse' ) => 'infinit',
						esc_html__( 'Disable', 'omniverse' ) => 'disable',
					),
					'dependency'       => array(
						'element' => 'layout',
						'value' => 'grid',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Extra
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Design', 'omniverse' ),
					'group' => esc_html__( 'Design', 'omniverse' ),
					'param_name' => 'extra_divider'
				),
				array(
					'type' => 'omniverse_image_select',
					'heading' => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'style',
					'value' => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Show text on mouse over', 'omniverse' ) => 'hover',
						esc_html__( 'Alternative', 'omniverse' ) => 'hover-inverse',
						esc_html__( 'Text under image', 'omniverse' ) => 'text-shown',
						esc_html__( 'Mouse move parallax', 'omniverse' ) => 'parallax',
					),
					'group' => esc_html__( 'Design', 'omniverse' ),
					'images_value' => array(
						'inherit' => OMNIVERSE_ASSETS_IMAGES . '/settings/empty.jpg',
						'hover' => OMNIVERSE_ASSETS_IMAGES . '/settings/portfolio/hover.jpg',
						'hover-inverse' => OMNIVERSE_ASSETS_IMAGES . '/settings/portfolio/hover-inverse.jpg',
						'text-shown' => OMNIVERSE_ASSETS_IMAGES . '/settings/portfolio/text-shown.jpg',
						'parallax' => OMNIVERSE_ASSETS_IMAGES . '/settings/portfolio/hover.jpg',
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Images size', 'omniverse' ),
					'group' => esc_html__( 'Design', 'omniverse' ),
					'param_name' => 'image_size',
					'hint' => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'description' => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
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
				array(
					'type' => 'omniverse_switch',
					'heading' => esc_html__( 'Lazy loading for images', 'omniverse' ),
					'hint' => esc_html__( 'Enable lazy loading for images for this element.', 'omniverse' ),
					'param_name' => 'lazy_loading',
					'true_state' => 'yes',
					'false_state' => 'no',
					'default' => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' )
				),
				array(
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
					'type'       => 'css_editor',
					'param_name' => 'css',
				),
				omniverse_get_vc_responsive_spacing_map(),
			),
		);
	}
}
