<?php
/**
 * Slider metaboxes
 *
 * @package dn
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use DN\Admin\Modules\Options\Metaboxes;

if ( ! function_exists( 'omniverse_register_slider_metaboxes' ) ) {
	/**
	 * Register slider metaboxes
	 *
	 * @since 1.0.0
	 */
	function omniverse_register_slider_metaboxes() {
		$slide_metabox = Metaboxes::add_metabox(
			array(
				'id'         => 'zs_slide_metaboxes',
				'title'      => esc_html__( 'Slide Settings', 'omniverse' ),
				'post_types' => array( 'omniverse_slide' ),
			)
		);

		$slide_metabox->add_section(
			array(
				'id'       => 'slide_content',
				'name'     => esc_html__( 'Layout', 'omniverse' ),
				'icon'     => 'dn-i-layout',
				'priority' => 10,
			)
		);

		$slide_metabox->add_section(
			array(
				'id'       => 'image_settings',
				'name'     => esc_html__( 'Background', 'omniverse' ),
				'icon'     => 'dn-i-image',
				'priority' => 20,
			)
		);

		$slide_metabox->add_section(
			array(
				'id'       => 'slide_link',
				'name'     => esc_html__( 'Settings', 'omniverse' ),
				'icon'     => 'dn-i-setting-slider-in-square',
				'priority' => 30,
			)
		);

		$slide_metabox->add_field(
			array(
				'id'        => 'bg_color',
				'name'      => esc_html__( 'Color', 'omniverse' ),
				'type'      => 'color',
				'section'   => 'image_settings',
				'default'   => '#fefefe',
				'data_type' => 'hex',
				'priority'  => 19,
			)
		);

		// Desktop.
		$slide_metabox->add_field(
			array(
				'id'       => 'bg_image_desktop',
				'name'     => esc_html__( 'Background image', 'omniverse' ),
				'type'     => 'upload',
				'section'  => 'image_settings',
				'requires' => array(
					array(
						'key'     => 'slide_image_settings_tab',
						'compare' => 'equals',
						'value'   => 'desktop',
					),
				),
				't_tab'    => array(
					'id'    => 'settings_tabs',
					'tab'   => esc_html__( 'Desktop', 'omniverse' ),
					'title' => esc_html__( 'Image', 'omniverse' ),
					'style' => 'default',
				),
				'priority' => 20,
				'class'    => 'dn-tab-field',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'           => 'bg_image_size_desktop',
				'name'         => esc_html__( 'Background size', 'omniverse' ),
				'type'         => 'select',
				'empty_option' => true,
				'select2'      => true,
				'section'      => 'image_settings',
				'options'      => array(
					'cover'   => array(
						'name'  => esc_html__( 'Cover', 'omniverse' ),
						'value' => 'cover',
					),
					'contain' => array(
						'name'  => esc_html__( 'Contain', 'omniverse' ),
						'value' => 'contain',
					),
				),
				'default'      => 'cover',
				't_tab'        => array(
					'id'   => 'settings_tabs',
					'icon' => 'dn-i-desktop',
					'tab'  => esc_html__( 'Desktop', 'omniverse' ),
				),
				'priority'     => 30,
				'class'        => 'dn-tab-field dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'           => 'bg_image_position_desktop',
				'name'         => esc_html__( 'Background position', 'omniverse' ),
				'type'         => 'select',
				'empty_option' => true,
				'select2'      => true,
				'section'      => 'image_settings',
				'options'      => array(
					'left-top'      => array(
						'name'  => esc_html__( 'Left Top', 'omniverse' ),
						'value' => 'left top',
					),
					'left-center'   => array(
						'name'  => esc_html__( 'Left Center', 'omniverse' ),
						'value' => 'left center',
					),
					'left-bottom'   => array(
						'name'  => esc_html__( 'Left Bottom', 'omniverse' ),
						'value' => 'left bottom',
					),
					'center-top'    => array(
						'name'  => esc_html__( 'Center Top', 'omniverse' ),
						'value' => 'center top',
					),
					'center-center' => array(
						'name'  => esc_html__( 'Center Center', 'omniverse' ),
						'value' => 'center center',
					),
					'center-bottom' => array(
						'name'  => esc_html__( 'Center Bottom', 'omniverse' ),
						'value' => 'center bottom',
					),
					'right-top'     => array(
						'name'  => esc_html__( 'Right Top', 'omniverse' ),
						'value' => 'right top',
					),
					'right-center'  => array(
						'name'  => esc_html__( 'Right Center', 'omniverse' ),
						'value' => 'right center',
					),
					'right-bottom'  => array(
						'name'  => esc_html__( 'Right Bottom', 'omniverse' ),
						'value' => 'right bottom',
					),
					'custom'        => array(
						'name'  => esc_html__( 'Custom', 'omniverse' ),
						'value' => 'custom',
					),
				),
				'default'      => 'center center',
				't_tab'        => array(
					'id'   => 'settings_tabs',
					'icon' => 'dn-i-desktop',
					'tab'  => esc_html__( 'Desktop', 'omniverse' ),
				),
				'priority'     => 40,
				'class'        => 'dn-tab-field dn-last-tab-field dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'       => 'bg_image_position_x_desktop',
				'type'     => 'text_input',
				'name'     => esc_html__( 'Position by X (px)', 'omniverse' ),
				'section'  => 'image_settings',
				'requires' => array(
					array(
						'key'     => 'bg_image_position_desktop',
						'compare' => 'equals',
						'value'   => 'custom',
					),
				),
				't_tab'    => array(
					'id'   => 'settings_tabs',
					'icon' => 'dn-i-desktop',
					'tab'  => esc_html__( 'Desktop', 'omniverse' ),
				),
				'priority' => 50,
				'class'    => 'dn-tab-field dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'       => 'bg_image_position_y_desktop',
				'type'     => 'text_input',
				'name'     => esc_html__( 'Position by Y (px)', 'omniverse' ),
				'section'  => 'image_settings',
				'requires' => array(
					array(
						'key'     => 'bg_image_position_desktop',
						'compare' => 'equals',
						'value'   => 'custom',
					),
				),
				't_tab'    => array(
					'id'   => 'settings_tabs',
					'icon' => 'dn-i-desktop',
					'tab'  => esc_html__( 'Desktop', 'omniverse' ),
				),
				'priority' => 60,
				'class'    => 'dn-tab-field dn-last-tab-field dn-col-6',
			)
		);

		// Tablet.
		$slide_metabox->add_field(
			array(
				'id'       => 'bg_image_tablet',
				'name'     => esc_html__( 'Background image', 'omniverse' ),
				'type'     => 'upload',
				'section'  => 'image_settings',
				'requires' => array(
					array(
						'key'     => 'slide_image_settings_tab',
						'compare' => 'equals',
						'value'   => 'tablet',
					),
				),
				't_tab'    => array(
					'id'   => 'settings_tabs',
					'icon' => 'dn-i-tablet',
					'tab'  => esc_html__( 'Tablet', 'omniverse' ),
				),
				'priority' => 80,
				'class'    => 'dn-tab-field',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'           => 'bg_image_size_tablet',
				'name'         => esc_html__( 'Background size', 'omniverse' ),
				'type'         => 'select',
				'empty_option' => true,
				'select2'      => true,
				'section'      => 'image_settings',
				'options'      => array(
					'cover'   => array(
						'name'  => esc_html__( 'Cover', 'omniverse' ),
						'value' => 'cover',
					),
					'contain' => array(
						'name'  => esc_html__( 'Contain', 'omniverse' ),
						'value' => 'contain',
					),
					'inherit' => array(
						'name'  => esc_html__( 'Inherit', 'omniverse' ),
						'value' => 'inherit',
					),
				),
				't_tab'        => array(
					'id'   => 'settings_tabs',
					'icon' => 'dn-i-tablet',
					'tab'  => esc_html__( 'Tablet', 'omniverse' ),
				),
				'priority'     => 90,
				'class'        => 'dn-tab-field dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'           => 'bg_image_position_tablet',
				'name'         => esc_html__( 'Background position', 'omniverse' ),
				'type'         => 'select',
				'empty_option' => true,
				'select2'      => true,
				'section'      => 'image_settings',
				'options'      => array(
					'left-top'      => array(
						'name'  => esc_html__( 'Left Top', 'omniverse' ),
						'value' => 'left top',
					),
					'left-center'   => array(
						'name'  => esc_html__( 'Left Center', 'omniverse' ),
						'value' => 'left center',
					),
					'left-bottom'   => array(
						'name'  => esc_html__( 'Left Bottom', 'omniverse' ),
						'value' => 'left bottom',
					),
					'center-top'    => array(
						'name'  => esc_html__( 'Center Top', 'omniverse' ),
						'value' => 'center top',
					),
					'center-center' => array(
						'name'  => esc_html__( 'Center Center', 'omniverse' ),
						'value' => 'center center',
					),
					'center-bottom' => array(
						'name'  => esc_html__( 'Center Bottom', 'omniverse' ),
						'value' => 'center bottom',
					),
					'right-top'     => array(
						'name'  => esc_html__( 'Right Top', 'omniverse' ),
						'value' => 'right top',
					),
					'right-center'  => array(
						'name'  => esc_html__( 'Right Center', 'omniverse' ),
						'value' => 'right center',
					),
					'right-bottom'  => array(
						'name'  => esc_html__( 'Right Bottom', 'omniverse' ),
						'value' => 'right bottom',
					),
					'custom'        => array(
						'name'  => esc_html__( 'Custom', 'omniverse' ),
						'value' => 'custom',
					),
				),
				't_tab'        => array(
					'id'   => 'settings_tabs',
					'icon' => 'dn-i-tablet',
					'tab'  => esc_html__( 'Tablet', 'omniverse' ),
				),
				'priority'     => 100,
				'class'        => 'dn-tab-field dn-last-tab-field dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'       => 'bg_image_position_x_tablet',
				'type'     => 'text_input',
				'name'     => esc_html__( 'Position by X (px)', 'omniverse' ),
				'section'  => 'image_settings',
				'requires' => array(
					array(
						'key'     => 'bg_image_position_tablet',
						'compare' => 'equals',
						'value'   => 'custom',
					),
				),
				't_tab'    => array(
					'id'   => 'settings_tabs',
					'icon' => 'dn-i-tablet',
					'tab'  => esc_html__( 'Tablet', 'omniverse' ),
				),
				'priority' => 110,
				'class'    => 'dn-tab-field dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'       => 'bg_image_position_y_tablet',
				'type'     => 'text_input',
				'name'     => esc_html__( 'Position by Y (px)', 'omniverse' ),
				'section'  => 'image_settings',
				'requires' => array(
					array(
						'key'     => 'bg_image_position_tablet',
						'compare' => 'equals',
						'value'   => 'custom',
					),
				),
				't_tab'    => array(
					'id'   => 'settings_tabs',
					'icon' => 'dn-i-tablet',
					'tab'  => esc_html__( 'Tablet', 'omniverse' ),
				),
				'priority' => 120,
				'class'    => 'dn-tab-field dn-last-tab-field dn-col-6',
			)
		);

		// Mobile.
		$slide_metabox->add_field(
			array(
				'id'       => 'bg_image_mobile',
				'name'     => esc_html__( 'Background image', 'omniverse' ),
				'type'     => 'upload',
				'section'  => 'image_settings',
				't_tab'    => array(
					'id'   => 'settings_tabs',
					'icon' => 'dn-i-phone',
					'tab'  => esc_html__( 'Mobile', 'omniverse' ),
				),
				'priority' => 140,
				'class'    => 'dn-tab-field',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'           => 'bg_image_size_mobile',
				'name'         => esc_html__( 'Background size', 'omniverse' ),
				'type'         => 'select',
				'empty_option' => true,
				'select2'      => true,
				'section'      => 'image_settings',
				'options'      => array(
					'cover'   => array(
						'name'  => esc_html__( 'Cover', 'omniverse' ),
						'value' => 'cover',
					),
					'contain' => array(
						'name'  => esc_html__( 'Contain', 'omniverse' ),
						'value' => 'contain',
					),
					'inherit' => array(
						'name'  => esc_html__( 'Inherit', 'omniverse' ),
						'value' => 'inherit',
					),
				),
				't_tab'        => array(
					'id'   => 'settings_tabs',
					'icon' => 'dn-i-phone',
					'tab'  => esc_html__( 'Mobile', 'omniverse' ),
				),
				'priority'     => 150,
				'class'        => 'dn-tab-field dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'           => 'bg_image_position_mobile',
				'name'         => esc_html__( 'Background position', 'omniverse' ),
				'type'         => 'select',
				'empty_option' => true,
				'select2'      => true,
				'section'      => 'image_settings',
				'options'      => array(
					'left-top'      => array(
						'name'  => esc_html__( 'Left Top', 'omniverse' ),
						'value' => 'left top',
					),
					'left-center'   => array(
						'name'  => esc_html__( 'Left Center', 'omniverse' ),
						'value' => 'left center',
					),
					'left-bottom'   => array(
						'name'  => esc_html__( 'Left Bottom', 'omniverse' ),
						'value' => 'left bottom',
					),
					'center-top'    => array(
						'name'  => esc_html__( 'Center Top', 'omniverse' ),
						'value' => 'center top',
					),
					'center-center' => array(
						'name'  => esc_html__( 'Center Center', 'omniverse' ),
						'value' => 'center center',
					),
					'center-bottom' => array(
						'name'  => esc_html__( 'Center Bottom', 'omniverse' ),
						'value' => 'center bottom',
					),
					'right-top'     => array(
						'name'  => esc_html__( 'Right Top', 'omniverse' ),
						'value' => 'right top',
					),
					'right-center'  => array(
						'name'  => esc_html__( 'Right Center', 'omniverse' ),
						'value' => 'right center',
					),
					'right-bottom'  => array(
						'name'  => esc_html__( 'Right Bottom', 'omniverse' ),
						'value' => 'right bottom',
					),
					'custom'        => array(
						'name'  => esc_html__( 'Custom', 'omniverse' ),
						'value' => 'custom',
					),
				),
				't_tab'        => array(
					'id'   => 'settings_tabs',
					'icon' => 'dn-i-phone',
					'tab'  => esc_html__( 'Mobile', 'omniverse' ),
				),
				'priority'     => 160,
				'class'        => 'dn-tab-field dn-last-tab-field dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'       => 'bg_image_position_x_mobile',
				'type'     => 'text_input',
				'name'     => esc_html__( 'Position by X (px)', 'omniverse' ),
				'section'  => 'image_settings',
				'requires' => array(
					array(
						'key'     => 'bg_image_position_mobile',
						'compare' => 'equals',
						'value'   => 'custom',
					),
				),
				't_tab'    => array(
					'id'  => 'settings_tabs',
					'tab' => esc_html__( 'Mobile', 'omniverse' ),
				),
				'priority' => 170,
				'class'    => 'dn-tab-field dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'       => 'bg_image_position_y_mobile',
				'type'     => 'text_input',
				'name'     => esc_html__( 'Position by Y (px)', 'omniverse' ),
				'section'  => 'image_settings',
				'requires' => array(
					array(
						'key'     => 'bg_image_position_mobile',
						'compare' => 'equals',
						'value'   => 'custom',
					),
				),
				't_tab'    => array(
					'id'   => 'settings_tabs',
					'icon' => 'dn-i-phone',
					'tab'  => esc_html__( 'Mobile', 'omniverse' ),
				),
				'priority' => 180,
				'class'    => 'dn-tab-field dn-last-tab-field dn-col-6',
			)
		);

		// General.
		$slide_metabox->add_field(
			array(
				'id'          => 'content_without_padding',
				'type'        => 'checkbox',
				'name'        => esc_html__( 'Content no space', 'omniverse' ),
				'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'content-without-padding.mp4" autoplay loop muted></video>',
				'description' => esc_html__( 'The content block will not have any paddings', 'omniverse' ),
				'section'     => 'slide_content',
				'priority'    => 10,
			)
		);

		$slide_metabox->add_field(
			array(
				'id'          => 'content_full_width',
				'type'        => 'checkbox',
				'name'        => esc_html__( 'Full width content', 'omniverse' ),
				'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'content-full-width.mp4" autoplay loop muted></video>',
				'description' => esc_html__( 'Takes the slider\'s width', 'omniverse' ),
				'section'     => 'slide_content',
				'priority'    => 20,
			)
		);

		$slide_metabox->add_field(
			array(
				'id'          => 'content_width',
				'name'        => esc_html__( 'Content width', 'omniverse' ),
				'description' => esc_html__( 'Set your value in pixels.', 'omniverse' ),
				'type'        => 'range',
				'min'         => '100',
				'max'         => '1200',
				'step'        => '5',
				'default'     => '1200',
				'section'     => 'slide_content',
				'requires'    => array(
					array(
						'key'     => 'content_full_width',
						'compare' => 'not_equals',
						'value'   => 'on',
					),
				),
				't_tab'       => array(
					'id'       => 'slide_content_width_tabs',
					'tab'      => esc_html__( 'Desktop', 'omniverse' ),
					'icon'     => 'dn-i-desktop',
					'style'    => 'devices',
					'requires' => array(
						array(
							'key'     => 'content_full_width',
							'compare' => 'not_equals',
							'value'   => 'on',
						),
					),
				),
				'priority'    => 30,
				'unit'        => 'px',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'          => 'content_width_tablet',
				'name'        => esc_html__( 'Content width', 'omniverse' ),
				'description' => esc_html__( 'Set your value in pixels.', 'omniverse' ),
				'type'        => 'range',
				'min'         => '100',
				'max'         => '1200',
				'step'        => '5',
				'default'     => '1200',
				'section'     => 'slide_content',
				'requires'    => array(
					array(
						'key'     => 'content_full_width',
						'compare' => 'not_equals',
						'value'   => 'on',
					),
				),
				't_tab'       => array(
					'id'   => 'slide_content_width_tabs',
					'tab'  => esc_html__( 'Tablet', 'omniverse' ),
					'icon' => 'dn-i-tablet',
				),
				'priority'    => 40,
				'unit'        => 'px',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'          => 'content_width_mobile',
				'name'        => esc_html__( 'Content width', 'omniverse' ),
				'description' => esc_html__( 'Set your value in pixels.', 'omniverse' ),
				'type'        => 'range',
				'min'         => '50',
				'max'         => '800',
				'step'        => '5',
				'default'     => '500',
				'section'     => 'slide_content',
				'requires'    => array(
					array(
						'key'     => 'content_full_width',
						'compare' => 'not_equals',
						'value'   => 'on',
					),
				),
				't_tab'       => array(
					'id'   => 'slide_content_width_tabs',
					'tab'  => esc_html__( 'Mobile', 'omniverse' ),
					'icon' => 'dn-i-phone',
				),
				'priority'    => 50,
				'unit'        => 'px',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'       => 'vertical_align',
				'name'     => esc_html__( 'Vertical content align', 'omniverse' ),
				'type'     => 'buttons',
				'default'  => 'middle',
				'section'  => 'slide_content',
				'options'  => array(
					'top'    => array(
						'name'  => esc_html__( 'Top', 'omniverse' ),
						'value' => 'top',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/top.jpg',
					),
					'middle' => array(
						'name'  => esc_html__( 'Middle', 'omniverse' ),
						'value' => 'middle',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/middle.jpg',
					),
					'bottom' => array(
						'name'  => esc_html__( 'Bottom', 'omniverse' ),
						'value' => 'bottom',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/bottom.jpg',
					),
				),
				't_tab'    => array(
					'id'    => 'content_settings_tabs',
					'tab'   => esc_html__( 'Desktop', 'omniverse' ),
					'title' => esc_html__( 'Content position', 'omniverse' ),
					'icon'  => 'dn-i-desktop',
					'style' => 'default',
				),
				'priority' => 191,
				'class'    => 'dn-tab-field dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'       => 'horizontal_align',
				'name'     => esc_html__( 'Horizontal content align', 'omniverse' ),
				'type'     => 'buttons',
				'section'  => 'slide_content',
				'options'  => array(
					'left'   => array(
						'name'  => esc_html__( 'Left', 'omniverse' ),
						'value' => 'left',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/left.jpg',
					),
					'center' => array(
						'name'  => esc_html__( 'Center', 'omniverse' ),
						'value' => 'center',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/center.jpg',
					),
					'right'  => array(
						'name'  => esc_html__( 'Right', 'omniverse' ),
						'value' => 'right',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/right.jpg',
					),
				),
				't_tab'    => array(
					'id'   => 'content_settings_tabs',
					'tab'  => esc_html__( 'Desktop', 'omniverse' ),
					'icon' => 'dn-i-desktop',
				),
				'default'  => 'left',
				'priority' => 192,
				'class'    => 'dn-tab-field dn-last-tab-field dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'       => 'vertical_align_tablet',
				'name'     => esc_html__( 'Vertical content align', 'omniverse' ),
				'type'     => 'buttons',
				'section'  => 'slide_content',
				'options'  => array(
					'top'    => array(
						'name'  => esc_html__( 'Top', 'omniverse' ),
						'value' => 'top',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/top.jpg',
					),
					'middle' => array(
						'name'  => esc_html__( 'Middle', 'omniverse' ),
						'value' => 'middle',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/middle.jpg',
					),
					'bottom' => array(
						'name'  => esc_html__( 'Bottom', 'omniverse' ),
						'value' => 'bottom',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/bottom.jpg',
					),
				),
				't_tab'    => array(
					'id'   => 'content_settings_tabs',
					'tab'  => esc_html__( 'Tablet', 'omniverse' ),
					'icon' => 'dn-i-tablet',
				),
				'priority' => 193,
				'class'    => 'dn-tab-field dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'       => 'horizontal_align_tablet',
				'name'     => esc_html__( 'Horizontal content align', 'omniverse' ),
				'type'     => 'buttons',
				'section'  => 'slide_content',
				'options'  => array(
					'left'   => array(
						'name'  => esc_html__( 'Left', 'omniverse' ),
						'value' => 'left',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/left.jpg',
					),
					'center' => array(
						'name'  => esc_html__( 'Center', 'omniverse' ),
						'value' => 'center',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/center.jpg',
					),
					'right'  => array(
						'name'  => esc_html__( 'Right', 'omniverse' ),
						'value' => 'right',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/right.jpg',
					),
				),
				't_tab'    => array(
					'id'   => 'content_settings_tabs',
					'tab'  => esc_html__( 'Tablet', 'omniverse' ),
					'icon' => 'dn-i-tablet',
				),
				'priority' => 194,
				'class'    => 'dn-tab-field dn-last-tab-field dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'       => 'vertical_align_mobile',
				'name'     => esc_html__( 'Vertical content align', 'omniverse' ),
				'type'     => 'buttons',
				'section'  => 'slide_content',
				'options'  => array(
					'top'    => array(
						'name'  => esc_html__( 'Top', 'omniverse' ),
						'value' => 'top',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/top.jpg',
					),
					'middle' => array(
						'name'  => esc_html__( 'Middle', 'omniverse' ),
						'value' => 'middle',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/middle.jpg',
					),
					'bottom' => array(
						'name'  => esc_html__( 'Bottom', 'omniverse' ),
						'value' => 'bottom',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/bottom.jpg',
					),
				),
				't_tab'    => array(
					'id'   => 'content_settings_tabs',
					'tab'  => esc_html__( 'Mobile', 'omniverse' ),
					'icon' => 'dn-i-phone',
				),
				'priority' => 195,
				'class'    => 'dn-tab-field dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'       => 'horizontal_align_mobile',
				'name'     => esc_html__( 'Horizontal content align', 'omniverse' ),
				'type'     => 'buttons',
				'section'  => 'slide_content',
				'options'  => array(
					'left'   => array(
						'name'  => esc_html__( 'Left', 'omniverse' ),
						'value' => 'left',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/left.jpg',
					),
					'center' => array(
						'name'  => esc_html__( 'Center', 'omniverse' ),
						'value' => 'center',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/center.jpg',
					),
					'right'  => array(
						'name'  => esc_html__( 'Right', 'omniverse' ),
						'value' => 'right',
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/cmb2-align/right.jpg',
					),
				),
				't_tab'    => array(
					'id'   => 'content_settings_tabs',
					'tab'  => esc_html__( 'Mobile', 'omniverse' ),
					'icon' => 'dn-i-phone',
				),
				'priority' => 196,
				'class'    => 'dn-tab-field dn-last-tab-field dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'           => 'slide_animation',
				'name'         => esc_html__( 'Animation', 'omniverse' ),
				'description'  => esc_html__( 'Select a content appearance animation', 'omniverse' ),
				'type'         => 'select',
				'section'      => 'slide_link',
				'group'        => esc_html__( 'Animation', 'omniverse' ),
				'options'      => array(
					'none'              => array(
						'name'  => esc_html__( 'None', 'omniverse' ),
						'value' => 'none',
					),
					'slide-from-top'    => array(
						'name'  => esc_html__( 'Slide from top', 'omniverse' ),
						'value' => 'slide-from-top',
					),
					'slide-from-bottom' => array(
						'name'  => esc_html__( 'Slide from bottom', 'omniverse' ),
						'value' => 'slide-from-bottom',
					),
					'slide-from-right'  => array(
						'name'  => esc_html__( 'Slide from right', 'omniverse' ),
						'value' => 'slide-from-right',
					),
					'slide-from-left'   => array(
						'name'  => esc_html__( 'Slide from left', 'omniverse' ),
						'value' => 'slide-from-left',
					),
					'top-flip-x'        => array(
						'name'  => esc_html__( 'Top flip X', 'omniverse' ),
						'value' => 'top-flip-x',
					),
					'bottom-flip-x'     => array(
						'name'  => esc_html__( 'Bottom flip X', 'omniverse' ),
						'value' => 'bottom-flip-x',
					),
					'right-flip-y'      => array(
						'name'  => esc_html__( 'Right flip Y', 'omniverse' ),
						'value' => 'right-flip-y',
					),
					'left-flip-y'       => array(
						'name'  => esc_html__( 'Left flip Y', 'omniverse' ),
						'value' => 'left-flip-y',
					),
					'zoom-in'           => array(
						'name'  => esc_html__( 'Zoom in', 'omniverse' ),
						'value' => 'zoom-in',
					),
				),
				'is_animation' => true,
				'priority'     => 230,
			)
		);

		$slide_metabox->add_field(
			array(
				'id'          => 'link',
				'type'        => 'text_input',
				'name'        => esc_html__( 'Link', 'omniverse' ),
				'description' => esc_html__( 'Add URL to make whole slide clickable. Placing a link over the slide content will make this content not selectable.', 'omniverse' ),
				'section'     => 'slide_link',
				'group'       => esc_html__( 'Slide link', 'omniverse' ),
				'attributes'  => array(
					'type' => 'url',
				),
				'priority'    => 240,
				'class'       => 'dn-col-6',
			)
		);

		$slide_metabox->add_field(
			array(
				'id'       => 'link_target_blank',
				'type'     => 'checkbox',
				'name'     => esc_html__( 'Open link in new tab', 'omniverse' ),
				'section'  => 'slide_link',
				'group'    => esc_html__( 'Slide link', 'omniverse' ),
				'on-text'  => esc_html__( 'Yes', 'omniverse' ),
				'off-text' => esc_html__( 'No', 'omniverse' ),
				'priority' => 250,
				'class'    => 'dn-col-6',
			)
		);
	}

	add_action( 'init', 'omniverse_register_slider_metaboxes', 100 );
}

