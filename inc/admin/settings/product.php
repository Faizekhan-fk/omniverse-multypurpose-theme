<?php
/**
 * Single product options.
 *
 * @package omniverse
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

use DN\Admin\Modules\Options;

/**
 * Product page
 */

Options::add_field(
	array(
		'id'          => 'single_product_layout',
		'name'        => esc_html__( 'Single product sidebar', 'omniverse' ),
		'description' => esc_html__( 'Select main Tab content and sidebar alignment for single product pages.', 'omniverse' ),
		'group'       => esc_html__( 'Sidebar', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'single_product_section',
		'options'     => array(
			'full-width'    => array(
				'name'  => esc_html__( '1 Column', 'omniverse' ),
				'value' => 'full-width',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/sidebar-layout/none.png',
			),
			'sidebar-left'  => array(
				'name'  => esc_html__( '2 Column Left', 'omniverse' ),
				'value' => 'sidebar-left',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/sidebar-layout/left.png',
			),
			'sidebar-right' => array(
				'name'  => esc_html__( '2 Column Right', 'omniverse' ),
				'value' => 'sidebar-right',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/sidebar-layout/right.png',
			),
		),
		'default'     => 'full-width',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'full_height_sidebar',
		'name'        => esc_html__( 'Full height sidebar', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'full-height-sidebar.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'If you have a lot of widgets added to the sidebar your single product page layout may look inconsistent. Try to enable this option in this situation.', 'omniverse' ),
		'group'       => esc_html__( 'Sidebar', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'single_product_section',
		'default'     => false,
		'priority'    => 20,
		'requires'    => array(
			array(
				'key'     => 'single_product_layout',
				'compare' => 'not_equals',
				'value'   => 'full-width',
			),
		),
	)
);


Options::add_field(
	array(
		'id'          => 'single_sidebar_width',
		'name'        => esc_html__( 'Sidebar size', 'omniverse' ),
		'description' => esc_html__( 'You can set different sizes for your single product pages sidebar', 'omniverse' ),
		'group'       => esc_html__( 'Sidebar', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'single_product_section',
		'options'     => array(
			2 => array(
				'name'  => esc_html__( 'Small', 'omniverse' ),
				'value' => 2,
			),
			3 => array(
				'name'  => esc_html__( 'Medium', 'omniverse' ),
				'value' => 3,
			),
			4 => array(
				'name'  => esc_html__( 'Large', 'omniverse' ),
				'value' => 4,
			),
		),
		'default'     => 3,
		'priority'    => 30,
		'class'       => 'dn-tooltip-bordered',
	)
);

/**
 * Images.
 */
Options::add_field(
	array(
		'id'          => 'single_product_style',
		'name'        => esc_html__( 'Product page layout', 'omniverse' ),
		'description' => esc_html__( 'You can choose different page layout depending on the product image size you need', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'single_product_section',
		'options'     => array(
			1 => array(
				'name'  => esc_html__( 'Small image', 'omniverse' ),
				'value' => 1,
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/single-product-image-width/small.jpg',
			),
			2 => array(
				'name'  => esc_html__( 'Medium', 'omniverse' ),
				'value' => 2,
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/single-product-image-width/medium.jpg',
			),
			3 => array(
				'name'  => esc_html__( 'Large', 'omniverse' ),
				'value' => 3,
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/single-product-image-width/large.jpg',
			),
			4 => array(
				'name'  => esc_html__( 'Full width (container)', 'omniverse' ),
				'value' => 4,
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/single-product-image-width/fw-container.jpg',
			),
			5 => array(
				'name'  => esc_html__( 'Full width (window)', 'omniverse' ),
				'value' => 5,
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/single-product-image-width/fw-window.jpg',
			),
		),
		'default'     => 2,
		'priority'    => 40,
	)
);

Options::add_field(
	array(
		'id'          => 'product_design',
		'name'        => esc_html__( 'Product page design', 'omniverse' ),
		'description' => esc_html__( 'Choose between different predefined designs', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'single_product_section',
		'options'     => array(
			'default' => array(
				'name'  => esc_html__( 'Default', 'omniverse' ),
				'value' => 'default',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/product-page/product-page-default.jpg',
			),
			'alt'     => array(
				'name'  => esc_html__( 'Centered', 'omniverse' ),
				'value' => 'default',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/product-page/product-page-alt.jpg',
			),
		),
		'default'     => 'default',
		'priority'    => 45,
	)
);

Options::add_field(
	array(
		'id'          => 'product_sticky',
		'name'        => esc_html__( 'Sticky product', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'sticky-product.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'If you turn on this option, the section with description will be sticky when you scroll the page. In case when the description is higher than images, the images section will be fixed instead.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'single_product_section',
		'default'     => false,
		'priority'    => 50,
	)
);

Options::add_field(
	array(
		'id'          => 'product_summary_shadow',
		'name'        => esc_html__( 'Add shadow to product summary block', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'add-shadow-to-product-summary-block.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Useful when you set background color for the single product page to gray for example.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'single_product_section',
		'default'     => false,
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 60,
	)
);

Options::add_field(
	array(
		'id'          => 'single_full_width',
		'name'        => esc_html__( 'Full width product page', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'full-width-product-page.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Stretch the single product page content.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'single_product_section',
		'default'     => false,
		'priority'    => 70,
	)
);

Options::add_field(
	array(
		'id'          => 'single_product_header',
		'name'        => esc_html__( 'Custom single product header', 'omniverse' ),
		'description' => esc_html__( 'You can use different header for your single product page.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'select',
		'section'     => 'single_product_section',
		'options'     => '',
		'callback'    => 'omniverse_get_theme_settings_headers_array',
		'default'     => 'none',
		'priority'    => 80,
	)
);

Options::add_field(
	array(
		'id'           => 'single_product_builder_post_data',
		'name'         => esc_html__( 'Select preview product for builder', 'omniverse' ),
		'description'  => esc_html__( 'The information from this product will be used as an example while you are working with the product template and Elementor.', 'omniverse' ),
		'group'        => esc_html__( 'Builder', 'omniverse' ),
		'type'         => 'select',
		'section'      => 'single_product_section',
		'select2'      => true,
		'empty_option' => true,
		'autocomplete' => array(
			'type'   => 'post',
			'value'  => 'product',
			'search' => 'omniverse_get_post_by_query_autocomplete',
			'render' => 'omniverse_get_post_by_ids_autocomplete',
		),
		'priority'     => 110,
	)
);

Options::add_field(
	array(
		'id'          => 'image_action',
		'name'        => esc_html__( 'Main image click action', 'omniverse' ),
		'description' => esc_html__( 'Enable/disable zoom option or switch to photoswipe popup.', 'omniverse' ),
		'group'       => esc_html__( 'Main image', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'product_images',
		'options'     => array(
			'zoom'  => array(
				'name'  => esc_html__( 'Zoom', 'omniverse' ),
				'hint'  => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'main-image-click-action-zoom.mp4" autoplay loop muted></video>',
				'value' => 'zoom',
			),
			'popup' => array(
				'name'  => esc_html__( 'Photoswipe popup', 'omniverse' ),
				'hint'  => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'main-image-click-action-photoswipe.mp4" autoplay loop muted></video>',
				'value' => 'popup',
			),
			'none'  => array(
				'name'  => esc_html__( 'None', 'omniverse' ),
				'value' => 'none',
			),
		),
		'default'     => 'zoom',
		'priority'    => 170,
	)
);

Options::add_field(
	array(
		'id'          => 'photoswipe_icon',
		'name'        => esc_html__( 'Show "Click to enlarge" icon', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-zoom-image-icon.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Click to open image in popup and swipe to zoom', 'omniverse' ),
		'group'       => esc_html__( 'Main image', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'product_images',
		'default'     => '1',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 180,
	)
);

Options::add_field(
	array(
		'id'          => 'product_slider_auto_height',
		'name'        => esc_html__( 'Main carousel auto height', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'main-carousel-auto-height.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Useful when you have product images with different height.', 'omniverse' ),
		'group'       => esc_html__( 'Main image', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'product_images',
		'default'     => false,
		'priority'    => 190,
	)
);

Options::add_field(
	array(
		'id'       => 'pagination_main_gallery',
		'name'     => esc_html__( 'Main carousel with pagination', 'omniverse' ),
		'hint'     => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'pagination-main-gallery.mp4" autoplay loop muted></video>',
		'group'    => esc_html__( 'Main image', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'product_images',
		'default'  => false,
		'priority' => 210,
	)
);

Options::add_field(
	array(
		'id'          => 'product_images_captions',
		'name'        => esc_html__( 'Images captions on Photo Swipe lightbox', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'images-captions-on-photo-swipe-lightbox.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Display caption texts below images when you open the photoswipe popup. Captions can be added to your images via the Media library.', 'omniverse' ),
		'group'       => esc_html__( 'Main image', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'product_images',
		'default'     => false,
		'priority'    => 220,
	)
);

Options::add_field(
	array(
		'id'       => 'thums_position',
		'name'     => esc_html__( 'Gallery layout', 'omniverse' ),
		'group'    => esc_html__( 'Image gallery', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_images',
		'options'  => array(
			'left'              => array(
				'name'  => esc_html__( 'Thumbnails left', 'omniverse' ),
				'value' => 'left',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/single-product-image/left.jpg',
			),
			'bottom'            => array(
				'name'  => esc_html__( 'Thumbnails bottom', 'omniverse' ),
				'value' => 'bottom',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/single-product-image/bottom.jpg',
			),
			'without'           => array(
				'name'  => esc_html__( 'Carousel', 'omniverse' ),
				'value' => 'without',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/single-product-image/without.jpg',
			),
			'bottom_column'     => array(
				'name'  => esc_html__( 'Grid', 'omniverse' ),
				'value' => 'left',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/single-product-image/grid.jpg',
			),
			'bottom_grid'       => array(
				'name'  => esc_html__( 'Bottom grid', 'omniverse' ),
				'value' => 'left',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/single-product-image/bottom_grid.jpg',
			),
			'bottom_combined'   => array(
				'name'  => esc_html__( 'Combined grid 1', 'omniverse' ),
				'value' => 'bottom_combined',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/single-product-image/bottom_combined.jpg',
			),
			'bottom_combined_2' => array(
				'name'  => esc_html__( 'Combined grid 2', 'omniverse' ),
				'value' => 'bottom_combined_2',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/single-product-image/bottom_combined_2.jpg',
			),
			'bottom_combined_3' => array(
				'name'  => esc_html__( 'Combined grid 3', 'omniverse' ),
				'value' => 'bottom_combined_3',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/single-product-image/bottom_combined_3.jpg',
			),
		),
		'default'  => 'left',
		'priority' => 60,
		'class'    => 'dn-thumbnails-position',
	)
);

Options::add_field(
	array(
		'id'            => 'single_product_grid_columns_gap',
		'name'          => esc_html__( 'Gallery gap', 'omniverse' ),
		'type'          => 'responsive_range',
		'section'       => 'product_images',
		'group'         => esc_html__( 'Image gallery', 'omniverse' ),
		'hint'          => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'single-product-gallery-gap.mp4" autoplay loop muted></video>',
		'selectors'     => array(
			'.woocommerce-product-gallery' => array(
				'--wd-gallery-gap: {{VALUE}}{{UNIT}};',
			),
		),
		'devices'       => array(
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
		'range'         => array(
			'px' => array(
				'min'  => 0,
				'max'  => 50,
				'step' => 1,
			),
		),
		'generate_zero' => true,
		'priority'      => 65,
	)
);

Options::add_field(
	array(
		'id'       => 'single_product_grid_column_desktop',
		'name'     => esc_html__( 'Columns on desktop', 'omniverse' ),
		'group'    => esc_html__( 'Image gallery', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_images',
		'options'  => array(
			1 => array(
				'name'  => 1,
				'value' => 1,
			),
			2 => array(
				'name'  => 2,
				'value' => 2,
			),
			3 => array(
				'name'  => 3,
				'value' => 3,
			),
			4 => array(
				'name'  => 4,
				'value' => 4,
			),
			5 => array(
				'name'  => 5,
				'value' => 5,
			),
			6 => array(
				'name'  => 6,
				'value' => 6,
			),
		),
		'default'  => '',
		'priority' => 70,
		'requires' => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'bottom_column', 'bottom_grid' ),
			),
		),
		't_tab'    => array(
			'id'       => 'single_product_grid_column_tabs',
			'tab'      => esc_html__( 'Desktop', 'omniverse' ),
			'title'    => esc_html__( 'Thumbnails columns', 'omniverse' ),
			'icon'     => 'dn-i-desktop',
			'style'    => 'devices',
			'requires' => array(
				array(
					'key'     => 'thums_position',
					'compare' => 'equals',
					'value'   => array( 'bottom_column', 'bottom_grid' ),
				),
			),
		),
	)
);

Options::add_field(
	array(
		'id'       => 'single_product_grid_column_tablet',
		'name'     => esc_html__( 'Columns on tablet', 'omniverse' ),
		'group'    => esc_html__( 'Image gallery', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_images',
		'options'  => array(
			1 => array(
				'name'  => 1,
				'value' => 1,
			),
			2 => array(
				'name'  => 2,
				'value' => 2,
			),
			3 => array(
				'name'  => 3,
				'value' => 3,
			),
			4 => array(
				'name'  => 4,
				'value' => 4,
			),
			5 => array(
				'name'  => 5,
				'value' => 5,
			),
			6 => array(
				'name'  => 6,
				'value' => 6,
			),
		),
		'default'  => '',
		'priority' => 71,
		'requires' => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'bottom_column', 'bottom_grid' ),
			),
		),
		't_tab'    => array(
			'id'    => 'single_product_grid_column_tabs',
			'icon'  => 'dn-i-tablet',
			'style' => 'devices',
			'tab'   => esc_html__( 'Tablet', 'omniverse' ),
		),
	)
);

Options::add_field(
	array(
		'id'       => 'single_product_grid_column_mobile',
		'name'     => esc_html__( 'Columns on mobile', 'omniverse' ),
		'group'    => esc_html__( 'Image gallery', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_images',
		'options'  => array(
			1 => array(
				'name'  => 1,
				'value' => 1,
			),
			2 => array(
				'name'  => 2,
				'value' => 2,
			),
			3 => array(
				'name'  => 3,
				'value' => 3,
			),
			4 => array(
				'name'  => 4,
				'value' => 4,
			),
			5 => array(
				'name'  => 5,
				'value' => 5,
			),
			6 => array(
				'name'  => 6,
				'value' => 6,
			),
		),
		'default'  => '',
		'priority' => 72,
		'requires' => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'bottom_column', 'bottom_grid' ),
			),
		),
		't_tab'    => array(
			'id'    => 'single_product_grid_column_tabs',
			'icon'  => 'dn-i-phone',
			'style' => 'devices',
			'tab'   => esc_html__( 'Mobile', 'omniverse' ),
		),
	)
);

Options::add_field(
	array(
		'id'       => 'single_product_gallery_column_desktop',
		'name'     => esc_html__( 'Columns on desktop', 'omniverse' ),
		'group'    => esc_html__( 'Image gallery', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_images',
		'options'  => array(
			1 => array(
				'name'  => 1,
				'value' => 1,
			),
			2 => array(
				'name'  => 2,
				'value' => 2,
			),
			3 => array(
				'name'  => 3,
				'value' => 3,
			),
			4 => array(
				'name'  => 4,
				'value' => 4,
			),
			5 => array(
				'name'  => 5,
				'value' => 5,
			),
			6 => array(
				'name'  => 6,
				'value' => 6,
			),
		),
		'default'  => 1,
		'priority' => 80,
		'requires' => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'without' ),
			),
		),
		't_tab'    => array(
			'id'       => 'single_product_gallery_column_tabs',
			'tab'      => esc_html__( 'Desktop', 'omniverse' ),
			'title'    => esc_html__( 'Thumbnails columns', 'omniverse' ),
			'icon'     => 'dn-i-desktop',
			'style'    => 'devices',
			'requires' => array(
				array(
					'key'     => 'thums_position',
					'compare' => 'equals',
					'value'   => array( 'without' ),
				),
			),
		),
	)
);

Options::add_field(
	array(
		'id'         => 'single_product_gallery_column_tablet',
		'name'       => esc_html__( 'Columns on tablet', 'omniverse' ),
		'group'      => esc_html__( 'Image gallery', 'omniverse' ),
		'type'       => 'buttons',
		'section'    => 'product_images',
		'selectors'  => array(
			'[class*="thumbs-grid-bottom"] .woocommerce-product-gallery__wrapper.wd-grid' => array(
				'--wd-col: {{VALUE}};',
			),
		),
		'css_device' => 'tablet',
		'options'    => array(
			1 => array(
				'name'  => 1,
				'value' => 1,
			),
			2 => array(
				'name'  => 2,
				'value' => 2,
			),
			3 => array(
				'name'  => 3,
				'value' => 3,
			),
			4 => array(
				'name'  => 4,
				'value' => 4,
			),
			5 => array(
				'name'  => 5,
				'value' => 5,
			),
			6 => array(
				'name'  => 6,
				'value' => 6,
			),
		),
		'default'    => '',
		'priority'   => 81,
		'requires'   => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'without' ),
			),
		),
		't_tab'      => array(
			'id'    => 'single_product_gallery_column_tabs',
			'icon'  => 'dn-i-tablet',
			'style' => 'devices',
			'tab'   => esc_html__( 'Tablet', 'omniverse' ),
		),
	)
);

Options::add_field(
	array(
		'id'         => 'single_product_gallery_column_mobile',
		'name'       => esc_html__( 'Columns on mobile', 'omniverse' ),
		'group'      => esc_html__( 'Image gallery', 'omniverse' ),
		'type'       => 'buttons',
		'section'    => 'product_images',
		'selectors'  => array(
			'[class*="thumbs-grid-bottom"] .woocommerce-product-gallery__wrapper.wd-grid' => array(
				'--wd-col: {{VALUE}};',
			),
		),
		'css_device' => 'mobile',
		'options'    => array(
			1 => array(
				'name'  => 1,
				'value' => 1,
			),
			2 => array(
				'name'  => 2,
				'value' => 2,
			),
			3 => array(
				'name'  => 3,
				'value' => 3,
			),
			4 => array(
				'name'  => 4,
				'value' => 4,
			),
			5 => array(
				'name'  => 5,
				'value' => 5,
			),
			6 => array(
				'name'  => 6,
				'value' => 6,
			),
		),
		'default'    => '',
		'priority'   => 82,
		'requires'   => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'without' ),
			),
		),
		't_tab'      => array(
			'id'    => 'single_product_gallery_column_tabs',
			'icon'  => 'dn-i-phone',
			'style' => 'devices',
			'tab'   => esc_html__( 'Mobile', 'omniverse' ),
		),
	)
);

Options::add_field(
	array(
		'id'       => 'single_product_thumbnails_vertical_items',
		'name'     => esc_html__( 'Thumbnails per slide on desktop', 'omniverse' ),
		'hint'     => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'single-product-thumbnails-vertical-items.mp4" autoplay loop muted></video>',
		'group'    => esc_html__( 'Image gallery', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_images',
		'options'  => array(
			'auto' => array(
				'name'  => esc_html__( 'Auto', 'omniverse' ),
				'value' => 'auto',
			),
			2      => array(
				'name'  => 2,
				'value' => 2,
			),
			3      => array(
				'name'  => 3,
				'value' => 3,
			),
			4      => array(
				'name'  => 4,
				'value' => 4,
			),
			5      => array(
				'name'  => 5,
				'value' => 5,
			),
			6      => array(
				'name'  => 6,
				'value' => 6,
			),
		),
		'default'  => 3,
		'priority' => 90,
		'requires' => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'left' ),
			),
		),
		't_tab'    => array(
			'id'       => 'single_product_thumbnails_items_tabs',
			'tab'      => esc_html__( 'Desktop', 'omniverse' ),
			'title'    => esc_html__( 'Thumbnails columns', 'omniverse' ),
			'icon'     => 'dn-i-desktop',
			'style'    => 'devices',
			'requires' => array(
				array(
					'key'     => 'thums_position',
					'compare' => 'equals',
					'value'   => array( 'bottom', 'left' ),
				),
			),
		),
	)
);

Options::add_field(
	array(
		'id'       => 'single_product_thumbnails_items_desktop',
		'name'     => esc_html__( 'Thumbnails per slide on desktop', 'omniverse' ),
		'hint'     => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'single-product-thumbnails-items-desktop.mp4" autoplay loop muted></video>',
		'group'    => esc_html__( 'Image gallery', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_images',
		'options'  => array(
			'auto' => array(
				'name'  => esc_html__( 'Auto', 'omniverse' ),
				'value' => 'auto',
			),
			2      => array(
				'name'  => 2,
				'value' => 2,
			),
			3      => array(
				'name'  => 3,
				'value' => 3,
			),
			4      => array(
				'name'  => 4,
				'value' => 4,
			),
			5      => array(
				'name'  => 5,
				'value' => 5,
			),
			6      => array(
				'name'  => 6,
				'value' => 6,
			),
		),
		'default'  => 4,
		'priority' => 91,
		'requires' => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'bottom' ),
			),
		),
		't_tab'    => array(
			'id'       => 'single_product_thumbnails_items_tabs',
			'tab'      => esc_html__( 'Desktop', 'omniverse' ),
			'title'    => esc_html__( 'Thumbnails columns', 'omniverse' ),
			'icon'     => 'dn-i-desktop',
			'style'    => 'devices',
			'requires' => array(
				array(
					'key'     => 'thums_position',
					'compare' => 'equals',
					'value'   => array( 'bottom', 'left' ),
				),
			),
		),
	)
);

