<?php
/**
 * Quick buy.
 *
 * @package Omniverse
 */

namespace DN\Modules\Quick_Buy;

use DN\Admin\Modules\Options;
use DN\Singleton;

/**
 * Quick buy.
 */
class Main extends Singleton {
	/**
	 * Constructor.
	 */
	public function init() {
		$this->include_files();
		$this->add_options();

		add_action( 'woocommerce_after_add_to_cart_button', array( $this, 'output_quick_buy_button' ), 1 );
	}

	/**
	 * Include files.
	 */
	public function include_files() {
		require_once OMNIVERSE_THEMEROOT . '/inc/integrations/woocommerce/modules/quick-buy/class-redirect.php';
	}

	/**
	 * Add options in theme settings.
	 */
	public function add_options() {
		Options::add_section(
			array(
				'id'       => 'single_product_buy_now',
				'parent'   => 'general_single_product_section',
				'name'     => esc_html__( 'Buy now', 'omniverse' ),
				'priority' => 35,
				'icon'     => 'dn-i-bag',
			)
		);

		Options::add_field(
			array(
				'id'          => 'buy_now_enabled',
				'name'        => esc_html__( 'Buy now button', 'omniverse' ),
				'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'buy-now-button.jpg" alt="">', 'omniverse' ), true ),
				'description' => wp_kses( __( 'Add an extra button next to the “Add to cart” that will add the product to the cart and redirect it to the cart or checkout. Read more information in our <a href="https://zynxsol.com/docs-topic/buy-now-button/">documentation</a>.', 'omniverse' ), 'default' ),
				'type'        => 'switcher',
				'section'     => 'single_product_buy_now',
				'default'     => false,
				'priority'    => 260,
			)
		);

		Options::add_field(
			array(
				'id'       => 'buy_now_redirect',
				'name'     => esc_html__( 'Redirect location', 'omniverse' ),
				'type'     => 'select',
				'section'  => 'single_product_buy_now',
				'default'  => 'checkout',
				'options'  => array(
					'checkout' => array(
						'name'  => esc_html__( 'Checkout page', 'omniverse' ),
						'value' => 'checkout',
					),
					'cart'     => array(
						'name'  => esc_html__( 'Cart page', 'omniverse' ),
						'value' => 'cart',
					),
				),
				'requires' => array(
					array(
						'key'     => 'quick_buy_enabled',
						'compare' => 'equals',
						'value'   => true,
					),
				),
				'priority' => 270,
			)
		);
	}

	/**
	 * Output quick buy button.
	 *
	 * @codeCoverageIgnore
	 */
	public function output_quick_buy_button() {
		if ( ! is_singular( 'product' ) && ! omniverse_loop_prop( 'is_quick_view' ) || ! omniverse_get_opt( 'buy_now_enabled' ) ) {
			return;
		}
		?>
			<button id="wd-add-to-cart" type="submit" name="wd-add-to-cart" value="<?php echo get_the_ID(); ?>" class="wd-buy-now-btn button alt">
				<?php esc_html_e( 'Buy now', 'omniverse' ); ?>
			</button>
		<?php
	}
}

Main::get_instance();