$slider_metabox = Metaboxes::add_metabox(
	array(
		'id'           => 'zs_slider_metaboxes',
		'title'        => esc_html__( 'Slide Settings', 'omniverse' ),
		'object'       => 'term',
		'taxonomies'   => array( 'omniverse_slider' ),
		'css_selector' => '#slider-{{ID}}',
	)
);

$slider_metabox->add_section(
	array(
		'id'       => 'slide_content',
		'name'     => esc_html__( 'Slide content', 'omniverse' ),
		'icon'     => 'dn-i-footer',
		'priority' => 10,
	)
);

$slider_metabox->add_field(
	array(
		'id'       => 'animation',
		'name'     => esc_html__( 'Slide change animation', 'omniverse' ),
		'type'     => 'buttons',
		'group'    => esc_html__( 'Layout', 'omniverse' ),
		'section'  => 'slide_content',
		'default'  => 'slide',
		'options'  => array(
			'slide'      => array(
				'name'  => esc_html__( 'Slide', 'omniverse' ),
				'hint'  => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'slide-change-animation-slide.mp4" autoplay loop muted></video>',
				'value' => 'slide',
			),
			'fade'       => array(
				'name'  => esc_html__( 'Fade', 'omniverse' ),
				'hint'  => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'slide-change-animation-fade.mp4" autoplay loop muted></video>',
				'value' => 'fade',
			),
			'parallax'   => array(
				'name'  => esc_html__( 'Parallax', 'omniverse' ),
				'hint'  => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'slide-change-animation-parallax.mp4" autoplay loop muted></video>',
				'value' => 'parallax',
			),
			'distortion' => array(
				'name'  => esc_html__( 'Distortion', 'omniverse' ),
				'hint'  => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'slide-change-animation-distortion.mp4" autoplay loop muted></video>',
				'value' => 'distortion',
			),
		),
		'priority' => 8,
	)
);

