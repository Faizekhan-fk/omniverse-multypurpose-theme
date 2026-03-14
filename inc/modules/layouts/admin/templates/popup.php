<?php
/**
 * Popup template.
 *
 * @package Omniverse
 *
 * @var string $btn_text     Button text.
 * @var string $btn_classes  Button classes.
 * @var string $title_text   Title text.
 * @var string $content      Content.
 */

$btn_classes = isset( $btn_classes ) ? $btn_classes : '';

wp_enqueue_style( 'wd-admin-page-layouts', OMNIVERSE_ASSETS . '/css/parts/page-layouts.min.css', array(), OMNIVERSE_VERSION );
?>
<div class="dn-popup-holder">
	<div class="dn-popup-overlay"></div>
	<?php if ( $btn_text ) : ?>
		<a href="javascript:void(0);" class="dn-popup-opener dn-btn dn-color-primary<?php echo esc_attr( $btn_classes ); ?>">
			<?php echo esc_html( $btn_text ); ?>
		</a>
	<?php endif; ?>

	<div class="dn-popup dn-theme-style">
		<div class="dn-popup-inner">
			<div class="dn-popup-header">
				<div class="dn-popup-title">
					<?php echo esc_html( $title_text ); ?>
				</div>

				<a href="javascript:void(0);" class="dn-popup-close dn-i-close">
					<?php esc_html_e( 'Close', 'omniverse' ); ?>
				</a>
			</div>

			<div class="dn-popup-content">
				<div class="dn-notices-wrapper dn-layout-popup-notices"></div>

				<?php echo $content; // phpcs:ignore ?>
			</div>
		</div>
	</div>
</div>
