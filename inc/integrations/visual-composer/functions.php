<?php
/**
 * This file adds some custom properties to the WPB editor.
 *
 * @package Omniverse.
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

// **********************************************************************//
// Features that add GLOBAL maps to WPB Composer
// **********************************************************************//
if ( ! function_exists( 'omniverse_vc_map' ) ) {
	/**
	 * Register element map.
	 *
	 * @param string          $tag Element tag.
	 * @param callable-string $callback Map callback.
	 *
	 * @return void
	 */
	function omniverse_vc_map( $tag, $callback ) {
		vc_lean_map( $tag, $callback );
	}
}

if ( ! function_exists( 'omniverse_vc_column_text_custom_options' ) ) {
	/**
	 * Update custom params map to Default Column Text element in WPBakery.
	 *
	 * @throws Exception .
	 */
	function omniverse_vc_column_text_custom_options() {
		$design_options = array(
			omniverse_get_vc_display_inline_map(),

			array(
				'type'             => 'omniverse_switch',
				'heading'          => esc_html__( 'Text larger', 'omniverse' ),
				'param_name'       => 'text_larger',
				'true_state'       => 'yes',
				'false_state'      => 'no',
				'default'          => 'no',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),

			omniverse_get_vc_animation_map( 'wd_animation' ),
			omniverse_get_vc_animation_map( 'wd_animation_delay' ),
			omniverse_get_vc_animation_map( 'wd_animation_duration' ),

			array(
				'type'       => 'omniverse_button_set',
				'heading'    => esc_html__( 'Color Scheme', 'omniverse' ),
				'param_name' => 'omniverse_color_scheme',
				'value'      => array(
					esc_html__( 'Inherit', 'omniverse' ) => '',
					esc_html__( 'Light', 'omniverse' )   => 'light',
					esc_html__( 'Dark', 'omniverse' )    => 'dark',
				),
			),
		);

		vc_add_params( 'vc_column_text', $design_options );
	}

	add_action( 'vc_before_init', 'omniverse_vc_column_text_custom_options' );
}

if ( ! function_exists( 'omniverse_vc_single_image_custom_options' ) ) {
	/**
	 * Update custom params map to Default Single Image element in WPBakery.
	 *
	 * @throws Exception .
	 */
	function omniverse_vc_single_image_custom_options() {
		$general_options = array(
			/**
			 * Omniverse Animation Option.
			 */
			omniverse_get_vc_animation_map( 'wd_animation' ),
			omniverse_get_vc_animation_map( 'wd_animation_delay' ),
			omniverse_get_vc_animation_map( 'wd_animation_duration' ),
			/**
			 * Parallax On Scroll Option.
			 */
			omniverse_parallax_scroll_map( 'parallax_scroll' ),
			omniverse_parallax_scroll_map( 'scroll_x' ),
			omniverse_parallax_scroll_map( 'scroll_y' ),
			omniverse_parallax_scroll_map( 'scroll_z' ),
			omniverse_parallax_scroll_map( 'scroll_smooth' ),
		);

		$advance_options = array(
			array(
				'type'        => 'omniverse_switch',
				'heading'     => esc_html__( 'Display inline', 'omniverse' ),
				'group'       => esc_html__( 'Advanced', 'omniverse' ),
				'param_name'  => 'omniverse_inline',
				'true_state'  => 'yes',
				'false_state' => 'no',
				'default'     => 'no',
			),
		);

		vc_add_params( 'vc_single_image', $general_options );
		vc_add_params( 'vc_single_image', $advance_options );
	}

	add_action( 'vc_before_init', 'omniverse_vc_single_image_custom_options' );
}

if ( ! function_exists( 'omniverse_vc_separator_custom_options' ) ) {
	/**
	 * Update custom params map to Default Separator element in WPBakery.
	 *
	 * @throws Exception .
	 */
	function omniverse_vc_separator_custom_options() {
		$advanced_options = array(
			omniverse_get_vc_responsive_visible_map( 'responsive_tabs_hide' ),
			omniverse_get_vc_responsive_visible_map( 'wd_hide_on_desktop' ),
			omniverse_get_vc_responsive_visible_map( 'wd_hide_on_tablet' ),
			omniverse_get_vc_responsive_visible_map( 'wd_hide_on_mobile' ),
		);

		vc_add_params( 'vc_separator', $advanced_options );
	}

	add_action( 'vc_before_init', 'omniverse_vc_separator_custom_options' );
}

// **********************************************************************//
// Filters for WPB Composer
// **********************************************************************//

