<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}
/**
* ------------------------------------------------------------------------------------------------
*  Button element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_omniverse_button_shortcode_args' ) ) {
	function omniverse_get_omniverse_button_shortcode_args() {
		return array(
			'name'        => esc_html__( 'Button', 'omniverse' ),
			'base'        => 'omniverse_button',
			'category'    => function_exists( 'omniverse_get_tab_title_category_for_wpb' ) ? omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ) : esc_html__( 'Theme elements', 'omniverse' ),
			'description' => esc_html__( 'Simple button in different theme styles', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/button.svg',
			'params'      => omniverse_get_button_shortcode_params(),
		);
	}
}

if ( ! function_exists( 'omniverse_get_button_shortcode_params' ) ) {
	function omniverse_get_button_shortcode_params() {
		$typography = omniverse_get_typography_map(
			array(
				'key'      => 'typography',
				'group'    => esc_html__( 'Style', 'omniverse' ),
				'selector' => '{{WRAPPER}} .btn',
			)
		);

		return apply_filters(
			'omniverse_get_button_shortcode_params',
			array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				/**
				* Button
				*/
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'button_divider',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Title', 'omniverse' ),
					'param_name'       => 'title',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'vc_link',
					'heading'          => esc_html__( 'Link', 'omniverse' ),
					'param_name'       => 'link',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Smooth scroll
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Smooth scroll', 'omniverse' ),
					'param_name' => 'smooth_divider',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Smooth scroll', 'omniverse' ),
					'hint'             => esc_html__( 'When you turn on this option you need to specify this button link with a hash symbol. For example #section-id Then you need to have a section with an ID of "section-id" and this button click will smoothly scroll the page to that section.', 'omniverse' ),
					'param_name'       => 'button_smooth_scroll',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Smooth scroll time (ms)', 'omniverse' ),
					'param_name'       => 'button_smooth_scroll_time',
					'dependency'       => array(
						'element'            => 'button_smooth_scroll',
						'value_not_equal_to' => array( 'no' ),
					),
					'std'              => '100',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Smooth scroll offset (px)', 'omniverse' ),
					'param_name'       => 'button_smooth_scroll_offset',
					'dependency'       => array(
						'element'            => 'button_smooth_scroll',
						'value_not_equal_to' => array( 'no' ),
					),
					'std'              => '100',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Collapsible content.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Collapsible content', 'omniverse' ),
					'param_name' => 'collapsible_content_divider',
				),
				array(
					'type'             => 'omniverse_switch',
					'param_name'       => 'wd_button_collapsible_content',
					'hint'             => esc_html__( 'Limit the column height and add the "Read more" button. IMPORTANT: you need to add our "Button" element to the end of this column and enable an appropriate option there as well.', 'omniverse' ),
					'heading'          => esc_html__( 'Enable collapsible content', 'omniverse' ),
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				* Extra
				*/
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_divider',
				),
				( function_exists( 'vc_map_add_css_animation' ) ) ? vc_map_add_css_animation( true ) : '',

				function_exists( 'omniverse_get_vc_animation_map' ) ? omniverse_get_vc_animation_map( 'wd_animation' ) : '',
				function_exists( 'omniverse_get_vc_animation_map' ) ? omniverse_get_vc_animation_map( 'wd_animation_delay' ) : '',
				function_exists( 'omniverse_get_vc_animation_map' ) ? omniverse_get_vc_animation_map( 'wd_animation_duration' ) : '',

				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),

				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'General', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'general_divider',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Button style', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'style',
					'value'            => array(
						esc_html__( 'Flat', 'omniverse' ) => 'default',
						esc_html__( 'Bordered', 'omniverse' ) => 'bordered',
						esc_html__( 'Link button', 'omniverse' ) => 'link',
						esc_html__( '3D', 'omniverse' )   => '3d',
					),
					'images_value'     => array(
						'default'  => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/default.png',
						'bordered' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/bordered.png',
						'link'     => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/link.png',
						'3d'       => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/3d.png',
					),
					'title'            => false,
					'std'              => 'default',
					'edit_field_class' => 'vc_col-xs-12 vc_column button-style',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Button shape', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'shape',
					'value'            => array(
						esc_html__( 'Rectangle', 'omniverse' ) => 'rectangle',
						esc_html__( 'Circle', 'omniverse' ) => 'round',
						esc_html__( 'Round', 'omniverse' )  => 'semi-round',
					),
					'images_value'     => array(
						'rectangle'  => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/shape/rectangle.jpeg',
						'round'      => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/shape/circle.jpeg',
						'semi-round' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/shape/round.jpeg',
					),
					'dependency'       => array(
						'element'            => 'style',
						'value_not_equal_to' => array( 'round', 'link' ),
					),
					'title'            => false,
					'std'              => 'rectangle',
					'edit_field_class' => 'vc_col-xs-12 vc_column button-shape',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Button size', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'size',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Extra Small', 'omniverse' ) => 'extra-small',
						esc_html__( 'Small', 'omniverse' ) => 'small',
						esc_html__( 'Large', 'omniverse' ) => 'large',
						esc_html__( 'Extra Large', 'omniverse' ) => 'extra-large',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_dropdown',
					'heading'          => esc_html__( 'Predefined button color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'color',
					'value'            => array(
						esc_html__( 'Grey', 'omniverse' )  => 'default',
						esc_html__( 'Primary color', 'omniverse' ) => 'primary',
						esc_html__( 'Alternative color', 'omniverse' ) => 'alt',
						esc_html__( 'White', 'omniverse' ) => 'white',
						esc_html__( 'Black', 'omniverse' ) => 'black',
					),
					'style'            => array(
						'default' => '#f3f3f3',
						'primary' => omniverse_get_color_value( 'primary-color', '#7eb934' ),
						'alt'     => omniverse_get_color_value( 'secondary-color', '#fbbc34' ),
						'black'   => '#212121',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Idle background color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'bg_color',
					'css_args'         => array(
						'background-color' => array(
							' a',
						),
						'border-color'     => array(
							' a',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Idle text color scheme', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'color_scheme',
					'value'            => array(
						esc_html__( 'Light', 'omniverse' )  => 'light',
						esc_html__( 'Dark', 'omniverse' )   => 'dark',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'    => esc_html__( 'Custom text color', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'wd_colorpicker',
					'param_name' => 'custom_color_scheme',
					'selectors'  => array(
						'{{WRAPPER}}.wd-button-wrapper a' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency' => array(
						'element' => 'color_scheme',
						'value'   => 'custom',
					),
				),

				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Background color on hover', 'omniverse' ),
					'param_name'       => 'bg_color_hover',
					'css_args'         => array(
						'background-color' => array(
							' a:hover',
						),
						'border-color'     => array(
							' a:hover',
						),
					),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Text color scheme on hover', 'omniverse' ),
					'param_name'       => 'color_scheme_hover',
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Light', 'omniverse' )  => 'light',
						esc_html__( 'Dark', 'omniverse' )   => 'dark',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'    => esc_html__( 'Custom text color on hover', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'wd_colorpicker',
					'param_name' => 'custom_color_scheme_hover',
					'selectors'  => array(
						'{{WRAPPER}}.wd-button-wrapper a:hover' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency' => array(
						'element' => 'color_scheme_hover',
						'value'   => 'custom',
					),
				),

				$typography['font_family'],
				$typography['font_size'],
				$typography['font_weight'],
				$typography['text_transform'],
				$typography['font_style'],
				$typography['line_height'],

				/**
				 * Layout.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Layout', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'layout_divider',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Align', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'align',
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
					'dependency'       => array(
						'element'            => 'button_inline',
						'value_not_equal_to' => array( 'yes' ),
					),
					'std'              => 'center',
					'omni_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),

				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Full width', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'full_width',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'        => 'omniverse_switch',
					'heading'     => esc_html__( 'Button inline', 'omniverse' ),
					'group'       => esc_html__( 'Style', 'omniverse' ),
					'param_name'  => 'button_inline',
					'true_state'  => 'yes',
					'false_state' => 'no',
					'default'     => 'no',
				),

				/**
				 * Icon
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'icon_divider',
				),
				array(
					'type'       => 'omniverse_button_set',
					'heading'    => esc_html__( 'Type', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'icon_type',
					'value'      => array(
						esc_html__( 'Icon', 'omniverse' )  => 'icon',
						esc_html__( 'Image', 'omniverse' ) => 'image',
					),
					'default'    => 'icon',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Image', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'image',
					'value'            => '',
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => 'image',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'img_size',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => 'image',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon library', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'value'      => array(
						esc_html__( 'Font Awesome', 'omniverse' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'omniverse' ) => 'openiconic',
						esc_html__( 'Typicons', 'omniverse' ) => 'typicons',
						esc_html__( 'Entypo', 'omniverse' ) => 'entypo',
						esc_html__( 'Linecons', 'omniverse' ) => 'linecons',
						esc_html__( 'Mono Social', 'omniverse' ) => 'monosocial',
						esc_html__( 'Material', 'omniverse' ) => 'material',
					),
					'param_name' => 'icon_library',
					'hint'       => esc_html__( 'Select icon library.', 'omniverse' ),
					'dependency' => array(
						'element' => 'icon_type',
						'value'   => 'icon',
					),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'icon_fontawesome',
					'value'      => '',
					'settings'   => array(
						'emptyIcon'    => true,
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'fontawesome' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'icon_openiconic',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'openiconic',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'openiconic' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'icon_typicons',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'typicons',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'typicons' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'icon_entypo',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'entypo',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'entypo' ),
					),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'icon_linecons',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'linecons',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'linecons' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'icon_monosocial',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'monosocial',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'monosocial' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'icon_material',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'material',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'material' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Button icon position', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'icon_position',
					'value'            => array(
						esc_html__( 'Left', 'omniverse' )  => 'left',
						esc_html__( 'Right', 'omniverse' ) => 'right',
					),
					'std'              => 'right',
					'edit_field_class' => 'vc_col-xs-12 vc_column button-style',
				),

				// Design Options tab.
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				function_exists( 'omniverse_get_vc_responsive_spacing_map' ) ? omniverse_get_vc_responsive_spacing_map() : '',

				/**
				 * Advanced Tab.
				 */
				omniverse_get_vc_responsive_visible_map( 'responsive_tabs_hide' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_desktop' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_tablet' ),
				omniverse_get_vc_responsive_visible_map( 'wd_hide_on_mobile' ),
			)
		);
	}
}
