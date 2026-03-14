<?php
/**
 * Count products visits.
 *
 * @package Omniverse
 */

namespace DN\Modules\Visitor_Counter;

use DN\Admin\Modules\Options;
use DN\Singleton;
use DN\Modules\Layouts\Main as Builder;

/**
 * Count products visits.
 */
class Main extends Singleton {
	/**
	 * Constructor.
	 */
	public function init() {
		$this->add_options();

		if ( ! omniverse_get_opt( 'counter_visitor_enabled' ) ) {
			return;
		}

		add_action( 'woocommerce_single_product_summary', array( $this, 'add_count_products_visits' ), 38 );

		add_action( 'wp_ajax_omniverse_update_count_product_visits', array( $this, 'update_count_product_visits' ) );
		add_action( 'wp_ajax_nopriv_omniverse_update_count_product_visits', array( $this, 'update_count_product_visits' ) );
		add_filter( 'omniverse_localized_string_array', array( $this, 'add_localized_settings' ) );
	}

	/**
	 * Add options in theme settings.
	 */
	public function add_options() {
		Options::add_section(
			array(
				'id'       => 'counter_visitor',
				'parent'   => 'general_single_product_section',
				'name'     => esc_html__( 'Visitor counter', 'omniverse' ),
				'priority' => 80,
				'icon'     => 'dn-i-bag',
			)
		);

		Options::add_field(
			array(
				'id'          => 'counter_visitor_enabled',
				'name'        => esc_html__( 'Visitor counter', 'omniverse' ),
				'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'visitor-counter.jpg" alt="">', 'omniverse' ), true ),
				'description' => wp_kses( __( 'Show the number of visitors that are currently viewing a product on the single product page. Read more information in our <a href="https://zynxsol.com/docs-topic/product-visitors-counter/">documentation</a>.', 'omniverse' ), 'default' ),
				'type'        => 'switcher',
				'section'     => 'counter_visitor',
				'default'     => '0',
				'priority'    => 10,
			)
		);

		Options::add_field(
			array(
				'id'          => 'counter_visitor_data_source',
				'name'        => esc_html__( 'Number of visitors', 'omniverse' ),
				'description' => esc_html__( 'You can show a real number of customers viewing the product or set a random fake number.', 'omniverse' ),
				'type'        => 'buttons',
				'section'     => 'counter_visitor',
				'options'     => array(
					'live_data' => array(
						'name'  => esc_html__( 'Real', 'omniverse' ),
						'value' => 'live_data',
					),
					'fake_data' => array(
						'name'  => esc_html__( 'Random', 'omniverse' ),
						'value' => 'fake_data',
					),
				),
				'default'     => 'live_data',
				'priority'    => 20,
			)
		);

		Options::add_field(
			array(
				'id'         => 'counter_visitor_data_source_min_number',
				'name'       => esc_html__( 'Minimum', 'omniverse' ),
				'type'       => 'text_input',
				'attributes' => array(
					'type' => 'number',
				),
				'section'    => 'counter_visitor',
				'requires'   => array(
					array(
						'key'     => 'counter_visitor_data_source',
						'compare' => 'equals',
						'value'   => 'fake_data',
					),
				),
				'priority'   => 30,
				'default'    => '10',
				'class'      => 'dn-col-6',
			)
		);

		Options::add_field(
			array(
				'id'         => 'counter_visitor_data_source_max_number',
				'name'       => esc_html__( 'Maximum', 'omniverse' ),
				'type'       => 'text_input',
				'attributes' => array(
					'type' => 'number',
				),
				'section'    => 'counter_visitor',
				'requires'   => array(
					array(
						'key'     => 'counter_visitor_data_source',
						'compare' => 'equals',
						'value'   => 'fake_data',
					),
				),
				'priority'   => 40,
				'default'    => '20',
				'class'      => 'dn-col-6',
			)
		);

		Options::add_field(
			array(
				'id'          => 'counter_visitor_live_mode',
				'name'        => esc_html__( 'Live mode', 'omniverse' ),
				'description' => esc_html__( 'Update the number of visitors in a specified interval of time.', 'omniverse' ),
				'type'        => 'switcher',
				'section'     => 'counter_visitor',
				'default'     => '0',
				'priority'    => 60,
			)
		);

		Options::add_field(
			array(
				'id'          => 'counter_visitor_ajax_update',
				'name'        => esc_html__( 'Update on page load', 'omniverse' ),
				'description' => esc_html__( 'Enable this option if you are using a full page cache like WP Rocket.', 'omniverse' ),
				'type'        => 'switcher',
				'section'     => 'counter_visitor',
				'default'     => '0',
				'requires'    => array(
					array(
						'key'     => 'counter_visitor_live_mode',
						'compare' => 'not_equals',
						'value'   => true,
					),
				),
				'on-text'     => esc_html__( 'Yes', 'omniverse' ),
				'off-text'    => esc_html__( 'No', 'omniverse' ),
				'priority'    => 70,
			)
		);

		Options::add_field(
			array(
				'id'       => 'counter_visitor_live_duration',
				'name'     => esc_html__( 'Update interval (seconds)', 'omniverse' ),
				'type'     => 'range',
				'section'  => 'counter_visitor',
				'default'  => 10,
				'min'      => 1,
				'step'     => 1,
				'max'      => 100,
				'requires' => array(
					array(
						'key'     => 'counter_visitor_live_mode',
						'compare' => 'equals',
						'value'   => true,
					),
				),
				'priority' => 80,
				'unit'     => 'sec',
			)
		);
	}

