<?php
/**
 * Title map.
 *
 * @package dn
 */

namespace DN\Elementor;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * Elementor widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Title extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_title';
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
		return esc_html__( 'Section title', 'omniverse' );
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
		return 'wd-icon-title';
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
			'extra_width_classes',
			array(
				'type'         => 'wd_css_class',
				'default'      => 'wd-width-100',
				'prefix_class' => '',
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'   => esc_html__( 'Subtitle', 'omniverse' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Subtitle text example',
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'omniverse' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Title text example',
			)
		);

		$this->add_control(
			'after_title',
			array(
				'label'   => esc_html__( 'Text', 'omniverse' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => 'Text after title text example',
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
				'label' => esc_html__( 'General', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => esc_html__( 'Style', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'default'      => esc_html__( 'Default', 'omniverse' ),
					'simple'       => esc_html__( 'Simple', 'omniverse' ),
					'bordered'     => esc_html__( 'Bordered', 'omniverse' ),
					'underlined'   => esc_html__( 'Underlined', 'omniverse' ),
					'underlined-2' => esc_html__( 'Underlined 2', 'omniverse' ),
					'overlined'    => esc_html__( 'Overlined', 'omniverse' ),
					'shadow'       => esc_html__( 'Shadow', 'omniverse' ),
					'image'        => esc_html__( 'With image', 'omniverse' ),
				),
				'default' => 'default',
			)
		);

		$this->add_control(
			'color',
			array(
				'label'   => esc_html__( 'Predefined color', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'default'  => esc_html__( 'Default', 'omniverse' ),
					'primary'  => esc_html__( 'Primary', 'omniverse' ),
					'alt'      => esc_html__( 'Alternative', 'omniverse' ),
					'black'    => esc_html__( 'Black', 'omniverse' ),
					'white'    => esc_html__( 'White', 'omniverse' ),
					'gradient' => esc_html__( 'Gradient', 'omniverse' ),
				),
				'default' => 'default',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'color_gradient',
				'label'     => esc_html__( 'Background', 'omniverse' ),
				'types'     => array( 'gradient' ),
				'selector'  => '{{WRAPPER}} .omniverse-title-container',
				'condition' => array(
					'color' => 'gradient',
				),
			)
		);

		$this->add_control(
			'size',
			array(
				'label'   => esc_html__( 'Predefined size', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'default'     => esc_html__( 'Default (22px)', 'omniverse' ),
					'small'       => esc_html__( 'Small (18px)', 'omniverse' ),
					'medium'      => esc_html__( 'Medium (26px)', 'omniverse' ),
					'large'       => esc_html__( 'Large (36px)', 'omniverse' ),
					'extra-large' => esc_html__( 'Extra Large (46px)', 'omniverse' ),
				),
				'default' => 'default',
			)
		);

		$this->add_control(
			'align',
			array(
				'label'   => esc_html__( 'Align', 'omniverse' ),
				'type'    => 'wd_buttons',
				'options' => array(
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
				'default' => 'center',
			)
		);

		$this->add_responsive_control(
			'width',
			array(
				'label'          => esc_html__( 'Width', 'omniverse' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array(
					'unit' => '%',
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'size_units'     => array( '%', 'px' ),
				'range'          => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
				),
				'selectors'      => array(
					'{{WRAPPER}} .title-after_title, {{WRAPPER}} .title-subtitle, {{WRAPPER}} .omniverse-title-container' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Subtitle settings.
		 */
		$this->start_controls_section(
			'subtitle_style_section',
			array(
				'label' => esc_html__( 'Subtitle', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'subtitle_style',
			array(
				'label'   => esc_html__( 'Style', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'default'    => esc_html__( 'Default', 'omniverse' ),
					'background' => esc_html__( 'Background', 'omniverse' ),
				),
				'default' => 'default',
			)
		);

		$this->add_control(
			'subtitle_color',
			array(
				'label'     => esc_html__( 'Color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .title-subtitle' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'subtitle_bg_color',
			array(
				'label'     => esc_html__( 'Background color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .title-subtitle' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'subtitle_style' => 'background',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'subtitle_typography',
				'label'    => esc_html__( 'Custom typography', 'omniverse' ),
				'selector' => '{{WRAPPER}} .title-subtitle',
			)
		);

		$this->end_controls_section();

		/**
		 * Title settings.
		 */
		$this->start_controls_section(
			'title_style_section',
			array(
				'label' => esc_html__( 'Title', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_decoration_style',
			array(
				'label'       => esc_html__( 'Highlight text style', 'omniverse' ),
				'description' => esc_html__( 'The text must be wrapped with the <u></u> tag to highlight it.', 'omniverse' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'default'     => esc_html__( 'Default', 'omniverse' ),
					'colored'     => esc_html__( 'Primary color', 'omniverse' ),
					'colored-alt' => esc_html__( 'Primary color + secondary font', 'omniverse' ),
					'bordered'    => esc_html__( 'Bordered', 'omniverse' ),
				),
				'default'     => 'default',
			)
		);

		$this->add_control(
			'image',
			array(
				'label'     => esc_html__( 'Choose image', 'omniverse' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => array(
					'style' => array( 'image' ),
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
					'style' => array( 'image' ),
				),
			)
		);

		$this->add_control(
			'tag',
			array(
				'label'   => esc_html__( 'Tag', 'omniverse' ),
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
				'default' => 'h4',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Custom typography', 'omniverse' ),
				'selector' => '{{WRAPPER}} .title',
			)
		);

		$this->end_controls_section();

		/**
		 * Text settings.
		 */
		$this->start_controls_section(
			'text_style_section',
			array(
				'label' => esc_html__( 'Text', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'Color', 'omniverse' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .title-after_title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_typography',
				'label'    => esc_html__( 'Custom typography', 'omniverse' ),
				'selector' => '{{WRAPPER}} .title-after_title',
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
		$default_settings = array(
			// General.
			'align'                  => 'center',
			'tag'                    => 'h4',
			'image'                  => '',
			'image_custom_dimension' => '',

			// Title.
			'title'                  => 'Title',
			'color'                  => 'default',
			'style'                  => 'default',
			'size'                   => 'default',
			'title_decoration_style' => 'default',

			// Subtitle.
			'subtitle'               => '',
			'subtitle_style'         => 'default',

			// Text.
			'after_title'            => '',
		);

		$settings     = wp_parse_args( $this->get_settings_for_display(), $default_settings );
		$image_output = '';

		$this->add_render_attribute(
			array(
				'wrapper'     => array(
					'class' => array(
						'title-wrapper set-mb-s reset-last-child',
						'wd-title-color-' . $settings['color'],
						'wd-title-style-' . $settings['style'],
						'wd-title-size-' . $settings['size'],
						'text-' . $settings['align'],
					),
				),
				'subtitle'    => array(
					'class' => array(
						'title-subtitle',
						'subtitle-color-' . $settings['color'],
						'subtitle-style-' . $settings['subtitle_style'],
						omniverse_get_new_size_classes( 'title', $settings['size'], 'subtitle' ),
					),
				),
				'title'       => array(
					'class' => array(
						'omniverse-title-container',
						'title',
						omniverse_get_new_size_classes( 'title', $settings['size'], 'title' ),
					),
				),
				'after_title' => array(
					'class' => array(
						'title-after_title set-cont-mb-s reset-last-child',
						omniverse_get_new_size_classes( 'title', $settings['size'], 'after_title' ),
					),
				),
			)
		);

		if ( 'default' !== $settings['title_decoration_style'] ) {
			$this->add_render_attribute( 'title', 'class', 'wd-underline-' . $settings['title_decoration_style'] );
		}

		$this->add_inline_editing_attributes( 'title' );
		$this->add_inline_editing_attributes( 'subtitle' );
		$this->add_inline_editing_attributes( 'after_title' );

		// Image settings.
		$custom_image_size = isset( $settings['image_custom_dimension']['width'] ) && $settings['image_custom_dimension']['width'] ? $settings['image_custom_dimension'] : array(
			'width'  => 128,
			'height' => 128,
		);

		if ( isset( $settings['image']['id'] ) && $settings['image']['id'] ) {
			$image_output = '<div class="img-wrapper">' . omniverse_otf_get_image_html( $settings['image']['id'], $settings['image_size'], $settings['image_custom_dimension'] ) . '</div>';

			if ( omniverse_is_svg( $settings['image']['url'] ) ) {
				$image_output = '<div class="img-wrapper"><span class="svg-icon" style="width:' . esc_attr( $custom_image_size['width'] ) . 'px; height:' . esc_attr( $custom_image_size['height'] ) . 'px;">' . omniverse_get_any_svg( $settings['image']['url'], rand( 999, 9999 ) ) . '</span></div>';
			}
		}

		omniverse_enqueue_inline_style( 'section-title' );

		if ( in_array( $settings['style'], array( 'bordered', 'simple' ), true ) ) {
			omniverse_enqueue_inline_style( 'section-title-style-simple-and-brd' );
		} elseif ( in_array( $settings['style'], array( 'overlined', 'underlined', 'underlined-2' ), true ) ) {
			omniverse_enqueue_inline_style( 'section-title-style-under-and-over' );
		}

		if ( isset( $settings['title_decoration_style'] ) && 'default' !== $settings['title_decoration_style'] ) {
			omniverse_enqueue_inline_style( 'mod-highlighted-text' );
		}

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>

			<?php if ( $settings['subtitle'] ) : ?>
				<div <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
					<?php echo nl2br( wp_kses( $settings['subtitle'], omniverse_get_allowed_html() ) ); ?>
				</div>
			<?php endif; ?>

			<div class="liner-continer">
				<<?php echo esc_attr( $settings['tag'] ); ?> <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo nl2br( wp_kses( $settings['title'], omniverse_get_allowed_html() ) ); ?></<?php echo esc_attr( $settings['tag'] ); ?>> <?php // Must be in one line Yoast SEO fix bug. ?>

				<?php if ( $image_output ) : ?>
					<?php echo $image_output; // phpcs:ignore ?>
				<?php endif; ?>
			</div>

			<?php if ( $settings['after_title'] ) : ?>
				<div <?php echo $this->get_render_attribute_string( 'after_title' ); ?>>
					<?php echo nl2br( wp_kses( $settings['after_title'], omniverse_get_allowed_html() ) ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Title() );
