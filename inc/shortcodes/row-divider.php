<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}

/**
* ------------------------------------------------------------------------------------------------
* Section divider shortcode
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_row_divider' ) ) {
	function omniverse_row_divider( $atts ) {
		extract(
			shortcode_atts(
				array(
					'position'        => 'top',
					'color'           => '#e1e1e1',
					'style'           => 'waves-small',
					'content_overlap' => '',
					'custom_height'   => '',
					'el_class'        => '',
					'omniverse_css_id' => '',
				),
				$atts
			)
		);

		if ( ! $omniverse_css_id ) {
			$omniverse_css_id = uniqid();
		}
		$divider_id = 'wd-' . $omniverse_css_id;

		$classes  = $divider_id;
		$classes .= ' dvr-position-' . $position;
		$classes .= ' dvr-style-' . $style;
		$classes .= omniverse_get_old_classes( ' omniverse-row-divider' );

		( $content_overlap == 'enable' ) ? $classes .= ' dvr-overlap-enable' : false;
		( $el_class != '' ) ? $classes              .= ' ' . $el_class : false;

		ob_start();

		omniverse_enqueue_inline_style( 'dividers' );
		?>
			<div id="<?php echo esc_attr( $divider_id ); ?>" class="wd-row-divider <?php echo esc_attr( $classes ); ?>">
				<?php echo omniverse_get_svg_content( $style . '-' . $position ); ?>
				<?php
				if ( ( $color && ! omniverse_is_css_encode( $color ) ) || $custom_height ) {
					$css = '.' . esc_attr( $divider_id ) . ' svg {';
					if ( $color && ! omniverse_is_css_encode( $color ) ) {
						$css .= 'fill: ' . esc_attr( $color ) . ';';
					}

					if ( $custom_height ) {
						$css .= 'height: ' . esc_attr( $custom_height  ) . ';';
					}
					$css .= '}';
					wp_add_inline_style( 'omniverse-inline-css', $css );
				}
				?>
			</div>
		<?php

		return ob_get_clean();
	}
}