	/**
	 * Add before add to cart count product visits.
	 */
	public function add_count_products_visits() {
		if ( Builder::get_instance()->has_custom_layout( 'single_product' ) || ! is_singular( 'product' ) || omniverse_loop_prop( 'is_quick_view' ) ) {
			return;
		}

		$this->output_count_visitors( ' wd-style-with-bg' );
	}

	/**
	 * Output count product visits in builder and single product.
	 *
	 * @codeCoverageIgnore
	 * @param string $extra_classes Extra classes.
	 */
	public function output_count_visitors( $extra_classes = '', $icon_output = '' ) {
		if ( omniverse_get_opt( 'counter_visitor_enabled' ) && ( omniverse_get_opt( 'counter_visitor_ajax_update' ) || omniverse_get_opt( 'counter_visitor_live_mode' ) ) ) {
			omniverse_enqueue_js_script( 'counter-product-visits' );
		}

		$product_visitors = $this->get_count_visits_in_db( get_the_ID() );

		$this->get_count_content( $product_visitors, $extra_classes, $icon_output );
	}

	/**
	 * Get count visit in database.
	 *
	 * @param integer $product_id Product ID.
	 * @param integer $live_visits Current visit.
	 * @return int
	 */
	public function get_count_visits_in_db( $product_id, $live_visits = 0 ) {
		$product_visits = get_post_meta( $product_id, 'omniverse_history_of_visits', true );
		$time_limited   = apply_filters( 'omniverse_visit_time_limited', 120 );
		$current_time   = time();

		if ( ! $product_visits || ! is_array( $product_visits ) ) {
			$product_visits = array();
		}

		if ( 'fake_data' === omniverse_get_opt( 'counter_visitor_data_source' ) ) {
			$min = abs( intval( omniverse_get_opt( 'counter_visitor_data_source_min_number', 0 ) ) );
			$max = abs( intval( omniverse_get_opt( 'counter_visitor_data_source_max_number', 10 ) ) );

			if ( ! empty( $product_visits[ array_key_last( $product_visits ) ] ) && $product_visits[ array_key_last( $product_visits ) ] + $time_limited < $current_time ) {
				$product_visits = array();
			}

			$product_visit = count( $product_visits );

			if ( $live_visits || $product_visit ) {
				$range = apply_filters( 'omniverse_counter_visitor_life_range', 5 );

				if ( $live_visits !== $product_visit ) {
					if ( $min <= $product_visit - $range && $max >= $product_visit + $range ) {
						$min = $product_visit - $range;
						$max = $product_visit + $range;
					}
				} else {
					$min = max( $min, $live_visits - $range );
					$max = min( $max, $live_visits + $range );
				}
			}
			$min = $min < $max ? $min : 0;

			$random = wp_rand( $min, $max );

			update_post_meta( $product_id, 'omniverse_history_of_visits', array_fill( 0, $random, $current_time ) );

			return $random;
		}

		if ( $product_visits ) {
			foreach ( $product_visits as $user_ip => $visit ) {
				if ( $visit + $time_limited < $current_time ) {
					unset( $product_visits[ $user_ip ] );
				}
			}
		}

		$product_visits[ $this->get_user_ip() ] = $current_time;

		update_post_meta( $product_id, 'omniverse_history_of_visits', $product_visits );

		return count( $product_visits ) - 1;
	}

