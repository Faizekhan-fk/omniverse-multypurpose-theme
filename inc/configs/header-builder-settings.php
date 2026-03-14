<?php if ( ! defined("OMNIVERSE_THEME_DIR")) exit("No direct script access allowed");

/**
 * ------------------------------------------------------------------------------------------------
 * Default header builder settings
 * ------------------------------------------------------------------------------------------------
 */

$header_settings = array(
	'overlap'        => array(
		'id'          => 'overlap',
		'title'       => esc_html__( 'Make it overlap', 'omniverse' ),
		'hint'   => '<img src="' . OMNIVERSE_TOOLTIP_URL . 'hb_settings_overlap.jpg" alt="">',
		'type'        => 'switcher',
		'tab'         => esc_html__( 'General', 'omniverse' ),
		'value'       => false,
		'description' => esc_html__( 'Make the header overlap the content.', 'omniverse' ),
		'extra_class' => 'dn-col-6',
	),
	'boxed'          => array(
		'id'          => 'boxed',
		'title'       => esc_html__( 'Make it boxed', 'omniverse' ),
		'hint'   	  => '<img src="' . OMNIVERSE_TOOLTIP_URL . 'hb_settings_boxed.jpg" alt="">',
		'type'        => 'switcher',
		'tab'         => esc_html__( 'General', 'omniverse' ),
		'value'       => false,
		'description' => esc_html__( 'The header will be boxed instead of full width', 'omniverse' ),
		'requires'    => array(
			'overlap' => array(
				'comparison' => 'equal',
				'value'      => true,
			),
		),
		'extra_class' => 'dn-col-6',
	),
	'full_width'     => array(
		'id'          => 'full_width',
		'title'       => esc_html__( 'Full width header', 'omniverse' ),
		'hint' 		  => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_settings_full_width.mp4" autoplay loop muted></video>',
		'type'        => 'switcher',
		'tab'         => esc_html__( 'General', 'omniverse' ),
		'value'       => false,
		'description' => esc_html__( 'Full width layout for the header container.', 'omniverse' ),
	),
	'dropdowns_dark' => array(
		'id'          => 'dropdowns_dark',
		'title'       => esc_html__( 'Header dropdowns dark', 'omniverse' ),
		'hint' 		  => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_settings_dropdowns_dark.mp4" autoplay loop muted></video>',
		'type'        => 'switcher',
		'tab'         => esc_html__( 'General', 'omniverse' ),
		'value'       => false,
		'description' => esc_html__( 'Make all menu, shopping cart, search, mobile menu dropdowns in dark color scheme.', 'omniverse' ),
	),
	'sticky_shadow'  => array(
		'id'          => 'sticky_shadow',
		'title'       => esc_html__( 'Sticky header shadow', 'omniverse' ),
		'type'        => 'switcher',
		'tab'         => esc_html__( 'Sticky header', 'omniverse' ),
		'value'       => true,
		'description' => esc_html__( 'Add a shadow for the header when it is sticked.', 'omniverse' ),
	),
	'hide_on_scroll' => array(
		'id'          => 'hide_on_scroll',
		'title'       => esc_html__( 'Hide when scrolling down', 'omniverse' ),
		'hint'        => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_settings_hide_on_scroll.mp4" autoplay loop muted></video>',
		'type'        => 'switcher',
		'tab'         => esc_html__( 'Sticky header', 'omniverse' ),
		'value'       => false,
		'description' => esc_html__( 'Hides the sticky header when you scroll the page down. And shows only when you scroll top.', 'omniverse' ),
	),
	'sticky_effect'  => array(
		'id'          => 'sticky_effect',
		'title'       => esc_html__( 'Sticky effect', 'omniverse' ),
		'type'        => 'selector',
		'tab'         => esc_html__( 'Sticky header', 'omniverse' ),
		'value'       => 'stick',
		'options'     => array(
			'stick' => array(
				'value' => 'stick',
				'hint'        => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_settings_scroll_stick.mp4" autoplay loop muted></video>',
				'label' => esc_html__( 'Stick on scroll', 'omniverse' ),
			),
			'slide' => array(
				'value' => 'slide',
				'hint'        => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_settings_scroll_slide.mp4" autoplay loop muted></video>',
				'label' => esc_html__( 'Slide after scrolled down', 'omniverse' ),
			),
		),
		'description' => esc_html__( 'You can choose between two types of sticky header effects.', 'omniverse' ),
	),
	'sticky_clone'   => array(
		'id'          => 'sticky_clone',
		'title'       => esc_html__( 'Sticky header clone', 'omniverse' ),
		'hint'        => '<video src="' . OMNIVERSE_TOOLTIP_URL . 'hb_settings_sticky_clone.mp4" autoplay loop muted></video>',
		'type'        => 'switcher',
		'tab'         => esc_html__( 'Sticky header', 'omniverse' ),
		'value'       => false,
		'requires'    => array(
			'sticky_effect' => array(
				'comparison' => 'equal',
				'value'      => 'slide',
			),
		),
		'description' => esc_html__( 'Sticky header will clone elements from the header (logo, menu, search and shopping cart widget) and show them in one line.', 'omniverse' ),
	),
	'sticky_height'  => array(
		'id'          => 'sticky_height',
		'title'       => esc_html__( 'Sticky header height', 'omniverse' ),
		'type'        => 'slider',
		'tab'         => esc_html__( 'Sticky header', 'omniverse' ),
		'from'        => 0,
		'to'          => 200,
		'value'       => 50,
		'units'       => 'px',
		'description' => esc_html__( 'Determine header height for sticky header value in pixels.', 'omniverse' ),
		'requires'    => array(
			'sticky_clone'  => array(
				'comparison' => 'equal',
				'value'      => true,
			),
			'sticky_effect' => array(
				'comparison' => 'equal',
				'value'      => 'slide',
			),
		),
	),
);

return apply_filters( 'omniverse_default_header_settings', $header_settings );