Options::add_field(
	array(
		'id'       => 'single_product_thumbnails_items_tablet',
		'name'     => esc_html__( 'Thumbnails per slide on tablet', 'omniverse' ),
		'group'    => esc_html__( 'Image gallery', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_images',
		'options'  => array(
			'auto' => array(
				'name'  => esc_html__( 'Auto', 'omniverse' ),
				'value' => 'auto',
			),
			2      => array(
				'name'  => 2,
				'value' => 2,
			),
			3      => array(
				'name'  => 3,
				'value' => 3,
			),
			4      => array(
				'name'  => 4,
				'value' => 4,
			),
			5      => array(
				'name'  => 5,
				'value' => 5,
			),
			6      => array(
				'name'  => 6,
				'value' => 6,
			),
		),
		'default'  => 4,
		'priority' => 92,
		'requires' => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'bottom', 'left' ),
			),
		),
		't_tab'    => array(
			'id'    => 'single_product_thumbnails_items_tabs',
			'icon'  => 'dn-i-tablet',
			'style' => 'devices',
			'tab'   => esc_html__( 'Tablet', 'omniverse' ),
		),
	)
);

Options::add_field(
	array(
		'id'       => 'single_product_thumbnails_items_mobile',
		'name'     => esc_html__( 'Thumbnails per slide on mobile', 'omniverse' ),
		'group'    => esc_html__( 'Image gallery', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_images',
		'options'  => array(
			'auto' => array(
				'name'  => esc_html__( 'Auto', 'omniverse' ),
				'value' => 'auto',
			),
			2      => array(
				'name'  => 2,
				'value' => 2,
			),
			3      => array(
				'name'  => 3,
				'value' => 3,
			),
			4      => array(
				'name'  => 4,
				'value' => 4,
			),
			5      => array(
				'name'  => 5,
				'value' => 5,
			),
			6      => array(
				'name'  => 6,
				'value' => 6,
			),
		),
		'default'  => 3,
		'priority' => 93,
		'requires' => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'bottom', 'left' ),
			),
		),
		't_tab'    => array(
			'id'    => 'single_product_thumbnails_items_tabs',
			'icon'  => 'dn-i-phone',
			'style' => 'devices',
			'tab'   => esc_html__( 'Mobile', 'omniverse' ),
		),
	)
);

