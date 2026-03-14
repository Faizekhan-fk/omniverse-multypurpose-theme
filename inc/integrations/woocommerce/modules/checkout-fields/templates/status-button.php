<?php
/**
 * Status button template.
 *
 * @var bool $status Field status.
 * @var string $id Field id.
 * @var string $text_on The text that will be displayed when the button is on.
 * @var string $text_off The text that will be displayed when the button is off.
 * @package Omniverse
 */

$classes = '';

if ( $status ) {
	$classes .= ' dn-active';
}
?>

<div class="dn-switcher-btn<?php echo esc_attr( $classes ); ?>" data-id="<?php echo esc_attr( $id ); ?>" data-status="<?php echo esc_attr( $status ); ?>">
	<div class="dn-switcher-dot-wrap">
		<div class="dn-switcher-dot"></div>
	</div>
	<div class="dn-switcher-labels">
		<span class="dn-switcher-label dn-on">
			<?php echo ! empty( $text_on ) ? esc_html( $text_on ) : esc_html__( 'On', 'omniverse' ); ?>
		</span>

		<span class="dn-switcher-label dn-off">
			<?php echo ! empty( $text_off ) ? esc_html( $text_off ) : esc_html__( 'Off', 'omniverse' ); ?>
		</span>
	</div>
</div>
