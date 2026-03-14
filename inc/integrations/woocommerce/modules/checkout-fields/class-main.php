<?php
/**
 * Checkout fields class.
 *
 * @package omniverse
 */

namespace DN\Modules\Checkout_Fields;

use DN\Modules\Checkout_Fields\List_Table\Fields_Table;
use DN\Admin\Modules\Options;
use DN\Singleton;

/**
 * Checkout fields class.
 */
class Main extends Singleton {
	/**
	 * Init.
	 */
	public function init() {
		$this->include_files();

		add_action( 'init', array( $this, 'add_options' ) );
	}

	/**
	 * Add options in theme settings.
	 */
	public function add_options() {
		Options::add_field(
			array(
				'id'          => 'checkout_fields_enabled',
				'name'        => esc_html__( 'Checkout fields manager', 'omniverse' ),
				'description' => esc_html__( 'You can configure your checkout forms in Dashboard -> WooCommerce -> Checkout Fields.', 'omniverse' ),
				'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'checkout-fields-manager.mp4" autoplay loop muted></video>',
				'type'        => 'switcher',
				'section'     => 'checkout_section',
				'default'     => false,
				'priority'    => 50,
			)
		);
	}

	/**
	 * Include files.
	 */
	private function include_files() {
		if ( ! class_exists( 'WP_List_Table' ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
		}

		$files = array(
			'class-helper',
			'list-tables/class-fields-table',
			'class-admin',
			'class-frontend',
			'class-ajax-actions',
		);

		foreach ( $files as $file ) {
			require_once get_parent_theme_file_path( OMNIVERSE_FRAMEWORK . '/integrations/woocommerce/modules/checkout-fields/' . $file . '.php' );
		}
	}
}

Main::get_instance();
