<?php
/**
 * Marquee map.
 *
 * @package Elements
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_get_vc_map_marquee' ) ) {
	/**
	 * Displays the shortcode settings fields in the admin.
	 */
	function omniverse_get_vc_map_marquee() {
		$marquee_typography = omniverse_get_typography_map(
			array(
				'title'    => esc_html__( 'Typography', 'omniverse' ),
				'key'      => 'marquee_typography',
				'selector' => '{{WRAPPER}} .wd-marquee',
			)
		);

		return array(
			'base'        => 'omniverse_marquee',
			'name'        => esc_html__( 'Marquee', 'omniverse' ),
			'description' => esc_html__( 'Text scrolling area', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/marquee.svg',
			'params'      => array(
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
					'param_name' => 'general_settings_divider',
				),

				array(
					'type'             => 'wd_number',
					'heading'          => esc_html__( 'Scrolling speed', 'omniverse' ),
					'param_name'       => 'speed',
					'hint'             => esc_html__( 'Duration of one animation cycle (in seconds)', 'omniverse' ),
					'devices'          => array(
						'desktop' => array(
							'placeholder' => '5',
						),
						'tablet'  => array(
							'placeholder' => '5',
						),
						'mobile'  => array(
							'placeholder' => '5',
						),
					),
					'selectors'        => array(
						'{{WRAPPER}} .wd-marquee' => array(
							'--wd-marquee-speed: {{VALUE}}s;',
						),
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),

				array(
					'type'             => 'wd_select',
					'heading'          => esc_html__( 'Scrolling direction', 'omniverse' ),
					'param_name'       => 'direction',
					'style'            => 'select',
					'selectors'        => array(
						'{{WRAPPER}} .wd-marquee' => array(
							'--wd-marquee-direction: {{VALUE}};',
						),
					),
					'devices'          => array(
						'desktop' => array(
							'value' => '',
						),
					),
					'value'            => array(
						esc_html__( 'Right to left', 'omniverse' ) => '',
						esc_html__( 'Left to right', 'omniverse' ) => 'reverse',
						esc_html__( 'Right to left and reverse', 'omniverse' ) => 'alternate',
						esc_html__( 'Left to right and reverse', 'omniverse' ) => 'alternate-reverse',
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),

				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Pause on hover', 'omniverse' ),
					'param_name'       => 'paused_on_hover',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),

				$marquee_typography['font_family'],
				$marquee_typography['font_size'],
				$marquee_typography['font_weight'],
				$marquee_typography['text_transform'],
				$marquee_typography['font_style'],
				$marquee_typography['line_height'],

				array(
					'type'             => 'wd_colorpicker',
					'heading'          => esc_html__( 'Color', 'omniverse' ),
					'param_name'       => 'marquee_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-marquee' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'       => esc_html__( 'Items gap', 'omniverse' ),
					'type'          => 'wd_slider',
					'param_name'    => 'content_gap',
					'selectors'     => array(
						'{{WRAPPER}} .wd-marquee' => array(
							'--wd-marquee-gap: {{VALUE}}{{UNIT}};',
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
							'max'  => 200,
							'step' => 1,
						),
					),
					'generate_zero' => true,
				),

				/**
				 * Content.
				 */
				array(
					'type'       => 'param_group',
					'param_name' => 'marquee_contents',
					'heading'    => esc_html__( 'Content', 'omniverse' ),
					'group'      => esc_html__( 'Content', 'omniverse' ),
					'value'      => rawurlencode(
						wp_json_encode(
							array(
								array(
									'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
								),
							)
						)
					),
					'params'     => array(
						array(
							'type'       => 'vc_link',
							'heading'    => esc_html__( 'Link', 'omniverse' ),
							'param_name' => 'link',
						),
						array(
							'param_name' => 'text',
							'type'       => 'textarea',
							'heading'    => esc_html__( 'Text', 'omniverse' ),
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__( 'Icon type', 'omniverse' ),
							'value'      => array(
								esc_html__( 'Inherit', 'omniverse' ) => 'inherit',
								esc_html__( 'With image', 'omniverse' ) => 'image',
							),
							'param_name' => 'icon_type',
						),
						array(
							'type'             => 'attach_image',
							'heading'          => esc_html__( 'Custom image', 'omniverse' ),
							'param_name'       => 'image_id',
							'value'            => '',
							'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
							'dependency'       => array(
								'element' => 'icon_type',
								'value'   => array( 'image' ),
							),
						),
						array(
							'type'             => 'textfield',
							'heading'          => esc_html__( 'Image size', 'omniverse' ),
							'param_name'       => 'image_size',
							'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x50 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
							'dependency'       => array(
								'element' => 'icon_type',
								'value'   => array( 'image' ),
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
							'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x50\'.', 'omniverse' ),
						),
					),
				),
				/**
				 * Icon.
				 */
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon type', 'omniverse' ),
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'value'      => array(
						esc_html__( 'Without icon', 'omniverse' ) => 'without',
						esc_html__( 'With icon', 'omniverse' ) => 'icon',
						esc_html__( 'With image', 'omniverse' ) => 'image',
					),
					'param_name' => 'icon_type',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Image', 'omniverse' ),
					'group'            => esc_html__( 'Icon', 'omniverse' ),
					'param_name'       => 'image',
					'value'            => '',
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'image' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'group'            => esc_html__( 'Icon', 'omniverse' ),
					'param_name'       => 'img_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x50 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'image' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x50\'.', 'omniverse' ),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon library', 'omniverse' ),
					'group'      => esc_html__( 'Icon', 'omniverse' ),
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
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_fontawesome',
					'value'      => 'far fa-bell',
					'settings'   => array(
						'emptyIcon'    => false,
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => 'fontawesome',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_openiconic',
					'settings'   => array(
						'emptyIcon'    => false,
						'type'         => 'openiconic',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => 'openiconic',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_typicons',
					'settings'   => array(
						'emptyIcon'    => false,
						'type'         => 'typicons',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => 'typicons',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_entypo',
					'settings'   => array(
						'emptyIcon'    => false,
						'type'         => 'entypo',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => 'entypo',
					),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_linecons',
					'settings'   => array(
						'emptyIcon'    => false,
						'type'         => 'linecons',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => 'linecons',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_monosocial',
					'settings'   => array(
						'emptyIcon'    => false,
						'type'         => 'monosocial',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => 'monosocial',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'param_name' => 'icon_material',
					'settings'   => array(
						'emptyIcon'    => false,
						'type'         => 'material',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => 'material',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				// array(
				// 'type'       => 'omniverse_title_divider',
				// 'holder'     => 'div',
				// 'title'      => esc_html__( 'Icon', 'omniverse' ),
				// 'group'      => esc_html__( 'Icon', 'omniverse' ),
				// 'param_name' => 'style_icon_divider',
				// ),
					array(
						'type'             => 'omniverse_colorpicker',
						'heading'          => esc_html__( 'Icons color', 'omniverse' ),
						'group'            => esc_html__( 'Icon', 'omniverse' ),
						'param_name'       => 'marquee_icon_color',
						'css_args'         => array(
							'color' => array(
								' .wd-icon',
							),
						),
						'dependency'       => array(
							'element' => 'icon_type',
							'value'   => array( 'icon' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
				array(
					'heading'    => esc_html__( 'Icon size', 'omniverse' ),
					'group'      => esc_html__( 'Icon', 'omniverse' ),
					'type'       => 'wd_slider',
					'param_name' => 'icon_size',
					'selectors'  => array(
						'{{WRAPPER}} .wd-marquee .wd-icon' => array(
							'font-size: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'    => array(
						'desktop' => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'      => array(
						'px' => array(
							'min'  => 1,
							'max'  => 100,
							'step' => 1,
						),
					),
					'dependency' => array(
						'element' => 'icon_type',
						'value'   => array( 'icon' ),
					),
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
