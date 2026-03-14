<?php

namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 * Mobile menu burger icon
 * ------------------------------------------------------------------------------------------------
 */
class Burger extends Element {

	public function __construct() {
		parent::__construct();
		$this->template_name = 'burger';
	}

	public function map() {
		$this->args = array(
			'type'            => 'burger',
			'title'           => esc_html__( 'Mobile menu', 'omniverse' ),
			'text'            => esc_html__( 'Mobile burger icon', 'omniverse' ),
			'icon'            => 'dn-i-burger-circle',
			'editable'        => true,
			'container'       => false,
			'edit_on_create'  => true,
			'drag_target_for' => array(),
			'drag_source'     => 'content_element',
			'removable'       => true,
			'addable'         => true,
			'params'          => array(
				'close_btn'              => array(
					'id'    => 'close_btn',
					'title' => esc_html__( 'Show close button', 'omniverse' ),
					'hint'  => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_mobile_menu_close_btn.mp4" autoplay loop muted></video>',
					'type'  => 'switcher',
					'tab'   => esc_html__( 'General', 'omniverse' ),
					'group' => esc_html__( 'Elements', 'omniverse' ),
					'value' => false,
				),
				'search_form'            => array(
					'id'    => 'search_form',
					'title' => esc_html__( 'Show search form', 'omniverse' ),
					'hint'  => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_mobile_menu_search_form.mp4" autoplay loop muted></video>',
					'type'  => 'switcher',
					'tab'   => esc_html__( 'General', 'omniverse' ),
					'group' => esc_html__( 'Elements', 'omniverse' ),
					'value' => true,
				),
				'post_type'              => array(
					'id'       => 'post_type',
					'title'    => esc_html__( 'Post type', 'omniverse' ),
					'type'     => 'selector',
					'tab'      => esc_html__( 'General', 'omniverse' ),
					'group'    => esc_html__( 'Elements', 'omniverse' ),
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
						'search_form' => array(
							'comparison' => 'equal',
							'value'      => true,
						),
					),
				),
				'show_wishlist'          => array(
					'id'    => 'show_wishlist',
					'title' => esc_html__( 'Show wishlist', 'omniverse' ),
					'hint'  => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_mobile_menu_show_wishlist.mp4" autoplay loop muted></video>',
					'type'  => 'switcher',
					'tab'   => esc_html__( 'General', 'omniverse' ),
					'group' => esc_html__( 'Elements', 'omniverse' ),
					'value' => true,
				),
				'show_compare'           => array(
					'id'    => 'show_compare',
					'title' => esc_html__( 'Show compare', 'omniverse' ),
					'hint'  => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_mobile_menu_show_compare.mp4" autoplay loop muted></video>',
					'type'  => 'switcher',
					'tab'   => esc_html__( 'General', 'omniverse' ),
					'group' => esc_html__( 'Elements', 'omniverse' ),
					'value' => true,
				),
				'show_account'           => array(
					'id'    => 'show_account',
					'title' => esc_html__( 'Show account', 'omniverse' ),
					'hint'  => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_mobile_menu_show_account.mp4" autoplay loop muted></video>',
					'type'  => 'switcher',
					'tab'   => esc_html__( 'General', 'omniverse' ),
					'group' => esc_html__( 'Elements', 'omniverse' ),
					'value' => true,
				),
				'show_html_block'        => array(
					'id'          => 'show_html_block',
					'title'       => esc_html__( 'Show HTML Blocks', 'omniverse' ),
					'hint'        => '<img src="' . OMNIVERSE_TOOLTIP_URL . 'hb_show_html_block.jpg" alt="">',
					'type'        => 'switcher',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Elements', 'omniverse' ),
					'description' => esc_html__( 'HTML Blocks that were assigned to the menu items will be shown as items submenus.', 'omniverse' ),
					'value'       => false,
				),
				'languages'              => array(
					'id'          => 'languages',
					'title'       => esc_html__( 'Show WPML languages', 'omniverse' ),
					'hint'        => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_mobile_menu_wpml.mp4" autoplay loop muted></video>',
					'type'        => 'switcher',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Elements', 'omniverse' ),
					'value'       => false,
					'description' => esc_html__( 'Show the language switcher if the WPML plugin is enabled.', 'omniverse' ),
					'extra_class' => 'dn-col-6',
				),
				'show_language_flag'     => array(
					'id'          => 'show_language_flag',
					'title'       => esc_html__( 'Show flag of WPML languages', 'omniverse' ),
					'type'        => 'switcher',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Elements', 'omniverse' ),
					'value'       => true,
					'requires'    => array(
						'languages' => array(
							'comparison' => 'equal',
							'value'      => true,
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'categories_menu'        => array(
					'id'    => 'categories_menu',
					'title' => esc_html__( 'Show categories menu', 'omniverse' ),
					'hint'  => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_mobile_menu_categories_menu.mp4" autoplay loop muted></video>',
					'type'  => 'switcher',
					'tab'   => esc_html__( 'General', 'omniverse' ),
					'group' => esc_html__( 'Category', 'omniverse' ),
					'value' => false,
				),
				'primary_menu_title'     => array(
					'id'          => 'primary_menu_title',
					'title'       => esc_html__( 'First menu tab title', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Category', 'omniverse' ),
					'value'       => '',
					'description' => esc_html__( 'You can rewrite mobile menu tab title with this option. Or leave empty to have a default one - Menu.', 'omniverse' ),
					'requires'    => array(
						'categories_menu' => array(
							'comparison' => 'equal',
							'value'      => true,
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'secondary_menu_title'   => array(
					'id'          => 'secondary_menu_title',
					'title'       => esc_html__( 'Second menu tab title', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Category', 'omniverse' ),
					'value'       => '',
					'description' => esc_html__( 'You can rewrite mobile menu tab title with this option. Or leave empty to have a default one - Categories.', 'omniverse' ),
					'requires'    => array(
						'categories_menu' => array(
							'comparison' => 'equal',
							'value'      => true,
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'menu_id'                => array(
					'id'          => 'menu_id',
					'title'       => esc_html__( 'Choose menu', 'omniverse' ),
					'type'        => 'select',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Category', 'omniverse' ),
					'value'       => '',
					'callback'    => 'get_menu_options_with_empty',
					'description' => esc_html__( 'Choose which menu to display.', 'omniverse' ),
					'requires'    => array(
						'categories_menu' => array(
							'comparison' => 'equal',
							'value'      => true,
						),
					),
				),
				'tabs_swap'              => array(
					'id'          => 'tabs_swap',
					'title'       => esc_html__( 'Swap menus', 'omniverse' ),
					'type'        => 'switcher',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Category', 'omniverse' ),
					'value'       => false,
					'description' => esc_html__( 'Swap the positions of the first and secondary menus.', 'omniverse' ),
					'requires'    => array(
						'categories_menu' => array(
							'comparison' => 'equal',
							'value'      => true,
						),
					),
				),
				'menu_layout'            => array(
					'id'          => 'menu_layout',
					'title'       => esc_html__( 'Menu layout', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'General', 'omniverse' ),
					'value'       => 'dropdown',
					'options'     => array(
						'dropdown'  => array(
							'value' => 'dropdown',
							'label' => esc_html__( 'Dropdown', 'omniverse' ),
							'hint'  => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_mobile_menu_menu_layout_dropdown.mp4" autoplay loop muted></video>',
						),
						'drilldown' => array(
							'value' => 'drilldown',
							'label' => esc_html__( 'Drilldown', 'omniverse' ),
							'hint'  => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_mobile_menu_menu_layout_drilldown.mp4" autoplay loop muted></video>',
						),
					),
					'description' => esc_html__( 'Change the layout of the submenus of the mobile menus.', 'omniverse' ),
				),
				'drilldown_animation'    => array(
					'id'          => 'drilldown_animation',
					'title'       => esc_html__( 'Drilldown animation', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'General', 'omniverse' ),
					'value'       => 'slide',
					'options'     => array(
						'slide'   => array(
							'value' => 'slide',
							'label' => esc_html__( 'Slide', 'omniverse' ),
							'hint'  => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_mobile_menu_menu_drilldown_animation_slide.mp4" autoplay loop muted></video>',
						),
						'fade-in' => array(
							'value' => 'fade-in',
							'label' => esc_html__( 'Fade in', 'omniverse' ),
							'hint'  => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_mobile_menu_menu_drilldown_animation_fade_in.mp4" autoplay loop muted></video>',
						),
					),
					'requires'    => array(
						'menu_layout' => array(
							'comparison' => 'equal',
							'value'      => 'drilldown',
						),
					),
					'description' => esc_html__( 'Change the navigation animation through the drilldown menu.', 'omniverse' ),
				),
				'submenu_opening_action' => array(
					'id'          => 'submenu_opening_action',
					'title'       => esc_html__( 'Submenu opening action', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'General', 'omniverse' ),
					'value'       => 'only_arrow',
					'options'     => array(
						'only_arrow'     => array(
							'value' => 'arrow',
							'label' => esc_html__( 'Arrow', 'omniverse' ),
							'hint'  => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_mobile_menu_submenu_opening_arrow.mp4" autoplay loop muted></video>',
						),
						'item_and_arrow' => array(
							'value' => 'item_and_arrow',
							'label' => esc_html__( 'Label and arrow', 'omniverse' ),
							'hint'  => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_mobile_menu_submenu_opening_item_and_arrow.mp4" autoplay loop muted></video>',
						),
					),
					'description' => esc_html__( 'Specify which parent menu element needs to be clicked to open the submenu.', 'omniverse' ),
				),
				'position'               => array(
					'id'          => 'position',
					'title'       => esc_html__( 'Position', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'General', 'omniverse' ),
					'value'       => 'left',
					'options'     => array(
						'left'  => array(
							'value' => 'left',
							'hint'  => '<img src="' . OMNIVERSE_TOOLTIP_URL . 'hb_mobile_menu_position_left.jpg" alt="">',
							'label' => esc_html__( 'Left', 'omniverse' ),
						),
						'right' => array(
							'value' => 'right',
							'hint'  => '<img src="' . OMNIVERSE_TOOLTIP_URL . 'hb_mobile_menu_position_right.jpg" alt="">',
							'label' => esc_html__( 'Right', 'omniverse' ),
						),
					),
					'description' => esc_html__( 'Position of the mobile menu sidebar.', 'omniverse' ),
				),
				'style'                  => array(
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
				'icon_design'            => array(
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
