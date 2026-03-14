<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}

/**
* ------------------------------------------------------------------------------------------------
* Twitter element
* ------------------------------------------------------------------------------------------------
*/
if ( ! function_exists( 'omniverse_twitter' ) ) {
	function omniverse_twitter( $atts ) {
		extract(
			shortcode_atts(
				array(
					'name'               => 'Twitter',
					'num_tweets'         => 5,
					'cache_time'         => 5,
					'consumer_key'       => '',
					'consumer_secret'    => '',
					'access_token'       => '',
					'accesstoken_secret' => '',
					'show_avatar'        => 0,
					'avatar_size'        => '',
					'exclude_replies'    => false,
					'el_class'           => '',
					'omniverse_css_id'    => '',
					'css'                => '',
				),
				$atts
			)
		);

		$class = '';

		if ( ! empty( $omniverse_css_id ) ) {
			$class = ' wd-rs-' . $omniverse_css_id;
		}

		if ( function_exists( 'vc_shortcode_custom_css_class' ) ) {
			$class .= ' ' . vc_shortcode_custom_css_class( $css );
		}

		if ( $el_class ) {
			$class .= ' ' . $el_class;
		}

		ob_start();

		if ( empty( $name ) || empty( $consumer_key ) || empty( $consumer_secret ) || empty( $access_token ) || empty( $accesstoken_secret ) ) {
			echo '<div class="wd-notice wd-info">' . esc_html__( 'You need to enter your Consumer key and secret to display your recent X (Twitter) feed.', 'omniverse' ) . '</div>';
			return ob_get_clean();
		}

		omniverse_enqueue_inline_style( 'twitter' );
		?>
		<div class="wd-twitter-element wd-twitter-vc-element<?php echo esc_attr( $class ); ?>">
			<?php omniverse_get_twitts( $atts ); ?>
		</div>
		<?php

		return ob_get_clean();
	}
}
