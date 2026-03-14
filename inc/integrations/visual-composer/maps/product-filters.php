<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}
/**
* ------------------------------------------------------------------------------------------------
* Product filters
* ------------------------------------------------------------------------------------------------
*/
if ( ! function_exists( 'omniverse_get_vc_map_product_filters' ) ) {
	function omniverse_get_vc_map_product_filters() {
		$title_typography = omniverse_get_typography_map(
			array(
				'key'      => 'title_typography',
				'selector' => '{{WRAPPER}} .wd-pf-title .title-text',
				'group'    => esc_html__( 'Style', 'omniverse' ),
			)
		);

		return array(
			'name'                    => esc_html__( 'Product filters', 'omniverse' ),
			'base'                    => 'omniverse_product_filters',
			'class'                   => '',
			'category'                => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description'             => esc_html__( 'Add filters by category, attribute or price', 'omniverse' ),
			'icon'                    => OMNIVERSE_ASSETS . '/images/vc-icon/product-filter.svg',
			'as_parent'               => array( 'only' => 'omniverse_filter_categories, omniverse_filters_attribute, omniverse_filters_price_slider, omniverse_stock_status, omniverse_filters_orderby' ),
			'content_element'         => true,
			'show_settings_on_create' => true,
			'params'                  => array(
				/**
				 * General tab.
				 */
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Submit form on', 'omniverse' ),
					'param_name'       => 'submit_form_on',
					'value'            => array(
						esc_html__( 'Button click', 'omniverse' ) => 'click',
						esc_html__( 'Dropdown select', 'omniverse' ) => 'select',
					),
					'std'              => 'click',
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Show selected values in dropdown', 'omniverse' ),
					'param_name'       => 'show_selected_values',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'yes',
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Show dropdown on', 'omniverse' ),
					'param_name'       => 'show_dropdown_on',
					'value'            => array(
						esc_html__( 'Hover', 'omniverse' ) => 'hover',
						esc_html__( 'Click', 'omniverse' ) => 'click',
					),
					'std'              => 'click',
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),

				/**
				 * Style tab.
				 */

				/**
				 * General settings.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'title'      => esc_html__( 'General', 'omniverse' ),
					'param_name' => 'title_style_section',
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'holder'     => 'div',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'style',
					'value'            => array(
						esc_html__( 'Simplified', 'omniverse' ) => 'simplified',
						esc_html__( 'Form', 'omniverse' )       => 'form',
						esc_html__( 'Form underlined', 'omniverse' ) => 'form-underlined',
					),
					'std'              => 'form',
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Display grid', 'omniverse' ),
					'param_name'       => 'display_grid',
					'value'            => array(
						esc_html__( 'Stretch', 'omniverse' ) => 'stretch',
						esc_html__( 'Inline', 'omniverse' ) => 'inline',
						esc_html__( 'Number', 'omniverse' ) => 'number',
					),
					'std'              => 'stretch',
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'wd_slider',
					'heading'          => esc_html__( 'Columns', 'omniverse' ),
					'param_name'       => 'display_grid_col',
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'selectors'        => array(),
					'devices'          => array(
						'desktop' => array(
							'unit'  => '-',
							'value' => 4,
						),
						'tablet'  => array(
							'unit'  => '-',
							'value' => 0,
						),
						'mobile'  => array(
							'unit'  => '-',
							'value' => 0,
						),
					),
					'range'            => array(
						'-' => array(
							'min'  => 1,
							'max'  => 12,
							'step' => 1,
						),
					),
					'dependency'       => array(
						'element' => 'display_grid',
						'value'   => array( 'number' ),
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'wd_select',
					'heading'          => esc_html__( 'Space between', 'omniverse' ),
					'param_name'       => 'space_between',
					'style'            => 'select',
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'selectors'        => array(),
					'devices'          => array(
						'desktop' => array(
							'value' => '10',
						),
						'tablet'  => array(
							'value' => '10',
						),
						'mobile'  => array(
							'value' => '10',
						),
					),
					'value'            => array(
						esc_html__( '0 px', 'omniverse' )  => '0',
						esc_html__( '2 px', 'omniverse' )  => '2',
						esc_html__( '6 px', 'omniverse' )  => '6',
						esc_html__( '10 px', 'omniverse' ) => '10',
						esc_html__( '20 px', 'omniverse' ) => '20',
						esc_html__( '30 px', 'omniverse' ) => '30',
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'       => 'omniverse_button_set',
					'heading'    => esc_html__( 'Color Scheme', 'omniverse' ),
					'param_name' => 'omniverse_color_scheme',
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'value'      => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Light', 'omniverse' ) => 'light',
						esc_html__( 'Dark', 'omniverse' )  => 'dark',
					),
				),

				/**
				 * Title settings.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'title'      => esc_html__( 'Title', 'omniverse' ),
					'param_name' => 'title_style_section',
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'holder'     => 'div',
				),
				array(
					'type'             => 'wd_colorpicker',
					'heading'          => esc_html__( 'Idle color', 'omniverse' ),
					'param_name'       => 'title_idle_color',
					'selectors'        => array(
						'{{WRAPPER}} .title-text' => array(
							'color: {{VALUE}};',
						),
					),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'wd_colorpicker',
					'heading'          => esc_html__( 'Hover color', 'omniverse' ),
					'param_name'       => 'title_hover_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-pf-checkboxes:hover .title-text, {{WRAPPER}} .wd-pf-checkboxes.wd-opened .title-text' => array(
							'color: {{VALUE}};',
						),
					),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Border color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'form_brd_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-product-filters' => array(
							'--wd-form-brd-color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'style',
						'value'   => array( 'form', 'form-underlined' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Border color focus', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'form_brd_color_focus',
					'selectors'        => array(
						'{{WRAPPER}} .wd-product-filters' => array(
							'--wd-form-brd-color-focus: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'style',
						'value'   => array( 'form', 'form-underlined' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Background color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'form_bg',
					'selectors'        => array(
						'{{WRAPPER}} .wd-product-filters' => array(
							'--wd-form-bg: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'style',
						'value'   => array( 'form' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				$title_typography['font_family'],
				$title_typography['font_size'],
				$title_typography['font_weight'],
				$title_typography['text_transform'],
				$title_typography['font_style'],
				$title_typography['line_height'],
				/**
				 * Design Options tab.
				 */
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
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
			),
			'js_view'                 => 'VcColumnView',
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_filter_categories' ) ) {
	function omniverse_get_vc_map_filter_categories() {
		return array(
			'name'            => esc_html__( 'Filter categories', 'omniverse' ),
			'base'            => 'omniverse_filter_categories',
			'as_child'        => array( 'only' => 'omniverse_product_filters' ),
			'content_element' => true,
			'category'        => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/product-filter-categories.svg',
			'params'          => array(
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'General options', 'omniverse' ),
					'param_name' => 'general_divider',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Title', 'omniverse' ),
					'param_name'       => 'title',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Order by', 'omniverse' ),
					'param_name'       => 'order_by',
					'value'            => array(
						esc_html__( 'Name', 'omniverse' ) => 'name',
						esc_html__( 'ID', 'omniverse' ) => 'ID',
						esc_html__( 'Slug', 'omniverse' ) => 'slug',
						esc_html__( 'Count', 'omniverse' ) => 'count',
						esc_html__( 'Category order', 'omniverse' ) => 'order',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Show hierarchy', 'omniverse' ),
					'param_name'       => 'hierarchical',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 1,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Hide empty categories', 'omniverse' ),
					'param_name'       => 'hide_empty',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 0,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Show current category ancestors', 'omniverse' ),
					'param_name'       => 'show_categories_ancestors',
					'hint'             => esc_html__( 'If you visit category Man, for example, only man\'s subcategories will be shown in the page title like T-shirts, Coats, Shoes etc.', 'omniverse' ),
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 0,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_divider',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name'       => 'el_class',
					'hint'             => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
			),
			array(
				'type' => 'omniverse_switch',
				'heading' => esc_html__( 'Show labels', 'omniverse' ),
				'param_name' => 'labels',
				'true_state' => 1,
				'false_state' => 0,
				'default' => 1,
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type' => 'omniverse_title_divider',
				'holder' => 'div',
				'title' => esc_html__( 'Extra options', 'omniverse' ),
				'param_name' => 'extra_divider'
			),
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_filters_attribute' ) ) {
	function omniverse_get_vc_map_filters_attribute() {
		$attribute_array = array( '' => '' );

		if ( function_exists( 'wc_get_attribute_taxonomies' ) ) {
			$attribute_taxonomies = wc_get_attribute_taxonomies();

			if ( $attribute_taxonomies ) {
				foreach ( $attribute_taxonomies as $tax ) {
					$attribute_array[ $tax->attribute_name ] = $tax->attribute_name;
				}
			}
		}

		return array(
			'name'            => esc_html__( 'Filter attribute', 'omniverse' ),
			'base'            => 'omniverse_filters_attribute',
			'as_child'        => array( 'only' => 'omniverse_product_filters' ),
			'content_element' => true,
			'category'        => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/product-filter-atribute.svg',
			'params'          => array(
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'General options', 'omniverse' ),
					'param_name' => 'general_divider',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Title', 'omniverse' ),
					'param_name'       => 'title',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Attribute', 'omniverse' ),
					'param_name'       => 'attribute',
					'value'            => $attribute_array,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'autocomplete',
					'heading'          => esc_html__( 'Show in categories', 'omniverse' ),
					'param_name'       => 'categories',
					'settings'         => array(
						'multiple' => true,
						'sortable' => true,
					),
					'save_always'      => true,
					'hint'             => esc_html__( 'Choose on which categories pages you want to display this filter. Or leave empty to show on all pages.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Query type', 'omniverse' ),
					'param_name'       => 'query_type',
					'hint'             => esc_html__( 'If you select “AND”, you will be allowed to select only one attribute. In case of “OR”, you will be able to select multiple values.', 'omniverse' ),
					'value'            => array(
						esc_html__( 'AND', 'omniverse' ) => 'and',
						esc_html__( 'OR', 'omniverse' ) => 'or',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Swatches size', 'omniverse' ),
					'param_name'       => 'size',
					'value'            => array(
						esc_html__( 'Small', 'omniverse' ) => 'small',
						esc_html__( 'Medium', 'omniverse' ) => 'normal',
						esc_html__( 'Large', 'omniverse' ) => 'large',
					),
					'std'              => 'normal',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Swatches shape', 'omniverse' ),
					'param_name'       => 'shape',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => 'inherit',
						esc_html__( 'Round', 'omniverse' ) => 'round',
						esc_html__( 'Rounded', 'omniverse' ) => 'rounded',
						esc_html__( 'Square', 'omniverse' ) => 'square',
					),
					'std'              => 'inherit',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Swatch style', 'omniverse' ),
					'param_name'       => 'swatch_style',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => 'inherit',
						esc_html__( 'Style 1', 'omniverse' ) => '1',
						esc_html__( 'Style 2', 'omniverse' ) => '2',
						esc_html__( 'Style 3', 'omniverse' ) => '3',
						esc_html__( 'Style 4', 'omniverse' ) => '4',
					),
					'std'              => 'inherit',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Layout', 'omniverse' ),
					'param_name'       => 'display',
					'value'            => array(
						esc_html__( 'List', 'omniverse' )   => 'list',
						esc_html__( '2 columns', 'omniverse' ) => 'double',
						esc_html__( 'Inline', 'omniverse' ) => 'inline',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Show labels', 'omniverse' ),
					'param_name'       => 'labels',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 1,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_divider'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' )
				)
			),
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_stock_status' ) ) {
	function omniverse_get_vc_map_stock_status() {
		return array(
			'name'            => esc_html__( 'Stock status', 'omniverse' ),
			'base'            => 'omniverse_stock_status',
			'as_child'        => array( 'only' => 'omniverse_product_filters' ),
			'content_element' => true,
			'category'        => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/product-filter-atribute.svg',
			'params'          => array(
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'General options', 'omniverse' ),
					'param_name' => 'general_divider',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Title', 'omniverse' ),
					'param_name'       => 'title',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Show labels', 'omniverse' ),
					'param_name'       => 'labels',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 1,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'On Sale filter', 'omniverse' ),
					'param_name'       => 'onsale',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 1,
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'In Stock filter', 'omniverse' ),
					'param_name'       => 'instock',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 1,
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'On backorder filter', 'omniverse' ),
					'param_name'       => 'onbackorder',
					'true_state'       => 1,
					'false_state'      => 0,
					'default'          => 1,
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_divider',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
			),
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_filters_price_slider' ) ) {
	function omniverse_get_vc_map_filters_price_slider() {
		return array(
			'name'            => esc_html__( 'Filter price', 'omniverse' ),
			'base'            => 'omniverse_filters_price_slider',
			'as_child'        => array( 'only' => 'omniverse_product_filters' ),
			'content_element' => true,
			'category'        => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/product-filter-price.svg',
			'params'          => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Title', 'omniverse' ),
					'param_name' => 'title',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
			),
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_filters_orderby' ) ) {
	function omniverse_get_vc_map_filters_orderby() {
		return array(
			'name'            => esc_html__( 'Order by', 'omniverse' ),
			'base'            => 'omniverse_filters_orderby',
			'as_child'        => array( 'only' => 'omniverse_product_filters' ),
			'content_element' => true,
			'category'        => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/product-filter-atribute.svg',
			'params'          => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
			),
		);
	}
}

add_filter( 'vc_autocomplete_omniverse_filters_attribute_categories_callback', 'omniverse_productCategoryCategoryAutocompleteSuggester', 10, 1 );

add_filter( 'vc_autocomplete_omniverse_filters_attribute_categories_render', 'omniverse_productCategoryCategoryRenderByIdExact', 10, 1 );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_omniverse_product_filters extends WPBakeryShortCodesContainer {}

	class WPBakeryShortCode_omniverse_filter_categories extends WPBakeryShortCode {}

	class WPBakeryShortCode_omniverse_filters_attribute extends WPBakeryShortCode {}

	class WPBakeryShortCode_omniverse_filters_price_slider extends WPBakeryShortCode {}

	class WPBakeryShortCode_omniverse_filters_orderby extends WPBakeryShortCode {}

	class WPBakeryShortCode_omniverse_stock_status extends WPBakeryShortCode {}
}
