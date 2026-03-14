<div class="dn-welcome-page">

	<?php if ( omniverse_get_opt( 'white_label' ) ) : ?>
		<div class="dn-box dn-white-label-box dn-theme-style">
			<div class="dn-box-content">
				<h3>
					<?php if ( omniverse_get_opt( 'white_label_dashboard_title' ) ) : ?>
						<?php echo esc_html( omniverse_get_opt( 'white_label_dashboard_title' ) ); ?>
					<?php else : ?>
						<?php esc_html_e( 'Welcome to OmniVerse', 'omniverse' ); ?>
					<?php endif; ?>
				</h3>
				<div class="dn-about-text">
					<?php if ( omniverse_get_opt( 'white_label_dashboard_text' ) ) : ?>
						<?php echo wp_kses( omniverse_get_opt( 'white_label_dashboard_text' ), true ); ?>
					<?php else : ?>
						<?php esc_html_e( 'Thank you for purchasing our premium eCommerce theme - Omniverse. Here you are able to start creating your awesome web store by importing our prebuilt websites and theme options.', 'omniverse' ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php else : ?>
		<div class="dn-box dn-welcome-box dn-theme-style dn-color-scheme-light">
			<div class="dn-box-content">
				<img src="<?php echo esc_url( OMNIVERSE_ASSETS_IMAGES . '/dashboard/banner.svg' ); ?>" alt="banner">

				<h3>
					<?php esc_html_e( 'Welcome to OmniVerse', 'omniverse' ); ?>
				</h3>

				<p>
					<?php esc_html_e( 'Thank you for choosing Omniverse, our premium eCommerce WordPress theme. You’re now ready to start building your professional online store with ease.', 'omniverse' ); ?>
				</p>
			</div>
		</div>

		<div class="dn-row dn-welcome-row dn-sp-20 dn-theme-style">
			<div class="dn-col-12 dn-col-xl-12">
				<div class="dn-box dn-info-boxes">
					<div class="dn-box-content">
						<h4>
							<?php esc_html_e( 'Need Help?' ); ?>
						</h4>

						<p>
							<?php esc_html_e( 'Check the links below for more information and additional support.' ); ?>
						</p>

						<div class="dn-row">
							<div class="dn-col">
								<div class="dn-info-box-img">
									<img src="<?php echo esc_url( OMNIVERSE_ASSETS_IMAGES . '/dashboard/documentation.webp' ); ?>" alt="documentation banner">
								</div>
								<a href="https://zynxsol.com/documentation/omniverse/" class="dn-bordered-btn dn-color-default" target="_blank">
									<?php esc_html_e( 'Documentation' ); ?>
								</a>
							</div>

							<div class="dn-col">
								<div class="dn-info-box-img">
									<img src="<?php echo esc_url( OMNIVERSE_ASSETS_IMAGES . '/dashboard/video-tutorials.webp' ); ?>" alt="video banner">
								</div>
								<a href="https://www.youtube.com/channel/UCu3loFwqqOQ9z-YTcnplK8w/" class="dn-bordered-btn dn-color-default" target="_blank">
									<?php esc_html_e( 'Video tutorials' ); ?>
								</a>
							</div>

							<div class="dn-col">
								<div class="dn-info-box-img">
									<img src="<?php echo esc_url( OMNIVERSE_ASSETS_IMAGES . '/dashboard/support forum.webp' ); ?>" alt="forum banner">
								</div>
								<a href="https://zynxsol.com/forums/forum/omniverse-premium-template/" class="dn-bordered-btn dn-color-default" target="_blank">
									<?php esc_html_e( 'Support forum' ); ?>
								</a>
							</div>
							
							<div class="dn-col">
								<div class="dn-info-box-img">
									<img src="<?php echo esc_url( OMNIVERSE_ASSETS_IMAGES . '/dashboard/rate-us.webp' ); ?>" alt="forum banner">
								</div>
								<a href="https://themeforest.net/downloads" class="dn-bordered-btn dn-color-default" target="_blank">
									<?php esc_html_e( 'Rate our theme' ); ?>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

</div>