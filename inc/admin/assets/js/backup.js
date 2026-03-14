/* global omniverseConfig */

(function($) {
	'use strict';

	$(document).on('click', '.dn-create-backup', function(e) {
		e.preventDefault();

		$('.dn-box-content').addClass('dn-loading');
		cleanNotices();

		$.ajax({
			url    : omniverseConfig.ajaxUrl,
			method : 'POST',
			data   : {
				action  : 'zs_create_backup',
				security: omniverseConfig.backup_nonce
			},
			success: function(response) {
				$('.dn-box').replaceWith(response.data.content);
				printNotice(response.success, response.data.message);
				$('.dn-box-content').removeClass('dn-loading');
			}
		});
	});

	$(document).on('click', '.dn-delete-backup', function(e) {
		e.preventDefault();

		if (!confirm(omniverseConfig.remove_backup_text)) {
			return;
		}

		var $this = $(this);

		$('.dn-box-content').addClass('dn-loading');
		cleanNotices();

		$.ajax({
			url    : omniverseConfig.ajaxUrl,
			method : 'POST',
			data   : {
				action  : 'zs_delete_backup',
				id      : $this.parents('.dn-backup-item').data('id'),
				security: omniverseConfig.backup_nonce
			},
			success: function(response) {
				$('.dn-box').replaceWith(response.data.content);
				printNotice(response.success, response.data.message);
				$('.dn-box-content').removeClass('dn-loading');
			}
		});
	});

	$(document).on('click', '.dn-apply-backup', function(e) {
		e.preventDefault();

		var $this = $(this);

		if (!confirm(omniverseConfig.apply_backup_text)) {
			return;
		}

		$('.dn-box-content').addClass('dn-loading');
		cleanNotices();

		$.ajax({
			url    : omniverseConfig.ajaxUrl,
			method : 'POST',
			data   : {
				action  : 'zs_apply_backup',
				id      : $this.parents('.dn-backup-item').data('id'),
				security: omniverseConfig.backup_nonce
			},
			success: function(response) {
				printNotice(response.success, response.data.message);
				$this.removeClass('dn-loading');
				$('.dn-box-content').removeClass('dn-loading');
			}
		});
	});

	function cleanNotices() {
		$('.dn-notices-wrapper').html('');
	}

	function printNotice(success, message) {
		$('.dn-notices-wrapper').append(`
			<div class="dn-notice dn-${success ? 'success' : 'error'}">
				${message}
			</div>
		`);
	}
})(jQuery);