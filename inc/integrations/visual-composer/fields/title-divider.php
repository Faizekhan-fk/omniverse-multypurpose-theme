<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );

/**
* Omniverse title divider
*/
if ( ! function_exists( 'omniverse_get_title_divider_param' ) ) {
	function omniverse_get_title_divider_param( $settings, $value ) {
        $input = '<input id="' . esc_attr( $settings[ 'param_name' ] ) . '" class="wpb_vc_param_value" name="' . esc_attr( $settings[ 'param_name' ] ) . '" value="" type="hidden">';
        $title = isset( $settings[ 'title' ] ) ? '<div class="omniverse-td-title">' . $settings[ 'title' ] . '</div>' : '';
        $subtitle = isset( $settings[ 'subtitle' ] ) ? '<span class="omniverse-td-subtitle">' . $settings[ 'subtitle' ] . '</span>' : '';

        return $input . $title . $subtitle;
    }
    
}
