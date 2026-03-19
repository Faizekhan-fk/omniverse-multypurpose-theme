<?php

if ( ! defined('OMNIVERSE_THEME_DIR')) exit('No direct script access allowed');

add_option( 'omniverse-generated-wpbcss-file' );
add_option( 'omniverse_is_activated' );
add_option( 'dn-theme_settings_default-file-data' );
add_option( 'dn-options-presets' );
add_option( 'dn-omniverse-options' );
add_option( 'omniverse_setup_status' );
add_option( 'wd_import_theme_version' );

if ( ! function_exists( 'omniverse_gallery_shortcode_add_scripts_styles' ) ) {
	/**
	 * Add scripts and styles to default gallery shortcode.
	 *
	 * @param string $output Gallery styles.
	 *
	 * @return string
	 */
	function omniverse_gallery_shortcode_add_scripts_styles( $output ) {
		omniverse_enqueue_js_library( 'magnific' );
		omniverse_enqueue_js_script( 'mfp-popup' );

		ob_start();
		omniverse_enqueue_inline_style( 'mfp-popup' );
		$style = ob_get_clean();

		return $style . $output;
	}

	add_filter( 'gallery_style', 'omniverse_gallery_shortcode_add_scripts_styles' );
}
/**
 * ------------------------------------------------------------------------------------------------
 * Set up theme default and register various supported features
 * ------------------------------------------------------------------------------------------------
 */
if( ! function_exists( 'omniverse_theme_setup' ) ) {
	function omniverse_theme_setup() {
		/**
		 * Add support for post formats
		 */
		add_theme_support( 'post-formats', 
			array(
				'video', 
				'audio', 
				'quote', 
				'image', 
				'gallery', 
				'link'
			) 
		);
	
		/**
		 * Add support for automatic feed links
		 */
		add_theme_support( 'automatic-feed-links' );	

		/**
		 * Add support for post thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add support for post title tag
		 */
		add_theme_support( "title-tag" );

		add_theme_support(
			'html5',
			array(
				'comment-form',
			)
		);

		/**
		 * Register nav menus
		 */
		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main Menu', 'omniverse' ),
			'mobile-menu' => esc_html__( 'Mobile Side Menu', 'omniverse' ),
		) );

		add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );

		if ( omniverse_get_opt( 'load_text_domain', true ) ) {
			/**
			 * Make the theme available for translations.
			 */
			$lang_dir = OMNIVERSE_THEMEROOT . '/languages';
			load_theme_textdomain( 'omniverse', $lang_dir );
		}
	}

	add_action( 'after_setup_theme', 'omniverse_theme_setup' );
}


/**
 * ------------------------------------------------------------------------------------------------
 * Disable emoji styles
 * ------------------------------------------------------------------------------------------------
 */

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
/**
 * ------------------------------------------------------------------------------------------------
  * Allow SVG logo
 * ------------------------------------------------------------------------------------------------
 */

if( ! function_exists( 'omniverse_upload_mimes' ) ) {
	add_filter( 'upload_mimes', 'omniverse_upload_mimes', 100, 1 );
	function omniverse_upload_mimes( $mimes ) {
		if ( omniverse_get_opt( 'allow_upload_svg' ) ) {
			$mimes['svg'] = 'image/svg+xml';
			$mimes['svgz'] = 'image/svg+xml';
		}
//		$mimes['woff'] = 'font/woff';
//		$mimes['woff2'] = 'font/woff2';
		$mimes['ttf'] = 'font/ttf';
		$mimes['eot'] = 'font/eot';
		// $mimes['svg'] = 'font/svg';
		$mimes['woff'] = 'application/x-font-woff';
		$mimes['woff2'] = 'application/x-font-woff2';
		//$mimes['ttf'] = 'application/x-font-ttf';
		//$mimes['eot'] = 'application/vnd.ms-fontobject';
		return $mimes;
	}
}


/**
 * ------------------------------------------------------------------------------------------------
 * Register the widget areas
 * ------------------------------------------------------------------------------------------------
 */
