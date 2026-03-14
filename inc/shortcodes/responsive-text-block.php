<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}

/**
* ------------------------------------------------------------------------------------------------
* Omniverse responsive text block shortcode
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_shortcode_responsive_text_block' ) ) {
	function omniverse_shortcode_responsive_text_block( $atts, $content ) {
		$text_wrapper_class = apply_filters( 'vc_shortcodes_css_class', '', '', $atts );

		$atts = shortcode_atts(
			array(
				'text'               => 'Title',
				'font'               => 'primary',
				'font_weight'        => '',
				'content_width'      => '100',
				'color_scheme'       => '',
				'color'              => '',
				'size'               => 'default',
				'align'              => 'center',
				'text_font_size'     => '',
				'inline'             => 'no',

				// Old size
				'desktop_text_size'  => '',
				'tablet_text_size'   => '',
				'mobile_text_size'   => '',

				'omniverse_css_id'    => '',
				'css_animation'      => 'none',
				'el_class'           => '',
				'css'                => '',
			),
			$atts
		);

		extract( $atts );

		if ( ! $omniverse_css_id ) {
			$omniverse_css_id = uniqid();
		}

		$text_id    = 'wd-' . $omniverse_css_id;
		$style_attr = '';

		$text_wrapper_class .= ' color-scheme-' . $color_scheme;
		$text_wrapper_class .= ' text-' . $align;
		$text_wrapper_class .= $inline == 'yes' ? ' inline-element' : '';
		$text_wrapper_class .= omniverse_get_css_animation( $css_animation );

		if ( $content_width && 'custom' !== $content_width && '100' !== $content_width ) {
			$style_attr         .= ' style="--wd-max-width: ' . $content_width . '%;"';
			$text_wrapper_class .= ' wd-width-enabled';
		} elseif ( 'custom' === $content_width ) {
			$text_wrapper_class .= ' wd-width-custom';
		}

		$text_class  = ' font-' . $font;
		$text_class .= ' wd-font-weight-' . $font_weight;
		$text_class .= ' ' . omniverse_get_new_size_classes( 'text', $size, 'title' );

		if ( function_exists( 'vc_shortcode_custom_css_class' ) ) {
			$text_wrapper_class .= ' ' . vc_shortcode_custom_css_class( $css );
		}

		if ( $el_class != '' ) {
			$text_wrapper_class .= ' ' . $el_class;
		}

		ob_start();

		omniverse_enqueue_inline_style( 'responsive-text' );
		?>
			<div id="<?php echo esc_attr( $text_id ); ?>" class="wd-text-block-wrapper wd-wpb<?php echo esc_attr( $text_wrapper_class ); ?>"<?php echo wp_kses( $style_attr, true ); ?>>
				<div class="omniverse-title-container omniverse-text-block reset-last-child<?php echo esc_attr( $text_class ); ?>">
					<?php echo do_shortcode( $content ); ?>
				</div>

				<?php
				if ( ( $size == 'custom' && ! $text_font_size ) || ( $color_scheme == 'custom' && ! omniverse_is_css_encode( $color ) ) ) {
					$css = '';

					if ( $desktop_text_size || $color ) {
						$css .= '#' . esc_attr( $text_id ) . ' .omniverse-text-block  {';
						if ( $desktop_text_size ) {
							$css .= 'font-size: ' . esc_attr( $desktop_text_size ) . 'px;';
							$css .= 'line-height: ' . esc_attr( (int) $desktop_text_size + 10 ) . 'px;';
						}

						if ( $color ) {
							$css .= 'color: ' . esc_attr( $color ) . ';';
						}
						$css .= '}';
					}

					if ( $tablet_text_size ) {
						$css .= '@media (max-width: 1199px) {';
						$css .= omniverse_responsive_text_size_css( $text_id, 'omniverse-text-block', $tablet_text_size, 'return' );
						$css .= '}';
					}

					if ( $mobile_text_size ) {
						$css .= '@media (max-width: 767px) {';
						$css .= omniverse_responsive_text_size_css( $text_id, 'omniverse-text-block', $mobile_text_size, 'return' );
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
