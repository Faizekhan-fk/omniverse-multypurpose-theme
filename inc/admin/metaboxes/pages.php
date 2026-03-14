<?php
/**
 * Page metaboxes
 *
 * @package dn
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use DN\Admin\Modules\Options\Metaboxes;

if ( ! function_exists( 'omniverse_register_page_metaboxes' ) ) {
	/**
	 * Register page metaboxes
	 *
	 * @since 1.0.0
	 */
	function omniverse_register_page_metaboxes() {
		global $omniverse_transfer_options, $omniverse_prefix;

		$omniverse_prefix = '_omniverse_';

		$page_metabox = Metaboxes::add_metabox(
			array(
				'id'         => 'zs_page_metaboxes',
				'title'      => esc_html__( 'Page Setting (custom metabox from theme)', 'omniverse' ),
				'post_types' => array( 'page', 'post', 'portfolio' ),
			)
		);

		$page_metabox->add_section(
			array(
				'id'       => 'header',
				'name'     => esc_html__( 'Header', 'omniverse' ),
				'priority' => 10,
				'icon'     => 'dn-i-header-builder',
			)
		);

		$page_metabox->add_section(
			array(
				'id'       => 'page_title',
				'name'     => esc_html__( 'Page title', 'omniverse' ),
				'priority' => 20,
				'icon'     => 'dn-i-page-title',
			)
		);

		$page_metabox->add_section(
			array(
				'id'       => 'sidebar',
				'name'     => esc_html__( 'Sidebar', 'omniverse' ),
				'priority' => 30,
				'icon'     => 'dn-i-sidebars',
			)
		);

		$page_metabox->add_section(
			array(
				'id'       => 'footer',
				'name'     => esc_html__( 'Footer', 'omniverse' ),
				'priority' => 40,
				'icon'     => 'dn-i-footer',
			)
		);

		$page_metabox->add_section(
			array(
				'id'         => 'mobile',
				'name'       => esc_html__( 'Mobile version', 'omniverse' ),
				'priority'   => 50,
				'icon'       => 'dn-i-phone',
				'post_types' => array( 'page' ),
			)
		);

		$page_metabox->add_field(
			array(
				'id'           => $omniverse_prefix . 'mobile_content',
				'name'         => esc_html__( 'Mobile version HTML block (experimental)', 'omniverse' ),
				'description'  => esc_html__( 'You can create a separate content that will be displayed on mobile devices to optimize the performance.', 'omniverse' ),
				'type'         => 'select',
				'section'      => 'mobile',
				'select2'      => true,
				'empty_option' => true,
				'autocomplete' => array(
					'type'   => 'post',
					'value'  => 'cms_block',
					'search' => 'omniverse_get_post_by_query_autocomplete',
					'render' => 'omniverse_get_post_by_ids_autocomplete',
				),
				'priority'     => 10,
			)
		);

		$page_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'open_categories',
				'type'        => 'checkbox',
				'name'        => esc_html__( 'Open categories menu', 'omniverse' ),
				'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'open-categories-menu.jpg" alt="">', 'omniverse' ), true ),
				'description' => esc_html__( 'Always shows categories navigation on this page', 'omniverse' ),
				'section'     => 'header',
				'on-text'     => esc_html__( 'Yes', 'omniverse' ),
				'off-text'    => esc_html__( 'No', 'omniverse' ),
				'priority'    => 10,
			)
		);

		$page_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'whb_header',
				'name'        => esc_html__( 'Custom header for this page', 'omniverse' ),
				'description' => esc_html__( 'If you are using our header builder for your header configuration you can select different layout from the list for this particular page.', 'omniverse' ),
				'type'        => 'select',
				'section'     => 'header',
				'options'     => '',
				'callback'    => 'omniverse_get_theme_settings_headers_array',
				'default'     => 'inherit',
				'priority'    => 20,
			)
		);

		$page_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'title_off',
				'type'        => 'checkbox',
				'name'        => esc_html__( 'Disable page title', 'omniverse' ),
				'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'disable-page-title.mp4" autoplay loop muted></video>',
				'description' => esc_html__( 'You can hide page heading for this page', 'omniverse' ),
				'section'     => 'page_title',
				'on-text'     => esc_html__( 'Yes', 'omniverse' ),
				'off-text'    => esc_html__( 'No', 'omniverse' ),
				'priority'    => 30,
			)
		);

		$page_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'page-title-size',
				'name'        => esc_html__( 'Page title size', 'omniverse' ),
				'description' => esc_html__( 'You can set different sizes for your page titles.', 'omniverse' ),
				'type'        => 'buttons',
				'section'     => 'page_title',
				'options'     => array(
					'inherit' => array(
						'name'  => esc_html__( 'Inherit', 'omniverse' ),
						'value' => 'inherit',
					),
					'default' => array(
						'name'  => esc_html__( 'Default', 'omniverse' ),
						'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'page-title-size-default.jpg" alt="">', 'omniverse' ), true ),
						'value' => 'default',
					),
					'small'   => array(
						'name'  => esc_html__( 'Small', 'omniverse' ),
						'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'page-title-size-small.jpg" alt="">', 'omniverse' ), true ),
						'value' => 'small',
					),
					'large'   => array(
						'name'  => esc_html__( 'Large', 'omniverse' ),
						'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'page-title-size-large.jpg" alt="">', 'omniverse' ), true ),
						'value' => 'large',
					),
				),
				'default'     => 'inherit',
				'priority'    => 40,
			)
		);

		$page_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'title_image',
				'type'        => 'upload',
				'name'        => esc_html__( 'Image for page title', 'omniverse' ),
				'description' => esc_html__( 'Upload an image', 'omniverse' ),
				'section'     => 'page_title',
				'priority'    => 50,
				'class'       => 'dn-col-6',
			)
		);

		$page_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'title_bg_color',
				'type'        => 'color',
				'name'        => esc_html__( 'Page title background color', 'omniverse' ),
				'description' => esc_html__( 'Choose a color', 'omniverse' ),
				'section'     => 'page_title',
				'data_type'   => 'hex',
				'priority'    => 60,
				'class'       => 'dn-col-6',
			)
		);

		$page_metabox->add_field(
			array(
				'id'       => $omniverse_prefix . 'title_color',
				'name'     => esc_html__( 'Text color for title', 'omniverse' ),
				'type'     => 'buttons',
				'section'  => 'page_title',
				'options'  => array(
					'default' => array(
						'name'  => esc_html__( 'Inherit', 'omniverse' ),
						'value' => 'default',
					),
					'light'   => array(
						'name'  => esc_html__( 'Light', 'omniverse' ),
						'value' => 'light',
					),
					'dark'    => array(
						'name'  => esc_html__( 'Dark', 'omniverse' ),
						'value' => 'dark',
					),
				),
				'default'  => 'default',
				'priority' => 70,
			)
		);

		$page_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'main_layout',
				'name'        => esc_html__( 'Sidebar position', 'omniverse' ),
				'description' => esc_html__( 'Select main content and sidebar alignment.', 'omniverse' ),
				'type'        => 'buttons',
				'section'     => 'sidebar',
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
				'priority'    => 80,
			)
		);

		$page_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'sidebar_width',
				'name'        => esc_html__( 'Sidebar size', 'omniverse' ),
				'description' => esc_html__( 'You can set different sizes for your pages sidebar', 'omniverse' ),
				'type'        => 'buttons',
				'section'     => 'sidebar',
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
				'priority'    => 90,
				'class'       => 'dn-tooltip-bordered',
			)
		);

		$omniverse_transfer_options[] = 'page-title-size';
		$omniverse_transfer_options[] = 'main_layout';
		$omniverse_transfer_options[] = 'sidebar_width';

		$page_metabox->add_field(
			array(
				'id'       => $omniverse_prefix . 'custom_sidebar',
				'name'     => esc_html__( 'Custom sidebar for this page', 'omniverse' ),
				'type'     => 'select',
				'section'  => 'sidebar',
				'options'  => '',
				'callback' => 'omniverse_get_theme_settings_sidebars_array',
				'priority' => 100,
			)
		);

		$page_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'footer_off',
				'type'        => 'checkbox',
				'name'        => esc_html__( 'Disable footer', 'omniverse' ),
				'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'disable-footer.jpg" alt="">', 'omniverse' ), true ),
				'description' => esc_html__( 'You can disable footer for this page', 'omniverse' ),
				'section'     => 'footer',
				'on-text'     => esc_html__( 'Yes', 'omniverse' ),
				'off-text'    => esc_html__( 'No', 'omniverse' ),
				'priority'    => 110,
				'class'       => 'dn-tooltip-bordered',
			)
		);

		$page_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'prefooter_off',
				'type'        => 'checkbox',
				'name'        => esc_html__( 'Disable prefooter', 'omniverse' ),
				'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'disable-prefooter.jpg" alt="">', 'omniverse' ), true ),
				'description' => esc_html__( 'You can disable prefooter for this page', 'omniverse' ),
				'section'     => 'footer',
				'on-text'     => esc_html__( 'Yes', 'omniverse' ),
				'off-text'    => esc_html__( 'No', 'omniverse' ),
				'priority'    => 120,
				'class'       => 'dn-tooltip-bordered',
			)
		);

		$page_metabox->add_field(
			array(
				'id'          => $omniverse_prefix . 'copyrights_off',
				'type'        => 'checkbox',
				'name'        => esc_html__( 'Disable copyrights', 'omniverse' ),
				'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'disable-copyrights.jpg" alt="">', 'omniverse' ), true ),
				'description' => esc_html__( 'You can disable copyrights for this page', 'omniverse' ),
				'section'     => 'footer',
				'on-text'     => esc_html__( 'Yes', 'omniverse' ),
				'off-text'    => esc_html__( 'No', 'omniverse' ),
				'priority'    => 130,
				'class'       => 'dn-tooltip-bordered',
			)
		);
	}

	add_action( 'init', 'omniverse_register_page_metaboxes', 100 );
}


