<?php
/**
 * The sidebar containing the secondary widget area
 *
 * Displays on posts and pages.
 *
 * If no active widgets are in this sidebar, hide it completely.
 */

use DN\Registry;

$sidebar_class = omniverse_get_sidebar_class();

$sidebar_name = Registry::getInstance()->layout->get_sidebar_name();

if ( strstr( $sidebar_class, 'col-lg-0' ) ) {
	return;
}
?>
<?php if ( omniverse_get_opt( 'shop_hide_sidebar' ) || omniverse_get_opt( 'shop_hide_sidebar_tablet' ) || omniverse_get_opt( 'shop_hide_sidebar_desktop' ) || omniverse_get_opt( 'hide_main_sidebar_mobile' ) ) : ?>
	<?php omniverse_enqueue_inline_style( 'off-canvas-sidebar' ); ?>
<?php endif; ?>

<aside class="sidebar-container <?php echo esc_attr( $sidebar_class ); ?> area-<?php echo esc_attr( $sidebar_name ); ?>">
	<?php if ( omniverse_get_opt( 'shop_hide_sidebar' ) || omniverse_get_opt( 'shop_hide_sidebar_tablet' ) || omniverse_get_opt( 'shop_hide_sidebar_desktop' ) || omniverse_get_opt( 'hide_main_sidebar_mobile' ) ) : ?>
		<div class="wd-heading">
			<div class="close-side-widget wd-action-btn wd-style-text wd-cross-icon">
				<a href="#" rel="nofollow noopener"><?php esc_html_e( 'Close', 'omniverse' ); ?></a>
			</div>
		</div>
	<?php endif; ?>
	<div class="widget-area">
		<?php do_action( 'omniverse_before_sidebar_area' ); ?>
		<?php dynamic_sidebar( $sidebar_name ); ?>
		<?php do_action( 'omniverse_after_sidebar_area' ); ?>
	</div><!-- .widget-area -->
</aside><!-- .sidebar-container -->
