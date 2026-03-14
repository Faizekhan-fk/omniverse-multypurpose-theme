<?php
/**
 * Import.
 *
 * @package Omniverse
 */

namespace DN\Admin\Modules;

use WP_Query;
use DN\Admin\Modules\Import\Helpers;
use DN\Admin\Modules\Import\Process;
use DN\Admin\Modules\Import\Remove;
use DN\Singleton;

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

/**
 * Import.
 */
class Import extends Singleton {
	/**
	 * Available versions.
	 *
	 * @var array
	 */
	private $version_list = array();

	/**
	 * Helpers.
	 *
	 * @var Helpers
	 */
	private $helpers;

	/**
	 * Constructor.
	 */
	 
	public $business_type; 
	public function init() {
		$this->include_files();

		$this->helpers = Helpers::get_instance();
		$this->set_versions_list();

		$this->business_type = get_option( 'wd_business_type' );

		add_action( 'wp_ajax_omniverse_import_action', array( $this, 'import_action' ) );
	}

	/**
	 * Include files.
	 *
	 * @return void
	 */
	public function include_files() {
		$files = array(
			'class-helpers',
			'class-process',
			'class-widgets',
			'class-sliders',
			'class-xml',
			'class-options',
			'class-headers',
			'class-after',
			'class-remove',
			'class-before',
			'class-images',
			'class-menu',
		);

		foreach ( $files as $file ) {
			require_once get_parent_theme_file_path( OMNIVERSE_FRAMEWORK . '/admin/modules/import/' . $file . '.php' );
		}
	}

	/**
	 * Import action.
	 */
	public function import_action() {
		check_ajax_referer( 'omniverse-import-nonce', 'security' );

		if ( empty( $_GET['version'] ) || empty( $_GET['type'] ) || empty( $_GET['process'] ) ) {
			return;
		}
		

		$version = sanitize_text_field( wp_unslash( $_GET['version'] ) );
		$type    = sanitize_text_field( wp_unslash( $_GET['type'] ) );
		$process = sanitize_text_field( wp_unslash( $_GET['process'] ) );
		$businessType = sanitize_text_field( wp_unslash( $_GET['businessType'] ) );
		
		new Process( $version, $process, $type, $businessType );
		
		wp_send_json(
			array(
				'preview_url' => $this->get_preview_url( $version, $type ),
				'remove_html' => Remove::get_instance()->popup_content( true, 'import' ),
			)
		);
	}

	/**
	 * Get categories.
	 */
	public function get_categories() {
		$categories = [];

		foreach ( $this->version_list as $version_data ) {
			if( isset($version_data['b_type']) && @$version_data['b_type'] === $this->business_type ){
				if ( ! isset( $version_data['categories'] ) ) {
					continue;
				}

				$type = 'version' === $version_data['type'] ? 'version' : 'page';

				foreach ( $version_data['categories'] as $category ) {
					$count = ! empty( $categories[ $type ][ $category['slug'] ]['count'] ) ? $categories[ $type ][ $category['slug'] ]['count'] : 0;

					$categories[ $type ][ $category['slug'] ] = [
						'data'  => $category,
						'count' => $count + 1,
					];
				}
			}
		}

		return $categories;
	}

	/**
	 * Get all category count by type.
	 *
	 * @param string $count_type Count type.
	 *
	 * @return int|mixed
	 */
	public function get_all_category_count( $count_type ) {
		$output = [];

		foreach ( $this->version_list as $version_data ) {
			if( isset($version_data['b_type']) && @$version_data['b_type'] === $this->business_type ){
				$type = 'version' === $version_data['type'] ? 'version' : 'page';

				$output[ $type ] = isset( $output[ $type ] ) ? $output[ $type ] + 1 : 1;
			}
		}

		return $output[ $count_type ];
	}

