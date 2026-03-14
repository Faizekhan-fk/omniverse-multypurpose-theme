<?php
/**
 * Helpers.
 *
 * @package Omniverse
 */

if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

use DN\Config;
use DN\Modules\Layouts\Main as Builder;

if ( ! function_exists( 'omniverse_is_core_installed' ) ) {
	function omniverse_is_core_installed() {
		return defined( 'OMNIVERSE_CORE_PLUGIN_VERSION' );
	}
}

if ( ! function_exists( 'wd_array_unique_recursive' ) ) {
	function wd_array_unique_recursive( $array ) {
		$scalars = array();
		foreach ( $array as $key => $value ) {
			if ( is_scalar( $value ) ) {
				if ( isset( $scalars[ $value ] ) ) {
					unset( $array[ $key ] );
				} else {
					$scalars[ $value ] = true;
				}
			} elseif ( is_array( $value ) ) {
				$array[ $key ] = wd_array_unique_recursive( $value );
			}
		}

		return $array;
	}
}

if ( ! function_exists( 'wd_add_cssclass' ) ) {
	/**
	 * Adds a CSS class to a string.
	 *
	 * @since 2.7.0
	 *
	 * @param  string  $class_to_add  The CSS class to add.
	 * @param  string  $classes  The string to add the CSS class to.
	 *
	 * @return string The string with the CSS class added.
	 */
	function wd_add_cssclass( $class_to_add, $classes ) {
		if ( empty( $classes ) ) {
			return $class_to_add;
		}

		return $classes . ' ' . $class_to_add;
	}
}

if ( ! function_exists( 'str_contains' ) ) {
	/**
	 * str_contains php8 fix.
	 */
	function str_contains( $haystack, $needle ) {
		return $needle !== '' && mb_strpos( $haystack, $needle ) !== false;
	}
}

if ( ! function_exists( 'omniverse_page_css_files_disable' ) ) {
	/**
	 * Page css files disable.
	 *
	 * @param string $description Term description.
	 * @return string
	 * @since 1.0.0
	 */
	function omniverse_page_css_files_disable( $description ) {
		$GLOBALS['wd_page_css_ignore'] = true;

		return $description;
	}
}

if ( ! function_exists( 'omniverse_page_css_files_enable' ) ) {
	/**
	 * Page css files enable.
	 *
	 * @param string $description Term description.
	 * @return string
	 * @since 1.0.0
	 */
	function omniverse_page_css_files_enable( $description ) {
		unset( $GLOBALS['wd_page_css_ignore'] );

		return $description;
	}
}

if ( ! function_exists( 'omniverse_cookie_secure_param' ) ) {
	/**
	 * Cookie secure param.
	 *
	 * @since 1.0.0
	 */
	function omniverse_cookie_secure_param() {
		return apply_filters( 'omniverse_cookie_secure_param', is_ssl() );
	}
}

if ( ! class_exists( 'WD_WPBakeryShortCodeFix' ) ) {
	/**
	 * Class fix for compatibility with WPB addons plugins.
	 */
	class WD_WPBakeryShortCodeFix {
		/**
		 * Settings.
		 *
		 * @return null
		 */
		public function settings() {
			return null;
		}
	}
}

if ( ! function_exists( 'omniverse_fix_transitions_flicking' ) ) {
	/**
	 * Fix for transitions flicking.
	 *
	 * @since 1.0.0
	 */
	function omniverse_fix_transitions_flicking() {
		echo '<script type="text/javascript" id="wd-flicker-fix">// Flicker fix.</script>';
	}

	add_action( 'wp_body_open', 'omniverse_fix_transitions_flicking', 1 );
}

if ( ! function_exists( 'omniverse_get_theme_settings_selectors_array' ) ) {
	/**
	 * Get selectors array.
	 *
	 * @return array
	 */
	function omniverse_get_theme_settings_selectors_array() {
		return omniverse_get_config( 'typography-selectors' );
	}
}

if ( ! function_exists( 'omniverse_get_theme_settings_css_files_name_array' ) ) {
	/**
	 * Get css files array.
	 *
	 * @return array
	 */
	function omniverse_get_theme_settings_css_files_name_array() {
		return omniverse_get_theme_settings_css_files_array( 'name' );
	}
}

if ( ! function_exists( 'omniverse_get_theme_settings_css_files_array' ) ) {
	/**
	 * Get css files array.
	 *
	 * @param string $name_format Result name format.
	 *
	 * @return array
	 */
	function omniverse_get_theme_settings_css_files_array( $name_format = 'title' ) {
		$config_styles  = omniverse_get_config( 'css-files' );
		$styles_options = array();

		foreach ( $config_styles as $key => $styles ) {
			foreach ( $styles as $style ) {
				if ( isset( $styles_options[ $style['name'] ] ) ) {
					continue;
				}

				$styles_options[ $key ] = array(
					'name'  => $style['title'],
					'value' => $key,
				);

				if ( 'name' === $name_format ) {
					$styles_options[ $key ]['name'] = 'wd-' . $style['name'] . '-css';
				}
			}
		}

		asort( $styles_options );

		return $styles_options;
	}
}

