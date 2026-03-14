<?php

if ( ! function_exists( 'omniverse_get_sticky_toolbar_fields' ) ) {
	/**
	 * All available fields for Theme Settings sorter option.
	 *
	 * @since 3.6
	 */
	function omniverse_get_sticky_toolbar_fields( $new = false ) {

		if ( $new ) {
			$options = array(
				'shop' => array(
					'name'  => esc_html__( 'Shop page', 'omniverse' ),
					'value' => 'shop',
				),
				'sidebar' => array(
					'name'  => esc_html__( 'Off canvas sidebar', 'omniverse' ),
					'value' => 'sidebar',
				),
				'wishlist' => array(
					'name'  => esc_html__( 'Wishlist', 'omniverse' ),
					'value' => 'wishlist',
				),
				'cart' => array(
					'name'  => esc_html__( 'Cart', 'omniverse' ),
					'value' => 'cart',
				),
				'account' => array(
					'name'  => esc_html__( 'My account', 'omniverse' ),
					'value' => 'account',
				),
				'mobile' => array(
					'name'  => esc_html__( 'Mobile menu', 'omniverse' ),
					'value' => 'mobile',
				),
				'home' => array(
					'name'  => esc_html__( 'Home page', 'omniverse' ),
					'value' => 'home',
				),
				'blog' => array(
					'name'  => esc_html__( 'Blog page', 'omniverse' ),
					'value' => 'blog',
				),
				'compare' => array(
					'name'  => esc_html__( 'Compare', 'omniverse' ),
					'value' => 'compare',
				),
				'link_1' => array(
					'name'  => esc_html__( 'Button [1]', 'omniverse' ),
					'value' => 'link_1',
				),
				'link_2' => array(
					'name'  => esc_html__( 'Button [2]', 'omniverse' ),
					'value' => 'link_2',
				),
				'link_3' => array(
					'name'  => esc_html__( 'Button [3]', 'omniverse' ),
					'value' => 'link_3',
				),
				'link_4' => array(
					'name'  => esc_html__( 'Button [4]', 'omniverse' ),
					'value' => 'link_4',
				),
				'link_5' => array(
					'name'  => esc_html__( 'Button [5]', 'omniverse' ),
					'value' => 'link_5',
				),
			);

			if ( apply_filters( 'omniverse_toolbar_search', false ) ) {
				$options['search'] = array(
					'name'  => esc_html__( 'Search', 'omniverse' ),
					'value' => 'search',
				);
			}

			return $options;
		}

		$fields = array(
			'enabled'  => array(
				'shop'     => esc_html__( 'Shop page', 'omniverse' ),
				'sidebar'  => esc_html__( 'Off canvas sidebar', 'omniverse' ),
				'wishlist' => esc_html__( 'Wishlist', 'omniverse' ),
				'cart'     => esc_html__( 'Cart', 'omniverse' ),
				'account'  => esc_html__( 'My account', 'omniverse' ),
			),
			'disabled' => array(
				'mobile'   => esc_html__( 'Mobile menu', 'omniverse' ),
				'home'     => esc_html__( 'Home page', 'omniverse' ),
				'blog'     => esc_html__( 'Blog page', 'omniverse' ),
				'compare'  => esc_html__( 'Compare', 'omniverse' ),
				'link_1'   => esc_html__( 'Button [1]', 'omniverse' ),
				'link_2'   => esc_html__( 'Button [2]', 'omniverse' ),
				'link_3'   => esc_html__( 'Button [3]', 'omniverse' ),
				'link_4'   => esc_html__( 'Button [4]', 'omniverse' ),
				'link_5'   => esc_html__( 'Button [5]', 'omniverse' ),
			),
		);

		if ( apply_filters( 'omniverse_toolbar_search', false ) ) {
			$fields['disabled']['search'] = esc_html__( 'Search', 'omniverse' );
		}

		return $fields;
	}
}

