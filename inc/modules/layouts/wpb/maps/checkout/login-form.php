<?php
/**
 * Login form map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_checkout_login_form' ) ) {
	/**
	 * Login form map.
	 */
	function omniverse_get_vc_map_checkout_login_form() {
		$toggle_typography = omniverse_get_typography_map(
			array(
				'key'      => 'toggle_typography',
				'group'    => esc_html__( 'Style', 'js_composer' ),
				'selector' => '{{WRAPPER}} .woocommerce-form-login-toggle > div',
			)
		);

		return array(
			'base'        => 'omniverse_checkout_login_form',
			'name'        => esc_html__( 'Login form', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Checkout', 'omniverse' ), 'checkout_content' ),
			'description' => esc_html__( 'Checkout user login form', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/ch-icons/ch-login-form.svg',
			'params'      => array(
				array(
					'title'      => esc_html__( 'General', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'js_composer' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'general_style_section',
				),
				array(
					'heading'          => esc_html__( 'Alignment', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'param_name'       => 'alignment',
					'type'             => 'omniverse_image_select',
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
				array(
					'title'      => esc_html__( 'Toggle', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'js_composer' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'toggle_style_section',
				),
				$toggle_typography['font_family'],
				$toggle_typography['font_size'],
				$toggle_typography['font_weight'],
				$toggle_typography['text_transform'],
				$toggle_typography['font_style'],
				$toggle_typography['line_height'],
				array(
					'title'      => esc_html__( 'Form', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'js_composer' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'form_style_section',
				),
				array(
					'heading'          => esc_html__( 'Width', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_slider',
					'param_name'       => 'form_width',
					'devices'          => array(
						'desktop' => array(
							'unit'  => 'px',
							'value' => 470,
						),
						'tablet' => array(
							'unit'  => 'px',
							'value' => 0,
						),
						'mobile' => array(
							'unit'  => 'px',
							'value' => 0,
						),
					),
					'range'            => array(
						'px' => array(
							'min'  => 0,
							'max'  => 1200,
							'step' => 1,
						),
						'%' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					),
					'selectors'        => array(
						'{{WRAPPER}} .login.hidden-form' => array(
							'max-width: {{VALUE}}{{UNIT}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Background color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'form_bg_color',
					'selectors'        => array(
						'{{WRAPPER}} .login.hidden-form' => array(
							'background-color: {{VALUE}};',
						),
					),
				),
				array(
					'heading'          => esc_html__( 'Border type', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_select',
					'param_name'       => 'border_type',
					'style'            => 'select',
					'selectors'        => array(
						'{{WRAPPER}} .login.hidden-form' => array(
							'border-style: {{VALUE}};',
						),
					),
					'devices'          => array(
						'desktop' => array(
							'value' => '',
						),
					),
					'value'            => array(
						esc_html__( 'Default', 'omniverse' ) => '',
						esc_html__( 'None', 'omniverse' )    => 'none',
						esc_html__( 'Solid', 'omniverse' )   => 'solid',
						esc_html__( 'Dotted', 'omniverse' )  => 'dotted',
						esc_html__( 'Double', 'omniverse' )  => 'double',
						esc_html__( 'Dashed', 'omniverse' )  => 'dashed',
						esc_html__( 'Groove', 'omniverse' )  => 'groove',
					),
				),
				array(
					'heading'    => esc_html__( 'Border width', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'wd_dimensions',
					'param_name' => 'border_width',
					'selectors'  => array(
						'{{WRAPPER}} .login.hidden-form' => array(
							'border-top-width: {{TOP}}px;',
							'border-right-width: {{RIGHT}}px;',
							'border-bottom-width: {{BOTTOM}}px;',
							'border-left-width: {{LEFT}}px;',
						),
					),
					'devices'    => array(
						'desktop' => array(
							'unit' => 'px',
						),
					),
					'range'      => array(
						'px' => array(),
					),
					'dependency' => array(
						'element' => 'border_type',
						'value_not_equal_to' => array('', 'eyJkZXZpY2VzIjp7ImRlc2t0b3AiOnsidmFsdWUiOiJub25lIn19fQ=='),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Border color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'border_color',
					'selectors'        => array(
						'{{WRAPPER}} .login.hidden-form' => array(
							'border-color: {{VALUE}};',
						),
					),
					'dependency' => array(
						'element'   => 'border_type',
						'value_not_equal_to' => array('', 'eyJkZXZpY2VzIjp7ImRlc2t0b3AiOnsidmFsdWUiOiJub25lIn19fQ=='),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'    => esc_html__( 'Border radius', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'wd_dimensions',
					'param_name' => 'border_radius',
					'selectors'  => array(
						'{{WRAPPER}} .login.hidden-form' => array(
							'border-top-left-radius: {{TOP}}{{UNIT}};',
							'border-top-right-radius: {{RIGHT}}{{UNIT}};',
							'border-bottom-right-radius: {{BOTTOM}}{{UNIT}};',
							'border-bottom-left-radius: {{LEFT}}{{UNIT}};',
						),
					),
					'devices'    => array(
						'desktop' => array(
							'unit' => 'px',
						),
						'tablet' => array(
							'unit' => 'px',
						),
						'mobile' => array(
							'unit' => 'px',
						),
					),
					'range'      => array(
						'px' => array(),
					),
					'dependency' => array(
						'element' => 'border_type',
						'value_not_equal_to' => array('', 'eyJkZXZpY2VzIjp7ImRlc2t0b3AiOnsidmFsdWUiOiJub25lIn19fQ=='),
					),
				),
				array(
					'heading'    => esc_html__( 'Padding', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'wd_dimensions',
					'param_name' => 'form_padding',
					'selectors'  => array(
						'{{WRAPPER}} .login.hidden-form' => array(
							'padding-top: {{TOP}}{{UNIT}};',
							'padding-left: {{LEFT}}{{UNIT}};',
							'padding-right: {{RIGHT}}{{UNIT}};',
							'padding-bottom: {{BOTTOM}}{{UNIT}};',
						),
					),
					'devices'    => array(
						'desktop' => array(
							'unit' => 'px',
						),
						'tablet' => array(
							'unit' => 'px',
						),
						'mobile' => array(
							'unit' => 'px',
						),
					),
					'range'      => array(
						'px' => array(),
					),
				),

				array(
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
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
			),
		);
	}
}
