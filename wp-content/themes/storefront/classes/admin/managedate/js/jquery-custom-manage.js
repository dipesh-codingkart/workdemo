jQuery(function($) {    
    var epdates = ($('.express_priority').val()) ? $('.express_priority').val().split(', ') : 0 ;
    $('.select_epdates').multiDatesPicker({
        addDates: epdates,
        altField: '.express_priority'
    });
    var intlc_dates = ($('.intl_calendar').val()) ? $('.intl_calendar').val().split(', ') : 0 ;
    $('.select_intlcdates').multiDatesPicker({
        addDates: intlc_dates,
        altField: '.intl_calendar'
    });
    var free_shipping_dates = ($('.us_free_shipping_cal').val()) ? $('.us_free_shipping_cal').val().split(', ') : 0 ;
    $('.select_free_shipping_dates').multiDatesPicker({
        addDates: free_shipping_dates,
        altField: '.us_free_shipping_cal'
    });
    var disable_tasting_kit_dates = ($('.disable_tasting_kit_cal').val()) ? $('.disable_tasting_kit_cal').val().split(', ') : 0 ;
    $('.select_disable_tasting_kit_dates').multiDatesPicker({
        addDates: disable_tasting_kit_dates,
        altField: '.disable_tasting_kit_cal'
    });
    $('.gift_sub_tp').timeselector();
});  