<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );
/**
* ------------------------------------------------------------------------------------------------
* Twitter element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_twitter' ) ) {
	function omniverse_get_vc_map_twitter() {
		return array(
			'name' => esc_html__( 'X (Twitter)', 'omniverse' ),
			'base' => 'omniverse_twitter',
			'category' => omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Shows posts from any X account', 'omniverse' ),
			'icon' => OMNIVERSE_ASSETS . '/images/vc-icon/twitter.svg',
			'params' => array(
				array(
					'param_name' => 'omniverse_css_id',
					'type'       => 'omniverse_css_id',
				),
				/**
				 * Widget settings
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Widget settings', 'omniverse' ),
					'param_name' => 'widget_divider',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'X Name (without @ symbol)', 'omniverse' ),
					'param_name' => 'name',
					'value' => 'x',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of posts', 'omniverse' ),
					'param_name' => 'num_tweets',
					'value' => 5,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Size of Avatar', 'omniverse' ),
					'param_name' => 'avatar_size',
					'hint' => esc_html__( 'Default: 48px', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_switch',
					'heading' => esc_html__( 'Show your avatar image', 'omniverse' ),
					'param_name' => 'show_avatar',
					'true_state' => 1,
					'false_state' => 0,
					'default' => 0,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'omniverse_switch',
					'heading' => esc_html__( 'Exclude Replies', 'omniverse' ),
					'param_name' => 'exclude_replies',
					'true_state' => 1,
					'false_state' => 0,
					'default' => 0,
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Access settings
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Access settings', 'omniverse' ),
					'param_name' => 'access_divider',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Consumer Key', 'omniverse' ),
					'param_name' => 'consumer_key',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Consumer Secret', 'omniverse' ),
					'param_name' => 'consumer_secret',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Access Token', 'omniverse' ),
					'param_name' => 'access_token',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Access Token Secret', 'omniverse' ),
					'param_name' => 'accesstoken_secret',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Extra
				 */
				array(
					'type' => 'omniverse_title_divider',
					'holder' => 'div',
					'title' => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_divider'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				omniverse_get_vc_responsive_spacing_map(),
			)
		);
	}
}