$slider_metabox->add_field(
	array(
		'id'          => 'stretch_slider',
		'name'        => esc_html__( 'Stretch slider', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'stretch-slider.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Make slider full width', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'checkbox',
		'section'     => 'slide_content',
		'class'       => 'dn-col-6',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 10,
	)
);

$slider_metabox->add_field(
	array(
		'id'          => 'stretch_content',
		'name'        => esc_html__( 'Full width content', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'slider-full-with-content.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Make content full width', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'checkbox',
		'section'     => 'slide_content',
		'requires'    => array(
			array(
				'key'     => 'stretch_slider',
				'compare' => 'equals',
				'value'   => 'on',
			),
		),
		'class'       => 'dn-col-6',
		'priority'    => 11,
	)
);

$slider_metabox->add_field(
	array(
		'id'          => 'height',
		'name'        => esc_html__( 'Height on desktop', 'omniverse' ),
		'description' => esc_html__( 'Set your value in pixels.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'range',
		'min'         => '100',
		'max'         => '1200',
		'step'        => '5',
		'default'     => '500',
		'section'     => 'slide_content',
		'selectors'   => array(
			'{{WRAPPER}} .wd-slide' => array(
				'min-height: {{VALUE}}px;',
			),
		),
		't_tab'       => array(
			'id'    => 'slider_height_settings_tabs',
			'tab'   => esc_html__( 'Desktop', 'omniverse' ),
			'icon'  => 'dn-i-desktop',
			'style' => 'devices',
		),
		'priority'    => 20,
		'unit'        => 'px',
	)
);

$slider_metabox->add_field(
	array(
		'id'          => 'height_tablet',
		'name'        => esc_html__( 'Height on tablet', 'omniverse' ),
		'description' => esc_html__( 'Set your value in pixels.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'range',
		'min'         => '100',
		'max'         => '1200',
		'step'        => '5',
		'default'     => '500',
		'section'     => 'slide_content',
		'selectors'   => array(
			'{{WRAPPER}} .wd-slide' => array(
				'min-height: {{VALUE}}px;',
			),
		),
		'css_device'  => 'tablet',
		't_tab'       => array(
			'id'   => 'slider_height_settings_tabs',
			'tab'  => esc_html__( 'Tablet', 'omniverse' ),
			'icon' => 'dn-i-tablet',
		),
		'priority'    => 30,
		'unit'        => 'px',
	)
);

$slider_metabox->add_field(
	array(
		'id'          => 'height_mobile',
		'name'        => esc_html__( 'Height on mobile', 'omniverse' ),
		'description' => esc_html__( 'Set your value in pixels.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'range',
		'min'         => '100',
		'max'         => '1200',
		'step'        => '5',
		'default'     => '500',
		'section'     => 'slide_content',
		'selectors'   => array(
			'{{WRAPPER}} .wd-slide' => array(
				'min-height: {{VALUE}}px;',
			),
		),
		'css_device'  => 'mobile',
		't_tab'       => array(
			'id'   => 'slider_height_settings_tabs',
			'tab'  => esc_html__( 'Mobile', 'omniverse' ),
			'icon' => 'dn-i-phone',
		),
		'priority'    => 40,
		'unit'        => 'px',
	)
);

$slider_metabox->add_field(
	array(
		'id'       => 'arrows_style',
		'name'     => esc_html__( 'Arrows style', 'omniverse' ),
		'group'    => esc_html__( 'Arrows style', 'omniverse' ),
		'type'     => 'buttons',
		'default'  => '1',
		'section'  => 'slide_content',
		'options'  => array(
			'1' => array(
				'name'  => esc_html__( 'Style 1', 'omniverse' ),
				'value' => '1',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/slider-navigation/arrow-style-1.jpg',
			),
			'2' => array(
				'name'  => esc_html__( 'Style 2', 'omniverse' ),
				'value' => '2',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/slider-navigation/arrow-style-2.jpg',
			),
			'3' => array(
				'name'  => esc_html__( 'Style 3', 'omniverse' ),
				'value' => '3',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/slider-navigation/arrow-style-3.jpg',
			),
			'0' => array(
				'name'  => esc_html__( 'Disable', 'omniverse' ),
				'value' => '0',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/slider-navigation/navigation-disable.jpg',
			),
		),
		'priority' => 50,
	)
);

$slider_metabox->add_field(
	array(
		'id'       => 'navigation_color_scheme',
		'name'     => esc_html__( 'Arrows color scheme', 'omniverse' ),
		'group'    => esc_html__( 'Arrows style', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'slide_content',
		'default'  => '',
		'options'  => array(
			'light' => array(
				'name'  => esc_html__( 'Light', 'omniverse' ),
				'value' => 'light',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/slider-navigation/arrows-color-light.jpg',
			),
			'dark'  => array(
				'name'  => esc_html__( 'Dark', 'omniverse' ),
				'value' => 'dark',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/slider-navigation/arrows-color-dark.jpg',
			),
		),
		'requires' => array(
			array(
				'key'     => 'arrows_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
		),
		'priority' => 60,
	)
);

$slider_metabox->add_field(
	array(
		'id'       => 'arrows_custom_settings',
		'name'     => esc_html__( 'Custom settings', 'omniverse' ),
		'group'    => esc_html__( 'Arrows style', 'omniverse' ),
		'type'     => 'checkbox',
		'section'  => 'slide_content',
		'default'  => '',
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'requires' => array(
			array(
				'key'     => 'arrows_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
		),
		'class'    => 'dn-col-6',
		'priority' => 65,
	)
);

$slider_metabox->add_field(
	array(
		'id'       => 'arrows_hover_style',
		'name'     => esc_html__( 'Hover style', 'omniverse' ),
		'group'    => esc_html__( 'Arrows style', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'slide_content',
		'options'  => array(
			'disable' => array(
				'name'  => esc_html__( 'Disable', 'omniverse' ),
				'value' => 'disable',
			),
			'1'       => array(
				'name'  => esc_html__( 'Style 1', 'omniverse' ),
				'value' => '1',
			),
		),
		'default'  => 'disable',
		'requires' => array(
			array(
				'key'     => 'arrows_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
			array(
				'key'     => 'arrows_custom_settings',
				'compare' => 'equals',
				'value'   => 'on',
			),
		),
		'class'    => 'dn-col-6',
		'priority' => 70,
	)
);

$slider_metabox->add_field(
	array(
		'id'            => 'arrows_size',
		'name'          => esc_html__( 'Size', 'omniverse' ),
		'group'         => esc_html__( 'Arrows style', 'omniverse' ),
		'type'          => 'responsive_range',
		'section'       => 'slide_content',
		'selectors'     => array(
			'{{WRAPPER}} .wd-slider-arrows' => array(
				'--wd-arrow-size: {{VALUE}}{{UNIT}};',
			),
		),
		'generate_zero' => true,
		'devices'       => array(
			'desktop' => array(
				'value' => '',
				'unit'  => 'px',
			),
			'tablet'  => array(
				'value' => '',
				'unit'  => 'px',
			),
			'mobile'  => array(
				'value' => '',
				'unit'  => 'px',
			),
		),
		'range'         => array(
			'px' => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			),
		),
		'requires'      => array(
			array(
				'key'     => 'arrows_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
			array(
				'key'     => 'arrows_custom_settings',
				'compare' => 'equals',
				'value'   => 'on',
			),
		),
		'class'         => 'dn-col-6',
		'priority'      => 75,
	)
);

$slider_metabox->add_field(
	array(
		'id'            => 'arrows_icon_size',
		'name'          => esc_html__( 'Icon size', 'omniverse' ),
		'group'         => esc_html__( 'Arrows style', 'omniverse' ),
		'type'          => 'responsive_range',
		'section'       => 'slide_content',
		'selectors'     => array(
			'{{WRAPPER}} .wd-slider-arrows' => array(
				'--wd-arrow-icon-size: {{VALUE}}{{UNIT}};',
			),
		),
		'generate_zero' => true,
		'devices'       => array(
			'desktop' => array(
				'value' => '',
				'unit'  => 'px',
			),
			'tablet'  => array(
				'value' => '',
				'unit'  => 'px',
			),
			'mobile'  => array(
				'value' => '',
				'unit'  => 'px',
			),
		),
		'range'         => array(
			'px' => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			),
		),
		'requires'      => array(
			array(
				'key'     => 'arrows_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
			array(
				'key'     => 'arrows_custom_settings',
				'compare' => 'equals',
				'value'   => 'on',
			),
		),
		'class'         => 'dn-col-6',
		'priority'      => 80,
	)
);

$slider_metabox->add_field(
	array(
		'id'            => 'arrows_offset_h',
		'name'          => esc_html__( 'Offset horizontal', 'omniverse' ),
		'group'         => esc_html__( 'Arrows style', 'omniverse' ),
		'type'          => 'responsive_range',
		'section'       => 'slide_content',
		'selectors'     => array(
			'{{WRAPPER}} .wd-slider-arrows' => array(
				'--wd-arrow-offset-h: {{VALUE}}{{UNIT}};',
			),
		),
		'generate_zero' => true,
		'devices'       => array(
			'desktop' => array(
				'value' => '',
				'unit'  => 'px',
			),
			'tablet'  => array(
				'value' => '',
				'unit'  => 'px',
			),
			'mobile'  => array(
				'value' => '',
				'unit'  => 'px',
			),
		),
		'range'         => array(
			'px' => array(
				'min'  => -500,
				'max'  => 500,
				'step' => 1,
			),
		),
		'requires'      => array(
			array(
				'key'     => 'arrows_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
			array(
				'key'     => 'arrows_custom_settings',
				'compare' => 'equals',
				'value'   => 'on',
			),
		),
		'class'         => 'dn-col-6',
		'priority'      => 90,
	)
);

$slider_metabox->add_field(
	array(
		'id'            => 'arrows_offset_v',
		'name'          => esc_html__( 'Offset vertical', 'omniverse' ),
		'group'         => esc_html__( 'Arrows style', 'omniverse' ),
		'type'          => 'responsive_range',
		'section'       => 'slide_content',
		'selectors'     => array(
			'{{WRAPPER}} .wd-slider-arrows' => array(
				'--wd-arrow-offset-v: {{VALUE}}{{UNIT}};',
			),
		),
		'generate_zero' => true,
		'devices'       => array(
			'desktop' => array(
				'value' => '',
				'unit'  => 'px',
			),
			'tablet'  => array(
				'value' => '',
				'unit'  => 'px',
			),
			'mobile'  => array(
				'value' => '',
				'unit'  => 'px',
			),
		),
		'range'         => array(
			'px' => array(
				'min'  => -500,
				'max'  => 500,
				'step' => 1,
			),
		),
		'requires'      => array(
			array(
				'key'     => 'arrows_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
			array(
				'key'     => 'arrows_custom_settings',
				'compare' => 'equals',
				'value'   => 'on',
			),
		),
		'class'         => 'dn-col-6',
		'priority'      => 100,
	)
);

$slider_metabox->add_field(
	array(
		'id'           => 'arrows_color_group',
		'name'         => esc_html__( 'Сolor', 'omniverse' ),
		'group'        => esc_html__( 'Arrows style', 'omniverse' ),
		'type'         => 'group',
		'section'      => 'slide_content',
		'inner_fields' => array(
			array(
				'id'        => 'arrows_color',
				'name'      => esc_html__( 'Regular', 'omniverse' ),
				'type'      => 'color',
				'section'   => 'slide_content',
				'selectors' => array(
					'{{WRAPPER}} .wd-slider-arrows' => array(
						'--wd-arrow-color: {{VALUE}};',
					),
				),
				'default'   => array(),
				'priority'  => 10,
				'class'     => 'dn-col-4',
			),
			array(
				'id'        => 'arrows_color_hover',
				'name'      => esc_html__( 'Hover', 'omniverse' ),
				'type'      => 'color',
				'section'   => 'slide_content',
				'selectors' => array(
					'{{WRAPPER}} .wd-slider-arrows' => array(
						'--wd-arrow-color-hover: {{VALUE}};',
					),
				),
				'default'   => array(),
				'priority'  => 20,
				'class'     => 'dn-col-4',
			),
		),
		'requires'     => array(
			array(
				'key'     => 'arrows_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
			array(
				'key'     => 'arrows_custom_settings',
				'compare' => 'equals',
				'value'   => 'on',
			),
		),
		'priority'     => 110,
	)
);

$slider_metabox->add_field(
	array(
		'id'           => 'arrows_bg_color_group',
		'name'         => esc_html__( 'Background color', 'omniverse' ),
		'group'        => esc_html__( 'Arrows style', 'omniverse' ),
		'type'         => 'group',
		'section'      => 'slide_content',
		'inner_fields' => array(
			array(
				'id'        => 'arrows_bg_color',
				'name'      => esc_html__( 'Regular', 'omniverse' ),
				'type'      => 'color',
				'section'   => 'slide_content',
				'selectors' => array(
					'{{WRAPPER}} .wd-slider-arrows' => array(
						'--wd-arrow-bg: {{VALUE}};',
					),
				),
				'default'   => array(),
				'priority'  => 10,
				'class'     => 'dn-col-4',
			),
			array(
				'id'        => 'arrows_bg_color_hover',
				'name'      => esc_html__( 'Hover', 'omniverse' ),
				'type'      => 'color',
				'section'   => 'slide_content',
				'selectors' => array(
					'{{WRAPPER}} .wd-slider-arrows' => array(
						'--wd-arrow-bg-hover: {{VALUE}};',
					),
				),
				'default'   => array(),
				'priority'  => 20,
				'class'     => 'dn-col-4',
			),
		),
		'requires'     => array(
			array(
				'key'     => 'arrows_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
			array(
				'key'     => 'arrows_custom_settings',
				'compare' => 'equals',
				'value'   => 'on',
			),
		),
		'priority'     => 150,
	)
);

$slider_metabox->add_field(
	array(
		'id'           => 'arrows_border_group',
		'name'         => esc_html__( 'Border', 'omniverse' ),
		'group'        => esc_html__( 'Arrows style', 'omniverse' ),
		'type'         => 'group',
		'style'        => 'dropdown',
		'btn_settings' => array(
			'label'   => esc_html__( 'Edit settings', 'omniverse' ),
			'classes' => 'dn-i-cog',
		),
		'css_rules'    => array(
			'with_all_value' => true,
		),
		'selectors'    => array(
			'{{WRAPPER}} .wd-slider-arrows' => array(
				'--wd-arrow-brd: {{ARROWS_BORDER_WIDTH}} {{ARROWS_BORDER_STYLE}};',
			),
		),
		'section'      => 'slide_content',
		'inner_fields' => array(
			array(
				'id'            => 'arrows_border_radius',
				'name'          => esc_html__( 'Border radius', 'omniverse' ),
				'type'          => 'responsive_range',
				'selectors'     => array(
					'{{WRAPPER}} .wd-slider-arrows' => array(
						'--wd-arrow-radius: {{VALUE}}{{UNIT}};',
					),
				),
				'generate_zero' => true,
				'devices'       => array(
					'desktop' => array(
						'value' => '',
						'unit'  => 'px',
					),
				),
				'range'         => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					),
				),
				'priority'      => 10,
			),
			array(
				'id'       => 'arrows_border_style',
				'name'     => esc_html__( 'Border style', 'omniverse' ),
				'type'     => 'select',
				'options'  => array(
					''       => array(
						'name'  => esc_html__( 'None', 'omniverse' ),
						'value' => '',
					),
					'solid'  => array(
						'name'  => esc_html__( 'Solid', 'omniverse' ),
						'value' => 'solid',
					),
					'dotted' => array(
						'name'  => esc_html__( 'Dotted', 'omniverse' ),
						'value' => 'dotted',
					),
					'double' => array(
						'name'  => esc_html__( 'Double', 'omniverse' ),
						'value' => 'double',
					),
					'dashed' => array(
						'name'  => esc_html__( 'Dashed', 'omniverse' ),
						'value' => 'dashed',
					),
					'groove' => array(
						'name'  => esc_html__( 'Groove', 'omniverse' ),
						'value' => 'groove',
					),
				),
				'default'  => '',
				'priority' => 20,
			),
			array(
				'id'       => 'arrows_border_width',
				'name'     => esc_html__( 'Border width', 'omniverse' ),
				'type'     => 'responsive_range',
				'devices'  => array(
					'desktop' => array(
						'value' => '',
						'unit'  => 'px',
					),
				),
				'range'    => array(
					'px' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),
				'requires' => array(
					array(
						'key'     => 'arrows_border_style',
						'compare' => 'not_equals',
						'value'   => '',
					),
				),
				'priority' => 30,
			),
			array(
				'id'        => 'arrows_border_color',
				'name'      => esc_html__( 'Color', 'omniverse' ),
				'type'      => 'color',
				'selectors' => array(
					'{{WRAPPER}} .wd-slider-arrows' => array(
						'--wd-arrow-brd-color: {{VALUE}};',
					),
				),
				'default'   => array(),
				'requires'  => array(
					array(
						'key'     => 'arrows_border_style',
						'compare' => 'not_equals',
						'value'   => '',
					),
				),
				'class'     => 'dn-col-6',
				'priority'  => 40,
			),
			array(
				'id'        => 'arrows_border_color_hover',
				'name'      => esc_html__( 'Color hover', 'omniverse' ),
				'type'      => 'color',
				'selectors' => array(
					'{{WRAPPER}} .wd-slider-arrows' => array(
						'--wd-arrow-brd-color-hover: {{VALUE}};',
					),
				),
				'default'   => array(),
				'requires'  => array(
					array(
						'key'     => 'arrows_border_style',
						'compare' => 'not_equals',
						'value'   => '',
					),
				),
				'class'     => 'dn-col-6',
				'priority'  => 50,
			),
		),
		'requires'     => array(
			array(
				'key'     => 'arrows_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
			array(
				'key'     => 'arrows_custom_settings',
				'compare' => 'equals',
				'value'   => 'on',
			),
		),
		'class'        => 'dn-col-6',
		'priority'     => 170,
	)
);

$slider_metabox->add_field(
	array(
		'id'           => 'arrows_box_shadow_group',
		'name'         => esc_html__( 'Box shadow', 'omniverse' ),
		'group'        => esc_html__( 'Arrows style', 'omniverse' ),
		'type'         => 'group',
		'style'        => 'dropdown',
		'btn_settings' => array(
			'label'   => esc_html__( 'Edit settings', 'omniverse' ),
			'classes' => 'dn-i-cog',
		),
		'selectors'    => array(
			'{{WRAPPER}} .wd-slider-arrows' => array(
				'--wd-arrow-shadow: {{ARROWS_BOX_SHADOW_OFFSET_X}} {{ARROWS_BOX_SHADOW_OFFSET_Y}} {{ARROWS_BOX_SHADOW_BLUR}} {{ARROWS_BOX_SHADOW_SPREAD}} {{ARROWS_BOX_SHADOW_COLOR}};',
			),
		),
		'section'      => 'slide_content',
		'inner_fields' => array(
			array(
				'id'       => 'arrows_box_shadow_color',
				'name'     => esc_html__( 'Color', 'omniverse' ),
				'type'     => 'color',
				'default'  => array(),
				'priority' => 10,
			),
			array(
				'id'       => 'arrows_box_shadow_offset_x',
				'name'     => esc_html__( 'Horizontal offset', 'omniverse' ),
				'type'     => 'responsive_range',
				'devices'  => array(
					'desktop' => array(
						'value' => '',
						'unit'  => 'px',
					),
				),
				'range'    => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'priority' => 20,
			),
			array(
				'id'       => 'arrows_box_shadow_offset_y',
				'name'     => esc_html__( 'Vertical offset', 'omniverse' ),
				'type'     => 'responsive_range',
				'devices'  => array(
					'desktop' => array(
						'value' => '',
						'unit'  => 'px',
					),
				),
				'range'    => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'priority' => 30,
			),
			array(
				'id'       => 'arrows_box_shadow_blur',
				'name'     => esc_html__( 'Blur', 'omniverse' ),
				'type'     => 'responsive_range',
				'devices'  => array(
					'desktop' => array(
						'value' => '',
						'unit'  => 'px',
					),
				),
				'range'    => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'priority' => 40,
			),
			array(
				'id'       => 'arrows_box_shadow_spread',
				'name'     => esc_html__( 'Spread', 'omniverse' ),
				'type'     => 'responsive_range',
				'devices'  => array(
					'desktop' => array(
						'value' => '',
						'unit'  => 'px',
					),
				),
				'range'    => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'priority' => 50,
			),
		),
		'requires'     => array(
			array(
				'key'     => 'arrows_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
			array(
				'key'     => 'arrows_custom_settings',
				'compare' => 'equals',
				'value'   => 'on',
			),
		),
		'class'        => 'dn-col-6',
		'priority'     => 180,
	)
);

$slider_metabox->add_field(
	array(
		'id'       => 'pagination_style',
		'name'     => esc_html__( 'Pagination style', 'omniverse' ),
		'group'    => esc_html__( 'Pagination style', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'slide_content',
		'default'  => '1',
		'options'  => array(
			'1' => array(
				'name'  => esc_html__( 'Style 1', 'omniverse' ),
				'value' => '1',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/slider-navigation/pagination-style-1.jpg',
			),
			'2' => array(
				'name'  => esc_html__( 'Style 2', 'omniverse' ),
				'value' => '2',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/slider-navigation/pagination-style-2.jpg',
			),
			'3' => array(
				'name'  => esc_html__( 'Style 3', 'omniverse' ),
				'value' => '3',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/slider-navigation/pagination-style-3.jpg',
			),
			'0' => array(
				'name'  => esc_html__( 'Disable', 'omniverse' ),
				'value' => '0',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/slider-navigation/navigation-disable.jpg',
			),
		),
		'priority' => 200,
	)
);

$slider_metabox->add_field(
	array(
		'id'       => 'pagination_horizon_align',
		'name'     => esc_html__( 'Pagination horizontal alignment', 'omniverse' ),
		'group'    => esc_html__( 'Pagination style', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'slide_content',
		'default'  => 'center',
		'options'  => array(
			'left'   => array(
				'name'  => esc_html__( 'Left', 'omniverse' ),
				'value' => 'left',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/slider-navigation/pagination-horizontal-alignment-left.jpg',
			),
			'center' => array(
				'name'  => esc_html__( 'Center', 'omniverse' ),
				'value' => 'center',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/slider-navigation/pagination-horizontal-alignment-center.jpg',
			),
			'right'  => array(
				'name'  => esc_html__( 'Right', 'omniverse' ),
				'value' => 'right',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/slider-navigation/pagination-horizontal-alignment-right.jpg',
			),
		),
		'requires' => array(
			array(
				'key'     => 'pagination_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
		),
		'priority' => 210,
	)
);

$slider_metabox->add_field(
	array(
		'id'       => 'pagination_color',
		'name'     => esc_html__( 'Pagination color scheme', 'omniverse' ),
		'group'    => esc_html__( 'Pagination style', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'slide_content',
		'default'  => '',
		'options'  => array(
			'light' => array(
				'name'  => esc_html__( 'Light', 'omniverse' ),
				'value' => 'light',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/slider-navigation/pagination-color-light.jpg',
			),
			'dark'  => array(
				'name'  => esc_html__( 'Dark', 'omniverse' ),
				'value' => 'dark',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/slider-navigation/pagination-color-dark.jpg',
			),
		),
		'requires' => array(
			array(
				'key'     => 'pagination_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
		),
		'priority' => 220,
	)
);

$slider_metabox->add_field(
	array(
		'id'       => 'pagination_custom_settings',
		'name'     => esc_html__( 'Custom settings', 'omniverse' ),
		'group'    => esc_html__( 'Pagination style', 'omniverse' ),
		'type'     => 'checkbox',
		'section'  => 'slide_content',
		'default'  => '',
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'requires' => array(
			array(
				'key'     => 'pagination_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
		),
		'priority' => 230,
	)
);

$slider_metabox->add_field(
	array(
		'id'            => 'pagination_size',
		'name'          => esc_html__( 'Size', 'omniverse' ),
		'group'         => esc_html__( 'Pagination style', 'omniverse' ),
		'type'          => 'responsive_range',
		'section'       => 'slide_content',
		'selectors'     => array(
			'{{WRAPPER}} .wd-nav-pagin-wrap' => array(
				'--wd-pagin-size: {{VALUE}}{{UNIT}};',
			),
		),
		'generate_zero' => true,
		'devices'       => array(
			'desktop' => array(
				'value' => '',
				'unit'  => 'px',
			),
			'tablet'  => array(
				'value' => '',
				'unit'  => 'px',
			),
			'mobile'  => array(
				'value' => '',
				'unit'  => 'px',
			),
		),
		'range'         => array(
			'px' => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			),
		),
		'requires'      => array(
			array(
				'key'     => 'pagination_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
			array(
				'key'     => 'pagination_custom_settings',
				'compare' => 'equals',
				'value'   => 'on',
			),
		),
		'priority'      => 240,
	)
);

$slider_metabox->add_field(
	array(
		'id'           => 'pagination_bg_color_group',
		'name'         => esc_html__( 'Background color', 'omniverse' ),
		'group'        => esc_html__( 'Pagination style', 'omniverse' ),
		'type'         => 'group',
		'section'      => 'slide_content',
		'inner_fields' => array(
			array(
				'id'        => 'pagination_bg_color',
				'name'      => esc_html__( 'Regular', 'omniverse' ),
				'type'      => 'color',
				'section'   => 'slide_content',
				'selectors' => array(
					'{{WRAPPER}} .wd-nav-pagin-wrap' => array(
						'--wd-pagin-bg: {{VALUE}};',
					),
				),
				'default'   => array(),
				'priority'  => 10,
				'class'     => 'dn-col-4',
			),
			array(
				'id'        => 'pagination_bg_color_hover',
				'name'      => esc_html__( 'Hover', 'omniverse' ),
				'type'      => 'color',
				'section'   => 'slide_content',
				'selectors' => array(
					'{{WRAPPER}} .wd-nav-pagin-wrap' => array(
						'--wd-pagin-bg-hover: {{VALUE}};',
					),
				),
				'default'   => array(),
				'priority'  => 20,
				'class'     => 'dn-col-4',
			),
			array(
				'id'        => 'pagination_bg_color_active',
				'name'      => esc_html__( 'Active', 'omniverse' ),
				'type'      => 'color',
				'section'   => 'slide_content',
				'selectors' => array(
					'{{WRAPPER}} .wd-nav-pagin-wrap' => array(
						'--wd-pagin-bg-act: {{VALUE}};',
					),
				),
				'default'   => array(),
				'priority'  => 30,
				'class'     => 'dn-col-4',
			),
			array(
				'id'        => 'pagination_bg_color_wrapper',
				'name'      => esc_html__( 'Background of wrapper', 'omniverse' ),
				'type'      => 'color',
				'section'   => 'slide_content',
				'selectors' => array(
					'{{WRAPPER}} .wd-nav-pagin-wrap' => array(
						'--wd-pagin-wrap-bg: {{VALUE}};',
					),
				),
				'default'   => array(),
				'requires'  => array(
					array(
						'key'     => 'pagination_style',
						'compare' => 'equals',
						'value'   => '3',
					),
				),
				'priority'  => 40,
				'class'     => 'dn-col-4',
			),
		),
		'requires'     => array(
			array(
				'key'     => 'pagination_style',
				'compare' => 'not_equals',
				'value'   => array( '0', '2' ),
			),
			array(
				'key'     => 'pagination_custom_settings',
				'compare' => 'equals',
				'value'   => 'on',
			),
		),
		'priority'     => 250,
	)
);

$slider_metabox->add_field(
	array(
		'id'           => 'pagination_color_group',
		'name'         => esc_html__( 'Color', 'omniverse' ),
		'group'        => esc_html__( 'Pagination style', 'omniverse' ),
		'type'         => 'group',
		'section'      => 'slide_content',
		'inner_fields' => array(
			array(
				'id'        => 'pagination_color_idle',
				'name'      => esc_html__( 'Regular', 'omniverse' ),
				'type'      => 'color',
				'section'   => 'slide_content',
				'selectors' => array(
					'{{WRAPPER}} .wd-nav-pagin-wrap' => array(
						'--wd-pagin-color: {{VALUE}};',
					),
				),
				'default'   => array(),
				'priority'  => 10,
				'class'     => 'dn-col-4',
			),
			array(
				'id'        => 'pagination_color_hover',
				'name'      => esc_html__( 'Hover', 'omniverse' ),
				'type'      => 'color',
				'section'   => 'slide_content',
				'selectors' => array(
					'{{WRAPPER}} .wd-nav-pagin-wrap' => array(
						'--wd-pagin-color-hover: {{VALUE}};',
					),
				),
				'default'   => array(),
				'priority'  => 20,
				'class'     => 'dn-col-4',
			),
			array(
				'id'        => 'pagination_color_active',
				'name'      => esc_html__( 'Active', 'omniverse' ),
				'type'      => 'color',
				'section'   => 'slide_content',
				'selectors' => array(
					'{{WRAPPER}} .wd-nav-pagin-wrap' => array(
						'--wd-pagin-color-act: {{VALUE}};',
					),
				),
				'default'   => array(),
				'priority'  => 30,
				'class'     => 'dn-col-4',
			),
		),
		'requires'     => array(
			array(
				'key'     => 'pagination_style',
				'compare' => 'equals',
				'value'   => '2',
			),
			array(
				'key'     => 'pagination_custom_settings',
				'compare' => 'equals',
				'value'   => 'on',
			),
		),
		'priority'     => 260,
	)
);

$slider_metabox->add_field(
	array(
		'id'           => 'pagination_border_group',
		'name'         => esc_html__( 'Border', 'omniverse' ),
		'group'        => esc_html__( 'Pagination style', 'omniverse' ),
		'type'         => 'group',
		'style'        => 'dropdown',
		'btn_settings' => array(
			'label'   => esc_html__( 'Edit settings', 'omniverse' ),
			'classes' => 'dn-i-cog',
		),
		'css_rules'    => array(
			'with_all_value' => true,
		),
		'selectors'    => array(
			'{{WRAPPER}} .wd-nav-pagin-wrap' => array(
				'--wd-pagin-brd: {{PAGINATION_BORDER_WIDTH}} {{PAGINATION_BORDER_STYLE}};',
			),
		),
		'section'      => 'slide_content',
		'inner_fields' => array(
			array(
				'id'            => 'pagination_border_radius',
				'name'          => esc_html__( 'Border radius', 'omniverse' ),
				'type'          => 'responsive_range',
				'selectors'     => array(
					'{{WRAPPER}} .wd-nav-pagin-wrap' => array(
						'--wd-pagin-radius: {{VALUE}}{{UNIT}};',
					),
				),
				'generate_zero' => true,
				'devices'       => array(
					'desktop' => array(
						'value' => '',
						'unit'  => 'px',
					),
				),
				'range'         => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					),
				),
				'priority'      => 10,
			),
			array(
				'id'       => 'pagination_border_style',
				'name'     => esc_html__( 'Border style', 'omniverse' ),
				'type'     => 'select',
				'options'  => array(
					''       => array(
						'name'  => esc_html__( 'None', 'omniverse' ),
						'value' => '',
					),
					'solid'  => array(
						'name'  => esc_html__( 'Solid', 'omniverse' ),
						'value' => 'solid',
					),
					'dotted' => array(
						'name'  => esc_html__( 'Dotted', 'omniverse' ),
						'value' => 'dotted',
					),
					'double' => array(
						'name'  => esc_html__( 'Double', 'omniverse' ),
						'value' => 'double',
					),
					'dashed' => array(
						'name'  => esc_html__( 'Dashed', 'omniverse' ),
						'value' => 'dashed',
					),
					'groove' => array(
						'name'  => esc_html__( 'Groove', 'omniverse' ),
						'value' => 'groove',
					),
				),
				'default'  => '',
				'priority' => 20,
			),
			array(
				'id'       => 'pagination_border_width',
				'name'     => esc_html__( 'Border width', 'omniverse' ),
				'type'     => 'responsive_range',
				'devices'  => array(
					'desktop' => array(
						'value' => '',
						'unit'  => 'px',
					),
				),
				'range'    => array(
					'px' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),
				'requires' => array(
					array(
						'key'     => 'pagination_border_style',
						'compare' => 'not_equals',
						'value'   => '',
					),
				),
				'priority' => 30,
			),
			array(
				'id'        => 'pagination_border_color',
				'name'      => esc_html__( 'Color', 'omniverse' ),
				'type'      => 'color',
				'selectors' => array(
					'{{WRAPPER}} .wd-nav-pagin-wrap' => array(
						'--wd-pagin-brd-color: {{VALUE}};',
					),
				),
				'default'   => array(),
				'requires'  => array(
					array(
						'key'     => 'pagination_border_style',
						'compare' => 'not_equals',
						'value'   => '',
					),
				),
				'priority'  => 40,
				'class'     => 'dn-col-4',
			),
			array(
				'id'        => 'pagination_border_color_hover',
				'name'      => esc_html__( 'Color hover', 'omniverse' ),
				'type'      => 'color',
				'selectors' => array(
					'{{WRAPPER}} .wd-nav-pagin-wrap' => array(
						'--wd-pagin-brd-color-hover: {{VALUE}};',
					),
				),
				'default'   => array(),
				'requires'  => array(
					array(
						'key'     => 'pagination_border_style',
						'compare' => 'not_equals',
						'value'   => '',
					),
				),
				'priority'  => 50,
				'class'     => 'dn-col-4',
			),
			array(
				'id'        => 'pagination_border_active_color',
				'name'      => esc_html__( 'Active color', 'omniverse' ),
				'type'      => 'color',
				'selectors' => array(
					'{{WRAPPER}} .wd-nav-pagin-wrap' => array(
						'--wd-pagin-brd-color-act: {{VALUE}};',
					),
				),
				'default'   => array(),
				'requires'  => array(
					array(
						'key'     => 'pagination_style',
						'compare' => 'not_equals',
						'value'   => '0',
					),
					array(
						'key'     => 'pagination_custom_settings',
						'compare' => 'equals',
						'value'   => 'on',
					),
					array(
						'key'     => 'pagination_border_style',
						'compare' => 'not_equals',
						'value'   => '',
					),
				),
				'priority'  => 60,
				'class'     => 'dn-col-4',
			),
		),
		'requires'     => array(
			array(
				'key'     => 'pagination_style',
				'compare' => 'not_equals',
				'value'   => '0',
			),
			array(
				'key'     => 'pagination_custom_settings',
				'compare' => 'equals',
				'value'   => 'on',
			),
		),
		'priority'     => 280,
	)
);

$slider_metabox->add_field(
	array(
		'id'          => 'autoplay',
		'name'        => esc_html__( 'Enable autoplay', 'omniverse' ),
		'description' => esc_html__( 'Rotate slider images automatically.', 'omniverse' ),
		'group'       => esc_html__( 'Settings', 'omniverse' ),
		'type'        => 'checkbox',
		'section'     => 'slide_content',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 290,
	)
);

$slider_metabox->add_field(
	array(
		'id'       => 'autoplay_speed',
		'name'     => esc_html__( 'Autoplay speed', 'omniverse' ),
		'group'    => esc_html__( 'Settings', 'omniverse' ),
		'type'     => 'range',
		'min'      => '1000',
		'max'      => '30000',
		'step'     => '100',
		'default'  => '9000',
		'section'  => 'slide_content',
		'priority' => 300,
		'unit'     => 'ms',
		'requires' => array(
			array(
				'key'     => 'autoplay',
				'compare' => 'equals',
				'value'   => 'on',
			),
		),
	)
);

$slider_metabox->add_field(
	array(
		'id'          => 'scroll_carousel_init',
		'name'        => esc_html__( 'Init carousel on scroll', 'omniverse' ),
		'description' => esc_html__( 'This option allows you to init carousel script only when visitor scroll the page to the slider. Useful for performance optimization.', 'omniverse' ),
		'group'       => esc_html__( 'Settings', 'omniverse' ),
		'type'        => 'checkbox',
		'section'     => 'slide_content',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 310,
	)
);


