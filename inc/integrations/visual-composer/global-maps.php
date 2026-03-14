<?php

if ( ! function_exists( 'omniverse_get_vc_carousel_map' ) ) {
	/**
	 * Get animation map settings for VC.
	 */
	function omniverse_get_vc_carousel_map() {
		$settings = array(
			'omniverse_products'          => array(
				'group'      => esc_html__( 'Carousel', 'omniverse' ),
				'exclude'    => array( 'slider_spacing_tabs', 'slider_spacing', 'slider_spacing_tablet', 'slider_spacing_mobile' ),
				'dependency' => array(
					'element' => 'layout',
					'value'   => array( 'carousel' ),
				),
			),
			'products_tab'               => array(
				'group'      => esc_html__( 'Carousel', 'omniverse' ),
				'exclude'    => array( 'slider_spacing_tabs', 'slider_spacing', 'slider_spacing_tablet', 'slider_spacing_mobile' ),
				'dependency' => array(
					'element' => 'layout',
					'value'   => array( 'carousel' ),
				),
			),
			'omniverse_blog'              => array(
				'group'      => esc_html__( 'Carousel', 'omniverse' ),
				'exclude'    => array( 'slider_spacing_tabs', 'slider_spacing', 'slider_spacing_tablet', 'slider_spacing_mobile' ),
				'dependency' => array(
					'element' => 'blog_design',
					'value'   => array( 'carousel' ),
				),
			),
			'omniverse_gallery'           => array(
				'group'      => esc_html__( 'Carousel', 'omniverse' ),
				'exclude'    => array( 'slider_spacing_tabs', 'slider_spacing', 'slider_spacing_tablet', 'slider_spacing_mobile' ),
				'dependency' => array(
					'element' => 'view',
					'value'   => array( 'carousel' ),
				),
			),
			'omniverse_instagram'         => array(
				'group'      => esc_html__( 'Carousel', 'omniverse' ),
				'exclude'    => array( 'slides_per_view_tabs', 'slides_per_view', 'slides_per_view_tablet', 'slides_per_view_mobile', 'slider_spacing_tabs', 'slider_spacing', 'slider_spacing_tablet', 'slider_spacing_mobile' ),
				'dependency' => array(
					'element' => 'design',
					'value'   => array( 'slider' ),
				),
			),
			'omniverse_categories'        => array(
				'group'      => esc_html__( 'Carousel', 'omniverse' ),
				'exclude'    => array( 'slider_spacing_tabs', 'slider_spacing', 'slider_spacing_tablet', 'slider_spacing_mobile' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'carousel' ),
				),
			),
			'testimonials'               => array(
				'group'      => esc_html__( 'Carousel', 'omniverse' ),
				'exclude'    => array( 'slider_spacing_tabs', 'slider_spacing', 'slider_spacing_tablet', 'slider_spacing_mobile' ),
				'dependency' => array(
					'element' => 'layout',
					'value'   => array( 'slider' ),
				),
			),
			'omniverse_brands'            => array(
				'group'      => esc_html__( 'Carousel', 'omniverse' ),
				'exclude'    => array( 'slides_per_view_tabs', 'slides_per_view', 'slides_per_view_tablet', 'slides_per_view_mobile', 'slider_spacing_tabs', 'slider_spacing', 'slider_spacing_tablet', 'slider_spacing_mobile' ),
				'dependency' => array(
					'element' => 'style',
					'value'   => array( 'carousel' ),
				),
			),
			'omniverse_nested_carousel'   => array(
				'group' => esc_html__( 'Style', 'omniverse' ),
			),
			'banners_carousel'           => array(),
			'omniverse_info_box_carousel' => array(),
			'omniverse_portfolio'         => array(
				'group'      => esc_html__( 'Carousel', 'omniverse' ),
				'exclude'    => array( 'slider_spacing_tabs', 'slider_spacing', 'slider_spacing_tablet', 'slider_spacing_mobile' ),
				'dependency' => array(
					'element' => 'layout',
					'value'   => array( 'carousel' ),
				),
			),
		);

		$fields = array(
			array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Slides per view', 'omniverse' ),
				'hint'             => esc_html__( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode. Also supports for "auto" value, in this case it will fit slides depending on container\'s width. "auto" mode doesn\'t compatible with loop mode.', 'omniverse' ),
				'param_name'       => 'slides_per_view_tabs',
				'tabs'             => true,
				'value'            => array(
					esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
					esc_html__( 'Tablet', 'omniverse' )  => 'tablet',
					esc_html__( 'Mobile', 'omniverse' )  => 'mobile',
				),
				'default'          => 'desktop',
				'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'omniverse_slider',
				'param_name'       => 'slides_per_view',
				'min'              => '1',
				'max'              => '8',
				'step'             => '0.5',
				'default'          => '3',
				'units'            => 'col',
				'wd_dependency'    => array(
					'element' => 'slides_per_view_tabs',
					'value'   => array( 'desktop' ),
				),
				'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'omniverse_slider',
				'param_name'       => 'slides_per_view_tablet',
				'min'              => '1',
				'max'              => '8',
				'step'             => '0.5',
				'default'          => '',
				'units'            => 'col',
				'wd_dependency'    => array(
					'element' => 'slides_per_view_tabs',
					'value'   => array( 'tablet' ),
				),
				'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'omniverse_slider',
				'param_name'       => 'slides_per_view_mobile',
				'min'              => '1',
				'max'              => '8',
				'step'             => '0.5',
				'default'          => 'auto',
				'units'            => 'col',
				'wd_dependency'    => array(
					'element' => 'slides_per_view_tabs',
					'value'   => array( 'mobile' ),
				),
				'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
			),

			array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Slider spacing', 'omniverse' ),
				'hint'             => esc_html__( 'Set the interval numbers that you want to display between slider items.', 'omniverse' ),
				'param_name'       => 'slider_spacing_tabs',
				'tabs'             => true,
				'value'            => array(
					esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
					esc_html__( 'Tablet', 'omniverse' )  => 'tablet',
					esc_html__( 'Mobile', 'omniverse' )  => 'mobile',
				),
				'default'          => 'desktop',
				'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'dropdown',
				'param_name'       => 'slider_spacing',
				'value'            => array(
					30,
					20,
					10,
					6,
					2,
					0,
				),
				'wd_dependency'    => array(
					'element' => 'slider_spacing_tabs',
					'value'   => array( 'desktop' ),
				),
				'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'dropdown',
				'param_name'       => 'slider_spacing_tablet',
				'value'            => array(
					esc_html__( 'Inherit', 'omniverse' ) => '',
					'30'                                => '30',
					'20'                                => '20',
					'10'                                => '10',
					'6'                                 => '6',
					'2'                                 => '2',
					'0'                                 => '0',
				),
				'std'              => '',
				'wd_dependency'    => array(
					'element' => 'slider_spacing_tabs',
					'value'   => array( 'tablet' ),
				),
				'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'dropdown',
				'param_name'       => 'slider_spacing_mobile',
				'value'            => array(
					esc_html__( 'Inherit', 'omniverse' ) => '',
					'30'                                => '30',
					'20'                                => '20',
					'10'                                => '10',
					'6'                                 => '6',
					'2'                                 => '2',
					'0'                                 => '0',
				),
				'std'              => '',
				'wd_dependency'    => array(
					'element' => 'slider_spacing_tabs',
					'value'   => array( 'mobile' ),
				),
				'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
			),

			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Scroll per page', 'omniverse' ),
				'param_name'       => 'scroll_per_page',
				'hint'             => esc_html__( 'Scroll per page not per item. This affect next/prev buttons and mouse/touch dragging.', 'omniverse' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'std'              => 'yes',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Center mode', 'omniverse' ),
				'param_name'       => 'center_mode',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
				'wd_dependency'    => array(
					'element' => 'scroll_per_page',
					'value'   => array( 'no' ),
				),
			),
			array(
				'type'       => 'omniverse_empty_space',
				'param_name' => 'omniverse_empty_space',
			),
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Slider loop', 'omniverse' ),
				'param_name'       => 'wrap',
				'hint'             => esc_html__( 'Enables loop mode.', 'omniverse' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Auto height', 'omniverse' ),
				'param_name'       => 'autoheight',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Slider autoplay', 'omniverse' ),
				'param_name'       => 'autoplay',
				'hint'             => esc_html__( 'Enables autoplay mode.', 'omniverse' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Slider speed', 'omniverse' ),
				'param_name'       => 'speed',
				'value'            => '5000',
				'hint'             => esc_html__( 'Duration of animation between slides (in ms)', 'omniverse' ),
				'wd_dependency'    => array(
					'element' => 'autoplay',
					'value'   => 'yes',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Init carousel on scroll', 'omniverse' ),
				'hint'             => esc_html__( 'This option allows you to init carousel script only when visitor scroll the page to the slider. Useful for performance optimization.', 'omniverse' ),
				'param_name'       => 'scroll_carousel_init',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Disabled overflow', 'omniverse' ),
				'param_name'       => 'disable_overflow_carousel',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'       => 'omniverse_empty_space',
				'param_name' => 'omniverse_empty_space',
			),
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Hide prev/next buttons', 'omniverse' ),
				'param_name'       => 'hide_prev_next_buttons',
				'hint'             => esc_html__( 'If "YES" prev/next control will be removed', 'omniverse' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'dropdown',
				'heading'          => esc_html__( 'Carousel arrow position', 'omniverse' ),
				'param_name'       => 'carousel_arrows_position',
				'value'            => array(
					esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => '',
					esc_html__( 'Separate', 'omniverse' ) => 'sep',
					esc_html__( 'Together', 'omniverse' ) => 'together',
				),
				'wd_dependency'    => array(
					'element' => 'hide_prev_next_buttons',
					'value'   => array( 'no' ),
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'wd_slider',
				'param_name'       => 'carousel_arrows_offset_h',
				'heading'          => esc_html__( 'Arrow offset horizontal', 'omniverse' ),
				'devices'          => array(
					'desktop'         => array(
						'unit'  => 'px',
						'value' => '',
					),
					'tablet_vertical' => array(
						'unit'  => 'px',
						'value' => '',
					),
					'mobile'          => array(
						'unit'  => 'px',
						'value' => '',
					),
				),
				'range'            => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors'        => array(
					'{{WRAPPER}} .wd-nav-arrows' => array(
						'--wd-arrow-offset-h: {{VALUE}}{{UNIT}};',
					),
				),
				'generate_zero'    => true,
				'wd_dependency'    => array(
					'element' => 'hide_prev_next_buttons',
					'value'   => array( 'no' ),
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'wd_slider',
				'param_name'       => 'carousel_arrows_offset_v',
				'heading'          => esc_html__( 'Arrow offset vertical', 'omniverse' ),
				'devices'          => array(
					'desktop'         => array(
						'unit'  => 'px',
						'value' => '',
					),
					'tablet_vertical' => array(
						'unit'  => 'px',
						'value' => '',
					),
					'mobile'          => array(
						'unit'  => 'px',
						'value' => '',
					),
				),
				'range'            => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors'        => array(
					'{{WRAPPER}} .wd-nav-arrows' => array(
						'--wd-arrow-offset-v: {{VALUE}}{{UNIT}};',
					),
				),
				'generate_zero'    => true,
				'wd_dependency'    => array(
					'element' => 'hide_prev_next_buttons',
					'value'   => array( 'no' ),
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Hide pagination control', 'omniverse' ),
				'param_name'       => 'hide_pagination_control_tabs',
				'hint'             => esc_html__( 'If "YES" pagination control will be removed', 'omniverse' ),
				'tabs'             => true,
				'value'            => array(
					esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
					esc_html__( 'Tablet', 'omniverse' )  => 'tablet',
					esc_html__( 'Mobile', 'omniverse' )  => 'mobile',
				),
				'default'          => 'desktop',
				'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'hide_pagination_control',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'wd_dependency'    => array(
					'element' => 'hide_pagination_control_tabs',
					'value'   => array( 'desktop' ),
				),
				'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'hide_pagination_control_tablet',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'yes',
				'wd_dependency'    => array(
					'element' => 'hide_pagination_control_tabs',
					'value'   => array( 'tablet' ),
				),
				'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'hide_pagination_control_mobile',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'yes',
				'wd_dependency'    => array(
					'element' => 'hide_pagination_control_tabs',
					'value'   => array( 'mobile' ),
				),
				'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
			),
			array(
				'type'        => 'omniverse_switch',
				'heading'     => esc_html__( 'Dynamic pagination control', 'omniverse' ),
				'param_name'  => 'dynamic_pagination_control',
				'true_state'  => 'yes',
				'false_state' => 'no',
				'default'     => 'no',
			),

			array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Hide scrollbar', 'omniverse' ),
				'param_name'       => 'hide_scrollbar_tabs',
				'hint'             => esc_html__( 'If "YES" scrollbar will be removed', 'omniverse' ),
				'tabs'             => true,
				'value'            => array(
					esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
					esc_html__( 'Tablet', 'omniverse' )  => 'tablet',
					esc_html__( 'Mobile', 'omniverse' )  => 'mobile',
				),
				'default'          => 'desktop',
				'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'hide_scrollbar',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'yes',
				'wd_dependency'    => array(
					'element' => 'hide_scrollbar_tabs',
					'value'   => array( 'desktop' ),
				),
				'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'hide_scrollbar_tablet',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'yes',
				'wd_dependency'    => array(
					'element' => 'hide_scrollbar_tabs',
					'value'   => array( 'tablet' ),
				),
				'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'hide_scrollbar_mobile',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'yes',
				'wd_dependency'    => array(
					'element' => 'hide_scrollbar_tabs',
					'value'   => array( 'mobile' ),
				),
				'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
			),

			array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Synchronization', 'omniverse' ),
				'param_name'       => 'carousel_sync',
				'value'            => array(
					esc_html__( 'Disabled', 'omniverse' )  => '',
					esc_html__( 'As parent', 'omniverse' ) => 'parent',
					esc_html__( 'As child', 'omniverse' )  => 'child',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'ID', 'omniverse' ),
				'param_name'       => 'sync_parent_id',
				'std'              => 'wd_' . uniqid(),
				'save_always'      => true,
				'wd_dependency'    => array(
					'element' => 'carousel_sync',
					'value'   => array( 'parent' ),
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'ID', 'omniverse' ),
				'param_name'       => 'sync_child_id',
				'wd_dependency'    => array(
					'element' => 'carousel_sync',
					'value'   => array( 'child' ),
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
		);

		foreach ( $settings as $element_key => $setting ) {
			$element_fields = $fields;

			foreach ( $element_fields as $key => $field ) {
				if ( isset( $setting['exclude'], $field['param_name'] ) && in_array( $field['param_name'], $setting['exclude'], true ) ) {
					unset( $element_fields[ $key ] );

					continue;
				}

				if ( isset( $setting['dependency'] ) ) {
					$element_fields[ $key ]['dependency'] = $setting['dependency'];
				}

				if ( isset( $setting['group'] ) ) {
					$element_fields[ $key ]['group'] = $setting['group'];
				}
			}

			vc_add_params( $element_key, $element_fields );
		}
	}

	add_action( 'vc_before_mapping', 'omniverse_get_vc_carousel_map' );
}

