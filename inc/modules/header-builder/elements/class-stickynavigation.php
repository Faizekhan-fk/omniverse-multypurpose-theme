<?php

namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 * Sticky navigation element
 * ------------------------------------------------------------------------------------------------
 */
class Stickynavigation extends Element {

	public function __construct() {
		parent::__construct();
		$this->template_name = 'sticky-navigation';
	}

	public function map() {
		$this->args = array(
			'type'            => 'stickynavigation',
			'title'           => esc_html__( 'Sticky navigation', 'omniverse' ),
			'text'            => esc_html__( 'Navigation opener', 'omniverse' ),
			'icon'            => 'dn-i-sticky-nav',
			'editable'        => true,
			'container'       => false,
			'edit_on_create'  => true,
			'drag_target_for' => array(),
			'drag_source'     => 'content_element',
			'desktop'         => true,
			'removable'       => true,
			'addable'         => true,
			'params'          => array(
				'sticky_notice'       => array(
					'id'          => 'sticky_notice',
					'description' => esc_html__( 'Before using this element, make sure that you have configured the sticky navigation menu via options located in Theme Options - Genaral - Sticky navigation.', 'omniverse' ),
					'type'        => 'notice',
					'style'       => 'info',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'value'       => '',
				),
				'style'               => array(
					'id'          => 'style',
					'title'       => esc_html__( 'Display', 'omniverse' ),
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
					'description' => esc_html__( 'You can show the icon only or display "Menu" text too.', 'omniverse' ),
				),
				'title'               => array(
					'id'          => 'title',
					'title'       => esc_html__( 'Icon text', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'value'       => '',
					'description' => esc_html__( 'Specify your custom text for this menu or leave it empty to keep "Menu".', 'omniverse' ),
					'requires'    => array(
						'style' => array(
							'comparison' => 'equal',
							'value'      => 'text',
						),
					),
				),
				'icon_design'         => array(
					'id'      => 'icon_design',
					'title'   => esc_html__( 'Icon design', 'omniverse' ),
					'type'    => 'selector',
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'Icon', 'omniverse' ),
					'value'   => '1',
					'options' => array(
						'1' => array(
							'value' => '1',
							'label' => esc_html__( 'First', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/mobile-menu-icons/first.jpg',
						),
						'6' => array(
							'value' => '6',
							'label' => esc_html__( 'Second', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/mobile-menu-icons/second.jpg',
						),
						'7' => array(
							'value' => '7',
							'label' => esc_html__( 'Third', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/mobile-menu-icons/third.jpg',
						),
						'8' => array(
							'value' => '8',
							'label' => esc_html__( 'Fourth', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/mobile-menu-icons/fourth.jpg',
						),
					),
				),
				'wrap_type'           => array(
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
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/bg-wrap-type/menu-wrap-icon.jpg',
						),
						'icon_and_text' => array(
							'value' => 'icon_and_text',
							'label' => esc_html__( 'Icon and text', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/bg-wrap-type/menu-wrap-icon-and-text.jpg',
						),
					),
					'requires' => array(
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
				'color'               => array(
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
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => array( '7', '8' ),
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'hover_color'         => array(
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
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => array( '7', '8' ),
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'bg_color'            => array(
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
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => array( '7', '8' ),
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'bg_hover_color'      => array(
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
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => array( '7', '8' ),
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_color'          => array(
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
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => '8',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_hover_color'    => array(
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
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => '8',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_bg_color'       => array(
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
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => '8',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_bg_hover_color' => array(
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
						'icon_design' => array(
							'comparison' => 'equal',
							'value'      => '8',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_type'           => array(
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
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/default-icons/burger-default.jpg',
						),
						'custom'  => array(
							'value' => 'custom',
							'label' => esc_html__( 'Custom', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/upload.jpg',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'custom_icon'         => array(
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
				'mouse_event'         => array(
					'id'          => 'mouse_event',
					'title'       => esc_html__( 'Open on mouse event', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Extra', 'omniverse' ),
					'type'        => 'selector',
					'options'     => array(
						'click' => array(
							'value' => 'click',
							'label' => esc_html__( 'Click', 'omniverse' ),
						),
						'hover' => array(
							'value' => 'hover',
							'label' => esc_html__( 'Hover', 'omniverse' ),
						),
					),
					'value'       => 'click',
					'extra_class' => 'dn-col-6',
				),
				'close_menu_mouseout' => array(
					'id'          => 'close_menu_mouseout',
					'title'       => esc_html__( 'Close menu on mouse leave', 'omniverse' ),
					'type'        => 'switcher',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Extra', 'omniverse' ),
					'value'       => false,
					'requires'    => array(
						'mouse_event' => array(
							'comparison' => 'equal',
							'value'      => 'click',
						),
					),
					'extra_class' => 'dn-col-6',
				),
			),
		);
	}
}