if ( ! function_exists( 'omniverse_get_theme_settings_js_scripts_files_array' ) ) {
	/**
	 * Get js files array.
	 *
	 * @return array
	 */
	function omniverse_get_theme_settings_js_scripts_files_array() {
		$config_scripts  = omniverse_get_config( 'js-scripts' );
		$scripts_options = array();

		foreach ( $config_scripts as $key => $scripts ) {
			foreach ( $scripts as $script ) {
				if ( isset( $scripts_options[ $script['name'] ] ) ) {
					continue;
				}

				$scripts_options[ $script['name'] ] = array(
					'name'  => $script['title'],
					'value' => $script['name'],
				);
			}
		}

		asort( $scripts_options );

		return $scripts_options;
	}
}

if ( ! function_exists( 'omniverse_get_current_page_builder' ) ) {
	/**
	 * Get current page builder.
	 * If both builders are activated then 'wpb' will be returned.
	 * If no builder is active, an empty ribbon will be returned.
	 *
	 * @since 6.1.0
	 */
	function omniverse_get_current_page_builder() {
		if ( defined( 'WPB_VC_VERSION' ) ) {
			return 'wpb';
		}

		if ( did_action( 'elementor/loaded' ) ) {
			return 'elementor';
		}

		return '';
	}
}

if ( ! function_exists( 'omniverse_is_blog_design_new' ) ) {
	/**
	 * Is blog design new.
	 *
	 * @since 6.1.0
	 *
	 * @param string $design Design.
	 */
	function omniverse_is_blog_design_new( $design ) {
		$old = array(
			'default',
			'default-alt',
			'small-images',
			'chess',
			'masonry',
			'mask',
		);

		return ! in_array( $design, $old, true );
	}
}

if ( ! function_exists( 'omniverse_get_element_template' ) ) {
	/**
	 * Loads a template part into a template.
	 *
	 * @since 6.1.0
	 *
	 * @param string $element_name  Template name.
	 * @param array  $args          Arguments.
	 * @param string $template_name Module name.
	 */
	function omniverse_get_element_template( $element_name, $args, $template_name ) {
		if ( ! empty( $args ) && is_array( $args ) ) {
			extract( $args ); // phpcs:ignore
		}

		include OMNIVERSE_THEMEROOT . '/inc/template-tags/elements/' . $element_name . '/' . $template_name;
	}
}

if ( ! function_exists( 'omniverse_get_old_classes' ) ) {
	/**
	 * Get old classes.
	 *
	 * @since 6.0.0
	 *
	 * @param string $classes Classes.
	 *
	 * @return string
	 */
	function omniverse_get_old_classes( $classes ) {
		if ( ! apply_filters( 'omniverse_show_deprecated_css_classes', false ) ) {
			$classes = '';
		}

		return esc_html( $classes );
	}
}

if ( ! function_exists( 'omniverse_get_theme_settings_selectors_array' ) ) {
	/**
	 * Get selectors array.
	 *
	 * @return array
	 */
	function omniverse_get_theme_settings_selectors_array() {
		return omniverse_get_config( 'typography-selectors' );
	}
}

if ( ! function_exists( 'omniverse_get_theme_settings_buttons_selectors_array' ) ) {
	/**
	 * Get buttons selectors array.
	 *
	 * @return array
	 */
	function omniverse_get_theme_settings_buttons_selectors_array() {
		return omniverse_get_config( 'buttons-selectors' );
	}
}

