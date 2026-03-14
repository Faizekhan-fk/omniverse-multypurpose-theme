/* global omniverse_settings */
(function($) {
	omniverseThemeModule.commentImage = function() {
		$('form.comment-form').attr('enctype', 'multipart/form-data');

		var $form = $('.comment-form');
		var $input = $form.find('#wd-add-img-btn');
		var allowedMimes = [];

		if ($input.length === 0) {
			return;
		}

		$.each(omniverse_settings.comment_images_upload_mimes, function(index, value) {
			allowedMimes.push(String(value));
		});

		$form.find('#wd-add-img-btn').on('change', function() {
			$form.find('.wd-add-img-count').text(omniverse_settings.comment_images_added_count_text.replace('%s', this.files.length));
		});

		$form.on('submit', function(e) {
			$form.find('.woocommerce-error').remove();

			var hasLarge = false;
			var hasNotAllowedMime = false;

			if ($input[0].files.length > omniverse_settings.comment_images_count) {
				showError(omniverse_settings.comment_images_count_text);
				e.preventDefault();
			}

			if ($input[0].files.length <= 0 && 'yes' === omniverse_settings.single_product_comment_images_required) {
				showError(omniverse_settings.comment_required_images_error_text);
				e.preventDefault();
			}

			Array.prototype.forEach.call($input[0].files, function(file) {
				var size = file.size;
				var type = String(file.type);

				if (size > omniverse_settings.comment_images_upload_size) {
					hasLarge = true;
				}

				if ($.inArray(type, allowedMimes) < 0) {
					hasNotAllowedMime = true;
				}
			});

			if (hasLarge) {
				showError(omniverse_settings.comment_images_upload_size_text);
				e.preventDefault();
			}

			if (hasNotAllowedMime) {
				showError(omniverse_settings.comment_images_upload_mimes_text);
				e.preventDefault();
			}
		});

		function showError(text) {
			$form.prepend('<ul class="woocommerce-error" role="alert"><li>' + text + '</li></ul>');
		}
	};

	$(document).ready(function() {
		omniverseThemeModule.commentImage();
	});
})(jQuery);
