<?php

namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 * Simple vertical line
 * ------------------------------------------------------------------------------------------------
 */
class Divider extends Element {

	public function __construct() {
		parent::__construct();

		$this->template_name = 'divider';
	}

	public function map() {
		$this->args = array(
			'type'            => 'divider',
			'title'           => esc_html__( 'Divider', 'omniverse' ),
			'text'            => esc_html__( 'Simple vertical line', 'omniverse' ),
			'icon'            => 'dn-i-divider',
			'editable'        => true,
			'container'       => false,
			'edit_on_create'  => true,
			'drag_target_for' => array(),
			'drag_source'     => 'content_element',
			'removable'       => true,
			'addable'         => true,
			'params'          => array(
				'full_height' => array(
					'id'          => 'full_height',
					'title'       => esc_html__( 'Full height', 'omniverse' ),
					'hint'        => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_divider_full_height.mp4" autoplay loop muted></video>',
					'type'        => 'switcher',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'value'       => false,
					'description' => esc_html__( 'Mark this option if you want to show this divider line on the full height for this row.', 'omniverse' ),
				),
				'css_class'   => array(
					'id'          => 'css_class',
					'title'       => esc_html__( 'Additional CSS class', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'value'       => '',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
			),
		);
	}
}
