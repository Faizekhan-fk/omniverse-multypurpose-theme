<?php
wp_enqueue_script( 'wd-setup-wizard', OMNIVERSE_ASSETS . '/js/wizard.js', array(), OMNIVERSE_VERSION, true );

use DN\Admin\Modules\Setup_Wizard;
require_once get_template_directory() . '/inc/admin/modules/setup-wizard/class-setup-wizard.php';
$wizard = Setup_Wizard::get_instance();
$business_type = get_option( 'wd_business_type' );
$page = $_GET['page'];
$url = 'admin.php?page=zs_page_builder';
?>

<div class="dn-box dn-theme-style">
	<div class="dn-box-header">
		<h3>
			<?php esc_html_e( 'Page Builder', 'omniverse' ); ?>
		</h3>
		<p>
			<?php esc_html_e( 'Choose one of the Page Builder', 'omniverse' ); ?>
		</p>
	</div>

	<div class="dn-box-content">
		<div class="dn-wizard-builder-select">
			<div class="dn-wizard-ecommerce <?php echo ($business_type) == 'ecommerce'?'dn-active':''; ?>" data-builder="ecommerce">
				<div class="dn-page-builder-img">
					<img src="<?php echo esc_url( $wizard->get_image_url( 'elementor-builder.svg' ) ); ?>" alt="elementor logo" width="51" height="40">
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

			<div class="dn-wizard-lms <?php echo ($business_type) == 'lms'?'dn-active':''; ?>" data-builder="lms">
				<div class="dn-page-builder-img">
					<img src="<?php 
				echo esc_url( $wizard->get_image_url( 'wpb.svg' ) );
				?>" alt="wpb logo" width="51" height="40">
				</div>

				<div class="dn-page-builder-title">
					<?php esc_attr_e( 'WPBakery', 'omniverse' ); ?>
				</div>

				<p>
					<?php esc_attr_e( 'WPBakery Page Builder plugin for WordPress', 'omniverse' ); ?>
				</p>
			</div>
		</div>
		<div class="dn-stup-footer">
			<a class="dn-btn dn-color-primary dn-next dn-ecommerce dn-shown" href="<?php echo esc_url( $url ); ?>&business_type=ecommerce">
				<?php esc_html_e( 'Update', 'omniverse' ); ?>
			</a>
			<a class="dn-btn dn-color-primary dn-next dn-lms dn-hidden" href="<?php echo esc_url( $url ); ?>&business_type=lms">
				<?php esc_html_e( 'Update', 'omniverse' ); ?>
			</a>
		</div>
	</div>
</div>