if ( ! function_exists( 'omniverse_get_vc_animation_map' ) ) {
	/**
	 * Get animation map settings for VC.
	 *
	 * @param string $key Needed map. Should be equal to map param_name.
	 *
	 * @return array
	 */
	function omniverse_get_vc_animation_map( $key ) {
		$map = array(
			'wd_animation'          => array(
				'type'             => 'dropdown',
				'heading'          => esc_html__( 'Theme Animation', 'omniverse' ),
				'hint'             => esc_html__( 'Use custom theme animations if you want to run them in the slider element.' ),
				'param_name'       => 'wd_animation',
				'admin_label'      => true,
				'value'            => array(
					esc_html__( 'None', 'omniverse' )       => '',
					esc_html__( 'Slide from top', 'omniverse' ) => 'slide-from-top',
					esc_html__( 'Slide from bottom', 'omniverse' ) => 'slide-from-bottom',
					esc_html__( 'Slide from left', 'omniverse' ) => 'slide-from-left',
					esc_html__( 'Slide from right', 'omniverse' ) => 'slide-from-right',
					esc_html__( 'Slide short from left', 'omniverse' ) => 'slide-short-from-left',
					esc_html__( 'Slide short from right', 'omniverse' ) => 'slide-short-from-right',
					esc_html__( 'Flip X bottom', 'omniverse' ) => 'bottom-flip-x',
					esc_html__( 'Flip X top', 'omniverse' ) => 'top-flip-x',
					esc_html__( 'Flip Y left', 'omniverse' ) => 'left-flip-y',
					esc_html__( 'Flip Y right', 'omniverse' ) => 'right-flip-y',
					esc_html__( 'Zoom in', 'omniverse' )    => 'zoom-in',
				),
				'std'              => '',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			'wd_animation_delay'    => array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Theme Animation Delay (ms)', 'omniverse' ),
				'param_name'       => 'wd_animation_delay',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'dependency'       => array(
					'element'            => 'wd_animation',
					'value_not_equal_to' => array( '' ),
				),
			),
			'wd_animation_duration' => array(
				'type'             => 'dropdown',
				'heading'          => esc_html__( 'Theme Animation duration', 'omniverse' ),
				'param_name'       => 'wd_animation_duration',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'value'            => array(
					esc_html__( 'Slow', 'omniverse' )   => 'slow',
					esc_html__( 'Normal', 'omniverse' ) => 'normal',
					esc_html__( 'Fast', 'omniverse' )   => 'fast',
				),
				'dependency'       => array(
					'element'            => 'wd_animation',
					'value_not_equal_to' => array( '' ),
				),
				'std'              => 'normal',
			),
		);

		return array_key_exists( $key, $map ) ? $map[ $key ] : array();
	}
}

