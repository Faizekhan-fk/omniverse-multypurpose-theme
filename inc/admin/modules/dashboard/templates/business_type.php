<?php
wp_enqueue_script( 'wd-setup-wizard', OMNIVERSE_ASSETS . '/js/wizard.js', array(), OMNIVERSE_VERSION, true );

use DN\Admin\Modules\Setup_Wizard;
require_once get_template_directory() . '/inc/admin/modules/setup-wizard/class-setup-wizard.php';
$wizard = Setup_Wizard::get_instance();
$business_type = get_option( 'wd_business_type' );
$page = $_GET['page'];
$url = 'admin.php?page=zs_business_type';
?>

<div class="dn-box dn-theme-style">
	<div class="dn-box-header">
		<h3>
			<?php esc_html_e( 'Business Type', 'omniverse' ); ?>
		</h3>
		<p>
			<?php esc_html_e( 'Choose one of the Business Type theme', 'omniverse' ); ?>
		</p>
	</div>

	<div class="dn-box-content">
		<div class="dn-wizard-builder-select">
			<div class="dn-wizard-ecommerce <?php echo ($business_type) == 'ecommerce'?'dn-active':''; ?>" data-builder="ecommerce">
				<div class="dn-page-builder-img">
					<img src="<?php echo esc_url( $wizard->get_image_url( 'ecommerce.svg' ) ); ?>" alt="ecommerce logo" width="51" height="40">
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

			<div class="dn-wizard-lms <?php echo ($business_type) == 'lms'?'dn-active':''; ?>" data-builder="lms">
				<div class="dn-page-builder-img">
					<img src="<?php 
				echo esc_url( $wizard->get_image_url( 'lms.svg' ) );
				?>" alt="lms logo" width="51" height="40">
				</div>

				<div class="dn-page-builder-title">
					<?php esc_attr_e( 'LMS', 'omniverse' ); ?>
				</div>

				<p>
					<?php esc_attr_e( 'Learn Managment System Website for WordPress', 'omniverse' ); ?>
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