if ( ! function_exists( 'omniverse_sticky_toolbar_template' ) ) {
	/**
	 * Sticky toolbar template
	 *
	 * @since 3.6
	 */
	function omniverse_sticky_toolbar_template() {
		if ( omniverse_is_maintenance_active() ) {
			return;
		}

		$fields  = omniverse_get_opt( 'sticky_toolbar_fields' );
		$classes = '';

		if ( isset( $fields['enabled']['placebo'] ) ) {
			unset( $fields['enabled']['placebo'] );
		}

		$enabled_fields = class_exists( 'DN\Admin\Modules\Options' ) ? $fields : $fields['enabled'];

		if ( ! omniverse_get_opt( 'sticky_toolbar' ) || ! $enabled_fields || is_admin() || defined( 'IFRAME_REQUEST' ) ) {
			return;
		}

		if ( omniverse_get_opt( 'sticky_toolbar_label' ) ) {
			$classes .= ' wd-toolbar-label-show';
			$classes .= omniverse_get_old_classes( ' omniverse-toolbar-label-show' );
		}

		omniverse_enqueue_inline_style( 'bottom-toolbar' );
		omniverse_enqueue_inline_style( 'header-elements-base' );

		$classes .= omniverse_get_old_classes( ' omniverse-toolbar' );

		?>
		<div class="wd-toolbar<?php echo esc_attr( $classes ); ?>">
			<?php
			foreach ( $enabled_fields as $key => $value ) {
				$key = class_exists( 'DN\Admin\Modules\Options' ) ? $value : $key;
				switch ( $key ) {
					case 'wishlist':
						omniverse_sticky_toolbar_wishlist_template();
						break;
					case 'cart':
						omniverse_sticky_toolbar_cart_template();
						break;
					case 'compare':
						omniverse_sticky_toolbar_compare_template();
						break;
					case 'search':
						omniverse_sticky_toolbar_search_template();
						break;
					case 'account':
						omniverse_sticky_toolbar_account_template();
						break;
					case 'mobile':
						omniverse_sticky_toolbar_mobile_menu_template();
						break;
					case 'sidebar':
						omniverse_sticky_sidebar_button( false, true );
						break;
					case 'link_1';
					case 'link_2';
					case 'link_3';
					case 'link_4';
					case 'link_5';
						omniverse_sticky_toolbar_custom_link_template( $key );
						break;
					case 'home';
					case 'blog';
					case 'shop':
						omniverse_sticky_toolbar_page_link_template( $key );
						break;
				}
			}
			?>
		</div>
		<?php

	}

	add_action( 'wp_footer', 'omniverse_sticky_toolbar_template' );
}

if ( ! function_exists( 'omniverse_sticky_toolbar_wishlist_template' ) ) {
	/**
	 * Sticky toolbar wishlist template
	 *
	 * @since 3.6
	 */
	function omniverse_sticky_toolbar_wishlist_template() {
		if ( ! omniverse_woocommerce_installed() || ! omniverse_get_opt( 'wishlist', 1 ) || ( omniverse_get_opt( 'wishlist_logged' ) && ! is_user_logged_in() ) ) {
			return;
		}

		$settings      = whb_get_settings();
		$product_count = false;
		$classes       = '';

		if ( isset( $settings['wishlist']['hide_product_count'] ) ) {
			$product_count = ! $settings['wishlist']['hide_product_count'];
		}

		if ( ! $product_count ) {
			$classes .= ' without-product-count';
		}

		omniverse_enqueue_js_script( 'wishlist' );

		?>
		<div class="wd-header-wishlist wd-tools-element wd-design-5<?php echo esc_attr( $classes ); ?>" title="<?php echo esc_attr__( 'My wishlist', 'omniverse' ); ?>">
			<a href="<?php echo esc_url( omniverse_get_wishlist_page_url() ); ?>">
				<span class="wd-tools-icon">
					<?php if ( $product_count ) : ?>
						<span class="wd-tools-count">
							<?php echo esc_html( omniverse_get_wishlist_count() ); ?>
						</span>
					<?php endif; ?>
				</span>
				<span class="wd-toolbar-label">
					<?php echo esc_html_x( 'Wishlist', 'toolbar', 'omniverse' ); ?>
				</span>
			</a>
		</div>
		<?php
	}
}

