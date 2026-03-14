<?php
/**
 * The main class for sold counter module.
 *
 * @package Omniverse
 */

namespace DN\Modules\Sold_Counter;

use DN\Admin\Modules\Options;
use DN\Singleton;
use DN\Modules\Layouts\Main as Builder;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * The main class for sales booster.
 */
class Main extends Singleton {
	/**
	 * Constructor.
	 */
	public function init() {
		add_action( 'init', array( $this, 'add_options' ), 10 );

		if ( ! omniverse_get_opt( 'sold_counter_enabled' ) ) {
			return;
		}

		add_action( 'woocommerce_single_product_summary', array( $this, 'render' ), 25 );
	}

	/**
	 * Add options in theme settings.
	 *
	 * @return void
	 */
	public function add_options() {
		Options::add_section(
			array(
				'id'       => 'sold_counter',
				'parent'   => 'general_single_product_section',
				'name'     => esc_html__( 'Sold counter', 'omniverse' ),
				'priority' => 90,
				'icon'     => 'dn-i-cart',
			)
		);

		Options::add_field(
			array(
				'id'          => 'sold_counter_enabled',
				'name'        => esc_html__( 'Sold counter', 'omniverse' ),
				'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'sold_counter_enabled.mp4" autoplay loop muted></video>',
				'description' => esc_html__( 'Show the number of sales for the last period.', 'omniverse' ),
				'type'        => 'switcher',
				'section'     => 'sold_counter',
				'default'     => false,
				'on-text'     => esc_html__( 'Yes', 'omniverse' ),
				'off-text'    => esc_html__( 'No', 'omniverse' ),
				'priority'    => 10,
			)
		);

		Options::add_field(
			array(
				'id'          => 'sold_counter_sales_type',
				'name'        => esc_html__( 'Show sales type', 'omniverse' ),
				'description' => esc_html__( 'You can show a real number of orders count for this product or set a random fake number.', 'omniverse' ),
				'type'        => 'buttons',
				'section'     => 'sold_counter',
				'options'     => array(
					'real_data' => array(
						'name'  => esc_html__( 'Real', 'omniverse' ),
						'value' => 'real_data',
					),
					'fake_data' => array(
						'name'  => esc_html__( 'Random', 'omniverse' ),
						'value' => 'fake_data',
					),
				),
				'default'     => 'real_data',
				'priority'    => 30,
			)
		);

		Options::add_field(
			array(
				'id'         => 'sold_counter_shown_after',
				'name'       => esc_html__( 'Minimum sales count', 'omniverse' ),
				'type'       => 'text_input',
				'attributes' => array(
					'type' => 'number',
					'min'  => '0',
				),
				'section'    => 'sold_counter',
				'requires'   => array(
					array(
						'key'     => 'sold_counter_sales_type',
						'compare' => 'equals',
						'value'   => 'real_data',
					),
				),
				'priority'   => 40,
				'default'    => '0',
			)
		);

		Options::add_field(
			array(
				'id'         => 'sold_counter_min_count',
				'name'       => esc_html__( 'Minimum', 'omniverse' ),
				'type'       => 'text_input',
				'attributes' => array(
					'type' => 'number',
					'min'  => '0',
				),
				'section'    => 'sold_counter',
				'requires'   => array(
					array(
						'key'     => 'sold_counter_sales_type',
						'compare' => 'equals',
						'value'   => 'fake_data',
					),
				),
				'priority'   => 40,
				'default'    => '10',
				'class'      => 'dn-col-6',
			)
		);

		Options::add_field(
			array(
				'id'         => 'sold_counter_max_count',
				'name'       => esc_html__( 'Maximum', 'omniverse' ),
				'type'       => 'text_input',
				'attributes' => array(
					'type' => 'number',
					'min'  => '0',
				),
				'section'    => 'sold_counter',
				'requires'   => array(
					array(
						'key'     => 'sold_counter_sales_type',
						'compare' => 'equals',
						'value'   => 'fake_data',
					),
				),
				'priority'   => 50,
				'default'    => '20',
				'class'      => 'dn-col-6',
			)
		);

		Options::add_field(
			array(
				'id'       => 'sold_counter_hide_on_outofstock',
				'name'     => esc_html__( 'Hide for out of stock products', 'omniverse' ),
				'type'     => 'switcher',
				'section'  => 'sold_counter',
				'default'  => false,
				'on-text'  => esc_html__( 'Yes', 'omniverse' ),
				'off-text' => esc_html__( 'No', 'omniverse' ),
				'priority' => 60,
			)
		);

		Options::add_field(
			array(
				'id'          => 'sold_counter_timeframe',
				'name'        => esc_html__( 'Time frame', 'omniverse' ),
				'description' => esc_html__( 'Specify custom timeframe value.', 'omniverse' ),
				'type'        => 'range',
				'section'     => 'sold_counter',
				'default'     => 3,
				'min'         => 1,
				'max'         => 59,
				'step'        => 1,
				'priority'    => 70,
			)
		);

		Options::add_field(
			array(
				'id'          => 'sold_counter_timeframe_period',
				'name'        => esc_html__( 'Time period', 'omniverse' ),
				'description' => esc_html__( 'Select custom time period', 'omniverse' ),
				'type'        => 'select',
				'section'     => 'sold_counter',
				'options'     => array(
					'minutes' => array(
						'name'  => esc_html__( 'Minutes', 'omniverse' ),
						'value' => 'minutes',
					),
					'hours'   => array(
						'name'  => esc_html__( 'Hours', 'omniverse' ),
						'value' => 'hours',
					),
					'days'    => array(
						'name'  => esc_html__( 'Days', 'omniverse' ),
						'value' => 'days',
					),
					'weeks'   => array(
						'name'  => esc_html__( 'Weeks', 'omniverse' ),
						'value' => 'weeks',
					),
					'months'  => array(
						'name'  => esc_html__( 'Months', 'omniverse' ),
						'value' => 'months',
					),
				),
				'default'     => 'minutes',
				'priority'    => 80,
			)
		);

		Options::add_field(
			array(
				'id'          => 'sold_counter_transient_hours',
				'name'        => esc_html__( 'Cache lifespan', 'omniverse' ),
				'description' => esc_html__( 'Specify the time in hours after which the product sales cache is cleared.', 'omniverse' ),
				'type'        => 'range',
				'section'     => 'sold_counter',
				'default'     => 24,
				'min'         => 1,
				'max'         => 72,
				'step'        => 1,
				'priority'    => 90,
			)
		);
	}

