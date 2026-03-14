<?php
/**
 * Payment methods map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_checkout_payment_methods' ) ) {
	/**
	 * Payment methods map.
	 */
	function omniverse_get_vc_map_checkout_payment_methods() {
		$title_typography = omniverse_get_typography_map(
			array(
				'key'              => 'title_typography',
				'group'            => esc_html__( 'Style', 'omniverse' ),
				'selector'         => '{{WRAPPER}} .payment_methods li > label',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			)
		);

		$description_typography = omniverse_get_typography_map(
			array(
				'key'      => 'description_typography',
				'group'    => esc_html__( 'Style', 'omniverse' ),
				'selector' => '{{WRAPPER}} .payment_box',
			)
		);

		return array(
			'base'        => 'omniverse_checkout_payment_methods',
			'name'        => esc_html__( 'Payment methods', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Checkout', 'omniverse' ), 'checkout_form' ),
			'description' => esc_html__( 'Payment methods and checkout button', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/ch-icons/ch-payment-methods.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'omniverse_css_id',
				),

				// Payment title.
				array(
					'title'      => esc_html__( 'Payment title', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'payment_title_divider',
				),

				$title_typography['font_family'],
				$title_typography['font_size'],
				$title_typography['font_weight'],
				$title_typography['text_transform'],
				$title_typography['font_style'],
				$title_typography['line_height'],

				array(
					'heading'          => esc_html__( 'Color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'title_color',
					'selectors'        => array(
						'{{WRAPPER}} .payment_methods li > label' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				// Payment description.
				array(
					'title'      => esc_html__( 'Payment description', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'payment_description_divider',
				),

				$description_typography['font_family'],
				$description_typography['font_size'],
				$description_typography['font_weight'],
				$description_typography['text_transform'],
				$description_typography['font_style'],
				$description_typography['line_height'],

				array(
					'heading'          => esc_html__( 'Color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'payment_description_color',
					'selectors'        => array(
						'{{WRAPPER}} .payment_box' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Background color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'payment_description_background_color',
					'selectors'        => array(
						'{{WRAPPER}} .payment_box' => array(
							'background-color: {{VALUE}};',
						),
						'{{WRAPPER}} .payment_box:before' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				// Terms and conditions.
				array(
					'title'      => esc_html__( 'Terms and conditions', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'terms_conditions_divider',
				),

				array(
					'heading'    => esc_html__( 'Background color', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'wd_colorpicker',
					'param_name' => 'terms_conditions_background_color',
					'selectors'  => array(
						'{{WRAPPER}} .woocommerce-terms-and-conditions' => array(
							'background-color: {{VALUE}};',
						),
					),
				),

				// Button.
				array(
					'title'      => esc_html__( 'Button', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'general_divider',
				),

				array(
					'heading'    => esc_html__( 'Button position', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'wd_select',
					'param_name' => 'button_alignment',
					'style'      => 'select',
					'selectors'  => array(),
					'devices'    => array(
						'desktop' => array(
							'value' => 'left',
						),
					),
					'value'      => array(
						esc_html__( 'Left', 'omniverse' ) => 'left',
						esc_html__( 'Center', 'omniverse' ) => 'center',
						esc_html__( 'Right', 'omniverse' ) => 'right',
						esc_html__( 'Full width', 'omniverse' ) => 'full-width',
					),
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
