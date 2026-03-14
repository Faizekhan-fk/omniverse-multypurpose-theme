(function ($) {
    $('#vc_ui-panel-edit-element').on('vcPanel.shown', function () {
        $('.omniverse-vc-datepicker').each(function () {
            $(this).find('.omniverse-vc-datepicker-value').datetimepicker({
                dateFormat: 'yy/mm/dd',
                timeFormat: "HH:mm",
                showSecond: 0,
                showMillisec: 0,
                showMicrosec: 0,
                showTimezone: 0,
            });
        });
    });
})(jQuery);
