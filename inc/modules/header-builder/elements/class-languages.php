<?php
namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 * Languages element
 * ------------------------------------------------------------------------------------------------
 */
class Languages extends Element {

	public function __construct() {
		parent::__construct();

		$this->template_name = 'languages';
	}

	public function map() {
		$this->args = array(
			'type'            => 'languages',
			'title'           => esc_html__( 'WPML Languages', 'omniverse' ),
			'text'            => esc_html__( 'Language selectors', 'omniverse' ),
			'icon'            => 'dn-i-translate',
			'editable'        => true,
			'container'       => false,
			'edit_on_create'  => true,
			'drag_target_for' => array(),
			'drag_source'     => 'content_element',
			'removable'       => true,
			'addable'         => true,
			'params'          => array(
				'show_language_flag' => array(
					'id'          => 'show_language_flag',
					'title'       => esc_html__( 'Show Flag', 'omniverse' ),
					'description' => esc_html__( 'Show flag of languages', 'omniverse' ),
					'type'        => 'switcher',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'value'       => true,
				),
				'mouse_event'        => array(
					'id'      => 'mouse_event',
					'title'   => esc_html__( 'Open on mouse event', 'omniverse' ),
					'type'    => 'selector',
					'tab'     => esc_html__( 'General', 'omniverse' ),
					'value'   => 'hover',
					'options' => array(
						'hover' => array(
							'value' => 'hover',
							'label' => esc_html__( 'Hover', 'omniverse' ),
						),
						'click' => array(
							'value' => 'click',
							'label' => esc_html__( 'Click', 'omniverse' ),
						),
					),
				),
				'color_scheme'       => array(
					'id'          => 'color_scheme',
					'title'       => esc_html__( 'Text color scheme', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'value'       => 'dark',
					'options'     => array(
						'dark'  => array(
							'value' => 'dark',
							'label' => esc_html__( 'Dark', 'omniverse' ),
						),
						'light' => array(
							'value' => 'light',
							'label' => esc_html__( 'Light', 'omniverse' ),
						),
					),
					'description' => esc_html__( 'Select different text color scheme depending on your header background.', 'omniverse' ),
				),
			),
		);
	}
}
