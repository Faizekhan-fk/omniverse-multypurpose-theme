<?php

namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 *  Wishlist icon in the header elements
 * ------------------------------------------------------------------------------------------------
 */
class Wishlist extends Element {

	public function __construct() {
		parent::__construct();
		$this->template_name = 'wishlist';
	}

	public function map() {
		$this->args = array(
			'type'            => 'wishlist',
			'title'           => esc_html__( 'Wishlist', 'omniverse' ),
			'text'            => esc_html__( 'Wishlist icon', 'omniverse' ),
			'icon'            => 'dn-i-heart',
			'editable'        => true,
			'container'       => false,
			'edit_on_create'  => true,
			'drag_target_for' => array(),
			'drag_source'     => 'content_element',
			'removable'       => true,
			'addable'         => true,
			'params'          => array(
				'design'              => array(
					'id'          => 'design',
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
					'description' => esc_html__( 'You can show the icon only or display "Wishlist" text too.', 'omniverse' ),
				),
				'icon_design'         => array(
					'id'      => 'icon_design',
					'title'   => esc_html__( 'Icon design', 'omniverse' ),
					'type'    => 'selector',
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'Icon', 'omniverse' ),
					'value'   => '2',
					'options' => array(
						'1' => array(
							'value' => '1',
							'label' => esc_html__( 'First', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/wishlist-icons/first.jpg',
						),
						'2' => array(
							'value' => '2',
							'label' => esc_html__( 'Second', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/wishlist-icons/second.jpg',
						),
						'4' => array(
							'value' => '4',
							'label' => esc_html__( 'Third', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/wishlist-icons/third.jpg',
						),
						'6' => array(
							'value' => '6',
							'label' => esc_html__( 'Fourth', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/wishlist-icons/fourth.jpg',
						),
						'7' => array(
							'value' => '7',
							'label' => esc_html__( 'Fifth', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/wishlist-icons/fifth.jpg',
						),
						'8' => array(
							'value' => '8',
							'label' => esc_html__( 'Sixth', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/wishlist-icons/sixth.jpg',
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
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/bg-wrap-type/wishlist-wrap-icon.jpg',
						),
						'icon_and_text' => array(
							'value' => 'icon_and_text',
							'label' => esc_html__( 'Icon and text', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/bg-wrap-type/wishlist-wrap-icon-and-text.jpg',
						),
					),
					'requires' => array(
						'design'      => array(
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
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/default-icons/wishlist-default.jpg',
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
				'hide_product_count'  => array(
					'id'          => 'hide_product_count',
					'title'       => esc_html__( 'Hide product count label', 'omniverse' ),
					'hint'        => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_wishlist_hide_product_count.mp4" autoplay loop muted></video>',
					'type'        => 'switcher',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Extra', 'omniverse' ),
					'value'       => false,
					'description' => esc_html__( 'Mark this option if you want to hide product count label.', 'omniverse' ),
				),
			),
		);
	}
}
