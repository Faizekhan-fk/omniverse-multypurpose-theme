<?php

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}
/**
* ------------------------------------------------------------------------------------------------
*  Google map element map
* ------------------------------------------------------------------------------------------------
*/

if( ! function_exists( 'omniverse_get_vc_map_google_map' ) ) {
	/**
	 * Displays the shortcode settings fields in the admin.
	 */
	function omniverse_get_vc_map_google_map() {
		return array(
			'name'            => esc_html__( 'Google map', 'omniverse' ),
			'description'     => esc_html__( 'Shows Google map block', 'omniverse' ),
			'base'            => 'omniverse_google_map',
			'category'        => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'as_parent'       => array( 'except' => 'testimonial' ),
			'content_element' => true,
			'js_view'         => 'VcColumnView',
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/google-maps.svg',
			'params'          => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				/**
				 * Settings.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Settings', 'omniverse' ),
					'param_name' => 'settings_divider',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Google API key', 'omniverse' ),
					'param_name' => 'google_key',
					'hint'       => wp_kses(
						__( 'Obtain API key <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">here</a> to use our Google map VC element. By default, the key will be taken from Theme Settings.', 'omniverse' ),
						array(
							'a' => array(
								'href'   => array(),
								'target' => array(),
							),
						)
					),
				),
				array(
					'type'        => 'omniverse_switch',
					'heading'     => esc_html__( 'Multiple markers', 'omniverse' ),
					'param_name'  => 'multiple_markers',
					'true_state'  => 'yes',
					'false_state' => 'no',
					'default'     => 'no',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Latitude (required)', 'omniverse' ),
					'param_name'       => 'lat',
					'hint'             => wp_kses(
						__( 'You can use <a href="https://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">this service</a> to get coordinates of your location.', 'omniverse' ),
						array(
							'a' => array(
								'href'   => array(),
								'target' => array(),
							),
						)
					),
					'dependency'       => array(
						'element' => 'multiple_markers',
						'value'   => array( 'no' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Longitude (required)', 'omniverse' ),
					'param_name'       => 'lon',
					'dependency'       => array(
						'element' => 'multiple_markers',
						'value'   => array( 'no' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'param_group',
					'param_name' => 'marker_list',
					'heading'    => esc_html__( 'Marker list', 'omniverse' ),
					'dependency' => array(
						'element' => 'multiple_markers',
						'value'   => array( 'yes' ),
					),
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
							'param_name'       => 'marker_lat',
							'type'             => 'textfield',
							'hint'             => wp_kses(
								__( 'You can use <a href="https://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">this service</a> to get coordinates of your location.', 'omniverse' ),
								array(
									'a' => array(
										'href'   => array(),
										'target' => array(),
									),
								)
							),
							'admin_label'      => true,
							'heading'          => esc_html__( 'Latitude (required)', 'omniverse' ),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'param_name'       => 'marker_lon',
							'type'             => 'textfield',
							'admin_label'      => true,
							'heading'          => esc_html__( 'Longitude (required)', 'omniverse' ),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'param_name'  => 'marker_description',
							'type'        => 'textarea',
							'admin_label' => true,
							'heading'     => esc_html__( 'Description', 'omniverse' ),
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
							'value'       => '',
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
					'param_name' => 'marker_divider',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Marker icon', 'omniverse' ),
					'param_name'       => 'marker_icon',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image size', 'omniverse' ),
					'param_name'  => 'marker_icon_size',
					'description' => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'value'       => '',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Title', 'omniverse' ),
					'param_name'       => 'title',
					'dependency'       => array(
						'element' => 'multiple_markers',
						'value'   => array( 'no' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textarea',
					'heading'          => esc_html__( 'Text on marker', 'omniverse' ),
					'param_name'       => 'marker_text',
					'dependency'       => array(
						'element' => 'multiple_markers',
						'value'   => array( 'no' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Map settings.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Map settings', 'omniverse' ),
					'param_name' => 'map_set_divider',
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
					'type'             => 'omniverse_slider',
					'heading'          => esc_html__( 'Zoom', 'omniverse' ),
					'param_name'       => 'zoom',
					'min'              => '0',
					'max'              => '19',
					'step'             => '1',
					'default'          => '15',
					'units'            => '',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'hint'             => esc_html__( 'Zoom level when focus the marker 0 - 19', 'omniverse' ),
				),
				array(
					'type'             => 'wd_slider',
					'heading'          => esc_html__( 'Map Height', 'omniverse' ),
					'param_name'       => 'new_height',
					'selectors'        => array(
						'{{WRAPPER}}' => array(
							'height: {{VALUE}}{{UNIT}};',
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
							'min'  => 100,
							'max'  => 2000,
							'step' => 10,
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'transfer'         => 'height',
				),
				array(
					'type'             => 'omniverse_slider',
					'heading'          => esc_html__( 'Map height', 'omniverse' ),
					'param_name'       => 'height',
					'min'              => '100',
					'max'              => '2000',
					'step'             => '10',
					'default'          => '400',
					'units'            => 'px',
					'edit_field_class' => 'vc_col-sm-6 vc_column dn-hidden',
					'hint'             => esc_html__( 'Default: 400', 'omniverse' ),
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Zoom with mouse wheel', 'omniverse' ),
					'param_name'       => 'scroll',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'        => 'textarea_raw_html',
					'heading'     => esc_html__( 'Styles (JSON)', 'omniverse' ),
					'param_name'  => 'style_json',
					'description' => sprintf(
						__( 'Styled maps allow you to customize the presentation of the standard Google base maps, changing the visual display of such elements as roads, parks, and built-up areas. %3$s You can find more Google maps styles on the website: %1$s Snazzy Maps %2$s %3$s Just copy JSON code and paste it here %3$s For example: %3$s %4$s', 'omniverse' ),
						'<a target="_blank" href="https://snazzymaps.com/">',
						'</a>',
						'<br>',
						'[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]'
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
					'wood_tooltip'     => true,
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
					'wood_tooltip'     => true,
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
					'hint'             => esc_html__( 'For a better performance you can initialize the Google map only when you scroll down the page or when you click on it.', 'omniverse' ),
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
	class WPBakeryShortCode_omniverse_google_map extends WPBakeryShortCodesContainer { // phpcs:ignore.

	}
}
