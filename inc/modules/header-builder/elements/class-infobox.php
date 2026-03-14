<?php

namespace DN\Modules\Header_Builder\Elements;

use DN\Modules\Header_Builder\Element;

/**
 * ------------------------------------------------------------------------------------------------
 *  Infobox element
 * ------------------------------------------------------------------------------------------------
 */
class Infobox extends Element {

	public function __construct() {
		parent::__construct();
		$this->template_name = 'info-box';
	}

	public function map() {
		$secondary_font = omniverse_get_opt( 'secondary-font' );
		$text_font      = omniverse_get_opt( 'text-font' );
		$primary_font   = omniverse_get_opt( 'primary-font' );

		$secondary_font_title = isset( $secondary_font[0] ) ? esc_html__( 'Secondary font', 'omniverse' ) . ' (' . $secondary_font[0]['font-family'] . ')' : esc_html__( 'Secondary font', 'omniverse' );
		$text_font_title      = isset( $text_font[0] ) ? esc_html__( 'Text font', 'omniverse' ) . ' (' . $text_font[0]['font-family'] . ')' : esc_html__( 'Text', 'omniverse' );
		$primary_font_title   = isset( $primary_font[0] ) ? esc_html__( 'Title font', 'omniverse' ) . ' (' . $primary_font[0]['font-family'] . ')' : esc_html__( 'Title font', 'omniverse' );

		$this->args = array(
			'type'            => 'infobox',
			'title'           => esc_html__( 'Information box', 'omniverse' ),
			'text'            => esc_html__( 'Text with icon', 'omniverse' ),
			'icon'            => 'dn-i-alert-info',
			'editable'        => true,
			'container'       => false,
			'edit_on_create'  => true,
			'drag_target_for' => array(),
			'drag_source'     => 'content_element',
			'removable'       => true,
			'addable'         => true,
			'params'          => array(
				'icon_type'                   => array(
					'id'          => 'icon_type',
					'title'       => esc_html__( 'Icon type', 'omniverse' ),
					'tab'         => esc_html__( 'Content', 'omniverse' ),
					'description' => esc_html__( 'You can display icon based on image or just write some text like 01., 02., M, X etc.', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'selector',
					'value'       => 'icon',
					'options'     => array(
						'icon' => array(
							'label' => esc_html__( 'Icon', 'omniverse' ),
							'value' => 'icon',
						),
						'text' => array(
							'label' => esc_html__( 'Text', 'omniverse' ),
							'value' => 'text',
						),
					),
				),
				'icon_text'                   => array(
					'id'       => 'icon_text',
					'title'    => esc_html__( 'Icon text', 'omniverse' ),
					'type'     => 'text',
					'tab'      => esc_html__( 'Content', 'omniverse' ),
					'group'    => esc_html__( 'Icon', 'omniverse' ),
					'value'    => '',
					'requires' => array(
						'icon_type' => array(
							'comparison' => 'equal',
							'value'      => 'text',
						),
					),
				),
				'image'                       => array(
					'id'          => 'image',
					'title'       => esc_html__( 'Image', 'omniverse' ),
					'type'        => 'image',
					'tab'         => esc_html__( 'Content', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'value'       => '',
					'requires'    => array(
						'icon_type' => array(
							'comparison' => 'equal',
							'value'      => 'icon',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'img_size'                    => array(
					'id'          => 'img_size',
					'title'       => esc_html__( 'Image size', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'Content', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'description' => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'value'       => '',
					'requires'    => array(
						'icon_type' => array(
							'comparison' => 'equal',
							'value'      => 'icon',
						),
					),
					'extra_class' => 'dn-col-6',
				),

				'subtitle'                    => array(
					'id'    => 'subtitle',
					'title' => esc_html__( 'Subtitle text', 'omniverse' ),
					'type'  => 'textarea',
					'tab'   => esc_html__( 'Content', 'omniverse' ),
					'group' => esc_html__( 'Content', 'omniverse' ),
					'value' => '',
				),
				'title'                       => array(
					'id'    => 'title',
					'title' => esc_html__( 'Title text', 'omniverse' ),
					'type'  => 'textarea',
					'tab'   => esc_html__( 'Content', 'omniverse' ),
					'group' => esc_html__( 'Content', 'omniverse' ),
					'value' => '',
				),
				'content'                     => array(
					'id'    => 'content',
					'title' => esc_html__( 'Content', 'omniverse' ),
					'type'  => 'editor',
					'tab'   => esc_html__( 'Content', 'omniverse' ),
					'group' => esc_html__( 'Content', 'omniverse' ),
					'value' => '',
				),
				'btn_text'                    => array(
					'id'    => 'btn_text',
					'title' => esc_html__( 'Button text', 'omniverse' ),
					'type'  => 'text',
					'tab'   => esc_html__( 'Content', 'omniverse' ),
					'group' => esc_html__( 'Content', 'omniverse' ),
					'value' => '',
				),
				'link'                        => array(
					'id'    => 'link',
					'title' => esc_html__( 'Link', 'omniverse' ),
					'type'  => 'link',
					'tab'   => esc_html__( 'Content', 'omniverse' ),
					'group' => esc_html__( 'Content', 'omniverse' ),
					'value' => '',
				),
				'el_class'                    => array(
					'id'          => 'el_class',
					'title'       => esc_html__( 'Additional CSS class', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'Content', 'omniverse' ),
					'group'       => esc_html__( 'Extra', 'omniverse' ),
					'value'       => '',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),

				'style'                       => array(
					'id'      => 'style',
					'title'   => esc_html__( 'Box style', 'omniverse' ),
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'General', 'omniverse' ),
					'type'    => 'select',
					'value'   => 'base',
					'options' => array(
						'base'     => array(
							'label' => esc_html__( 'Base', 'omniverse' ),
							'value' => 'base',
						),
						'border'   => array(
							'label' => esc_html__( 'Bordered', 'omniverse' ),
							'value' => 'border',
						),
						'shadow'   => array(
							'label' => esc_html__( 'Shadow', 'omniverse' ),
							'value' => 'shadow',
						),
						'bg-hover' => array(
							'label' => esc_html__( 'Background on hover', 'omniverse' ),
							'value' => 'bg-hover',
						),
					),
				),
				'omniverse_color_scheme'       => array(
					'id'          => 'omniverse_color_scheme',
					'title'       => esc_html__( 'Color scheme', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'General', 'omniverse' ),
					'type'        => 'selector',
					'value'       => '',
					'options'     => array(
						''      => array(
							'label' => esc_html__( 'Inherit', 'omniverse' ),
							'value' => '',
						),
						'light' => array(
							'label' => esc_html__( 'Light', 'omniverse' ),
							'value' => 'light',
						),
						'dark'  => array(
							'label' => esc_html__( 'Dark', 'omniverse' ),
							'value' => 'dark',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'omniverse_hover_color_scheme' => array(
					'id'          => 'omniverse_hover_color_scheme',
					'title'       => esc_html__( 'Color scheme on hover', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'General', 'omniverse' ),
					'type'        => 'selector',
					'value'       => 'light',
					'options'     => array(
						'light' => array(
							'label' => esc_html__( 'Light', 'omniverse' ),
							'value' => 'light',
						),
						'dark'  => array(
							'label' => esc_html__( 'Dark', 'omniverse' ),
							'value' => 'dark',
						),
					),
					'requires'    => array(
						'style' => array(
							'comparison' => 'equal',
							'value'      => 'bg-hover',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'alignment'                   => array(
					'id'      => 'alignment',
					'title'   => esc_html__( 'Text alignment', 'omniverse' ),
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'General', 'omniverse' ),
					'type'    => 'selector',
					'value'   => 'left',
					'options' => array(
						'left'   => array(
							'label' => esc_html__( 'Left', 'omniverse' ),
							'value' => 'left',
						),
						'center' => array(
							'label' => esc_html__( 'Center', 'omniverse' ),
							'value' => 'center',
						),
						'right'  => array(
							'label' => esc_html__( 'Right', 'omniverse' ),
							'value' => 'right',
						),
					),
				),
				'bg_color'                    => array(
					'id'        => 'bg_color',
					'title'     => esc_html__( 'Background color', 'omniverse' ),
					'tab'       => esc_html__( 'Style', 'omniverse' ),
					'group'     => esc_html__( 'Background', 'omniverse' ),
					'type'      => 'color',
					'value'     => '',
					'selectors' => array(
						'{{WRAPPER}} .wd-info-box' => array(
							'background-color: {{VALUE}};',
						),
					),
				),
				'bg_image_box'                => array(
					'id'          => 'bg_image_box',
					'title'       => esc_html__( 'Background image', 'omniverse' ),
					'type'        => 'image',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Background', 'omniverse' ),
					'value'       => '',
					'extra_class' => 'dn-col-6',
				),
				'bg_image_box_size'           => array(
					'id'          => 'bg_image_box_size',
					'title'       => esc_html__( 'Background image size', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Background', 'omniverse' ),
					'description' => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'value'       => '',
					'extra_class' => 'dn-col-6',
				),
				'bg_image_box_position'       => array(
					'id'          => 'bg_image_box_position',
					'title'       => esc_html__( 'Background position', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Background', 'omniverse' ),
					'type'        => 'select',
					'value'       => '',
					'options'     => array(
						''              => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => '',
						),
						'center center' => array(
							'label' => esc_html__( 'Center Center', 'omniverse' ),
							'value' => 'center center',
						),
						'center left'   => array(
							'label' => esc_html__( 'Center Left', 'omniverse' ),
							'value' => 'center left',
						),
						'center right'  => array(
							'label' => esc_html__( 'Center Right', 'omniverse' ),
							'value' => 'center right',
						),
						'top center'    => array(
							'label' => esc_html__( 'Top Center', 'omniverse' ),
							'value' => 'top center',
						),
						'top left'      => array(
							'label' => esc_html__( 'Top Left', 'omniverse' ),
							'value' => 'top left',
						),
						'top right'     => array(
							'label' => esc_html__( 'Top Right', 'omniverse' ),
							'value' => 'top right',
						),
						'bottom center' => array(
							'label' => esc_html__( 'Bottom Center', 'omniverse' ),
							'value' => 'bottom center',
						),
						'bottom left'   => array(
							'label' => esc_html__( 'Bottom Left', 'omniverse' ),
							'value' => 'bottom left',
						),
						'bottom right'  => array(
							'label' => esc_html__( 'Bottom Right', 'omniverse' ),
							'value' => 'bottom right',
						),
					),
					'extra_class' => 'dn-col-6',
					'requires'    => array(
						'bg_image_box' => array(
							'comparison' => 'not_equal',
							'value'      => '',
						),
					),
				),
				'bg_image_box_repeat'         => array(
					'id'          => 'bg_image_box_repeat',
					'title'       => esc_html__( 'Background repeat', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Background', 'omniverse' ),
					'type'        => 'select',
					'value'       => '',
					'options'     => array(
						''          => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => '',
						),
						'no-repeat' => array(
							'label' => esc_html__( 'No-repeat', 'omniverse' ),
							'value' => 'no-repeat',
						),
						'repeat'    => array(
							'label' => esc_html__( 'Repeat', 'omniverse' ),
							'value' => 'repeat',
						),
						'repeat-x'  => array(
							'label' => esc_html__( 'Repeat-x', 'omniverse' ),
							'value' => 'repeat-x',
						),
						'repeat-y'  => array(
							'label' => esc_html__( 'Repeat-x', 'omniverse' ),
							'value' => 'repeat-y',
						),
					),
					'requires'    => array(
						'bg_image_box' => array(
							'comparison' => 'not_equal',
							'value'      => '',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'bg_image_box_sizes'          => array(
					'id'          => 'bg_image_box_sizes',
					'title'       => esc_html__( 'Background size', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Background', 'omniverse' ),
					'type'        => 'select',
					'value'       => '',
					'options'     => array(
						''        => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => '',
						),
						'cover'   => array(
							'label' => esc_html__( 'Cover', 'omniverse' ),
							'value' => 'cover',
						),
						'contain' => array(
							'label' => esc_html__( 'Contain', 'omniverse' ),
							'value' => 'contain',
						),
					),
					'requires'    => array(
						'bg_image_box' => array(
							'comparison' => 'not_equal',
							'value'      => '',
						),
					),
					'extra_class' => 'dn-col-6',
				),

				'bg_hover_color'              => array(
					'id'        => 'bg_hover_color',
					'title'     => esc_html__( 'Background color on hover', 'omniverse' ),
					'tab'       => esc_html__( 'Style', 'omniverse' ),
					'group'     => esc_html__( 'Background', 'omniverse' ),
					'type'      => 'color',
					'value'     => '',
					'selectors' => array(
						'{{WRAPPER}} .wd-info-box:after' => array(
							'background-color: {{VALUE}};',
						),
					),
					'requires'  => array(
						'style' => array(
							'comparison' => 'equal',
							'value'      => 'bg-hover',
						),
					),
				),
				'bg_hover_image'              => array(
					'id'          => 'bg_hover_image',
					'title'       => esc_html__( 'Background image  on hover', 'omniverse' ),
					'type'        => 'image',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Background', 'omniverse' ),
					'value'       => '',
					'requires'    => array(
						'style' => array(
							'comparison' => 'equal',
							'value'      => 'bg-hover',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'bg_hover_image_size'         => array(
					'id'          => 'bg_hover_image_size',
					'title'       => esc_html__( 'Background image on hover size', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Background', 'omniverse' ),
					'description' => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'value'       => '',
					'requires'    => array(
						'style' => array(
							'comparison' => 'equal',
							'value'      => 'bg-hover',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'bg_hover_image_position'     => array(
					'id'          => 'bg_hover_image_position',
					'title'       => esc_html__( 'Background position', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Background', 'omniverse' ),
					'type'        => 'select',
					'value'       => '',
					'options'     => array(
						''              => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => '',
						),
						'center center' => array(
							'label' => esc_html__( 'Center Center', 'omniverse' ),
							'value' => 'center center',
						),
						'center left'   => array(
							'label' => esc_html__( 'Center Left', 'omniverse' ),
							'value' => 'center left',
						),
						'center right'  => array(
							'label' => esc_html__( 'Center Right', 'omniverse' ),
							'value' => 'center right',
						),
						'top center'    => array(
							'label' => esc_html__( 'Top Center', 'omniverse' ),
							'value' => 'top center',
						),
						'top left'      => array(
							'label' => esc_html__( 'Top Left', 'omniverse' ),
							'value' => 'top left',
						),
						'top right'     => array(
							'label' => esc_html__( 'Top Right', 'omniverse' ),
							'value' => 'top right',
						),
						'bottom center' => array(
							'label' => esc_html__( 'Bottom Center', 'omniverse' ),
							'value' => 'bottom center',
						),
						'bottom left'   => array(
							'label' => esc_html__( 'Bottom Left', 'omniverse' ),
							'value' => 'bottom left',
						),
						'bottom right'  => array(
							'label' => esc_html__( 'Bottom Right', 'omniverse' ),
							'value' => 'bottom right',
						),
					),
					'requires'    => array(
						'style' => array(
							'comparison' => 'equal',
							'value'      => 'bg-hover',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'bg_hover_image_repeat'       => array(
					'id'          => 'bg_hover_image_repeat',
					'title'       => esc_html__( 'Background repeat', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Background', 'omniverse' ),
					'type'        => 'select',
					'value'       => '',
					'options'     => array(
						''          => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => '',
						),
						'no-repeat' => array(
							'label' => esc_html__( 'No-repeat', 'omniverse' ),
							'value' => 'no-repeat',
						),
						'repeat'    => array(
							'label' => esc_html__( 'Repeat', 'omniverse' ),
							'value' => 'repeat',
						),
						'repeat-x'  => array(
							'label' => esc_html__( 'Repeat-x', 'omniverse' ),
							'value' => 'repeat-x',
						),
						'repeat-y'  => array(
							'label' => esc_html__( 'Repeat-x', 'omniverse' ),
							'value' => 'repeat-y',
						),
					),
					'requires'    => array(
						'style' => array(
							'comparison' => 'equal',
							'value'      => 'bg-hover',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'bg_hover_image_sizes'        => array(
					'id'          => 'bg_hover_image_sizes',
					'title'       => esc_html__( 'Background size', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Background', 'omniverse' ),
					'type'        => 'select',
					'value'       => '',
					'options'     => array(
						''        => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => '',
						),
						'cover'   => array(
							'label' => esc_html__( 'Cover', 'omniverse' ),
							'value' => 'cover',
						),
						'contain' => array(
							'label' => esc_html__( 'Contain', 'omniverse' ),
							'value' => 'contain',
						),
					),
					'requires'    => array(
						'style' => array(
							'comparison' => 'equal',
							'value'      => 'bg-hover',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'image_alignment'             => array(
					'id'          => 'image_alignment',
					'title'       => esc_html__( 'Alignment', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'selector',
					'value'       => 'top',
					'options'     => array(
						'left'  => array(
							'label' => esc_html__( 'Left', 'omniverse' ),
							'value' => 'left',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/left.png',
						),
						'top'   => array(
							'label' => esc_html__( 'Top', 'omniverse' ),
							'value' => 'top',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/top.png',
						),
						'right' => array(
							'label' => esc_html__( 'Right', 'omniverse' ),
							'value' => 'right',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/position/right.png',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'image_vertical_alignment'    => array(
					'id'          => 'image_vertical_alignment',
					'title'       => esc_html__( 'Vertical alignment', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'selector',
					'value'       => 'top',
					'options'     => array(
						'top'    => array(
							'label' => esc_html__( 'Top', 'omniverse' ),
							'value' => 'top',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/vertical-position/top.png',
						),
						'middle' => array(
							'label' => esc_html__( 'Middle', 'omniverse' ),
							'value' => 'middle',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/vertical-position/middle.png',
						),
						'bottom' => array(
							'label' => esc_html__( 'Bottom', 'omniverse' ),
							'value' => 'bottom',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/vertical-position/bottom.png',
						),
					),
					'requires'    => array(
						'image_alignment' => array(
							'comparison' => 'equal',
							'value'      => array( 'left', 'right' ),
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_style'                  => array(
					'id'      => 'icon_style',
					'title'   => esc_html__( 'Style', 'omniverse' ),
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'Icon', 'omniverse' ),
					'type'    => 'selector',
					'value'   => 'simple',
					'options' => array(
						'simple'      => array(
							'label' => esc_html__( 'Simple', 'omniverse' ),
							'value' => 'simple',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/style/simple.png',
						),
						'with-bg'     => array(
							'label' => esc_html__( 'With background', 'omniverse' ),
							'value' => 'with-bg',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/style/with-bg.png',
						),
						'with-border' => array(
							'label' => esc_html__( 'With border', 'omniverse' ),
							'value' => 'with-border',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/style/with-border.png',
						),
					),
				),
				'icon_bg_color'               => array(
					'id'          => 'icon_bg_color',
					'title'       => esc_html__( 'Background color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}} .info-box-icon' => array(
							'background-color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'icon_style' => array(
							'comparison' => 'equal',
							'value'      => 'with-bg',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_bg_hover_color'         => array(
					'id'          => 'icon_bg_hover_color',
					'title'       => esc_html__( 'Background color on hover', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}} .info-box-icon:hover' => array(
							'background-color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'icon_style' => array(
							'comparison' => 'equal',
							'value'      => 'with-bg',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_border_color'           => array(
					'id'          => 'icon_border_color',
					'title'       => esc_html__( 'Border color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}} .info-box-icon' => array(
							'border-color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'icon_style' => array(
							'comparison' => 'equal',
							'value'      => 'with-border',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_border_hover_color'     => array(
					'id'          => 'icon_border_hover_color',
					'title'       => esc_html__( 'Border color on hover', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}} .info-box-icon:hover' => array(
							'border-color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'icon_style' => array(
							'comparison' => 'equal',
							'value'      => 'with-border',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_text_size'              => array(
					'id'          => 'icon_text_size',
					'title'       => esc_html__( 'Text size', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'select',
					'value'       => 'default',
					'options'     => array(
						'default' => array(
							'label' => esc_html__( 'Default (52px)', 'omniverse' ),
							'value' => 'default',
						),
						'small'   => array(
							'label' => esc_html__( 'Small (38px)', 'omniverse' ),
							'value' => 'small',
						),
						'large'   => array(
							'label' => esc_html__( 'Large (74px)', 'omniverse' ),
							'value' => 'large',
						),
					),
					'requires'    => array(
						'icon_type' => array(
							'comparison' => 'equal',
							'value'      => 'text',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_text_color'             => array(
					'id'          => 'icon_text_color',
					'title'       => esc_html__( 'Text color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Icon', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}} .box-with-text' => array(
							'color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'icon_type' => array(
							'comparison' => 'equal',
							'value'      => 'text',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'icon_spacing'                => array(
					'id'        => 'icon_spacing',
					'title'     => esc_html__( 'Spacing', 'omniverse' ),
					'type'      => 'slider',
					'tab'       => esc_html__( 'Style', 'omniverse' ),
					'group'     => esc_html__( 'Icon', 'omniverse' ),
					'from'      => 5,
					'to'        => 50,
					'value'     => 10,
					'units'     => 'px',
					'selectors' => array(
						'{{WRAPPER}}.info-box-wrapper div.wd-info-box' => array(
							'--ib-icon-sp: {{VALUE}}px;',
						),
					),
				),

				'subtitle_style'              => array(
					'id'          => 'subtitle_style',
					'title'       => esc_html__( 'Style', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Subtitle', 'omniverse' ),
					'type'        => 'selector',
					'value'       => 'default',
					'options'     => array(
						'default'    => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => 'default',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/subtitle-style/default.png',
						),
						'background' => array(
							'label' => esc_html__( 'Background', 'omniverse' ),
							'value' => 'background',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/subtitle-style/background.png',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'subtitle_custom_bg_color'    => array(
					'id'          => 'subtitle_custom_bg_color',
					'title'       => esc_html__( 'Background color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Subtitle', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}} .info-box-subtitle' => array(
							'background-color: {{VALUE}};',
						),
					),
					'requires'    => array(
						'subtitle_style' => array(
							'comparison' => 'equal',
							'value'      => 'background',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'subtitle_style_divider'      => array(
					'id'    => 'subtitle_style_divider',
					'type'  => 'divider',
					'tab'   => esc_html__( 'Style', 'omniverse' ),
					'group' => esc_html__( 'Subtitle', 'omniverse' ),
					'value' => '',
				),
				'subtitle_color'              => array(
					'id'          => 'subtitle_color',
					'title'       => esc_html__( 'Predefined color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Subtitle', 'omniverse' ),
					'type'        => 'select',
					'value'       => 'default',
					'options'     => array(
						'default' => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => 'default',
						),
						'primary' => array(
							'label' => esc_html__( 'Primary', 'omniverse' ),
							'value' => 'primary',
						),
						'alt'     => array(
							'label' => esc_html__( 'Alternative', 'omniverse' ),
							'value' => 'alt',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'subtitle_custom_color'       => array(
					'id'          => 'subtitle_custom_color',
					'title'       => esc_html__( 'Custom color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Subtitle', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}} .info-box-subtitle' => array(
							'color: {{VALUE}};',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'subtitle_font'               => array(
					'id'          => 'subtitle_font',
					'title'       => esc_html__( 'Font family', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Subtitle', 'omniverse' ),
					'type'        => 'select',
					'value'       => '',
					'options'     => array(
						''        => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => '',
						),
						'text'    => array(
							'label' => $text_font_title,
							'value' => 'text',
						),
						'primary' => array(
							'label' => $primary_font_title,
							'value' => 'primary',
						),
						'alt'     => array(
							'label' => $secondary_font_title,
							'value' => 'alt',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'subtitle_font_weight'        => array(
					'id'          => 'subtitle_font_weight',
					'title'       => esc_html__( 'Font weight', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Subtitle', 'omniverse' ),
					'type'        => 'select',
					'value'       => '',
					'options'     => array(
						''  => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => '',
						),
						100 => array(
							'label' => esc_html__( 'Ultra-Light 100', 'omniverse' ),
							'value' => 100,
						),
						200 => array(
							'label' => esc_html__( 'Light 200', 'omniverse' ),
							'value' => 200,
						),
						300 => array(
							'label' => esc_html__( 'Book 300', 'omniverse' ),
							'value' => 300,
						),
						400 => array(
							'label' => esc_html__( 'Normal 400', 'omniverse' ),
							'value' => 400,
						),
						500 => array(
							'label' => esc_html__( 'Medium 500', 'omniverse' ),
							'value' => 500,
						),
						600 => array(
							'label' => esc_html__( 'Semi-Bold 600', 'omniverse' ),
							'value' => 600,
						),
						700 => array(
							'label' => esc_html__( 'Bold 700', 'omniverse' ),
							'value' => 700,
						),
						800 => array(
							'label' => esc_html__( 'Extra-Bold 800', 'omniverse' ),
							'value' => 800,
						),
						900 => array(
							'label' => esc_html__( 'Ultra-Bold 900', 'omniverse' ),
							'value' => 900,
						),
					),
					'selectors'   => array(
						'{{WRAPPER}} .info-box-subtitle' => array(
							'font-weight: {{VALUE}};',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'subtitle_font_size'          => array(
					'id'          => 'subtitle_font_size',
					'title'       => esc_html__( 'Font size', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Subtitle', 'omniverse' ),
					'selectors'   => array(
						'{{WRAPPER}} .info-box-subtitle' => array(
							'font-size: {{VALUE}};',
						),
					),
					'description' => esc_html__( 'Insert value including units. For example: "14px" or "1.5em".', 'omniverse' ),
					'value'       => '',
					'extra_class' => 'dn-col-6',
				),
				'subtitle_line_height'        => array(
					'id'          => 'subtitle_line_height',
					'title'       => esc_html__( 'Line height', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Subtitle', 'omniverse' ),
					'selectors'   => array(
						'{{WRAPPER}} .wd-info-box .info-box-content .info-box-subtitle' => array(
							'line-height: {{VALUE}};',
						),
					),
					'value'       => '',
					'description' => esc_html__( 'Insert default or reletive value. For example: "14px" or "1.2".', 'omniverse' ),
					'extra_class' => 'dn-col-6',
				),

				'title_style'                 => array(
					'id'          => 'title_style',
					'title'       => esc_html__( 'Style', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Title', 'omniverse' ),
					'type'        => 'selector',
					'value'       => 'default',
					'options'     => array(
						'default'    => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => 'default',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/title-style/default.png',
						),
						'underlined' => array(
							'label' => esc_html__( 'Underline', 'omniverse' ),
							'value' => 'underlined',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/infobox/title-style/underlined.png',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'title_color'                 => array(
					'id'          => 'title_color',
					'title'       => esc_html__( 'Color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Title', 'omniverse' ),
					'type'        => 'color',
					'value'       => '',
					'selectors'   => array(
						'{{WRAPPER}} .info-box-title' => array(
							'color: {{VALUE}};',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'title_font'                  => array(
					'id'          => 'title_font',
					'title'       => esc_html__( 'Font family', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Title', 'omniverse' ),
					'type'        => 'select',
					'value'       => '',
					'options'     => array(
						''        => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => '',
						),
						'text'    => array(
							'label' => $text_font_title,
							'value' => 'text',
						),
						'primary' => array(
							'label' => $primary_font_title,
							'value' => 'primary',
						),
						'alt'     => array(
							'label' => $secondary_font_title,
							'value' => 'alt',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'title_font_weight'           => array(
					'id'          => 'title_font_weight',
					'title'       => esc_html__( 'Font weight', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Title', 'omniverse' ),
					'type'        => 'select',
					'value'       => '',
					'options'     => array(
						''  => array(
							'label' => esc_html__( 'Default', 'omniverse' ),
							'value' => '',
						),
						100 => array(
							'label' => esc_html__( 'Ultra-Light 100', 'omniverse' ),
							'value' => 100,
						),
						200 => array(
							'label' => esc_html__( 'Light 200', 'omniverse' ),
							'value' => 200,
						),
						300 => array(
							'label' => esc_html__( 'Book 300', 'omniverse' ),
							'value' => 300,
						),
						400 => array(
							'label' => esc_html__( 'Normal 400', 'omniverse' ),
							'value' => 400,
						),
						500 => array(
							'label' => esc_html__( 'Medium 500', 'omniverse' ),
							'value' => 500,
						),
						600 => array(
							'label' => esc_html__( 'Semi-Bold 600', 'omniverse' ),
							'value' => 600,
						),
						700 => array(
							'label' => esc_html__( 'Bold 700', 'omniverse' ),
							'value' => 700,
						),
						800 => array(
							'label' => esc_html__( 'Extra-Bold 800', 'omniverse' ),
							'value' => 800,
						),
						900 => array(
							'label' => esc_html__( 'Ultra-Bold 900', 'omniverse' ),
							'value' => 900,
						),
					),
					'selectors'   => array(
						'{{WRAPPER}} .info-box-title' => array(
							'font-weight: {{VALUE}};',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'title_size'                  => array(
					'id'          => 'title_size',
					'title'       => esc_html__( 'Predefined font size', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Title', 'omniverse' ),
					'type'        => 'select',
					'value'       => 'default',
					'options'     => array(
						'default'     => array(
							'label' => esc_html__( 'Default (18px)', 'omniverse' ),
							'value' => 'default',
						),
						'small'       => array(
							'label' => esc_html__( 'Small (16px)', 'omniverse' ),
							'value' => 'small',
						),
						'large'       => array(
							'label' => esc_html__( 'Large (26px)', 'omniverse' ),
							'value' => 'primary',
						),
						'extra-large' => array(
							'label' => esc_html__( 'Extra Large (36px)', 'omniverse' ),
							'value' => 'extra-large',
						),
					),
					'extra_class' => 'dn-col-6',
				),
				'title_font_size'             => array(
					'id'          => 'title_font_size',
					'title'       => esc_html__( 'Font size', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Title', 'omniverse' ),
					'selectors'   => array(
						'{{WRAPPER}} .info-box-title' => array(
							'font-size: {{VALUE}};',
						),
					),
					'value'       => '',
					'description' => esc_html__( 'Insert value including units. For example: "14px" or "1.5em".', 'omniverse' ),
					'extra_class' => 'dn-col-6',
				),
				'title_line_height'           => array(
					'id'          => 'title_line_height',
					'title'       => esc_html__( 'Line height', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Title', 'omniverse' ),
					'selectors'   => array(
						'{{WRAPPER}} .wd-info-box .info-box-title' => array(
							'line-height: {{VALUE}};',
						),
					),
					'value'       => '',
					'extra_class' => 'dn-col-6',
					'description' => esc_html__( 'Insert default or reletive value. For example: "14px" or "1.2".', 'omniverse' ),
				),
				'title_tag'                   => array(
					'id'          => 'title_tag',
					'title'       => esc_html__( 'Tag', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Title', 'omniverse' ),
					'type'        => 'select',
					'value'       => 'h4',
					'options'     => array(
						'h1'   => array(
							'label' => 'h1',
							'value' => 'h1',
						),
						'h2'   => array(
							'label' => 'h2',
							'value' => 'h2',
						),
						'h3'   => array(
							'label' => 'h3',
							'value' => 'h3',
						),
						'h4'   => array(
							'label' => 'h4',
							'value' => 'h4',
						),
						'h5'   => array(
							'label' => 'h5',
							'value' => 'h5',
						),
						'h6'   => array(
							'label' => 'h6',
							'value' => 'h6',
						),
						'p'    => array(
							'label' => 'p',
							'value' => 'p',
						),
						'div'  => array(
							'label' => 'div',
							'value' => 'div',
						),
						'span' => array(
							'label' => 'span',
							'value' => 'span',
						),
					),
					'extra_class' => 'dn-col-6',
				),

				'custom_text_color'           => array(
					'id'        => 'custom_text_color',
					'title'     => esc_html__( 'Text Color', 'omniverse' ),
					'tab'       => esc_html__( 'Style', 'omniverse' ),
					'group'     => esc_html__( 'Content', 'omniverse' ),
					'type'      => 'color',
					'value'     => '',
					'selectors' => array(
						'{{WRAPPER}} .info-box-inner' => array(
							'color: {{VALUE}};',
						),
					),
				),
				'content_font_size'           => array(
					'id'          => 'content_font_size',
					'title'       => esc_html__( 'Font size', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Content', 'omniverse' ),
					'description' => esc_html__( 'Insert value including units. For example: "14px" or "1.5em".', 'omniverse' ),
					'selectors'   => array(
						'{{WRAPPER}} .info-box-inner' => array(
							'font-size: {{VALUE}};',
						),
					),
					'value'       => '',
					'extra_class' => 'dn-col-6',
				),
				'content_line_height'         => array(
					'id'          => 'content_line_height',
					'title'       => esc_html__( 'Line height', 'omniverse' ),
					'type'        => 'text',
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Content', 'omniverse' ),
					'description' => esc_html__( 'Insert default or reletive value. For example: "14px" or "1.2".', 'omniverse' ),
					'selectors'   => array(
						'{{WRAPPER}} .info-box-inner' => array(
							'line-height: {{VALUE}};',
						),
					),
					'value'       => '',
					'extra_class' => 'dn-col-6',
				),

				'btn_style'                   => array(
					'id'      => 'btn_style',
					'title'   => esc_html__( 'Style', 'omniverse' ),
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'Button', 'omniverse' ),
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

				'btn_shape'                   => array(
					'id'       => 'btn_shape',
					'title'    => esc_html__( 'Shape', 'omniverse' ),
					'tab'      => esc_html__( 'Style', 'omniverse' ),
					'group'    => esc_html__( 'Button', 'omniverse' ),
					'type'     => 'selector',
					'value'    => 'rectangle',
					'options'  => array(
						'rectangle'  => array(
							'label' => esc_html__( 'Rectangle', 'omniverse' ),
							'value' => 'rectangle',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/shape/rectangle.jpeg',
						),
						'round'      => array(
							'label' => esc_html__( 'Round', 'omniverse' ),
							'value' => 'round',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/shape/circle.jpeg',
						),
						'semi-round' => array(
							'label' => esc_html__( 'Rounded', 'omniverse' ),
							'value' => 'semi-round',
							'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/shape/round.jpeg',
						),
					),
					'requires' => array(
						'btn_style' => array(
							'comparison' => 'not_equal',
							'value'      => 'link',
						),
					),
				),
				'btn_size'                    => array(
					'id'          => 'btn_size',
					'title'       => esc_html__( 'Predefined size', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Button', 'omniverse' ),
					'type'        => 'select',
					'value'       => 'default',
					'options'     => array(
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
					'extra_class' => 'dn-col-6',
				),
				'btn_color'                   => array(
					'id'          => 'btn_color',
					'title'       => esc_html__( 'Predefined color', 'omniverse' ),
					'tab'         => esc_html__( 'Style', 'omniverse' ),
					'group'       => esc_html__( 'Button', 'omniverse' ),
					'type'        => 'select',
					'value'       => 'default',
					'options'     => array(
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
					'extra_class' => 'dn-col-6',
				),
				'btn_position'                => array(
					'id'      => 'btn_position',
					'title'   => esc_html__( 'Button position', 'omniverse' ),
					'tab'     => esc_html__( 'Style', 'omniverse' ),
					'group'   => esc_html__( 'Button', 'omniverse' ),
					'type'    => 'select',
					'value'   => 'hover',
					'options' => array(
						'hover'  => array(
							'label' => esc_html__( 'Show on hover', 'omniverse' ),
							'value' => 'hover',
						),
						'static' => array(
							'label' => esc_html__( 'Static', 'omniverse' ),
							'value' => 'static',
						),
					),
				),
			),
		);
	}
}
