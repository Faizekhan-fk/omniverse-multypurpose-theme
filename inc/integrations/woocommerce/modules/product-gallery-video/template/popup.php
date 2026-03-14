<?php
/**
 * Popup template.
 *
 * @package Omniverse
 */
?>

<div class="dn-popup-holder dn-popup-product-gallery" data-default-settings='<?php echo wp_json_encode( $this->default_settings ); ?>'>
	<div class="dn-popup-overlay"></div>

	<div class="dn-popup dn-theme-style">
		<div class="dn-popup-inner">
			<div class="dn-popup-header">
				<div class="dn-popup-title">
					<?php esc_html_e( 'Product gallery video', 'omniverse' ); ?>
				</div>
				<a href="#" class="dn-popup-close dn-i-close">
					<?php esc_html__( 'Close', 'omniverse' ); ?>
				</a>
			</div>

			<div class="dn-popup-content dn-section dn-active-section">
				<div class="dn-fields">
					<div class="dn-field dn-settings-field dn-buttons-control dn-gallery_video_type-field">
						<div class="dn-option-title">
							<label>
								<span>
									<?php esc_html_e( 'Video source', 'omniverse' ); ?>
								</span>
							</label>
						</div>
						<div class="dn-option-control">
							<div class="dn-btns-set dn-active">
								<div class="dn-set-item dn-set-btn dn-active" data-value="mp4">
									<span>
										<?php esc_html_e( 'MP4', 'omniverse' ); ?>
									</span>
								</div>
								<div class="dn-set-item dn-set-btn" data-value="youtube">
									<span>
										<?php esc_html_e( 'YouTube', 'omniverse' ); ?>
									</span>
								</div>
								<div class="dn-set-item dn-set-btn" data-value="vimeo">
									<span>
										<?php esc_html_e( 'Vimeo', 'omniverse' ); ?>
									</span>
								</div>
							</div>
							<input type="hidden" data-name="video_type" value="mp4">
						</div>
					</div>

					<div class="dn-field dn-settings-field dn-text_input-control dn-gallery_custom_url-field dn-shown" data-dependency="gallery_video_type:equals:youtube;">
						<div class="dn-option-title">
							<label>
								<span>
									<?php esc_html_e( 'YouTube video URL', 'omniverse' ); ?>
								</span>
							</label>
						</div>
						<div class="dn-option-control">
							<input type="text" data-name="youtube_url" value="">
						</div>
						<p class="dn-field-description">
							<?php esc_html_e( 'Example: https://youtu.be/LXb3EKWsInQ', 'omniverse' ); ?>
						</p>
					</div>

					<div class="dn-field dn-settings-field dn-text_input-control dn-gallery_custom_url-field dn-shown" data-dependency="gallery_video_type:equals:vimeo;">
						<div class="dn-option-title">
							<label>
								<span>
									<?php esc_html_e( 'Vimeo video URL', 'omniverse' ); ?>
								</span>
							</label>
						</div>
						<div class="dn-option-control">
							<input type="text" data-name="vimeo_url" value="">
						</div>
						<p class="dn-field-description">
							<?php esc_html_e( 'Example: https://vimeo.com/259400046', 'omniverse' ); ?>
						</p>
					</div>

					<div class="dn-field dn-settings-field dn-upload-control dn-gallery_upload_video-field" data-dependency="gallery_video_type:equals:mp4;">
						<div class="dn-option-title">
							<label>
								<span>
									<?php esc_html_e( 'MP4 video file' ); ?>
								</span>
							</label>
						</div>
						<div class="dn-option-control">
							<div class="dn-upload-preview"></div>
							<div class="dn-upload-btns">
								<a class="dn-btn dn-upload-btn dn-i-import">
									<?php esc_html_e( 'Upload', 'omniverse' ); ?>
								</a>
								<a class="dn-btn dn-color-warning dn-remove-upload-btn dn-i-trash">
									<?php esc_html_e( 'Remove', 'omniverse' ); ?>
								</a>
								<input type="hidden" class="dn-upload-input-url" data-name="upload_video_url" value="">
								<input type="hidden" class="dn-upload-input-id" data-name="upload_video_id" value="">
							</div>
						</div>
						<p class="dn-field-description">
							<?php esc_html_e( 'Upload a new or select (.mp4) video file from the media library.', 'omniverse' ); ?>
						</p>
					</div>
					<div class="dn-field dn-col-6 dn-settings-field dn-buttons-control dn-gallery_video_control-field">
						<div class="dn-option-title">
							<label>
								<span>
									<?php esc_html_e( 'Video display type', 'omniverse' ); ?>
								</span>
								<div class="dn-hint">
									<div class="dn-tooltip dn-top">
										<video data-src="<?php echo esc_url( OMNIVERSE_TOOLTIP_URL . 'video-display-type-native-player.mp4' ); ?>" autoplay loop muted></video>
									</div>
								</div>
							</label>
						</div>
						<div class="dn-option-control">
							<div class="dn-btns-set dn-active">
								<div class="dn-set-item dn-set-btn dn-active" data-value="theme">
									<span>
										<?php esc_html_e( 'Simplified', 'omniverse' ); ?>
									</span>
								</div>
								<div class="dn-set-item dn-set-btn" data-value="native">
									<span>
										<?php esc_html_e( 'Native player', 'omniverse' ); ?>
									</span>
								</div>
							</div>
							<input type="hidden" data-name="video_control" value="theme">
						</div>
						<p class="dn-field-description">
							<?php esc_html_e( 'Minimalist theme-friendly design or a design from an embedded video player.', 'omniverse' ); ?>
						</p>
					</div>
					<div class="dn-field dn-col-6 dn-settings-field dn-switcher-control dn-gallery_hide_gallery_img-field" data-dependency="gallery_video_control:equals:native;">
						<div class="dn-option-title">
							<label>
								<span>
									<?php esc_html_e( 'Hide gallery image', 'omniverse' ); ?>
								</span>
							</label>
						</div>
						<div class="dn-option-control">
							<div class="dn-switcher-btn" data-on="1" data-off="0">
								<div class="dn-switcher-dot-wrap">
									<div class="dn-switcher-dot"></div>
								</div>
								<div class="dn-switcher-labels">
									<span class="dn-switcher-label dn-on">
										<?php esc_html_e( 'Yes', 'omniverse' ); ?>
									</span>
									<span class="dn-switcher-label dn-off">
										<?php esc_html_e( 'No', 'omniverse' ); ?>
									</span>
								</div>
							</div>
							<input type="hidden" data-name="hide_gallery_img" value="0">
						</div>
						<p class="dn-field-description">
							<?php esc_html_e( 'Show the native player instead of the gallery image, even if the video hasn\'t started yet.', 'omniverse' ); ?>
						</p>
					</div>
					<div class="dn-field dn-col-6 dn-settings-field dn-buttons-control dn-gallery_video_size-field" data-dependency="gallery_video_control:equals:theme;">
						<div class="dn-option-title">
							<label>
								<span>
									<?php esc_html_e( 'Video size', 'omniverse' ); ?>
								</span>
								<div class="dn-hint">
									<div class="dn-tooltip dn-top">
										<video data-src="<?php echo esc_url( OMNIVERSE_TOOLTIP_URL . 'video-size-cover.mp4' ); ?>" autoplay loop muted></video>
									</div>
								</div>
							</label>
						</div>
						<div class="dn-option-control">
							<div class="dn-btns-set dn-active">
								<div class="dn-set-item dn-set-btn dn-active" data-value="contain">
									<span>
										<?php esc_html_e( 'Contain', 'omniverse' ); ?>
									</span>
								</div>
								<div class="dn-set-item dn-set-btn" data-value="cover">
									<span>
										<?php esc_html_e( 'Cover', 'omniverse' ); ?>
									</span>
								</div>
							</div>
							<input type="hidden" data-name="video_size" value="contain">
						</div>
						<p class="dn-field-description">
							<?php esc_html_e( 'Choose how the video will fill its container.', 'omniverse' ); ?>
						</p>
					</div>
					<div class="dn-field dn-divider-field"></div>
					<div class="dn-field dn-col-6 dn-settings-field dn-switcher-control dn-gallery_autoplay-field">
						<div class="dn-option-title">
							<label>
								<span>
									<?php esc_html_e( 'Autoplay', 'omniverse' ); ?>
								</span>
							</label>
						</div>
						<div class="dn-option-control">
							<div class="dn-switcher-btn" data-on="1" data-off="0">
								<div class="dn-switcher-dot-wrap">
									<div class="dn-switcher-dot"></div>
								</div>
								<div class="dn-switcher-labels">
									<span class="dn-switcher-label dn-on">
										<?php esc_html_e( 'On', 'omniverse' ); ?>
									</span>
									<span class="dn-switcher-label dn-off">
										<?php esc_html_e( 'Off', 'omniverse' ); ?>
									</span>
								</div>
							</div>
							<input type="hidden" data-name="autoplay" value="0">
						</div>
						<p class="dn-field-description">
							<?php esc_html_e( 'Start playback after the gallery is loaded. Work on mobile depends on the video source.', 'omniverse' ); ?>
						</p>
					</div>

					<div class="dn-field dn-col-6 dn-settings-field dn-buttons-control dn-gallery_audio_status-field" data-dependency="gallery_autoplay:equals:0;">
						<div class="dn-option-title">
							<label>
								<span>
									<?php esc_html_e( 'Audio status', 'omniverse' ); ?>
								</span>
							</label>
						</div>
						<div class="dn-option-control">
							<div class="dn-btns-set dn-active">
								<div class="dn-set-item dn-set-btn dn-active" data-value="unmute">
									<span>
										<?php esc_html_e( 'Unmute', 'omniverse' ); ?>
									</span>
								</div>
								<div class="dn-set-item dn-set-btn" data-value="mute">
									<span>
										<?php esc_html_e( 'Mute', 'omniverse' ); ?>
									</span>
								</div>
							</div>
							<input type="hidden" data-name="audio_status" value="unmute">
						</div>
						<p class="dn-field-description">
							<?php esc_html_e( 'Audio in autoplay videos is always muted.', 'omniverse' ); ?>
						</p>
					</div>
					<div class="dn-field dn-settings-field dn-switcher-control dn-gallery_hide_information-field">
						<div class="dn-option-title">
							<label>
								<span>
									<?php esc_html_e( 'Hide overlay information', 'omniverse' ); ?>
								</span>
								<div class="dn-hint">
									<div class="dn-tooltip dn-top">
										<video data-src="<?php echo esc_url( OMNIVERSE_TOOLTIP_URL . 'hide-overlay-information.mp4' ); ?>" autoplay loop muted></video>
									</div>
								</div>
							</label>
						</div>
						<div class="dn-option-control">
							<div class="dn-switcher-btn" data-on="1" data-off="0">
								<div class="dn-switcher-dot-wrap">
									<div class="dn-switcher-dot"></div>
								</div>
								<div class="dn-switcher-labels">
									<span class="dn-switcher-label dn-on">
										<?php esc_html_e( 'Yes', 'omniverse' ); ?>
									</span>
									<span class="dn-switcher-label dn-off">
										<?php esc_html_e( 'No', 'omniverse' ); ?>
									</span>
								</div>
							</div>
							<input type="hidden" data-name="hide_information" value="0">
						</div>
						<p class="dn-field-description">
							<?php esc_html_e( 'Hide product labels, buttons, and pagination on the gallery slider during video playback.', 'omniverse' ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="dn-popup-actions">
				<a href="#" class="dn-save-submit dn-btn dn-color-primary">
					<?php esc_html_e( 'Save', 'omniverse' ); ?>
				</a>
			</div>
		</div>
	</div>
</div>
