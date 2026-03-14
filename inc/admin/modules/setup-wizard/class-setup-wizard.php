<?php
/**
 * Setup wizard class.
 *
 * @package omniverse
 */

namespace DN\Admin\Modules;

use DN\Singleton;

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

/**
 * Setup wizard class.
 */
class Setup_Wizard extends Singleton {
	/**
	 * Available pages.
	 *
	 * @var array
	 */
	public $available_pages = array();

	/**
	 * Constructor.
	 */
	public function init() {
		$this->available_pages = array(
			'welcome'           => esc_html__( 'Welcome', 'omniverse' ),
			'activation'        => esc_html__( 'Activation', 'omniverse' ),
			'child-theme'       => esc_html__( 'Child theme', 'omniverse' ),
			'page-builder'      => esc_html__( 'Page builder', 'omniverse' ),
			'business-type'      => esc_html__( 'Business Type', 'omniverse' ),
			'plugins'           => esc_html__( 'Plugins', 'omniverse' ),
			'prebuilt-websites' => esc_html__( 'Prebuilt websites', 'omniverse' ),
			'done'              => esc_html__( 'Done', 'omniverse' ),
		);

		if ( isset( $_GET['skip_setup'] ) ) {
			update_option( 'omniverse_setup_status', 'done', false );
		}

		if ( isset( $_GET['business_type'] ) ) {
			update_option( 'wd_business_type', $_GET['business_type'] );
		}

		if ( 'done' !== get_option( 'omniverse_setup_status' ) ) { // phpcs:ignore
			add_action( 'admin_init', array( $this, 'prevent_plugins_redirect' ), 1 );
			do_action( 'omniverse_setup_wizard' );
		}

		if ( defined( 'DOING_AJAX' ) || isset( $_GET['page'] ) && ( 'zs_dashboard' === $_GET['page'] || 'tgmpa-install-plugins' === $_GET['page'] ) ) {
			add_action( 'admin_init', array( $this, 'prevent_plugins_redirect' ), 1 );
		}

		add_action( 'admin_init', array( $this, 'theme_activation_redirect' ) );

		add_filter( 'leadin_impact_code', array( $this, 'get_hubspot_affiliate_code' ) );
	}