	/**
	 * Interface.
	 */
	public function render() {
		wp_enqueue_script( 'dn-import', OMNIVERSE_ASSETS . '/js/import.js', array(), OMNIVERSE_VERSION, true );

		$wrapper_classes = '';
		$items_classes   = '';

		$base_versions = $this->helpers->get_base_version();

		if ( $base_versions ) {
			foreach ( $base_versions as $version ) {
				if ( $this->is_imported( $version ) ) {
					$wrapper_classes .= ' dn-base-imported';

					break;
				}
			}
		}

		if ( Remove::get_instance()->has_data_to_remove() ) {
			$wrapper_classes .= ' dn-has-data';
		}

		$protocol = is_ssl() ? 'https' : 'http';

		if ( $this->get_required_plugins() || ( defined( 'ELEMENTOR_VERSION' ) && defined( 'WPB_PLUGIN_DIR' ) ) || ! class_exists( 'DOMDocument' ) || ! function_exists( 'simplexml_load_file' ) || wp_parse_url( get_home_url(), PHP_URL_SCHEME ) !== $protocol || wp_parse_url( get_home_url(), PHP_URL_SCHEME ) !== wp_parse_url( get_site_url(), PHP_URL_SCHEME ) ) {
			$items_classes .= ' dn-disabled';
		}

		$version      = omniverse_get_theme_info( 'Version' );
		$current_base = get_option( 'wd_import_current_base', 'base' );

		wp_enqueue_script( 'dn-helpers', OMNIVERSE_SCRIPTS . '/scripts/global/helpers.min.js', array(), $version, true );
		wp_enqueue_script( 'dn-lazy-load', OMNIVERSE_SCRIPTS . '/scripts/global/lazyLoading.min.js', array(), $version, true );
		wp_enqueue_style( 'dn-lazy-load', OMNIVERSE_STYLES . '/parts/opt-lazy-load.min.css', array(), $version );

		?>
		<script>
			var omniverse_settings = {
				product_gallery    : {
					thumbs_slider: {
						position: true
					}
				},
				lazy_loading_offset: 0
			};
		</script>
		<div class="dn-box dn-import dn-theme-style<?php echo esc_attr( $wrapper_classes ); ?>" data-current-base="<?php echo esc_attr( $current_base ); ?>">
			<div class="dn-box-header">
				<div class="dn-row">
					<div class="dn-col">
						<h3>
							<?php esc_html_e( 'Prebuilt websites', 'omniverse' ); ?>
						</h3>
						<div class="dn-import-search dn-search dn-i-search">
							<input type="text" placeholder="<?php echo esc_attr__( 'Search by name', 'omniverse' ); ?>" aria-label="<?php echo esc_attr__( 'Search by name', 'omniverse' ); ?>">
						</div>
					</div>
					<div class="dn-col-auto dn-col-remove-content">
						<?php Remove::get_instance()->render(); ?>
					</div>
				</div>
			</div>
			<div class="dn-box-content">
				<div class="dn-row dn-sp-20">
					<div class="dn-col-12 dn-col-lg-3 dn-col-xl-2 dn-col-dummy-nav">
						<?php if ( ! isset( $_GET['tab'] ) || ( isset( $_GET['tab'] ) && 'wizard' !== $_GET['tab'] ) ) : // phpcs:ignore ?>

							<div class="dn-import-cats-list-wrap">
								<div class="dn-import-cats-list">
									<?php foreach ( $this->get_categories() as $type => $categories ) : ?>
										<?php
										$classes = '';

										if ( 'version' === $type ) {
											$classes = wd_add_cssclass( 'dn-active', $classes );
										}
										?>
										<ul class="dn-filter <?php echo esc_attr( $classes ); ?>" data-type="<?php echo esc_attr( $type ); ?>">
											<li data-cat="*" class="dn-active">
												<a>
													<span><?php esc_html_e( 'All', 'omniverse' ); ?></span>
													<span class="dn-filter-count"><?php echo esc_html( $this->get_all_category_count( $type ) ); ?></span>
												</a>
											</li>
											<?php foreach ( $categories as $category ) : ?>
												<li data-cat="<?php echo esc_attr( $category['data']['slug'] ); ?>">
													<a>
														<span><?php echo esc_html( $category['data']['name'] ); ?></span>
														<span class="dn-filter-count"><?php echo esc_html( $category['count'] ); ?></span>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>

					<div class="dn-col">
						<div class="dn-notices-wrapper dn-notices-sticky dn-import-notices"><?php $this->print_notices(); // Must be in one line. ?></div>
						<div class="dn-import-items dn-row dn-sp-20<?php echo esc_attr( $items_classes ); ?>">
							<?php 
							foreach ( $this->version_list as $slug => $version_data ) : ?>
								<?php
								if( isset($version_data['b_type']) && @$version_data['b_type'] === $this->business_type ){
								$item_classes        = '';
								$item_wrap_classes   = '';
								$is_version_imported = $this->is_imported( $slug );

								$type       = $version_data['type'];
								$base       = isset( $version_data['base'] ) ? $version_data['base'] : '';
								$tags       = isset( $version_data['tags'] ) ? $version_data['tags'] : '';
								$categories = isset( $version_data['categories'] ) ? $version_data['categories'] : [];
								$b_type     = $version_data['b_type'];

								if ( 'version' === $type ) {
									$item_wrap_classes = wd_add_cssclass( 'dn-active', $item_classes );
								}
								if ( $is_version_imported ) {
									$item_classes = wd_add_cssclass( 'dn-imported', $item_classes );
								}

								$categories_array = [];
								foreach ( $categories as $category ) {
									$categories_array[] = $category['slug'];
								}

								?>
								<div class="dn-import-item-wrap dn-cat-show dn-col-6 dn-col-xl-4 <?php echo esc_attr( $item_wrap_classes ); ?>">
									<div class="dn-import-item <?php echo esc_attr( $item_classes ); ?>" data-version="<?php echo esc_attr( $slug ); ?>" data-base="<?php echo esc_attr( $base ); ?>" data-type="<?php echo esc_attr( $type ); ?>" data-tags="<?php echo esc_attr( $tags ); ?>" data-cats="<?php echo esc_attr( implode( ',', $categories_array ) ); ?>" data-business="<?php echo $b_type; ?>">
										<div class="dn-import-item-image">
											<img data-omni-src="<?php echo esc_url( OMNIVERSE_DUMMY_URL . $slug . '/preview.jpg' ); ?>" src="<?php echo esc_url( omniverse_lazy_get_default_preview() ); ?>" class="wd-lazy-load wd-lazy-fade" alt="<?php echo esc_attr__( 'Import preview', 'omniverse' ); ?>">
											<div class="dn-box-labels">
												<?php if ( 'main' === $slug ) : ?>
													<div class="dn-box-label dn-label-default dn-i-flag">
														<?php echo esc_attr__( 'Default', 'omniverse' ); ?>
													</div>
												<?php endif; ?>
												<div class="dn-box-label dn-label-warning dn-i-check">
													<?php echo esc_attr__( 'Imported', 'omniverse' ); ?>
												</div>
											</div>
											<a href="<?php echo esc_url( $this->get_demo_preview_url( $slug, $version_data ) ); ?>" class="dn-btn dn-color-white dn-import-item-preview dn-i-view" target="_blank">
												<?php esc_html_e( 'Live preview', 'omniverse' ); ?>
											</a>
											<div class="dn-import-progress-bar" data-progress="0"></div>
											<div class="dn-import-progress-bar-percent">0%</div>
										</div>
										<footer class="dn-import-item-footer">
											<span class="dn-import-item-title">
												<?php echo esc_html( $version_data['title'] ); ?>
											</span>

											<a href="#" class="dn-import-item-btn dn-btn dn-color-alt dn-i-check">
												<?php esc_html_e( 'Activate', 'omniverse' ); ?>
											</a>
											<a href="#" class="dn-import-item-btn dn-bordered-btn dn-color-primary dn-i-import">
												<?php esc_html_e( 'Import', 'omniverse' ); ?>
											</a>
											<a href="<?php echo esc_url( $this->get_preview_url( $slug, $type ) ); ?>" target="_blank" class="dn-view-item-btn dn-btn dn-color-alt dn-i-expand">
												<?php esc_html_e( 'View page', 'omniverse' ); ?>
											</a>
										</footer>
									</div>
								</div>
								<?php } ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="dn-box-footer">
				<p>
					<?php esc_html_e( 'Import any of the demo versions that will include a home page, a few products, posts, projects, images and menus. You will be able to switch to any demo at any time. You can also remove all the previously imported content.', 'omniverse' ); ?>
				</p>
			</div>
		</div>
		<?php
	}

