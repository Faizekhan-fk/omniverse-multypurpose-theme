<?php
/**
 * Blog map.
 *
 * @package dn
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
class Blog extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_blog';
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
		return esc_html__( 'Blog', 'omniverse' );
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
		return 'wd-icon-blog';
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
			'post_type',
			[
				'label'       => esc_html__( 'Data source', 'omniverse' ),
				'description' => esc_html__( 'Select content type for your grid.', 'omniverse' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'post' => esc_html__( 'Post', 'omniverse' ),
					'ids'  => esc_html__( 'List of IDs', 'omniverse' ),
				],
				'default'     => 'post',
			]
		);

		$this->add_control(
			'include',
			[
				'label'       => esc_html__( 'Include only', 'omniverse' ),
				'description' => esc_html__( 'Add posts, pages, etc. by title.', 'omniverse' ),
				'type'        => 'wd_autocomplete',
				'search'      => 'omniverse_get_posts_by_query',
				'render'      => 'omniverse_get_posts_title_by_id',
				'post_type'   => 'post',
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'post_type' => 'ids',
				],
			]
		);

		$this->add_control(
			'taxonomies',
			[
				'label'       => esc_html__( 'Categories or tags', 'omniverse' ),
				'description' => esc_html__( 'Enter categories, tags or custom taxonomies.', 'omniverse' ),
				'type'        => 'wd_autocomplete',
				'search'      => 'omniverse_get_taxonomies_by_query',
				'render'      => 'omniverse_get_taxonomies_title_by_id',
				'taxonomy'    => [ 'category', 'post_tag' ],
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'post_type!' => 'ids',
				],
			]
		);

		$this->add_control(
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
				),
			]
		);

		$this->add_control(
			'order',
			[
				'label'       => esc_html__( 'Sort order', 'omniverse' ),
				'description' => 'Designates the ascending or descending order. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>.',
				'type'        => Controls_Manager::SELECT,
				'default'     => 'DESC',
				'options'     => array(
					'DESC' => esc_html__( 'Descending', 'omniverse' ),
					'ASC'  => esc_html__( 'Ascending', 'omniverse' ),
				),
			]
		);

		$this->add_control(
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

		$this->add_control(
			'offset',
			[
				'label'       => esc_html__( 'Offset', 'omniverse' ),
				'description' => esc_html__( 'Number of grid elements to displace or pass over.', 'omniverse' ),
				'type'        => Controls_Manager::TEXT,
				'condition'   => [
					'post_type!' => 'ids',
				],
			]
		);

		$this->add_control(
			'exclude',
			[
				'label'       => esc_html__( 'Exclude', 'omniverse' ),
				'description' => esc_html__( 'Exclude posts, pages, etc. by title.', 'omniverse' ),
				'type'        => 'wd_autocomplete',
				'search'      => 'omniverse_get_posts_by_query',
				'render'      => 'omniverse_get_posts_title_by_id',
				'post_type'   => 'post',
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'post_type!' => 'ids',
				],
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
			'blog_design',
			[
				'label'       => esc_html__( 'Blog design', 'omniverse' ),
				'description' => esc_html__( 'Choose one of the blog designs available in the theme.', 'omniverse' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'default',
				'options'     => array(
					'default'      => esc_html__( 'Default', 'omniverse' ),
					'default-alt'  => esc_html__( 'Default alternative', 'omniverse' ),
					'small-images' => esc_html__( 'Small images', 'omniverse' ),
					'chess'        => esc_html__( 'Chess', 'omniverse' ),
					'masonry'      => esc_html__( 'Masonry grid', 'omniverse' ),
					'mask'         => esc_html__( 'Mask on image', 'omniverse' ),
					'meta-image'   => esc_html__( 'Meta on image', 'omniverse' ),
					'carousel'     => esc_html__( 'Carousel', 'omniverse' ),
					'list'         => esc_html__( 'List', 'omniverse' ),
				),
			]
		);

		$this->add_control(
			'blog_carousel_design',
			[
				'label'       => esc_html__( 'Blog carousel design', 'omniverse' ),
				'description' => esc_html__( 'Choose one of the blog designs available in the theme.', 'omniverse' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'masonry',
				'options'     => array(
					'masonry'      => esc_html__( 'Default', 'omniverse' ),
					'small-images' => esc_html__( 'Small images', 'omniverse' ),
					'mask'         => esc_html__( 'Mask on image', 'omniverse' ),
					'meta-image'   => esc_html__( 'Meta on image', 'omniverse' ),
				),
				'condition'   => [
					'blog_design' => 'carousel',
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

		$this->add_responsive_control(
			'blog_columns',
			[
				'label'       => esc_html__( 'Columns', 'omniverse' ),
				'description' => esc_html__( 'Number of columns in the grid.', 'omniverse' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size' => 3,
				],
				'size_units'  => '',
				'range'       => [
					'px' => [
						'min'  => 1,
						'max'  => 4,
						'step' => 1,
					],
				],
				'devices'     => array( 'desktop', 'tablet', 'mobile' ),
				'classes'     => 'wd-hide-custom-breakpoints',
				'condition'   => [
					'blog_design' => [ 'masonry', 'mask', 'meta-image' ],
				],
			]
		);

		$this->add_responsive_control(
			'blog_spacing',
			[
				'label'     => esc_html__( 'Space between', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'' => esc_html__( 'Inherit from Theme Settings', 'omniverse' ),
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
					'blog_design' => [ 'mask', 'masonry', 'carousel', 'meta-image' ],
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
				),
				'condition' => [
					'blog_design!' => 'carousel',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Visibility settings.
		 */
		$this->start_controls_section(
			'visibility_style_section',
			[
				'label' => esc_html__( 'Elements visibility', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'parts_title',
			[
				'label'        => esc_html__( 'Title for posts', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '1',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => '1',
			]
		);

		$this->add_control(
			'parts_meta',
			[
				'label'        => esc_html__( 'Meta information', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '1',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => '1',
			]
		);

		$this->add_control(
			'parts_text',
			[
				'label'        => esc_html__( 'Post text', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '1',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => '1',
			]
		);

		$this->add_control(
			'parts_btn',
			[
				'label'        => esc_html__( 'Read more button', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '1',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => '1',
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
		omniverse_elementor_blog_template( $this->get_settings_for_display() );
	}
}

Plugin::instance()->widgets_manager->register( new Blog() );
