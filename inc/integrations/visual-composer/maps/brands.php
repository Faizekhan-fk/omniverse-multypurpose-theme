<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}
/**
* ------------------------------------------------------------------------------------------------
*  Brands element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_brands' ) ) {
	function omniverse_get_vc_map_brands() {
		$order_by_values = array(
			'',
			esc_html__( 'Name', 'omniverse' )    => 'name',
			esc_html__( 'Slug', 'omniverse' )    => 'slug',
			esc_html__( 'Term ID', 'omniverse' ) => 'term_id',
			esc_html__( 'ID', 'omniverse' )      => 'id',
			esc_html__( 'Random', 'omniverse' )  => 'random',
			esc_html__( 'As IDs or slugs provided order', 'omniverse' ) => 'include',
		);

		$order_way_values = array(
			'',
			esc_html__( 'Descending', 'omniverse' ) => 'DESC',
			esc_html__( 'Ascending', 'omniverse' )  => 'ASC',
		);

		return array(
			'name'        => esc_html__( 'Brands', 'omniverse' ),
			'base'        => 'omniverse_brands',
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Brands carousel/grid', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/brands.svg',
			'params'      => array(
				array(
					'param_name' => 'omniverse_css_id',
					'type'       => 'omniverse_css_id',
				),
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Title', 'omniverse' ),
					'param_name' => 'title_divider',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Brands title', 'omniverse' ),
					'param_name' => 'title',
				),
				/**
				 * Data settings
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Data settings', 'omniverse' ),
					'param_name' => 'data_divider',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Number', 'omniverse' ),
					'param_name'       => 'number',
					'hint'             => esc_html__( 'Enter the number of brands to display for this element.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Order by', 'omniverse' ),
					'param_name'       => 'orderby',
					'value'            => $order_by_values,
					'save_always'      => true,
					'hint'             => sprintf(
						wp_kses(
							__( 'Select how to sort retrieved brands. More at %s.', 'omniverse' ),
							array(
								'a' => array(
									'href'   => array(),
									'target' => array(),
								),
							)
						),
						'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Sort order', 'omniverse' ),
					'param_name'       => 'order',
					'value'            => $order_way_values,
					'save_always'      => true,
					'hint'             => sprintf(
						wp_kses(
							__( 'Designates the ascending or descending order. More at %s.', 'omniverse' ),
							array(
								'a' => array(
									'href'   => array(),
									'target' => array(),
								),
							)
						),
						'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'autocomplete',
					'heading'          => esc_html__( 'Brands', 'omniverse' ),
					'param_name'       => 'ids',
					'settings'         => array(
						'multiple' => true,
						'sortable' => true,
					),
					'save_always'      => true,
					'hint'             => esc_html__( 'List of product brands to show. Leave empty to show all', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Hide empty', 'omniverse' ),
					'param_name'       => 'hide_empty',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Filter in current category', 'omniverse' ),
					'hint'             => esc_html__( 'Enable this option and all brand links will work inside the current category page. Or it will lead to the shop page if you are not on the category page.', 'omniverse' ),
					'param_name'       => 'filter_in_current_category',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Disable link', 'omniverse' ),
					'param_name'       => 'disable_link',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
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
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Layout', 'omniverse' ),
					'param_name'       => 'style',
					'save_always'      => true,
					'value'            => array(
						'Carousel'   => 'carousel',
						'Grid'       => 'grid',
						'Links List' => 'list',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Carousel
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'title'      => esc_html__( 'Carousel', 'omniverse' ),
					'group'      => esc_html__( 'Carousel', 'omniverse' ),
					'param_name' => 'carousel_divider',
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'carousel' ),
					),
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Slides per view', 'omniverse' ),
					'hint'             => esc_html__( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode.', 'omniverse' ),
					'param_name'       => 'per_row_tabs',
					'group'            => esc_html__( 'Carousel', 'omniverse' ),
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'dependency'       => array(
						'element' => 'style',
						'value'   => array( 'carousel' ),
					),
					'default'          => 'desktop',
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'omniverse_slider',
					'param_name'       => 'per_row',
					'group'            => esc_html__( 'Carousel', 'omniverse' ),
					'min'              => '1',
					'max'              => '8',
					'step'             => '0.5',
					'default'          => '3',
					'units'            => 'col',
					'dependency'       => array(
						'element' => 'style',
						'value'   => array( 'carousel' ),
					),
					'wd_dependency'    => array(
						'element' => 'per_row_tabs',
						'value'   => array( 'desktop' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'omniverse_slider',
					'param_name'       => 'per_row_tablet',
					'group'            => esc_html__( 'Carousel', 'omniverse' ),
					'min'              => '1',
					'max'              => '8',
					'step'             => '0.5',
					'default'          => '',
					'units'            => 'col',
					'dependency'       => array(
						'element' => 'style',
						'value'   => array( 'carousel' ),
					),
					'wd_dependency'    => array(
						'element' => 'per_row_tabs',
						'value'   => array( 'tablet' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'omniverse_slider',
					'param_name'       => 'per_row_mobile',
					'group'            => esc_html__( 'Carousel', 'omniverse' ),
					'min'              => '1',
					'max'              => '8',
					'step'             => '0.5',
					'default'          => '',
					'units'            => 'col',
					'dependency'       => array(
						'element' => 'style',
						'value'   => array( 'carousel' ),
					),
					'wd_dependency'    => array(
						'element' => 'per_row_tabs',
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
						'element' => 'style',
						'value'   => array( 'grid', 'list' ),
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
						'element' => 'style',
						'value'   => array( 'grid', 'list' ),
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
						'element' => 'style',
						'value'   => array( 'grid', 'list' ),
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
						'element' => 'style',
						'value'   => array( 'grid', 'list' ),
					),
					'wd_dependency'    => array(
						'element' => 'columns_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Space between', 'omniverse' ),
					'param_name'       => 'spacing_tabs',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'default'          => 'desktop',
					'dependency'       => array(
						'element' => 'brand_style',
						'value'   => array( 'default' ),
					),
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'spacing',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => '',
						30 => 30,
						20 => 20,
						10 => 10,
						6  => 6,
						2  => 2,
						0  => 0,
					),
					'std'              => '',
					'wd_dependency'    => array(
						'element' => 'spacing_tabs',
						'value'   => array( 'desktop' ),
					),
					'dependency'       => array(
						'element' => 'brand_style',
						'value'   => array( 'default' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'spacing_tablet',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						30 => 30,
						20 => 20,
						10 => 10,
						6  => 6,
						2  => 2,
						0  => 0,
					),
					'std'              => '',
					'wd_dependency'    => array(
						'element' => 'spacing_tabs',
						'value'   => array( 'tablet' ),
					),
					'dependency'       => array(
						'element' => 'brand_style',
						'value'   => array( 'default' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'param_name'       => 'spacing_mobile',
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						30 => 30,
						20 => 20,
						10 => 10,
						6  => 6,
						2  => 2,
						0  => 0,
					),
					'std'              => '',
					'wd_dependency'    => array(
						'element' => 'spacing_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),
				array(
					'type'       => 'wd_slider',
					'heading'    => esc_html__( 'Padding', 'omniverse' ),
					'param_name' => 'padding',
					'selectors'  => array(
						'{{WRAPPER}}.wd-brands' => array(
							'--wd-brand-pd: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'    => array(
						'desktop' => array(
							'value' => '',
							'unit'  => 'px',
						),
						'tablet'  => array(
							'value' => '',
							'unit'  => 'px',
						),
						'mobile'  => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'      => array(
						'px' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					),
				),
				array(
					'param_name'       => 'alignment',
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Alignment', 'omniverse' ),
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
					'std'              => '',
					'omni_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'brand_style',
					'save_always'      => true,
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Bordered', 'omniverse' ) => 'bordered',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'With background', 'omniverse' ),
					'param_name'       => 'with_bg_color',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'dependency'       => array(
						'element' => 'brand_style',
						'value'   => array( 'default' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Background color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'brand_bg_color',
					'selectors'        => array(
						'{{WRAPPER}}.wd-brands' => array(
							'--wd-brand-bg: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'with_bg_color',
						'value'   => array( 'yes' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
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
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Hover', 'omniverse' ),
					'param_name'  => 'hover',
					'save_always' => true,
					'value'       => array(
						'Default'   => 'default',
						'Simple'    => 'simple',
						'Alternate' => 'alt',
					),
				),
				array(
					'type'             => 'wd_slider',
					'heading'          => esc_html__( 'Width', 'omniverse' ),
					'param_name'       => 'image_width',
					'selectors'        => array(
						'{{WRAPPER}}.wd-brands' => array(
							'--wd-brand-img-width: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'          => array(
						'desktop' => array(
							'value' => '',
							'unit'  => 'px',
						),
						'tablet'  => array(
							'value' => '',
							'unit'  => 'px',
						),
						'mobile'  => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'            => array(
						'px' => array(
							'min'  => 0,
							'max'  => 200,
							'step' => 1,
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'wd_slider',
					'heading'          => esc_html__( 'Height', 'omniverse' ),
					'param_name'       => 'image_height',
					'selectors'        => array(
						'{{WRAPPER}}.wd-brands' => array(
							'--wd-brand-img-height: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'          => array(
						'desktop' => array(
							'value' => '',
							'unit'  => 'px',
						),
						'tablet'  => array(
							'value' => '',
							'unit'  => 'px',
						),
						'mobile'  => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'            => array(
						'px' => array(
							'min'  => 0,
							'max'  => 200,
							'step' => 1,
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				function_exists( 'omniverse_get_vc_responsive_spacing_map' ) ? omniverse_get_vc_responsive_spacing_map() : '',
			),
		);
	}
}

// Filters For autocomplete param:
// For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback.
add_filter( 'vc_autocomplete_omniverse_brands_ids_callback', 'omniverse_productBrandsAutocompleteSuggester', 10, 1 ); // Get suggestion(find). Must return an array.
add_filter( 'vc_autocomplete_omniverse_brands_ids_render', 'omniverse_productBrandsRenderByIdExact', 10, 1 );

if ( ! function_exists( 'omniverse_productBrandsAutocompleteSuggester' ) ) {
	function omniverse_productBrandsAutocompleteSuggester( $query, $slug = false ) {
		global $wpdb;
		$cat_id = (int) $query;
		$query  = trim( $query );

		$attribute = omniverse_get_opt( 'brands_attribute' );

		$post_meta_infos = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT a.term_id AS id, b.name as name, b.slug AS slug
						FROM {$wpdb->term_taxonomy} AS a
						INNER JOIN {$wpdb->terms} AS b ON b.term_id = a.term_id
						WHERE a.taxonomy = '%s' AND (a.term_id = '%d' OR b.slug LIKE '%%%s%%' OR b.name LIKE '%%%s%%' )",
				$attribute,
				$cat_id > 0 ? $cat_id : - 1,
				stripslashes( $query ),
				stripslashes( $query )
			),
			ARRAY_A
		);

		$result = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $slug ? $value['slug'] : $value['id'];
				$data['label'] = esc_html__( 'Id', 'omniverse' ) . ': ' .
								 $value['id'] .
								 ( ( strlen( $value['name'] ) > 0 ) ? ' - ' . esc_html__( 'Name', 'omniverse' ) . ': ' .
																	  $value['name'] : '' ) .
								 ( ( strlen( $value['slug'] ) > 0 ) ? ' - ' . esc_html__( 'Slug', 'omniverse' ) . ': ' .
																	  $value['slug'] : '' );
				$result[]      = $data;
			}
		}

		return $result;
	}
}

if ( ! function_exists( 'omniverse_productBrandsRenderByIdExact' ) ) {
	function omniverse_productBrandsRenderByIdExact( $query ) {
		global $wpdb;
		$query     = $query['value'];
		$cat_id    = (int) $query;
		$attribute = omniverse_get_opt( 'brands_attribute' );
		$term      = get_term( $cat_id, $attribute );

		return omniverse_productCategoryTermOutput( $term );
	}
}