if ( ! function_exists( 'omniverse_get_responsive_reset_margin_map' ) ) {
	/**
	 * Get mobile reset option map.
	 *
	 * @param string $key Needed map. Should be equal to map param_name.
	 *
	 * @return array map.
	 */
	function omniverse_get_responsive_reset_margin_map( $key ) {
		$map = array(
			/**
			 * Responsive Options.
			 */
			'responsive_tabs_reset' => array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Reset margin (deprecated)', 'omniverse' ),
				'param_name'       => 'responsive_tabs_reset',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'tabs'             => true,
				'value'            => array(
					esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
					esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
				),
				'default'          => 'tablet',
				'edit_field_class' => 'wd-custom-width vc_col-sm-12 vc_column',
			),
			'mobile_reset_margin'   => array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'mobile_reset_margin',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs_reset',
					'value'   => array( 'mobile' ),
				),
			),
			'tablet_reset_margin'   => array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'tablet_reset_margin',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs_reset',
					'value'   => array( 'tablet' ),
				),
			),
		);

		return array_key_exists( $key, $map ) ? $map[ $key ] : array();
	}
}

if ( ! function_exists( 'omniverse_get_vc_responsive_spacing_map' ) ) {
	/**
	 * Get responsive spacing option map.
	 *
	 * @return array map.
	 */
	function omniverse_get_vc_responsive_spacing_map() {
		return array(
			'type'       => 'omniverse_responsive_spacing',
			'param_name' => 'responsive_spacing',
			'group'      => esc_html__( 'Design Options', 'js_composer' ),
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_responsive_visible_map' ) ) {
	/**
	 * Get responsive visible option map.
	 *
	 * @param string $key Needed map. Should be equal to map param_name.
	 *
	 * @return array map.
	 */
	function omniverse_get_vc_responsive_visible_map( $key ) {
		$map = array(
			/**
			 * Responsive Options.
			 */
			'responsive_tabs_hide' => array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Hide element', 'omniverse' ),
				'param_name'       => 'responsive_tabs_hide',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'tabs'             => true,
				'value'            => array(
					esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
					esc_html__( 'Tablet', 'omniverse' )  => 'tablet',
					esc_html__( 'Mobile', 'omniverse' )  => 'mobile',
				),
				'default'          => 'desktop',
				'edit_field_class' => 'wd-custom-width vc_col-sm-12 vc_column',
			),
			'wd_hide_on_desktop'   => array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'wd_hide_on_desktop',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs_hide',
					'value'   => array( 'desktop' ),
				),
			),
			'wd_hide_on_tablet'    => array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'wd_hide_on_tablet',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs_hide',
					'value'   => array( 'tablet' ),
				),
			),
			'wd_hide_on_mobile'    => array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'wd_hide_on_mobile',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs_hide',
					'value'   => array( 'mobile' ),
				),
			),
		);

		return array_key_exists( $key, $map ) ? $map[ $key ] : array();
	}
}

