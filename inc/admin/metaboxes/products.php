<?php
/**
 * Product metaboxes
 *
 * @package dn
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use DN\Admin\Modules\Options\Metaboxes;

if ( ! function_exists( 'omniverse_register_product_metaboxes' ) ) {
	/**
	 * Register page metaboxes
	 *
	 * @since 1.0.0
	 */
	function omniverse_register_product_metaboxes() {
		global $omniverse_transfer_options, $omniverse_prefix;

		$omniverse_prefix = '_omniverse_';

		$product_metabox = Metaboxes::add_metabox(
			array(
				'id'         => 'zs_product_metaboxes',
				'title'      => esc_html__( 'Product Setting (custom metabox from theme)', 'omniverse' ),
				'post_types' => array( 'product' ),
			)
		);

		$product_metabox->add_section(
			array(
				'id'       => 'product_general_section',
				'name'     => esc_html__( 'General', 'omniverse' ),
				'icon'     => 'dn-i-cog',
				'priority' => 10,
			)
		);

		$product_metabox->add_section(
			array(
				'id'       => 'layout_options_section',
				'name'     => esc_html__( 'Layout', 'omniverse' ),
				'icon'     => 'dn-i-layout',
				'priority' => 15,
			)
		);

		$product_metabox->add_section(
			array(
				'id'       => 'design_color_options_section',
				'name'     => esc_html__( 'Style', 'omniverse' ),
				'icon'     => 'dn-i-brush',
				'priority' => 20,
			)
		);

		$product_metabox->add_section(
			array(
				'id'       => 'sidebar_options_section',
				'name'     => esc_html__( 'Sidebar', 'omniverse' ),
				'icon'     => 'dn-i-sidebars',
				'priority' => 30,
			)
		);

		$product_metabox->add_section(
			array(
				'id'       => 'tab_options_section',
				'name'     => esc_html__( 'Tabs', 'omniverse' ),
				'icon'     => 'dn-i-footer',
				'priority' => 50,
			)
		);

		$product_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'new_label',
				'type'        => 'checkbox',
				'name'        => esc_html__( 'Permanent "New" label', 'omniverse' ),
				'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'permanent-new-label.jpg" alt="">', 'omniverse' ), true ),
				'description' => esc_html__( 'Enable this option to make your product have "New" status forever.', 'omniverse' ),
				'section'     => 'product_general_section',
				'priority'    => 10,
				'class'       => 'dn-col-6',
			)
		);

		$product_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'new_label_date',
				'type'        => 'text_input',
				'name'        => esc_html__( 'Mark product as "New" till date', 'omniverse' ),
				'description' => esc_html__( 'Specify the end date when the "New" status will be retired. NOTE: "Permanent "New" label" option should be disabled if you use the exact date.', 'omniverse' ),
				'section'     => 'product_general_section',
				'datepicker'  => true,
				'priority'    => 20,
				'class'       => 'dn-col-6',
			)
		);

		$taxonomies_list = array(
			'' => array(
				'name'  => esc_html__( 'Select', 'omniverse' ),
				'value' => '',
			),
		);
		$taxonomies      = get_taxonomies();
		foreach ( $taxonomies as $taxonomy ) {
			$taxonomies_list[ $taxonomy ] = array(
				'name'  => $taxonomy,
				'value' => $taxonomy,
			);
		}

		$product_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'swatches_attribute',
				'type'        => 'select',
				'name'        => esc_html__( 'Grid swatch attribute to display', 'omniverse' ),
				'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'grid-swatch-attribute-to-display.mp4" autoplay loop muted></video>',
				'description' => esc_html__( 'Choose attribute that will be shown on products grid for this particular product', 'omniverse' ),
				'section'     => 'product_general_section',
				'options'     => $taxonomies_list,
				'priority'    => 30,
			)
		);

		$product_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'related_off',
				'type'        => 'checkbox',
				'name'        => esc_html__( 'Hide related products', 'omniverse' ),
				'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-related-products.jpg" alt="">', 'omniverse' ), true ),
				'description' => esc_html__( 'You can hide related products on this page', 'omniverse' ),
				'section'     => 'product_general_section',
				'on-text'     => esc_html__( 'Yes', 'omniverse' ),
				'off-text'    => esc_html__( 'No', 'omniverse' ),
				'priority'    => 40,
			)
		);

		$product_metabox->add_field(
			array(
				'id'       => $omniverse_prefix . 'exclude_show_single_variation',
				'type'     => 'checkbox',
				'name'     => esc_html__( 'Exclude variation products on grid', 'omniverse' ),
				'section'  => 'product_general_section',
				'on-text'  => esc_html__( 'Yes', 'omniverse' ),
				'off-text' => esc_html__( 'No', 'omniverse' ),
				'priority' => 45,
				'class'    => 'dn-col-6',
			)
		);

		$product_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'product_video',
				'type'        => 'text_input',
				'name'        => esc_html__( 'Product video URL', 'omniverse' ),
				'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'product-video-url.mp4" autoplay loop muted></video>',
				'description' => esc_html__( 'URL example: https://www.youtube.com/watch?v=LXb3EKWsInQ', 'omniverse' ),
				'section'     => 'product_general_section',
				'priority'    => 50,
			)
		);

		$product_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'product_hashtag',
				'type'        => 'text_input',
				'name'        => esc_html__( 'Instagram product hashtag (deprecated)', 'omniverse' ),
				'description' => wp_kses( __( 'Insert tag that will be used to display images from instagram from your customers. For example: <strong>#nike_rush_run</strong>', 'omniverse' ), 'default' ),
				'section'     => 'product_general_section',
				'class'       => 'dn-hidden',
				'priority'    => 60,
			)
		);

		$product_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'single_product_style',
				'name'        => esc_html__( 'Product image width', 'omniverse' ),
				'description' => esc_html__( 'You can choose different page layout depending on the product image size you need.', 'omniverse' ),
				'type'        => 'select',
				'section'     => 'layout_options_section',
				'options'     => array(
					'inherit' => array(
						'name'  => esc_html__( 'Inherit', 'omniverse' ),
						'value' => 'inherit',
					),
					1         => array(
						'name'  => esc_html__( 'Small image', 'omniverse' ),
						'value' => 1,
					),
					2         => array(
						'name'  => esc_html__( 'Medium', 'omniverse' ),
						'value' => 2,
					),
					3         => array(
						'name'  => esc_html__( 'Large', 'omniverse' ),
						'value' => 3,
					),
					4         => array(
						'name'  => esc_html__( 'Full width (container)', 'omniverse' ),
						'value' => 4,
					),
					5         => array(
						'name'  => esc_html__( 'Full width (window)', 'omniverse' ),
						'value' => 5,
					),
				),
				'default'     => 'inherit',
				'priority'    => 10,
			)
		);

		$product_metabox->add_field(
			array(
				'id'       => $omniverse_prefix . 'thums_position',
				'name'     => esc_html__( 'Thumbnails position', 'omniverse' ),
				'type'     => 'select',
				'section'  => 'layout_options_section',
				'options'  => array(
					'inherit'              => array(
						'name'  => esc_html__( 'Inherit', 'omniverse' ),
						'value' => 'inherit',
					),
					'left'                 => array(
						'name'  => esc_html__( 'Left (vertical position)', 'omniverse' ),
						'value' => 'left',
					),
					'bottom'               => array(
						'name'  => esc_html__( 'Bottom (horizontal carousel)', 'omniverse' ),
						'value' => 'bottom',
					),
					'bottom_column'        => array(
						'name'  => esc_html__( 'Bottom (1 column)', 'omniverse' ),
						'value' => 'left',
					),
					'bottom_grid'          => array(
						'name'  => esc_html__( 'Bottom (2 columns)', 'omniverse' ),
						'value' => 'left',
					),
					'bottom_combined'      => array(
						'name'  => esc_html__( 'Combined grid (1:2:1)', 'omniverse' ),
						'value' => 'bottom_combined',
					),
					'without'              => array(
						'name'  => esc_html__( 'Without', 'omniverse' ),
						'value' => 'without',
					),
				),
				'status'   => 'deprecated',
				'status_description' => esc_html__( 'This option is deprecated. You can now use "Layouts" or "Theme Options presets" to change one or several individual product pages.', 'omniverse' ),
				'default'  => 'inherit',
				'priority' => 20,
			)
		);

		$product_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'whb_header',
				'name'        => esc_html__( 'Custom header for this product', 'omniverse' ),
				'description' => esc_html__( 'You can select a different header from the list for this particular product.', 'omniverse' ),
				'type'        => 'select',
				'section'     => 'layout_options_section',
				'options'     => '',
				'callback'    => 'omniverse_get_theme_settings_headers_array',
				'default'     => 'inherit',
				'priority'    => 9,
			)
		);

		$product_metabox->add_field(
			array(
				'id'           => $omniverse_prefix . 'extra_content',
				'name'         => esc_html__( 'Extra content block', 'omniverse' ),
				'description'  => esc_html__( 'You can create some extra content with WPBakery Page Builder (in Admin panel / HTML Blocks / Add new) and add it to this product', 'omniverse' ),
				'type'         => 'select',
				'section'      => 'layout_options_section',
				'select2'      => true,
				'empty_option' => true,
				'autocomplete' => array(
					'type'   => 'post',
					'value'  => 'cms_block',
					'search' => 'omniverse_get_post_by_query_autocomplete',
					'render' => 'omniverse_get_post_by_ids_autocomplete',
				),
				'priority'     => 30,
			)
		);

		$product_metabox->add_field(
			array(
				'id'       => $omniverse_prefix . 'extra_position',
				'name'     => esc_html__( 'Extra content position', 'omniverse' ),
				'type'     => 'buttons',
				'section'  => 'layout_options_section',
				'options'  => array(
					'after'     => array(
						'name'  => esc_html__( 'After content', 'omniverse' ),
						'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'extra-content-position-affter-content.jpg" alt="">', 'omniverse' ), true ),
						'value' => 'after',
					),
					'before'    => array(
						'name'  => esc_html__( 'Before content', 'omniverse' ),
						'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'extra-content-position-before-content.jpg" alt="">', 'omniverse' ), true ),
						'value' => 'before',
					),
					'prefooter' => array(
						'name'  => esc_html__( 'Prefooter', 'omniverse' ),
						'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'extra-content-position-prefooter.jpg" alt="">', 'omniverse' ), true ),
						'value' => 'prefooter',
					),
				),
				'default'  => 'after',
				'priority' => 40,
			)
		);

		$product_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'product_design',
				'name'        => esc_html__( 'Product page design', 'omniverse' ),
				'description' => esc_html__( 'Choose between different predefined designs.', 'omniverse' ),
				'type'        => 'buttons',
				'section'     => 'design_color_options_section',
				'options'     => array(
					'inherit' => array(
						'name'  => esc_html__( 'Inherit', 'omniverse' ),
						'value' => 'inherit',
					),
					'default' => array(
						'name'  => esc_html__( 'Default', 'omniverse' ),
						'value' => 'default',
					),
					'alt'     => array(
						'name'  => esc_html__( 'Centered', 'omniverse' ),
						'value' => 'default',
					),
				),
				'default'     => 'inherit',
				'priority'    => 10,
			)
		);

		$product_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'product-background',
				'name'        => esc_html__( 'Product background', 'omniverse' ),
				'description' => esc_html__( 'Set background for this particular product page.', 'omniverse' ),
				'type'        => 'color',
				'section'     => 'design_color_options_section',
				'data_type'   => 'hex',
				'priority'    => 20,
			)
		);

		$product_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'main_layout',
				'name'        => esc_html__( 'Sidebar position', 'omniverse' ),
				'description' => esc_html__( 'Select main content and sidebar alignment.', 'omniverse' ),
				'type'        => 'buttons',
				'section'     => 'sidebar_options_section',
				'options'     => array(
					'default'       => array(
						'name'  => esc_html__( 'Inherit', 'omniverse' ),
						'value' => 'default',
					),
					'full-width'    => array(
						'name'  => esc_html__( 'Without', 'omniverse' ),
						'value' => 'full-width',
					),
					'sidebar-left'  => array(
						'name'  => esc_html__( 'Left', 'omniverse' ),
						'value' => 'sidebar-left',
					),
					'sidebar-right' => array(
						'name'  => esc_html__( 'Right', 'omniverse' ),
						'value' => 'sidebar-right',
					),
				),
				'default'     => 'default',
				'priority'    => 10,
			)
		);

		$product_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'sidebar_width',
				'name'        => esc_html__( 'Sidebar size', 'omniverse' ),
				'description' => esc_html__( 'You can set different sizes for your pages sidebar', 'omniverse' ),
				'type'        => 'buttons',
				'section'     => 'sidebar_options_section',
				'options'     => array(
					'default' => array(
						'name'  => esc_html__( 'Inherit', 'omniverse' ),
						'value' => 'default',
					),
					2         => array(
						'name'  => esc_html__( 'Small', 'omniverse' ),
						'value' => 2,
					),
					3         => array(
						'name'  => esc_html__( 'Medium', 'omniverse' ),
						'value' => 3,
					),
					4         => array(
						'name'  => esc_html__( 'Large', 'omniverse' ),
						'value' => 4,
					),
				),
				'default'     => 'default',
				'priority'    => 20,
			)
		);

		$product_metabox->add_field(
			array(
				'id'       => $omniverse_prefix . 'custom_sidebar',
				'name'     => esc_html__( 'Custom sidebar for this product', 'omniverse' ),
				'type'     => 'select',
				'section'  => 'sidebar_options_section',
				'options'  => '',
				'callback' => 'omniverse_get_theme_settings_sidebars_array',
				'priority' => 30,
			)
		);

		$product_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'hide_tabs_titles',
				'type'        => 'checkbox',
				'name'        => esc_html__( 'Hide tabs headings', 'omniverse' ),
				'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'hide-tabs-headings.jpg" alt="">', 'omniverse' ), true ),
				'description' => esc_html__( 'Description and Additional information', 'omniverse' ),
				'section'     => 'tab_options_section',
				'on-text'     => esc_html__( 'Yes', 'omniverse' ),
				'off-text'    => esc_html__( 'No', 'omniverse' ),
				'priority'    => 10,
			)
		);

		$product_metabox->add_field(
			array(
				'id'       => $omniverse_prefix . 'product_custom_tab_title',
				'type'     => 'text_input',
				'name'     => esc_html__( 'Custom tab title', 'omniverse' ),
				'section'  => 'tab_options_section',
				't_tab'    => array(
					'id'    => 'custom_tabs',
					'tab'   => esc_html__( 'Tab [1]', 'omniverse' ),
					'style' => 'default',
				),
				'priority' => 20,
			)
		);

		$product_metabox->add_field(
			array(
				'id'       => $omniverse_prefix . 'product_custom_tab_content_type',
				'name'     => esc_html__( 'Custom tab content', 'omniverse' ),
				'type'     => 'buttons',
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
				'section'  => 'tab_options_section',
				't_tab'    => array(
					'id'    => 'custom_tabs',
					'tab'   => esc_html__( 'Tab [1]', 'omniverse' ),
					'style' => 'default',
				),
				'class'    => 'dn-html-block-switch',
				'priority' => 30,
			)
		);

		$product_metabox->add_field(
			array(
				'id'       => $omniverse_prefix . 'product_custom_tab_content',
				'type'     => 'textarea',
				'wysiwyg'  => true,
				'name'     => esc_html__( 'Custom tab content', 'omniverse' ),
				'section'  => 'tab_options_section',
				't_tab'    => array(
					'id'  => 'custom_tabs',
					'tab' => esc_html__( 'Tab [1]', 'omniverse' ),
				),
				'requires' => array(
					array(
						'key'     => $omniverse_prefix . 'product_custom_tab_content_type',
						'compare' => 'equals',
						'value'   => 'text',
					),
				),
				'priority' => 40,
			)
		);

		$product_metabox->add_field(
			array(
				'id'           => $omniverse_prefix . 'product_custom_tab_html_block',
				'type'         => 'select',
				'section'      => 'tab_options_section',
				'name'         => esc_html__( 'HTML Block', 'omniverse' ),
				'select2'      => true,
				'empty_option' => true,
				'autocomplete' => array(
					'type'   => 'post',
					'value'  => 'cms_block',
					'search' => 'omniverse_get_post_by_query_autocomplete',
					'render' => 'omniverse_get_post_by_ids_autocomplete',
				),
				't_tab'        => array(
					'id'  => 'custom_tabs',
					'tab' => esc_html__( 'Tab [1]', 'omniverse' ),
				),
				'requires'     => array(
					array(
						'key'     => $omniverse_prefix . 'product_custom_tab_content_type',
						'compare' => 'equals',
						'value'   => 'html_block',
					),
				),
				'priority'     => 50,
			)
		);

		$product_metabox->add_field(
			array(
				'id'       => $omniverse_prefix . 'product_custom_tab_title_2',
				'type'     => 'text_input',
				'name'     => esc_html__( 'Custom tab title', 'omniverse' ),
				'section'  => 'tab_options_section',
				't_tab'    => array(
					'id'  => 'custom_tabs',
					'tab' => esc_html__( 'Tab [2]', 'omniverse' ),
				),
				'priority' => 60,
			)
		);

		$product_metabox->add_field(
			array(
				'id'       => $omniverse_prefix . 'product_custom_tab_content_type_2',
				'name'     => esc_html__( 'Custom tab content', 'omniverse' ),
				'type'     => 'buttons',
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
				'section'  => 'tab_options_section',
				't_tab'    => array(
					'id'  => 'custom_tabs',
					'tab' => esc_html__( 'Tab [2]', 'omniverse' ),
				),
				'class'    => 'dn-html-block-switch',
				'priority' => 70,
			)
		);

		$product_metabox->add_field(
			array(
				'id'       => $omniverse_prefix . 'product_custom_tab_content_2',
				'type'     => 'textarea',
				'wysiwyg'  => true,
				'name'     => esc_html__( 'Custom tab content', 'omniverse' ),
				'section'  => 'tab_options_section',
				't_tab'    => array(
					'id'  => 'custom_tabs',
					'tab' => esc_html__( 'Tab [2]', 'omniverse' ),
				),
				'requires' => array(
					array(
						'key'     => $omniverse_prefix . 'product_custom_tab_content_type_2',
						'compare' => 'equals',
						'value'   => 'text',
					),
				),
				'priority' => 80,
			)
		);

		$product_metabox->add_field(
			array(
				'id'           => $omniverse_prefix . 'product_custom_tab_html_block_2',
				'type'         => 'select',
				'section'      => 'tab_options_section',
				'name'         => esc_html__( 'HTML Block', 'omniverse' ),
				'select2'      => true,
				'empty_option' => true,
				'autocomplete' => array(
					'type'   => 'post',
					'value'  => 'cms_block',
					'search' => 'omniverse_get_post_by_query_autocomplete',
					'render' => 'omniverse_get_post_by_ids_autocomplete',
				),
				't_tab'        => array(
					'id'  => 'custom_tabs',
					'tab' => esc_html__( 'Tab [2]', 'omniverse' ),
				),
				'requires'     => array(
					array(
						'key'     => $omniverse_prefix . 'product_custom_tab_content_type_2',
						'compare' => 'equals',
						'value'   => 'html_block',
					),
				),
				'priority'     => 90,
			)
		);

		$omniverse_local_transfer_options = array(
			'product_design',
			'single_product_style',
			'thums_position',
			'product-background',
			'main_layout',
			'sidebar_width',
		);

		$omniverse_transfer_options = array_merge( $omniverse_transfer_options, $omniverse_local_transfer_options );
	}

	add_action( 'init', 'omniverse_register_product_metaboxes', 100 );
}

