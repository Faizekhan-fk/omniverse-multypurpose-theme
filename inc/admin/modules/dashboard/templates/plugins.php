<?php
wp_enqueue_script( 'wd-setup-wizard', OMNIVERSE_ASSETS . '/js/wizard.js', array(), OMNIVERSE_VERSION, true );
?>

<div class="dn-box dn-theme-style">
	<div class="dn-box-header">
		<h3>
			<?php esc_html_e( 'Theme plugins', 'omniverse' ); ?>
		</h3>
	</div>

	<div class="dn-box-content">
		<?php
		get_template_part(
			'inc/admin/modules/setup-wizard/templates/plugins',
			'',
			array( 'show_plugins' => 'theme_plugin' )
		);
		?>
	</div>
	<?php if ( ! omniverse_get_opt( 'white_label' ) ) : ?>
		<div class="dn-box-footer">
			<p>Plugins marked with "Required" label are needed for the smooth operation of the OmniVerse theme. Other plugins provide additional functionality but may be deleted if they are not necessary.</p>
		</div>
	<?php endif; ?>
</div>

<div class="dn-box dn-theme-style">
	<div class="dn-box-header">
		<h3>
			<?php esc_html_e( 'Compatible plugins', 'omniverse' ); ?>
		</h3>
	</div>

	<div class="dn-box-content">
		<?php
		get_template_part(
			'inc/admin/modules/setup-wizard/templates/plugins',
			'',
			array( 'show_plugins' => 'compatible' )
		);
		?>
	</div>
	<?php if ( ! omniverse_get_opt( 'white_label' ) ) : ?>
		<div class="dn-box-footer">
			<p>Didn't find a compatible plugin? <a href="https://zynxsol.com/forums/forum/omniverse-premium-template/">Get help</a></p>
		</div>
	<?php endif; ?>
</div>
