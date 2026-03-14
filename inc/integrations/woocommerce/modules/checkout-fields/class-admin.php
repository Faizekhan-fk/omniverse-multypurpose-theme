<?php
/**
 * Checkout admin page class.
 *
 * @package omniverse
 */

namespace DN\Modules\Checkout_Fields;

use DN\Modules\Checkout_Fields\List_Table\Fields_Table;
use DN\Singleton;

/**
 * Checkout admin page class.
 */
class Admin extends Singleton {
	/**
	 * Instance of the Helper class.
	 *
	 * @var Helper
	 */
	public $helper;

	/**
	 * List of registered tabs.
	 *
	 * @var array
	 */
	public $tabs;

	/**
	 * Init.
	 */
	public function init() {
		$this->helper = Helper::get_instance();
		$this->tabs   = array(
			'billing'  => esc_html__( 'Billing details', 'omniverse' ),
			'shipping' => esc_html__( 'Shipping details', 'omniverse' ),
		);

		add_action( 'init', array( $this, 'reset_all_fields' ) );
		add_action( 'admin_menu', array( $this, 'add_admin_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Add submenu page in admin Woocommerce tab.
	 *
	 * @return void
	 */
	public function add_admin_page() {
		if ( ! omniverse_get_opt( 'checkout_fields_enabled' ) || ! omniverse_woocommerce_installed() ) {
			return;
		}

		add_submenu_page(
			'woocommerce',
			esc_html__( 'Checkout Fields', 'omniverse' ),
			esc_html__( 'Checkout Fields', 'omniverse' ),
			'manage_woocommerce',
			'dn-checkout-fields-page',
			array( $this, 'render_checkout_fields_page' )
		);
	}

	/**
	 * Render 'checkout fields' page in admin Woocommerce tab.
	 *
	 * @return void
	 */
	public function render_checkout_fields_page() {
		$list_table = new Fields_Table();

		$list_table->prepare_items();
		?>
		<?php
			$this->helper->get_template(
				'checkout-fields-page',
				array(
					'base_url'    => $this->get_base_url(),
					'tabs'        => $this->tabs,
					'current_tab' => $this->get_current_tab(),
					'list_table'  => $list_table,
				)
			);
		?>
		<?php
	}

	/**
	 * Enqueue admin scripts.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		if ( ! isset( $_GET['page'] ) || 'dn-checkout-fields-page' !== $_GET['page'] ) { // phpcs:ignore
			return;
		}

		wp_enqueue_style( 'wd-page-checkout-fields-manager', OMNIVERSE_ASSETS . '/css/parts/page-checkout-fields-manager.min.css', array(), OMNIVERSE_VERSION );

		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'dn-checkout-fields-manager', OMNIVERSE_ASSETS . '/js/checkoutFieldsManager.js', array(), OMNIVERSE_VERSION, true );
	}

	/**
	 * Reset checkout fields settings to default.
	 *
	 * @return void
	 */
	public function reset_all_fields() {
		if ( ! isset( $_GET['page'] ) || ! isset( $_GET['reset-all-fields'] ) || 'dn-checkout-fields-page' !== $_GET['page'] || empty( $this->tabs ) ) { // phpcs:ignore
			return;
		}

		delete_option( 'zs_checkout_fields_manager_options' );
		delete_transient( 'wd_default_checkout_fields' );

		wp_safe_redirect( $this->get_base_url() );
		exit();
	}

	/**
	 * Get current tab.
	 *
	 * @return string
	 */
	public function get_current_tab() {
		return ! empty( $_GET['tab'] ) && in_array( $_GET['tab'], array_keys( $this->tabs ), true ) ? $_GET['tab'] : 'billing'; // phpcs:ignore.
	}

	/**
	 * Get base url.
	 *
	 * @return string
	 */
	public function get_base_url() {
		return add_query_arg(
			array(
				'page' => 'dn-checkout-fields-page',
			),
			admin_url( 'admin.php' )
		);
	}
}

Admin::get_instance();
