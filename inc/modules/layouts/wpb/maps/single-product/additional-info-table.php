<?php
/**
 * Additional info table map.
 *
 * @package Omniverse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

if ( ! function_exists( 'omniverse_get_vc_map_single_product_additional_info_table' ) ) {
	/**
	 * Additional info table map.
	 */
	function omniverse_get_vc_map_single_product_additional_info_table() {
		$typography = omniverse_get_typography_map(
			array(
				'key'      => 'title',
				'selector' => '{{WRAPPER}} .title-text',
			)
		);

		$name_typography = omniverse_get_typography_map(
			array(
				'title'         => esc_html__( 'Name typography', 'omniverse' ),
				'group'         => esc_html__( 'Style', 'omniverse' ),
				'key'           => 'attr_name',
				'selector'      => '{{WRAPPER}} .woocommerce-product-attributes-item__label',
				'wd_dependency' => array(
					'element' => 'attributes_style_tabs',
					'value'   => array( 'name' ),
				),
				'dependency'    => array(
					'element' => 'attr_hide_name',
					'value'   => 'no',
				),
			)
		);
		$term_typography = omniverse_get_typography_map(
			array(
				'title'         => esc_html__( 'Term typography', 'omniverse' ),
				'group'         => esc_html__( 'Style', 'omniverse' ),
				'key'           => 'attr_term',
				'selector'      => '{{WRAPPER}} .woocommerce-product-attributes-item__value',
				'wd_dependency' => array(
					'element' => 'attributes_style_tabs',
					'value'   => array( 'term' ),
				),
			)
		);

		return array(
			'base'        => 'omniverse_single_product_additional_info_table',
			'name'        => esc_html__( 'Product additional information table', 'omniverse' ),
			'category'    => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Single product elements', 'omniverse' ), 'single_product' ),
			'description' => esc_html__( 'Attributes, dimensions, and weight', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/sp-icons/sp-additional-information-table.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),

				array(
					'title'      => esc_html__( 'Title', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'title_divider',
				),

				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Element title', 'omniverse' ),
					'param_name' => 'title',
					'holder'     => 'div',
				),

				array(
					'heading'          => esc_html__( 'Color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'title_color',
					'selectors'        => array(
						'{{WRAPPER}} .title-text' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				$typography['font_family'],
				$typography['font_size'],
				$typography['font_weight'],
				$typography['text_transform'],
				$typography['font_style'],
				$typography['line_height'],

				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Icon type', 'omniverse' ),
					'param_name'       => 'icon_type',
					'value'            => array(
						esc_html__( 'Without icon', 'omniverse' ) => 'without',
						esc_html__( 'With icon', 'omniverse' ) => 'icon',
						esc_html__( 'With image', 'omniverse' ) => 'image',
					),
					'std'              => 'without',
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Image', 'omniverse' ),
					'param_name'       => 'image',
					'value'            => '',
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => 'image',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'param_name'       => 'img_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x50 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => 'image',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x50\'.', 'omniverse' ),
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Icon library', 'omniverse' ),
					'param_name'       => 'icon_library',
					'value'            => array(
						esc_html__( 'Font Awesome', 'omniverse' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'omniverse' ) => 'openiconic',
						esc_html__( 'Typicons', 'omniverse' ) => 'typicons',
						esc_html__( 'Entypo', 'omniverse' ) => 'entypo',
						esc_html__( 'Linecons', 'omniverse' ) => 'linecons',
						esc_html__( 'Mono Social', 'omniverse' ) => 'monosocial',
						esc_html__( 'Material', 'omniverse' ) => 'material',
					),
					'hint'             => esc_html__( 'Select icon library.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => 'icon',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_html__( 'Icon', 'omniverse' ),
					'param_name'       => 'icon_fontawesome',
					'value'            => 'far fa-bell',
					'settings'         => array(
						'emptyIcon'    => false,
						'iconsPerPage' => 50,
					),
					'dependency'       => array(
						'element' => 'icon_library',
						'value'   => 'fontawesome',
					),
					'hint'             => esc_html__( 'Select icon from library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_html__( 'Icon', 'omniverse' ),
					'param_name'       => 'icon_openiconic',
					'settings'         => array(
						'emptyIcon'    => false,
						'type'         => 'openiconic',
						'iconsPerPage' => 50,
					),
					'dependency'       => array(
						'element' => 'icon_library',
						'value'   => 'openiconic',
					),
					'hint'             => esc_html__( 'Select icon from library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_html__( 'Icon', 'omniverse' ),
					'param_name'       => 'icon_typicons',
					'settings'         => array(
						'emptyIcon'    => false,
						'type'         => 'typicons',
						'iconsPerPage' => 50,
					),
					'dependency'       => array(
						'element' => 'icon_library',
						'value'   => 'typicons',
					),
					'hint'             => esc_html__( 'Select icon from library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_html__( 'Icon', 'omniverse' ),
					'param_name'       => 'icon_entypo',
					'settings'         => array(
						'emptyIcon'    => false,
						'type'         => 'entypo',
						'iconsPerPage' => 50,
					),
					'dependency'       => array(
						'element' => 'icon_library',
						'value'   => 'entypo',
					),
					'hint'             => esc_html__( 'Select icon from library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_html__( 'Icon', 'omniverse' ),
					'param_name'       => 'icon_linecons',
					'settings'         => array(
						'emptyIcon'    => false,
						'type'         => 'linecons',
						'iconsPerPage' => 50,
					),
					'dependency'       => array(
						'element' => 'icon_library',
						'value'   => 'linecons',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'hint'             => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_html__( 'Icon', 'omniverse' ),
					'param_name'       => 'icon_monosocial',
					'settings'         => array(
						'emptyIcon'    => false,
						'type'         => 'monosocial',
						'iconsPerPage' => 50,
					),
					'dependency'       => array(
						'element' => 'icon_library',
						'value'   => 'monosocial',
					),
					'hint'             => esc_html__( 'Select icon from library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_html__( 'Icon', 'omniverse' ),
					'param_name'       => 'icon_material',
					'settings'         => array(
						'emptyIcon'    => false,
						'type'         => 'material',
						'iconsPerPage' => 50,
					),
					'dependency'       => array(
						'element' => 'icon_library',
						'value'   => 'material',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'hint'             => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'heading'          => esc_html__( 'Icons color', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'icons_color',
					'selectors'        => array(
						'{{WRAPPER}} .title-icon' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'icon' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Icon size', 'omniverse' ),
					'type'             => 'wd_slider',
					'param_name'       => 'icon_size',
					'selectors'        => array(
						'{{WRAPPER}} .title-icon' => array(
							'font-size: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'          => array(
						'desktop' => array(
							'value' => '',
							'unit'  => 'px',
						),
					),
					'range'            => array(
						'px' => array(
							'min'  => 1,
							'max'  => 100,
							'step' => 1,
						),
					),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'icon' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'title'      => esc_html__( 'Data source', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'general_divider',
				),

				array(
					'heading'          => '',
					'type'             => 'omniverse_button_set',
					'param_name'       => 'data_source',
					'value'            => array(
						esc_html__( 'All', 'omniverse' ) => 'all',
						esc_html__( 'Include', 'omniverse' ) => 'include',
						esc_html__( 'Exclude', 'omniverse' )     => 'exclude',
					),
					'default'          => 'all',
					'edit_field_class' => 'vc_col-sm-12 vc_column',
				),

				array(
					'type'       => 'autocomplete',
					'heading'    => esc_html__( 'Include', 'omniverse' ),
					'param_name' => 'include',
					'settings'   => array(
						'multiple'   => true,
						'sortable'   => true,
						'min_length' => 1,
					),
					'dependency' => array(
						'element' => 'data_source',
						'value'   => array( 'include' ),
					),
				),

				array(
					'type'       => 'autocomplete',
					'heading'    => esc_html__( 'Exclude', 'omniverse' ),
					'param_name' => 'exclude',
					'settings'   => array(
						'multiple'   => true,
						'sortable'   => true,
						'min_length' => 1,
					),
					'dependency' => array(
						'element' => 'data_source',
						'value'   => array( 'exclude' ),
					),
				),

				// General.
				array(
					'title'      => esc_html__( 'General', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'general_divider',
				),

				array(
					'heading'          => esc_html__( 'Layout', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'layout',
					'value'            => array(
						esc_html__( 'List', 'omniverse' ) => 'list',
						esc_html__( 'Grid', 'omniverse' ) => 'grid',
						esc_html__( 'Inline', 'omniverse' ) => 'inline',
					),
					'wood_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Style', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'dropdown',
					'param_name'       => 'style',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' )  => 'default',
						esc_html__( 'Bordered', 'omniverse' ) => 'bordered',
					),
					'std'              => 'bordered',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'    => esc_html__( 'Columns', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'wd_slider',
					'param_name' => 'columns',
					'selectors'  => array(
						'{{WRAPPER}} .shop_attributes' => array(
							'--wd-attr-col: {{VALUE}};',
						),
					),
					'devices'    => array(
						'desktop' => array(
							'value' => '',
							'unit'  => '-',
						),
						'tablet'  => array(
							'value' => '',
							'unit'  => '-',
						),
						'mobile'  => array(
							'value' => '',
							'unit'  => '-',
						),
					),
					'range'      => array(
						'-' => array(
							'min'  => 1,
							'max'  => 6,
							'step' => 1,
						),
					),
				),

				array(
					'heading'    => esc_html__( 'Vertical spacing', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'wd_slider',
					'param_name' => 'vertical_gap',
					'selectors'  => array(
						'{{WRAPPER}} .shop_attributes' => array(
							'--wd-attr-v-gap: {{VALUE}}{{UNIT}};',
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
							'min'  => 0,
							'max'  => 150,
							'step' => 1,
						),
					),
				),

				array(
					'heading'    => esc_html__( 'Horizontal spacing', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'wd_slider',
					'param_name' => 'horizontal_gap',
					'selectors'  => array(
						'{{WRAPPER}} .shop_attributes' => array(
							'--wd-attr-h-gap: {{VALUE}}{{UNIT}};',
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
							'min'  => 0,
							'max'  => 150,
							'step' => 1,
						),
					),
				),

				// Attributes.
				array(
					'title'      => esc_html__( 'Attributes', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'attributes_divider',
				),

				array(
					'heading'          => esc_html__( 'Hide image', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'attr_hide_image',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'     => esc_html__( 'Image width', 'omniverse' ),
					'group'       => esc_html__( 'Style', 'omniverse' ),
					'description' => esc_html__( 'Attribute image container width', 'omniverse' ),
					'type'        => 'wd_slider',
					'param_name'  => 'image_width',
					'selectors'   => array(
						'{{WRAPPER}} .shop_attributes' => array(
							'--wd-attr-img-width: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'     => array(
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
					'range'       => array(
						'px' => array(
							'min'  => 0,
							'max'  => 300,
							'step' => 1,
						),
					),
					'dependency'  => array(
						'element' => 'attr_hide_image',
						'value'   => array( 'no' ),
					),
				),

				array(
					'type'       => 'omniverse_button_set',
					'heading'    => esc_html__( 'Typography', 'omniverse' ),
					'group'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'attributes_style_tabs',
					'tabs'       => true,
					'value'      => array(
						esc_html__( 'Name', 'omniverse' ) => 'name',
						esc_html__( 'Term', 'omniverse' ) => 'term',
					),
					'default'    => 'name',
				),
				array(
					'heading'          => esc_html__( 'Hide name', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'omniverse_switch',
					'param_name'       => 'attr_hide_name',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'wd_dependency'    => array(
						'element' => 'attributes_style_tabs',
						'value'   => array( 'name' ),
					),
				),

				$name_typography['font_family'],
				$name_typography['font_size'],
				$name_typography['font_weight'],
				$name_typography['text_transform'],
				$name_typography['font_style'],
				$name_typography['line_height'],

				array(
					'heading'          => esc_html__( 'Name color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'attr_name_color',
					'selectors'        => array(
						'{{WRAPPER}} .woocommerce-product-attributes-item__label' => array(
							'color: {{VALUE}};',
						),
					),
					'wd_dependency'    => array(
						'element' => 'attributes_style_tabs',
						'value'   => array( 'name' ),
					),
					'dependency'       => array(
						'element' => 'attr_hide_name',
						'value'   => 'no',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'       => esc_html__( 'Name column width', 'omniverse' ),
					'group'         => esc_html__( 'Style', 'omniverse' ),
					'type'          => 'wd_slider',
					'param_name'    => 'attr_name_column_width',
					'selectors'     => array(
						'{{WRAPPER}} .woocommerce-product-attributes-item__label' => array(
							'width: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'       => array(
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
					'range'         => array(
						'px' => array(
							'min'  => 0,
							'max'  => 300,
							'step' => 1,
						),
						'%'  => array(
							'min'  => 1,
							'max'  => 100,
							'step' => 1,
						),
					),
					'wd_dependency' => array(
						'element' => 'attributes_style_tabs',
						'value'   => array( 'name' ),
					),
					'dependency'    => array(
						'element' => 'layout',
						'value'   => 'inline',
					),
				),

				$term_typography['font_family'],
				$term_typography['font_size'],
				$term_typography['font_weight'],
				$term_typography['text_transform'],
				$term_typography['font_style'],
				$term_typography['line_height'],

				array(
					'heading'          => esc_html__( 'Term color', 'omniverse' ),
					'group'            => esc_html__( 'Style', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'attr_term_color',
					'selectors'        => array(
						'{{WRAPPER}} .woocommerce-product-attributes-item__value' => array(
							'color: {{VALUE}};',
						),
					),
					'wd_dependency'    => array(
						'element' => 'attributes_style_tabs',
						'value'   => array( 'term' ),
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

if ( ! function_exists( 'wd_autocomplete_products_attributes_field_search' ) ) {
	/**
	 * Output search autocomplete results.
	 *
	 * @param string $search Search attribute.
	 *
	 * @return array
	 */
	function wd_autocomplete_products_attributes_field_search( $search ) {
		$data       = array();
		$attributes = omniverse_get_products_attributes();

		if ( $attributes ) {
			foreach ( $attributes as $key => $attribute ) {
				if ( false === strpos( strtolower( $attribute ), strtolower( $search ) ) ) {
					continue;
				}

				$data[] = array(
					'value' => $key,
					'label' => $attribute,
				);
			}
		}

		return $data;
	}

	add_filter( 'vc_autocomplete_omniverse_single_product_additional_info_table_include_callback', 'wd_autocomplete_products_attributes_field_search', 10, 1 );
	add_filter( 'vc_autocomplete_omniverse_single_product_additional_info_table_exclude_callback', 'wd_autocomplete_products_attributes_field_search', 10, 1 );
}

if ( ! function_exists( 'wd_autocomplete_products_attributes_field_render' ) ) {
	/**
	 * Render controls field.
	 *
	 * @param array $value Save value.
	 *
	 * @return array|bool
	 */
	function wd_autocomplete_products_attributes_field_render( $value ) {
		if ( empty( $value['value'] ) ) {
			return false;
		}

		$wc_attributes  = wc_get_attribute_taxonomy_labels();
		$all_attributes = array();

		$all_attributes['weight']     = esc_html__( 'Weight', 'woocommerce' );
		$all_attributes['dimensions'] = esc_html__( 'Dimensions', 'woocommerce' );

		if ( $wc_attributes ) {
			foreach ( $wc_attributes as $key => $attribute ) {
				$all_attributes[ 'pa_' . $key ] = $attribute . ' (pa_' . $key . ')';
			}
		}

		return empty( $all_attributes[ $value['value'] ] ) ? false : array(
			'label' => $all_attributes[ $value['value'] ],
			'value' => $value['value'],
		);
	}

	add_filter( 'vc_autocomplete_omniverse_single_product_additional_info_table_include_render', 'wd_autocomplete_products_attributes_field_render', 10, 1 );
	add_filter( 'vc_autocomplete_omniverse_single_product_additional_info_table_exclude_render', 'wd_autocomplete_products_attributes_field_render', 10, 1 );
}
