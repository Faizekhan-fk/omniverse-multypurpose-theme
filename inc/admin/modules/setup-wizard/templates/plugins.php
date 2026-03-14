<?php
/**
 * Plugins template.
 *
 * @package omniverse
 */

use DN\Admin\Modules\Setup_Wizard;
use DN\Admin\Modules\Setup_Wizard\Install_Plugins;

if ( isset( $_GET['wd_builder'] ) ) {
	$builder = esc_html( $_GET['wd_builder'] );
} elseif ( omniverse_get_current_page_builder() ) {
	$builder = omniverse_get_current_page_builder();
} else {
	$builder = 'elementor';
}

$dashboard       = Setup_Wizard::get_instance();
$install_plugins = Install_Plugins::get_instance();

if ( isset( $args['show_plugins'] ) && 'compatible' === $args['show_plugins'] ) {
	$plugins_list = omniverse_get_config( 'compatible-plugins' );
} else {
	$plugins_list = $install_plugins->get_plugins();
}

if ( $dashboard->is_setup() ) {
	$button_item_class = 'dn-inline-btn dn-style-underline';
} else {
	$button_item_class = 'dn-btn';
}

?>
<div class="dn-plugins<?php echo $install_plugins->is_all_activated() ? ' dn-all-active' : ''; ?>">
	<div class="dn-plugin-response"></div>

	<?php if ( $dashboard->is_setup() ) : ?>
		<h3>
			<?php esc_html_e( 'Plugins activation', 'omniverse' ); ?>
		</h3>

		<p>
			<?php esc_html_e( 'Install and activate plugins for you website.', 'omniverse' ); ?>
		</p>
	<?php endif; ?>

	<ul>
		<?php foreach ( $plugins_list as $slug => $plugin_data ) : ?>
			<?php $image_url = isset( $plugin_data['image'] ) ? $plugin_data['image'] : $slug . '.svg'; ?>
			<li class="dn-plugin-wrapper<?php echo isset( $plugin_data['description'] ) ? ' dn-large' : ''; ?>">
				<div class="dn-plugin-heading">
					<div class="dn-plugin-img">
						<img src="<?php echo esc_url( $dashboard->get_plugin_image_url( $image_url ) ); ?>" alt="plugin logo">
					</div>

					<span class="dn-plugin-name">
						<?php echo esc_html( $plugin_data['name'] ); ?>
					</span>
				</div>

					<span class="dn-plugin-required">
						<?php if ( ! empty( $plugin_data['required'] ) || 'elementor' === $slug || 'js_composer' === $slug ) : ?>
							<span class="dn-plugin-required-dot"></span>
							<span class="dn-plugin-required-text">
								<?php esc_html_e( 'Required', 'omniverse' ); ?>
							</span>
						<?php endif; ?>
					</span>

				<?php if ( ! empty( $plugin_data['description'] ) ) : ?>
					<div class="dn-plugin-description">
						<?php echo esc_html( $plugin_data['description'] ); ?>
					</div>
				<?php endif; ?>

				<span class="dn-plugin-version">
					<?php if ( ! empty( $plugin_data['version'] ) ) : ?>
						<span>
							<?php echo esc_html( $plugin_data['version'] ); ?>
						</span>
					<?php endif; ?>
				</span>

				<div class="dn-plugin-btn-wrapper">
					<?php if ( is_multisite() && is_plugin_active_for_network( $plugin_data['file_path'] ) ) : ?>
						<span class="dn-plugin-btn-text">
							<?php esc_html_e( 'Plugin activated globally.', 'omniverse' ); ?>
						</span>
					<?php elseif ( isset( $plugin_data['status'] ) && 'require_update' !== $plugin_data['status'] ) : ?>
						<a class="<?php echo esc_attr( $button_item_class ); ?> dn-ajax-plugin dn-<?php echo esc_html( $plugin_data['status'] ); ?>"
							href="<?php echo esc_url( $install_plugins->get_action_url( $slug, $plugin_data['status'] ) ); ?>"
							data-plugin="<?php echo esc_attr( $slug ); ?>"
							data-builder="<?php echo esc_attr( $builder ); ?>"
							data-action="<?php echo esc_attr( $plugin_data['status'] ); ?>">
							<span><?php echo esc_html( $install_plugins->get_action_text( $plugin_data['status'] ) ); ?></span>
						</a>
					<?php elseif ( $dashboard->is_setup() ) : ?>
						<span class="dn-plugin-btn-text">
							<?php esc_html_e( 'Required update not available', 'omniverse' ); ?>
						</span>
					<?php endif; ?>

					<?php if ( isset( $plugin_data['buttons'] ) ) : ?>
						<?php foreach ( $plugin_data['buttons'] as $button ) : ?>
							<a href="<?php echo esc_url( $button['url'] ); ?>" class="dn-btn<?php echo isset( $button['extra-class'] ) ? ' ' . esc_attr( $button['extra-class'] ) : ''; ?>">
								<?php echo esc_html( $button['name'] ); ?>
							</a>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php if ( $plugins_list && ( ! isset( $args['show_plugins'] ) || 'compatible' !== $args['show_plugins'] ) ) : ?>
		<script>
			var dnPluginsData = <?php echo wp_json_encode( $plugins_list ); ?>
		</script>
	<?php endif; ?>
</div>

<?php if ( $dashboard->is_setup() ) : ?>
	<div class="dn-wizard-footer">
			<?php $dashboard->get_prev_button( 'business-type', $_GET['wd_builder'], $_GET['business_type'] ); ?>
		<div>
			<a class="dn-inline-btn dn-style-underline dn-wizard-all-plugins" href="#">
				<?php esc_html_e( 'Install & activate all', 'omniverse' ); ?>
			</a>
			<?php $dashboard->get_next_business_type_button( 'prebuilt-websites', $_GET['wd_builder'], $_GET['business_type'], count( $install_plugins->get_required_plugins_to_activate() ) > 0 ); ?>
		</div>
	</div>
<?php endif; ?>
