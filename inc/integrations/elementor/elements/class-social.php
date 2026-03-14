<?php
/**
 * Social buttons map.
 */

namespace DN\Elementor;

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Social extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_social_buttons';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Social buttons', 'omniverse' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'wd-icon-social';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'wd-elements' );
	}

	/**
	 * Register the widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		/**
		 * Content tab.
		 */

		/**
		 * General settings.
		 */
		$this->start_controls_section(
			'general_content_section',
			array(
				'label' => esc_html__( 'General', 'omniverse' ),
			)
		);

		$this->add_control(
			'show_label',
			array(
				'label'        => esc_html__( 'Label', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'On', 'omniverse' ),
				'label_off'    => esc_html__( 'Off', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'label_text',
			array(
				'label'     => esc_html__( 'Label text', 'omniverse' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Share: ', 'omniverse' ),
				'condition' => array(
					'show_label' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'type',
			array(
				'label'   => esc_html__( 'Type', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'share'  => esc_html__( 'Share', 'omniverse' ),
					'follow' => esc_html__( 'Follow', 'omniverse' ),
				),
				'default' => 'share',
			)
		);

		$this->add_control(
			'social_links_source',
			array(
				'label'     => esc_html__( 'Social links source', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'theme_settings' => esc_html__( 'Theme Options', 'omniverse' ),
					'custom'         => esc_html__( 'Custom', 'omniverse' ),
				),
				'default'   => 'theme_settings',
				'condition' => array(
					'type' => array( 'follow' ),
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Links to social profiles.
		 */
		$this->start_controls_section(
			'social_links_content_section',
			array(
				'label'     => esc_html__( 'Links to social profiles', 'omniverse' ),
				'condition' => array(
					'type'                 => array( 'follow' ),
					'social_links_source' => array( 'custom' ),
				),
			)
		);

		$this->add_control(
			'fb_link',
			array(
				'label'   => esc_html__( 'Facebook link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '#',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'twitter_link',
			array(
				'label'   => esc_html__( 'X link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '#',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'isntagram_link',
			array(
				'label'   => esc_html__( 'Instagram link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '#',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'pinterest_link',
			array(
				'label'   => esc_html__( 'Pinterest link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '#',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'youtube_link',
			array(
				'label'   => esc_html__( 'Youtube link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '#',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'tumblr_link',
			array(
				'label'   => esc_html__( 'Tumblr link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'linkedin_link',
			array(
				'label'   => esc_html__( 'LinkedIn link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'vimeo_link',
			array(
				'label'   => esc_html__( 'Vimeo link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'flickr_link',
			array(
				'label'   => esc_html__( 'Flickr link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'github_link',
			array(
				'label'   => esc_html__( 'Github link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'dribbble_link',
			array(
				'label'   => esc_html__( 'Dribbble link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'behance_link',
			array(
				'label'   => esc_html__( 'Behance link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'soundcloud_link',
			array(
				'label'   => esc_html__( 'SoundCloud link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'spotify_link',
			array(
				'label'   => esc_html__( 'Spotify link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'ok_link',
			array(
				'label'   => esc_html__( 'OK link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'vk_link',
			array(
				'label'   => esc_html__( 'VK link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'whatsapp_link',
			array(
				'label'   => esc_html__( 'WhatsApp link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'snapchat_link',
			array(
				'label'   => esc_html__( 'Snapchat link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'tg_link',
			array(
				'label'   => esc_html__( 'Telegram link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'tiktok_link',
			array(
				'label'   => esc_html__( 'TikTok link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->add_control(
			'discord_link',
			array(
				'label'   => esc_html__( 'Discord link', 'omniverse' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'ai'      => array(
					'active' => false,
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Style tab.
		 */

		/**
		 * General settings.
		 */
		$this->start_controls_section(
			'general_style_section',
			array(
				'label'     => esc_html__( 'General', 'omniverse' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'     => esc_html__( 'Layout', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''        => esc_html__( 'Default', 'omniverse' ),
					'justify' => esc_html__( 'Justify', 'omniverse' ),
					'inline'  => esc_html__( 'Inline', 'omniverse' ),
				),
				'default'   => '',
				'condition' => array(
					'show_label' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'align',
			array(
				'label'     => esc_html__( 'Align', 'omniverse' ),
				'type'      => 'wd_buttons',
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/left.jpg',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/center.jpg',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/align/right.jpg',
					),
				),
				'default'   => 'center',
			)
		);

		$this->end_controls_section();

		/**
		 * Icons settings.
		 */
		$this->start_controls_section(
			'icons_style_section',
			array(
				'label' => esc_html__( 'Icons', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => esc_html__( 'Style', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'default'     => esc_html__( 'Default', 'omniverse' ),
					'simple'      => esc_html__( 'Simple', 'omniverse' ),
					'colored'     => esc_html__( 'Colored', 'omniverse' ),
					'colored-alt' => esc_html__( 'Colored alternative', 'omniverse' ),
					'bordered'    => esc_html__( 'Bordered', 'omniverse' ),
					'primary'     => esc_html__( 'Primary color', 'omniverse' ),
				),
				'default' => 'default',
			)
		);

		$this->add_control(
			'form',
			array(
				'label'   => esc_html__( 'Form', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'circle'  => esc_html__( 'Circle', 'omniverse' ),
					'square'  => esc_html__( 'Square', 'omniverse' ),
					'rounded' => esc_html__( 'Rounded', 'omniverse' ),
				),
				'default' => 'circle',
			)
		);

		$this->add_control(
			'size',
			array(
				'label'   => esc_html__( 'Size', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'default' => esc_html__( 'Default (18px)', 'omniverse' ),
					'small'   => esc_html__( 'Small (14px)', 'omniverse' ),
					'large'   => esc_html__( 'Large (22px)', 'omniverse' ),
				),
				'default' => 'default',
			)
		);

		$this->add_control(
			'color',
			array(
				'label'   => esc_html__( 'Color', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'dark'  => esc_html__( 'Dark', 'omniverse' ),
					'light' => esc_html__( 'Light', 'omniverse' ),
				),
				'default' => 'dark',
			)
		);

		$this->end_controls_section();

		/**
		 * Label settings.
		 */
		$this->start_controls_section(
			'label_style_section',
			array(
				'label'     => esc_html__( 'Label', 'omniverse' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_label' => array( 'yes' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label'     => esc_html__( 'Typography', 'omniverse' ),
				'name'      => 'title_typography',
				'selector'  => '{{WRAPPER}} .wd-social-icons .wd-label',
				'condition' => array(
					'show_label' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'label_color',
			array(
				'label'     => esc_html__( 'Label color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wd-social-icons .wd-label' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_label' => array( 'yes' ),
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = wp_parse_args(
			$this->get_settings_for_display(),
			array(
				'elementor'            => true,
				'layout'               => '',
				'social_links_source' => 'theme_settings',
				// Label settings.
				'show_label'           => 'no',
				'label_text'           => esc_html__( 'Share: ', 'omniverse' ),
				'is_element'           => true,
			)
		);

		omniverse_shortcode_social( $settings );
	}
}

Plugin::instance()->widgets_manager->register( new Social() );
