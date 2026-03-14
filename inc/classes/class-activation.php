<?php
/**
 * Activate theme.
 *
 * @package dn
 */

namespace DN;

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

/**
 * Activate theme.
 */
class Activation {
	private $_api             = null;
	private $_notices         = null;

	function __construct() {
		$this->_api     = Registry::getInstance()->api;
		$this->_notices = Registry::getInstance()->notices;

		$this->process_form();
	}

	/**
	 * License page template.
	 *
	 * @return void
	 */
	public function form() {
		?>
		<div class="dn-box dn-license dn-theme-style">
			<div class="dn-box-header">
				<h3>
					<?php esc_html_e( 'Theme license', 'omniverse' ); ?>
				</h3>
				<p>
					<?php esc_html_e( 'Activate your purchase code for this domain to turn on auto updates function.', 'omniverse' ); ?>
				</p>
			</div>

			<div class="dn-box-content">
				<div class="dn-row">
					<div class="dn-col-12 dn-col-xl-5 dn-license-img">
						<img src="<?php echo esc_url( OMNIVERSE_ASSETS_IMAGES . '/dashboard/license.jpg' ); ?>" alt="license banner">
					</div>

					<div class="dn-col-12 dn-col-xl-7 dn-license-content">
						<?php $this->_notices->show_msgs(); ?>

						<?php if ( omniverse_is_license_activated() ) : ?>
							<div class="dn-activated-message">
								<p>Thank you for activation. Now you are able to get automatic updates for our
									theme via <a href="<?php echo esc_url( admin_url( 'themes.php' ) ); ?>">Appearance -> Themes</a> or via <a href="<?php echo esc_url( admin_url( 'update-core.php?force-check=1' ) ); ?>">Dashboard -> Updates</a>. You can click this button to deactivate your license code from this domain if you are going to transfer your website to some other domain or server.<br>
								</p>

								<form action="" class="dn-form dn-activation-form" method="post">
									<?php wp_nonce_field( 'dn-license-deactivation' ); ?>
									<input type="hidden" name="purchase-code-deactivate" value="1"/>
									<div class="dn-license-btn dn-deactivate-btn dn-i-close">
										<input class="dn-btn dn-color-warning" type="submit" value="<?php esc_attr_e( 'Deactivate theme', 'omniverse' ); ?>" />
									</div>
								</form>
							</div>
						<?php else : ?>
							<form action="" class="dn-form dn-activation-form" method="post">
								<?php wp_nonce_field( 'dn-license-activation' ); ?>
								<?php if ( ! omniverse_get_opt( 'white_label' ) ) : ?>
									<label for="purchase-code"><?php esc_html_e( 'Purchase code', 'omniverse' ); ?> (<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">Where can I get my purchase code?</a>)</label>
								<?php endif; ?>

								<div class="dn-activation-form-inner">
									<input type="text" name="purchase-code" placeholder="Example: 1e71cs5f-13d9-41e8-a140-2cff01d96afb" id="purchase-code" required>
									<?php if ( omniverse_is_license_activated() ) : ?>
										<span>
										<?php esc_html_e( 'Activated', 'omniverse' ); ?>
									</span>
									<?php else : ?>
										<span>
										<?php esc_html_e( 'Not activated', 'omniverse' ); ?>
									</span>
									<?php endif; ?>
								</div>

								<div class="dn-dev-domain-agree">
									<label for="dn-dev-domain-label">
										<input id="dn-dev-domain-label" type="checkbox" name="dn-dev-domain" <?php checked( isset( $_REQUEST['dn-dev-domain'] ) && $_REQUEST['dn-dev-domain'], '1' ); // phpcs:ignore ?> value="1">
										<?php esc_html_e( 'Development domain', 'omniverse' ); ?>
									</label>
								</div>

								<div class="dn-activation-form-agree">
									<label for="agree_stored" class="agree-label" >
										<input type="checkbox" name="agree_stored" id="agree_stored" required>
										<?php if ( ! omniverse_get_opt( 'white_label' ) ) : ?>
											<?php esc_html_e( 'I agree that my purchase code and user data will be stored by zynxsol.com', 'omniverse' ); ?>
										<?php else : ?>
											<?php esc_html_e( 'I agree that my purchase code and user data will be stored.', 'omniverse' ); ?>
										<?php endif; ?>
									</label>

									<div class="dn-hint">
										<div class="dn-tooltip dn-top dn-top-left">
											<?php esc_html_e( 'To activate the theme and access full product support, you need to register your purchase code from Envato on our website. This code will be securely stored along with your support expiration details and basic user information. Registration is required so we can provide technical support, updates, and other customer services related to your theme.', 'omniverse' ); ?>
										</div>
									</div>
								</div>

								<div class="dn-license-btn dn-activate-btn dn-i-key">
									<input class="dn-btn dn-color-primary" name="omniverse-purchase-code" type="submit" value="<?php esc_attr_e( 'Activate theme', 'omniverse' ); ?>" />
								</div>
							</form>
						<?php endif; ?>
						<p class="dn-note">
							<?php
								echo wp_kses(
									'<span>Note:</span> With a regular license, the theme can be used on only one live domain. However, you can activate the theme on two domains to enable automatic updates — one for your development (staging) site and one for your production (live) website.
						If you need to review your active domains or remove any existing activations, simply log in to your account on <a href="https://zynxsol.com/" target="_blank">our website</a> and check the activation list section.',
									omniverse_get_allowed_html()
								);
							?>
						</p>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Process activate theme.
	 *
	 * @return void
	 */
	public function process_form() {
		if ( isset( $_POST['purchase-code-deactivate'] ) ) {
			check_admin_referer( 'dn-license-deactivation' );
			$this->deactivate();
			$this->_notices->add_success( 'Theme license is successfully deactivated.' );
			return;
		}

		if ( isset( $_POST['omniverse-purchase-code'] ) && ( empty( $_POST['agree_stored'] ) ) ) {
			$this->_notices->add_error( 'You must agree to store your purchase code and user data by zynxsol.com' );
			return;
		}

		if ( empty( $_POST['purchase-code'] ) ) {
			return;
		}
		check_admin_referer( 'dn-license-activation' );

		$code = sanitize_text_field( $_POST['purchase-code'] );
		$dev  = (int) ( isset( $_POST['dn-dev-domain'] ) && $_POST['dn-dev-domain'] ); // phpcs:ignore

		$response = $this->_api->call(
			'activate?key=' . $code,
			array(
				'domain' => get_site_url(),
				'theme'  => OMNIVERSE_SLUG,
				'dev'    => $dev,
			),
			'post'
		);

		if ( isset( $_GET['zynxsol_debug'] ) ) {
			ar( $response );
		}

		if ( is_wp_error( $response ) ) {
			$this->_notices->add_error( 'The API server can\'t be reached. Please, contact your hosting provider to check the connectivity with our zynxsol.com server. If you need further help, please, contact our support center too.' );
			return;
		}

		$data = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( isset( $data['errors'] ) ) {
			$this->_notices->add_error( $data['errors'] );
			return;
		}

		if ( ( isset( $data['code'] ) && 'rest_forbidden' === $data['code'] ) || empty( $data['verified'] ) ) {
			$this->_notices->add_error( 'The purchase code is invalid. <a target="_blank" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-">Where can I get my purchase code?</a>' );
			return;
		}

		$this->activate( $code, $data['token'], $dev );

		$this->_notices->add_success( 'The license is verified and theme is activated successfully. Auto updates function is enabled.' );
	}

	/**
	 * Activate theme.
	 *
	 * @param string $purchase Theme token.
	 * @param string $token Purchase code.
	 * @param int    $dev Is developer activation? Set 1 or 0.
	 *
	 * @return void
	 */
	public function activate( $purchase, $token, $dev ) {
		update_option( 'omniverse_token', $token );
		update_option( 'omniverse_is_activated', true );
		update_option( 'omniverse_purchase_code', $purchase );
		update_option( 'omniverse_dev_domain', $dev );
	}

	/**
	 * Deactivated theme.
	 *
	 * @return void
	 */
	public function deactivate() {
		$this->_api->call( 'deactivate/?token=' . get_option( 'omniverse_token' ) );

		delete_option( 'omniverse_token' );
		delete_option( 'omniverse_is_activated' );
		delete_option( 'omniverse_purchase_code' );
		delete_option( 'omniverse-update-time' );
		delete_option( 'omniverse-update-info' );
		delete_option( 'omniverse_dev_domain' );
	}
}
