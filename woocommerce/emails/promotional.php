<?php
/**
 * Customer "promotional" email.
 *
 * @package DN
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>
	<?php echo wp_kses_post( $email_content ); ?>

	<p>
		<small>
			<?php echo wp_kses( sprintf( __( 'If you don\'t want to receive any further notification, please %s', 'omniverse' ), '<a href="' . omniverse_get_unsubscribe_link( $email->user->ID ) . '">' . esc_html__( 'unsubscribe', 'omniverse' ) . '</a>' ), true ); ?>
		</small>
	</p>

<?php do_action( 'woocommerce_email_footer', $email ); ?>
