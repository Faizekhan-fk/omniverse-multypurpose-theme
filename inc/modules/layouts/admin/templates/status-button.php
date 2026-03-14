<?php

$classes = '';

if ( 'publish' === $status ) {
	$classes .= ' dn-active';
}
?>


<div class="dn-switcher-btn<?php echo esc_attr( $classes ); ?>" data-id="<?php echo esc_attr( $post_id ); ?>" data-status="<?php echo esc_attr( $status ); ?>">
	<div class="dn-switcher-dot-wrap">
		<div class="dn-switcher-dot"></div>
	</div>
	<div class="dn-switcher-labels">
		<span class="dn-switcher-label dn-on">
			<?php esc_html_e( 'On', 'omniverse' ); ?>
		</span>

		<span class="dn-switcher-label dn-off">
			<?php esc_html_e( 'Off', 'omniverse' ); ?>
		</span>
	</div>
</div>
