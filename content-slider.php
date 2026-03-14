<?php
$omniverse_loop = omniverse_loop_prop( 'omniverse_loop' );

$classes = array();

$blog_design    = omniverse_loop_prop( 'blog_design' );
$classes[]      = 'wd-post';
$classes[]      = 'blog-post-loop';
$classes[]      = 'blog-design-' . $blog_design;
$blog_style     = omniverse_get_opt( 'blog_style', 'shadow' );
$post_format    = get_post_format();
$thumb_classes  = '';
$gallery_slider = apply_filters( 'omniverse_gallery_slider', true );
$gallery        = array();

if ( ! is_single() && 'quote' === $post_format ) {
	omniverse_enqueue_inline_style( 'blog-loop-format-quote' );
}

if ( 'shadow' === $blog_style ) {
	$classes[] = 'blog-style-bg';

	if ( omniverse_get_opt( 'blog_with_shadow', true ) ) {
		$classes[] = 'wd-add-shadow';
	}
} else {
	$classes[] = 'blog-style-' . $blog_style;
}

if ( ! get_the_title() ) {
	$classes[] = 'post-no-title';
}

if ( 'gallery' === $post_format && $gallery_slider ) {
	$gallery = get_post_gallery( false, false );

	if ( ! empty( $gallery['src'] ) ) {
		$thumb_classes .= ' wd-carousel-container wd-post-gallery color-scheme-light';
	}
}

$random = rand( 100, 999 );

$carosel_attrs = array(
	'post_type'               => 'post',
	'slides_per_view'         => 1,
	'hide_pagination_control' => 'yes',
	'autoheight'              => 'yes',
);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="article-inner">
		<header class="entry-header">
			<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() && omniverse_loop_prop( 'parts_media' ) ) : ?>
				<figure class="entry-thumbnail<?php echo esc_attr( $thumb_classes ); ?>">
					<?php if ( 'gallery' === $post_format && $gallery_slider && ! empty( $gallery['src'] ) ) : ?>
						<?php
						omniverse_enqueue_js_library( 'swiper' );
						omniverse_enqueue_js_script( 'swiper-carousel' );
						omniverse_enqueue_inline_style( 'swiper' );
						?>
						<div class="wd-carousel-inner">
							<div class="wd-carousel wd-grid"<?php echo omniverse_get_carousel_attributes( $carosel_attrs ); ?>>
								<div class="wd-carousel-wrap">
									<?php
										foreach ( $gallery['src'] as $src ) {
											if ( preg_match( "/data:image/is", $src ) ) {
												continue;
											}
											?>
											<div class="wd-carousel-item">
												<?php echo apply_filters( 'omniverse_image', '<img src="' . esc_url( $src ) . '" />' ); ?>
											</div>
											<?php
										}
									?>
								</div>
							</div>
							<?php omniverse_get_carousel_nav_template( ' wd-post-arrows wd-pos-sep wd-custom-style' ); ?>
						</div>
					<?php else: ?>
						<div class="post-img-wrapp">
							<a href="<?php echo esc_url( get_permalink() ); ?>">
								<?php echo omniverse_get_post_thumbnail( 'large' ); ?>
							</a>
						</div>
					<?php endif; ?>
					<div class="post-image-mask">
						<span></span>
					</div>
				</figure>
			<?php endif; ?>

			<?php
			omniverse_post_date(
				array(
					'style' => 'wd-style-with-bg',
				)
			);
			?>
		</header><!-- .entry-header -->

		<div class="article-body-container">
			<?php if ( omniverse_loop_prop( 'parts_meta' ) && get_the_category_list( ', ' ) ) : ?>
				<div class="meta-categories-wrapp"><div class="meta-post-categories wd-post-cat wd-style-with-bg"><?php echo get_the_category_list( ', ' ); ?></div></div>
			<?php endif ?>

			<?php if ( omniverse_loop_prop( 'parts_title' ) ) : ?>
				<h3 class="wd-entities-title title post-title">
					<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h3>
			<?php endif; // is_single() ?>

			<?php if ( omniverse_loop_prop( 'parts_meta' ) ) : ?>
				<div class="entry-meta wd-entry-meta">
					<?php
					omniverse_post_meta(
						array(
							'author'        => 1,
							'author_avatar' => 1,
							'date'          => 0,
							'comments'      => 1,
							'author_label'  => 'long',
						)
					);
					?>
				</div><!-- .entry-meta -->

				<?php if ( omniverse_is_social_link_enable( 'share' ) ) : ?>
					<div class="hovered-social-icons wd-tltp wd-tltp-top">
						<div class="wd-tooltip-label">
							<?php
							if ( function_exists( 'omniverse_shortcode_social' ) ) {
								echo omniverse_shortcode_social( // phpcs:ignore.
									array(
										'size'  => 'small',
										'color' => 'light',
									)
								);
							}
							?>
						</div>
					</div>
				<?php endif ?>
			<?php endif ?>

			<?php
				$parts_btn       = omniverse_loop_prop( 'parts_btn' );
				$is_full_content = 'full' === omniverse_get_opt( 'blog_excerpt' );
			?>

			<?php if ( omniverse_loop_prop( 'parts_text' ) ) : ?>
				<div class="entry-content wd-entry-content<?php echo omniverse_get_old_classes( ' omniverse-entry-content' ); // phpcs:ignore. ?>">
					<?php omniverse_get_content( $parts_btn ); ?>
				</div><!-- .entry-content -->
			<?php endif; ?>

			<?php if ( ! $is_full_content && $parts_btn ) : ?>
				<?php omniverse_render_read_more_btn( 'link' ); ?>
			<?php endif; ?>
		</div>
	</div>
</article><!-- #post -->

<?php
// Increase loop count
omniverse_set_loop_prop( 'omniverse_loop', $omniverse_loop + 1 );
