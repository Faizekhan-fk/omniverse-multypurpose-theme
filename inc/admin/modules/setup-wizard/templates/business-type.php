<?php
/**
 * Business Type template.
 *
 * @package omniverse
 */

?>

<div class="dn-wizard-content-inner dn-wizard-page-builder">

	<h3>
		<?php esc_html_e( 'Business Type', 'omniverse' ); ?>
	</h3>

	<p>
		<?php esc_html_e( 'Choose one of the Business Type theme', 'omniverse' ); ?>
	</p>

	<div class="dn-wizard-builder-select">
		<div class="dn-wizard-ecommerce dn-active" data-builder="ecommerce">
			<div class="dn-page-builder-img">
				<img src="<?php echo esc_url( $this->get_image_url( 'ecommerce.svg' ) ); ?>" alt="ecommerce logo" width="51" height="40">
			</div>

			<div class="dn-page-builder-title">
				<?php esc_attr_e( 'E-Commerce', 'omniverse' ); ?>
			</div>

			<p>
				<?php esc_attr_e( 'E-commerce Website for WordPress', 'omniverse' ); ?>
			</p>
		</div>

		<span>
			<?php esc_attr_e( 'OR', 'omniverse' ); ?>
		</span>

		<div class="dn-wizard-lms" data-builder="lms">
			<div class="dn-page-builder-img">
				<img src="<?php echo esc_url( $this->get_image_url( 'lms.svg' ) ); ?>" alt="lms logo" width="51" height="40">
			</div>

			<div class="dn-page-builder-title">
				<?php esc_attr_e( 'LMS', 'omniverse' ); ?>
			</div>

			<p>
				<?php esc_attr_e( 'Learn Managment System Website for WordPress', 'omniverse' ); ?>
			</p>
		</div>
	</div>

</div>

<div class="dn-wizard-footer">
	<?php $this->get_prev_button( 'page-builder' ); ?>
	<?php $this->get_next_business_type_button( 'plugins', $_GET['wd_builder'], 'ecommerce' ); ?>
	<?php $this->get_next_business_type_button( 'plugins', $_GET['wd_builder'], 'lms' ); ?>
</div>
