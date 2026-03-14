<?php
namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 *  Secondary menu element
 * ------------------------------------------------------------------------------------------------
 */
class Menu extends Element {

	public function __construct() {
		parent::__construct();
		$this->template_name = 'menu';
	}

	public function map() {
		$this->args = array(
			'type'            => 'menu',
			'title'           => esc_html__( 'Menu', 'omniverse' ),
			'text'            => esc_html__( 'Secondary menu', 'omniverse' ),
			'icon'            => 'dn-i-menu',
			'editable'        => true,
			'container'       => false,
			'drg'             => false,
			'drag_target_for' => array(),
			'drag_source'     => 'content_element',
			'edit_on_create'  => true,
			'removable'       => true,
			'addable'         => true,
			'params'          => array(
				'menu_id'    => array(
					'id'          => 'menu_id',
					'title'       => esc_html__( 'Choose menu', 'omniverse' ),
					'type'        => 'select',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'value'       => '',
					'callback'    => 'get_menu_options_with_empty',
					'description' => esc_html__( 'Choose which menu to display in the header.', 'omniverse' ),
				),
				'menu_style' => array(
					'id'          => 'menu_style',
					'title'       => esc_html__( 'Style', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Menu', 'omniverse' ),
					'value'       => 'default',
					'options'     => array(
						'default'   => array(
							'value' => 'default',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/menu-style/default.jpg',
							'label' => esc_html__( 'Default', 'omniverse' ),
						),
						'underline' => array(
							'value' => 'underline',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/menu-style/underline.jpg',
							'label' => esc_html__( 'Underline', 'omniverse' ),
						),
						'bordered'  => array(
							'value' => 'bordered',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/menu-style/bordered.jpg',
							'label' => esc_html__( 'Bordered', 'omniverse' ),
						),
						'separated' => array(
							'value' => 'separated',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/menu-style/separated.jpg',
							'label' => esc_html__( 'Separated', 'omniverse' ),
						),
						'bg'        => array(
							'value' => 'bg',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/header-builder/menu-style/background.jpg',
							'label' => esc_html__( 'Background', 'omniverse' ),
						),
					),
					'description' => esc_html__( 'You can change menu style in the header.', 'omniverse' ),
				),
				'menu_align' => array(
					'id'          => 'menu_align',
					'title'       => esc_html__( 'Menu align', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Menu', 'omniverse' ),
					'value'       => 'left',
					'options'     => array(
						'left'   => array(
							'value' => 'left',
							'label' => esc_html__( 'Left', 'omniverse' ),
						),
						'center' => array(
							'value' => 'center',
							'label' => esc_html__( 'Center', 'omniverse' ),
						),
						'right'  => array(
							'value' => 'right',
							'label' => esc_html__( 'Right', 'omniverse' ),
						),
					),
					'description' => esc_html__( 'Set the menu items text align.', 'omniverse' ),
				),
				'items_gap'  => array(
					'id'          => 'items_gap',
					'title'       => esc_html__( 'Items gap', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Menu', 'omniverse' ),
					'value'       => 's',
					'options'     => array(
						's' => array(
							'value' => 's',
							'label' => esc_html__( 'Small', 'omniverse' ),
						),
						'm' => array(
							'value' => 'm',
							'label' => esc_html__( 'Medium', 'omniverse' ),
						),
						'l' => array(
							'value' => 'l',
							'label' => esc_html__( 'Large', 'omniverse' ),
						),
					),
					'description' => esc_html__( 'Set the items gap.', 'omniverse' ),
				),
				'bg_overlay' => array(
					'id'          => 'bg_overlay',
					'title'       => esc_html__( 'Background overlay', 'omniverse' ),
					'hint'        => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_bg_overlay.mp4" autoplay loop muted></video>',
					'description' => __( 'Highlight dropdowns by darkening the background behind.', 'omniverse' ),
					'type'        => 'switcher',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Menu', 'omniverse' ),
					'value'       => false,
				),
				'inline'     => array(
					'id'          => 'inline',
					'title'       => esc_html__( 'Display inline', 'omniverse' ),
					'type'        => 'switcher',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Menu', 'omniverse' ),
					'value'       => false,
					'description' => esc_html__( 'The width of the element will depend on its content', 'omniverse' ),
				),
			),
		);
	}
}
