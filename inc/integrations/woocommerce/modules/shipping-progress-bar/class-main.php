<?php
/**
 * Free shipping progress bar.
 *
 * @package Omniverse
 */

namespace DN\Modules\Shipping_Progress_Bar;

use DN\Admin\Modules\Options;
use DN\Singleton;
use DN\Modules\Layouts\Main as Builder;

/**
 * Free shipping progress bar.
 */
class Main extends Singleton {
	/**
	 * Constructor.
	 */
	public function init() {
		$this->add_options();

		add_action( 'wp', array( $this, 'output_shipping_progress_bar' ), 100 );
		add_action( 'init', array( $this, 'output_shipping_progress_bar_in_mini_cart' ), 100 );
	}

	/**
	 * Add options in theme settings.
	 */
	public function add_options() {
		Options::add_section(
			array(
				'id'       => 'shipping_progress_bar',
				'parent'   => 'general_shop_section',
				'name'     => esc_html__( 'Free shipping bar', 'omniverse' ),
				'priority' => 100,
				'icon'     => 'dn-i-cart',
			)
		);

		Options::add_field(
			array(
				'id'          => 'shipping_progress_bar_enabled',
				'name'        => esc_html__( 'Free shipping bar', 'omniverse' ),
				'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'free-shipping-bar-cart-page.jpg" alt="">', 'omniverse' ), true ),
				'description' => esc_html__( 'Display a free shipping progress bar on the website.', 'omniverse' ),
				'type'        => 'switcher',
				'section'     => 'shipping_progress_bar',
				'default'     => '0',
				'priority'    => 10,
			)
		);

		Options::add_field(
			array(
				'id'       => 'shipping_progress_bar_calculation',
				'name'     => esc_html__( 'Calculation', 'omniverse' ),
				'type'     => 'buttons',
				'section'  => 'shipping_progress_bar',
				'options'  => array(
					'custom' => array(
						'name'  => esc_html__( 'Custom', 'omniverse' ),
						'value' => 'custom',
					),
					'wc'     => array(
						'name'  => esc_html__( 'Based on WooCommerce zones', 'omniverse' ),
						'value' => 'wc',
					),
				),
				'default'  => 'custom',
				'priority' => 20,
			)
		);

		Options::add_field(
			array(
				'id'          => 'shipping_progress_bar_amount',
				'name'        => esc_html__( 'Goal amount', 'omniverse' ),
				'description' => esc_html__( 'Amount to reach 100% defined in your currency absolute value. For example: 300', 'omniverse' ),
				'type'        => 'text_input',
				'section'     => 'shipping_progress_bar',
				'requires'    => array(
					array(
						'key'     => 'shipping_progress_bar_calculation',
						'compare' => 'equals',
						'value'   => 'custom',
					),
				),
				'default'     => '100',
				'priority'    => 30,
			)
		);

		Options::add_field(
			array(
				'id'       => 'shipping_progress_bar_include_coupon',
				'name'     => esc_html__( 'Coupon discount', 'omniverse' ),
				'type'     => 'buttons',
				'section'  => 'shipping_progress_bar',
				'options'  => array(
					'include' => array(
						'name'  => esc_html__( 'Include', 'omniverse' ),
						'value' => 'include',
					),
					'exclude' => array(
						'name'  => esc_html__( 'Exclude', 'omniverse' ),
						'value' => 'exclude',
					),
				),
				'default'  => 'exclude',
				'priority' => 40,
			)
		);

		Options::add_field(
			array(
				'id'       => 'shipping_progress_bar_location_card_page',
				'name'     => esc_html__( 'Cart page', 'omniverse' ),
				'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'free-shipping-bar-cart-page.jpg" alt="">', 'omniverse' ), true ),
				'type'     => 'switcher',
				'section'  => 'shipping_progress_bar',
				'group'    => esc_html__( 'Locations', 'omniverse' ),
				'default'  => '1',
				'priority' => 50,
				'class'    => 'dn-col-6',
			)
		);

		Options::add_field(
			array(
				'id'       => 'shipping_progress_bar_location_mini_cart',
				'name'     => esc_html__( 'Mini cart', 'omniverse' ),
				'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'free-shipping-bar-mini-cart.jpg" alt="">', 'omniverse' ), true ),
				'type'     => 'switcher',
				'section'  => 'shipping_progress_bar',
				'group'    => esc_html__( 'Locations', 'omniverse' ),
				'default'  => '1',
				'priority' => 60,
				'class'    => 'dn-col-6',
			)
		);

		Options::add_field(
			array(
				'id'       => 'shipping_progress_bar_location_checkout',
				'name'     => esc_html__( 'Checkout page', 'omniverse' ),
				'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'free-shipping-bar-checkout-page.jpg" alt="">', 'omniverse' ), true ),
				'type'     => 'switcher',
				'section'  => 'shipping_progress_bar',
				'group'    => esc_html__( 'Locations', 'omniverse' ),
				'default'  => '0',
				'priority' => 70,
				'class'    => 'dn-col-6',
			)
		);

		Options::add_field(
			array(
				'id'       => 'shipping_progress_bar_location_single_product',
				'name'     => esc_html__( 'Single product', 'omniverse' ),
				'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'shop-free-shipping-bar.jpg" alt="">', 'omniverse' ), true ),
				'type'     => 'switcher',
				'section'  => 'shipping_progress_bar',
				'group'    => esc_html__( 'Locations', 'omniverse' ),
				'default'  => '0',
				'priority' => 80,
				'class'    => 'dn-col-6',
			)
		);

		Options::add_field(
			array(
				'id'          => 'shipping_progress_bar_message_initial',
				'name'        => esc_html__( 'Initial message', 'omniverse' ),
				'description' => esc_html__( 'Message to show before reaching the goal. Use shortcode [remainder] to display the amount left to reach the minimum.', 'omniverse' ),
				'type'        => 'textarea',
				'wysiwyg'     => true,
				'section'     => 'shipping_progress_bar',
				'group'       => esc_html__( 'Message', 'omniverse' ),
				'default'     => '<p>Add [remainder] to cart and get free shipping!</p>',
				'priority'    => 90,
			)
		);

		Options::add_field(
			array(
				'id'          => 'shipping_progress_bar_message_success',
				'name'        => esc_html__( 'Success message', 'omniverse' ),
				'description' => esc_html__( 'Message to show after reaching 100%.', 'omniverse' ),
				'type'        => 'textarea',
				'wysiwyg'     => true,
				'section'     => 'shipping_progress_bar',
				'group'       => esc_html__( 'Message', 'omniverse' ),
				'default'     => '<p>Your order qualifies for free shipping!</p>',
				'priority'    => 100,
			)
		);
	}

