<?php
/**
 * Gallery map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_single_product_gallery' ) ) {
	/**
	 * Gallery map.
	 */
	function omniverse_get_vc_map_single_product_gallery() {
		return array(
			'base'        => 'omniverse_single_product_gallery',
			'name'        => esc_html__( 'Product gallery', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Single product elements', 'omniverse' ), 'single_product' ),
			'description' => esc_html__( 'Featured image and product gallery', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sp-icons/sp-gallery.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),

				array(
					'heading'     => esc_html__( 'Gallery layout', 'omniverse' ),
					'type'        => 'dropdown',
					'param_name'  => 'thumbnails_position',
					'description' => esc_html__( 'Set your thumbnails display or leave default set from Theme Settings.', 'omniverse' ),
					'value'       => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Thumbnails left', 'omniverse' ) => 'left',
						esc_html__( 'Thumbnails bottom', 'omniverse' ) => 'bottom',
						esc_html__( 'Carousel', 'omniverse' ) => 'without',
						esc_html__( 'Grid', 'omniverse' ) => 'bottom_column',
						esc_html__( 'Bottom grid', 'omniverse' ) => 'bottom_grid',
						esc_html__( 'Combined grid 1', 'omniverse' ) => 'bottom_combined',
						esc_html__( 'Combined grid 2', 'omniverse' ) => 'bottom_combined_2',
						esc_html__( 'Combined grid 3', 'omniverse' ) => 'bottom_combined_3',
					),
				),

				array(
					'heading'    => esc_html__( 'Slides per view', 'omniverse' ),
					'type'       => 'wd_select',
					'param_name' => 'slides_per_view',
					'style'      => 'select',
					'selectors'  => array(),
					'devices'    => array(
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
					'value'      => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => '',
						esc_html__( '1', 'omniverse' ) => '1',
						esc_html__( '2', 'omniverse' ) => '2',
						esc_html__( '3', 'omniverse' ) => '3',
						esc_html__( '4', 'omniverse' ) => '4',
						esc_html__( '5', 'omniverse' ) => '5',
						esc_html__( '6', 'omniverse' ) => '6',
					),
					'dependency' => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'without' ),
					),
				),

				array(
					'heading'    => esc_html__( 'Grid columns', 'omniverse' ),
					'type'       => 'wd_select',
					'param_name' => 'grid_columns',
					'style'      => 'select',
					'selectors'  => array(),
					'devices'    => array(
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
					'value'      => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => '',
						esc_html__( '1', 'omniverse' ) => '1',
						esc_html__( '2', 'omniverse' ) => '2',
						esc_html__( '3', 'omniverse' ) => '3',
						esc_html__( '4', 'omniverse' ) => '4',
						esc_html__( '5', 'omniverse' ) => '5',
						esc_html__( '6', 'omniverse' ) => '6',
					),
					'dependency' => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'bottom_column', 'bottom_grid' ),
					),
				),

				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Thumbnails per slide', 'omniverse' ),
					'param_name'       => 'thumbnails_bottom_columns_tabs',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'default'          => 'desktop',
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'bottom', 'left' ),
					),
					'edit_field_class' => 'wd-res-control wd-custom-width vc_col-sm-12 vc_column',
				),

				array(
					'type'          => 'dropdown',
					'param_name'    => 'thumbnails_left_vertical_columns',
					'value'         => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Auto', 'omniverse' ) => 'auto',
						'2'                              => '2',
						'3'                              => '3',
						'4'                              => '4',
						'5'                              => '5',
						'6'                              => '6',
					),
					'std'           => 'inherit',
					'dependency'    => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'left' ),
					),
					'wd_dependency' => array(
						'element' => 'thumbnails_bottom_columns_tabs',
						'value'   => array( 'desktop' ),
					),
				),

				array(
					'type'             => 'dropdown',
					'param_name'       => 'thumbnails_bottom_columns_desktop',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Auto', 'omniverse' ) => 'auto',
						'2'                              => '2',
						'3'                              => '3',
						'4'                              => '4',
						'5'                              => '5',
						'6'                              => '6',
					),
					'std'              => 'inherit',
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'bottom' ),
					),
					'wd_dependency'    => array(
						'element' => 'thumbnails_bottom_columns_tabs',
						'value'   => array( 'desktop' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),

				array(
					'type'             => 'dropdown',
					'param_name'       => 'thumbnails_bottom_columns_tablet',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Auto', 'omniverse' ) => 'auto',
						'2'                              => '2',
						'3'                              => '3',
						'4'                              => '4',
						'5'                              => '5',
						'6'                              => '6',
					),
					'std'              => 'inherit',
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'bottom', 'left' ),
					),
					'wd_dependency'    => array(
						'element' => 'thumbnails_bottom_columns_tabs',
						'value'   => array( 'tablet' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),

				array(
					'type'             => 'dropdown',
					'param_name'       => 'thumbnails_bottom_columns_mobile',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Auto', 'omniverse' ) => 'auto',
						'2'                              => '2',
						'3'                              => '3',
						'4'                              => '4',
						'5'                              => '5',
						'6'                              => '6',
					),
					'std'              => 'inherit',
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'bottom', 'left' ),
					),
					'wd_dependency'    => array(
						'element' => 'thumbnails_bottom_columns_tabs',
						'value'   => array( 'mobile' ),
					),
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
				),

				array(
					'heading'       => esc_html__( 'Gallery gap', 'omniverse' ),
					'type'          => 'wd_slider',
					'param_name'    => 'grid_columns_gap',
					'selectors'     => array(
						'{{WRAPPER}} .woocommerce-product-gallery' => array(
							'--wd-gallery-gap: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'       => array(
						'desktop'         => array(
							'value' => '',
							'unit'  => 'px',
						),
						'tablet_vertical' => array(
							'value' => '',
							'unit'  => 'px',
						),
						'mobile'          => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'         => array(
						'px' => array(
							'min'  => 0,
							'max'  => 50,
							'step' => 1,
						),
					),
					'generate_zero' => true,
					'dependency'    => array(
						'element'            => 'thumbnails_position',
						'value_not_equal_to' => 'inherit',
					),
				),

				array(
					'heading'          => esc_html__( 'Carousel on tablet', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'carousel_on_tablet',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Enable', 'omniverse' ) => 'enable',
						esc_html__( 'Disable', 'omniverse' ) => 'disable',
					),
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'bottom_column', 'bottom_grid', 'bottom_combined', 'bottom_combined_2', 'bottom_combined_3' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Carousel on mobile', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'carousel_on_mobile',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Enable', 'omniverse' ) => 'enable',
						esc_html__( 'Disable', 'omniverse' ) => 'disable',
					),
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'bottom_column', 'bottom_grid', 'bottom_combined', 'bottom_combined_2', 'bottom_combined_3' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Center mode in main gallery', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'main_gallery_center_mode',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Enable', 'omniverse' ) => 'enable',
						esc_html__( 'Disable', 'omniverse' ) => 'disable',
					),
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'without' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'    => esc_html__( 'Thumbnails position bottom on mobile devices', 'omniverse' ),
					'type'       => 'dropdown',
					'param_name' => 'thumbnails_wrap_in_mobile_devices',
					'value'      => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'On', 'omniverse' )  => 'on',
						esc_html__( 'Off', 'omniverse' ) => 'off',
					),
					'dependency' => array(
						'element' => 'thumbnails_position',
						'value'   => array( 'left' ),
					),
				),

				array(
					'heading'          => esc_html__( 'Thumbnails gallery width', 'omniverse' ),
					'type'             => 'wd_slider',
					'param_name'       => 'thumbnails_left_gallery_width',
					'selectors'        => array(
						'{{WRAPPER}} .woocommerce-product-gallery.thumbs-position-left' => array(
							'--wd-thumbs-width: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'          => array(
						'desktop'         => array(
							'value' => '',
							'unit'  => 'px',
						),
						'tablet_vertical' => array(
							'value' => '',
							'unit'  => 'px',
						),
						'mobile'          => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'            => array(
						'px' => array(
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						),
						'%'  => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					),
					'generate_zero'    => true,
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => 'left',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Thumbnails gallery height', 'omniverse' ),
					'type'             => 'wd_slider',
					'param_name'       => 'thumbnails_left_gallery_geight',
					'selectors'        => array(
						'{{WRAPPER}} .woocommerce-product-gallery.thumbs-position-left' => array(
							'--wd-thumbs-height: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'          => array(
						'desktop'         => array(
							'value' => '',
							'unit'  => 'px',
						),
						'tablet_vertical' => array(
							'value' => '',
							'unit'  => 'px',
						),
						'mobile'          => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'            => array(
						'px' => array(
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						),
					),
					'generate_zero'    => true,
					'dependency'       => array(
						'element' => 'thumbnails_position',
						'value'   => 'left',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Main carousel with pagination', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'pagination_main_gallery',
					'value'            => array(
						esc_html__( 'Inherit from Theme Settings', 'omniverse' ) => 'inherit',
						esc_html__( 'Enable', 'omniverse' ) => 'enable',
						esc_html__( 'Disable', 'omniverse' ) => 'disable',
					),
					'dependency'       => array(
						'element'            => 'thumbnails_position',
						'value_not_equal_to' => 'inherit',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
					'type'       => 'css_editor',
					'param_name' => 'css',
				),
				omniverse_get_vc_responsive_spacing_map(),
			),
		);
	}
}

add_filter( 'vc_autocomplete_omniverse_single_product_gallery_product_id_callback', 'omniverse_productIdAutocompleteSuggester_new', 10, 1 );
add_filter( 'vc_autocomplete_omniverse_single_product_gallery_product_id_render', 'omniverse_productIdAutocompleteRender', 10, 1 );
