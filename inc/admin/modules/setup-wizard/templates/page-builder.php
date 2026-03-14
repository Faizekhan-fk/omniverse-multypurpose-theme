<?php
/**
 * Page builder template.
 *
 * @package omniverse
 */

?>

<div class="dn-wizard-content-inner dn-wizard-page-builder">

	<h3>
		<?php esc_html_e( 'Page builder plugin', 'omniverse' ); ?>
	</h3>

	<p>
		<?php esc_html_e( 'Choose one of the page builder plugins', 'omniverse' ); ?>
	</p>

	<div class="dn-wizard-builder-select">
		<div class="dn-wizard-elementor dn-active" data-builder="elementor">
			<div class="dn-page-builder-img">
				<img src="<?php echo esc_url( $this->get_image_url( 'elementor-builder.svg' ) ); ?>" alt="elementor logo">
			</div>

			<div class="dn-page-builder-title">
				<?php esc_attr_e( 'Elementor', 'omniverse' ); ?>
			</div>

			<p>
				<?php esc_attr_e( 'The World\'s Leading WordPress Website Builder', 'omniverse' ); ?>
			</p>
		</div>

		<span>
			<?php esc_attr_e( 'OR', 'omniverse' ); ?>
		</span>

		<div class="dn-wizard-wpb" data-builder="wpb">
			<div class="dn-page-builder-img">
				<img src="<?php echo esc_url( $this->get_image_url( 'wpb.svg' ) ); ?>" alt="wpb logo">
			</div>

			<div class="dn-page-builder-title">
				<?php esc_attr_e( 'WPBakery', 'omniverse' ); ?>
			</div>

			<p>
				<?php esc_attr_e( 'WPBakery Page Builder plugin for WordPress', 'omniverse' ); ?>
			</p>
		</div>
	</div>

</div>

<div class="dn-wizard-footer">
	<?php $this->get_prev_button( 'child-theme' ); ?>
	<?php $this->get_next_button( 'business-type', 'elementor' ); ?>
	<?php $this->get_next_button( 'business-type', 'wpb' ); ?>
</div>