if( ! function_exists( 'omniverse_widget_init' ) ) {
	function omniverse_widget_init() {
		if( function_exists( 'register_sidebar' ) ) {
			$widget_class = ( omniverse_get_opt( 'widget_toggle' ) ) ? ' widget-hidable' : '';

			$before_title = '<' . omniverse_get_widget_title_tag() . ' class="widget-title">';
			$after_title  = '</' . omniverse_get_widget_title_tag() . '>';

			register_sidebar( 
				array(
					'name'          => esc_html__( 'Main Widget Area', 'omniverse' ),
					'id'            => 'sidebar-1',
					'description'   => esc_html__( 'Default Widget Area for posts and pages', 'omniverse' ),
					'class'         => '',
					'before_widget' => '<div id="%1$s" class="wd-widget widget sidebar-widget' . $widget_class . ' %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => $before_title,
					'after_title'   => $after_title,
				)
			);

			if ( omniverse_get_opt( 'portfolio', '1' ) ) {
				register_sidebar(
					array(
						'name'          => esc_html__( 'Portfolio Widget Area', 'omniverse' ),
						'id'            => 'portfolio-widgets-area',
						'description'   => esc_html__( 'Default Widget Area for projects', 'omniverse' ),
						'class'         => '',
						'before_widget' => '<div id="%1$s" class="wd-widget widget sidebar-widget' . $widget_class . ' %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => $before_title,
						'after_title'   => $after_title,
					)
				);
			}

			if ( omniverse_woocommerce_installed() ) {
				$sidebar_shop_classes = '';

				if ( 'all' === omniverse_get_opt( 'shop_widgets_collapse' ) ) {
					$sidebar_shop_classes .= ' wd-widget-collapse';
				}

				register_sidebar( 
					array(
						'name'          => esc_html__( 'Shop page Widget Area', 'omniverse' ),
						'id'            => 'sidebar-shop',
						'description'   => esc_html__( 'Widget Area for shop pages', 'omniverse' ),
						'class'         => '',
						'before_widget' => '<div id="%1$s" class="wd-widget widget sidebar-widget' . $widget_class . $sidebar_shop_classes . ' %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => $before_title,
						'after_title'   => $after_title,
					)
				);
				register_sidebar( 
					array(
						'name'          => esc_html__( 'Shop filters', 'omniverse' ),
						'id'            => 'filters-area',
						'description'   => esc_html__( 'Widget Area for shop filters above the products', 'omniverse' ),
						'class'         => '',
						'before_widget' => '<div id="%1$s" class="wd-widget widget filter-widget wd-col' . $widget_class . ' %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => $before_title,
						'after_title'   => $after_title,
					)
				);
				register_sidebar( 
					array(
						'name'          => esc_html__( 'Single product page Widget Area', 'omniverse' ),
						'id'            => 'sidebar-product-single',
						'description'   => esc_html__( 'Widget Area for single product page', 'omniverse' ),
						'class'         => '',
						'before_widget' => '<div id="%1$s" class="wd-widget widget sidebar-widget' . $widget_class . ' %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => $before_title,
						'after_title'   => $after_title,
					)
				);
				
				register_sidebar( 
					array(
						'name'          => esc_html__( 'My Account pages sidebar', 'omniverse' ),
						'id'            => 'sidebar-my-account',
						'description'   => esc_html__( 'Widget Area for My Account, orders and other user pages.', 'omniverse' ),
						'class'         => '',
						'before_widget' => '<div id="%1$s" class="wd-widget widget sidebar-widget' . $widget_class . ' widget-my-account %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => $before_title,
						'after_title'   => $after_title,
					)
				);
			}

			register_sidebar(
				array(
					'name'          => esc_html__( 'Full Screen Menu Area', 'omniverse' ),
					'id'            => 'sidebar-full-screen-menu',
					'description'   => esc_html__( 'Widget Area for full screen menu', 'omniverse' ),
					'class'         => '',
					'before_widget' => '<div id="%1$s" class="wd-widget widget full-screen-menu-widget' . $widget_class . ' %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => $before_title,
					'after_title'   => $after_title,
				)
			);

			register_sidebar( 
				array(
					'name'          => esc_html__( 'Area after the mobile menu', 'omniverse' ),
					'id'            => 'mobile-menu-widgets',
					'description'   => esc_html__( 'Place your widgets that will be displayed after the mobile menu links', 'omniverse' ),
					'class'         => '',
					'before_widget' => '<div id="%1$s" class="wd-widget widget mobile-menu-widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => $before_title,
					'after_title'   => $after_title,
				)
			);

			$footer_layout = omniverse_get_opt( 'footer-layout' );

			$footer_classes = '';

			if ( omniverse_get_opt( 'collapse_footer_widgets' ) ) {
				$footer_classes .= omniverse_get_old_classes( ' footer-widget-collapse' );
			}

			$footer_config = omniverse_get_footer_config( $footer_layout );

			if( count( $footer_config['cols'] ) > 0 ) {
				foreach ( $footer_config['cols'] as $key => $columns ) {
					$index = $key + 1;
					register_sidebar( 
						array(
							'name'          => 'Footer Column ' . $index,
							'id'            => 'footer-'.$index,
							'description'   => 'Footer column',
							'class'         => '',
							'before_widget' => '<div id="%1$s" class="wd-widget widget footer-widget ' . esc_attr( $footer_classes ) . ' %2$s">',
							'after_widget'  => '</div>',
							'before_title'  => $before_title,
							'after_title'   => $after_title,
						)
					);
				}
			}

			$custom_sidebars = get_posts(
				array(
					'post_type'      => 'omniverse_sidebar',
					'post_status'    => 'publish',
					'posts_per_page' => -1,
				)
			);

			foreach ( $custom_sidebars as $sidebar ) {
				register_sidebar( 
					array(
						'name'          => $sidebar->post_title,
						'id'            => 'sidebar-' . $sidebar->ID,
						'description'   => '',
						'class'         => '',
						'before_widget' => '<div id="%1$s" class="wd-widget widget sidebar-widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => $before_title,
						'after_title'   => $after_title,
					)
				);
			}
		}
	}

	add_action( 'widgets_init', 'omniverse_widget_init' );
}


