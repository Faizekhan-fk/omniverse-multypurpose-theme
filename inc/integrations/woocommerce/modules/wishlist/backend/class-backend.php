<?php
/**
 * Wishlist settings page on admin panel.
 *
 * @package Omniverse
 */

namespace DN\WC_Wishlist;

use WP_User_Query;
use DN\Singleton;
use DN\WC_Wishlist\Backend\List_Table\Wishlists;
use DN\WC_Wishlist\Backend\List_Table\Popular_Products;
use DN\WC_Wishlist\Backend\List_Table\Users_Popular_Products;
use Automattic\WooCommerce\Admin\Features\Navigation\Menu;
use Automattic\WooCommerce\Admin\Features\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'No direct script access allowed' );
}

/**
 * Create Wishlist settings page on admin panel.
 */
class Backend extends Singleton {
	/**
	 * @var array
	 */
	private $tabs = array();

	/**
	 * Base initialization class required for Module class.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		$this->tabs = array(
			'dn-all-wishlists'                => esc_html__( 'All wishlists', 'omniverse' ),
			'dn-popular-products-in-wishlist' => esc_html__( 'Popular products', 'omniverse' ),
		);

		if ( isset( $_GET['page'] ) && 'dn-wishlist-settings-page' === $_GET['page'] ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		$this->include_files();

		add_action( 'init', array( $this, 'delete_wishlists' ) );
		add_action( 'init', array( $this, 'create_promotion' ) );

		add_action( 'admin_notices', array( $this, 'show_notice' ) );
		add_action( 'admin_menu', array( $this, 'register_wishlist_settings_page' ) );

		add_action( 'wp_ajax_omniverse_json_search_users', array( $this, 'omniverse_json_search_users' ) );

		add_filter( 'set-screen-option', array( $this, 'set_screen_option' ), 10, 3);
	}

	public function show_notice() {
		if ( ! isset( $_GET['page'] ) || 'dn-wishlist-settings-page' !== $_GET['page'] || ! isset( $_GET['tab'] ) || ! in_array( $_GET['tab'], array( 'dn-popular-products-in-wishlist', 'dn-users-popular-products' ), true ) || omniverse_check_this_email_notification_is_enabled( 'woocommerce_omniverse_promotional_email_settings', 'yes' ) ) {
			return;
		}

		?>
		<div class="notice notice-error is-dismissible">
			<p>
				<?php
					printf(
						'%s <a href="%s">%s</a>.',
						esc_html__( 'Wishlist promotional email is currently disabled. You need to enable it if you want to send promotional emails to your customers. Find it in', 'omniverse' ),
						esc_url( admin_url( 'admin.php?page=wc-settings&tab=email' ) ),
						esc_html__( 'WooCommerce -> Settings -> Emails', 'omniverse' )
					);
				?>
			</p>
		</div>
		<?php
	}

	public function create_promotion() {
		if ( ! isset( $_REQUEST['_wpnonce'] ) || ! isset( $_REQUEST['product_id'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'omniverse_send_promotion_email' ) || ! omniverse_check_this_email_notification_is_enabled( 'woocommerce_omniverse_promotional_email_settings', 'yes' ) ) {
			return;
		}

		$product_id     = $_REQUEST['product_id'];
		$user_ids       = isset( $_REQUEST['user_id'] ) ? $_REQUEST['user_id'] : array_unique( Popular_Products::get_user_ids_by_product_id( $product_id ) );
		$users_products = ! is_array( $user_ids ) ? array( $user_ids => $product_id ) : array_combine( $user_ids, array_fill( 0, count( $user_ids ), $product_id ) );

		Sends_Promotional::update_promotion_data( $users_products );
	}

	/**
	 * Enqueue styles and scripts on wp admin panel.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style(
			'dn-page-wishlists',
			OMNIVERSE_ASSETS . '/css/parts/page-wishlists.min.css',
			array(),
			omniverse_get_theme_info( 'Version' )
		);

		wp_enqueue_script(
			'dn-admin-wishlist',
			OMNIVERSE_ASSETS . '/js/wishlist.js',
			array(
				'jquery',
				'jquery-ui-datepicker',
				'select2',
			),
			OMNIVERSE_VERSION,
			true
		);

		wp_localize_script(
			'dn-admin-wishlist',
			'dnAdminWishlistSettings',
			array(
				'send_promotional_confirm_text' => esc_html__( 'Ready to send this promotional email?', 'omniverse' ),
			)
		);
	}

	public function omniverse_json_search_users( $term = '' ) {
		check_ajax_referer( 'search-users', 'security' );

		if ( empty( $term ) && isset( $_GET['term'] ) ) {
			$term = (string) wc_clean( wp_unslash( $_GET['term'] ) ); // phpcs:ignore.
		}

		if ( empty( $term ) ) {
			wp_die();
		}

		$users_found = array();

		$users = new WP_User_Query(
			array(
				'search'         => '*' . esc_attr( $term ) . '*',
				'search_columns' => array(
					'user_login',
					'user_nicename',
					'user_email',
					'user_url',
				),
			)
		);

		$users_objects = $users->get_results();

		foreach ( $users_objects as $user ) {
			$users_found[ $user->get( 'ID' ) ] = $user->get( 'user_login' );
		}

		wp_send_json( apply_filters( 'omniverse_json_search_found_users', $users_found ) );
	}

	/**
	 * Include main files.
	 */
	private function include_files() {
		if ( ! class_exists( 'WP_List_Table' ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
		}

		$files = array(
			'class-popular-products',
			'class-users-popular-products',
			'class-wishlists',
		);

		foreach ( $files as $file ) {
			$file_path = ZS_WISHLIST_DIR . 'backend/list-tables/' . $file . '.php';

			if ( file_exists( $file_path ) ) {
				require_once $file_path;
			}
		}
	}

	/**
	 * This method deletes wishlists when you click the Delete button.
	 *
	 * @return void
	 */
	public function delete_wishlists() {
		if ( ! isset( $_GET['delete_wishlist'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['delete_wishlist'] ) ), 'delete_wishlist' ) || empty( $_GET['wishlist_id'] ) ) {
			return;
		}

		$wishlist_id = intval( $_GET['wishlist_id'] );

		$wishlist = new Wishlist( $wishlist_id );

		$wishlist->remove_group( $wishlist_id );
		$wishlist->update_count_cookie();

		wp_safe_redirect( admin_url( '/edit.php?post_type=product&page=dn-wishlist-settings-page&tab=dn-all-wishlists' ) );
		die();
	}