	/**
	 * Print notices.
	 */
	public function print_notices() {
		if ( $this->get_required_plugins() ) {
			$this->print_notice( 'warning', sprintf( __( 'You need to install the following plugins to use our import function: <strong><a href="%1$s">%2$s</a></strong>', 'omniverse' ), esc_url( add_query_arg( 'page', rawurlencode( 'tgmpa-install-plugins' ), self_admin_url( 'themes.php' ) ) ), implode( ', ', $this->get_required_plugins() ) ) );
		}

		if ( defined( 'ELEMENTOR_VERSION' ) && defined( 'WPB_PLUGIN_DIR' ) ) {
			$this->print_notice( 'warning', __( 'Please, deactivate one of the builders and leave only ONE plugin either <strong>WPBakery page builder</strong> or <strong>Elementor</strong>.', 'omniverse' ) );
		}

		if ( ! class_exists( 'DOMDocument' ) ) {
			$this->print_notice( 'warning', __( 'Please, contact the host support and ask them to enable <strong>DOMDocument</strong>.', 'omniverse' ) );
		}

		if ( ! function_exists( 'simplexml_load_file' ) ) {
			$this->print_notice( 'warning', __( 'Please, contact the host support and ask them to enable <strong>simplexml_load_file</strong>.', 'omniverse' ) );
		}

		$protocol = is_ssl() ? 'https' : 'http';

		if ( wp_parse_url( get_home_url(), PHP_URL_SCHEME ) !== $protocol || wp_parse_url( get_home_url(), PHP_URL_SCHEME ) !== wp_parse_url( get_site_url(), PHP_URL_SCHEME ) ) {
			$this->print_notice( 'warning', __( 'In your settings, the HTTP protocol is specified, but you opened the page via HTTPS. This can lead to an error during import. You need to correct the settings and specify the protocol https:// in WordPress -> Settings -> General.', 'omniverse' ) );
		}
	}