	/**
	 * Get sales count data for render by product id.
	 *
	 * @param int $id Product id.
	 *
	 * @return false|array
	 */
	public function get_product_sales_count_data( $id ) {
		if ( omniverse_get_opt( 'sold_counter_hide_on_outofstock' ) ) {
			$this_product = wc_get_product( $id );

			if ( ! $this_product->is_in_stock() ) {
				return false;
			}
		}

		$average_count = get_transient( 'omniverse_product_sales_' . $id );

		$sold_counter_timeframe = omniverse_get_opt( 'sold_counter_timeframe' );

		switch ( omniverse_get_opt( 'sold_counter_timeframe_period' ) ) {
			case 'minutes':
				$timeframe_period = ( $sold_counter_timeframe > 1 ? $sold_counter_timeframe . ' ' : '' ) . _n( 'minute', 'minutes', (int) $sold_counter_timeframe, 'omniverse' );
				break;
			case 'hours':
				$timeframe_period = ( $sold_counter_timeframe > 1 ? $sold_counter_timeframe . ' ' : '' ) . _n( 'hour', 'hours', (int) $sold_counter_timeframe, 'omniverse' );
				break;
			case 'days':
				$timeframe_period = ( $sold_counter_timeframe > 1 ? $sold_counter_timeframe . ' ' : '' ) . _n( 'day', 'days', (int) $sold_counter_timeframe, 'omniverse' );
				break;
			case 'weeks':
				$timeframe_period = ( $sold_counter_timeframe > 1 ? $sold_counter_timeframe . ' ' : '' ) . _n( 'week', 'weeks', (int) $sold_counter_timeframe, 'omniverse' );
				break;
			case 'months':
				$timeframe_period = ( $sold_counter_timeframe > 1 ? $sold_counter_timeframe . ' ' : '' ) . _n( 'month', 'months', (int) $sold_counter_timeframe, 'omniverse' );
				break;
			default:
				$timeframe_period = $sold_counter_timeframe . ' ' . esc_html__( 'hours', 'omniverse' );
				break;
		};

		if ( ! $average_count ) {
			if ( 'fake_data' === omniverse_get_opt( 'sold_counter_sales_type' ) ) {
				$min = abs( intval( omniverse_get_opt( 'sold_counter_min_count' ) ) );
				$max = abs( intval( omniverse_get_opt( 'sold_counter_max_count' ) ) );

				$average_count = wp_rand( $min, $max );
			} else {
				$date_before = strtotime(
					'-' . $sold_counter_timeframe *
					str_replace(
						array(
							'minutes',
							'hours',
							'days',
							'weeks',
							'months',
						),
						array(
							MINUTE_IN_SECONDS,
							HOUR_IN_SECONDS,
							DAY_IN_SECONDS,
							WEEK_IN_SECONDS,
							MONTH_IN_SECONDS,
						),
						omniverse_get_opt( 'sold_counter_timeframe_period' )
					) . ' seconds'
				);

				$orders = get_posts(
					array(
						'numberposts' => -1,
						'post_type'   => array( 'shop_order' ),
						'post_status' => array( 'wc-completed', 'wc-processing' ),
						'date_query'  => array(
							'after'  => date( 'Y-m-d H:i:s', $date_before ),
							'before' => date( 'Y-m-d H:i:s', strtotime( 'now' ) ),
						),
					)
				);

				$average_count = 0;

				foreach ( $orders as $order_id ) {
					$order = wc_get_order( $order_id );

					foreach ( $order->get_items() as $item_id => $item_values ) {
						$quantity   = 0;
						$product_id = $item_values->get_product_id();

						if ( $product_id === $id ) {
							$quantity = $item_values->get_quantity();
						}

						$average_count += $quantity;
					}
				}
			}

			set_transient( 'omniverse_product_sales_' . $id, $average_count, (int) omniverse_get_opt( 'sold_counter_transient_hours' ) * HOUR_IN_SECONDS );

			$saved_ids   = (array) get_transient( 'omniverse_product_sales_ids', array() );
			$saved_ids[] = $id;
			$saved_ids   = array_unique( $saved_ids );

			set_transient( 'omniverse_product_sales_ids', $saved_ids );
		}

		if ( 'real_data' === omniverse_get_opt( 'sold_counter_sales_type' ) && omniverse_get_opt( 'sold_counter_shown_after' ) > $average_count ) {
			return false;
		}

		if ( $average_count ) {
			return array(
				'wd_count_number' => $average_count,
				'wd_count_msg'    => sprintf(
					'%s %s %s',
					_n( 'Item', 'Items', $average_count, 'omniverse' ),
					esc_html__( 'sold in last', 'omniverse' ),
					esc_html( $timeframe_period )
				),
			);
		}

		return false;
	}

