<?php
/**
 * Nav Menu Images Nav Menu Edit Walker
 *
 * @package Nav Menu Images
 * @subpackage Nav Menu Edit Walker
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Filter nav menu items on edit screen.
 *
 * @since 1.0
 *
 * @uses Walker_Nav_Menu_Edit
 */
class NMI_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
	/**
	 * @see Walker_Nav_Menu_Edit::start_el()
	 * @since 1.0
	 * @access public
	 *
	 * @global $wp_version
	 * @uses Walker_Nav_Menu_Edit::start_el()
	 * @uses admin_url() To get URL of uploader.
	 * @uses esc_url() To escape URL.
	 * @uses add_query_arg() To append variables to URL.
	 * @uses esc_attr() To escape string.
	 * @uses has_post_thumbnail() To check if item has thumb.
	 * @uses get_the_post_thumbnail() To get item's thumb.
	 * @uses version_compare() To compare WordPress versions.
	 * @uses wp_create_nonce() To create item's nonce.
	 * @uses esc_html__() To translate & escape string.
	 * @uses esc_html() To escape string.
	 * @uses do_action_ref_array() Calls 'nmi_menu_item_walker_output' with the output.
	 *                        post object, depth and arguments to overwrite item's output.
	 * @uses NMI_Walker_Nav_Menu_Edit::get_settings() To get JSONed item's data.
	 * @uses do_action_ref_array() Calls 'nmi_menu_item_walker_end' with the output.
	 *                        post object, depth and arguments to overwrite item's output.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param array $args Not used.
	 * @param int $id Not used.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_version;

		// First, make item with standard class
		parent::start_el( $output, $item, $depth, $args, $id );

		// Now add additional content
		$item_id = $item->ID;

		// Form upload link
		$upload_url = admin_url( 'media-upload.php' );
		$query_args = array(
			'post_id'   => $item_id,
			'tab'       => 'gallery',
			'TB_iframe' => '1',
			'width'     => '640',
			'height'    => '425'
		);
		$upload_url = esc_url( add_query_arg( $query_args, $upload_url ) );


		// Hidden field with item's ID
		$output .= '<input type="hidden" name="nmi_item_id" id="nmi_item_id" value="' . esc_attr( $item_id ) . '" />';

		$output .= '<div class="nmi-item-custom-fields">';

		$blocks = omniverse_get_static_blocks_array();

		ob_start();

		$design        = get_post_meta( $item_id, '_menu_item_design', true );
		$style_aside   = get_post_meta( $item_id, '_menu_item_style_aside', true );
		$width         = get_post_meta( $item_id, '_menu_item_width', true );
		$icon          = get_post_meta( $item_id, '_menu_item_icon', true );
		$height        = get_post_meta( $item_id, '_menu_item_height', true );
		$padding       = get_post_meta( $item_id, '_menu_item_padding', true );
		$scroll        = get_post_meta( $item_id, '_menu_item_scroll', true );
		$event         = get_post_meta( $item_id, '_menu_item_event', true );
		$label         = get_post_meta( $item_id, '_menu_item_label', true );
		$label_text    = get_post_meta( $item_id, '_menu_item_label-text', true );
		$block         = get_post_meta( $item_id, '_menu_item_block', true );
		$dropdown_ajax = get_post_meta( $item_id, '_menu_item_dropdown-ajax', true );
		$opanchor      = get_post_meta( $item_id, '_menu_item_opanchor', true );
		$color_scheme  = get_post_meta( $item_id, '_menu_item_colorscheme', true );
		$image_type    = get_post_meta( $item_id, '_menu_item_image-type', true );

		?>
			<h4 class="description-wide nmi-dropdown-title"><?php esc_html_e( 'Dropdown settings', 'omniverse' ); ?></h4>
			<span class="dn-wp-menu-group">
				<p class="description description-wide nmi-design">
					<label for="edit-menu-item-design-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Design', 'omniverse' ); ?><br>
						<select id="edit-menu-item-design-<?php echo esc_attr( $item_id ); ?>" data-field="nmi-design" class="widefat" name="menu-item-design[<?php echo esc_attr( $item_id ); ?>]">
							<option value="default" <?php selected( $design, 'default' ); ?>><?php esc_html_e( 'Default', 'omniverse' ); ?></option>
							<option value="full-width" <?php selected( $design, 'full-width' ); ?>><?php esc_html_e( 'Full width', 'omniverse' ); ?></option>
							<option value="full-height" <?php selected( $design, 'full-height' ); ?>><?php esc_html_e( 'Full height', 'omniverse' ); ?></option>
							<option value="sized" <?php selected( $design, 'sized' ); ?>><?php esc_html_e( 'Set sizes', 'omniverse' ); ?></option>
							<option value="aside" <?php selected( $design, 'aside' ); ?>><?php esc_html_e( 'Aside', 'omniverse' ); ?></option>
						</select>
					</label>
				</p>
				<p class="description description-wide nmi-style-aside">
					<label for="edit-menu-item-style-aside-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Aside style', 'omniverse' ); ?><br>
						<select id="edit-menu-style-aside-<?php echo esc_attr( $item_id ); ?>" data-field="nmi-style-aside" class="widefat" name="menu-item-style_aside[<?php echo esc_attr( $item_id ); ?>]">
							<option value="default" <?php selected( $style_aside, 'default' ); ?>><?php esc_html_e( 'Default', 'omniverse' ); ?></option>
							<option value="with-bg" <?php selected( $style_aside, 'with-bg' ); ?>><?php esc_html_e( 'With background', 'omniverse' ); ?></option>
						</select>
					</label>
				</p>
				<p class="description description-thin nmi-width">
					<label for="edit-menu-item-width-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Dropdown width', 'omniverse' ); ?><br>
						<span class="dn-input-append">
							<input type="number" id="edit-menu-item-width-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-width[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $width ); ?>">
							<span class="add-on">px</span>
						</span>
					</label>
				</p>
				<p class="description description-thin nmi-height">
					<label for="edit-menu-item-height-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Dropdown height', 'omniverse' ); ?><br>
						<span class="dn-input-append">
							<input type="number" id="edit-menu-item-height-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-height[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $height ); ?>">
							<span class="add-on">px</span>
						</span>
					</label>
				</p>
				<p class="description description-wide nmi-padding">
					<label for="edit-menu-item-padding-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Dropdown padding', 'omniverse' ); ?><br>
						<span class="dn-input-append">
						<input type="number" id="edit-menu-item-padding-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-padding[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $padding ); ?>">
						<span class="add-on">px</span>
						</span>
					</label>
				</p>
				<p class="description description-wide nmi-scroll">
					<label for="edit-menu-item-scroll-<?php echo esc_attr( $item_id ); ?>">
						<span class="dn-menu-title"><?php esc_html_e( 'Enable scroll', 'omniverse' ); ?><span class="dn-hint"><span class="dn-tooltip dn-top"><?php esc_html_e( 'Select "Yes" to limit the dropdown height to the value specified in the "Dropdown height" input. If "No" the "Dropdown height" will specify only the minimum height and the real dropdown height will depend on the actual height of the content.', 'omniverse' ); ?></span></span></span><br>
						<select id="edit-menu-item-scroll-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-scroll[<?php echo esc_attr( $item_id ); ?>]">
							<option value="no" <?php selected( $scroll, 'no' ); ?>><?php esc_html_e( 'No', 'omniverse' ); ?></option>
							<option value="yes" <?php selected( $scroll, 'yes' ); ?>><?php esc_html_e( 'Yes', 'omniverse' ); ?></option>
						</select>
					</label>
				</p>
				<p class="description description-wide nmi-block">
					<label for="edit-menu-item-block-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'HTML Block for the dropdown', 'omniverse' ); ?><br>
						<select id="edit-menu-item-block-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-block[<?php echo esc_attr( $item_id ); ?>]">
							<option value="" <?php selected( $block, '' ); ?>><?php esc_html_e( 'None', 'omniverse' ); ?></option>
							<?php foreach ( $blocks as $title => $id ) : ?>
								<option value="<?php echo esc_attr( $id ); ?>" data-edit-link="<?php echo esc_url( admin_url( 'post.php?post=' . $id . '&action=edit' ) ); ?>" <?php selected( $block, $id ); ?>><?php echo esc_html( $title ); ?></option>
							<?php endforeach ?>
						</select>
						<?php echo wp_kses( omniverse_get_html_block_links(), true ); ?>
					</label>
				</p>
				<p class="description description-wide nmi-dropdown-ajax">
					<label for="edit-menu-item-dropdown-ajax-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Load HTML dropdown with AJAX', 'omniverse' ); ?><br>
						<select id="edit-menu-item-dropdown-ajax-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-dropdown-ajax[<?php echo esc_attr( $item_id ); ?>]">
							<option></option>
							<option value="yes" <?php selected( $dropdown_ajax, 'yes' ); ?>><?php esc_html_e( 'Yes', 'omniverse' ); ?></option>
							<option value="no" <?php selected( $dropdown_ajax, 'no' ); ?>><?php esc_html_e( 'No', 'omniverse' ); ?></option>
						</select>
					</label>
				</p>
				<p class="description description-thin nmi-color-scheme">
					<label for="edit-menu-item-colorscheme-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Dropdown color scheme', 'omniverse' ); ?><br>
						<select id="edit-menu-item-colorscheme-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-colorscheme[<?php echo esc_attr( $item_id ); ?>]">
							<option value=""></option>
							<option value="light" <?php selected( $color_scheme, 'light' ); ?>><?php esc_html_e( 'Light', 'omniverse' ); ?></option>
							<option value="dark" <?php selected( $color_scheme, 'dark' ); ?>><?php esc_html_e( 'Dark', 'omniverse' ); ?></option>
						</select>
					</label>
				</p>
				<p class="description description-thin nmi-event">
					<label for="edit-menu-item-event-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Open on mouse event', 'omniverse' ); ?><br>
						<select id="edit-menu-item-event-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-event[<?php echo esc_attr( $item_id ); ?>]">
							<option value="hover" <?php selected( $event, 'hover' ); ?>><?php esc_html_e( 'Hover', 'omniverse' ); ?></option>
							<option value="click" <?php selected( $event, 'click' ); ?>><?php esc_html_e( 'Click', 'omniverse' ); ?></option>
						</select>
					</label>
				</p>
			</span>

			<h4 class="description-wide"><?php esc_html_e( 'Label settings', 'omniverse' ); ?></h4>
			<span class="dn-wp-menu-group">
				<p class="description description-thin nmi-label-text">
					<label for="edit-menu-item-label-text-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Label text', 'omniverse' ); ?><br>
						<input type="text" id="edit-menu-item-label-text-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-label-text[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $label_text ); ?>">
					</label>
				</p>
				<p class="description description-thin nmi-label">
					<label for="edit-menu-item-label-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Label color', 'omniverse' ); ?><br>
						<select id="edit-menu-item-label-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-label[<?php echo esc_attr( $item_id ); ?>]">
							<option value=""></option>
							<option value="primary" <?php selected( $label, 'primary' ); ?>><?php esc_html_e( 'Primary Color', 'omniverse' ); ?></option>
							<option value="secondary" <?php selected( $label, 'secondary' ); ?>><?php esc_html_e( 'Secondary', 'omniverse' ); ?></option>
							<option value="red" <?php selected( $label, 'red' ); ?>><?php esc_html_e( 'Red', 'omniverse' ); ?></option>
							<option value="green" <?php selected( $label, 'green' ); ?>><?php esc_html_e( 'Green', 'omniverse' ); ?></option>
							<option value="blue" <?php selected( $label, 'blue' ); ?>><?php esc_html_e( 'Blue', 'omniverse' ); ?></option>
							<option value="orange" <?php selected( $label, 'orange' ); ?>><?php esc_html_e( 'Orange', 'omniverse' ); ?></option>
							<option value="grey" <?php selected( $label, 'grey' ); ?>><?php esc_html_e( 'Grey', 'omniverse' ); ?></option>
							<option value="black" <?php selected( $label, 'black' ); ?>><?php esc_html_e( 'Black', 'omniverse' ); ?></option>
							<option value="white" <?php selected( $label, 'white' ); ?>><?php esc_html_e( 'White', 'omniverse' ); ?></option>
						</select>
					</label>
				</p>
			</span>
			<h4 class="description-wide"><?php esc_html_e( 'Image settings', 'omniverse' ); ?></h4>
			<span class="dn-wp-menu-group">
				<p class="description description-wide nmi-image-type">
					<label for="edit-menu-item-image-type-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Use image as', 'omniverse' ); ?><br>
						<select id="edit-menu-item-image-type-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-image-type[<?php echo esc_attr( $item_id ); ?>]">
							<option value="image" <?php selected( $image_type, 'image', true ); ?>>
								<?php esc_html_e( 'Menu item icon', 'omniverse' ); ?>
							</option>
							<option value="background" <?php selected( $image_type, 'background', true ); ?>>
								<?php esc_html_e( 'Dropdown background', 'omniverse' ); ?>
							</option>
						</select>
					</label>
				</p>
				<?php if ( has_post_thumbnail( $item_id ) ) : ?>
					<?php $link_text = esc_html__( 'Change image', 'omniverse' ); ?>
					<div class="nmi-current-image nmi-div nmi-change-image" style="display: none;">
						<a href="<?php echo esc_url( $upload_url ); ?>" data-id="<?php echo esc_attr( $item_id ); ?>" class="thickbox add_media link-with-image">
							<?php echo get_the_post_thumbnail( $item_id, 'thumb' ); ?>
						</a>
					</div>
				<?php else : ?>
					<?php $link_text = esc_html__( 'Upload image', 'omniverse' ); ?>
					<div class="nmi-current-image nmi-div nmi-upload-image" style="display: none;"></div>
				<?php endif; ?>

				<div class="nmi-upload-link nmi-div" style="display: none;">
					<a href="<?php echo esc_url( $upload_url ); ?>" data-id="<?php echo esc_attr( $item_id ); ?>" class="thickbox add_media">
						<?php echo esc_html( $link_text ); ?>
					</a>
					<?php if ( has_post_thumbnail( $item_id ) && version_compare( $wp_version, '3.5', '>=' ) ) : ?>
						|
						<a href="#" data-id="<?php echo esc_attr( $item_id ); ?>" class="nmi_remove" onclick="NMIRemoveThumbnail('<?php echo esc_attr( wp_create_nonce( 'set_post_thumbnail-' . $item_id ) ); ?>','<?php echo esc_attr( $item_id ); ?>');return false;">
							<?php echo esc_html__( 'Remove image', 'omniverse' ); ?>
						</a>
					<?php endif; ?>
				</div>
			</span>

			<h4 class="description-wide"><?php esc_html_e( 'Extra options', 'omniverse' ); ?></h4>
			<span class="dn-menu-title"><?php esc_html_e( 'Page anchor (for one-page menu)', 'omniverse' ); ?><span class="dn-hint"><span class="dn-tooltip dn-top"><?php esc_html_e( 'Enable this to use one page navigation menu. If enabled you need to set the link for this item to be like this: http://your_site.com/home_page/#anchor_id where anchor_id will be the ID of the ROW on your home page.', 'omniverse' ); ?></span></span></span><br>
			<p class="description description-wide nmi-opanchor">
				<label for="edit-menu-item-opanchor-<?php echo esc_attr( $item_id ); ?>">
					<select id="edit-menu-item-opanchor-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-opanchor[<?php echo esc_attr( $item_id ); ?>]">
						<option value=""></option>
						<option value="enable" <?php selected( $opanchor, 'enable' ); ?>><?php esc_html_e( 'Enable', 'omniverse' ); ?></option>
						<option value="disable" <?php selected( $opanchor, 'disable' ); ?>><?php esc_html_e( 'Disable', 'omniverse' ); ?></option>
					</select>
				</label>
			</p>

			<p class="description description-wide nmi-icon">
				<label for="edit-menu-item-height-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e( 'Icon name (from FontAwesome 5 set)', 'omniverse' ); ?>
					<span class="dn-field-status dn-status-deprecated">
						<span class="dn-status-label">
							<?php esc_html_e( 'Deprecated', 'omniverse' ); ?>
						</span>
					</span>
					<br>
					<input type="text" id="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-icon[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $icon ); ?>">
				</label>
				<span class="description"><?php esc_html_e( 'The icon code from FontAwesome 5 list.', 'omniverse' ); ?><?php esc_html_e( ' Example:', 'omniverse' ); ?> <code>envelope-open fas</code></span>
			</p>
		<?php
		$output .= ob_get_contents();
		ob_end_clean();

		$output .= '</div><!-- .nmi-item-custom-fields -->';

		// Filter output
		do_action_ref_array( 'nmi_menu_item_walker_output', array( &$output, $item, $depth, $args ) );

		// Add JSONed meta data
		$output .= $this->get_settings( $item_id );

		do_action_ref_array( 'nmi_menu_item_walker_end', array( &$output, $item, $depth, $args ) );
	}

	/**
	 * Get JSONed item's data.
	 *
	 * Heavily based on wp_enqueue_media() and
	 * WP_Scripts::localize()
	 *
	 * @see wp_enqueue_media()
	 * @see WP_Scripts::localize()
	 *
	 * @since 2.0
	 * @access public
	 *
	 * @uses version_compare() To compare WordPress versions.
	 * @uses wp_create_nonce() To create item's nonce.
	 * @uses get_post() To get post's object.
	 * @uses get_post_meta() To get post's meta data.
	 * @uses apply_filters() Calls 'media_view_settings' with the settings
	 *                        and post object to overwrite item's settings.
	 * @uses did_action() To check if action was done.
	 * @uses do_action() Calls 'nmi_setup_settings_var' with the item ID.
	 *
	 * @param int $post_id The item's post ID.
	 * @return string New HTML output.
	 */
	public function get_settings( $post_id ) {
		global $wp_version;

		// Only works for WP 3.5+
		if ( ! version_compare( $wp_version, '3.5', '>=' ) )
			return;

		// Prepare general settings
		$settings = array();

		// Prepare post specific settings
		$post = null;
		if ( isset( $post_id ) ) {
			$post = get_post( $post_id );
			$settings['post'] = array(
				'id' => $post->ID,
				'nonce' => wp_create_nonce( 'update-post_' . $post->ID ),
			);

			$featured_image_id = get_post_meta( $post->ID, '_thumbnail_id', true );
			$settings['post']['featuredImageId'] = $featured_image_id ? $featured_image_id : -1;
			$settings['post']['featuredExisted'] = $featured_image_id ? 1 : -1;
		}

		// Filter item's settins
		$settings = apply_filters( 'media_view_settings', $settings, $post );

		// Prepare Javascript varible name
		$object_name = 'nmi_settings[' . $post->ID . ']';

		// Loop through each setting and prepare it for JSON
		foreach ( (array) $settings as $key => $value ) {
			if ( ! is_scalar( $value ) )
				continue;

			$settings[$key] = html_entity_decode( (string) $value, ENT_QUOTES, 'UTF-8' );
		}

		// Encode settings to JSON
		$script = "$object_name = " . json_encode( $settings ) . ';';

		// If this is first item, register variable
		if ( ! did_action( 'nmi_setup_settings_var' ) ) {
			$script = "var nmi_settings = [];\n" . $script;
			do_action( 'nmi_setup_settings_var', $post->ID );
		}

		// Wrap everythig
		$output = "<script>\n";
		$output .= "/* <![CDATA[ */\n";
		$output .= "$script\n";
		$output .= "/* ]]> */\n";
		$output .= "</script>\n";

		return $output;
	}
}
