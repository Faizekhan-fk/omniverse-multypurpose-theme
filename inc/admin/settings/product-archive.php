<?php
if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

use DN\Admin\Modules\Options;

Options::add_field(
	array(
		'id'          => 'ajax_shop',
		'name'        => esc_html__( 'AJAX shop', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'ajax-shop.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Enable AJAX functionality for filter widgets, categories navigation, and pagination on the shop page.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'product_archive_section',
		'default'     => '1',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'ajax_scroll',
		'name'        => esc_html__( 'Scroll to top after AJAX', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'scroll-to-top-after-ajax.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Disable - Enable scroll to top after AJAX.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'product_archive_section',
		'default'     => '1',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'       => 'shop_page_breadcrumbs',
		'name'     => esc_html__( 'Breadcrumbs on shop page', 'omniverse' ),
		'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'breadcrumbs-on-shop-page.jpg" alt="">', 'omniverse' ), true ),
		'type'     => 'switcher',
		'section'  => 'product_archive_section',
		'default'  => '1',
		'priority' => 30,
	)
);

Options::add_field(
	array(
		'id'          => 'cat_desc_position',
		'name'        => esc_html__( 'Category description position', 'omniverse' ),
		'description' => esc_html__( 'You can change default products category description position and move it below the products.', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'product_archive_section',
		'options'     => array(
			'before' => array(
				'name'  => esc_html__( 'Before product grid', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'category-description-position-before.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'before',
			),
			'after'  => array(
				'name'  => esc_html__( 'After product grid', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'category-description-position-affter.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'after',
			),
		),
		'default'     => 'before',
		'priority'    => 40,
	)
);

/**
 * Product styles.
 */
Options::add_field(
	array(
		'id'          => 'products_hover',
		'name'        => esc_html__( 'Hover on product', 'omniverse' ),
		'description' => esc_html__( 'Choose one of those hover effects for products', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'products_styles_section',
		'default'     => 'base',
		'options'     => array(
			'info-alt'         => array(
				'name'  => esc_html__( 'Full info on hover', 'omniverse' ),
				'value' => 'info-alt',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/info-alt.jpg',
			),
			'info'             => array(
				'name'  => esc_html__( 'Full info on image', 'omniverse' ),
				'value' => 'info',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/info.jpg',
			),
			'alt'              => array(
				'name'  => esc_html__( 'Icons and "add to cart" on hover', 'omniverse' ),
				'value' => 'alt',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/alt.jpg',
			),
			'icons'            => array(
				'name'  => esc_html__( 'Icons on hover', 'omniverse' ),
				'value' => 'icons',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/icons.jpg',
			),
			'quick'            => array(
				'name'  => esc_html__( 'Quick', 'omniverse' ),
				'value' => 'quick',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/quick.jpg',
			),
			'button'           => array(
				'name'  => esc_html__( 'Show button on hover on image', 'omniverse' ),
				'value' => 'button',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/button.jpg',
			),
			'base'             => array(
				'name'  => esc_html__( 'Show summary on hover', 'omniverse' ),
				'value' => 'base',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/base.jpg',
			),
			'standard'         => array(
				'name'  => esc_html__( 'Standard button', 'omniverse' ),
				'value' => 'standard',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/standard.jpg',
			),
			'tiled'            => array(
				'name'  => esc_html__( 'Tiled', 'omniverse' ),
				'value' => 'tiled',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/tiled.jpg',
			),
			'fw-button'        => array(
				'name'  => esc_html__( 'Full width button', 'omniverse' ),
				'value' => 'fw-button',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/fw-button.jpg',
			),
			'buttons-on-hover' => array(
				'name'  => esc_html__( 'Buttons on hover', 'omniverse' ),
				'value' => 'new',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/hover/buttons-on-hover.jpg',
			),
		),
		'priority'    => 10,
		'requires'    => array(
			array(
				'key'     => 'shop_view',
				'compare' => 'not_equals',
				'value'   => 'list',
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'base_hover_mobile_click',
		'name'        => esc_html__( 'Open product on click on mobile', 'omniverse' ),
		'description' => esc_html__( 'If you disable this option, when user click on the product on mobile devices, it will see its description text and add to cart button. The product page will be opened on second click.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_styles_section',
		'default'     => false,
		'priority'    => 20,
		'requires'    => array(
			array(
				'key'     => 'products_hover',
				'compare' => 'equals',
				'value'   => array( 'base' ),
			),
			array(
				'key'     => 'shop_view',
				'compare' => 'not_equals',
				'value'   => 'list',
			),
		),
	)
);

Options::add_field(
	array(
		'id'       => 'products_color_scheme',
		'name'     => esc_html__( 'Products color scheme', 'omniverse' ),
		'group'    => esc_html__( 'Style', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'products_styles_section',
		'default'  => 'default',
		'options'  => array(
			'default' => array(
				'name'  => esc_html__( 'Default', 'omniverse' ),
				'value' => 'default',
			),
			'dark'    => array(
				'name'  => esc_html__( 'Dark', 'omniverse' ),
				'value' => 'dark',
			),
			'light'   => array(
				'name'  => esc_html__( 'Light', 'omniverse' ),
				'value' => 'light',
			),
		),
		'priority' => 30,
	)
);

Options::add_field(
	array(
		'id'          => 'products_bordered_grid',
		'name'        => esc_html__( 'Bordered grid', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'bordered-grid-outside.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Add borders between all product loop items, except for product elements, which have their own options.', 'omniverse' ),
		'group'       => esc_html__( 'Style', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_styles_section',
		'priority'    => 40,
	)
);

Options::add_field(
	array(
		'id'       => 'products_bordered_grid_style',
		'name'     => esc_html__( 'Bordered grid style', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'products_styles_section',
		'group'    => esc_html__( 'Style', 'omniverse' ),
		'options'  => array(
			'outside' => array(
				'name'  => esc_html__( 'Outside', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'bordered-grid-outside.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'outside',
			),
			'inside'  => array(
				'name'  => esc_html__( 'Inside', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'bordered-grid-inside.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'inside',
			),
		),
		'default'  => 'outside',
		'requires' => array(
			array(
				'key'     => 'products_bordered_grid',
				'compare' => 'equals',
				'value'   => true,
			),
		),
		'priority' => 50,
	)
);

Options::add_field(
	array(
		'id'          => 'products_with_background',
		'name'        => esc_html__( 'Products background', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'products-with-background.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Add background to all product loop items, except product elements, which have their own options.', 'omniverse' ),
		'group'       => esc_html__( 'Style', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_styles_section',
		'priority'    => 60,
	)
);

Options::add_field(
	array(
		'id'          => 'products_background',
		'name'        => esc_html__( 'Custom products background color', 'omniverse' ),
		'description' => esc_html__( 'Set custom background color for products.', 'omniverse' ),
		'group'       => esc_html__( 'Style', 'omniverse' ),
		'type'        => 'color',
		'default'     => array( 'idle' => '' ),
		'section'     => 'products_styles_section',
		'selectors'   => array(
			':is(.shop-content-area.wd-builder-off,.wd-wishlist-content,.related-and-upsells,.cart-collaterals,.wd-shop-product,.wd-fbt) .wd-products-with-bg, :is(.shop-content-area.wd-builder-off,.wd-wishlist-content,.related-and-upsells,.cart-collaterals,.wd-shop-product,.wd-fbt) .wd-products-with-bg .wd-product' => array(
				'--wd-prod-bg:{{VALUE}};',
				'--wd-bordered-bg:{{VALUE}};',
			),
		),
		'priority'    => 70,
		'class'       => 'dn-tab-field',
		'requires'    => array(
			array(
				'key'     => 'products_with_background',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'products_shadow',
		'name'        => esc_html__( 'Products shadow', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'products_shadow.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Add a shadow to product loop items if the initial product style did not have one. Product elements have their own shadow control.', 'omniverse' ),
		'group'       => esc_html__( 'Style', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_styles_section',
		'priority'    => 80,
	)
);

Options::add_field(
	array(
		'id'          => 'stretch_product_desktop',
		'name'        => esc_html__( 'Even product grid for desktop', 'omniverse' ),
		'description' => esc_html__( 'Align the product hover content to the bottom of the products row.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'even-product-grid.mp4" autoplay loop muted></video>',
		'type'        => 'switcher',
		'section'     => 'products_styles_section',
		'default'     => false,
		'priority'    => 90,
		'requires'    => array(
			array(
				'key'     => 'products_hover',
				'compare' => 'equals',
				'value'   => array( 'icons', 'alt', 'button', 'standard', 'tiled', 'quick', 'base', 'fw-button', 'buttons-on-hover' ),
			),
		),
		't_tab'       => array(
			'id'    => 'stretch_product_tabs',
			'tab'   => esc_html__( 'Desktop', 'omniverse' ),
			'icon'  => 'dn-i-desktop',
			'style' => 'devices',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'stretch_product_tablet',
		'name'        => esc_html__( 'Even product grid for tablet', 'omniverse' ),
		'description' => esc_html__( 'Align the product hover content to the bottom of the products row.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_styles_section',
		'default'     => false,
		'priority'    => 100,
		'requires'    => array(
			array(
				'key'     => 'products_hover',
				'compare' => 'equals',
				'value'   => array( 'icons', 'alt', 'button', 'standard', 'tiled', 'quick', 'base', 'fw-button', 'buttons-on-hover' ),
			),
		),
		't_tab'       => array(
			'id'   => 'stretch_product_tabs',
			'tab'  => esc_html__( 'Tablet', 'omniverse' ),
			'icon' => 'dn-i-tablet',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'stretch_product_mobile',
		'name'        => esc_html__( 'Even product grid for mobile', 'omniverse' ),
		'description' => esc_html__( 'Align the product hover content to the bottom of the products row.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_styles_section',
		'default'     => false,
		'priority'    => 110,
		'requires'    => array(
			array(
				'key'     => 'products_hover',
				'compare' => 'equals',
				'value'   => array( 'icons', 'alt', 'button', 'standard', 'tiled', 'quick', 'base', 'fw-button', 'buttons-on-hover' ),
			),
		),
		't_tab'       => array(
			'id'   => 'stretch_product_tabs',
			'tab'  => esc_html__( 'Mobile', 'omniverse' ),
			'icon' => 'dn-i-phone',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'product_title_lines_limit',
		'name'        => esc_html__( 'Product title lines limit', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'product-title-lines-limit.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Specify the maximum number of product title lines if it does not fit on one line.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'products_styles_section',
		'options'     => array(
			'one'  => array(
				'name'  => esc_html__( 'One line', 'omniverse' ),
				'value' => 'one',
			),
			'two'  => array(
				'name'  => esc_html__( 'Two line', 'omniverse' ),
				'value' => 'one',
			),
			'none' => array(
				'name'  => esc_html__( 'None', 'omniverse' ),
				'value' => 'none',
			),
		),
		'default'     => 'none',
		'priority'    => 120,
	)
);

Options::add_field(
	array(
		'id'          => 'show_empty_star_rating',
		'name'        => esc_html__( 'Show empty star rating', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-empty-star-rating.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Show empty star rating even if the product has no ratings.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_styles_section',
		'default'     => false,
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 130,
	)
);

Options::add_field(
	array(
		'id'          => 'hover_image',
		'name'        => esc_html__( 'Hover image', 'omniverse' ),
		'description' => esc_html__( 'Disable - Enable hover image for products on the shop page.', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'hover-image.mp4" autoplay loop muted></video>',
		'group'       => esc_html__( 'Elements', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_styles_section',
		'default'     => '1',
		'priority'    => 140,
	)
);

Options::add_field(
	array(
		'id'          => 'grid_gallery',
		'name'        => esc_html__( 'Product gallery', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'grid-gallery-control-hover.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Add the ability to view the product gallery on the products loop.', 'omniverse' ),
		'group'       => esc_html__( 'Elements', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_styles_section',
		'default'     => false,
		'priority'    => 150,
	)
);

Options::add_field(
	array(
		'id'       => 'grid_gallery_control',
		'name'     => esc_html__( 'Product gallery controls on desktop', 'omniverse' ),
		'group'    => esc_html__( 'Elements', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'products_styles_section',
		'options'  => array(
			'hover'  => array(
				'name'  => esc_html__( 'Hover', 'omniverse' ),
				'hint'  => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'grid-gallery-control-hover.mp4" autoplay loop muted></video>',
				'value' => 'hover',
			),
			'arrows' => array(
				'name'  => esc_html__( 'Arrows', 'omniverse' ),
				'hint'  => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'grid-gallery-control-arrows.mp4" autoplay loop muted></video>',
				'value' => 'arrows',
			),
		),
		'default'  => 'hover',
		'requires' => array(
			array(
				'key'     => 'grid_gallery',
				'compare' => 'equals',
				'value'   => true,
			),
		),
		't_tab'    => array(
			'id'       => 'grid_gallery_tabs',
			'tab'      => esc_html__( 'Desktop', 'omniverse' ),
			'icon'     => 'dn-i-desktop',
			'style'    => 'devices',
			'requires' => array(
				array(
					'key'     => 'grid_gallery',
					'compare' => 'equals',
					'value'   => true,
				),
			),
		),
		'priority' => 160,
	)
);

Options::add_field(
	array(
		'id'       => 'grid_gallery_enable_arrows',
		'name'     => esc_html__( 'Product gallery controls on mobile device', 'omniverse' ),
		'group'    => esc_html__( 'Elements', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'products_styles_section',
		'options'  => array(
			'none'   => array(
				'name'  => esc_html__( 'None', 'omniverse' ),
				'value' => 'none',
			),
			'arrows' => array(
				'name'  => esc_html__( 'Arrows', 'omniverse' ),
				'value' => 'arrows',
			),
		),
		'default'  => 'none',
		'requires' => array(
			array(
				'key'     => 'grid_gallery',
				'compare' => 'equals',
				'value'   => true,
			),
		),
		't_tab'    => array(
			'id'   => 'grid_gallery_tabs',
			'tab'  => esc_html__( 'Mobile device', 'omniverse' ),
			'icon' => 'dn-i-phone',
		),
		'priority' => 170,
	)
);

Options::add_field(
	array(
		'id'          => 'product_quantity',
		'name'        => esc_html__( 'Quantity input on product', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'quantity-input-on-product.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Show quantity input on product hover and quick shop where the layout is allowing it. It can be shown on the following product hovers: "Standard button", "Quick", "Full width button", "List".', 'omniverse' ),
		'group'       => esc_html__( 'Elements', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_styles_section',
		'default'     => false,
		'priority'    => 180,
	)
);

Options::add_field(
	array(
		'id'       => 'base_hover_content',
		'name'     => esc_html__( 'Hover content', 'omniverse' ),
		'group'    => esc_html__( 'Elements', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'products_styles_section',
		'options'  => array(
			'excerpt'         => array(
				'name'  => esc_html__( 'Excerpt', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'hover-content-excerpt.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'excerpt',
			),
			'additional_info' => array(
				'name'  => esc_html__( 'Additional information', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'hover-content-additional-information.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'additional_info',
			),
			'none'            => array(
				'name'  => esc_html__( 'None', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'hover-content-none.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'none',
			),
		),
		'default'  => 'excerpt',
		'requires' => array(
			array(
				'key'     => 'products_hover',
				'compare' => 'equals',
				'value'   => array( 'base', 'fw-button' ),
			),
		),
		'priority' => 190,
	)
);

Options::add_field(
	array(
		'id'       => 'stock_status_position',
		'name'     => esc_html__( 'Stock status position', 'omniverse' ),
		'group'    => esc_html__( 'Elements', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'products_styles_section',
		'options'  => array(
			'thumbnail'   => array(
				'name'  => esc_html__( 'In thumbnail', 'omniverse' ),
				'hint'  => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'stock-status-position-thumbnail.mp4" autoplay loop muted></video>',
				'value' => 'thumbnail',
			),
			'after_title' => array(
				'name'  => esc_html__( 'After title', 'omniverse' ),
				'hint'  => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'stock-status-position-after-title.mp4" autoplay loop muted></video>',
				'value' => 'after_title',
			),
		),
		'default'  => 'thumbnail',
		'priority' => 200,
	)
);

Options::add_field(
	array(
		'id'       => 'show_stock_quantity_on_grid',
		'name'     => esc_html__( 'Show stock quantity', 'omniverse' ),
		'group'    => esc_html__( 'Elements', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'products_styles_section',
		'default'  => false,
		'requires' => array(
			array(
				'key'     => 'stock_status_position',
				'compare' => 'equals',
				'value'   => 'after_title',
			),
		),
		'priority' => 205,
	)
);

Options::add_field(
	array(
		'id'          => 'grid_stock_progress_bar',
		'name'        => esc_html__( 'Stock progress bar', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'products-archive-stock-progress-bar.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Display a number of sold and in stock products as a progress bar.', 'omniverse' ),
		'group'       => esc_html__( 'Elements', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_styles_section',
		'default'     => false,
		'priority'    => 210,
	)
);

Options::add_field(
	array(
		'id'          => 'shop_countdown',
		'name'        => esc_html__( 'Countdown timer', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'product-archive-countdown-timer.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Show timer for products that have scheduled date for the sale price', 'omniverse' ),
		'group'       => esc_html__( 'Elements', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_styles_section',
		'default'     => false,
		'priority'    => 220,
	)
);

Options::add_field(
	array(
		'id'       => 'categories_under_title',
		'name'     => esc_html__( 'Show product category', 'omniverse' ),
		'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-product-category.jpg" alt="">', 'omniverse' ), true ),
		'group'    => esc_html__( 'Elements', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'products_styles_section',
		'default'  => true,
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'priority' => 230,
	)
);

Options::add_field(
	array(
		'id'       => 'brands_under_title',
		'name'     => esc_html__( 'Show product brands', 'omniverse' ),
		'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-product-brands.jpg" alt="">', 'omniverse' ), true ),
		'group'    => esc_html__( 'Elements', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'products_styles_section',
		'default'  => false,
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'priority' => 240,
	)
);

Options::add_field(
	array(
		'id'       => 'sku_under_title',
		'name'     => esc_html__( 'Show SKU', 'omniverse' ),
		'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-sku.jpg" alt="">', 'omniverse' ), true ),
		'group'    => esc_html__( 'Elements', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'products_styles_section',
		'default'  => false,
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'priority' => 250,
	)
);

Options::add_field(
	array(
		'id'       => 'show_reviews_count',
		'name'     => esc_html__( 'Show reviews count', 'omniverse' ),
		'hint'     => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'show_reviews_count.mp4" autoplay loop muted></video>',
		'group'    => esc_html__( 'Elements', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'products_styles_section',
		'default'  => false,
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'priority' => 260,
	)
);

/**
 * Categories styles.
 */
Options::add_field(
	array(
		'id'          => 'categories_design',
		'name'        => esc_html__( 'Categories design', 'omniverse' ),
		'description' => esc_html__( 'Choose one of those designs for categories', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'categories_styles_section',
		'default'     => 'default',
		'options'     => array(
			'default'       => array(
				'name'  => esc_html__( 'Default', 'omniverse' ),
				'value' => 'default',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/default.jpg',
			),
			'alt'           => array(
				'name'  => esc_html__( 'Alternative', 'omniverse' ),
				'value' => 'alt',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/alt.jpg',
			),
			'center'        => array(
				'name'  => esc_html__( 'Center title', 'omniverse' ),
				'value' => 'center',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/center.jpg',
			),
			'replace-title' => array(
				'name'  => esc_html__( 'Replace title', 'omniverse' ),
				'value' => 'replace-title',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/replace-title.jpg',
			),
			'mask-subcat'   => array(
				'name'  => esc_html__( 'Mask with subcategories', 'omniverse' ),
				'value' => 'mask-subcat',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/subcat.jpg',
			),
			'zoom-out'      => array(
				'name'  => esc_html__( 'Zoom out', 'omniverse' ),
				'value' => 'zoom-out',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/categories/zoom-out.jpg',
			),
		),
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'       => 'categories_rounding',
		'name'     => esc_html__( 'Categories rounding', 'omniverse' ),
		'type'     => 'select',
		'section'  => 'categories_styles_section',
		'options'  => array(
			''       => array(
				'name'  => esc_html__( 'Inherit global rounding', 'omniverse' ),
				'value' => '',
			),
			'0'      => array(
				'name'  => esc_html__( '0', 'omniverse' ),
				'value' => '0',
			),
			'5'      => array(
				'name'  => esc_html__( '5', 'omniverse' ),
				'value' => '5',
			),
			'8'      => array(
				'name'  => esc_html__( '8', 'omniverse' ),
				'value' => '8',
			),
			'12'     => array(
				'name'  => esc_html__( '12', 'omniverse' ),
				'value' => '12',
			),
			'custom' => array(
				'name'  => esc_html__( 'Custom', 'omniverse' ),
				'value' => 'custom',
			),
		),
		'default'  => '',
		'priority' => 20,
	)
);

Options::add_field(
	array(
		'id'        => 'custom_categories_rounding_size',
		'name'      => esc_html__( 'Custom categories rounding', 'omniverse' ),
		'type'      => 'responsive_range',
		'section'   => 'categories_styles_section',
		'selectors' => array(
			':root' => array(
				'--wd-cat-brd-radius: {{VALUE}}{{UNIT}};',
			),
		),
		'devices'   => array(
			'desktop' => array(
				'value' => '',
				'unit'  => 'px',
			),
		),
		'range'     => array(
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
		'requires'  => array(
			array(
				'key'     => 'categories_rounding',
				'compare' => 'equals',
				'value'   => 'custom',
			),
		),
		'priority'  => 30,
	)
);

Options::add_field(
	array(
		'id'       => 'categories_color_scheme',
		'name'     => esc_html__( 'Categories color scheme', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'categories_styles_section',
		'default'  => 'default',
		'options'  => array(
			'default' => array(
				'name'  => esc_html__( 'Default', 'omniverse' ),
				'value' => 'default',
			),
			'dark'    => array(
				'name'  => esc_html__( 'Dark', 'omniverse' ),
				'value' => 'dark',
			),
			'light'   => array(
				'name'  => esc_html__( 'Light', 'omniverse' ),
				'value' => 'light',
			),
		),
		'priority' => 40,
		'requires' => array(
			array(
				'key'     => 'categories_design',
				'compare' => 'equals',
				'value'   => array( 'default', 'mask-subcat' ),
			),
		),
	)
);

Options::add_field(
	array(
		'id'       => 'categories_with_shadow',
		'name'     => esc_html__( 'Categories with shadow', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'categories_styles_section',
		'options'  => array(
			'enable'  => array(
				'name'  => esc_html__( 'Enable', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'categories-with-shadow-enable.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'enable',
			),
			'disable' => array(
				'name'  => esc_html__( 'Disable', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'categories-with-shadow-disable.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'disable',
			),
		),
		'default'  => 'enable',
		'priority' => 50,
		'requires' => array(
			array(
				'key'     => 'categories_design',
				'compare' => 'equals',
				'value'   => array( 'alt', 'default' ),
			),
		),
	)
);

Options::add_field(
	array(
		'id'       => 'hide_categories_product_count',
		'name'     => esc_html__( 'Hide product count on category', 'omniverse' ),
		'hint'     => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'hide-product-count-on-category.mp4" autoplay loop muted></video>',
		'type'     => 'switcher',
		'section'  => 'categories_styles_section',
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'default'  => false,
		'priority' => 60,
	)
);

/**
 * Sidebar.
 */
Options::add_field(
	array(
		'id'          => 'shop_layout',
		'name'        => esc_html__( 'Shop layout', 'omniverse' ),
		'description' => esc_html__( 'Select main content and sidebar alignment for shop pages.', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'shop_sidebar_section',
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
		'priority'    => 10,
		'default'     => 'sidebar-left',
	)
);

Options::add_field(
	array(
		'id'          => 'shop_sidebar_width',
		'name'        => esc_html__( 'Sidebar size', 'omniverse' ),
		'description' => esc_html__( 'You can set different sizes for your shop pages sidebar', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'shop_sidebar_section',
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
		'priority'    => 20,
		'default'     => 3,
		'class'       => 'dn-tooltip-bordered',
	)
);

Options::add_field(
	array(
		'id'          => 'shop_hide_sidebar_desktop',
		'name'        => esc_html__( 'Off canvas sidebar for desktop', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'off-canvas-sidebar-for-desktop.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'You can hide the sidebar from the page and show it nicely with a button click.', 'omniverse' ),
		'group'       => esc_html__( 'Off canvas sidebar', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_sidebar_section',
		'default'     => false,
		'priority'    => 30,
		't_tab'       => array(
			'id'    => 'off_canvas_sidebar_tabs',
			'tab'   => esc_html__( 'Desktop', 'omniverse' ),
			'icon'  => 'dn-i-desktop',
			'style' => 'devices',
		),
	)
);


Options::add_field(
	array(
		'id'          => 'shop_hide_sidebar_tablet',
		'name'        => esc_html__( 'Off canvas sidebar for tablet', 'omniverse' ),
		'description' => esc_html__( 'You can hide the sidebar on tablet devices and show it nicely with a button click.', 'omniverse' ),
		'group'       => esc_html__( 'Off canvas sidebar', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_sidebar_section',
		'default'     => '1',
		'priority'    => 40,
		'requires'    => array(
			array(
				'key'     => 'shop_layout',
				'compare' => 'not_equals',
				'value'   => 'full-width',
			),
		),
		't_tab'       => array(
			'id'   => 'off_canvas_sidebar_tabs',
			'tab'  => esc_html__( 'Tablet', 'omniverse' ),
			'icon' => 'dn-i-tablet',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'shop_hide_sidebar',
		'name'        => esc_html__( 'Off canvas sidebar for mobile', 'omniverse' ),
		'description' => esc_html__( 'You can hide the sidebar on mobile devices and show it nicely with a button click.', 'omniverse' ),
		'group'       => esc_html__( 'Off canvas sidebar', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_sidebar_section',
		'default'     => '1',
		'priority'    => 50,
		'requires'    => array(
			array(
				'key'     => 'shop_layout',
				'compare' => 'not_equals',
				'value'   => 'full-width',
			),
		),
		't_tab'       => array(
			'id'   => 'off_canvas_sidebar_tabs',
			'tab'  => esc_html__( 'Mobile', 'omniverse' ),
			'icon' => 'dn-i-phone',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'sticky_filter_button',
		'name'        => esc_html__( 'Sticky off canvas sidebar button', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'sticky-off-canvas-sidebar-button.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Display the filters button fixed on the screen for mobile and tablet devices.', 'omniverse' ),
		'group'       => esc_html__( 'Off canvas sidebar', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_sidebar_section',
		'default'     => false,
		'priority'    => 51,
	)
);

/**
 * Page title.
 */
Options::add_field(
	array(
		'id'          => 'shop_title',
		'name'        => esc_html__( 'Shop title', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'product-archive-shop-title.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Show title for shop page, product categories or tags.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_page_title_section',
		'default'     => '1',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'shop_categories',
		'name'        => esc_html__( 'Categories in page title', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'categories-in-page-title.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'This categories menu is generated automatically based on all categories in the shop. You are not able to manage this menu as other WordPress menus.', 'omniverse' ),
		'group'       => esc_html__( 'Categories', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_page_title_section',
		'default'     => '1',
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'          => 'shop_categories_ancestors',
		'name'        => esc_html__( 'Show current category ancestors', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-current-category-ancestors.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'If you visit category Man, for example, only man\'s subcategories will be shown in the page title like T-shirts, Coats, Shoes etc.', 'omniverse' ),
		'group'       => esc_html__( 'Categories', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_page_title_section',
		'default'     => false,
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 30,
		'requires'    => array(
			array(
				'key'     => 'shop_categories',
				'compare' => 'equals',
				'value'   => true,
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'show_categories_neighbors',
		'name'        => esc_html__( 'Show category neighbors if there is no children', 'omniverse' ),
		'description' => esc_html__( 'If the category you visit doesn\'t contain any subcategories, the page title menu will display this category\'s neighbors categories.', 'omniverse' ),
		'group'       => esc_html__( 'Categories', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_page_title_section',
		'default'     => false,
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 40,
		'requires'    => array(
			array(
				'key'     => 'shop_categories',
				'compare' => 'equals',
				'value'   => true,
			),
			array(
				'key'     => 'shop_categories_ancestors',
				'compare' => 'equals',
				'value'   => true,
			),
		),
	)
);

Options::add_field(
	array(
		'id'       => 'shop_products_count',
		'name'     => esc_html__( 'Show products count for each category', 'omniverse' ),
		'hint'     => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-products-count-for-each-category.mp4" autoplay loop muted></video>',
		'group'    => esc_html__( 'Categories', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'shop_page_title_section',
		'default'  => '1',
		'priority' => 50,
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'requires' => array(
			array(
				'key'     => 'shop_categories',
				'compare' => 'equals',
				'value'   => true,
			),
		),
	)
);

Options::add_field(
	array(
		'id'       => 'shop_page_title_hide_empty_categories',
		'name'     => esc_html__( 'Hide empty categories', 'omniverse' ),
		'hint'     => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'hide-empty-categories.mp4" autoplay loop muted></video>',
		'group'    => esc_html__( 'Categories', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'shop_page_title_section',
		'default'  => false,
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'requires' => array(
			array(
				'key'     => 'shop_categories',
				'compare' => 'equals',
				'value'   => true,
			),
		),
		'priority' => 60,
	)
);

Options::add_field(
	array(
		'id'           => 'shop_page_title_categories_exclude',
		'type'         => 'select',
		'section'      => 'shop_page_title_section',
		'name'         => esc_html__( 'Exclude categories', 'omniverse' ),
		'group'        => esc_html__( 'Categories', 'omniverse' ),
		'select2'      => true,
		'empty_option' => true,
		'multiple'     => true,
		'requires'     => array(
			array(
				'key'     => 'shop_categories',
				'compare' => 'equals',
				'value'   => true,
			),
			array(
				'key'     => 'shop_categories_ancestors',
				'compare' => 'not_equals',
				'value'   => true,
			),
		),
		'autocomplete' => array(
			'type'   => 'term',
			'value'  => 'product_cat',
			'search' => 'omniverse_get_taxonomies_by_query_autocomplete',
			'render' => 'omniverse_get_taxonomies_by_ids_autocomplete',
		),
		'priority'     => 70,
	)
);

/**
 * Products grid.
 */
Options::add_field(
	array(
		'id'          => 'shop_view',
		'name'        => __( 'Shop products view', 'omniverse' ),
		'description' => __( 'You can set different view mode for the shop page', 'omniverse' ),
		'group'       => esc_html__( 'Grid', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'products_grid_section',
		'options'     => array(
			'grid'      => array(
				'name'  => esc_html__( 'Grid', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'shop-products-view-grid.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'grid',
			),
			'list'      => array(
				'name'  => esc_html__( 'List', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'shop-products-view-list.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'list',
			),
			'grid_list' => array(
				'name'  => esc_html__( 'Grid / List', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'shop-products-view-grid-list.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'grid_list',
			),
			'list_grid' => array(
				'name'  => esc_html__( 'List / Grid', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'shop-products-view-list-grid.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'list_grid',
			),
		),
		'default'     => 'grid',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'products_columns',
		'name'        => esc_html__( 'Products columns on desktop', 'omniverse' ),
		'description' => esc_html__( 'How many products you want to show per row', 'omniverse' ),
		'group'       => esc_html__( 'Grid', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'products_grid_section',
		'options'     => array(
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
		'default'     => 3,
		'priority'    => 20,
		'requires'    => array(
			array(
				'key'     => 'shop_view',
				'compare' => 'not_equals',
				'value'   => 'list',
			),
		),
		't_tab'       => array(
			'id'       => 'products_columns_tabs',
			'tab'      => esc_html__( 'Desktop', 'omniverse' ),
			'icon'     => 'dn-i-desktop',
			'style'    => 'devices',
			'requires' => array(
				array(
					'key'     => 'shop_view',
					'compare' => 'not_equals',
					'value'   => 'list',
				),
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'products_columns_tablet',
		'name'        => esc_html__( 'Products columns on tablet', 'omniverse' ),
		'description' => esc_html__( 'How many products you want to show per row', 'omniverse' ),
		'group'       => esc_html__( 'Grid', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'products_grid_section',
		'options'     => array(
			'auto' => array(
				'name'  => esc_html__( 'Auto', 'omniverse' ),
				'value' => 'auto',
			),
			1      => array(
				'name'  => 1,
				'value' => 1,
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
		'default'     => 'auto',
		'priority'    => 21,
		'requires'    => array(
			array(
				'key'     => 'shop_view',
				'compare' => 'not_equals',
				'value'   => 'list',
			),
		),
		't_tab'       => array(
			'id'   => 'products_columns_tabs',
			'tab'  => esc_html__( 'Tablet', 'omniverse' ),
			'icon' => 'dn-i-tablet',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'products_columns_mobile',
		'name'        => esc_html__( 'Products columns on mobile', 'omniverse' ),
		'description' => esc_html__( 'How many products you want to show per row on mobile devices', 'omniverse' ),
		'group'       => esc_html__( 'Grid', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'products_grid_section',
		'options'     => array(
			1 => array(
				'name'  => 1,
				'value' => 1,
			),
			2 => array(
				'name'  => 2,
				'value' => 2,
			),
		),
		'default'     => 2,
		'priority'    => 30,
		'requires'    => array(
			array(
				'key'     => 'shop_view',
				'compare' => 'not_equals',
				'value'   => 'list',
			),
		),
		't_tab'       => array(
			'id'   => 'products_columns_tabs',
			'tab'  => esc_html__( 'Mobile', 'omniverse' ),
			'icon' => 'dn-i-phone',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'products_spacing',
		'name'        => esc_html__( 'Space between products on desktop', 'omniverse' ),
		'description' => esc_html__( 'You can set different spacing between blocks on shop page', 'omniverse' ),
		'group'       => esc_html__( 'Grid', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'products_grid_section',
		'options'     => array(
			0  => array(
				'name'  => 0,
				'value' => 0,
			),
			2  => array(
				'name'  => 2,
				'value' => 2,
			),
			6  => array(
				'name'  => 5,
				'value' => 6,
			),
			10 => array(
				'name'  => 10,
				'value' => 10,
			),
			20 => array(
				'name'  => 20,
				'value' => 20,
			),
			30 => array(
				'name'  => 30,
				'value' => 30,
			),
		),
		'default'     => 20,
		'priority'    => 40,
		'requires'    => array(
			array(
				'key'     => 'shop_view',
				'compare' => 'not_equals',
				'value'   => 'list',
			),
		),
		't_tab'       => array(
			'id'       => 'products_spacing_tabs',
			'tab'      => esc_html__( 'Desktop', 'omniverse' ),
			'icon'     => 'dn-i-desktop',
			'style'    => 'devices',
			'requires' => array(
				array(
					'key'     => 'shop_view',
					'compare' => 'not_equals',
					'value'   => 'list',
				),
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'products_spacing_tablet',
		'name'        => esc_html__( 'Space between products on tablet', 'omniverse' ),
		'description' => esc_html__( 'You can set different spacing between blocks on shop page', 'omniverse' ),
		'group'       => esc_html__( 'Grid', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'products_grid_section',
		'is_deselect' => true,
		'options'     => array(
			'0'  => array(
				'name'  => 0,
				'value' => '0',
			),
			'2'  => array(
				'name'  => 2,
				'value' => '2',
			),
			'6'  => array(
				'name'  => 5,
				'value' => '6',
			),
			'10' => array(
				'name'  => 10,
				'value' => '10',
			),
			'20' => array(
				'name'  => 20,
				'value' => '20',
			),
			'30' => array(
				'name'  => 30,
				'value' => '30',
			),
		),
		'default'     => '',
		'priority'    => 41,
		'requires'    => array(
			array(
				'key'     => 'shop_view',
				'compare' => 'not_equals',
				'value'   => 'list',
			),
		),
		't_tab'       => array(
			'id'   => 'products_spacing_tabs',
			'tab'  => esc_html__( 'Tablet', 'omniverse' ),
			'icon' => 'dn-i-tablet',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'products_spacing_mobile',
		'name'        => esc_html__( 'Space between products on mobile', 'omniverse' ),
		'description' => esc_html__( 'You can set different spacing between blocks on shop page', 'omniverse' ),
		'group'       => esc_html__( 'Grid', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'products_grid_section',
		'is_deselect' => true,
		'options'     => array(
			'0'  => array(
				'name'  => 0,
				'value' => '0',
			),
			'2'  => array(
				'name'  => 2,
				'value' => '2',
			),
			'6'  => array(
				'name'  => 5,
				'value' => '6',
			),
			'10' => array(
				'name'  => 10,
				'value' => '10',
			),
			'20' => array(
				'name'  => 20,
				'value' => '20',
			),
			'30' => array(
				'name'  => 30,
				'value' => '30',
			),
		),
		'default'     => '',
		'priority'    => 42,
		'requires'    => array(
			array(
				'key'     => 'shop_view',
				'compare' => 'not_equals',
				'value'   => 'list',
			),
		),
		't_tab'       => array(
			'id'   => 'products_spacing_tabs',
			'tab'  => esc_html__( 'Mobile', 'omniverse' ),
			'icon' => 'dn-i-phone',
		),
	)
);


Options::add_field(
	array(
		'id'          => 'per_row_columns_selector',
		'name'        => esc_html__( 'Number of columns selector', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'number-of-columns-selector.jpg" alt="">', 'omniverse' ), true ),
		'group'       => esc_html__( 'Grid', 'omniverse' ),
		'description' => esc_html__( 'Allow customers to change number of columns per row', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_grid_section',
		'default'     => '1',
		'priority'    => 50,
		'requires'    => array(
			array(
				'key'     => 'shop_view',
				'compare' => 'not_equals',
				'value'   => 'list',
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'products_columns_variations',
		'name'        => esc_html__( 'Available products columns variations', 'omniverse' ),
		'description' => esc_html__( 'What columns users may select to be displayed on the product page', 'omniverse' ),
		'group'       => esc_html__( 'Grid', 'omniverse' ),
		'type'        => 'select',
		'multiple'    => true,
		'select2'     => true,
		'section'     => 'products_grid_section',
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
		'default'     => array( 2, 3, 4 ),
		'priority'    => 60,
		'requires'    => array(
			array(
				'key'     => 'shop_view',
				'compare' => 'not_equals',
				'value'   => 'list',
			),
			array(
				'key'     => 'per_row_columns_selector',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'products_masonry',
		'name'        => esc_html__( 'Masonry grid', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'product-archive-masonry-grid.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Useful if your products have different height.', 'omniverse' ),
		'group'       => esc_html__( 'Grid', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_grid_section',
		'default'     => false,
		'priority'    => 62,
		'requires'    => array(
			array(
				'key'     => 'shop_view',
				'compare' => 'not_equals',
				'value'   => 'list',
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'products_different_sizes',
		'name'        => esc_html__( 'Products grid with different sizes', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'products-grid-with-different-sizes.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'In this situation, some of the products will be twice bigger in width than others. Recommended to use with 6 columns grid only.', 'omniverse' ),
		'group'       => esc_html__( 'Grid', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_grid_section',
		'default'     => false,
		'priority'    => 63,
		'requires'    => array(
			array(
				'key'     => 'shop_view',
				'compare' => 'not_equals',
				'value'   => 'list',
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'shop_per_page',
		'name'        => esc_html__( 'Products per page', 'omniverse' ),
		'description' => esc_html__( 'Number of products per page', 'omniverse' ),
		'group'       => esc_html__( 'Pages', 'omniverse' ),
		'type'        => 'text_input',
		'attributes'  => array(
			'type' => 'number',
		),
		'section'     => 'products_grid_section',
		'default'     => 12,
		'priority'    => 70,
	)
);

Options::add_field(
	array(
		'id'          => 'per_page_links',
		'name'        => esc_html__( 'Products per page links', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'products-per-page-links.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Allow customers to change number of products per page', 'omniverse' ),
		'group'       => esc_html__( 'Pages', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_grid_section',
		'default'     => '1',
		'priority'    => 80,
	)
);

Options::add_field(
	array(
		'id'          => 'per_page_options',
		'name'        => esc_html__( 'Products per page variations', 'omniverse' ),
		'description' => esc_html__( 'For ex.: 12,24,36,-1. Use -1 to show all products on the page', 'omniverse' ),
		'group'       => esc_html__( 'Pages', 'omniverse' ),
		'type'        => 'text_input',
		'section'     => 'products_grid_section',
		'default'     => '9,12,18,24',
		'priority'    => 90,
		'requires'    => array(
			array(
				'key'     => 'per_page_links',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'shop_pagination',
		'name'        => esc_html__( 'Products pagination', 'omniverse' ),
		'description' => esc_html__( 'Choose a type for the pagination on your shop page.', 'omniverse' ),
		'group'       => esc_html__( 'Pages', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'products_grid_section',
		'options'     => array(
			'pagination' => array(
				'name'  => esc_html__( 'Pagination', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'products-pagination-pagination.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'pagination',
			),
			'more-btn'   => array(
				'name'  => esc_html__( '"Load more" button', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'products-pagination-load-more-button.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'more-btn',
			),
			'infinit'    => array(
				'name'  => esc_html__( 'Infinite scrolling', 'omniverse' ),
				'hint'  => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'infinit-products.mp4" autoplay loop muted></video>',
				'value' => 'infinit',
			),
		),
		'default'     => 'pagination',
		'priority'    => 100,
	)
);

Options::add_field(
	array(
		'id'          => 'load_more_button_page_url',
		'name'        => esc_html__( 'Keep the page number in the URL', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'keep-the-page-number-in-the-url.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Enable this option if you want to change the page number in the URL when you click on the “Load more” button.', 'omniverse' ),
		'group'       => esc_html__( 'Pages', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'products_grid_section',
		'default'     => true,
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 110,
	)
);

/**
 * Widgets.
 */
Options::add_field(
	array(
		'id'          => 'categories_toggle',
		'name'        => esc_html__( 'Toggle function for categories widget', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'toggle-function-for-categories-widget.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Turn it on to enable accordion JS for the WooCommerce Product Categories widget. Useful if you have a lot of categories and subcategories.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'widgets_section',
		'default'     => '1',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'widgets_scroll',
		'name'        => esc_html__( 'Scroll for filters widgets', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'scroll-for-filters-widgets.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'You can limit your Layered Navigation widgets by height and enable nice scroll for them. Useful if you have a lot of product colors/sizes or other attributes for filters.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'widgets_section',
		'default'     => '1',
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'          => 'widget_heights',
		'name'        => esc_html__( 'Height for filters widgets', 'omniverse' ),
		'description' => esc_html__( 'Set widgets height in pixels.', 'omniverse' ),
		'type'        => 'range',
		'section'     => 'widgets_section',
		'default'     => 223,
		'min'         => 100,
		'step'        => 1,
		'max'         => 800,
		'priority'    => 30,
		'selectors'   => array(
			'.omniverse-woocommerce-layered-nav .wd-scroll-content' => array(
				'max-height: {{VALUE}}px;',
			),
		),
		'requires'    => array(
			array(
				'key'     => 'widgets_scroll',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
		'unit'        => 'px',
	)
);

Options::add_field(
	array(
		'id'          => 'shop_widgets_collapse',
		'name'        => esc_html__( 'Shop sidebar widgets collapse', 'omniverse' ),
		'description' => esc_html__( '“Filters only” variant works with OmniVerse Layered Navigation widgets.', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'widgets_section',
		'options'     => array(
			'disable'     => array(
				'name'  => esc_html__( 'Disable', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'shop-sidebar-widgets-disable.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'disable',
			),
			'all'         => array(
				'name'  => esc_html__( 'All widgets', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'shop-sidebar-widgets-collapse-all-widgets.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'all',
			),
			'layered-nav' => array(
				'name'  => esc_html__( 'Filters only', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'shop-sidebar-widgets-collapse-filters-only.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'layered-nav',
			),
		),
		'default'     => 'disable',
		'priority'    => 40,
	)
);

/**
 * Shop filers.
 */
Options::add_field(
	array(
		'id'          => 'shop_filters',
		'name'        => esc_html__( 'Shop filters', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'shop-filters.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Enable shop filters widget\'s area above the products.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_filters_section',
		'default'     => false,
		'priority'    => 10,
	)
);


Options::add_field(
	array(
		'id'          => 'shop_filters_type',
		'name'        => esc_html__( 'Shop filters content type', 'omniverse' ),
		'description' => esc_html__( 'You can use widgets or custom HTML block with our Product filters page builder element.', 'omniverse' ),
		'group'       => esc_html__( 'Content', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'shop_filters_section',
		'default'     => 'widgets',
		'options'     => array(
			'widgets' => array(
				'name'  => esc_html__( 'Widgets', 'omniverse' ),
				'value' => 'widgets',
			),
			'content' => array(
				'name'  => esc_html__( 'HTML Block', 'omniverse' ),
				'value' => 'content',
			),
		),
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'       => 'shop_filters_columns',
		'name'     => esc_html__( 'Shop filters columns on desktop', 'omniverse' ),
		'group'    => esc_html__( 'Content', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'shop_filters_section',
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
		'priority' => 31,
		'requires' => array(
			array(
				'key'     => 'shop_filters_type',
				'compare' => 'equals',
				'value'   => 'widgets',
			),
		),
		't_tab'    => array(
			'id'       => 'shop_filters_columns_tabs',
			'tab'      => esc_html__( 'Desktop', 'omniverse' ),
			'icon'     => 'dn-i-desktop',
			'style'    => 'devices',
			'requires' => array(
				array(
					'key'     => 'shop_filters_type',
					'compare' => 'equals',
					'value'   => 'widgets',
				),
			),
		),
	)
);

Options::add_field(
	array(
		'id'       => 'shop_filters_columns_tablet',
		'name'     => esc_html__( 'Shop filters columns on tablet', 'omniverse' ),
		'group'    => esc_html__( 'Content', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'shop_filters_section',
		'options'  => array(
			'auto' => array(
				'name'  => esc_html__( 'Auto', 'omniverse' ),
				'value' => 'auto',
			),
			1      => array(
				'name'  => 1,
				'value' => 1,
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
		'default'  => 'auto',
		'priority' => 32,
		'requires' => array(
			array(
				'key'     => 'shop_filters_type',
				'compare' => 'equals',
				'value'   => 'widgets',
			),
		),
		't_tab'    => array(
			'id'   => 'shop_filters_columns_tabs',
			'tab'  => esc_html__( 'Tablet', 'omniverse' ),
			'icon' => 'dn-i-tablet',
		),
	)
);

Options::add_field(
	array(
		'id'       => 'shop_filters_columns_mobile',
		'name'     => esc_html__( 'Shop filters columns on mobile', 'omniverse' ),
		'group'    => esc_html__( 'Content', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'shop_filters_section',
		'options'  => array(
			'auto' => array(
				'name'  => esc_html__( 'Auto', 'omniverse' ),
				'value' => 'auto',
			),
			1      => array(
				'name'  => 1,
				'value' => 1,
			),
			2      => array(
				'name'  => 2,
				'value' => 2,
			),
		),
		'default'  => 'auto',
		'priority' => 33,
		'requires' => array(
			array(
				'key'     => 'shop_filters_type',
				'compare' => 'equals',
				'value'   => 'widgets',
			),
		),
		't_tab'    => array(
			'id'   => 'shop_filters_columns_tabs',
			'tab'  => esc_html__( 'Mobile', 'omniverse' ),
			'icon' => 'dn-i-phone',
		),
	)
);

Options::add_field(
	array(
		'id'       => 'shop_filters_spacing',
		'name'     => esc_html__( 'Space between widgets on desktop', 'omniverse' ),
		'group'    => esc_html__( 'Content', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'shop_filters_section',
		'options'  => array(
			0  => array(
				'name'  => 0,
				'value' => 0,
			),
			2  => array(
				'name'  => 2,
				'value' => 2,
			),
			6  => array(
				'name'  => 5,
				'value' => 6,
			),
			10 => array(
				'name'  => 10,
				'value' => 10,
			),
			20 => array(
				'name'  => 20,
				'value' => 20,
			),
			30 => array(
				'name'  => 30,
				'value' => 30,
			),
		),
		'default'  => 30,
		'priority' => 40,
		'requires' => array(
			array(
				'key'     => 'shop_filters_type',
				'compare' => 'equals',
				'value'   => 'widgets',
			),
		),
		't_tab'    => array(
			'id'       => 'shop_filters_spacing_tabs',
			'tab'      => esc_html__( 'Desktop', 'omniverse' ),
			'icon'     => 'dn-i-desktop',
			'style'    => 'devices',
			'requires' => array(
				array(
					'key'     => 'shop_filters_type',
					'compare' => 'equals',
					'value'   => 'widgets',
				),
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'shop_filters_spacing_tablet',
		'name'        => esc_html__( 'Space between widgets on tablet', 'omniverse' ),
		'group'       => esc_html__( 'Content', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'shop_filters_section',
		'is_deselect' => true,
		'options'     => array(
			'0'  => array(
				'name'  => 0,
				'value' => '0',
			),
			'2'  => array(
				'name'  => 2,
				'value' => '2',
			),
			'6'  => array(
				'name'  => 5,
				'value' => '6',
			),
			'10' => array(
				'name'  => 10,
				'value' => '10',
			),
			'20' => array(
				'name'  => 20,
				'value' => '20',
			),
			'30' => array(
				'name'  => 30,
				'value' => '30',
			),
		),
		'default'     => '',
		'priority'    => 41,
		'requires'    => array(
			array(
				'key'     => 'shop_filters_type',
				'compare' => 'equals',
				'value'   => 'widgets',
			),
		),
		't_tab'       => array(
			'id'   => 'shop_filters_spacing_tabs',
			'tab'  => esc_html__( 'Tablet', 'omniverse' ),
			'icon' => 'dn-i-tablet',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'shop_filters_spacing_mobile',
		'name'        => esc_html__( 'Space between widgets on mobile', 'omniverse' ),
		'group'       => esc_html__( 'Content', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'shop_filters_section',
		'is_deselect' => true,
		'options'     => array(
			'0'  => array(
				'name'  => 0,
				'value' => '0',
			),
			'2'  => array(
				'name'  => 2,
				'value' => '2',
			),
			'6'  => array(
				'name'  => 5,
				'value' => '6',
			),
			'10' => array(
				'name'  => 10,
				'value' => '10',
			),
			'20' => array(
				'name'  => 20,
				'value' => '20',
			),
			'30' => array(
				'name'  => 30,
				'value' => '30',
			),
		),
		'default'     => '',
		'priority'    => 42,
		'requires'    => array(
			array(
				'key'     => 'shop_filters_type',
				'compare' => 'equals',
				'value'   => 'widgets',
			),
		),
		't_tab'       => array(
			'id'   => 'shop_filters_spacing_tabs',
			'tab'  => esc_html__( 'Mobile', 'omniverse' ),
			'icon' => 'dn-i-phone',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'hide_sort_by',
		'name'        => esc_html__( 'Hide "Sort by" widget', 'omniverse' ),
		'group'       => esc_html__( 'Content', 'omniverse' ),
		'description' => esc_html__( 'Enable this option if you want to remove the predefined "Sort by" widget from the shop page filters aria.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_filters_section',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'default'     => false,
		'priority'    => 43,
	)
);

Options::add_field(
	array(
		'id'          => 'hide_price_filter',
		'name'        => esc_html__( 'Hide "Price filter" widget', 'omniverse' ),
		'group'       => esc_html__( 'Content', 'omniverse' ),
		'description' => esc_html__( 'Enable this option if you want to remove the predefined "Price filter" widget from the shop page filters aria.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_filters_section',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'default'     => false,
		'priority'    => 44,
	)
);

Options::add_field(
	array(
		'id'           => 'shop_filters_content',
		'name'         => esc_html__( 'Shop filters HTML Block', 'omniverse' ),
		'description'  => esc_html__( 'You can create an HTML Block in Dashboard -> HTML Blocks and add Product filters page builder element there.', 'omniverse' ),
		'group'        => esc_html__( 'Content', 'omniverse' ),
		'type'         => 'select',
		'section'      => 'shop_filters_section',
		'select2'      => true,
		'empty_option' => true,
		'autocomplete' => array(
			'type'   => 'post',
			'value'  => 'cms_block',
			'search' => 'omniverse_get_post_by_query_autocomplete',
			'render' => 'omniverse_get_post_by_ids_autocomplete',
		),
		'priority'     => 30,
		'requires'     => array(
			array(
				'key'     => 'shop_filters_type',
				'compare' => 'equals',
				'value'   => 'content',
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'shop_filters_always_open',
		'name'        => esc_html__( 'Shop filters area always opened', 'omniverse' ),
		'description' => esc_html__( 'If you enable this option the shop filters will be always opened on the shop page.', 'omniverse' ),
		'group'       => esc_html__( 'State', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_filters_section',
		'default'     => false,
		'priority'    => 50,
	)
);

Options::add_field(
	array(
		'id'          => 'shop_filters_close',
		'name'        => esc_html__( 'Stop close filters after click', 'omniverse' ),
		'description' => esc_html__( 'This option will prevent filters area from closing when you click on certain filter links.', 'omniverse' ),
		'group'       => esc_html__( 'State', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_filters_section',
		'default'     => false,
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 60,
		'requires'    => array(
			array(
				'key'     => 'shop_filters_always_open',
				'compare' => 'equals',
				'value'   => '0',
			),
		),
	)
);
