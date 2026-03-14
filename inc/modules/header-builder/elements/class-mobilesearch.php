<?php

namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 *  Search icon for mobile devices
 * ------------------------------------------------------------------------------------------------
 */
class Mobilesearch extends Element {

	public function __construct() {
		parent::__construct();
		$this->template_name = 'mobile-search';
	}

	public function map() {
		$this->args = array(
			'type'            => 'mobilesearch',
			'title'           => esc_html__( 'Search', 'omniverse' ),
			'text'            => esc_html__( 'Search form', 'omniverse' ),
			'icon'            => 'dn-i-search',
			'editable'        => true,
			'container'       => false,
			'edit_on_create'  => true,
			'drag_target_for' => array(),
			'drag_source'     => 'content_element',
			'removable'       => true,
			'addable'         => true,
			'mobile'          => true,
			'params'          => array(
				'display'                => array(
					'id'          => 'display',
					'title'       => esc_html__( 'Display', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'value'       => 'icon',
					'options'     => array(
						'icon'          => array(
							'value' => 'icon',
							'label' => esc_html__( 'Icon', 'omniverse' ),
						),
						'full-screen'   => array(
							'value' => 'full-screen',
							'label' => esc_html__( 'Full screen', 'omniverse' ),
						),
						'full-screen-2' => array(
							'value' => 'full-screen-2',
							'label' => esc_html__( 'Full screen 2', 'omniverse' ),
						),
						'form'          => array(
							'value' => 'form',
							'label' => esc_html__( 'Form', 'omniverse' ),
						),
					),
					'description' => esc_html__( 'Display search icon/form in the header in different views.', 'omniverse' ),
				),
				'post_type'              => array(
					'id'       => 'post_type',
					'title'    => esc_html__( 'Search post type', 'omniverse' ),
					'type'     => 'selector',
					'tab'      => esc_html__( 'General', 'omniverse' ),
					'value'    => 'product',
					'options'  => array(
						'product'   => array(
							'value' => 'product',
							'label' => esc_html__( 'Product', 'omniverse' ),
						),
						'post'      => array(
							'value' => 'post',
							'label' => esc_html__( 'Post', 'omniverse' ),
						),
						'portfolio' => array(
							'value' => 'portfolio',
							'label' => esc_html__( 'Portfolio', 'omniverse' ),
						),
						'page'      => array(
							'value' => 'page',
							'label' => esc_html__( 'Page', 'omniverse' ),
						),
						'any'       => array(
							'value' => 'any',
							'label' => esc_html__( 'All post types', 'omniverse' ),
						),
					),
					'requires' => array(
						'display' => array(
							'comparison' => 'not_equals',
							'value'      => 'icon',
						),
					),
				),
				'search_style'           => array(
					'id'       => 'search_style',
					'title'    => esc_html__( 'Search style', 'omniverse' ),
					'type'     => 'selector',
					'tab'      => esc_html__( 'Style', 'omniverse' ),
					'group'    => esc_html__( 'Form', 'omniverse' ),
					'value'    => 'default',
					'options'  => array(
						'default'   => array(
							'value' => 'default',
							'label' => esc_html__( 'Default', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/search/default.jpg',
						),
						'with-bg'   => array(
							'value' => 'with-bg',
							'label' => esc_html__( 'With background', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/search/with-bg.jpg',
						),
						'with-bg-2' => array(
							'value' => 'with-bg-2',
							'label' => esc_html__( 'With background 2', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/search/with-bg-2.jpg',
						),
						'4'         => array(
							'value' => '4',
							'label' => esc_html__( 'Fourth', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/search/fourth.jpg',
						),
					),
					'requires' => array(
						'display' => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen', 'icon' ),
						),
					),
				),
				'form_shape'             => array(
					'id'            => 'form_shape',
					'title'         => esc_html__( 'Form shape', 'omniverse' ),
					'type'          => 'select',
					'tab'           => esc_html__( 'Style', 'omniverse' ),
					'group'         => esc_html__( 'Form', 'omniverse' ),
					'value'         => '',
					'generate_zero' => true,
					'options'       => array(
						''   => array(
							'label' => esc_html__( 'Inherit', 'omniverse' ),
							'value' => '',
						),
						'0'  => array(
							'label' => esc_html__( 'Square', 'omniverse' ),
							'value' => '0',
						),
						'5'  => array(
							'label' => esc_html__( 'Rounded', 'omniverse' ),
							'value' => '5',
						),
						'35' => array(
							'label' => esc_html__( 'Round', 'omniverse' ),
							'value' => '35',
						),
					),
					'selectors'     => array(
						'{{WRAPPER}}' => array(
							'--wd-form-brd-radius: {{VALUE}}px;',
						),
					),
					'requires'      => array(
						'display' => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen', 'icon' ),
						),
					),
				),
				'form_height'            => array(
					'id'        => 'form_height',
					'title'     => esc_html__( 'Form height', 'omniverse' ),
					'type'      => 'slider',
					'tab'       => esc_html__( 'Style', 'omniverse' ),
					'group'     => esc_html__( 'Form', 'omniverse' ),
					'from'      => 30,
					'to'        => 100,
					'value'     => 42,
					'units'     => 'px',
					'selectors' => array(
						'{{WRAPPER}} .searchform' => array(
							'--wd-form-height: {{VALUE}}px;',
						),
					),
					'requires'  => array(
						'display' => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen', 'icon' ),
						),
					),
				),
				'form_color'             => array(
					'id'          => 'form_color',
					'title'       => esc_html__( 'Form text color', 'omniverse' ),
					'type'        => 'color',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Form', 'omniverse' ),
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}}.wd-search-form.wd-header-search-form-mobile .searchform' => array(
							'--wd-form-color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'display' => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen', 'icon' ),
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'form_placeholder_color' => array(
					'id'          => 'form_placeholder_color',
					'title'       => esc_html__( 'Form placeholder color', 'omniverse' ),
					'type'        => 'color',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Form', 'omniverse' ),
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}}.wd-search-form.wd-header-search-form-mobile .searchform' => array(
							'--wd-form-placeholder-color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'display' => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen', 'icon' ),
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'form_brd_color'         => array(
					'id'          => 'form_brd_color',
					'title'       => esc_html__( 'Form border color', 'omniverse' ),
					'type'        => 'color',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Form', 'omniverse' ),
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}}.wd-search-form.wd-header-search-form-mobile .searchform' => array(
							'--wd-form-brd-color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'display' => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen', 'icon' ),
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'form_brd_color_focus'   => array(
					'id'          => 'form_brd_color_focus',
					'title'       => esc_html__( 'Form border color focus', 'omniverse' ),
					'type'        => 'color',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Form', 'omniverse' ),
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}}.wd-search-form.wd-header-search-form-mobile .searchform' => array(
							'--wd-form-brd-color-focus: {{VALUE}};',
						),
					),
					'requires'    => array(
						'display' => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen', 'icon' ),
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'form_bg'                => array(
					'id'          => 'form_bg',
					'title'       => esc_html__( 'Form background color', 'omniverse' ),
					'type'        => 'color',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Form', 'omniverse' ),
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}}.wd-search-form.wd-header-search-form-mobile .searchform' => array(
							'--wd-form-bg: {{VALUE}};',
						),
					),
					'requires'    => array(
						'display' => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen', 'icon' ),
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'style'                  => array(
					'id'          => 'style',
					'title'       => esc_html__( 'Icon display', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'value'       => 'icon',
					'options'     => array(
						'icon' => array(
							'value' => 'icon',
							'label' => esc_html__( 'Icon', 'omniverse' ),
						),
						'text' => array(
							'value' => 'text',
							'label' => esc_html__( 'Icon with text', 'omniverse' ),
						),
					),
					'description' => esc_html__( 'You can show the icon only or display "Search" text too.', 'omniverse' ),
					'requires'    => array(
						'display' => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen-2', 'form' ),
						),
					),
				),
				'icon_design'            => array(
					'id'       => 'icon_design',
					'title'    => esc_html__( 'Icon design', 'omniverse' ),
					'type'     => 'selector',
					'tab'      => esc_html__( 'Style', 'omniverse' ),
					'group'    => esc_html__( 'Icon', 'omniverse' ),
					'value'    => '1',
					'options'  => array(
						'1' => array(
							'value' => '1',
							'label' => esc_html__( 'First', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/search-icons/first.jpg',
						),
						'6' => array(
							'value' => '6',
							'label' => esc_html__( 'Second', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/search-icons/second.jpg',
						),
						'7' => array(
							'value' => '7',
							'label' => esc_html__( 'Third', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/search-icons/third.jpg',
						),
						'8' => array(
							'value' => '8',
							'label' => esc_html__( 'Fourth', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/search-icons/fourth.jpg',
						),
					),
					'requires' => array(
						'display' => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen-2', 'form' ),
						),
					),
				),
				'wrap_type'              => array(
					'id'       => 'wrap_type',
					'title'    => esc_html__( 'Background wrap type', 'omniverse' ),
					'type'     => 'selector',
					'tab'      => esc_html__( 'Style', 'omniverse' ),
					'group'    => esc_html__( 'Icon', 'omniverse' ),
					'value'    => 'icon_only',
					'options'  => array(
						'icon_only'     => array(
							'value' => 'icon_only',
							'label' => esc_html__( 'Icon only', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/bg-wrap-type/search-wrap-icon.jpg',
						),
						'icon_and_text' => array(
							'value' => 'icon_and_text',
							'label' => esc_html__( 'Icon and text', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/bg-wrap-type/search-wrap-icon-and-text.jpg',
						),
					),
					'requires' => array(
						'display'     => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen-2', 'form' ),
						),
						'style'       => array(
							'comparison' => 'equal',
							'value'      => 'text',
						),
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => array( '6', '7' ),
						),
					),
				),
				'color'                  => array(
					'id'          => 'color',
					'title'       => esc_html__( 'Color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'whb-row .{{WRAPPER}}.wd-tools-element .wd-tools-inner, .whb-row .{{WRAPPER}}.wd-tools-element > a > .wd-tools-icon' => array(
							'color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'display'     => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen-2', 'form' ),
						),
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => array( '7', '8' ),
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'hover_color'            => array(
					'id'          => 'hover_color',
					'title'       => esc_html__( 'Hover color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'whb-row .{{WRAPPER}}.wd-tools-element:hover .wd-tools-inner, .whb-row .{{WRAPPER}}.wd-tools-element:hover > a > .wd-tools-icon' => array(
							'color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'display'     => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen-2', 'form' ),
						),
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => array( '7', '8' ),
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'bg_color'               => array(
					'id'          => 'bg_color',
					'title'       => esc_html__( 'Background color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'whb-row .{{WRAPPER}}.wd-tools-element .wd-tools-inner, .whb-row .{{WRAPPER}}.wd-tools-element > a > .wd-tools-icon' => array(
							'background-color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'display'     => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen-2', 'form' ),
						),
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => array( '7', '8' ),
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'bg_hover_color'         => array(
					'id'          => 'bg_hover_color',
					'title'       => esc_html__( 'Hover background color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'whb-row .{{WRAPPER}}.wd-tools-element:hover .wd-tools-inner, .whb-row .{{WRAPPER}}.wd-tools-element:hover > a > .wd-tools-icon' => array(
							'background-color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'display'     => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen-2', 'form' ),
						),
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => array( '7', '8' ),
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_color'             => array(
					'id'          => 'icon_color',
					'title'       => esc_html__( 'Icon color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}}.wd-tools-element.wd-design-8 .wd-tools-icon' => array(
							'color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'display'     => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen-2', 'form' ),
						),
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => '8',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_hover_color'       => array(
					'id'          => 'icon_hover_color',
					'title'       => esc_html__( 'Hover icon color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}}.wd-tools-element.wd-design-8:hover .wd-tools-icon' => array(
							'color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'display'     => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen-2', 'form' ),
						),
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => '8',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_bg_color'          => array(
					'id'          => 'icon_bg_color',
					'title'       => esc_html__( 'Icon background color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}}.wd-tools-element.wd-design-8 .wd-tools-icon' => array(
							'background-color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'display'     => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen-2', 'form' ),
						),
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => '8',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_bg_hover_color'    => array(
					'id'          => 'icon_bg_hover_color',
					'title'       => esc_html__( 'Hover icon background color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}}.wd-tools-element.wd-design-8:hover .wd-tools-icon' => array(
							'background-color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'display'     => array(
							'comparison' => 'not_equal',
							'value'      => array( 'full-screen-2', 'form' ),
						),
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => '8',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_type'              => array(
					'id'          => 'icon_type',
					'title'       => esc_html__( 'Icon type', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'value'       => 'default',
					'options'     => array(
						'default' => array(
							'value' => 'default',
							'label' => esc_html__( 'Default', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/default-icons/search-default.jpg',
						),
						'custom'  => array(
							'value' => 'custom',
							'label' => esc_html__( 'Custom', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/upload.jpg',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'custom_icon'            => array(
					'id'          => 'custom_icon',
					'title'       => esc_html__( 'Upload an image', 'omniverse' ),
					'type'        => 'image',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'value'       => '',
					'description' => '',
					'requires'    => array(
						'icon_type' => array(
							'comparison' => 'equal',
							'value'      => 'custom',
						),
					),
					'extra_class' => 'dn-col-6',
				),
			),
		);
	}
}
