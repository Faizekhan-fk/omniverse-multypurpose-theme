<?php
/**
 * Register vc elements maps.
 *
 * @package Omniverse
 */

if ( ! function_exists( 'omniverse_vc_register_maps' ) ) {
	function omniverse_vc_register_maps() {
		if ( ! omniverse_is_core_installed() ) {
			return;
		}

		$maps = array(
			'omniverse_3d_view'                   => 'omniverse_get_vc_map_3d_view',
			'omniverse_accordion'                 => 'omniverse_get_vc_map_accordion',
			'omniverse_accordion_item'            => 'omniverse_get_vc_map_accordion_item',
			'products_tabs'                      => 'omniverse_get_vc_map_products_tabs',
			'products_tab'                       => 'omniverse_get_vc_map_products_tab',
			'omniverse_ajax_search'               => 'omniverse_get_vc_map_ajax_search',
			'omniverse_counter'                   => 'omniverse_get_vc_map_animated_counter',
			'author_area'                        => 'omniverse_get_vc_map_author_area',
			'banners_carousel'                   => 'omniverse_get_vc_map_banners_carousel',
			'omniverse_blog'                      => 'omniverse_get_vc_map_blog',
			'omniverse_brands'                    => 'omniverse_get_vc_map_brands',
			'omniverse_button'                    => 'omniverse_get_omniverse_button_shortcode_args',
			'omniverse_compare'                   => 'omniverse_get_vc_shortcode_compare',
			'omniverse_countdown_timer'           => 'omniverse_get_vc_map_countdown_timer',
			'extra_menu'                         => 'omniverse_get_vc_map_extra_menu',
			'extra_menu_list'                    => 'omniverse_get_vc_map_extra_menu_list',
			'omniverse_google_map'                => 'omniverse_get_vc_map_google_map',
			'html_block'                         => 'omniverse_get_vc_map_html_block',
			'omniverse_image'                     => 'omniverse_get_vc_map_image',
			'omniverse_image_hotspot'             => 'omniverse_get_vc_map_image_hotspot',
			'omniverse_hotspot'                   => 'omniverse_get_vc_map_hotspot',
			'omniverse_gallery'                   => 'omniverse_get_vc_map_gallery',
			'omniverse_info_box'                  => 'omniverse_get_omniverse_info_box_shortcode_args',
			'omniverse_info_box_carousel'         => 'omniverse_get_vc_map_info_box_carousel',
			'omniverse_instagram'                 => 'omniverse_get_vc_map_instagram',
			'omniverse_list'                      => 'omniverse_get_vc_map_list',
			'omniverse_mailchimp'                 => 'omniverse_get_vc_map_mailchimp',
			'omniverse_marquee'                   => 'omniverse_get_vc_map_marquee',
			'omniverse_mega_menu'                 => 'omniverse_get_vc_map_mega_menu',
			'omniverse_menu_price'                => 'omniverse_get_vc_map_menu_price',
			'omniverse_nested_carousel'           => 'omniverse_get_vc_map_nested_carousel',
			'omniverse_nested_carousel_item'      => 'omniverse_get_vc_map_nested_carousel_item',
			'omniverse_off_canvas_btn'            => 'omniverse_get_vc_map_off_canvas_btn',
			'omniverse_open_street_map'           => 'omniverse_get_vc_map_open_street_map',
			'omniverse_popup'                     => 'omniverse_get_vc_map_popup',
			'omniverse_portfolio'                 => 'omniverse_get_vc_map_portfolio',
			'pricing_tables'                     => 'omniverse_get_vc_map_pricing_tables',
			'pricing_plan'                       => 'omniverse_get_vc_map_pricing_plan',
			'omniverse_categories'                => 'omniverse_get_vc_shortcode_categories',
			'omniverse_product_filters'           => 'omniverse_get_vc_map_product_filters',
			'omniverse_products'                  => 'omniverse_get_products_shortcode_map_params',
			'omniverse_filter_categories'         => 'omniverse_get_vc_map_filter_categories',
			'omniverse_filters_attribute'         => 'omniverse_get_vc_map_filters_attribute',
			'omniverse_stock_status'              => 'omniverse_get_vc_map_stock_status',
			'omniverse_filters_price_slider'      => 'omniverse_get_vc_map_filters_price_slider',
			'omniverse_filters_orderby'           => 'omniverse_get_vc_map_filters_orderby',
			'promo_banner'                       => 'omniverse_get_vc_map_promo_banner',
			'omniverse_responsive_text_block'     => 'omniverse_get_vc_map_responsive_text_block',
			'omniverse_row_divider'               => 'omniverse_get_vc_map_row_divider',
			'omniverse_title'                     => 'omniverse_get_vc_map_title',
			'omniverse_sidebar'                   => 'omniverse_get_vc_map_sidebar',
			'omniverse_size_guide'                => 'omniverse_get_vc_map_size_guide',
			'omniverse_slider'                    => 'omniverse_get_vc_map_slider',
			'social_buttons'                     => 'omniverse_get_social_buttons_shortcode_args',
			'omniverse_table'                     => 'omniverse_get_vc_map_table',
			'omniverse_table_row'                 => 'omniverse_get_vc_map_table_row',
			'omniverse_tabs'                      => 'omniverse_get_vc_map_tabs',
			'omniverse_tab'                       => 'omniverse_get_vc_map_tab',
			'team_member'                        => 'omniverse_get_vc_map_team_member',
			'testimonials'                       => 'omniverse_get_vc_map_testimonials',
			'testimonial'                        => 'omniverse_get_vc_map_testimonial',
			'omniverse_text_block'                => 'omniverse_get_vc_map_text_block',
			'omniverse_timeline'                  => 'omniverse_get_vc_map_timeline',
			'omniverse_timeline_item'             => 'omniverse_get_vc_map_timeline_item',
			'omniverse_timeline_breakpoint'       => 'omniverse_get_vc_map_timeline_breakpoint',
			'omniverse_twitter'                   => 'omniverse_get_vc_map_twitter',
			'omniverse_video'                     => 'omniverse_get_vc_map_video',
			'omniverse_shortcode_products_widget' => 'omniverse_get_vc_map_shortcode_products_widget',
			'omniverse_wishlist'                  => 'omniverse_get_vc_map_wishlist',
		);

		if ( ! omniverse_woocommerce_installed() ) {
			$woo_maps = array(
				'products_tabs'                      => 'omniverse_get_vc_map_products_tabs',
				'products_tab'                       => 'omniverse_get_vc_map_products_tab',
				'omniverse_brands'                    => 'omniverse_get_vc_map_brands',
				'omniverse_categories'                => 'omniverse_get_vc_shortcode_categories',
				'omniverse_product_filters'           => 'omniverse_get_vc_map_product_filters',
				'omniverse_products'                  => 'omniverse_get_products_shortcode_map_params',
				'omniverse_filter_categories'         => 'omniverse_get_vc_map_filter_categories',
				'omniverse_filters_attribute'         => 'omniverse_get_vc_map_filters_attribute',
				'omniverse_stock_status'              => 'omniverse_get_vc_map_stock_status',
				'omniverse_filters_price_slider'      => 'omniverse_get_vc_map_filters_price_slider',
				'omniverse_filters_orderby'           => 'omniverse_get_vc_map_filters_orderby',
				'omniverse_shortcode_products_widget' => 'omniverse_get_vc_map_shortcode_products_widget',
			);

			$maps = array_diff( $maps, $woo_maps );
		}

		if ( ! omniverse_get_opt( 'portfolio', '1' ) ) {
			$maps = array_diff( $maps, array( 'omniverse_portfolio' => 'omniverse_get_vc_map_portfolio' ) );
		}

		foreach ( $maps as $key => $callback ) {
			omniverse_vc_map( $key, $callback );
		}
	}

	add_action( 'vc_mapper_init_after', 'omniverse_vc_register_maps' );
}
