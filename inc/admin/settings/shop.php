<?php
if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

use DN\Admin\Modules\Options;

Options::add_field(
	array(
		'id'          => 'add_to_cart_action',
		'name'        => esc_html__( 'Action after add to cart', 'omniverse' ),
		'group'       => esc_html__( 'Shopping cart widget', 'omniverse' ),
		'description' => esc_html__( 'Choose between showing an informative popup and opening the shopping cart widget.', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'shop_section',
		'options'     => array(
			'popup'   => array(
				'name'  => esc_html__( 'Show popup', 'omniverse' ),
				'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'action-after-add-to-cart-show-popup.mp4" autoplay loop muted></video>',
				'value' => 'popup',
			),
			'widget'  => array(
				'name'  => esc_html__( 'Display widget', 'omniverse' ),
				'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'action-after-add-to-cart-display-widget.mp4" autoplay loop muted></video>',
				'value' => 'widget',
			),
			'nothing' => array(
				'name'  => esc_html__( 'No action', 'omniverse' ),
				'value' => 'nothing',
			),
		),
		'default'     => 'widget',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'add_to_cart_action_timeout',
		'name'        => esc_html__( 'Hide widget automatically', 'omniverse' ),
		'group'       => esc_html__( 'Shopping cart widget', 'omniverse' ),
		'description' => esc_html__( 'After adding to cart the shopping cart widget will be hidden automatically', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_section',
		'default'     => false,
		'priority'    => 20,
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'requires'    => array(
			array(
				'key'     => 'add_to_cart_action',
				'compare' => 'not_equals',
				'value'   => 'nothing',
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'add_to_cart_action_timeout_number',
		'name'        => esc_html__( 'Hide widget after', 'omniverse' ),
		'group'       => esc_html__( 'Shopping cart widget', 'omniverse' ),
		'description' => esc_html__( 'Set the number of seconds for the shopping cart widget to be displayed after adding to cart', 'omniverse' ),
		'type'        => 'range',
		'section'     => 'shop_section',
		'default'     => 3,
		'min'         => 1,
		'max'         => 20,
		'step'        => 1,
		'priority'    => 30,
		'requires'    => array(
			array(
				'key'     => 'add_to_cart_action',
				'compare' => 'not_equals',
				'value'   => 'nothing',
			),
			array(
				'key'     => 'add_to_cart_action_timeout',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
		'unit'        => 'sec',
	)
);

Options::add_field(
	array(
		'id'          => 'mini_cart_quantity',
		'name'        => esc_html__( 'Quantity input on shopping cart widget', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'quantity-input-shopping-cart-widget.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Give your customers an ability to change the number of products in the cart directly from the shopping cart widget.', 'omniverse' ),
		'group'       => esc_html__( 'Shopping cart widget', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_section',
		'default'     => '0',
		'priority'    => 40,
		'class'       => 'dn-tooltip-bordered',
	)
);

Options::add_field(
	array(
		'id'       => 'show_sku_in_mini_cart',
		'name'     => esc_html__( 'Show SKU in mini cart', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-sku-in-mini-cart.jpg" alt="">', 'omniverse' ), true ),
		'group'    => esc_html__( 'SKU', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'shop_section',
		'default'  => false,
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'priority' => 50,
	)
);

Options::add_field(
	array(
		'id'       => 'show_sku_in_cart',
		'name'     => esc_html__( 'Show SKU on cart page', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-sku-in-cart-page.jpg" alt="">', 'omniverse' ), true ),
		'group'    => esc_html__( 'SKU', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'shop_section',
		'default'  => false,
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'priority' => 60,
	)
);

Options::add_field(
	array(
		'id'       => 'show_sku_in_thank_you_page',
		'name'     => esc_html__( 'Show SKU on thank you page', 'omniverse' ),
		'group'    => esc_html__( 'SKU', 'omniverse' ),
		'hint'     => '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-sku-in-thank-you-page.jpg" alt="">',
		'type'     => 'switcher',
		'section'  => 'shop_section',
		'default'  => false,
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'priority' => 65,
	)
);

Options::add_field(
	array(
		'id'       => 'show_sku_in_email_order',
		'name'     => esc_html__( 'Show SKU in customer order received email', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-sku-in-customer-order-received-email.jpg" alt="">', 'omniverse' ), true ),
		'group'    => esc_html__( 'SKU', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'shop_section',
		'default'  => false,
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'priority' => 70,
	)
);

Options::add_field(
	array(
		'id'       => 'show_sku_on_ajax',
		'name'     => esc_html__( 'Show SKU on search AJAX results', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-sku-on-search-ajax-results.jpg" alt="">', 'omniverse' ), true ),
		'group'    => esc_html__( 'SKU', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'shop_section',
		'requires' => array(
			array(
				'key'     => 'search_by_sku',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
		'default'  => false,
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'priority' => 80,
	)
);


Options::add_field(
	array(
		'id'          => 'catalog_mode',
		'name'        => esc_html__( 'Enable catalog mode', 'omniverse' ),
		'description' => esc_html__( 'You can hide all "Add to cart" buttons, cart widget, cart and checkout pages. This will allow you to showcase your products as an online catalog without ability to make a purchase.', 'omniverse' ),
		'group'       => esc_html__( 'Catalog mode', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_section',
		'default'     => false,
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 90,
	)
);

Options::add_field(
	array(
		'id'          => 'size_guides',
		'name'        => esc_html__( 'Enable size guides', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'enable-size-guides.mp4" autoplay loop muted></video>',
		'description' => wp_kses(
			__( 'Turn on the size guide feature on the website. Read more information about this function in <a href="https://zynxsol.com/docs/omniverse/faq-guides/create-size-guide-table/" target="_blank">our documentation</a>.', 'omniverse' ),
			array(
				'a'      => array(
					'href'   => true,
					'target' => true,
				),
				'br'     => array(),
				'strong' => array(),
			)
		),
		'group'       => esc_html__( 'Size guides', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_section',
		'default'     => '1',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 100,
	)
);

Options::add_field(
	array(
		'id'          => 'login_prices',
		'name'        => esc_html__( 'Login to see add to cart and prices', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'login-to-see-add-to-cart-and-prices.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'You can restrict shopping functions only for logged in customers.', 'omniverse' ),
		'group'       => esc_html__( 'Hide add to cart and price', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'shop_section',
		'default'     => false,
		'priority'    => 110,
	)
);

/**
 * Swatches.
 */


/**
 * Variable product.
 */


Options::add_field(
	array(
		'id'          => 'quick_shop_variable',
		'name'        => esc_html__( '"Quick shop" for variable products', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'quick-shop-for-variable-products.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Allow your users to purchase variable products directly from the shop page.', 'omniverse' ),
		'group'       => esc_html__( 'Quick shop', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'variable_products_section',
		'default'     => '1',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'quick_shop_variable_type',
		'name'        => esc_html__( '"Quick shop" type', 'omniverse' ),
		'group'       => esc_html__( 'Quick shop', 'omniverse' ),
		'description' => esc_html__( 'Choose the type of adding product variation to the cart on the product grid.', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'variable_products_section',
		'options'     => array(
			'select_options' => array(
				'name'  => esc_html__( 'On "Select options" click', 'omniverse' ),
				'hint'  => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'quick_shop_variable_type_select.mp4" autoplay loop muted></video>',
				'value' => 'select_options',
			),
			'variation_form' => array(
				'name'  => esc_html__( 'On variation click', 'omniverse' ),
				'hint'  => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'quick_shop_variable_type_variation.mp4" autoplay loop muted></video>',
				'value' => 'variation_form',
			),
		),
		'requires'    => array(
			array(
				'key'     => 'quick_shop_variable',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
		'default'     => 'select_options',
		'priority'    => 11,
	)
);

Options::add_field(
	array(
		'id'       => 'quick_shop_clear_action',
		'name'     => esc_html__( 'Clear variation', 'omniverse' ),
		'group'    => esc_html__( 'Quick shop', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'variable_products_section',
		'options'  => array(
			'none'   => array(
				'name'  => esc_html__( 'None', 'omniverse' ),
				'value' => 'none',
			),
			'btn'    => array(
				'name'  => esc_html__( 'Clear button', 'omniverse' ),
				'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'quick_shop_clear_action_button.mp4" autoplay loop muted></video>',
				'value' => 'btn',
			),
			'double' => array(
				'name'  => esc_html__( 'On second click', 'omniverse' ),
				'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'quick_shop_clear_action_click.mp4" autoplay loop muted></video>',
				'value' => 'double',
			),
		),
		'requires' => array(
			array(
				'key'     => 'quick_shop_variable',
				'compare' => 'equals',
				'value'   => '1',
			),
			array(
				'key'     => 'quick_shop_variable_type',
				'compare' => 'equals',
				'value'   => 'variation_form',
			),
		),
		'default'  => 'none',
		'priority' => 12,
	)
);

Options::add_field(
	array(
		'id'           => 'grid_swatches_attribute',
		'name'         => esc_html__( 'Grid swatch attribute to display', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'grid-swatch-attribute-to-display.mp4" autoplay loop muted></video>',
		'description'  => esc_html__( 'Choose the attribute that will be shown on the product grid.', 'omniverse' ),
		'group'        => esc_html__( 'Attribute swatches', 'omniverse' ),
		'type'         => 'select',
		'section'      => 'variable_products_section',
		'callback'     => 'omniverse_product_attributes_array',
		'priority'     => 40,
		'empty_option' => true,
	)
);

Options::add_field(
	array(
		'id'          => 'swatches_limit',
		'name'        => esc_html__( 'Limit swatches on grid', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'limit-swatches-on-grid.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Collapse swatches list on the product grid to save space in case a product has too many variations.', 'omniverse' ),
		'group'       => esc_html__( 'Attribute swatches', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'variable_products_section',
		'default'     => false,
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 50,
	)
);

Options::add_field(
	array(
		'id'       => 'swatches_limit_count',
		'name'     => esc_html__( 'Number of visible swatches on grid', 'omniverse' ),
		'type'     => 'range',
		'section'  => 'variable_products_section',
		'group'    => esc_html__( 'Attribute swatches', 'omniverse' ),
		'default'  => 5,
		'min'      => 1,
		'step'     => 1,
		'max'      => 20,
		'priority' => 60,
		'requires' => array(
			array(
				'key'     => 'swatches_limit',
				'compare' => 'equals',
				'value'   => true,
			),
		),
		'unit'     => 'swatch',
	)
);

Options::add_field(
	array(
		'id'          => 'single_product_swatches_limit',
		'name'        => esc_html__( 'Limit swatches on single product', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'single_product_swatches_limit.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Collapse swatches list on the single product to save space in case a product has too many variations.', 'omniverse' ),
		'group'       => esc_html__( 'Attribute swatches', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'variable_products_section',
		'default'     => false,
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 61,
	)
);

Options::add_field(
	array(
		'id'       => 'single_product_swatches_limit_count',
		'name'     => esc_html__( 'Number of visible swatches on single product', 'omniverse' ),
		'type'     => 'range',
		'section'  => 'variable_products_section',
		'group'    => esc_html__( 'Attribute swatches', 'omniverse' ),
		'default'  => 10,
		'min'      => 1,
		'step'     => 1,
		'max'      => 30,
		'priority' => 62,
		'requires' => array(
			array(
				'key'     => 'single_product_swatches_limit',
				'compare' => 'equals',
				'value'   => true,
			),
		),
		'unit'     => 'swatch',
	)
);

Options::add_field(
	array(
		'id'          => 'swatches_use_variation_images',
		'name'        => esc_html__( 'Use images from product variations', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'use-images-from-product-variations.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Swatches buttons will be filled with images chosen for product variations and not with images uploaded to attribute terms.', 'omniverse' ),
		'group'       => esc_html__( 'Attribute swatches', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'variable_products_section',
		'default'     => false,
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 70,
	)
);

Options::add_field(
	array(
		'id'          => 'swatches_labels_name',
		'name'        => esc_html__( 'Show selected option name on desktop and tablet', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-selected-option-name-on-desktop-and-tablet.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Replace the variation swatch tooltip with the text label next to the attribute title.', 'omniverse' ),
		'group'       => esc_html__( 'Attribute swatches', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'variable_products_section',
		'default'     => false,
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 80,
	)
);

Options::add_field(
	array(
		'id'          => 'swatches_scroll_top_desktop',
		'name'        => esc_html__( 'Scroll to top on variation select [desktop]', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'scroll-top-on-variation-select.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'When you turn on this option and click on some variation with image, the page will be scrolled up to show that variation image in the main product gallery.', 'omniverse' ),
		'group'       => esc_html__( 'Attribute swatches', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'variable_products_section',
		't_tab'       => [
			'id'    => 'swatches_scroll_top_tabs',
			'tab'   => esc_html__( 'Desktop', 'omniverse' ),
			'icon'  => 'dn-i-desktop',
			'style' => 'devices',
		],
		'default'     => false,
		'priority'    => 90,
	)
);

Options::add_field(
	array(
		'id'          => 'swatches_scroll_top_mobile',
		'name'        => esc_html__( 'Scroll to top on variation select [mobile]', 'omniverse' ),
		'description' => esc_html__( 'When you turn on this option and click on some variation with image, the page will be scrolled up to show that variation image in the main product gallery.', 'omniverse' ),
		'group'       => esc_html__( 'Attribute swatches', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'variable_products_section',
		't_tab'       => [
			'id'   => 'swatches_scroll_top_tabs',
			'tab'  => esc_html__( 'Mobile', 'omniverse' ),
			'icon' => 'dn-i-phone',
		],
		'default'     => false,
		'priority'    => 95,
	)
);

Options::add_field(
	array(
		'id'          => 'variation_gallery',
		'name'        => esc_html__( 'Additional variations images', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'additional-variations-images.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Add an ability to upload additional images for each variation in variable products.', 'omniverse' ),
		'group'       => esc_html__( 'Variations images', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'variable_products_section',
		'default'     => '1',
		'priority'    => 100,
	)
);

Options::add_field(
	array(
		'id'          => 'variation_gallery_storage_method',
		'name'        => esc_html__( 'Data storage method', 'omniverse' ),
		'description' => esc_html__( 'If you have problems with import/export of the additional variations images data, you need to use "Variations products meta" method.', 'omniverse' ),
		'group'       => esc_html__( 'Variations images', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'variable_products_section',
		'options'     => array(
			'old' => array(
				'name'  => esc_html__( 'Parent product meta', 'omniverse' ),
				'value' => 'old',
			),
			'new' => array(
				'name'  => esc_html__( 'Variations products meta', 'omniverse' ),
				'value' => 'new',
			),
		),
		'requires'    => array(
			array(
				'key'     => 'variation_gallery',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
		'default'     => 'old',
		'priority'    => 110,
	)
);

Options::add_field(
	array(
		'id'          => 'ajax_variation_threshold',
		'name'        => esc_html__( 'AJAX variation threshold', 'omniverse' ),
		'description' => esc_html__( 'Increase this value if you noticed a problem with additional variations images function.', 'omniverse' ),
		'group'       => esc_html__( 'Variations images', 'omniverse' ),
		'type'        => 'range',
		'section'     => 'variable_products_section',
		'requires'    => array(
			array(
				'key'     => 'variation_gallery',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
		'default'     => 30,
		'min'         => 1,
		'max'         => 500,
		'step'        => 1,
		'priority'    => 120,
		'unit'        => 'var',
	)
);

Options::add_field(
	array(
		'id'          => 'hide_larger_price',
		'name'        => esc_html__( 'Hide "to" price', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'hide-to-price.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'This option will hide a higher price for variable products and leave only a small one.', 'omniverse' ),
		'group'       => esc_html__( 'Price', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'variable_products_section',
		'default'     => false,
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 130,
	)
);

Options::add_field(
	array(
		'id'          => 'single_product_variations_price',
		'type'        => 'switcher',
		'name'        => esc_html__( 'Remove duplicate price for variable product', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'remove-duplicate-price-for-variable-product.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'When you will select any variation, the price on the single product page will be updated with an actual variation price.', 'omniverse' ),
		'group'       => esc_html__( 'Price', 'omniverse' ),
		'section'     => 'variable_products_section',
		'default'     => '0',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 140,
	)
);

/**
 * Labels.
 */
Options::add_field(
	array(
		'id'       => 'label_shape',
		'name'     => esc_html__( 'Label shape', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'product_labels_section',
		'default'  => 'rounded',
		'options'  => array(
			'rounded'     => array(
				'name'  => esc_html__( 'Round', 'omniverse' ),
				'value' => 'rounded',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/product-label/rounded.jpg',
			),
			'rectangular' => array(
				'name'  => esc_html__( 'Rectangular', 'omniverse' ),
				'value' => 'rectangular',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/product-label/rectangular.jpg',
			),
			'rounded-sm' => array(
				'name'  => esc_html__( 'Rounded small', 'omniverse' ),
				'value' => 'rounded-sm',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/product-label/rounded-small.jpg',
			),
		),
		'priority' => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'percentage_label',
		'name'        => esc_html__( '"Sale" label in percentage', 'omniverse' ),
		'group'       => esc_html__( 'Sale', 'omniverse' ),
		'description' => esc_html__( 'Works with Simple, Variable and External products only.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'product_labels_section',
		'default'     => '1',
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'          => 'sale_label_bg_color',
		'name'        => esc_html__( '"Sale" label background', 'omniverse' ),
		'group'       => esc_html__( 'Sale', 'omniverse' ),
		'type'        => 'color',
		'section'     => 'product_labels_section',
		'selector_bg' => '.product-labels .product-label.onsale',
		'default'     => array(),
		'priority'    => 30,
		'class'       => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'sale_label_text_color',
		'name'     => esc_html__( '"Sale" label text color', 'omniverse' ),
		'group'    => esc_html__( 'Sale', 'omniverse' ),
		'type'     => 'color',
		'section'  => 'product_labels_section',
		'selector' => '.product-labels .product-label.onsale',
		'default'  => array(),
		'priority' => 40,
		'class'    => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'          => 'new_label',
		'name'        => esc_html__( '"New" label on products', 'omniverse' ),
		'group'       => esc_html__( 'New', 'omniverse' ),
		'description' => esc_html__( 'This label is displayed for products if you enabled this option for particular items.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'product_labels_section',
		'default'     => '1',
		'priority'    => 50,
	)
);

Options::add_field(
	array(
		'id'          => 'new_label_days_after_create',
		'name'        => esc_html__( 'Automatic "New" label period', 'omniverse' ),
		'group'       => esc_html__( 'New', 'omniverse' ),
		'description' => esc_html__( 'Set a number of days to keep your products marked as "New" after creation.', 'omniverse' ),
		'type'        => 'range',
		'section'     => 'product_labels_section',
		'default'     => 0,
		'min'         => 0,
		'max'         => 365,
		'step'        => 1,
		'priority'    => 51,
		'unit'        => 'day',
	)
);

Options::add_field(
	array(
		'id'          => 'new_label_bg_color',
		'name'        => esc_html__( '"New" label background', 'omniverse' ),
		'group'       => esc_html__( 'New', 'omniverse' ),
		'type'        => 'color',
		'section'     => 'product_labels_section',
		'selector_bg' => '.product-labels .product-label.new',
		'default'     => array(),
		'priority'    => 60,
		'class'       => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'new_label_text_color',
		'name'     => esc_html__( '"New" label text color', 'omniverse' ),
		'group'    => esc_html__( 'New', 'omniverse' ),
		'type'     => 'color',
		'section'  => 'product_labels_section',
		'selector' => '.product-labels .product-label.new',
		'default'  => array(),
		'priority' => 70,
		'class'    => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'          => 'hot_label',
		'name'        => esc_html__( '"Hot" label on products', 'omniverse' ),
		'group'       => esc_html__( 'Hot', 'omniverse' ),
		'description' => esc_html__( 'Your products marked as "Featured" will have a badge with "Hot" label.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'product_labels_section',
		'default'     => '1',
		'priority'    => 80,
	)
);

Options::add_field(
	array(
		'id'          => 'hot_label_bg_color',
		'name'        => esc_html__( '"Hot" label background', 'omniverse' ),
		'group'       => esc_html__( 'Hot', 'omniverse' ),
		'type'        => 'color',
		'section'     => 'product_labels_section',
		'selector_bg' => '.product-labels .product-label.featured',
		'default'     => array(),
		'priority'    => 90,
		'class'       => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'hot_label_text_color',
		'name'     => esc_html__( '"Hot" label text color', 'omniverse' ),
		'group'    => esc_html__( 'Hot', 'omniverse' ),
		'type'     => 'color',
		'section'  => 'product_labels_section',
		'selector' => '.product-labels .product-label.featured',
		'default'  => array(),
		'priority' => 100,
		'class'    => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'          => 'stock_label_bg_color',
		'name'        => esc_html__( '"Out of stock" label background', 'omniverse' ),
		'group'       => esc_html__( 'Out of stock', 'omniverse' ),
		'type'        => 'color',
		'section'     => 'product_labels_section',
		'selector_bg' => '.product-labels .product-label.out-of-stock',
		'default'     => array(),
		'priority'    => 110,
		'class'       => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'stock_label_text_color',
		'name'     => esc_html__( '"Out of stock" label text color', 'omniverse' ),
		'group'    => esc_html__( 'Out of stock', 'omniverse' ),
		'type'     => 'color',
		'section'  => 'product_labels_section',
		'selector' => '.product-labels .product-label.out-of-stock',
		'default'  => array(),
		'priority' => 120,
		'class'    => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'          => 'attribute_label_bg_color',
		'name'        => esc_html__( '"Attribute" label background', 'omniverse' ),
		'group'       => esc_html__( 'Attribute', 'omniverse' ),
		'type'        => 'color',
		'section'     => 'product_labels_section',
		'selector_bg' => '.product-labels .product-label.attribute-label:not(.label-with-img)',
		'default'     => array(),
		'priority'    => 130,
		'class'       => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'       => 'attribute_label_text_color',
		'name'     => esc_html__( '"Attribute" label text color', 'omniverse' ),
		'group'    => esc_html__( 'Attribute', 'omniverse' ),
		'type'     => 'color',
		'section'  => 'product_labels_section',
		'selector' => '.product-labels .product-label.attribute-label:not(.label-with-img)',
		'default'  => array(),
		'priority' => 140,
		'class'    => 'dn-col-6',
	)
);

/**
 * Brands.
 */
Options::add_field(
	array(
		'id'           => 'brands_attribute',
		'name'         => esc_html__( 'Brand attribute', 'omniverse' ),
		'description'  => wp_kses( __( 'If you want to show brand image on your product page select desired attribute here. Read more information in our <a href="https://zynxsol.com/docs-topic/product-brands/" target="_blank">documentation</a>.', 'omniverse' ), true ),
		'type'         => 'select',
		'section'      => 'brands_section',
		'callback'     => 'omniverse_product_attributes_array',
		'priority'     => 10,
		'default'      => 'pa_brand',
		'empty_option' => true,
	)
);

Options::add_field(
	array(
		'id'          => 'product_page_brand',
		'name'        => esc_html__( 'Show brand on the single product page', 'omniverse' ),
		'description' => esc_html__( 'You can disable/enable product\'s brand image on the single page.', 'omniverse' ),
		'type'        => 'switcher',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'section'     => 'brands_section',
		'default'     => '1',
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'          => 'product_brand_location',
		'name'        => esc_html__( 'Brand position on the product page', 'omniverse' ),
		'description' => esc_html__( 'Select a position of the brand image on the single product page.', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'brands_section',
		'options'     => array(
			'about_title' => array(
				'name'  => esc_html__( 'Aligned on the right of the product title', 'omniverse' ),
				'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'brand-position-the-product-page-right.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'about_title',
			),
			'sidebar'     => array(
				'name'  => esc_html__( 'Sidebar', 'omniverse' ),
				'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'brand-position-the-product-page-sidebar.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'sidebar',
			),
		),
		'priority'    => 30,
		'default'     => 'about_title',
	)
);

Options::add_field(
	array(
		'id'          => 'brand_tab',
		'name'        => esc_html__( 'Show tab with brand information', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-tab-with-brand-information.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( ' If enabled you will see an additional tab with brand description on the single product page. Text will be taken from the "Description" field for each brand (attribute term).', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'brands_section',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'default'     => '1',
		'priority'    => 40,
	)
);

Options::add_field(
	array(
		'id'          => 'brand_tab_name',
		'name'        => esc_html__( 'Use brand name for tab title', 'omniverse' ),
		'description' => esc_html__( 'If you enable this option, the tab with the brand information will be called "About [Brand name]".', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'brands_section',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'default'     => false,
		'priority'    => 50,
		'requires'    => array(
			array(
				'key'     => 'brand_tab',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
	)
);

/**
 * Quick view.
 */
Options::add_field(
	array(
		'id'          => 'quick_view',
		'name'        => esc_html__( 'Quick view', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'shop-quick-view.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Enable Quick view option. Ability to see the product information with AJAX.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'quick_view_section',
		'default'     => '1',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'quick_view_layout',
		'name'        => esc_html__( 'Quick view layout', 'omniverse' ),
		'description' => esc_html__( 'Choose between horizontal and vertical layouts for the quick view window.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'quick_view_section',
		'default'     => 'horizontal',
		'options'     => array(
			'horizontal' => array(
				'name'  => esc_html__( 'Horizontal', 'omniverse' ),
				'value' => 'horizontal',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/quick-view-layout/horizontal.jpg',
			),
			'vertical'   => array(
				'name'  => esc_html__( 'Vertical', 'omniverse' ),
				'value' => 'vertical',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/quick-view-layout/vertical.jpg',
			),
		),
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'          => 'quickview_width',
		'name'        => esc_html__( 'Quick view width', 'omniverse' ),
		'description' => esc_html__( 'Set width of the quick view in pixels.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'range',
		'section'     => 'quick_view_section',
		'default'     => 920,
		'min'         => 400,
		'step'        => 10,
		'max'         => 1200,
		'priority'    => 30,
		'selectors'   => array(
			'div.wd-popup.popup-quick-view' => array(
				'max-width: {{VALUE}}px;',
			),
		),
		'unit'        => 'px',
	)
);

Options::add_field(
	array(
		'id'          => 'quick_view_variable',
		'name'        => esc_html__( 'Show variations on quick view', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-variations-on-quick-view.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Enable Quick view option for variable products. Will allow your users to purchase variable products directly from the quick view.', 'omniverse' ),
		'group'       => esc_html__( 'Settings', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'quick_view_section',
		'default'     => '1',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 40,
	)
);

/**
 * Compare.
 */
Options::add_field(
	array(
		'id'          => 'compare',
		'name'        => esc_html__( 'Enable compare', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'shop-compare.jpg" alt="">', 'omniverse' ), true ),
		'description' => wp_kses( __( 'Enable compare functionality built in with the theme. Read more information in our <a href="https://zynxsol.com/docs/omniverse/omniverse-compare/">documentation</a>.', 'omniverse' ), true ),
		'type'        => 'switcher',
		'section'     => 'compare_section',
		'default'     => '1',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'           => 'compare_page',
		'name'         => esc_html__( 'Compare page', 'omniverse' ),
		'description'  => esc_html__( 'Select a page for the compare table. It should contain the shortcode: [omniverse_compare]', 'omniverse' ),
		'type'         => 'select',
		'section'      => 'compare_section',
		'options'      => '',
		'callback'     => 'omniverse_get_pages_array',
		'empty_option' => true,
		'select2'      => true,
		'default'      => 265,
		'priority'     => 20,
	)
);

Options::add_field(
	array(
		'id'          => 'fields_compare',
		'name'        => esc_html__( 'Select fields for compare table', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'select-fields-for-compare-table.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Choose which fields should be presented on the product compare page with table.', 'omniverse' ),
		'type'        => 'select',
		'multiple'    => true,
		'select2'     => true,
		'section'     => 'compare_section',
		'callback'    => 'omniverse_compare_available_fields',
		'default'     => array(
			'description',
			'sku',
			'availability',
		),
		'priority'    => 30,
	)
);

Options::add_field(
	array(
		'id'          => 'empty_compare_text',
		'name'        => esc_html__( 'Empty compare text', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'empty-compare-text.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Text will be displayed if user don\'t add any products to compare', 'omniverse' ),
		'default'     => 'No products added in the compare list. You must add some products to compare them.<br> You will find a lot of interesting products on our "Shop" page.',
		'type'        => 'textarea',
		'wysiwyg'     => false,
		'section'     => 'compare_section',
		'priority'    => 40,
	)
);

Options::add_field(
	array(
		'id'          => 'compare_on_grid',
		'name'        => esc_html__( 'Show button on product grid', 'omniverse' ),
		'hint'        => '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-button-on-product-grid.jpg" alt="">',
		'group'       => esc_html__( 'Buttons', 'omniverse' ),
		'description' => esc_html__( 'Display compare product button on all products grids and lists.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'compare_section',
		'default'     => '1',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 45,
	)
);

Options::add_field(
	array(
		'id'       => 'compare_save_button_state',
		'type'     => 'switcher',
		'name'     => esc_html__( 'Save button state after adding in compare list', 'omniverse' ),
		'group'    => esc_html__( 'Buttons', 'omniverse' ),
		'section'  => 'compare_section',
		'default'  => '0',
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'priority' => 46,
	)
);

Options::add_field(
	array(
		'id'          => 'compare_by_category',
		'name'        => esc_html__( 'Enable compare by category', 'omniverse' ),
		'group'       => esc_html__( 'Compare by category', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'compare-by-category.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Group the products added to the compare list in order to compare them according to their categories.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'compare_section',
		'default'     => '0',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 50,
	)
);

Options::add_field(
	array(
		'id'          => 'show_more_products_btn',
		'name'        => esc_html__( 'Show "Compare more products" buttons', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-compare-more-products-buttons.jpg" alt="">', 'omniverse' ), true ),
		'group'       => esc_html__( 'Compare by category', 'omniverse' ),
		'description' => esc_html__( 'Display a button that leads to the selected category.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'compare_section',
		'default'     => '1',
		'requires'    => array(
			array(
				'key'     => 'compare_by_category',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 60,
	)
);

/**
 * Wishlist (60).
 */

/**
* Cart.
*/
Options::add_field(
	array(
		'id'          => 'update_cart_quantity_change',
		'name'        => esc_html__( 'Update cart on quantity change', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'update_cart_quantity_change.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'When this option is enabled the cart will be refreshed automatically when you increase/decrease the product quantity.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'cart_section',
		'default'     => false,
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'empty_cart_text',
		'name'        => esc_html__( 'Empty cart text', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'empty-cart-text.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Text will be displayed if user don\'t add any products to cart', 'omniverse' ),
		'type'        => 'textarea',
		'wysiwyg'     => false,
		'section'     => 'cart_section',
		'default'     => 'Before proceed to checkout you must add some products to your shopping cart.<br> You will find a lot of interesting products on our "Shop" page.',
		'priority'    => 20,
	)
);

/**
* Thank you page.
*/
Options::add_field(
	array(
		'id'       => 'thank_you_page_content_type',
		'name'     => esc_html__( 'Extra content for "Thank you page"', 'omniverse' ),
		'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'extra-content-for-thank-you-page.jpg" alt="">', 'omniverse' ), true ),
		'type'     => 'buttons',
		'section'  => 'thank_you_page_section',
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
		'priority' => 10,
		'class'    => 'dn-html-block-switch',
	)
);

Options::add_field(
	array(
		'id'       => 'thank_you_page_extra_content',
		'type'     => 'textarea',
		'wysiwyg'  => true,
		'name'     => esc_html__( 'Text', 'omniverse' ),
		'section'  => 'thank_you_page_section',
		'requires' => array(
			array(
				'key'     => 'thank_you_page_content_type',
				'compare' => 'equals',
				'value'   => 'text',
			),
		),
		'priority' => 20,
	)
);

Options::add_field(
	array(
		'id'           => 'thank_you_page_html_block',
		'type'         => 'select',
		'section'      => 'thank_you_page_section',
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
				'key'     => 'thank_you_page_content_type',
				'compare' => 'equals',
				'value'   => 'html_block',
			),
		),
		'priority'     => 30,
	)
);

Options::add_field(
	array(
		'id'          => 'thank_you_page_default_content',
		'name'        => esc_html__( 'Default "Thank you page" content', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'default-thank-you-page-content.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'If you use custom extra content you can disable default WooCommerce order details on the thank you page', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'thank_you_page_section',
		'default'     => '1',
		'priority'    => 40,
	)
);
