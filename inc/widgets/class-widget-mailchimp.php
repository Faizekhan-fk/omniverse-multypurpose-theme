<?php
/**
 * This file has a class that creates a mailchimp widget.
 *
 * @package Omniverse
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! class_exists( 'OMNIVERSE_Widget_Mailchimp' ) ) {
	/**
	 * This class create mailchimp widget.
	 */
	class OMNIVERSE_Widget_Mailchimp extends WPH_Widget {
		/**
		 * Widget construct method.
		 */
		public function __construct() {
			$this->create_widget(
				array(
					'label'       => esc_html__( 'OMNIVERSE Mailchimp ', 'omniverse' ),
					'description' => esc_html__( 'Newsletter subscription form', 'omniverse' ),
					'slug'        => 'wd-mailchimp-widget',
					'fields'      => array(
						array(
							'id'              => 'form_id',
							'type'            => 'dropdown',
							'callback_global' => 'omniverse_get_mailchimp_forms',
							'name'            => esc_html__( 'Select form', 'omniverse' ),
						),
					),
				)
			);
		}

		/**
		 * This is method rendering widget.
		 *
		 * @param array $args arguments for create widget.
		 * @param array $instance data for create widget preview.
		 */
		public function widget( $args, $instance ) {
			if ( ! $instance['form_id'] || ! defined( 'MC4WP_VERSION' ) || $this->is_widget_preview() ) {
				return;
			}

			echo wp_kses_post( $args['before_widget'] );

			omniverse_enqueue_inline_style( 'mc4wp', true );
			?>
			<div class="wd-mc4wp-wrapper">
				<?php echo do_shortcode( '[mc4wp_form id="' . esc_attr( $instance['form_id'] ) . '"]' ); ?>
			</div>
			<?php
			echo wp_kses_post( $args['after_widget'] );
		}
	}
}
