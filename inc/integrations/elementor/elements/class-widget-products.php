<?php
/**
 * WC Products widget map.
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
class Products_Widget extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_products_widget';
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
		return esc_html__( 'WC Products widget', 'omniverse' );
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
		return 'wd-icon-widget-products';
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
			'title',
			[
				'label' => esc_html__( 'Title', 'omniverse' ),
				'type'  => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'show',
			[
				'label'   => esc_html__( 'Show', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''            => esc_html__( 'All Products', 'omniverse' ),
					'featured'    => esc_html__( 'Featured Products', 'omniverse' ),
					'onsale'      => esc_html__( 'On-sale Products', 'omniverse' ),
					'product_ids' => esc_html__( 'List of IDs', 'omniverse' ),
				],
				'default' => '',
			]
		);

		$this->add_control(
			'number',
			[
				'label'      => esc_html__( 'Number of products to show', 'omniverse' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 3,
				],
				'size_units' => '',
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 7,
						'step' => 1,
					],
				],
				'condition'  => [
					'show!' => [ 'product_ids' ],
				],
			]
		);

		$this->add_control(
			'include_products',
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
					'show' => 'product_ids',
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'     => esc_html__( 'Order by', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'date',
				'options'   => array(
					'date'  => esc_html__( 'Date', 'omniverse' ),
					'rand'  => esc_html__( 'Random order', 'omniverse' ),
					'price' => esc_html__( 'Price', 'omniverse' ),
					'sales' => esc_html__( 'Sales', 'omniverse' ),
				),
				'condition' => [
					'show!' => 'product_ids',
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'     => esc_html__( 'Sort order', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'ASC',
				'options'   => array(
					'DESC' => esc_html__( 'Descending', 'omniverse' ),
					'ASC'  => esc_html__( 'Ascending', 'omniverse' ),
				),
				'condition' => [
					'show!' => 'product_ids',
				],
			]
		);

		$this->add_control(
			'ids',
			[
				'label'       => esc_html__( 'Categories', 'omniverse' ),
				'description' => esc_html__( 'List of product categories.', 'omniverse' ),
				'type'        => 'wd_autocomplete',
				'search'      => 'omniverse_get_taxonomies_by_query',
				'render'      => 'omniverse_get_taxonomies_title_by_id',
				'taxonomy'    => [ 'product_cat' ],
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'show!' => 'product_ids',
				],
			]
		);

		$this->add_control(
			'images_size',
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
					'images_size' => 'custom',
				],
			]
		);

		$this->add_control(
			'hide_free',
			[
				'label'        => esc_html__( 'Hide free products', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '0',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => '1',
			]
		);

		$this->add_control(
			'show_hidden',
			[
				'label'        => esc_html__( 'Show hidden products', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '0',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => '1',
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
		global $omniverse_widget_product_img_size, $omniverse_widget_product_img_size_custom;

		$default_settings = [
			'title'            => '',
			'show'             => '',
			'number'           => [ 'size' => 3 ],
			'include_products' => '',
			'orderby'          => 'date',
			'order'            => 'asc',
			'ids'              => '',
			'hide_free'        => 0,
			'show_hidden'      => 0,
			'images_size'      => 'woocommerce_thumbnail',
			'img_size_custom'  => array(),
		];

		$settings = wp_parse_args( $this->get_settings_for_display(), $default_settings );

		$omniverse_widget_product_img_size        = $settings['images_size'];
		$omniverse_widget_product_img_size_custom = $settings['img_size_custom'];
		$this->ids                               = $settings['ids'];
		$this->include_products                  = $settings['include_products'];
		$type                                    = 'WC_Widget_Products';
		$settings['number']                      = isset( $settings['number']['size'] ) ? $settings['number']['size'] : 3;

		omniverse_enqueue_inline_style( 'widget-product-list' );
		?>
		<div class="widget_products">
			<?php
			$args = array( 'widget_id' => uniqid() );

			add_filter( 'woocommerce_products_widget_query_args', array( $this, 'add_category_order' ), 10 );
			add_filter( 'woocommerce_products_widget_query_args', array( $this, 'add_product_order' ), 20 );

			if ( function_exists( 'omniverse_woocommerce_installed' ) && omniverse_woocommerce_installed() ) {
				the_widget( $type, $settings, $args );
			}

			remove_filter( 'woocommerce_products_widget_query_args', array( $this, 'add_category_order' ), 10 );
			remove_filter( 'woocommerce_products_widget_query_args', array( $this, 'add_product_order' ), 20 );
			?>
		</div>
		<?php

		unset( $omniverse_widget_product_img_size );
		unset( $omniverse_widget_product_img_size_custom );
	}

	public function add_category_order( $query_args ) {
		if ( isset( $this->ids[0] ) && $this->ids[0] ) {
			$query_args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'id',
				'terms'    => $this->ids,
			);
		}

		return $query_args;
	}

	public function add_product_order( $query_args ) {
		if ( isset( $this->include_products[0] ) && $this->include_products[0] ) {
			$query_args['post__in']       = $this->include_products;
			$query_args['orderby']        = 'post__in';
			$query_args['posts_per_page'] = - 1;
		}

		return $query_args;
	}
}

Plugin::instance()->widgets_manager->register( new Products_Widget() );