if ( ! function_exists( 'omniverse_sticky_toolbar_cart_template' ) ) {
	/**
	 * Sticky toolbar cart template
	 *
	 * @since 3.6
	 */
	function omniverse_sticky_toolbar_cart_template() {
		if ( ! omniverse_woocommerce_installed() || ( ! is_user_logged_in() && omniverse_get_opt( 'login_prices' ) ) ) {
			return;
		}

		$settings     = whb_get_settings();
		$opener       = false;
		$classes      = '';
		$icon_classes = ' wd-icon-alt';

		if ( isset( $settings['cart']['position'] ) ) {
			$opener = $settings['cart']['position'] == 'side';
		}

		if ( ! empty( $settings['cart']['icon_type'] ) && 'cart' === $settings['cart']['icon_type'] ) {
			$icon_classes = '';
		}

		if ( $opener ) {
			omniverse_enqueue_inline_style( 'header-cart-side' );

			$classes .= ' cart-widget-opener';
		}

		omniverse_enqueue_inline_style( 'header-cart' );

		$classes .= omniverse_get_old_classes( ' omniverse-shopping-cart' );

		?>
		<div class="wd-header-cart wd-tools-element wd-design-5<?php echo esc_attr( $classes ); ?>" title="<?php echo esc_attr__( 'My cart', 'omniverse' ); ?>">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
				<span class="wd-tools-icon<?php echo esc_attr( $icon_classes ); ?>">
					<?php omniverse_cart_count(); ?>
				</span>
				<span class="wd-toolbar-label">
					<?php esc_html_e( 'Cart', 'omniverse' ); ?>
				</span>
			</a>
		</div>
		<?php
	}
}


if ( ! function_exists( 'omniverse_sticky_toolbar_compare_template' ) ) {
	/**
	 * Sticky toolbar compare template
	 *
	 * @since 3.6
	 */
	function omniverse_sticky_toolbar_compare_template() {
		if ( ! omniverse_woocommerce_installed() || ! omniverse_get_opt( 'compare' ) ) {
			return;
		}

		$settings      = whb_get_settings();
		$product_count = false;
		$classes       = '';

		if ( isset( $settings['compare']['hide_product_count'] ) ) {
			$product_count = ! $settings['compare']['hide_product_count'];
		}

		if ( ! $product_count ) {
			$classes .= ' without-product-count';
		}

		?>
		<div class="wd-header-compare wd-tools-element wd-design-5<?php echo esc_attr( $classes ); ?>" title="<?php echo esc_attr__( 'Compare products', 'omniverse' ); ?>">
			<a href="<?php echo esc_url( omniverse_get_compare_page_url() ); ?>">
				<span class="wd-tools-icon">
					<?php if ( $product_count ) : ?>
						<span class="wd-tools-count"><?php echo omniverse_get_compare_count(); ?></span>
					<?php endif; ?>
				</span>
				<span class="wd-toolbar-label">
					<?php esc_html_e( 'Compare', 'omniverse' ); ?>
				</span>
			</a>
		</div>
		<?php
	}
}

if ( ! function_exists( 'omniverse_sticky_toolbar_search_template' ) ) {
	/**
	 * Sticky toolbar search template
	 *
	 * @since 3.6
	 */
	function omniverse_sticky_toolbar_search_template() {
		omniverse_enqueue_js_script( 'mobile-search' );
		?>
		<div class="wd-header-search wd-header-search-mobile<?php echo omniverse_get_old_classes( ' mobile-search-icon search-button' ); ?>">
			<a href="#" rel="nofollow" aria-label="<?php esc_html_e( 'Search', 'omniverse' ); ?>">
				<span class="wd-tools-icon<?php echo omniverse_get_old_classes( ' search-button-icon' ); ?>"></span>
				<span class="wd-toolbar-label">
					<?php esc_html_e( 'Search', 'omniverse' ); ?>
				</span>
			</a>
		</div>
		<?php
	}
}

if ( ! function_exists( 'omniverse_sticky_toolbar_account_template' ) ) {
	/**
	 * Sticky toolbar account template
	 *
	 * @since 3.6
	 */
	function omniverse_sticky_toolbar_account_template() {
		if ( ! omniverse_woocommerce_installed() ) {
			return;
		}

		$settings = whb_get_settings();
		$is_side  = isset( $settings['account'] ) && 'side' === $settings['account']['form_display'] && $settings['account']['login_dropdown'];
		$classes  = '';

		if ( ! is_user_logged_in() && $is_side ) {
			omniverse_enqueue_js_script( 'login-sidebar' );
			$classes .= ' login-side-opener';
		}

		omniverse_enqueue_inline_style( 'header-my-account' );

		?>
		<div class="wd-header-my-account wd-tools-element wd-style-icon <?php echo esc_attr( $classes ); ?>">
			<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
				<span class="wd-tools-icon"></span>
				<span class="wd-toolbar-label">
					<?php echo esc_html_x( 'My account', 'toolbar', 'omniverse' ); ?>
				</span>
			</a>
		</div>
		<?php
	}
}