/**
 * ------------------------------------------------------------------------------------------------
 * Register plugins necessary for theme
 * ------------------------------------------------------------------------------------------------
 */

if( ! function_exists( 'omniverse_register_required_plugins' ) ) {
	function omniverse_register_required_plugins() {

	    $plugins = array(

	        // This is an example of how to include a plugin pre-packaged with a theme.

	        array(
	            'name'               => 'LearnPress', // The plugin name.
	            'slug'               => 'learnpress', // The plugin slug (typically the folder name).
	            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
	        ),
			array(
	            'name'               => 'Elementor', // The plugin name.
	            'slug'               => 'elementor', // The plugin slug (typically the folder name).
	            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
	        ),
	        array(
	            'name'               => 'WPBakery Page Builder', // The plugin name.
	            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
	            'source'             => OMNIVERSE_PLUGINS_URL . 'js_composer.zip', // The plugin source.
	            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
	            'version'            => get_option( 'omniverse_js_composer_version', '6.4.1' ), // E.g. 1.0.0. If set, the active plugin must be this version or higher.
	            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
	            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
	            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
	        ),

	        array(
	            'name'               => 'Omniverse Core', // The plugin name.
	            'slug'               => 'omniverse-core', // The plugin slug (typically the folder name).
	            'source'             => OMNIVERSE_PLUGINS_URL . 'omniverse-core.zip', // The plugin source.
	            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
	            'version'            => OMNIVERSE_CORE_VERSION, // E.g. 1.0.0. If set, the active plugin must be this version or higher.
	            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
	            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
	            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
	        ),

			array(
	            'name'      => 'WooCommerce',
	            'slug'      => 'woocommerce',
	            'required'  => false,
	        ),

	        array(
	            'name'      => 'Contact Form 7',
	            'slug'      => 'contact-form-7',
	            'required'  => false,
			),
			
			array(
	            'name'      => 'Safe SVG',
	            'slug'      => 'safe-svg',
	            'required'  => false,
	        ),

	        array(
	            'name'      => 'MailChimp for WordPress',
	            'slug'      => 'mailchimp-for-wp',
	            'required'  => false,
	        ),
	    );

		if ( ! empty( get_option( 'wd_import_theme_version' ) ) && ! empty( omniverse_get_current_page_builder() ) ) {
			$plugins = array_filter(
				$plugins,
				function( $plugin ) {
					$remove_builder_slug = 'wpb' === omniverse_get_current_page_builder() ? 'elementor' : 'js_composer';
					return $remove_builder_slug !== $plugin['slug'] ? $plugin : '';
				}
			);
		}

	    $config = apply_filters( 'omniverse_tgmpa_configs_plugins', array(
	        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
	        'menu'         => 'tgmpa-install-plugins', // Menu slug.
	        'has_notices'  => true,                    // Show admin notices or not.
	        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
	        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
	        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
	        'message'      => '',                      // Message to output right before the plugins table.
	        'strings'      => array(
	            'page_title'                      => esc_html__( 'Install Required Plugins', 'omniverse' ),
	            'menu_title'                      => esc_html__( 'Install Plugins', 'omniverse' ),
	            'installing'                      => 'Installing Plugin: %s', // %s = plugin name.
	            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'omniverse' ),
	            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'omniverse' ), // %1$s = plugin name(s).
	            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'omniverse' ), // %1$s = plugin name(s).
	            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'omniverse' ), // %1$s = plugin name(s).
	            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'omniverse' ), // %1$s = plugin name(s).
	            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'omniverse' ), // %1$s = plugin name(s).
	            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'omniverse' ), // %1$s = plugin name(s).
	            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'omniverse' ), // %1$s = plugin name(s).
	            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'omniverse' ), // %1$s = plugin name(s).
	            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'omniverse' ),
	            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'omniverse' ),
	            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'omniverse' ),
	            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'omniverse' ),
	            'complete'                        => 'All plugins installed and activated successfully. %s', // %s = dashboard link.
	            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
	        )
	    )
		);

	    tgmpa( $plugins, $config );

	}

	add_action( 'tgmpa_register', 'omniverse_register_required_plugins' );
}

// **********************************************************************//
// ! Theme 3d plugins
// **********************************************************************//

	if( ! function_exists( 'omniverse_3d_plugins' )) {
		function omniverse_3d_plugins() {
			if( function_exists( 'set_revslider_as_theme' ) ){
				set_revslider_as_theme();
			}
		}

		add_action( 'init', 'omniverse_3d_plugins' );
	}

	if( ! function_exists( 'omniverse_vcSetAsTheme' ) ) {

		function omniverse_vcSetAsTheme() {
			if( function_exists( 'vc_set_as_theme' ) ){
				vc_set_as_theme();
			}
		}

		add_action( 'vc_before_init', 'omniverse_vcSetAsTheme' );
	}

