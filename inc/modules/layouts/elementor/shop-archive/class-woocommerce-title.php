<?php
/**
 * Woocommerce title map.
 *
 * @package Omniverse
 */

namespace DN\Modules\Layouts;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 */
class Woocommerce_Title extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_shop_archive_woocommerce_title';
	}

	/**
	 * Get widget content.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'WooCommerce title', 'omniverse' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'wd-icon-sa-woocommerce-title';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'wd-shop-archive-elements' );
	}

	/**
	 * Show in panel.
	 *
	 * @return bool Whether to show the widget in the panel or not.
	 */
	public function show_in_panel() {
		return Main::is_layout_type( 'shop_archive' );
	}

	/**
	 * Register the widget controls.
	 */
	protected function register_controls() {
		/**
		 * Content tab
		 */

		/**
		 * General settings
		 */
		$this->start_controls_section(
			'general_content_section',
			array(
				'label' => esc_html__( 'General', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'css_classes',
			array(
				'type'         => 'wd_css_class',
				'default'      => 'wd-woo-page-title',
				'prefix_class' => '',
			)
		);

		$this->add_control(
			'text_alignment',
			array(
				'label'        => esc_html__( 'Text alignment', 'omniverse' ),
				'type'         => 'wd_buttons',
				'options'      => array(
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
				'prefix_class' => 'text-',
				'default'      => 'left',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label'    => esc_html__( 'Typography', 'omniverse' ),
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .title',
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'Text color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'tag',
			array(
				'label'   => esc_html__( 'Title tag', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1'   => esc_html__( 'h1', 'omniverse' ),
					'h2'   => esc_html__( 'h2', 'omniverse' ),
					'h3'   => esc_html__( 'h3', 'omniverse' ),
					'h4'   => esc_html__( 'h4', 'omniverse' ),
					'h5'   => esc_html__( 'h5', 'omniverse' ),
					'h6'   => esc_html__( 'h6', 'omniverse' ),
					'p'    => esc_html__( 'p', 'omniverse' ),
					'div'  => esc_html__( 'div', 'omniverse' ),
					'span' => esc_html__( 'span', 'omniverse' ),
				),
				'default' => 'span',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 */
	protected function render() {
		$settings = wp_parse_args(
			$this->get_settings_for_display(),
			array(
				'tag' => 'span',
			)
		);
		?>
		<<?php echo esc_attr( $settings['tag'] ); ?> class="entry-title title">
			<?php woocommerce_page_title(); ?>
		</<?php echo esc_attr( $settings['tag'] ); ?>>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Woocommerce_Title() );
