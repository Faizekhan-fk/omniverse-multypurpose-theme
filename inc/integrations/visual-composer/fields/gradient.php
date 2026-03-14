<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );

/**
* Add gradient to VC 
*/
if( ! function_exists( 'omniverse_add_gradient_type' ) && apply_filters( 'omniverse_gradients_enabled', true ) ) {
	function omniverse_add_gradient_type( $settings, $value ) {
		return omniverse_get_gradient_field( $settings['param_name'], $value, true );
	}
}

if( ! function_exists( 'omniverse_get_gradient_field' ) ) {
	function omniverse_get_gradient_field( $param_name, $value, $is_VC = false ) {
		$classes = $param_name;
		$classes .= ( $is_VC ) ? ' wpb_vc_param_value' : '';
		$uniqid = uniqid();
		$output = '<div class="omniverse-grad-wrap">';
			$output .= '<div class="omniverse-grad-line" id="omniverse-grad-line' . $uniqid . '"></div>';
			$output .= '<div class="omniverse-grad-preview" id="omniverse-grad-preview' . $uniqid . '"></div>';
			$output .= '<input id="omniverse-grad-val' . $uniqid . '" class="' . $classes . '" name="' . $param_name . '"  style="display:none"  value="'.$value.'"/>';
		$output .= '</div>';

		return $output;
	}
}