if ( ! function_exists( 'omniverse_vc_extra_classes' ) ) {
	if ( defined( 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' ) ) {
		add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'omniverse_vc_extra_classes', 30, 3 );
	}

	/**
	 * Adds classes depending on the passed settings.
	 *
	 * @param string $class list of classes.
	 * @param mixed  $base .
	 * @param array  $atts list of settings.
	 * @return string new classes.
	 */
	function omniverse_vc_extra_classes( $class, $base, $atts ) {
		if ( isset( $atts['wd_z_index'] ) && 'yes' === $atts['wd_z_index'] ) {
			$class .= ' wd-z-index';
		}

		if ( 'vc_column' === $base || 'vc_column_inner' === $base ) {
			if ( ! empty( $atts['vertical_alignment'] ) || ! empty( $atts['horizontal_alignment'] ) ) {
				$class .= ' wd-enabled-flex';
			}
		}

		if ( 'vc_column' === $base && ! empty( $atts['wd_column_role'] ) ) {
			omniverse_enqueue_inline_style( 'int-wpb-opt-off-canvas-column' );

			if ( isset( $atts['wd_column_role_offcanvas_desktop'] ) && 'yes' === $atts['wd_column_role_offcanvas_desktop'] ) {
				$class .= ' wd-col-offcanvas-lg';
			}

			if ( isset( $atts['wd_column_role_offcanvas_tablet'] ) && 'yes' === $atts['wd_column_role_offcanvas_tablet'] ) {
				$class .= ' wd-col-offcanvas-md-sm';
			}

			if ( isset( $atts['wd_column_role_offcanvas_mobile'] ) && 'yes' === $atts['wd_column_role_offcanvas_mobile'] ) {
				$class .= ' wd-col-offcanvas-sm';
			}

			if ( isset( $atts['wd_column_role_content_desktop'] ) && 'yes' === $atts['wd_column_role_content_desktop'] ) {
				$class .= ' wd-col-content-lg';
			}

			if ( isset( $atts['wd_column_role_content_tablet'] ) && 'yes' === $atts['wd_column_role_content_tablet'] ) {
				$class .= ' wd-col-content-md-sm';
			}

			if ( isset( $atts['wd_column_role_content_mobile'] ) && 'yes' === $atts['wd_column_role_content_mobile'] ) {
				$class .= ' wd-col-content-sm';
			}

			if ( isset( $atts['wd_off_canvas_alignment'] ) && ! empty( $atts['wd_off_canvas_alignment'] ) ) {
				$class .= ' wd-alignment-' . $atts['wd_off_canvas_alignment'];
			}
		}

		if ( ! empty( $atts['omniverse_inline'] ) && 'yes' === $atts['omniverse_inline'] ) {
			$class .= ' inline-element';
		}
		if ( ! empty( $atts['omniverse_color_scheme'] ) && ( 'vc_column' === $base ||
		'vc_column_inner' === $base || 'vc_empty_space' === $base || 'vc_column_text' === $base ) ) {
			$class .= ' color-scheme-' . $atts['omniverse_color_scheme'];
		}
		if ( isset( $atts['text_larger'] ) && 'yes' === $atts['text_larger'] ) {
			$class .= ' text-larger';
		}
		if ( isset( $atts['omniverse_sticky_column'] ) && 'true' === $atts['omniverse_sticky_column'] ) {
			$class .= ' omniverse-sticky-column';

			if ( isset( $atts['omniverse_sticky_column_offset'] ) && $atts['omniverse_sticky_column_offset'] ) {
				$class .= ' wd_sticky_offset_' . $atts['omniverse_sticky_column_offset'];
			}
			omniverse_enqueue_js_library( 'sticky-kit' );
			omniverse_enqueue_js_script( 'sticky-column' );
		}
		if ( isset( $atts['omniverse_parallax'] ) && $atts['omniverse_parallax'] ) {
			$class .= ' wd-parallax';
			$class .= omniverse_get_old_classes( ' omniverse-parallax' );
			omniverse_enqueue_js_library( 'parallax' );
			omniverse_enqueue_js_script( 'parallax' );
		}
		if ( isset( $atts['omniverse_disable_overflow'] ) && $atts['omniverse_disable_overflow'] ) {
			$class .= ' wd-disable-overflow';
		}
		if ( isset( $atts['omniverse_gradient_switch'] ) && 'yes' === $atts['omniverse_gradient_switch'] && apply_filters( 'omniverse_gradients_enabled', true ) ) {
			$class .= ' wd-row-gradient-enable';
		}
		// Bg option.
		if ( ! empty( $atts['omniverse_bg_position'] ) ) {
			$class .= ' wd-bg-' . $atts['omniverse_bg_position'];
		}
		// Text align option.
		if ( ! empty( $atts['omniverse_text_align'] ) ) {
			$class .= ' text-' . $atts['omniverse_text_align'];
		}
		// Responsive opt.
		if ( isset( $atts['omniverse_hide_large'] ) && $atts['omniverse_hide_large'] ) {
			$class .= ' hidden-lg';
		}
		if ( isset( $atts['omniverse_hide_medium'] ) && $atts['omniverse_hide_medium'] ) {
			$class .= ' hidden-md hidden-sm';
		}
		if ( isset( $atts['omniverse_hide_small'] ) && $atts['omniverse_hide_small'] ) {
			$class .= ' hidden-xs';
		}
		// Row reverse opt.
		if ( isset( $atts['row_reverse_mobile'] ) && $atts['row_reverse_mobile'] ) {
			$class .= ' row-reverse-mobile';
		}
		if ( isset( $atts['row_reverse_tablet'] ) && $atts['row_reverse_tablet'] ) {
			$class .= ' row-reverse-tablet';
		}

		// Hide bg img on mobile.
		if ( isset( $atts['mobile_bg_img_hidden'] ) && 'yes' === $atts['mobile_bg_img_hidden'] ) {
			$class .= ' mobile-bg-img-hidden';
		}

		// Hide bg img on tablet.
		if ( isset( $atts['tablet_bg_img_hidden'] ) && 'yes' === $atts['tablet_bg_img_hidden'] ) {
			$class .= ' tablet-bg-img-hidden';
		}

		// Reset margin (deprecated).
		if ( isset( $atts['mobile_reset_margin'] ) && 'yes' === $atts['mobile_reset_margin'] ) {
			$class .= ' reset-margin-mobile';
		}

		if ( isset( $atts['tablet_reset_margin'] ) && 'yes' === $atts['tablet_reset_margin'] ) {
			$class .= ' reset-margin-tablet';
		}

		if ( ! empty( $atts['css_animation'] ) && 'none' !== $atts['css_animation'] ) {
			omniverse_enqueue_inline_style( 'mod-animations-keyframes' );
		}

		if ( ! empty( $atts['wd_animation'] ) && 'none' !== $atts['wd_animation'] ) {
			$class .= ' wd-animation-' . $atts['wd_animation'];

			$duration = ! empty( $atts['wd_animation_duration'] ) ? $atts['wd_animation_duration'] : 'normal';
			$class   .= ' wd-animation-' . $duration;

			if ( ! empty( $atts['wd_animation_delay'] ) ) {
				$class .= ' wd_delay_' . $atts['wd_animation_delay'];
			}

			omniverse_enqueue_js_library( 'waypoints' );
			omniverse_enqueue_js_script( 'animations' );
			omniverse_enqueue_inline_style( 'animations' );
		}

		if ( ! empty( $atts['omniverse_css_id'] ) ) {
			$class .= ' wd-rs-' . $atts['omniverse_css_id'];
		}

		if ( ! empty( $atts['omniverse_stretch_content'] ) ) {
			$class .= ' wd-' . $atts['omniverse_stretch_content'];
		}

		if ( isset( $atts['wd_hide_on_desktop'] ) && 'yes' === $atts['wd_hide_on_desktop'] ) {
			$class .= ' hidden-lg';
		}

		if ( isset( $atts['wd_hide_on_tablet'] ) && 'yes' === $atts['wd_hide_on_tablet'] ) {
			$class .= ' hidden-md hidden-sm';
		}

		if ( isset( $atts['wd_hide_on_mobile'] ) && 'yes' === $atts['wd_hide_on_mobile'] ) {
			$class .= ' hidden-xs';
		}

		if ( isset( $atts['wd_collapsible_content_switcher'] ) && 'yes' === $atts['wd_collapsible_content_switcher'] ) {
			omniverse_enqueue_inline_style( 'collapsible-content' );

			$class .= ' wd-collapsible-content';
		}

		/**
		 * Single Product Layout.
		 */
		if ( ( isset( $atts['width_desktop'] ) && ! empty( $atts['width_desktop'] ) ) || ( isset( $atts['width_tablet'] ) && ! empty( $atts['width_tablet'] ) || ( isset( $atts['width_mobile'] ) && ! empty( $atts['width_mobile'] ) ) ) ) {
			$class .= ' wd-enabled-width';
		}

		return $class;
	}
}

