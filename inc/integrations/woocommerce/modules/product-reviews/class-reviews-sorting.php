<?php
/**
 * Single product reviews class.
 *
 * @package omniverse
 */

namespace DN\Modules\Product_Reviews;

use DN\Singleton;

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

/**
 * Reviews_Sorting class.
 */
class Reviews_Sorting extends Singleton {
	private $sorting_fields = array();

	public function init() {
		add_action( 'wp', array( $this, 'do_after_setup_globals_options' ), 500 );
	}

	public function do_after_setup_globals_options() {
		if ( ! omniverse_get_opt( 'reviews_sorting' ) ) {
			return;
		}

		$this->sorting_fields = array(
			'default' => esc_html__( 'Default', 'omniverse' ),
			'newest'  => esc_html__( 'Newest', 'omniverse' ),
			'oldest'  => esc_html__( 'Oldest', 'omniverse' ),
		);

		if ( omniverse_get_opt( 'reviews_enable_likes' ) ) {
			$this->sorting_fields['most_helpful'] = esc_html__( 'Most helpful', 'omniverse' );
		}

		if ( function_exists( 'wc_review_ratings_enabled' ) && wc_review_ratings_enabled() ) {
			$this->sorting_fields['highest_rated'] = esc_html__( 'Highest rated', 'omniverse' );
			$this->sorting_fields['lowest_rated']  = esc_html__( 'Lowest rated', 'omniverse' );
		}
	}

	/**
	 * Get "Reviews sorting" fields.
	 *
	 * @return array
	 */
	public function get_sorting_fields() {
		return $this->sorting_fields;
	}

	/**
	 * Render.
	 *
	 * @codeCoverageIgnore
	 * @param bool $return Do you need to return the html?.
	 * @return string|void
	 */
	public function render( $return = false ) {
		$order_by               = Helper::get_order_by_from_request();
		$reviews_sorting_fields = $this->get_sorting_fields();

		if ( $return ) {
			ob_start();
		}

		?>
		<select name="omniverse_reviews_sorting_select" class="wd-reviews-sorting-select" aria-label="<?php echo esc_attr__( 'Select reviews sorting', 'omniverse'); ?>">
			<?php foreach ( $reviews_sorting_fields as $filter_key => $filter ) : ?>
				<option value="<?php echo esc_attr( $filter_key ); ?>" <?php selected( $filter_key, $order_by ); ?>>
					<?php echo esc_html( $filter ); ?>
				</option>
			<?php endforeach; ?>
		</select>
		<?php
		if ( $return ) {
			return ob_get_clean();
		}
	}
}

Reviews_Sorting::get_instance();
