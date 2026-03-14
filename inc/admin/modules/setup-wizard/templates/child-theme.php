<?php
/**
 * Child theme template.
 *
 * @package omniverse
 */

?>

<div class="dn-wizard-content-inner dn-wizard-child-theme<?php echo is_child_theme() ? ' dn-installed' : ''; ?>">

	<div class="dn-child-theme-response"></div>

	<h3>
		<?php esc_html_e( 'Setup Omniverse Child Theme', 'omniverse' ); ?>
	</h3>

	<p>
		<?php esc_html_e( 'Install the child theme in a single click', 'omniverse' ); ?>
	</p>

	<div class="dn-theme-images">
		<div class="dn-main-image">
			<img  src="<?php echo esc_url( $this->get_image_url( 'parent.png' ) ); ?>" alt="parent">
		</div>
		<div class="dn-child-image">
			<img  src="<?php echo esc_url( $this->get_image_url( 'child.png' ) ); ?>" alt="child">
		</div>
		<span class="dn-child-checkmark"></span>
	</div>

	<p>
		<?php
		esc_html_e(
			'If you plan to customize the theme source code, we strongly recommend using the Omniverse Child Theme instead of editing the main theme files directly. This ensures that future updates to the parent theme won’t overwrite your custom changes.',
			'omniverse'
		);
		?>
	</p>
	
	<p>
		<?php
		esc_html_e(
			'The child theme allows you to safely modify HTML, CSS, PHP, and other theme elements while keeping the core Omniverse theme fully updatable.',
			'omniverse'
		);
		?>
	</p>
	
	<p>
		<?php
		esc_html_e(
			'Click the button below to automatically install and activate the Omniverse Child Theme and start customizing your website safely.',
			'omniverse'
		);
		?>
	</p>

	<a href="#" class="dn-btn dn-color-primary dn-install-child-theme">
		<?php esc_html_e( 'Install child theme', 'omniverse' ); ?>
	</a>
</div>

<div class="dn-wizard-footer">
	<?php $this->get_prev_button( 'activation' ); ?>
	<div>
		<?php $this->get_next_button( 'page-builder' ); ?>
		<?php $this->get_skip_button( 'page-builder' ); ?>
	</div>
</div>