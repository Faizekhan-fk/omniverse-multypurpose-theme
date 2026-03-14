<?php
if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

use DN\Admin\Modules\Options;

/**
 * General.
 */
Options::add_section(
	array(
		'id'       => 'general_parent_section',
		'name'     => esc_html__( 'General', 'omniverse' ),
		'priority' => 10,
		'icon'     => 'dn-i-home',
	)
);

Options::add_section(
	array(
		'id'       => 'general_layout_section',
		'parent'   => 'general_parent_section',
		'name'     => esc_html__( 'Layout', 'omniverse' ),
		'priority' => 10,
		'icon'     => 'dn-i-home',
	)
);

Options::add_section(
	array(
		'id'       => 'header_banner_section',
		'parent'   => 'general_parent_section',
		'name'     => esc_html__( 'Header banner', 'omniverse' ),
		'priority' => 20,
		'icon'     => 'dn-i-home',
	)
);

Options::add_section(
	array(
		'id'       => 'promo_popup_section',
		'parent'   => 'general_parent_section',
		'name'     => esc_html__( 'Promo popup', 'omniverse' ),
		'priority' => 30,
		'icon'     => 'dn-i-home',
	)
);

Options::add_section(
	array(
		'id'       => 'age_verify_section',
		'parent'   => 'general_parent_section',
		'name'     => esc_html__( 'Age verify popup', 'omniverse' ),
		'priority' => 40,
		'icon'     => 'dn-i-home',
	)
);

Options::add_section(
	array(
		'id'       => 'cookie_section',
		'parent'   => 'general_parent_section',
		'name'     => esc_html__( 'Cookie law info', 'omniverse' ),
		'priority' => 50,
		'icon'     => 'dn-i-home',
	)
);

Options::add_section(
	array(
		'id'       => 'general_navbar_section',
		'parent'   => 'general_parent_section',
		'name'     => esc_html__( 'Mobile bottom navbar', 'omniverse' ),
		'priority' => 60,
		'icon'     => 'dn-i-home',
	)
);

Options::add_section(
	array(
		'id'       => 'general_search',
		'parent'   => 'general_parent_section',
		'name'     => esc_html__( 'Search', 'omniverse' ),
		'priority' => 70,
		'icon'     => 'dn-i-home',
	)
);

/**
 * Page title.
 */
Options::add_section(
	array(
		'id'       => 'page_title_section',
		'name'     => esc_html__( 'Page title', 'omniverse' ),
		'priority' => 30,
		'icon'     => 'dn-i-page-title',
	)
);

/**
 * Footer.
 */
Options::add_section(
	array(
		'id'       => 'general_footer_section',
		'name'     => esc_html__( 'Footer', 'omniverse' ),
		'priority' => 40,
		'icon'     => 'dn-i-footer',
	)
);

Options::add_section(
	array(
		'id'       => 'footer_section',
		'parent'   => 'general_footer_section',
		'name'     => esc_html__( 'Footer', 'omniverse' ),
		'priority' => 10,
		'icon'     => 'dn-i-footer',
	)
);

Options::add_section(
	array(
		'id'       => 'copyrights_section',
		'parent'   => 'general_footer_section',
		'name'     => esc_html__( 'Copyrights', 'omniverse' ),
		'priority' => 20,
		'icon'     => 'dn-i-footer',
	)
);

Options::add_section(
	array(
		'id'       => 'prefooter_section',
		'parent'   => 'general_footer_section',
		'name'     => esc_html__( 'Prefooter', 'omniverse' ),
		'priority' => 30,
		'icon'     => 'dn-i-footer',
	)
);

/**
 * Typography.
 */
Options::add_section(
	array(
		'id'       => 'general_typography_section',
		'name'     => esc_html__( 'Typography', 'omniverse' ),
		'priority' => 50,
		'icon'     => 'dn-i-typography',
	)
);

