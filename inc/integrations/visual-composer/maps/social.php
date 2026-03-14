<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
* Social buttons element map
* ------------------------------------------------------------------------------------------------
*/

if( ! function_exists( 'omniverse_get_social_buttons_shortcode_args' ) ) {
	function omniverse_get_social_buttons_shortcode_args() {
		return array(
			'name' => esc_html__( 'Social buttons', 'omniverse' ),
			'base' => 'social_buttons',
			'category' => function_exists( 'omniverse_get_tab_title_category_for_wpb' ) ? omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ) : esc_html__( 'Theme elements', 'omniverse' ),
			'description' => esc_html__( 'Follow or share buttons', 'omniverse' ),
        	'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/social-buttons.svg',
			'params' => omniverse_get_social_shortcode_params()
		);
	}
}

if( ! function_exists( 'omniverse_get_social_shortcode_params' ) ) {
	function omniverse_get_social_shortcode_params() {
		$typography = array();

		if ( function_exists( 'omniverse_get_typography_map' ) ) {
			$typography = omniverse_get_typography_map(
				array(
					'key'        => 'label',
					'selector'   => '{{WRAPPER}}.wd-social-icons .wd-label',
					'dependency' => array(
						'element' => 'show_label',
						'value'   => 'yes',
					),
					'group'      => esc_html__( 'Style', 'js_composer' ),
				)
			);
		}

		return apply_filters( 'omniverse_get_social_shortcode_params', array(
			/**
			* Type
			*/
			array(
				'type' => 'omniverse_title_divider',
				'holder' => 'div',
				'title' => esc_html__( 'General', 'omniverse' ),
				'param_name' => 'type_divider'
			),

			array(
				'type'       => 'omniverse_css_id',
				'param_name' => 'omniverse_css_id',
			),

			array(
				'heading'          => esc_html__( 'Label', 'omniverse' ),
				'type'             => 'omniverse_switch',
				'param_name'       => 'show_label',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),

			array(
				'heading'          => esc_html__( 'Label text', 'omniverse' ),
				'type'             => 'textfield',
				'param_name'       => 'label_text',
				'value'            => esc_html__( 'Share: ', 'omniverse' ),
				'dependency'       => array(
					'element' => 'show_label',
					'value'   => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),

			array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Buttons type', 'omniverse' ),
				'param_name'       => 'type',
				'value'            => array(
					esc_html__( 'Share', 'omniverse' )  => 'share',
					esc_html__( 'Follow', 'omniverse' ) => 'follow',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),

			array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Social links source', 'omniverse' ),
				'param_name'       => 'social_links_source',
				'value'            => array(
					esc_html__( 'Theme Options', 'omniverse' ) => 'theme_settings',
					esc_html__( 'Custom', 'omniverse' ) => 'custom',
				),
				'dependency'       => array(
					'element' => 'type',
					'value'   => 'follow',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),

			/**
			 * Links to social profiles.
			 */
			array(
				'type'       => 'omniverse_title_divider',
				'holder'     => 'div',
				'title'      => esc_html__( 'Links to social profiles', 'omniverse' ),
				'param_name' => 'social_links_divider',
				'dependency' => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Facebook link', 'omniverse' ),
				'param_name'       => 'fb_link',
				'std'              => '#',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'X link', 'omniverse' ),
				'param_name'       => 'twitter_link',
				'std'              => '#',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Instagram link', 'omniverse' ),
				'param_name'       => 'isntagram_link',
				'std'              => '#',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Pinterest link', 'omniverse' ),
				'param_name'       => 'pinterest_link',
				'std'              => '#',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Youtube link', 'omniverse' ),
				'param_name'       => 'youtube_link',
				'std'              => '#',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Tumblr link', 'omniverse' ),
				'param_name'       => 'tumblr_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'LinkedIn link', 'omniverse' ),
				'param_name'       => 'linkedin_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Vimeo link', 'omniverse' ),
				'param_name'       => 'vimeo_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Flickr link', 'omniverse' ),
				'param_name'       => 'flickr_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Github link', 'omniverse' ),
				'param_name'       => 'github_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Dribbble link', 'omniverse' ),
				'param_name'       => 'dribbble_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Behance link', 'omniverse' ),
				'param_name'       => 'behance_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'SoundCloud link', 'omniverse' ),
				'param_name'       => 'soundcloud_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Spotify link', 'omniverse' ),
				'param_name'       => 'spotify_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'OK link', 'omniverse' ),
				'param_name'       => 'ok_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'VK link', 'omniverse' ),
				'param_name'       => 'vk_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'WhatsApp link', 'omniverse' ),
				'param_name'       => 'whatsapp_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Snapchat link', 'omniverse' ),
				'param_name'       => 'snapchat_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Telegram link', 'omniverse' ),
				'param_name'       => 'tg_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'TikTok link', 'omniverse' ),
				'param_name'       => 'tiktok_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Discord link', 'omniverse' ),
				'param_name'       => 'discord_link',
				'save_always'      => true,
				'dependency'       => array(
					'element' => 'social_links_source',
					'value'   => 'custom',
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
			( function_exists( 'vc_map_add_css_animation' ) ) ? vc_map_add_css_animation( true ) : '',
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra class name', 'omniverse' ),
				'param_name' => 'el_class',
				'hint' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' )
			),

			/**
			 * Style tab.
			 */
			// General.
			array(
				'type'       => 'omniverse_title_divider',
				'holder'     => 'div',
				'title'      => esc_html__( 'General', 'omniverse' ),
				'param_name' => 'style_general_divider',
				'group'      => esc_html__( 'Style', 'js_composer' ),
			),
			array(
				'heading'          => esc_html__( 'Layout', 'omniverse' ),
				'type'             => 'dropdown',
				'param_name'       => 'layout',
				'value'            => array(
					esc_html__( 'Default', 'omniverse' ) => 'default',
					esc_html__( 'Inline', 'omniverse' )  => 'inline',
					esc_html__( 'Justify', 'omniverse' ) => 'justify',
				),
				'dependency'       => array(
					'element' => 'show_label',
					'value'   => 'yes',
				),
				'group'            => esc_html__( 'Style', 'js_composer' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'omniverse_image_select',
				'heading'          => esc_html__( 'Align ', 'omniverse' ),
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
				'std'              => 'center',
				'wood_tooltip'     => true,
				'group'            => esc_html__( 'Style', 'js_composer' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
			),
			// Icons.
			array(
				'type'       => 'omniverse_title_divider',
				'holder'     => 'div',
				'title'      => esc_html__( 'Icons', 'omniverse' ),
				'param_name' => 'style_icons_divider',
				'group'      => esc_html__( 'Style', 'js_composer' ),
			),

			array(
				'type'             => 'omniverse_image_select',
				'heading'          => esc_html__( 'Button style', 'omniverse' ),
				'param_name'       => 'style',
				'value'            => array(
					esc_html__( 'Default', 'omniverse' )  => '',
					esc_html__( 'Simple', 'omniverse' )   => 'simple',
					esc_html__( 'Colored', 'omniverse' )  => 'colored',
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
				'std'              => '',
				'group'            => esc_html__( 'Style', 'js_composer' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column social-style',
			),
			array(
				'type'             => 'omniverse_image_select',
				'heading'          => esc_html__( 'Button form', 'omniverse' ),
				'param_name'       => 'form',
				'value'            => array(
					esc_html__( 'Circle', 'omniverse' )  => 'circle',
					esc_html__( 'Square', 'omniverse' )  => 'square',
					esc_html__( 'Rounded', 'omniverse' ) => 'rounded',
				),
				'images_value'     => array(
					'circle'  => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/shape/circle.png',
					'square'  => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/shape/square.png',
					'rounded' => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/shape/rounded.png',
				),
				'wood_tooltip'     => true,
				'std'              => 'circle',
				'group'            => esc_html__( 'Style', 'js_composer' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column social-form',
			),
			array(
				'type'             => 'dropdown',
				'heading'          => esc_html__( 'Buttons size', 'omniverse' ),
				'param_name'       => 'size',
				'value'            => array(
					esc_html__( 'Default (18px)', 'omniverse' ) => '',
					esc_html__( 'Small (14px)', 'omniverse' ) => 'small',
					esc_html__( 'Large (22px)', 'omniverse' ) => 'large',
				),
				'group'            => esc_html__( 'Style', 'js_composer' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Color', 'omniverse' ),
				'param_name'       => 'color',
				'value'            => array(
					esc_html__( 'Dark', 'omniverse' )  => 'dark',
					esc_html__( 'Light', 'omniverse' ) => 'light',
				),
				'group'            => esc_html__( 'Style', 'js_composer' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			// Label.
			array(
				'type'       => 'omniverse_title_divider',
				'holder'     => 'div',
				'title'      => esc_html__( 'Label', 'omniverse' ),
				'param_name' => 'style_label_divider',
				'dependency' => array(
					'element' => 'show_label',
					'value'   => 'yes',
				),
				'group'      => esc_html__( 'Style', 'js_composer' ),
			),
			function_exists( 'omniverse_get_typography_map' ) ? $typography['font_family'] : '',
			function_exists( 'omniverse_get_typography_map' ) ? $typography['font_size'] : '',
			function_exists( 'omniverse_get_typography_map' ) ? $typography['font_weight'] : '',
			function_exists( 'omniverse_get_typography_map' ) ? $typography['text_transform'] : '',
			function_exists( 'omniverse_get_typography_map' ) ? $typography['font_style'] : '',
			function_exists( 'omniverse_get_typography_map' ) ? $typography['line_height'] : '',
			array(
				'heading'          => esc_html__( 'Label color', 'omniverse' ),
				'type'             => 'wd_colorpicker',
				'param_name'       => 'label_color',
				'selectors'        => array(
					'{{WRAPPER}}.wd-social-icons .wd-label' => array(
						'color: {{VALUE}};',
					),
				),
				'dependency'       => array(
					'element' => 'show_label',
					'value'   => 'yes',
				),
				'group'            => esc_html__( 'Style', 'js_composer' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			/**
			 * Design Options tab.
			 */
			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'CSS box', 'omniverse' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Design Options', 'js_composer' ),
			),
			function_exists( 'omniverse_get_vc_responsive_spacing_map' ) ? omniverse_get_vc_responsive_spacing_map() : '',

			/**
			 * Advanced tab.
			 */

			// Width option (with dependency Columns option, responsive).
			omniverse_get_responsive_dependency_width_map( 'responsive_tabs' ),
			omniverse_get_responsive_dependency_width_map( 'width_desktop' ),
			omniverse_get_responsive_dependency_width_map( 'custom_width_desktop' ),
			omniverse_get_responsive_dependency_width_map( 'width_tablet' ),
			omniverse_get_responsive_dependency_width_map( 'custom_width_tablet' ),
			omniverse_get_responsive_dependency_width_map( 'width_mobile' ),
			omniverse_get_responsive_dependency_width_map( 'custom_width_mobile' ),
		) );
	}
}
