<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );}
/**
* ------------------------------------------------------------------------------------------------
* Section title element map
* ------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'omniverse_get_vc_map_title' ) ) {
	function omniverse_get_vc_map_title() {
		$secondary_font        = omniverse_get_opt( 'secondary-font' );
		$default_font          = omniverse_get_opt( 'text-font' );
		$alt_font_subtitle     = isset( $secondary_font[0] ) ? esc_html__( 'Alternative', 'omniverse' ) . ' (' . $secondary_font[0]['font-family'] . ')' : esc_html__( 'Alternative', 'omniverse' );
		$default_font_subtitle = isset( $default_font[0] ) ? esc_html__( 'Default', 'omniverse' ) . ' (' . $default_font[0]['font-family'] . ')' : esc_html__( 'Default', 'omniverse' );

		return array(
			'name'        => esc_html__( 'Section title', 'omniverse' ),
			'base'        => 'omniverse_title',
			'category'    => omniverse_get_tab_title_category_for_wpb(  esc_html__( 'Theme elements', 'omniverse' ) ),
			'description' => esc_html__( 'Styled title for sections', 'omniverse' ),
			'icon'        => OMNIVERSE_ASSETS . '/images/vc-icon/section-title.svg',
			'params'      => array(
				array(
					'type'       => 'omniverse_css_id',
					'param_name' => 'omniverse_css_id',
				),
				/**
				 * Layout
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Layout', 'omniverse' ),
					'param_name' => 'layout_divider',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Align', 'omniverse' ),
					'param_name'       => 'align',
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
					'std'              => 'center',
					'omni_tooltip'     => true,
					'edit_field_class' => 'vc_col-sm-6 vc_column title-align',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Width', 'omniverse' ),
					'param_name'       => 'title_width',
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
						esc_html__( 'Custom', 'omniverse' ) => 'custom',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_button_set',
					'heading'          => esc_html__( 'Custom title width', 'omniverse' ),
					'param_name'       => 'custom_title_width',
					'tabs'             => true,
					'value'            => array(
						esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
						esc_html__( 'Tablet', 'omniverse' ) => 'tablet',
						esc_html__( 'Mobile', 'omniverse' ) => 'mobile',
					),
					'default'          => 'desktop',
					'edit_field_class' => 'wd-res-control vc_col-sm-12 vc_column wd-custom-width',
					'dependency'       => array(
						'element' => 'title_width',
						'value'   => array( 'custom' ),
					),
				),
				array(
					'type'             => 'omniverse_slider',
					'param_name'       => 'title_desktop_width',
					'min'              => '0',
					'max'              => '1000',
					'step'             => '1',
					'default'          => '600',
					'units'            => 'px',
					'edit_field_class' => 'wd-res-control vc_col-sm-12 vc_column',
					'css_args'         => array(
						'--wd-max-width' => array(
							'',
						),
					),
					'css_params'       => array(
						'device' => 'desktop',
					),
					'wd_dependency'    => array(
						'element' => 'custom_title_width',
						'value'   => array( 'desktop' ),
					),
					'dependency'       => array(
						'element' => 'title_width',
						'value'   => array( 'custom' ),
					),
				),
				array(
					'type'             => 'omniverse_slider',
					'param_name'       => 'title_tablet_width',
					'min'              => '0',
					'max'              => '1000',
					'step'             => '1',
					'default'          => '0',
					'units'            => 'px',
					'edit_field_class' => 'wd-res-control vc_col-sm-12 vc_column',
					'css_args'         => array(
						'--wd-max-width' => array(
							'',
						),
					),
					'css_params'       => array(
						'device' => 'tablet',
					),
					'wd_dependency'    => array(
						'element' => 'custom_title_width',
						'value'   => array( 'tablet' ),
					),
					'dependency'       => array(
						'element' => 'title_width',
						'value'   => array( 'custom' ),
					),
				),
				array(
					'type'             => 'omniverse_slider',
					'param_name'       => 'title_mobile_width',
					'min'              => '0',
					'max'              => '1000',
					'step'             => '1',
					'default'          => '0',
					'units'            => 'px',
					'edit_field_class' => 'wd-res-control vc_col-sm-12 vc_column',
					'css_args'         => array(
						'--wd-max-width' => array(
							'',
						),
					),
					'css_params'       => array(
						'device' => 'mobile',
					),
					'wd_dependency'    => array(
						'element' => 'custom_title_width',
						'value'   => array( 'mobile' ),
					),
					'dependency'       => array(
						'element' => 'title_width',
						'value'   => array( 'custom' ),
					),
				),
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Style', 'omniverse' ),
					'param_name' => 'layout_divider',
				),
				array(
					'type'         => 'omniverse_image_select',
					'heading'      => esc_html__( 'Style', 'omniverse' ),
					'param_name'   => 'style',
					'value'        => array(
						esc_html__( 'Default', 'omniverse' ) => 'default',
						esc_html__( 'Simple', 'omniverse' ) => 'simple',
						esc_html__( 'Bordered', 'omniverse' ) => 'bordered',
						esc_html__( 'Underline', 'omniverse' ) => 'underlined',
						esc_html__( 'Underline 2', 'omniverse' ) => 'underlined-2',
						esc_html__( 'Overlined', 'omniverse' ) => 'overlined',
						esc_html__( 'Shadow', 'omniverse' ) => 'shadow',
						esc_html__( 'With image', 'omniverse' ) => 'image',
					),
					'images_value' => array(
						'default'      => OMNIVERSE_ASSETS_IMAGES . '/settings/title-style/default.png',
						'simple'       => OMNIVERSE_ASSETS_IMAGES . '/settings/title-style/simple.png',
						'bordered'     => OMNIVERSE_ASSETS_IMAGES . '/settings/title-style/bordered.png',
						'underlined'   => OMNIVERSE_ASSETS_IMAGES . '/settings/title-style/underlined.png',
						'underlined-2' => OMNIVERSE_ASSETS_IMAGES . '/settings/title-style/underlined-2.png',
						'overlined'    => OMNIVERSE_ASSETS_IMAGES . '/settings/title-style/overlined.png',
						'shadow'       => OMNIVERSE_ASSETS_IMAGES . '/settings/title-style/shadow.png',
						'image'        => OMNIVERSE_ASSETS_IMAGES . '/settings/title-style/image.png',
					),
				),
				array(
					'type'             => 'omniverse_dropdown',
					'heading'          => esc_html__( 'Predefined color scheme', 'omniverse' ),
					'param_name'       => 'color',
					'value'            => omniverse_section_title_color_variation(),
					'style'            => array(
						'default' => '#989898',
						'primary' => omniverse_get_color_value( 'primary-color', '#7eb934' ),
						'alt'     => omniverse_get_color_value( 'secondary-color', '#fbbc34' ),
						'black'   => '#2d2a2a',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				omniverse_title_gradient_picker(),
				/**
				 * Image
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Image', 'omniverse' ),
					'param_name' => 'image_divider',
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'image' ),
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
						'element' => 'style',
						'value'   => array( 'image' ),
					),
				),
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Image size', 'omniverse' ),
					'param_name'       => 'img_size',
					'hint'             => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use \'thumbnail\' size.', 'omniverse' ),
					'dependency'       => array(
						'element' => 'style',
						'value'   => array( 'image' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description'      => esc_html__( 'Example: \'thumbnail\', \'medium\', \'large\', \'full\' or enter image size in pixels: \'200x100\'.', 'omniverse' ),

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

				omniverse_get_vc_animation_map( 'wd_animation' ),
				omniverse_get_vc_animation_map( 'wd_animation_delay' ),
				omniverse_get_vc_animation_map( 'wd_animation_duration' ),

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
					'group'      => esc_html__( 'Title', 'omniverse' ),
					'param_name' => 'title_divider',
				),
				array(
					'type'       => 'textarea',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'omniverse' ),
					'group'      => esc_html__( 'Title', 'omniverse' ),
					'param_name' => 'title',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Predefined size', 'omniverse' ),
					'group'            => esc_html__( 'Title', 'omniverse' ),
					'param_name'       => 'size',
					'value'            => array(
						esc_html__( 'Default (22px)', 'omniverse' ) => 'default',
						esc_html__( 'Small (18px)', 'omniverse' ) => 'small',
						esc_html__( 'Medium (26px)', 'omniverse' ) => 'medium',
						esc_html__( 'Large (36px)', 'omniverse' ) => 'large',
						esc_html__( 'Extra Large (46px)', 'omniverse' ) => 'extra-large',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Font weight', 'omniverse' ),
					'group'            => esc_html__( 'Title', 'omniverse' ),
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
					'heading'          => esc_html__( 'Custom size', 'omniverse' ),
					'group'            => esc_html__( 'Title', 'omniverse' ),
					'param_name'       => 'title_font_size',
					'css_args'         => array(
						'font-size' => array(
							' .omniverse-title-container',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Custom line height', 'omniverse' ),
					'group'            => esc_html__( 'Title', 'omniverse' ),
					'param_name'       => 'title_line_height',
					'css_args'         => array(
						'line-height' => array(
							' .omniverse-title-container',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'omniverse_empty_space',
					'param_name' => 'omniverse_empty_space',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Custom color', 'omniverse' ),
					'group'            => esc_html__( 'Title', 'omniverse' ),
					'param_name'       => 'title_custom_color',
					'css_args'         => array(
						'color' => array(
							' .omniverse-title-container',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Highlight text style', 'omniverse' ),
					'hint'             => esc_html__( 'The text must be wrapped with the <u></u> tag to highlight it.' ),
					'group'            => esc_html__( 'Title', 'omniverse' ),
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
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Tag', 'omniverse' ),
					'group'            => esc_html__( 'Title', 'omniverse' ),
					'param_name'       => 'tag',
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
				/**
				 * Subtitle
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Subtitle', 'omniverse' ),
					'group'      => esc_html__( 'Subtitle', 'omniverse' ),
					'param_name' => 'subtitle_divider',
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Subtitle', 'omniverse' ),
					'group'      => esc_html__( 'Subtitle', 'omniverse' ),
					'param_name' => 'subtitle',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Font', 'omniverse' ),
					'group'            => esc_html__( 'Subtitle', 'omniverse' ),
					'param_name'       => 'subtitle_font',
					'value'            => array(
						$default_font_subtitle => 'default',
						$alt_font_subtitle     => 'alt',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Font weight', 'omniverse' ),
					'group'            => esc_html__( 'Subtitle', 'omniverse' ),
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
					'heading'          => esc_html__( 'Font Size', 'omniverse' ),
					'group'            => esc_html__( 'Subtitle', 'omniverse' ),
					'param_name'       => 'subtitle_font_size',
					'css_args'         => array(
						'font-size' => array(
							' .title-subtitle',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Line height', 'omniverse' ),
					'group'            => esc_html__( 'Subtitle', 'omniverse' ),
					'param_name'       => 'subtitle_line_height_size',
					'css_args'         => array(
						'line-height' => array(
							' .title-subtitle',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_colorpicker',
					'heading'          => esc_html__( 'Custom color', 'omniverse' ),
					'group'            => esc_html__( 'Subtitle', 'omniverse' ),
					'param_name'       => 'subtitle_color',
					'css_args'         => array(
						'color' => array(
							' .title-subtitle',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_image_select',
					'heading'          => esc_html__( 'Style', 'omniverse' ),
					'group'            => esc_html__( 'Subtitle', 'omniverse' ),
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
					'group'            => esc_html__( 'Subtitle', 'omniverse' ),
					'param_name'       => 'subtitle_bg_color',
					'css_args'         => array(
						'background-color' => array(
							' .title-subtitle',
						),
					),
					'dependency'       => array(
						'element' => 'subtitle_style',
						'value'   => array( 'background' ),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				/**
				 * Text after title
				 */
				array(
					'type'       => 'omniverse_title_divider',
					'holder'     => 'div',
					'title'      => esc_html__( 'Text', 'omniverse' ),
					'group'      => esc_html__( 'Text', 'omniverse' ),
					'param_name' => 'text_divider',
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Text after title', 'omniverse' ),
					'group'      => esc_html__( 'Text', 'omniverse' ),
					'param_name' => 'after_title',
				),
				array(
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Size', 'omniverse' ),
					'group'            => esc_html__( 'Text', 'omniverse' ),
					'param_name'       => 'after_font_size',
					'css_args'         => array(
						'font-size' => array(
							' .title-after_title',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'             => 'omniverse_responsive_size',
					'heading'          => esc_html__( 'Line height', 'omniverse' ),
					'group'            => esc_html__( 'Text', 'omniverse' ),
					'param_name'       => 'after_line_height_size',
					'css_args'         => array(
						'line-height' => array(
							' .title-after_title',
						),
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'       => 'omniverse_colorpicker',
					'heading'    => esc_html__( 'Color', 'omniverse' ),
					'group'      => esc_html__( 'Text', 'omniverse' ),
					'param_name' => 'after_color',
					'css_args'   => array(
						'color' => array(
							' .title-after_title',
						),
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'omniverse' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'js_composer' ),
				),
				omniverse_get_vc_responsive_spacing_map(),
				/**
				 * Advanced.
				 */

				// Width option (with dependency Columns option, responsive).
				omniverse_get_responsive_dependency_width_map( 'responsive_tabs' ),
				omniverse_get_responsive_dependency_width_map( 'width_desktop' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_desktop' ),
				omniverse_get_responsive_dependency_width_map( 'width_tablet' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_tablet' ),
				omniverse_get_responsive_dependency_width_map( 'width_mobile' ),
				omniverse_get_responsive_dependency_width_map( 'custom_width_mobile' ),
			),
		);
	}
}


if ( ! function_exists( 'omniverse_section_title_color_variation' ) ) {
	/**
	 * Get Section Title Color.
	 *
	 * @return array List of title color variation.
	 */
	function omniverse_section_title_color_variation() {

		$variation = array(
			esc_html__( 'Default', 'omniverse' )           => 'default',
			esc_html__( 'Primary color', 'omniverse' )     => 'primary',
			esc_html__( 'Alternative color', 'omniverse' ) => 'alt',
			esc_html__( 'Black', 'omniverse' )             => 'black',
			esc_html__( 'White', 'omniverse' )             => 'white',
		);

		if ( apply_filters( 'omniverse_gradients_enabled', true ) ) {
			$variation = array_merge(
				$variation,
				array(
					esc_html__( 'Gradient', 'omniverse' ) => 'gradient',
				)
			);
		}

		return $variation;
	}
}

if ( ! function_exists( 'omniverse_title_gradient_picker' ) ) {
	/**
	 * Get Gradient Section Title Color Picker.
	 *
	 * @return array List of title color variation.
	 */
	function omniverse_title_gradient_picker() {

		$title_color = array(
			'type'       => 'omniverse_gradient',
			'param_name' => 'omniverse_color_gradient',
			'heading'    => esc_html__( 'Gradient title color', 'omniverse' ),
			'dependency' => array(
				'element' => 'color',
				'value'   => array( 'gradient' ),
			),
		);

		if ( ! apply_filters( 'omniverse_gradients_enabled', true ) ) {
			$title_color = false;
		}

		return $title_color;
	}
}
