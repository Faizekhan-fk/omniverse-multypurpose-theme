<?php
use DN\Modules\Mega_Menu_Walker;

if ( $params['menu_id'] == '' ) {
	return;
}

$categories_title  = ! empty( $params['categories_title'] ) ? $params['categories_title'] : esc_html__( 'Browse Categories', 'omniverse' );
$extra_class       = '';
$dropdowns_classes = '';
$opened            = get_post_meta( omniverse_get_the_ID(), '_omniverse_open_categories', true );
$icon_type         = $params['icon_type'];
$menu_class        = omniverse_get_old_classes( ' vertical-navigation' );
$icon_classes      = 'menu-opener-icon';

if ( omniverse_woocommerce_installed() && is_product() ) {
	$opened = false;
}

$class = ( $params['color_scheme'] != 'inherit' ) ? 'color-scheme-' . $params['color_scheme'] : '';

if ( ! empty( $params['background'] ) && ! empty( $params['background']['background-color'] ) ) {
	$class .= ' has-bg';
}

$extra_class .= ' wd-style-1';

if ( ! $opened ) {
	$extra_class .= ' wd-event-' . $params['mouse_event'];
} else {
	$dropdowns_classes .= ' wd-opened';
}

if ( ! $opened && $params['open_dropdown'] ) {
	$extra_class .= ' wd-open-dropdown';
}

if ( ! empty( $params['bg_overlay'] ) ) {
	omniverse_enqueue_js_script( 'menu-overlay' );

	$extra_class .= ' wd-with-overlay';
}

$menu_class  .= ' wd-design-' . $params['design'];
$extra_class .= ( $opened ) ? omniverse_get_old_classes( ' opened-menu' ) : omniverse_get_old_classes( ' show-on-hover' );

if ( 'light' === whb_get_dropdowns_color() ) {
	$dropdowns_classes .= ' color-scheme-light';
}

if ( $icon_type == 'custom' ) {
	$extra_class .= ' omniverse-cat-custom-icon';
}

$html = '';
if ( $params['more_cat_button'] ) {
	omniverse_enqueue_js_script( 'header-el-category-more-btn' );
	omniverse_enqueue_inline_style( 'header-el-category-more-btn' );
	$extra_class .= ' wd-more-cat';
	$html        .= '<li class="menu-item item-level-0 wd-more-cat-btn"><a href="#" rel="nofollow noopener" class="omniverse-nav-link" aria-label="' . esc_attr__( 'Show more category button', 'omniverse' ) . '"></a></li>';
}

$extra_class .= ' whb-' . $id;

$extra_class       .= omniverse_get_old_classes( ' header-categories-nav' );
$class             .= omniverse_get_old_classes( ' header-categories-nav-wrap' );
$dropdowns_classes .= omniverse_get_old_classes( ' categories-menu-dropdown' );

omniverse_enqueue_js_script( 'header-categories-menu' );
omniverse_enqueue_inline_style( 'header-categories-nav' );
omniverse_enqueue_inline_style( 'mod-nav-vertical' );
omniverse_enqueue_inline_style( 'mod-nav-vertical-design-' . $params['design'] );
?>

<div class="wd-header-cats<?php echo esc_attr( $extra_class ); ?>" role="navigation" aria-label="<?php esc_html_e( 'Header categories navigation', 'omniverse' ); ?>">
	<span class="menu-opener <?php echo esc_attr( $class ); ?>">
		<?php if ( $icon_type == 'custom' ) : ?>
			<span class="<?php echo esc_attr( $icon_classes ); ?> custom-icon"><?php echo whb_get_custom_icon( $params['custom_icon'] ); ?></span>
		<?php else : ?>
			<span class="<?php echo esc_attr( $icon_classes . omniverse_get_old_classes( ' omniverse-burger' ) ); ?>"></span>
		<?php endif; ?>

		<span class="menu-open-label">
			<?php echo esc_html( $categories_title ); ?>
		</span>
	</span>
	<div class="wd-dropdown wd-dropdown-cats<?php echo esc_attr( $dropdowns_classes ); ?>">
		<?php
		wp_nav_menu(
			array(
				'container'  => '',
				'menu'       => $params['menu_id'],
				'menu_class' => 'menu wd-nav wd-nav-vertical' . $menu_class,
				'walker'     => new Mega_Menu_Walker(),
				'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s' . $html . '</ul>',
			)
		);
		?>
	</div>
</div>
