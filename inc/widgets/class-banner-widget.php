<?php
/**
 * This file creates OMNIVERSE Banner Widget.
 *
 * @package Omniverse
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
};

if ( ! class_exists( 'OMNIVERSE_Banner_Widget' ) ) {
	/**
	 * Register widget based on VC_MAP parameters that display banner shortcode
	 */
	class OMNIVERSE_Banner_Widget extends WPH_Widget {

		/**
		 * This method creates these widgets.
		 */
		public function __construct() {
			if ( ! function_exists( 'omniverse_get_banner_params' ) ) {
				return;
			};

			$secondary_font = omniverse_get_opt( 'secondary-font' );
			$text_font      = omniverse_get_opt( 'text-font' );
			$primary_font   = omniverse_get_opt( 'primary-font' );

			$secondary_font_title = isset( $secondary_font[0] ) ? esc_html__( 'Secondary', 'omniverse' ) . ' (' . $secondary_font[0]['font-family'] . ')' : esc_html__( 'Secondary', 'omniverse' );
			$text_font_title      = isset( $text_font[0] ) ? esc_html__( 'Text', 'omniverse' ) . ' (' . $text_font[0]['font-family'] . ')' : esc_html__( 'Text', 'omniverse' );
			$primary_font_title   = isset( $primary_font[0] ) ? esc_html__( 'Primary', 'omniverse' ) . ' (' . $primary_font[0]['font-family'] . ')' : esc_html__( 'Primary', 'omniverse' );

			$this->create_widget(
				array(
					'label'       => esc_html__( 'OMNIVERSE Banner', 'omniverse' ),
					'description' => esc_html__( 'Promo banner with text', 'omniverse' ),
					'slug'        => 'omniverse-banner',
					'fields'      => array(
						/**
						 * Image.
						 */
						array(
							'type'       => 'omniverse_title_divider',
							'holder'     => 'div',
							'title'      => esc_html__( 'Image', 'omniverse' ),
							'param_name' => 'image_divider',
						),
						array(
							'type'             => 'attach_image',
							'heading'          => esc_html__( 'Image', 'omniverse' ),
							'param_name'       => 'image',
							'value'            => '',
							'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Image size', 'omniverse' ),
							'param_name'  => 'img_size',
							'description' => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\'.', 'omniverse' ),
						),
						array(
							'type'             => 'omniverse_slider',
							'heading'          => esc_html__( 'Banner height', 'omniverse' ),
							'param_name'       => 'height',
							'min'              => '100',
							'max'              => '2000',
							'step'             => '1',
							'default'          => '300',
							'units'            => 'px',
							'value'            => array(
								'600' => '600',
								'500' => '500',
								'400' => '400',
								'350' => '350',
								'300' => '300',
								'250' => '250',
								'200' => '200',
								'150' => '150',
								'100' => '100',
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
							'hint'             => esc_html__( 'Default: 300', 'omniverse' ),
						),
						array(
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Image Position', 'omniverse' ),
							'param_name'       => 'image_bg_position',
							'value'            => array(
								esc_html__( 'Center', 'omniverse' ) => 'center',
								esc_html__( 'Top', 'omniverse' )    => 'top',
								esc_html__( 'Bottom', 'omniverse' ) => 'bottom',
								esc_html__( 'Left', 'omniverse' )   => 'left',
								esc_html__( 'Right', 'omniverse' )  => 'right',
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'       => 'vc_link',
							'heading'    => esc_html__( 'Banner link', 'omniverse' ),
							'param_name' => 'link',
							'hint'       => esc_html__( 'Enter URL if you want this banner to have a link.', 'omniverse' ),
						),
						/**
						 * Style.
						 */
						array(
							'type'       => 'omniverse_title_divider',
							'holder'     => 'div',
							'title'      => esc_html__( 'Style', 'omniverse' ),
							'param_name' => 'style_divider',
						),
						array(
							'type'             => 'omniverse_image_select',
							'heading'          => esc_html__( 'Banner style', 'omniverse' ),
							'param_name'       => 'style',
							'value'            => array(
								esc_html__( 'Default', 'omniverse' ) => 'default',
								esc_html__( 'Color mask', 'omniverse' ) => 'mask',
								esc_html__( 'Mask with shadow', 'omniverse' ) => 'shadow',
								esc_html__( 'Bordered', 'omniverse' ) => 'border',
								esc_html__( 'Bordered background', 'omniverse' ) => 'background',
								esc_html__( 'Content background', 'omniverse' ) => 'content-background',
							),
							'images_value'     => array(
								'default'            => OMNIVERSE_ASSETS_IMAGES . '/settings/banner-style/default.png',
								'mask'               => OMNIVERSE_ASSETS_IMAGES . '/settings/banner-style/mask.png',
								'shadow'             => OMNIVERSE_ASSETS_IMAGES . '/settings/banner-style/shadow.png',
								'border'             => OMNIVERSE_ASSETS_IMAGES . '/settings/banner-style/border.png',
								'background'         => OMNIVERSE_ASSETS_IMAGES . '/settings/banner-style/background.png',
								'content-background' => OMNIVERSE_ASSETS_IMAGES . '/settings/banner-style/content-background.png',
							),
							'omni_tooltip'     => true,
							'hint'             => esc_html__( 'You can use some of our predefined styles for your banner content.', 'omniverse' ),
							'edit_field_class' => 'vc_col-xs-12 vc_column banner-style',
						),
						array(
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Hover effect', 'omniverse' ),
							'param_name'       => 'hover',
							'value'            => array(
								esc_html__( 'Zoom image', 'omniverse' ) => 'zoom',
								esc_html__( 'Parallax', 'omniverse' ) => 'parallax',
								esc_html__( 'Background', 'omniverse' ) => 'background',
								esc_html__( 'Bordered', 'omniverse' ) => 'border',
								esc_html__( 'Zoom reverse', 'omniverse' ) => 'zoom-reverse',
								esc_html__( 'Disable', 'omniverse' ) => 'none',
							),
							'hint'             => esc_html__( 'Set beautiful hover effects for your banner.', 'omniverse' ),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'omniverse_button_set',
							'heading'          => esc_html__( 'Color Scheme', 'omniverse' ),
							'param_name'       => 'omniverse_color_scheme',
							'value'            => array(
								esc_html__( 'Inherit', 'omniverse' ) => '',
								esc_html__( 'Light', 'omniverse' ) => 'light',
								esc_html__( 'Dark', 'omniverse' )  => 'dark',
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'omniverse_colorpicker',
							'heading'          => esc_html__( 'Content background color', 'omniverse' ),
							'param_name'       => 'custom_content_bg_color',
							'css_args'         => array(
								'background-color' => array(
									' .wrapper-content-banner',
								),
							),
							'dependency'       => array(
								'element' => 'style',
								'value'   => array( 'content-background' ),
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						/**
						 * Extra.
						 */
						array(
							'type'       => 'omniverse_title_divider',
							'holder'     => 'div',
							'title'      => esc_html__( 'Extra options', 'omniverse' ),
							'param_name' => 'extra_divider',
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
							'param_name' => 'el_class',
							'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
						),
						/**
						 * Title.
						 */
						array(
							'type'       => 'omniverse_title_divider',
							'holder'     => 'div',
							'title'      => esc_html__( 'Title', 'omniverse' ),
							'group'      => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name' => 'title_divider',
						),
						array(
							'type'       => 'textarea',
							'heading'    => esc_html__( 'Title', 'omniverse' ),
							'param_name' => 'title',
							'holder'     => 'div',
							'group'      => esc_html__( 'Title and Subtitle', 'omniverse' ),
						),
						array(
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Font', 'omniverse' ),
							'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name'       => 'title_font',
							'value'            => array(
								esc_html__( 'Default', 'omniverse' ) => '',
								$text_font_title      => 'text',
								$primary_font_title   => 'primary',
								$secondary_font_title => 'alt',
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Title tag', 'omniverse' ),
							'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name'       => 'title_tag',
							'value'            => array(
								'h1'   => 'h1',
								'h2'   => 'h2',
								'h3'   => 'h3',
								'h4'   => 'h4',
								'h5'   => 'h5',
								'h6'   => 'h6',
								'p'    => 'p',
								'div'  => 'div',
								'span' => 'span',
							),
							'std'              => 'h4',
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Predefined title size', 'omniverse' ),
							'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name'       => 'title_size',
							'value'            => array(
								esc_html__( 'Default (22px)', 'omniverse' ) => 'default',
								esc_html__( 'Small (16px)', 'omniverse' ) => 'small',
								esc_html__( 'Large (26px)', 'omniverse' ) => 'large',
								esc_html__( 'Extra Large (36px)', 'omniverse' ) => 'extra-large',
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Font weight', 'omniverse' ),
							'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name'       => 'font_weight',
							'value'            => array(
								'' => '',
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
							'type'             => 'omniverse_responsive_size',
							'heading'          => esc_html__( 'Custom font size', 'omniverse' ),
							'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name'       => 'custom_title_size',
							'css_args'         => array(
								'font-size' => array(
									' .banner-title',
								),
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'omniverse_responsive_size',
							'heading'          => esc_html__( 'Custom line height', 'omniverse' ),
							'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name'       => 'custom_title_line_height',
							'css_args'         => array(
								'line-height' => array(
									' .banner-title',
								),
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'       => 'omniverse_empty_space',
							'param_name' => 'omniverse_empty_space',
							'group'      => esc_html__( 'Title and Subtitle', 'omniverse' ),
						),
						array(
							'type'             => 'omniverse_colorpicker',
							'heading'          => esc_html__( 'Color', 'omniverse' ),
							'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name'       => 'custom_title_color',
							'css_args'         => array(
								'color' => array(
									' .banner-title',
								),
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						/**
						 * Subtitle.
						 */
						array(
							'type'       => 'omniverse_title_divider',
							'holder'     => 'div',
							'title'      => esc_html__( 'Subtitle', 'omniverse' ),
							'group'      => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name' => 'subtitle_divider',
						),
						array(
							'type'       => 'textarea',
							'heading'    => esc_html__( 'Sub title', 'omniverse' ),
							'param_name' => 'subtitle',
							'group'      => esc_html__( 'Title and Subtitle', 'omniverse' ),
						),
						array(
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Font', 'omniverse' ),
							'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name'       => 'subtitle_font',
							'value'            => array(
								esc_html__( 'Default', 'omniverse' ) => '',
								$text_font_title      => 'text',
								$primary_font_title   => 'primary',
								$secondary_font_title => 'alt',
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Font weight', 'omniverse' ),
							'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name'       => 'subtitle_font_weight',
							'value'            => array(
								'' => '',
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
							'type'             => 'omniverse_responsive_size',
							'heading'          => esc_html__( 'Size', 'omniverse' ),
							'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name'       => 'custom_subtitle_size',
							'css_args'         => array(
								'font-size' => array(
									' .banner-subtitle',
								),
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'omniverse_responsive_size',
							'heading'          => esc_html__( 'Line height', 'omniverse' ),
							'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name'       => 'custom_subtitle_line_height',
							'css_args'         => array(
								'line-height' => array(
									' .banner-subtitle',
								),
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'       => 'omniverse_empty_space',
							'param_name' => 'omniverse_empty_space',
							'group'      => esc_html__( 'Title and Subtitle', 'omniverse' ),
						),
						array(
							'type'             => 'omniverse_dropdown',
							'heading'          => esc_html__( 'Predefined subtitle color scheme', 'omniverse' ),
							'param_name'       => 'subtitle_color',
							'value'            => array(
								esc_html__( 'Default', 'omniverse' ) => 'default',
								esc_html__( 'Primary', 'omniverse' ) => 'primary',
								esc_html__( 'Alternative', 'omniverse' ) => 'alt',
							),
							'style'            => array(
								'default' => '#f3f3f3',
								'primary' => omniverse_get_color_value( 'primary-color', '#7eb934' ),
								'alt'     => omniverse_get_color_value( 'secondary-color', '#fbbc34' ),
							),
							'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'omniverse_colorpicker',
							'heading'          => esc_html__( 'Custom color', 'omniverse' ),
							'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name'       => 'custom_subtitle_color',
							'css_args'         => array(
								'color' => array(
									' .banner-subtitle',
								),
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'omniverse_image_select',
							'heading'          => esc_html__( 'Subtitle style', 'omniverse' ),
							'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name'       => 'subtitle_style',
							'value'            => array(
								esc_html__( 'Default', 'omniverse' ) => 'default',
								esc_html__( 'Background', 'omniverse' ) => 'background',
							),
							'images_value'     => array(
								'default'    => OMNIVERSE_ASSETS_IMAGES . '/settings/subtitle-style/default.png',
								'background' => OMNIVERSE_ASSETS_IMAGES . '/settings/subtitle-style/background.png',
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'omniverse_colorpicker',
							'heading'          => esc_html__( 'Background color', 'omniverse' ),
							'group'            => esc_html__( 'Title and Subtitle', 'omniverse' ),
							'param_name'       => 'custom_subtitle_bg_color',
							'css_args'         => array(
								'background-color' => array(
									' .banner-subtitle',
								),
							),
							'dependency'       => array(
								'element' => 'subtitle_style',
								'value'   => array( 'background' ),
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						/**
						 * Content.
						 */
						array(
							'type'       => 'omniverse_title_divider',
							'holder'     => 'div',
							'title'      => esc_html__( 'Content', 'omniverse' ),
							'group'      => esc_html__( 'Content', 'omniverse' ),
							'param_name' => 'content_divider',
						),
						array(
							'type'       => 'textarea_html',
							'holder'     => 'div',
							'heading'    => esc_html__( 'Banner content', 'omniverse' ),
							'group'      => esc_html__( 'Content', 'omniverse' ),
							'param_name' => 'content',
							'hint'       => esc_html__( 'Add here few words to your banner image.', 'omniverse' ),
						),
						array(
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Text size', 'omniverse' ),
							'group'            => esc_html__( 'Content', 'omniverse' ),
							'param_name'       => 'content_text_size',
							'value'            => array(
								esc_html__( 'Default (14px)', 'omniverse' ) => 'default',
								esc_html__( 'Medium (16px)', 'omniverse' ) => 'medium',
								esc_html__( 'Large (18px)', 'omniverse' ) => 'large',
								esc_html__( 'Custom', 'omniverse' ) => 'custom',
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'omniverse_colorpicker',
							'heading'          => esc_html__( 'Color', 'omniverse' ),
							'group'            => esc_html__( 'Content', 'omniverse' ),
							'param_name'       => 'custom_text_color',
							'css_args'         => array(
								'color' => array(
									' .banner-inner',
								),
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'omniverse_responsive_size',
							'heading'          => esc_html__( 'Size', 'omniverse' ),
							'group'            => esc_html__( 'Content', 'omniverse' ),
							'param_name'       => 'custom_text_size',
							'css_args'         => array(
								'font-size' => array(
									' .banner-inner',
								),
							),
							'dependency'       => array(
								'element' => 'content_text_size',
								'value'   => array( 'custom' ),
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'omniverse_responsive_size',
							'heading'          => esc_html__( 'Line height', 'omniverse' ),
							'group'            => esc_html__( 'Content', 'omniverse' ),
							'param_name'       => 'custom_text_line_height',
							'css_args'         => array(
								'line-height' => array(
									' .banner-inner',
								),
							),
							'dependency'       => array(
								'element' => 'content_text_size',
								'value'   => array( 'custom' ),
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						/**
						 * Button.
						 */
						array(
							'type'       => 'omniverse_title_divider',
							'holder'     => 'div',
							'title'      => esc_html__( 'Button', 'omniverse' ),
							'group'      => esc_html__( 'Button', 'omniverse' ),
							'param_name' => 'button_divider',
						),
						array(
							'type'             => 'textfield',
							'heading'          => esc_html__( 'Button text', 'omniverse' ),
							'param_name'       => 'btn_text',
							'group'            => esc_html__( 'Button', 'omniverse' ),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'omniverse_button_set',
							'heading'          => esc_html__( 'Button position', 'omniverse' ),
							'param_name'       => 'btn_position',
							'value'            => array(
								esc_html__( 'Show on hover', 'omniverse' ) => 'hover',
								esc_html__( 'Static', 'omniverse' ) => 'static',
							),
							'group'            => esc_html__( 'Button', 'omniverse' ),
							'dependency'       => array(
								'element'            => 'style',
								'value_not_equal_to' => array( 'content-background' ),
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'omniverse_dropdown',
							'group'            => esc_html__( 'Button', 'omniverse' ),
							'heading'          => esc_html__( 'Predefined button color', 'omniverse' ),
							'param_name'       => 'btn_color',
							'value'            => array(
								esc_html__( 'Default', 'omniverse' ) => 'default',
								esc_html__( 'Primary color', 'omniverse' ) => 'primary',
								esc_html__( 'Alternative color', 'omniverse' ) => 'alt',
								esc_html__( 'White', 'omniverse' ) => 'white',
								esc_html__( 'Black', 'omniverse' ) => 'black',
							),
							'style'            => array(
								'default' => '#f3f3f3',
								'primary' => omniverse_get_color_value( 'primary-color', '#7eb934' ),
								'alt'     => omniverse_get_color_value( 'secondary-color', '#fbbc34' ),
								'black'   => '#212121',
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Button size', 'omniverse' ),
							'param_name'       => 'btn_size',
							'value'            => array(
								esc_html__( 'Default', 'omniverse' ) => 'default',
								esc_html__( 'Extra Small', 'omniverse' ) => 'extra-small',
								esc_html__( 'Small', 'omniverse' ) => 'small',
								esc_html__( 'Large', 'omniverse' ) => 'large',
								esc_html__( 'Extra Large', 'omniverse' ) => 'extra-large',
							),
							'group'            => esc_html__( 'Button', 'omniverse' ),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'omniverse_image_select',
							'heading'          => esc_html__( 'Button style', 'omniverse' ),
							'group'            => esc_html__( 'Button', 'omniverse' ),
							'param_name'       => 'btn_style',
							'value'            => array(
								esc_html__( 'Flat', 'omniverse' ) => 'default',
								esc_html__( 'Bordered', 'omniverse' ) => 'bordered',
								esc_html__( 'Link button', 'omniverse' ) => 'link',
								esc_html__( '3D', 'omniverse' ) => '3d',
							),
							'images_value'     => array(
								'default'  => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/default.png',
								'bordered' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/bordered.png',
								'link'     => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/link.png',
								'3d'       => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/style/3d.png',
							),
							'title'            => false,
							'std'              => 'default',
							'edit_field_class' => 'vc_col-xs-12 vc_column button-style',
						),
						array(
							'type'             => 'omniverse_image_select',
							'heading'          => esc_html__( 'Button shape', 'omniverse' ),
							'group'            => esc_html__( 'Button', 'omniverse' ),
							'param_name'       => 'btn_shape',
							'value'            => array(
								esc_html__( 'Rectangle', 'omniverse' ) => 'rectangle',
								esc_html__( 'Circle', 'omniverse' ) => 'round',
								esc_html__( 'Round', 'omniverse' ) => 'semi-round',
							),
							'images_value'     => array(
								'rectangle'  => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/shape/rectangle.jpeg',
								'round'      => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/shape/circle.jpeg',
								'semi-round' => OMNIVERSE_ASSETS_IMAGES . '/settings/buttons/shape/round.jpeg',
							),
							'dependency'       => array(
								'element'            => 'btn_style',
								'value_not_equal_to' => array( 'round', 'link' ),
							),
							'title'            => false,
							'std'              => 'rectangle',
							'edit_field_class' => 'vc_col-xs-12 vc_column button-shape',
						),
						array(
							'type'             => 'omniverse_switch',
							'heading'          => esc_html__( 'Hide button on tablet', 'omniverse' ),
							'group'            => esc_html__( 'Button', 'omniverse' ),
							'param_name'       => 'hide_btn_tablet',
							'true_state'       => 'yes',
							'false_state'      => 'no',
							'default'          => 'no',
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'omniverse_switch',
							'heading'          => esc_html__( 'Hide button on mobile', 'omniverse' ),
							'group'            => esc_html__( 'Button', 'omniverse' ),
							'param_name'       => 'hide_btn_mobile',
							'true_state'       => 'yes',
							'false_state'      => 'no',
							'default'          => 'no',
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						/**
						 * Layouts.
						 */
						array(
							'type'       => 'omniverse_title_divider',
							'holder'     => 'div',
							'title'      => esc_html__( 'Layouts', 'omniverse' ),
							'group'      => esc_html__( 'Layouts', 'omniverse' ),
							'param_name' => 'positioning_divider',
						),
						array(
							'type'             => 'omniverse_image_select',
							'heading'          => esc_html__( 'Content horizontal alignment', 'omniverse' ),
							'group'            => esc_html__( 'Layouts', 'omniverse' ),
							'param_name'       => 'horizontal_alignment',
							'value'            => array(
								esc_html__( 'Left', 'omniverse' ) => 'left',
								esc_html__( 'Center', 'omniverse' ) => 'center',
								esc_html__( 'Right', 'omniverse' ) => 'right',
							),
							'images_value'     => array(
								'left'   => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/horizontal/left.png',
								'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/horizontal/center.png',
								'right'  => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/horizontal/right.png',
							),
							'std'              => 'left',
							'omni_tooltip'     => true,
							'edit_field_class' => 'vc_col-sm-6 vc_column content-position',
						),
						array(
							'type'             => 'omniverse_image_select',
							'heading'          => esc_html__( 'Content vertical alignment', 'omniverse' ),
							'param_name'       => 'vertical_alignment',
							'group'            => esc_html__( 'Layouts', 'omniverse' ),
							'value'            => array(
								esc_html__( 'Top', 'omniverse' ) => 'top',
								esc_html__( 'Middle', 'omniverse' ) => 'middle',
								esc_html__( 'Bottom', 'omniverse' ) => 'bottom',
							),
							'images_value'     => array(
								'top'    => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/vertical/top.png',
								'middle' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/vertical/middle.png',
								'bottom' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/vertical/bottom.png',
							),
							'std'              => 'top',
							'omni_tooltip'     => true,
							'edit_field_class' => 'vc_col-sm-6 vc_column content-position',
						),
						array(
							'type'             => 'omniverse_image_select',
							'heading'          => esc_html__( 'Text alignment', 'omniverse' ),
							'group'            => esc_html__( 'Layouts', 'omniverse' ),
							'param_name'       => 'text_alignment',
							'value'            => array(
								esc_html__( 'Left', 'omniverse' ) => 'left',
								esc_html__( 'Center', 'omniverse' ) => 'center',
								esc_html__( 'Right', 'omniverse' ) => 'right',
							),
							'images_value'     => array(
								'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
								'left'   => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
								'right'  => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
							),
							'std'              => 'left',
							'omni_tooltip'     => true,
							'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
						),
						array(
							'type'             => 'dropdown',
							'heading'          => esc_html__( 'Content width', 'omniverse' ),
							'group'            => esc_html__( 'Layouts', 'omniverse' ),
							'param_name'       => 'content_width',
							'value'            => array(
								'100%' => '100',
								'90%'  => '90',
								'80%'  => '80',
								'70%'  => '70',
								'60%'  => '60',
								'50%'  => '50',
								'40%'  => '40',
								'30%'  => '30',
								'20%'  => '20',
								'10%'  => '10',
							),
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						array(
							'type'             => 'omniverse_switch',
							'heading'          => esc_html__( 'Increase spaces', 'omniverse' ),
							'group'            => esc_html__( 'Layouts', 'omniverse' ),
							'param_name'       => 'increase_spaces',
							'hint'             => esc_html__( 'Suggest to use this option if you have large banners. Padding will be set in percentage to your screen width.', 'omniverse' ),
							'true_state'       => 'yes',
							'false_state'      => 'no',
							'default'          => 'no',
							'edit_field_class' => 'vc_col-sm-6 vc_column',
						),
						/**
						 * Deprecated.
						 */
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Title desktop text size ( > 1024px )', 'omniverse' ),
							'param_name' => 'title_desktop_text_size',
							'hint'       => esc_html__( 'Only number without px.', 'omniverse' ),
							'group'      => esc_html__( 'Custom size', 'omniverse' ),
							'dependency' => array(
								'element' => 'title_size',
								'value'   => array( 'custom' ),
							),
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Title tablet text size ( < 1024px )', 'omniverse' ),
							'param_name' => 'title_tablet_text_size',
							'hint'       => esc_html__( 'Only number without px.', 'omniverse' ),
							'group'      => esc_html__( 'Custom size', 'omniverse' ),
							'dependency' => array(
								'element' => 'title_size',
								'value'   => array( 'custom' ),
							),
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Title mobile text size ( < 767px )', 'omniverse' ),
							'param_name' => 'title_mobile_text_size',
							'hint'       => esc_html__( 'Only number without px.', 'omniverse' ),
							'group'      => esc_html__( 'Custom size', 'omniverse' ),
							'dependency' => array(
								'element' => 'title_size',
								'value'   => array( 'custom' ),
							),
						),
						/**
						 * Subtitle custom size.
						 */
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Subtitle desktop text size ( > 1024px )', 'omniverse' ),
							'param_name' => 'subtitle_desktop_text_size',
							'hint'       => esc_html__( 'Only number without px.', 'omniverse' ),
							'group'      => esc_html__( 'Custom size', 'omniverse' ),
							'dependency' => array(
								'element' => 'title_size',
								'value'   => array( 'custom' ),
							),
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Subtitle tablet text size ( < 1024px )', 'omniverse' ),
							'param_name' => 'subtitle_tablet_text_size',
							'hint'       => esc_html__( 'Only number without px.', 'omniverse' ),
							'group'      => esc_html__( 'Custom size', 'omniverse' ),
							'dependency' => array(
								'element' => 'title_size',
								'value'   => array( 'custom' ),
							),
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Subtitle mobile text size ( < 767px )', 'omniverse' ),
							'param_name' => 'subtitle_mobile_text_size',
							'hint'       => esc_html__( 'Only number without px.', 'omniverse' ),
							'group'      => esc_html__( 'Custom size', 'omniverse' ),
							'dependency' => array(
								'element' => 'title_size',
								'value'   => array( 'custom' ),
							),
						),
					),
				)
			);
		}

		/**
		 * This method render this widget.
		 *
		 * @param array $args general settings for this widget.
		 * @param array $instance the value of the options for output.
		 */
		public function widget( $args, $instance ) {
			if ( $this->is_widget_preview() ) {
				return;
			}

			$instance['custom_height'] = 'yes';

			extract( $args );

			echo wp_kses_post( $before_widget );

			echo omniverse_shortcode_promo_banner( $instance, $instance['content'] );

			echo wp_kses_post( $after_widget );
		}
	}
}
