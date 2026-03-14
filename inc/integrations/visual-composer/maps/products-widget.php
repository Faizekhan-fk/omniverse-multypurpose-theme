<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
*  WC products widget element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_shortcode_products_widget' ) ) {
	function omniverse_get_vc_map_shortcode_products_widget() {
		return array(
			'name' => esc_html__( 'WC products widget', 'omniverse' ),
			'base' => 'omniverse_shortcode_products_widget',
			'category' => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Small products list widget', 'omniverse' ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/wc-product-widget.svg',
			'params' => array(
				array(
					'param_name' => 'omniverse_css_id',
					'type'       => 'omniverse_css_id',
				),
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Title', 'omniverse' ),
					'param_name' => 'title_divider',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Widget title', 'omniverse' ),
					'param_name' => 'title',
				),
				/**
				 * Data settings
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Data settings', 'omniverse' ),
					'param_name' => 'data_divider',
				),
				array(
					'type' => 'omniverse_slider',
					'heading' => esc_html__( 'Number of products to show', 'omniverse' ),
					'param_name' => 'number',
					'min' => '1',
					'max' => '7',
					'step' => '1',
					'default' => '3',
					'units' => '',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency' => array(
						'element' => 'show',
						'value_not_equal_to' => array( 'product_ids' ),
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Show', 'omniverse' ),
					'param_name' => 'show',
					'value' => array(
						esc_html__( 'All Products', 'omniverse' ) => '',
						esc_html__( 'Featured Products', 'omniverse' ) => 'featured',
						esc_html__( 'On-sale Products', 'omniverse' ) => 'onsale',
						esc_html__( 'List of IDs', 'omniverse' ) => 'product_ids'

					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'autocomplete',
					'heading' => esc_html__( 'Include only', 'omniverse' ),
					'param_name' => 'include_products',
					'hint' => esc_html__( 'Add products by title.', 'omniverse' ),
					'settings' => array(
						'multiple' => true,
						'sortable' => true,
						'unique_values' => true,
						// In UI show results except selected. NB! You should manually check values in backend
					),
					'save_always' => true,
					'dependency' => array(
						'element' => 'show',
						'value' => array( 'product_ids' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Order by', 'omniverse' ),
					'param_name' => 'orderby',
					'value' => array(
						esc_html__( 'Date', 'omniverse' ) => 'date',
						esc_html__( 'Price', 'omniverse' ) => 'price',
						esc_html__( 'Random', 'omniverse' ) => 'rand',
						esc_html__( 'Sales', 'omniverse' ) => 'sales'
					),
					'dependency' => array(
						'element' => 'show',
						'value_not_equal_to' => array( 'product_ids' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_button_set',
					'heading' => esc_html__( 'Order', 'omniverse' ),
					'param_name' => 'order',
					'value' => array(
						esc_html__( 'ASC', 'omniverse' ) => 'asc',
						esc_html__( 'DESC', 'omniverse' ) => 'desc'
					),
					'dependency' => array(
						'element' => 'show',
						'value_not_equal_to' => array( 'product_ids' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'autocomplete',
					'heading' => esc_html__( 'Categories', 'omniverse' ),
					'param_name' => 'ids',
					'settings' => array(
						'multiple' => true,
						'sortable' => true
					),
					'save_always' => true,
					'hint' => esc_html__( 'List of product categories', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency' => array(
						'element' => 'show',
						'value_not_equal_to' => array( 'product_ids' ),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Images size', 'omniverse' ),
					'param_name' => 'images_size',
					'hint' => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description' => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
				),
				/**
				 * Extra
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_divider',
				),
				array(
					'type' => 'omniverse_switch',
					'heading' => esc_html__( 'Hide free products', 'omniverse' ),
					'param_name' => 'hide_free',
					'true_state' => 1,
					'false_state' => 0,
					'default' => 0,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_switch',
					'heading' => esc_html__( 'Show hidden products', 'omniverse' ),
					'param_name' => 'show_hidden',
					'true_state' => 1,
					'false_state' => 0,
					'default' => 0,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
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
			),
		);
	}
}

//Filters For autocomplete param:
//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
add_filter( 'vc_autocomplete_omniverse_shortcode_products_widget_ids_callback', 'omniverse_productCategoryCategoryAutocompleteSuggester', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_omniverse_shortcode_products_widget_ids_render', 'omniverse_productCategoryCategoryRenderByIdExact', 10, 1 );

add_filter( 'vc_autocomplete_omniverse_shortcode_products_widget_include_products_callback',	'omniverse_productIdAutocompleteSuggester', 10, 1 );
add_filter( 'vc_autocomplete_omniverse_shortcode_products_widget_include_products_render',	'omniverse_productIdAutocompleteRender', 10, 1 );
