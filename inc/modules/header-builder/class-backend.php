<?php

namespace DN\Modules\Header_Builder;

use DN\Modules\Header_Builder;
use DN\Singleton;

/**
 * ------------------------------------------------------------------------------------------------
 * Backend class that enqueues main scripts and CSS.
 * ------------------------------------------------------------------------------------------------
 */
class Backend extends Singleton {

	/**
	 * Object main class.
	 *
	 * @var null
	 */
	private $_builder = null;

	/**
	 * Initialize class.
	 *
	 * @return void
	 */
	public function init() {
		$this->_builder = Header_Builder::get_instance();

		if ( isset( $_GET['page'] ) && 'zs_header_builder' === $_GET['page'] ) { //phpcs:ignore
			add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ), 50 );
		}
	}

	/**
	 * Enqueue scripts in page.
	 *
	 * @return void
	 */
	public function scripts() {
		$dev = apply_filters( 'whb_debug_mode', false );

		$assets_path = ( $dev ) ? plugins_url( 'header-builder/builder/public/' ) : OMNIVERSE_ASSETS;

		wp_register_script( 'omniverse-admin-builder', $assets_path . '/js/builder.js', array(), '', true );

		wp_localize_script(
			'omniverse-admin-builder',
			'headerBuilder',
			array(
				'sceleton'        => $this->_builder->factory->get_header( false )->get_structure(),
				'settings'        => $this->_builder->factory->get_header( false )->get_settings(),
				'name'            => OMNIVERSE_HB_DEFAULT_NAME,
				'id'              => OMNIVERSE_HB_DEFAULT_ID,
				'headersList'     => $this->_builder->list->get_all(),
				'headersExamples' => $this->_builder->list->get_examples(),
				'defaultHeader'   => $this->_builder->manager->get_default_header(),
				'texts'           => array(
					'managerTitle'                       => __( 'Headers builder', 'omniverse' ),
					'description'                        => __( 'Here you can manage your header layouts, create new ones, import and export. You can set which header to use for all pages by default.', 'omniverse' ),
					'createNew'                          => __( 'Add new header', 'omniverse' ),
					'import'                             => __( 'Import header', 'omniverse' ),
					'remove'                             => __( 'Delete', 'omniverse' ),
					'edit'                               => __( 'Edit', 'omniverse' ),
					'duplicate'                          => __( 'Duplicate', 'omniverse' ),
					'makeDefault'                        => __( 'Set as default', 'omniverse' ),
					'headerSearchPlaceholder'            => __( 'Search by name', 'omniverse' ),
					'alreadyDefault'                     => __( 'Default header', 'omniverse' ),
					'headerSettings'                     => __( 'Header settings', 'omniverse' ),
					'delete'                             => __( 'Delete', 'omniverse' ),
					'Make it default'                    => __( 'Make it default', 'omniverse' ),
					'on'                                 => __( 'On', 'omniverse' ),
					'off'                                => __( 'Off', 'omniverse' ),
					'Import new header'                  => __( 'Import new header', 'omniverse' ),
					'Import'                             => __( 'Import', 'omniverse' ),
					'JSON code for import is not valid!' => __( 'JSON code for import is not valid!', 'omniverse' ),
					'Paste your JSON header export data here and click "Import"' => __( 'Paste your JSON header export data here and click "Import"', 'omniverse' ),
					'Are you sure you want to remove this header?' => __( 'Are you sure you want to remove this header?', 'omniverse' ),
					'Press OK to make this header default for all pages, Cancel to leave.' => __( 'Press OK to make this header default for all pages, Cancel to leave.', 'omniverse' ),
					'Choose which layout you want to use as a base for your new header.' => __( 'Choose which layout you want to use as a base for your new header.', 'omniverse' ),
					'Examples library'                   => __( 'Examples library', 'omniverse' ),
					'User headers'                       => __( 'User headers', 'omniverse' ),
					'Background image repeat'            => __( 'Background image repeat', 'omniverse' ),
					'Background image'                   => __( 'Background image', 'omniverse' ),
					'Background color'                   => __( 'Background color', 'omniverse' ),
					'Inherit'                            => __( 'Inherit', 'omniverse' ),
					'No repeat'                          => __( 'No repeat', 'omniverse' ),
					'Repeat All'                         => __( 'Repeat All', 'omniverse' ),
					'Repeat horizontally'                => __( 'Repeat horizontally', 'omniverse' ),
					'Repeat vertically'                  => __( 'Repeat vertically', 'omniverse' ),
					'Background image size'              => __( 'Background image size', 'omniverse' ),
					'Cover'                              => __( 'Cover', 'omniverse' ),
					'Contain'                            => __( 'Contain', 'omniverse' ),
					'Background image attachment'        => __( 'Background image attachment', 'omniverse' ),
					'Fixed'                              => __( 'Fixed', 'omniverse' ),
					'Scroll'                             => __( 'Scroll', 'omniverse' ),
					'Background image position'          => __( 'Background image position', 'omniverse' ),
					'Left top'                           => __( 'Left top', 'omniverse' ),
					'Left center'                        => __( 'Left center', 'omniverse' ),
					'Left bottom'                        => __( 'Left bottom', 'omniverse' ),
					'Center top'                         => __( 'Center top', 'omniverse' ),
					'Center center'                      => __( 'Center center', 'omniverse' ),
					'Center bottom'                      => __( 'Center bottom', 'omniverse' ),
					'Right top'                          => __( 'Right top', 'omniverse' ),
					'Right center'                       => __( 'Right center', 'omniverse' ),
					'Right bottom'                       => __( 'Right bottom', 'omniverse' ),
					'Preview'                            => __( 'Preview', 'omniverse' ),
					'Border Width'                       => __( 'Border Width', 'omniverse' ),
					'Style'                              => __( 'Style', 'omniverse' ),
					'Container'                          => __( 'Container', 'omniverse' ),
					'fullwidth'                          => __( 'fullwidth', 'omniverse' ),
					'boxed'                              => __( 'boxed', 'omniverse' ),
					'Upload an image'                    => __( 'Upload an image', 'omniverse' ),
					'Upload'                             => __( 'Upload', 'omniverse' ),
					'Open in new window'                 => __( 'Open in new window', 'omniverse' ),
					'Add element to this section'        => __( 'Add element to this section', 'omniverse' ),
					'Are you sure you want to delete this element?' => __( 'Are you sure you want to delete this element?', 'omniverse' ),
					'Export this header structure'       => __( 'Export this header structure', 'omniverse' ),
					'importDescription'                  => __(
						'Copy the code from the following text area and save it. You will be
					able to import it later with our import function in the headers
					manager.',
						'omniverse'
					),
					'Save header'                        => __( 'Save header', 'omniverse' ),
					'Back to headers list'               => __( 'Back to headers list', 'omniverse' ),
					'Edit'                               => __( 'Edit', 'omniverse' ),
					'Clone'                              => __( 'Clone', 'omniverse' ),
					'Remove'                             => __( 'Remove', 'omniverse' ),
					'Add element'                        => __( 'Add element', 'omniverse' ),
					'Loading, please wait...'            => __( 'Loading, please wait...', 'omniverse' ),
					'Close'                              => __( 'Close', 'omniverse' ),
					'Save'                               => __( 'Save', 'omniverse' ),
					'Header settings'                    => __( 'Header settings', 'omniverse' ),
					'Export header'                      => __( 'Export header', 'omniverse' ),
					'Desktop layout'                     => __( 'Desktop layout', 'omniverse' ),
					'Mobile layout'                      => __( 'Mobile layout', 'omniverse' ),
					'Header is successfully saved.'      => __( 'Header is successfully saved.', 'omniverse' ),
					'Header is successfully deleted.'    => __( 'Header is successfully deleted.', 'omniverse' ),
					'Default header for all pages is changed.' => __( 'Default header for all pages is changed.', 'omniverse' ),
					'Configure'                          => __( 'Configure', 'omniverse' ),
					'settings'                           => __( 'settings', 'omniverse' ),
					'Hidden on desktop'                  => __( 'Hidden on desktop', 'omniverse' ),
					'Hidden on mobile'                   => __( 'Hidden on mobile', 'omniverse' ),
				),
			)
		);

		wp_enqueue_script( 'omniverse-admin-builder' );

		wp_enqueue_editor();
		wp_enqueue_media();
	}
}

$GLOBALS['omniverse_hb_backend'] = Backend::get_instance();
