<?php
/**
 * Sidebar template.
 *
 * @package omniverse
 */

?>

<div class="dn-wizard-done-nav">
	<div class="dn-wizard-done-nav-img">
		<img src="<?php echo esc_url( $this->get_image_url( 'check.png' ) ); ?>" alt="check">
	</div>

	<h3>
		<?php esc_html_e( 'Congratulations!', 'omniverse' ); ?>
	</h3>

	<p>
		<?php esc_html_e( 'You have successfully installed our theme.', 'omniverse' ); ?>
	</p>

	{% comment %} <img class="dn-wizard-nav-bg-img" src="<?php echo esc_url( $this->get_image_url( 'themes.png' ) ); ?>" alt="themes"> {% endcomment %}
</div>

<ul>
	<?php
	$index        = 0;
	$current_page = 'welcome';

	if ( isset( $_GET['step'] ) && ! empty( $_GET['step'] ) ) { // phpcs:ignore
		$current_page = trim( wp_unslash( $_GET['step'] ) ); // phpcs:ignore
	}

	$current_page_index = array_search( $current_page, array_keys( $this->available_pages ), true );

	?>
	<?php foreach ( $this->available_pages as $slug => $text ) : ?>
		<?php
		$classes = '';
		if ( $index > $current_page_index ) {
			$classes .= ' dn-disabled';
		}

		if ( $this->is_active_page( $slug ) ) {
			$classes .= ' dn-active';
		}

		?>
		<li class="<?php echo esc_attr( $classes ); ?>" data-slug="<?php echo esc_attr( $slug ); ?>">
			<a href="<?php echo esc_url( $this->get_page_url( $slug ) ); ?>">
				<?php echo esc_html( $text ); ?>
			</a>
		</li>
		<?php $index++; ?>
	<?php endforeach; ?>
</ul>

<?php if ( isset( $_GET['step'] ) && 'welcome' === $_GET['step'] || ! isset( $_GET['step'] ) ) : // phpcs:ignore ?>

<?php endif; ?>