if ( ! function_exists( 'omniverse_get_vc_display_inline_map' ) ) {
	/**
	 * Get display inline option map.
	 *
	 * @return array map.
	 */
	function omniverse_get_vc_display_inline_map() {
		return array(
			'type'             => 'omniverse_switch',
			'heading'          => esc_html__( 'Display inline', 'omniverse' ),
			'param_name'       => 'omniverse_inline',
			'true_state'       => 'yes',
			'false_state'      => 'no',
			'default'          => 'no',
			'edit_field_class' => 'vc_col-sm-12 vc_column',
		);
	}
}

if ( ! function_exists( 'omniverse_contact_form_7_custom_options' ) ) {
	/**
	 * Update custom params map to Default Contact Form 7 element in WPBakery.
	 *
	 * @throws Exception .
	 */
	function omniverse_contact_form_7_custom_options() {
		$params = array(
			array(
				'type'       => 'omniverse_title_divider',
				'holder'     => 'div',
				'title'      => esc_html__( 'Style', 'omniverse' ),
				'param_name' => 'style_divider',
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Color presets', 'omniverse' ),
				'param_name' => 'html_class',
				'value'      => array(
					esc_html__( 'Default', 'omniverse' ) => '',
					esc_html__( 'With background', 'omniverse' ) => 'wd-style-with-bg',
				),
				'std'        => '',
			),

			array(
				'type'       => 'omniverse_title_divider',
				'holder'     => 'div',
				'title'      => esc_html__( 'Form', 'omniverse' ),
				'param_name' => 'form_divider',
				'dependency' => array(
					'element'            => 'html_class',
					'value_not_equal_to' => 'wd-style-with-bg',
				),
			),

			array(
				'heading'          => esc_html__( 'Text color', 'omniverse' ),
				'type'             => 'wd_colorpicker',
				'param_name'       => 'form_color',
				'selectors'        => array(
					'form.wpcf7-form' => array(
						'--wd-form-color: {{VALUE}};',
					),
				),
				'dependency'       => array(
					'element'            => 'html_class',
					'value_not_equal_to' => 'wd-style-with-bg',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),

			array(
				'heading'          => esc_html__( 'Placeholder color', 'omniverse' ),
				'type'             => 'wd_colorpicker',
				'param_name'       => 'form_placeholder_color',
				'selectors'        => array(
					'form.wpcf7-form' => array(
						'--wd-form-placeholder-color: {{VALUE}};',
					),
				),
				'dependency'       => array(
					'element'            => 'html_class',
					'value_not_equal_to' => 'wd-style-with-bg',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),

			array(
				'heading'          => esc_html__( 'Border color', 'omniverse' ),
				'type'             => 'wd_colorpicker',
				'param_name'       => 'form_brd_color',
				'selectors'        => array(
					'form.wpcf7-form' => array(
						'--wd-form-brd-color: {{VALUE}};',
					),
				),
				'dependency'       => array(
					'element'            => 'html_class',
					'value_not_equal_to' => 'wd-style-with-bg',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),

			array(
				'heading'          => esc_html__( 'Border color focus', 'omniverse' ),
				'type'             => 'wd_colorpicker',
				'param_name'       => 'form_brd_color_focus',
				'selectors'        => array(
					'form.wpcf7-form' => array(
						'--wd-form-brd-color-focus: {{VALUE}};',
					),
				),
				'dependency'       => array(
					'element'            => 'html_class',
					'value_not_equal_to' => 'wd-style-with-bg',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),

			array(
				'heading'          => esc_html__( 'Background color', 'omniverse' ),
				'type'             => 'wd_colorpicker',
				'param_name'       => 'form_bg',
				'selectors'        => array(
					'form.wpcf7-form' => array(
						'--wd-form-bg: {{VALUE}};',
					),
				),
				'dependency'       => array(
					'element'            => 'html_class',
					'value_not_equal_to' => 'wd-style-with-bg',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
		);

		vc_add_params( 'contact-form-7', $params );
	}

	add_action( 'vc_before_init', 'omniverse_contact_form_7_custom_options' );
}

if ( ! function_exists( 'omniverse_vc_column_custom_options' ) ) {
	/**
	 * Update custom params map to Default Column element in WPBakery.
	 *
	 * @throws Exception .
	 */
	function omniverse_vc_column_custom_options() {
		$general_options = array(
			/**
			 * CSS ID Option.
			 */
			array(
				'type'       => 'omniverse_css_id',
				'param_name' => 'omniverse_css_id',
			),
			/**
			 * Color Scheme Param.
			 */
			array(
				'type'       => 'omniverse_button_set',
				'heading'    => esc_html__( 'Color Scheme', 'omniverse' ),
				'param_name' => 'omniverse_color_scheme',
				'value'      => array(
					esc_html__( 'Inherit', 'omniverse' ) => '',
					esc_html__( 'Light', 'omniverse' )   => 'light',
					esc_html__( 'Dark', 'omniverse' )    => 'dark',
				),
			),
			/**
			 * Parallax On Scroll Option.
			 */
			omniverse_parallax_scroll_map( 'parallax_scroll' ),
			omniverse_parallax_scroll_map( 'scroll_x' ),
			omniverse_parallax_scroll_map( 'scroll_y' ),
			omniverse_parallax_scroll_map( 'scroll_z' ),
			omniverse_parallax_scroll_map( 'scroll_smooth' ),
			/**
			 * Enable sticky column Option.
			 */
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Enable sticky column', 'omniverse' ),
				'description'      => esc_html__( 'Also enable equal columns height for the parent row to make it work', 'omniverse' ),
				'param_name'       => 'omniverse_sticky_column',
				'true_state'       => 'true',
				'false_state'      => 'false',
				'default'          => 'false',
				'dependency'       => array(
					'element' => 'wd_column_role',
					'value'   => array( '' ),
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Sticky column offset', 'omniverse' ),
				'param_name'       => 'omniverse_sticky_column_offset',
				'dependency'       => array(
					'element' => 'omniverse_sticky_column',
					'value'   => array( 'true' ),
				),
				'value'            => 150,
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			/**
			 * Text align Option.
			 */
			array(
				'type'             => 'dropdown',
				'heading'          => esc_html__( 'Text align', 'omniverse' ),
				'param_name'       => 'omniverse_text_align',
				'value'            => array(
					esc_html__( 'Choose', 'omniverse' ) => '',
					esc_html__( 'Left', 'omniverse' )   => 'left',
					esc_html__( 'Center', 'omniverse' ) => 'center',
					esc_html__( 'Right', 'omniverse' )  => 'right',
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			/**
			 * Collapsible content Option.
			 */
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Collapsible content', 'omniverse' ),
				'hint'             => esc_html__( 'Limit the column height and add the "Read more" button. IMPORTANT: you need to add our "Button" element to the end of this column and enable an appropriate option there as well.', 'omniverse' ),
				'param_name'       => 'wd_collapsible_content_switcher',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'dependency'       => array(
					'element' => 'wd_column_role',
					'value'   => array( '' ),
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'wd_slider',
				'param_name'       => 'wd_collapsible_content_max_height',
				'heading'          => esc_html__( 'Column content height', 'omniverse' ),
				'devices'          => array(
					'desktop' => array(
						'unit'  => 'px',
						'value' => 300,
					),
					'tablet'  => array(
						'unit'  => 'px',
						'value' => 200,
					),
					'mobile'  => array(
						'unit'  => 'px',
						'value' => 100,
					),
				),
				'range'            => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'        => array(
					'{{WRAPPER}}.wd-collapsible-content > .vc_column-inner' => array(
						'max-height: {{VALUE}}{{UNIT}};',
					),
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'dependency'       => array(
					'element' => 'wd_collapsible_content_switcher',
					'value'   => array( 'yes' ),
				),
			),
			array(
				'type'       => 'wd_colorpicker',
				'param_name' => 'wd_collapsible_content_fade_out_color',
				'heading'    => esc_html__( 'Fade out color', 'omniverse' ),
				'selectors'  => array(
					'{{WRAPPER}}.wd-collapsible-content:not(.wd-opened) > .vc_column-inner > .wpb_wrapper:after' => array(
						'color: {{VALUE}};',
					),
				),
				'default'    => array(
					'value' => '#fff',
				),
				'dependency' => array(
					'element' => 'wd_collapsible_content_switcher',
					'value'   => array( 'yes' ),
				),
			),
			/** Vertical Alignment */
			array(
				'type'             => 'wd_select',
				'heading'          => esc_html__( 'Vertical alignment', 'omniverse' ),
				'param_name'       => 'vertical_alignment',
				'style'            => 'select',
				'selectors'        => array(
					'{{WRAPPER}} > .vc_column-inner > .wpb_wrapper' => array(
						'align-items: {{VALUE}};',
					),
				),
				'devices'          => array(
					'desktop' => array(
						'value' => '',
					),
					'tablet'  => array(
						'value' => '',
					),
					'mobile'  => array(
						'value' => '',
					),
				),
				'value'            => array(
					esc_html__( 'Default', 'omniverse' ) => '',
					esc_html__( 'Top', 'omniverse' )     => 'flex-start',
					esc_html__( 'Middle', 'omniverse' )  => 'center',
					esc_html__( 'Bottom', 'omniverse' )  => 'flex-end',
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			/** Horizontal Alignment */
			array(
				'type'             => 'wd_select',
				'heading'          => esc_html__( 'Horizontal alignment', 'omniverse' ),
				'param_name'       => 'horizontal_alignment',
				'style'            => 'select',
				'selectors'        => array(
					'{{WRAPPER}} > .vc_column-inner > .wpb_wrapper' => array(
						'justify-content: {{VALUE}}',
					),
				),
				'devices'          => array(
					'desktop' => array(
						'value' => '',
					),
					'tablet'  => array(
						'value' => '',
					),
					'mobile'  => array(
						'value' => '',
					),
				),
				'value'            => array(
					esc_html__( 'Default', 'omniverse' ) => '',
					esc_html__( 'Start', 'omniverse' )   => 'flex-start',
					esc_html__( 'Center', 'omniverse' )  => 'center',
					esc_html__( 'End', 'omniverse' )     => 'flex-end',
					esc_html__( 'Space Between', 'omniverse' ) => 'space-between',
					esc_html__( 'Space Around', 'omniverse' ) => 'space-around',
					esc_html__( 'Space Evenly', 'omniverse' ) => 'space-evenly',
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			/** Off canvas column */
			array(
				'type'             => 'dropdown',
				'heading'          => __( 'Column role for "off-canvas layout"', 'omniverse' ),
				'description'      => esc_html__( 'You can create your page layout with an off-canvas sidebar. In this case, you need to have two columns: one will be set as the off-canvas sidebar and another as the content. NOTE: you need to also display the Off-canvas button element somewhere in your content column to open the sidebar. Also, you need to enable them on specific devices synchronously.', 'omniverse' ),
				'param_name'       => 'wd_column_role',
				'value'            => array(
					esc_html__( 'None', 'omniverse' ) => '',
					esc_html__( 'Off canvas column', 'omniverse' ) => 'offcanvas',
					esc_html__( 'Content column', 'omniverse' ) => 'content',
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Desktop', 'omniverse' ),
				'param_name'       => 'wd_column_role_offcanvas_desktop',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'wd_dependency'    => array(
					'element' => 'wd_column_role',
					'value'   => array( 'offcanvas' ),
				),
			),
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Tablet', 'omniverse' ),
				'param_name'       => 'wd_column_role_offcanvas_tablet',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'wd_dependency'    => array(
					'element' => 'wd_column_role',
					'value'   => array( 'offcanvas' ),
				),
			),
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Mobile', 'omniverse' ),
				'param_name'       => 'wd_column_role_offcanvas_mobile',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'wd_dependency'    => array(
					'element' => 'wd_column_role',
					'value'   => array( 'offcanvas' ),
				),
			),
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Desktop', 'omniverse' ),
				'param_name'       => 'wd_column_role_content_desktop',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'wd_dependency'    => array(
					'element' => 'wd_column_role',
					'value'   => array( 'content' ),
				),
			),
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Tablet', 'omniverse' ),
				'param_name'       => 'wd_column_role_content_tablet',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'wd_dependency'    => array(
					'element' => 'wd_column_role',
					'value'   => array( 'content' ),
				),
			),
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Mobile', 'omniverse' ),
				'param_name'       => 'wd_column_role_content_mobile',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'wd_dependency'    => array(
					'element' => 'wd_column_role',
					'value'   => array( 'content' ),
				),
			),
			array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Off canvas alignment', 'omniverse' ),
				'param_name'       => 'wd_off_canvas_alignment',
				'value'            => array(
					esc_html__( 'Left', 'omniverse' )  => 'left',
					esc_html__( 'Right', 'omniverse' ) => 'right',
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
				'dependency'       => array(
					'element' => 'wd_column_role',
					'value'   => array( 'offcanvas' ),
				),
			),
		);

		$design_option = array(
			/**
			 * Background Position Option.
			 */
			array(
				'type'             => 'dropdown',
				'heading'          => esc_html__( 'Background position', 'omniverse' ),
				'param_name'       => 'omniverse_bg_position',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'value'            => array(
					esc_html__( 'None', 'omniverse' )       => '',
					esc_html__( 'Left top', 'omniverse' )   => 'left-top',
					esc_html__( 'Left center', 'omniverse' ) => 'left-center',
					esc_html__( 'Left bottom', 'omniverse' ) => 'left-bottom',
					esc_html__( 'Right top', 'omniverse' )  => 'right-top',
					esc_html__( 'Right center', 'omniverse' ) => 'right-center',
					esc_html__( 'Right bottom', 'omniverse' ) => 'right-bottom',
					esc_html__( 'Center top', 'omniverse' ) => 'center-top',
					esc_html__( 'Center center', 'omniverse' ) => 'center-center',
					esc_html__( 'Center bottom', 'omniverse' ) => 'center-bottom',
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			/**
			 * Responsive Options.
			 */
			array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Disable background image', 'omniverse' ),
				'param_name'       => 'responsive_tabs',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'tabs'             => true,
				'value'            => array(
					esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
					esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
				),
				'default'          => 'tablet',
				'edit_field_class' => 'wd-custom-width vc_col-sm-12 vc_column',
				'dependency'       => array(
					'element' => 'content_width',
					'value'   => array( 'custom' ),
				),
			),
			/**
			 * Hide bg img on mobile.
			 */
			array(
				'type'             => 'omniverse_switch',
				'hint'             => esc_html__( 'Turn on to reset background image on mobile devices', 'omniverse' ),
				'param_name'       => 'mobile_bg_img_hidden',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs',
					'value'   => array( 'mobile' ),
				),
			),
			/**
			 * Hide bg img on tablet.
			 */
			array(
				'type'             => 'omniverse_switch',
				'hint'             => esc_html__( 'Turn on to reset background image on tablet devices', 'omniverse' ),
				'param_name'       => 'tablet_bg_img_hidden',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs',
					'value'   => array( 'tablet' ),
				),
			),
			/**
			 * Parallax Option.
			 */
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Background parallax', 'omniverse' ),
				'param_name'       => 'omniverse_parallax',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'true_state'       => 1,
				'false_state'      => 0,
				'default'          => 0,
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			/**
			 * Box Shadow Option.
			 */
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Box Shadow', 'omniverse' ),
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'param_name'       => 'omniverse_box_shadow',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'wd_box_shadow',
				'param_name'       => 'wd_box_shadow',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'selectors'        => array(
					'{{WRAPPER}} > .vc_column-inner' => array(
						'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
					),
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'dependency'       => array(
					'element' => 'omniverse_box_shadow',
					'value'   => array( 'yes' ),
				),
				'default'          => array(
					'horizontal' => '0',
					'vertical'   => '0',
					'blur'       => '9',
					'spread'     => '0',
					'color'      => 'rgba(0, 0, 0, .15)',
				),
			),
			/**
			 * Responsive Spacing Option.
			 */
			array(
				'type'       => 'omniverse_responsive_spacing',
				'param_name' => 'responsive_spacing',
				'group'      => esc_html__( 'Design Options', 'js_composer' ),
			),
		);

		$responsive_options = array(
			/**
			 * Responsive Options.
			 */
			array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Reset margin (deprecated)', 'omniverse' ),
				'param_name'       => 'responsive_tabs_advanced',
				'group'            => esc_html__( 'Responsive Options', 'omniverse' ),
				'tabs'             => true,
				'value'            => array(
					esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
					esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
				),
				'default'          => 'tablet',
				'edit_field_class' => 'wd-custom-width vc_col-sm-12 vc_column',
				'dependency'       => array(
					'element' => 'content_width',
					'value'   => array( 'custom' ),
				),
			),
			/**
			 * Reset margin (deprecated) on mobile Option.
			 */
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'mobile_reset_margin',
				'group'            => esc_html__( 'Responsive Options', 'omniverse' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs_advanced',
					'value'   => array( 'mobile' ),
				),
			),
			/**
			 * Reset margin (deprecated) on tablet Option.
			 */
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'tablet_reset_margin',
				'group'            => esc_html__( 'Responsive Options', 'omniverse' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs_advanced',
					'value'   => array( 'tablet' ),
				),
			),
		);

		$advanced_options = array(
			/**
			 * Z Index.
			 */
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'wd_z_index',
				'heading'          => esc_html__( 'Z Index', 'omniverse' ),
				'hint'             => esc_html__( 'Enable this option if you would like to display this element above other elements on the page. You can specify a custom value as well.', 'omniverse' ),
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'wd_number',
				'param_name'       => 'wd_z_index_custom',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'devices'          => array(
					'desktop' => array(
						'value' => 35,
					),
				),
				'min'              => -1,
				'max'              => 1000,
				'step'             => 1,
				'selectors'        => array(
					'{{WRAPPER}}' => array(
						'z-index: {{VALUE}}',
					),
				),
				'dependency'       => array(
					'element' => 'wd_z_index',
					'value'   => array( 'yes' ),
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
		);

		vc_add_params( 'vc_column', $general_options );
		vc_add_params( 'vc_column', $design_option );
		vc_add_params( 'vc_column', $responsive_options );
		vc_add_params( 'vc_column', $advanced_options );

		vc_add_params( 'vc_column_inner', $general_options );
		vc_add_params( 'vc_column_inner', $design_option );
		vc_add_params( 'vc_column_inner', $advanced_options );
	}

	add_action( 'vc_before_init', 'omniverse_vc_column_custom_options' );

}

if ( ! function_exists( 'omniverse_vc_section_custom_options' ) ) {
	/**
	 * Update custom params map to Default Section element in WPBakery.
	 *
	 * @throws Exception .
	 */
	function omniverse_vc_section_custom_options() {
		$general_options = array(
			/**
			 * CSS ID Option.
			 */
			array(
				'type'       => 'omniverse_css_id',
				'param_name' => 'omniverse_css_id',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Section stretch CSS', 'omniverse' ),
				'param_name'  => 'omniverse_stretch_content',
				'value'       => array(
					esc_html__( 'Default', 'omniverse' ) => '',
					esc_html__( 'Stretch section', 'omniverse' ) => 'section-stretch',
					esc_html__( 'Stretch section and content', 'omniverse' ) => 'section-stretch-content',
				),
				'description' => esc_html__( 'Enable this option instead of native WPBakery one to stretch section with CSS and not with JS.', 'omniverse' ),
			),
		);

		$design_options = array(
			/**
			 * Responsive Spacing Option.
			 */
			array(
				'type'       => 'omniverse_responsive_spacing',
				'param_name' => 'responsive_spacing',
				'group'      => esc_html__( 'Design Options', 'js_composer' ),
			),
			/**
			 * Background position Option.
			 */
			array(
				'type'             => 'dropdown',
				'heading'          => esc_html__( 'Background position', 'omniverse' ),
				'param_name'       => 'omniverse_bg_position',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'value'            => array(
					esc_html__( 'None', 'omniverse' )       => '',
					esc_html__( 'Left top', 'omniverse' )   => 'left-top',
					esc_html__( 'Left center', 'omniverse' ) => 'left-center',
					esc_html__( 'Left bottom', 'omniverse' ) => 'left-bottom',
					esc_html__( 'Right top', 'omniverse' )  => 'right-top',
					esc_html__( 'Right center', 'omniverse' ) => 'right-center',
					esc_html__( 'Right bottom', 'omniverse' ) => 'right-bottom',
					esc_html__( 'Center top', 'omniverse' ) => 'center-top',
					esc_html__( 'Center center', 'omniverse' ) => 'center-center',
					esc_html__( 'Center bottom', 'omniverse' ) => 'center-bottom',
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			/**
			 * Responsive Options.
			 */
			array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Disable background image', 'omniverse' ),
				'param_name'       => 'responsive_tabs',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'tabs'             => true,
				'value'            => array(
					esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
					esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
				),
				'default'          => 'tablet',
				'edit_field_class' => 'wd-custom-width vc_col-sm-12 vc_column',
			),
			/**
			 * Disable background image on mobile Option.
			 */
			array(
				'type'             => 'omniverse_switch',
				'hint'             => esc_html__( 'Turn on to reset background image on mobile devices', 'omniverse' ),
				'param_name'       => 'mobile_bg_img_hidden',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs',
					'value'   => array( 'mobile' ),
				),
			),
			/**
			 * Disable background image on tablet Option.
			 */
			array(
				'type'             => 'omniverse_switch',
				'hint'             => esc_html__( 'Turn on to reset background image on tablet devices', 'omniverse' ),
				'param_name'       => 'tablet_bg_img_hidden',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs',
					'value'   => array( 'tablet' ),
				),
			),
			/**
			 * Parallax Option.
			 */
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Background parallax', 'omniverse' ),
				'param_name'       => 'omniverse_parallax',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'true_state'       => 1,
				'false_state'      => 0,
				'default'          => 0,
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
		);

		$advanced_options = array(
			/**
			 * Z Index Option.
			 */
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'wd_z_index',
				'heading'          => esc_html__( 'Z Index', 'omniverse' ),
				'hint'             => esc_html__( 'Enable this option if you would like to display this element above other elements on the page. You can specify a custom value as well.', 'omniverse' ),
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'wd_number',
				'param_name'       => 'wd_z_index_custom',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'devices'          => array(
					'desktop' => array(
						'value' => 35,
					),
				),
				'min'              => -1,
				'max'              => 1000,
				'step'             => 1,
				'selectors'        => array(
					'{{WRAPPER}}' => array(
						'z-index: {{VALUE}}',
					),
				),
				'dependency'       => array(
					'element' => 'wd_z_index',
					'value'   => array( 'yes' ),
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			/**
			 * Disable Overflow Option.
			 */
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Disable "overflow:hidden;"', 'omniverse' ),
				'hint'             => esc_html__( 'Use this option if you have some elements inside this row that needs to overflow the boundaries. Examples: mega menu, filters, search with categories dropdowns.', 'omniverse' ),
				'param_name'       => 'omniverse_disable_overflow',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'true_state'       => 1,
				'false_state'      => 0,
				'default'          => 0,
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),

		);

		if ( apply_filters( 'omniverse_gradients_enabled', true ) ) {
			$design_options[] = array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Background gradient', 'omniverse' ),
				'param_name'       => 'omniverse_gradient_switch',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			);

			$design_options[] = array(
				'type'       => 'omniverse_gradient',
				'param_name' => 'omniverse_color_gradient',
				'group'      => esc_html__( 'Design Options', 'js_composer' ),
				'dependency' => array(
					'element' => 'omniverse_gradient_switch',
					'value'   => array( 'yes' ),
				),
			);
		}

		/**
		 * Box Shadow Option.
		 */
		$design_options[] = array(
			'type'             => 'omniverse_switch',
			'heading'          => esc_html__( 'Box Shadow', 'omniverse' ),
			'group'            => esc_html__( 'Design Options', 'js_composer' ),
			'param_name'       => 'omniverse_box_shadow',
			'true_state'       => 'yes',
			'false_state'      => 'no',
			'default'          => 'no',
			'edit_field_class' => 'vc_col-sm-12 vc_column',
		);
		$design_options[] = array(
			'type'             => 'wd_box_shadow',
			'param_name'       => 'wd_box_shadow',
			'group'            => esc_html__( 'Design Options', 'js_composer' ),
			'selectors'        => array(
				'{{WRAPPER}}' => array(
					'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
				),
			),
			'edit_field_class' => 'vc_col-sm-12 vc_column',
			'dependency'       => array(
				'element' => 'omniverse_box_shadow',
				'value'   => array( 'yes' ),
			),
			'default'          => array(
				'horizontal' => '0',
				'vertical'   => '0',
				'blur'       => '9',
				'spread'     => '0',
				'color'      => 'rgba(0, 0, 0, .15)',
			),
		);

		vc_add_params( 'vc_section', $general_options );
		vc_add_params( 'vc_section', $design_options );
		vc_add_params( 'vc_section', $advanced_options );
	}

	add_action( 'vc_before_init', 'omniverse_vc_section_custom_options' );
}

if ( ! function_exists( 'omniverse_vc_empty_space_custom_options' ) ) {
	/**
	 * Update custom params map to Default Empty Space element in WPBakery.
	 *
	 * @throws Exception .
	 */
	function omniverse_vc_empty_space_custom_options() {
		$advanced_options = array(
			/**
			 * Hide empty space Options.
			 */
			array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Hide empty space', 'omniverse' ),
				'param_name'       => 'responsive_tabs',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'tabs'             => true,
				'value'            => array(
					esc_html__( 'Large', 'omniverse' )  => 'large',
					esc_html__( 'Medium', 'omniverse' ) => 'medium',
					esc_html__( 'Small', 'omniverse' )  => 'small',
				),
				'default'          => 'large',
				'edit_field_class' => 'wd-custom-width vc_col-sm-12 vc_column',
			),
			/**
			 * Hide on large.
			 */
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'omniverse_hide_large',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'true_state'       => 1,
				'false_state'      => 0,
				'default'          => 0,
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs',
					'value'   => array( 'large' ),
				),
			),
			/**
			 * Hide on medium.
			 */
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'omniverse_hide_medium',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'true_state'       => 1,
				'false_state'      => 0,
				'default'          => 0,
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs',
					'value'   => array( 'medium' ),
				),
			),
			/**
			 * Hide on small.
			 */
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'omniverse_hide_small',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'true_state'       => 1,
				'false_state'      => 0,
				'default'          => 0,
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs',
					'value'   => array( 'small' ),
				),
			),
		);

		vc_add_params( 'vc_empty_space', $advanced_options );
	}

	add_action( 'vc_before_init', 'omniverse_vc_empty_space_custom_options' );
}