if ( ! function_exists( 'omniverse_sticky_toolbar_page_link_template' ) ) {
	/**
	 * Sticky toolbar page link template
	 *
	 * @since 3.6
	 */
	function omniverse_sticky_toolbar_page_link_template( $key ) {
		$url = '';

		switch ( $key ) {
			case 'blog':
				$url  = get_permalink( get_option( 'page_for_posts' ) );
				$text = esc_html__( 'Blog', 'omniverse' );
				break;
			case 'home':
				$url  = get_home_url();
				$text = esc_html__( 'Home', 'omniverse' );
				break;
			case 'shop':
				$url  = omniverse_woocommerce_installed() ? get_permalink( wc_get_page_id( 'shop' ) ) : get_home_url();
				$text = esc_html__( 'Shop', 'omniverse' );
				break;
		}

		$classes = '';

		$classes .= omniverse_get_old_classes( ' omniverse-toolbar-' . $key );
		$classes .= omniverse_get_old_classes( ' omniverse-toolbar-item' );

		?>
		<div class="wd-toolbar-<?php echo esc_attr( $key ); ?> wd-toolbar-item wd-tools-element<?php echo esc_attr( $classes ); ?>">
			<a href="<?php echo esc_url( $url ); ?>">
				<span class="wd-tools-icon"></span>
				<span class="wd-toolbar-label">
					<?php echo $text; ?>
				</span>
			</a>
		</div>
		<?php
	}
}

if ( ! function_exists( 'omniverse_sticky_toolbar_custom_link_template' ) ) {
	/**
	 * Sticky toolbar custom link template
	 *
	 * @since 3.6
	 *
	 * @param string $key Key.
	 */
	function omniverse_sticky_toolbar_custom_link_template( $key ) {
		omniverse_lazy_loading_deinit( true );

		$wrapper_classes = '';
		$url             = omniverse_get_opt( $key . '_url' );
		$text            = omniverse_get_opt( $key . '_text' );
		$icon            = omniverse_get_opt( $key . '_icon' );

		$wrapper_classes .= isset( $icon['id'] ) && $icon['id'] ? ' wd-tools-custom-icon' : '';

		$wrapper_classes .= omniverse_get_old_classes( ' omniverse-toolbar-item omniverse-toolbar-link' );

		?>
		<?php if ( $url && $text ) : ?>
			<div class="wd-toolbar-link wd-tools-element wd-toolbar-item<?php echo esc_attr( $wrapper_classes ); ?>">
				<a href="<?php echo esc_url( $url ); ?>">
					<span class="wd-toolbar-icon wd-tools-icon wd-icon wd-custom-icon">
						<?php if ( isset( $icon['id'] ) && $icon['id'] ) : ?>
							<?php echo wp_get_attachment_image( $icon['id'] ); ?>
						<?php endif; ?>
					</span>

					<span class="wd-toolbar-label">
						<?php echo esc_html( $text ); ?>
					</span>
				</a>
			</div>
		<?php endif; ?>
		<?php

		omniverse_lazy_loading_init();
	}
}

if ( ! function_exists( 'omniverse_sticky_toolbar_mobile_menu_template' ) ) {
	/**
	 * Sticky toolbar mobile menu template
	 *
	 * @since 3.6
	 */
	function omniverse_sticky_toolbar_mobile_menu_template() {
		?>
		<div class="wd-header-mobile-nav whb-wd-header-mobile-nav mobile-style-icon wd-tools-element<?php echo omniverse_get_old_classes( ' omniverse-burger-icon' ); ?>">
			<a href="#" rel="nofollow">
				<span class="wd-tools-icon<?php echo omniverse_get_old_classes( ' omniverse-burger' ); ?>"></span>
				<span class="wd-toolbar-label">
					<?php esc_html_e( 'Menu', 'omniverse' ); ?>
				</span>
			</a>
		</div>
		<?php
	}
}
