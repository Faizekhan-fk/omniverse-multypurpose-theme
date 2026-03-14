<?php
/**
 * Countdown timer map.
 */

namespace DN\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Countdown extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_countdown_timer';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Countdown timer', 'omniverse' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'wd-icon-countdown';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'wd-elements' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		/**
		 * Content tab.
		 */

		/**
		 * General settings.
		 */
		$this->start_controls_section(
			'general_content_section',
			[
				'label' => esc_html__( 'General', 'omniverse' ),
			]
		);

		$this->add_control(
			'date',
			[
				'label'   => esc_html__( 'Date', 'omniverse' ),
				'type'    => Controls_Manager::DATE_TIME,
				'default' => date( 'Y-m-d', strtotime( ' +2 months' ) ),
			]
		);

		$this->add_control(
			'hide_on_finish',
			array(
				'label'        => esc_html__( 'Hide countdown on finish', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		/**
		 * Style tab.
		 */

		/**
		 * General settings.
		 */
		$this->start_controls_section(
			'general_style_section',
			[
				'label' => esc_html__( 'General', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Style', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'standard'    => esc_html__( 'Standard', 'omniverse' ),
					'transparent' => esc_html__( 'Transparent', 'omniverse' ),
					'active'      => esc_html__( 'Primary color', 'omniverse' ),
					'simple'      => esc_html__( 'Simple', 'omniverse' ),
				],
				'default' => 'standard',
			]
		);

		$this->add_control(
			'omniverse_color_scheme',
			[
				'label'   => esc_html__( 'Color Scheme', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''      => esc_html__( 'Inherit', 'omniverse' ),
					'light' => esc_html__( 'Light', 'omniverse' ),
					'dark'  => esc_html__( 'Dark', 'omniverse' ),
				],
				'default' => '',
			]
		);

		$this->add_control(
			'align',
			[
				'label'   => esc_html__( 'Align', 'omniverse' ),
				'type'    => 'wd_buttons',
				'options' => [
					'left'   => [
						'title' => esc_html__( 'Left', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					],
				],
				'default' => 'center',
			]
		);

		$this->add_control(
			'size',
			[
				'label'   => esc_html__( 'Predefined size', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'small'  => esc_html__( 'Small (20px)', 'omniverse' ),
					'medium' => esc_html__( 'Medium (24px)', 'omniverse' ),
					'large'  => esc_html__( 'Large (28px)', 'omniverse' ),
					'xlarge' => esc_html__( 'Extra Large (42px)', 'omniverse' ),
				],
				'default' => 'medium',
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$default_settings = [
			'date'                  => '2020-12-12',
			'omniverse_color_scheme' => 'dark',
			'size'                  => 'medium',
			'align'                 => 'center',
			'style'                 => 'standard',
			'hide_on_finish'        => 'no',
		];

		$settings = wp_parse_args( $this->get_settings_for_display(), $default_settings );

		$timezone = apply_filters( 'omniverse_wp_timezone_element', false ) ? get_option( 'timezone_string' ) : 'GMT';

		$this->add_render_attribute(
			[
				'wrapper' => [
					'class' => [
						'wd-countdown-timer',
						'color-scheme-' . $settings['omniverse_color_scheme'],
						'text-' . $settings['align'],
					],
				],
				'timer'   => [
					'class'         => [
						'wd-timer',
						'timer-size-' . $settings['size'],
						'timer-style-' . $settings['style'],
						omniverse_get_old_classes( ' omniverse-timer' ),
					],
					'data-end-date' => [
						apply_filters( 'wd_countdown_timer_end_date', $settings['date'] ),
					],
					'data-timezone' => [
						$timezone,
					],
					'data-hide-on-finish' => [
						$settings['hide_on_finish'],
					],
				],
			]
		);

		omniverse_enqueue_js_library( 'countdown-bundle' );
		omniverse_enqueue_js_script( 'countdown-element' );
		omniverse_enqueue_inline_style( 'countdown' );

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'timer' ); ?>>
				<span class="countdown-days">
					<span class="wd-timer-value">
						0
					</span>
					<span class="wd-timer-text">
						<?php esc_html_e( 'days', 'omniverse' ); ?>
					</span>
				</span>
				<span class="countdown-hours">
					<span class="wd-timer-value">
						00
					</span>
					<span class="wd-timer-text">
						<?php esc_html_e( 'hr', 'omniverse' ); ?>
					</span>
				</span>
				<span class="countdown-min">
					<span class="wd-timer-value">
						00
					</span>
					<span class="wd-timer-text">
						<?php esc_html_e( 'min', 'omniverse' ); ?>
					</span>
				</span>
				<span class="countdown-sec">
					<span class="wd-timer-value">
						00
					</span>
					<span class="wd-timer-text">
						<?php esc_html_e( 'sc', 'omniverse' ); ?>
					</span>
				</span>
			</div>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Countdown() );
