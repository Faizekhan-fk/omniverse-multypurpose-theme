(function ($) {

    $('#vc_ui-panel-edit-element').on('vcPanel.shown', function () {
        $('.omniverse-vc-image-select').each(function () {
            var $select = $(this);
            var $input = $select.find('.omniverse-vc-image-select-input');
            var inputValue = $input.attr('value');
            $select.find('li[data-value="' + inputValue + '"]').addClass('dn-active');
            $select.find('li').click(function () {
                var $this = $(this),
                    dataValue = $this.data('value');

                $this.siblings().removeClass('dn-active');
                $this.addClass('dn-active');
                $input.attr('value', dataValue).trigger('change');
            });
        });
    });

})(jQuery);
