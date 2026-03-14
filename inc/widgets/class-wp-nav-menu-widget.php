<?php if ( ! defined('OMNIVERSE_THEME_DIR')) exit('No direct script access allowed');

use DN\Modules\Mega_Menu_Walker;
/**
 * Custom Navigation Menu widget class
 *
 */

if( ! class_exists( 'OMNIVERSE_WP_Nav_Menu_Widget' ) ) {
	class OMNIVERSE_WP_Nav_Menu_Widget extends WPH_Widget {

		public function __construct() {
			$widget_ops = array( 'description' => esc_html__('Add a custom mega menu to your sidebar.', 'omniverse') );
			parent::__construct( 'nav_mega_menu', esc_html__('OMNIVERSE Sidebar Mega Menu', 'omniverse'), $widget_ops );
		}

		public function widget($args, $instance) {
			// Get menu
			$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

			if ( !$nav_menu || $this->is_widget_preview() )
				return;

			$menu_class  = 'menu wd-nav wd-nav-vertical' . omniverse_get_old_classes( ' vertical-navigation' );

			omniverse_enqueue_inline_style( 'mod-nav-vertical' );

			if ( ! empty( $instance['dropdown_design'] ) ) {
				$menu_class .= ' wd-design-' . $instance['dropdown_design'];

				omniverse_enqueue_inline_style( 'mod-nav-vertical-design-' . $instance['dropdown_design'] );
			}

			/** This filter is documented in wp-includes/default-widgets.php */
			$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			echo wp_kses_post( $args['before_widget'] );

			if ( !empty($instance['title']) )
				echo wp_kses_post( $args['before_title'] ) . $instance['title'] . wp_kses_post( $args['after_title'] );

			wp_nav_menu( array(
				'fallback_cb' => '',
				'container'  => '',
				'menu' => $nav_menu,
				'menu_class' => $menu_class,
				'walker' => new Mega_Menu_Walker()
			) );

			echo wp_kses_post( $args['after_widget'] );
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			if ( ! empty( $new_instance['title'] ) ) {
				$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
			}
			if ( ! empty( $new_instance['nav_menu'] ) ) {
				$instance['nav_menu'] = (int) $new_instance['nav_menu'];
			}
			if ( ! empty( $new_instance['dropdown_design'] ) ) {
				$instance['dropdown_design'] = $new_instance['dropdown_design'];
			}

			return $instance;
		}

		public function form( $instance ) {
			$title           = isset( $instance['title'] ) ? $instance['title'] : '';
			$nav_menu        = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
			$dropdown_design = isset( $instance['dropdown_design'] ) ? $instance['dropdown_design'] : '';

			// Get menus
			$menus = wp_get_nav_menus();

			// If no menus exist, direct the user to go and create some.
			if ( ! $menus ) {
				printf(
					'<p>%s</p>',
					sprintf(
						/* Translators: %s Link to the menu creation page. */
						esc_html__( 'No menus have been created yet. %s.', 'omniverse' ),
						sprintf(
							'<a href="%s">%s</a>',
							esc_url( admin_url( 'nav-menus.php' ) ),
							esc_html__( 'Create some', 'omniverse' )
						)
					)
				);
				return;
			}
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:', 'omniverse') ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo sanitize_text_field( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('nav_menu') ); ?>"><?php esc_html_e('Select Menu:', 'omniverse'); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id('nav_menu') ); ?>" name="<?php echo esc_attr( $this->get_field_name('nav_menu') ); ?>">
					<option value="0"><?php esc_html_e( '&mdash; Select &mdash;', 'omniverse' ) ?></option>
			<?php
				foreach ( $menus as $menu ) {
					echo '<option value="' . $menu->term_id . '"'
						. selected( $nav_menu, $menu->term_id, false )
						. '>'. esc_html( $menu->name ) . '</option>';
				}
			?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('dropdown_design') ); ?>">
					<?php esc_html_e('Design:', 'omniverse'); ?>
				</label>

				<select id="<?php echo esc_attr( $this->get_field_id('dropdown_design') ); ?>" name="<?php echo esc_attr( $this->get_field_name('dropdown_design') ); ?>">
					<option value="default" <?php selected( $dropdown_design , 'default' ); ?>>
						<?php esc_html_e( 'Default', 'omniverse' ); ?>
					</option>
					<option value="with-bg" <?php selected( $dropdown_design , 'with-bg' ); ?>>
						<?php esc_html_e( 'With background', 'omniverse' ); ?>
					</option>
					<option value="simple" <?php selected( $dropdown_design , 'with-bg' ); ?>>
						<?php esc_html_e( 'Simple', 'omniverse' ); ?>
					</option>
				</select>
			</p>
			<?php
		}
	}
}
