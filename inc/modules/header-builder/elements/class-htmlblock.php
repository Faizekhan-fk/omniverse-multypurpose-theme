<?php
namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 *  HTML Block element
 * ------------------------------------------------------------------------------------------------
 */
class HTMLBlock extends Element {

	public function __construct() {
		parent::__construct();

		$this->template_name = 'html-block';
	}

	public function map() {
		$description = esc_html__( 'Choose which HTML block to display in the header', 'omniverse' );

		if ( function_exists( 'omniverse_get_html_block_links' ) ) {
			$description .= omniverse_get_html_block_links();
		}

		$this->args = array(
			'type'            => 'HTMLBlock',
			'title'           => esc_html__( 'HTML Block', 'omniverse' ),
			'text'            => esc_html__( 'Page builder content', 'omniverse' ),
			'icon'            => 'dn-i-html-block',
			'editable'        => true,
			'container'       => false,
			'edit_on_create'  => true,
			'drag_target_for' => array(),
			'drag_source'     => 'content_element',
			'removable'       => true,
			'addable'         => true,
			'params'          => array(
				'block_id' => array(
					'id'          => 'block_id',
					'title'       => esc_html__( 'HTML Block', 'omniverse' ),
					'type'        => 'select',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'value'       => '',
					'callback'    => 'get_html_block_options',
					'description' => $description,
				),
			),
		);
	}
}
