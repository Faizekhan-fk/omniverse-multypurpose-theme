<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
* Pricing tables elements map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_pricing_tables' ) ) {
	function omniverse_get_vc_map_pricing_tables() {
		return array(
			'name' => esc_html__( 'Pricing tables', 'omniverse' ),
			'base' => 'pricing_tables',
			'as_parent' => array( 'only' => 'pricing_plan' ),
			'content_element' => true,
			'show_settings_on_create' => false,
			'category' => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Show your pricing plans', 'omniverse' ),
			'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/pricing-tables.svg',
			'params' => array(
				array(
					'param_name' => 'omniverse_css_id',
					'type'       => 'omniverse_css_id',
				),
				array(
					'type'       => 'omniverse_title_divider',
					'title'      => esc_html__( 'General', 'omniverse' ),
					'param_name' => 'title_style_section',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Display grid', 'omniverse' ),
					'param_name'       => 'display_grid',
					'value'            => array(
						esc_html__( 'Stretch', 'omniverse' ) => 'stretch',
						esc_html__( 'Number', 'omniverse' ) => 'number',
					),
					'std'              => 'stretch',
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'wd_slider',
					'heading'          => esc_html__( 'Columns', 'omniverse' ),
					'param_name'       => 'display_grid_col',
					'selectors'        => array(),
					'devices'          => array(
						'desktop' => array(
							'unit'  => '-',
							'value' => 3,
						),
						'tablet'  => array(
							'unit' => '-',
						),
						'mobile'  => array(
							'unit' => '-',
						),
					),
					'range'            => array(
						'-' => array(
							'min'  => 1,
							'max'  => 12,
							'step' => 1,
						),
					),
					'dependency'       => array(
						'element' => 'display_grid',
						'value'   => array( 'number' ),
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'wd_select',
					'heading'          => esc_html__( 'Space between', 'omniverse' ),
					'param_name'       => 'space_between',
					'style'            => 'select',
					'selectors'        => array(),
					'devices'          => array(
						'desktop' => array(
							'value' => '20',
						),
						'tablet'  => array(
							'value' => '',
						),
						'mobile'  => array(
							'value' => '',
						),
					),
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( '0 px', 'omniverse' )  => '0',
						esc_html__( '2 px', 'omniverse' )  => '2',
						esc_html__( '6 px', 'omniverse' )  => '6',
						esc_html__( '10 px', 'omniverse' ) => '10',
						esc_html__( '20 px', 'omniverse' ) => '20',
						esc_html__( '30 px', 'omniverse' ) => '30',
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'       => 'omniverse_title_divider',
					'title'      => esc_html__( 'Extra', 'omniverse' ),
					'param_name' => 'extra_style_section',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				omniverse_get_vc_responsive_spacing_map(),
			),
			'js_view' => 'VcColumnView'
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_pricing_plan' ) ) {
	function omniverse_get_vc_map_pricing_plan() {
		return array(
			'name' => esc_html__( 'Price plan', 'omniverse' ),
			'base' => 'pricing_plan',
			'as_child' => array( 'only' => 'pricing_tables' ),
			'content_element' => true,
			'category' => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Price option', 'omniverse' ),
			'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/price-plan.svg',
			'params' => array(
				/**
				 * Content
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Content', 'omniverse' ),
					'param_name' => 'content_divider'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Pricing plan name', 'omniverse' ),
					'param_name' => 'name',
				),
				array(
					'type' => 'textarea',
					'heading' => esc_html__( 'Featured list', 'omniverse' ),
					'param_name' => 'features_list',
					'hint' => esc_html__( 'Start each feature text from a new line', 'omniverse' ),
				),
				/**
				 * Pricing
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Pricing', 'omniverse' ),
					'param_name' => 'pricing_divider'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Price value', 'omniverse' ),
					'param_name' => 'price_value',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Price suffix', 'omniverse' ),
					'param_name' => 'price_suffix',
					'value' => 'per month',
					'hint' => esc_html__( 'For example: per month', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Price currency', 'omniverse' ),
					'param_name' => 'currency',
					'hint' => esc_html__( 'For example: $', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Button
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'button_divider'
				),
				array(
					'type' => 'omniverse_button_set',
					'heading' => esc_html__( 'Button type', 'omniverse' ),
					'param_name' => 'button_type',
					'value' => array(
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
						esc_html__( 'Product add to cart', 'omniverse' ) => 'product'
					),
					'hint' => esc_html__( 'Set your custom link for button or allow users to add some product to cart', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button label', 'omniverse' ),
					'param_name' => 'button_label',
					'value' => '',
					'dependency' => array(
						'element' => 'button_type',
						'value' => array( 'custom' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'vc_link',
					'heading' => esc_html__( 'Button link', 'omniverse'),
					'param_name' => 'link',
					'hint' => esc_html__( 'Enter URL if you want this box to have a link.', 'omniverse' ),
					'dependency' => array(
						'element' => 'button_type',
						'value' => array( 'custom' )
					),
					'edit_field_class' => 'vc_col-xs-12 vc_column',
				),
				array(
					'type' => 'autocomplete',
					'heading' => esc_html__( 'Select identificator', 'omniverse' ),
					'param_name' => 'id',
					'hint' => esc_html__( 'Input product ID or product SKU or product title to see suggestions', 'omniverse' ),
					'dependency' => array(
						'element' => 'button_type',
						'value' => array( 'product' )
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Label
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Label', 'omniverse' ),
					'param_name' => 'label_divider',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Label text', 'omniverse' ),
					'param_name' => 'label',
					'hint' => esc_html__( 'For example: Best option!', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_dropdown',
					'heading' => esc_html__( 'Label color', 'omniverse' ),
					'param_name' => 'label_color',
					'value' => array(
						'' => '',
						esc_html__( 'Red', 'omniverse' ) => 'red',
						esc_html__( 'Green', 'omniverse' ) => 'green',
						esc_html__( 'Blue', 'omniverse' ) => 'blue',
						esc_html__( 'Yellow', 'omniverse' ) => 'yellow',
					),
					'style' => array(
						'red' => '#EF4836',
						'green' => '#0fa34c',
						'blue' => '#2a7ce4',
						'yellow' => '#F7CA18',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Style
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'style_divider'
				),
				array(
					'type' => 'omniverse_image_select',
					'heading' => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'style',
					'value' => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Alternative', 'omniverse' ) => 'alt'
					),
					'images_value' => array(
						'default' => OMNIVERSE_ASSETS_IMAGES . '/settings/pricing-table/default.png',
						'alt' => OMNIVERSE_ASSETS_IMAGES . '/settings/pricing-table/alt.png',
					),
					'omni_tooltip' => true,
					'std' => 'default',
					'edit_field_class' => 'vc_col-sm-6 vc_column price-plan',
				),
				array(
					'type' => 'omniverse_switch',
					'heading' => esc_html__( 'Best option', 'omniverse' ),
					'param_name' => 'best_option',
					'hint' => esc_html__( 'Highlight this price plan as best value with extra styles.', 'omniverse' ),
					'true_state' => 'yes',
					'false_state' => 'no',
					'default' => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_switch',
					'heading' => esc_html__( 'With background image', 'omniverse' ),
					'param_name' => 'with_bg_image',
					'true_state' => 'yes',
					'false_state' => 'no',
					'default' => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image', 'omniverse' ),
					'param_name' => 'bg_image',
					'value' => '',
					'hint' => esc_html__( 'Select image from media library.', 'omniverse' ),
					'dependency' => array(
						'element' => 'with_bg_image',
						'value' => array( 'yes' ),
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
				)
			)
		);
	}
}

// Necessary hooks for blog autocomplete fields
add_filter( 'vc_autocomplete_pricing_plan_id_callback',	'vc_include_field_search', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_pricing_plan_id_render', 'vc_include_field_render', 10, 1 ); // Render exact product. Must return an array (label,value)

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if( class_exists( 'WPBakeryShortCodesContainer' ) ){
    class WPBakeryShortCode_pricing_tables extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if( class_exists( 'WPBakeryShortCode' ) ){
    class WPBakeryShortCode_pricing_plan extends WPBakeryShortCode {

    }
}
