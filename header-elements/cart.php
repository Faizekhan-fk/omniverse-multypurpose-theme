<?php
$extra_class   = $custom_icon = $custom_icon_width = $custom_icon_height = $icon_classes = '';
$icon_type     = $params['icon_type'];
$cart_position = $params['position'];

$extra_class .= ' wd-design-' . $params['style'];

if ( '3' === $params['style'] ) {
	omniverse_enqueue_inline_style( 'header-cart-design-3' );
}

if ( '8' === $params['style'] ) {
	omniverse_enqueue_inline_style( 'mod-tools-design-8' );
}

if ( $icon_type == 'bag' ) {
	$icon_classes .= ' wd-icon-alt';
	$extra_class  .= omniverse_get_old_classes( ' omniverse-cart-alt' );
}

if ( $icon_type == 'custom' ) {
	$extra_class .= ' wd-tools-custom-icon';
}

if ( $cart_position == 'side' ) {
	omniverse_enqueue_inline_style( 'header-cart-side' );
	$extra_class .= ' cart-widget-opener';
}

if ( omniverse_get_opt( 'mini_cart_quantity' ) ) {
	omniverse_enqueue_inline_style( 'woo-mod-quantity' );

	omniverse_enqueue_js_script( 'mini-cart-quantity' );
	omniverse_enqueue_js_script( 'woocommerce-quantity' );
}

if ( $cart_position != 'side' && $cart_position != 'without' ) {
	$extra_class .= ' wd-event-hover';
}

if ( ! empty( $params['design'] ) ) {
	$extra_class .= ' wd-style-' . $params['design'];
}

if ( 'dropdown' === $cart_position && ! empty( $params['bg_overlay'] ) ) {
	omniverse_enqueue_js_script( 'menu-overlay' );

	$extra_class .= ' wd-with-overlay';
}

if ( isset( $params['wrap_type'], $params['design'], $params['style'] ) && 'icon_and_text' === $params['wrap_type'] && 'text' === $params['design'] && in_array( $params['style'], array( '6', '7' ), true ) ) {
	$extra_class .= ' wd-with-wrap';
}

$dropdowns_classes = '';

if ( isset( $id ) ) {
	$extra_class .= ' whb-' . $id;
}

$extra_class       .= omniverse_get_old_classes( ' omniverse-shopping-cart' );
$extra_class       .= omniverse_get_old_classes( ' omniverse-cart-design-' . $params['style'] );
$icon_classes      .= omniverse_get_old_classes( ' omniverse-cart-icon' );
$dropdowns_classes .= omniverse_get_old_classes( ' dropdown-cart' );


if ( 'light' === whb_get_dropdowns_color() ) {
	$dropdowns_classes .= ' color-scheme-light';
}

if ( ! omniverse_woocommerce_installed() || $params['style'] == 'disable' || ( ! is_user_logged_in() && omniverse_get_opt( 'login_prices' ) ) ) {
	return;
}

omniverse_enqueue_js_script( 'on-remove-from-cart' );
omniverse_enqueue_inline_style( 'header-cart' );
omniverse_enqueue_inline_style( 'widget-shopping-cart' );
omniverse_enqueue_inline_style( 'widget-product-list' );
?>

<div class="wd-header-cart wd-tools-element<?php echo esc_attr( $extra_class ); ?>">
	<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php echo esc_attr__( 'Shopping cart', 'omniverse' ); ?>">
		<?php if ( '8' === $params['style'] || ( isset( $params['wrap_type'], $params['design'], $params['style'] ) && 'icon_and_text' === $params['wrap_type'] && 'text' === $params['design'] && in_array( $params['style'], array( '6', '7' ), true ) ) ) : ?>
			<span class="wd-tools-inner">
		<?php endif; ?>

			<span class="wd-tools-icon<?php echo esc_attr( $icon_classes ); ?>">
				<?php if ( $icon_type == 'custom' ) : ?>
					<?php echo whb_get_custom_icon( $params['custom_icon'] ); ?>
				<?php endif; ?>
				<?php if ( in_array( $params['style'], array( '2', '4', '5', '6', '7', '8' ), true ) ) : ?>
					<?php omniverse_cart_count(); ?>
				<?php endif; ?>
			</span>
			<span class="wd-tools-text<?php echo omniverse_get_old_classes( ' omniverse-cart-totals' ); ?>">
				<?php if ( ! in_array( $params['style'], array( '2', '4', '5', '6', '7', '8' ), true ) ) : ?>
					<?php omniverse_cart_count(); ?>
				<?php endif; ?>

				<?php if ( in_array( $params['style'], array( '1' ), true ) ) : ?>
					<span class="subtotal-divider">/</span>
				<?php endif; ?>
				<?php omniverse_cart_subtotal(); ?>
			</span>

		<?php if ( '8' === $params['style'] || ( isset( $params['wrap_type'], $params['design'], $params['style'] ) && 'icon_and_text' === $params['wrap_type'] && 'text' === $params['design'] && in_array( $params['style'], array( '6', '7' ), true ) ) ) : ?>
			</span>
		<?php endif; ?>
	</a>
	<?php if ( $cart_position != 'side' && $cart_position != 'without' ) : ?>
		<div class="wd-dropdown wd-dropdown-cart<?php echo esc_attr( $dropdowns_classes ); ?>">
			<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
		</div>
	<?php endif; ?>
</div>