	/**
	 * Output shipping progress bar.
	 */
	public function output_shipping_progress_bar() {
		if ( ! omniverse_get_opt( 'shipping_progress_bar_enabled' ) ) {
			return;
		}

		if ( omniverse_get_opt( 'shipping_progress_bar_location_card_page' ) && ! Builder::get_instance()->has_custom_layout( 'cart' ) ) {
			add_action( 'woocommerce_before_cart_table', array( $this, 'render_shipping_progress_bar_with_wrapper' ) );
		}

		if ( omniverse_get_opt( 'shipping_progress_bar_location_single_product' ) ) {
			add_action( 'woocommerce_single_product_summary', array( $this, 'render_shipping_progress_bar_with_wrapper' ), 29 );
		}

		if ( omniverse_get_opt( 'shipping_progress_bar_location_checkout' ) ) {
			add_action( 'woocommerce_checkout_billing', array( $this, 'render_shipping_progress_bar_with_wrapper' ) );
		}
	}

	/**
	 * Update fragments shipping progress bar.
	 *
	 * @return void
	 */
	public function output_shipping_progress_bar_in_mini_cart() {
		if ( ! omniverse_get_opt( 'shipping_progress_bar_enabled' ) ) {
			return;
		}

		if ( omniverse_get_opt( 'shipping_progress_bar_location_mini_cart' ) ) {
			add_action( 'woocommerce_widget_shopping_cart_before_buttons', array( $this, 'render_shipping_progress_bar' ) );
		}

		add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'get_shipping_progress_bar_fragments' ), 40 );
		add_filter( 'woocommerce_update_order_review_fragments', array( $this, 'get_shipping_progress_bar_checkout_fragments' ), 10 );
	}

	/**
	 * Get shipping progress bar content.
	 *
	 * @codeCoverageIgnore
	 * @return void
	 */
	public function render_shipping_progress_bar_with_wrapper() {
		?>
		<div class="wd-shipping-progress-bar wd-style-bordered">
			<?php $this->render_shipping_progress_bar(); ?>
		</div>
		<?php
	}

	/**
	 * Add shipping progress bar fragment.
	 *
	 * @param array $array Fragments.
	 *
	 * @return array
	 */
	public function get_shipping_progress_bar_checkout_fragments( $array ) {
		ob_start();

		$this->render_shipping_progress_bar();

		$content = ob_get_clean();

		$array['div.wd-free-progress-bar'] = $content;

		return $array;
	}

	/**
	 * Add shipping progress bar fragment.
	 *
	 * @param array $array Fragments.
	 *
	 * @return array
	 */
	public function get_shipping_progress_bar_fragments( $array ) {
		ob_start();

		$this->render_shipping_progress_bar();

		$content = ob_get_clean();

		if ( apply_filters( 'omniverse_update_fragments_fix', true ) ) {
			$array['div.wd-free-progress-bar_wd'] = $content;
		} else {
			$array['div.wd-free-progress-bar'] = $content;
		}

		return $array;
	}

	/**
	 * Render free shipping progress bar.
	 *
	 * @codeCoverageIgnore
	 */
	public function render_shipping_progress_bar() {
		if ( ! omniverse_get_opt( 'shipping_progress_bar_enabled' ) ) {
			return;
		}

		$calculation     = omniverse_get_opt( 'shipping_progress_bar_calculation', 'custom' );
		$wrapper_classes = '';
		$percent         = 100;
		$limit           = 0;
		$free_shipping   = false;

		if ( ! is_object( WC() ) || ! property_exists( WC(), 'cart' ) || ! is_object( WC()->cart ) || ! method_exists( WC()->cart, 'get_displayed_subtotal' ) ) {
			$total       = 0;
			$calculation = 'custom';
		} else {
			$total = WC()->cart->get_displayed_subtotal();
		}

		if ( 'wc' === $calculation ) {
			$packages = WC()->cart->get_shipping_packages();
			$package  = reset( $packages );
			$zone     = wc_get_shipping_zone( $package );

			foreach ( $zone->get_shipping_methods( true ) as $method ) {
				if ( 'free_shipping' === $method->id ) {
					$limit = $method->get_option( 'min_amount' );
				}
			}
		} elseif ( 'custom' === $calculation ) {
			$limit = omniverse_get_opt( 'shipping_progress_bar_amount' );
		}

		if ( $total && 'include' === omniverse_get_opt( 'shipping_progress_bar_include_coupon' ) && WC()->cart->get_coupons() ) {
			foreach ( WC()->cart->get_coupons() as $coupon ) {
				$total -= WC()->cart->get_coupon_discount_amount( $coupon->get_code(), WC()->cart->display_cart_ex_tax );

				if ( $coupon->get_free_shipping() ) {
					$free_shipping = true;
					break;
				}
			}
		}

		$limit = apply_filters( 'omniverse_shipping_progress_bar_amount', $limit );

		if ( $total < $limit && ! $free_shipping ) {
			$percent = floor( ( $total / $limit ) * 100 );
			$message = str_replace( '[remainder]', wc_price( $limit - $total ), omniverse_get_opt( 'shipping_progress_bar_message_initial' ) );
		} else {
			$message = omniverse_get_opt( 'shipping_progress_bar_message_success' );
		}

		if ( 0 === (int) $total || $percent < 0 ) {
			$wrapper_classes .= ' wd-progress-hide';
		}

		if ( ! $limit ) {
			return;
		}

		?>
		<div class="wd-progress-bar wd-free-progress-bar<?php echo esc_attr( $wrapper_classes ); ?>">
			<div class="progress-msg">
				<?php echo wp_kses( $message, 'post' ); ?>
			</div>
			<div class="progress-area">
				<div class="progress-bar" style="width: <?php echo esc_attr( $percent ); ?>%"></div>
			</div>
		</div>
		<?php
	}
}

Main::get_instance();
