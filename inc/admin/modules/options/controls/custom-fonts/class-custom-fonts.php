<?php
/**
 * Upload your custom fonts.
 *
 * @package dn
 */

namespace DN\Admin\Modules\Options\Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use DN\Admin\Modules\Options\Field;

/**
 * Custom fonts control class.
 */
class Custom_Fonts extends Field {
	/**
	 * Default field value.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	private $_default_value = array(
		'font-name'   => '',
		'font-weight' => 400,
		'font-woff'   => array(
			'url' => '',
			'id'  => '',
		),
		'font-woff2'  => array(
			'url' => '',
			'id'  => '',
		),
		'font-ttf'    => array(
			'url' => '',
			'id'  => '',
		),
		'font-svg'    => array(
			'url' => '',
			'id'  => '',
		),
		'font-eot'    => array(
			'url' => '',
			'id'  => '',
		),
	);

	/**
	 * Contruct the object.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $args     Field args array.
	 * @param array  $options  Options from the database.
	 * @param string $type     Field type.
	 * @param string $object   Object.
	 */
	public function __construct( $args, $options, $type = 'options', $object = 'post' ) {
		parent::__construct( $args, $options, $type, $object );

		$this->args = $args;
	}

	/**
	 * Displays the field control HTML.
	 *
	 * @since 1.0.0
	 */
	public function render_control() {
		$value = $this->get_field_value();

		// get last index from the array.
		$key = 0;
		if ( is_array( $value ) ) {
			end( $value );
			$key = key( $value );
		}

		?>
			<div id="<?php echo esc_attr( $this->get_id() ); ?>" data-id="<?php echo esc_attr( $this->get_id() ); ?>" data-key="<?php echo esc_attr( $key ); ?>" class="dn-custom-fonts">

				<div class="dn-custom-fonts-sections">
					<?php if ( is_array( $value ) && count( $value ) > 0 ) : ?>
						<?php foreach ( $value as $index => $value ) : ?>
							<?php $this->render_section( $index ); ?>
						<?php endforeach; ?>
					<?php else : ?>
						<?php $this->render_section( 0 ); ?>
					<?php endif; ?>
				</div>

				<?php $this->section_template( false, $this->_default_value ); ?>

				<div class="dn-custom-fonts-btn-add dn-font-section-add dn-inline-btn dn-color-primary dn-i-add"><?php esc_html_e( 'Add font', 'omniverse' ); ?></div>

			</div>
		<?php
	}

	/**
	 * Renders one typography settings section based on index.
	 *
	 * @since 1.0.0
	 *
	 * @param integer $index  Section index.
	 */
	public function render_section( $index ) {
		$default_value = $this->_default_value;
		$value         = $this->get_field_value();
		$section_value = array();

		if ( '{{index}}' === $index ) {
			return;
		}

		if ( isset( $value[ $index ] ) ) {
			$section_value = wp_parse_args( $value[ $index ], $default_value );
		} else {
			$section_value = $default_value;
		}

		$this->section_template( $index, $section_value );
	}

