<?php
/**
 * Title map.
 *
 * @package dn
 */

namespace DN\Elementor;

use Elementor\Control_Media;
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
class Images_Gallery extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wd_images_gallery';
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
		return esc_html__( 'Images gallery', 'omniverse' );
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
		return 'wd-icon-images-gallery';
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
			'ids',
			array(
				'label'   => esc_html__( 'Images', 'omniverse' ),
				'type'    => Controls_Manager::GALLERY,
				'default' => array(),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'ids', // Need images id.
				'default'   => 'large',
				'separator' => 'none',
			)
		);

		$this->end_controls_section();

		/**
		 * Click action settings.
		 */
		$this->start_controls_section(
			'click_action_section',
			array(
				'label' => esc_html__( 'Click action', 'omniverse' ),
			)
		);

		$this->add_control(
			'on_click',
			array(
				'label'   => esc_html__( 'On click action', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'lightbox' => esc_html__( 'Lightbox', 'omniverse' ),
					'links'    => esc_html__( 'Custom link', 'omniverse' ),
					'none'     => esc_html__( 'None', 'omniverse' ),
				),
				'default' => 'lightbox',
			)
		);

		$this->add_control(
			'target_blank',
			array(
				'label'        => esc_html__( 'Open in new tab', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '0',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => '1',
				'condition'    => array(
					'on_click' => array( 'links' ),
				),
			)
		);

		$this->add_control(
			'caption',
			array(
				'label'        => esc_html__( 'Images captions', 'omniverse' ),
				'description'  => esc_html__( 'Display images captions below the images when you open them in lightbox. Captions are based on titles of your photos and can be edited in Dashboard -> Media.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '0',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => '1',
				'condition'    => array(
					'on_click' => array( 'lightbox' ),
				),
			)
		);

		$this->add_control(
			'custom_links',
			array(
				'label'       => esc_html__( 'Custom links', 'omniverse' ),
				'description' => esc_html__( 'Enter links for each slide (Note: divide links with linebreaks (Enter).', 'omniverse' ),
				'type'        => Controls_Manager::TEXTAREA,
				'condition'   => array(
					'on_click' => array( 'links' ),
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Extra settings.
		 */
		$this->start_controls_section(
			'extra_content_section',
			array(
				'label' => esc_html__( 'Extra', 'omniverse' ),
			)
		);

		$this->add_control(
			'lazy_loading',
			array(
				'label'        => esc_html__( 'Lazy loading for images', 'omniverse' ),
				'description'  => esc_html__( 'Enable lazy loading for images for this element.', 'omniverse' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => esc_html__( 'Yes', 'omniverse' ),
				'label_off'    => esc_html__( 'No', 'omniverse' ),
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		/**
		 * Style tab.
		 */

		/**
		 * Layout settings.
		 */
		$this->start_controls_section(
			'layout_style_section',
			array(
				'label' => esc_html__( 'Layout', 'omniverse' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'view',
			array(
				'label'   => esc_html__( 'View', 'omniverse' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'grid'      => esc_html__( 'Default grid', 'omniverse' ),
					'masonry'   => esc_html__( 'Masonry grid', 'omniverse' ),
					'carousel'  => esc_html__( 'Carousel', 'omniverse' ),
					'justified' => esc_html__( 'Justified gallery', 'omniverse' ),
				),
				'default' => 'grid',
			)
		);

		$this->add_responsive_control(
			'spacing',
			array(
				'label'     => esc_html__( 'Space between', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					0  => esc_html__( '0 px', 'omniverse' ),
					2  => esc_html__( '2 px', 'omniverse' ),
					6  => esc_html__( '6 px', 'omniverse' ),
					10 => esc_html__( '10 px', 'omniverse' ),
					20 => esc_html__( '20 px', 'omniverse' ),
					30 => esc_html__( '30 px', 'omniverse' ),
				),
				'default'   => '0',
				'devices'   => array( 'desktop', 'tablet', 'mobile' ),
				'classes'   => 'wd-hide-custom-breakpoints',
				'condition' => array(
					'view!' => array( 'justified' ),
				),
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'       => esc_html__( 'Columns', 'omniverse' ),
				'description' => esc_html__( 'Number of columns in the grid.', 'omniverse' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => array(
					'size' => 3,
				),
				'size_units'  => '',
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					),
				),
				'devices'     => array( 'desktop', 'tablet', 'mobile' ),
				'classes'     => 'wd-hide-custom-breakpoints',
				'condition'   => array(
					'view' => array( 'grid', 'masonry' ),
				),
			)
		);

		$this->add_control(
			'rounding_size',
			array(
				'label'     => esc_html__( 'Rounding', 'omniverse' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''       => esc_html__( 'Inherit', 'omniverse' ),
					'0'      => esc_html__( '0', 'omniverse' ),
					'5'      => esc_html__( '5', 'omniverse' ),
					'8'      => esc_html__( '8', 'omniverse' ),
					'12'     => esc_html__( '12', 'omniverse' ),
					'custom' => esc_html__( 'Custom', 'omniverse' ),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}}' => '--wd-brd-radius: {{VALUE}}px;',
				),
			)
		);

		$this->add_control(
			'custom_rounding_size',
			array(
				'label'      => esc_html__( 'Custom rounding', 'omniverse' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}}' => '--wd-brd-radius: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'rounding_size' => array( 'custom' ),
				),
			)
		);

		$this->add_control(
			'horizontal_align',
			array(
				'label'     => esc_html__( 'Horizontal  align', 'omniverse' ),
				'type'      => 'wd_buttons',
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/horizontal/left.png',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/horizontal/center.png',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/horizontal/right.png',
					),
				),
				'default'   => 'center',
				'condition' => array(
					'view' => array( 'grid', 'masonry', 'carousel' ),
				),
			)
		);

		$this->add_control(
			'vertical_align',
			array(
				'label'     => esc_html__( 'Vertical  align', 'omniverse' ),
				'type'      => 'wd_buttons',
				'options'   => array(
					'top'    => array(
						'title' => esc_html__( 'Top', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/vertical/top.png',
					),
					'middle' => array(
						'title' => esc_html__( 'Middle', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/vertical/middle.png',
					),
					'bottom' => array(
						'title' => esc_html__( 'Bottom', 'omniverse' ),
						'image' => OMNIVERSE_ASSETS_IMAGES . '/settings/content-align/vertical/bottom.png',
					),
				),
				'default'   => 'middle',
				'condition' => array(
					'view' => array( 'grid', 'masonry', 'carousel' ),
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
		$default_settings = array(
			'ids'                    => '',
			'slides_per_view'        => array( 'size' => 4 ),
			'slides_per_view_tablet' => array( 'size' => '' ),
			'slides_per_view_mobile' => array( 'size' => '' ),
			'columns'                => array( 'size' => 3 ),
			'columns_tablet'         => array( 'size' => '' ),
			'columns_mobile'         => array( 'size' => '' ),
			'link'                   => '',
			'spacing'                => 0,
			'on_click'               => 'lightbox',
			'target_blank'           => false,
			'custom_links'           => '',
			'view'                   => 'grid',
			'caption'                => false,
			'lazy_loading'           => 'no',
			'horizontal_align'       => 'center',
			'vertical_align'         => 'middle',
			'custom_sizes'           => apply_filters( 'omniverse_images_gallery_shortcode_custom_sizes', false ),
		);

		$settings = wp_parse_args( $this->get_settings_for_display(), array_merge( omniverse_get_carousel_atts(), $default_settings ) );

		$settings['columns']         = isset( $settings['columns']['size'] ) ? $settings['columns']['size'] : 3;
		$settings['slides_per_view'] = isset( $settings['slides_per_view']['size'] ) ? $settings['slides_per_view']['size'] : 3;

		$this->add_render_attribute(
			array(
				'wrapper' => array(
					'class' => array(
						'wd-images-gallery',
					),
				),
				'item'    => array(
					'class' => array(
						'wd-gallery-item',
					),
				),
			)
		);

		$v_align_value = array(
			'top'    => 'flex-start',
			'middle' => 'center',
			'bottom' => 'flex-end',
		);

		if ( isset( $v_align_value[ $settings['vertical_align'] ] ) ) {
			$this->add_render_attribute( 'wrapper', 'style', '--wd-align-items:' . $v_align_value[ $settings['vertical_align'] ] . ';' );
		}

		if ( ! empty( $settings['horizontal_align'] ) ) {
			$this->add_render_attribute( 'wrapper', 'style', '--wd-justify-content:' . $settings['horizontal_align'] . ';' );
		}

		$carousel_atts = '';

		if ( 'lightbox' === $settings['on_click'] ) {
			omniverse_enqueue_js_library( 'photoswipe-bundle' );
			omniverse_enqueue_inline_style( 'photoswipe' );
			omniverse_enqueue_js_script( 'photoswipe-images' );
			$this->add_render_attribute( 'wrapper', 'class', 'photoswipe-images' );
		}

		if ( 'masonry' === $settings['view'] ) {
			$this->add_render_attribute( 'gallery', 'class', 'wd-masonry' );

			wp_enqueue_script( 'imagesloaded' );
			omniverse_enqueue_js_library( 'isotope-bundle' );
			omniverse_enqueue_js_script( 'image-gallery-element' );
		}

		if ( 'justified' === $settings['view'] ) {
			$this->add_render_attribute( 'gallery', 'class', 'wd-justified' );

			omniverse_enqueue_js_library( 'justified' );
			omniverse_enqueue_inline_style( 'justified' );
			omniverse_enqueue_js_script( 'image-gallery-element' );
		}

		if ( 'carousel' === $settings['view'] ) {
			omniverse_enqueue_js_library( 'swiper' );
			omniverse_enqueue_js_script( 'swiper-carousel' );
			omniverse_enqueue_inline_style( 'swiper' );

			if ( ! empty( $settings['slides_per_view_tablet']['size'] ) || ! empty( $settings['slides_per_view_mobile']['size'] ) ) {
				$settings['custom_sizes'] = array(
					'desktop' => $settings['slides_per_view'],
					'tablet'  => $settings['slides_per_view_tablet']['size'],
					'mobile'  => $settings['slides_per_view_mobile']['size'],
				);
			}

			$carousel_atts = omniverse_get_carousel_attributes( $settings );

			$this->add_render_attribute( 'wrapper', 'class', 'wd-carousel-container' );

			$this->add_render_attribute( 'gallery', 'class', 'wd-carousel wd-grid' );

			$this->add_render_attribute( 'item', 'class', 'wd-carousel-item' );

			if ( 'yes' === $settings['scroll_carousel_init'] ) {
				omniverse_enqueue_js_library( 'waypoints' );
				$this->add_render_attribute( 'gallery', 'class', 'scroll-init' );
			}

			if ( omniverse_get_opt( 'disable_owl_mobile_devices' ) ) {
				$this->add_render_attribute( 'wrapper', 'class', 'wd-carousel-dis-mb wd-off-md wd-off-sm' );
			}
		}

		if ( 'grid' === $settings['view'] || 'masonry' === $settings['view'] ) {
			if ( 'masonry' === $settings['view'] ) {
				$this->add_render_attribute( 'gallery', 'class', 'wd-grid-f-col' );
			} else {
				$this->add_render_attribute( 'gallery', 'class', 'wd-grid-g' );
			}

			$this->add_render_attribute( 'item', 'class', 'wd-col' );

			$this->add_render_attribute( 'gallery', 'style', omniverse_get_grid_attrs( $settings ) );
		}

		if ( 'yes' === $settings['lazy_loading'] ) {
			omniverse_lazy_loading_init( true );
			omniverse_enqueue_inline_style( 'lazy-loading' );
		}

		if ( count( $settings['ids'] ) < 1 ) {
			return;
		}

		omniverse_enqueue_inline_style( 'image-gallery' );

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( 'carousel' === $settings['view'] ) : ?>
				<div class="wd-carousel-inner">
			<?php endif; ?>
			<div <?php echo $this->get_render_attribute_string( 'gallery' ); ?> <?php echo 'carousel' === $settings['view'] ? $carousel_atts : ''; ?>>
				<?php if ( 'carousel' === $settings['view'] ) : ?>
					<div class="wd-carousel-wrap">
				<?php endif; ?>
				<?php foreach ( $settings['ids'] as $index => $image ) : ?>
					<?php
					$image_url = omniverse_otf_get_image_url( $image['id'], $settings['ids_size'], $settings['ids_custom_dimension'] );

					if ( ! $image_url ) {
						continue;
					}

					if ( apply_filters( 'omniverse_image_gallery_caption', false ) ) {
						$title = wp_get_attachment_caption( $image['id'] );
					} else {
						$attachment = get_post( $image['id'] );
						$title      = trim( wp_strip_all_tags( $attachment->post_title ) );
					}

					$image_data = wp_get_attachment_image_src( $image['id'], 'full' );
					$link       = $image_data[0];

					if ( 'links' === $settings['on_click'] ) {
						$custom_links = explode( "\n", $settings['custom_links'] );
						$link         = isset( $custom_links[ $index ] ) ? $custom_links[ $index ] : '';
					}

					if ( 'lightbox' === $settings['on_click'] ) {
						$index++;
					}

					$link_attrs = omniverse_get_link_attrs(
						array(
							'url'  => $link,
							'data' => 'data-width="' . esc_attr( $image_data[1] ) . '" data-height="' . esc_attr( $image_data[2] ) . '" data-index="' . esc_attr( $index ) . '" data-elementor-open-lightbox="no"',
						)
					);

					if ( $settings['target_blank'] ) {
						$link_attrs .= ' target="_blank"';
					}

					if ( $settings['caption'] ) {
						$link_attrs .= ' title="' . $title . '"';
					}

					?>
					<div <?php echo $this->get_render_attribute_string( 'item' ); ?>>
						<?php if ( 'none' !== $settings['on_click'] ) : ?>
							<a <?php echo $link_attrs; ?>>
						<?php endif ?>

						<?php echo apply_filters( 'omniverse_image', '<img src="' . esc_url( $image_url ) . '"alt="' . esc_attr( Control_Media::get_image_alt( $image ) ) . '">' ); ?>

						<?php if ( 'none' !== $settings['on_click'] ) : ?>
							</a>
						<?php endif ?>
					</div>
					<?php endforeach; ?>
					<?php if ( 'carousel' === $settings['view'] ) : ?>
						</div>
					<?php endif; ?>
			</div>
			<?php if ( 'carousel' === $settings['view'] ) : ?>
				<?php if ( 'yes' !== $settings['hide_prev_next_buttons'] ) : ?>
					<?php
					if ( ! empty( $settings['carousel_arrows_position'] ) ) {
						$nav_classes = ' wd-pos-' . $settings['carousel_arrows_position'];
					} else {
						$nav_classes = ' wd-pos-' . omniverse_get_opt( 'carousel_arrows_position', 'sep' );
					}

					$arrows_hover_style = omniverse_get_opt( 'carousel_arrows_hover_style', '1' );

					if ( 'disable' !== $arrows_hover_style ) {
						$nav_classes .= ' wd-hover-' . $arrows_hover_style;
					}

					omniverse_get_carousel_nav_template( $nav_classes );
					?>
				<?php endif; ?>

				</div>

				<?php omniverse_get_carousel_pagination_template( $settings ); ?>
				<?php omniverse_get_carousel_scrollbar_template( $settings ); ?>
			<?php endif; ?>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Images_Gallery() );
