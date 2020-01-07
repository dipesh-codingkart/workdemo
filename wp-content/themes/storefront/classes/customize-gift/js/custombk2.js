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
document.getElementById("defaultOpen").click();
jQuery(document).ready(function($)
{
    var terms_data,productsize,productduration,productfrequency;
    var country_obj = {};
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
            dataType: 'json',
            data:
            {
                zone_id: zone_id,
                productid: productid,
            },
            cache: false,
            success: function(dataResult)
            {
                allconditionscheck(dataResult,productsize,productduration,productfrequency);
                if(dataResult !=="null")
                {
                    country_obj[zone_id] = dataResult;
                }   
            }
        });       
    }   
    $("#mycountryid").on("change",addcountryselect);
    addcountryselect(); 
    
    function variationchangeandbydefault() 
    {
        var zone_id = $("#mycountryid").val();
        var productsize = $('input[name="productsize"]:checked').val();
        var productduration = $('input[name="productduration"]:checked').val();
        var productfrequency = $('input[name="productfrequency"]:checked').val();
        //var checksize = checkedvariation.filter(sizeobject => sizeobject.attributes.attribute_pa_size === productsize);
        /*    
        for(var i=0;i<=checksize.length;i++)
        {
            if(jQuery.inArray(checksize[i].attributes.attribute_pa_duration, productallduration))
            {
                $("#durationsh_"+checksize[i].attributes.attribute_pa_duration).show();
            }
            else
            {
                $("#durationsh_"+checksize[i].attributes.attribute_pa_duration).hide();
            }
            if(jQuery.inArray(checksize[i].attributes.attribute_pa_frequency, productallfrequency))
            {
                $("#frequencysh_"+checksize[i].attributes.attribute_pa_frequency).show();
                
            }
            else
            {
                $("#frequencysh_"+checksize[i].attributes.attribute_pa_frequency).hide();
                //console.log(checksize[i].attributes.attribute_pa_frequency);
            }
        } */         
         
        if(zone_id !=='1')
        {
            /* Object.size = function(obj) {
                var size = 0, key;
                for (key in obj) {
                    if (obj.hasOwnProperty(key)) size++;
                }
                return size;
            };
            var size = Object.size(country_obj); */
            allconditionscheck(country_obj[zone_id],productsize,productduration,productfrequency);
        }
        else
        {
            var term_data="";
            allconditionscheck(terms_data,productsize,productduration,productfrequency);
        }    
    }   
    $("input[type='radio']").on("click",variationchangeandbydefault);
    variationchangeandbydefault();
    function allconditionscheck(terms_data,productsize,productduration,productfrequency)
    {
        var terms_data;
        var resultvariation = checkedvariation.filter(firstobject => firstobject.attributes.attribute_pa_size === productsize && firstobject.attributes.attribute_pa_duration === productduration && firstobject.attributes.attribute_pa_frequency === productfrequency)[0];
        if(resultvariation)
        {
            $("#showzonevariation").html("$"+resultvariation.display_price);
            var term_id = shipping_term_id[resultvariation.variation_id];
            if(terms_data)
            {
                var resultterms = terms_data.filter(termobject => termobject.term_id === term_id)[0];
                var totalprice = (parseInt(resultvariation.display_price) + parseInt(resultterms.cost));
                $("#showzonevariationtotal").html("total $" + totalprice);
            }
            else
            {
                $("#showzonevariationtotal").html("Free shipping available");
            }                
        }
    }
    allconditionscheck(terms_data,productsize,productduration,productfrequency);    
});    
            