<?php
/**
 * The main patcher class.
 *
 * @package Omniverse
 */

namespace DN\Modules\Patcher;

use DN\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * The main patcher class.
 */
class Main extends Singleton {
	/**
	 * Register hooks.
	 */
	public function init() {
		$this->include_files();

		add_action( 'wp_ajax_omniverse_patch_action', array( $this, 'patch_process' ) );
	}

	/**
	 * Include files.
	 */
	public function include_files() {
		require_once get_parent_theme_file_path( OMNIVERSE_FRAMEWORK . '/modules/patcher/class-client.php' );
		require_once get_parent_theme_file_path( OMNIVERSE_FRAMEWORK . '/modules/patcher/class-patch.php' );
	}

	/**
	 * Patch process.
	 */
	public function patch_process() {
		check_ajax_referer( 'patcher_nonce', 'security' );

		if ( empty( $_GET['id'] ) ) {
			wp_send_json(
				array(
					'message' => esc_html__( 'Empty path ID, please, try again.', 'omniverse' ),
					'status'  => 'error',
				)
			);
		}

		$patch_id          = sanitize_text_field( $_GET['id'] ); //phpcs:ignore
		$patches_installed = get_option( 'zs_successfully_installed_patches' );

		if ( isset( $patches_installed[ OMNIVERSE_VERSION ][ $patch_id ] ) ) {
			wp_send_json(
				array(
					'message' => esc_html__( 'The patch is already applied.', 'omniverse' ),
					'status'  => 'success',
				)
			);
		}

		new Patch( $patch_id );
	}
}

Main::get_instance();