	/**
	 * Displays the section template.
	 *
	 * @since 1.0.0
	 *
	 * @param integer $index  Section index.
	 * @param array   $section_value  Section data.
	 */
	public function section_template( $index, $section_value ) {
		$hide_class = false === $index ? ' dn-custom-fonts-template hide' : '';
		$index      = false === $index ? '{{index}}' : $index;

		$font_weight = array(
			esc_html__( 'Ultra-Light 100', 'omniverse' ) => 100,
			esc_html__( 'Light 200', 'omniverse' )       => 200,
			esc_html__( 'Book 300', 'omniverse' )        => 300,
			esc_html__( 'Normal 400', 'omniverse' )      => 400,
			esc_html__( 'Medium 500', 'omniverse' )      => 500,
			esc_html__( 'Semi-Bold 600', 'omniverse' )   => 600,
			esc_html__( 'Bold 700', 'omniverse' )        => 700,
			esc_html__( 'Extra-Bold 800', 'omniverse' )  => 800,
			esc_html__( 'Ultra-Bold 900', 'omniverse' )  => 900,
		);

		$font_name = esc_html__( 'Custom font', 'omniverse' );
		if ( $section_value['font-name'] && $section_value['font-weight'] ) {
			$font_name .= ' - ' . $section_value['font-name'] . ' (' . $section_value['font-weight'] . ')';
		}

		?>

			<div class="dn-font-section dn-group dn-custom-fonts-section<?php echo esc_attr( $hide_class ); ?>" data-id="<?php echo esc_attr( $this->get_id() ); ?>-<?php echo esc_attr( $index ); ?>">
				<h3 class="dn-custom-fonts-title"><?php echo esc_html( $font_name ); ?></h3>
				<div class="dn-row dn-sp-20">
					<div class="dn-custom-fonts-field dn-col-12 dn-col-lg-6">
						<label class="dn-custom-fonts-label">
							<?php esc_html_e( 'Font name', 'omniverse' ); ?>
						</label>
						<input type="text" name="<?php echo esc_attr( $this->get_input_name( $index, 'font-name' ) ); ?>" value="<?php echo esc_attr( $section_value['font-name'] ); ?>">
						<p class="dn-field-description"><?php esc_html_e( 'Enter your name with letters and spacing only. It will be used in a list of fonts under the Typography section. For example: Indie Flower', 'omniverse' ); ?></p>
					</div>
					<div class="dn-custom-fonts-field dn-col-12 dn-col-lg-6">
						<label class="dn-custom-fonts-label">
							<?php esc_html_e( 'Font weight', 'omniverse' ); ?>
						</label>
						<select name="<?php echo esc_attr( $this->get_input_name( $index, 'font-weight' ) ); ?>">
							<?php foreach ( $font_weight as $key => $value ) : ?>
								<?php
									$selected = $section_value['font-weight'] == $value ? 'selected' : '';
								?>
								<option value="<?php echo esc_attr( $value ); ?>" <?php echo esc_attr( $selected ); ?>>
									<?php echo esc_html( $key ); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<?php foreach ( $this->args['fonts'] as $font ) : ?>
						<?php
							/* translators: 1: Font name */
							$title  = sprintf( __( 'Font (.%s)', 'omniverse' ), esc_attr( $font ) );
							$values = $section_value[ 'font-' . $font ];
							$name   = $this->get_input_name( $index, 'font-' . $font );
						?>
						<?php $this->upload_template( $title, $values, $name ); ?>
					<?php endforeach; ?>
				</div>

				<div class="dn-custom-fonts-btn-remove dn-font-section-remove dn-inline-btn dn-color-warning dn-i-trash"><?php esc_html_e( 'Remove', 'omniverse' ); ?></div>

			</div>
		<?php
	}

	/**
	 * Displays the upload field template.
	 *
	 * @since 1.0.0
	 *
	 * @param string $title Field title.
	 * @param array  $values Field values.
	 * @param array  $name Field name.
	 */
	public function upload_template( $title, $values, $name ) {
		$url = '';

		if ( isset( $values['id'] ) && $values['id'] ) {
			$url = wp_get_attachment_url( $values['id'] );
		} elseif ( is_array( $values ) ) {
			$url = $values['url'];
		}

		?>
			<div class="dn-custom-fonts-field dn-upload-control dn-col-12 dn-col-lg-6">
				<label class="dn-custom-fonts-label"><?php echo esc_html( $title ); ?></label>
				<div class="dn-upload-preview">
					<input type="text" class="dn-upload-preview-input" disabled value="<?php echo esc_url( $url ); ?>">
				</div>
				<div class="dn-upload-btns">
					<button class="dn-btn dn-upload-btn dn-i-import"><?php esc_html_e( 'Upload', 'omniverse' ); ?></button>
					<button class="dn-btn dn-color-warning dn-remove-upload-btn dn-i-trash<?php echo ( isset( $url ) && ! empty( $url ) ) ? ' dn-active' : ''; ?>"><?php esc_html_e( 'Remove', 'omniverse' ); ?></button>

					<input type="hidden" class="dn-upload-input-url" name="<?php echo esc_attr( $name . '[url]' ); ?>" value="<?php echo esc_attr( $values['url'] ); ?>" />
					<input type="hidden" class="dn-upload-input-id" name="<?php echo esc_attr( $name . '[id]' ); ?>" value="<?php echo esc_attr( $values['id'] ); ?>" />
				</div>
			</div>
		<?php
	}
}