if ( ! function_exists( 'omniverse_get_current_url' ) ) {
	/**
	 * Get current url.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	function omniverse_get_current_url() {
		global $wp;

		return home_url( $wp->request );
	}
}

if ( ! function_exists( 'omniverse_get_document_title' ) ) {
	/**
	 * Returns document title for the current page.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	function omniverse_get_document_title() {
		$title = wp_get_document_title();

		$post_meta = get_post_meta( omniverse_get_the_ID(), '_yoast_wpseo_title', true );
		if ( is_object( get_queried_object() ) && property_exists( get_queried_object(), 'term_id' ) && function_exists( 'YoastSEO' ) ) {
			$taxonomy_helper = YoastSEO()->helpers->taxonomy;
			$meta            = $taxonomy_helper->get_term_meta( get_queried_object() );

			if ( isset( $meta['wpseo_title'] ) && $meta['wpseo_title'] ) {
				$title = wpseo_replace_vars( $meta['wpseo_title'], get_queried_object() );
			}
		} elseif ( $post_meta && function_exists( 'wpseo_replace_vars' ) ) {
			$title = wpseo_replace_vars( $post_meta, get_post( omniverse_get_the_ID() ) );
		}

		return $title;
	}
}

if ( ! function_exists( 'omniverse_get_new_size_classes' ) ) {
	/**
	 * Get new size classes.
	 *
	 * @param mixed $element Element.
	 * @param mixed $old_key Old key.
	 * @param mixed $selector Selector.
	 *
	 * @return string
	 */
	function omniverse_get_new_size_classes( $element, $old_key, $selector ) {
		$array = array(
			'banner'       => array(
				'small'       => array(
					'subtitle' => 'xs',
					'title'    => 's',
				),
				'default'     => array(
					'subtitle' => 'xs',
					'title'    => 'l',
					'content'  => 'xs',
				),
				'large'       => array(
					'subtitle' => 's',
					'title'    => 'xl',
					'content'  => 'm',
				),
				'extra-large' => array(
					'subtitle' => 'm',
					'title'    => 'xxl',
				),
				'medium'      => array(
					'content' => 's',
				),
			),
			'infobox'      => array(
				'small'       => array(
					'subtitle' => 'xs',
					'title'    => 's',
				),
				'default'     => array(
					'subtitle' => 'xs',
					'title'    => 'm',
				),
				'large'       => array(
					'subtitle' => 's',
					'title'    => 'xl',
				),
				'extra-large' => array(
					'subtitle' => 'm',
					'title'    => 'xxl',
				),
			),
			'title'        => array(
				'small'       => array(
					'subtitle'    => 'xs',
					'title'       => 'm',
					'after_title' => 'xs',
				),
				'default'     => array(
					'subtitle'    => 'xs',
					'title'       => 'l',
					'after_title' => 'xs',
				),
				'medium'      => array(
					'subtitle'    => 'xs',
					'title'       => 'xl',
					'after_title' => 's',
				),
				'large'       => array(
					'subtitle'    => 'xs',
					'title'       => 'xxl',
					'after_title' => 's',
				),
				'extra-large' => array(
					'subtitle'    => 'm',
					'title'       => 'xxxl',
					'after_title' => 's',
				),
			),
			'text'         => array(
				'small'       => array(
					'title' => 'm',
				),
				'default'     => array(
					'title' => 'l',
				),
				'medium'      => array(
					'title' => 'xl',
				),
				'large'       => array(
					'title' => 'xxl',
				),
				'extra-large' => array(
					'title' => 'xxxl',
				),
			),
			'list'         => array(
				'default'     => array(
					'text' => 'xs',
				),
				'medium'      => array(
					'text' => 's',
				),
				'large'       => array(
					'text' => 'm',
				),
				'extra-large' => array(
					'text' => 'l',
				),
			),
			'testimonials' => array(
				'small'  => array(
					'text' => 'xs',
				),
				'medium' => array(
					'text' => 's',
				),
				'large'  => array(
					'text' => 'm',
				),
			),
		);

		return isset( $array[ $element ][ $old_key ][ $selector ] ) ? 'wd-fontsize-' . $array[ $element ][ $old_key ][ $selector ] : '';
	}
}

if ( ! function_exists( 'array_key_first' ) ) {
	function array_key_first( array $arr ) {
		foreach ( $arr as $key => $unused ) {
			return $key;
		}
		return null;
	}
}

if ( ! function_exists( 'omniverse_is_elementor_full_width' ) ) {
	/**
	 * Check if Elementor full width.
	 *
	 * @param bool $negative_gap_ignore Is ignore negative gap option.
	 *
	 * @return boolean
	 */
	function omniverse_is_elementor_full_width( $negative_gap_ignore = false ) {
		$page_template = get_post_meta( omniverse_get_the_ID(), '_wp_page_template', true );

		if ( omniverse_is_elementor_pro_installed() ) {
			$manager = \ElementorPro\Plugin::instance()->modules_manager->get_modules( 'theme-builder' )->get_conditions_manager();

			if ( $manager->get_documents_for_location( 'single' ) || $manager->get_documents_for_location( 'archive' ) ) {
				$page_template = 'elementor_header_footer';
			}
		}

		if ( $negative_gap_ignore ) {
			return 'elementor_header_footer' === $page_template;
		}

		return 'elementor_header_footer' === $page_template && 'enabled' !== omniverse_get_opt( 'negative_gap', 'enabled' );
	}
}

if ( ! function_exists( 'omniverse_is_elementor_pro_installed' ) ) {
	/**
	 * Check if Elementor PRO is activated
	 *
	 * @since 1.0.0
	 * @return boolean
	 */
	function omniverse_is_elementor_pro_installed() {
		return defined( 'ELEMENTOR_PRO_VERSION' ) && omniverse_is_elementor_installed();
	}
}

if ( ! function_exists( 'omniverse_vc_build_link' ) ) {
	function omniverse_vc_build_link( $value ) {
		return omniverse_vc_parse_multi_attribute(
			$value,
			array(
				'url'    => '',
				'title'  => '',
				'target' => '',
				'rel'    => '',
			)
		);
	}
}

