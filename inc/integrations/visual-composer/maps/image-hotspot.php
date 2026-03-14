<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
* Image hotspot
* ------------------------------------------------------------------------------------------------
*/
if ( ! function_exists( 'omniverse_get_vc_map_image_hotspot' ) ) {
	function omniverse_get_vc_map_image_hotspot() {
		return array(
			'name' => esc_html__( 'Image Hotspot', 'omniverse' ),
			'base' => 'omniverse_image_hotspot',
			'class' => '',
			'category' => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Add hotspots with products to the image', 'omniverse' ),
			'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/image-map.svg',
			'as_parent' => array( 'only' => 'omniverse_hotspot' ),
			'content_element' => true,
			'show_settings_on_create' => true,
			'params' => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				/**
				 * Image
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Background', 'omniverse' ),
					'param_name' => 'image_divider',
				),
				array(
					'type'       => 'omniverse_button_set',
					'heading'    => esc_html__( 'Source', 'omniverse' ),
					'param_name' => 'source_type',
					'value'      => array(
						esc_html__( 'Image', 'omniverse' ) => 'image',
						esc_html__( 'Video', 'omniverse' ) => 'video',
					),
					'default'    => 'image',
				),
				array(
					'type'            => 'wd_upload',
					'heading'         => esc_html__( 'Video', 'omniverse' ),
					'param_name'      => 'video',
					'attachment_type' => 'video',
					'value'           => '',
					'hint'            => esc_html__( 'Select video from media library.', 'omniverse' ),
					'dependency'      => array(
						'element' => 'source_type',
						'value'   => array( 'video' ),
					),
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Fallback image', 'omniverse' ),
					'param_name'       => 'video_poster',
					'holder'           => 'img',
					'value'            => '',
					'hint'             => esc_html__( 'Select images from media library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency'       => array(
						'element' => 'source_type',
						'value'   => array( 'video' ),
					),
				),
				array(
					'type'            => 'textfield',
					'heading'         => esc_html__( 'Fallback image size', 'omniverse' ),
					'param_name'      => 'video_poster_size',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'source_type',
						'value'   => array( 'video' ),
					),
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Image', 'omniverse' ),
					'param_name'       => 'img',
					'holder'           => 'img',
					'value'            => '',
					'hint'             => esc_html__( 'Select images from media library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency'       => array(
						'element' => 'source_type',
						'value'   => array( 'image' ),
					),
				),
				array(
					'type'            => 'textfield',
					'heading'         => esc_html__( 'Image size', 'omniverse' ),
					'param_name'      => 'img_size',
					'hint'            => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'source_type',
						'value'   => array( 'image' ),
					),
				),
				/**
				 * Icon
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_divider'
				),
				array(
					'type' => 'omniverse_image_select',
					'heading' => esc_html__( 'Icon style', 'omniverse' ),
					'param_name' => 'icon',
					'value' => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Alternative', 'omniverse' ) => 'alt',
					),
					'images_value' => array(
						'default' => OMNIVERSE_ASSETS_IMAGES . '/settings/image-hotspot/default.jpg',
						'alt' => OMNIVERSE_ASSETS_IMAGES . '/settings/image-hotspot/alt.jpg',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Icon position', 'omniverse' ),
					'param_name'       => 'icon_position',
					'value'            =>  array(
						esc_html__( 'Static', 'omniverse' ) => 'static',
						esc_html__( 'On hover', 'omniverse' ) => 'hover',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Hotspot action', 'omniverse' ),
					'param_name' => 'action',
					'value' =>  array(
						esc_html__( 'Hover', 'omniverse' ) => 'hover',
						esc_html__( 'Click', 'omniverse' ) => 'click',
					),
					'hint' => esc_html__( 'Open hotspot content on click or hover', 'omniverse' ),
				),
				array(
					'heading'          => esc_html__( 'Primary color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'primary_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-image-hotspot' => array(
							'--hotspot-primary: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Secondary color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'secondary_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-image-hotspot' => array(
							'--hotspot-secondary: {{VALUE}};',
						),
					),
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
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' )
				),
				/**
				 * Design Options
				 */
				array(
					'type' => 'css_editor',
					'heading' => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group' => esc_html__( 'Design Options', 'js_composer' )
				),
				omniverse_get_vc_responsive_spacing_map(),
			),
			'js_view' => 'VcColumnView'
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_hotspot' ) ) {
	function omniverse_get_vc_map_hotspot() {
		return array(
			'name' => esc_html__( 'Hotspot', 'omniverse'),
			'base' => 'omniverse_hotspot',
			'as_child' => array( 'only' => 'omniverse_image_hotspot' ),
			'content_element' => true,
			'category' => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/image-map-hotspot.svg',
			'params' => array(
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Position', 'omniverse' ),
					'param_name' => 'title_divider'
				),
				array(
					'type' => 'omniverse_image_hotspot',
					'heading' => esc_html__( 'Hotspot position', 'omniverse' ),
					'param_name' => 'hotspot',
				),
				/**
				 * Content
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Content', 'omniverse' ),
					'param_name' => 'content_divider'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Hotspot content', 'omniverse' ),
					'param_name' => 'hotspot_type',
					'value' =>  array(
						esc_html__( 'Product', 'omniverse' ) => 'product',
						esc_html__( 'Text', 'omniverse' ) => 'text'
					),
					'hint' => esc_html__( 'You can display any product or custom text in the hotspot content.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Hotspot dropdown side', 'omniverse' ),
					'param_name' => 'hotspot_dropdown_side',
					'value' =>  array(
						esc_html__( 'Left', 'omniverse' ) => 'left',
						esc_html__( 'Right', 'omniverse' ) => 'right',
						esc_html__( 'Top', 'omniverse' ) => 'top',
						esc_html__( 'Bottom', 'omniverse' ) => 'bottom',
					),
					'hint' => esc_html__( 'Show the content on left or right side, top or bottom.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Product
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Product', 'omniverse' ),
					'param_name' => 'product_divider',
					'dependency' => array(
						'element' => 'hotspot_type',
						'value' => array( 'product' )
					)
				),
				array(
					'type' => 'autocomplete',
					'heading' => esc_html__( 'Select product', 'omniverse' ),
					'param_name' => 'product_id',
					'hint' => esc_html__( 'Add products by title.', 'omniverse' ),
					'settings' => array(
						'multiple' => false,
						'sortable' => false,
						'groups' => true
					),
					'dependency' => array(
						'element' => 'hotspot_type',
						'value' => array( 'product' )
					)
				),
				/**
				 * Text
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Text', 'omniverse' ),
					'param_name' => 'text_divider',
					'dependency' => array(
						'element' => 'hotspot_type',
						'value' => array( 'text' )
					)
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'heading' => esc_html__( 'Title', 'omniverse' ),
					'param_name' => 'title',
					'dependency' => array(
						'element' => 'hotspot_type',
						'value' => array( 'text' )
					)
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image', 'omniverse' ),
					'param_name' => 'img',
					'value' => '',
					'hint' => esc_html__( 'Select images from media library.', 'omniverse' ),
					'dependency' => array(
						'element' => 'hotspot_type',
						'value' => array( 'text' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Image size', 'omniverse' ),
					'param_name' => 'img_size',
					'hint' => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'dependency' => array(
						'element' => 'hotspot_type',
						'value' => array( 'text' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description' => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Link text', 'omniverse'),
					'param_name' => 'link_text',
					'dependency' => array(
						'element' => 'hotspot_type',
						'value' => array( 'text' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'vc_link',
					'heading' => esc_html__( 'Link', 'omniverse'),
					'param_name' => 'link',
					'dependency' => array(
						'element' => 'hotspot_type',
						'value' => array( 'text' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'heading' => esc_html__( 'Content', 'omniverse' ),
					'param_name' => 'content',
					'dependency' => array(
						'element' => 'hotspot_type',
						'value' => array( 'text' )
					)
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
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' )
				),
			),
		);
	}
}

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if( class_exists( 'WPBakeryShortCodesContainer' ) ){
	class WPBakeryShortCode_omniverse_image_hotspot extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if( class_exists( 'WPBakeryShortCode' ) ){
	class WPBakeryShortCode_omniverse_hotspot extends WPBakeryShortCode {}
}

//WC 3.6.0
if ( function_exists( 'WC' ) && version_compare( WC()->version, '3.6.0', '<' ) ) {
	add_filter( 'vc_autocomplete_omniverse_hotspot_product_id_callback',	'omniverse_productIdAutocompleteSuggester', 10, 1 );
	add_filter( 'vc_autocomplete_omniverse_hotspot_product_id_render','omniverse_productIdAutocompleteRender', 10, 1 );
} else {
	add_filter( 'vc_autocomplete_omniverse_hotspot_product_id_callback',	'omniverse_productIdAutocompleteSuggester_new', 10, 1 );
	add_filter( 'vc_autocomplete_omniverse_hotspot_product_id_render','omniverse_productIdAutocompleteRender', 10, 1 );
}

if ( ! function_exists( 'omniverse_productIdAutocompleteSuggester' ) ) {
	function omniverse_productIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$product_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.ID AS id, a.post_title AS title, b.meta_value AS sku
						FROM {$wpdb->posts} AS a
						LEFT JOIN ( SELECT meta_value, post_id  FROM {$wpdb->postmeta} WHERE `meta_key` = '_sku' ) AS b ON b.post_id = a.ID
						WHERE a.post_type = 'product' AND ( a.ID = '%d' OR b.meta_value LIKE '%%%s%%' OR a.post_title LIKE '%%%s%%' )", $product_id > 0 ? $product_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data = array();
				$data['value'] = $value['id'];
				$data['label'] = __( 'Id', 'omniverse' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . __( 'Title', 'omniverse' ) . ': ' . $value['title'] : '' ) . ( ( strlen( $value['sku'] ) > 0 ) ? ' - ' . __( 'Sku', 'omniverse' ) . ': ' . $value['sku'] : '' );
				$results[] = $data;
			}
		}

		return $results;
	}
}

if ( ! function_exists( 'omniverse_productIdAutocompleteSuggester_new' ) ) {
	function omniverse_productIdAutocompleteSuggester_new( $query ) {
		global $wpdb;
		$product_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.ID AS id, a.post_title AS title
						FROM {$wpdb->posts} AS a
						LEFT JOIN ( SELECT product_id, sku FROM {$wpdb->wc_product_meta_lookup} ) AS b ON b.product_id = a.ID
						WHERE a.post_type = 'product' AND ( a.ID = '%d' OR b.sku LIKE '%%%s%%' OR a.post_title LIKE '%%%s%%' )", $product_id > 0 ? $product_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'omniverse' ) . ': ' . $value['id'] . ( ( isset( $value['title'] ) ) ? ' - ' . esc_html__( 'Title', 'omniverse' ) . ': ' . $value['title'] : '' ) . ( ( isset( $value['sku'] ) ) ? ' - ' . esc_html__( 'Sku', 'omniverse' ) . ': ' . $value['sku'] : '' );
				$results[] = $data;
			}
		}

		return $results;
	}
}

if ( ! function_exists( 'omniverse_productIdAutocompleteRender' ) ) {
	function omniverse_productIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get product
			$product_object = wc_get_product( (int) $query );
			if ( is_object( $product_object ) ) {
				$product_sku = $product_object->get_sku();
				$product_title = $product_object->get_title();
				$product_id = $product_object->get_id();

				$product_sku_display = '';
				if ( ! empty( $product_sku ) ) {
					$product_sku_display = ' - ' . esc_html__( 'Sku', 'omniverse' ) . ': ' . $product_sku;
				}

				$product_title_display = '';
				if ( ! empty( $product_title ) ) {
					$product_title_display = ' - ' . esc_html__( 'Title', 'omniverse' ) . ': ' . $product_title;
				}

				$product_id_display = esc_html__( 'Id', 'omniverse' ) . ': ' . $product_id;

				$data = array();
				$data['value'] = $product_id;
				$data['label'] = $product_id_display . $product_title_display . $product_sku_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}