$post_category_metabox = Metaboxes::add_metabox(
	array(
		'id'         => 'zs_post_category_metaboxes',
		'title'      => esc_html__( 'Extra options from theme', 'omniverse' ),
		'object'     => 'term',
		'taxonomies' => array( 'category' ),
	)
);

$post_category_metabox->add_section(
	array(
		'id'       => 'general',
		'name'     => esc_html__( 'General', 'omniverse' ),
		'icon'     => 'dashicons dashicons-welcome-write-blog',
		'priority' => 10,
	)
);

$post_category_metabox->add_field(
	array(
		'id'          => '_omniverse_blog_design',
		'name'        => esc_html__( 'Blog design', 'omniverse' ),
		'description' => esc_html__( 'Choose one of the blog designs available in the theme.', 'omniverse' ),
		'type'        => 'select',
		'section'     => 'general',
		'options'     => array(
			'inherit'      => array(
				'name'  => esc_html__( 'Inherit', 'omniverse' ),
				'value' => 'inherit',
			),
			'default'      => array(
				'name'  => esc_html__( 'Default', 'omniverse' ),
				'value' => 'Default',
			),
			'default-alt'  => array(
				'name'  => esc_html__( 'Default alternative', 'omniverse' ),
				'value' => 'default-alt',
			),
			'small-images' => array(
				'name'  => esc_html__( 'Small images', 'omniverse' ),
				'value' => 'small-images',
			),
			'chess'        => array(
				'name'  => esc_html__( 'Chess', 'omniverse' ),
				'value' => 'chess',
			),
			'masonry'      => array(
				'name'  => esc_html__( 'Masonry grid', 'omniverse' ),
				'value' => 'default',
			),
			'mask'         => array(
				'name'  => esc_html__( 'Mask on image', 'omniverse' ),
				'value' => 'mask',
			),
			'meta-image'   => array(
				'name'  => esc_html__( 'Meta on image', 'omniverse' ),
				'value' => 'meta-image',
			),
		),
		'priority'    => 10,
	)
);
