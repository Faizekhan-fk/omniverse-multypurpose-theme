<?php
/**
 * Open street map.
 *
 * @package Elements
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_get_vc_map_open_street_map' ) ) {
	/**
	 * Displays the shortcode settings fields in the admin.
	 */
	function omniverse_get_vc_map_open_street_map() {
		return array(
			'base'            => 'omniverse_open_street_map',
			'name'            => esc_html__( 'Open street map', 'omniverse' ),
			'description'     => esc_html__( 'Show Open street map', 'omniverse' ),
			'category'        => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'as_parent'       => array( 'except' => 'testimonial' ),
			'content_element' => true,
			'js_view'         => 'VcColumnView',
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/open-street-map.svg',
			'params'          => array(
				array(
					'param_name' => 'omniverse_css_id',
					'type'       => 'omniverse_css_id',
				),
				/**
				 * Settings.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Settings', 'omniverse' ),
					'param_name' => 'title_divider',
				),
				array(
					'type'       => 'param_group',
					'param_name' => 'marker_list',
					'heading'    => esc_html__( 'Marker list', 'omniverse' ),
					'params'     => array(
						array(
							'type'          => 'omniverse_title_divider',
							'holder'        => 'div',
							'title'         => esc_html__( 'Content', 'omniverse' ),
							'param_name'    => 'marker_content_title_divider',
							'without_group' => true,
						),
						array(
							'param_name'  => 'marker_title',
							'type'        => 'textfield',
							'admin_label' => true,
							'heading'     => esc_html__( 'Title', 'omniverse' ),
						),
						array(
							'param_name' => 'marker_coords',
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Coordinates', 'omniverse' ),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'param_name'  => 'marker_description',
							'type'        => 'textarea',
							'admin_label' => true,
							'heading'     => esc_html__( 'Description', 'omniverse' ),
						),
						array(
							'heading'    => esc_html__( 'Behavior', 'omniverse' ),
							'type'       => 'dropdown',
							'param_name' => 'marker_behavior',
							'value'      => array(
								esc_html__( 'Popup', 'omniverse' ) => 'popup',
								esc_html__( 'Tooltip', 'omniverse' ) => 'tooltip',
								esc_html__( 'Static with close', 'omniverse' ) => 'static_close_on',
								esc_html__( 'Static without close', 'omniverse' ) => 'static_close_off',
								esc_html__( 'None', 'omniverse' ) => 'none',
							),
						),
						array(
							'type'        => 'omniverse_switch',
							'heading'     => esc_html__( 'Show button', 'omniverse' ),
							'param_name'  => 'show_button',
							'true_state'  => esc_html__( 'yes', 'omniverse' ),
							'false_state' => esc_html__( 'no', 'omniverse' ),
							'default'     => 'no',
						),
						array(
							'param_name' => 'button_text',
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Button text', 'omniverse' ),
							'dependency' => array(
								'element' => 'show_button',
								'value'   => array( 'yes' ),
							),
						),
						array(
							'param_name' => 'button_url',
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Button URL', 'omniverse' ),
							'dependency' => array(
								'element' => 'show_button',
								'value'   => array( 'yes' ),
							),
						),
						array(
							'heading'    => esc_html__( 'URL target', 'omniverse' ),
							'type'       => 'dropdown',
							'param_name' => 'button_url_target',
							'value'      => array(
								esc_html__( 'Same Window', 'omniverse' ) => '_self',
								esc_html__( 'New Window/Tab', 'omniverse' ) => '_blank',
							),
							'std'        => '_blank',
							'dependency' => array(
								'element'            => 'button_url',
								'value_not_equal_to' => array( '' ),
							),
						),
						array(
							'type'          => 'omniverse_title_divider',
							'holder'        => 'div',
							'title'         => esc_html__( 'Marker', 'omniverse' ),
							'param_name'    => 'marker_image_title_divider',
							'without_group' => true,
						),
						array(
							'type'       => 'attach_image',
							'heading'    => esc_html__( 'Image', 'omniverse' ),
							'param_name' => 'image',
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Image size', 'omniverse' ),
							'param_name'  => 'image_size',
							'description' => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
							'value'       => 'full',
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
					),
				),
				/**
				 * Marker settings.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Marker settings', 'omniverse' ),
					'param_name' => 'title_divider',
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Marker icon', 'omniverse' ),
					'param_name' => 'marker_icon',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image size', 'omniverse' ),
					'param_name'  => 'marker_icon_size',
					'description' => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'value'       => 'full',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Map settings.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Map settings', 'omniverse' ),
					'param_name' => 'title_divider',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Map mask', 'omniverse' ),
					'hint'             => esc_html__( 'Add an overlay to your map to make the content look cleaner on the map.', 'omniverse' ),
					'param_name'       => 'mask',
					'value'            => array(
						esc_html__( 'Without', 'omniverse' ) => '',
						esc_html__( 'Dark', 'omniverse' )  => 'dark',
						esc_html__( 'Light', 'omniverse' ) => 'light',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Zoom', 'omniverse' ),
					'hint'             => esc_html__( 'Zoom level when focus the marker 1 - 20', 'omniverse' ),
					'type'             => 'wd_slider',
					'param_name'       => 'zoom',
					'selectors'        => array(
						'{{WRAPPER}}' => array(),
					),
					'devices'          => array(
						'desktop' => array(
							'value' => '15',
							'unit'  => 'level',
						),
					),
					'range'            => array(
						'level' => array(
							'min' => 1,
							'max' => 20,
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Map Height', 'omniverse' ),
					'type'             => 'wd_slider',
					'param_name'       => 'height',
					'selectors'        => array(
						'{{WRAPPER}}.wd-osm-map-container .wd-osm-map-wrapper' => array(
							'height: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'          => array(
						'desktop' => array(
							'value' => '400',
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
							'min'  => 40,
							'max'  => 2000,
							'step' => 10,
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Zoom control', 'omniverse' ),
					'param_name'       => 'zoom_control',
					'true_state'       => esc_html__( 'yes', 'omniverse' ),
					'false_state'      => esc_html__( 'no', 'omniverse' ),
					'default'          => 'yes',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Zoom with mouse wheel', 'omniverse' ),
					'param_name'       => 'scroll_zoom',
					'true_state'       => esc_html__( 'yes', 'omniverse' ),
					'false_state'      => esc_html__( 'no', 'omniverse' ),
					'default'          => 'yes',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Pan control', 'omniverse' ),
					'param_name'       => 'pan_control',
					'true_state'       => esc_html__( 'yes', 'omniverse' ),
					'false_state'      => esc_html__( 'no', 'omniverse' ),
					'default'          => 'yes',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'    => esc_html__( 'Map style (Tile)', 'omniverse' ),
					'type'       => 'dropdown',
					'param_name' => 'geoapify_tile',
					'value'      => array(
						esc_html__( 'OSM carto', 'omniverse' ) => 'osm-carto',
						esc_html__( 'Stamen toner', 'omniverse' ) => 'stamen-toner',
						esc_html__( 'Stamen terrain', 'omniverse' ) => 'stamen-terrain',
						esc_html__( 'Stamen watercolor', 'omniverse' ) => 'stamen-watercolor',
						esc_html__( 'Custom map tile', 'omniverse' ) => 'custom-tile',
					),
				),
				array(
					'param_name'  => 'geoapify_custom_tile',
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Custom map tile URL', 'omniverse' ),
					'description' => sprintf(
						__( 'You can find more Open Street Maps styles on the website: %1$s OpenStreetMap Wiki %2$s %3$s Just copy url and paste it here %3$s For example: %4$s', 'omniverse' ),
						'<a target="_blank" href="https://wiki.openstreetmap.org/wiki/Raster_tile_providers">',
						'</a>',
						'<br>',
						'https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png'
					),
					'dependency'  => array(
						'element' => 'geoapify_tile',
						'value'   => array( 'custom-tile' ),
					),
				),
				array(
					'param_name' => 'osm_custom_attribution',
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Attribution title', 'omniverse' ),
					'dependency' => array(
						'element' => 'geoapify_tile',
						'value'   => array( 'custom-tile' ),
					),
				),
				array(
					'param_name' => 'osm_custom_attribution_url',
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Attribution URL', 'omniverse' ),
					'dependency' => array(
						'element' => 'geoapify_tile',
						'value'   => array( 'custom-tile' ),
					),
				),
				/**
				 * Extra.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_divider',
				),
				( function_exists( 'vc_map_add_css_animation' ) ) ? vc_map_add_css_animation( true ) : '',
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
				/**
				 * Content settings.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Content settings', 'omniverse' ),
					'group'      => esc_html__( 'Content', 'omniverse' ),
					'param_name' => 'content_set_divider',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Content on the map horizontal position', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'param_name'       => 'content_horizontal',
					'value'            => array(
						esc_html__( 'Left', 'omniverse' )   => 'left',
						esc_html__( 'Center', 'omniverse' ) => 'center',
						esc_html__( 'Right', 'omniverse' )  => 'right',
					),
					'images_value'     => array(
						'left'   => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/horizontal/left.png',
						'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/horizontal/center.png',
						'right'  => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/horizontal/right.png',
					),
					'std'              => 'left',
					'omni_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column content-position',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Content on the map vertical position', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'param_name'       => 'content_vertical',
					'value'            => array(
						esc_html__( 'Top', 'omniverse' ) => 'top',
						esc_html__( 'Middle', 'omniverse' ) => 'middle',
						esc_html__( 'Bottom', 'omniverse' ) => 'bottom',
					),
					'images_value'     => array(
						'top'    => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/vertical/top.png',
						'middle' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/vertical/middle.png',
						'bottom' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/vertical/bottom.png',
					),
					'std'              => 'top',
					'omni_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column content-position',
				),
				array(
					'type'             => 'omniverse_slider',
					'heading'          => esc_html__( 'Content width', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'param_name'       => 'content_width',
					'min'              => '100',
					'max'              => '2000',
					'step'             => '10',
					'default'          => '300',
					'units'            => 'px',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'hint'             => esc_html__( 'Default: 300', 'omniverse' ),
				),
				/**
				 * Loading settings.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Lazy loading settings', 'omniverse' ),
					'group'      => esc_html__( 'Content', 'omniverse' ),
					'param_name' => 'loading_set_divider',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Init event', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'param_name'       => 'init_type',
					'value'            => array(
						esc_html__( 'On page load', 'omniverse' ) => 'page_load',
						esc_html__( 'On scroll', 'omniverse' ) => 'scroll',
						esc_html__( 'On button click', 'omniverse' ) => 'button',
						esc_html__( 'On user interaction', 'omniverse' ) => 'interaction',
					),
					'hint'             => esc_html__( 'For a better performance you can initialize the Open street map only when you scroll down the page or when you click on it.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'omniverse_slider',
					'heading'          => esc_html__( 'Scroll offset', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'param_name'       => 'init_offset',
					'min'              => '0',
					'max'              => '1000',
					'step'             => '10',
					'default'          => '100',
					'units'            => 'px',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'hint'             => esc_html__( 'Default: 100', 'omniverse' ),
					'dependency'       => array(
						'element' => 'init_type',
						'value'   => array( 'scroll' ),
					),
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Placeholders', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'param_name'       => 'map_init_placeholder',
					'value'            => '',
					'hint'             => esc_html__( "Select image from media library.", 'omniverse' ), // phpcs:ignore.
					'dependency'       => array(
						'element' => 'init_type',
						'value'   => array( 'scroll', 'button', 'interaction' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Placeholder size', 'omniverse' ),
					'group'            => esc_html__( 'Content', 'omniverse' ),
					'param_name'       => 'map_init_placeholder_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'init_type',
						'value'   => array( 'scroll', 'button', 'interaction' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
				),
				/**
				 * Design Options.
				 */
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

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container.
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_omniverse_open_street_map extends WPBakeryShortCodesContainer { // phpcs:ignore.

	}
}
