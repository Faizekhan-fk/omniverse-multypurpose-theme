<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 */

get_header();

// Get content width and sidebar position.
$content_class = omniverse_get_content_class();
?>

<div class="site-content <?php echo esc_attr( $content_class ); ?>" role="main">

		<?php /* The loop */ ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php get_template_part( 'content', get_post_format() ); ?>

			<div class="wd-single-footer"><?php if ( get_the_tag_list( '', ', ' ) ) : ?>
					<div class="single-meta-tags">
						<span class="tags-title"><?php esc_html_e( 'Tags', 'omniverse' ); ?>:</span>
						<div class="tags-list">
							<?php echo get_the_tag_list( '', ', ' ); ?>
						</div>
					</div>
				<?php endif; ?><?php if ( omniverse_get_opt( 'blog_share' ) && omniverse_is_social_link_enable( 'share' ) ) : ?>
					<div class="single-post-social">
						<?php
						if ( function_exists( 'omniverse_shortcode_social' ) ) {
							echo omniverse_shortcode_social(
								array(
									'type'    => 'share',
									'tooltip' => 'no',
									'style'   => 'colored',
								)
							);}
						?>
					</div>
				<?php endif ?></div>

			<?php
			if ( omniverse_get_opt( 'blog_navigation' ) ) {
				omniverse_posts_navigation();}
			?>

				<?php

				if ( omniverse_get_opt( 'blog_related_posts' ) ) {
					$args = omniverse_get_related_posts_args( $post->ID );

					$query  = new WP_Query( $args );
					$design = omniverse_get_opt( 'blog_design' );

					omniverse_enqueue_inline_style( 'blog-base' );
					if ( 'meta-image' === $design ) {
						omniverse_enqueue_inline_style( 'blog-loop-base' );
						omniverse_enqueue_inline_style( 'blog-loop-design-' . $design );
					} else {
						omniverse_enqueue_inline_style( 'blog-loop-base-old' );
						omniverse_enqueue_inline_style( 'blog-loop-design-masonry' );
					}

					if ( function_exists( 'omniverse_generate_posts_slider' ) ) {
						echo omniverse_generate_posts_slider( //phpcs:ignore.
							array(
								'title'                => esc_html__( 'Related Posts', 'omniverse' ),
								'blog_design'          => 'carousel',
								'blog_carousel_design' => 'meta-image' === $design ? $design : 'masonry',
								'wrapper_classes'      => ' related-posts-slider',
								'slides_per_view'      => 2,
								'parts_title'          => omniverse_get_opt( 'parts_title', true ),
								'parts_meta'           => omniverse_get_opt( 'parts_meta', true ),
								'parts_text'           => omniverse_get_opt( 'parts_text', true ),
								'parts_btn'            => omniverse_get_opt( 'parts_btn', true ),
								'spacing'              => 20,
							),
							$query
						);
					}
				}
				?>

				<?php comments_template(); ?>

		<?php endwhile; ?>

</div><!-- .site-content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
