function openPage(pageName,elmnt,color)
{
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++)
    {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++)
    {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;
}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
jQuery(document).ready(function($)
{
    var terms_data,productsize,productduration,productfrequency;
    function addcountryselect() 
    {
        var str = $("#myForm").serializeArray();
        var myJSON = JSON.stringify(str);
        var zone_id = str[0].value;
        var productsize = str[1].value;
        var productduration = str[2].value;
        var productfrequency = str[3].value;
        $.ajax({
            url: customurl,
            type: "GET",
            data:
            {
                zone_id: zone_id,
                productid: productid,
            },
            cache: false,
            success: function(dataResult)
            {
                allconditionscheck(dataResult,productsize,productduration,productfrequency);
            }
        });
    }    
    $("#mycountryid").on("change",addcountryselect);
    addcountryselect();
    function variationchangeandbydefault(terms_data) 
    {
        var productsize = $('input[name="productsize"]:checked').val();
        var productduration = $('input[name="productduration"]:checked').val();
        var productfrequency = $('input[name="productfrequency"]:checked').val();
        console.log(terms_data);
        allconditionscheck(terms_data,productsize,productduration,productfrequency);
    }   
    $("input[type='radio']").on("click",variationchangeandbydefault);
    variationchangeandbydefault(terms_data);
    
    function allconditionscheck(terms_data,productsize,productduration,productfrequency)
    {
        var resultvariation = checkedvariation.filter(firstobject => firstobject.attributes.attribute_pa_size === productsize && firstobject.attributes.attribute_pa_duration === productduration && firstobject.attributes.attribute_pa_frequency === productfrequency);
        if(resultvariation)
        {
            $("#showzonevariation").html("$"+resultvariation[0].display_price);
            var term_id = shipping_term_id[resultvariation[0].variation_id];
            
            var term_data =  jQuery.parseJSON(terms_data);
            if(term_data)
            {
                var resultterms = term_data.filter(termobject => termobject.term_id === term_id);
                var totalprice = (parseInt(resultvariation[0].display_price) + parseInt(resultterms[0].cost));
                $("#showzonevariationtotal").html("Total $" + totalprice);
            }
            else
            {
                $("#showzonevariationtotal").html("Free shipping available");
            }                
        }
    }
    allconditionscheck(terms_data,productsize,productduration,productfrequency);    
});    
            