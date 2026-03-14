<?php if ( ! defined('OMNIVERSE_THEME_DIR')) exit('No direct script access allowed');

/**
 * Register widget that displays HTML static block
 *
 */

if ( ! class_exists( 'OMNIVERSE_Static_Block_Widget' ) ) {
	class OMNIVERSE_Static_Block_Widget extends WPH_Widget {
	
		function __construct() {
			
		
			// Configure widget array
			$args = array( 
				// Widget Backend label
				'label' => esc_html__( 'OMNIVERSE HTML Block', 'omniverse' ), 
				// Widget Backend Description								
				'description' => esc_html__( 'Display HTML block', 'omniverse' ), 	
				'slug' => 'omniverse-html-block',
			 );
		
		
			// fields array

			$args['fields'] = array(
				array(
					'id'              => 'id',
					'type'            => 'dropdown',
					'heading'         => esc_html__( 'Select block', 'omniverse' ),
					'callback_global' => 'omniverse_get_static_blocks_array',
					'description'     => function_exists( 'omniverse_get_html_block_links' ) ? omniverse_get_html_block_links() : '',
				),
			); // fields array

			// create widget
			$this->create_widget( $args );
		}
		
		// Output function

		function widget( $args, $instance )	{
			if ( $this->is_widget_preview() ) {
				return;
			}

			echo omniverse_get_html_block( $instance['id'] );
		}
	
	} // class
}
