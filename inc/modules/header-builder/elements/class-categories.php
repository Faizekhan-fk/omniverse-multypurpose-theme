<?php

namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 *  Get categories dropdown vertical menu
 * ------------------------------------------------------------------------------------------------
 */
class Categories extends Element {

	public function __construct() {
		parent::__construct();

		$this->template_name = 'categories';
	}

	public function map() {
		$this->args = array(
			'type'            => 'categories',
			'title'           => esc_html__( 'Categories', 'omniverse' ),
			'text'            => esc_html__( 'Categories dropdown', 'omniverse' ),
			'icon'            => 'dn-i-dropdown',
			'editable'        => true,
			'container'       => false,
			'edit_on_create'  => true,
			'drag_target_for' => array(),
			'drag_source'     => 'content_element',
			'removable'       => true,
			'addable'         => true,
			'desktop'         => true,
			'params'          => array(
				'menu_id'               => array(
					'id'          => 'menu_id',
					'title'       => esc_html__( 'Choose menu', 'omniverse' ),
					'type'        => 'select',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Menu', 'omniverse' ),
					'value'       => '',
					'callback'    => 'get_menu_options_with_empty',
					'description' => esc_html__( 'Choose which menu to display in the header as a categories dropdown.', 'omniverse' ),
				),
				'categories_title'      => array(
					'id'          => 'categories_title',
					'title'       => esc_html__( 'Menu title', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Menu', 'omniverse' ),
					'value'       => '',
					'description' => esc_html__( 'Specify your custom title for this menu dropdown or leave it empty to keep "Browse categories".', 'omniverse' ),
				),
				'more_cat_button'       => array(
					'id'          => 'more_cat_button',
					'title'       => esc_html__( 'Limit categories', 'omniverse' ),
					'hint'        => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_categories_more_cat_button.mp4" autoplay loop muted></video>',
					'type'        => 'switcher',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Dropdown', 'omniverse' ),
					'value'       => false,
					'description' => __( 'Display a certain number of categories and "show more" button.', 'omniverse' ),
				),
				'more_cat_button_count' => array(
					'id'          => 'more_cat_button_count',
					'title'       => esc_html__( 'Number of categories', 'omniverse' ),
					'description' => esc_html__( 'Specify the number of categories to be shown initially', 'omniverse' ),
					'type'        => 'slider',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Dropdown', 'omniverse' ),
					'from'        => 1,
					'to'          => 100,
					'value'       => 5,
					'units'       => '',
					'requires'    => array(
						'more_cat_button' => array(
							'comparison' => 'equal',
							'value'      => true,
						),
					),
				),
				'mouse_event'           => array(
					'id'      => 'mouse_event',
					'title'   => esc_html__( 'Open on mouse event', 'omniverse' ),
					'type'    => 'selector',
					'tab'     => esc_html__( 'General', 'omniverse' ),
					'group'   => esc_html__( 'Dropdown', 'omniverse' ),
					'value'   => 'hover',
					'options' => array(
						'hover' => array(
							'value' => 'hover',
							'label' => esc_html__( 'Hover', 'omniverse' ),
						),
						'click' => array(
							'value' => 'click',
							'label' => esc_html__( 'Click', 'omniverse' ),
						),
					),
				),
				'open_dropdown'         => array(
					'id'          => 'open_dropdown',
					'title'       => esc_html__( 'Open menu item dropdown', 'omniverse' ),
					'hint'        => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_categories_open_dropdown.mp4" autoplay loop muted></video>',
					'description' => __( 'Submenu dropdown stays open after cursor leaves the parent menu item. Stops working if "Open categories menu" options is enabled on a page.', 'omniverse' ),
					'type'        => 'switcher',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Dropdown', 'omniverse' ),
					'value'       => false,
				),
				'design'                => array(
					'id'      => 'design',
					'title'   => esc_html__( 'Dropdown design', 'omniverse' ),
					'type'    => 'selector',
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'Dropdown', 'omniverse' ),
					'value'   => 'default',
					'options' => array(
						'default' => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'hint'  => '<img src="' . OMNIVERSE_TOOLTIP_URL . 'hb_categories_design_default.jpg" alt="">',
							'value' => 'default',
						),
						'with-bg' => array(
							'label' => esc_html__( 'With background', 'omniverse' ),
							'hint'  => '<img src="' . OMNIVERSE_TOOLTIP_URL . 'hb_categories_design_with_bg.jpg" alt="">',
							'value' => 'with-bg',
						),
					),
				),
				'bg_overlay'            => array(
					'id'          => 'bg_overlay',
					'title'       => esc_html__( 'Background overlay', 'omniverse' ),
					'hint'        => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_categories_bg_overlay.mp4" autoplay loop muted></video>',
					'description' => __( 'Highlight dropdowns by darkening the background behind.', 'omniverse' ),
					'type'        => 'switcher',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Dropdown', 'omniverse' ),
					'value'       => false,
				),
				'color_scheme'          => array(
					'id'          => 'color_scheme',
					'title'       => esc_html__( 'Text color scheme', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Menu title', 'omniverse' ),
					'value'       => 'light',
					'options'     => array(
						'dark'  => array(
							'value' => 'dark',
							'label' => esc_html__( 'Dark', 'omniverse' ),
						),
						'light' => array(
							'value' => 'light',
							'label' => esc_html__( 'Light', 'omniverse' ),
						),
					),
					'description' => esc_html__( 'Select different text color scheme depending on your header background.', 'omniverse' ),
				),
				'background'            => array(
					'id'          => 'background',
					'type'        => 'bg',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Menu title', 'omniverse' ),
					'value'       => '',
					'description' => '',
				),
				'border'                => array(
					'id'              => 'border',
					'type'            => 'border',
					'sides'           => array( 'bottom', 'top', 'left', 'right' ),
					'tab'             => esc_html__( 'Style', 'omniverse' ),
					'group'           => esc_html__( 'Menu title', 'omniverse' ),
					'colorpicker_top' => true,
					'container'       => false,
					'value'           => '',
					'description'     => esc_html__( 'Border settings for menu title.', 'omniverse' ),
				),
				'icon_type'             => array(
					'id'          => 'icon_type',
					'title'       => esc_html__( 'Icon type', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Menu title', 'omniverse' ),
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
				'custom_icon'           => array(
					'id'          => 'custom_icon',
					'title'       => esc_html__( 'Upload an image', 'omniverse' ),
					'type'        => 'image',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Menu title', 'omniverse' ),
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