Options::add_field(
	array(
		'id'       => 'main_gallery_on_tablet',
		'name'     => esc_html__( 'Carousel on tablet', 'omniverse' ),
		'group'    => esc_html__( 'Image gallery', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'product_images',
		'default'  => true,
		'requires' => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'bottom_column', 'bottom_grid', 'bottom_combined', 'bottom_combined_2', 'bottom_combined_3' ),
			),
		),
		't_tab'    => array(
			'id'       => 'single_product_carousel_tabs',
			'tab'      => esc_html__( 'Tablet', 'omniverse' ),
			'title'    => esc_html__( 'Thumbnails columns', 'omniverse' ),
			'icon'     => 'dn-i-tablet',
			'style'    => 'devices',
			'requires' => array(
				array(
					'key'     => 'thums_position',
					'compare' => 'equals',
					'value'   => array( 'bottom_column', 'bottom_grid', 'bottom_combined', 'bottom_combined_2', 'bottom_combined_3' ),
				),
			),
		),
		'priority' => 100,
	)
);

Options::add_field(
	array(
		'id'       => 'main_gallery_on_mobile',
		'name'     => esc_html__( 'Carousel on mobile', 'omniverse' ),
		'group'    => esc_html__( 'Image gallery', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'product_images',
		'default'  => true,
		'requires' => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'bottom_column', 'bottom_grid', 'bottom_combined', 'bottom_combined_2', 'bottom_combined_3' ),
			),
		),
		't_tab'    => array(
			'id'    => 'single_product_carousel_tabs',
			'icon'  => 'dn-i-phone',
			'style' => 'devices',
			'tab'   => esc_html__( 'Mobile', 'omniverse' ),
		),
		'priority' => 101,
	)
);

