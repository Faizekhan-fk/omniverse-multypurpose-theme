/* global omniverseConfig */
/* global omniverse_patch_notice */

(function($) {
	'use strict';

	$(document).on('click', '.dn-patch-apply', function (e) {
		e.preventDefault();

		var $this = $(this);
		var patchesMap = $this.data('patches-map');
		var fileMap = [];

		for(var i = 0; i < patchesMap.length; i++) {
			fileMap[i] = 'omniverse/' + patchesMap[i];
		}

		var confirmation = confirm( `${omniverse_patch_notice.single_patch_confirm} \r\r\n` + fileMap.join('\r\n') );

		if ( ! confirmation ) {
			return;
		}

		addLoading();
		cleanNotice();

		sendAjax($this.data('id'), function(response) {
            if ( 'undefined' !== typeof response.message ) {
                printNotice(response.status, response.message);
            }

            if ( 'undefined' !== typeof response.status && 'success' === response.status ) {
                $this.parents('.dn-patch-item').addClass('dn-applied');
                updatePatcherCounter();
            }

            removeLoading();
        });
	});

	$(document).on('click', '.dn-patch-apply-all', function (e) {
		e.preventDefault();

		var $applyAllBtn = $(this);
        var $patches     = $('.dn-patch-item:not(.dn-table-row-heading):not(.dn-applied)').get();

		cleanNotice();

		if ( 0 === $patches.length ) {
			printNotice('success', omniverse_patch_notice.all_patches_applied);
			return;
		}

		if ( ! confirm(omniverse_patch_notice.all_patches_confirm) ) {
			return;
		}

		$applyAllBtn.parent().addClass('dn-loading');
        addLoading();
        recursiveApply($patches);
	});

    function recursiveApply($patches){
        var $applyAllBtn = $('.dn-patch-apply-all');

        if ( 0 === $patches.length ) {
            $applyAllBtn.parent().addClass('dn-applied');
            $applyAllBtn.parent().removeClass('dn-loading');
            removeLoading();

            return;
        }

        var $patch = $($patches.pop());
        var id     = $patch.find('.dn-patch-apply').data('id');

        sendAjax(id , function(response) {
            if ( 'undefined' !== typeof response.message && 'error' === response.status ) {
				$applyAllBtn.parent().removeClass('dn-loading');
                printNotice(response.status, response.message);
            }

			if ( 0 === $patches.length ) {
				printNotice('success', omniverse_patch_notice.all_patches_applied);
			}

            if ( 'undefined' !== typeof response.status && 'success' === response.status ) {
                $patch.addClass('dn-applied');
				updatePatcherCounter();

                recursiveApply($patches);
            } else {
                removeLoading();
            }
        });
    }

	function sendAjax(id, cb) {
		$.ajax({
			url    : omniverseConfig.ajaxUrl,
			data   : {
				action   : 'omniverse_patch_action',
				security : omniverseConfig.patcher_nonce,
				id,
			},
			timeout: 1000000,
			error  : function() {
				printNotice('error', omniverse_patch_notice.ajax_error);
			},
			success: cb
		});
	}

	// Helpers.
	function printNotice(type, message) {
		$('.dn-notices-wrapper').append(`
			<div class="dn-notice dn-${type}">
				${message}
			</div>
		`);

		setTimeout(function(){
			$('.dn-notice').addClass('dn-hidden');
		}, 7000);
	}

	function cleanNotice() {
		$('.dn-notices-wrapper').text('');
	}

	function addLoading() {
		$('.dn-box-content').addClass('dn-loading');
		$('.dn-patch-apply-all').addClass('dn-disabled');
	}

	function removeLoading() {
		$('.dn-box-content').removeClass('dn-loading');
		$('.dn-patch-apply-all').removeClass('dn-disabled');
	}

	function updatePatcherCounter() {
		var $counters = document.querySelectorAll('.dn-patcher-counter');

		$counters.forEach( $counter => {
			if ( null === $counter) {
				return;
			}

			var $count = parseInt($counter.querySelector('.patcher-count').innerText);

			if ( 1 === $count ) {
				$counter.classList.add('dn-hidden');
			} else {
				$counter.querySelector('.patcher-count').innerText = --$count;
			}
		});
	}

})(jQuery);