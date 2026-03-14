<?php if ( ! defined('OMNIVERSE_THEME_DIR')) exit('No direct script access allowed');

/**
 * Register widget based on VC_MAP parameters that display isntagram widget
 *
 */

if ( ! class_exists( 'OMNIVERSE_Instagram_Widget' ) ) {
	class OMNIVERSE_Instagram_Widget extends WPH_Widget {
	
		function __construct() {
			if( ! function_exists( 'omniverse_get_instagram_params' ) ) return;
		
			// Configure widget array
			$args = array( 
				// Widget Backend label
				'label' => esc_html__( 'OMNIVERSE Instagram', 'omniverse' ), 
				// Widget Backend Description								
				'description' => esc_html__( 'Instagram photos', 'omniverse' ), 		
				'slug' => 'omniverse-instagram',
			 );
		
			// Configure the widget fields
		
			// fields array
			$args['fields'] = omniverse_get_instagram_params();

			// create widget
			$this->create_widget( $args );
		}
		
		// Output function

		function widget( $args, $instance )	{
			if ( $this->is_widget_preview() ) {
				return;
			}

			extract($args);

			echo wp_kses_post( $before_widget );

			if(!empty($instance['title'])) { echo wp_kses_post( $before_title ). $instance['title'] . wp_kses_post( $after_title ); };

			do_action( 'wpiw_before_widget', $instance );

			$instance['title']          = '';
			$instance['spacing']        = 1;
			$instance['spacing_custom'] = 6;
			$instance['per_row']        = 3;
			$instance['per_row_tablet'] = 3;
			$instance['per_row_mobile'] = 3;
			$instance['username']       = $instance['username'] ? $instance['username'] : 'flickr';

			echo omniverse_shortcode_instagram( $instance );

			do_action( 'wpiw_after_widget', $instance );

			echo wp_kses_post( $after_widget );
		}
	
	} // class
}
