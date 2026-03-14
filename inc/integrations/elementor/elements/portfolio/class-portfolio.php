<?php
/**
 * Portfolio map.
 */

namespace DN\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Portfolio extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_portfolio';
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
		return esc_html__( 'Portfolio', 'omniverse' );
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
		return 'wd-icon-portfolio';
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
			'extra_width_classes',
			array(
				'type'         => 'wd_css_class',
				'default'      => 'wd-width-100',
				'prefix_class' => '',
			)
		);

		$this->add_control(
			'categories',
			[
				'label'       => esc_html__( 'Categories or tags', 'omniverse' ),
				'description' => esc_html__( 'List of product categories.', 'omniverse' ),
				'type'        => 'wd_autocomplete',
				'search'      => 'omniverse_get_taxonomies_by_query',
				'render'      => 'omniverse_get_taxonomies_title_by_id',
				'taxonomy'    => [ 'project-cat' ],
				'multiple'    => true,
				'label_block' => true,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order by', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''           => '',
					'date'       => esc_html__( 'Date', 'omniverse' ),
					'id'         => esc_html__( 'ID', 'omniverse' ),
					'title'      => esc_html__( 'Title', 'omniverse' ),
					'modified'   => esc_html__( 'Last modified date', 'omniverse' ),
					'menu_order' => esc_html__( 'Menu order', 'omniverse' ),
				),
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Sort order', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''     => esc_html__( 'Inherit', 'omniverse' ),
					'DESC' => esc_html__( 'Descending', 'omniverse' ),
					'ASC'  => esc_html__( 'Ascending', 'omniverse' ),
				),
			]
		);

		$this->end_controls_section();

		/**
		 * Style tab.
		 */

		/**
		 * General settings.
		 */
		$this->start_controls_section(
			'general_style_section',
			[
				'label' => esc_html__( 'General', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'grid'     => esc_html__( 'Grid', 'omniverse' ),
					'carousel' => esc_html__( 'Carousel', 'omniverse' ),
				],
				'default' => 'grid',
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Style', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'inherit'       => esc_html__( 'Inherit from Theme Settings', 'omniverse' ),
					'hover'         => esc_html__( 'Show text on mouse over', 'omniverse' ),
					'hover-inverse' => esc_html__( 'Alternative', 'omniverse' ),
					'text-shown'    => esc_html__( 'Text under image', 'omniverse' ),
					'parallax'      => esc_html__( 'Mouse move parallax', 'omniverse' ),
				],
				'default' => 'inherit',
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__( 'Number of projects per page', 'omniverse' ),
				'type'  => Controls_Manager::TEXT,
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
				'condition'   => [
					'layout' => 'grid',
				],
				'range'       => [
					'px' => [
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					],
				],
				'devices'     => array( 'desktop', 'tablet', 'mobile' ),
				'classes'     => 'wd-hide-custom-breakpoints',
			]
		);

		$this->add_responsive_control(
			'spacing',
			[
				'label'   => esc_html__( 'Space between', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Inherit from Theme Settings', 'omniverse' ),
					0  => esc_html__( '0 px', 'omniverse' ),
					2  => esc_html__( '2 px', 'omniverse' ),
					6  => esc_html__( '6 px', 'omniverse' ),
					10 => esc_html__( '10 px', 'omniverse' ),
					20 => esc_html__( '20 px', 'omniverse' ),
					30 => esc_html__( '30 px', 'omniverse' ),
				],
				'default' => '',
				'devices' => array( 'desktop', 'tablet', 'mobile' ),
				'classes' => 'wd-hide-custom-breakpoints',
			]
		);

		$this->add_control(
			'filters',
			[
				'label'        => esc_html__( 'Show categories filters', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '0',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'condition'    => [
					'layout' => 'grid',
				],
				'return_value' => '1',
			]
		);

		$this->add_control(
			'filters_type',
			[
				'label'     => esc_html__( 'Filters type', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'links'   => esc_html__( 'Links', 'omniverse' ),
					'masonry' => esc_html__( 'Masonry', 'omniverse' ),
				],
				'default'   => 'masonry',
				'condition' => [
					'filters' => '1',
					'layout'  => 'grid',
				],
			]
		);

		$this->add_control(
			'pagination',
			[
				'label'     => esc_html__( 'Pagination', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''           => esc_html__( 'Inherit', 'omniverse' ),
					'pagination' => esc_html__( 'Pagination', 'omniverse' ),
					'load_more'  => esc_html__( 'Load more button', 'omniverse' ),
					'infinit'    => esc_html__( 'Infinit scrolling', 'omniverse' ),
					'disable'    => esc_html__( 'Disable', 'omniverse' ),
				),
				'condition' => [
					'layout' => 'grid',
				],
			]
		);

		$this->add_control(
			'image_size',
			[
				'label'   => esc_html__( 'Image size', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'large',
				'options' => omniverse_get_all_image_sizes_names( 'elementor' ),
			]
		);

		$this->add_control(
			'image_size_custom',
			[
				'label'       => esc_html__( 'Image dimension', 'omniverse' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => esc_html__( 'You can crop the original image size to any custom size. You can also set a single value for height or width in order to keep the original size ratio.', 'omniverse' ),
				'condition'   => [
					'image_size' => 'custom',
				],
			]
		);

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
		omniverse_elementor_portfolio_template( $this->get_settings_for_display() );
	}
}

Plugin::instance()->widgets_manager->register( new Portfolio() );
