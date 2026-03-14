<?php

namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 * Social buttons element
 * ------------------------------------------------------------------------------------------------
 */
class Social extends Element {

	public function __construct() {
		parent::__construct();

		$this->template_name = 'social';
	}

	public function map() {
		$this->args = array(
			'type'            => 'social',
			'title'           => esc_html__( 'Social links icons', 'omniverse' ),
			'text'            => esc_html__( 'Social links icons', 'omniverse' ),
			'icon'            => 'dn-i-social',
			'editable'        => true,
			'container'       => false,
			'edit_on_create'  => true,
			'drag_target_for' => array(),
			'drag_source'     => 'content_element',
			'removable'       => true,
			'addable'         => true,
			'params'          => array(
				'type'     => array(
					'id'      => 'type',
					'title'   => esc_html__( 'Buttons type', 'omniverse' ),
					'tab'     => esc_html__( 'General', 'omniverse' ),
					'type'    => 'selector',
					'value'   => 'share',
					'options' => array(
						'share'  => array(
							'label' => esc_html__( 'Share', 'omniverse' ),
							'value' => 'share',
						),
						'follow' => array(
							'label' => esc_html__( 'Follow', 'omniverse' ),
							'value' => 'follow',
						),
					),
				),
				'el_class' => array(
					'id'          => 'el_class',
					'title'       => esc_html__( 'Additional CSS class', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'value'       => '',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
				'style'    => array(
					'id'      => 'style',
					'title'   => esc_html__( 'Button style', 'omniverse' ),
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'Icons', 'omniverse' ),
					'type'    => 'selector',
					'value'   => 'default',
					'options' => array(
						'default'     => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => 'default',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/style/default.png',
						),
						'simple'      => array(
							'label' => esc_html__( 'Simple', 'omniverse' ),
							'value' => 'simple',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/style/simple.png',
						),
						'colored'     => array(
							'label' => esc_html__( 'Colored', 'omniverse' ),
							'value' => 'colored',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/style/colored.png',
						),
						'colored-alt' => array(
							'label' => esc_html__( 'Colored alternative', 'omniverse' ),
							'value' => 'colored-alt',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/style/colored-alt.png',
						),
						'bordered'    => array(
							'label' => esc_html__( 'Bordered', 'omniverse' ),
							'value' => 'bordered',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/style/bordered.png',
						),
						'primary'     => array(
							'label' => esc_html__( 'Primary color', 'omniverse' ),
							'value' => 'primary',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/style/primary.png',
						),
					),
				),
				'form'     => array(
					'id'      => 'form',
					'title'   => esc_html__( 'Button form', 'omniverse' ),
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'Icons', 'omniverse' ),
					'type'    => 'selector',
					'value'   => 'circle',
					'options' => array(
						'circle'  => array(
							'label' => esc_html__( 'Circle', 'omniverse' ),
							'value' => 'circle',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/shape/circle.png',
						),
						'square'  => array(
							'label' => esc_html__( 'Square', 'omniverse' ),
							'value' => 'square',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/shape/square.png',
						),
						'rounded' => array(
							'label' => esc_html__( 'Rounded', 'omniverse' ),
							'value' => 'rounded',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/social-buttons/shape/rounded.png',
						),
					),
				),
				'size'     => array(
					'id'      => 'size',
					'title'   => esc_html__( 'Button size', 'omniverse' ),
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'Icons', 'omniverse' ),
					'type'    => 'select',
					'value'   => '',
					'options' => array(
						''      => array(
							'label' => esc_html__( 'Default (18px)', 'omniverse' ),
							'value' => '',
						),
						'small' => array(
							'label' => esc_html__( 'Small (14px)', 'omniverse' ),
							'value' => 'small',
						),
						'large' => array(
							'label' => esc_html__( 'Large (22px)', 'omniverse' ),
							'value' => 'large',
						),
					),
				),
				'color'    => array(
					'id'      => 'color',
					'title'   => esc_html__( 'Color', 'omniverse' ),
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'Icons', 'omniverse' ),
					'type'    => 'selector',
					'value'   => 'dark',
					'options' => array(
						'dark'  => array(
							'label' => esc_html__( 'Dark', 'omniverse' ),
							'value' => 'dark',
						),
						'light' => array(
							'label' => esc_html__( 'Light', 'omniverse' ),
							'value' => 'light',
						),
					),
				),
			),
		);
	}
}
