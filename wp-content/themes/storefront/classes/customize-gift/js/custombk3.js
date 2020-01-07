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
         /**********1*************/
        var str = $("#myForm").serializeArray();
        var myJSON = JSON.stringify(str);
        var zone_id = str[0].value;
        var productsize = str[1].value;
        var productfrequency = str[2].value;
        var productduration = str[3].value;
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
         /**********2*************/    
    }   
    $("#mycountryid").on("change",addcountryselect);
    addcountryselect(); 
    
    function variationchangeandbydefault() 
    {
        /**********1*************/
        var zone_id = $("#mycountryid").val();
        var productsize = $('input[name="productsize"]:checked').val();
        var productduration = $('input[name="productduration"]:checked').val();
        var productfrequency = $('input[name="productfrequency"]:checked').val();
        var duration_arr = [];
        var frequency_arr = [];
        /**********1*************/
        
        /**********2*************/
        if(productfrequency=='every-two-weeks')
        {    
            $("#durationsh_two-months").show();
        }
        else
        {
            $("#durationsh_two-months").hide();
        }
        if((productfrequency=='every-two-weeks')&&(productduration=='two-months'))
        {    
            $("input[value='every-month']").attr('disabled', true);
        }
        else
        {
            $("input[value='every-month']").attr('disabled', false);
        }
        if((productsize=='world-coffee-sampler')&&(productduration=='two-months'))
        {
            $("input[value='one-year']").attr('checked', true);
            $("input[value='every-month']").attr('disabled', false);
            $("input[value='every-month']").attr('checked', true);
            var productduration = 'one-year';
            var productfrequency = 'every-month';
            allconditionscheck(terms_data,productsize,productduration,productfrequency);
        }
        if(productsize=='world-coffee-sampler')
        {
            $("input[value='every-month']").attr('checked', true);
            $("input[value='every-month']").attr('disabled', false);
            $(".hideshowpdata").hide();
        }
        else
        {
           $(".hideshowpdata").show(); 
        }    
        var checksize = checkedvariation.filter(sizeobject => sizeobject.attributes.attribute_pa_size == productsize);
        $.each(checksize, function (index, value) 
        {
            duration_arr.push(value.attributes.attribute_pa_duration);
            frequency_arr.push(value.attributes.attribute_pa_frequency);
        });
        $.each(productallduration, function (index, value) 
        {
            if (duration_arr.indexOf(value)!=-1)
            {
                if(value!=='two-months')
                {
                    $("#durationsh_"+value).show();
                }
            }
            else
            {
                $("#durationsh_"+value).hide();
            }
        });
        $.each(productallfrequency, function (index, value) 
        {
            if(frequency_arr.indexOf(value)!=-1)
            {
                $("#frequencysh_"+value).show();
            }
            else
            {
                $("#frequencysh_"+value).hide();
            }
        });
        /**********2*************/
        /**********3*************/
        if(zone_id !=='1')
        {
            allconditionscheck(country_obj[zone_id],productsize,productduration,productfrequency);
        }
        else
        {
            var term_data="";
            allconditionscheck(terms_data,productsize,productduration,productfrequency);
        }
        /**********3*************/        
    }   
    $("input[type='radio']").on("change",variationchangeandbydefault);
    variationchangeandbydefault();  
    
    function allconditionscheck(terms_data,productsize,productduration,productfrequency)
    {
        /**********1*************/
        var terms_data;
        var resultvariation = checkedvariation.filter(firstobject => firstobject.attributes.attribute_pa_size === productsize && firstobject.attributes.attribute_pa_duration === productduration && firstobject.attributes.attribute_pa_frequency === productfrequency)[0];
        if(resultvariation)
        {
            $("#showzonevariation").html("$"+resultvariation.display_price);
             /**********2*************/
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
            