// **********************************************************************//
// Add custom animations to WPB Composer
// **********************************************************************//

if ( ! function_exists( 'omniverse_add_css_animation' ) ) {
	/**
	 * Add animation map settings for VC.
	 *
	 * @param array $animations list of animations.
	 * @return array
	 */
	function omniverse_add_css_animation( $animations ) {
		$animations[] = array(
			'label'  => esc_html__( 'Theme Animations', 'omniverse' ),
			'values' => array(
				esc_html__( 'Slide from top', 'omniverse' ) => array(
					'value' => 'wd-slide-from-top',
					'type'  => 'in',
				),
				esc_html__( 'Slide from bottom', 'omniverse' ) => array(
					'value' => 'wd-slide-from-bottom',
					'type'  => 'in',
				),
				esc_html__( 'Slide from left', 'omniverse' ) => array(
					'value' => 'wd-slide-from-left',
					'type'  => 'in',
				),
				esc_html__( 'Slide from right', 'omniverse' ) => array(
					'value' => 'wd-slide-from-right',
					'type'  => 'in',
				),
				esc_html__( 'Right flip Y', 'omniverse' )   => array(
					'value' => 'wd-right-flip-y',
					'type'  => 'in',
				),
				esc_html__( 'Left flip Y', 'omniverse' )    => array(
					'value' => 'wd-left-flip-y',
					'type'  => 'in',
				),
				esc_html__( 'Top flip X', 'omniverse' )     => array(
					'value' => 'wd-top-flip-x',
					'type'  => 'in',
				),
				esc_html__( 'Bottom flip X', 'omniverse' )  => array(
					'value' => 'wd-bottom-flip-x',
					'type'  => 'in',
				),
				esc_html__( 'Zoom in', 'omniverse' )        => array(
					'value' => 'wd-zoom-in',
					'type'  => 'in',
				),
				esc_html__( 'Rotate Z', 'omniverse' )       => array(
					'value' => 'wd-rotate-z',
					'type'  => 'in',
				),
			),
		);

		return $animations;
	}

	add_action( 'vc_param_animation_style_list', 'omniverse_add_css_animation', 1000 );
}

