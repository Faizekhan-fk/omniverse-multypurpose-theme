<?php if ( ! omniverse_get_opt( 'white_label' ) ) : ?>
	<div class="dn-footer dn-theme-style">
		<div class="dn-row">
			<div class="dn-col">
				<a class="dn-logo" href="https://zynxsol.com/" target="_blank">
					<img src="<?php echo esc_url( OMNIVERSE_ASSETS_IMAGES . '/xtemos-logo-dark.svg' ); ?>" alt="<?php	esc_html_e( 'Logo', 'woodmart' ); ?>">
				</a>
			</div>
			<div class="dn-col-auto">
				<?php
				new DN\Admin\Modules\Dashboard\Menu(
					[
						'items' => [
							[
								'link' => [
									'url'        => 'https://omniverse.zynxsol.com/docs',
									'new_window' => true,
								],
								'icon' => 'documentation',
								'text' => esc_html__( 'Documentation', 'woodmart' ),
							],
							[
								'link' => [
									'url'        => 'https://themeforest.net/downloads',
									'new_window' => true,
								],
								'icon' => 'rate-theme',
								'text' => esc_html__( 'Rate our theme', 'woodmart' ),
							],
						],
					]
				);
				?>
			</div>
		</div>
	</div>
<?php endif; ?>