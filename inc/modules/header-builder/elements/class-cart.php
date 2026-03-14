<?php
namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 *  Shopping cart widget element
 * ------------------------------------------------------------------------------------------------
 */
class Cart extends Element {

	public function __construct() {
		parent::__construct();

		$this->template_name = 'cart';
	}

	public function map() {
		$this->args = array(
			'type'            => 'cart',
			'title'           => esc_html__( 'Cart', 'omniverse' ),
			'text'            => esc_html__( 'Shopping widget', 'omniverse' ),
			'icon'            => 'dn-i-cart',
			'editable'        => true,
			'container'       => false,
			'edit_on_create'  => true,
			'drag_target_for' => array(),
			'drag_source'     => 'content_element',
			'removable'       => true,
			'addable'         => true,
			'params'          => array(
				'position'            => array(
					'id'      => 'position',
					'title'   => esc_html__( 'Position', 'omniverse' ),
					'type'    => 'selector',
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'General', 'omniverse' ),
					'value'   => 'side',
					'options' => array(
						'side'     => array(
							'value' => 'side',
							'label' => esc_html__( 'Hidden sidebar', 'omniverse' ),
							'hint'  => '<img src="' . OMNIVERSE_TOOLTIP_URL . 'hb_cart_hidden_sidebar.jpg" alt="">',
						),
						'dropdown' => array(
							'value' => 'dropdown',
							'label' => esc_html__( 'Dropdown', 'omniverse' ),
							'hint'  => '<img src="' . OMNIVERSE_TOOLTIP_URL . 'hb_cart_dropdown.jpg" alt="">',
						),
						'without'  => array(
							'value' => 'without',
							'label' => esc_html__( 'Without', 'omniverse' ),
						),
					),
				),
				'bg_overlay'          => array(
					'id'          => 'bg_overlay',
					'title'       => esc_html__( 'Background overlay', 'omniverse' ),
					'hint'        => '<img src="' . OMNIVERSE_TOOLTIP_URL . 'hb_cart_bg_overlay.jpg" alt="">',
					'description' => __( 'Highlight dropdowns by darkening the background behind.', 'omniverse' ),
					'type'        => 'switcher',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'General', 'omniverse' ),
					'value'       => false,
					'requires'    => array(
						'position' => array(
							'comparison' => 'equal',
							'value'      => 'dropdown',
						),
					),

				),
				'design'              => array(
					'id'          => 'design',
					'title'       => esc_html__( 'Display', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'value'       => '',
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
					'description' => esc_html__( 'You can show the icon only or display “Cart” contents info too.', 'omniverse' ),
				),
				'style'               => array(
					'id'      => 'style',
					'title'   => esc_html__( 'Icon design', 'omniverse' ),
					'type'    => 'selector',
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'Icon', 'omniverse' ),
					'value'   => '1',
					'options' => array(
						'1' => array(
							'value' => '1',
							'label' => esc_html__( 'First', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/cart-icons/first.jpg',
						),
						'2' => array(
							'value' => '2',
							'label' => esc_html__( 'Second', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/cart-icons/second.jpg',
						),
						'3' => array(
							'value' => '3',
							'label' => esc_html__( 'Third', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/cart-icons/third.jpg',
						),
						'4' => array(
							'value' => '4',
							'label' => esc_html__( 'Fourth', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/cart-icons/fourth.jpg',
						),
						'5' => array(
							'value' => '5',
							'label' => esc_html__( 'Fifths', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/cart-icons/fifths.jpg',
						),
						'6' => array(
							'value' => '6',
							'label' => esc_html__( 'Sixth', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/cart-icons/six.jpg',
						),
						'7' => array(
							'value' => '7',
							'label' => esc_html__( 'Seventh', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/cart-icons/seventh.jpg',
						),
						'8' => array(
							'value' => '8',
							'label' => esc_html__( 'Eighth', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/cart-icons/eighth.jpg',
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
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/bg-wrap-type/cart-bg-wrap-icon.jpg',
						),
						'icon_and_text' => array(
							'value' => 'icon_and_text',
							'label' => esc_html__( 'Icon and text', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/bg-wrap-type/cart-bg-wrap-icon-and-text.jpg',
						),
					),
					'requires' => array(
						'design' => array(
							'comparison' => 'equal',
							'value'      => 'text',
						),
						'style'  => array(
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
						'style' => array(
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
						'style' => array(
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
						'style' => array(
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
						'style' => array(
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
						'style' => array(
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
						'style' => array(
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
						'style' => array(
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
						'style' => array(
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
					'value'       => 'cart',
					'options'     => array(
						'cart'   => array(
							'value' => 'cart',
							'label' => esc_html__( 'Cart', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/cart-icons/cart.jpg',
						),
						'bag'    => array(
							'value' => 'bag',
							'label' => esc_html__( 'Bag', 'omniverse' ),
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/cart-icons/bag.jpg',
						),
						'custom' => array(
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
			),
		);
	}
}