Options::add_section(
	array(
		'id'       => 'typography_section',
		'parent'   => 'general_typography_section',
		'name'     => esc_html__( 'Basic', 'omniverse' ),
		'priority' => 10,
		'icon'     => 'dn-i-typography',
	)
);

Options::add_section(
	array(
		'id'       => 'advanced_typography_section',
		'parent'   => 'general_typography_section',
		'name'     => esc_html__( 'Advanced', 'omniverse' ),
		'priority' => 20,
		'icon'     => 'dn-i-typography',
	)
);

Options::add_section(
	array(
		'id'       => 'custom_fonts_section',
		'parent'   => 'general_typography_section',
		'name'     => esc_html__( 'Custom fonts', 'omniverse' ),
		'priority' => 30,
		'icon'     => 'dn-i-typography',
	)
);

Options::add_section(
	array(
		'id'       => 'icons_fonts_section',
		'parent'   => 'general_typography_section',
		'name'     => esc_html__( 'Icon fonts', 'omniverse' ),
		'priority' => 40,
		'icon'     => 'dn-i-typography',
	)
);

Options::add_section(
	array(
		'id'       => 'typekit_section',
		'parent'   => 'general_typography_section',
		'name'     => esc_html__( 'Adobe fonts', 'omniverse' ),
		'priority' => 50,
		'icon'     => 'dn-i-typography',
	)
);



/**
 * Styles and colors.
 */
Options::add_section(
	array(
		'id'       => 'general_styles_section',
		'name'     => esc_html__( 'Styles and colors', 'omniverse' ),
		'priority' => 60,
		'icon'     => 'dn-i-brush',
	)
);

Options::add_section(
	array(
		'id'       => 'styles_section',
		'parent'   => 'general_styles_section',
		'name'     => esc_html__( 'Styles', 'omniverse' ),
		'priority' => 10,
		'icon'     => 'dn-i-brush',
	)
);

Options::add_section(
	array(
		'id'       => 'colors_section',
		'parent'   => 'general_styles_section',
		'name'     => esc_html__( 'Colors', 'omniverse' ),
		'priority' => 20,
		'icon'     => 'dn-i-brush',
	)
);

Options::add_section(
	array(
		'id'       => 'pages_bg_section',
		'parent'   => 'general_styles_section',
		'name'     => esc_html__( 'Pages background', 'omniverse' ),
		'priority' => 30,
		'icon'     => 'dn-i-brush',
	)
);

Options::add_section(
	array(
		'id'       => 'buttons_section',
		'parent'   => 'general_styles_section',
		'name'     => esc_html__( 'Buttons', 'omniverse' ),
		'priority' => 40,
		'icon'     => 'dn-i-brush',
	)
);

Options::add_section(
	array(
		'id'       => 'forms_section',
		'parent'   => 'general_styles_section',
		'name'     => esc_html__( 'Forms', 'omniverse' ),
		'priority' => 50,
		'icon'     => 'dn-i-brush',
	)
);

Options::add_section(
	array(
		'id'       => 'notices_section',
		'parent'   => 'general_styles_section',
		'name'     => esc_html__( 'Notices', 'omniverse' ),
		'priority' => 60,
		'icon'     => 'dn-i-brush',
	)
);

Options::add_section(
	array(
		'id'       => 'general_carousel',
		'parent'   => 'general_styles_section',
		'name'     => esc_html__( 'Carousel', 'omniverse' ),
		'priority' => 70,
		'icon'     => 'dn-i-brush',
	)
);

/**
 * Blog.
 */
Options::add_section(
	array(
		'id'       => 'general_blog_section',
		'name'     => esc_html__( 'Blog', 'omniverse' ),
		'priority' => 70,
		'icon'     => 'dn-i-book-edit',
	)
);

Options::add_section(
	array(
		'id'       => 'blog_section',
		'name'     => esc_html__( 'Blog', 'omniverse' ),
		'parent'   => 'general_blog_section',
		'priority' => 10,
		'icon'     => 'dn-i-book-edit',
	)
);

