(function ($) {
    const wdSwitcherBtnInit = function () {
        $('.dn-switcher-btn').each(function() {
            var $switcherBtn = $(this);

            if ( $switcherBtn.hasClass('wd-inited') ) {
                return;
            }

            $switcherBtn.on('click', function () {
                var $this = $(this);
                var value = '';

                if ($this.hasClass('dn-active')) {
                    value = $this.data('off');
                    $this.removeClass('dn-active');
                } else {
                    value = $this.data('on');
                    $this.addClass('dn-active');
                }

                $this.find('.switch-field-value').val(value).trigger('change');
            });

            $switcherBtn.addClass('wd-inited');
        });
    }

    $('#vc_ui-panel-edit-element').on('vcPanel.shown click > .vc_controls [data-vc-control="clone"]', function () {
        wdSwitcherBtnInit();
    });
})(jQuery);