if ( ! function_exists( 'omniverse_get_tab_title_category_for_wpb' ) ) {
	/**
	 * Get tab title category for WPB builder.
	 *
	 * @param string $title Title category.
	 * @param string $layout Layout type.
	 * @return string
	 */
	function omniverse_get_tab_title_category_for_wpb( $title, $layout = '' ) {
		if ( $layout ) {
			$layout = ' dn-layout-' . $layout;
		}

		return '<span class="dn-wpb-tab-title' . $layout . '">' . $title . '</span>';
	}
}

if ( ! function_exists( 'omniverse_wpml_pb_shortcode_encode_urlencoded_json' ) ) {
	/**
	 * Encode urlencoded json.
	 *
	 * @param string $string String.
	 * @param string $encoding Format.
	 * @param array  $original_string Original string.
	 * @return string
	 */
	function omniverse_wpml_pb_shortcode_encode_urlencoded_json( $string, $encoding, $original_string ) {
		if ( 'urlencoded_json' === $encoding ) {
			$output = array();

			foreach ( $original_string as $combined_key => $value ) {
				$parts                = explode( '_', $combined_key );
				$i                    = array_pop( $parts );
				$key                  = implode( '_', $parts );
				$output[ $i ][ $key ] = $value;
			}

			$string = urlencode( wp_json_encode( $output ) ); // phpcs:ignore;
		}
		return $string;
	}

	add_filter( 'wpml_pb_shortcode_encode', 'omniverse_wpml_pb_shortcode_encode_urlencoded_json', 10, 3 );
}

if ( ! function_exists( 'omniverse_wpml_pb_shortcode_decode_urlencoded_json' ) ) {
	/**
	 * Decode urlencoded json.
	 *
	 * @param string $string String.
	 * @param string $encoding Format.
	 * @param string $original_string Original string.
	 * @return string
	 */
	function omniverse_wpml_pb_shortcode_decode_urlencoded_json( $string, $encoding, $original_string ) {
		if ( 'urlencoded_json' === $encoding ) {
			$rows = json_decode( urldecode( $original_string ), true );

			$string = array();

			foreach ( $rows as $i => $row ) {
				foreach ( $row as $key => $value ) {
					if ( in_array( $key, array( 'list', 'list-content' ), true ) ) {
						$string[ $key . '_' . $i ] = array(
							'value'     => $value,
							'translate' => true,
						);
					} else {
						$string[ $key . '_' . $i ] = array(
							'value'     => $value,
							'translate' => false,
						);
					}
				}
			}
		}

		return $string;
	}

	add_filter( 'wpml_pb_shortcode_decode', 'omniverse_wpml_pb_shortcode_decode_urlencoded_json', 10, 3 );
}
