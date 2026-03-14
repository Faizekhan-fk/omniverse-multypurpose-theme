<?php
/**
 * Form template.
 *
 * @package Omniverse
 *
 * @var array $layout_types Layout types.
 * @var Admin $admin        Admin instance.
 */

use DN\Modules\Layouts\Admin;

$layout_default_name = 'New layout';
$current_tab         = isset( $_GET['wd_layout_type_tab'] ) ? $_GET['wd_layout_type_tab'] : 'all';  // phpcs:ignore

if ( 'single_product' === $current_tab ) {
	$layout_default_name = 'Single product layout';
} elseif ( 'shop_archive' === $current_tab ) {
	$layout_default_name = 'Product archive layout';
} elseif ( 'cart' === $current_tab ) {
	$layout_default_name = 'Cart layout';
} elseif ( 'checkout' === $current_tab ) {
	$layout_default_name = 'Checkout layout';
}

if ( 'checkout' === $current_tab ) {
	unset( $layout_types['cart'] );
	unset( $layout_types['shop_archive'] );
	unset( $layout_types['single_product'] );
}

$wrapper_classes = ' dn-layout-type-' . $current_tab;
?>
<form>
	<div class="dn-layout-fields<?php echo esc_attr( $wrapper_classes ); ?>">
		<div class="dn-layout-field dn-layout-type-select">
			<label for="wd_layout_type">
				<?php esc_html_e( 'Layout type', 'omniverse' ); ?>
			</label>
			<select class="dn-layout-type" id="wd_layout_type" name="wd_layout_type" required>
				<option value="">
					<?php esc_html_e( 'Select...', 'omniverse' ); ?>
				</option>
				<?php foreach ( $layout_types as $key => $label ) : ?>
					<?php
					$current_tab = isset( $_GET['wd_layout_type_tab'] ) ? $_GET['wd_layout_type_tab'] : ''; // phpcs:ignore

					if ( 'checkout' === $current_tab ) {
						$current_tab = 'checkout_form';
					}
					?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $current_tab, $key ); ?>>
						<?php echo esc_html( $label ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="dn-layout-field">
			<label for="wd_layout_name">
				<?php esc_html_e( 'Layout name', 'omniverse' ); ?>
			</label>
			<input class="dn-layout-name" id="wd_layout_name" name="wd_layout_name" type="text" placeholder="<?php esc_html_e( 'Enter layout name', 'omniverse' ); ?>" required value="<?php echo esc_attr( $layout_default_name ); ?>">
		</div>
	</div>

	<div class="dn-layout-conditions">
		<label class="dn-layout-conditions-title">
			<?php esc_html_e( 'Conditions', 'omniverse' ); ?>
		</label>

		<a href="javascript:void(0);" class="dn-layout-condition-add dn-hidden dn-inline-btn dn-color-primary dn-i-add">
			<?php esc_html_e( 'Add condition', 'omniverse' ); ?>
		</a>
	</div>

	<?php $admin->get_predefined_layouts(); ?>
	<div class="dn-popup-actions dn-layout-submit-wrap">
		<button class="dn-disabled dn-layout-submit dn-btn dn-color-primary dn-i-add" type="submit">
			<?php esc_html_e( 'Create layout', 'omniverse' ); ?>
		</button>
	</div>
</form>