Options::add_section(
	array(
		'id'       => 'blog_archive_section',
		'name'     => esc_html__( 'Blog archive', 'omniverse' ),
		'parent'   => 'general_blog_section',
		'priority' => 20,
		'icon'     => 'dn-i-book-edit',
	)
);

Options::add_section(
	array(
		'id'       => 'blog_singe_post_section',
		'name'     => esc_html__( 'Single post', 'omniverse' ),
		'parent'   => 'general_blog_section',
		'priority' => 30,
		'icon'     => 'dn-i-book-edit',
	)
);

/**
 * Portfolio.
 */
Options::add_section(
	array(
		'id'       => 'general_portfolio_section',
		'name'     => esc_html__( 'Portfolio', 'omniverse' ),
		'priority' => 80,
		'icon'     => 'dn-i-portfolio',
	)
);

Options::add_section(
	array(
		'id'       => 'portfolio_section',
		'name'     => esc_html__( 'Portfolio', 'omniverse' ),
		'parent'   => 'general_portfolio_section',
		'priority' => 10,
		'icon'     => 'dn-i-portfolio',
	)
);

Options::add_section(
	array(
		'id'       => 'portfolio_archive_section',
		'name'     => esc_html__( 'Portfolio archive', 'omniverse' ),
		'parent'   => 'general_portfolio_section',
		'priority' => 20,
		'icon'     => 'dn-i-portfolio',
	)
);

Options::add_section(
	array(
		'id'       => 'portfolio_singe_project_section',
		'name'     => esc_html__( 'Single project', 'omniverse' ),
		'parent'   => 'general_portfolio_section',
		'priority' => 30,
		'icon'     => 'dn-i-portfolio',
	)
);

/**
 * Shop.
 */
Options::add_section(
	array(
		'id'       => 'general_shop_section',
		'name'     => esc_html__( 'Shop', 'omniverse' ),
		'priority' => 90,
		'icon'     => 'dn-i-cart',
	)
);

Options::add_section(
	array(
		'id'       => 'shop_section',
		'parent'   => 'general_shop_section',
		'name'     => esc_html__( 'Shop', 'omniverse' ),
		'priority' => 10,
		'icon'     => 'dn-i-cart',
	)
);

Options::add_section(
	array(
		'id'       => 'variable_products_section',
		'parent'   => 'general_shop_section',
		'name'     => esc_html__( 'Variable products', 'omniverse' ),
		'priority' => 20,
		'icon'     => 'dn-i-cart',
	)
);

Options::add_section(
	array(
		'id'       => 'product_labels_section',
		'parent'   => 'general_shop_section',
		'name'     => esc_html__( 'Product labels', 'omniverse' ),
		'priority' => 30,
		'icon'     => 'dn-i-cart',
	)
);

Options::add_section(
	array(
		'id'       => 'brands_section',
		'parent'   => 'general_shop_section',
		'name'     => esc_html__( 'Brands', 'omniverse' ),
		'priority' => 40,
		'icon'     => 'dn-i-cart',
	)
);

Options::add_section(
	array(
		'id'       => 'quick_view_section',
		'parent'   => 'general_shop_section',
		'name'     => esc_html__( 'Quick view', 'omniverse' ),
		'priority' => 50,
		'icon'     => 'dn-i-cart',
	)
);

Options::add_section(
	array(
		'id'       => 'compare_section',
		'parent'   => 'general_shop_section',
		'name'     => esc_html__( 'Compare', 'omniverse' ),
		'priority' => 60,
		'icon'     => 'dn-i-cart',
	)
);

Options::add_section(
	array(
		'id'       => 'wishlist_section',
		'name'     => esc_html__( 'Wishlist', 'omniverse' ),
		'parent'   => 'general_shop_section',
		'priority' => 70,
		'icon'     => 'dn-i-cart',
	)
);

