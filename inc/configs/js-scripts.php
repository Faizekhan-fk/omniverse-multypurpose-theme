<?php
/**
 * JS scripts.
 *
 * @version 1.0
 * @package dn
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

return array(
	// Admin.
	'admin-bar-slider-menu'            => array(
		array(
			'title'     => esc_html__( 'Admin bar slider menu', 'omniverse' ),
			'name'      => 'admin-bar-slider-menu',
			'file'      => '/js/scripts/admin/adminBarSliderMenu',
			'in_footer' => true,
		),
	),
	// Global.
	'omniverse-theme'                   => array(
		array(
			'title'     => esc_html__( 'Helpers', 'omniverse' ),
			'name'      => 'omniverse-theme',
			'file'      => '/js/scripts/global/helpers',
			'in_footer' => true,
		),
	),
	'scrollbar'                        => array(
		array(
			'title'     => esc_html__( 'Scroll Bar', 'omniverse' ),
			'name'      => 'scrollbar',
			'file'      => '/js/scripts/global/scrollBar',
			'in_footer' => false,
		),
	),
	'animations'                       => array(
		array(
			'title'     => esc_html__( 'Animations', 'omniverse' ),
			'name'      => 'animations',
			'file'      => '/js/scripts/global/animations',
			'in_footer' => true,
		),
	),
	'age-verify'                       => array(
		array(
			'title'     => esc_html__( 'Age verify', 'omniverse' ),
			'name'      => 'age-verify',
			'file'      => '/js/scripts/global/ageVerify',
			'in_footer' => true,
		),
	),
	'ajax-search'                      => array(
		array(
			'title'     => esc_html__( 'AJAX search', 'omniverse' ),
			'name'      => 'ajax-search',
			'file'      => '/js/scripts/global/ajaxSearch',
			'in_footer' => true,
		),
	),
	'animations-offset'                => array(
		array(
			'title'     => esc_html__( 'Element animations', 'omniverse' ),
			'name'      => 'animations-offset',
			'file'      => '/js/scripts/global/animationsOffset',
			'in_footer' => true,
		),
	),
	'back-history'                     => array(
		array(
			'title'     => esc_html__( 'Back history button', 'omniverse' ),
			'name'      => 'back-history',
			'file'      => '/js/scripts/global/backHistory',
			'in_footer' => true,
		),
	),
	'btns-tooltips'                    => array(
		array(
			'title'     => esc_html__( 'Tooltips', 'omniverse' ),
			'name'      => 'btns-tooltips',
			'file'      => '/js/scripts/global/btnsToolTips',
			'in_footer' => true,
		),
	),
	'cookies-popup'                    => array(
		array(
			'title'     => esc_html__( 'Cookies popup', 'omniverse' ),
			'name'      => 'cookies-popup',
			'file'      => '/js/scripts/global/cookiesPopup',
			'in_footer' => true,
		),
	),
	'widget-collapse'                  => array(
		array(
			'title'     => esc_html__( 'Widgets collapse script', 'omniverse' ),
			'name'      => 'widget-collapse',
			'file'      => '/js/scripts/global/widgetCollapse',
			'in_footer' => true,
		),
	),
	'hidden-sidebar'                   => array(
		array(
			'title'     => esc_html__( 'Off canvas sidebars', 'omniverse' ),
			'name'      => 'hidden-sidebar',
			'file'      => '/js/scripts/global/hiddenSidebar',
			'in_footer' => true,
		),
	),
	'lazy-loading'                     => array(
		array(
			'title'     => esc_html__( 'Lazy loading', 'omniverse' ),
			'name'      => 'lazy-loading',
			'file'      => '/js/scripts/global/lazyLoading',
			'in_footer' => true,
		),
	),
	'mfp-popup'                        => array(
		array(
			'title'     => esc_html__( 'Magnific popup', 'omniverse' ),
			'name'      => 'mfp-popup',
			'file'      => '/js/scripts/global/mfpPopup',
			'in_footer' => true,
		),
	),
	'swiper-carousel'                     => array(
		array(
			'title'     => esc_html__( 'Swiper carousel', 'omniverse' ),
			'name'      => 'swiper-carousel',
			'file'      => '/js/scripts/global/swiperInit',
			'in_footer' => true,
		),
	),
	'parallax'                         => array(
		array(
			'title'     => esc_html__( 'Background parallax', 'omniverse' ),
			'name'      => 'parallax',
			'file'      => '/js/scripts/global/parallax',
			'in_footer' => true,
		),
	),
	'photoswipe-images'                => array(
		array(
			'title'     => esc_html__( 'Image gallery element photoswipe', 'omniverse' ),
			'name'      => 'photoswipe-images',
			'file'      => '/js/scripts/global/photoswipeImages',
			'in_footer' => true,
		),
		array(
			'title'     => esc_html__( 'Photoswipe', 'omniverse' ),
			'name'      => 'photoswipe',
			'file'      => '/js/scripts/global/callPhotoSwipe',
			'in_footer' => true,
		),
	),
	'promo-popup'                      => array(
		array(
			'title'     => esc_html__( 'Promo popup', 'omniverse' ),
			'name'      => 'promo-popup',
			'file'      => '/js/scripts/global/promoPopup',
			'in_footer' => true,
		),
	),
	'scroll-top'                       => array(
		array(
			'title'     => esc_html__( 'Scroll to top button', 'omniverse' ),
			'name'      => 'scroll-top',
			'file'      => '/js/scripts/global/scrollTop',
			'in_footer' => true,
		),
	),
	'search-full-screen'               => array(
		array(
			'title'     => esc_html__( 'Search full screen', 'omniverse' ),
			'name'      => 'search-full-screen',
			'file'      => '/js/scripts/global/searchFullScreen',
			'in_footer' => true,
		),
	),
	'sticky-column'                    => array(
		array(
			'title'     => esc_html__( 'Sticky column', 'omniverse' ),
			'name'      => 'sticky-column',
			'file'      => '/js/scripts/global/stickyColumn',
			'in_footer' => true,
		),
	),
	'sticky-container'                 => array(
		array(
			'title'     => esc_html__( 'Sticky container', 'omniverse' ),
			'name'      => 'sticky-container',
			'file'      => '/js/scripts/global/stickyContainer',
			'in_footer' => true,
		),
	),
	'sticky-footer'                    => array(
		array(
			'title'     => esc_html__( 'Sticky footer', 'omniverse' ),
			'name'      => 'sticky-footer',
			'file'      => '/js/scripts/global/stickyFooter',
			'in_footer' => true,
		),
	),
	'sticky-social-buttons'            => array(
		array(
			'title'     => esc_html__( 'Sticky social buttons', 'omniverse' ),
			'name'      => 'sticky-social-buttons',
			'file'      => '/js/scripts/global/stickySocialButtons',
			'in_footer' => true,
		),
	),
	'widgets-hidable'                  => array(
		array(
			'title'     => esc_html__( 'Widget title toggle', 'omniverse' ),
			'name'      => 'widgets-hidable',
			'file'      => '/js/scripts/global/widgetsHidable',
			'in_footer' => true,
		),
	),
	'masonry-layout'                   => array(
		array(
			'title'     => esc_html__( 'Masonry', 'omniverse' ),
			'name'      => 'masonry-layout',
			'file'      => '/js/scripts/global/masonryLayout',
			'in_footer' => true,
		),
	),
	// Blog.
	'blog-load-more'                   => array(
		array(
			'title'     => esc_html__( 'Blog load more', 'omniverse' ),
			'name'      => 'blog-load-more',
			'file'      => '/js/scripts/blog/blogLoadMore',
			'in_footer' => true,
		),
		array(
			'title'     => esc_html__( 'Load more button', 'omniverse' ),
			'name'      => 'click-on-scroll-btn',
			'file'      => '/js/scripts/global/clickOnScrollButton',
			'in_footer' => true,
		),
	),
	// Elements.
	'banner-element'                   => array(
		array(
			'title'     => esc_html__( 'Banner element parallax', 'omniverse' ),
			'name'      => 'banner-element',
			'file'      => '/js/scripts/elements/banner',
			'in_footer' => true,
		),
	),
	'button-element'                   => array(
		array(
			'title'     => esc_html__( 'Button element smooth scroll', 'omniverse' ),
			'name'      => 'button-element',
			'file'      => '/js/scripts/elements/button',
			'in_footer' => true,
		),
	),
	'popup-element'                    => array(
		array(
			'title'     => esc_html__( 'Popup element', 'omniverse' ),
			'name'      => 'popup-element',
			'file'      => '/js/scripts/elements/contentPopup',
			'in_footer' => true,
		),
	),
	'countdown-element'                => array(
		array(
			'title'     => esc_html__( 'Countdown element', 'omniverse' ),
			'name'      => 'countdown-element',
			'file'      => '/js/scripts/elements/countDownTimer',
			'in_footer' => true,
		),
	),
	'counter-element'                  => array(
		array(
			'title'     => esc_html__( 'Animated counter element', 'omniverse' ),
			'name'      => 'counter-element',
			'file'      => '/js/scripts/elements/counter',
			'in_footer' => true,
		),
	),
	'google-map-element'               => array(
		array(
			'title'     => esc_html__( 'Google map element', 'omniverse' ),
			'name'      => 'google-map-element',
			'file'      => '/js/scripts/elements/googleMap',
			'in_footer' => true,
		),
	),
	'hotspot-element'                  => array(
		array(
			'title'     => esc_html__( 'Hotspot element', 'omniverse' ),
			'name'      => 'hotspot-element',
			'file'      => '/js/scripts/elements/hotSpot',
			'in_footer' => true,
		),
	),
	'image-gallery-element'            => array(
		array(
			'title'     => esc_html__( 'Image gallery element', 'omniverse' ),
			'name'      => 'image-gallery-element',
			'file'      => '/js/scripts/elements/imageGallery',
			'in_footer' => true,
		),
	),
	'infobox-element'                  => array(
		array(
			'title'     => esc_html__( 'Infobox element SVG animation', 'omniverse' ),
			'name'      => 'infobox-element',
			'file'      => '/js/scripts/elements/infoBox',
			'in_footer' => true,
		),
	),
	'instagram-element'                => array(
		array(
			'title'     => esc_html__( 'Instagram element', 'omniverse' ),
			'name'      => 'instagram-element',
			'file'      => '/js/scripts/elements/instagram',
			'in_footer' => true,
		),
	),
	'slider-element'                   => array(
		array(
			'title'     => esc_html__( 'Slider element', 'omniverse' ),
			'name'      => 'slider-element',
			'file'      => '/js/scripts/elements/slider',
			'in_footer' => true,
		),
	),
	'slider-distortion'                => array(
		array(
			'title'     => esc_html__( 'Slider distortion', 'omniverse' ),
			'name'      => 'slider-distortion',
			'file'      => '/js/scripts/shaders/sliderDistortion',
			'in_footer' => true,
		),
		array(
			'title'     => esc_html__( 'Shaders', 'omniverse' ),
			'name'      => 'shaders',
			'file'      => '/js/scripts/shaders/shaders',
			'in_footer' => true,
		),
		array(
			'title'     => esc_html__( 'ShaderX', 'omniverse' ),
			'name'      => 'shaderX',
			'file'      => '/js/scripts/shaders/shaderX',
			'in_footer' => true,
		),
	),
	'video-poster-element'             => array(
		array(
			'title'     => esc_html__( 'Video poster element', 'omniverse' ),
			'name'      => 'video-poster-element',
			'file'      => '/js/scripts/elements/videoPoster',
			'in_footer' => true,
		),
	),
	'view3d-element'                   => array(
		array(
			'title'     => esc_html__( 'View 3D element', 'omniverse' ),
			'name'      => 'view3d-element',
			'file'      => '/js/scripts/elements/view3d',
			'in_footer' => true,
		),
	),
	'tabs-element'                     => array(
		array(
			'title'     => esc_html__( 'Tabs element', 'omniverse' ),
			'name'      => 'tabs-element',
			'file'      => '/js/scripts/elements/tabs',
			'in_footer' => true,
		),
	),
	'open-street-map-element'          => array(
		array(
			'title'     => esc_html__( 'Open street map', 'omniverse' ),
			'name'      => 'open-street-map-element',
			'file'      => '/js/scripts/elements/openStreetMap',
			'in_footer' => true,
		),
	),
	'stock-status'                     => array(
		array(
			'title'     => esc_html__( 'Single product layout element stock status', 'omniverse' ),
			'name'      => 'stock-status',
			'file'      => '/js/scripts/elements/stockStatus',
			'in_footer' => true,
		),
	),
	'video-element'                    => array(
		array(
			'title'     => esc_html__( 'Video element', 'omniverse' ),
			'name'      => 'video-element',
			'file'      => '/js/scripts/elements/videoElement',
			'in_footer' => true,
		),
	),
	'video-element-popup'              => array(
		array(
			'title'     => esc_html__( 'Video element popup', 'omniverse' ),
			'name'      => 'video-element-popup',
			'file'      => '/js/scripts/elements/videoElementPopup',
			'in_footer' => true,
		),
	),
	// Header.
	'header-banner'                    => array(
		array(
			'title'     => esc_html__( 'Header banner', 'omniverse' ),
			'name'      => 'header-banner',
			'file'      => '/js/scripts/header/headerBanner',
			'in_footer' => true,
		),
	),
	'header-builder'                   => array(
		array(
			'title'     => esc_html__( 'Header builder', 'omniverse' ),
			'name'      => 'header-builder',
			'file'      => '/js/scripts/header/headerBuilder',
			'in_footer' => true,
		),
	),
	'mobile-search'                    => array(
		array(
			'title'     => esc_html__( 'Mobile search element', 'omniverse' ),
			'name'      => 'mobile-search',
			'file'      => '/js/scripts/header/mobileSearchIcon',
			'in_footer' => true,
		),
	),
	// Menu.
	'full-screen-menu'                 => array(
		array(
			'title'     => esc_html__( 'Full screen menu', 'omniverse' ),
			'name'      => 'full-screen-menu',
			'file'      => '/js/scripts/menu/fullScreenMenu',
			'in_footer' => true,
		),
	),
	'menu-dropdowns-ajax'              => array(
		array(
			'title'     => esc_html__( 'Menu dropdowns AJAX', 'omniverse' ),
			'name'      => 'menu-dropdowns-ajax',
			'file'      => '/js/scripts/menu/menuDropdownsAJAX',
			'in_footer' => true,
		),
	),
	'menu-offsets'                     => array(
		array(
			'title'     => esc_html__( 'Menu offsets', 'omniverse' ),
			'name'      => 'menu-offsets',
			'file'      => '/js/scripts/menu/menuOffsets',
			'in_footer' => true,
		),
	),
	'menu-sticky-offsets'              => array(
		array(
			'title'     => esc_html__( 'Sticky categories navigation', 'omniverse' ),
			'name'      => 'menu-sticky-offsets',
			'file'      => '/js/scripts/menu/menuStickyOffsets',
			'in_footer' => true,
		),
	),
	'menu-overlay'                     => array(
		array(
			'title'     => esc_html__( 'Menu overlay', 'omniverse' ),
			'name'      => 'menu-overlay',
			'file'      => '/js/scripts/menu/menuOverlay',
			'in_footer' => true,
		),
	),
	'menu-setup'                       => array(
		array(
			'title'     => esc_html__( 'Menu element click action', 'omniverse' ),
			'name'      => 'menu-setup',
			'file'      => '/js/scripts/menu/menuSetUp',
			'in_footer' => true,
		),
	),
	'mobile-navigation'                => array(
		array(
			'title'     => esc_html__( 'Mobile navigation', 'omniverse' ),
			'name'      => 'mobile-navigation',
			'file'      => '/js/scripts/menu/mobileNavigation',
			'in_footer' => true,
		),
	),
	'header-el-category-more-btn'      => array(
		array(
			'title'     => esc_html__( 'More categories button', 'omniverse' ),
			'name'      => 'header-el-category-more-btn',
			'file'      => '/js/scripts/menu/moreCategoriesButton',
			'in_footer' => true,
		),
	),
	'one-page-menu'                    => array(
		array(
			'title'     => esc_html__( 'One page menu', 'omniverse' ),
			'name'      => 'one-page-menu',
			'file'      => '/js/scripts/menu/onePageMenu',
			'in_footer' => true,
		),
	),
	'simple-dropdown'                  => array(
		array(
			'title'     => esc_html__( 'Simple dropdown', 'omniverse' ),
			'name'      => 'simple-dropdown',
			'file'      => '/js/scripts/menu/simpleDropdown',
			'in_footer' => true,
		),
	),
	// Portfolio.
	'ajax-portfolio'                   => array(
		array(
			'title'     => esc_html__( 'Portfolio AJAX', 'omniverse' ),
			'name'      => 'portfolio-portfolio',
			'file'      => '/js/scripts/portfolio/ajaxPortfolio',
			'in_footer' => true,
		),
	),
	'portfolio-effect'                 => array(
		array(
			'title'     => esc_html__( 'Portfolio effect', 'omniverse' ),
			'name'      => 'portfolio-effect',
			'file'      => '/js/scripts/portfolio/portfolioEffects',
			'in_footer' => true,
		),
	),
	'portfolio-load-more'              => array(
		array(
			'title'     => esc_html__( 'Portfolio load more', 'omniverse' ),
			'name'      => 'portfolio-load-more',
			'file'      => '/js/scripts/portfolio/portfolioLoadMore',
			'in_footer' => true,
		),
	),
	'portfolio-photoswipe'             => array(
		array(
			'title'     => esc_html__( 'Portfolio photoswipe', 'omniverse' ),
			'name'      => 'portfolio-photoswipe',
			'file'      => '/js/scripts/portfolio/portfolioPhotoSwipe',
			'in_footer' => true,
		),
		array(
			'title'     => esc_html__( 'Photoswipe', 'omniverse' ),
			'name'      => 'photoswipe',
			'file'      => '/js/scripts/global/callPhotoSwipe',
			'in_footer' => true,
		),
	),
	'portfolio-wd-nav-portfolios'      => array(
		array(
			'title'     => esc_html__( 'Portfolio masonry filters', 'omniverse' ),
			'name'      => 'portfolio-wd-nav-portfolios',
			'file'      => '/js/scripts/portfolio/portfolioMasonryFilters',
			'in_footer' => true,
		),
	),
	// WC.
	'action-after-add-to-cart'         => array(
		array(
			'title'     => esc_html__( 'Action after add to cart', 'omniverse' ),
			'name'      => 'action-after-add-to-cart',
			'file'      => '/js/scripts/wc/actionAfterAddToCart',
			'in_footer' => true,
		),
	),
	'add-to-cart-all-types'            => array(
		array(
			'title'     => esc_html__( 'Single product AJAX add to cart', 'omniverse' ),
			'name'      => 'add-to-cart-all-types',
			'file'      => '/js/scripts/wc/addToCartAllTypes',
			'in_footer' => true,
		),
	),
	'ajax-filters'                     => array(
		array(
			'title'     => esc_html__( 'AJAX shop', 'omniverse' ),
			'name'      => 'ajax-filters',
			'file'      => '/js/scripts/wc/ajaxFilters',
			'in_footer' => true,
		),
		array(
			'title'     => esc_html__( 'Sort by widget action', 'omniverse' ),
			'name'      => 'sort-by-widget',
			'file'      => '/js/scripts/wc/sortByWidget',
			'in_footer' => true,
		),
	),
	'cart-widget'                      => array(
		array(
			'title'     => esc_html__( 'Cart widget', 'omniverse' ),
			'name'      => 'cart-widget',
			'file'      => '/js/scripts/wc/cartWidget',
			'in_footer' => true,
		),
	),
	'categories-accordion'             => array(
		array(
			'title'     => esc_html__( 'Categories accordion', 'omniverse' ),
			'name'      => 'categories-accordion',
			'file'      => '/js/scripts/wc/categoriesAccordion',
			'in_footer' => true,
		),
	),
	'categories-dropdown'              => array(
		array(
			'title'     => esc_html__( 'Categories dropdown', 'omniverse' ),
			'name'      => 'categories-dropdown',
			'file'      => '/js/scripts/wc/categoriesDropdowns',
			'in_footer' => true,
		),
	),
	'categories-menu'                  => array(
		array(
			'title'     => esc_html__( 'Categories menu', 'omniverse' ),
			'name'      => 'categories-menu',
			'file'      => '/js/scripts/wc/categoriesMenu',
			'in_footer' => true,
		),
	),
	'comment-image'                    => array(
		array(
			'title'     => esc_html__( 'Single product review images', 'omniverse' ),
			'name'      => 'comment-image',
			'file'      => '/js/scripts/wc/commentImage',
			'in_footer' => true,
		),
	),
	'filter-dropdowns'                 => array(
		array(
			'title'     => esc_html__( 'Layered navigation dropdowns', 'omniverse' ),
			'name'      => 'filter-dropdowns',
			'file'      => '/js/scripts/wc/filterDropdowns',
			'in_footer' => true,
		),
	),
	'filters-area'                     => array(
		array(
			'title'     => esc_html__( 'Shop filters area', 'omniverse' ),
			'name'      => 'filters-area',
			'file'      => '/js/scripts/wc/filtersArea',
			'in_footer' => true,
		),
	),
	'grid-quantity'                    => array(
		array(
			'title'     => esc_html__( 'Quantity on products grid', 'omniverse' ),
			'name'      => 'grid-quantity',
			'file'      => '/js/scripts/wc/gridQuantity',
			'in_footer' => true,
		),
	),
	'header-categories-menu'           => array(
		array(
			'title'     => esc_html__( 'Header categories menu', 'omniverse' ),
			'name'      => 'header-categories-menu',
			'file'      => '/js/scripts/wc/headerCategoriesMenu',
			'in_footer' => true,
		),
	),
	'init-zoom'                        => array(
		array(
			'title'     => esc_html__( 'Single product image zoom', 'omniverse' ),
			'name'      => 'init-zoom',
			'file'      => '/js/scripts/wc/initZoom',
			'in_footer' => true,
		),
	),
	'login-dropdown'                   => array(
		array(
			'title'     => esc_html__( 'Login dropdown', 'omniverse' ),
			'name'      => 'login-dropdown',
			'file'      => '/js/scripts/wc/loginDropdown',
			'in_footer' => true,
		),
	),
	'login-sidebar'                    => array(
		array(
			'title'     => esc_html__( 'Login sidebar', 'omniverse' ),
			'name'      => 'login-sidebar',
			'file'      => '/js/scripts/wc/loginSidebar',
			'in_footer' => true,
		),
	),
	'login-tabs'                       => array(
		array(
			'title'     => esc_html__( 'Login tabs', 'omniverse' ),
			'name'      => 'login-tabs',
			'file'      => '/js/scripts/wc/loginTabs',
			'in_footer' => true,
		),
	),
	'mini-cart-quantity'               => array(
		array(
			'title'     => esc_html__( 'Mini cart quantity', 'omniverse' ),
			'name'      => 'mini-cart-quantity',
			'file'      => '/js/scripts/wc/miniCartQuantity',
			'in_footer' => true,
		),
	),
	'checkout-fields'                  => array(
		array(
			'title'     => esc_html__( 'Checkout fields', 'omniverse' ),
			'name'      => 'checkout-fields',
			'file'      => '/js/scripts/wc/checkoutFields',
			'in_footer' => true,
		),
	),
	'checkout-remove-btn'              => array(
		array(
			'title'     => esc_html__( 'Checkout remove button', 'omniverse' ),
			'name'      => 'checkout-remove-btn',
			'file'      => '/js/scripts/wc/checkoutRemoveBtn',
			'in_footer' => true,
		),
	),
	'checkout-quantity'                => array(
		array(
			'title'     => esc_html__( 'Checkout quantity', 'omniverse' ),
			'name'      => 'checkout-quantity',
			'file'      => '/js/scripts/wc/checkoutQuantity',
			'in_footer' => true,
		),
	),
	'on-remove-from-cart'              => array(
		array(
			'title'     => esc_html__( 'Remove from cart loader', 'omniverse' ),
			'name'      => 'on-remove-from-cart',
			'file'      => '/js/scripts/wc/onRemoveFromCart',
			'in_footer' => true,
		),
	),
	'product-360-button'               => array(
		array(
			'title'     => esc_html__( 'Single product 360 button', 'omniverse' ),
			'name'      => 'product-360-button',
			'file'      => '/js/scripts/wc/product360Button',
			'in_footer' => true,
		),
		array(
			'title'     => esc_html__( 'View 3D element', 'omniverse' ),
			'name'      => 'view3d-element',
			'file'      => '/js/scripts/elements/view3d',
			'in_footer' => true,
		),
	),
	'product-accordion'                => array(
		array(
			'title'     => esc_html__( 'Single product accordion', 'omniverse' ),
			'name'      => 'product-accordion',
			'file'      => '/js/scripts/wc/productAccordion',
			'in_footer' => true,
		),
	),
	'product-filters'                  => array(
		array(
			'title'     => esc_html__( 'Product filters', 'omniverse' ),
			'name'      => 'product-filters',
			'file'      => '/js/scripts/wc/productFilters',
			'in_footer' => true,
		),
	),
	'product-hover'                    => array(
		array(
			'title'     => esc_html__( 'Product base hover', 'omniverse' ),
			'name'      => 'product-hover',
			'file'      => '/js/scripts/wc/productHover',
			'in_footer' => true,
		),
	),
	'product-images'                   => array(
		array(
			'title'     => esc_html__( 'Single product image photoswipe', 'omniverse' ),
			'name'      => 'product-images',
			'file'      => '/js/scripts/wc/productImages',
			'in_footer' => true,
		),
		array(
			'title'     => esc_html__( 'Photoswipe', 'omniverse' ),
			'name'      => 'photoswipe',
			'file'      => '/js/scripts/global/callPhotoSwipe',
			'in_footer' => true,
		),
	),
	'product-images-gallery'           => array(
		array(
			'title'     => esc_html__( 'Single product image gallery', 'omniverse' ),
			'name'      => 'product-images-gallery',
			'file'      => '/js/scripts/wc/productImagesGallery',
			'in_footer' => true,
		),
	),
	'product-more-description'         => array(
		array(
			'title'     => esc_html__( 'Product more description', 'omniverse' ),
			'name'      => 'product-more-description',
			'file'      => '/js/scripts/wc/productMoreDescription',
			'in_footer' => true,
		),
	),
	'product-recently-viewed'          => array(
		array(
			'title'     => esc_html__( 'Recently Viewed Products', 'omniverse' ),
			'name'      => 'product-recently-viewed',
			'file'      => '/js/scripts/wc/productRecentlyViewed',
			'in_footer' => true,
		),
	),
	'products-load-more'               => array(
		array(
			'title'     => esc_html__( 'Product load more', 'omniverse' ),
			'name'      => 'products-load-more',
			'file'      => '/js/scripts/wc/productsLoadMore',
			'in_footer' => true,
		),
		array(
			'title'     => esc_html__( 'Load more button', 'omniverse' ),
			'name'      => 'click-on-scroll-btn',
			'file'      => '/js/scripts/global/clickOnScrollButton',
			'in_footer' => true,
		),
	),
	'products-tabs'                    => array(
		array(
			'title'     => esc_html__( 'Single product tabs', 'omniverse' ),
			'name'      => 'products-tabs',
			'file'      => '/js/scripts/wc/productsTabs',
			'in_footer' => true,
		),
	),
	'product-video'                    => array(
		array(
			'title'     => esc_html__( 'Single product video button', 'omniverse' ),
			'name'      => 'product-video',
			'file'      => '/js/scripts/wc/productVideo',
			'in_footer' => true,
		),
	),
	'quick-shop'                       => array(
		array(
			'title'     => esc_html__( 'Quick shop', 'omniverse' ),
			'name'      => 'quick-shop',
			'file'      => '/js/scripts/wc/quickShop',
			'in_footer' => true,
		),
	),
	'quick-shop-with-form'             => array(
		array(
			'title'     => esc_html__( 'Quick shop variation form', 'omniverse' ),
			'name'      => 'quick-shop-with-form',
			'file'      => '/js/scripts/wc/quickShopVariationForm',
			'in_footer' => true,
		),
	),
	'quick-view'                       => array(
		array(
			'title'     => esc_html__( 'Quick view', 'omniverse' ),
			'name'      => 'quick-view',
			'file'      => '/js/scripts/wc/quickView',
			'in_footer' => true,
		),
	),
	'shop-loader'                      => array(
		array(
			'title'     => esc_html__( 'Shop loader', 'omniverse' ),
			'name'      => 'shop-loader',
			'file'      => '/js/scripts/wc/shopLoader',
			'in_footer' => true,
		),
	),
	'shop-masonry'                     => array(
		array(
			'title'     => esc_html__( 'Shop masonry', 'omniverse' ),
			'name'      => 'shop-masonry',
			'file'      => '/js/scripts/wc/shopMasonry',
			'in_footer' => true,
		),
	),
	'shop-page-init'                   => array(
		array(
			'title'     => esc_html__( 'Shop page init', 'omniverse' ),
			'name'      => 'shop-page-init',
			'file'      => '/js/scripts/wc/shopPageInit',
			'in_footer' => true,
		),
		array(
			'title'     => esc_html__( 'Load more button', 'omniverse' ),
			'name'      => 'click-on-scroll-btn',
			'file'      => '/js/scripts/global/clickOnScrollButton',
			'in_footer' => true,
		),
	),
	'single-product-tabs-accordion'    => array(
		array(
			'title'     => esc_html__( 'Single product tabs accordion', 'omniverse' ),
			'name'      => 'single-product-tabs-accordion',
			'file'      => '/js/scripts/wc/singleProductTabsAccordion',
			'in_footer' => true,
		),
	),
	'sticky-add-to-cart'               => array(
		array(
			'title'     => esc_html__( 'Single product sticky add to cart', 'omniverse' ),
			'name'      => 'sticky-add-to-cart',
			'file'      => '/js/scripts/wc/stickyAddToCart',
			'in_footer' => true,
		),
	),
	'sticky-details'                   => array(
		array(
			'title'     => esc_html__( 'Single product sticky details', 'omniverse' ),
			'name'      => 'sticky-details',
			'file'      => '/js/scripts/wc/stickyDetails',
			'in_footer' => true,
		),
	),
	'sticky-sidebar-btn'               => array(
		array(
			'title'     => esc_html__( 'Sticky sidebar button', 'omniverse' ),
			'name'      => 'sticky-sidebar-btn',
			'file'      => '/js/scripts/wc/stickySidebarBtn',
			'in_footer' => true,
		),
	),
	'swatches-limit'                   => array(
		array(
			'title'     => esc_html__( 'Swatches limit', 'omniverse' ),
			'name'      => 'swatches-limit',
			'file'      => '/js/scripts/wc/swatchesLimit',
			'in_footer' => true,
		),
	),
	'swatches-on-grid'                 => array(
		array(
			'title'     => esc_html__( 'Swatches on grid', 'omniverse' ),
			'name'      => 'swatches-on-grid',
			'file'      => '/js/scripts/wc/swatchesOnGrid',
			'in_footer' => true,
		),
	),
	'swatches-variations'              => array(
		array(
			'title'     => esc_html__( 'Swatches variations', 'omniverse' ),
			'name'      => 'swatches-variations',
			'file'      => '/js/scripts/wc/swatchesVariations',
			'in_footer' => true,
		),
	),
	'variations-price'                 => array(
		array(
			'title'     => esc_html__( 'Variations price', 'omniverse' ),
			'name'      => 'variations-price',
			'file'      => '/js/scripts/wc/variationsPrice',
			'in_footer' => true,
		),
	),
	'wishlist'                         => array(
		array(
			'title'     => esc_html__( 'Wishlist', 'omniverse' ),
			'name'      => 'wishlist',
			'file'      => '/js/scripts/wc/wishlist',
			'in_footer' => true,
		),
	),
	'wishlist-group'                   => array(
		array(
			'title'     => esc_html__( 'Wishlist group', 'omniverse' ),
			'name'      => 'wishlist-group',
			'file'      => '/js/scripts/wc/wishlistGroup',
			'in_footer' => true,
		),
	),
	'omniverse-compare'                 => array(
		array(
			'title'     => esc_html__( 'Compare', 'omniverse' ),
			'name'      => 'omniverse-compare',
			'file'      => '/js/scripts/wc/omniverseCompare',
			'in_footer' => true,
		),
	),
	'woocommerce-comments'             => array(
		array(
			'title'     => esc_html__( 'WooCommerce comments', 'omniverse' ),
			'name'      => 'woocommerce-comments',
			'file'      => '/js/scripts/wc/woocommerceComments',
			'in_footer' => true,
		),
	),
	'woocommerce-notices'              => array(
		array(
			'title'     => esc_html__( 'WooCommerce notices', 'omniverse' ),
			'name'      => 'woocommerce-notices',
			'file'      => '/js/scripts/wc/woocommerceNotices',
			'in_footer' => true,
		),
	),
	'woocommerce-price-slider'         => array(
		array(
			'title'     => esc_html__( 'WooCommerce price slider', 'omniverse' ),
			'name'      => 'woocommerce-price-slider',
			'file'      => '/js/scripts/wc/woocommercePriceSlider',
			'in_footer' => true,
		),
	),
	'woocommerce-quantity'             => array(
		array(
			'title'     => esc_html__( 'WooCommerce quantity', 'omniverse' ),
			'name'      => 'woocommerce-quantity',
			'file'      => '/js/scripts/wc/woocommerceQuantity',
			'in_footer' => true,
		),
	),
	'woocommerce-wrapp-table'          => array(
		array(
			'title'     => esc_html__( 'WooCommerce responsive table', 'omniverse' ),
			'name'      => 'woocommerce-wrapp-table',
			'file'      => '/js/scripts/wc/woocommerceWrappTable',
			'in_footer' => true,
		),
	),
	'accordion-element'                => array(
		array(
			'title'     => esc_html__( 'Accordion element', 'omniverse' ),
			'name'      => 'accordion-element',
			'file'      => '/js/scripts/elements/accordion',
			'in_footer' => true,
		),
	),
	'button-show-more'                 => array(
		array(
			'title'     => esc_html__( 'Button show more', 'omniverse' ),
			'name'      => 'button-show-more',
			'file'      => '/js/scripts/elements/buttonShowMore',
			'in_footer' => true,
		),
	),
	'off-canvas-colum-btn'             => array(
		array(
			'title'     => esc_html__( 'Button off canvas', 'omniverse' ),
			'name'      => 'off-canvas-colum-btn',
			'file'      => '/js/scripts/elements/offCanvasColumnBtn',
			'in_footer' => true,
		),
	),
	'counter-product-visits'           => array(
		array(
			'title'     => esc_html__( 'Counter product visits', 'omniverse' ),
			'name'      => 'counter-product-visits',
			'file'      => '/js/scripts/wc/countProductVisits',
			'in_footer' => true,
		),
	),
	'search-by-filters'                => array(
		array(
			'title'     => esc_html__( 'Search by filters', 'omniverse' ),
			'name'      => 'search-by-filters',
			'file'      => '/js/scripts/wc/searchByFilters',
			'in_footer' => true,
		),
	),
	'frequently-bought-together'       => array(
		array(
			'title'     => esc_html__( 'Frequently bought together', 'omniverse' ),
			'name'      => 'frequently-bought-together',
			'file'      => '/js/scripts/wc/frequentlyBoughtTogether',
			'in_footer' => true,
		),
	),
	'image-gallery-in-loop'            => array(
		array(
			'title'     => esc_html__( 'Images gallery in product loop', 'omniverse' ),
			'name'      => 'image-gallery-in-loop',
			'file'      => '/js/scripts/wc/imagesGalleryInLoop',
			'in_footer' => true,
		),
	),
	'dynamic-discounts-table'          => array(
		array(
			'title'     => esc_html__( 'Dynamic discounts table', 'omniverse' ),
			'name'      => 'dynamic-discounts-table',
			'file'      => '/js/scripts/wc/dynamicDiscountsTable',
			'in_footer' => true,
		),
	),
	// Single product.
	'product-reviews'                  => array(
		array(
			'title'     => esc_html__( 'WooCommerce single product reviews', 'omniverse' ),
			'name'      => 'product-reviews',
			'file'      => '/js/scripts/wc/productReviews',
			'in_footer' => true,
		),
	),
	'product-reviews-likes'            => array(
		array(
			'title'     => esc_html__( 'WooCommerce single product reviews likes', 'omniverse' ),
			'name'      => 'product-reviews-likes',
			'file'      => '/js/scripts/wc/productReviewsLikes',
			'in_footer' => true,
		),
	),
	'product-reviews-criteria'         => array(
		array(
			'title'     => esc_html__( 'WooCommerce single product reviews criteria', 'omniverse' ),
			'name'      => 'product-reviews-criteria',
			'file'      => '/js/scripts/wc/productReviewsCriteria',
			'in_footer' => true,
		),
	),
	'single-product-video-gallery'     => array(
		array(
			'title'     => esc_html__( 'WooCommerce single product video image', 'omniverse' ),
			'name'      => 'single-product-video-gallery',
			'file'      => '/js/scripts/wc/productGalleryVideo',
			'in_footer' => true,
		),
	),
	'cart-quantity'                    => array(
		array(
			'title'     => esc_html__( 'WooCommerce cart quantity', 'omniverse' ),
			'name'      => 'cart-quantity',
			'file'      => '/js/scripts/wc/cartQuantity',
			'in_footer' => true,
		),
	),
);
