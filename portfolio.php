<?php

/* Template name: Portfolio */

$filters_type  = omniverse_get_opt( 'portfolio_filters_type', 'masonry' );
$filters       = omniverse_get_opt( 'portoflio_filters' );
$content_class = omniverse_get_content_class();

if ( 'fragments' === omniverse_is_woo_ajax() ) {
	omniverse_get_portfolio_main_loop( true );
	die();
}

if ( ! omniverse_is_woo_ajax() ) {
	get_header();
} else {
	omniverse_page_top_part();
}

?>
<div class="site-content page-portfolio <?php echo esc_attr( $content_class ); ?>" role="main">
	<?php if ( have_posts() ) : ?>
		<div class="wd-portfolio-element">
			<?php if ( $filters && ( ( 'links' === $filters_type && is_tax() ) || ! is_tax() ) ) : ?>
				<?php omniverse_portfolio_filters( '', $filters_type ); ?>
			<?php endif ?>

			<?php omniverse_get_portfolio_main_loop(); ?>
		</div>
	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>
</div>
<?php

get_sidebar();

if ( ! omniverse_is_woo_ajax() ) {
	get_footer();
} else {
	omniverse_page_bottom_part();
}
