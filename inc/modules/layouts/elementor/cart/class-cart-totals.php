<?php
/**
 * Cart totals map.
 *
 * @package Omniverse
 */

namespace DN\Modules\Layouts;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Base;
use WC_Shortcode_Cart;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 */
class Cart_Totals extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_cart_totals';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Cart totals', 'omniverse' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'wd-icon-ct-cart-table';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'wd-cart-elements' );
	}

	/**
	 * Show in panel.
	 *
	 * @return bool Whether to show the widget in the panel or not.
	 */
	public function show_in_panel() {
		return Main::is_layout_type( 'cart' );
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return array( 'wc-cart' );
	}

	/**
	 * Register the widget controls.
	 */
	protected function register_controls() {

		/**
		 * Style tab.
		 */

		/**
		 * Title settings.
		 */
		$this->start_controls_section(
			'title_style_section',
			array(
				'label' => esc_html__( 'Title', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title',
			array(
				'label'        => esc_html__( 'Enable title', 'omniverse' ),
				'description'  => esc_html__( 'If "NO" title will be removed.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'show',
				'return_value' => 'show',
				'prefix_class' => 'wd-title-',
			)
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'omniverse' ),
				'selector' => '{{WRAPPER}} .cart-totals-inner > h2',
				'condition' => array(
					'title' => 'show',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cart-totals-inner > h2' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'title' => 'show',
				),
			)
		);

		$this->add_control(
			'title_alignment',
			array(
				'label'        => esc_html__( 'Alignment', 'omniverse' ),
				'type'         => 'wd_buttons',
				'options'      => array(
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
				'prefix_class' => 'text-',
				'default'      => '',
				'condition' => array(
					'title' => 'show',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Button settings.
		 */
		$this->start_controls_section(
			'general_style_section',
			array(
				'label' => esc_html__( 'Button', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'css_classes',
			array(
				'type'         => 'wd_css_class',
				'default'      => 'wd-cart-totals',
				'prefix_class' => '',
			)
		);

		$this->add_control(
			'button_alignment',
			array(
				'label'        => esc_html__( 'Button position', 'omniverse' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'left'       => esc_html__( 'Left', 'omniverse' ),
					'center'     => esc_html__( 'Center', 'omniverse' ),
					'right'      => esc_html__( 'Right', 'omniverse' ),
					'full-width' => esc_html__( 'Full width', 'omniverse' ),
				),
				'prefix_class' => 'wd-btn-align-',
				'default'      => '',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 */
	protected function render() {
		if ( ! is_object( WC()->cart ) || 0 === WC()->cart->get_cart_contents_count() ) {
			return;
		}

		$nonce_value = wc_get_var( $_REQUEST['woocommerce-shipping-calculator-nonce'], wc_get_var( $_REQUEST['_wpnonce'], '' ) ); // @codingStandardsIgnoreLine.

		// Update Shipping. Nonce check uses new value and old value (woocommerce-cart). @todo remove in 4.0.
		if ( ! empty( $_POST['calc_shipping'] ) && ( wp_verify_nonce( $nonce_value, 'woocommerce-shipping-calculator' ) || wp_verify_nonce( $nonce_value, 'woocommerce-cart' ) ) ) { // WPCS: input var ok.
			$shortcode_cart = new WC_Shortcode_Cart();
			$shortcode_cart->calculate_shipping();
		}

		wc()->cart->calculate_fees();
		wc()->cart->calculate_shipping();
		wc()->cart->calculate_totals();

		woocommerce_cart_totals();
	}
}

Plugin::instance()->widgets_manager->register( new Cart_Totals() );
