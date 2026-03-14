<?php
/**
 * Products element.
 *
 * @package Omniverse
 */

namespace DN\Modules\Layouts;

use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 */
class Archive_Products extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_archive_products';
	}

	/**
	 * Get widget content.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Archive products', 'omniverse' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'wd-icon-sa-archive-products';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'wd-shop-archive-elements' );
	}

	/**
	 * Show in panel.
	 *
	 * @return bool Whether to show the widget in the panel or not.
	 */
	public function show_in_panel() {
		return Main::is_layout_type( 'shop_archive' );
	}

	/**
	 * Register the widget controls.
	 */
	protected function register_controls() {
		/**
		 * Content tab
		 */

		/**
		 * General settings
		 */
		$this->start_controls_section(
			'general_style_section',
			array(
				'label' => esc_html__( 'General', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'css_classes',
			array(
				'type'         => 'wd_css_class',
				'default'      => 'wd-shop-product',
				'prefix_class' => '',
			)
		);

		$this->add_control(
			'wrapper_css_classes',
			array(
				'type'         => 'wd_css_class',
				'default'      => 'wd-products-element',
				'prefix_class' => '',
			)
		);

		$this->add_control(
			'products_view',
			array(
				'label'   => esc_html__( 'Products view', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'inherit' => esc_html__( 'Inherit from Theme Settings', 'omniverse' ),
					'grid'    => esc_html__( 'Grid', 'omniverse' ),
					'list'    => esc_html__( 'List', 'omniverse' ),
				),
				'default' => 'inherit',
			)
		);

		$this->add_control(
			'product_hover',
			array(
				'label'     => esc_html__( 'Hover on product', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
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
				'default'   => 'inherit',
				'condition' => array(
					'products_view!' => array( 'list' ),
				),
			)
		);

		$this->add_responsive_control(
			'products_columns',
			array(
				'label'          => esc_html__( 'Products columns', 'omniverse' ),
				'type'           => Controls_Manager::SELECT,
				'options'        => array(
					'inherit' => esc_html__( 'Inherit from Theme Settings', 'omniverse' ),
					'1'       => esc_html__( '1', 'omniverse' ),
					'2'       => esc_html__( '2', 'omniverse' ),
					'3'       => esc_html__( '3', 'omniverse' ),
					'4'       => esc_html__( '4', 'omniverse' ),
					'5'       => esc_html__( '5', 'omniverse' ),
					'6'       => esc_html__( '6', 'omniverse' ),
				),
				'default'        => 'inherit',
				'tablet_default' => 'inherit',
				'mobile_default' => 'inherit',
				'render_type'    => 'template',
				'devices'        => array( 'desktop', 'tablet', 'mobile' ),
				'classes'        => 'wd-hide-custom-breakpoints',
			)
		);

		$this->add_responsive_control(
			'products_spacing',
			array(
				'label'   => esc_html__( 'Space between products', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'inherit' => esc_html__( 'Inherit from Theme Settings', 'omniverse' ),
					'0'       => esc_html__( '0', 'omniverse' ),
					'2'       => esc_html__( '2', 'omniverse' ),
					'6'       => esc_html__( '6', 'omniverse' ),
					'10'      => esc_html__( '10', 'omniverse' ),
					'20'      => esc_html__( '20', 'omniverse' ),
					'30'      => esc_html__( '30', 'omniverse' ),
				),
				'default' => 'inherit',
				'devices' => array( 'desktop', 'tablet', 'mobile' ),
				'classes' => 'wd-hide-custom-breakpoints',
			)
		);

		$this->add_control(
			'shop_pagination',
			array(
				'label'   => esc_html__( 'Products pagination', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'inherit'    => esc_html__( 'Inherit from Theme Settings', 'omniverse' ),
					'pagination' => esc_html__( 'Pagination', 'omniverse' ),
					'more-btn'   => esc_html__( '"Load more" button', 'omniverse' ),
					'infinit'    => esc_html__( 'Infinite scrolling', 'omniverse' ),
				),
				'default' => 'inherit',
			)
		);

		$this->add_control(
			'img_size',
			array(
				'label'   => esc_html__( 'Image size', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'large',
				'options' => omniverse_get_all_image_sizes_names( 'elementor' ),
			)
		);

		$this->add_control(
			'img_size_custom',
			array(
				'label'       => esc_html__( 'Image dimension', 'omniverse' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => esc_html__( 'You can crop the original image size to any custom size. You can also set a single value for height or width in order to keep the original size ratio.', 'omniverse' ),
				'condition'   => array(
					'img_size' => 'custom',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Products design settings.
		 */
		$this->start_controls_section(
			'products_design_style_section',
			array(
				'label' => esc_html__( 'Products design', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'products_color_scheme',
			array(
				'label'        => esc_html__( 'Products color scheme', 'omniverse' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'inherit',
				'options'      => array(
					'inherit' => esc_html__( 'Inherit from Theme Settings', 'omniverse' ),
					'default' => esc_html__( 'Default', 'omniverse' ),
					'dark'    => esc_html__( 'Dark', 'omniverse' ),
					'light'   => esc_html__( 'Light', 'omniverse' ),
				),
			)
		);

		$this->add_control(
			'products_bordered_grid',
			array(
				'label'       => esc_html__( 'Bordered grid', 'omniverse' ),
				'description' => esc_html__( 'Add borders between the products in your grid', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'inherit' => esc_html__( 'Inherit from Theme Settings', 'omniverse' ),
					'enable'  => esc_html__( 'Enable', 'omniverse' ),
					'disable' => esc_html__( 'Disable', 'omniverse' ),
				),
				'default' => 'inherit',
			)
		);

		$this->add_control(
			'products_bordered_grid_style',
			array(
				'label'     => esc_html__( 'Bordered grid style', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'inherit' => esc_html__( 'Inherit from Theme Settings', 'omniverse' ),
					'outside' => esc_html__( 'Outside', 'omniverse' ),
					'inside'  => esc_html__( 'Inside', 'omniverse' ),
				),
				'condition' => array(
					'products_bordered_grid' => array( 'enable' ),
				),
				'default'   => 'inherit',
			)
		);

		$this->add_control(
			'products_with_background',
			array(
				'label'       => esc_html__( 'Products background', 'omniverse' ),
				'description' => esc_html__( 'Add a background to the products in your grid.', 'omniverse' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'inherit' => esc_html__( 'Inherit from Theme Settings', 'omniverse' ),
					'yes'     => esc_html__( 'Yes', 'omniverse' ),
					'no'      => esc_html__( 'No', 'omniverse' ),
				),
				'default'     => 'inherit',
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
					'products_with_background' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'products_shadow',
			array(
				'label'        => esc_html__( 'Products shadow', 'omniverse' ),
				'description'  => esc_html__( 'Add a shadow to products if the initial product style did not have one.', 'omniverse' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'inherit' => esc_html__( 'Inherit from Theme Settings', 'omniverse' ),
					'yes'     => esc_html__( 'Yes', 'omniverse' ),
					'no'      => esc_html__( 'No', 'omniverse' ),
				),
				'default'      => 'inherit',
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
				'products_view'            => 'inherit',
				'products_columns'         => 'inherit',
				'products_columns_tablet'  => 'inherit',
				'products_columns_mobile'  => 'inherit',
				'products_spacing'         => 'inherit',
				'products_spacing_tablet'  => 'inherit',
				'products_spacing_mobile'  => 'inherit',
				'shop_pagination'          => 'inherit',
				'product_hover'            => 'inherit',
				'products_bordered_grid'   => 'inherit',
				'img_size'                 => '',
				'img_size_custom'          => '',
				'products_color_scheme'    => 'inherit',
				'products_with_background' => 'inherit',
				'products_shadow'          => 'inherit',
			)
		);

		if ( 'yes' === $settings['products_with_background'] ) {
			$products_with_background = '1';
		} else if ( 'no' === $settings['products_with_background'] ) {
			$products_with_background = '0';
		}

		if ( 'yes' === $settings['products_shadow'] ) {
			$products_shadow = '1';
		} else if ( 'no' === $settings['products_shadow'] ) {
			$products_shadow = '0';
		}

		if ( ! empty( $settings['img_size'] ) ) {
			omniverse_set_loop_prop( 'img_size', $settings['img_size'] );
		}

		if ( ! empty( $settings['img_size_custom']['width'] ) || ! empty( $settings['img_size_custom']['height'] ) ) {
			omniverse_set_loop_prop( 'img_size_custom', $settings['img_size_custom'] );
		}

		Main::setup_preview();

		omniverse_sticky_loader( ' wd-content-loader' );

		if ( 'inherit' !== $settings['products_view'] ) {
			omniverse_set_loop_prop( 'products_view', omniverse_new_get_shop_view( $settings['products_view'], true ) );
		}

		if ( 'inherit' !== $settings['products_columns'] ) {
			omniverse_set_loop_prop( 'products_columns', omniverse_new_get_products_columns_per_row( $settings['products_columns'], true ) );
		}

		if ( 'inherit' !== $settings['products_columns_tablet'] ) {
			omniverse_set_loop_prop( 'products_columns_tablet', $settings['products_columns_tablet'] );
		}

		if ( 'inherit' !== $settings['products_columns_mobile'] ) {
			omniverse_set_loop_prop( 'products_columns_mobile', $settings['products_columns_mobile'] );
		}

		if ( 'inherit' !== $settings['products_spacing'] ) {
			omniverse_set_loop_prop( 'products_spacing', $settings['products_spacing'] );
		}

		if ( $settings['products_spacing_tablet'] && 'inherit' !== $settings['products_spacing_tablet'] ) {
			omniverse_set_loop_prop( 'products_spacing_tablet', $settings['products_spacing_tablet'] );
		}

		if ( $settings['products_spacing_mobile'] && 'inherit' !== $settings['products_spacing_mobile'] ) {
			omniverse_set_loop_prop( 'products_spacing_mobile', $settings['products_spacing_mobile'] );
		}

		if ( 'inherit' !== $settings['product_hover'] && ! empty( $settings['product_hover'] ) ) {
			omniverse_set_loop_prop( 'product_hover', $settings['product_hover'] );
		}

		if ( 'inherit' !== $settings['shop_pagination'] ) {
			Global_Data::get_instance()->set_data( 'shop_pagination', $settings['shop_pagination'] );
		}

		if ( 'inherit' !== $settings['products_bordered_grid'] ) {
			omniverse_set_loop_prop( 'products_bordered_grid', $settings['products_bordered_grid'] );
		}

		if ( $settings['products_bordered_grid_style'] && 'inherit' !== $settings['products_bordered_grid_style'] ) {
			omniverse_set_loop_prop( 'products_bordered_grid_style', $settings['products_bordered_grid_style'] );
		}

		if ( $settings['products_color_scheme'] && 'inherit' !== $settings['products_color_scheme'] ) {
			omniverse_set_loop_prop( 'products_color_scheme', $settings['products_color_scheme'] );
		}

		if ( isset( $products_with_background ) ) {
			omniverse_set_loop_prop( 'products_with_background', $products_with_background );
		}

		if ( isset( $products_shadow ) ) {
			omniverse_set_loop_prop( 'products_shadow', $products_shadow );
		}

		do_action( 'omniverse_woocommerce_main_loop' );

		Main::restore_preview();
	}
}

Plugin::instance()->widgets_manager->register( new Archive_Products() );
