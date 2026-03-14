<?php
/**
 * JS libraries.
 *
 * @version 1.0
 * @package dn
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

return array(
	'autocomplete'           => array(
		array(
			'title'      => esc_html__( 'Autocomplete', 'omniverse' ),
			'name'       => 'autocomplete',
			'file'       => '/js/libs/autocomplete',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'cookie'                 => array(
		array(
			'title'      => esc_html__( 'Cookie', 'omniverse' ),
			'name'       => 'cookie',
			'file'       => '/js/libs/cookie',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'countdown-bundle'       => array(
		array(
			'title'      => esc_html__( 'Countdown', 'omniverse' ),
			'name'       => 'countdown-bundle',
			'file'       => '/js/libs/countdown-bundle',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'device'                 => array(
		array(
			'title'      => esc_html__( 'Device', 'omniverse' ),
			'name'       => 'device',
			'file'       => '/js/libs/device',
			'in_footer'  => false,
			'dependency' => array( 'jquery' ),
		),
	),
	'isotope-bundle'         => array(
		array(
			'title'      => esc_html__( 'Isotope', 'omniverse' ),
			'name'       => 'isotope-bundle',
			'file'       => '/js/libs/isotope-bundle',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'justified'              => array(
		array(
			'title'      => esc_html__( 'Justified gallery', 'omniverse' ),
			'name'       => 'justified',
			'file'       => '/js/libs/justifiedGallery',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'magnific'               => array(
		array(
			'title'      => esc_html__( 'Magnific popup', 'omniverse' ),
			'name'       => 'magnific',
			'file'       => '/js/libs/magnific-popup',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'panr-parallax-bundle'   => array(
		array(
			'title'      => esc_html__( 'Panr parallax', 'omniverse' ),
			'name'       => 'panr-parallax-bundle',
			'file'       => '/js/libs/panr-parallax-bundle',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'parallax'               => array(
		array(
			'title'      => esc_html__( 'Parallax', 'omniverse' ),
			'name'       => 'parallax',
			'file'       => '/js/libs/parallax',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'parallax-scroll-bundle' => array(
		array(
			'title'      => esc_html__( 'Parallax scroll', 'omniverse' ),
			'name'       => 'parallax-scroll-bundle',
			'file'       => '/js/libs/parallax-scroll-bundle',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'photoswipe-bundle'      => array(
		array(
			'title'      => esc_html__( 'Photoswipe', 'omniverse' ),
			'name'       => 'photoswipe-bundle',
			'file'       => '/js/libs/photoswipe-bundle',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'pjax'                   => array(
		array(
			'title'      => esc_html__( 'PJAX', 'omniverse' ),
			'name'       => 'pjax',
			'file'       => '/js/libs/pjax',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'sticky-kit'             => array(
		array(
			'title'      => esc_html__( 'Sticky kit', 'omniverse' ),
			'name'       => 'sticky-kit',
			'file'       => '/js/libs/sticky-kit',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'swiper'                 => array(
		array(
			'title'      => esc_html__( 'Swiper', 'omniverse' ),
			'name'       => 'wd_swiper',
			'file'       => '/js/libs/swiper',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'threesixty'             => array(
		array(
			'title'      => esc_html__( 'Threesixty', 'omniverse' ),
			'name'       => 'threesixty',
			'file'       => '/js/libs/threesixty',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'tooltips'               => array(
		array(
			'title'      => esc_html__( 'Tooltips', 'omniverse' ),
			'name'       => 'tooltips',
			'file'       => '/js/libs/tooltips',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'vivus'                  => array(
		array(
			'title'      => esc_html__( 'Vivus', 'omniverse' ),
			'name'       => 'vivus',
			'file'       => '/js/libs/vivus',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'waypoints'              => array(
		array(
			'title'      => esc_html__( 'Waypoint', 'omniverse' ),
			'name'       => 'waypoints',
			'file'       => '/js/libs/waypoints',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'leaflet'                => array(
		array(
			'title'      => esc_html__( 'Leaflet', 'omniverse' ),
			'name'       => 'leaflet',
			'file'       => '/js/libs/leaflet',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
	'vimeo_player'           => array(
		array(
			'title'      => esc_html__( 'Vimeo player', 'omniverse' ),
			'name'       => 'vimeo_player',
			'file'       => '/js/libs/vimeo-player',
			'in_footer'  => true,
			'dependency' => array(),
		),
	),
);