Options::add_field(
	array(
		'id'       => 'main_gallery_center_mode',
		'name'     => esc_html__( 'Center mode in main gallery', 'omniverse' ),
		'group'    => esc_html__( 'Image gallery', 'omniverse' ),
		'hint'     => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'single-product-gallery-center-mode.mp4" autoplay loop muted></video>',
		'type'     => 'switcher',
		'section'  => 'product_images',
		'default'  => false,
		'requires' => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'without' ),
			),
		),
		'priority' => 105,
	)
);

Options::add_field(
	array(
		'id'       => 'single_product_thumbnails_wrap_in_mobile_devices',
		'name'     => esc_html__( 'Thumbnails position bottom on mobile devices', 'omniverse' ),
		'group'    => esc_html__( 'Image gallery', 'omniverse' ),
		'hint'     => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'single-product-thumbnails-bottom-in-mobile-devices.mp4" autoplay loop muted></video>',
		'type'     => 'switcher',
		'section'  => 'product_images',
		'default'  => true,
		'requires' => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'left' ),
			),
		),
		'priority' => 110,
	)
);

Options::add_field(
	array(
		'id'            => 'single_product_thumbnails_gallery_width',
		'name'          => esc_html__( 'Thumbnails gallery width', 'omniverse' ),
		'group'         => esc_html__( 'Image gallery', 'omniverse' ),
		'hint'          => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'single-product-thumbnails-gallery-width.mp4" autoplay loop muted></video>',
		'type'          => 'responsive_range',
		'section'       => 'product_images',
		'selectors'     => array(
			'.woocommerce-product-gallery.thumbs-position-left' => array(
				'--wd-thumbs-width: {{VALUE}}{{UNIT}};',
			),
		),
		'generate_zero' => true,
		'devices'       => array(
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
		'range'         => array(
			'px' => array(
				'min'  => 0,
				'max'  => 1000,
				'step' => 1,
			),
			'%'  => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			),
		),
		'requires'      => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'left' ),
			),
		),
		'class'         => 'dn-col-6',
		'priority'      => 140,
	)
);

