<?php
/**
 * The template for displaying single project
 *
 */

get_header(); ?>

<?php 
	
	// Get content width and sidebar position
	$content_class = omniverse_get_content_class();

?>


<div class="site-content <?php echo esc_attr( $content_class ); ?>" role="main">

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

				<div class="portfolio-single-content">
					<?php the_content( esc_html__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'omniverse' ) ); ?>
				</div>

				<?php if ( omniverse_get_opt( 'portfolio_navigation' ) ) omniverse_posts_navigation(); ?>

				<?php
				$args = omniverse_get_related_projects_args( get_the_ID() );

				$query = new WP_Query( $args );

				if ( omniverse_get_opt( 'portfolio_related' ) ) {
					$style = omniverse_get_opt( 'portoflio_style' );

					if ( 'parallax' === $style ) {
						omniverse_enqueue_js_library( 'panr-parallax-bundle' );
						omniverse_enqueue_js_script( 'portfolio-effect' );
					}

					omniverse_enqueue_portfolio_loop_styles( $style );

					omniverse_enqueue_js_library( 'photoswipe-bundle' );
					omniverse_enqueue_inline_style( 'photoswipe' );
					omniverse_enqueue_js_script( 'portfolio-photoswipe' );
					echo omniverse_generate_posts_slider(
						array(
							'title'                   => esc_html__( 'Related projects', 'omniverse' ),
							'slides_per_view'         => 3,
							'hide_pagination_control' => 'yes',
							'custom_sizes'            => apply_filters( 'omniverse_portfolio_related_custom_sizes', false ),
							'spacing'                 => omniverse_get_opt( 'portfolio_spacing' ),
							'spacing_tablet'          => omniverse_get_opt( 'portfolio_spacing_tablet', '' ),
							'spacing_mobile'          => omniverse_get_opt( 'portfolio_spacing_mobile', '' ),
						),
						$query
					);
				}
				?>
		<?php endwhile; ?>

</div><!-- .site-content -->


<?php get_sidebar(); ?>

<?php get_footer(); ?>