if ( ! function_exists( 'omniverse_vc_parse_multi_attribute' ) ) {
	function omniverse_vc_parse_multi_attribute( $value, $default = array() ) {
		$result = $default;

		if ( is_array( $value ) ) {
			$params_pairs = $value;
		} else {
			$params_pairs = explode( '|', $value );
		}

		if ( ! empty( $params_pairs ) ) {
			foreach ( $params_pairs as $pair ) {
				$param = preg_split( '/\:/', $pair );
				if ( ! empty( $param[0] ) && isset( $param[1] ) ) {
					$result[ $param[0] ] = rawurldecode( $param[1] );
				}
			}
		}

		return $result;
	}
}
if ( ! function_exists( 'omniverse_get_size_guides_array' ) ) {
	function omniverse_get_size_guides_array( $style = 'default' ) {
		if ( 'default' === $style ) {
			$output = array(
				esc_html__( 'Select', 'omniverse' ) => '',
				esc_html__( 'Inherit current product', 'omniverse' ) => 'inherit',
			);
		} elseif ( 'elementor' === $style ) {
			$output = array(
				'0'       => esc_html__( 'Select', 'omniverse' ),
				'inherit' => esc_html__( 'Inherit current product', 'omniverse' ),
			);
		}

		$posts = get_posts(
			array(
				'posts_per_page' => 200,
				'post_type'      => 'omniverse_size_guide',
			)
		);

		foreach ( $posts as $post ) {
			if ( 'default' === $style ) {
				$output[ $post->post_title ] = $post->ID;
			} elseif ( 'elementor' === $style ) {
				$output[ $post->ID ] = $post->post_title;
			}
		}

		return $output;
	}
}

if ( ! function_exists( 'omniverse_is_elementor_installed' ) ) {
	/**
	 * Check if Elementor is activated
	 *
	 * @since 1.0.0
	 * @return boolean
	 */
	function omniverse_is_elementor_installed() {
		return did_action( 'elementor/loaded' ) && 'elementor' === omniverse_get_current_page_builder();
	}
}
// **********************************************************************//
// Remove https
// **********************************************************************//

if ( ! function_exists( 'omniverse_remove_https' ) ) {
	function omniverse_remove_https( $link ) {
		return preg_replace( '#^https?:#', '', $link );
	}
}

// **********************************************************************//
// ! If page needs header
// **********************************************************************//

if ( ! function_exists( 'omniverse_needs_header' ) ) {
	function omniverse_needs_header() {
		return ( ! isset( $GLOBALS['wd_maintenance'] ) && ! is_singular( 'omniverse_slide' ) && ! is_singular( 'cms_block' ) );
	}
}

// **********************************************************************//
// ! If page needs footer
// **********************************************************************//

if ( ! function_exists( 'omniverse_needs_footer' ) ) {
	function omniverse_needs_footer() {
		return ( ! isset( $GLOBALS['wd_maintenance'] ) && ! is_singular( 'omniverse_slide' ) && ! is_singular( 'cms_block' ) );
	}
}


// **********************************************************************//
// ! Conditional tags
// **********************************************************************//

if ( ! function_exists( 'omniverse_is_shop_archive' ) ) {
	function omniverse_is_shop_archive() {
		return ( omniverse_woocommerce_installed() && ( is_shop() || is_product_category() || is_product_tag() || is_singular( 'product' ) || omniverse_is_product_attribute_archive() ) );
	}
}

if ( ! function_exists( 'omniverse_is_blog_archive' ) ) {
	function omniverse_is_blog_archive() {
		return ( is_home() || is_search() || is_tag() || is_category() || is_date() || is_author() );
	}
}

if ( ! function_exists( 'omniverse_is_portfolio_archive' ) ) {
	function omniverse_is_portfolio_archive() {
		return ( is_post_type_archive( 'portfolio' ) || is_tax( 'project-cat' ) );
	}
}

// **********************************************************************//
// ! Is maintenance page
// **********************************************************************//

if ( ! function_exists( 'omniverse_maintenance_page' ) ) {
	function omniverse_maintenance_page() {
		if ( ! omniverse_get_opt( 'maintenance_mode' ) || is_user_logged_in() || ( omniverse_get_opt( 'maintenance_mode' ) && isset( $_GET[ omniverse_get_opt( 'maintenance_access_key' ) ] ) ) ) {
			return false;
		}

		$pages_ids = omniverse_pages_ids_from_template( 'maintenance' );

		if ( ! empty( $pages_ids ) && is_page( $pages_ids ) ) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'omniverse_is_maintenance_active' ) ) {
	/**
	 * This function will return true if the site visitor should be redirected to the maintenance page.
	 *
	 * @return bool
	 */
	function omniverse_is_maintenance_active() {
		$maintenance_mode       = omniverse_get_opt( 'maintenance_mode' );
		$maintenance_access_key = omniverse_get_opt( 'maintenance_access_key' );
		$is_access_key          = ! empty( $maintenance_access_key ) && isset( $_GET[ $maintenance_access_key ] ); //phpcs:ignore;

		if ( ! $maintenance_mode || is_user_logged_in() || $is_access_key ) {
			return false;
		}

		return true;
	}
}

// **********************************************************************//
// ! Get config file
// **********************************************************************//

if ( ! function_exists( 'omniverse_get_config' ) ) {
	function omniverse_get_config( $name ) {
		return Config::get_instance()->get_config( $name );
	}
}

// **********************************************************************//
// ! Text to one-line string
// **********************************************************************//

if ( ! function_exists( 'omniverse_text2line' ) ) {
	function omniverse_text2line( $str ) {
		return trim( preg_replace( "/('|\"|\r?\n)/", '', $str ) );
	}
}


