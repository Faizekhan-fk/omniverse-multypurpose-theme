<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}

/**
* ------------------------------------------------------------------------------------------------
* Menu price element
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_shortcode_menu_price' ) ) {
	function omniverse_shortcode_menu_price( $atts, $content ) {
		$click = $output = $class = '';
		extract(
			shortcode_atts(
				array(
					'img_id'          => '',
					'img_size'        => 'full',
					'title'           => '',
					'description'     => '',
					'price'           => '',
					'link'            => '',
					'css_animation'   => 'none',
					'el_class'        => '',
					'omniverse_css_id' => '',
					'css'             => '',
				),
				$atts
			)
		);

		$link_attributes = omniverse_get_link_attributes( $link );

		if ( $link_attributes ) {
			$class .= ' wd-with-link';
		}

		$class .= ' ' . $el_class;
		$class .= omniverse_get_css_animation( $css_animation );
		$class .= omniverse_get_old_classes( ' omniverse-menu-price' );

		if ( ! empty( $omniverse_css_id ) ) {
			$class .= ' wd-rs-' . $omniverse_css_id;
		}

		if ( function_exists( 'vc_shortcode_custom_css_class' ) ) {
			$class .= ' ' . vc_shortcode_custom_css_class( $css );
		}

		ob_start();

		omniverse_enqueue_inline_style( 'menu-price' );
		?>
			<div class="wd-menu-price wd-wpb <?php echo esc_attr( $class ); ?>">
				<?php if ( $img_id ) : ?>
					<div class="menu-price-image">
						<?php
							echo omniverse_otf_get_image_html( $img_id, $img_size );
						?>
					</div>
				<?php endif ?>
				<div class="menu-price-desc-wrapp">
					<div class="menu-price-heading">
						<?php if ( ! empty( $title ) ) : ?>
							<h3 class="menu-price-title wd-entities-title"><span><?php echo wp_kses( $title, omniverse_get_allowed_html() ); ?></span></h3>
						<?php endif ?>
						<div class="menu-price-price price"><?php echo wp_kses( $price, omniverse_get_allowed_html() ); ?></div>
					</div>
					<?php if ( $description ) : ?>
						<div class="menu-price-details"><?php echo do_shortcode( $description ); ?></div>
					<?php endif ?>
				</div>

				<?php if ( $link_attributes ) : ?>
					<a class="wd-menu-price-link wd-fill" aria-label="<?php esc_html_e( 'Menu price link', 'omniverse' ); ?>" <?php echo wp_kses( $link_attributes, true ); ?>></a>
				<?php endif; ?>
			</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}