	/**
	 * Prevent plugins redirect.
	 */
	public function prevent_plugins_redirect() {
		delete_transient( '_revslider_welcome_screen_activation_redirect' );
		delete_transient( '_vc_page_welcome_redirect' );
		delete_transient( 'elementor_activation_redirect' );
		add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );
		remove_action( 'admin_menu', 'vc_menu_page_build' );
		remove_action( 'network_admin_menu', 'vc_network_menu_page_build' );
		remove_action( 'vc_activation_hook', 'vc_page_welcome_set_redirect' );
		remove_action( 'admin_init', 'vc_page_welcome_redirect' );
	}

	/**
	 * Hubspot affiliate.
	 */
	public function get_hubspot_affiliate_code() {
		return '7m0A9V';
	}

	/**
	 * Redirect to setup wizard after theme activated.
	 */
	public function theme_activation_redirect() {
		if ( 'done' === get_option( 'omniverse_setup_status' ) ) {
			return;
		}

		global $pagenow;

		$args = array(
			'page' => 'zs_dashboard',
			'tab'  => 'wizard',
		);

		if ( 'themes.php' === $pagenow && is_admin() && isset( $_GET['activated'] ) ) { // phpcs:ignore
			wp_safe_redirect( esc_url_raw( add_query_arg( $args, admin_url( 'admin.php' ) ) ) );
		}
	}

	/**
	 * Template.
	 */
	public function setup_wizard_template() {
		if ( 'done' === get_option( 'omniverse_setup_status' ) ) {
			return;
		}

		wp_enqueue_script( 'wd-setup-wizard', OMNIVERSE_ASSETS . '/js/wizard.js', array(), OMNIVERSE_VERSION, true );

		$page = 'welcome';

		if ( isset( $_GET['step'] ) && ! empty( $_GET['step'] ) ) { // phpcs:ignore
			$page = trim( wp_unslash( $_GET['step'] ) ); // phpcs:ignore
		}

		$this->show_page( $page );
	}

	/**
	 * Show page.
	 *
	 * @param string $name Template file name.
	 */
	public function show_page( $name ) {
		?>
		<div class="dn-setup-wizard-wrap dn-theme-style">
			<div class="dn-setup-wizard">
				<div class="dn-wizard-nav">
					<?php $this->show_part( 'sidebar' ); ?>
				</div>

				<div class="dn-wizard-content">
					<?php $this->show_part( $name ); ?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Get previous page button.
	 *
	 * @param string $page Page slug.
	 */
	public function get_prev_button( $page, $builder='', $business_type='') {
		$url     = $this->get_page_url( $page );
		
		if ( 'plugins' === $page || 'business-type' === $page || 'prebuilt-websites' === $page ) {
			$url     .= '&wd_builder='.$builder.'&business_type='.$business_type;
		}
		
		?>
		<a class="dn-inline-btn dn-prev" href="<?php echo esc_url( $this->get_page_url( $url ) ); ?>">
			<?php esc_html_e( 'Previous step', 'omniverse' ); ?>
		</a>
		<?php
	}

	/**
	 * Get previous page button.
	 *
	 * @param string  $page Page slug.
	 * @param string  $builder Builder name.
	 * @param boolean $disabled Is button disabled.
	 */
	public function get_next_button( $page, $builder = '', $disabled = false ) {
		$classes = '';
		$url     = $this->get_page_url( $page );

		if ( 'elementor' === $builder ) {
			$classes .= ' dn-elementor dn-shown';
			$url     .= '&wd_builder=elementor';
		} elseif ( 'wpb' === $builder ) {
			$classes .= ' dn-wpb dn-hidden';
			$url     .= '&wd_builder=wpb';
		}

		if ( $disabled ) {
			$classes .= ' dn-disabled';
		}

		?>
		<a class="dn-btn dn-color-primary dn-next<?php echo esc_attr( $classes ); ?>" href="<?php echo esc_url( $url ); ?>">
			<?php esc_html_e( 'Next step', 'omniverse' ); ?>
		</a>
		<?php
	}
	
	public function get_next_business_type_button( $page, $builder = '', $business_type = '', $disabled = false ) {
		$classes = '';
		$url     = $this->get_page_url( $page );

		if ( 'ecommerce' === $business_type && 'prebuilt-websites' !== $page ) {
			$classes .= ' dn-ecommerce dn-shown';
			$url     .= '&wd_builder='.$builder.'&business_type=ecommerce';
		} elseif ( 'lms' === $business_type && 'prebuilt-websites' !== $page ) {
			$classes .= ' dn-lms dn-hidden';
			$url     .= '&wd_builder='.$builder.'&business_type=lms';
		} 
		
		if ( 'prebuilt-websites' === $page ) {
			$classes .= '';
			$classes .= ' dn-lms dn-shown';
			$url     .= '&wd_builder='.$builder.'&business_type='.$business_type;
		}
		

		if ( $disabled ) {
			$classes .= ' dn-disabled';
		}

		?>
		<a class="dn-btn dn-color-primary dn-next<?php echo esc_attr( $classes ); ?>" href="<?php echo esc_url( $url ); ?>">
			<?php esc_html_e( 'Next step', 'omniverse' ); ?>
		</a>
		<?php
	}

	/**
	 * Get skip page button.
	 *
	 * @param string $page Page slug.
	 */
	public function get_skip_button( $page ) {
		?>
		<a class="dn-inline-btn dn-color-primary dn-skip" href="<?php echo esc_url( $this->get_page_url( $page ) ); ?>">
			<?php esc_html_e( 'Skip', 'omniverse' ); ?>
		</a>
		<?php
	}

	/**
	 * Show template part.
	 *
	 * @param string $name Template file name.
	 */
	public function show_part( $name ) {
		include_once get_parent_theme_file_path( OMNIVERSE_FRAMEWORK . '/admin/modules/setup-wizard/templates/' . $name . '.php' );
	}

	/**
	 * Is active page.
	 *
	 * @param string $name Page name.
	 */
	public function is_active_page( $name ) {
		$page = 'welcome';

		if ( isset( $_GET['step'] ) && ! empty( $_GET['step'] ) ) { // phpcs:ignore
			$page = trim( wp_unslash( $_GET['step'] ) ); // phpcs:ignore
		}

		return $name === $page; // phpcs:ignore
	}

	/**
	 * Get page url.
	 *
	 * @param string $name Page name.
	 */
	public function get_page_url( $name ) {
		return admin_url( 'admin.php?page=zs_dashboard&tab=wizard&step=' . $name ); // phpcs:ignore
	}

	/**
	 * Get image url.
	 *
	 * @param string $name Image name.
	 */
	public function get_image_url( $name ) {
		return OMNIVERSE_THEME_DIR . '/inc/admin/modules/setup-wizard/images/' . $name;
	}

	/**
	 * Get plugin image url.
	 *
	 * @param string $name Image name.
	 */
	public function get_plugin_image_url( $name ) {
		return OMNIVERSE_THEME_DIR . '/inc/admin/assets/images/plugins/' . $name;
	}

	/**
	 * Is setup wizard.
	 *
	 * @return bool
	 */
	public function is_setup() {
		return isset( $_GET['tab'] ) && 'wizard' === $_GET['tab']; //phpcs:ignore
	}
}

Setup_Wizard::get_instance();