Options::add_section(
	array(
		'id'       => 'cart_section',
		'parent'   => 'general_shop_section',
		'name'     => esc_html__( 'Cart', 'omniverse' ),
		'priority' => 75,
	)
);

Options::add_section(
	array(
		'id'       => 'checkout_section',
		'parent'   => 'general_shop_section',
		'name'     => esc_html__( 'Checkout', 'omniverse' ),
		'priority' => 80,
	)
);

Options::add_section(
	array(
		'id'       => 'thank_you_page_section',
		'parent'   => 'general_shop_section',
		'name'     => esc_html__( 'Thank you page', 'omniverse' ),
		'priority' => 85,
		'icon'     => 'dn-i-cart',
	)
);

/**
 * Product archive.
 */
Options::add_section(
	array(
		'id'       => 'general_product_archive_section',
		'name'     => esc_html__( 'Product archive', 'omniverse' ),
		'priority' => 100,
		'icon'     => 'dn-i-archive',
	)
);

Options::add_section(
	array(
		'id'       => 'product_archive_section',
		'parent'   => 'general_product_archive_section',
		'name'     => esc_html__( 'Product archive', 'omniverse' ),
		'priority' => 10,
		'icon'     => 'dn-i-archive',
	)
);

Options::add_section(
	array(
		'id'       => 'products_grid_section',
		'parent'   => 'general_product_archive_section',
		'name'     => esc_html__( 'Products grid', 'omniverse' ),
		'priority' => 20,
		'icon'     => 'dn-i-archive',
	)
);

Options::add_section(
	array(
		'id'       => 'products_styles_section',
		'parent'   => 'general_product_archive_section',
		'name'     => esc_html__( 'Products styles', 'omniverse' ),
		'priority' => 30,
		'icon'     => 'dn-i-archive',
	)
);

Options::add_section(
	array(
		'id'       => 'categories_styles_section',
		'parent'   => 'general_product_archive_section',
		'name'     => esc_html__( 'Categories styles', 'omniverse' ),
		'priority' => 40,
		'icon'     => 'dn-i-archive',
	)
);

Options::add_section(
	array(
		'id'       => 'shop_filters_section',
		'parent'   => 'general_product_archive_section',
		'name'     => esc_html__( 'Shop filters', 'omniverse' ),
		'priority' => 50,
		'icon'     => 'dn-i-archive',
	)
);

Options::add_section(
	array(
		'id'       => 'widgets_section',
		'parent'   => 'general_product_archive_section',
		'name'     => esc_html__( 'Widgets', 'omniverse' ),
		'priority' => 60,
		'icon'     => 'dn-i-archive',
	)
);

Options::add_section(
	array(
		'id'       => 'shop_page_title_section',
		'parent'   => 'general_product_archive_section',
		'name'     => esc_html__( 'Page title', 'omniverse' ),
		'priority' => 70,
		'icon'     => 'dn-i-archive',
	)
);

Options::add_section(
	array(
		'id'       => 'shop_sidebar_section',
		'parent'   => 'general_product_archive_section',
		'name'     => esc_html__( 'Sidebar', 'omniverse' ),
		'priority' => 80,
		'icon'     => 'dn-i-archive',
	)
);

/**
 * Single product.
 */
Options::add_section(
	array(
		'id'       => 'general_single_product_section',
		'name'     => esc_html__( 'Single product', 'omniverse' ),
		'priority' => 110,
		'icon'     => 'dn-i-bag',
	)
);

Options::add_section(
	array(
		'id'       => 'single_product_section',
		'parent'   => 'general_single_product_section',
		'name'     => esc_html__( 'Single product', 'omniverse' ),
		'priority' => 10,
		'icon'     => 'dn-i-bag',
	)
);

Options::add_section(
	array(
		'id'       => 'product_images',
		'parent'   => 'general_single_product_section',
		'name'     => esc_html__( 'Gallery', 'omniverse' ),
		'priority' => 20,
		'icon'     => 'dn-i-bag',
	)
);

