<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_maintenance_mode' ) ) {
	function omniverse_maintenance_mode() {
		if ( ! omniverse_is_maintenance_active() ) {
			return;
		}

        $page_id = omniverse_pages_ids_from_template( 'maintenance' );

        $page_id = current( $page_id );

        if ( ! $page_id ) {
			return;
		}

        if ( ! is_page( $page_id ) && ! is_user_logged_in() ) {
            wp_redirect( get_permalink( $page_id ) );
            exit();
        }
	}

	add_action( 'template_redirect', 'omniverse_maintenance_mode', 10 );
}