<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}
/**
* ------------------------------------------------------------------------------------------------
* Promo Banner element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_promo_banner' ) ) {
	function omniverse_get_vc_map_promo_banner() {
		return array(
			'name'        => esc_html__( 'Promo Banner', 'omniverse' ),
			'base'        => 'promo_banner',
			'class'       => '',
			'category'    => function_exists( 'omniverse_get_tab_title_category_for_wpb' ) ?
				omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ) : esc_html__( 'Theme elements', 'omniverse' ),
			'description' => esc_html__( 'Promo image with text and hover effect', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/promo-banner.svg',
			'params'      => omniverse_get_banner_params(),
		);
	}
}

if ( ! function_exists( 'omniverse_get_vc_map_banners_carousel' ) ) {
	function omniverse_get_vc_map_banners_carousel() {
		return array(
			'name'                    => esc_html__( 'Banners carousel', 'omniverse' ),
			'base'                    => 'banners_carousel',
			'as_parent'               => array( 'only' => 'promo_banner' ),
			'content_element'         => true,
			'show_settings_on_create' => true,
			'category'                => function_exists( 'omniverse_get_tab_title_category_for_wpb' ) ?
				omniverse_get_tab_title_category_for_wpb( esc_html__( 'Theme elements', 'omniverse' ) ) : esc_html__( 'Theme elements', 'omniverse' ),
			'description'             => esc_html__( 'Show your banners as a carousel', 'omniverse' ),
			'icon'                    => OMNIVERSE_ASSETS . '/images/vc-icon/banners-carousel.svg',
			'params'                  => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Carousel', 'omniverse' ),
					'param_name' => 'slider_divider',
				),

				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				function_exists( 'omniverse_get_vc_responsive_spacing_map' ) ? omniverse_get_vc_responsive_spacing_map() : '',
				/**
				 * Extra
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Extra options', 'omniverse' ),
					'group'      => esc_html__( 'Advanced', 'omniverse' ),
					'param_name' => 'extra_divider',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'group'      => esc_html__( 'Advanced', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
			),
			'js_view'                 => 'VcColumnView',
		);
	}
}

if ( ! function_exists( 'omniverse_get_banner_params' ) ) {
	function omniverse_get_banner_params() {
		$secondary_font = omniverse_get_opt( 'secondary-font' );
		$text_font      = omniverse_get_opt( 'text-font' );
		$primary_font   = omniverse_get_opt( 'primary-font' );

		$secondary_font_title = isset( $secondary_font[0] ) ? esc_html__( 'Secondary font', 'omniverse' ) . ' (' . $secondary_font[0]['font-family'] . ')' : esc_html__( 'Secondary font', 'omniverse' );
		$text_font_title      = isset( $text_font[0] ) ? esc_html__( 'Text font', 'omniverse' ) . ' (' . $text_font[0]['font-family'] . ')' : esc_html__( 'Text', 'omniverse' );
		$primary_font_title   = isset( $primary_font[0] ) ? esc_html__( 'Title font', 'omniverse' ) . ' (' . $primary_font[0]['font-family'] . ')' : esc_html__( 'Title font', 'omniverse' );

		return apply_filters(
			'omniverse_get_banner_params',
			array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				/**
				* Image
				*/
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Background', 'omniverse' ),
					'param_name' => 'image_divider',
				),
				array(
					'type'       => 'omniverse_button_set',
					'heading'    => esc_html__( 'Source', 'omniverse' ),
					'param_name' => 'source_type',
					'value'      => array(
						esc_html__( 'Image', 'omniverse' ) => 'image',
						esc_html__( 'Video', 'omniverse' ) => 'video',
					),
					'default'    => 'image',
				),
				array(
					'type'            => 'wd_upload',
					'heading'         => esc_html__( 'Video', 'omniverse' ),
					'param_name'      => 'video',
					'attachment_type' => 'video',
					'value'           => '',
					'hint'            => esc_html__( 'Select video from media library.', 'omniverse' ),
					'dependency'      => array(
						'element' => 'source_type',
						'value'   => array( 'video' ),
					),
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Fallback image', 'omniverse' ),
					'param_name'       => 'video_poster',
					'value'            => '',
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency'       => array(
						'element' => 'source_type',
						'value'   => array( 'video' ),
					),
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Fallback image size', 'omniverse' ),
					'param_name'       => 'video_poster_size',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'source_type',
						'value'   => array( 'video' ),
					),
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Image', 'omniverse' ),
					'param_name'       => 'image',
					'value'            => '',
					'hint'             => esc_html__( 'Select image from media library.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency'       => array(
						'element' => 'source_type',
						'value'   => array( 'image' ),
					),
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'param_name'       => 'img_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'source_type',
						'value'   => array( 'image' ),
					),
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Fixed height', 'omniverse' ),
					'param_name'       => 'custom_height',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
				),
				array(
					'type'             => 'wd_slider',
					'heading'          => esc_html__( 'Banner Height', 'omniverse' ),
					'param_name'       => 'new_height',
					'selectors'  => array(
						'{{WRAPPER}}' => array(
							'--wd-img-height: {{VALUE}}{{UNIT}};',
						),
					),
					'devices'    => array(
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
					'range'      => array(
						'px' => array(
							'min'  => 0,
							'max'  => 2000,
							'step' => 1,
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'hint'             => esc_html__( 'Default: 0', 'omniverse' ),
					'dependency'       => array(
						'element' => 'custom_height',
						'value'   => array( 'yes' ),
					),
					'transfer'         => 'height',
				),
				array(
					'type'             => 'omniverse_slider',
					'heading'          => esc_html__( 'Image Height', 'omniverse' ),
					'param_name'       => 'height',
					'min'              => '0',
					'max'              => '2000',
					'step'             => '1',
					'default'          => '0',
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
						'0'   => '0',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column dn-hidden',
					'hint'             => esc_html__( 'Default: 0', 'omniverse' ),
					'dependency'       => array(
						'element' => 'custom_height',
						'value'   => array( 'yes' ),
					),
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
					'dependency'       => array(
						'element' => 'custom_height',
						'value'   => array( 'yes' ),
					),
					'wd_dependency'    => array(
						'element' => 'source_type',
						'value'   => array( 'image' ),
					),
				),
				array(
					'heading'       => esc_html__( 'Rounding', 'omniverse' ),
					'type'          => 'wd_select',
					'param_name'    => 'rounding_size',
					'style'         => 'select',
					'selectors'     => array(
						'{{WRAPPER}}' => array(
							'--wd-brd-radius: {{VALUE}}px;',
						),
					),
					'devices'       => array(
						'desktop' => array(
							'value' => '',
						),
					),
					'value'         => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( '0', 'omniverse' )      => '0',
						esc_html__( '5', 'omniverse' )      => '5',
						esc_html__( '8', 'omniverse' )      => '8',
						esc_html__( '12', 'omniverse' )     => '12',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'generate_zero' => true,
				),
				array(
					'heading'       => esc_html__( 'Custom rounding', 'omniverse' ),
					'type'          => 'wd_slider',
					'param_name'    => 'custom_rounding_size',
					'selectors'     => array(
						'{{WRAPPER}}' => array(
							'--wd-brd-radius: {{VALUE}}{{UNIT}};',
						),
					),
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
						'%'  => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					),
					'dependency'    => array(
						'element' => 'rounding_size',
						'value'   => function_exists( 'omniverse_compress' ) ? omniverse_compress(
							wp_json_encode(
								array(
									'devices' => array(
										'desktop' => array(
											'value' => 'custom',
										),
									),
								)
							)
						) : '',
					),
					'generate_zero' => true,
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Banner link', 'omniverse' ),
					'param_name' => 'link',
					'hint'       => esc_html__( 'Enter URL if you want this banner to have a link.', 'omniverse' ),
				),
				/**
				* Style
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
					'wood_tooltip'     => true,
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
				* Extra
				*/
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Extra options', 'omniverse' ),
					'param_name' => 'extra_divider',
				),
				( function_exists( 'vc_map_add_css_animation' ) ) ? vc_map_add_css_animation( true ) : '',
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Extra class name', 'omniverse' ),
					'param_name' => 'el_class',
					'hint'       => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'omniverse' ),
				),
				/**
				* Title
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
				* Subtitle
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
					'edit_field_class' => 'vc_col-sm-12 vc_column',
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
				* Content
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
				 * Countdown.
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Date', 'omniverse' ),
					'group'      => esc_html__( 'Countdown', 'omniverse' ),
					'param_name' => 'countdown_date_divider',
				),
				array(
					'type'             => 'omniverse_datepicker',
					'heading'          => esc_html__( 'Date', 'omniverse' ),
					'group'            => esc_html__( 'Countdown', 'omniverse' ),
					'param_name'       => 'date',
					'hint'             => esc_html__( 'Final date in the format Y/m/d. For example 2020/12/12 13:00', 'omniverse' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_switch',
					'heading'          => esc_html__( 'Hide countdown on finish', 'omniverse' ),
					'group'            => esc_html__( 'Countdown', 'omniverse' ),
					'param_name'       => 'hide_countdown_on_finish',
					'true_state'       => 'yes',
					'false_state'      => 'no',
					'default'          => 'no',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Style', 'omniverse' ),
					'group'      => esc_html__( 'Countdown', 'omniverse' ),
					'param_name' => 'countdown_style_divider',
				),
				array(
					'type'       => 'omniverse_dropdown',
					'heading'    => esc_html__( 'Style', 'omniverse' ),
					'group'      => esc_html__( 'Countdown', 'omniverse' ),
					'param_name' => 'countdown_style',
					'value'      => array(
						esc_html__( 'Standard', 'omniverse' ) => 'standard',
						esc_html__( 'Transparent', 'omniverse' ) => 'transparent',
						esc_html__( 'Primary color', 'omniverse' ) => 'active',
						esc_html__( 'Simple', 'omniverse' ) => 'simple',
					),
					'style'      => array(
						'active' => omniverse_get_color_value( 'primary-color', '#7eb934' ),
					),
				),
				array(
					'type'       => 'omniverse_button_set',
					'heading'    => esc_html__( 'Color Scheme', 'omniverse' ),
					'group'      => esc_html__( 'Countdown', 'omniverse' ),
					'param_name' => 'countdown_color_scheme',
					'value'      => array(
						esc_html__( 'Inherit', 'omniverse' ) => '',
						esc_html__( 'Light', 'omniverse' ) => 'light',
						esc_html__( 'Dark', 'omniverse' ) => 'dark',
					),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Size', 'omniverse' ),
					'group'      => esc_html__( 'Countdown', 'omniverse' ),
					'param_name' => 'countdown_size',
					'value'      => array(
						esc_html__( 'Medium (24px)', 'omniverse' ) => 'medium',
						esc_html__( 'Small (20px)', 'omniverse' ) => 'small',
						esc_html__( 'Large (28px)', 'omniverse' ) => 'large',
						esc_html__( 'Extra Large (42px)', 'omniverse' ) => 'xlarge',
					),
				),
				/**
				* Button
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
						esc_html__( 'Round', 'omniverse' )  => 'semi-round',
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
				 * Button icon
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'btn_icon_divider',
				),
				array(
					'type'       => 'omniverse_button_set',
					'heading'    => esc_html__( 'Type', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'btn_icon_type',
					'value'      => array(
						esc_html__( 'Icon', 'omniverse' )  => 'icon',
						esc_html__( 'Image', 'omniverse' ) => 'image',
					),
					'default'    => 'icon',
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Image', 'omniverse' ),
					'group'            => esc_html__( 'Button', 'omniverse' ),
					'param_name'       => 'btn_image',
					'value'            => '',
					'dependency'       => array(
						'element' => 'btn_icon_type',
						'value'   => 'image',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'group'            => esc_html__( 'Button', 'omniverse' ),
					'param_name'       => 'btn_img_size',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'btn_icon_type',
						'value'   => 'image',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon library', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'value'      => array(
						esc_html__( 'Font Awesome', 'omniverse' ) => 'fontawesome',
						esc_html__( 'Open Iconic', 'omniverse' ) => 'openiconic',
						esc_html__( 'Typicons', 'omniverse' ) => 'typicons',
						esc_html__( 'Entypo', 'omniverse' ) => 'entypo',
						esc_html__( 'Linecons', 'omniverse' ) => 'linecons',
						esc_html__( 'Mono Social', 'omniverse' ) => 'monosocial',
						esc_html__( 'Material', 'omniverse' ) => 'material',
					),
					'param_name' => 'icon_library',
					'hint'       => esc_html__( 'Select icon library.', 'omniverse' ),
					'dependency' => array(
						'element' => 'btn_icon_type',
						'value'   => 'icon',
					),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'icon_fontawesome',
					'value'      => '',
					'settings'   => array(
						'emptyIcon'    => true,
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'fontawesome' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'icon_openiconic',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'openiconic',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'openiconic' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'icon_typicons',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'typicons',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'typicons' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'icon_entypo',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'entypo',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'entypo' ),
					),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'icon_linecons',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'linecons',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'linecons' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'icon_monosocial',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'monosocial',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'monosocial' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'omniverse' ),
					'group'      => esc_html__( 'Button', 'omniverse' ),
					'param_name' => 'icon_material',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'material',
						'iconsPerPage' => 4000,
					),
					'dependency' => array(
						'element' => 'icon_library',
						'value'   => array( 'material' ),
					),
					'hint'       => esc_html__( 'Select icon from library.', 'omniverse' ),
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Button icon position', 'omniverse' ),
					'group'            => esc_html__( 'Button', 'omniverse' ),
					'param_name'       => 'btn_icon_position',
					'value'            => array(
						esc_html__( 'Left', 'omniverse' )  => 'left',
						esc_html__( 'Right', 'omniverse' ) => 'right',
					),
					'std'              => 'right',
					'edit_field_class' => 'vc_col-xs-12 vc_column button-style',
				),
				/**
				* Layouts
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
						esc_html__( 'Left', 'omniverse' )   => 'left',
						esc_html__( 'Center', 'omniverse' ) => 'center',
						esc_html__( 'Right', 'omniverse' )  => 'right',
					),
					'images_value'     => array(
						'left'   => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/horizontal/left.png',
						'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/horizontal/center.png',
						'right'  => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/horizontal/right.png',
					),
					'std'              => 'left',
					'wood_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column content-position',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Content vertical alignment', 'omniverse' ),
					'param_name'       => 'vertical_alignment',
					'group'            => esc_html__( 'Layouts', 'omniverse' ),
					'value'            => array(
						esc_html__( 'Top', 'omniverse' )    => 'top',
						esc_html__( 'Middle', 'omniverse' ) => 'middle',
						esc_html__( 'Bottom', 'omniverse' ) => 'bottom',
					),
					'images_value'     => array(
						'top'    => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/vertical/top.png',
						'middle' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/vertical/middle.png',
						'bottom' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/vertical/bottom.png',
					),
					'std'              => 'top',
					'wood_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column content-position',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Text alignment', 'omniverse' ),
					'group'            => esc_html__( 'Layouts', 'omniverse' ),
					'param_name'       => 'text_alignment',
					'value'            => array(
						esc_html__( 'Left', 'omniverse' )   => 'left',
						esc_html__( 'Center', 'omniverse' ) => 'center',
						esc_html__( 'Right', 'omniverse' )  => 'right',
					),
					'images_value'     => array(
						'center' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
						'left'   => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
						'right'  => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					),
					'std'              => 'left',
					'wood_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Content width', 'omniverse' ),
					'group'            => esc_html__( 'Layouts', 'omniverse' ),
					'param_name'       => 'content_width',
					'value'            => array(
						'100%'                             => '100',
						'90%'                              => '90',
						'80%'                              => '80',
						'70%'                              => '70',
						'60%'                              => '60',
						'50%'                              => '50',
						'40%'                              => '40',
						'30%'                              => '30',
						'20%'                              => '20',
						'10%'                              => '10',
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Custom content width', 'omniverse' ),
					'group'            => esc_html__( 'Layouts', 'omniverse' ),
					'param_name'       => 'custom_content_width',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'default'          => 'desktop',
					'edit_field_class' => 'wd-res-control vc_col-sm-12 vc_column wd-custom-width',
					'dependency'       => array(
						'element' => 'content_width',
						'value'   => array( 'custom' ),
					),
				),
				array(
					'type'             => 'omniverse_slider',
					'group'            => esc_html__( 'Layouts', 'omniverse' ),
					'param_name'       => 'content_desktop_width',
					'min'              => '0',
					'max'              => '1000',
					'step'             => '1',
					'default'          => '600',
					'units'            => 'px',
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
					'css_args'         => array(
						'--wd-max-width' => array(
							'',
						),
					),
					'css_params'       => array(
						'device' => 'desktop',
					),
					'wd_dependency'    => array(
						'element' => 'custom_content_width',
						'value'   => array( 'desktop' ),
					),
					'dependency'       => array(
						'element' => 'content_width',
						'value'   => array( 'custom' ),
					),
				),
				array(
					'type'             => 'omniverse_slider',
					'group'            => esc_html__( 'Layouts', 'omniverse' ),
					'param_name'       => 'content_tablet_width',
					'min'              => '0',
					'max'              => '1000',
					'step'             => '1',
					'default'          => '0',
					'units'            => 'px',
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
					'css_args'         => array(
						'--wd-max-width' => array(
							'',
						),
					),
					'css_params'       => array(
						'device' => 'tablet',
					),
					'wd_dependency'    => array(
						'element' => 'custom_content_width',
						'value'   => array( 'tablet' ),
					),
					'dependency'       => array(
						'element' => 'content_width',
						'value'   => array( 'custom' ),
					),
				),
				array(
					'type'             => 'omniverse_slider',
					'group'            => esc_html__( 'Layouts', 'omniverse' ),
					'param_name'       => 'content_mobile_width',
					'min'              => '0',
					'max'              => '1000',
					'step'             => '1',
					'default'          => '0',
					'units'            => 'px',
					'edit_field_class' => 'wd-res-item vc_col-sm-12 vc_column',
					'css_args'         => array(
						'--wd-max-width' => array(
							'',
						),
					),
					'css_params'       => array(
						'device' => 'mobile',
					),
					'wd_dependency'    => array(
						'element' => 'custom_content_width',
						'value'   => array( 'mobile' ),
					),
					'dependency'       => array(
						'element' => 'content_width',
						'value'   => array( 'custom' ),
					),
				),
				array(
					'type'             => 'wd_slider',
					'param_name'       => 'content_height',
					'heading'          => esc_html__( 'Content height', 'omniverse' ),
					'group'            => esc_html__( 'Layouts', 'omniverse' ),
					'devices'          => array(
						'desktop' => array(
							'unit'  => '%',
							'value' => '',
						),
						'tablet'  => array(
							'unit'  => '%',
							'value' => '',
						),
						'mobile'  => array(
							'unit'  => '%',
							'value' => '',
						),
					),
					'range'            => array(
						'%'  => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
						'px' => array(
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						),
					),
					'selectors'        => array(
						'{{WRAPPER}} .promo-banner:not(.banner-content-background) .content-banner, {{WRAPPER}} .promo-banner.banner-content-background .wrapper-content-banner' => array(
							'min-height: {{VALUE}}{{UNIT}};',
						),
					),
					'dependency'       => array(
						'element' => 'style',
						'value'   => array( 'content-background' ),
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
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
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				function_exists( 'omniverse_get_vc_responsive_spacing_map' ) ? omniverse_get_vc_responsive_spacing_map() : '',
				/**
				* Deprecated
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
				// Subtitle custom size
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
				/**
				 * Advanced.
				 */
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Highlight text style', 'omniverse' ),
					'hint'             => esc_html__( 'The text must be wrapped with the <u></u> tag to highlight it.' ),
					'group'            => esc_html__( 'Advanced', 'omniverse' ),
					'param_name'       => 'title_decoration_style',
					'value'            => array(
						esc_html__( 'Default', 'omniverse' )  => 'default',
						esc_html__( 'Primary color', 'omniverse' )  => 'colored',
						esc_html__( 'Primary color + secondary font', 'omniverse' ) => 'colored-alt',
						esc_html__( 'Bordered', 'omniverse' ) => 'bordered',
					),
					'std'              => 'colored',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				function_exists( 'omniverse_get_vc_responsive_visible_map' ) ? omniverse_get_vc_responsive_visible_map( 'responsive_tabs_hide' ) : '',
				function_exists( 'omniverse_get_vc_responsive_visible_map' ) ? omniverse_get_vc_responsive_visible_map( 'wd_hide_on_desktop' ) : '',
				function_exists( 'omniverse_get_vc_responsive_visible_map' ) ? omniverse_get_vc_responsive_visible_map( 'wd_hide_on_tablet' ) : '',
				function_exists( 'omniverse_get_vc_responsive_visible_map' ) ? omniverse_get_vc_responsive_visible_map( 'wd_hide_on_mobile' ) : '',
			)
		);
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_banners_carousel extends WPBakeryShortCodesContainer {}
}