Options::add_field(
	array(
		'id'            => 'single_product_thumbnails_gallery_height',
		'name'          => esc_html__( 'Thumbnails gallery height', 'omniverse' ),
		'group'         => esc_html__( 'Image gallery', 'omniverse' ),
		'hint'          => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'single-product-thumbnails-gallery-height.mp4" autoplay loop muted></video>',
		'type'          => 'responsive_range',
		'section'       => 'product_images',
		'selectors'     => array(
			'.woocommerce-product-gallery.thumbs-position-left' => array(
				'--wd-thumbs-height: {{VALUE}}{{UNIT}};',
			),
		),
		'generate_zero' => true,
		'devices'       => array(
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
		'range'         => array(
			'px' => array(
				'min'  => 0,
				'max'  => 1000,
				'step' => 1,
			),
		),
		'requires'      => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'left' ),
			),
		),
		'class'         => 'dn-col-6',
		'priority'      => 150,
	)
);

Options::add_field(
	array(
		'id'          => 'single_product_thumbnails_gallery_image_width',
		'type'        => 'text_input',
		'attributes'  => array(
			'type' => 'number',
		),
		'section'     => 'product_images',
		'name'        => esc_html__( 'Thumbnails image width', 'omniverse' ),
		'description' => __( 'IMPORTANT: You need to regenerate all thumbnails to apply the changes. Use the following <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">plugin</a> for this.', 'omniverse' ),
		'group'       => esc_html__( 'Image gallery', 'omniverse' ),
		'default'     => 150,
		'priority'    => 160,
		'requires'    => array(
			array(
				'key'     => 'thums_position',
				'compare' => 'equals',
				'value'   => array( 'bottom', 'left' ),
			),
		),
	)
);

/**
 * Add to cart options.
 */
