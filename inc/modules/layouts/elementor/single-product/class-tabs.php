<?php
/**
 * Tabs map.
 *
 * @package Omniverse
 */

namespace DN\Modules\Layouts;

use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 */
class Tabs extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_single_product_tabs';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Product tabs', 'omniverse' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'wd-icon-sp-tabs';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'wd-single-product-elements' );
	}

	/**
	 * Show in panel.
	 *
	 * @return bool Whether to show the widget in the panel or not.
	 */
	public function show_in_panel() {
		return Main::is_layout_type( 'single_product' );
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return array( 'wc-single-product' );
	}

	/**
	 * Register the widget controls.
	 */
	protected function register_controls() {

		/**
		 * Content tab.
		 */

		/**
		 * General settings
		 */
		$this->start_controls_section(
			'general_content_section',
			array(
				'label' => esc_html__( 'General', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'css_classes_tabs',
			array(
				'type'         => 'wd_css_class',
				'default'      => 'wd-single-tabs',
				'prefix_class' => '',
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Layout', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'tabs'      => esc_html__( 'Tabs', 'omniverse' ),
					'accordion' => esc_html__( 'Accordion', 'omniverse' ),
					'all-open'  => esc_html__( 'All open', 'omniverse' ),
				),
				'default' => 'tabs',
			)
		);

		$this->add_control(
			'enable_description',
			array(
				'label'        => esc_html__( 'Enable description tab', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'enable_additional_info',
			array(
				'label'        => esc_html__( 'Enable additional info tab', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'enable_reviews',
			array(
				'label'        => esc_html__( 'Enable reviews tab', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->end_controls_section();

		/**
		 * Style tab.
		 */

		/**
		 * Tabs title section.
		 */
		$this->start_controls_section(
			'tabs_title_style_section',
			array(
				'label'     => esc_html__( 'Title', 'omniverse' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout' => 'tabs',
				),
			)
		);

		$this->add_control(
			'tabs_style',
			array(
				'label'   => esc_html__( 'Style', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'default'           => esc_html__( 'Default', 'omniverse' ),
					'underline'         => esc_html__( 'Underline', 'omniverse' ),
					'underline-reverse' => esc_html__( 'Overline', 'omniverse' ),
				),
				'default' => 'default',
			)
		);

		$this->add_control(
			'tabs_title_text_color_scheme',
			array(
				'label'   => esc_html__( 'Color scheme', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'omniverse' ),
					'light'   => esc_html__( 'Light', 'omniverse' ),
					'dark'    => esc_html__( 'Dark', 'omniverse' ),
					'custom'  => esc_html__( 'Custom', 'omniverse' ),
				),
				'default' => 'inherit',
			)
		);

		$this->start_controls_tabs(
			'tabs_title_text_color_tabs',
			array(
				'condition' => array(
					'tabs_title_text_color_scheme' => 'custom',
				),
			)
		);

		$this->start_controls_tab(
			'tabs_title_text_color_tab',
			array(
				'label' => esc_html__( 'Idle', 'omniverse' ),
			)
		);

		$this->add_control(
			'tabs_title_text_idle_color',
			array(
				'label'     => esc_html__( 'Color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-tabs > .wd-nav-wrapper li > a' => 'color: {{VALUE}}',
				),
				array(
					'condition' => array(
						'tabs_title_text_color_scheme' => 'custom',
					),
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_title_text_hover_color_tab',
			array(
				'label' => esc_html__( 'Hover', 'omniverse' ),
			)
		);

		$this->add_control(
			'tabs_title_text_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-tabs > .wd-nav-wrapper li:hover > a' => 'color: {{VALUE}}',
				),
				array(
					'condition' => array(
						'tabs_title_text_color_scheme' => 'custom',
					),
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_title_text_hover_active_tab',
			array(
				'label' => esc_html__( 'Active', 'omniverse' ),
			)
		);

		$this->add_control(
			'tabs_title_text_hover_active',
			array(
				'label'     => esc_html__( 'Color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-tabs > .wd-nav-wrapper li.active > a' => 'color: {{VALUE}}',
				),
				array(
					'condition' => array(
						'tabs_title_text_color_scheme' => 'custom',
					),
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tabs_title_typography',
				'label'    => esc_html__( 'Typography', 'omniverse' ),
				'selector' => '{{WRAPPER}} .woocommerce-tabs > .wd-nav-wrapper li > a',
			)
		);

		$this->add_control(
			'tabs_alignment',
			array(
				'label'   => esc_html__( 'Title alignment', 'omniverse' ),
				'type'    => 'wd_buttons',
				'options' => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					),
				),
				'default' => 'center',
			)
		);

		$this->add_responsive_control(
			'tabs_space_between_tabs_title_horizontal',
			array(
				'label'     => esc_html__( 'Horizontal spacing', 'omniverse' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 150,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .wd-nav-tabs > li:not(:last-child)' => 'margin-inline-end: {{SIZE}}px;',
				),
			)
		);

		$this->add_responsive_control(
			'tabs_space_between_tabs_title_vertical',
			array(
				'label'     => esc_html__( 'Vertical spacing', 'omniverse' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 150,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .wd-nav-tabs-wrapper' => 'margin-bottom: {{SIZE}}px;',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Accordion title section.
		 */
		$this->start_controls_section(
			'accordion_title_style_section',
			array(
				'label'     => esc_html__( 'Title', 'omniverse' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout' => 'accordion',
				),
			)
		);

		$this->add_control(
			'accordion_state',
			array(
				'label'   => esc_html__( 'Items state', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'first'      => esc_html__( 'First opened', 'omniverse' ),
					'all_closed' => esc_html__( 'All closed', 'omniverse' ),
				),
				'default' => 'first',
			)
		);

		$this->add_control(
			'accordion_style',
			array(
				'label'   => esc_html__( 'Style', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'default' => esc_html__( 'Default', 'omniverse' ),
					'shadow'  => esc_html__( 'Shadow', 'omniverse' ),
					'simple'  => esc_html__( 'Simple', 'omniverse' ),
				),
				'default' => 'default',
			)
		);

		$this->add_control(
			'accordion_hide_top_bottom_border',
			array(
				'label'     => esc_html__( 'Hide top & bottom border', 'omniverse' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'omniverse' ),
				'label_off' => esc_html__( 'No', 'omniverse' ),
				'condition' => array(
					'accordion_style' => 'default',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'shadow',
				'selector'  => '{{WRAPPER}} > div > .wd-accordion.wd-style-shadow > .wd-accordion-item',
				'condition' => array(
					'accordion_style' => array( 'shadow' ),
				),
			)
		);

		$this->add_control(
			'accordion_alignment',
			array(
				'label'   => esc_html__( 'Title alignment', 'omniverse' ),
				'type'    => 'wd_buttons',
				'options' => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
						'style' => 'col-2',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					),
				),
				'default' => 'left',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'accordion_title_typography',
				'label'    => esc_html__( 'Typography', 'omniverse' ),
				'selector' => '{{WRAPPER}} [class*="tab-title-"] .wd-accordion-title-text',
			)
		);

		$this->add_control(
			'accordion_title_text_color_scheme',
			array(
				'label'   => esc_html__( 'Color scheme', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'omniverse' ),
					'light'   => esc_html__( 'Light', 'omniverse' ),
					'dark'    => esc_html__( 'Dark', 'omniverse' ),
					'custom'  => esc_html__( 'Custom', 'omniverse' ),
				),
				'default' => 'inherit',
			)
		);

		$this->start_controls_tabs(
			'accordion_title_text_color_tabs',
			array(
				'condition' => array(
					'accordion_title_text_color_scheme' => 'custom',
				),
			)
		);

		$this->start_controls_tab(
			'accordion_title_text_color_tab',
			array(
				'label' => esc_html__( 'Idle', 'omniverse' ),
			)
		);

		$this->add_control(
			'accordion_title_text_idle_color',
			array(
				'label'     => esc_html__( 'Color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} [class*="tab-title-"] .wd-accordion-title-text' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'accordion_title_text_color_scheme' => 'custom',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'accordion_title_text_hover_color_tab',
			array(
				'label' => esc_html__( 'Hover', 'omniverse' ),
			)
		);

		$this->add_control(
			'accordion_title_text_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wd-accordion-title[class*="tab-title-"]:hover .wd-accordion-title-text' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'accordion_title_text_color_scheme' => 'custom',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'accordion_title_text_active_color_tab',
			array(
				'label' => esc_html__( 'Active', 'omniverse' ),
			)
		);

		$this->add_control(
			'accordion_title_text_active_color',
			array(
				'label'     => esc_html__( 'Color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wd-accordion-title[class*="tab-title-"].wd-active .wd-accordion-title-text' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'accordion_title_text_color_scheme' => 'custom',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Accordion opener settings.
		 */
		$this->start_controls_section(
			'accordion_opener_section',
			array(
				'label'     => esc_html__( 'Opener', 'omniverse' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout' => 'accordion',
				),
			)
		);

		$this->add_control(
			'accordion_opener_style',
			array(
				'label'   => esc_html__( 'Style', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'arrow' => esc_html__( 'Arrow', 'omniverse' ),
					'plus'  => esc_html__( 'Plus', 'omniverse' ),
				),
				'default' => 'arrow',
			)
		);

		$this->add_control(
			'accordion_opener_alignment',
			array(
				'label'   => esc_html__( 'Position', 'omniverse' ),
				'type'    => 'wd_buttons',
				'options' => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/left.png',
						'style' => 'col-2',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/right.png',
					),
				),
				'default' => 'left',
			)
		);

		$this->end_controls_section();

		/**
		 * Tabs content section.
		 */
		$this->start_controls_section(
			'tabs_content_style_section',
			array(
				'label'     => esc_html__( 'Content', 'omniverse' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout!' => 'all-open',
				),
			)
		);

		$this->add_control(
			'tabs_content_text_color_scheme',
			array(
				'label'   => esc_html__( 'Color scheme', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'omniverse' ),
					'light'   => esc_html__( 'Light', 'omniverse' ),
					'dark'    => esc_html__( 'Dark', 'omniverse' ),
				),
				'default' => 'inherit',
			)
		);

		$this->end_controls_section();

		/**
		 * All open title section.
		 */

		$this->start_controls_section(
			'all_open_general_style_section',
			array(
				'label'     => esc_html__( 'General', 'omniverse' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout' => 'all-open',
				),
			)
		);

		$this->add_control(
			'all_open_css_classes',
			array(
				'type'         => 'wd_css_class',
				'default'      => 'tabs-layout-all-open',
				'prefix_class' => '',
			)
		);

		$this->add_responsive_control(
			'all_open_vertical_spacing.',
			array(
				'label'      => esc_html__( 'Vertical spacing', 'omniverse' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 200,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wd-tab-wrapper:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'all_open_title_style_section',
			array(
				'label'     => esc_html__( 'Title', 'omniverse' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout' => 'all-open',
				),
			)
		);

		$this->add_control(
			'all_open_style',
			array(
				'label'        => esc_html__( 'Style', 'omniverse' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'default'  => esc_html__( 'Default', 'omniverse' ),
					'overline' => esc_html__( 'Overline', 'omniverse' ),
				),
				'default'      => 'default',
				'prefix_class' => 'wd-title-style-',
			)
		);

		$this->add_control(
			'all_open_title_text_color',
			array(
				'label'     => esc_html__( 'Color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wd-all-open-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'all_open_title_typography',
				'label'    => esc_html__( 'Typography', 'omniverse' ),
				'selector' => '{{WRAPPER}} .wd-all-open-title',
			)
		);

		$this->end_controls_section();

		/**
		 * SP TABS.
		 */
		$this->start_controls_section(
			'additional_info_style_section',
			array(
				'label'     => esc_html__( 'Additional information', 'omniverse' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'enable_additional_info' => 'yes',
				),
			)
		);

		$this->add_control(
			'additional_info_layout',
			array(
				'label'   => esc_html__( 'Layout', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'list'   => esc_html__( 'List', 'omniverse' ),
					'grid'   => esc_html__( 'Grid', 'omniverse' ),
					'inline' => esc_html__( 'Inline', 'omniverse' ),
				),
				'default' => 'list',
			)
		);

		$this->add_control(
			'additional_info_style',
			array(
				'label'   => esc_html__( 'Style', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'default'  => esc_html__( 'Default', 'omniverse' ),
					'bordered' => esc_html__( 'Bordered', 'omniverse' ),
				),
				'default' => 'bordered',
			)
		);

		$this->add_responsive_control(
			'additional_info_columns',
			array(
				'label'     => esc_html__( 'Columns', 'omniverse' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					),
				),
				'default'   => array(
					'size' => 1,
				),
				'selectors' => array(
					'{{WRAPPER}} .shop_attributes' => '--wd-attr-col: {{SIZE}};',
				),
			)
		);

		$this->add_responsive_control(
			'additional_info_vertical_gap',
			array(
				'label'     => esc_html__( 'Vertical spacing', 'omniverse' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .shop_attributes' => '--wd-attr-v-gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'additional_info_horizontal_gap',
			array(
				'label'     => esc_html__( 'Horizontal spacing', 'omniverse' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .shop_attributes' => '--wd-attr-h-gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'additional_info_max_width',
			array(
				'label'       => esc_html__( 'Table width', 'omniverse' ),
				'description' => esc_html__( 'Attribute image container width', 'omniverse' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( '%', 'px' ),
				'default'     => array(
					'unit' => '%',
				),
				'range'       => array(
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .shop_attributes' => 'max-width: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'layout' => 'tabs',
				),
			)
		);

		$this->add_control(
			'attr_hide_image',
			array(
				'label'        => esc_html__( 'Hide image', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$this->add_responsive_control(
			'additional_info_image_width',
			array(
				'label'       => esc_html__( 'Image width', 'omniverse' ),
				'type'        => Controls_Manager::SLIDER,
				'description' => esc_html__( 'Limit the attribute image container width', 'omniverse' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .shop_attributes' => '--wd-attr-img-width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'attr_hide_image!' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'additional_info_settings_tabs' );

		$this->start_controls_tab(
			'additional_info_name_tab',
			array(
				'label' => esc_html__( 'Name', 'omniverse' ),
			)
		);

		$this->add_control(
			'attr_hide_name',
			array(
				'label'        => esc_html__( 'Hide name', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'additional_info_name_typography',
				'label'     => esc_html__( 'Name typography', 'omniverse' ),
				'selector'  => '{{WRAPPER}} .woocommerce-product-attributes-item__label',
				'condition' => array(
					'attr_hide_name!' => 'yes',
				),
			)
		);

		$this->add_control(
			'additional_info_name_color',
			array(
				'label'     => esc_html__( 'Name color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-product-attributes-item__label' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'attr_hide_name!' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'attr_name_column_width',
			array(
				'label'      => esc_html__( 'Name column width', 'omniverse' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'px' ),
				'range'      => array(
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
				'selectors'  => array(
					'{{WRAPPER}} .woocommerce-product-attributes-item__label' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'additional_info_layout' => 'inline',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'additional_info_term_tab',
			array(
				'label' => esc_html__( 'Term', 'omniverse' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'additional_info_term_typography',
				'label'    => esc_html__( 'Term typography', 'omniverse' ),
				'selector' => '{{WRAPPER}} .woocommerce-product-attributes-item__value',
			)
		);

		$this->add_control(
			'additional_info_term_color',
			array(
				'label'     => esc_html__( 'Term color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-product-attributes-item__value' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'reviews_style_section',
			array(
				'label'     => esc_html__( 'Reviews', 'omniverse' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'enable_reviews' => 'yes',
				),
			)
		);

		$this->add_control(
			'reviews_layout',
			array(
				'label'   => esc_html__( 'Reviews section columns', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'one-column' => esc_html__( 'One column', 'omniverse' ),
					'two-column' => esc_html__( 'Two columns', 'omniverse' ),
				),
				'default' => 'one-column',
			)
		);

		$this->add_responsive_control(
			'reviews_columns',
			array(
				'label'          => esc_html__( 'Reviews columns', 'omniverse' ),
				'type'           => Controls_Manager::SELECT,
				'options'        => array(
					'1' => esc_html__( '1', 'omniverse' ),
					'2' => esc_html__( '2', 'omniverse' ),
				),
				'default'        => '1',
				'tablet_default' => '1',
				'mobile_default' => '1',
				'devices'        => array( 'desktop', 'tablet', 'mobile' ),
				'classes'        => 'wd-hide-custom-breakpoints',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 */
	protected function render() {
		$settings = wp_parse_args(
			$this->get_settings_for_display(),
			array(
				'layout'                           => 'tabs',
				'enable_additional_info'           => 'yes',
				'enable_reviews'                   => 'yes',
				'enable_description'               => 'yes',
				'additional_info_style'            => 'bordered',
				'additional_info_layout'           => 'list',
				'attr_hide_name'                   => 'no',
				'attr_hide_icon'                   => 'no',
				'reviews_layout'                   => 'one-column',
				'reviews_columns'                  => '1',
				'reviews_columns_tablet'           => '1',
				'reviews_columns_mobile'           => '1',

				/**
				 * Tabs Settings.
				 */
				'tabs_style'                       => 'default',
				'tabs_title_text_color_scheme'     => 'inherit',
				'tabs_alignment'                   => 'center',
				'tabs_content_text_color_scheme'   => 'inherit',

				/**
				 * Accordion Settings.
				 */
				'accordion_state'                  => 'first',
				'accordion_style'                  => 'default',
				'accordion_alignment'              => 'left',
				'accordion_hide_top_bottom_border' => '',

				/**
				 * Opener Settings.
				 */
				'accordion_opener_alignment'       => 'left',
				'accordion_opener_style'           => 'arrow',
			)
		);

		$args = $this->get_template_args( $settings );

		foreach ( array( 'desktop', 'tablet', 'mobile' ) as $device ) {
			$key = 'reviews_columns' . ( 'desktop' === $device ? '' : '_' . $device );

			Global_Data::get_instance()->set_data( $key, $this->get_settings_for_display( $key ) );
		}

		wp_enqueue_script( 'wc-single-product' );

		if ( empty( $settings['enable_additional_info'] ) ) {
			add_filter( 'woocommerce_product_tabs', 'omniverse_single_product_remove_additional_information_tab', 98 );
		}
		if ( empty( $settings['enable_reviews'] ) ) {
			add_filter( 'woocommerce_product_tabs', 'omniverse_single_product_remove_reviews_tab', 98 );
		}
		if ( empty( $settings['enable_description'] ) ) {
			add_filter( 'woocommerce_product_tabs', 'omniverse_single_product_remove_description_tab', 98 );
		}
		if ( omniverse_get_opt( 'hide_tabs_titles' ) || get_post_meta( get_the_ID(), '_omniverse_hide_tabs_titles', true ) ) {
			add_filter( 'woocommerce_product_description_heading', '__return_false', 20 );
			add_filter( 'woocommerce_product_additional_information_heading', '__return_false', 20 );
		}

		Main::setup_preview();

		if ( 'yes' === $settings['enable_reviews'] ) {
			omniverse_enqueue_inline_style( 'mod-comments' );
		}

		if ( comments_open() ) {
			omniverse_enqueue_inline_style( 'woo-single-prod-el-reviews' );
			omniverse_enqueue_inline_style( 'woo-single-prod-el-reviews-' . omniverse_get_opt( 'reviews_style', 'style-1' ) );
			omniverse_enqueue_js_script( 'woocommerce-comments' );
		}

		wc_get_template(
			'single-product/tabs/tabs-' . $settings['layout'] . '.php',
			$args
		);

		Main::restore_preview();
	}

	/**
	 * Get template args.
	 *
	 * @param array $settings Element settings list.
	 * @return array
	 */
	private function get_template_args( $settings ) {
		$tabs_layout = $settings['layout'];

		$additional_info_classes  = ' wd-layout-' . $settings['additional_info_layout'];
		$additional_info_classes .= ' wd-style-' . $settings['additional_info_style'];
		$additional_info_classes .= 'yes' === $settings['attr_hide_name'] ? ' wd-hide-name' : '';
		$additional_info_classes .= 'yes' === $settings['attr_hide_image'] ? ' wd-hide-image' : '';
		$reviews_classes          = ' wd-layout-' . $settings['reviews_layout'];
		$args                     = array();
		$title_content_classes    = '';

		if ( 'inherit' !== $settings['tabs_content_text_color_scheme'] ) {
			$title_content_classes .= ' color-scheme-' . $settings['tabs_content_text_color_scheme'];
		}

		$default_args = array(
			'builder_additional_info_classes' => $additional_info_classes,
			'builder_reviews_classes'         => $reviews_classes,
			'builder_content_classes'         => $title_content_classes,
		);

		if ( 'tabs' === $tabs_layout ) {
			$args = $this->get_tabs_template_args( $settings );
		} elseif ( 'accordion' === $tabs_layout ) {
			$args = $this->get_accordion_template_classes( $settings );
		}

		return array_merge(
			$default_args,
			$args
		);
	}

	/**
	 * Get tabs template args.
	 *
	 * @param array $settings Layout data.
	 * @return array
	 */
	private function get_tabs_template_args( $settings ) {
		$title_wrapper_classes = ' text-' . $settings['tabs_alignment'];
		$title_classes         = ' wd-style-' . $settings['tabs_style'];

		if ( 'inherit' !== $settings['tabs_title_text_color_scheme'] && 'custom' !== $settings['tabs_title_text_color_scheme'] ) {
			$title_wrapper_classes .= ' color-scheme-' . $settings['tabs_title_text_color_scheme'];
		}

		return array(
			'builder_tabs_classes'             => $title_classes,
			'builder_nav_tabs_wrapper_classes' => $title_wrapper_classes,
		);
	}

	/**
	 * Get accordion template args.
	 *
	 * @param array $settings Layout data.
	 * @return array
	 */
	private function get_accordion_template_classes( $settings ) {
		$wrapper_classes = ' wd-style-' . $settings['accordion_style'];
		$accordion_state = $settings['accordion_state'];
		$opener_classes  = ' wd-opener-style-' . $settings['accordion_opener_style'];
		$title_classes   = ' text-' . $settings['accordion_alignment'];
		$title_classes  .= ' wd-opener-pos-' . $settings['accordion_opener_alignment'];

		if ( 'inherit' !== $settings['accordion_title_text_color_scheme'] && 'custom' !== $settings['accordion_title_text_color_scheme'] ) {
			$title_classes .= ' color-scheme-' . $settings['accordion_title_text_color_scheme'];
		}

		if ( 'yes' === $settings['accordion_hide_top_bottom_border'] ) {
			$wrapper_classes .= ' wd-border-off';
		}

		return array(
			'builder_accordion_classes' => $wrapper_classes,
			'builder_state'             => $accordion_state,
			'builder_opener_classes'    => $opener_classes,
			'builder_title_classes'     => $title_classes,
		);
	}
}

Plugin::instance()->widgets_manager->register( new Tabs() );
