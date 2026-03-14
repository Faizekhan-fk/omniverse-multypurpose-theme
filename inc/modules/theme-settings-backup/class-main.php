<?php

namespace DN\Modules\Theme_Settings_Backup;

use DN\Admin\Modules\Options\Presets;
use DN\Modules\Styles_Storage;
use DN\Admin\Modules\Options as ThemeSettings;
use DN\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

class Main extends Singleton {
	/**
	 * Register hooks.
	 */
	public function init() {
		add_action( 'wp_ajax_zs_create_backup', array( $this, 'create_backup' ) );
		add_action( 'wp_ajax_zs_delete_backup', array( $this, 'delete_backup' ) );
		add_action( 'wp_ajax_zs_download_backup', array( $this, 'download_backup' ) );
		add_action( 'wp_ajax_zs_apply_backup', array( $this, 'apply_backup' ) );
		add_action( 'zs_dashboard_before_page', array( $this, 'auto_backup' ) );
	}

	/**
	 * Displays the field control HTML.
	 *
	 * @since 1.0.0
	 *
	 * @return void.
	 */
	public function render() {
		wp_enqueue_script( 'dn-backup-scripts', OMNIVERSE_ASSETS . '/js/backup.js', array(), OMNIVERSE_VERSION, true );

		$all_backups  = array();
		$auto_backups = get_option( 'zs_backups_auto' );
		$backups      = get_option( 'zs_backups' );

		if ( $auto_backups ) {
			$all_backups += $auto_backups;
		}

		if ( $backups ) {
			$all_backups += $backups;
		}

		ksort( $all_backups );
		$all_backups = array_reverse( $all_backups, true );

		?>
		<div class="dn-box dn-backups dn-theme-style">
			<div class="dn-box-header">
				<div class="dn-row">
					<div class="dn-col">
						<h3>
							<?php esc_html_e( 'Backup', 'omniverse' ); ?>
						</h3>
					</div>

					<div class="dn-col-auto">
						<a class="dn-bordered-btn dn-color-primary dn-i-add dn-create-backup" href="#">
							<?php esc_html_e( 'Create backup', 'omniverse' ); ?>
						</a>
					</div>
				</div>
			</div>

			<div class="dn-box-content">
				<div class="dn-notices-wrapper dn-notices-sticky">
					<?php if ( ! $all_backups ) : ?>
						<div class="dn-notice dn-info">
							<?php esc_html_e( 'There are currently no existing backups.', 'omniverse' ); ?>
						</div>
					<?php endif; ?>
				</div>

				<?php if ( $all_backups ) : ?>
					<div class="dn-table dn-even">
						<div class="dn-table-row-heading dn-backup-header">
							<div class="dn-backup-title">
								<?php esc_html_e( 'Title', 'omniverse' ); ?>
							</div>
							<div class="dn-backup-date">
								<?php esc_html_e( 'Date', 'omniverse' ); ?>
							</div>
							<div class="dn-backup-action"></div>
						</div>
						<?php foreach ( $all_backups as $id => $backup ) : ?>
							<?php $this->get_item_backup( $id, $backup ); ?>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Output HTML codes for item backup.
	 *
	 * @param  int   $id  ID backup.
	 * @param  array $backup  Backup data.
	 */
	public function get_item_backup( $id, $backup ) {
		?>
		<div class="dn-table-row dn-backup-item" data-id="<?php echo esc_attr( $id ); ?>">
			<div class="dn-backup-title">
				<?php echo esc_html( $backup['title'] ); ?>
			</div>

			<div class="dn-backup-date">
				<?php echo esc_html( $backup['date'] ); ?>
			</div>

			<div class="dn-backup-action">
				<a href="#" class="dn-btn dn-color-primary dn-apply-backup dn-i-check">
					<?php esc_html_e( 'Apply', 'omniverse' ); ?>
				</a>
				<a href="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>?action=zs_download_backup&id=<?php echo esc_attr( $id ); ?>&security=<?php echo esc_attr( wp_create_nonce( 'zs_backup_nonce' ) ); ?>" class="dn-bordered-btn dn-color-default dn-i-export dn-export-backup">
					<?php esc_html_e( 'Export', 'omniverse' ); ?>
				</a>
				<a href="#" class="dn-bordered-btn dn-color-warning dn-style-icon dn-i-trash dn-delete-backup" title="<?php esc_html_e( 'Delete', 'omniverse' ); ?>"></a>
			</div>
		</div>
		<?php
	}

	/**
	 * Create backup.
	 */
	public function create_backup() {
		check_ajax_referer( 'zs_backup_nonce', 'security' );

		$backups     = get_option( 'zs_backups' );
		$backup_time = time();
		$options     = get_option( 'dn-omniverse-options' );
		$presets     = get_option( 'dn-options-presets' );

		if ( isset( $options['last_message'] ) ) {
			unset( $options['last_message'] );
		}

		if ( isset( $options['last_tab'] ) ) {
			unset( $options['last_tab'] );
		}

		$backups[ $backup_time ] = array(
			'title'   => esc_html__( 'Manual backup', 'omniverse' ),
			'date'    => gmdate( 'Y-m-d H:i:s', $backup_time ),
			'auto'    => false,
			'options' => $options,
			'presets' => $presets,
		);

		update_option( 'zs_backups', $backups, false );

		ob_start();

		$this->render();

		$content = ob_get_clean();

		wp_send_json_success(
			array(
				'content' => $content,
				'message' => esc_html__( 'Backup successfully created.', 'omniverse' ),
			)
		);
	}

	/**
	 * Delete backup.
	 */
	public function delete_backup() {
		check_ajax_referer( 'zs_backup_nonce', 'security' );

		if ( ! isset( $_POST['id'] ) ) {
			wp_send_json_error(
				array(
					'message' => esc_html__(
						'Something went wrong during backup deleted. ID is missing. Please, try again later.',
						'omniverse'
					),
				)
			);
		}

		$backups      = get_option( 'zs_backups' );
		$auto_backups = get_option( 'zs_backups_auto' );
		$backup_id    = sanitize_text_field( wp_unslash( $_POST['id'] ) );

		if ( ! isset( $backups[ $backup_id ] ) && ! isset( $auto_backups[ $backup_id ] ) ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'Something went wrong during backup deleted. ID is missing. Please, try again later.', 'omniverse' ),
				)
			);
		}

		if ( isset( $backups[ $backup_id ] ) ) {
			unset( $backups[ $backup_id ] );
			update_option( 'zs_backups', $backups, false );
		}

		if ( isset( $auto_backups[ $backup_id ] ) ) {
			unset( $auto_backups[ $backup_id ] );
			update_option( 'zs_backups_auto', $auto_backups, false );
		}

		ob_start();

		$this->render();

		$content = ob_get_clean();

		wp_send_json_success(
			array(
				'content' => $content,
				'message' => esc_html__( 'Backup successfully deleted.', 'omniverse' ),
			)
		);
	}

	/**
	 * Download options export.
	 *
	 * @since 1.0.0
	 */
	public function download_backup() {
		check_ajax_referer( 'zs_backup_nonce', 'security' );

		header( 'Content-Description: File Transfer' );
		header( 'Content-type: application/txt' );
		header( 'Content-Transfer-Encoding: binary' );
		header( 'Expires: 0' );
		header( 'Cache-Control: must-revalidate' );
		header( 'Pragma: public' );

		$file_name = '';
		$content   = '';

		if ( ! isset( $_GET['id'] ) ) {
			$file_name = 'Error';
			$content   = esc_html__( 'Something went wrong during backup download. ID is missing. Please, try again later.', 'omniverse' );
		}

		$backups      = get_option( 'zs_backups' );
		$auto_backups = get_option( 'zs_backups_auto' );
		$backup_id    = sanitize_text_field( wp_unslash( $_GET['id'] ) );

		if ( ! isset( $backups[ $backup_id ] ) && ! isset( $auto_backups[ $backup_id ] ) ) {
			$file_name = 'Error';
			$content   = esc_html__( 'Something went wrong during backup download. ID is missing. Please, try again later.', 'omniverse' );
		}

		if ( isset( $backups[ $backup_id ] ) ) {
			$backup    = $backups[ $backup_id ];
			$file_name = $backup['title'] . '-' . $backup['date'];
			$content   = wp_json_encode(
				array(
					'options' => $backup['options'],
					'presets' => $backup['presets'],
				)
			);
		}

		if ( isset( $auto_backups[ $backup_id ] ) ) {
			$backup    = $auto_backups[ $backup_id ];
			$file_name = $backup['title'] . '-' . $backup['date'];
			$content   = wp_json_encode(
				array(
					'options' => $backup['options'],
					'presets' => $backup['presets'],
				)
			);
		}

		header( 'Content-Disposition: attachment; filename="' . $file_name . '.json"' );

		echo $content; //phpcs:ignore

		wp_die();
	}

	/**
	 * Apply backup.
	 */
	public function apply_backup() {
		check_ajax_referer( 'zs_backup_nonce', 'security' );

		if ( ! isset( $_POST['id'] ) ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'Something went wrong during backup installation. ID is missing. Please, try again later.', 'omniverse' ),
				)
			);
		}

		$backups      = get_option( 'zs_backups' );
		$auto_backups = get_option( 'zs_backups_auto' );
		$backup_id    = sanitize_text_field( wp_unslash( $_POST['id'] ) );
		$backup       = array();

		if ( ! isset( $backups[ $backup_id ] ) && ! isset( $auto_backups[ $backup_id ] ) ) {
			wp_send_json_error(
				array(
					'message' => esc_html__( 'Something went wrong during backup installation. ID is missing. Please, try again later.', 'omniverse' ),
				)
			);
		}

		if ( isset( $backups[ $backup_id ] ) ) {
			$backup = $backups[ $backup_id ];
		}

		if ( isset( $auto_backups[ $backup_id ] ) ) {
			$backup = $auto_backups[ $backup_id ];
		}

		$backup['options']['last_message'] = 'import';

		$options = ThemeSettings::get_instance();

		$pseudo_post_data = array(
			'import-btn'    => true,
			'import_export' => wp_json_encode( $backup['options'] ),
		);

		$sanitized_options = $options->sanitize_before_save( $pseudo_post_data );

		$options->update_options( $sanitized_options );

		update_option( 'dn-options-presets', $backup['presets'] );

		$presets = Presets::get_active_presets();
		array_unshift( $presets, 'default' );

		foreach ( $presets as $preset ) {
			$storage = new Styles_Storage( 'theme_settings_' . $preset );

			$storage->reset_data();
			$storage->delete_file();
		}

		wp_send_json_success(
			array(
				'message' => esc_html__( 'Backup successfully installed.', 'omniverse' ),
			)
		);
	}

	/**
	 * Create auto backup.
	 */
	public function auto_backup() {
		if ( get_transient( 'dn-omniverse-auto-backup-check' ) ) {
			return;
		}

		$auto_backups = (array) get_option( 'zs_backups_auto' );
		$backup_time  = time();
		$options      = get_option( 'dn-omniverse-options' );
		$presets      = get_option( 'dn-options-presets' );

		set_transient( 'dn-omniverse-auto-backup-check', true, DAY_IN_SECONDS );

		if ( $auto_backups && 5 <= count( $auto_backups ) ) {
			foreach ( $auto_backups as $id => $backup ) {
				if ( $id <= strtotime( '-1 day' ) ) {
					unset( $auto_backups[ $id ] );
				}

				if ( apply_filters( 'omniverse_auto_backups_count', 10 ) > count( $auto_backups ) ) {
					break;
				}
			}
		}

		if ( isset( $options['last_message'] ) ) {
			unset( $options['last_message'] );
		}

		if ( isset( $options['last_tab'] ) ) {
			unset( $options['last_tab'] );
		}

		$auto_backups[ $backup_time ] = array(
			'title'   => esc_html__( 'Auto Backup ', 'omniverse' ),
			'date'    => gmdate( 'Y-m-d H:i:s', $backup_time ),
			'auto'    => true,
			'options' => $options,
			'presets' => $presets,
		);

		update_option( 'zs_backups_auto', $auto_backups, false );
	}
}

Main::get_instance();
