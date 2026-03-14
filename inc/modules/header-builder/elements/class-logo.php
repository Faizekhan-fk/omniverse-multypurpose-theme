<?php

namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 * Logo image element
 * ------------------------------------------------------------------------------------------------
 */
class Logo extends Element {

	public function __construct() {
		parent::__construct();
		$this->template_name = 'logo';
	}

	public function map() {
		$this->args = array(
			'type'            => 'logo',
			'title'           => esc_html__( 'Logo', 'omniverse' ),
			'icon'            => 'dn-i-logo',
			'text'            => wp_kses( __( 'Website\'s logo', 'omniverse' ), 'default' ),
			'editable'        => true,
			'container'       => false,
			'edit_on_create'  => true,
			'drag_target_for' => array(),
			'drag_source'     => 'content_element',
			'removable'       => true,
			'addable'         => true,
			'params'          => array(
				'image'         => array(
					'id'          => 'image',
					'title'       => esc_html__( 'Logo image', 'omniverse' ),
					'type'        => 'image',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'value'       => '',
					'description' => '',
				),
				'width'         => array(
					'id'          => 'width',
					'title'       => esc_html__( 'Logo width', 'omniverse' ),
					'type'        => 'slider',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'from'        => 10,
					'to'          => 500,
					'value'       => 150,
					'units'       => 'px',
					'description' => esc_html__( 'Determine the logo image width in pixels. If the overall image aspect ratio is larger than the header row height, further logo width increase will be ignored.', 'omniverse' ),
				),
				'sticky_notice' => array(
					'id'          => 'sticky_notice',
					'description' => esc_html__( 'Optional. You do not have to upload your logo if it is the same as on a regular header. Use this option only if the logo for the sticky header is different or has a different size.', 'omniverse' ),
					'type'        => 'notice',
					'style'       => 'info',
					'tab'         => esc_html__( 'Sticky header', 'omniverse' ),
					'value'       => '',
				),
				'sticky_image'  => array(
					'id'          => 'sticky_image',
					'title'       => esc_html__( 'Logo image for sticky header', 'omniverse' ),
					'hint'        => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb-logo-image-for-sticky-header.mp4" autoplay loop muted></video>',
					'type'        => 'image',
					'tab'         => esc_html__( 'Sticky header', 'omniverse' ),
					'value'       => '',
					'description' => esc_html__( 'Leave empty to use same logo as on the regular header.', 'omniverse' ),
				),
				'sticky_width'  => array(
					'id'          => 'sticky_width',
					'title'       => esc_html__( 'Sticky header logo width', 'omniverse' ),
					'type'        => 'slider',
					'tab'         => esc_html__( 'Sticky header', 'omniverse' ),
					'from'        => 10,
					'to'          => 500,
					'value'       => 150,
					'units'       => 'px',
					'description' => esc_html__( 'Determine the logo on the sticky header image width in pixels.', 'omniverse' ),
				),
				'width_height'  => array(
					'id'          => 'width_height',
					'title'       => esc_html__( 'Add width and height attributes', 'omniverse' ),
					'type'        => 'switcher',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'description' => esc_html__( 'Explicit width and height attributes are recommended to improve page load speed.', 'omniverse' ),
					'value'       => false,
				),
			),
		);
	}
}
