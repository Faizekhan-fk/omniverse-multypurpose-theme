<?php if ( ! defined('OMNIVERSE_THEME_DIR')) exit('No direct script access allowed');

/**
 * Register widget based on VC_MAP parameters that display author area shortcode
 *
 */

if ( ! class_exists( 'OMNIVERSE_Author_Area_Widget' ) ) {
	class OMNIVERSE_Author_Area_Widget extends WPH_Widget {
	
		function __construct() {
			if( ! function_exists( 'omniverse_get_author_area_params' ) ) return;
		
			// Configure widget array
			$args = array( 
				// Widget Backend label
				'label' => esc_html__( 'OMNIVERSE Author Information', 'omniverse' ), 
				// Widget Backend Description								
				'description' => esc_html__( 'Small information block about blog author', 'omniverse' ), 	
				'slug' => 'omniverse-author-information',
			 );
		
			// Configure the widget fields
		
			// fields array
			$args['fields'] = omniverse_get_author_area_params();

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

			if(!empty($instance['title'])) { echo wp_kses_post( $before_title ) . $instance['title'] . wp_kses_post( $after_title ); };

			do_action( 'wpiw_before_widget', $instance );

			$instance['title'] = '';

			echo omniverse_shortcode_author_area( $instance, $instance['content'] );

			do_action( 'wpiw_after_widget', $instance );

			echo wp_kses_post( $after_widget );
		}
	} // class
}