// **********************************************************************//
// ! Get page ID by it's template name
// **********************************************************************//
if ( ! function_exists( 'omniverse_tpl2id' ) ) {
	function omniverse_tpl2id( $tpl = '' ) {
		$pages = get_pages(
			array(
				'meta_key'   => '_wp_page_template',
				'meta_value' => $tpl,
			)
		);
		foreach ( $pages as $page ) {
			return $page->ID;
		}
	}
}

if ( ! function_exists( 'omniverse_get_portfolio_page_id' ) ) {
	/**
	 * Get portfolio page id.
	 */
	function omniverse_get_portfolio_page_id() {
		return omniverse_get_opt( 'portfolio_page' ) ? omniverse_get_opt( 'portfolio_page' ) : omniverse_tpl2id( 'portfolio.php' );
	}
}


// **********************************************************************//
// ! Function print array within a pre tags
// **********************************************************************//
if ( ! function_exists( 'ar' ) ) {
	function ar( $array ) {
		echo '<pre>';
			print_r( $array );
		echo '</pre>';
	}
}


// **********************************************************************//
// ! Get protocol (http or https)
// **********************************************************************//
if ( ! function_exists( 'omniverse_http' ) ) {
	function omniverse_http() {
		if ( ! is_ssl() ) {
			return 'http';
		} else {
			return 'https';
		}
	}
}

// **********************************************************************//
// Omniverse get theme info
// **********************************************************************//
if ( ! function_exists( 'omniverse_get_theme_info' ) ) {
	function omniverse_get_theme_info( $parameter ) {
		$theme_info = wp_get_theme();
		if ( is_child_theme() && is_object( $theme_info->parent() ) ) {
			$theme_info = wp_get_theme( $theme_info->parent()->template );
		}
			return $theme_info->get( $parameter );
	}
}

// **********************************************************************//
// Is share button enable
// **********************************************************************//
if ( ! function_exists( 'omniverse_is_social_link_enable' ) ) {
	function omniverse_is_social_link_enable( $type ) {
		$result = false;
		if ( $type == 'share' && ( omniverse_get_opt( 'share_fb' ) || omniverse_get_opt( 'share_twitter' ) || omniverse_get_opt( 'share_linkedin' ) || omniverse_get_opt( 'share_pinterest' ) || omniverse_get_opt( 'share_ok' ) || omniverse_get_opt( 'share_whatsapp' ) || omniverse_get_opt( 'share_email' ) || omniverse_get_opt( 'share_vk' ) || omniverse_get_opt( 'share_tg' ) || omniverse_get_opt( 'share_viber' ) ) ) {
			$result = true;
		}

		if ( $type == 'follow' && ( omniverse_get_opt( 'fb_link' ) || omniverse_get_opt( 'twitter_link' ) || omniverse_get_opt( 'google_link' ) || omniverse_get_opt( 'isntagram_link' ) || omniverse_get_opt( 'pinterest_link' ) || omniverse_get_opt( 'youtube_link' ) || omniverse_get_opt( 'tumblr_link' ) || omniverse_get_opt( 'linkedin_link' ) || omniverse_get_opt( 'vimeo_link' ) || omniverse_get_opt( 'flickr_link' ) || omniverse_get_opt( 'github_link' ) || omniverse_get_opt( 'dribbble_link' ) || omniverse_get_opt( 'behance_link' ) || omniverse_get_opt( 'soundcloud_link' ) || omniverse_get_opt( 'spotify_link' ) || omniverse_get_opt( 'ok_link' ) || omniverse_get_opt( 'whatsapp_link' ) || omniverse_get_opt( 'vk_link' ) || omniverse_get_opt( 'snapchat_link' ) || omniverse_get_opt( 'tg_link' ) || omniverse_get_opt( 'tiktok_link' ) || omniverse_get_opt( 'discord_link' ) || omniverse_get_opt( 'social_email_links' ) ) ) {
			$result = true;
		}

		return $result;
	}
}

// **********************************************************************//
// Is compare iframe
// **********************************************************************//
if ( ! function_exists( 'omniverse_is_compare_iframe' ) ) {
	function omniverse_is_compare_iframe() {
		return wp_script_is( 'jquery-fixedheadertable', 'enqueued' );
	}
}

// **********************************************************************//
// Is SVG image
// **********************************************************************//
if ( ! function_exists( 'omniverse_is_svg' ) ) {
	function omniverse_is_svg( $src ) {
		return substr( $src, -3, 3 ) == 'svg';
	}
}

// **********************************************************************//
// Get explode size
// **********************************************************************//
if ( ! function_exists( 'omniverse_get_explode_size' ) ) {
	function omniverse_get_explode_size( $img_size, $default_size ) {
		$sizes = explode( 'x', $img_size );
		if ( count( $sizes ) < 2 ) {
			$sizes[0] = $sizes[1] = $default_size;
		}
		return $sizes;
	}
}

// **********************************************************************//
// Check is theme is activated with a purchase code
// **********************************************************************//

