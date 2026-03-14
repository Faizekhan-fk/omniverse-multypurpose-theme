<?php
/**
 * The template for displaying all html block.
 *
 * @package dn
 */

if ( ! current_user_can( apply_filters( 'omniverse_html_block_access', 'administrator' ) ) ) {
	wp_die( 'You do not have access.', '', array( 'back_link' => true ) );
}

get_header();

?>
<?php if ( omniverse_is_elementor_installed() && ( omniverse_elementor_is_edit_mode() || omniverse_elementor_is_preview_page() || omniverse_elementor_is_preview_mode() ) ) : ?>
	<div class="wd-html-block-scheme-switcher">
		<div class="wd-html-block-scheme-dark" data-color="#ffffff">
			<?php esc_html_e( 'Dark', 'omniverse' ); ?>
		</div>
	
		<div class="wd-html-block-scheme-light" data-color="#212121">
			<?php esc_html_e( 'Light', 'omniverse' ); ?>
		</div>
	</div>

	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('.wd-html-block-scheme-switcher > div').on('click', function() {
				jQuery('.website-wrapper').css('background-color', jQuery(this).data('color'));
			});
		});
	</script>
<?php endif; ?>

<div class="container">
	<div class="row">
		<div class="site-content col-lg-12 col-12 col-md-12">
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		</div>
	</div>
</div>

<?php

get_footer();
