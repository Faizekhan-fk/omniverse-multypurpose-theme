<?php

namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 *  Button element
 * ------------------------------------------------------------------------------------------------
 */
class Button extends Element {

	public function __construct() {
		parent::__construct();

		$this->template_name = 'button';
	}

	public function map() {
		$this->args = array(
			'type'            => 'button',
			'title'           => esc_html__( 'Button', 'omniverse' ),
			'text'            => esc_html__( 'Button with link', 'omniverse' ),
			'icon'            => 'dn-i-button',
			'editable'        => true,
			'container'       => false,
			'edit_on_create'  => true,
			'drag_target_for' => array(),
			'drag_source'     => 'content_element',
			'removable'       => true,
			'addable'         => true,
			'params'          => array(
				'title'                       => array(
					'id'    => 'title',
					'title' => esc_html__( 'Title', 'omniverse' ),
					'tab'   => esc_html__( 'General', 'omniverse' ),
					'group' => esc_html__( 'Content', 'omniverse' ),
					'type'  => 'text',
					'value' => '',
				),
				'link'                        => array(
					'id'    => 'link',
					'title' => esc_html__( 'Link', 'omniverse' ),
					'tab'   => esc_html__( 'General', 'omniverse' ),
					'group' => esc_html__( 'Content', 'omniverse' ),
					'type'  => 'link',
					'value' => array( 'url' => '' ),
				),
				'button_smooth_scroll'        => array(
					'id'          => 'button_smooth_scroll',
					'title'       => esc_html__( 'Smooth scroll', 'omniverse' ),
					'hint'        => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_button_smooth_scroll.mp4" autoplay loop muted></video>',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Extra', 'omniverse' ),
					'type'        => 'switcher',
					'value'       => false,
					'description' => esc_html__( 'When you turn on this option you need to specify this button link with a hash symbol. For example #section-id Then you need to have a section with an ID of "section-id" and this button click will smoothly scroll the page to that section.', 'omniverse' ),
				),
				'button_smooth_scroll_time'   => array(
					'id'          => 'button_smooth_scroll_time',
					'title'       => esc_html__( 'Smooth scroll time (ms)', 'omniverse' ),
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Extra', 'omniverse' ),
					'type'        => 'text',
					'value'       => '',
					'requires'    => array(
						'button_smooth_scroll' => array(
							'comparison' => 'equal',
							'value'      => true,
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'button_smooth_scroll_offset' => array(
					'id'          => 'button_smooth_scroll_offset',
					'title'       => esc_html__( 'Smooth scroll offset (px)', 'omniverse' ),
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Extra', 'omniverse' ),
					'type'        => 'text',
					'value'       => '',
					'requires'    => array(
						'button_smooth_scroll' => array(
							'comparison' => 'equal',
							'value'      => true,
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'el_class'                    => array(
					'id'          => 'el_class',
					'title'       => esc_html__( 'Additional CSS class', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'General', 'omniverse' ),
					'group'       => esc_html__( 'Extra', 'omniverse' ),
					'value'       => '',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
				'style'                       => array(
					'id'      => 'style',
					'title'   => esc_html__( 'Button style', 'omniverse' ),
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'General', 'omniverse' ),
					'type'    => 'selector',
					'value'   => 'default',
					'options' => array(
						'default'  => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => 'default',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/default.png',
						),
						'bordered' => array(
							'label' => esc_html__( 'Bordered', 'omniverse' ),
							'value' => 'bordered',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/bordered.png',
						),
						'link'     => array(
							'label' => esc_html__( 'Link button', 'omniverse' ),
							'value' => 'link',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/link.png',
						),
						'3d'       => array(
							'label' => esc_html__( '3D', 'omniverse' ),
							'value' => '3d',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/3d.png',
						),
					),
				),
				'shape'                       => array(
					'id'       => 'shape',
					'title'    => esc_html__( 'Button shape', 'omniverse' ),
					'tab'      => esc_html__( 'Style', 'omniverse' ),
					'group'    => esc_html__( 'General', 'omniverse' ),
					'type'     => 'selector',
					'value'    => 'rectangle',
					'options'  => array(
						'rectangle'  => array(
							'label' => esc_html__( 'Rectangle', 'omniverse' ),
							'value' => 'rectangle',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/shape/rectangle.jpeg',
						),
						'round'      => array(
							'label' => esc_html__( 'Circle', 'omniverse' ),
							'value' => 'round',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/shape/circle.jpeg',
						),
						'semi-round' => array(
							'label' => esc_html__( 'Round', 'omniverse' ),
							'value' => 'semi-round',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/shape/round.jpeg',
						),
					),
					'requires' => array(
						'style' => array(
							'comparison' => 'not_equal',
							'value'      => array( 'round', 'link' ),
						),
					),
				),
				'size'                        => array(
					'id'      => 'size',
					'title'   => esc_html__( 'Button size', 'omniverse' ),
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'General', 'omniverse' ),
					'type'    => 'select',
					'value'   => 'default',
					'options' => array(
						'default'     => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => 'default',
						),
						'extra-small' => array(
							'label' => esc_html__( 'Extra Small', 'omniverse' ),
							'value' => 'extra-small',
						),
						'small'       => array(
							'label' => esc_html__( 'Small', 'omniverse' ),
							'value' => 'small',
						),
						'large'       => array(
							'label' => esc_html__( 'Large', 'omniverse' ),
							'value' => 'large',
						),
						'extra-large' => array(
							'label' => esc_html__( 'Extra Large', 'omniverse' ),
							'value' => 'extra-large',
						),
					),
				),
				'color'                       => array(
					'id'      => 'color',
					'title'   => esc_html__( 'Predefined button color', 'omniverse' ),
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'Colors', 'omniverse' ),
					'type'    => 'select',
					'value'   => 'default',
					'options' => array(
						'default' => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => 'default',
						),
						'primary' => array(
							'label' => esc_html__( 'Primary color', 'omniverse' ),
							'value' => 'primary',
						),
						'alt'     => array(
							'label' => esc_html__( 'Alternative color', 'omniverse' ),
							'value' => 'alt',
						),
						'white'   => array(
							'label' => esc_html__( 'White', 'omniverse' ),
							'value' => 'white',
						),
						'black'   => array(
							'label' => esc_html__( 'Black', 'omniverse' ),
							'value' => 'black',
						),
					),
				),
				'bg_color'                    => array(
					'id'          => 'bg_color',
					'title'       => esc_html__( 'Background color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Colors', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'extra_class' => 'dn-col-6',
				),
				'bg_color_hover'              => array(
					'id'          => 'bg_color_hover',
					'title'       => esc_html__( 'Background color on hover', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Colors', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'extra_class' => 'dn-col-6',
				),
				'color_scheme'                => array(
					'id'          => 'color_scheme',
					'title'       => esc_html__( 'Text color scheme', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Colors', 'omniverse' ),
					'type'        => 'selector',
					'value'       => 'light',
					'options'     => array(
						'light'  => array(
							'label' => esc_html__( 'Light', 'omniverse' ),
							'value' => 'light',
						),
						'dark'   => array(
							'label' => esc_html__( 'Dark', 'omniverse' ),
							'value' => 'dark',
						),
						'custom' => array(
							'label' => esc_html__( 'Custom', 'omniverse' ),
							'value' => 'custom',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'custom_color_scheme'         => array(
					'id'          => 'custom_color_scheme',
					'title'       => esc_html__( 'Custom text color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Colors', 'omniverse' ),
					'selectors'   => array(
						'{{WRAPPER}}.wd-button-wrapper a' => array(
							'color: {{VALUE}};',
						),
					),
					'type'        => 'color',
					'value'       => '',
					'requires'    => array(
						'color_scheme' => array(
							'comparison' => 'equal',
							'value'      => 'custom',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'color_scheme_divider'        => array(
					'id'    => 'color_scheme_divider',
					'type'  => 'divider',
					'tab'   => esc_html__( 'Style', 'omniverse' ),
					'group' => esc_html__( 'Colors', 'omniverse' ),
					'value' => '',
				),
				'color_scheme_hover'          => array(
					'id'          => 'color_scheme_hover',
					'title'       => esc_html__( 'Text color scheme on hover', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Colors', 'omniverse' ),
					'type'        => 'selector',
					'value'       => 'light',
					'options'     => array(
						'light'  => array(
							'label' => esc_html__( 'Light', 'omniverse' ),
							'value' => 'light',
						),
						'dark'   => array(
							'label' => esc_html__( 'Dark', 'omniverse' ),
							'value' => 'dark',
						),
						'custom' => array(
							'label' => esc_html__( 'Custom', 'omniverse' ),
							'value' => 'custom',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'custom_color_scheme_hover'   => array(
					'id'          => 'custom_color_scheme_hover',
					'title'       => esc_html__( 'Custom text color on hover', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Colors', 'omniverse' ),
					'selectors'   => array(
						'{{WRAPPER}}.wd-button-wrapper a:hover' => array(
							'color: {{VALUE}};',
						),
					),
					'type'        => 'color',
					'value'       => '',
					'requires'    => array(
						'color_scheme_hover' => array(
							'comparison' => 'equal',
							'value'      => 'custom',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_library'                => array(
					'id'          => 'icon_library',
					'title'       => esc_html__( 'Icon library', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Image', 'omniverse' ),
					'type'        => 'select',
					'value'       => 'fontawesome',
					'options'     => array(
						'fontawesome' => array(
							'label' => esc_html__( 'Font Awesome', 'omniverse' ),
							'value' => 'fontawesome',
						),
						'openiconic'  => array(
							'label' => esc_html__( 'Open Iconic', 'omniverse' ),
							'value' => 'openiconic',
						),
						'typicons'    => array(
							'label' => esc_html__( 'Typicons', 'omniverse' ),
							'value' => 'typicons',
						),
						'entypo'      => array(
							'label' => esc_html__( 'Entypo', 'omniverse' ),
							'value' => 'entypo',
						),
						'linecons'    => array(
							'label' => esc_html__( 'Linecons', 'omniverse' ),
							'value' => 'linecons',
						),
						'monosocial'  => array(
							'label' => esc_html__( 'Mono Social', 'omniverse' ),
							'value' => 'monosocial',
						),
						'material'    => array(
							'label' => esc_html__( 'Material', 'omniverse' ),
							'value' => 'material',
						),
					),
					'extra_class' => 'dn-hidden',
				),
				'icon_fontawesome'            => array(
					'id'          => 'icon_fontawesome',
					'title'       => esc_html__( 'Icon', 'omniverse' ),
					'description' => esc_html__( 'Enter the class name of the icon. For example "fas fa-check".', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Image', 'omniverse' ),
					'type'        => 'text',
					'value'       => '',
					'requires'    => array(
						'icon_library' => array(
							'comparison' => 'equal',
							'value'      => 'fontawesome',
						),
					),
					'extra_class' => 'dn-hidden',
				),
				'icon_openiconic'             => array(
					'id'          => 'icon_openiconic',
					'title'       => esc_html__( 'Icon', 'omniverse' ),
					'description' => esc_html__( 'Enter the class name of the icon. For example "oi oi-check".', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Image', 'omniverse' ),
					'type'        => 'text',
					'value'       => '',
					'requires'    => array(
						'icon_library' => array(
							'comparison' => 'equal',
							'value'      => 'openiconic',
						),
					),
					'extra_class' => 'dn-hidden',
				),
				'icon_typicons'               => array(
					'id'          => 'icon_typicons',
					'title'       => esc_html__( 'Icon', 'omniverse' ),
					'description' => esc_html__( 'Enter the class name of the icon. For example "typcn typcn-input-checked".', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Image', 'omniverse' ),
					'type'        => 'text',
					'value'       => '',
					'requires'    => array(
						'icon_library' => array(
							'comparison' => 'equal',
							'value'      => 'typicons',
						),
					),
					'extra_class' => 'dn-hidden',
				),
				'icon_entypo'                 => array(
					'id'          => 'icon_entypo',
					'title'       => esc_html__( 'Icon', 'omniverse' ),
					'description' => esc_html__( 'Enter the class name of the icon. For example "entypo-icon entypo-icon-check".', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Image', 'omniverse' ),
					'type'        => 'text',
					'value'       => '',
					'requires'    => array(
						'icon_library' => array(
							'comparison' => 'equal',
							'value'      => 'entypo',
						),
					),
					'extra_class' => 'dn-hidden',
				),
				'icon_linecons'               => array(
					'id'          => 'icon_linecons',
					'title'       => esc_html__( 'Icon', 'omniverse' ),
					'description' => esc_html__( 'Enter the class name of the icon. For example "vc_li vc_li-star".', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Image', 'omniverse' ),
					'type'        => 'text',
					'value'       => '',
					'requires'    => array(
						'icon_library' => array(
							'comparison' => 'equal',
							'value'      => 'linecons',
						),
					),
					'extra_class' => 'dn-hidden',
				),
				'icon_monosocial'             => array(
					'id'          => 'icon_monosocial',
					'title'       => esc_html__( 'Icon', 'omniverse' ),
					'description' => esc_html__( 'Enter the class name of the icon. For example "vc-mono vc-mono-addme".', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Image', 'omniverse' ),
					'type'        => 'text',
					'value'       => '',
					'requires'    => array(
						'icon_library' => array(
							'comparison' => 'equal',
							'value'      => 'monosocial',
						),
					),
					'extra_class' => 'dn-hidden',
				),
				'icon_material'               => array(
					'id'          => 'icon_material',
					'title'       => esc_html__( 'Icon', 'omniverse' ),
					'description' => esc_html__( 'Enter the class name of the icon. For example "vc-material vc-material-check".', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Image', 'omniverse' ),
					'type'        => 'text',
					'value'       => '',
					'requires'    => array(
						'icon_library' => array(
							'comparison' => 'equal',
							'value'      => 'material',
						),
					),
					'extra_class' => 'dn-hidden',
				),
				'image'                       => array(
					'id'          => 'image',
					'title'       => esc_html__( 'Image', 'omniverse' ),
					'group'       => esc_html__( 'Image', 'omniverse' ),
					'type'        => 'image',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'value'       => '',
					'extra_class' => 'dn-col-6',
				),
				'img_size'                    => array(
					'id'          => 'img_size',
					'title'       => esc_html__( 'Image size', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Image', 'omniverse' ),
					'value'       => '',
					'description' => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'extra_class' => 'dn-col-6',
				),
				'icon_position'               => array(
					'id'      => 'icon_position',
					'title'   => esc_html__( 'Button image position', 'omniverse' ),
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'Image', 'omniverse' ),
					'type'    => 'selector',
					'value'   => 'left',
					'options' => array(
						'left'  => array(
							'label' => esc_html__( 'Left', 'omniverse' ),
							'value' => 'left',
						),
						'right' => array(
							'label' => esc_html__( 'Right', 'omniverse' ),
							'value' => 'right',
						),
					),
				),
			),
		);
	}
}
