<?php
/**
 * The template for displaying the footer
 */

if ( omniverse_get_opt( 'collapse_footer_widgets' ) && ( ! omniverse_get_opt( 'mobile_optimization', 0 ) || ( wp_is_mobile() && omniverse_get_opt( 'mobile_optimization' ) ) ) ) {
	omniverse_enqueue_inline_style( 'widget-collapse' );
	omniverse_enqueue_js_script( 'widget-collapse' );
}

$page_id                 = omniverse_page_ID();
$disable_prefooter       = get_post_meta( $page_id, '_omniverse_prefooter_off', true );
$disable_footer_page     = get_post_meta( $page_id, '_omniverse_footer_off', true );
$disable_copyrights_page = get_post_meta( $page_id, '_omniverse_copyrights_off', true );
?>
<?php if ( omniverse_needs_footer() ) : ?>
	<?php if ( ! omniverse_is_woo_ajax() ) : ?>
		</div><!-- .main-page-wrapper --> 
	<?php endif ?>
		</div> <!-- end row -->
	</div> <!-- end container -->

	<?php if ( ! $disable_prefooter && ( 'text' === omniverse_get_opt( 'prefooter_content_type', 'text' ) && omniverse_get_opt( 'prefooter_area' ) || 'html_block' === omniverse_get_opt( 'prefooter_content_type' ) && omniverse_get_opt( 'prefooter_html_block' ) ) ) : ?>
		<?php omniverse_enqueue_inline_style( 'footer-base' ); ?>
		<div class="wd-prefooter<?php echo omniverse_get_old_classes( ' omniverse-prefooter' ); ?>">
			<div class="container">
				<?php if ( 'text' === omniverse_get_opt( 'prefooter_content_type', 'text' ) ) : ?>
					<?php echo do_shortcode( omniverse_get_opt( 'prefooter_area' ) ); ?>
				<?php else : ?>
					<?php echo omniverse_get_html_block( omniverse_get_opt( 'prefooter_html_block' ) ); ?>
				<?php endif; ?>
			</div>
		</div>
	<?php endif ?>

	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) : ?>
		<footer class="footer-container color-scheme-<?php echo esc_attr( omniverse_get_opt( 'footer-style' ) ); ?>">
			<?php if ( ! $disable_footer_page && omniverse_get_opt( 'disable_footer' ) ) : ?>
				<?php omniverse_enqueue_inline_style( 'footer-base' ); ?>
				<?php if ( 'widgets' === omniverse_get_opt( 'footer_content_type', 'widgets' ) ) : ?>
					<?php get_sidebar( 'footer' ); ?>
				<?php else : ?>
					<div class="container main-footer">
						<?php echo omniverse_get_html_block( omniverse_get_opt( 'footer_html_block' ) ); ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( ! $disable_copyrights_page && omniverse_get_opt( 'disable_copyrights' ) ) : ?>
				<?php omniverse_enqueue_inline_style( 'footer-base' ); ?>
				<div class="copyrights-wrapper copyrights-<?php echo esc_attr( omniverse_get_opt( 'copyrights-layout' ) ); ?>">
					<div class="container">
						<div class="min-footer">
							<div class="col-left set-cont-mb-s reset-last-child">
								<?php if ( omniverse_get_opt( 'copyrights' ) != '' ) : ?>
									<?php echo do_shortcode( omniverse_get_opt( 'copyrights' ) ); ?>
								<?php else : ?>
									<p>&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>. <?php esc_html_e( 'All rights reserved', 'omniverse' ); ?></p>
								<?php endif ?>
							</div>
							<?php if ( omniverse_get_opt( 'copyrights2' ) != '' ) : ?>
								<div class="col-right set-cont-mb-s reset-last-child">
									<?php echo do_shortcode( omniverse_get_opt( 'copyrights2' ) ); ?>
								</div>
							<?php endif ?>
						</div>
					</div>
				</div>
			<?php endif ?>
		</footer>
	<?php endif ?>
<?php endif ?>
</div> <!-- end wrapper -->
<div class="wd-close-side wd-fill<?php echo omniverse_get_old_classes( ' omniverse-close-side' ); ?>"></div>
<?php do_action( 'omniverse_before_wp_footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
