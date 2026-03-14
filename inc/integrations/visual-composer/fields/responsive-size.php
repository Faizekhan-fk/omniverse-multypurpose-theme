<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );

/**
* Omniverse responsive size param
*/
if ( ! function_exists( 'omniverse_get_responsive_size_param' ) ) {
	function omniverse_get_responsive_size_param( $settings, $value ) {
        $output = '<div class="omniverse-rs-wrapper ' . esc_attr( $settings['param_name'] ) . '">';
            $output .= '<div class="omniverse-rs-item dn-input-append-wrap desktop">';
                $output .= '<label class="dn-i-desktop">Desktop</label>';
                $output .= '<div class="dn-input-append">';
                    $output .= '<input type="number" min="1" class="omniverse-rs-input" data-id="desktop">';
                    $output .= '<span class="add-on">px</span>';
                $output .= '</div>';
            $output .= '</div>';

            $output .= '<div class="omniverse-rs-trigger dn-i-button-right" title="Responsive controls"></div>';

            $output .= '<div class="omniverse-rs-item dn-input-append-wrap tablet hide">';
                $output .= '<label class="dn-i-tablet">Tablet</label>';
                $output .= '<div class="dn-input-append">';
                    $output .= '<input type="number" min="1" class="omniverse-rs-input" data-id="tablet">';
                    $output .= '<span class="add-on">px</span>';
                $output .= '</div>';
            $output .= '</div>';

            $output .= '<div class="omniverse-rs-item dn-input-append-wrap mobile hide">';
                $output .= '<label class="dn-i-phone">Mobile</label>';
                $output .= '<div class="dn-input-append">';
                    $output .= '<input type="number" min="1" class="omniverse-rs-input" data-id="mobile">';
                    $output .= '<span class="add-on">px</span>';
                $output .= '</div>';
            $output .= '</div>';

            $output .= '<input type="hidden" data-css_args="' . esc_attr( json_encode( $settings['css_args'] ) ) . '" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value omniverse-rs-value" value="' . esc_attr( $value ) . '">';
        $output .= '</div>';

	    return $output;
    }
    
}
