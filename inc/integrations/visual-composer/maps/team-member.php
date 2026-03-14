<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}
/**
* ------------------------------------------------------------------------------------------------
* Team Member element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_team_member' ) ) {
	/**
	 * Team member element map.
	 *
	 * @return array
	 */
	function omniverse_get_vc_map_team_member() {
		$name_typography = omniverse_get_typography_map(
			array(
				'title'    => esc_html__( 'Name typography', 'omniverse' ),
				'key'      => 'name_typography',
				'selector' => '{{WRAPPER}}.team-member .member-name',
			)
		);

		$position_typography = omniverse_get_typography_map(
			array(
				'title'    => esc_html__( 'Position typography', 'omniverse' ),
				'key'      => 'position_typography',
				'selector' => '{{WRAPPER}}.team-member .member-position',
			)
		);

		return array(
			'name'        => esc_html__( 'Team Member', 'omniverse' ),
			'base'        => 'team_member',
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Display information about some person', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/team-member.svg',
			'params'      => array(
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
					'title'      => esc_html__( 'Image', 'omniverse' ),
					'param_name' => 'image_divider',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'User Avatar', 'omniverse' ),
					'param_name'       => 'image',
					'value'            => '',
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'param_name'       => 'img_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Content
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Content', 'omniverse' ),
					'param_name' => 'content_divider',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Name', 'omniverse' ),
					'param_name'       => 'name',
					'value'            => '',
					'hint'             => esc_html__( 'Enter the person’s name.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				$name_typography['font_family'],
				$name_typography['font_size'],
				$name_typography['font_weight'],
				$name_typography['text_transform'],
				$name_typography['font_style'],
				$name_typography['line_height'],
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Position', 'omniverse' ),
					'param_name'       => 'position',
					'value'            => '',
					'hint'             => esc_html__( 'Enter the person’s title or job position. For example: CEO or Senior Developer.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				$position_typography['font_family'],
				$position_typography['font_size'],
				$position_typography['font_weight'],
				$position_typography['text_transform'],
				$position_typography['font_style'],
				$position_typography['line_height'],
				array(
					'type'       => 'textarea_html',
					'heading'    => esc_html__( 'Text', 'omniverse' ),
					'param_name' => 'content',
					'hint'       => esc_html__( 'You can add some member bio here.', 'omniverse' ),
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
					'param_name'       => 'layout',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'With hover', 'omniverse' ) => 'hover',
					),
					'hint'             => esc_html__( 'You can use different design for your team member styled for the theme', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Align', 'omniverse' ),
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
					'std'              => 'left',
					'wood_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				/**
				 * Social links
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Social links', 'omniverse' ),
					'param_name' => 'links_divider',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Facebook link', 'omniverse' ),
					'param_name'       => 'facebook',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'X link', 'omniverse' ),
					'param_name'       => 'twitter',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Linkedin link', 'omniverse' ),
					'param_name'       => 'linkedin',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Skype link', 'omniverse' ),
					'param_name'       => 'skype',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Instagram link', 'omniverse' ),
					'param_name'       => 'instagram',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Buttons
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Buttons', 'omniverse' ),
					'param_name' => 'buttons_divider',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Social buttons size', 'omniverse' ),
					'param_name'       => 'size',
					'value'            => array(
						esc_html__( 'Default (18px)', 'omniverse' ) => '',
						esc_html__( 'Small (14px)', 'omniverse' ) => 'small',
						esc_html__( 'Large (22px)', 'omniverse' ) => 'large',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Social button style', 'omniverse' ),
					'param_name'       => 'style',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => '',
						esc_html__( 'Simple', 'omniverse' ) => 'simple',
						esc_html__( 'Colored', 'omniverse' ) => 'colored',
						esc_html__( 'Colored alternative', 'omniverse' ) => 'colored-alt',
						esc_html__( 'Bordered', 'omniverse' ) => 'bordered',
						esc_html__( 'Primary color', 'omniverse' ) => 'primary',
					),
					'images_value'     => array(
						''            => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/style/default.png',
						'simple'      => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/style/simple.png',
						'colored'     => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/style/colored.png',
						'colored-alt' => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/style/colored-alt.png',
						'bordered'    => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/style/bordered.png',
						'primary'     => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/style/primary.png',
					),
					'wood_tooltip'     => true,
					'std'              => 'default',
					'edit_field_class' => 'vc_col-xs-12 vc_column social-style',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Social button form', 'omniverse' ),
					'param_name'       => 'form',
					'value'            => array(
						esc_html__( 'Circle', 'omniverse' ) => 'circle',
						esc_html__( 'Square', 'omniverse' ) => 'square',
						esc_html__( 'Rounded', 'omniverse' ) => 'rounded',
					),
					'images_value'     => array(
						'circle' => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/shape/circle.png',
						'square' => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/shape/square.png',
						'rounded' => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/shape/rounded.png',
					),
					'wood_tooltip'     => true,
					'std'              => 'default',
					'edit_field_class' => 'vc_col-xs-12 vc_column social-form',
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
				( function_exists( 'vc_map_add_css_animation' ) ) ? vc_map_add_css_animation( true ) : '',
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
				/**
				 * Design options
				 */
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				omniverse_get_vc_responsive_spacing_map(),
				/**
				 * Advanced
				 */

				// Width option (with dependency Columns option, responsive).
				omniverse_get_responsive_dependency_width_map( 'responsive_tabs' ),
				omniverse_get_responsive_dependency_width_map( 'width_desktop' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_desktop' ),
				omniverse_get_responsive_dependency_width_map( 'width_tablet' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_tablet' ),
				omniverse_get_responsive_dependency_width_map( 'width_mobile' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_mobile' ),
			),
		);
	}
}
