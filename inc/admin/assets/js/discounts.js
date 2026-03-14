/* global omniverseConfig */
/* global omniverse_discounts_notice */
(function($) {
    // Condition query select2.
    function conditionQuerySelect2($field) {
        $field.select2({
            ajax             : {
                url     : omniverseConfig.ajaxUrl,
                data    : function(params) {
                    return {
                        action    : 'wd_discount_conditions_query',
                        security  : omniverseConfig.get_new_template_nonce,
                        query_type: $field.attr('data-query-type'),
                        search    : params.term
                    };
                },
                method  : 'POST',
                dataType: 'json'
            },
            theme            : 'dn',
            dropdownAutoWidth: false,
            width            : 'resolve'
        });
    }

    function conditionQueryFieldInit( conditionType, $querySelect ) {
        if ($querySelect.data('select2')) {
            $querySelect.val('');
            $querySelect.select2('destroy');
        }

        var $conditionQueryFieldTitle      = $querySelect.parents('.dn-controls-wrapper').find('.dn-discount-condition-query').first();
        var $querySelectWrapper            = $querySelect.parent();
        var $productTypeQuerySelectWrapper = $querySelect.parent().siblings('.dn-discount-product-type-condition-query');

        if ('all' === conditionType) {
            $querySelectWrapper.addClass('dn-hidden');
            $productTypeQuerySelectWrapper.addClass('dn-hidden');
            $querySelect.removeAttr('data-query-type');
        } else if ('product_type' === conditionType) {
            $querySelectWrapper.addClass('dn-hidden');
            $productTypeQuerySelectWrapper.removeClass('dn-hidden');
            $querySelect.removeAttr('data-query-type');
        } else {
            $querySelectWrapper.removeClass('dn-hidden');
            $productTypeQuerySelectWrapper.addClass('dn-hidden');
            $querySelect.attr('data-query-type', conditionType);
            conditionQuerySelect2($querySelect);
        }

        // Show or hide Condition query field title.
        var showTitle = false;

        $('select.dn-discount-condition-type').each((key, type) => {
            if ( 'all' !== $(type).val() ) {
                showTitle = true;
            }
        });

        if ( showTitle ) {
            $conditionQueryFieldTitle.removeClass('dn-hidden');
        } else {
            $conditionQueryFieldTitle.addClass('dn-hidden');
        }
    }

    function validate() {
        let isValid = true;
        let ruleType = $('#_omniverse_rule_type').val();
        let $ruleRows = $('.dn-_omniverse_discount_rules-field .dn-controls-wrapper > .dn-discount:not(.title)');
        let $conditionRows = $('.dn-_omniverse_discount_condition-field .dn-controls-wrapper > .dn-discount:not(.title)');
        let discountRulesSelector = '.dn-_omniverse_discount_rules-field';
        let discountConditionSelector = '.dn-_omniverse_discount_condition-field';

        if ( 'undefined' === typeof ruleType ) {
            ruleType = 'bulk';
        }

        if ( 'bulk' !== ruleType ) {
            return isValid;
        }

        removeNotices( discountRulesSelector );
        removeNotices( discountConditionSelector );

        if ( 0 === $ruleRows.length ) {
            showNotice( discountRulesSelector, omniverse_discounts_notice.no_quantity_range );
            isValid = false;
        }

        if ( 0 === $conditionRows.length ) {
            showNotice( discountConditionSelector, omniverse_discounts_notice.no_discount_condition );
            isValid = false;
        }

        $ruleRows.each((key,ruleRow) => {
            let $ruleRow              = $(ruleRow);
            let priceFrom     = parseInt( $ruleRow.find('.dn-discount-from input').val() );
            let priceTo       = parseInt( $ruleRow.find('.dn-discount-to input').val() );
            let type              = $ruleRow.find('.dn-discount-type select').val();
            let discountPercentageValue = parseInt( $ruleRow.find('.dn-discount-percentage-value input').val() );
            let nextPriceFrom = parseInt( $ruleRow.next().find('.dn-discount-from input').val() );

            if ( isNaN( priceFrom ) || isNaN( priceTo ) ) {
                return isValid;
            }

            if ( key !== $ruleRows.length - 1 && priceTo >= nextPriceFrom ) {
                if ( isNaN( nextPriceFrom ) ) {
                    return isValid;
                }

                showNotice( discountRulesSelector, omniverse_discounts_notice.quantity_range_start );
                isValid = false;
            }

            if ( priceFrom > priceTo ) {
                showNotice( discountRulesSelector, omniverse_discounts_notice.closing_quantity );
                isValid = false;
            }

            if ( 'percentage' === type && discountPercentageValue > 100 ) {
                showNotice( discountRulesSelector, omniverse_discounts_notice.max_value );
                isValid = false;
            }
        });

        return isValid;
    }

    function showNotice(selector, notice) {
        $( selector ).prepend(
            '<div class="notice notice-error is-dismissible">' +
                '<p>' +
                    notice +
                '</p>' +
                '<button type="button" class="notice-dismiss">' +
                    '<span class="screen-reader-text">' +
                        omniverse_discounts_notice.dismiss_text +
                    '</span>' +
                '</button>' +
            '</div>'
        );

        $( selector ).on('click', '.notice .notice-dismiss', function(e) {
            e.preventDefault();

            let $this = $(this);
            let $thisNotice = $this.parents('.notice');

            $thisNotice.fadeTo( 100, 0, function() {
                $thisNotice.slideUp( 100, function() {
                    $thisNotice.remove();
                });
            });
        })
    }

    function removeNotices(selector) {
        $( selector ).find('.notice').remove();
    }

    function updateConditions($ruleRow) {
        $ruleRow.find('.dn-discount-from input').attr('required', true);
        $ruleRow.find('.dn-discount-type select').attr('required', true);
        $ruleRow.find('.dn-discount-amount-value:not(.dn-hidden) input').attr('required', true);
        $ruleRow.find('.dn-discount-percentage-value:not(.dn-hidden) input').attr('required', true);

        $ruleRow.find('.dn-discount-type select').on('change', function() {
            let $discountTypeSelect = $(this);
            let $discountTypeWrapper = $discountTypeSelect.parent();
            let $discountAmountInputWrapper = $discountTypeWrapper.siblings('.dn-discount-amount-value');
            let $discountPercentageInputWrapper = $discountTypeWrapper.siblings('.dn-discount-percentage-value');
            let $discountAmountInput = $discountAmountInputWrapper.find('input');
            let $discountPercentageInput = $discountPercentageInputWrapper.find('input');

            if ( 'amount' === $discountTypeSelect.val() ) {
                $discountAmountInputWrapper.removeClass('dn-hidden');
                $discountPercentageInputWrapper.addClass('dn-hidden');

                $discountAmountInput.attr('required', true);
                $discountPercentageInput.attr('required', false);
            } else if ( 'percentage' === $discountTypeSelect.val() ) {
                $discountPercentageInputWrapper.removeClass('dn-hidden');
                $discountAmountInputWrapper.addClass('dn-hidden');

                $discountPercentageInput.attr('required', true);
                $discountAmountInput.attr('required', false);
            }
        })
    }

    $('#post:has(.dn-options)').on('submit', function(e){
        if ( ! validate() ) {
            e.preventDefault();
        }
    });

    $(document)
        .ready( function() {
            $('select.dn-discount-condition-query:not(.dn-hidden)').each((key, field) => {
                var $querySelect  = $( field );
                var conditionType = $querySelect.parents('.dn-discount').find('select.dn-discount-condition-type').val();

                conditionQueryFieldInit( conditionType, $querySelect );
            });

            $('.dn-_omniverse_discount_rules-field .dn-controls-wrapper > .dn-discount:not(.title)').each((key,ruleRow) => {
                updateConditions( $(ruleRow) );
            });
        })
        .on('change', 'select.dn-discount-condition-type', function() {
            var $this = $(this);
            var conditionType = $this.val();
            var $querySelect = $this.parents('.dn-discount').find('select.dn-discount-condition-query');

            conditionQueryFieldInit( conditionType, $querySelect );
        })
        .on('click', '.dn-_omniverse_discount_rules-field .dn-add-row', function() {
            let ruleType = $('#_omniverse_rule_type').val();
            let $ruleRows = $('.dn-_omniverse_discount_rules-field .dn-controls-wrapper > .dn-discount:not(.title)');

            if ( 'undefined' === typeof ruleType ) {
                ruleType = 'bulk';
            }

            if ( 'bulk' !== ruleType ) {
                return;
            }

            $ruleRows.each((key,ruleRow) => {
                let $ruleRow = $(ruleRow);

                updateConditions( $ruleRow );

                if ( key !== $ruleRows.length - 1 ) {
                    $ruleRow.find('.dn-discount-to input').attr('required', true);
                }
            });
        })
        .on('click', '.column-wd_woo_discounts_status .dn-switcher-btn', function() {
            var $switcher = $(this);

            $switcher.addClass('dn-loading');

            $.ajax({
                url     : omniverseConfig.ajaxUrl,
                method  : 'POST',
                data    : {
                    action  : 'wd_woo_discounts_change_status',
                    id      : $switcher.data('id'),
                    status  : 'publish' === $switcher.data('status') ? 'draft' : 'publish',
                    security: omniverseConfig.get_new_template_nonce
                },
                dataType: 'json',
                success : function(response) {
                    $switcher.replaceWith(response.new_html);
                },
                error   : function(error) {
                    console.error(error);
                }
            });
        });
})(jQuery)
