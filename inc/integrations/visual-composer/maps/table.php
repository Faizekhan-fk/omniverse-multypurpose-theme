<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}
/**
 * ------------------------------------------------------------------------------------------------
 * Section table element map
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'omniverse_get_vc_map_table' ) ) {
	function omniverse_get_vc_map_table() {
		return array(
			'name'            => esc_html__( 'Table', 'omniverse' ),
			'base'            => 'omniverse_table',
			'as_parent'       => array( 'only' => 'omniverse_table_row' ),
			'content_element' => true,
			'category'        => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description'     => esc_html__( 'Customizable HTML table', 'omniverse' ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/table.svg',
			'js_view'         => 'VcColumnView',
			'params'          => array(
				array(
					'heading'          => esc_html__( 'Alignment', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_select',
					'param_name'       => 'alignment',
					'style'            => 'images',
					'selectors'        => array(),
					'devices'          => array(
						'desktop' => array(
							'value' => 'left',
						),
					),
					'value'            => array(
						esc_html__( 'Left', 'omniverse' )   => 'left',
						esc_html__( 'Center', 'omniverse' ) => 'center',
						esc_html__( 'Right', 'omniverse' )  => 'right',
					),
					'images'           => array(
						'left'   => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
						'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
						'right'  => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				// Background.
				array(
					'title'      => esc_html__( 'Background', 'omniverse' ),
					'group'      => esc_html__( 'Settings', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'background_divider',
				),

				array(
					'param_name' => 'background_type',
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Background type', 'omniverse' ),
					'group'      => esc_html__( 'Settings', 'omniverse' ),
					'value'      => array(
						esc_html__( 'Body', 'omniverse' ) => 'body',
						__( 'Horizontal even & odd', 'omniverse' )  => 'h_even_odd',
						__( 'Vertical even & odd', 'omniverse' )  => 'v_even_odd',
					),
					'std'        => 'body',
				),

				array(
					'heading'          => esc_html__( 'Body background color', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'body_bg_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-el-table th, {{WRAPPER}} .wd-el-table td' => array(
							'background-color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'background_type',
						'value'   => array( 'body' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Body text color', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'body_text_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-el-table th, {{WRAPPER}} .wd-el-table td' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'background_type',
						'value'   => array( 'body' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Horizontal even background color', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'h_even_bg_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-el-table tr:nth-child(even)' => array(
							'background-color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'background_type',
						'value'   => array( 'h_even_odd' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Horizontal odd background color', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'h_odd_bg_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-el-table tr:nth-child(odd)' => array(
							'background-color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'background_type',
						'value'   => array( 'h_even_odd' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Horizontal even text color', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'h_even_text_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-el-table tr:nth-child(even)' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'background_type',
						'value'   => array( 'h_even_odd' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Horizontal odd text color', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'h_odd_text_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-el-table tr:nth-child(odd)' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'background_type',
						'value'   => array( 'h_even_odd' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Vertical even background color', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'v_even_bg_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-el-table th:nth-child(even), {{WRAPPER}} .wd-el-table td:nth-child(even)' => array(
							'background-color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'background_type',
						'value'   => array( 'v_even_odd' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Vertical odd background color', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'v_odd_bg_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-el-table th:nth-child(odd), {{WRAPPER}} .wd-el-table td:nth-child(odd)' => array(
							'background-color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'background_type',
						'value'   => array( 'v_even_odd' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Vertical even text color', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'v_even_text_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-el-table th:nth-child(even), {{WRAPPER}} .wd-el-table td:nth-child(even)' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'background_type',
						'value'   => array( 'v_even_odd' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Vertical odd text color', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'v_odd_text_color',
					'selectors'        => array(
						'{{WRAPPER}} .wd-el-table th:nth-child(odd), {{WRAPPER}} .wd-el-table td:nth-child(odd)' => array(
							'color: {{VALUE}};',
						),
					),
					'dependency'       => array(
						'element' => 'background_type',
						'value'   => array( 'v_even_odd' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				// Border.
				array(
					'title'      => esc_html__( 'Border', 'omniverse' ),
					'group'      => esc_html__( 'Settings', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'border_divider',
				),

				array(
					'heading'          => esc_html__( 'Border type', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_select',
					'param_name'       => 'border_type',
					'style'            => 'select',
					'selectors'        => array(
						'{{WRAPPER}} th, {{WRAPPER}} td' => array(
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
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Border color', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'border_color',
					'selectors'        => array(
						'{{WRAPPER}} th, {{WRAPPER}} td' => array(
							'border-color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'    => esc_html__( 'Border width', 'omniverse' ),
					'group'      => esc_html__( 'Settings', 'omniverse' ),
					'type'       => 'wd_dimensions',
					'param_name' => 'border_width',
					'selectors'  => array(
						'{{WRAPPER}} th, {{WRAPPER}} td' => array(
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
				),

				// Padding.
				array(
					'title'      => esc_html__( 'Padding', 'omniverse' ),
					'group'      => esc_html__( 'Settings', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'padding_divider',
				),

				array(
					'heading'    => esc_html__( 'Table cell padding', 'omniverse' ),
					'group'      => esc_html__( 'Settings', 'omniverse' ),
					'type'       => 'wd_dimensions',
					'param_name' => 'padding',
					'selectors'  => array(
						'{{WRAPPER}} .wd-el-table th, {{WRAPPER}} .wd-el-table td' => array(
							'padding-top: {{TOP}}px;',
							'padding-right: {{RIGHT}}px;',
							'padding-bottom: {{BOTTOM}}px;',
							'padding-left: {{LEFT}}px;',
						),
					),
					'devices'    => array(
						'desktop' => array(
							'unit' => 'px',
						),
						'tablet'  => array(
							'unit' => 'px',
						),
						'mobile'  => array(
							'unit' => 'px',
						),
					),
					'range'      => array(
						'px' => array(),
					),
				),

				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				omniverse_get_vc_responsive_spacing_map(),

				/**
				 * Advanced Tab.
				 */
				omniverse_get_responsive_dependency_width_map( 'responsive_tabs' ),
				omniverse_get_responsive_dependency_width_map( 'width_desktop' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_desktop' ),
				omniverse_get_responsive_dependency_width_map( 'width_tablet' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_tablet' ),
				omniverse_get_responsive_dependency_width_map( 'width_mobile' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_mobile' ),
			),
			'default_content' => '[omniverse_table_row table_column="%5B%7B%22column_content%22%3A%22Heading%20%231%22%2C%22column_cell_type%22%3A%22heading%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%2C%7B%22column_content%22%3A%22Heading%20%232%22%2C%22column_cell_type%22%3A%22heading%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%2C%7B%22column_content%22%3A%22Heading%20%233%22%2C%22column_cell_type%22%3A%22heading%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%2C%7B%22column_content%22%3A%22Heading%20%234%22%2C%22column_cell_type%22%3A%22heading%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%5D" ][omniverse_table_row table_column="%5B%7B%22column_content%22%3A%22Row%20%231%20Content%20%231%22%2C%22column_cell_type%22%3A%22default%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%2C%7B%22column_content%22%3A%22Row%20%231%20Content%20%232%22%2C%22column_cell_type%22%3A%22default%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%2C%7B%22column_content%22%3A%22Row%20%231%20Content%20%233%22%2C%22column_cell_type%22%3A%22default%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%2C%7B%22column_content%22%3A%22Row%20%231%20Content%20%234%22%2C%22column_cell_type%22%3A%22default%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%5D" ][omniverse_table_row table_column="%5B%7B%22column_content%22%3A%22Row%20%232%20Content%20%231%22%2C%22column_cell_type%22%3A%22default%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%2C%7B%22column_content%22%3A%22Row%20%232%20Content%20%232%22%2C%22column_cell_type%22%3A%22default%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%2C%7B%22column_content%22%3A%22Row%20%232%20Content%20%233%22%2C%22column_cell_type%22%3A%22default%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%2C%7B%22column_content%22%3A%22Row%20%232%20Content%20%234%22%2C%22column_cell_type%22%3A%22default%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%5D" ][omniverse_table_row table_column="%5B%7B%22column_content%22%3A%22Row%20%233%20Content%20%231%22%2C%22column_cell_type%22%3A%22default%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%2C%7B%22column_content%22%3A%22Row%20%233%20Content%20%232%22%2C%22column_cell_type%22%3A%22default%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%2C%7B%22column_content%22%3A%22Row%20%233%20Content%20%233%22%2C%22column_cell_type%22%3A%22default%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%2C%7B%22column_content%22%3A%22Row%20%233%20Content%20%234%22%2C%22column_cell_type%22%3A%22default%22%2C%22column_cell_span%22%3A%221%22%2C%22column_cell_row%22%3A%221%22%7D%5D" ]',
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_table_row' ) ) {
	function omniverse_get_vc_map_table_row() {
		$typography = omniverse_get_typography_map(
			array(
				'key'      => 'table_row',
				'selector' => '{{WRAPPER}} th, {{WRAPPER}} td',
				'group'    => esc_html__( 'Settings', 'omniverse' ),
			)
		);

		return array(
			'name'            => esc_html__( 'Table row', 'omniverse' ),
			'base'            => 'omniverse_table_row',
			'as_child'        => array( 'only' => 'omniverse_table' ),
			'content_element' => true,
			'category'        => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/wpb-table-element-row.svg',
			'params'          => array(
				array(
					'type'       => 'param_group',
					'param_name' => 'table_column',
					'group'      => esc_html__( 'Column', 'omniverse' ),
					'params'     => array(
						array(
							'type'       => 'textarea',
							'heading'    => esc_html__( 'Content', 'omniverse' ),
							'param_name' => 'column_content',
						),
						array(
							'param_name'       => 'column_cell_type',
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Cell Type', 'omniverse' ),
							'value'            => array(
								esc_html__( 'Default', 'omniverse' ) => 'default',
								esc_html__( 'Heading', 'omniverse' ) => 'heading',
							),
							'std'              => 'default',
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'param_name'       => 'row_item_alignment',
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Alignment', 'omniverse' ),
							'value'            => array(
								esc_html__( 'Inherit', 'omniverse' )   => '',
								esc_html__( 'Left', 'omniverse' )   => 'left',
								esc_html__( 'Center', 'omniverse' ) => 'center',
								esc_html__( 'Right', 'omniverse' )  => 'right',
							),
							'std'              => '',
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'heading'          => esc_html__( 'Column Span', 'omniverse' ),
							'param_name'       => 'column_cell_span',
							'type'             => 'textfield',
							'value'            => '1',
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'heading'          => esc_html__( 'Row Span', 'omniverse' ),
							'param_name'       => 'column_cell_row',
							'type'             => 'textfield',
							'value'            => '1',
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'heading'          => esc_html__( 'Color', 'omniverse' ),
							'type'             => 'wd_colorpicker',
							'param_name'       => 'row_item_color',
							'selectors'        => array(),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'heading'          => esc_html__( 'Background color', 'omniverse' ),
							'type'             => 'wd_colorpicker',
							'param_name'       => 'row_item_bg_color',
							'selectors'        => array(),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
					),
				),
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
					'group'      => esc_html__( 'Settings', 'omniverse' ),
				),

				array(
					'title'      => esc_html__( 'General', 'omniverse' ),
					'group'      => esc_html__( 'Settings', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'general_divider',
				),

				$typography['font_family'],
				$typography['font_size'],
				$typography['font_weight'],
				$typography['text_transform'],
				$typography['font_style'],
				$typography['line_height'],

				array(
					'heading'          => esc_html__( 'Color', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'table_row_color',
					'selectors'        => array(
						'{{WRAPPER}} th, {{WRAPPER}} td' => array(
							'color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'heading'          => esc_html__( 'Background color', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'table_row_bg_color',
					'selectors'        => array(
						'{{WRAPPER}}' => array(
							'background-color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				// Border.
				array(
					'title'      => esc_html__( 'Border', 'omniverse' ),
					'group'      => esc_html__( 'Settings', 'omniverse' ),
					'type'       => 'omniverse_title_divider',
					'param_name' => 'border_divider',
				),

				array(
					'heading'          => esc_html__( 'Border type', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_select',
					'param_name'       => 'border_type',
					'style'            => 'select',
					'selectors'        => array(
						'{{WRAPPER}} th, {{WRAPPER}} td' => array(
							'border-style: {{VALUE}};',
						),
					),
					'devices'          => array(
						'desktop' => array(
							'value' => '',
						),
					),
					'value'            => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'None', 'omniverse' )    => 'none',
						esc_html__( 'Solid', 'omniverse' )   => 'solid',
						esc_html__( 'Dotted', 'omniverse' )  => 'dotted',
						esc_html__( 'Double', 'omniverse' )  => 'double',
						esc_html__( 'Dashed', 'omniverse' )  => 'dashed',
						esc_html__( 'Groove', 'omniverse' )  => 'groove',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'          => esc_html__( 'Border color', 'omniverse' ),
					'group'            => esc_html__( 'Settings', 'omniverse' ),
					'type'             => 'wd_colorpicker',
					'param_name'       => 'border_color',
					'selectors'        => array(
						'{{WRAPPER}} th, {{WRAPPER}} td' => array(
							'border-color: {{VALUE}};',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),

				array(
					'heading'    => esc_html__( 'Border width', 'omniverse' ),
					'group'      => esc_html__( 'Settings', 'omniverse' ),
					'type'       => 'wd_dimensions',
					'param_name' => 'border_width',
					'selectors'  => array(
						'{{WRAPPER}} th, {{WRAPPER}} td' => array(
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
				),
			),
		);
	}
}

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_omniverse_table extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_omniverse_table_row extends WPBakeryShortCode {}
}