	/**
	 * Render output html.
	 *
	 * @codeCoverageIgnore
	 * @param string $classes     Custom classes for sold counter wrapper.
	 * @param string $icon_output Icon html for output in sold counter.
	 *
	 * @return void
	 */
	public function render( $classes = '', $icon_output = '' ) {
		global $product;

		if ( ( ! is_product() && ! Builder::get_instance()->has_custom_layout( 'single_product' ) ) || omniverse_loop_prop( 'is_quick_view' ) ) {
			return;
		}

		omniverse_enqueue_inline_style( 'woo-mod-product-count' );
		omniverse_enqueue_inline_style( 'woo-opt-sold-count' );

		$sales_count_data = $this->get_product_sales_count_data( $product->get_ID() );

		if ( empty( $sales_count_data ) ) {
			return;
		}

		if ( empty( $icon_output ) ) {
			$icon_output = '<span class="wd-count-icon"></span>';
		}

		?>
		<div class="wd-product-count wd-sold-count <?php echo esc_attr( $classes ); ?>">
			<?php echo $icon_output; // phpcs:ignore. ?><span class="wd-count-number"><?php echo esc_html( $sales_count_data['wd_count_number'] ); // Must be in one line. ?></span>
			<span class="wd-count-msg"><?php echo esc_html( $sales_count_data['wd_count_msg'] ); ?></span>
		</div>
		<?php
	}
}

Main::get_instance();