Options::add_section(
	array(
		'id'       => 'single_product_add_to_cart_section',
		'parent'   => 'general_single_product_section',
		'name'     => esc_html__( 'Add to cart', 'omniverse' ),
		'priority' => 30,
		'icon'     => 'dn-i-bag',
	)
);

Options::add_section(
	array(
		'id'       => 'product_elements',
		'parent'   => 'general_single_product_section',
		'name'     => esc_html__( 'Elements', 'omniverse' ),
		'priority' => 40,
		'icon'     => 'dn-i-bag',
	)
);

Options::add_section(
	array(
		'id'       => 'product_tabs',
		'parent'   => 'general_single_product_section',
		'name'     => esc_html__( 'Tabs', 'omniverse' ),
		'priority' => 60,
		'icon'     => 'dn-i-bag',
	)
);

Options::add_section(
	array(
		'id'       => 'single_product_related_section',
		'parent'   => 'general_single_product_section',
		'name'     => esc_html__( 'Related & Upsells', 'omniverse' ),
		'priority' => 70,
		'icon'     => 'dn-i-bag',
	)
);

/**
 * Login/register section.
 */
Options::add_section(
	array(
		'id'       => 'my_account',
		'name'     => esc_html__( 'My account', 'omniverse' ),
		'priority' => 115,
		'icon'     => 'dn-i-login',
	)
);

Options::add_section(
	array(
		'id'       => 'login_section',
		'parent'   => 'my_account',
		'name'     => esc_html__( 'Login / Register', 'omniverse' ),
		'priority' => 10,
		'icon'     => 'dn-i-login',
	)
);

Options::add_section(
	array(
		'id'       => 'dashboard_section',
		'parent'   => 'my_account',
		'name'     => esc_html__( 'Dashboard', 'omniverse' ),
		'priority' => 20,
		'icon'     => 'dn-i-login',
	)
);

/**
 * Share buttons configuration.
 */
Options::add_section(
	array(
		'id'       => 'general_social_profiles',
		'name'     => esc_html__( 'Social profiles', 'omniverse' ),
		'priority' => 130,
		'icon'     => 'dn-i-social',
	)
);

Options::add_section(
	array(
		'id'       => 'social_profiles',
		'parent'   => 'general_social_profiles',
		'name'     => esc_html__( 'Social profiles', 'omniverse' ),
		'priority' => 10,
		'icon'     => 'dn-i-social',
	)
);

Options::add_section(
	array(
		'id'       => 'social_links',
		'parent'   => 'general_social_profiles',
		'name'     => esc_html__( 'Links to social profiles', 'omniverse' ),
		'priority' => 20,
		'icon'     => 'dn-i-social',
	)
);

Options::add_section(
	array(
		'id'       => 'social_share',
		'parent'   => 'general_social_profiles',
		'name'     => esc_html__( 'Share buttons', 'omniverse' ),
		'priority' => 30,
		'icon'     => 'dn-i-social',
	)
);

/**
 * API integrations.
 */
Options::add_section(
	array(
		'id'       => 'api_integrations_section',
		'name'     => esc_html__( 'API integrations', 'omniverse' ),
		'priority' => 140,
		'icon'     => 'dn-i-cog',
	)
);

Options::add_section(
	array(
		'id'       => 'instagram_api_section',
		'name'     => esc_html__( 'Instagram API', 'omniverse' ),
		'parent'   => 'api_integrations_section',
		'priority' => 10,
		'icon'     => 'dn-i-cog',
	)
);

Options::add_section(
	array(
		'id'       => 'google_api_section',
		'name'     => esc_html__( 'Google map API', 'omniverse' ),
		'parent'   => 'api_integrations_section',
		'priority' => 20,
		'icon'     => 'dn-i-cog',
	)
);

