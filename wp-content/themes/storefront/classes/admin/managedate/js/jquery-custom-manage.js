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
    $('.gift_sub_tp').timeselector();
});  