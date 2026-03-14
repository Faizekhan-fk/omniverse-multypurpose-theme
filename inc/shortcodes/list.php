<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}

/**
* ------------------------------------------------------------------------------------------------
* List shortcode
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_list_shortcode' ) ) {
	function omniverse_list_shortcode( $atts ) {
		$list_class = apply_filters( 'vc_shortcodes_css_class', '', '', $atts );

		$atts = shortcode_atts(
			array(
				'icon_fontawesome' => 'far fa-bell',
				'icon_openiconic'  => 'vc-oi vc-oi-dial',
				'icon_typicons'    => 'typcn typcn-adjust-brightness',
				'icon_entypo'      => 'entypo-icon entypo-icon-note',
				'icon_linecons'    => 'vc_li vc_li-heart',
				'icon_monosocial'  => 'vc-mono vc-mono-fivehundredpx',
				'icon_material'    => 'vc-material vc-material-cake',
				'icon_library'     => 'fontawesome',
				'icons_color'      => '#333333',
				'icons_bg_color'   => '#f4f4f4',

				'image'            => '',
				'img_size'         => '25x25',

				'color_scheme'     => '',
				'size'             => 'default',
				'align'            => 'left',

				'list_items_gap'   => '',

				'list'             => '',
				'list_type'        => 'icon',
				'list_style'       => 'default',

				'el_class'         => '',
				'css_animation'    => 'none',
				'css'              => '',

				'omniverse_css_id'  => '',
			),
			$atts
		);

		extract( $atts );

		if ( 'icon' === $list_type && function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
			vc_icon_element_fonts_enqueue( $icon_library );
		}

		$list_items = $img = '';

		if ( function_exists( 'vc_param_group_parse_atts' ) ) {
			$list_items = vc_param_group_parse_atts( $list );
		}

		if ( empty( $list_items ) ) {
			return;
		}

		if ( ! $omniverse_css_id ) {
			$omniverse_css_id = uniqid();
		}
		$list_id = 'wd-' . $omniverse_css_id;

		$icon_class = 'list-icon wd-icon';
		if ( $list_type == 'icon' ) {
			$icon_class .= ' ' . ${'icon_' . $icon_library};
		}

		$list_class .= ' wd-list wd-wpb';
		$list_class .= ' color-scheme-' . $color_scheme;
		$list_class .= ' ' . omniverse_get_new_size_classes( 'list', $size, 'text' );
		$list_class .= ' wd-list-type-' . $list_type;
		$list_class .= ' wd-list-style-' . $list_style;
		$list_class .= ' wd-justify-' . $align;
		$list_class .= omniverse_get_css_animation( $css_animation );
		$list_class .= ( $el_class ) ? ' ' . $el_class : '';

		if ( $list_style == 'rounded' || $list_style == 'square' ) {
			$list_class .= ' wd-list-shape-icon';
		}
		if ( function_exists( 'vc_shortcode_custom_css_class' ) ) {
			$list_class .= ' ' . vc_shortcode_custom_css_class( $css );
		}

		$icon_output = '';

		if ( 'without' !== $list_type ) {
			$icon_output = '<span class="' . esc_attr( $icon_class ) . '"></span>';
		}

		if ( 'image' === $list_type && ! empty( $image ) ) {
			if ( omniverse_is_svg( wp_get_attachment_image_url( $image ) ) ) {
				$icon_output = omniverse_get_svg_html(
					$image,
					$atts['img_size']
				);
			} else {
				$icon_output = omniverse_otf_get_image_html( $image, $img_size );
			}
		}

		ob_start();

		omniverse_enqueue_inline_style( 'list' );
		?>

		<ul class="<?php echo esc_attr( $list_class ); ?>" id="<?php echo esc_attr( $list_id ); ?>">
			<?php foreach ( $list_items as $item ) : ?>
				<?php
				if ( ! isset( $item['list-content'] ) ) {
					continue;
				}

				if ( isset( $item['link'] ) ) {
					$link_attrs = omniverse_get_link_attributes( $item['link'] );
				}

				if ( empty( $item['item_image_size'] ) ) {
					$item['item_image_size'] = $img_size;
				}

				$item_icon_output = $icon_output;

				if ( isset( $item['item_type'] ) && 'image' === $item['item_type'] && isset( $item['image_id'] ) ) {
					if ( omniverse_is_svg( wp_get_attachment_image_url( $item['image_id'] ) ) ) {
						$item_icon_output = omniverse_get_svg_html(
							$item['image_id'],
							$item['item_image_size']
						);
					} else {
						$item_icon_output = omniverse_otf_get_image_html( $item['image_id'], $item['item_image_size'] );
					}
				}
				?>
				<li>
					<?php echo $item_icon_output; // phpcs:ignore ?>

					<span class="list-content"><?php echo do_shortcode( $item['list-content'] ); ?></span>
					<?php if ( isset( $item['link'] ) ) : ?>
						<a class="wd-fill" <?php echo $link_attrs; ?> aria-label="<?php esc_attr_e( 'List link', 'omniverse' ); ?>"></a>
					<?php endif; ?>
				</li>
			<?php endforeach ?>
		</ul>
		<?php
		if ( ( $icons_color && ! omniverse_is_css_encode( $icons_color ) ) || ( $icons_bg_color && ! omniverse_is_css_encode( $icons_bg_color ) ) ) {
			$css = '#' . esc_attr( $list_id ) . ' .wd-icon {';
			$css .= 'color: ' . esc_attr( $icons_color ) . ';';
			$css .= '}';

			if ( $list_style == 'rounded' || $list_style == 'square' ) {
				$css .= '#' . esc_attr( $list_id ) . ' .wd-icon {';
				$css .= 'background-color: ' . esc_attr( $icons_bg_color  ) . ';';
				$css .= '}';
			}

			wp_add_inline_style( 'omniverse-inline-css', $css );
		}

		return ob_get_clean();
	}
}
