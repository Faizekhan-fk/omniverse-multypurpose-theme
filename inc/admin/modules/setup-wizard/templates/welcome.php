<?php
/**
 * Welcome template.
 *
 * @package omniverse
 */

?>

<div class="dn-wizard-content-inner dn-wizard-welcome">

	<div class="dn-wizard-logo">
		<img class="dn-wizard-logo" src="<?php echo esc_url( $this->get_image_url( 'logo.svg' ) ); ?>" alt="logo">
		</div>

	<h3>
		<?php esc_html_e( 'Welcome to Omniverse Theme!', 'omniverse' ); ?>
	</h3>

	<p>
		<?php
		esc_html_e(
			'Thank you for choosing Omniverse — your powerful solution for building modern, flexible, and high-performance websites.'
		);
		?>
	</p>

	<p>
		<?php
		esc_html_e(
			'You’ve successfully installed the theme and are ready to start creating your website. Omniverse gives you full control over layout design, colors, typography, and many other customization options to craft a unique online experience.'
		);
		?>
	</p>
	
	<p>
		<?php
		esc_html_e(
			'Follow the next setup steps to get started, explore the features, and bring your project to life. If you need any assistance, feel free to contact our support team or explore our other products.'
		);
		?>
	</p>
	
	<p>
		<?php
		esc_html_e(
			'Enjoy building with Omniverse!'
		);
		?>
	</p>

	<p class="dn-wizard-signature">
		<span>
			<?php esc_html_e( 'Good Luck!', 'omniverse' ); ?>
		</span>
		<img src="<?php echo esc_url( $this->get_image_url( 'signature.png' ) ); ?>" alt="signature">
	</p>

	<div class="dn-wizard-buttons">
		<a class="dn-inline-btn dn-style-underline" href="<?php echo esc_url( admin_url( 'admin.php?page=zs_dashboard&skip_setup' ) ); ?>">
			<?php esc_html_e( 'Skip setup', 'omniverse' ); ?>
		</a>

		<a class="dn-btn dn-color-primary dn-next" href="<?php echo esc_url( $this->get_page_url( 'activation' ) ); ?>">
			<?php esc_html_e( 'Let\'s start', 'omniverse' ); ?>
		</a>
	</div>

</div>
