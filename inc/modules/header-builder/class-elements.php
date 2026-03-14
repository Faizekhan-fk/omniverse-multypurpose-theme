<?php

namespace DN\Modules\Header_Builder;

/**
 * ------------------------------------------------------------------------------------------------
 * Include all elements classes and create their objects. AJAX handlers.
 * ------------------------------------------------------------------------------------------------
 */
class Elements {

	/**
	 * Elements list.
	 *
	 * @var array
	 */
	public $elements = array(
		'Root',
		'Row',
		'Column',
		'Logo',
		'Mainmenu',
		'Menu',
		'Burger',
		'Cart',
		'Wishlist',
		'Compare',
		'Search',
		'Mobilesearch',
		'Account',
		'Categories',
		'Divider',
		'Space',
		'Text',
		'HTMLBlock',
		'Button',
		'Infobox',
		'Social',
		'Stickynavigation',
	);

	/**
	 * Elements object classes.
	 *
	 * @var array
	 */
	public $elements_classes = array();

	/**
	 * Construct.
	 */
	public function __construct() {
		$this->include_files();
		add_action( 'wp_ajax_omniverse_get_builder_elements', array( $this, 'get_elements_ajax' ) );
	}

	/**
	 * Include elements classes.
	 *
	 * @return void
	 */
	public function include_files() {
		if ( defined( 'WPML_PLUGIN_BASENAME' ) ) {
			$this->elements[] = 'Languages';
		}

		require_once OMNIVERSE_HB_DIR . 'elements/abstract/class-element.php';

		foreach ( $this->elements as $class ) {
			$path = OMNIVERSE_HB_DIR . 'elements/class-' . strtolower( $class ) . '.php';

			if ( file_exists( $path ) ) {
				require_once $path;

				$class_name                       = 'DN\Modules\Header_Builder\Elements\\' . $class;
				$this->elements_classes[ $class ] = new $class_name();
			}
		}
	}

	/**
	 * Get all elements.
	 *
	 * @return void
	 */
	public function get_elements_ajax() {
		check_ajax_referer( 'omniverse-get-builder-elements-nonce', 'security' );

		$elements = array();

		foreach ( $this->elements_classes as $el => $class ) {
			$args = $class->get_args();
			if ( $args['addable'] ) {
				$elements[] = $class->get_args();
			}
		}

		echo wp_json_encode( $elements );

		wp_die();
	}
}
