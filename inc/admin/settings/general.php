<?php

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

use DN\Admin\Modules\Options;

Options::add_field(
	array(
		'id'           => 'default_header',
		'name'         => esc_html__( 'Header', 'omniverse' ),
		'description'  => esc_html__( 'Set your default header for all pages from the list of all headers created with our Header builder.', 'omniverse' ),
		'type'         => 'select',
		'section'      => 'general_layout_section',
		'empty_option' => true,
		'select2'      => true,
		'options'      => '',
		'callback'     => 'omniverse_get_theme_settings_headers_array',
		'priority'     => 10,
	)
);

/**
 * Mobile bottom navbar.
 */
Options::add_field(
	array(
		'id'          => 'sticky_toolbar',
		'name'        => esc_html__( 'Enable sticky navbar', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'enable-sticky-navbar.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Sticky navigation toolbar will be shown at the bottom on mobile devices.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'general_navbar_section',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'default'     => true,
		'priority'    => 10,
		'class'       => 'dn-tooltip-bordered',
	)
);

Options::add_field(
	array(
		'id'          => 'sticky_toolbar_label',
		'name'        => esc_html__( 'Navbar labels', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'navbar-labels.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Show/hide labels under icons in the mobile navbar.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'general_navbar_section',
		'default'     => '1',
		'priority'    => 20,
		'class'       => 'dn-tooltip-bordered',
	)
);

Options::add_field(
	array(
		'id'          => 'sticky_toolbar_fields',
		'name'        => esc_html__( 'Select buttons', 'omniverse' ),
		'description' => esc_html__( 'Choose which buttons will be used for sticky navbar.', 'omniverse' ),
		'type'        => 'select',
		'multiple'    => true,
		'select2'     => true,
		'section'     => 'general_navbar_section',
		'options'     => omniverse_get_sticky_toolbar_fields( true ),
		'default'     => array(
			'shop',
			'sidebar',
			'wishlist',
			'cart',
			'account',
		),
		'priority'    => 30,
	)
);

Options::add_field(
	array(
		'id'       => 'link_1_url',
		'name'     => esc_html__( 'Custom button URL', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'general_navbar_section',
		't_tab'    => array(
			'id'    => 'button_tabs',
			'tab'   => esc_html__( 'Button [1]', 'omniverse' ),
			'title' => esc_html__( 'Custom buttons', 'omniverse' ),
			'style' => 'default',
		),
		'priority' => 50,
		'class'    => 'dn-tab-field dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'link_1_text',
		'name'     => esc_html__( 'Custom button text', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'general_navbar_section',
		't_tab'    => array(
			'id'  => 'button_tabs',
			'tab' => esc_html__( 'Button [1]', 'omniverse' ),
		),
		'priority' => 60,
		'class'    => 'dn-tab-field dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'link_1_icon',
		'name'     => esc_html__( 'Custom button icon', 'omniverse' ),
		'type'     => 'upload',
		'section'  => 'general_navbar_section',
		't_tab'    => array(
			'id'  => 'button_tabs',
			'tab' => esc_html__( 'Button [1]', 'omniverse' ),
		),
		'priority' => 70,
		'class'    => 'dn-tab-field dn-last-tab-field',
	)
);

Options::add_field(
	array(
		'id'       => 'link_2_url',
		'name'     => esc_html__( 'Custom button URL', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'general_navbar_section',
		't_tab'    => array(
			'id'  => 'button_tabs',
			'tab' => esc_html__( 'Button [2]', 'omniverse' ),
		),
		'priority' => 80,
		'class'    => 'dn-tab-field dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'link_2_text',
		'name'     => esc_html__( 'Custom button text', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'general_navbar_section',
		't_tab'    => array(
			'id'  => 'button_tabs',
			'tab' => esc_html__( 'Button [2]', 'omniverse' ),
		),
		'priority' => 90,
		'class'    => 'dn-tab-field dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'link_2_icon',
		'name'     => esc_html__( 'Custom button icon', 'omniverse' ),
		'type'     => 'upload',
		'section'  => 'general_navbar_section',
		't_tab'    => array(
			'id'  => 'button_tabs',
			'tab' => esc_html__( 'Button [2]', 'omniverse' ),
		),
		'priority' => 100,
		'class'    => 'dn-tab-field dn-last-tab-field',
	)
);

Options::add_field(
	array(
		'id'       => 'link_3_url',
		'name'     => esc_html__( 'Custom button URL', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'general_navbar_section',
		't_tab'    => array(
			'id'  => 'button_tabs',
			'tab' => esc_html__( 'Button [3]', 'omniverse' ),
		),
		'priority' => 110,
		'class'    => 'dn-tab-field dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'link_3_text',
		'name'     => esc_html__( 'Custom button text', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'general_navbar_section',
		't_tab'    => array(
			'id'  => 'button_tabs',
			'tab' => esc_html__( 'Button [3]', 'omniverse' ),
		),
		'priority' => 120,
		'class'    => 'dn-tab-field dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'link_3_icon',
		'name'     => esc_html__( 'Custom button icon', 'omniverse' ),
		'type'     => 'upload',
		'section'  => 'general_navbar_section',
		't_tab'    => array(
			'id'  => 'button_tabs',
			'tab' => esc_html__( 'Button [3]', 'omniverse' ),
		),
		'priority' => 130,
		'class'    => 'dn-tab-field dn-last-tab-field',
	)
);

Options::add_field(
	array(
		'id'       => 'link_4_url',
		'name'     => esc_html__( 'Custom button URL', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'general_navbar_section',
		't_tab'    => array(
			'id'  => 'button_tabs',
			'tab' => esc_html__( 'Button [4]', 'omniverse' ),
		),
		'priority' => 140,
		'class'    => 'dn-tab-field dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'link_4_text',
		'name'     => esc_html__( 'Custom button text', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'general_navbar_section',
		't_tab'    => array(
			'id'  => 'button_tabs',
			'tab' => esc_html__( 'Button [4]', 'omniverse' ),
		),
		'priority' => 150,
		'class'    => 'dn-tab-field dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'link_4_icon',
		'name'     => esc_html__( 'Custom button icon', 'omniverse' ),
		'type'     => 'upload',
		'section'  => 'general_navbar_section',
		't_tab'    => array(
			'id'  => 'button_tabs',
			'tab' => esc_html__( 'Button [4]', 'omniverse' ),
		),
		'priority' => 160,
		'class'    => 'dn-tab-field dn-last-tab-field',
	)
);

Options::add_field(
	array(
		'id'       => 'link_5_url',
		'name'     => esc_html__( 'Custom button URL', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'general_navbar_section',
		't_tab'    => array(
			'id'  => 'button_tabs',
			'tab' => esc_html__( 'Button [5]', 'omniverse' ),
		),
		'priority' => 170,
		'class'    => 'dn-tab-field dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'link_5_text',
		'name'     => esc_html__( 'Custom button text', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'general_navbar_section',
		't_tab'    => array(
			'id'  => 'button_tabs',
			'tab' => esc_html__( 'Button [5]', 'omniverse' ),
		),
		'priority' => 180,
		'class'    => 'dn-tab-field dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'link_5_icon',
		'name'     => esc_html__( 'Custom button icon', 'omniverse' ),
		'type'     => 'upload',
		'section'  => 'general_navbar_section',
		't_tab'    => array(
			'id'  => 'button_tabs',
			'tab' => esc_html__( 'Button [5]', 'omniverse' ),
		),
		'priority' => 190,
		'class'    => 'dn-tab-field dn-last-tab-field',
	)
);

/**
 * Age verify.
 */
Options::add_field(
	array(
		'id'       => 'age_verify',
		'name'     => esc_html__( 'Enable age verification popup', 'omniverse' ),
		'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'general-enable-age-verification-popup.jpg" alt="">', 'omniverse' ), true ),
		'type'     => 'switcher',
		'section'  => 'age_verify_section',
		'default'  => false,
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'priority' => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'age_verify_text',
		'name'        => esc_html__( 'Popup message', 'omniverse' ),
		'description' => esc_html__( 'Write a message warning your visitors about age restriction on your website', 'omniverse' ),
		'default'     => '<h4 class="text-center">Are you over 18?</h4>
<p class="text-center">You must be 18 years of age or older to view page. Please verify your age to enter.</p>',
		'type'        => 'textarea',
		'wysiwyg'     => true,
		'section'     => 'age_verify_section',
		'group'       => esc_html__( 'Content', 'omniverse' ),
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'          => 'age_verify_text_error',
		'name'        => esc_html__( 'Error message', 'omniverse' ),
		'description' => esc_html__( 'This message will be displayed when the visitor don\'t verify his age.', 'omniverse' ),
		'default'     => '<h4 class="text-center">Access forbidden</h4>
<p class="text-center">Your access is restricted because of your age.</p>',
		'type'        => 'textarea',
		'wysiwyg'     => true,
		'section'     => 'age_verify_section',
		'group'       => esc_html__( 'Content', 'omniverse' ),
		'priority'    => 30,
	)
);

Options::add_field(
	array(
		'id'       => 'age_verify_background',
		'name'     => esc_html__( 'Background', 'omniverse' ),
		'type'     => 'background',
		'section'  => 'age_verify_section',
		'group'    => esc_html__( 'Style', 'omniverse' ),
		'selector' => 'div.wd-popup.wd-age-verify',
		'priority' => 40,
	)
);

Options::add_field(
	array(
		'id'       => 'age_verify_color_scheme',
		'name'     => esc_html__( 'Text color scheme', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'age_verify_section',
		'group'    => esc_html__( 'Style', 'omniverse' ),
		'options'  => array(
			'dark'  => array(
				'name'  => esc_html__( 'Dark', 'omniverse' ),
				'value' => 'dark',
			),
			'light' => array(
				'name'  => esc_html__( 'Light', 'omniverse' ),
				'value' => 'light',
			),
		),
		'default'  => 'dark',
		'priority' => 50,
	)
);

Options::add_field(
	array(
		'id'        => 'age_verify_width',
		'name'      => esc_html__( 'Width', 'omniverse' ),
		'type'      => 'range',
		'section'   => 'age_verify_section',
		'group'     => esc_html__( 'Style', 'omniverse' ),
		'default'   => 500,
		'min'       => 400,
		'step'      => 10,
		'max'       => 1000,
		'priority'  => 60,
		'selectors' => array(
			'div.wd-popup.wd-age-verify' => array(
				'max-width: {{VALUE}}px;',
			),
		),
		'unit'      => 'px',
	)
);

/**
 * Promo popup.
 */
Options::add_field(
	array(
		'id'          => 'promo_popup',
		'name'        => esc_html__( 'Enable promo popup', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'general-enable-promo-popup.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Show promo popup to users when they enter the site.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'promo_popup_section',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'default'     => false,
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'       => 'promo_popup_content_type',
		'name'     => esc_html__( 'Promo popup content', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'promo_popup_section',
		'options'  => array(
			'text'       => array(
				'name'  => esc_html__( 'Text', 'omniverse' ),
				'value' => 'text',
			),
			'html_block' => array(
				'name'  => esc_html__( 'HTML Block', 'omniverse' ),
				'value' => 'html_block',
			),
		),
		'group'    => esc_html__( 'Content', 'omniverse' ),
		'default'  => 'html_block',
		'priority' => 20,
		'class'    => 'dn-html-block-switch',
	)
);

Options::add_field(
	array(
		'id'       => 'popup_text',
		'type'     => 'textarea',
		'name'     => esc_html__( 'Text', 'omniverse' ),
		'wysiwyg'  => true,
		'section'  => 'promo_popup_section',
		'group'    => esc_html__( 'Content', 'omniverse' ),
		'requires' => array(
			array(
				'key'     => 'promo_popup_content_type',
				'compare' => 'equals',
				'value'   => 'text',
			),
		),
		'priority' => 30,
	)
);

Options::add_field(
	array(
		'id'           => 'popup_html_block',
		'type'         => 'select',
		'section'      => 'promo_popup_section',
		'name'         => esc_html__( 'HTML Block', 'omniverse' ),
		'group'        => esc_html__( 'Content', 'omniverse' ),
		'select2'      => true,
		'empty_option' => true,
		'autocomplete' => array(
			'type'   => 'post',
			'value'  => 'cms_block',
			'search' => 'omniverse_get_post_by_query_autocomplete',
			'render' => 'omniverse_get_post_by_ids_autocomplete',
		),
		'requires'     => array(
			array(
				'key'     => 'promo_popup_content_type',
				'compare' => 'equals',
				'value'   => 'html_block',
			),
		),
		'priority'     => 40,
	)
);

Options::add_field(
	array(
		'id'          => 'popup_scroll',
		'name'        => esc_html__( 'Show after user scroll down the page', 'omniverse' ),
		'description' => esc_html__( 'Set the number of pixels users have to scroll down before popup opens', 'omniverse' ),
		'type'        => 'range',
		'section'     => 'promo_popup_section',
		'default'     => 1000,
		'min'         => 100,
		'step'        => 50,
		'max'         => 5000,
		'priority'    => 50,
		'requires'    => array(
			array(
				'key'     => 'popup_event',
				'compare' => 'equals',
				'value'   => 'scroll',
			),
		),
		'unit'        => 'px',
	)
);

Options::add_field(
	array(
		'id'          => 'popup-background',
		'name'        => esc_html__( 'Popup background', 'omniverse' ),
		'description' => esc_html__( 'Set background image or color for promo popup', 'omniverse' ),
		'type'        => 'background',
		'group'       => esc_html__( 'Style', 'omniverse' ),
		'default'     => array(
			'color'    => '#111111',
			'repeat'   => 'no-repeat',
			'size'     => 'contain',
			'position' => 'left center',
		),
		'section'     => 'promo_popup_section',
		'selector'    => '.wd-popup.wd-promo-popup',
		'priority'    => 60,
	)
);

Options::add_field(
	array(
		'id'          => 'popup_color_scheme',
		'name'        => esc_html__( 'Popup text color', 'omniverse' ),
		'description' => esc_html__( 'Set light or dark text color scheme depending on the promo popup background color.', 'omniverse' ),
		'group'       => esc_html__( 'Style', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'promo_popup_section',
		'default'     => 'dark',
		'options'     => array(
			'dark'  => array(
				'name'  => esc_html__( 'Dark', 'omniverse' ),
				'value' => 'dark',
			),
			'light' => array(
				'name'  => esc_html__( 'Light', 'omniverse' ),
				'value' => 'light',
			),
		),
		'priority'    => 65,
	)
);

Options::add_field(
	array(
		'id'          => 'popup_width',
		'name'        => esc_html__( 'Popup width', 'omniverse' ),
		'description' => esc_html__( 'Set width of the promo popup in pixels.', 'omniverse' ),
		'type'        => 'range',
		'group'       => esc_html__( 'Style', 'omniverse' ),
		'section'     => 'promo_popup_section',
		'default'     => 800,
		'min'         => 400,
		'step'        => 10,
		'max'         => 1000,
		'priority'    => 70,
		'selectors'   => array(
			'div.wd-popup.wd-promo-popup' => array(
				'max-width: {{VALUE}}px;',
			),
		),
		'unit'        => 'px',
	)
);

Options::add_field(
	array(
		'id'            => 'popup_padding',
		'name'          => esc_html__( 'Popup padding', 'omniverse' ),
		'description'   => esc_html__( 'Set padding of the promo popup in pixels or percentages. The default value is 30px.', 'omniverse' ),
		'type'          => 'responsive_range',
		'group'         => esc_html__( 'Style', 'omniverse' ),
		'section'       => 'promo_popup_section',
		'selectors'     => array(
			':root' => array(
				'--wd-promo-popup-padding: {{VALUE}}{{UNIT}};',
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
				'max'  => 200,
				'step' => 1,
			),
			'%'  => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			),
		),
		'priority'      => 75,
	)
);

Options::add_field(
	array(
		'id'          => 'promo_popup_hide_mobile',
		'name'        => esc_html__( 'Hide on mobile devices', 'omniverse' ),
		'description' => esc_html__( 'You can disable this option on mobile devices completely.', 'omniverse' ),
		'type'        => 'switcher',
		'group'       => esc_html__( 'Settings', 'omniverse' ),
		'section'     => 'promo_popup_section',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'default'     => '1',
		'priority'    => 80,
	)
);

Options::add_field(
	array(
		'id'       => 'popup_event',
		'name'     => esc_html__( 'Show popup after', 'omniverse' ),
		'type'     => 'buttons',
		'group'    => esc_html__( 'Settings', 'omniverse' ),
		'section'  => 'promo_popup_section',
		'default'  => 'time',
		'options'  => array(
			'time'   => array(
				'name'  => esc_html__( 'Some time', 'omniverse' ),
				'value' => 'time',
			),
			'scroll' => array(
				'name'  => esc_html__( 'User scroll', 'omniverse' ),
				'value' => 'scroll',
			),
		),
		'priority' => 90,
	)
);

Options::add_field(
	array(
		'id'           => 'promo_timeout',
		'name'         => esc_html__( 'Popup delay', 'omniverse' ),
		'description'  => esc_html__( 'Show popup after some time (in milliseconds)', 'omniverse' ),
		'type'         => 'text_input',
		'attributes'   => array(
			'type' => 'number',
		),
		'group'        => esc_html__( 'Settings', 'omniverse' ),
		'section'      => 'promo_popup_section',
		'empty_option' => true,
		'default'      => '2000',
		'priority'     => 100,
		'requires'     => array(
			array(
				'key'     => 'popup_event',
				'compare' => 'equals',
				'value'   => 'time',
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'popup_pages',
		'name'        => esc_html__( 'Show after number of pages visited', 'omniverse' ),
		'description' => esc_html__( 'You can choose how many pages the user should visit before the popup will be shown.', 'omniverse' ),
		'type'        => 'range',
		'group'       => esc_html__( 'Settings', 'omniverse' ),
		'section'     => 'promo_popup_section',
		'default'     => 0,
		'min'         => 0,
		'step'        => 1,
		'max'         => 10,
		'priority'    => 110,
		'unit'        => 'page',
	)
);

Options::add_field(
	array(
		'id'          => 'promo_version',
		'name'        => esc_html__( 'Popup version', 'omniverse' ),
		'description' => esc_html__( 'If you apply any changes to your popup settings or content you might want to force the popup to all visitors who already closed it again. In this case, you just need to increase the banner version.', 'omniverse' ),
		'type'        => 'text_input',
		'attributes'  => array(
			'type' => 'number',
		),
		'group'       => esc_html__( 'Settings', 'omniverse' ),
		'section'     => 'promo_popup_section',
		'default'     => 1,
		'priority'    => 120,
	)
);

/**
 * Cookies.
 */
Options::add_field(
	array(
		'id'          => 'cookies_info',
		'name'        => esc_html__( 'Show cookies info', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'general-cookies-notice.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Under EU privacy regulations, websites must make it clear to visitors what information about them is being stored. This specifically includes cookies. Turn on this option and user will see info box at the bottom of the page that your web-site is using cookies.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'cookie_section',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'default'     => false,
		'priority'    => 10,
		'class'       => 'dn-tooltip-bordered',
	)
);

Options::add_field(
	array(
		'id'          => 'cookies_text',
		'name'        => esc_html__( 'Popup text', 'omniverse' ),
		'description' => esc_html__( 'Place here some information about cookies usage that will be shown in the popup.', 'omniverse' ),
		'group'       => esc_html__( 'Content', 'omniverse' ),
		'type'        => 'textarea',
		'wysiwyg'     => true,
		'section'     => 'cookie_section',
		'default'     => esc_html__( 'We use cookies to improve your experience on our website. By browsing this website, you agree to our use of cookies.', 'omniverse' ),
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'           => 'cookies_policy_page',
		'name'         => esc_html__( 'Page with details', 'omniverse' ),
		'description'  => esc_html__( 'Choose page that will contain detailed information about your Privacy Policy', 'omniverse' ),
		'group'        => esc_html__( 'Settings', 'omniverse' ),
		'type'         => 'select',
		'section'      => 'cookie_section',
		'options'      => '',
		'callback'     => 'omniverse_get_pages_array',
		'empty_option' => true,
		'select2'      => true,
		'priority'     => 30,
	)
);

Options::add_field(
	array(
		'id'          => 'cookies_version',
		'name'        => esc_html__( 'Cookies version', 'omniverse' ),
		'description' => esc_html__( 'If you change your cookie policy information you can increase their version to show the popup to all visitors again.', 'omniverse' ),
		'group'       => esc_html__( 'Settings', 'omniverse' ),
		'type'        => 'text_input',
		'attributes'  => array(
			'type' => 'number',
		),
		'section'     => 'cookie_section',
		'default'     => 1,
		'priority'    => 40,
	)
);

/**
 * Header banner.
 */
Options::add_field(
	array(
		'id'          => 'header_banner',
		'name'        => esc_html__( 'Header banner', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'general-header-banner.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Display a thin line above the header with your custom content. Useful for promotions and global messages.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'header_banner_section',
		'default'     => false,
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'header_banner_link',
		'name'        => esc_html__( 'Banner link', 'omniverse' ),
		'description' => esc_html__( 'The link will be added to the whole banner area.', 'omniverse' ),
		'group'       => esc_html__( 'Content', 'omniverse' ),
		'type'        => 'text_input',
		'section'     => 'header_banner_section',
		'tags'        => 'header banner text link',
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'       => 'header_banner_content_type',
		'name'     => esc_html__( 'Banner content', 'omniverse' ),
		'group'    => esc_html__( 'Content', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'header_banner_section',
		'options'  => array(
			'text'       => array(
				'name'  => esc_html__( 'Text', 'omniverse' ),
				'value' => 'text',
			),
			'html_block' => array(
				'name'  => esc_html__( 'HTML Block', 'omniverse' ),
				'value' => 'html_block',
			),
		),
		'default'  => 'text',
		'priority' => 25,
		'class'    => 'dn-html-block-switch',
	)
);

Options::add_field(
	array(
		'id'           => 'header_banner_html_block',
		'name'         => esc_html__( 'HTML Block', 'omniverse' ),
		'group'        => esc_html__( 'Content', 'omniverse' ),
		'type'         => 'select',
		'section'      => 'header_banner_section',
		'select2'      => true,
		'empty_option' => true,
		'autocomplete' => array(
			'type'   => 'post',
			'value'  => 'cms_block',
			'search' => 'omniverse_get_post_by_query_autocomplete',
			'render' => 'omniverse_get_post_by_ids_autocomplete',
		),
		'requires'     => array(
			array(
				'key'     => 'header_banner_content_type',
				'compare' => 'equals',
				'value'   => 'html_block',
			),
		),
		'priority'     => 30,
	)
);

Options::add_field(
	array(
		'id'       => 'header_banner_shortcode',
		'name'     => esc_html__( 'Banner content', 'omniverse' ),
		'group'    => esc_html__( 'Content', 'omniverse' ),
		'type'     => 'textarea',
		'wysiwyg'  => true,
		'section'  => 'header_banner_section',
		'tags'     => 'header banner text content',
		'requires' => array(
			array(
				'key'     => 'header_banner_content_type',
				'compare' => 'equals',
				'value'   => 'text',
			),
		),
		'priority' => 30,
	)
);

Options::add_field(
	array(
		'id'       => 'header_banner_bg',
		'name'     => esc_html__( 'Banner background', 'omniverse' ),
		'group'    => esc_html__( 'Style', 'omniverse' ),
		'type'     => 'background',
		'section'  => 'header_banner_section',
		'selector' => '.header-banner',
		'priority' => 40,
	)
);

Options::add_field(
	array(
		'id'          => 'header_banner_color',
		'name'        => esc_html__( 'Banner text color', 'omniverse' ),
		'description' => esc_html__( 'Set light or dark text color scheme depending on the banner\'s background color.', 'omniverse' ),
		'group'       => esc_html__( 'Style', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'header_banner_section',
		'default'     => 'light',
		'options'     => array(
			'dark'  => array(
				'name'  => esc_html__( 'Dark', 'omniverse' ),
				'value' => 'dark',
			),
			'light' => array(
				'name'  => esc_html__( 'Light', 'omniverse' ),
				'value' => 'light',
			),
		),
		'priority'    => 50,
	)
);

Options::add_field(
	array(
		'id'          => 'header_banner_height',
		'name'        => esc_html__( 'Banner height for desktop', 'omniverse' ),
		'description' => esc_html__( 'The height for the banner area in pixels on desktop devices.', 'omniverse' ),
		'group'       => esc_html__( 'Style', 'omniverse' ),
		'type'        => 'range',
		'section'     => 'header_banner_section',
		'default'     => 40,
		'min'         => 0,
		'step'        => 1,
		'max'         => 200,
		'selectors'   => array(
			':root' => array(
				'--wd-header-banner-h: {{VALUE}}px;',
			),
		),
		't_tab'       => array(
			'id'    => 'header_banner_height_tabs',
			'tab'   => esc_html__( 'Desktop', 'omniverse' ),
			'icon'  => 'dn-i-desktop',
			'style' => 'devices',
		),
		'priority'    => 60,
		'unit'        => 'px',
	)
);

Options::add_field(
	array(
		'id'          => 'header_banner_mobile_height',
		'name'        => esc_html__( 'Banner height for mobile', 'omniverse' ),
		'description' => esc_html__( 'The height for the banner area in pixels on mobile devices.', 'omniverse' ),
		'group'       => esc_html__( 'Style', 'omniverse' ),
		'type'        => 'range',
		'section'     => 'header_banner_section',
		'default'     => 40,
		'min'         => 0,
		'step'        => 1,
		'max'         => 200,
		'css_device'  => 'tablet',
		'selectors'   => array(
			':root' => array(
				'--wd-header-banner-h: {{VALUE}}px;',
			),
		),
		't_tab'       => array(
			'id'   => 'header_banner_height_tabs',
			'tab'  => esc_html__( 'Mobile', 'omniverse' ),
			'icon' => 'dn-i-phone',
		),
		'priority'    => 70,
		'unit'        => 'px',
	)
);

Options::add_field(
	array(
		'id'          => 'header_close_btn',
		'name'        => esc_html__( 'Close button', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'header-close-button.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Show close banner button', 'omniverse' ),
		'group'       => esc_html__( 'Settings', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'header_banner_section',
		'default'     => '1',
		'tags'        => 'header banner color background',
		'priority'    => 80,
	)
);

Options::add_field(
	array(
		'id'          => 'header_banner_version',
		'name'        => esc_html__( 'Banner version', 'omniverse' ),
		'description' => esc_html__( 'If you apply any changes to your banner settings or content you might want to force the banner to all visitors who already closed it again. In this case, you just need to increase the banner version.', 'omniverse' ),
		'group'       => esc_html__( 'Settings', 'omniverse' ),
		'type'        => 'text_input',
		'attributes'  => array(
			'type' => 'number',
		),
		'section'     => 'header_banner_section',
		'default'     => '1',
		'priority'    => 90,
		'requires'    => array(
			array(
				'key'     => 'header_close_btn',
				'compare' => 'equals',
				'value'   => true,
			),
		),
	)
);

/**
 * Search.
 */
Options::add_field(
	array(
		'id'          => 'enqueue_posts_results',
		'name'        => esc_html__( 'Display results from blog', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'display-results-from-blog.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Enable this option to show search results from the blog below the product results.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'general_search',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'default'     => false,
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'       => 'search_posts_results_column',
		'name'     => esc_html__( 'Number of columns for blog results', 'omniverse' ),
		'type'     => 'range',
		'section'  => 'general_search',
		'default'  => 2,
		'min'      => 2,
		'step'     => 1,
		'max'      => 6,
		'requires' => array(
			array(
				'key'     => 'enqueue_posts_results',
				'compare' => 'equals',
				'value'   => true,
			),
		),
		'priority' => 20,
		'unit'     => 'col',
	)
);

Options::add_field(
	array(
		'id'       => 'search_by_sku',
		'name'     => esc_html__( 'Search by product SKU', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'general_search',
		'default'  => '1',
		'priority' => 30,
	)
);

Options::add_field(
	array(
		'id'          => 'relevanssi_search',
		'name'        => esc_html__( 'Use Relevanssi for AJAX search', 'omniverse' ),
		'description' => wp_kses(
			__( 'You will need to install and activate this <a href="https://wordpress.org/plugins/relevanssi/" target="_blank">plugin</a>', 'omniverse' ),
			true
		),
		'type'        => 'switcher',
		'section'     => 'general_search',
		'default'     => '0',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 40,
	)
);

Options::add_field(
	array(
		'id'          => 'popular_requests',
		'name'        => esc_html__( 'Popular requests', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'popular-requests.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Show quick buttons under the search form with popular search requests. Separate words with new lines.', 'omniverse' ),
		'group'       => esc_html__( 'Full screen search', 'omniverse' ),
		'type'        => 'textarea',
		'wysiwyg'     => false,
		'section'     => 'general_search',
		'default'     => '',
		'priority'    => 50,
	)
);

Options::add_field(
	array(
		'id'       => 'full_search_content_type',
		'name'     => esc_html__( 'Full screen search extra content', 'omniverse' ),
		'hint'     => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'full-screen-search-extra-content.mp4" autoplay loop muted></video>',
		'type'     => 'buttons',
		'section'  => 'general_search',
		'group'    => esc_html__( 'Full screen search', 'omniverse' ),
		'default'  => 'content',
		'options'  => array(
			'text'    => array(
				'name'  => esc_html__( 'Text', 'omniverse' ),
				'value' => 'text',
			),
			'content' => array(
				'name'  => esc_html__( 'HTML Block', 'omniverse' ),
				'value' => 'content',
			),
		),
		'priority' => 60,
		'class'    => 'dn-html-block-switch',
	)
);

Options::add_field(
	array(
		'id'          => 'full_search_content_text',
		'type'        => 'textarea',
		'name'        => esc_html__( 'Full-screen search text', 'omniverse' ),
		'description' => esc_html__( 'You can display some products, posts, banners or other information in the full screen search.', 'omniverse' ),
		'group'       => esc_html__( 'Full screen search', 'omniverse' ),
		'wysiwyg'     => true,
		'section'     => 'general_search',
		'requires'    => array(
			array(
				'key'     => 'full_search_content_type',
				'compare' => 'equals',
				'value'   => 'text',
			),
		),
		'priority'    => 70,
	)
);

Options::add_field(
	array(
		'id'           => 'full_search_content_html_block',
		'name'         => esc_html__( 'Full screen search custom content', 'omniverse' ),
		'description'  => esc_html__( 'You can display some products, posts, banners or other information in the full screen search.', 'omniverse' ),
		'group'        => esc_html__( 'Full screen search', 'omniverse' ),
		'type'         => 'select',
		'section'      => 'general_search',
		'select2'      => true,
		'empty_option' => true,
		'autocomplete' => array(
			'type'   => 'post',
			'value'  => 'cms_block',
			'search' => 'omniverse_get_post_by_query_autocomplete',
			'render' => 'omniverse_get_post_by_ids_autocomplete',
		),
		'priority'     => 80,
		'requires'     => array(
			array(
				'key'     => 'full_search_content_type',
				'compare' => 'equals',
				'value'   => 'content',
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'ajax_fullscreen_content',
		'name'        => esc_html__( 'AJAX full screen search extra content', 'omniverse' ),
		'description' => esc_html__( 'Load full screen search extra content HTML with AJAX', 'omniverse' ),
		'group'       => esc_html__( 'Full screen search', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'general_search',
		'default'     => true,
		'priority'    => 90,
	)
);
