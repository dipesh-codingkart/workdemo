var epdates = jQuery(".epdate").val();
epstrArray = epdates.split(" ");
var dates = [];
for(var epi = 0; epi < epstrArray.length; epi++)
{
    dates.push(epstrArray[epi]); 
}
function addDate(date) {
    if (jQuery.inArray(date, dates) < 0) dates.push(date);
}
function removeDate(index) {
    dates.splice(index, 1);
}
function printArray() {
    var printArr = new String;
    dates.forEach(function (val) {
        printArr +=  val+" ";
    });
    jQuery('.print-array').val(printArr);
}
function addOrRemoveDate(date) {
    var index = jQuery.inArray(date, dates);
    if (index >= 0) 
        removeDate(index);
    else 
        addDate(date);

    printArray();
}
function padNumber(number) {
    var ret = new String(number);
    if (ret.length == 1) ret = "0" + ret;
    return ret;
}
jQuery(".onedateselect").datepicker({
    onSelect: function (dateText, inst) {
        addOrRemoveDate(dateText);
    },
    beforeShowDay: function (date) {
        var year = date.getFullYear();
        var month = padNumber(date.getMonth() + 1);
        var day = padNumber(date.getDate());
        var dateString = month + "/" + day + "/" + year;

        var gotDate = jQuery.inArray(dateString, dates);
        if (gotDate >= 0) {
            return [true, "ui-state-highlight"];
        }
        return [true, ""];
    }
});
jQuery(function() {
    jQuery('.gift_sub_tp').timeselector()
});