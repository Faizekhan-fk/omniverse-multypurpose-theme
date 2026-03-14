<?php

if ( ! function_exists( 'omniverse_white_label' ) ) {
	function omniverse_white_label() {
		if ( ! omniverse_get_opt( 'white_label' ) ) {
			return;
		}

		$screenshot_data = omniverse_get_opt( 'white_label_appearance_screenshot' );
		?>

		<style>
			<?php if ( $screenshot_data['id'] ) : ?>
            .theme[aria-describedby="omniverse-action omniverse-name"] img, .theme[aria-describedby="omniverse-child-action omniverse-child-name"] img, .wd-omniverse-theme img, .wd-omniverse-theme .theme-info, .theme[data-slug="omniverse"] img, .theme[data-slug="omniverse-child"] img, .wd-omniverse-theme img{
				display: none;
			}

            .theme-browser .theme[aria-describedby="omniverse-action omniverse-name"]:focus .theme-screenshot, .theme-browser .theme[aria-describedby="omniverse-action omniverse-name"]:hover .theme-screenshot, .theme-browser .theme[aria-describedby="omniverse-child-action omniverse-child-name"]:focus .theme-screenshot, .theme-browser .theme[aria-describedby="omniverse-child-action omniverse-child-name"]:hover .theme-screenshot, .theme-browser .theme[data-slug="omniverse"]:focus .theme-screenshot, .theme-browser .theme[data-slug="omniverse"]:hover .theme-screenshot, .theme-browser .theme[data-slug="omniverse-child"]:focus .theme-screenshot, .theme-browser .theme[data-slug="omniverse-child"]:hover .theme-screenshot {
				opacity: 0.4;
			}

            .theme[aria-describedby="omniverse-action omniverse-name"] .theme-screenshot, .theme[aria-describedby="omniverse-child-action omniverse-child-name"] .theme-screenshot, .wd-omniverse-theme .screenshot, .theme[data-slug="omniverse"] .theme-screenshot, .theme[data-slug="omniverse-child"] .theme-screenshot {
				background-image: url(<?php echo esc_url( wp_get_attachment_image_url( $screenshot_data['id'], 'full' ) ); ?>) !important;
				background-repeat: no-repeat !important;
				background-position: center center !important;
				background-size: contain !important;
				background-color: transparent !important;
			}

			.theme-name#omniverse-name span , .theme-name#omniverse-child-name span{
				font-size: 15px;
			}
			<?php endif; ?>

			<?php if ( omniverse_get_opt( 'white_label_theme_name' ) ) : ?>
			.theme-name#omniverse-name:after {
				content: "<?php echo esc_html( omniverse_get_opt( 'white_label_theme_name' ) ); ?>";
				font-size: 15px;
				margin-left: 5px;
			}

			.theme-name#omniverse-name, .theme-name#omniverse-child-name {
				font-size:0
			}

			.theme-name#omniverse-child-name:after {
				content: "<?php echo esc_html( omniverse_get_opt( 'white_label_theme_name' ) ); ?>-child";
				font-size: 15px;
				margin-left: 5px;
			}
			<?php endif; ?>
		</style>
		<?php
	}

	add_filter( 'admin_print_styles', 'omniverse_white_label', -100 );
}

if ( ! function_exists( 'omniverse_white_label_add_body_class' ) ) {
	/**
	 * Add body classes.
	 *
	 * @param array $classes Body classes.
	 * @return array
	 */
	function omniverse_white_label_add_body_class( $classes ) {
		if ( ! omniverse_get_opt( 'white_label' ) || ! is_user_logged_in() ) {
			return $classes;
		}

		$white_label_logo = omniverse_get_opt( 'white_label_sidebar_icon_logo', array( 'url' => '' ) );

		if ( ! empty( $white_label_logo['url'] ) ) {
			$classes[] = 'wd-white-label-img';
		}

		return $classes;
	}

	add_filter( 'body_class', 'omniverse_white_label_add_body_class' );
}
