<?php
namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 *  Basic structure element - row
 * ------------------------------------------------------------------------------------------------
 */
class Row extends Element {

	public function __construct() {
		parent::__construct();

		$this->template_name = 'row';
	}

	public function map() {
		$this->args = array(
			'type'            => 'row',
			'title'           => esc_html__( 'Row', 'omniverse' ),
			'text'            => esc_html__( 'Row', 'omniverse' ),
			'editable'        => true,
			'container'       => false,
			'edit_on_create'  => false,
			'drag_target_for' => array(),
			'drag_source'     => '',
			'removable'       => false,
			'addable'         => false,
			'it_works'        => 'row',
			'class'           => '',
			'content'         => array(),
			'params'          => array(
				'row_columns'   => array(
					'id'      => 'row_columns',
					'title'   => esc_html__( 'Row columns', 'omniverse' ),
					'type'    => 'selector',
					'tab'     => esc_html__( 'General', 'omniverse' ),
					'group'   => esc_html__( 'Layout', 'omniverse' ),
					'value'   => '3',
					'options' => array(
						'1' => array(
							'label' => 1,
							'value' => '1',
						),
						'3' => array(
							'label' => 3,
							'value' => '3',
						),
					),
				),
				'flex_layout'   => array(
					'id'          => 'flex_layout',
					'title'       => esc_html__( 'Row flex layout', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Layout', 'omniverse' ),
					'value'       => 'flex-middle',
					'options'     => array(
						'flex-middle' => array(
							'label' => esc_html__( 'Flexible middle column', 'omniverse' ),
							'value' => 'flex-middle',
							'image' => OMNIVERSE_ASSETS . '/images/header-builder/header-layout-2.jpg',
						),
						'equal-sides' => array(
							'label' => esc_html__( 'Equal right and left columns', 'omniverse' ),
							'value' => 'equal-sides',
							'image' => OMNIVERSE_ASSETS . '/images/header-builder/header-layout-1.jpg',
						),
					),
					'description' => wp_kses( __( 'Determine the "flex layout" for this row. More information about both options read in our <a href="https://zynxsol.com/docs/omniverse/header-builder/header-rows-flex-layouts/" target="_blank">documentation here</a>.', 'omniverse' ), 'default' ),
					'requires'    => array(
						'row_columns' => array(
							'comparison' => 'equal',
							'value'      => '3',
						),
					),
				),
				'height'        => array(
					'id'          => 'height',
					'title'       => esc_html__( 'Row height', 'omniverse' ),
					'type'        => 'slider',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Height', 'omniverse' ),
					'from'        => 0,
					'to'          => 200,
					'value'       => 50,
					'units'       => 'px',
					'description' => esc_html__( 'Determine the header height value in pixels.', 'omniverse' ),
				),
				'mobile_height' => array(
					'id'          => 'mobile_height',
					'title'       => esc_html__( 'Row height on mobile devices', 'omniverse' ),
					'type'        => 'slider',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Height', 'omniverse' ),
					'from'        => 0,
					'to'          => 200,
					'value'       => 40,
					'units'       => 'px',
					'description' => esc_html__( 'Determine the header height for mobile devices value in pixels.', 'omniverse' ),
				),
				'hide_desktop'  => array(
					'id'          => 'hide_desktop',
					'title'       => esc_html__( 'Hide on desktop', 'omniverse' ),
					'type'        => 'switcher',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Responsive', 'omniverse' ),
					'value'       => false,
					'description' => esc_html__( 'Disable this row for desktop devices.', 'omniverse' ),
					'extra_class' => 'dn-col-6',
				),
				'hide_mobile'   => array(
					'id'          => 'hide_mobile',
					'title'       => esc_html__( 'Hide on mobile', 'omniverse' ),
					'type'        => 'switcher',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Responsive', 'omniverse' ),
					'value'       => false,
					'description' => esc_html__( 'Disable this row for mobile devices.', 'omniverse' ),
					'extra_class' => 'dn-col-6',
				),
				'sticky'        => array(
					'id'          => 'sticky',
					'title'       => esc_html__( 'Make it sticky', 'omniverse' ),
					'hint'        => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_row_sticky.mp4" autoplay loop muted></video>',
					'type'        => 'switcher',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Sticky', 'omniverse' ),
					'value'       => false,
					'description' => esc_html__( 'The following option will not work if "Sticky header clone" is enabled in header settings.', 'omniverse' ),
				),
				'sticky_height' => array(
					'id'          => 'sticky_height',
					'title'       => esc_html__( 'Row height on sticky header', 'omniverse' ),
					'type'        => 'slider',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Sticky', 'omniverse' ),
					'from'        => 0,
					'to'          => 200,
					'value'       => 60,
					'units'       => 'px',
					'description' => esc_html__( 'Determine the header height for sticky header value in pixels.', 'omniverse' ),
					'requires'    => array(
						'sticky' => array(
							'comparison' => 'equal',
							'value'      => true,
						),
					),
				),
				'color_scheme'  => array(
					'id'          => 'color_scheme',
					'title'       => esc_html__( 'Text color scheme', 'omniverse' ),
					'type'        => 'selector',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Colors', 'omniverse' ),
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
					'description' => esc_html__( 'Select different text color scheme depending on your background.', 'omniverse' ),
				),
				'background'    => array(
					'id'          => 'background',
					'group'       => esc_html__( 'Colors', 'omniverse' ),
					'type'        => 'bg',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'value'       => '',
					'description' => '',
				),
				'border'        => array(
					'id'              => 'border',
					'group'           => esc_html__( 'Border bottom', 'omniverse' ),
					'type'            => 'border',
					'sides'           => array( 'bottom' ),
					'tab'             => esc_html__( 'Style', 'omniverse' ),
					'colorpicker_top' => true,
					'container'       => true,
					'value'           => '',
					'description'     => esc_html__( 'Set border bottom for this header row.', 'omniverse' ),
				),
				'shadow'        => array(
					'id'          => 'shadow',
					'title'       => esc_html__( 'Shadow', 'omniverse' ),
					'type'        => 'switcher',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Shadow', 'omniverse' ),
					'value'       => false,
					'description' => esc_html__( 'Add shadow to the header section.', 'omniverse' ),
				),
			),
		);
	}
}
