<?php
if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

use DN\Admin\Modules\Options;

Options::add_field(
	array(
		'id'          => 'blog_layout',
		'name'        => esc_html__( 'Blog layout', 'omniverse' ),
		'description' => esc_html__( 'Select main content and sidebar alignment for blog pages.', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'blog_section',
		'options'     => array(
			'full-width'    => array(
				'name'  => esc_html__( '1 Column', 'omniverse' ),
				'value' => 'full-width',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/sidebar-layout/none.png',
			),
			'sidebar-left'  => array(
				'name'  => esc_html__( '2 Columns Left', 'omniverse' ),
				'value' => 'sidebar-left',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/sidebar-layout/left.png',
			),
			'sidebar-right' => array(
				'name'  => esc_html__( '2 Columns Right', 'omniverse' ),
				'value' => 'sidebar-right',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/sidebar-layout/right.png',
			),
		),
		'default'     => 'sidebar-right',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'blog_sidebar_width',
		'name'        => esc_html__( 'Blog sidebar size', 'omniverse' ),
		'description' => esc_html__( 'You can set different sizes for your blog pages sidebar', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'blog_section',
		'options'     => array(
			2 => array(
				'name'  => esc_html__( 'Small', 'omniverse' ),
				'value' => 2,
			),
			3 => array(
				'name'  => esc_html__( 'Medium', 'omniverse' ),
				'value' => 2,
			),
			4 => array(
				'name'  => esc_html__( 'Large', 'omniverse' ),
				'value' => 2,
			),
		),
		'default'     => 3,
		'priority'    => 20,
		'class'       => 'dn-tooltip-bordered',
	)
);

Options::add_field(
	array(
		'id'          => 'single_post_justified_gallery',
		'name'        => esc_html__( 'Justify gallery', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'blog-justify-gallery.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'This option will replace standard WordPress gallery with “Justified gallery” JS library.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'blog_section',
		'default'     => '0',
		'priority'    => 30,
	)
);

/**
 * Blog archive.
 */
Options::add_field(
	array(
		'id'          => 'blog_design',
		'name'        => esc_html__( 'Blog design', 'omniverse' ),
		'description' => esc_html__( 'Choose one of the blog designs available in the theme.', 'omniverse' ),
		'group'       => esc_html__( 'Style', 'omniverse' ),
		'type'        => 'select',
		'section'     => 'blog_archive_section',
		'options'     => array(
			'default'      => array(
				'name'  => esc_html__( 'Default', 'omniverse' ),
				'value' => 'default',
			),
			'default-alt'  => array(
				'name'  => esc_html__( 'Default alternative', 'omniverse' ),
				'value' => 'default-alt',
			),
			'small-images' => array(
				'name'  => esc_html__( 'Small images', 'omniverse' ),
				'value' => 'small-images',
			),
			'chess'        => array(
				'name'  => esc_html__( 'Chess', 'omniverse' ),
				'value' => 'chess',
			),
			'masonry'      => array(
				'name'  => esc_html__( 'Masonry grid', 'omniverse' ),
				'value' => 'masonry',
			),
			'mask'         => array(
				'name'  => esc_html__( 'Mask on image', 'omniverse' ),
				'value' => 'mask',
			),
			'meta-image'   => array(
				'name'  => esc_html__( 'Meta on image', 'omniverse' ),
				'value' => 'meta-image',
			),
			'list'         => array(
				'name'  => esc_html__( 'List', 'omniverse' ),
				'value' => 'list',
			),
		),
		'default'     => 'masonry',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'blog_style',
		'name'        => esc_html__( 'Blog style', 'omniverse' ),
		'description' => esc_html__( 'You can use flat style or add a background to your blog posts.', 'omniverse' ),
		'group'       => esc_html__( 'Style', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'blog_archive_section',
		'options'     => array(
			'flat'   => array(
				'name'  => esc_html__( 'Flat', 'omniverse' ),
				'value' => 'flat',
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'blog-style-flat.jpg" alt="">', 'omniverse' ), true ),
			),
			'shadow' => array(
				'name'  => esc_html__( 'With background', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'blog-style-with-shadow.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'shadow',
			),
		),
		'default'     => 'shadow',
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'       => 'blog_with_shadow',
		'name'     => esc_html__( 'Add shadow', 'omniverse' ),
		'group'    => esc_html__( 'Style', 'omniverse' ),
		'type'     => 'switcher',
		'section'  => 'blog_archive_section',
		'default'  => true,
		'on-text'  => esc_html__( 'Yes', 'omniverse' ),
		'off-text' => esc_html__( 'No', 'omniverse' ),
		'requires' => array(
			array(
				'key'     => 'blog_style',
				'compare' => 'equals',
				'value'   => array( 'shadow' ),
			),
		),
		'priority' => 21,
	)
);

Options::add_field(
	array(
		'id'          => 'blog_columns',
		'name'        => esc_html__( 'Blog columns on desktop', 'omniverse' ),
		'description' => esc_html__( 'Number of columns for the blog grid.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'blog_archive_section',
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
		),
		'default'     => 3,
		'priority'    => 22,
		'requires'    => array(
			array(
				'key'     => 'blog_design',
				'compare' => 'equals',
				'value'   => array( 'masonry', 'mask', 'meta-image' ),
			),
		),
		't_tab'       => array(
			'id'       => 'blog_columns_tabs',
			'tab'      => esc_html__( 'Desktop', 'omniverse' ),
			'title'    => esc_html__( 'Blog columns', 'omniverse' ),
			'icon'     => 'dn-i-desktop',
			'style'    => 'devices',
			'requires' => array(
				array(
					'key'     => 'blog_design',
					'compare' => 'equals',
					'value'   => array( 'masonry', 'mask', 'meta-image' ),
				),
			),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'blog_columns_tablet',
		'name'        => esc_html__( 'Blog columns on tablet', 'omniverse' ),
		'description' => esc_html__( 'Number of columns for the blog grid.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'blog_archive_section',
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
		),
		'default'     => 'auto',
		'priority'    => 23,
		'requires'    => array(
			array(
				'key'     => 'blog_design',
				'compare' => 'equals',
				'value'   => array( 'masonry', 'mask', 'meta-image' ),
			),
		),
		't_tab'       => array(
			'id'   => 'blog_columns_tabs',
			'icon' => 'dn-i-tablet',
			'tab'  => esc_html__( 'Tablet', 'omniverse' ),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'blog_columns_mobile',
		'name'        => esc_html__( 'Blog columns on mobile', 'omniverse' ),
		'description' => esc_html__( 'Number of columns for the blog grid.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'blog_archive_section',
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
		),
		'default'     => 'auto',
		'priority'    => 24,
		'requires'    => array(
			array(
				'key'     => 'blog_design',
				'compare' => 'equals',
				'value'   => array( 'masonry', 'mask', 'meta-image' ),
			),
		),
		't_tab'       => array(
			'id'   => 'blog_columns_tabs',
			'icon' => 'dn-i-phone',
			'tab'  => esc_html__( 'Mobile', 'omniverse' ),
		),
	)
);

Options::add_field(
	array(
		'id'          => 'blog_spacing',
		'name'        => esc_html__( 'Space between posts on desktop', 'omniverse' ),
		'description' => esc_html__( 'You can set the different spacing between posts on the blog page.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'blog_archive_section',
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
		't_tab'       => array(
			'id'    => 'blog_spacing_tabs',
			'tab'   => esc_html__( 'Desktop', 'omniverse' ),
			'icon'  => 'dn-i-desktop',
			'style' => 'devices',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'blog_spacing_tablet',
		'name'        => esc_html__( 'Space between posts on tablet', 'omniverse' ),
		'description' => esc_html__( 'You can set the different spacing between posts on the blog page.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'blog_archive_section',
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
		'default'     => '',
		'priority'    => 41,
		't_tab'       => array(
			'id'   => 'blog_spacing_tabs',
			'tab'  => esc_html__( 'Tablet', 'omniverse' ),
			'icon' => 'dn-i-tablet',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'blog_spacing_mobile',
		'name'        => esc_html__( 'Space between posts on mobile', 'omniverse' ),
		'description' => esc_html__( 'You can set the different spacing between posts on the blog page.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'blog_archive_section',
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
		'default'     => '',
		'priority'    => 42,
		't_tab'       => array(
			'id'   => 'blog_spacing_tabs',
			'tab'  => esc_html__( 'Mobile', 'omniverse' ),
			'icon' => 'dn-i-phone',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'blog_pagination',
		'name'        => esc_html__( 'Blog pagination', 'omniverse' ),
		'description' => esc_html__( 'Choose a type for the pagination on your blog page.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'blog_archive_section',
		'options'     => array(
			'pagination' => array(
				'name'  => esc_html__( 'Pagination links', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'blog-pagination-pagination-links.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'pagination',
			),
			'load_more'  => array(
				'name'  => esc_html__( '"Load more" button', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'blog-pagination-load-more-button.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'load_more',
			),
			'infinit'    => array(
				'name'  => esc_html__( 'Infinit scrolling', 'omniverse' ),
				'hint'  => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'blog-pagination-pagination-infinit.mp4" autoplay loop muted></video>',
				'value' => 'infinit',
			),
		),
		'default'     => 'pagination',
		'priority'    => 50,
	)
);

Options::add_field(
	array(
		'id'          => 'blog_excerpt',
		'name'        => esc_html__( 'Posts excerpt', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'posts-excerpt.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'If you set this option to "Excerpt" then you would be able to set a custom excerpt for each post or it will be cut from the post content. If you choose "Full content" then all content will be shown, or you can add the "Read more button" while editing the post and by doing this cut your excerpt length as you need.', 'omniverse' ),
		'group'       => esc_html__( 'Post options', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'blog_archive_section',
		'options'     => array(
			'excerpt' => array(
				'name'  => esc_html__( 'Excerpt', 'omniverse' ),
				'value' => 'excerpt',
			),
			'full'    => array(
				'name'  => esc_html__( 'Full content', 'omniverse' ),
				'value' => 'full',
			),
		),
		'default'     => 'excerpt',
		'priority'    => 60,
	)
);

Options::add_field(
	array(
		'id'          => 'blog_words_or_letters',
		'name'        => esc_html__( 'Excerpt length by words or letters', 'omniverse' ),
		'description' => esc_html__( 'Limit your excerpt text for posts by words or letters.', 'omniverse' ),
		'group'       => esc_html__( 'Post options', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'blog_archive_section',
		'options'     => array(
			'word'   => array(
				'name'  => esc_html__( 'Word', 'omniverse' ),
				'value' => 'word',
			),
			'letter' => array(
				'name'  => esc_html__( 'Letters', 'omniverse' ),
				'value' => 'letter',
			),
		),
		'requires'    => array(
			array(
				'key'     => 'blog_excerpt',
				'compare' => 'equals',
				'value'   => array( 'excerpt' ),
			),
		),
		'default'     => 'letter',
		'priority'    => 70,
		'class'       => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'          => 'blog_excerpt_length',
		'name'        => esc_html__( 'Excerpt length', 'omniverse' ),
		'description' => esc_html__( 'Number of words or letters that will be displayed for each post if you use "Excerpt" mode and don\'t set custom excerpt for each post.', 'omniverse' ),
		'group'       => esc_html__( 'Post options', 'omniverse' ),
		'type'        => 'text_input',
		'attributes'  => array(
			'type' => 'number',
		),
		'section'     => 'blog_archive_section',
		'requires'    => array(
			array(
				'key'     => 'blog_excerpt',
				'compare' => 'equals',
				'value'   => array( 'excerpt' ),
			),
		),
		'default'     => 135,
		'priority'    => 80,
		'class'       => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'          => 'parts_title',
		'name'        => esc_html__( 'Title for posts', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'parts_title.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Display post title', 'omniverse' ),
		'group'       => esc_html__( 'Elements', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'blog_archive_section',
		'default'     => '1',
		'class'       => 'dn-col-6',
		'priority'    => 90,
	)
);

Options::add_field(
	array(
		'id'          => 'parts_meta',
		'name'        => esc_html__( 'Meta information', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'parts_meta.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Display categories, share icons, author and replies', 'omniverse' ),
		'group'       => esc_html__( 'Elements', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'blog_archive_section',
		'default'     => '1',
		'class'       => 'dn-col-6',
		'priority'    => 100,
	)
);

Options::add_field(
	array(
		'id'          => 'parts_text',
		'name'        => esc_html__( 'Post text', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'parts_text.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Display post excerpt', 'omniverse' ),
		'group'       => esc_html__( 'Elements', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'blog_archive_section',
		'default'     => '1',
		'class'       => 'dn-col-6',
		'priority'    => 110,
	)
);

Options::add_field(
	array(
		'id'          => 'parts_btn',
		'name'        => esc_html__( 'Read more button', 'omniverse' ),
		'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'parts_btn.mp4" autoplay loop muted></video>',
		'description' => esc_html__( 'Display "Continue reading" button ', 'omniverse' ),
		'group'       => esc_html__( 'Elements', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'blog_archive_section',
		'default'     => '1',
		'class'       => 'dn-col-6',
		'priority'    => 120,
	)
);

/**
 * Single post.
 */

Options::add_field(
	array(
		'id'          => 'single_post_design',
		'name'        => esc_html__( 'Single post design', 'omniverse' ),
		'description' => esc_html__( 'You can use different design for your single post page.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'blog_singe_post_section',
		'options'     => array(
			'default'     => array(
				'name'  => esc_html__( 'Default', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'blog-single-post-design-default.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'default',
			),
			'large_image' => array(
				'name'  => esc_html__( 'Large image', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'blog-single-post-design-large-image.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'large_image',
			),
		),
		'default'     => 'default',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'single_post_header',
		'name'        => esc_html__( 'Custom single post header', 'omniverse' ),
		'description' => esc_html__( 'You can use different header for your single post page.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'select',
		'section'     => 'blog_singe_post_section',
		'options'     => '',
		'callback'    => 'omniverse_get_theme_settings_headers_array',
		'default'     => 'none',
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'          => 'blog_share',
		'name'        => esc_html__( 'Share buttons', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'single-post-share-buttons.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Display share icons on single post page', 'omniverse' ),
		'group'       => esc_html__( 'Elements', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'blog_singe_post_section',
		'default'     => '1',
		'class'       => 'dn-col-6',
		'priority'    => 30,
	)
);

Options::add_field(
	array(
		'id'          => 'blog_navigation',
		'name'        => esc_html__( 'Posts navigation', 'omniverse' ),
		'description' => esc_html__( 'Next and previous posts links on single post page', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'single-post-posts-navigation.jpg" alt="">', 'omniverse' ), true ),
		'group'       => esc_html__( 'Elements', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'blog_singe_post_section',
		'default'     => '1',
		'class'       => 'dn-col-6',
		'priority'    => 40,
	)
);

Options::add_field(
	array(
		'id'          => 'blog_author_bio',
		'name'        => esc_html__( 'Author bio', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'single-post-autor-bio.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Display information about the post author', 'omniverse' ),
		'group'       => esc_html__( 'Elements', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'blog_singe_post_section',
		'default'     => '1',
		'class'       => 'dn-col-6',
		'priority'    => 50,
	)
);

Options::add_field(
	array(
		'id'          => 'blog_related_posts',
		'name'        => esc_html__( 'Related posts', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'single-post-related-posts.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Show related posts on single post page (by tags)', 'omniverse' ),
		'group'       => esc_html__( 'Elements', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'blog_singe_post_section',
		'default'     => '1',
		'class'       => 'dn-col-6',
		'priority'    => 60,
	)
);
