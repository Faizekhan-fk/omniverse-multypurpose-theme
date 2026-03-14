<?php

use Elementor\Plugin;

if ( ! function_exists( 'omniverse_get_owl_atts' ) ) {
	function omniverse_get_owl_atts() {
		_deprecated_function( 'omniverse_get_owl_atts', '7.3', 'omniverse_get_carousel_atts' );

		return omniverse_get_carousel_atts();
	}
}

if ( ! function_exists( 'omniverse_get_owl_attributes' ) ) {
	function omniverse_get_owl_attributes( $atts = array(), $witout_init = false ) {
		_deprecated_function( 'omniverse_get_owl_attributes', '7.3', 'omniverse_get_carousel_attributes' );

		return omniverse_get_carousel_attributes( $atts );
	}
}

// **********************************************************************//
// Omniverse Owl Items Per Slide
// **********************************************************************//
if ( ! function_exists( 'omniverse_owl_items_per_slide' ) ) {
	function omniverse_owl_items_per_slide( $slides_per_view, $hide = array(), $post_type = false, $location = false, $custom_sizes = false ) {
		_deprecated_function( 'omniverse_owl_items_per_slide', '7.3' );

		$items   = omniverse_get_owl_items_numbers( $slides_per_view, $post_type, $custom_sizes );
		$classes = '';

		if ( omniverse_get_opt( 'thums_position' ) == 'centered' && $location == 'main-gallery' ) {
			$items['desktop'] = $items['tablet'] = $items['mobile'] = 2;
		}

		if ( ! in_array( 'lg', $hide ) ) {
			$classes .= 'owl-items-lg-' . $items['desktop'];
		}
		if ( ! in_array( 'md', $hide ) ) {
			$classes .= ' owl-items-md-' . $items['tablet_landscape'];
		}
		if ( ! in_array( 'sm', $hide ) ) {
			$classes .= ' owl-items-sm-' . $items['tablet'];
		}
		if ( ! in_array( 'xs', $hide ) ) {
			$classes .= ' owl-items-xs-' . $items['mobile'];
		}

		return $classes;
	}
}
// **********************************************************************//
// Omniverse Get Owl Items Numbers
// **********************************************************************//
if ( ! function_exists( 'omniverse_get_owl_items_numbers' ) ) {
	function omniverse_get_owl_items_numbers( $slides_per_view, $post_type = false, $custom_sizes = false ) {
		_deprecated_function( 'omniverse_get_owl_items_numbers', '7.3' );

		$items = omniverse_get_col_sizes( $slides_per_view );

		if ( $post_type == 'product' ) {
			if ( 'auto' !== omniverse_get_opt( 'products_columns_tablet' ) && ! empty( $mobile_columns ) ) {
				$items['tablet'] = omniverse_get_opt( 'products_columns_tablet' );
			}

			$items['mobile'] = omniverse_get_opt( 'products_columns_mobile' );
		}

		if ( $items['desktop'] == 1 ) {
			$items['mobile'] = 1;
		}

		if ( $custom_sizes && is_array( $custom_sizes ) ) {
			$auto_columns = omniverse_get_col_sizes( $custom_sizes['desktop'] );

			if ( empty( $custom_sizes['tablet'] ) || 'auto' === $custom_sizes['tablet'] ) {
				$custom_sizes['tablet'] = $auto_columns['tablet'];
			}

			if ( empty( $custom_sizes['mobile'] ) || 'auto' === $custom_sizes['mobile'] ) {
				$custom_sizes['mobile'] = $auto_columns['mobile'];
			}

			return $custom_sizes;
		}

		return $items;
	}
}

if ( ! function_exists( 'omniverse_elementor_get_content_css' ) ) {
	/**
	 * Retrieve builder content css.
	 *
	 * @since 1.0.0
	 *
	 * @param integer $id The post ID.
	 *
	 * @return string
	 */
	function omniverse_elementor_get_content_css( $id ) {
		_deprecated_function( 'omniverse_elementor_get_content_css', '7.3' );

		if ( ! omniverse_is_elementor_installed() ) {
			return '';
		}

		$post    = new Elementor\Core\Files\CSS\Post( $id );
		$meta    = $post->get_meta();
		$content = '';

		if ( Plugin::$instance->experiments->is_feature_active( 'additional_custom_breakpoints' ) ) {
			$content = $post->get_content();
		}

		ob_start();

		if ( $post::CSS_STATUS_FILE === $meta['status'] && apply_filters( 'omniverse_elementor_content_file_css', true ) && ! omniverse_is_woo_ajax() ) {
			?>
			<link rel="stylesheet" id="elementor-post-<?php echo esc_attr( $id ); ?>-css" href="<?php echo esc_url( $post->get_url() ); ?>" type="text/css" media="all">
			<?php
		} else {
			if ( ! $content ) {
				$content = $post->get_content();
			}

			echo '<style>' . $content . '</style>';
			Plugin::$instance->frontend->print_fonts_links();
		}

		return ob_get_clean();
	}
}