if ( ! function_exists( 'omniverse_is_license_activated' ) ) {
	function omniverse_is_license_activated() {
		return get_option( 'omniverse_is_activated', false );
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * Is shop on front page
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'omniverse_is_shop_on_front' ) ) {
	function omniverse_is_shop_on_front() {
		return function_exists( 'wc_get_page_id' ) && 'page' === get_option( 'show_on_front' ) && wc_get_page_id( 'shop' ) == get_option( 'page_on_front' );
	}
}

if ( ! function_exists( 'omniverse_get_allowed_html' ) ) {
	/**
	 * Return allowed html tags
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function omniverse_get_allowed_html() {
		return apply_filters(
			'omniverse_allowed_html',
			array(
				'h1'     => array(),
				'h2'     => array(),
				'h3'     => array(),
				'h4'     => array(),
				'h5'     => array(),
				'h6'     => array(),
				'pre'    => array(),
				'p'      => array(),
				'br'     => array(),
				'i'      => array(),
				'b'      => array(),
				'u'      => array(),
				'em'     => array(),
				'del'    => array(),
				'a'      => array(
					'href'   => true,
					'class'  => true,
					'target' => true,
					'title'  => true,
					'rel'    => true,
				),
				'strong' => array(),
				'span'   => array(
					'style' => true,
					'class' => true,
				),
				'ol'     => array(),
				'ul'     => array(),
				'li'     => array(),
			)
		);
	}
}


if ( ! function_exists( 'omniverse_clean' ) ) {
	/**
	 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
	 * Non-scalar values are ignored.
	 *
	 * @param string|array $var Data to sanitize.
	 * @return string|array
	 */
	function omniverse_clean( $var ) {
		if ( is_array( $var ) ) {
			return array_map( 'omniverse_clean', $var );
		} else {
			return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
		}
	}
}

if ( ! function_exists( 'omniverse_get_svg_html' ) ) {
	/**
	 * Function to show SVG images.
	 *
	 * @param string|int  $image_id image id.
	 * @param null|string $size Needed image size. Default = thumbnail.
	 * @param null|string $attributes List of attributes. If a whip then the data is taken from $attachment object.
	 * @return string html tag img string.
	 */
	function omniverse_get_svg_html( $image_id, $size = 'thumbnail', $attributes = array() ) {
		$html       = '';
		$thumb_size = array();

		$image_id = apply_filters( 'wpml_object_id', $image_id, 'attachment', true );

		$attributes = wp_parse_args(
			$attributes,
			array(
				'alt'   => get_post_meta( $image_id, '_wp_attachment_image_alt', true ),
				'src'   => wp_get_attachment_image_url( $image_id, 'full' ),
				'title' => get_the_title( $image_id ),
			)
		);

		if ( 'string' === gettype( $size ) ) {
			$thumb_size = omniverse_get_image_size( $size );
		} elseif ( is_array( $size ) ) {
			if ( array_key_exists( 'width', $size ) && array_key_exists( 'height', $size ) ) {
				$thumb_size[0] = $size['width'];
				$thumb_size[1] = $size['height'];
			} else {
				$thumb_size = $size;
			}
		}

		if ( isset( $attributes ) ) {
			$attributes['width']  = isset( $thumb_size[0] ) ? $thumb_size[0] : '';
			$attributes['height'] = isset( $thumb_size[1] ) ? $thumb_size[1] : '';

			$attributes = array_map( 'esc_attr', $attributes );

			foreach ( $attributes as $name => $value ) {
				if ( ! empty( $value ) ) {
					$html .= " $name=" . '"' . $value . '"';
				}
			}
		}
		return '<img ' . $html . '>';
	}
}

if ( ! function_exists( 'omniverse_get_mailchimp_forms' ) ) {
	/**
	 * This function return form list for mailchimp.
	 *
	 * @return array
	 */
	function omniverse_get_mailchimp_forms() {
		$forms = get_posts(
			array(
				'post_type'   => 'mc4wp-form',
				'numberposts' => -1,
			)
		);

		$mailchimp_forms = array();

		if ( $forms ) {
			foreach ( $forms as $form ) {
				$mailchimp_forms[ $form->post_title ] = $form->ID;
			}
		}

		return $mailchimp_forms;
	}
}

if ( ! function_exists( 'omniverse_get_wpb_font_family_options' ) ) {
	/**
	 * This function get theme font options and return array for WPBakery map.
	 *
	 * @return array
	 */
	function omniverse_get_wpb_font_family_options() {
		$secondary_font = omniverse_get_opt( 'secondary-font' );
		$primary_font   = omniverse_get_opt( 'primary-font' );
		$text_font      = omniverse_get_opt( 'text-font' );

		$secondary_font_title = isset( $secondary_font[0] ) ? esc_html__( 'Secondary font', 'omniverse' ) . ' (' . $secondary_font[0]['font-family'] . ')' : esc_html__( 'Secondary font', 'omniverse' );
		$text_font_title      = isset( $text_font[0] ) ? esc_html__( 'Text font', 'omniverse' ) . ' (' . $text_font[0]['font-family'] . ')' : esc_html__( 'Text', 'omniverse' );
		$primary_font_title   = isset( $primary_font[0] ) ? esc_html__( 'Title font', 'omniverse' ) . ' (' . $primary_font[0]['font-family'] . ')' : esc_html__( 'Title font', 'omniverse' );

		return array(
			$primary_font_title   => 'primary',
			$text_font_title      => 'text',
			$secondary_font_title => 'alt',
		);
	}
}

