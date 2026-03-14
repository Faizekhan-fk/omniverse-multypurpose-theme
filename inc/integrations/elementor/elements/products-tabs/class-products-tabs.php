<?php
/**
 * Products tabs map.
 *
 * @package dn
 */

namespace DN\Elementor;

use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Products_Tabs extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_products_tabs';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'AJAX Products tabs', 'omniverse' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'wd-icon-product-tabs';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'wd-elements' ];
	}

	/**
	 * Get attribute taxonomies
	 *
	 * @since 1.0.0
	 */
	public function get_product_attributes_array() {
		$attributes = [];

		if ( omniverse_woocommerce_installed() ) {
			foreach ( wc_get_attribute_taxonomies() as $attribute ) {
				$attributes[] = 'pa_' . $attribute->attribute_name;
			}
		}

		return $attributes;
	}

	/**
	 * Register the widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		/**
		 * Content tab.
		 */

		/**
		 * General settings.
		 */
		$this->start_controls_section(
			'general_content_section',
			[
				'label' => esc_html__( 'General', 'omniverse' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => esc_html__( 'Tabs title', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Title text example',
			]
		);

		$this->add_control(
			'description',
			[
				'label'     => esc_html__( 'Tabs description', 'omniverse' ),
				'type'      => Controls_Manager::TEXTAREA,
				'condition' => [
					'design' => array( 'default', 'aside' ),
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Image settings.
		 */
		$this->start_controls_section(
			'image_content_section',
			[
				'label' => esc_html__( 'Image', 'omniverse' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose image', 'omniverse' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image',
				'default'   => 'thumbnail',
				'separator' => 'none',
			]
		);

		$this->end_controls_section();

		/**
		 * Tabs settings.
		 */
		$this->start_controls_section(
			'tabs_content_section',
			[
				'label' => esc_html__( 'Tabs', 'omniverse' ),
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'content_tabs' );

		$repeater->start_controls_tab(
			'query_tab',
			[
				'label' => esc_html__( 'Query', 'omniverse' ),
			]
		);

		$repeater->add_control(
			'post_type',
			[
				'label'       => esc_html__( 'Data source', 'omniverse' ),
				'description' => esc_html__( 'Select content type for your grid.', 'omniverse' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'product',
				'options'     => array(
					'product'            => esc_html__( 'All Products', 'omniverse' ),
					'featured'           => esc_html__( 'Featured Products', 'omniverse' ),
					'sale'               => esc_html__( 'Sale Products', 'omniverse' ),
					'new'                => esc_html__( 'Products with NEW label', 'omniverse' ),
					'bestselling'        => esc_html__( 'Bestsellers', 'omniverse' ),
					'ids'                => esc_html__( 'List of IDs', 'omniverse' ),
					'top_rated_products' => esc_html__( 'Top Rated Products', 'omniverse' ),
				),
			]
		);

		$repeater->add_control(
			'ajax_recently_viewed',
			[
				'label'        => esc_html__( 'Update with AJAX on page load', 'omniverse' ),
				'description'  => esc_html__( 'Enable this option if you use full-page cache like WP Rocket.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
				'condition'    => [
					'post_type' => 'recently_viewed',
				],
			]
		);

		$repeater->add_control(
			'include',
			[
				'label'       => esc_html__( 'Include only', 'omniverse' ),
				'description' => esc_html__( 'Add products by title.', 'omniverse' ),
				'type'        => 'wd_autocomplete',
				'search'      => 'omniverse_get_posts_by_query',
				'render'      => 'omniverse_get_posts_title_by_id',
				'post_type'   => 'product',
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'post_type' => 'ids',
				],
			]
		);

		$repeater->add_control(
			'taxonomies',
			[
				'label'       => esc_html__( 'Categories or tags', 'omniverse' ),
				'description' => esc_html__( 'List of product categories.', 'omniverse' ),
				'type'        => 'wd_autocomplete',
				'search'      => 'omniverse_get_taxonomies_by_query',
				'render'      => 'omniverse_get_taxonomies_title_by_id',
				'taxonomy'    => array_merge( [ 'product_cat', 'product_tag' ], $this->get_product_attributes_array() ),
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'post_type!' => 'ids',
				],
			]
		);

		$repeater->add_control(
			'orderby',
			[
				'label'       => esc_html__( 'Order by', 'omniverse' ),
				'description' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'omniverse' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => array(
					''               => '',
					'date'           => esc_html__( 'Date', 'omniverse' ),
					'id'             => esc_html__( 'ID', 'omniverse' ),
					'author'         => esc_html__( 'Author', 'omniverse' ),
					'title'          => esc_html__( 'Title', 'omniverse' ),
					'modified'       => esc_html__( 'Last modified date', 'omniverse' ),
					'comment_count'  => esc_html__( 'Number of comments', 'omniverse' ),
					'menu_order'     => esc_html__( 'Menu order', 'omniverse' ),
					'meta_value'     => esc_html__( 'Meta value', 'omniverse' ),
					'meta_value_num' => esc_html__( 'Meta value number', 'omniverse' ),
					'rand'           => esc_html__( 'Random order', 'omniverse' ),
					'price'          => esc_html__( 'Price', 'omniverse' ),
				),
				'condition'   => [
					'post_type!' => 'recently_viewed',
				],
			]
		);

		$repeater->add_control(
			'offset',
			[
				'label'       => esc_html__( 'Offset', 'omniverse' ),
				'description' => esc_html__( 'Number of grid elements to displace or pass over.', 'omniverse' ),
				'type'        => Controls_Manager::TEXT,
				'condition'   => [
					'post_type!' => array( 'ids', 'recently_viewed' ),
				],
			]
		);

		$repeater->add_control(
			'query_type',
			[
				'label'     => esc_html__( 'Query type', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'OR',
				'options'   => array(
					'OR'  => esc_html__( 'OR', 'omniverse' ),
					'AND' => esc_html__( 'AND', 'omniverse' ),
				),
				'condition' => array(
					'post_type!' => 'recently_viewed',
				),
			]
		);

		$repeater->add_control(
			'order',
			[
				'label'       => esc_html__( 'Sort order', 'omniverse' ),
				'description' => 'Designates the ascending or descending order. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>.',
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => array(
					''     => esc_html__( 'Inherit', 'omniverse' ),
					'DESC' => esc_html__( 'Descending', 'omniverse' ),
					'ASC'  => esc_html__( 'Ascending', 'omniverse' ),
				),
				'condition'   => [
					'post_type!' => array( 'ids', 'recently_viewed' ),
				],
			]
		);

		$repeater->add_control(
			'hide_out_of_stock',
			[
				'label'        => esc_html__( 'Hide out of stock products', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			]
		);

		$repeater->add_control(
			'meta_key',
			[
				'label'       => esc_html__( 'Meta key', 'omniverse' ),
				'description' => esc_html__( 'Input meta key for grid ordering.', 'omniverse' ),
				'type'        => Controls_Manager::TEXTAREA,
				'condition'   => [
					'orderby' => [ 'meta_value', 'meta_value_num' ],
				],
			]
		);

		$repeater->add_control(
			'exclude',
			[
				'label'       => esc_html__( 'Exclude', 'omniverse' ),
				'description' => esc_html__( 'Exclude posts, pages, etc. by title.', 'omniverse' ),
				'type'        => 'wd_autocomplete',
				'search'      => 'omniverse_get_posts_by_query',
				'render'      => 'omniverse_get_posts_title_by_id',
				'post_type'   => 'product',
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'post_type!' => 'ids',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'text_tab',
			[
				'label' => esc_html__( 'Text', 'omniverse' ),
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'   => esc_html__( 'Tabs title', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Tab title',
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'icon_tab',
			[
				'label' => esc_html__( 'Icon', 'omniverse' ),
			]
		);

		$repeater->add_control(
			'icon_type',
			array(
				'label'   => esc_html__( 'Icon type', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'icon'  => esc_html__( 'With icon', 'omniverse' ),
					'image' => esc_html__( 'With image', 'omniverse' ),
				),
				'default' => 'image',
			)
		);

		$repeater->add_control(
			'icon',
			array(
				'label'     => esc_html__( 'Icon', 'omniverse' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => array(
					'icon_type' => array( 'icon' ),
				),
			)
		);

		$repeater->add_control(
			'image',
			[
				'label'     => esc_html__( 'Choose image', 'omniverse' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => array(
					'icon_type' => array( 'image' ),
				),
			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image',
				'default'   => 'thumbnail',
				'separator' => 'none',
				'condition' => array(
					'icon_type' => array( 'image' ),
				),
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'tabs_items',
			[
				'type'        => Controls_Manager::REPEATER,
				'title_field' => '{{{ title }}}',
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'title' => 'Tab title 1',
					],
					[
						'title' => 'Tab title 2',
					],
					[
						'title' => 'Tab title 3',
					],
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Style tab.
		 */
		/**
		 * Heading settings.
		 */
		$this->start_controls_section(
			'heading_style_section',
			[
				'label' => esc_html__( 'Heading', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'design',
			[
				'label'   => esc_html__( 'Design', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'omniverse' ),
					'simple'  => esc_html__( 'Simple', 'omniverse' ),
					'alt'     => esc_html__( 'Alternative', 'omniverse' ),
					'aside'   => esc_html__( 'Aside', 'omniverse' ),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'tabs_side_width',
			array(
				'label'      => esc_html__( 'Side heading width', 'omniverse' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 100,
						'max'  => 500,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wd-tabs.tabs-design-aside' => '--wd-side-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'design' => array( 'aside' ),
				),
			)
		);

		$this->add_control(
			'color',
			[
				'label'     => esc_html__( 'Tabs primary color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wd-nav-tabs.wd-style-default li.wd-active a, {{WRAPPER}} .wd-nav-tabs.wd-style-default li:hover a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tabs-design-simple .tabs-name' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .wd-nav-tabs.wd-style-underline .nav-link-text:after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tabs_title_color',
			array(
				'label'     => esc_html__( 'Title color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tabs-name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tabs_heading_typography',
				'label'    => esc_html__( 'Title typography', 'omniverse' ),
				'selector' => '{{WRAPPER}} .wd-tabs .tabs-name',
			)
		);

		$this->add_control(
			'tabs_description_color',
			array(
				'label'     => esc_html__( 'Description color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wd-tabs-desc' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'design' => array( 'default', 'aside' ),
				),
			)
		);

		$this->add_control(
			'enable_heading_bg',
			array(
				'label'        => esc_html__( 'Heading background', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'heading_bg',
			array(
				'label'     => esc_html__( 'Custom background color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wd-tabs.wd-header-with-bg .wd-tabs-header' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'enable_heading_bg' => 'yes',
				),
			)
		);

		$this->add_control(
			'alignment',
			[
				'label'     => esc_html__( 'Alignment', 'omniverse' ),
				'type'      => 'wd_buttons',
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					],
				],
				'default'   => 'center',
				'condition' => [
					'design' => 'default',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Tabs Style.
		 */
		$this->start_controls_section(
			'title_style_section',
			[
				'label' => esc_html__( 'Tab title', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tabs_style',
			array(
				'label'     => esc_html__( 'Style', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'default'   => esc_html__( 'Default', 'omniverse' ),
					'underline' => esc_html__( 'Underline', 'omniverse' ),
				),
				'default'   => 'underline',
				'condition' => array(
					'design!' => array( 'simple' ),
				),
			)
		);

		$this->add_control(
			'title_text_color_scheme',
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
					'title_text_color_scheme' => 'custom',
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
					'{{WRAPPER}} .wd-nav-wrapper .wd-nav > li > a' => 'color: {{VALUE}}',
				),
				array(
					'condition' => array(
						'title_text_color_scheme' => 'custom',
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
					'{{WRAPPER}} .wd-nav-wrapper .wd-nav > li:hover > a' => 'color: {{VALUE}}',
				),
				array(
					'condition' => array(
						'title_text_color_scheme' => 'custom',
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
					'{{WRAPPER}} .wd-nav-wrapper .wd-nav-tabs > li.wd-active > a, {{WRAPPER}} .wd-tabs:not(.wd-inited) .wd-nav-wrapper .wd-nav-tabs li:first-child a' => 'color: {{VALUE}}',
				),
				array(
					'condition' => array(
						'title_text_color_scheme' => 'custom',
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
				'selector' => '{{WRAPPER}} .wd-nav.wd-nav-tabs .wd-nav-link',
			)
		);

		$this->add_control(
			'icon_alignment_design_default',
			array(
				'label'     => esc_html__( 'Icon alignment', 'omniverse' ),
				'type'      => 'wd_buttons',
				'options'   => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/left.png',
					),
					'top'   => array(
						'title' => esc_html__( 'Top', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/top.png',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/right.png',
					),
				),
				'default'   => 'top',
				'condition' => array(
					'design' => array( 'default' ),
				),
			)
		);

		$this->add_control(
			'icon_alignment',
			array(
				'label'     => esc_html__( 'Icon alignment', 'omniverse' ),
				'type'      => 'wd_buttons',
				'options'   => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/left.png',
					),
					'top'   => array(
						'title' => esc_html__( 'Top', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/top.png',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/right.png',
					),
				),
				'default'   => 'left',
				'condition' => array(
					'design!' => array( 'default' ),
				),
			)
		);

		$this->add_responsive_control(
			'space_between_tabs_title_horizontal',
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
				'condition' => array(
					'design!' => array( 'aside' ),
				),
			)
		);

		$this->add_responsive_control(
			'space_between_tabs_title_vertical',
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
					'{{WRAPPER}} .wd-tabs' => '--wd-header-sp: {{SIZE}}px;',
				),
				'devices'   => array( 'desktop', 'tablet', 'mobile' ),
				'classes'   => 'wd-hide-custom-breakpoints',
				'condition' => array(
					'design!' => array( 'aside' ),
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Products layout settings.
		 */
		$this->start_controls_section(
			'products_layout_style_section',
			[
				'label' => esc_html__( 'Products layout', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => array(
					'grid'     => esc_html__( 'Grid', 'omniverse' ),
					'list'     => esc_html__( 'List', 'omniverse' ),
					'carousel' => esc_html__( 'Carousel', 'omniverse' ),
				),
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label'       => esc_html__( 'Columns', 'omniverse' ),
				'description' => esc_html__( 'Number of columns in the grid.', 'omniverse' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size' => 4,
				],
				'size_units'  => '',
				'range'       => [
					'px' => [
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					],
				],
				'devices'     => array( 'desktop', 'tablet', 'mobile' ),
				'classes'     => 'wd-hide-custom-breakpoints',
				'condition'   => [
					'layout' => 'grid',
				],
			]
		);

		$this->add_control(
			'products_masonry',
			[
				'label'       => esc_html__( 'Masonry grid', 'omniverse' ),
				'description' => esc_html__( 'Products may have different sizes.', 'omniverse' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => array(
					''        => esc_html__( 'Inherit', 'omniverse' ),
					'enable'  => esc_html__( 'Enable', 'omniverse' ),
					'disable' => esc_html__( 'Disable', 'omniverse' ),
				),
				'condition'   => [
					'layout' => 'grid',
				],
			]
		);

		$this->add_control(
			'products_different_sizes',
			[
				'label'       => esc_html__( 'Products grid with different sizes', 'omniverse' ),
				'description' => esc_html__( 'In this situation, some of the products will be twice bigger in width than others. Recommended to use with 6 columns grid only.', 'omniverse' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => array(
					''        => esc_html__( 'Inherit', 'omniverse' ),
					'enable'  => esc_html__( 'Enable', 'omniverse' ),
					'disable' => esc_html__( 'Disable', 'omniverse' ),
				),
				'condition'   => [
					'layout' => 'grid',
				],
			]
		);

		$this->add_responsive_control(
			'spacing',
			[
				'label'     => esc_html__( 'Space between', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'' => esc_html__( 'Inherit', 'omniverse' ),
					0  => esc_html__( '0 px', 'omniverse' ),
					2  => esc_html__( '2 px', 'omniverse' ),
					6  => esc_html__( '6 px', 'omniverse' ),
					10 => esc_html__( '10 px', 'omniverse' ),
					20 => esc_html__( '20 px', 'omniverse' ),
					30 => esc_html__( '30 px', 'omniverse' ),
				],
				'default'   => '',
				'devices'   => array( 'desktop', 'tablet', 'mobile' ),
				'classes'   => 'wd-hide-custom-breakpoints',
				'condition' => [
					'layout' => [ 'grid', 'carousel' ],
				],
			]
		);

		$this->add_control(
			'items_per_page',
			[
				'label'       => esc_html__( 'Items per page', 'omniverse' ),
				'description' => esc_html__( 'Number of items to show per page.', 'omniverse' ),
				'default'     => 12,
				'type'        => Controls_Manager::NUMBER,
			]
		);

		$this->add_control(
			'pagination',
			[
				'label'     => esc_html__( 'Pagination', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''         => esc_html__( 'Inherit', 'omniverse' ),
					'more-btn' => esc_html__( 'Load more button', 'omniverse' ),
					'infinit'  => esc_html__( 'Infinit scrolling', 'omniverse' ),
					'arrows'   => esc_html__( 'Arrows', 'omniverse' ),
				),
				'condition' => [
					'layout!' => 'carousel',
				],
			]
		);

		$this->add_control(
			'pagination_arrows_position_popover',
			array(
				'label'     => esc_html__( 'Arrows position', 'omniverse' ),
				'type'      => Controls_Manager::POPOVER_TOGGLE,
				'condition' => array(
					'layout!'    => 'carousel',
					'pagination' => 'arrows',
				),
			)
		);

		$this->start_popover();

		$this->add_control(
			'pagination_arrows_position',
			[
				'label'     => esc_html__( 'Position', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''         => esc_html__( 'Inherit from Theme Settings', 'omniverse' ),
					'sep'      => esc_html__( 'Separate', 'omniverse' ),
					'together' => esc_html__( 'Together', 'omniverse' ),
				),
				'condition' => [
					'layout!'                             => 'carousel',
					'pagination'                          => 'arrows',
					'pagination_arrows_position_popover!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_arrows_offset_h',
			array(
				'label'      => esc_html__( 'Offset horizontal', 'omniverse' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wd-nav-arrows' => '--wd-arrow-offset-h: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!'                             => 'carousel',
					'pagination'                          => 'arrows',
					'pagination_arrows_position_popover!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'pagination_arrows_offset_v',
			array(
				'label'      => esc_html__( 'Offset vertical', 'omniverse' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wd-nav-arrows' => '--wd-arrow-offset-v: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!'                             => 'carousel',
					'pagination'                          => 'arrows',
					'pagination_arrows_position_popover!' => '',
				),
			)
		);

		$this->end_popover();

		$this->end_controls_section();

		/**
		 * Products design settings.
		 */
		$this->start_controls_section(
			'products_design_style_section',
			[
				'label' => esc_html__( 'Products design', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'product_hover',
			[
				'label'     => esc_html__( 'Products hover', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'inherit',
				'options'   => array(
					'inherit'          => esc_html__( 'Inherit from Theme Settings', 'omniverse' ),
					'info-alt'         => esc_html__( 'Full info on hover', 'omniverse' ),
					'info'             => esc_html__( 'Full info on image', 'omniverse' ),
					'alt'              => esc_html__( 'Icons and "add to cart" on hover', 'omniverse' ),
					'icons'            => esc_html__( 'Icons on hover', 'omniverse' ),
					'quick'            => esc_html__( 'Quick', 'omniverse' ),
					'button'           => esc_html__( 'Show button on hover on image', 'omniverse' ),
					'base'             => esc_html__( 'Show summary on hover', 'omniverse' ),
					'standard'         => esc_html__( 'Standard button', 'omniverse' ),
					'tiled'            => esc_html__( 'Tiled', 'omniverse' ),
					'fw-button'        => esc_html__( 'Full width button', 'omniverse' ),
					'buttons-on-hover' => esc_html__( 'Buttons on hover', 'omniverse' ),
				),
				'condition' => [
					'layout!' => 'list',
				],
			]
		);

		$this->add_control(
			'img_size',
			[
				'label'   => esc_html__( 'Image size', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'large',
				'options' => omniverse_get_all_image_sizes_names( 'elementor' ),
			]
		);

		$this->add_control(
			'img_size_custom',
			[
				'label'       => esc_html__( 'Image dimension', 'omniverse' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => esc_html__( 'You can crop the original image size to any custom size. You can also set a single value for height or width in order to keep the original size ratio.', 'omniverse' ),
				'condition'   => [
					'img_size' => 'custom',
				],
			]
		);

		$this->add_control(
			'rounding_size',
			array(
				'label'     => esc_html__( 'Rounding', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''       => esc_html__( 'Inherit', 'omniverse' ),
					'0'      => esc_html__( '0', 'omniverse' ),
					'5'      => esc_html__( '5', 'omniverse' ),
					'8'      => esc_html__( '8', 'omniverse' ),
					'12'     => esc_html__( '12', 'omniverse' ),
					'custom' => esc_html__( 'Custom', 'omniverse' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}}' => '--wd-brd-radius: {{VALUE}}px;',
				),
			)
		);

		$this->add_control(
			'custom_rounding_size',
			array(
				'label'      => esc_html__( 'Rounding', 'omniverse' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
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
					'{{WRAPPER}}' => '--wd-brd-radius: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'rounding_size' => array( 'custom' ),
				),
			)
		);

		$this->add_control(
			'sale_countdown',
			[
				'label'        => esc_html__( 'Sale countdown', 'omniverse' ),
				'description'  => esc_html__( 'Countdown to the end sale date will be shown. Be sure you have set final date of the product sale price.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '0',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => '1',
			]
		);

		$this->add_responsive_control(
			'stretch_product',
			[
				'label'        => esc_html__( 'Even product grid', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '0',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => '1',
				'devices'      => array( 'desktop', 'tablet', 'mobile' ),
				'classes'      => 'wd-hide-custom-breakpoints',
				'condition'    => array(
					'product_hover' => array( 'icons', 'alt', 'button', 'standard', 'tiled', 'quick', 'base', 'fw-button', 'buttons-on-hover' ),
				),
			]
		);

		$this->add_control(
			'stock_progress_bar',
			[
				'label'        => esc_html__( 'Stock progress bar', 'omniverse' ),
				'description'  => esc_html__( 'Display a number of sold and in stock products as a progress bar.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '0',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => '1',
			]
		);

		$this->add_control(
			'products_color_scheme',
			array(
				'label'        => esc_html__( 'Products color scheme', 'omniverse' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'default',
				'options'      => array(
					'default' => esc_html__( 'Default', 'omniverse' ),
					'dark'    => esc_html__( 'Dark', 'omniverse' ),
					'light'   => esc_html__( 'Light', 'omniverse' ),
				),
			)
		);

		$this->add_control(
			'products_bordered_grid',
			[
				'label'        => esc_html__( 'Bordered grid', 'omniverse' ),
				'description'  => esc_html__( 'Add borders between the products in your grid.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '0',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => '1',
			]
		);

		$this->add_control(
			'products_bordered_grid_style',
			array(
				'label'       => esc_html__( 'Bordered grid style', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'outside' => esc_html__( 'Outside', 'omniverse' ),
					'inside'  => esc_html__( 'inside', 'omniverse' ),
				),
				'condition' => array(
					'products_bordered_grid' => array( '1' ),
				),
				'default' => 'outside',
			)
		);

		$this->add_control(
			'products_with_background',
			array(
				'label'        => esc_html__( 'Products background', 'omniverse' ),
				'description'  => esc_html__( 'Add a background to the products in your grid.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '0',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => '1',
			)
		);

		$this->add_control(
			'products_background',
			array(
				'label'     => esc_html__( 'Custom background color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wd-products-with-bg, {{WRAPPER}} .wd-products-with-bg .wd-product' => '--wd-prod-bg:{{VALUE}}; --wd-bordered-bg:{{VALUE}};',
				),
				'condition' => array(
					'products_with_background' => array( '1' ),
				),
			)
		);

		$this->add_control(
			'products_shadow',
			array(
				'label'        => esc_html__( 'Products shadow', 'omniverse' ),
				'description'  => esc_html__( 'Add a shadow to products if the initial product style did not have one.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '0',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => '1',
			)
		);

		$this->add_control(
			'product_quantity',
			[
				'label'        => esc_html__( 'Quantity input on product', 'omniverse' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => array(
					''        => esc_html__( 'Inherit', 'omniverse' ),
					'enable'  => esc_html__( 'Enable', 'omniverse' ),
					'disable' => esc_html__( 'Disable', 'omniverse' ),
				),
			]
		);

		$this->add_control(
			'grid_gallery',
			array(
				'label'       => esc_html__( 'Product gallery', 'omniverse' ),
				'description' => esc_html__( 'Add the ability to view the product gallery on the products loop.', 'omniverse' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => array(
					''    => esc_html__( 'Inherit', 'omniverse' ),
					'yes' => esc_html__( 'Yes', 'omniverse' ),
					'no'  => esc_html__( 'No', 'omniverse' ),
				),
			)
		);

		$this->start_controls_tabs(
			'grid_gallery_tabs',
			array(
				'condition' => array(
					'grid_gallery' => array( 'yes' ),
				),
			)
		);

		$this->start_controls_tab(
			'grid_gallery_desktop_tab',
			array(
				'label' => esc_html__( 'Desktop', 'omniverse' ),
			)
		);

		$this->add_control(
			'grid_gallery_control',
			array(
				'label'   => esc_html__( 'Product gallery controls', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''       => esc_html__( 'Inherit', 'omniverse' ),
					'arrows' => esc_html__( 'Arrows', 'omniverse' ),
					'hover'  => esc_html__( 'Hover', 'omniverse' ),
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'grid_gallery_mobile_tab',
			[
				'label' => esc_html__( 'Mobile devices', 'omniverse' ),
			]
		);

		$this->add_control(
			'grid_gallery_enable_arrows',
			array(
				'label'   => esc_html__( 'Product gallery controls', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''       => esc_html__( 'Inherit', 'omniverse' ),
					'none'   => esc_html__( 'None', 'omniverse' ),
					'arrows' => esc_html__( 'Arrows', 'omniverse' ),
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Extra settings.
		 */
		$this->start_controls_section(
			'extra_style_section',
			[
				'label' => esc_html__( 'Extra', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'lazy_loading',
			[
				'label'        => esc_html__( 'Lazy loading for images', 'omniverse' ),
				'description'  => esc_html__( 'Enable lazy loading for images for this element.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		omniverse_elementor_products_tabs_template( $this->get_settings_for_display() );
	}
}

Plugin::instance()->widgets_manager->register( new Products_Tabs() );
