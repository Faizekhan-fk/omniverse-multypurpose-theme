<?php
/**
 * Video map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}


if ( ! function_exists( 'omniverse_get_vc_map_video' ) ) {
	function omniverse_get_vc_map_video() {
		$btn_typography = omniverse_get_typography_map(
			array(
				'key'        => 'button_typography',
				'group'      => esc_html__( 'Style', 'omniverse' ),
				'selector'   => '{{WRAPPER}} .btn',
				'dependency' => array(
					'element' => 'video_action_button',
					'value'   => array( 'action_button' ),
				),
			)
		);

		$label_typography = omniverse_get_typography_map(
			array(
				'title'      => esc_html__( 'Label typography', 'omniverse' ),
				'key'        => 'play_button_label_typography',
				'group'      => esc_html__( 'Style', 'omniverse' ),
				'selector'   => '{{WRAPPER}}.wd-el-video .wd-el-video-play-label',
				'dependency' => array(
					'element' => 'video_action_button',
					'value'   => array( 'play', 'overlay' ),
				),
			)
		);

		return array(
			'name'        => esc_html__( 'Video', 'omniverse' ),
			'base'        => 'omniverse_video',
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Embed/Self-hosted video player', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/video.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'General', 'omniverse' ),
					'param_name' => 'general_divider',
				),
				array(
					'heading'          => esc_html__( 'Source', 'omniverse' ),
					'param_name'       => 'video_type',
					'type'             => 'dropdown',
					'value'            => array(
						esc_html__( 'Self hosted', 'omniverse' ) => 'hosted',
						esc_html__( 'YouTube', 'omniverse' ) => 'youtube',
						esc_html__( 'Vimeo', 'omniverse' ) => 'vimeo',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Video', 'omniverse' ),
					'type'             => 'wd_upload',
					'param_name'       => 'video_hosted',
					'attachment_type'  => 'video',
					'value'            => '',
					'hint'             => esc_html__( 'Select video from media library.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'video_type',
						'value'   => array( 'hosted' ),
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Link', 'omniverse' ),
					'type'             => 'textfield',
					'param_name'       => 'video_youtube_url',
					'value'            => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
					'dependency'       => array(
						'element' => 'video_type',
						'value'   => array( 'youtube' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Link', 'omniverse' ),
					'param_name'       => 'video_vimeo_url',
					'value'            => 'https://vimeo.com/235215203',
					'dependency'       => array(
						'element' => 'video_type',
						'value'   => array( 'vimeo' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'    => esc_html__( 'Action button', 'omniverse' ),
					'param_name' => 'video_action_button',
					'type'       => 'dropdown',
					'value'      => array(
						esc_html__( 'Without', 'omniverse' ) => 'without',
						esc_html__( 'Play button on image', 'omniverse' ) => 'overlay',
						esc_html__( 'Play button', 'omniverse' ) => 'play',
						esc_html__( 'Button', 'omniverse' ) => 'action_button',
					),
				),
				array(
					'heading'          => esc_html__( 'Lightbox', 'omniverse' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'video_overlay_lightbox',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'overlay' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Label', 'omniverse' ),
					'param_name'       => 'play_button_label',
					'type'             => 'textfield',
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'overlay', 'play' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Video options', 'omniverse' ),
					'param_name' => 'video_options_divider',
					'dependency' => array(
						'element' => 'video_action_button',
						'value'   => array( 'without' ),
					),
				),
				array(
					'heading'          => esc_html__( 'Autoplay', 'omniverse' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'video_autoplay',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'without' ),
					),
				),
				array(
					'heading'          => esc_html__( 'Mute', 'omniverse' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'video_mute',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'without' ),
					),
				),
				array(
					'heading'          => esc_html__( 'Loop', 'omniverse' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'video_loop',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'without' ),
					),
				),
				array(
					'heading'          => esc_html__( 'Controls', 'omniverse' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'video_controls',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'yes',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'without' ),
					),
				),
				array(
					'heading'          => esc_html__( 'Preload', 'omniverse' ),
					'description'      => esc_html__( 'Preload attribute lets you specify how the video should be loaded when the page loads. ', 'omniverse' ),
					'param_name'       => 'video_preload',
					'type'             => 'dropdown',
					'value'            => array(
						esc_html__( 'Metadata', 'omniverse' ) => 'metadata',
						esc_html__( 'Auto', 'omniverse' ) => 'auto',
						esc_html__( 'None', 'omniverse' ) => 'none',
					),
					'std'              => 'metadata',
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'without' ),
					),
					'wd_dependency'    => array(
						'element' => 'video_type',
						'value'   => array( 'hosted' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Poster', 'omniverse' ),
					'type'             => 'attach_image',
					'param_name'       => 'video_poster',
					'value'            => '',
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'without' ),
					),
					'wd_dependency'    => array(
						'element' => 'video_type',
						'value'   => array( 'hosted' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Image overlay', 'omniverse' ),
					'param_name' => 'image_overlay_divider',
					'dependency' => array(
						'element' => 'video_action_button',
						'value'   => array( 'overlay' ),
					),
				),
				array(
					'heading'          => esc_html__( 'Image', 'omniverse' ),
					'param_name'       => 'video_image_overlay',
					'type'             => 'attach_image',
					'value'            => '',
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'overlay' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'video_image_overlay_size',
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'overlay' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'button_divider',
					'dependency' => array(
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
					),
				),
				array(
					'heading'          => esc_html__( 'Text', 'omniverse' ),
					'param_name'       => 'button_text',
					'type'             => 'textfield',
					'value'            => 'Play video',
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'General', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'general_style_divider',
					'dependency' => array(
						'element'            => 'video_action_button',
						'value_not_equal_to' => array( 'action_button', 'play' ),
					),
				),
				array(
					'heading'    => esc_html__( 'Size', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'video_size',
					'type'       => 'dropdown',
					'value'      => array(
						esc_html__( 'Aspect ratio', 'omniverse' ) => 'aspect_ratio',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'std'        => 'custom',
					'dependency' => array(
						'element'            => 'video_action_button',
						'value_not_equal_to' => array( 'action_button', 'play' ),
					),
				),
				array(
					'heading'    => esc_html__( 'Height', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'wd_slider',
					'param_name' => 'video_height',
					'selectors'  => array(
						'{{WRAPPER}}.wd-el-video' => array(
							'height: {{VALUE}}px !important;'
						),
					),
					'devices'    => array(
						'desktop' => array(
							'value' => 400,
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
							'min'  => 100,
							'max'  => 2000,
							'step' => 1,
						),
					),
					'dependency' => array(
						'element' => 'video_size',
						'value'   => 'custom',
					),
				),
				array(
					'heading'    => esc_html__( 'Aspect Ratio', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'video_aspect_ratio',
					'type'       => 'wd_select',
					'style'      => 'select',
					'selectors'  => array(
						'{{WRAPPER}}.wd-el-video' => array(
							'--wd-aspect-ratio: {{VALUE}};',
						),
					),
					'devices'    => array(
						'desktop' => array(
							'value' => '16/9',
						),
					),
					'value'      => array(
						'16:9'  => '16/9',
						'16:10' => '16/10',
						'21:9'  => '21/9',
						'4:3'   => '4/3',
						'3:2'   => '3/2',
						'1:1'   => '1/1',
						'9:16'  => '9/16',
					),
					'dependency' => array(
						'element' => 'video_size',
						'value'   => array( 'aspect_ratio' ),
					),
				),

				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Button style', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'button_style_divider',
					'dependency' => array(
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
					),
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
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
					),
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
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
					),
					'wd_dependency'    => array(
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
					'std'              => 'default',
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_dropdown',
					'heading'          => esc_html__( 'Predefined button color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'color',
					'value'            => array(
						esc_html__( 'Grey', 'omniverse' )   => 'default',
						esc_html__( 'Primary color', 'omniverse' ) => 'primary',
						esc_html__( 'Alternative color', 'omniverse' ) => 'alt',
						esc_html__( 'White', 'omniverse' )  => 'white',
						esc_html__( 'Black', 'omniverse' )  => 'black',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'style'            => array(
						'default' => '#f3f3f3',
						'primary' => omniverse_get_color_value( 'primary-color', '#7eb934' ),
						'alt'     => omniverse_get_color_value( 'secondary-color', '#fbbc34' ),
						'black'   => '#212121',
					),
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Idle background color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'bg_color',
					'selectors'        => array(
						'{{WRAPPER}}.wd-button-wrapper a' => array(
							'background-color :{{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'color',
						'value'   => array( 'custom' ),
					),
					'wd_dependency'    => array(
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Background color on hover', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'bg_color_hover',
					'selectors'        => array(
						'{{WRAPPER}}.wd-button-wrapper a:hover' => array(
							'background-color :{{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'color',
						'value'   => array( 'custom' ),
					),
					'wd_dependency'    => array(
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
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
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Custom text color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'custom_color_scheme',
					'selectors'        => array(
						'{{WRAPPER}}.wd-button-wrapper a' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'color_scheme',
						'value'   => 'custom',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'omniverse_empty_space',
					'param_name' => 'omniverse_empty_space',
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'dependency' => array(
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
					),
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
					'heading'          => esc_html__( 'Custom text color on hover', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'custom_color_scheme_hover',
					'selectors'        => array(
						'{{WRAPPER}}.wd-button-wrapper a:hover' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'color_scheme_hover',
						'value'   => 'custom',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'omniverse_empty_space',
					'param_name' => 'omniverse_empty_space',
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'dependency' => array(
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
					),
				),

				$btn_typography['font_family'],
				$btn_typography['font_size'],
				$btn_typography['font_weight'],
				$btn_typography['text_transform'],
				$btn_typography['font_style'],
				$btn_typography['line_height'],

				/**
				 * Layout.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Button layout', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'button_layout_divider',
					'dependency' => array(
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
					),
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
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
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
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
					),
				),

				/**
				 * Icon
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Button icon', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'button_icon_divider',
					'dependency' => array(
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
					),
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
					'dependency' => array(
						'element' => 'video_action_button',
						'value'   => array( 'action_button' ),
					),
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

				/**
				 * Play button settings
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Play button', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'play_button_divider',
					'dependency' => array(
						'element'            => 'video_action_button',
						'value_not_equal_to' => array( 'action_button', 'without' ),
					),
				),

				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Alignment', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'play_button_align',
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
						'element' => 'video_action_button',
						'value'   => array( 'play' ),
					),
					'std'              => 'center',
					'omni_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'type'       => 'omniverse_empty_space',
					'param_name' => 'omniverse_empty_space',
					'dependency' => array(
						'element' => 'video_action_button',
						'value'   => array( 'play' ),
					),
				),

				array(
					'heading'          => esc_html__( 'Label color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'play_button_label_color',
					'selectors'        => array(
						'{{WRAPPER}}.wd-el-video .wd-el-video-play-label' => array(
							'color :{{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'play', 'overlay' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				$label_typography['font_family'],
				$label_typography['font_size'],
				$label_typography['font_weight'],
				$label_typography['text_transform'],
				$label_typography['font_style'],
				$label_typography['line_height'],

				array(
					'heading'    => esc_html__( 'Icon size', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'wd_slider',
					'param_name' => 'play_button_icon_size',
					'selectors'  => array(
						'{{WRAPPER}} .wd-el-video-play-btn' => array(
							'font-size: {{VALUE}}px;',
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
							'min'  => 40,
							'max'  => 150,
							'step' => 1,
						),
					),
					'dependency' => array(
						'element' => 'video_action_button',
						'value'   => array( 'play', 'overlay' ),
					),
				),

				array(
					'heading'          => esc_html__( 'Icon color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'play_button_icon_idle_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-el-video-play-btn' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'play', 'overlay' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Icon color hover', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'play_button_icon_hover_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-el-video-btn:hover .wd-el-video-play-btn, {{WRAPPER}}.wd-action-overlay:hover .wd-el-video-play-btn' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'video_action_button',
						'value'   => array( 'play', 'overlay' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				// Design options.
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
			),
		);
	}
}
