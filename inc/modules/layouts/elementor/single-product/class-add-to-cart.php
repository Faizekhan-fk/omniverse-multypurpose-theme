<?php
/**
 * Add to cart map.
 *
 * @package Omniverse
 */

namespace DN\Modules\Layouts;

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use DN\Modules\Layouts\Global_Data as Builder;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 */
class Add_To_Cart extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_single_product_add_to_cart';
	}

	/**
	 * Get widget content.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Product add to cart', 'omniverse' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'wd-icon-sp-add-to-cart';
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
				'default'      => 'wd-single-add-cart',
				'prefix_class' => '',
			)
		);

		$this->add_control(
			'alignment',
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
				'default'      => 'left',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style_section',
			array(
				'label' => esc_html__( 'Button', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'button_design',
			array(
				'label'        => esc_html__( 'Design', 'omniverse' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'default' => esc_html__( 'Default', 'omniverse' ),
					'full'    => esc_html__( 'Full width button', 'omniverse' ),
				),
				'prefix_class' => 'wd-btn-design-',
				'default'      => 'default',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label'    => esc_html__( 'Typography', 'omniverse' ),
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .single_add_to_cart_button',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'variable_product_style_section',
			array(
				'label' => esc_html__( 'Variable product', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'design',
			array(
				'label'        => esc_html__( 'Design', 'omniverse' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'default' => esc_html__( 'Default', 'omniverse' ),
					'justify' => esc_html__( 'Justify', 'omniverse' ),
				),
				'prefix_class' => 'wd-design-',
				'default'      => 'default',
			)
		);

		$this->add_control(
			'swatch_layout',
			array(
				'label'        => esc_html__( 'Swatches layout', 'omniverse' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'default' => esc_html__( 'Default', 'omniverse' ),
					'inline'  => esc_html__( 'Inline', 'omniverse' ),
				),
				'prefix_class' => 'wd-swatch-layout-',
				'default'      => 'default',
			)
		);

		$this->add_responsive_control(
			'reset_button_position',
			array(
				'label'          => esc_html__( 'Clear button position', 'omniverse' ),
				'type'           => Controls_Manager::SELECT,
				'options'        => array(
					'side'   => esc_html__( 'Side', 'omniverse' ),
					'bottom' => esc_html__( 'Bottom', 'omniverse' ),
				),
				'devices'        => array( 'desktop', 'mobile' ),
				'classes'        => 'wd-hide-custom-breakpoints wd-hide-tablet-breakpoint',
				'default'        => 'side',
				'mobile_default' => 'side',
			)
		);

		$this->add_responsive_control(
			'label_position',
			array(
				'label'          => esc_html__( 'Swatch label position', 'omniverse' ),
				'type'           => Controls_Manager::SELECT,
				'options'        => array(
					'side' => esc_html__( 'Side', 'omniverse' ),
					'top'  => esc_html__( 'Top', 'omniverse' ),
					'hide' => esc_html__( 'Hide', 'omniverse' ),
				),
				'devices'        => array( 'desktop', 'mobile' ),
				'classes'        => 'wd-hide-custom-breakpoints wd-hide-tablet-breakpoint',
				'default'        => 'side',
				'mobile_default' => 'side',
				'render_type'    => 'template',
			)
		);

		$this->start_controls_tabs( 'price_settings_tabs' );

		$this->start_controls_tab(
			'main_price_tab',
			array(
				'label' => esc_html__( 'Price', 'omniverse' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label'    => esc_html__( 'Typography', 'omniverse' ),
				'name'     => 'main_price_typography',
				'selector' => '{{WRAPPER}} .price',
			)
		);

		$this->add_control(
			'main_price_text_color',
			array(
				'label'     => esc_html__( 'Text color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .price, {{WRAPPER}} .amount, {{WRAPPER}} del' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'old_price_tab',
			array(
				'label' => esc_html__( 'Old price', 'omniverse' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label'    => esc_html__( 'Typography', 'omniverse' ),
				'name'     => 'old_price_typography',
				'selector' => '{{WRAPPER}} .price del, {{WRAPPER}} del .amount',
			)
		);

		$this->add_control(
			'old_price_text_color',
			array(
				'label'     => esc_html__( 'Text color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .price del, {{WRAPPER}} del .amount' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'suffix_tab',
			array(
				'label' => esc_html__( 'Suffix', 'omniverse' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label'     => esc_html__( 'Typography', 'omniverse' ),
				'name'      => 'suffix_typography',
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-price-suffix' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'suffix_text_color',
			array(
				'label'     => esc_html__( 'Text color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-price-suffix' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'stock_status_style_section',
			array(
				'label' => esc_html__( 'Stock status', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'enable_stock_status',
			array(
				'label'        => esc_html__( 'Enable stock status', 'omniverse' ),
				'description'  => esc_html__( 'If "NO" stock status will be removed.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'stock_status_css_classes',
			array(
				'type'         => 'wd_css_class',
				'default'      => 'wd-stock-status-off',
				'prefix_class' => '',
				'condition' => array(
					'enable_stock_status!' => array( 'yes' ),
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 */
	protected function render() {
		$default_settings = array(
			'design'                       => 'default',
			'reset_button_position'        => 'side',
			'reset_button_position_mobile' => 'side',
			'label_position'               => 'side',
			'label_position_mobile'        => 'side',
			'product_id'                   => false,
			'enable_stock_status'          => 'yes',
		);

		$settings = wp_parse_args( $this->get_settings_for_display(), $default_settings );

		if ( omniverse_get_opt( 'catalog_mode' ) || ! is_user_logged_in() && omniverse_get_opt( 'login_prices' ) ) {
			return;
		}

		$form_classes  = ' wd-reset-' . $settings['reset_button_position'] . '-lg';
		$form_classes .= ' wd-reset-' . $settings['reset_button_position_mobile'] . '-md';

		$form_classes .= ' wd-label-' . $settings['label_position'] . '-lg';
		$form_classes .= ' wd-label-' . $settings['label_position_mobile'] . '-md';

		if ( 'justify' === $settings['design'] ) {
			omniverse_enqueue_inline_style( 'woo-single-prod-el-add-to-cart-opt-design-justify-builder' );

			remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation' );
			add_action( 'woocommerce_before_variations_form', 'woocommerce_single_variation' );
		}

		Builder::get_instance()->set_data( 'form_classes', $form_classes );
		Builder::get_instance()->set_data( 'layout_id', get_the_ID() );

		Main::setup_preview( array(), $settings['product_id'] );
		woocommerce_template_single_add_to_cart();
		Main::restore_preview( $settings['product_id'] );
	}
}

Plugin::instance()->widgets_manager->register( new Add_To_Cart() );