Options::add_section(
	array(
		'id'       => 'social_login_api_section',
		'name'     => esc_html__( 'Social authentication', 'omniverse' ),
		'parent'   => 'api_integrations_section',
		'priority' => 30,
		'icon'     => 'dn-i-cog',
	)
);

/**
 * Performance.
 */
Options::add_section(
	array(
		'id'       => 'general_performance',
		'name'     => esc_html__( 'Performance', 'omniverse' ),
		'priority' => 150,
		'icon'     => 'dn-i-performance',
	)
);

Options::add_section(
	array(
		'id'       => 'performance_css',
		'name'     => esc_html__( 'CSS', 'omniverse' ),
		'parent'   => 'general_performance',
		'priority' => 10,
		'icon'     => 'dn-i-performance',
	)
);

Options::add_section(
	array(
		'id'       => 'performance_js',
		'name'     => esc_html__( 'JS', 'omniverse' ),
		'parent'   => 'general_performance',
		'priority' => 20,
		'icon'     => 'dn-i-performance',
	)
);

Options::add_section(
	array(
		'id'       => 'fonts_section',
		'name'     => esc_html__( 'Fonts & Icons', 'omniverse' ),
		'parent'   => 'general_performance',
		'priority' => 30,
		'icon'     => 'dn-i-performance',
	)
);

Options::add_section(
	array(
		'id'       => 'performance_lazy_loading',
		'name'     => esc_html__( 'Lazy loading', 'omniverse' ),
		'parent'   => 'general_performance',
		'priority' => 40,
		'icon'     => 'dn-i-performance',
	)
);

Options::add_section(
	array(
		'id'       => 'plugins_section',
		'name'     => esc_html__( 'Plugins', 'omniverse' ),
		'parent'   => 'general_performance',
		'priority' => 50,
		'icon'     => 'dn-i-performance',
	)
);

Options::add_section(
	array(
		'id'       => 'preloader_section',
		'name'     => esc_html__( 'Preloader', 'omniverse' ),
		'parent'   => 'general_performance',
		'priority' => 60,
		'icon'     => 'dn-i-performance',
	)
);

Options::add_section(
	array(
		'id'       => 'performance_other',
		'name'     => esc_html__( 'Other', 'omniverse' ),
		'parent'   => 'general_performance',
		'priority' => 70,
		'icon'     => 'dn-i-performance',
	)
);

/**
 * Maintenance.
 */
Options::add_section(
	array(
		'id'       => 'maintenance',
		'name'     => esc_html__( 'Maintenance', 'omniverse' ),
		'priority' => 160,
		'icon'     => 'dn-i-tools',
	)
);

/**
 * White label.
 */
Options::add_section(
	array(
		'id'       => 'white_label_section',
		'name'     => esc_html__( 'White label', 'omniverse' ),
		'priority' => 170,
		'icon'     => 'dn-i-tag',
	)
);

/**
 * Custom CSS section.
 */
Options::add_section(
	array(
		'id'       => 'custom_css',
		'name'     => esc_html__( 'Custom CSS', 'omniverse' ),
		'priority' => 180,
		'icon'     => 'dn-i-file-code-css',
	)
);

/**
 * Custom JS section.
 */
Options::add_section(
	array(
		'id'       => 'custom_js',
		'name'     => esc_html__( 'Custom JS', 'omniverse' ),
		'priority' => 190,
		'icon'     => 'dn-i-file-code-js',
	)
);

/**
 * Other.
 */
Options::add_section(
	array(
		'id'       => 'other_section',
		'name'     => esc_html__( 'Other', 'omniverse' ),
		'priority' => 200,
		'icon'     => 'dn-i-setting-slider-in-square',
	)
);

/**
 * Import / Export / Reset.
 */
Options::add_section(
	array(
		'id'       => 'import_export',
		'name'     => esc_html__( 'Import / Export / Reset', 'omniverse' ),
		'priority' => 220,
		'icon'     => 'dn-i-round-right',
	)
);