$product_attribute_metabox = Metaboxes::add_metabox(
	array(
		'id'         => 'zs_product_attribute_metaboxes',
		'title'      => esc_html__( 'Extra options from theme', 'omniverse' ),
		'object'     => 'term',
		'taxonomies' => array( 'product_cat' ),
	)
);

$product_attribute_metabox->add_section(
	array(
		'id'       => 'general',
		'name'     => esc_html__( 'General', 'omniverse' ),
		'icon'     => 'dn-i-footer',
		'priority' => 10,
	)
);

$product_attribute_metabox->add_field(
	array(
		'id'          => 'title_image',
		'name'        => esc_html__( 'Image for the category page title', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'image-for-the-category-page-title.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Use this image as a background for the page title on this category page.', 'omniverse' ),
		'type'        => 'upload',
		'section'     => 'general',
		'priority'    => 10,
	)
);

$product_attribute_metabox->add_field(
	array(
		'id'          => 'category_icon',
		'name'        => esc_html__( 'Image for categories navigation', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'image-for-categories-navigation.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'This image will be used in the page title categories menu and categories element with the selected option type "navigation".', 'omniverse' ),
		'type'        => 'upload',
		'section'     => 'general',
		'priority'    => 20,
	)
);

$product_attribute_metabox->add_field(
	array(
		'id'          => 'category_icon_alt',
		'name'        => esc_html__( 'Image for header menu', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'image-for-header-menu.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'The image will be used for this category display in any menu displayed in the header.', 'omniverse' ),
		'type'        => 'upload',
		'section'     => 'general',
		'priority'    => 30,
	)
);

$product_attribute_metabox->add_field(
	array(
		'id'       => 'category_extra_description_type',
		'name'     => esc_html__( 'Extra description', 'omniverse' ),
		'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'category-extra-description.jpg" alt="">', 'omniverse' ), true ),
		'type'     => 'buttons',
		'section'  => 'general',
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
		'priority' => 40,
		'class'    => 'dn-html-block-switch',
	)
);

$product_attribute_metabox->add_field(
	array(
		'id'           => 'category_extra_description_html_block',
		'type'         => 'select',
		'section'      => 'general',
		'name'         => esc_html__( 'HTML Block', 'omniverse' ),
		'description'  => esc_html__( 'Additional category description that will be displayed after product loop on this category page.', 'omniverse' ),
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
				'key'     => 'category_extra_description_type',
				'compare' => 'equals',
				'value'   => 'html_block',
			),
		),
		'priority'     => 50,
	)
);

$product_attribute_metabox->add_field(
	array(
		'id'          => 'category_extra_description_text',
		'name'        => esc_html__( 'Text', 'omniverse' ),
		'description' => esc_html__( 'Additional category description that will be displayed after product loop on this category page.', 'omniverse' ),
		'type'        => 'textarea',
		'wysiwyg'     => true,
		'section'     => 'general',
		'requires'    => array(
			array(
				'key'     => 'category_extra_description_type',
				'compare' => 'equals',
				'value'   => 'text',
			),
		),
		'priority'    => 50,
	)
);