if ( ! function_exists( 'omniverse_vc_row_custom_options' ) ) {
	/**
	 * Update custom params map to Default Row element in WPBakery.
	 *
	 * @throws Exception .
	 */
	function omniverse_vc_row_custom_options() {
		$general_options = array(
			/**
			 * CSS ID Option.
			 */
			array(
				'type'       => 'omniverse_css_id',
				'param_name' => 'omniverse_css_id',
			),
			array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Row stretch CSS', 'omniverse' ),
				'param_name'  => 'omniverse_stretch_content',
				'value'       => array(
					esc_html__( 'Default', 'omniverse' ) => '',
					esc_html__( 'Stretch row', 'omniverse' ) => 'section-stretch',
					esc_html__( 'Stretch row and content', 'omniverse' ) => 'section-stretch-content',
					esc_html__( 'Stretch row and content (no paddings)', 'omniverse' ) => 'section-stretch-content-no-pd',
				),
				'description' => esc_html__( 'Enable this option instead of native WPBakery one to stretch row with CSS and not with JS.', 'omniverse' ),
			),
		);

		$general_options_inner = array(
			/**
			 * CSS ID Option.
			 */
			array(
				'type'       => 'omniverse_css_id',
				'param_name' => 'omniverse_css_id',
			),
		);

		$design_options = array(
			/**
			 * Responsive Spacing Option.
			 */
			array(
				'type'       => 'omniverse_responsive_spacing',
				'param_name' => 'responsive_spacing',
				'group'      => esc_html__( 'Design Options', 'js_composer' ),
			),
			/**
			 * Background Position Option.
			 */
			array(
				'type'             => 'dropdown',
				'heading'          => esc_html__( 'Background position', 'omniverse' ),
				'param_name'       => 'omniverse_bg_position',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'value'            => array(
					esc_html__( 'None', 'omniverse' )       => '',
					esc_html__( 'Left top', 'omniverse' )   => 'left-top',
					esc_html__( 'Left center', 'omniverse' ) => 'left-center',
					esc_html__( 'Left bottom', 'omniverse' ) => 'left-bottom',
					esc_html__( 'Right top', 'omniverse' )  => 'right-top',
					esc_html__( 'Right center', 'omniverse' ) => 'right-center',
					esc_html__( 'Right bottom', 'omniverse' ) => 'right-bottom',
					esc_html__( 'Center top', 'omniverse' ) => 'center-top',
					esc_html__( 'Center center', 'omniverse' ) => 'center-center',
					esc_html__( 'Center bottom', 'omniverse' ) => 'center-bottom',
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			/**
			 * Responsive Options.
			 */
			array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Disable background image', 'omniverse' ),
				'param_name'       => 'responsive_tabs',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'tabs'             => true,
				'value'            => array(
					esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
					esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
				),
				'default'          => 'tablet',
				'edit_field_class' => 'wd-custom-width vc_col-sm-12 vc_column',
			),
			/**
			 * Disable background image on mobile Option.
			 */
			array(
				'type'             => 'omniverse_switch',
				'hint'             => esc_html__( 'Turn on to reset background image on mobile devices', 'omniverse' ),
				'param_name'       => 'mobile_bg_img_hidden',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs',
					'value'   => array( 'mobile' ),
				),
			),
			/**
			 * Disable background image on tablet Option.
			 */
			array(
				'type'             => 'omniverse_switch',
				'hint'             => esc_html__( 'Turn on to reset background image on tablet devices', 'omniverse' ),
				'param_name'       => 'tablet_bg_img_hidden',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs',
					'value'   => array( 'tablet' ),
				),
			),
			/**
			 * Parallax Option.
			 */
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Background parallax', 'omniverse' ),
				'param_name'       => 'omniverse_parallax',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'true_state'       => 1,
				'false_state'      => 0,
				'default'          => 0,
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
		);

		$advanced_options = array(
			/**
			 * Z Index Option.
			 */
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'wd_z_index',
				'heading'          => esc_html__( 'Z Index', 'omniverse' ),
				'hint'             => esc_html__( 'Enable this option if you would like to display this element above other elements on the page. You can specify a custom value as well.', 'omniverse' ),
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			array(
				'type'             => 'wd_number',
				'param_name'       => 'wd_z_index_custom',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'devices'          => array(
					'desktop' => array(
						'value' => 35,
					),
				),
				'min'              => -1,
				'max'              => 1000,
				'step'             => 1,
				'selectors'        => array(
					'{{WRAPPER}}' => array(
						'z-index: {{VALUE}}',
					),
				),
				'dependency'       => array(
					'element' => 'wd_z_index',
					'value'   => array( 'yes' ),
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			/**
			 * Disable overflow.
			 */
			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Disable "overflow:hidden;"', 'omniverse' ),
				'hint'             => esc_html__( 'Use this option if you have some elements inside this row that needs to overflow the boundaries. Examples: mega menu, filters, search with categories dropdowns.', 'omniverse' ),
				'param_name'       => 'omniverse_disable_overflow',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'true_state'       => 1,
				'false_state'      => 0,
				'default'          => 0,
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			/**
			 * Responsive Options.
			 */
			array(
				'type'             => 'omniverse_button_set',
				'heading'          => esc_html__( 'Row reverse', 'omniverse' ),
				'param_name'       => 'responsive_tabs_advanced',
				'hint'             => esc_html__( 'Reverse row columns on mobile and tablet devices.', 'omniverse' ),
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'tabs'             => true,
				'value'            => array(
					esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
					esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
				),
				'default'          => 'tablet',
				'edit_field_class' => 'wd-custom-width vc_col-sm-12 vc_column',
				'dependency'       => array(
					'element' => 'content_width',
					'value'   => array( 'custom' ),
				),
			),
			/**
			 * Row reverse mobile.
			 */
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'row_reverse_mobile',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'true_state'       => 1,
				'false_state'      => 0,
				'default'          => 0,
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs_advanced',
					'value'   => array( 'mobile' ),
				),
			),
			/**
			 * Row reverse tablet.
			 */
			array(
				'type'             => 'omniverse_switch',
				'param_name'       => 'row_reverse_tablet',
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'true_state'       => 1,
				'false_state'      => 0,
				'default'          => 0,
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'wd_dependency'    => array(
					'element' => 'responsive_tabs_advanced',
					'value'   => array( 'tablet' ),
				),
			),
		);

		/**
		 * Gradient option.
		 */
		if ( apply_filters( 'omniverse_gradients_enabled', true ) ) {
			$design_options[] = array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Background gradient', 'omniverse' ),
				'param_name'       => 'omniverse_gradient_switch',
				'group'            => esc_html__( 'Design Options', 'js_composer' ),
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			);

			$design_options[] = array(
				'type'       => 'omniverse_gradient',
				'param_name' => 'omniverse_color_gradient',
				'group'      => esc_html__( 'Design Options', 'js_composer' ),
				'dependency' => array(
					'element' => 'omniverse_gradient_switch',
					'value'   => array( 'yes' ),
				),
			);
		}

		/**
		 * Box Shadow Option.
		 */
		$design_options[] = array(
			'type'             => 'omniverse_switch',
			'heading'          => esc_html__( 'Box Shadow', 'omniverse' ),
			'group'            => esc_html__( 'Design Options', 'js_composer' ),
			'param_name'       => 'omniverse_box_shadow',
			'true_state'       => 'yes',
			'false_state'      => 'no',
			'default'          => 'no',
			'edit_field_class' => 'vc_col-sm-12 vc_column',
		);

		$design_options[] = array(
			'type'             => 'wd_box_shadow',
			'param_name'       => 'wd_box_shadow',
			'group'            => esc_html__( 'Design Options', 'js_composer' ),
			'selectors'        => array(
				'{{WRAPPER}}' => array(
					'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
				),
			),
			'edit_field_class' => 'vc_col-sm-12 vc_column',
			'dependency'       => array(
				'element' => 'omniverse_box_shadow',
				'value'   => array( 'yes' ),
			),
			'default'          => array(
				'horizontal' => '0',
				'vertical'   => '0',
				'blur'       => '9',
				'spread'     => '0',
				'color'      => 'rgba(0, 0, 0, .15)',
			),
		);

		vc_add_params( 'vc_row', $general_options );
		vc_add_params( 'vc_row', $design_options );
		vc_add_params( 'vc_row', $advanced_options );

		vc_add_params( 'vc_row_inner', $general_options_inner );
		vc_add_params( 'vc_row_inner', $design_options );
		vc_add_params( 'vc_row_inner', $advanced_options );
	}

	add_action( 'vc_before_init', 'omniverse_vc_row_custom_options' );
}
