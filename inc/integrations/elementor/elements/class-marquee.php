<?php
/**
 * Marquee element.
 *
 * @package dn
 */

namespace DN\Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Marquee extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_marquee';
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
		return esc_html__( 'Marquee', 'omniverse' );
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
		return 'wd-icon-marquee';
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
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'marquee' );
	}

	/**
	 * Register the widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		/**
		 * General settings
		 */
		$this->start_controls_section(
			'general_section',
			array(
				'label' => esc_html__( 'General', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_responsive_control(
			'speed',
			array(
				'label'       => esc_html__( 'Scrolling speed', 'omniverse' ),
				'description' => esc_html__( 'Duration of one animation cycle (in seconds)', 'omniverse' ),
				'placeholder' => '5',
				'type'        => Controls_Manager::NUMBER,
				'selectors'   => array(
					'{{WRAPPER}} .wd-marquee' => '--wd-marquee-speed: {{VALUE}}s;',
				),
			)
		);

		$this->add_control(
			'direction',
			array(
				'label'     => esc_html__( 'Scrolling direction', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''                  => esc_html__( 'Right to left', 'omniverse' ),
					'reverse'           => esc_html__( 'Left to right', 'omniverse' ),
					'alternate'         => esc_html__( 'Right to left and reverse', 'omniverse' ),
					'alternate-reverse' => esc_html__( 'Left to right and reverse', 'omniverse' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .wd-marquee' => '--wd-marquee-direction: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'paused_on_hover',
			array(
				'label'        => esc_html__( 'Pause on hover', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		/**
		 * Content settings
		 */
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			array(
				'label'   => esc_html__( 'Text', 'omniverse' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Link', 'omniverse' ),
				'description' => esc_html__( 'Enter URL if you want this banner to have a link.', 'omniverse' ),
				'type'        => Controls_Manager::URL,
				'default'     => array(
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				),
			)
		);

		$repeater->add_control(
			'icon_type',
			array(
				'label'   => esc_html__( 'Icon type', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'omniverse' ),
					'image'   => esc_html__( 'With image', 'omniverse' ),
				),
				'default' => 'inherit',
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'     => esc_html__( 'Choose image', 'omniverse' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => array(
					'icon_type' => array( 'image' ),
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image',
				'default'   => 'thumbnail',
				'separator' => 'none',
				'condition' => array(
					'icon_type' => array( 'image' ),
				),
			)
		);

		$this->add_control(
			'marquee_contents',
			array(
				'label'   => esc_html__( 'Marquee content', 'omniverse' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(),
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Icon settings.
		 */
		$this->start_controls_section(
			'icon_content_section',
			array(
				'label' => esc_html__( 'Icon', 'omniverse' ),
			)
		);

		$this->add_control(
			'icon_type',
			array(
				'label'   => esc_html__( 'Type', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'icon'    => esc_html__( 'With icon', 'omniverse' ),
					'image'   => esc_html__( 'With image', 'omniverse' ),
					'without' => esc_html__( 'Without icon', 'omniverse' ),
				),
				'default' => 'without',
			)
		);

		$this->add_control(
			'image',
			array(
				'label'     => esc_html__( 'Choose image', 'omniverse' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => array(
					'icon_type' => array( 'image' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image',
				'default'   => 'thumbnail',
				'separator' => 'none',
				'condition' => array(
					'icon_type' => array( 'image' ),
				),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'     => esc_html__( 'Icon', 'omniverse' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-star',
					'library' => 'fa-solid',
				),
				'condition' => array(
					'icon_type' => array( 'icon' ),
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Content settings.
		 */
		$this->start_controls_section(
			'general_style_section',
			array(
				'label' => esc_html__( 'Content', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'marquee_typography',
				'label'    => esc_html__( 'Typography', 'omniverse' ),
				'selector' => '{{WRAPPER}} .wd-marquee',
			)
		);

		$this->add_control(
			'marquee_color',
			array(
				'label'     => esc_html__( 'Color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wd-marquee' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'content_gap',
			array(
				'label'     => esc_html__( 'Items gap', 'omniverse' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => '',
				),
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .wd-marquee' => '--wd-marquee-gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Icon settings.
		 */
		$this->start_controls_section(
			'icon_style_section',
			array(
				'label'     => esc_html__( 'Icon', 'omniverse' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'icon_type' => array( 'icon' ),
				),
			)
		);

		$this->add_control(
			'marquee_icon_color',
			array(
				'label'     => esc_html__( 'Color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wd-marquee .wd-icon' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'icon_type' => array( 'icon' ),
				),
			)
		);

		$this->add_control(
			'marquee_icon_size',
			array(
				'label'     => esc_html__( 'Size', 'omniverse' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .wd-marquee .wd-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'icon_type' => array( 'icon' ),
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
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			array(
				'wrapper' => array(
					'class'          => array(
						'wd-marquee',
						'yes' === $settings['paused_on_hover'] ? 'wd-with-pause' : '',
					),
				),
			)
		);

		$icon_output = '';

		if ( 'image' === $settings['icon_type'] && ! empty( $settings['image']['id'] ) ) {
			$icon_output = omniverse_otf_get_image_html( $settings['image']['id'], $settings['image_size'], $settings['image_custom_dimension'] );

			if ( omniverse_is_svg( $settings['image']['url'] ) ) {
				if ( 'custom' === $settings['image_size'] && ! empty( $settings['image_custom_dimension'] ) ) {
					$icon_output = omniverse_get_svg_html( $settings['image']['id'], $settings['image_custom_dimension'] );
				} else {
					$icon_output = omniverse_get_svg_html( $settings['image']['id'], $settings['image_size'] );
				}
			}
		} elseif ( 'icon' === $settings['icon_type'] && ! empty( $settings['icon'] ) ) {
			$icon_output = omniverse_elementor_get_render_icon( $settings['icon'], array( 'class' => 'wd-marquee-icon wd-icon' ) );
		}

		$custom_image_size = ! empty( $settings['image_custom_dimension']['width'] ) ? $settings['image_custom_dimension'] : array(
			'width'  => 128,
			'height' => 128,
		);

		$shortcode_html = '';

		foreach ( $settings['marquee_contents'] as $index => $item ) {
			$item_icon_output      = $icon_output;
			$item['image_size']    = ! empty( $item['image_size'] ) ? $item['image_size'] : 'thumbnail';
			$item['link']['class'] = 'wd-fill';
			$link_attrs            = omniverse_get_link_attrs( $item['link'] );

			if ( empty( $item['image_custom_dimension']['width'] ) ) {
				$item['image_custom_dimension'] = $custom_image_size;
			}

			if ( 'image' === $item['icon_type'] && ! empty( $item['image']['id'] ) ) {
				$item_icon_output = omniverse_otf_get_image_html( $item['image']['id'], $item['image_size'], $item['image_custom_dimension'] );

				if ( omniverse_is_svg( $item['image']['url'] ) ) {
					if ( 'custom' === $item['image_size'] && ! empty( $item['image_custom_dimension'] ) ) {
						$icon_output_size = $item['image_custom_dimension'];
					} else {
						$icon_output_size = $item['image_size'];
					}

					$item_icon_output = omniverse_get_svg_html( $item['image']['id'], $icon_output_size );
				}
			}

			ob_start();

			?>
			<span>
				<?php echo ! empty( $item_icon_output ) ? $item_icon_output : $icon_output; // phpcs:ignore.?>

				<?php if ( ! empty( $item['text'] ) ) : ?>
					<?php echo do_shortcode( shortcode_unautop( $item['text'] ) ); ?>
				<?php endif; ?>

				<?php if ( isset( $item['link']['url'] ) && $item['link']['url'] ) : ?>
					<a <?php echo $link_attrs; // phpcs:ignore. ?> aria-label="<?php esc_attr_e( 'Marquee item link', 'omniverse' ); ?>"></a>
				<?php endif; ?>
			</span>
			<?php
			$shortcode_html .= ob_get_clean();
		}

		omniverse_enqueue_inline_style( 'marquee' );

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); // phpcs:ignore.?>>
			<div class="wd-marquee-content">
				<?php echo $shortcode_html; // phpcs:ignore. ?>
			</div>
			<div class="wd-marquee-content">
				<?php echo $shortcode_html; // phpcs:ignore. ?>
			</div>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Marquee() );
