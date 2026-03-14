<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );

/**
* Image hotspot field
*/
if ( ! function_exists( 'omniverse_image_hotspot' ) ) {
	function omniverse_image_hotspot( $settings, $value ) {
		$position = explode( '||', $value );
		$left = ( isset( $position[0] ) && $position[0] ) ? $position[0] : '50';
		$top = ( isset( $position[1] ) && $position[1] ) ? $position[1] : '50';

		$output = '<input type="hidden" class="dn-image-hotspot-position wpb_vc_param_value" name="' . esc_attr( $settings['param_name'] ) . '" value="' . esc_attr( $value ) . '">';
		$output .= '<div class="dn-image-hotspot-preview">';
			$output .= '<div class="dn-image-hotspot" style="left: ' . $left . '%; top: ' . $top . '%;"></div>';
			$output .= '<div class="dn-image-hotspot-image"></div>';
			$output .= '<div class="dn-image-hotspot-overlay"></div>';
		$output .= '</div>';
		 
		return $output;
	}

}
