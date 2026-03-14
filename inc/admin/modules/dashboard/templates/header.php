<?php

global $menu;
global $submenu;

$logo_url = OMNIVERSE_ASSETS_IMAGES . '/omni-logo-dark.svg';

if ( omniverse_get_opt( 'white_label' ) ) {
	$image_data = omniverse_get_opt( 'white_label_dashboard_logo' );

	if ( ! empty( $image_data['url'] ) ) {
		$logo_url = wp_get_attachment_image_url( $image_data['id'], 'full' );
	}
}

?>
<div class="dn-header dn-theme-style">
	<div class="dn-row">
		<div class="dn-col-auto dn-logo-wrap">
			<?php if ( current_user_can( apply_filters( 'omniverse_dashboard_theme_links_access', 'administrator' ) ) ) : ?>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=zs_dashboard' ) ); ?>"></a>
			<?php endif; ?>
			<img src="<?php echo esc_url( $logo_url ); ?>" class="dn-logo" alt="<?php esc_html_e( 'Logo', 'omniverse' ); ?>">
			<div class="dn-version">
				<?php echo esc_html( 'v.' . omniverse_get_theme_info( 'Version' ) ); ?>
			</div>
		</div>
		<div class="dn-col">
			<?php
			new DN\Admin\Modules\Dashboard\Menu(
				array(
					'items' => array(
						array(
							'link'       => array(
								'url' => admin_url( 'admin.php?page=zs_theme_settings' ),
							),
							'type'       => 'page',
							'slug'       => 'zs_theme_settings',
							'icon'       => 'theme-settings',
							'text'       => esc_html__( 'Theme Options', 'omniverse' ),
							'condition'  => current_user_can( apply_filters( 'omniverse_capability_menu_page', 'manage_options', 'zs_theme_settings' ) ),
							'child_menu' => array(
								'items' => array(
									array(
										'link' => array(
											'url' => admin_url( 'admin.php?page=zs_theme_settings_presets' ),
										),
										'type' => 'page',
										'slug' => 'zs_theme_settings_presets',
										'icon' => 'cog',
										'text' => esc_html__( 'Presets', 'omniverse' ),
									),
									array(
										'link' => array(
											'url' => admin_url( 'admin.php?page=zs_theme_settings_backup' ),
										),
										'type' => 'page',
										'slug' => 'zs_theme_settings_backup',
										'icon' => 'round-right',
										'text' => esc_html__( 'Backup', 'omniverse' ),
									),
								),
							),
						),
						array(
							'link'      => array(
								'url' => admin_url( 'admin.php?page=zs_business_type' ),
							),
							'type'      => 'page',
							'slug'      => 'zs_business_type',
							'icon'      => 'dummy-content',
							'condition' => omniverse_get_opt( 'dummy_import', '1' ) && current_user_can( apply_filters( 'omniverse_capability_menu_page', 'manage_options', 'zs_business_type' ) ),
							'text'      => esc_html__( 'Business Type', 'omniverse' ),
						),
						array(
							'link'      => array(
								'url' => admin_url( 'admin.php?page=zs_prebuilt_websites' ),
							),
							'type'      => 'page',
							'slug'      => 'zs_prebuilt_websites',
							'icon'      => 'dummy-content',
							'condition' => omniverse_get_opt( 'dummy_import', '1' ) && current_user_can( apply_filters( 'omniverse_capability_menu_page', 'manage_options', 'zs_prebuilt_websites' ) ),
							'text'      => esc_html__( 'Prebuilt websites', 'omniverse' ),
						),
						array(
							'link'      => array(
								'url' => admin_url( 'admin.php?page=zs_license' ),
							),
							'type'      => 'page',
							'slug'      => 'zs_license',
							'icon'      => 'key',
							'condition' => omniverse_get_opt( 'white_label_theme_license_tab', '1' ) && current_user_can( apply_filters( 'omniverse_capability_menu_page', 'manage_options', 'zs_license' ) ),
							'text'      => esc_html__( 'Theme license', 'omniverse' ),
							'class'     => omniverse_is_license_activated() ? '' : 'dn-license-not-activated',
						),
						array(
							'link'       => array(
								'url' => admin_url( 'admin.php?page=zs_plugins' ),
							),
							'type'       => 'page',
							'slug'       => 'zs_plugins',
							'icon'       => 'tools',
							'text'       => esc_html__( 'Tools', 'omniverse' ),
							'condition'  => current_user_can( apply_filters( 'omniverse_capability_menu_page', 'manage_options', 'zs_plugins' ) ),
							'child_menu' => array(
								'items' => array(
									array(
										'link' => array(
											'url' => admin_url( 'admin.php?page=zs_plugins' ),
										),
										'type' => 'page',
										'slug' => 'zs_plugins',
										'icon' => 'puzzle',
										'text' => esc_html__( 'Plugins', 'omniverse' ),
									),
									array(
										'link' => array(
											'url' => admin_url( 'admin.php?page=zs_patcher' ),
										),
										'type' => 'page',
										'slug' => 'zs_patcher',
										'icon' => 'cog',
										'text' => esc_html__( 'Patcher', 'omniverse' ),
									),
									array(
										'link' => array(
											'url' => admin_url( 'admin.php?page=zs_status' ),
										),
										'type' => 'page',
										'slug' => 'zs_status',
										'icon' => 'status',
										'text' => esc_html__( 'Status', 'omniverse' ),
									),
									array(
										'link'      => array(
											'url' => admin_url( 'admin.php?page=zs_changelog' ),
										),
										'type'      => 'page',
										'slug'      => 'zs_changelog',
										'icon'      => 'file-text',
										'condition' => omniverse_get_opt( 'white_label_changelog_tab', '1' ),
										'text'      => esc_html__( 'Changelog', 'omniverse' ),
									),
									array(
										'link'      => array(
											'url' => admin_url( 'admin.php?page=zs_wpb_css_generator' ),
										),
										'type'      => 'page',
										'slug'      => 'zs_wpb_css_generator',
										'icon'      => 'code',
										'condition' => 'wpb' === omniverse_get_current_page_builder(),
										'text'      => esc_html__( 'WPB CSS generator', 'omniverse' ),
									),
								),
							),
						),
					),
				)
			);
			?>
			<?php
			new DN\Admin\Modules\Dashboard\Menu(
				array(
					'items' => array(
						array(
							'link'      => array(
								'url' => admin_url( 'admin.php?page=zs_header_builder' ),
							),
							'type'      => 'page',
							'slug'      => 'zs_header_builder',
							'icon'      => 'header-builder',
							'text'      => esc_html__( 'Header builder', 'omniverse' ),
							'condition' => current_user_can( apply_filters( 'omniverse_capability_menu_page', 'manage_options', 'zs_header_builder' ) ),
						),
						array(
							'link'      => array(
								'url' => admin_url( 'edit.php?post_type=omniverse_layout' ),
							),
							'type'      => 'post_type',
							'slug'      => 'omniverse_layout',
							'icon'      => 'layouts',
							'text'      => esc_html__( 'Layouts', 'omniverse' ),
							'condition' => in_array( 'edit.php?post_type=omniverse_layout', array_column( $menu, 2 ) ),
						),
						array(
							'link'       => array(
								'url' => admin_url( 'edit-tags.php?taxonomy=omniverse_slider&post_type=omniverse_slide' ),
							),
							'type'       => 'post_type_taxonomy',
							'slug'       => 'omniverse_slide',
							'icon'       => 'slides',
							'text'       => esc_html__( 'Sliders', 'omniverse' ),
							'condition'  => omniverse_get_opt( 'omniverse_slider', '1' ) && in_array( 'edit.php?post_type=omniverse_slide', array_column( $menu, 2 ) ),
							'child_menu' => array(
								'items' => array(
									array(
										'link'      => array(
											'url' => admin_url( 'edit.php?post_type=omniverse_slide' ),
										),
										'type'      => 'post_type',
										'slug'      => 'omniverse_slide',
										'condition' => omniverse_get_opt( 'omniverse_slider', '1' ) && isset( $submenu['edit.php?post_type=omniverse_slide'] ),
										'text'      => esc_html__( 'All slides', 'omniverse' ),
									),
									array(
										'link'      => array(
											'url' => admin_url( 'post-new.php?post_type=omniverse_slide' ),
										),
										'type'      => 'post_type_new',
										'slug'      => 'omniverse_slide',
										'condition' => omniverse_get_opt( 'omniverse_slider', '1' ) && isset( $submenu['edit.php?post_type=omniverse_slide'] ),
										'text'      => esc_html__( 'Add new slide', 'omniverse' ),
									),
								),
							),
						),
						array(
							'link'       => array(
								'url' => admin_url( 'edit.php?post_type=cms_block' ),
							),
							'type'       => 'post_type',
							'slug'       => 'cms_block',
							'icon'       => 'html-block',
							'condition'  => in_array( 'edit.php?post_type=cms_block', array_column( $menu, 2 ) ),
							'text'       => esc_html__( 'HTML Blocks', 'omniverse' ),
							'child_menu' => array(
								'items' => array(
									array(
										'link'      => array(
											'url' => admin_url( 'edit-tags.php?taxonomy=cms_block_cat&post_type=cms_block' ),
										),
										'type'      => 'post_type_taxonomy',
										'slug'      => 'cms_block',
										'condition' => isset( $submenu['edit.php?post_type=cms_block'] ),
										'text'      => esc_html__( 'Categories', 'omniverse' ),
									),
									array(
										'link'      => array(
											'url' => admin_url( 'post-new.php?post_type=cms_block' ),
										),
										'type'      => 'post_type_new',
										'slug'      => 'cms_block',
										'condition' => isset( $submenu['edit.php?post_type=cms_block'] ),
										'text'      => esc_html__( 'Add new', 'omniverse' ),
									),
								),
							),
						),
						array(
							'link'       => array(
								'url' => admin_url( 'edit.php?post_type=omniverse_sidebar' ),
							),
							'type'       => 'post_type',
							'slug'       => 'omniverse_sidebar',
							'icon'       => 'sidebars',
							'condition'  => in_array( 'edit.php?post_type=omniverse_sidebar', array_column( $menu, 2 ) ),
							'text'       => esc_html__( 'Sidebars', 'omniverse' ),
							'child_menu' => array(
								'items' => array(
									array(
										'link'      => array(
											'url' => admin_url( 'post-new.php?post_type=omniverse_sidebar' ),
										),
										'type'      => 'post_type_new',
										'slug'      => 'omniverse_sidebar',
										'condition' => isset( $submenu['edit.php?post_type=omniverse_sidebar'] ),
										'text'      => esc_html__( 'Add new', 'omniverse' ),
									),
								),
							),
						),
					),
				)
			);
			?>
		</div>
	</div>
</div>