if ( ! function_exists( 'omniverse_get_builder_status_class' ) ) {
	/**
	 * This function return omniverse css class for check builder status (on/off).
	 *
	 * @return string
	 */
	function omniverse_get_builder_status_class() {
		if ( Builder::get_instance()->has_custom_layout( 'single_product' ) || Builder::get_instance()->has_custom_layout( 'shop_archive' ) || Builder::get_instance()->has_custom_layout( 'cart' ) || Builder::get_instance()->has_custom_layout( 'checkout_content' ) || Builder::get_instance()->has_custom_layout( 'checkout_form' ) ) {
			$class = ' wd-builder-on';
		} else {
			$class = ' wd-builder-off';
		}

		return $class;
	}
}

if ( ! function_exists( 'omniverse_get_responsive_dependency_width_map' ) ) {
	/**
	 * Get width map (with responsive dependency tabs).
	 *
	 * @param string $key name needed field.
	 *
	 * @return array
	 */
	function omniverse_get_responsive_dependency_width_map( $key ) {
		if ( ! function_exists( 'omniverse_compress' ) ) {
			return array();
		}

		$fields = array(
			// Desktop.
			'responsive_tabs'      => array(
				'heading'          => esc_html__( 'Width', 'omniverse' ),
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'type'             => 'omniverse_button_set',
				'param_name'       => 'responsive_tabs',
				'tabs'             => true,
				'value'            => array(
					esc_html__( 'Desktop', 'omniverse' ) => 'desktop',
					esc_html__( 'Tablet', 'omniverse' )  => 'tablet',
					esc_html__( 'Mobile', 'omniverse' )  => 'mobile',
				),
				'default'          => 'desktop',
				'edit_field_class' => 'wd-custom-width vc_col-sm-12 vc_column',
			),
			'width_desktop'        => array(
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'type'             => 'wd_select',
				'param_name'       => 'width_desktop',
				'style'            => 'select',
				'selectors'        => array(
					'{{WRAPPER}}' => array(
						'width: {{VALUE}} !important;',
						'max-width: {{VALUE}} !important;',
					),
				),
				'devices'          => array(
					'desktop' => array(
						'value' => '',
					),
				),
				'value'            => array(
					esc_html__( 'Default', 'omniverse' ) => '',
					esc_html__( 'Full Width (100%)', 'omniverse' ) => '100%',
					esc_html__( 'Inline (auto)', 'omniverse' ) => 'auto',
					esc_html__( 'Custom', 'omniverse' )  => '-',
				),
				'wd_dependency'    => array(
					'element' => 'responsive_tabs',
					'value'   => array( 'desktop' ),
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			'custom_width_desktop' => array(
				'heading'          => esc_html__( 'Custom width', 'omniverse' ),
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'type'             => 'wd_slider',
				'param_name'       => 'custom_width_desktop',
				'devices'          => array(
					'desktop' => array(
						'unit'  => 'px',
						'value' => 0,
					),
				),
				'range'            => array(
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
				'selectors'        => array(
					'{{WRAPPER}}' => array(
						'width: {{VALUE}}{{UNIT}} !important;',
						'max-width: {{VALUE}}{{UNIT}} !important;',
					),
				),
				'dependency'       => array(
					'element' => 'width_desktop',
					'value'   => omniverse_compress(
						wp_json_encode(
							array(
								'devices' => array(
									'desktop' => array(
										'value' => '-',
									),
								),
							)
						)
					),
				),
				'wd_dependency'    => array(
					'element' => 'responsive_tabs',
					'value'   => array( 'desktop' ),
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			// Tablet.
			'width_tablet'         => array(
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'type'             => 'wd_select',
				'param_name'       => 'width_tablet',
				'style'            => 'select',
				'selectors'        => array(
					'{{WRAPPER}}' => array(
						'width: {{VALUE}} !important;',
						'max-width: {{VALUE}} !important;',
					),
				),
				'devices'          => array(
					'tablet' => array(
						'value' => '',
					),
				),
				'value'            => array(
					esc_html__( 'Inherit', 'omniverse' ) => '',
					esc_html__( 'Full Width (100%)', 'omniverse' ) => '100%',
					esc_html__( 'Inline (auto)', 'omniverse' ) => 'auto',
					esc_html__( 'Custom', 'omniverse' )  => '-',
				),
				'wd_dependency'    => array(
					'element' => 'responsive_tabs',
					'value'   => array( 'tablet' ),
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			'custom_width_tablet'  => array(
				'heading'          => esc_html__( 'Custom width', 'omniverse' ),
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'type'             => 'wd_slider',
				'param_name'       => 'custom_width_tablet',
				'devices'          => array(
					'tablet' => array(
						'unit'  => 'px',
						'value' => 0,
					),
				),
				'range'            => array(
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
				'selectors'        => array(
					'{{WRAPPER}}' => array(
						'width: {{VALUE}}{{UNIT}} !important;',
						'max-width: {{VALUE}}{{UNIT}} !important;',
					),
				),
				'dependency'       => array(
					'element' => 'width_tablet',
					'value'   => omniverse_compress(
						wp_json_encode(
							array(
								'devices' => array(
									'tablet' => array(
										'value' => '-',
									),
								),
							)
						)
					),
				),
				'wd_dependency'    => array(
					'element' => 'responsive_tabs',
					'value'   => array( 'tablet' ),
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			// Mobile.
			'width_mobile'         => array(
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'type'             => 'wd_select',
				'param_name'       => 'width_mobile',
				'style'            => 'select',
				'selectors'        => array(
					'{{WRAPPER}}' => array(
						'width: {{VALUE}} !important;',
						'max-width: {{VALUE}} !important;',
					),
				),
				'devices'          => array(
					'mobile' => array(
						'value' => '',
					),
				),
				'value'            => array(
					esc_html__( 'Inherit', 'omniverse' ) => '',
					esc_html__( 'Full Width (100%)', 'omniverse' ) => '100%',
					esc_html__( 'Inline (auto)', 'omniverse' ) => 'auto',
					esc_html__( 'Custom', 'omniverse' )  => '-',
				),
				'wd_dependency'    => array(
					'element' => 'responsive_tabs',
					'value'   => array( 'mobile' ),
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
			'custom_width_mobile'  => array(
				'heading'          => esc_html__( 'Custom width', 'omniverse' ),
				'group'            => esc_html__( 'Advanced', 'omniverse' ),
				'type'             => 'wd_slider',
				'param_name'       => 'custom_width_mobile',
				'devices'          => array(
					'mobile' => array(
						'unit'  => 'px',
						'value' => 0,
					),
				),
				'range'            => array(
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
				'selectors'        => array(
					'{{WRAPPER}}' => array(
						'width: {{VALUE}}{{UNIT}} !important;',
						'max-width: {{VALUE}}{{UNIT}} !important;',
					),
				),
				'dependency'       => array(
					'element' => 'width_mobile',
					'value'   => omniverse_compress(
						wp_json_encode(
							array(
								'devices' => array(
									'mobile' => array(
										'value' => '-',
									),
								),
							)
						)
					),
				),
				'wd_dependency'    => array(
					'element' => 'responsive_tabs',
					'value'   => array( 'mobile' ),
				),
				'edit_field_class' => 'vc_col-sm-12 vc_column',
			),
		);

		return $fields[ $key ];
	}
}

if ( ! function_exists( 'omniverse_is_compressed_data' ) ) {
	/**
	 * Check $variable to compressed.
	 *
	 * @param string $variable need check data.
	 * @return bool
	 */
	function omniverse_is_compressed_data( $variable ) {
		if ( ! function_exists( 'omniverse_compress' ) || ! function_exists( 'omniverse_decompress' ) ) {
			return '';
		}
		return omniverse_compress( omniverse_decompress( $variable ) ) === $variable;
	}
}

if ( ! function_exists( 'omniverse_get_current_user_roles' ) ) {
	/**
	 * Get the current user roles list.
	 *
	 * @retun array
	 */
	function omniverse_get_current_user_roles() {
		return is_user_logged_in() ? (array) wp_get_current_user()->roles : array();
	}
}

if ( ! function_exists( 'omniverse_get_center_coords' ) ) {
	/**
	 * This function accepts a list of coords and returns a prepared array with the coordinates of the center.
	 * If the token list is empty, the method will return an empty array.
	 *
	 * @param array $coords List of coords.
	 * @return array
	 */
	function omniverse_get_center_coords( $coords ) {
		if ( empty( $coords ) ) {
			return array();
		}

		$count_coords = count( $coords );
		$xcos         = 0.0;
		$ycos         = 0.0;
		$zsin         = 0.0;

		foreach ( $coords as $lnglat ) {
			$lat = floatval( $lnglat['lat'] ) * pi() / 180;
			$lon = floatval( $lnglat['lng'] ) * pi() / 180;

			$acos  = cos( $lat ) * cos( $lon );
			$bcos  = cos( $lat ) * sin( $lon );
			$csin  = sin( $lat );
			$xcos += $acos;
			$ycos += $bcos;
			$zsin += $csin;
		}

		$xcos /= $count_coords;
		$ycos /= $count_coords;
		$zsin /= $count_coords;
		$lon   = atan2( $ycos, $xcos );
		$sqrt  = sqrt( $xcos * $xcos + $ycos * $ycos );
		$lat   = atan2( $zsin, $sqrt );

		return array( $lat * 180 / pi(), $lon * 180 / pi() );
	}
}

if ( ! function_exists( 'omniverse_is_old_category_structure' ) ) {
	/**
	 * Check if the category design refers to the old structure.
	 *
	 * @param string $category_design The design of the category that needs to be checked.
	 *
	 * @return bool
	 */
	function omniverse_is_old_category_structure( $category_design ) {
		$old_categories_designs = array(
			'default',
			'alt',
			'center',
			'replace-title',
		);

		return in_array( $category_design, $old_categories_designs, true );
	}
}
