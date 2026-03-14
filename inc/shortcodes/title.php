<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}

/**
 * ------------------------------------------------------------------------------------------------
 * Section title shortcode
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'omniverse_shortcode_title' ) ) {
	function omniverse_shortcode_title( $atts ) {
		$title_class = apply_filters( 'vc_shortcodes_css_class', '', '', $atts );

		$atts = shortcode_atts(
			array(
				'link'                    => '',
				'align'                   => 'center',
				'tag'                     => 'h4',
				'image'                   => '',
				'img_size'                => '200x50',
				'title_width'             => '100',

				'omniverse_css_id'         => '',
				'css_animation'           => 'none',
				'el_class'                => '',
				'css'                     => '',

				// Title
				'title'                   => '',
				'color'                   => 'default',
				'title_custom_color'      => '',
				'omniverse_color_gradient' => '',
				'style'                   => 'default',
				'size'                    => 'default',
				'font_weight'             => '',
				'title_font_size'         => '',

				// Old size
				'desktop_text_size'       => '',
				'tablet_text_size'        => '',
				'mobile_text_size'        => '',

				// Subtitle
				'subtitle'                => '',
				'subtitle_font'           => 'default',
				'subtitle_style'          => 'default',
				'subtitle_font_weight'    => '',

				// Text
				'after_title'             => '',

				// Extra.
				'title_decoration_style'  => 'colored',
			),
			$atts
		);

		extract( $atts );

		if ( ! $omniverse_css_id ) {
			$omniverse_css_id = uniqid();
		}
		$title_id   = 'wd-' . $omniverse_css_id;
		$style_attr = '';

		$subtitle_class = $title_container_class = $after_title_class = '';

		$title_class .= ' wd-title-color-' . $color;
		$title_class .= ' wd-title-style-' . $style;
		$title_class .= ' text-' . $align;
		$title_class .= omniverse_get_css_animation( $css_animation );
		$title_class .= ( $el_class ) ? ' ' . $el_class : '';

		if ( function_exists( 'vc_shortcode_custom_css_class' ) ) {
			$title_class .= ' ' . vc_shortcode_custom_css_class( $css );
		}

		if ( $title_width && 'custom' !== $title_width && '100' !== $title_width ) {
			$style_attr  .= ' style="--wd-max-width: ' . $title_width . '%;"';
			$title_class .= ' wd-width-enabled';
		}

		if ( 'custom' === $title_width ) {
			$title_class .= ' wd-width-custom';
		}

		if ( ! $title ) {
			$title_class .= ' wd-title-empty';
		}

		$subtitle_class .= ' subtitle-color-' . $color;
		$subtitle_class .= ' font-' . $subtitle_font;
		$subtitle_class .= ' subtitle-style-' . $subtitle_style;
		$subtitle_class .= ' wd-font-weight-' . $subtitle_font_weight;
		$subtitle_class .= ' ' . omniverse_get_new_size_classes( 'title', $size, 'subtitle' );

		$title_container_class .= ' wd-font-weight-' . $font_weight;
		$title_container_class .= ' ' . omniverse_get_new_size_classes( 'title', $size, 'title' );

		$after_title_class .= ' ' . omniverse_get_new_size_classes( 'title', $size, 'after_title' );

		$gradient_style = ( $color == 'gradient' ) ? 'style="' . omniverse_get_gradient_css( $omniverse_color_gradient ) . ';"' : '';

		ob_start();

		omniverse_enqueue_inline_style( 'section-title' );

		if ( in_array( $style, array( 'bordered', 'simple' ), true ) ) {
			omniverse_enqueue_inline_style( 'section-title-style-simple-and-brd' );
		} elseif ( in_array( $style, array( 'overlined', 'underlined', 'underlined-2' ), true ) ) {
			omniverse_enqueue_inline_style( 'section-title-style-under-and-over' );
		}

		if ( isset( $title_decoration_style ) && 'default' !== $title_decoration_style ) {
			$title_class .= ' wd-underline-' . $title_decoration_style;
			omniverse_enqueue_inline_style( 'mod-highlighted-text' );
		}
		?>

		<div id="<?php echo esc_attr( $title_id ); ?>" class="title-wrapper wd-wpb set-mb-s reset-last-child <?php echo esc_attr( $title_class ); ?>"<?php echo wp_kses( $style_attr, true ); ?>>
			<?php if ( $subtitle != '' ) : ?>
				<div class="title-subtitle <?php echo esc_attr( $subtitle_class ); ?>"><?php echo wp_kses( $subtitle, omniverse_get_allowed_html() ); ?></div>
			<?php endif; ?>

			<div class="liner-continer">
				<?php echo '<' . $tag . ' class="omniverse-title-container title ' . $title_container_class . '" ' . $gradient_style . '>' . $title . '</' . $tag . '>'; ?>

				<?php if ( $image ) : ?>
					<?php echo omniverse_display_icon( $image, $img_size, 128 ); ?>
				<?php endif; ?>
			</div>
			
			<?php if ( $after_title != '' ) : ?>
				<div class="title-after_title  set-cont-mb-s reset-last-child <?php echo esc_attr( $after_title_class ); ?>"><?php echo wp_kses( $after_title, omniverse_get_allowed_html() ); ?></div>
			<?php endif; ?>

			<?php
			if ( $size == 'custom' && ! $title_font_size  ) {
				$css = '';

				if ( $desktop_text_size ) {
					$css .= omniverse_responsive_text_size_css( $title_id, 'omniverse-title-container', $desktop_text_size, 'return' );
				}

				if ( $tablet_text_size ) {
					$css .= '@media (max-width: 1199px) {';
					$css .= omniverse_responsive_text_size_css( $title_id, 'omniverse-title-container', $tablet_text_size, 'return' );
					$css .= '}';
				}

				if ( $mobile_text_size  ) {
					$css .= '@media (max-width: 767px) {';
					$css .= omniverse_responsive_text_size_css( $title_id, 'omniverse-title-container', $mobile_text_size, 'return' );
					$css .= '}';
				}

				wp_add_inline_style( 'omniverse-inline-css', $css );
			}
			?>

		</div>
		
		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;

	}
}
