<?php
if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) {
	exit( 'No direct script access allowed' );
}

use DN\Admin\Modules\Options;

Options::add_field(
	array(
		'id'          => 'portfolio',
		'name'        => esc_html__( 'Portfolio', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'portfolio.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Enable/disable portfolio on your website.', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'portfolio_section',
		'default'     => '1',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'           => 'portfolio_page',
		'name'         => esc_html__( 'Portfolio page', 'omniverse' ),
		'description'  => esc_html__( 'You need to create an empty page and select from the dropdown. It will be used as a root page for your portfolio archives.', 'omniverse' ),
		'section'      => 'portfolio_section',
		'type'         => 'select',
		'empty_option' => true,
		'select2'      => true,
		'options'      => '',
		'callback'     => 'omniverse_get_pages_array',
		'priority'     => 19,
	)
);

Options::add_field(
	array(
		'id'          => 'portfolio_item_slug',
		'name'        => esc_html__( 'Portfolio project URL slug', 'omniverse' ),
		'description' => esc_html__( 'IMPORTANT: You need to go to WordPress Settings -> Permalinks and resave them to apply these settings.', 'omniverse' ),
		'group'       => esc_html__( 'URL', 'omniverse' ),
		'type'        => 'text_input',
		'section'     => 'portfolio_section',
		'priority'    => 20,
		'class'    => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'          => 'portfolio_cat_slug',
		'name'        => esc_html__( 'Portfolio category URL slug', 'omniverse' ),
		'description' => esc_html__( 'IMPORTANT: You need to go to WordPress Settings -> Permalinks and resave them to apply these settings.', 'omniverse' ),
		'group'       => esc_html__( 'URL', 'omniverse' ),
		'type'        => 'text_input',
		'section'     => 'portfolio_section',
		'priority'    => 30,
		'class'    => 'dn-col-6',
	)
);


/**
 * Portfolio archive.
 */

Options::add_field(
	array(
		'id'          => 'portfolio_full_width',
		'name'        => esc_html__( 'Full width portfolio', 'omniverse' ),
		'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'full-width-portfolio.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Makes the container 100% width of the page.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'portfolio_archive_section',
		'default'     => false,
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'projects_columns',
		'name'        => esc_html__( 'Projects columns on desktop', 'omniverse' ),
		'description' => esc_html__( 'How many projects you want to show per row', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'portfolio_archive_section',
		'options'     => array(
			1 => array(
				'name'  => '1',
				'value' => 1,
			),
			2 => array(
				'name'  => '2',
				'value' => 2,
			),
			3 => array(
				'name'  => '3',
				'value' => 3,
			),
			4 => array(
				'name'  => '4',
				'value' => 4,
			),
			5 => array(
				'name'  => '5',
				'value' => 5,
			),
			6 => array(
				'name'  => '6',
				'value' => 6,
			),
		),
		'default'     => 3,
		'priority'    => 12,
		't_tab'       => [
			'id'    => 'project_columns_tabs',
			'tab'   => esc_html__( 'Desktop', 'omniverse' ),
			'icon'  => 'dn-i-desktop',
			'style' => 'devices',
		],
	)
);

Options::add_field(
	array(
		'id'          => 'projects_columns_tablet',
		'name'        => esc_html__( 'Projects columns on tablet', 'omniverse' ),
		'description' => esc_html__( 'How many projects you want to show per row', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'portfolio_archive_section',
		'options'     => array(
			'auto' => array(
				'name'  => esc_html__( 'Auto', 'omniverse' ),
				'value' => 'auto',
			),
			1      => array(
				'name'  => '1',
				'value' => 1,
			),
			2      => array(
				'name'  => '2',
				'value' => 2,
			),
			3      => array(
				'name'  => '3',
				'value' => 3,
			),
			4      => array(
				'name'  => '4',
				'value' => 4,
			),
			5      => array(
				'name'  => '5',
				'value' => 5,
			),
			6      => array(
				'name'  => '6',
				'value' => 6,
			),
		),
		'default'     => 'auto',
		'priority'    => 13,
		't_tab'       => [
			'id'   => 'project_columns_tabs',
			'tab'  => esc_html__( 'Tablet', 'omniverse' ),
			'icon' => 'dn-i-tablet',
		],
	)
);

Options::add_field(
	array(
		'id'          => 'projects_columns_mobile',
		'name'        => esc_html__( 'Projects columns on mobile', 'omniverse' ),
		'description' => esc_html__( 'How many projects you want to show per row', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'portfolio_archive_section',
		'options'     => array(
			'auto' => array(
				'name'  => esc_html__( 'Auto', 'omniverse' ),
				'value' => 'auto',
			),
			1      => array(
				'name'  => '1',
				'value' => 1,
			),
			2      => array(
				'name'  => '2',
				'value' => 2,
			),
			3      => array(
				'name'  => '3',
				'value' => 3,
			),
			4      => array(
				'name'  => '4',
				'value' => 4,
			),
			5      => array(
				'name'  => '5',
				'value' => 5,
			),
			6      => array(
				'name'  => '6',
				'value' => 6,
			),
		),
		'default'     => 'auto',
		'priority'    => 14,
		't_tab'       => [
			'id'   => 'project_columns_tabs',
			'tab'  => esc_html__( 'Mobile', 'omniverse' ),
			'icon' => 'dn-i-phone',
		],
	)
);

Options::add_field(
	array(
		'id'          => 'portfolio_spacing',
		'name'        => esc_html__( 'Space between projects on desktop', 'omniverse' ),
		'description' => esc_html__( 'You can set different spacing between blocks on portfolio page', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'portfolio_archive_section',
		'options'     => array(
			0  => array(
				'name'  => '0',
				'value' => 0,
			),
			2  => array(
				'name'  => '2',
				'value' => 2,
			),
			6  => array(
				'name'  => '5',
				'value' => 6,
			),
			10 => array(
				'name'  => '10',
				'value' => 10,
			),
			20 => array(
				'name'  => '20',
				'value' => 20,
			),
			30 => array(
				'name'  => '30',
				'value' => 30,
			),
		),
		'default'     => 0,
		'priority'    => 20,
		't_tab'       => array(
			'id'    => 'portfolio_spacing_tabs',
			'tab'   => esc_html__( 'Desktop', 'omniverse' ),
			'icon'  => 'dn-i-desktop',
			'style' => 'devices',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'portfolio_spacing_tablet',
		'name'        => esc_html__( 'Space between projects on tablet', 'omniverse' ),
		'description' => esc_html__( 'You can set different spacing between blocks on portfolio page', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'portfolio_archive_section',
		'options'     => array(
			0  => array(
				'name'  => '0',
				'value' => 0,
			),
			2  => array(
				'name'  => '2',
				'value' => 2,
			),
			6  => array(
				'name'  => '5',
				'value' => 6,
			),
			10 => array(
				'name'  => '10',
				'value' => 10,
			),
			20 => array(
				'name'  => '20',
				'value' => 20,
			),
			30 => array(
				'name'  => '30',
				'value' => 30,
			),
		),
		'default'     => '',
		'priority'    => 21,
		't_tab'       => array(
			'id'   => 'portfolio_spacing_tabs',
			'tab'  => esc_html__( 'Tablet', 'omniverse' ),
			'icon' => 'dn-i-tablet',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'portfolio_spacing_mobile',
		'name'        => esc_html__( 'Space between projects on mobile', 'omniverse' ),
		'description' => esc_html__( 'You can set different spacing between blocks on portfolio page', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'portfolio_archive_section',
		'options'     => array(
			0  => array(
				'name'  => '0',
				'value' => 0,
			),
			2  => array(
				'name'  => '2',
				'value' => 2,
			),
			6  => array(
				'name'  => '5',
				'value' => 6,
			),
			10 => array(
				'name'  => '10',
				'value' => 10,
			),
			20 => array(
				'name'  => '20',
				'value' => 20,
			),
			30 => array(
				'name'  => '30',
				'value' => 30,
			),
		),
		'default'     => '',
		'priority'    => 22,
		't_tab'       => array(
			'id'   => 'portfolio_spacing_tabs',
			'tab'  => esc_html__( 'Mobile', 'omniverse' ),
			'icon' => 'dn-i-phone',
		),
	)
);

Options::add_field(
	array(
		'id'          => 'portoflio_per_page',
		'name'        => esc_html__( 'Items per page', 'omniverse' ),
		'description' => esc_html__( 'Number of portfolio projects that will be displayed on one page.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'text_input',
		'attributes'  => array(
			'type' => 'number',
		),
		'section'     => 'portfolio_archive_section',
		'default'     => 6,
		'priority'    => 30,
	)
);

Options::add_field(
	array(
		'id'          => 'portfolio_pagination',
		'name'        => esc_html__( 'Portfolio pagination', 'omniverse' ),
		'description' => esc_html__( 'Choose a type for the pagination on your portfolio page.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'buttons',
		'section'     => 'portfolio_archive_section',
		'options'     => array(
			'pagination' => array(
				'name'  => esc_html__( 'Pagination links', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'portfolio-pagination-pagination-links.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'pagination',
			),
			'load_more'  => array(
				'name'  => esc_html__( '"Load more" button', 'omniverse' ),
				'hint'  => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'portfolio-pagination-load-more-button.jpg" alt="">', 'omniverse' ), true ),
				'value' => 'load_more',
			),
			'infinit'    => array(
				'name'  => esc_html__( 'Infinit scrolling', 'omniverse' ),
				'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'portfolio-pagination-infinit.mp4" autoplay loop muted></video>',
				'value' => 'infinit',
			),
		),
		'default'     => 'load_more',
		'priority'    => 40,
	)
);

Options::add_field(
	array(
		'id'          => 'portoflio_orderby',
		'name'        => esc_html__( 'Portfolio order by', 'omniverse' ),
		'description' => esc_html__( 'Select a parameter for projects order.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'select',
		'section'     => 'portfolio_archive_section',
		'options'     => array(
			'date'       => array(
				'name'  => esc_html__( 'Date', 'omniverse' ),
				'value' => 'date',
			),
			'ID'         => array(
				'name'  => esc_html__( 'ID', 'omniverse' ),
				'value' => 'ID',
			),
			'title'      => array(
				'name'  => esc_html__( 'Title', 'omniverse' ),
				'value' => 'title',
			),
			'modified'   => array(
				'name'  => esc_html__( 'Modified', 'omniverse' ),
				'value' => 'modified',
			),
			'menu_order' => array(
				'name'  => esc_html__( 'Menu order', 'omniverse' ),
				'value' => 'menu_order',
			),
		),
		'default'     => 'date',
		'priority'    => 50,
		'class'    => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'          => 'portoflio_order',
		'name'        => esc_html__( 'Portfolio order', 'omniverse' ),
		'description' => esc_html__( 'Choose ascending or descending order.', 'omniverse' ),
		'group'       => esc_html__( 'Layout', 'omniverse' ),
		'type'        => 'select',
		'section'     => 'portfolio_archive_section',
		'options'     => array(
			'DESC' => array(
				'name'  => esc_html__( 'DESC', 'omniverse' ),
				'value' => 'DESC',
			),
			'ASC'  => array(
				'name'  => esc_html__( 'ASC', 'omniverse' ),
				'value' => 'ASC',
			),
		),
		'default'     => 'DESC',
		'priority'    => 60,
		'class'    => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'          => 'portoflio_style',
		'name'        => esc_html__( 'Portfolio style', 'omniverse' ),
		'description' => esc_html__( 'You can use different styles for your projects.', 'omniverse' ),
		'group'       => esc_html__( 'Project options', 'omniverse' ),

		'type'        => 'buttons',
		'section'     => 'portfolio_archive_section',
		'options'     => array(
			'hover'         => array(
				'name'  => esc_html__( 'Show text on mouse over', 'omniverse' ),
				'value' => 'hover',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/portfolio/hover.jpg',
			),
			'hover-inverse' => array(
				'name'  => esc_html__( 'Alternative', 'omniverse' ),
				'value' => 'hover-inverse',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/portfolio/hover-inverse.jpg',
			),
			'text-shown'    => array(
				'name'  => esc_html__( 'Text under image', 'omniverse' ),
				'value' => 'text-shown',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/portfolio/text-shown.jpg',
			),
			'parallax'      => array(
				'name'  => esc_html__( 'Mouse move parallax', 'omniverse' ),
				'value' => 'parallax',
				'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/portfolio/hover.jpg',
			),
		),
		'default'     => 'hover',
		'priority'    => 70,
		'class'       => 'dn-btn-set-img-col-3',
	)
);

Options::add_field(
	array(
		'id'          => 'portoflio_image_size',
		'name'        => esc_html__( 'Images size', 'omniverse' ),
		'description' => esc_html__( 'Enter image size. Example: \'thumbnail\', \'medium\', \'large\', \'full\' or other sizes defined by current theme.', 'omniverse' ),
		'group'       => esc_html__( 'Project options', 'omniverse' ),
		'type'        => 'text_input',
		'section'     => 'portfolio_archive_section',
		'default'     => 'large',
		'priority'    => 80,
	)
);

Options::add_field(
	array(
		'id'          => 'portoflio_filters',
		'name'        => esc_html__( 'Show categories filters', 'omniverse' ),
		'hint'     => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'show-categories-filters.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Display categories list that allows you to filter your portfolio projects.', 'omniverse' ),
		'group'       => esc_html__( 'Project options', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'portfolio_archive_section',
		'default'     => '1',
		'on-text'     => esc_html__( 'Yes', 'omniverse' ),
		'off-text'    => esc_html__( 'No', 'omniverse' ),
		'priority'    => 90,
	)
);

Options::add_field(
	array(
		'id'          => 'portfolio_filters_type',
		'type'        => 'buttons',
		'name'        => esc_html__( 'Categories filters', 'omniverse' ),
		'description' => esc_html__( 'You can switch between links that will lead to project categories and masonry filters within one page only. Or turn off the filters completely.', 'omniverse' ),
		'group'       => esc_html__( 'Project options', 'omniverse' ),
		'section'     => 'portfolio_archive_section',
		'options'     => array(
			'links'   => array(
				'name'  => esc_html__( 'Links', 'omniverse' ),
				'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'portfolio-categories-filters-links.mp4" autoplay loop muted></video>',
				'value' => 'links',
			),
			'masonry' => array(
				'name'  => esc_html__( 'Masonry', 'omniverse' ),
				'hint'        => '<video data-src="' . OMNIVERSE_TOOLTIP_URL . 'portfolio-categories-filters-masonry.mp4" autoplay loop muted></video>',
				'value' => 'masonry',
			),
		),
		'requires'    => array(
			array(
				'key'     => 'portoflio_filters',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
		'default'     => 'links',
		'priority'    => 100,
	)
);

Options::add_field(
	array(
		'id'          => 'ajax_portfolio',
		'type'        => 'switcher',
		'name'        => esc_html__( 'AJAX portfolio', 'omniverse' ),
		'description' => esc_html__( 'Use AJAX functionality for portfolio categories links.', 'omniverse' ),
		'group'       => esc_html__( 'Project options', 'omniverse' ),
		'section'     => 'portfolio_archive_section',
		'requires'    => array(
			array(
				'key'     => 'portfolio_filters_type',
				'compare' => 'equals',
				'value'   => 'links',
			),
			array(
				'key'     => 'portoflio_filters',
				'compare' => 'equals',
				'value'   => '1',
			),
		),
		'default'     => '1',
		'priority'    => 110,
	)
);

/**
 * Portfolio single.
 */
Options::add_field(
	array(
		'id'          => 'single_portfolio_header',
		'name'        => esc_html__( 'Custom single project header', 'omniverse' ),
		'description' => esc_html__( 'You can use different header for your single portfolio page.', 'omniverse' ),
		'type'        => 'select',
		'section'     => 'portfolio_singe_project_section',
		'options'     => '',
		'callback'    => 'omniverse_get_theme_settings_headers_array',
		'select2'     => true,
		'default'     => 'none',
		'priority'    => 10,
	)
);

Options::add_field(
	array(
		'id'          => 'single_portfolio_title_in_page_title',
		'name'        => esc_html__( 'Project name in page title', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'project-title-in-page-heading.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Display project title instead of portfolio page title in page heading', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'portfolio_singe_project_section',
		'default'     => false,
		'priority'    => 20,
	)
);

Options::add_field(
	array(
		'id'          => 'portfolio_navigation',
		'name'        => esc_html__( 'Projects navigation', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'portfolio-projects-navigation.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Next and previous projects links on single project page', 'omniverse' ),
		'group'       => esc_html__( 'Elements', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'portfolio_singe_project_section',
		'default'     => '1',
		'priority'    => 30,
		'class'       => 'dn-col-6',
	)
);

Options::add_field(
	array(
		'id'          => 'portfolio_related',
		'name'        => esc_html__( 'Related projects', 'omniverse' ),
		'hint'        => wp_kses( __( '<img data-src="' . OMNIVERSE_TOOLTIP_URL . 'project-related-projects.jpg" alt="">', 'omniverse' ), true ),
		'description' => esc_html__( 'Show related projects carousel.', 'omniverse' ),
		'group'       => esc_html__( 'Elements', 'omniverse' ),
		'type'        => 'switcher',
		'section'     => 'portfolio_singe_project_section',
		'default'     => '1',
		'priority'    => 40,
		'class'       => 'dn-col-6',
	)
);