	public function wishlist_screen_options() {
		global $wishlist_settings_page;

		$screen = get_current_screen();

		if( ! is_object( $screen ) || $screen->id !== $wishlist_settings_page) {
			return;
		}

		add_screen_option(
			'per_page',
			array(
				'label'   => esc_html__('Number of items per page', 'omniverse'),
				'default' => 20,
				'option'  => 'wishlists_per_page'
			)
		);
	}

	public function set_screen_option( $status, $option, $value ) {
		if ( 'wishlists_per_page' === $option ) {
			return $value;
		}
	}

	/**
	 * Register wishlist settings page.
	 *
	 * @return void
	 */
	public function register_wishlist_settings_page() {
		global $wishlist_settings_page;

		$wishlist_settings_page = add_submenu_page(
			'edit.php?post_type=product',
			esc_html__( 'Wishlists', 'omniverse' ),
			esc_html__( 'Wishlists', 'omniverse' ),
			apply_filters( 'omniverse_capability_menu_page', 'edit_posts', 'dn-wishlist-settings-page' ),
			'dn-wishlist-settings-page',
			array( $this, 'render_wishlist_settings_page' )
		);

		add_action( 'load-' . $wishlist_settings_page, array( $this, 'wishlist_screen_options' ) );

		if ( ! method_exists( Menu::class, 'add_plugin_item' ) || ! method_exists( Menu::class, 'add_plugin_category' ) || ! Features::is_enabled( 'navigation' ) ) {
			return;
		}

		Menu::add_plugin_category(
			array(
				'id'         => 'dn-wishlist-settings',
				'parent'     => 'woocommerce-products',
				'title'      => esc_html__( 'Wishlists', 'omniverse' ),
				'capability' => apply_filters( 'omniverse_capability_menu_page', 'edit_posts', 'dn-wishlist-settings' ),
				'url'        => 'dn-wishlist-settings-page',
			)
		);

		Menu::add_plugin_item(
			array(
				'id'         => 'dn-all-wishlists',
				'parent'     => 'dn-wishlist-settings',
				'title'      => esc_html__( 'All wishlists', 'omniverse' ),
				'capability' => apply_filters( 'omniverse_capability_menu_page', 'edit_posts', 'dn-all-wishlists' ),
				'url'        => 'dn-wishlist-settings-page&tab=dn-all-wishlists',
			)
		);

		Menu::add_plugin_item(
			array(
				'id'         => 'dn-popular-products-in-wishlist',
				'parent'     => 'dn-wishlist-settings',
				'title'      => esc_html__( 'Popular products', 'omniverse' ),
				'capability' => apply_filters( 'omniverse_capability_menu_page', 'edit_posts', 'dn-popular-products-in-wishlist' ),
				'url'        => 'dn-wishlist-settings-page&tab=dn-popular-products-in-wishlist',
			)
		);
	}

