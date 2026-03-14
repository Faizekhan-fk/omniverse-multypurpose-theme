<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}

/**
* ------------------------------------------------------------------------------------------------
* HTML block shortcode
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_html_block_shortcode' ) ) {
	function omniverse_html_block_shortcode( $atts ) {
		extract(
			shortcode_atts(
				array(
					'id' => 0,
				),
				$atts
			)
		);

		return omniverse_get_html_block( $id );
	}
}
