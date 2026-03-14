<?php
/**
 * Predefined layouts template.
 *
 * @package Omniverse
 *
 * @var array $layouts Layouts.
 */

?>
<?php foreach ( $layouts as $layout_type => $values ) : ?>
	<div class="dn-layout-predefined-layouts dn-images-set dn-hidden" data-type="<?php echo esc_attr( $layout_type ); ?>">
		<label><?php esc_html_e( 'Predefined layouts', 'omniverse' ); ?></label>
		<div class="dn-btns-set">
			<?php foreach ( $values as $layout => $data ) : ?>
				<div class="dn-layout-predefined-layout dn-set-item dn-set-btn-img" data-name="<?php echo esc_attr( $layout ); ?>">
					<img src="<?php echo esc_url( OMNIVERSE_THEME_DIR . '/inc/modules/layouts/admin/predefined/' . $layout_type . '/' . $layout . '/preview.jpg' ); ?>" alt="<?php echo esc_attr__( 'Layout preview', 'omniverse' ); ?>">
					<?php if ( ! empty( $data['url'] ) ) : ?>
						<div class="dn-import-preview-wrap">
							<a href="<?php echo esc_url( $data['url'] ); ?>" class="dn-btn dn-color-primary dn-import-item-preview dn-i-view" target="_blank">
								<?php esc_html_e( 'Live preview', 'omniverse' ); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endforeach; ?>