Options::add_field(
	array(
		'id'          => 'single_ajax_add_to_cart',
		'name'        => esc_html__( 'AJAX Add to cart', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'ajax-add-to-cart.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Turn on the AJAX add to cart option on the single product page. Will not work with plugins that add some custom fields to the add to cart form.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'single_product_add_to_cart_section',
		'default'     => '1',
		'priority'    => 110,
	)
);

Options::add_field(
	array(
		'id'          => 'single_sticky_add_to_cart',
		'name'        => esc_html__( 'Sticky add to cart', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'sticky-add-to-cart.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Add to cart section will be displayed at the bottom of your screen when you scroll down the page.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'single_product_add_to_cart_section',
		'default'     => false,
		'priority'    => 160,
		'class'       => 'dn-tooltip-bordered',
	)
);

Options::add_field(
	array(
		'id'          => 'mobile_single_sticky_add_to_cart',
		'name'        => esc_html__( 'Sticky add to cart on mobile', 'omniverse' ),
		'description' => esc_html__( 'You can leave this option for desktop only or enable it for all devices sizes.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'single_product_add_to_cart_section',
		'default'     => false,
		'priority'    => 170,
		'requires'    => array(
			array(
				'key'     => 'single_sticky_add_to_cart',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
	)
);

Options::add_field(
	array(
		'id'        => 'sticky_add_to_cart_height_desktop',
		'type'      => 'range',
		'section'   => 'single_product_add_to_cart_section',
		'name'      => esc_html__( 'Height on desktop', 'omniverse' ),
		'default'   => 95,
		'min'       => 60,
		'max'       => 200,
		'step'      => 1,
		'selectors' => array(
			':root' => array(
				'--wd-sticky-btn-height: {{VALUE}}px;',
			),
		),
		'requires'  => array(
			array(
				'key'     => 'single_sticky_add_to_cart',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
		't_tab'     => array(
			'id'       => 'sticky_add_to_cart_tabs',
			'tab'      => esc_html__( 'Desktop', 'omniverse' ),
			'icon'     => 'dn-i-desktop',
			'style'    => 'devices',
			'requires' => array(
				array(
					'key'     => 'single_sticky_add_to_cart',
					'compare' => 'equals',
					'value'   => '1',
				),
			),
		),
		'priority'  => 180,
		'unit'      => 'px',
	)
);

Options::add_field(
	array(
		'id'         => 'sticky_add_to_cart_height_tablet',
		'type'       => 'range',
		'section'    => 'single_product_add_to_cart_section',
		'name'       => esc_html__( 'Height on tablet', 'omniverse' ),
		'default'    => 95,
		'min'        => 60,
		'max'        => 200,
		'step'       => 1,
		'css_device' => 'tablet',
		'selectors'  => array(
			':root' => array(
				'--wd-sticky-btn-height: {{VALUE}}px;',
			),
		),
		'requires'   => array(
			array(
				'key'     => 'single_sticky_add_to_cart',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
		't_tab'      => array(
			'id'   => 'sticky_add_to_cart_tabs',
			'tab'  => esc_html__( 'Tablet', 'omniverse' ),
			'icon' => 'dn-i-tablet',
		),
		'priority'   => 190,
		'unit'       => 'px',
	)
);

Options::add_field(
	array(
		'id'         => 'sticky_add_to_cart_height_mobile',
		'type'       => 'range',
		'section'    => 'single_product_add_to_cart_section',
		'name'       => esc_html__( 'Height on mobile', 'omniverse' ),
		'default'    => 42,
		'min'        => 40,
		'max'        => 120,
		'step'       => 1,
		'css_device' => 'mobile',
		'selectors'  => array(
			':root' => array(
				'--wd-sticky-btn-height: {{VALUE}}px;',
			),
		),
		'requires'   => array(
			array(
				'key'     => 'single_sticky_add_to_cart',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
		't_tab'      => array(
			'id'   => 'sticky_add_to_cart_tabs',
			'tab'  => esc_html__( 'Mobile', 'omniverse' ),
			'icon' => 'dn-i-phone',
		),
		'priority'   => 200,
		'unit'       => 'px',
	)
);

Options::add_field(
	array(
		'id'       => 'before_add_to_cart_content_type',
		'name'     => esc_html__( 'Before "Add to cart button"', 'omniverse' ),
		'group'    => esc_html__( 'Content', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'single_product_add_to_cart_section',
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
		'priority' => 220,
		'class'    => 'dn-html-block-switch',
	)
);

Options::add_field(
	array(
		'id'       => 'content_before_add_to_cart',
		'type'     => 'textarea',
		'wysiwyg'  => true,
		'name'     => esc_html__( 'Text', 'omniverse' ),
		'group'    => esc_html__( 'Content', 'omniverse' ),
		'section'  => 'single_product_add_to_cart_section',
		'requires' => array(
			array(
				'key'     => 'before_add_to_cart_content_type',
				'compare' => 'equals',
				'value'   => 'text',
			),
		),
		'priority' => 230,
	)
);

Options::add_field(
	array(
		'id'           => 'before_add_to_cart_html_block',
		'type'         => 'select',
		'section'      => 'single_product_add_to_cart_section',
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
				'key'     => 'before_add_to_cart_content_type',
				'compare' => 'equals',
				'value'   => 'html_block',
			),
		),
		'priority'     => 240,
	)
);

Options::add_field(
	array(
		'id'       => 'after_add_to_cart_content_type',
		'name'     => esc_html__( 'After "Add to cart button"', 'omniverse' ),
		'group'    => esc_html__( 'Content', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'single_product_add_to_cart_section',
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
		'priority' => 250,
		'class'    => 'dn-html-block-switch',
	)
);

Options::add_field(
	array(
		'id'       => 'content_after_add_to_cart',
		'type'     => 'textarea',
		'name'     => esc_html__( 'Text', 'omniverse' ),
		'group'    => esc_html__( 'Content', 'omniverse' ),
		'wysiwyg'  => true,
		'section'  => 'single_product_add_to_cart_section',
		'requires' => array(
			array(
				'key'     => 'after_add_to_cart_content_type',
				'compare' => 'equals',
				'value'   => 'text',
			),
		),
		'priority' => 260,
	)
);

Options::add_field(
	array(
		'id'           => 'after_add_to_cart_html_block',
		'type'         => 'select',
		'name'         => esc_html__( 'HTML Block', 'omniverse' ),
		'group'        => esc_html__( 'Content', 'omniverse' ),
		'section'      => 'single_product_add_to_cart_section',
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
				'key'     => 'after_add_to_cart_content_type',
				'compare' => 'equals',
				'value'   => 'html_block',
			),
		),
		'priority'     => 270,
	)
);

/**
 * Elements.
 */
Options::add_field(
	array(
		'id'          => 'single_breadcrumbs_position',
		'name'        => esc_html__( 'Position', 'omniverse' ),
		'description' => esc_html__( 'Set different position for breadcrumbs section on your product\'s page.', 'omniverse' ),
		'group'       => esc_html__( 'Breadcrumbs & Products navigation', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'product_elements',
		'options'     => array(
			'default'      => array(
				'name'  => esc_html__( 'Default', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'breadcrumbs-product-page-position-default.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'default',
			),
			'below_header' => array(
				'name'  => esc_html__( 'Below header', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'breadcrumbs-product-page-position-below-header.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'below_header',
			),
			'summary'      => array(
				'name'  => esc_html__( 'Product summary', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'breadcrumbs-product-page-position-default.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'summary',
			),
		),
		'default'     => 'default',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'       => 'product_page_breadcrumbs',
		'name'     => esc_html__( 'Breadcrumbs on product page', 'omniverse' ),
		'group'    => esc_html__( 'Breadcrumbs & Products navigation', 'omniverse' ),
		'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'single-product-breadcrumbs.jpg" alt="">', 'omniverse' ), true ),
		'type'     => 'switcher',
		'section'  => 'product_elements',
		'default'  => '1',
		'priority' => 20,
	)
);

Options::add_field(
	array(
		'id'       => 'products_nav',
		'name'     => esc_html__( 'Products navigation', 'omniverse' ),
		'group'    => esc_html__( 'Breadcrumbs & Products navigation', 'omniverse' ),
		'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'single-product-products-navigation.jpg" alt="">', 'omniverse' ), true ),
		'type'     => 'switcher',
		'section'  => 'product_elements',
		'default'  => '1',
		'priority' => 30,
	)
);

Options::add_field(
	array(
		'id'          => 'product_short_description',
		'name'        => esc_html__( 'Enable short description', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'enable-short-description.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Enable/disable short description text in the product\'s summary block.', 'omniverse' ),
		'group'       => esc_html__( 'Short description', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'product_elements',
		'default'     => '1',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 40,
	)
);

Options::add_field(
	array(
		'id'          => 'attr_after_short_desc',
		'name'        => esc_html__( 'Show attributes table after short description', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-attributes-table-after-short-description.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'You can display attributes table after of short description.', 'omniverse' ),
		'group'       => esc_html__( 'Short description', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'product_elements',
		'default'     => false,
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 50,
	)
);

Options::add_field(
	array(
		'id'       => 'stock_status_design',
		'name'     => esc_html__( 'Stock status design', 'omniverse' ),
		'group'    => esc_html__( 'Stock status', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_elements',
		'default'  => 'default',
		'options'  => array(
			'default'  => array(
				'name'  => esc_html__( 'Default', 'omniverse' ),
				'value' => 'default',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/stock-status/default.jpg',
			),
			'with-bg'  => array(
				'name'  => esc_html__( 'With background', 'omniverse' ),
				'value' => 'with-bg',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/stock-status/background.jpg',
			),
			'bordered' => array(
				'name'  => esc_html__( 'Bordered', 'omniverse' ),
				'value' => 'bordered',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/stock-status/bordered.jpg',
			),
		),
		'priority' => 60,
		'class'    => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'          => 'single_stock_progress_bar',
		'name'        => esc_html__( 'Stock progress bar', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'stock-progress-bar.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Display a number of sold and in stock products as a progress bar.', 'omniverse' ),
		'group'       => esc_html__( 'Stock status', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'product_elements',
		'default'     => false,
		'priority'    => 70,
	)
);

Options::add_field(
	array(
		'id'          => 'product_countdown',
		'name'        => esc_html__( 'Countdown timer', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'countdown-timer.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Show timer for products that have scheduled date for the sale price', 'omniverse' ),
		'group'       => esc_html__( 'Countdown timer', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'product_elements',
		'default'     => false,
		'priority'    => 80,
	)
);

Options::add_field(
	array(
		'id'          => 'sale_countdown_variable',
		'name'        => esc_html__( 'Countdown for variable products', 'omniverse' ),
		'description' => esc_html__( 'Sale end date will be based on the first variation date of the product.', 'omniverse' ),
		'group'       => esc_html__( 'Countdown timer', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'product_elements',
		'requires'    => array(
			array(
				'key'     => 'product_countdown',
				'compare' => 'equals',
				'value'   => true,
			),
		),
		'default'     => false,
		'priority'    => 90,
	)
);

Options::add_field(
	array(
		'id'          => 'product_show_meta',
		'name'        => esc_html__( 'Show product meta', 'omniverse' ),
		'description' => esc_html__( 'Categories, tags, SKU', 'omniverse' ),
		'group'       => esc_html__( 'Meta', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'product_elements',
		'options'     => array(
			'add_to_cart' => array(
				'name'  => esc_html__( 'After "Add to cart" button', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-product-meta-affter-add-to-cart.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'add_to_cart',
			),
			'after_tabs'  => array(
				'name'  => esc_html__( 'After tabs', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-product-meta-affter-tabs.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'after_tabs',
			),
			'hide'        => array(
				'name'  => esc_html__( 'Hide', 'omniverse' ),
				'value' => 'hide',
			),
		),
		'default'     => 'add_to_cart',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 100,
	)
);

Options::add_field(
	array(
		'id'          => 'product_share',
		'name'        => esc_html__( 'Show share buttons', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-share-buttons.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Display share buttons icons on the single product page.', 'omniverse' ),
		'group'       => esc_html__( 'Share buttons', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'product_elements',
		'default'     => '1',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 110,
	)
);

Options::add_field(
	array(
		'id'          => 'product_share_type',
		'name'        => esc_html__( 'Share buttons type', 'omniverse' ),
		'description' => esc_html__( 'You can switch between share and follow buttons on the single product page.', 'omniverse' ),
		'group'       => esc_html__( 'Share buttons', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'product_elements',
		'options'     => array(
			'share'  => array(
				'name'  => esc_html__( 'Share', 'omniverse' ),
				'value' => 'share',
			),
			'follow' => array(
				'name'  => esc_html__( 'Follow', 'omniverse' ),
				'value' => 'follow',
			),
		),
		'requires'    => array(
			array(
				'key'     => 'product_share',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
		'default'     => 'share',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 120,
	)
);

/**
 * Related section.
 */


Options::add_field(
	array(
		'id'          => 'related_products',
		'name'        => esc_html__( 'Show related products', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-related-products.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Related products is a section that pulls products from your store that share the same tags or categories as the current product.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'single_product_related_section',
		'default'     => '1',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'upsells_position',
		'name'        => esc_html__( 'Upsells products position', 'omniverse' ),
		'description' => esc_html__( 'If use "Sidebar" be sure that you have enabled it for the product page layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'single_product_related_section',
		'options'     => array(
			'standard' => array(
				'name'  => esc_html__( 'Standard', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'upsells-products-position-standart.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'standard',
			),
			'sidebar'  => array(
				'name'  => esc_html__( 'Sidebar', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'upsells-products-position-sidebar.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'sidebar',
			),
			'hide'     => array(
				'name'  => esc_html__( 'Hide', 'omniverse' ),
				'value' => 'hide',
			),
		),
		'default'     => 'standard',
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'          => 'related_product_view',
		'name'        => esc_html__( 'Product view', 'omniverse' ),
		'description' => esc_html__( 'You can set different view mode for the related products. These settings will be applied for upsells products as well.', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'single_product_related_section',
		'options'     => array(
			'grid'   => array(
				'name'  => esc_html__( 'Grid', 'omniverse' ),
				'value' => 'grid',
			),
			'slider' => array(
				'name'  => esc_html__( 'Carousel', 'omniverse' ),
				'value' => 'slider',
			),
		),
		'default'     => 'slider',
		'priority'    => 30,
	)
);

Options::add_field(
	array(
		'id'          => 'related_product_columns',
		'name'        => esc_html__( 'Product columns', 'omniverse' ),
		'description' => esc_html__( 'How many products you want to show per row.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'single_product_related_section',
		'options'     => array(
			2 => array(
				'name'  => 2,
				'value' => 2,
			),
			3 => array(
				'name'  => 3,
				'value' => 3,
			),
			4 => array(
				'name'  => 4,
				'value' => 4,
			),
			5 => array(
				'name'  => 5,
				'value' => 5,
			),
			6 => array(
				'name'  => 6,
				'value' => 6,
			),
		),
		't_tab'       => array(
			'id'    => 'related_product_columns_tabs',
			'tab'   => esc_html__( 'Desktop', 'omniverse' ),
			'icon'  => 'dn-i-desktop',
			'style' => 'devices',
		),
		'default'     => 4,
		'priority'    => 40,
	)
);

Options::add_field(
	array(
		'id'          => 'related_product_columns_tablet',
		'name'        => esc_html__( 'Product columns', 'omniverse' ),
		'description' => esc_html__( 'How many products you want to show per row.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'single_product_related_section',
		'options'     => array(
			'auto' => array(
				'name'  => esc_html__( 'Auto', 'omniverse' ),
				'value' => 'auto',
			),
			2      => array(
				'name'  => 2,
				'value' => 2,
			),
			3      => array(
				'name'  => 3,
				'value' => 3,
			),
			4      => array(
				'name'  => 4,
				'value' => 4,
			),
			5      => array(
				'name'  => 5,
				'value' => 5,
			),
			6      => array(
				'name'  => 6,
				'value' => 6,
			),
		),
		't_tab'       => array(
			'id'   => 'related_product_columns_tabs',
			'icon' => 'dn-i-tablet',
			'tab'  => esc_html__( 'Tablet', 'omniverse' ),
		),
		'default'     => 'auto',
		'priority'    => 41,
	)
);

Options::add_field(
	array(
		'id'          => 'related_product_columns_mobile',
		'name'        => esc_html__( 'Product columns', 'omniverse' ),
		'description' => esc_html__( 'How many products you want to show per row.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'single_product_related_section',
		'options'     => array(
			'auto' => array(
				'name'  => esc_html__( 'Auto', 'omniverse' ),
				'value' => 'auto',
			),
			2      => array(
				'name'  => 2,
				'value' => 2,
			),
			3      => array(
				'name'  => 3,
				'value' => 3,
			),
			4      => array(
				'name'  => 4,
				'value' => 4,
			),
			5      => array(
				'name'  => 5,
				'value' => 5,
			),
			6      => array(
				'name'  => 6,
				'value' => 6,
			),
		),
		't_tab'       => array(
			'id'   => 'related_product_columns_tabs',
			'icon' => 'dn-i-phone',
			'tab'  => esc_html__( 'Mobile', 'omniverse' ),
		),
		'default'     => 'auto',
		'priority'    => 42,
	)
);

Options::add_field(
	array(
		'id'          => 'related_product_count',
		'name'        => esc_html__( 'Product count', 'omniverse' ),
		'description' => esc_html__( 'The total number of related products to display.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'text_input',
		'attributes'  => array(
			'type' => 'number',
		),
		'section'     => 'single_product_related_section',
		'default'     => 8,
		'priority'    => 50,
	)
);

/**
 * Tabs.
 */
Options::add_field(
	array(
		'id'          => 'product_tabs_layout',
		'name'        => esc_html__( 'Tabs layout', 'omniverse' ),
		'description' => esc_html__( 'Select which style for products tabs do you need.', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'product_tabs',
		'options'     => array(
			'tabs'      => array(
				'name'  => esc_html__( 'Tabs', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'tabs-layout-tabs.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'tabs',
			),
			'accordion' => array(
				'name'  => esc_html__( 'Accordion', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'tabs-layout-accordion.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'accordion',
			),
		),
		'default'     => 'tabs',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'       => 'product_tabs_location',
		'name'     => esc_html__( 'Tabs location', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_tabs',
		'options'  => array(
			'standard' => array(
				'name'  => esc_html__( 'Standard', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'tabs-layout-accordion.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'standard',
			),
			'summary'  => array(
				'name'  => esc_html__( 'After "Add to cart" button', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'tabs-location-after-dd-to-cart-button.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'summary',
			),
		),
		'default'  => 'standard',
		'priority' => 20,
		'requires' => array(
			array(
				'key'     => 'product_tabs_layout',
				'compare' => 'equals',
				'value'   => 'accordion',
			),
		),
	)
);

Options::add_field(
	array(
		'id'       => 'product_accordion_state',
		'name'     => esc_html__( 'Accordion state', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_tabs',
		'options'  => array(
			'first'      => array(
				'name'  => esc_html__( 'First opened', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'tabs-layout-accordion.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'first',
			),
			'all_closed' => array(
				'name'  => esc_html__( 'All closed', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'tabs-layout-accordion-all-closed.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'all_closed',
			),
		),
		'default'  => 'first',
		'priority' => 30,
		'requires' => array(
			array(
				'key'     => 'product_tabs_layout',
				'compare' => 'equals',
				'value'   => 'accordion',
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'hide_tabs_titles',
		'name'        => esc_html__( 'Hide tabs headings', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'hide-tabs-headings.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Don\'t show duplicated titles for product tabs.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'product_tabs',
		'default'     => '1',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 40,
	)
);

Options::add_field(
	array(
		'id'          => 'additional_tab_title',
		'name'        => esc_html__( 'Tab title', 'omniverse' ),
		'description' => esc_html__( 'Leave empty to disable custom tab', 'omniverse' ),
		'type'        => 'text_input',
		'default'     => 'Shipping & Delivery',
		'section'     => 'product_tabs',
		't_tab'       => array(
			'id'    => 'additional_tabs_control_tabs',
			'tab'   => esc_html__( 'Tab [1]', 'omniverse' ),
			'title' => esc_html__( 'Additional tabs', 'omniverse' ),
			'style' => 'default',
		),
		'priority'    => 60,
		'class'       => 'dn-tab-field',
	)
);

Options::add_field(
	array(
		'id'       => 'additional_tab_content_type',
		'name'     => esc_html__( 'Content type', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_tabs',
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
		't_tab'    => array(
			'id'  => 'additional_tabs_control_tabs',
			'tab' => esc_html__( 'Tab [1]', 'omniverse' ),
		),
		'default'  => 'text',
		'priority' => 61,
		'class'    => 'dn-html-block-switch',
	)
);

Options::add_field(
	array(
		'id'       => 'additional_tab_text',
		'type'     => 'textarea',
		'wysiwyg'  => false,
		'name'     => esc_html__( 'Text', 'omniverse' ),
		'default'  => '',
		'section'  => 'product_tabs',
		'requires' => array(
			array(
				'key'     => 'additional_tab_content_type',
				'compare' => 'equals',
				'value'   => 'text',
			),
		),
		't_tab'    => array(
			'id'  => 'additional_tabs_control_tabs',
			'tab' => esc_html__( 'Tab [1]', 'omniverse' ),
		),
		'priority' => 62,
		'class'    => 'dn-tab-field dn-last-tab-field',
	)
);

Options::add_field(
	array(
		'id'           => 'additional_tab_html_block',
		'type'         => 'select',
		'section'      => 'product_tabs',
		'name'         => esc_html__( 'HTML Block', 'omniverse' ),
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
				'key'     => 'additional_tab_content_type',
				'compare' => 'equals',
				'value'   => 'html_block',
			),
		),
		't_tab'        => array(
			'id'  => 'additional_tabs_control_tabs',
			'tab' => esc_html__( 'Tab [1]', 'omniverse' ),
		),
		'priority'     => 63,
		'class'        => 'dn-tab-field dn-last-tab-field',
	)
);

Options::add_field(
	array(
		'id'          => 'additional_tab_2_title',
		'name'        => esc_html__( 'Tab title', 'omniverse' ),
		'description' => esc_html__( 'Leave empty to disable custom tab', 'omniverse' ),
		'type'        => 'text_input',
		'section'     => 'product_tabs',
		't_tab'       => array(
			'id'  => 'additional_tabs_control_tabs',
			'tab' => esc_html__( 'Tab [2]', 'omniverse' ),
		),
		'priority'    => 70,
		'class'       => 'dn-tab-field',
	)
);

Options::add_field(
	array(
		'id'       => 'additional_tab_2_content_type',
		'name'     => esc_html__( 'Content type', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_tabs',
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
		't_tab'    => array(
			'id'  => 'additional_tabs_control_tabs',
			'tab' => esc_html__( 'Tab [2]', 'omniverse' ),
		),
		'default'  => 'text',
		'priority' => 71,
		'class'    => 'dn-html-block-switch',
	)
);

Options::add_field(
	array(
		'id'       => 'additional_tab_2_text',
		'type'     => 'textarea',
		'name'     => esc_html__( 'Text', 'omniverse' ),
		'wysiwyg'  => false,
		'default'  => '',
		'section'  => 'product_tabs',
		'requires' => array(
			array(
				'key'     => 'additional_tab_2_content_type',
				'compare' => 'equals',
				'value'   => 'text',
			),
		),
		't_tab'    => array(
			'id'  => 'additional_tabs_control_tabs',
			'tab' => esc_html__( 'Tab [2]', 'omniverse' ),
		),
		'priority' => 72,
		'class'    => 'dn-tab-field dn-last-tab-field',
	)
);

Options::add_field(
	array(
		'id'           => 'additional_tab_2_html_block',
		'type'         => 'select',
		'section'      => 'product_tabs',
		'name'         => esc_html__( 'HTML Block', 'omniverse' ),
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
				'key'     => 'additional_tab_2_content_type',
				'compare' => 'equals',
				'value'   => 'html_block',
			),
		),
		't_tab'        => array(
			'id'  => 'additional_tabs_control_tabs',
			'tab' => esc_html__( 'Tab [2]', 'omniverse' ),
		),
		'priority'     => 73,
		'class'        => 'dn-tab-field dn-last-tab-field',
	)
);

Options::add_field(
	array(
		'id'          => 'additional_tab_3_title',
		'name'        => esc_html__( 'Tab title', 'omniverse' ),
		'description' => esc_html__( 'Leave empty to disable custom tab', 'omniverse' ),
		'type'        => 'text_input',
		'section'     => 'product_tabs',
		't_tab'       => array(
			'id'  => 'additional_tabs_control_tabs',
			'tab' => esc_html__( 'Tab [3]', 'omniverse' ),
		),
		'priority'    => 80,
		'class'       => 'dn-tab-field',
	)
);

Options::add_field(
	array(
		'id'       => 'additional_tab_3_content_type',
		'name'     => esc_html__( 'Content type', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_tabs',
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
		't_tab'    => array(
			'id'  => 'additional_tabs_control_tabs',
			'tab' => esc_html__( 'Tab [3]', 'omniverse' ),
		),
		'default'  => 'text',
		'priority' => 81,
		'class'    => 'dn-html-block-switch',
	)
);

Options::add_field(
	array(
		'id'       => 'additional_tab_3_text',
		'type'     => 'textarea',
		'wysiwyg'  => false,
		'default'  => '',
		'name'     => esc_html__( 'Text', 'omniverse' ),
		'section'  => 'product_tabs',
		'requires' => array(
			array(
				'key'     => 'additional_tab_3_content_type',
				'compare' => 'equals',
				'value'   => 'text',
			),
		),
		't_tab'    => array(
			'id'  => 'additional_tabs_control_tabs',
			'tab' => esc_html__( 'Tab [3]', 'omniverse' ),
		),
		'priority' => 82,
		'class'    => 'dn-tab-field dn-last-tab-field',
	)
);

Options::add_field(
	array(
		'id'           => 'additional_tab_3_html_block',
		'type'         => 'select',
		'section'      => 'product_tabs',
		'name'         => esc_html__( 'HTML Block', 'omniverse' ),
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
				'key'     => 'additional_tab_3_content_type',
				'compare' => 'equals',
				'value'   => 'html_block',
			),
		),
		't_tab'        => array(
			'id'  => 'additional_tabs_control_tabs',
			'tab' => esc_html__( 'Tab [3]', 'omniverse' ),
		),
		'priority'     => 83,
		'class'        => 'dn-tab-field dn-last-tab-field',
	)
);
