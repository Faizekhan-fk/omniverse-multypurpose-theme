<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
* Categories element map
* ------------------------------------------------------------------------------------------------
*/

if( ! function_exists( 'omniverse_get_vc_shortcode_categories' ) ) {
	function omniverse_get_vc_shortcode_categories() {
		$order_by_values = array(
			'',
			esc_html__( 'Date', 'omniverse' ) => 'date',
			esc_html__( 'ID', 'omniverse' ) => 'ID',
			esc_html__( 'Title', 'omniverse' ) => 'title',
			esc_html__( 'Modified', 'omniverse' ) => 'modified',
			esc_html__( 'Menu order', 'omniverse' ) => 'menu_order',
			esc_html__( 'As IDs or slugs provided order', 'omniverse' ) => 'include',
		);

		$order_way_values = array(
			esc_html__( 'Inherit', 'omniverse' ) => '',
			esc_html__( 'Descending', 'omniverse' ) => 'DESC',
			esc_html__( 'Ascending', 'omniverse' ) => 'ASC',
		);

		$title_typography = omniverse_get_typography_map(
			array(
				'title'    => esc_html__( 'Title typography', 'omniverse' ),
				'key'      => 'title_typography',
				'selector' => '{{WRAPPER}} div.product-category .wd-entities-title, {{WRAPPER}} .wd-nav-product-cat>li>a',
				'group'    => esc_html__( 'Style', 'omniverse' ),
			)
		);

		return array(
				'name'        => esc_html__( 'Product categories', 'omniverse' ),
				'base'        => 'omniverse_categories',
				'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
				'description' => esc_html__( 'Product categories grid', 'omniverse' ),
				'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/product-categories.svg',
				'params'      => array(
					/**
					 * Data settings
					 */
					array(
						'group'      => esc_html__( 'Content', 'omniverse' ),
						'type'       => 'omniverse_css_id',
						'param_name' => 'omniverse_css_id',
					),

					array(
						'title'      => esc_html__( 'General', 'omniverse' ),
						'group'      => esc_html__( 'Content', 'omniverse' ),
						'type'       => 'omniverse_title_divider',
						'param_name' => 'data_divider',
					),

					array(
						'heading'          => esc_html__( 'Data source', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'hint'             => esc_html__( 'Use WooCommerce query when you display this element as a part of the shop page in OmniVerse Layouts builder.', 'omniverse' ),
						'type'             => 'dropdown',
						'param_name'       => 'data_source',
						'value'            => array(
							esc_html__( 'Custom query', 'omniverse' ) => 'custom_query',
							esc_html__( 'WooCommerce query', 'omniverse' ) => 'wc_query',
						),
						'std'              => 'custom_query',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),

					array(
						'heading'          => esc_html__( 'Type', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'type'             => 'dropdown',
						'param_name'       => 'type',
						'value'            => array(
							esc_html__( 'Navigation', 'omniverse' ) => 'navigation',
							esc_html__( 'Grid', 'omniverse' ) => 'grid',
						),
						'std'              => 'grid',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),

					array(
						'heading'          => esc_html__( 'Enable images', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'type'             => 'omniverse_switch',
						'param_name'       => 'images',
						'true_state'       => 'yes',
						'false_state'      => 'no',
						'default'          => 'yes',
						'dependency'       => array(
							'element' => 'type',
							'value'   => array( 'navigation' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),

					array(
						'heading'          => esc_html__( 'Enable product count', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'type'             => 'omniverse_switch',
						'param_name'       => 'product_count',
						'true_state'       => 'yes',
						'false_state'      => 'no',
						'default'          => 'yes',
						'dependency'       => array(
							'element' => 'type',
							'value'   => array( 'navigation' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),

					array(
						'heading'          => esc_html__( 'Mobile accordion', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'type'             => 'omniverse_switch',
						'param_name'       => 'mobile_accordion',
						'true_state'       => 'yes',
						'false_state'      => 'no',
						'default'          => 'yes',
						'hint'             => esc_html__( 'Turn categories navigation into accordion on mobile devices', 'omniverse' ),
						'dependency'       => array(
							'element' => 'type',
							'value'   => array( 'navigation' ),
						),
						'edit_field_class' => 'vc_col-sm-12 vc_column',
					),

					array(
						'heading'          => esc_html__( 'Show current category ancestors', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'descriptions'     => esc_html__( 'This option works with WooCommerce query Data source only. They are dedicated to the shop page layout.', 'omniverse' ),
						'type'             => 'omniverse_switch',
						'param_name'       => 'shop_categories_ancestors',
						'hint'             => esc_html__( 'If you visit category Man, for example, only man\'s subcategories will be shown in the page title like T-shirts, Coats, Shoes etc.', 'omniverse' ),
						'true_state'       => 'yes',
						'false_state'      => 'no',
						'default'          => 'no',
						'dependency'       => array(
							'element' => 'type',
							'value'   => array( 'navigation' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),

					array(
						'heading'          => esc_html__( 'Show category neighbors if there is no children', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'descriptions'     => esc_html__( 'This option works with WooCommerce query Data source only. They are dedicated to the shop page layout.', 'omniverse' ),
						'type'             => 'omniverse_switch',
						'param_name'       => 'show_categories_neighbors',
						'hint'             => esc_html__( 'If the category you visit doesn\'t contain any subcategories, the page title menu will display this category\'s neighbors categories.', 'omniverse' ),
						'true_state'       => 'yes',
						'false_state'      => 'no',
						'default'          => 'no',
						'dependency'       => array(
							'element' => 'type',
							'value'   => array( 'navigation' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),

					array(
						'heading'          => esc_html__( 'Number', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'type'             => 'textfield',
						'param_name'       => 'number',
						'hint'             => esc_html__( 'Enter the number of categories to display for this element.', 'omniverse' ),
						'dependency'       => array(
							'element' => 'data_source',
							'value'   => array( 'custom_query' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),

					array(
						'heading'          => esc_html__( 'Order by', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'type'             => 'dropdown',
						'param_name'       => 'orderby',
						'value'            => $order_by_values,
						'save_always'      => true,
						'hint'             => sprintf( wp_kses(  __( 'Select how to sort retrieved categories. More at %s.', 'omniverse' ), array(
							'a' => array(
								'href'   => array(),
								'target' => array()
							)
						)), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						'dependency'       => array(
							'element' => 'data_source',
							'value'   => array( 'custom_query' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'heading'          => esc_html__( 'Sort order', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'type'             => 'omniverse_button_set',
						'param_name'       => 'order',
						'value'            => $order_way_values,
						'save_always'      => true,
						'hint'             => sprintf( wp_kses(  __( 'Designates the ascending or descending order. More at %s.', 'omniverse' ), array(
							'a' => array(
								'href' => array(),
								'target' => array()
							)
						)), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						'dependency'       => array(
							'element' => 'data_source',
							'value'   => array( 'custom_query' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'heading'          => esc_html__( 'Categories', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'type'             => 'autocomplete',
						'param_name'       => 'ids',
						'settings'         => array(
							'multiple' => true,
							'sortable' => true,
						),
						'save_always'      => true,
						'hint'             => esc_html__( 'List of product categories', 'omniverse' ),
						'dependency'       => array(
							'element' => 'data_source',
							'value'   => array( 'custom_query' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'heading'          => esc_html__( 'Hide empty', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'type'             => 'omniverse_switch',
						'param_name'       => 'hide_empty',
						'hint'             => esc_html__( 'Don’t display categories that don’t have any products assigned.', 'omniverse' ),
						'true_state'       => 'yes',
						'false_state'      => 'no',
						'default'          => 'yes',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),

					/**
					 * Design
					 */
					array(
						'title'      => esc_html__( 'Design', 'omniverse' ),
						'group'      => esc_html__( 'Style', 'omniverse' ),
						'type'       => 'omniverse_title_divider',
						'param_name' => 'design_divider',
					),
					array(
						'heading'      => esc_html__( 'Categories design', 'omniverse' ),
						'group'        => esc_html__( 'Style', 'omniverse' ),
						'type'         => 'omniverse_image_select',
						'param_name'   => 'categories_design',
						'value'        => array(
							esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
							esc_html__( 'Default', 'omniverse' ) => 'default',
							esc_html__( 'Alternative', 'omniverse' ) => 'alt',
							esc_html__( 'Center title', 'omniverse' ) => 'center',
							esc_html__( 'Replace title', 'omniverse' ) => 'replace-title',
							esc_html__( 'Mask with subcategories', 'omniverse' ) => 'mask-subcat',
							esc_html__( 'Zoom out', 'omniverse' ) => 'zoom-out',
						),
						'images_value' => array(
							'inherit'       => OMNIVERSE_ASSETS_IMAGES . '/settings/empty.jpg',
							'default'       => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/default.jpg',
							'alt'           => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/alt.jpg',
							'center'        => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/center.jpg',
							'replace-title' => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/replace-title.jpg',
							'mask-subcat'   => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/subcat.jpg',
							'zoom-out'      => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/zoom-out.jpg',
						),
						'hint'         => esc_html__( 'Overrides option from Theme Settings -> Shop', 'omniverse' ),
						'dependency'   => array(
							'element' => 'type',
							'value'   => array( 'grid' ),
						),
					),
					array(
						'heading'    => esc_html__( 'Image size', 'omniverse' ),
						'group'      => esc_html__( 'Style', 'omniverse' ),
						'type'       => 'textfield',
						'param_name' => 'img_size',
						'hint'       => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					),
					array(
						'heading'    => esc_html__( 'Image container width', 'omniverse' ),
						'group'      => esc_html__( 'Style', 'omniverse' ),
						'type'       => 'wd_slider',
						'param_name' => 'image_container_width',
						'selectors'  => array(
							'{{WRAPPER}}' => array(
								'--wd-cat-img-width: {{VALUE}}{{UNIT}};',
							),
						),
						'devices'    => array(
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
						'range'      => array(
							'px' => array(
								'min'  => 0,
								'max'  => 1000,
								'step' => 1,
							),
							'%'  => array(
								'min'  => 0,
								'max'  => 100,
								'step' => 1,
							),
						),
						'dependency' => array(
							'element' => 'categories_design',
							'value'   => array( 'alt' ),
						),
					),
					array(
						'heading'          => esc_html__( 'Color scheme', 'omniverse' ),
						'group'            => esc_html__( 'Style', 'omniverse' ),
						'type'             => 'omniverse_dropdown',
						'param_name'       => 'color_scheme',
						'value'            => array(
							esc_html__( 'Inherit', 'omniverse' ) => 'inherit',
							esc_html__( 'Dark', 'omniverse' )  => 'dark',
							esc_html__( 'Light', 'omniverse' ) => 'light',
						),
						'style'            => array(
							'dark' => '#2d2a2a',
						),
						'std'              => '',
						'dependency'       => array(
							'element' => 'categories_design',
							'value'   => array( 'default', 'mask-subcat' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'heading'    => esc_html__( 'Categories with shadow', 'omniverse' ),
						'group'      => esc_html__( 'Style', 'omniverse' ),
						'type'       => 'omniverse_button_set',
						'param_name' => 'categories_with_shadow',
						'value'      => array(
							esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => '',
							esc_html__( 'Enable', 'omniverse' ) => 'enable',
							esc_html__( 'Disable', 'omniverse' ) => 'disable',
						),
						'dependency' => array(
							'element' => 'categories_design',
							'value'   => array( 'alt', 'default' ),
						),
					),

					array(
						'heading'          => esc_html__( 'Alignment', 'omniverse' ),
						'group'            => esc_html__( 'Style', 'omniverse' ),
						'type'             => 'wd_select',
						'param_name'       => 'nav_alignment',
						'style'            => 'images',
						'selectors'        => array(),
						'devices'          => array(
							'desktop' => array(
								'value' => 'left',
							),
						),
						'value'            => array(
							esc_html__( 'Left', 'omniverse' )   => 'left',
							esc_html__( 'Center', 'omniverse' ) => 'center',
							esc_html__( 'Right', 'omniverse' )  => 'right',
						),
						'images'           => array(
							'left'   => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
							'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
							'right'  => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
						),
						'dependency'       => array(
							'element' => 'type',
							'value'   => array( 'navigation' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'heading'          => esc_html__( 'Color scheme', 'omniverse' ),
						'group'            => esc_html__( 'Style', 'omniverse' ),
						'type'             => 'omniverse_dropdown',
						'param_name'       => 'nav_color_scheme',
						'value'            => array(
							esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
							esc_html__( 'Dark', 'omniverse' )  => 'dark',
							esc_html__( 'Light', 'omniverse' ) => 'light',
							esc_html__( 'Custom', 'omniverse' ) => 'custom',
						),
						'dependency'       => array(
							'element' => 'type',
							'value'   => array( 'navigation' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'type'             => 'wd_colorpicker',
						'heading'          => esc_html__( 'Idle color', 'omniverse' ),
						'param_name'       => 'title_idle_color',
						'selectors'        => array(
							'{{WRAPPER}} .wd-nav[class*=wd-style-] > li > a' => array(
								'color: {{VALUE}};',
							),
						),
						'group'            => esc_html__( 'Style', 'omniverse' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'dependency'       => array(
							'element' => 'nav_color_scheme',
							'value'   => array( 'custom' ),
						),
					),
					array(
						'type'             => 'wd_colorpicker',
						'heading'          => esc_html__( 'Hover color', 'omniverse' ),
						'param_name'       => 'title_hover_color',
						'selectors'        => array(
							'{{WRAPPER}} .wd-nav[class*=wd-style-] > li:hover > a' => array(
								'color: {{VALUE}};',
							),
						),
						'group'            => esc_html__( 'Style', 'omniverse' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'dependency'       => array(
							'element' => 'nav_color_scheme',
							'value'   => array( 'custom' ),
						),
					),
					array(
						'heading'       => esc_html__( 'Rounding', 'omniverse' ),
						'group'         => esc_html__( 'Style', 'omniverse' ),
						'type'          => 'wd_select',
						'param_name'    => 'rounding_size',
						'style'         => 'select',
						'selectors'     => array(
							'{{WRAPPER}}' => array(
								'--wd-cat-brd-radius: {{VALUE}}px;',
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
						'dependency'    => array(
							'element' => 'type',
							'value'   => array( 'grid' ),
						),
						'generate_zero' => true,
					),
					array(
						'heading'       => esc_html__( 'Custom rounding', 'omniverse' ),
						'group'         => esc_html__( 'Style', 'omniverse' ),
						'type'          => 'wd_slider',
						'param_name'    => 'custom_rounding_size',
						'selectors'     => array(
							'{{WRAPPER}}' => array(
								'--wd-cat-brd-radius: {{VALUE}}{{UNIT}};',
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
					$title_typography['font_family'],
					$title_typography['font_size'],
					$title_typography['font_weight'],
					$title_typography['text_transform'],
					$title_typography['font_style'],
					$title_typography['line_height'],

					/**
					 * Layout
					 */
					array(
						'title'      => esc_html__( 'Layout', 'omniverse' ),
						'group'      => esc_html__( 'Style', 'omniverse' ),
						'type'       => 'omniverse_title_divider',
						'param_name' => 'layout_divider',
						'holder'     => 'div',
						'dependency' => array(
							'element' => 'type',
							'value'   => array( 'grid' ),
						),
					),
					array(
						'heading'          => esc_html__( 'Layout', 'omniverse' ),
						'group'            => esc_html__( 'Style', 'omniverse' ),
						'type'             => 'dropdown',
						'param_name'       => 'style',
						'save_always'      => true,
						'hint'             => esc_html__( 'Try out our creative styles for categories block', 'omniverse' ),
						'value'            => array(
							esc_html__( 'Grid', 'omniverse' )                   => 'default',
							esc_html__( 'Masonry', 'omniverse' )                   => 'masonry',
							esc_html__( 'Masonry (with first wide)', 'omniverse' ) => 'masonry-first',
							esc_html__( 'Carousel', 'omniverse' )                  => 'carousel',
						),
						'dependency'       => array(
							'element' => 'type',
							'value'   => array( 'grid' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'heading'          => esc_html__( 'Columns', 'omniverse' ),
						'hint'             => esc_html__( 'Number of columns in the grid.', 'omniverse' ),
						'group'            => esc_html__( 'Style', 'omniverse' ),
						'type'             => 'wd_slider',
						'param_name'       => 'columns',
						'devices'          => array(
							'desktop' => array(
								'unit'  => '-',
								'value' => 4,
							),
							'tablet'  => array(
								'unit'  => '-',
								'value' => '',
							),
							'mobile'  => array(
								'unit'  => '-',
								'value' => '',
							),
						),
						'range'            => array(
							'-' => array(
								'min'  => 1,
								'max'  => 12,
								'step' => 1,
							),
						),
						'selectors'        => array(),
						'dependency'       => array(
							'element' => 'style',
							'value'   => array( 'masonry', 'default' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'heading'    => esc_html__( 'Grid items with different sizes', 'omniverse' ),
						'group'      => esc_html__( 'Style', 'omniverse' ),
						'type'       => 'textfield',
						'param_name' => 'grid_different_sizes',
						'value'      => '',
						'dependency' => array(
							'element' => 'style',
							'value'   => array( 'default' ),
						),
					),
					array(
						'type'             => 'omniverse_button_set',
						'heading'          => esc_html__( 'Space between categories', 'omniverse' ),
						'group'            => esc_html__( 'Style', 'omniverse' ),
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
						'group'            => esc_html__( 'Style', 'omniverse' ),
						'type'             => 'dropdown',
						'param_name'       => 'spacing',
						'value'            => array(
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
						'group'            => esc_html__( 'Style', 'omniverse' ),
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
						'group'            => esc_html__( 'Style', 'omniverse' ),
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
					/**
					 * Carousel
					 */
					array(
						'title'      => esc_html__( 'Carousel', 'omniverse' ),
						'group'      => esc_html__( 'Carousel', 'omniverse' ),
						'type'       => 'omniverse_title_divider',
						'holder'     => 'div',
						'param_name' => 'carousel_divider',
						'dependency' => array(
							'element' => 'style',
							'value'   => array( 'carousel' ),
						),
					),
					/**
					 * Extra
					 */
					array(
						'title'      => esc_html__( 'Extra options', 'omniverse' ),
						'group'      => esc_html__( 'Style', 'omniverse' ),
						'type'       => 'omniverse_title_divider',
						'param_name' => 'extra_divider',
					),
					array(
						'heading'          => esc_html__( 'Lazy loading for images', 'omniverse' ),
						'group'            => esc_html__( 'Style', 'omniverse' ),
						'type'             => 'omniverse_switch',
						'param_name'       => 'lazy_loading',
						'hint'             => esc_html__( 'Enable lazy loading for images for this element.', 'omniverse' ),
						'true_state'       => 'yes',
						'false_state'      => 'no',
						'default'          => 'no',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
						'group'      => esc_html__( 'Style', 'omniverse' ),
						'type'       => 'textfield',
						'param_name' => 'el_class',
						'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
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

//Filters For autocomplete param:
//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
add_filter( 'vc_autocomplete_omniverse_categories_ids_callback', 'omniverse_productCategoryCategoryAutocompleteSuggester', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_omniverse_categories_ids_render', 'omniverse_productCategoryCategoryRenderByIdExact', 10, 1 );

if( ! function_exists( 'omniverse_productCategoryCategoryAutocompleteSuggester' ) ) {
	function omniverse_productCategoryCategoryAutocompleteSuggester( $query, $slug = false ) {
		global $wpdb;
		$cat_id = (int) $query;
		$query = trim( $query );
		$post_meta_infos = $wpdb->get_results(
			$wpdb->prepare( "SELECT a.term_id AS id, b.name as name, b.slug AS slug
						FROM {$wpdb->term_taxonomy} AS a
						INNER JOIN {$wpdb->terms} AS b ON b.term_id = a.term_id
						WHERE a.taxonomy = 'product_cat' AND (a.term_id = '%d' OR b.slug LIKE '%%%s%%' OR b.name LIKE '%%%s%%' )",
				$cat_id > 0 ? $cat_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$result = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data = array();
				$data['value'] = $slug ? $value['slug'] : $value['id'];
				$data['label'] = esc_html__( 'Id', 'omniverse' ) . ': ' .
				                 $value['id'] .
				                 ( ( strlen( $value['name'] ) > 0 ) ? ' - ' . esc_html__( 'Name', 'omniverse' ) . ': ' .
				                                                      $value['name'] : '' ) .
				                 ( ( strlen( $value['slug'] ) > 0 ) ? ' - ' . esc_html__( 'Slug', 'omniverse' ) . ': ' .
				                                                      $value['slug'] : '' );
				$result[] = $data;
			}
		}

		return $result;
	}
}
if( ! function_exists( 'omniverse_productCategoryCategoryRenderByIdExact' ) ) {
	function omniverse_productCategoryCategoryRenderByIdExact( $query ) {
		global $wpdb;
		$query = $query['value'];
		$cat_id = (int) $query;
		$term = get_term( $cat_id, 'product_cat' );

		return omniverse_productCategoryTermOutput( $term );
	}
}

if( ! function_exists( 'omniverse_productCategoryTermOutput' ) ) {
	function omniverse_productCategoryTermOutput( $term ) {
		if ( !$term || !is_object( $term ) ) {
			return false;
		}

		$term_slug = $term->slug;
		$term_title = $term->name;
		$term_id = $term->term_id;

		$term_slug_display = '';
		if ( ! empty( $term_slug ) ) {
			$term_slug_display = ' - ' . esc_html__( 'Slug', 'omniverse' ) . ': ' . $term_slug;
		}

		$term_title_display = '';
		if ( ! empty( $term_title ) ) {
			$term_title_display = ' - ' . esc_html__( 'Name', 'omniverse' ) . ': ' . $term_title;
		}

		$term_id_display = esc_html__( 'Id', 'omniverse' ) . ': ' . $term_id;

		$data = array();
		$data['value'] = $term_id;
		$data['label'] = $term_id_display . $term_title_display . $term_slug_display;

		return ! empty( $data ) ? $data : false;
	}
}