	/**
	 * Get required plugins.
	 */
	public function get_required_plugins() {
		$plugins = array();

		if ( ! class_exists( 'OMNIVERSE_Post_Types' ) ) {
			$plugins[] = 'Omniverse Core';
		}

		if ( ! function_exists( 'is_shop' ) && isset($this->business_type) && $this->business_type  == 'ecommerce') {
			$plugins[] = 'Woocommerce';
		}

		if ( ! defined( 'ELEMENTOR_VERSION' ) && ! defined( 'WPB_PLUGIN_DIR' ) ) {
			$plugins[] = 'Elementor';
		}
		
		if ( !isset( get_plugins()['learnpress/learnpress.php'] ) && isset($this->business_type) && $this->business_type  == 'lms') {
			$plugins[] = 'LearnPress';
		}

		return $plugins;
	}

	/**
	 * Print notice.
	 *
	 * @param string $type    Type.
	 * @param string $message Message.
	 */
	private function print_notice( $type, $message ) {
		?>
		<div class="dn-notice dn-<?php echo esc_attr( $type ); ?>">
			<?php echo wp_kses( $message, omniverse_get_allowed_html() ); ?>
		</div>
		<?php
	}

	/**
	 * Is version imported.
	 *
	 * @param string $slug Slug.
	 *
	 * @return bool
	 */
	public function is_imported( $slug ) {
		return in_array( $slug, get_option( 'wd_import_imported_versions', array() ), true );
	}

	/**
	 * Get demo preview URL.
	 *
	 * @param string $slug         Slug.
	 * @param array  $version_data Data.
	 *
	 * @return string
	 */
	private function get_demo_preview_url( $slug, $version_data ) {
		$url = OMNIVERSE_DEMO_URL . $slug . '/';

		if ( 'version' === $version_data['type'] ) {
			$url = OMNIVERSE_DEMO_URL . 'demo-' . $slug . '/demo/' . $slug . '/';
		}

		if ( isset( $version_data['link'] ) ) {
			$url = $version_data['link'];
		}

		return $url;
	}

	/**
	 * Get preview URL.
	 *
	 * @param string $slug Slug.
	 * @param string $type Type.
	 *
	 * @return string
	 */
	private function get_preview_url( $slug, $type ) {
		$query_args = array(
			'post_type'              => 'page',
			'posts_per_page'         => 1,
			'no_found_rows'          => true,
			'ignore_sticky_posts'    => true,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
		);

		if ( 'version' === $type ) {
			$query_args['title'] = 'Home ' . $slug;

			$query = new WP_Query( $query_args );
			$page  = ! empty( $query->post ) ? $query->post : null;
		} else {
			$page = get_page_by_path( $slug, OBJECT, array( 'page' ) );
		}

		if ( ! $page ) {
			$query_args['title'] = str_replace( '-', ' ', $slug );

			$query = new WP_Query( $query_args );
			$page  = ! empty( $query->post ) ? $query->post : null;
		}

		if ( ! $page ) {
			return '';
		}

		return get_permalink( $page->ID );
	}

	/**
	 * Set versions list.
	 */
	private function set_versions_list() {
		$this->version_list = omniverse_get_config( 'versions' );
		$base_versions = $this->helpers->get_base_version();

		if ( $base_versions ) {
			foreach ( $base_versions as $version ) {
				unset( $this->version_list[ $version ] );
			}
		}
		
		if ( 'elementor' === omniverse_get_current_page_builder() ) {
			foreach ( $this->version_list as $key => $value ) {
				if ( isset( $value['elementor'] ) && ! $value['elementor'] ) {
					unset( $this->version_list[ $key ] );
				}
			}
		}
	}
}

Import::get_instance();
