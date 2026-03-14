<?php
/**
 * Accordion for accordion element.
 *
 * @package Elements.
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

if ( ! function_exists( 'omniverse_get_vc_map_accordion' ) ) {
	/**
	 * Displays the shortcode settings fields in the admin.
	 */
	function omniverse_get_vc_map_accordion() {
		$secondary_font = omniverse_get_opt( 'secondary-font' );
		$primary_font   = omniverse_get_opt( 'primary-font' );
		$text_font      = omniverse_get_opt( 'text-font' );

		$secondary_font_title = isset( $secondary_font[0] ) ? esc_html__( 'Secondary font', 'omniverse' ) . ' (' . $secondary_font[0]['font-family'] . ')' : esc_html__( 'Secondary font', 'omniverse' );
		$text_font_title      = isset( $text_font[0] ) ? esc_html__( 'Text font', 'omniverse' ) . ' (' . $text_font[0]['font-family'] . ')' : esc_html__( 'Text', 'omniverse' );
		$primary_font_title   = isset( $primary_font[0] ) ? esc_html__( 'Title font', 'omniverse' ) . ' (' . $primary_font[0]['font-family'] . ')' : esc_html__( 'Title font', 'omniverse' );

		return array(
				'base'            => 'omniverse_accordion',
				'name'            => esc_html__( 'Accordion', 'omniverse' ),
				'description'     => esc_html__( 'Tabbed content', 'omniverse' ),
				'category'        => function_exists( 'omniverse_get_tab_title_category_for_wpb' ) ? omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ) : esc_html__( 'Theme elements', 'omniverse' ),
				'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/accordion.svg',
				'as_parent'       => array( 'only' => 'omniverse_accordion_item' ),
				'content_element' => true,
				'js_view'         => 'VcColumnView',
				'default_content' => '[omniverse_accordion_item title="Accordion title"]Ac non ac hac ullamcorper rhoncus velit maecenas convallis torquent elit accumsan eu est pulvinar pretium congue a vestibulum suspendisse scelerisque condimentum parturient quam.Aliquet faucibus condimentum amet nam a nascetur suspendisse habitant a mollis senectus suscipit a vestibulum primis molestie parturient aptent nisi aenean.A scelerisque quam consectetur condimentum risus lobortis cum dignissim mi fusce primis rhoncus a rhoncus bibendum parturient condimentum odio a justo a et mollis pulvinar venenatis metus sodales elementum.Parturient ullamcorper natoque mi sagittis a nibh nisi a suspendisse a.[/omniverse_accordion_item][omniverse_accordion_item title="Accordion title"]Ac non ac hac ullamcorper rhoncus velit maecenas convallis torquent elit accumsan eu est pulvinar pretium congue a vestibulum suspendisse scelerisque condimentum parturient quam.Aliquet faucibus condimentum amet nam a nascetur suspendisse habitant a mollis senectus suscipit a vestibulum primis molestie parturient aptent nisi aenean.A scelerisque quam consectetur condimentum risus lobortis cum dignissim mi fusce primis rhoncus a rhoncus bibendum parturient condimentum odio a justo a et mollis pulvinar venenatis metus sodales elementum.Parturient ullamcorper natoque mi sagittis a nibh nisi a suspendisse a.[/omniverse_accordion_item][omniverse_accordion_item title="Accordion title"]Ac non ac hac ullamcorper rhoncus velit maecenas convallis torquent elit accumsan eu est pulvinar pretium congue a vestibulum suspendisse scelerisque condimentum parturient quam.Aliquet faucibus condimentum amet nam a nascetur suspendisse habitant a mollis senectus suscipit a vestibulum primis molestie parturient aptent nisi aenean.A scelerisque quam consectetur condimentum risus lobortis cum dignissim mi fusce primis rhoncus a rhoncus bibendum parturient condimentum odio a justo a et mollis pulvinar venenatis metus sodales elementum.Parturient ullamcorper natoque mi sagittis a nibh nisi a suspendisse a.[/omniverse_accordion_item]',
				'params'          => array(
					/**
					 * General Settings.
					 */
					array(
						'param_name' => 'omniverse_css_id',
						'type'       => 'omniverse_css_id',
						'group'      => esc_html__( 'Title', 'omniverse' ),
					),
					array(
						'param_name' => 'accordion_general_divider',
						'type'       => 'omniverse_title_divider',
						'title'      => esc_html__( 'Style', 'omniverse' ),
						'group'      => esc_html__( 'Title', 'omniverse' ),
						'holder'     => 'div',
					),
					array(
						'param_name'       => 'style',
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Style', 'omniverse' ),
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'value'            => array(
							esc_html__( 'Default', 'omniverse' )  => 'default',
							esc_html__( 'Shadow', 'omniverse' )   => 'shadow',
							esc_html__( 'Simple', 'omniverse' )   => 'simple',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name'       => 'state',
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Items state', 'omniverse' ),
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'value'            => array(
							esc_html__( 'First opened', 'omniverse' ) => 'first',
							esc_html__( 'All closed', 'omniverse' ) => 'all_closed',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'type'             => 'wd_box_shadow',
						'param_name'       => 'box_shadow',
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'heading'          => esc_html__( 'Box shadow', 'omniverse' ),
						'selectors'        => array(
							'{{WRAPPER}}.wd-style-shadow .wd-accordion-item' => array(
								'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
							),
						),
						'edit_field_class' => 'vc_col-sm-12 vc_column',
						'dependency'       => array(
							'element' => 'style',
							'value'   => array( 'shadow' ),
						),
						'default'          => array(
							'horizontal' => '0',
							'vertical'   => '0',
							'blur'       => '9',
							'spread'     => '0',
							'color'      => 'rgba(0, 0, 0, .15)',
						),
					),
					array(
						'param_name'       => 'title_text_alignment',
						'type'             => 'omniverse_image_select',
						'heading'          => esc_html__( 'Alignment', 'omniverse' ),
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'value'            => array(
							esc_html__( 'Left', 'omniverse' ) => 'left',
							esc_html__( 'Right', 'omniverse' ) => 'right',
						),
						'images_value'     => array(
							'left'  => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
							'right' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
						),
						'std'              => 'left',
						'omni_tooltip'     => true,
						'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
					),
					array(
						'heading'          => esc_html__( 'Hide top & bottom border', 'omniverse' ),
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'type'             => 'omniverse_switch',
						'param_name'       => 'hide_top_bottom_border',
						'true_state'       => 'yes',
						'false_state'      => 'no',
						'default'          => 'no',
						'dependency'       => array(
							'element' => 'style',
							'value'   => array( 'default' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					/**
					 * Title Settings.
					 */
					array(
						'param_name' => 'accordion_typography_divider',
						'type'       => 'omniverse_title_divider',
						'title'      => esc_html__( 'Typography', 'omniverse' ),
						'group'      => esc_html__( 'Title', 'omniverse' ),
						'holder'     => 'div',
					),
					array(
						'param_name'       => 'title_font_family',
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Font family', 'omniverse' ),
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'value'            => array(
							$primary_font_title   => 'primary',
							$text_font_title      => 'text',
							$secondary_font_title => 'alt',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name'       => 'title_font_size',
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Predefined size', 'omniverse' ),
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'value'            => array(
							esc_html__( 'Small (16px)', 'omniverse' ) => 's',
							esc_html__( 'Extra Small (14px)', 'omniverse' ) => 'xs',
							esc_html__( 'Medium (18px)', 'omniverse' ) => 'm',
							esc_html__( 'Large (22px)', 'omniverse' ) => 'l',
							esc_html__( 'Extra Large (26px)', 'omniverse' ) => 'xl',
							esc_html__( 'Custom', 'omniverse' ) => 'custom',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name'       => 'title_custom_font_size',
						'type'             => 'omniverse_responsive_size',
						'heading'          => esc_html__( 'Custom font size', 'omniverse' ),
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'css_args'         => array(
							'font-size' => array(
								' .wd-fontsize-custom',
							),
						),
						'dependency'       => array(
							'element' => 'title_font_size',
							'value'   => array( 'custom' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name'       => 'title_line_height',
						'type'             => 'omniverse_responsive_size',
						'heading'          => esc_html__( 'Custom line height', 'omniverse' ),
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'css_args'         => array(
							'line-height' => array(
								' .wd-fontsize-custom',
							),
						),
						'dependency'       => array(
							'element' => 'title_font_size',
							'value'   => array( 'custom' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name'       => 'title_font_weight',
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Font weight', 'omniverse' ),
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'value'            => array(
							esc_html__( 'Inherit', 'omniverse' ) => '',
							esc_html__( 'Ultra-Light 100', 'omniverse' ) => 100,
							esc_html__( 'Light 200', 'omniverse' ) => 200,
							esc_html__( 'Book 300', 'omniverse' ) => 300,
							esc_html__( 'Normal 400', 'omniverse' ) => 400,
							esc_html__( 'Medium 500', 'omniverse' ) => 500,
							esc_html__( 'Semi-Bold 600', 'omniverse' ) => 600,
							esc_html__( 'Bold 700', 'omniverse' ) => 700,
							esc_html__( 'Extra-Bold 800', 'omniverse' ) => 800,
							esc_html__( 'Ultra-Bold 900', 'omniverse' ) => 900,
						),
						'std'              => 600,
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name'       => 'title_text_color_scheme',
						'type'             => 'omniverse_dropdown',
						'heading'          => esc_html__( 'Color scheme', 'omniverse' ),
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'value'            => array(
							esc_html__( 'Inherit', 'omniverse' ) => 'inherit',
							esc_html__( 'Dark', 'omniverse' ) => 'dark',
							esc_html__( 'Light', 'omniverse' ) => 'light',
							esc_html__( 'Custom', 'omniverse' ) => 'custom',
						),
						'style'            => array(
							'dark' => '#2d2a2a',
						),
						'std'              => 'inherit',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name'       => 'custom_title_text_color',
						'type'             => 'omniverse_colorpicker',
						'heading'          => esc_html__( 'Text color', 'omniverse' ),
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'css_args'         => array(
							'color' => array(
								' .wd-accordion-title-text',
							),
						),
						'dependency'       => array(
							'element' => 'title_text_color_scheme',
							'value'   => array( 'custom' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name'       => 'custom_title_text_hover_color',
						'type'             => 'omniverse_colorpicker',
						'heading'          => esc_html__( 'Text hover color', 'omniverse' ),
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'css_args'         => array(
							'color' => array(
								' .wd-accordion-title-text:hover',
							),
						),
						'dependency'       => array(
							'element' => 'title_text_color_scheme',
							'value'   => array( 'custom' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name'       => 'custom_title_text_active_color',
						'type'             => 'omniverse_colorpicker',
						'heading'          => esc_html__( 'Text active color', 'omniverse' ),
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'css_args'         => array(
							'color' => array(
								'.wd-accordion:not(.wd-inited) .wd-accordion-item:first-child .wd-accordion-title-text',
								' .wd-accordion-title.wd-active .wd-accordion-title-text',
							),
						),
						'dependency'       => array(
							'element' => 'title_text_color_scheme',
							'value'   => array( 'custom' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					/**
					 * Opener.
					 */
					array(
						'param_name' => 'accordion_opener_divider',
						'type'       => 'omniverse_title_divider',
						'title'      => esc_html__( 'Opener', 'omniverse' ),
						'group'      => esc_html__( 'Title', 'omniverse' ),
						'holder'     => 'div',
					),
					array(
						'param_name'       => 'opener_style',
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Style', 'omniverse' ),
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'value'            => array(
							esc_html__( 'Arrow', 'omniverse' ) => 'arrow',
							esc_html__( 'Plus', 'omniverse' ) => 'plus',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name'       => 'opener_alignment',
						'type'             => 'omniverse_image_select',
						'heading'          => esc_html__( 'Alignment', 'omniverse' ),
						'group'            => esc_html__( 'Title', 'omniverse' ),
						'value'            => array(
							esc_html__( 'Left', 'omniverse' ) => 'left',
							esc_html__( 'Right', 'omniverse' ) => 'right',
						),
						'images_value'     => array(
							'left'  => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
							'right' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
						),
						'std'              => 'left',
						'omni_tooltip'     => true,
						'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
					),
					/**
					 * Content Settings.
					 */
					array(
						'param_name' => 'content_typography_divider',
						'type'       => 'omniverse_title_divider',
						'title'      => esc_html__( 'Typography', 'omniverse' ),
						'group'      => esc_html__( 'Content', 'omniverse' ),
						'holder'     => 'div',
					),
					array(
						'param_name'       => 'content_font_family',
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Font family', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'value'            => array(
							esc_html__( 'Inherit', 'omniverse' ) => '',
							$primary_font_title   => 'primary',
							$text_font_title      => 'text',
							$secondary_font_title => 'alt',
						),
						'std'              => '',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name'       => 'content_font_size',
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Predefined size', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'value'            => array(
							esc_html__( 'Inherit', 'omniverse' ) => '',
							esc_html__( 'Small (16px)', 'omniverse' ) => 's',
							esc_html__( 'Extra Small (14px)', 'omniverse' ) => 'xs',
							esc_html__( 'Medium (18px)', 'omniverse' ) => 'm',
							esc_html__( 'Large (22px)', 'omniverse' ) => 'l',
							esc_html__( 'Extra Large (26px)', 'omniverse' ) => 'xl',
							esc_html__( 'Custom', 'omniverse' ) => 'custom',
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name'       => 'content_custom_font_size',
						'type'             => 'omniverse_responsive_size',
						'heading'          => esc_html__( 'Custom font size', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'css_args'         => array(
							'font-size' => array(
								' .wd-fontsize-custom',
							),
						),
						'dependency'       => array(
							'element' => 'content_font_size',
							'value'   => array( 'custom' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name'       => 'content_line_height',
						'type'             => 'omniverse_responsive_size',
						'heading'          => esc_html__( 'Custom line height', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'css_args'         => array(
							'line-height' => array(
								' .wd-fontsize-custom',
							),
						),
						'dependency'       => array(
							'element' => 'content_font_size',
							'value'   => array( 'custom' ),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name'       => 'content_font_weight',
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Font weight', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'value'            => array(
							esc_html__( 'Inherit', 'omniverse' ) => '',
							esc_html__( 'Ultra-Light 100', 'omniverse' ) => 100,
							esc_html__( 'Light 200', 'omniverse' ) => 200,
							esc_html__( 'Book 300', 'omniverse' ) => 300,
							esc_html__( 'Normal 400', 'omniverse' ) => 400,
							esc_html__( 'Medium 500', 'omniverse' ) => 500,
							esc_html__( 'Semi-Bold 600', 'omniverse' ) => 600,
							esc_html__( 'Bold 700', 'omniverse' ) => 700,
							esc_html__( 'Extra-Bold 800', 'omniverse' ) => 800,
							esc_html__( 'Ultra-Bold 900', 'omniverse' ) => 900,
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name'       => 'content_text_color_scheme',
						'type'             => 'omniverse_dropdown',
						'heading'          => esc_html__( 'Color scheme', 'omniverse' ),
						'group'            => esc_html__( 'Content', 'omniverse' ),
						'value'            => array(
							esc_html__( 'Inherit', 'omniverse' ) => 'inherit',
							esc_html__( 'Dark', 'omniverse' ) => 'dark',
							esc_html__( 'Light', 'omniverse' ) => 'light',
							esc_html__( 'Custom', 'omniverse' ) => 'custom',
						),
						'style'            => array(
							'dark' => '#2d2a2a',
						),
						'std'              => 'inherit',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'param_name' => 'content_text_color_custom',
						'type'       => 'omniverse_colorpicker',
						'heading'    => esc_html__( 'Custom Color', 'omniverse' ),
						'group'      => esc_html__( 'Content', 'omniverse' ),
						'css_args'   => array(
							'color' => array(
								' .wd-accordion-content',
							),
						),
						'dependency' => array(
							'element' => 'content_text_color_scheme',
							'value'   => array( 'custom' ),
						),
					),
					array(
						'type'       => 'css_editor',
						'heading'    => esc_html__( 'CSS box', 'omniverse' ),
						'param_name' => 'css',
						'group'      => esc_html__( 'Design Options', 'js_composer' ),
					),
					/**
					 * Animations Settings.
					 */
					array(
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Theme Animation', 'omniverse' ),
						'hint'             => esc_html__( 'Use custom theme animations if you want to run them in the slider element.' ),
						'param_name'       => 'wd_animation',
						'group'            => esc_html__( 'Advanced', 'omniverse' ),
						'admin_label'      => true,
						'value'            => array(
							esc_html__( 'None', 'omniverse' )       => '',
							esc_html__( 'Slide from top', 'omniverse' ) => 'slide-from-top',
							esc_html__( 'Slide from bottom', 'omniverse' ) => 'slide-from-bottom',
							esc_html__( 'Slide from left', 'omniverse' ) => 'slide-from-left',
							esc_html__( 'Slide from right', 'omniverse' ) => 'slide-from-right',
							esc_html__( 'Slide short from left', 'omniverse' ) => 'slide-short-from-left',
							esc_html__( 'Slide short from right', 'omniverse' ) => 'slide-short-from-right',
							esc_html__( 'Flip X bottom', 'omniverse' ) => 'bottom-flip-x',
							esc_html__( 'Flip X top', 'omniverse' ) => 'top-flip-x',
							esc_html__( 'Flip Y left', 'omniverse' ) => 'left-flip-y',
							esc_html__( 'Flip Y right', 'omniverse' ) => 'right-flip-y',
							esc_html__( 'Zoom in', 'omniverse' )    => 'zoom-in',
						),
						'std'              => '',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
					),
					array(
						'type'             => 'textfield',
						'heading'          => esc_html__( 'Theme Animation Delay (ms)', 'omniverse' ),
						'param_name'       => 'wd_animation_delay',
						'group'            => esc_html__( 'Advanced', 'omniverse' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'dependency'       => array(
							'element'            => 'wd_animation',
							'value_not_equal_to' => array( '' ),
						),
					),
					array(
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Theme Animation duration', 'omniverse' ),
						'param_name'       => 'wd_animation_duration',
						'group'            => esc_html__( 'Advanced', 'omniverse' ),
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'value'            => array(
							esc_html__( 'Slow', 'omniverse' )   => 'slow',
							esc_html__( 'Normal', 'omniverse' ) => 'normal',
							esc_html__( 'Fast', 'omniverse' )   => 'fast',
						),
						'dependency'       => array(
							'element'            => 'wd_animation',
							'value_not_equal_to' => array( '' ),
						),
						'std'              => 'normal',
					),

					omniverse_get_vc_responsive_spacing_map(),

					omniverse_get_vc_responsive_visible_map( 'responsive_tabs_hide' ),
					omniverse_get_vc_responsive_visible_map( 'wd_hide_on_desktop' ),
					omniverse_get_vc_responsive_visible_map( 'wd_hide_on_tablet' ),
					omniverse_get_vc_responsive_visible_map( 'wd_hide_on_mobile' ),
				),
			);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_accordion_item' ) ) {
	function omniverse_get_vc_map_accordion_item() {
		return array(
			'base'            => 'omniverse_accordion_item',
			'name'            => esc_html__( 'Accordion Item', 'omniverse' ),
			'description'     => esc_html__( 'Add accordion item in accordion area', 'omniverse' ),
			'category'        => function_exists( 'omniverse_get_tab_title_category_for_wpb' ) ? omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ) : esc_html__( 'Theme elements', 'omniverse' ),
			'icon'            => OMNIVERSE_ASSETS . '/images/vc-icon/accordion-item.svg',
			'as_child'        => array( 'only' => 'omniverse_accordion' ),
			'content_element' => true,
			'params'          => array(
				/**
				 * Title.
				 */
				array(
					'param_name' => 'title',
					'type'       => 'textarea',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'omniverse' ),
				),
				/**
				 * Content.
				 */
				array(
					'param_name' => 'content_divider',
					'type'       => 'omniverse_title_divider',
					'title'      => esc_html__( 'Content', 'omniverse' ),
				),
				array(
					'param_name'       => 'content_type',
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Content type', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Text', 'omniverse' ) => 'text',
						esc_html__( 'HTML Block', 'omniverse' ) => 'html_block',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name' => 'content',
					'type'       => 'textarea_html',
					'heading'    => esc_html__( 'Content', 'omniverse' ),
					'dependency' => array(
						'element' => 'content_type',
						'value'   => array( 'text' ),
					),
				),
				array(
					'param_name' => 'html_block_id',
					'type'       => 'omniverse_dropdown',
					'heading'    => esc_html__( 'Select block', 'omniverse' ),
					'callback'   => 'omniverse_get_html_blocks_array_with_empty',
					'dependency' => array(
						'element' => 'content_type',
						'value'   => array( 'html_block' ),
					),
				),

				/**
				 * Icon.
				 */
				array(
					'param_name' => 'icon_divider',
					'type'       => 'omniverse_title_divider',
					'title'      => esc_html__( 'Icon settings', 'omniverse' ),
					'holder'     => 'div',
				),
				array(
					'param_name'       => 'icon_type',
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'List type', 'omniverse' ),
					'value'            => array(
						esc_html__( 'With icon', 'omniverse' ) => 'icon',
						esc_html__( 'With image', 'omniverse' ) => 'image',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'image',
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Image', 'omniverse' ),
					'value'            => '',
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'image' ),
					),
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'image_size',
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'image' ),
					),
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name'       => 'icon_libraries',
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Icon library', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Font Awesome', 'omniverse' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'omniverse' )  => 'openiconic',
						esc_html__( 'Typicons', 'omniverse' )     => 'typicons',
						esc_html__( 'Entypo', 'omniverse' )       => 'entypo',
						esc_html__( 'Linecons', 'omniverse' )     => 'linecons',
						esc_html__( 'Mono Social', 'omniverse' )  => 'monosocial',
						esc_html__( 'Material', 'omniverse' )     => 'material',
					),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => 'icon',
					),
					'hint'             => esc_html__( 'Select icon library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'param_name' => 'icon_fontawesome',
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'settings'   => array(
						'emptyIcon'    => true,
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_libraries',
						'value'   => 'fontawesome',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'param_name' => 'icon_openiconic',
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'openiconic',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_libraries',
						'value'   => 'openiconic',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'param_name' => 'icon_typicons',
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'typicons',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_libraries',
						'value'   => 'typicons',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'param_name' => 'icon_entypo',
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'entypo',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_libraries',
						'value'   => 'entypo',
					),
				),
				array(
					'param_name' => 'icon_linecons',
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'linecons',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_libraries',
						'value'   => 'linecons',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'param_name' => 'icon_monosocial',
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'monosocial',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_libraries',
						'value'   => 'monosocial',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'param_name' => 'icon_material',
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'material',
						'iconsPerPage' => 50,
					),
					'dependency' => array(
						'element' => 'icon_libraries',
						'value'   => 'material',
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
			),
		);
	}
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	/**
	 * Create omniverse accordion wrapper.
	 */
	class WPBakeryShortCode_omniverse_accordion extends WPBakeryShortCodesContainer {}
}
