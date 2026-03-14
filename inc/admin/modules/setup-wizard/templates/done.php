<?php
/**
 * Done template.
 *
 * @package omniverse
 */

?>

<div class="dn-wizard-content-inner dn-wizard-done">
	<div class="dn-wizard-logo">
		<img src="<?php echo esc_url( $this->get_image_url( 'logo.svg' ) ); ?>" alt="logo">
	</div>

	<h3>
		<?php esc_html_e( 'Everything is ready!', 'omniverse' ); ?>
	</h3>

	<p>
		<?php
		esc_html_e(
			'Congratulations! You have successfully installed our theme. Now you can start creating your amazing website with a help of our theme. It provides you with a full control on your website layout style.',
			'omniverse'
		);
		?>
	</p>

	<div class="dn-wizard-buttons">
		<a class="dn-btn dn-color-primary dn-i-view" href="<?php echo esc_url( get_home_url() ); ?>">
			<?php esc_html_e( 'View home page', 'omniverse' ); ?>
		</a>

		<a class="dn-inline-btn dn-i-cart" href="<?php echo esc_url( wc_admin_url( '&path=/setup-wizard' ) ); ?>">
			<?php esc_html_e( 'WooCommerce setup', 'omniverse' ); ?>
		</a>

		<a class="dn-inline-btn dn-i-theme-settings" href="<?php echo esc_url( admin_url( 'admin.php?page=zs_theme_settings' ) ); ?>">
			<?php esc_html_e( 'Theme Options', 'omniverse' ); ?>
		</a>

		<a class="dn-inline-btn dn-i-header-builder" href="<?php echo esc_url( admin_url( 'admin.php?page=zs_header_builder' ) ); ?>">
			<?php esc_html_e( 'Header builder', 'omniverse' ); ?>
		</a>
	</div>
</div>