	/**
	 * Render wishlist settings page.
	 *
	 * @return void
	 */
	public function render_wishlist_settings_page() {
		$list_table  = new Wishlists();
		$tabs        = $this->get_tabs();
		$current_tab = $this->get_current_tab();
		$base_url    = add_query_arg(
			array(
				'post_type' => 'product',
				'page'      => 'dn-wishlist-settings-page',
			),
			admin_url( 'edit.php' )
		);
		$title       = '';
		$is_users_popular_products = isset( $_GET['tab'] ) && 'dn-users-popular-products' === $_GET['tab'];

		if ( $is_users_popular_products ) {
			$title = esc_html__( 'Customers that added product to wishlist', 'omniverse' );

			if ( ! empty( $_GET['product_id'] ) ) { // phpcs:ignore;
				$product = wc_get_product( $_GET['product_id'] ); // phpcs:ignore;
			}

			if ( ! empty( $product ) ) {
				// translators: Product name.
				$title = sprintf( esc_html__( 'Customers that added "%s" to wishlist', 'omniverse' ), $product->get_name() );
			}
		}

		if ( ! empty( $_GET['tab'] ) && 'dn-popular-products-in-wishlist' === $_GET['tab'] ) { // phpcs:ignore;
			$list_table = new Popular_Products();
		} elseif ( ! empty( $_GET['tab'] ) && 'dn-users-popular-products' === $_GET['tab'] ) { // phpcs:ignore;
			$list_table = new Users_Popular_Products();
		}

		$list_table->prepare_items();

		ob_start();
		?>
			<div class="wrap wishlist-settings-page-wrap">
				<h2 class="wp-heading-inline"><?php echo esc_html__( 'Wishlists', 'omniverse' ); ?></h2>

				<?php if ( ! $is_users_popular_products ) : ?>
					<div class="nav-tab-wrapper">
						<?php foreach ( $tabs as $key => $label ) : ?>
							<?php
							$classes = '';
	
							if ( $current_tab === $key ) {
								$classes .= ' nav-tab-active';
							}
							?>
	
							<a class="nav-tab<?php echo esc_attr( $classes ); ?>" href="<?php echo esc_attr( add_query_arg( 'tab', $key, $base_url ) ); ?>">
								<?php echo esc_html( $label ); ?>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $title ) ) : ?>
					<h3><?php echo esc_html( $title ); ?></h3>
				<?php endif; ?>

				<form id="dn-wishlist-settings-page-form" method="post">
					<?php
					if ( $list_table instanceof Wishlists ) {
						$list_table->search_box( esc_html__( 'Search', 'omniverse' ), 'dn-search' );
					}

					$list_table->display();
					?>
				</form>
			</div>
		<?php
		echo ob_get_clean(); // phpcs:ignore;
	}

	/**
	 * Get a list of registered tabs.
	 *
	 * @return array
	 */
	public function get_tabs() {
		return $this->tabs;
	}

	/**
	 * Get current tab.
	 *
	 * @return string
	 */
	public function get_current_tab() {
		if ( ! empty( $_GET['tab'] ) ) { // phpcs:ignore
			return $_GET['tab']; // phpcs:ignore
		}

		return 'dn-all-wishlists';
	}
}

Backend::get_instance();
