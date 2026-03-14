<?php

namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 * Text element.
 * ------------------------------------------------------------------------------------------------
 */
class Text extends Element {

	public function __construct() {
		parent::__construct();

		$this->template_name = 'text';
	}

	public function map() {
		$this->args = array(
			'type'            => 'text',
			'title'           => esc_html__( 'Text/HTML', 'omniverse' ),
			'text'            => esc_html__( 'Plain text/HTML', 'omniverse' ),
			'icon'            => 'dn-i-text-html',
			'editable'        => true,
			'container'       => false,
			'edit_on_create'  => true,
			'drag_target_for' => array(),
			'drag_source'     => 'content_element',
			'removable'       => true,
			'addable'         => true,
			'params'          => array(
				'content'   => array(
					'id'          => 'content',
					'title'       => esc_html__( 'Text/HTML content', 'omniverse' ),
					'type'        => 'editor',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'value'       => '',
					'description' => esc_html__( 'Place your text or HTML code with WordPress shortcodes.', 'omniverse' ),
				),
				'inline'    => array(
					'id'          => 'inline',
					'title'       => esc_html__( 'Display inline', 'omniverse' ),
					'type'        => 'switcher',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'value'       => false,
					'description' => esc_html__( 'The width of the element will depend on its content', 'omniverse' ),
				),
				'css_class' => array(
					'id'          => 'css_class',
					'title'       => esc_html__( 'Additional CSS class', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'value'       => '',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
			),
		);
	}
}
