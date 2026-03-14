<?php
if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

use DN\Admin\Modules\Options;

Options::add_field(
	array(
		'id'          => 'insta_token',
		'name'        => esc_html__( 'Connect instagram account', 'omniverse' ),
		'description' => wp_kses(
			__( 'To get this data, follow the instructions in our documentation <a href="https://zynxsol.com/docs/omniverse/faq-guides/setup-instagram-api/" target="_blank">here</a>.', 'omniverse' ),
			true
		),
		'type'        => 'instagram_api',
		'section'     => 'instagram_api_section',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'insta_delete_outdated_images',
		'name'        => esc_html__( 'Delete outdated images', 'omniverse' ),
		'description' => esc_html__( 'This option will delete outdated images from the Media library automatically and keep only the latest from your account. Works with images added to the Media library starting from OmniVerse 7.2 version.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'instagram_api_section',
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'          => 'google_map_api_key',
		'name'        => esc_html__( 'Google map API key', 'omniverse' ),
		'type'        => 'text_input',
		'description' => wp_kses(
			__( 'Obtain API key <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">here</a> to use our Google Map VC element.', 'omniverse' ),
			true
		),
		'section'     => 'google_api_section',
		'tags'        => 'google api key',
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'       => 'fb_app_id',
		'name'     => esc_html__( 'Facebook app ID', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'social_login_api_section',
		't_tab'    => [
			'id'    => 'social_login_tabs',
			'icon'  => 'dn-i-facebook',
			'tab'   => esc_html__( 'Facebook', 'omniverse' ),
			'style' => 'default',
		],
		'priority' => 30,
		'class'    => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'fb_app_secret',
		'name'     => esc_html__( 'Facebook app secret', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'social_login_api_section',
		't_tab'    => [
			'id'   => 'social_login_tabs',
			'icon' => 'dn-i-facebook',
			'tab'  => esc_html__( 'Facebook', 'omniverse' ),
		],
		'priority' => 40,
		'class'    => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'fb_notice',
		'type'     => 'notice',
		'style'    => 'info',
		'name'     => '',
		'content'  => wp_kses(
			__(
				'Enable login with Facebook on your web-site.
				To do that you need to create an APP on the Facebook <a href="https://developers.facebook.com/" target="_blank">https://developers.facebook.com/</a>.
				Then go to APP settings and copy App ID and App Secret there. You also need to insert Redirect URI like this example <strong>{{PERMALINK}}facebook/int_callback</strong> More information you can get in our <a href="https://zynxsol.com/docs/omniverse/faq-guides/configure-facebook-login/" target="_blank">documentation</a>.',
				'omniverse'
			),
			true
		),
		'section'  => 'social_login_api_section',
		't_tab'    => [
			'id'    => 'social_login_tabs',
			'icon'  => 'dn-i-facebook',
			'tab'   => esc_html__( 'Facebook', 'omniverse' ),
		],
		'priority' => 50,
	)
);

Options::add_field(
	array(
		'id'       => 'goo_app_id',
		'name'     => esc_html__( 'Google app ID', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'social_login_api_section',
		't_tab'    => [
			'id'   => 'social_login_tabs',
			'icon' => 'dn-i-google',
			'tab'  => esc_html__( 'Google', 'omniverse' ),
		],
		'priority' => 60,
		'class'    => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'goo_app_secret',
		'name'     => esc_html__( 'Google app secret', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'social_login_api_section',
		't_tab'    => [
			'id'  => 'social_login_tabs',
			'icon' => 'dn-i-google',
			'tab' => esc_html__( 'Google', 'omniverse' ),
		],
		'priority' => 70,
		'class'    => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'goo_notice',
		'type'     => 'notice',
		'style'    => 'info',
		'name'     => '',
		'content'  => wp_kses(
			__(
				'You can enable login with Google on your web-site.
			To do that you need to Create a Google APIs project at <a href="https://console.cloud.google.com/home/dashboard" target="_blank">https://console.developers.google.com/apis/dashboard/</a>.
			Make sure to go to API Access tab and Create an OAuth 2.0 client ID. Choose Web application for Application type. Make sure that redirect URI is set to actual OAuth 2.0 callback URL, usually <strong>{{PERMALINK}}google/oauth2callback </strong> More information you can get in our <a href="https://zynxsol.com/docs/omniverse/faq-guides/configure-google-login/" target="_blank">documentation</a>.',
				'omniverse'
			),
			true
		),
		'section'  => 'social_login_api_section',
		't_tab'    => [
			'id'   => 'social_login_tabs',
			'icon' => 'dn-i-google',
			'tab'  => esc_html__( 'Google', 'omniverse' ),
		],
		'priority' => 80,
	)
);

Options::add_field(
	array(
		'id'       => 'vk_app_id',
		'name'     => esc_html__( 'VKontakte app ID', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'social_login_api_section',
		't_tab'    => [
			'id'   => 'social_login_tabs',
			'icon' => 'dn-i-vk',
			'tab'  => esc_html__( 'VKontakte', 'omniverse' ),
		],
		'priority' => 90,
		'class'    => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'vk_app_secret',
		'name'     => esc_html__( 'VKontakte app secret', 'omniverse' ),
		'type'     => 'text_input',
		'section'  => 'social_login_api_section',
		't_tab'    => [
			'id'   => 'social_login_tabs',
			'icon' => 'dn-i-vk',
			'tab'  => esc_html__( 'VKontakte', 'omniverse' ),
		],
		'priority' => 100,
		'class'    => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'vk_notice',
		'type'     => 'notice',
		'style'    => 'info',
		'name'     => '',
		'content'  => wp_kses(
			__(
				'To enable login with vk.com you need to create an APP here <a href="https://vk.com/dev" target="_blank">https://vk.com/dev</a>.
			Then go to APP settings and copy App ID and App Secret there.
			You also need to insert Redirect URI like this example <strong>{{PERMALINK}}vkontakte/int_callback</strong>',
				'omniverse'
			),
			true
		),
		'section'  => 'social_login_api_section',
		't_tab'    => [
			'id'   => 'social_login_tabs',
			'icon' => 'dn-i-vk',
			'tab'  => esc_html__( 'VKontakte', 'omniverse' ),
		],
		'priority' => 110,
	)
);

Options::add_field(
	array(
		'id'          => 'alt_auth_method',
		'name'        => esc_html__( 'Alternative login mechanism', 'omniverse' ),
		'description' => esc_html__( 'Enable it if you are redirected to my account page without signing in after click on the social login button.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'social_login_api_section',
		'default'     => '0',
		'priority'    => 120,
	)
);