	/**
	 * Get current user IP
	 *
	 * @return string
	 */
	public function get_user_ip() {
		$keys = array(
			'HTTP_CLIENT_IP',
			'HTTP_X_REAL_IP',
			'REMOTE_ADDR',
			'HTTP_X_FORWARDED_FOR',
		);

		foreach ( $keys as $key ) {
			if ( ! empty( $_SERVER[ $key ] ) ) {
				$ips = explode( ',', sanitize_text_field( wp_unslash( $_SERVER[ $key ] ) ) );
				$ip  = trim( end( $ips ) );

				if ( filter_var( $ip, FILTER_VALIDATE_IP ) ) {
					return $ip;
				}
			}
		}

		return '0.0.0.0';
	}

	/**
	 * Ajax count update.
	 */
	public function update_count_product_visits() {
		if ( ! isset( $_POST['product_id'] ) || ! $_POST['product_id'] ) { //phpcs:ignore
			return;
		}

		$product_id = sanitize_text_field( $_POST['product_id'] ); //phpcs:ignore
		$count      = intval( sanitize_text_field( $_POST['count'] ) ); //phpcs:ignore

		wp_send_json(
			array(
				'count'     => $this->get_count_visits_in_db( $product_id, $count ),
				'live_mode' => omniverse_get_opt( 'counter_visitor_live_mode' ) ? 'yes' : 'no',
			)
		);
	}

	/**
	 * Add live duration in localized settings.
	 *
	 * @param array $localized Settings.
	 *
	 * @return array
	 */
	public function add_localized_settings( $localized ) {
		if ( omniverse_get_opt( 'counter_visitor_enabled' ) && ( omniverse_get_opt( 'counter_visitor_ajax_update' ) || omniverse_get_opt( 'counter_visitor_live_mode' ) ) ) {
			$localized['counter_visitor_live_duration'] = omniverse_get_opt( 'counter_visitor_live_duration', 10 ) * 1000;
			$localized['counter_visitor_ajax_update']   = omniverse_get_opt( 'counter_visitor_ajax_update' ) && ! omniverse_get_opt( 'counter_visitor_live_mode' ) ? 'yes' : 'no';
			$localized['counter_visitor_live_mode']     = omniverse_get_opt( 'counter_visitor_live_mode' ) ? 'yes' : 'no';
		}

		return $localized;
	}

	/**
	 * Count visits content.
	 *
	 * @codeCoverageIgnore
	 * @param integer $count Count visits.
	 * @param string  $extra_classes Extra classes.
	 *
	 * @return void
	 */
	public function get_count_content( $count, $extra_classes = '', $icon_output = '' ) {
		omniverse_enqueue_inline_style( 'woo-mod-product-count' );
		omniverse_enqueue_inline_style( 'woo-opt-visits-count' );

		$wrapper_classes = '';

		if ( $extra_classes ) {
			$wrapper_classes .= $extra_classes;
		}

		if ( ! $count ) {
			$wrapper_classes .= ' wd-hide';
		}

		if ( empty( $icon_output ) ) {
			$icon_output = '<span class="wd-count-icon"></span>';
		}

		?>
		<div class="wd-product-count wd-visits-count<?php echo esc_attr( $wrapper_classes ); ?>" data-product-id="<?php the_ID(); ?>">
			<?php echo $icon_output; // phpcs:ignore. ?><span class="wd-count-number"><?php echo esc_html( $count ); // Must be in one line. ?></span>
			<span class="wd-count-msg"><?php echo esc_html( _n( 'People watching this product now!', 'People watching this product now!', $count, 'omniverse' ) ); ?></span>
		</div>
		<?php
	}
}

Main::get_instance();
