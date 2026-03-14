<?php
/**
 * This is Wishlist options file for Theme Options.
 *
 * @package Omniverse.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use DN\Admin\Modules\Options;

Options::add_field(
	array(
		'id'          => 'wishlist',
		'type'        => 'switcher',
		'name'        => esc_html__( 'Enable wishlist', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'shop-wishlist.jpg" alt="">', 'omniverse' ), true ),
		'description' => wp_kses( __( 'Enable wishlist functionality built in with the theme. Read more information in our <a href="https://zynxsol.com/docs/omniverse/omniverse-wishlist/">documentation</a>.', 'omniverse' ), true ),
		'section'     => 'wishlist_section',
		'default'     => '1',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'           => 'wishlist_page',
		'type'         => 'select',
		'name'         => esc_html__( 'Wishlist page', 'omniverse' ),
		'description'  => esc_html__( 'Select a page for the wishlist table. It should contain the shortcode: [omniverse_wishlist]', 'omniverse' ),
		'section'      => 'wishlist_section',
		'empty_option' => true,
		'select2'      => true,
		'options'      => '',
		'callback'     => 'omniverse_get_pages_array',
		'default'      => 267,
		'priority'     => 20,
	)
);

Options::add_field(
	array(
		'id'          => 'wishlist_logged',
		'type'        => 'switcher',
		'name'        => esc_html__( 'Only for logged in', 'omniverse' ),
		'description' => esc_html__( 'Disable wishlist for guests customers.', 'omniverse' ),
		'section'     => 'wishlist_section',
		'default'     => '0',
		'priority'    => 30,
	)
);

Options::add_field(
	array(
		'id'          => 'wishlist_bulk_action',
		'type'        => 'switcher',
		'name'        => esc_html__( 'Bulk actions', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'bulk-action-move-or-remove-to-wishlist.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Enable the ability to bulk move or remove products in the wishlist.', 'omniverse' ),
		'section'     => 'wishlist_section',
		'default'     => '1',
		'priority'    => 40,
	)
);

Options::add_field(
	array(
		'id'          => 'wishlist_empty_text',
		'type'        => 'textarea',
		'name'        => esc_html__( 'Empty wishlist text', 'omniverse' ),
		'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'empty-wishlist-text.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Text will be displayed if user don\'t add any products to wishlist.', 'omniverse' ),
		'section'     => 'wishlist_section',
		'wysiwyg'     => false,
		'default'     => 'You don\'t have any products in the wishlist yet. <br> You will find a lot of interesting products on our "Shop" page.',
		'priority'    => 50,
	)
);

Options::add_field(
	array(
		'id'          => 'wishlist_expanded',
		'type'        => 'switcher',
		'name'        => esc_html__( 'Enable multiple wishlists', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'multiple-wishlists.mp4" autoplay loop muted></video>',
		'group'       => esc_html__( 'Multiple wishlists', 'omniverse' ),
		'description' => esc_html__( 'Allows customers to organize favorite products into multiple wishlists based on their interest', 'omniverse' ),
		'section'     => 'wishlist_section',
		'default'     => '0',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 60,
	)
);

Options::add_field(
	array(
		'id'       => 'wishlist_show_popup',
		'name'     => esc_html__( 'Show wishlists popup', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'add-to-wishlist-popup.mp4" autoplay loop muted></video>',
		'group'    => esc_html__( 'Multiple wishlists', 'omniverse' ),
		'type'     => 'buttons',
		'section'  => 'wishlist_section',
		'options'  => array(
			'disable'  => array(
				'name'  => esc_html__( 'Never', 'omniverse' ),
				'value' => 'disable',
			),
			'enable'   => array(
				'name'  => esc_html__( 'Always', 'omniverse' ),
				'value' => 'enable',
			),
			'more_one' => array(
				'name'  => esc_html__( 'If more than one wishlist', 'omniverse' ),
				'value' => 'more_one',
			),
		),
		'default'  => 'enable',
		'priority' => 70,
		'requires' => array(
			array(
				'key'     => 'wishlist_expanded',
				'compare' => 'equals',
				'value'   => true,
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'product_loop_wishlist',
		'type'        => 'switcher',
		'name'        => esc_html__( 'Show button on products in loop', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-button-on-products-in-loop.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Display wishlist product button on all products grids and lists.', 'omniverse' ),
		'group'       => esc_html__( 'Buttons', 'omniverse' ),
		'section'     => 'wishlist_section',
		'default'     => '1',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 80,
	)
);

Options::add_field(
	array(
		'id'          => 'wishlist_save_button_state',
		'type'        => 'switcher',
		'name'        => esc_html__( 'Save button state after adding to the wishlist', 'omniverse' ),
		'description' => esc_html__( 'You can enable this option to show the "Browse wishlist" button when you visit the product that has been already added to the wishlist.  IMPORTANT: It will not work if you use some full-page cache like WP Rocket or WP Total Cache.', 'omniverse' ),
		'group'       => esc_html__( 'Buttons', 'omniverse' ),
		'section'     => 'wishlist_section',
		'default'     => '0',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 90,
	)
);