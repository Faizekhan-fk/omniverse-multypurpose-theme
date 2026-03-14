<?php use DN\Modules\Layouts\Main;

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
* AJAX Products tabs element map
* ------------------------------------------------------------------------------------------------
*/

if( ! function_exists( 'omniverse_get_products_shortcode_params' ) ) {
	function omniverse_get_products_shortcode_map_params() {
		return array(
			'name' => esc_html__( 'Products (grid or carousel)', 'omniverse' ),
			'base' => 'omniverse_products',
			'category' => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Animated carousel with posts', 'omniverse' ),
        	'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/products-grid-or-carousel.svg',
			'params' => omniverse_get_products_shortcode_params()
		);
	}
}

if( ! function_exists( 'omniverse_get_products_shortcode_params' ) ) {
	function omniverse_get_products_shortcode_params() {
		$typography = omniverse_get_typography_map(
			array(
				'key'      => 'title',
				'selector' => '{{WRAPPER}} .wd-el-title',
			)
		);

		$post_type_array            = array(
			esc_html__( 'All Products', 'omniverse' )       => 'product',
			esc_html__( 'Featured Products', 'omniverse' )  => 'featured',
			esc_html__( 'Sale Products', 'omniverse' )      => 'sale',
			esc_html__( 'Products with NEW label', 'omniverse' ) => 'new',
			esc_html__( 'Bestsellers', 'omniverse' )        => 'bestselling',
			esc_html__( 'List of IDs', 'omniverse' )        => 'ids',
			esc_html__( 'Top Rated Products', 'omniverse' ) => 'top_rated_products',
			esc_html__( 'Recently Viewed Products', 'omniverse' ) => 'recently_viewed',
		);
		$post_type_additional_array = array(
			'single_product' => array(
				esc_html__( 'Related (Single product)', 'omniverse' ) => 'related',
				esc_html__( 'Upsells (Single product)', 'omniverse' ) => 'upsells',
			),
			'cart'           => array(
				esc_html__( 'Cross Sells', 'omniverse' ) => 'cross-sells',
			),
		);

		foreach ( $post_type_additional_array as $needed_builder => $additional_options ) {
			if ( Main::is_layout_type( $needed_builder ) ) {
				$post_type_array = array_merge( $post_type_array, $additional_options );
			}
		}

		return apply_filters( 'omniverse_get_products_shortcode_params', array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Title', 'omniverse' ),
					'param_name' => 'title_divider'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Element title', 'omniverse' ),
					'param_name' => 'element_title',
				),
				array(
					'heading'          => esc_html__( 'Color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'title_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-el-title' => array(
							'color: {{VALUE}};',
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
				* Product source
				*/
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Product source', 'omniverse' ),
					'param_name' => 'source_divider'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Data source', 'omniverse' ),
					'param_name' => 'post_type',
					'value' => $post_type_array,
					'hint' => esc_html__( 'Select content type for your grid.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'autocomplete',
					'heading' => esc_html__( 'Include only', 'omniverse' ),
					'param_name' => 'include',
					'hint' => esc_html__( 'Add products by title.', 'omniverse' ),
					'settings' => array(
						'multiple' => true,
						'sortable' => true,
						'groups' => true
					),
					'dependency' => array(
						'element' => 'post_type',
						'value' => array( 'ids' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				// Custom query tab
				array(
					'type' => 'textarea_safe',
					'heading' => esc_html__( 'Custom query', 'omniverse' ),
					'param_name' => 'custom_query',
					'hint' => wp_kses(  __( 'Build custom query according to <a href="http://codex.wordpress.org/Function_Reference/query_posts">WordPress Codex</a>.', 'omniverse' ), array(
	                        'a' => array( 
	                            'href' => array(), 
	                            'target' => array()
	                        )
                    	) ),
					'dependency' => array(
						'element' => 'post_type',
						'value' => array( 'custom' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'autocomplete',
					'heading' => esc_html__( 'Categories or tags', 'omniverse' ),
					'param_name' => 'taxonomies',
					'settings' => array(
						'multiple' => true,
						// is multiple values allowed? default false
						// 'sortable' => true, // is values are sortable? default false
						'min_length' => 1,
						// min length to start search -> default 2
						// 'no_hide' => true, // In UI after select doesn't hide an select list, default false
						'groups' => true,
						// In UI show results grouped by groups, default false
						'unique_values' => true,
						// In UI show results except selected. NB! You should manually check values in backend, default false
						'display_inline' => true,
						// In UI show results inline view, default false (each value in own line)
						'delay' => 500,
						// delay for search. default 500
						'auto_focus' => true,
						// auto focus input, default true
					),
					'param_holder_class' => 'vc_not-for-custom',
					'hint' => esc_html__( 'Enter categories, tags or custom taxonomies.', 'omniverse' ),
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'ids', 'custom' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Update with AJAX on page load', 'omniverse' ),
					'hint'             => esc_html__( 'Enable this option if you use full-page cache like WP Rocket.', 'omniverse' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'ajax_recently_viewed',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'dependency'       => array(
						'element' => 'post_type',
						'value'   => array( 'recently_viewed' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
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
					'type' => 'omniverse_button_set',
					'heading' => esc_html__( 'Grid or carousel', 'omniverse' ),
					'param_name' => 'layout',
					'value' =>  array(
						esc_html__( 'Grid', 'omniverse' ) => 'grid',
	                    esc_html__( 'List', 'omniverse' ) => 'list',
	                    esc_html__( 'Carousel', 'omniverse' ) => 'carousel',
					),
					'hint' => esc_html__( 'Show products in standard grid or via slider carousel', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Columns', 'omniverse' ),
					'hint' => esc_html__( 'Number of columns in the grid.', 'omniverse' ),
					'param_name'       => 'columns_tabs',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'dependency'  => array(
						'element' => 'layout',
						'value' => array( 'grid' )
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
					'std' => '4',
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'grid' )
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
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'grid' )
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
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'grid' )
					),
					'wd_dependency'    => array(
						'element' => 'columns_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type' => 'omniverse_button_set',
					'heading' => esc_html__( 'Masonry grid', 'omniverse' ), 
					'param_name' => 'products_masonry',
					'hint' => esc_html__( 'Products may have different sizes', 'omniverse' ),
					'value' => array(
	                    esc_html__( 'Inherit', 'omniverse' ) => '',
	                    esc_html__( 'Enable', 'omniverse' ) => 'enable',
	                    esc_html__( 'Disable', 'omniverse' ) => 'disable'
					),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'grid' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_button_set',
					'heading' => esc_html__( 'Products grid with different sizes', 'omniverse' ), 
					'hint' => esc_html__( 'In this situation, some of the products will be twice bigger in width than others. Recommended to use with 6 columns grid only.', 'omniverse' ), 
					'param_name' => 'products_different_sizes',
					'value' => array(
	                    esc_html__( 'Inherit', 'omniverse' ) => '',
	                    esc_html__( 'Enable', 'omniverse' ) => 'enable',
	                    esc_html__( 'Disable', 'omniverse' ) => 'disable'
					),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'grid' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Space between products', 'omniverse' ),
					'param_name'       => 'spacing_tabs',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'grid', 'carousel' )
					),
					'default'          => 'desktop',
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'spacing',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => '',
						30 => 30,
						20 => 20,
						10 => 10,
						6  => 6,
						2  => 2,
						0  => 0,
					),
					'std'              => '',
					'dependency'       => array(
						'element' => 'layout',
						'value' => array( 'grid', 'carousel' )
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
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => '',
						30 => 30,
						20 => 20,
						10 => 10,
						6  => 6,
						2  => 2,
						0  => 0,
					),
					'std'              => '',
					'dependency'       => array(
						'element' => 'layout',
						'value' => array( 'grid', 'carousel' )
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
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => '',
						30 => 30,
						20 => 20,
						10 => 10,
						6  => 6,
						2  => 2,
						0  => 0,
					),
					'std'              => '',
					'dependency'       => array(
						'element' => 'layout',
						'value' => array( 'grid', 'carousel' )
					),
					'wd_dependency'    => array(
						'element' => 'spacing_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
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
				* Pagination
				*/
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Pagination', 'omniverse' ),
					'param_name' => 'pagination_divider'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Items per page', 'omniverse' ),
					'param_name' => 'items_per_page',
					'hint' => esc_html__( 'Number of items to show per page.', 'omniverse' ),
					'value' => '12',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Pagination', 'omniverse' ),
					'param_name' => 'pagination',
					'value' => array(
	                    esc_html__( 'Inherit', 'omniverse' ) => '',
	                    wp_kses( __( 'Load more button', 'omniverse' ), 'entities' ) => 'more-btn',
	                    esc_html__( 'Infinit scrolling', 'omniverse' ) => 'infinit',
	                    esc_html__( 'Arrows', 'omniverse' ) => 'arrows',
	                    esc_html__( 'Links', 'omniverse' ) => 'links'
					),
					'dependency' => array(
						'element' => 'layout',
						'value_not_equal_to' => array( 'carousel' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Arrow position', 'omniverse' ),
					'param_name' => 'pagination_arrows_position',
					'value' => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => '',
						esc_html__( 'Separate', 'omniverse' ) => 'sep',
						esc_html__( 'Together', 'omniverse' ) => 'together'
					),
					'wd_dependency'    => array(
						'element'            => 'layout',
						'value_not_equal_to' => array( 'carousel' )
					),
					'dependency'       => array(
						'element' => 'pagination',
						'value'   => array( 'arrows' )
					),
				),
				array(
					'type'             => 'wd_slider',
					'param_name'       => 'pagination_arrows_offset_h',
					'heading'          => esc_html__( 'Arrow offset horizontal', 'omniverse' ),
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
							'min'  => -500,
							'max'  => 500,
							'step' => 1,
						),
					),
					'selectors'        => array(
						'{{WRAPPER}}.wd-products-element .wd-nav-arrows' => array(
							'--wd-arrow-offset-h: {{VALUE}}{{UNIT}};',
						),
					),
					'generate_zero'   => true,
					'wd_dependency'   => array(
						'element'            => 'layout',
						'value_not_equal_to' => array( 'carousel' )
					),
					'dependency'       => array(
						'element' => 'pagination',
						'value'   => array( 'arrows' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'wd_slider',
					'param_name'       => 'pagination_arrows_offset_v',
					'heading'          => esc_html__( 'Arrow offset vertical', 'omniverse' ),
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
							'min'  => -500,
							'max'  => 500,
							'step' => 1,
						),
					),
					'selectors'        => array(
						'{{WRAPPER}}.wd-products-element .wd-nav-arrows' => array(
							'--wd-arrow-offset-v: {{VALUE}}{{UNIT}};',
						),
					),
					'generate_zero'    => true,
					'wd_dependency'    => array(
						'element'            => 'layout',
						'value_not_equal_to' => array( 'carousel' )
					),
					'dependency'       => array(
						'element' => 'pagination',
						'value'   => array( 'arrows' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_switch',
					'heading' => esc_html__( 'Shop tools', 'omniverse' ),
					'hint' => esc_html__( 'Per page, Sorting, Columns', 'omniverse' ),
					'param_name' => 'shop_tools',
					'true_state' => 'yes',
					'false_state' => 'no',
					'default' => 'no',
					'dependency' => array(
						'element' => 'pagination',
						'value' => array( 'links' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				* Design
				*/
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Design', 'omniverse' ),
					'group' => esc_html__( 'Design', 'omniverse' ),
					'param_name' => 'design_divider'
				),
				array(
					'type'         => 'omniverse_image_select',
					'heading'      => esc_html__( 'Products hover', 'omniverse' ),
					'param_name'   => 'product_hover',
					'value'        => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Full info on hover', 'omniverse' ) => 'info-alt',
						esc_html__( 'Full info on image', 'omniverse' ) => 'info',
						esc_html__( 'Icons and "add to cart" on hover', 'omniverse' ) => 'alt',
						esc_html__( 'Icons on hover', 'omniverse' ) => 'icons',
						esc_html__( 'Quick', 'omniverse' ) => 'quick',
						esc_html__( 'Show button on hover on image', 'omniverse' ) => 'button',
						esc_html__( 'Show summary on hover', 'omniverse' ) => 'base',
						esc_html__( 'Standard button', 'omniverse' ) => 'standard',
						esc_html__( 'Tiled', 'omniverse' ) => 'tiled',
						esc_html__( 'Full width button', 'omniverse' ) => 'fw-button',
						esc_html__( 'Small', 'omniverse' ) => 'small',
						esc_html__( 'Buttons on hover', 'omniverse' ) => 'buttons-on-hover',
					),
					'group'        => esc_html__( 'Design', 'omniverse' ),
					'images_value' => array(
						'inherit'          => OMNIVERSE_ASSETS_IMAGES . '/settings/empty.jpg',
						'info-alt'         => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/info-alt.jpg',
						'info'             => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/info.jpg',
						'alt'              => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/alt.jpg',
						'icons'            => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/icons.jpg',
						'quick'            => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/quick.jpg',
						'button'           => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/button.jpg',
						'base'             => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/base.jpg',
						'standard'         => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/standard.jpg',
						'tiled'            => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/tiled.jpg',
						'fw-button'        => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/fw-button.jpg',
						'small'            => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/small.jpg',
						'buttons-on-hover' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/buttons-on-hover.jpg',
					),
					'dependency'   => array(
						'element'            => 'layout',
						'value_not_equal_to' => array( 'list' ),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Images size', 'omniverse' ),
					'group' => esc_html__( 'Design', 'omniverse' ),
					'param_name' => 'img_size',
					'hint' => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'description' => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Sale countdown', 'omniverse' ),
					'hint'             => esc_html__( 'Countdown to the end sale date will be shown. Be sure you have set final date of the product sale price.', 'omniverse' ),
					'param_name'       => 'sale_countdown',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 0,
					'group'            => esc_html__( 'Design', 'omniverse' ),
					'dependency'       => array(
						'element'            => 'product_hover',
						'value_not_equal_to' => array( 'small' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Stock progress bar', 'omniverse' ),
					'hint'             => esc_html__( 'Display a number of sold and in stock products as a progress bar.', 'omniverse' ),
					'param_name'       => 'stock_progress_bar',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 0,
					'group'            => esc_html__( 'Design', 'omniverse' ),
					'dependency'       => array(
						'element'            => 'product_hover',
						'value_not_equal_to' => array( 'small' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Even product grid', 'omniverse' ),
					'group'            => esc_html__( 'Design', 'omniverse' ),
					'param_name'       => 'stretch_product_tabs',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'dependency'  => array(
						'element' => 'product_hover',
						'value'   => array( 'icons', 'alt', 'button', 'standard', 'tiled', 'quick', 'base', 'fw-button', 'buttons-on-hover' ),
					),
					'default'          => 'desktop',
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
				),
				array(
					'type'        => 'omniverse_switch',
					'param_name'  => 'stretch_product_desktop',
					'true_state'  => 1,
					'false_state' => 0,
					'default'     => 0,
					'group'       => esc_html__( 'Design', 'omniverse' ),
					'dependency'  => array(
						'element' => 'product_hover',
						'value'   => array( 'icons', 'alt', 'button', 'standard', 'tiled', 'quick', 'base', 'fw-button', 'buttons-on-hover' ),
					),
					'wd_dependency'    => array(
						'element' => 'stretch_product_tabs',
						'value'   => array( 'desktop' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'        => 'omniverse_switch',
					'param_name'  => 'stretch_product_tablet',
					'true_state'  => 1,
					'false_state' => 0,
					'default'     => 0,
					'group'       => esc_html__( 'Design', 'omniverse' ),
					'dependency'  => array(
						'element' => 'product_hover',
						'value'   => array( 'icons', 'alt', 'button', 'standard', 'tiled', 'quick', 'base', 'fw-button', 'buttons-on-hover' ),
					),
					'wd_dependency'    => array(
						'element' => 'stretch_product_tabs',
						'value'   => array( 'tablet' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'        => 'omniverse_switch',
					'param_name'  => 'stretch_product_mobile',
					'true_state'  => 1,
					'false_state' => 0,
					'default'     => 0,
					'group'       => esc_html__( 'Design', 'omniverse' ),
					'dependency'  => array(
						'element' => 'product_hover',
						'value'   => array( 'icons', 'alt', 'button', 'standard', 'tiled', 'quick', 'base', 'fw-button', 'buttons-on-hover' ),
					),
					'wd_dependency'    => array(
						'element' => 'stretch_product_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array (
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Highlighted products', 'omniverse' ),
					'hint'             => esc_html__( 'Create an eye-catching section of special products to promote them on your store.', 'omniverse' ),
					'param_name'       => 'highlighted_products',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 0,
					'group'            => esc_html__( 'Design', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'    => esc_html__( 'Products color scheme', 'omniverse' ),
					'group'      => esc_html__( 'Design', 'omniverse' ),
					'type'       => 'dropdown',
					'param_name' => 'products_color_scheme',
					'std'        => 'default',
					'value'      => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Dark', 'omniverse' )    => 'dark',
						esc_html__( 'Light', 'omniverse' )   => 'light' ,
					),
				),
				array(
					'type' => 'omniverse_switch',
					'heading' => esc_html__( 'Bordered grid', 'omniverse' ),
					'hint' => esc_html__( 'Add borders between the products in your grid', 'omniverse' ),
					'group' => esc_html__( 'Design', 'omniverse' ),
					'param_name' => 'products_bordered_grid',
					'true_state' => 1,
					'false_state' => 0,
					'default' => 0,
					'dependency'       => array(
						'element' => 'highlighted_products',
						'value' => '0',
					),
				),
				array(
					'type' => 'omniverse_button_set',
					'heading' => esc_html__( 'Bordered grid style', 'omniverse' ),
					'param_name' => 'products_bordered_grid_style',
					'value' => array(
						esc_html__( 'Outside', 'omniverse' ) => 'outside',
						esc_html__( 'Inside', 'omniverse' ) => 'inside'
					),
					'group' => esc_html__( 'Design', 'omniverse' ),
					'dependency' => array(
						'element' => 'products_bordered_grid',
						'value' => '1',
					),
				),
				array(
					'heading'     => esc_html__( 'Products background', 'omniverse' ),
					'hint'        => esc_html__( 'Add a background to the products in your grid.', 'omniverse' ),
					'group'       => esc_html__( 'Design', 'omniverse' ),
					'type'        => 'omniverse_switch',
					'param_name'  => 'products_with_background',
					'true_state'  => 1,
					'false_state' => 0,
					'default'     => 0,
				),
				array(
					'heading'          => esc_html__( 'Custom products background color', 'omniverse' ),
					'hint'             => esc_html__( 'Set custom background color for products.', 'omniverse' ),
					'group'            => esc_html__( 'Design', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'products_background',
					'selectors'        => array(
						'{{WRAPPER}} .wd-products-with-bg, {{WRAPPER}}.wd-products-with-bg, {{WRAPPER}} .wd-products-with-bg .wd-product, {{WRAPPER}}.wd-products-with-bg .wd-product' => array(
							'--wd-prod-bg:{{VALUE}}; --wd-bordered-bg:{{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'products_with_background',
						'value'   => array( '1' ),
					),
				),
				array(
					'heading'    => esc_html__( 'Products shadow', 'omniverse' ),
					'hint'       => esc_html__( 'Add a shadow to products if the initial product style did not have one.', 'omniverse' ),
					'group'      => esc_html__( 'Design', 'omniverse' ),
					'type'       => 'omniverse_switch',
					'param_name' => 'products_shadow',
					'true_state'  => 1,
					'false_state' => 0,
					'default'     => 0,
				),
				array(
					'heading'       => esc_html__( 'Rounding', 'omniverse' ),
					'group'         => esc_html__( 'Design', 'omniverse' ),
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
					'group'         => esc_html__( 'Design', 'omniverse' ),
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
				array(
					'heading'    => esc_html__( 'Product gallery', 'omniverse' ),
					'hint'       => esc_html__( 'Add the ability to view the product gallery on the products loop.', 'omniverse' ),
					'group'      => esc_html__( 'Design', 'omniverse' ),
					'type'       => 'dropdown',
					'param_name' => 'grid_gallery',
					'value'      => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Yes', 'omniverse' )     => 'yes',
						esc_html__( 'No', 'omniverse' )      => 'no' ,
					),
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Product gallery controls', 'omniverse' ),
					'group'            => esc_html__( 'Design', 'omniverse' ),
					'param_name'       => 'grid_gallery_control_tabs',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Mobile device', 'omniverse' ) => 'mobile',
					),
					'dependency' => array(
						'element' => 'grid_gallery',
						'value'   => array( 'yes' ),
					),
					'default'          => 'desktop',
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-6 vc_column',
				),
				array(
					'group'      => esc_html__( 'Design', 'omniverse' ),
					'type'       => 'omniverse_button_set',
					'param_name' => 'grid_gallery_control',
					'value'      => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Arrows', 'omniverse' )  => 'arrows',
						esc_html__( 'Hover', 'omniverse' )   => 'hover' ,
					),
					'dependency' => array(
						'element' => 'grid_gallery',
						'value'   => array( 'yes' ),
					),
					'wd_dependency'    => array(
						'element' => 'grid_gallery_control_tabs',
						'value'   => array( 'desktop' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'group'      => esc_html__( 'Design', 'omniverse' ),
					'type'       => 'omniverse_button_set',
					'param_name' => 'grid_gallery_enable_arrows',
					'value'      => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'None', 'omniverse' )    => 'none' ,
						esc_html__( 'Arrows', 'omniverse' )  => 'arrows',
					),
					'dependency' => array(
						'element' => 'grid_gallery',
						'value'   => array( 'yes' ),
					),
					'wd_dependency'    => array(
						'element' => 'grid_gallery_control_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type' => 'omniverse_button_set',
					'heading' => esc_html__( 'Quantity input on product', 'omniverse' ),
					'param_name' => 'product_quantity',
					'value' => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Enable', 'omniverse' ) => 'enable',
						esc_html__( 'Disable', 'omniverse' ) => 'disable'
					),
					'group' => esc_html__( 'Design', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				/**
				* Data settings
				*/
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Data settings', 'omniverse' ),
					'group' => esc_html__( 'Data Settings', 'omniverse' ),
					'param_name' => 'data_tab_divider',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Order by', 'omniverse' ),
					'param_name' => 'orderby',
					'value' => array(
						'',
						esc_html__( 'Date', 'omniverse' ) => 'date',
						esc_html__( 'Order by post ID', 'omniverse' ) => 'ID',
						esc_html__( 'Author', 'omniverse' ) => 'author',
						esc_html__( 'Title', 'omniverse' ) => 'title',
						esc_html__( 'Last modified date', 'omniverse' ) => 'modified',
						esc_html__( 'Number of comments', 'omniverse' ) => 'comment_count',
						esc_html__( 'Menu order/Page Order', 'omniverse' ) => 'menu_order',
						esc_html__( 'Meta value', 'omniverse' ) => 'meta_value',
						esc_html__( 'Meta value number', 'omniverse' ) => 'meta_value_num',
						esc_html__( 'Matches same order you passed in via the include parameter.', 'omniverse') => 'post__in',
						esc_html__( 'Random order', 'omniverse' ) => 'rand',
						esc_html__( 'Price', 'omniverse' ) => 'price',
					),
					'hint' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'omniverse' ),
					'group' => esc_html__( 'Data Settings', 'omniverse' ),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'custom', 'recently_viewed', 'top_rated_products' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Offset', 'omniverse' ),
					'param_name' => 'offset',
					'hint' => esc_html__( 'Number of grid elements to displace or pass over.', 'omniverse' ),
					'group' => esc_html__( 'Data Settings', 'omniverse' ),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'ids', 'custom', 'recently_viewed' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_button_set',
					'heading' => esc_html__( 'Query type', 'omniverse' ),
					'param_name' => 'query_type',
					'group' => esc_html__( 'Data Settings', 'omniverse' ),
					'value' => array(
						esc_html__( 'OR', 'omniverse' ) => 'OR',
						esc_html__( 'AND', 'omniverse' ) => 'AND'
					),
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'recently_viewed' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_button_set',
					'heading' => esc_html__( 'Sorting', 'omniverse' ),
					'param_name' => 'order',
					'group' => esc_html__( 'Data Settings', 'omniverse' ),
					'value' => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Descending', 'omniverse' ) => 'DESC',
						esc_html__( 'Ascending', 'omniverse' ) => 'ASC'
					),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'hint' => esc_html__( 'Select sorting order.', 'omniverse' ),
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'ids', 'custom', 'recently_viewed', 'top_rated_products' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Meta key', 'omniverse' ),
					'param_name' => 'meta_key',
					'hint' => esc_html__( 'Input meta key for grid ordering.', 'omniverse' ),
					'group' => esc_html__( 'Data Settings', 'omniverse' ),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'dependency' => array(
						'element' => 'orderby',
						'value' => array( 'meta_value', 'meta_value_num' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'autocomplete',
					'heading' => esc_html__( 'Exclude', 'omniverse' ),
					'param_name' => 'exclude',
					'hint' => esc_html__( 'Exclude posts, pages, etc. by title.', 'omniverse' ),
					'group' => esc_html__( 'Data Settings', 'omniverse' ),
					'settings' => array(
						'multiple' => true,
					),
					'param_holder_class' => 'vc_grid-data-type-not-ids',
					'dependency' => array(
						'element' => 'post_type',
						'value_not_equal_to' => array( 'ids', 'custom', 'recently_viewed' ),
						'callback' => 'vc_grid_exclude_dependency_callback',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Hide out of stock products', 'omniverse' ),
					'group'            => esc_html__( 'Data Settings', 'omniverse' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'hide_out_of_stock',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
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

				// Width option (with dependency Columns option, responsive).
				omniverse_get_responsive_dependency_width_map( 'responsive_tabs' ),
				omniverse_get_responsive_dependency_width_map( 'width_desktop' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_desktop' ),
				omniverse_get_responsive_dependency_width_map( 'width_tablet' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_tablet' ),
				omniverse_get_responsive_dependency_width_map( 'width_mobile' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_mobile' ),
			)
		);
	}
}

// Necessary hooks for blog autocomplete fields
add_filter( 'vc_autocomplete_omniverse_products_include_callback',	'omniverse_productIdAutocompleteSuggester_new', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_omniverse_products_include_render',
	'omniverse_productIdAutocompleteRender', 10, 1 ); // Render exact product. Must return an array (label,value)

// Narrow data taxonomies
add_filter( 'vc_autocomplete_omniverse_products_taxonomies_callback', 'omniverse_vc_autocomplete_taxonomies_field_search', 10, 1 );
add_filter( 'vc_autocomplete_omniverse_products_taxonomies_render', 'omniverse_vc_autocomplete_taxonomies_field_render', 10, 1 );

// Narrow data taxonomies for exclude_filter
add_filter( 'vc_autocomplete_omniverse_products_exclude_filter_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1 );
add_filter( 'vc_autocomplete_omniverse_products_exclude_filter_render', 'vc_autocomplete_taxonomies_field_render', 10, 1 );

add_filter( 'vc_autocomplete_omniverse_products_exclude_callback',	'vc_exclude_field_search', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_omniverse_products_exclude_render', 'vc_exclude_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)

if( ! function_exists( 'omniverse_vc_autocomplete_taxonomies_field_render' ) ) {
	function omniverse_vc_autocomplete_taxonomies_field_render( $term ) {
		$vc_taxonomies_types = vc_taxonomies_types();

		$brands_attribute = omniverse_get_opt( 'brands_attribute' );

		if( !empty( $brands_attribute ) && taxonomy_exists( $brands_attribute ) ) {
			$vc_taxonomies_types[ $brands_attribute ] = $brands_attribute;
		}

		$terms = get_terms( array_keys( $vc_taxonomies_types ), array(
			'include' => array( $term['value'] ),
			'hide_empty' => false,
		) );
		$data = false;
		if ( is_array( $terms ) && 1 === count( $terms ) ) {
			$term = $terms[0];
			$data = vc_get_term_object( $term );
		}

		return $data;
	}
}

// Add other product attributes
if( ! function_exists( 'omniverse_vc_autocomplete_taxonomies_field_search' ) ) {
	function omniverse_vc_autocomplete_taxonomies_field_search( $search_string ) {
		$data = array();
		$vc_filter_by = vc_post_param( 'vc_filter_by', '' );
		$vc_taxonomies_types = strlen( $vc_filter_by ) > 0 ? array( $vc_filter_by ) : array_keys( vc_taxonomies_types() );

		$brands_attribute = omniverse_get_opt( 'brands_attribute' );

		if( !empty( $brands_attribute ) && taxonomy_exists( $brands_attribute ) ) {
			array_push($vc_taxonomies_types, $brands_attribute);
		}

		$vc_taxonomies = get_terms( $vc_taxonomies_types, array(
			'hide_empty' => false,
			'search' => $search_string,
		) );
		if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
			foreach ( $vc_taxonomies as $t ) {
				if ( is_object( $t ) ) {
					$data[] = vc_get_term_object( $t );
				}
			}
		}

		return $data;
	}
}
