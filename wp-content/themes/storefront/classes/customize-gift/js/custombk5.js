function openPage(pageName,elmnt,color)
{
    if(pageName=='COFFEE') {
        jQuery(".coffeedetail").show();
    }
    else{
        jQuery(".coffeedetail").hide();
    }
    if(pageName=='GEAR') {
        jQuery(".geardetail").show();
    }
    else {
        jQuery(".geardetail").hide();
    } 
    if(pageName=='TIMING') {
        if (!jQuery(".chooseform").is(':checked')) {
            jQuery(".chooseformerror").html("Please select an option to continue.");
            console.log(jQuery(this).value);
            return false;
        }
        else {
            if(jQuery(".form_1_fname").val()=="")
            {
                $(".form_1_fnameerror").html("sssssssss");
                return false;
            }
            else {            
                jQuery("#TIMING").show();
            }
        }
    }  
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
}  document.getElementById("defaultOpen").click();
jQuery(document).ready(function($) {
    var alldetailobj = {}; var country_obj = {};  var grindtypeobj = {}; var gearobj = {};
    var terms_data,productsize,productduration,productfrequency,zone_id,grindtype,ground_grind_type;    
    function addcountryselect() {        /*for first step work*/ 
        var zone_id = $(".mycountryclass").val();
        var productsize = $('input[name="productsize"]:checked').val();
        var productduration = $('input[name="productduration"]:checked').val();
        var productfrequency = $('input[name="productfrequency"]:checked').val();
        var grindtype = $('input[name="grind_type"]:checked').val();
        if(grindtype=='ground') {
            ground_grind_type = $(".ground_grind_type_value").val();
            grindtypeobj = {"grindtype":grindtype,"ground_grind_type":ground_grind_type};
            $(".ground_grind_type").show();
        }
        else {
            grindtypeobj = {"grindtype":grindtype};
        }
        $(".oncountrychg").html('ADD');
        $(".ckprodadd").removeAttr('checked');
        $.ajax({
            url: customurl,
            type: "GET",
            dataType: 'json',
            data: {  zone_id: zone_id, productid: productid, },
            cache: false,
            success: function(dataResult)
            {
                allconditionscheck(zone_id,dataResult,productsize,productduration,productfrequency);
                if(dataResult !=="null") {
                    country_obj[zone_id] = dataResult;
                }
            }
        });  /*for second step work*/  
    }   
    $(".mycountryclass").on("change",addcountryselect);
    addcountryselect(); 
    function variationchangeandbydefault() {   /*for first step work*/
        var zone_id = $(".mycountryclass").val();
        var productsize = $('input[name="productsize"]:checked').val();
        var productduration = $('input[name="productduration"]:checked').val();
        var productfrequency = $('input[name="productfrequency"]:checked').val();
        var grindtype = $('input[name="grind_type"]:checked').val();
        grindtypeobj = {"grindtype":grindtype};
        var duration_arr = [];
        var frequency_arr = [];    
        if(productfrequency=='every-two-weeks') {    
            $("#durationsh_two-months").show();
        }
        else {
            $("#durationsh_two-months").hide();
        }
        if((productfrequency=='every-two-weeks')&&(productduration=='two-months')) {    
            $("input[value='every-month']").attr('disabled', true);
        }
        else {
            $("input[value='every-month']").attr('disabled', false);
        }
        if((productsize=='world-coffee-sampler')&&(productduration=='two-months')) {
            $("input[value='one-year']").attr('checked', true);
            $("input[value='every-month']").attr('disabled', false);
            $("input[value='every-month']").attr('checked', true);
            
            if(zone_id !=='1') {
                var productsize = 'world-coffee-sampler';
                var productduration = 'one-year';
                allconditionscheck(zone_id,country_obj[zone_id],productsize,productduration,productfrequency);
            }
            else {
                var productsize = 'world-coffee-sampler';
                var productduration = 'one-year';   
                allconditionscheck(zone_id,terms_data,productsize,productduration,productfrequency);
            }
        }
        if(productsize=='world-coffee-sampler') {
            $("input[value='every-month']").attr('checked', true);
            $("input[value='every-month']").attr('disabled', false);
            $(".hideshowpdata").hide();
             if(zone_id !=='1') {
                var productsize = 'world-coffee-sampler';
                var productfrequency = 'every-month';
                allconditionscheck(zone_id,country_obj[zone_id],productsize,productduration,productfrequency);
            }
            else {
                var productsize = 'world-coffee-sampler';
                var productfrequency = 'every-month';
                allconditionscheck(zone_id,terms_data,productsize,productduration,productfrequency);
            }        
        }
        else  {
           $(".hideshowpdata").show(); 
        }    
        var checksize = checkedvariation.filter(sizeobject => sizeobject.attributes.attribute_pa_size == productsize);
        $.each(checksize, function (index, value) {
            duration_arr.push(value.attributes.attribute_pa_duration);
            frequency_arr.push(value.attributes.attribute_pa_frequency);
        });
        $.each(productallduration, function (index, value) {
            if (duration_arr.indexOf(value)!=-1) {
                if(value!=='two-months') {
                    $("#durationsh_"+value).show();
                }
            }
            else {
                $("#durationsh_"+value).hide();
            }
        });
        $.each(productallfrequency, function (index, value) {
            if(frequency_arr.indexOf(value)!=-1) {
                $("#frequencysh_"+value).show();
            }
            else {
                $("#frequencysh_"+value).hide();
            }
        });
        if(grindtype=='whole-bean') {
            $(".ground_grind_type").hide();
        }
        if(grindtype=='ground') {
            ground_grind_type = $(".ground_grind_type_value").val();
            grindtypeobj = {"grindtype":grindtype,"ground_grind_type":ground_grind_type};
            $(".ground_grind_type").show();
        }
        if(zone_id !=='1') {
            allconditionscheck(zone_id,country_obj[zone_id],productsize,productduration,productfrequency);
        }
        else {
            allconditionscheck(zone_id,terms_data,productsize,productduration,productfrequency);
        } /*for third step work*/      
    }   
    $(".variationconnect,.ground_grind_type_value").on("change",variationchangeandbydefault);
    function allconditionscheck(zone_id,terms_data,productsize,productduration,productfrequency) {  /*for first step work*/
        var resultvariation = checkedvariation.filter(firstobject => firstobject.attributes.attribute_pa_size === productsize && firstobject.attributes.attribute_pa_duration === productduration && firstobject.attributes.attribute_pa_frequency === productfrequency)[0];
        if(resultvariation) {
            $("#showzonevariation").html("$"+resultvariation.display_price);
             /*for second step work*/
            var term_id = shipping_term_id[resultvariation.variation_id];
            if(terms_data) {
                var resultterms = terms_data.filter(termobject => termobject.term_id === term_id)[0];
                var totalprice = (parseInt(resultvariation.display_price) + parseInt(resultterms.cost));
                alldetailobj = { 'zone_id' : zone_id,'productsize' : productsize,'productfrequency' : productfrequency,'productduration':productduration,'totalprice':totalprice }; /*for second step work*/
                console.log(alldetailobj); console.log(grindtypeobj);
                $(".geartab").hide();
                $("#showzonevariationtotal").html("total $" + totalprice);
            }
            else {
                alldetailobj = { 'zone_id' : zone_id,'productsize' : productsize,'productfrequency' : productfrequency,'productduration' : productduration,'totalprice':resultvariation.display_price };
                console.log(alldetailobj); console.log(grindtypeobj);
                 $(".geartab").show(); /*for first step work*/
                $("#showzonevariationtotal").html("Free shipping available");
            }                
        }
    }
    allconditionscheck(zone_id,terms_data,productsize,productduration,productfrequency);
    var prodaddtol = 0; var i = 0; /* function for product add and added */
    $("input.ckprodadd").click(function() {
        var pdtidaddon = $(this).attr('data-id');
        var pdtname = $(this).attr('data-pdtname');
        if($(this).is(":checked")) {
            prodaddtol += parseFloat($(this).val());
            $(".changedata_"+pdtidaddon).html("ADDED");
            gearobj[pdtidaddon] = { 'productid': pdtidaddon , 'pdtname': pdtname, 'productprice': $(this).val() }; 
        } 
        else {
            prodaddtol -= parseFloat($(this).val());
            $(".changedata_"+pdtidaddon).html("ADD");
            delete gearobj[pdtidaddon];
        } console.log(gearobj);
        var addonvartotal = alldetailobj.totalprice + prodaddtol;
        $("#showzonevariation").html("$"+addonvartotal); 
    }); /* function for product product show by category  and sub category */
    $('.selectprosubcat').click(function() {
        if($(this).attr('data-subcategory')=='allproducts') {
            $('.autohideshow').show();
        }
        else {
            $('.autohideshow').hide();
            $('.subcats_' + $(this).attr('data-subcategory')).show();
        }
    });
    $('.chooseform').click(function(){
       var formid = $(this).attr("data-formid");
       $('.firsthidefrom').hide();
       $(".form"+formid).show(); 
    });
});