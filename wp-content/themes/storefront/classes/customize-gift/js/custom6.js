jQuery(document).ready(function($) {
    var fromidobj = {}; var sltdeliveryobj = {};
    function selecteddeliverfrom() {
        $(".chooseformerror").hide();
        var formid = $(this).attr("data-formid");
        $('.firsthidefrom').hide();
        fromidobj = {'fromid':formid};
        $(".form"+formid).show();
        $(".deliverydetail").hide();
    }
    $(".chooseform").on("click", selecteddeliverfrom);
    $('.tablink').click(function() { /* for tab work */
        $('.tabs').hide();
        $('.tabcontent_COFFEE').hide();
        if($(this).attr('data-tabid')=='COFFEE') {
            $(".coffeedetail").show();
            $('.tabcontent_' + $(this).attr('data-tabid')).show();
            $('.firsthidefrom').hide();
            $('.timingdetail').hide();
        } else {
            $(".coffeedetail").hide();
        }
        if($(this).attr('data-tabid')=='GEAR') {
            $(".geardetail").show();
            $('.tabcontent_' + $(this).attr('data-tabid')).show();
            $('.firsthidefrom').hide();
            $('.deliverydetail').hide();
            $('.timingdetail').hide();
        } else {
            $(".geardetail").hide();
        }
        if($(this).attr('data-tabid')=='DELIVERY') {
            $('.tabcontent_' + $(this).attr('data-tabid')).show();
            $(".deliverydetail").show();
            $('.timingdetail').hide();
        }
        if($(this).attr('data-tabid')=='TIMING') { /* tab work with validation */
             datepickerfunct(fromidobj.fromid);/* this function work for timepicker */
            if (!$(".chooseform").is(':checked')) {
                $(".chooseformerror").html("Please select an option to continue.");
                $('.tabcontent_DELIVERY').show();  
                $(".deliverydetail").show();
            }
            if((fromidobj.fromid=='1')||(fromidobj.fromid=='2')) {
                if(($(".form_fname_"+fromidobj.fromid).val()=="")||($(".form_lname_"+fromidobj.fromid).val()=="")||($(".form_address_"+fromidobj.fromid).val()=="")||($(".form_address2_"+fromidobj.fromid).val()=="")||($(".form_city_"+fromidobj.fromid).val()=="")||($(".form_state_"+fromidobj.fromid).val()=="")||($(".form_zip_"+fromidobj.fromid).val()=="")||($(".form_gifted_by_"+fromidobj.fromid).val()=="")||($(".form_gift_msg_"+fromidobj.fromid).val()=="")) {
                    $(".form_fnameerror_"+fromidobj.fromid).html("Please Enter First Name").show();
                    $(".form_lnameerror_"+fromidobj.fromid).html("Please Enter Last Name").show();
                    $(".form_addresserror_"+fromidobj.fromid).html("Please Enter Address").show();
                    $(".form_address2error_"+fromidobj.fromid).html("Please Enter Other Address").show();
                    $(".form_cityerror_"+fromidobj.fromid).html("Please Enter City").show();
                    $(".form_stateerror_"+fromidobj.fromid).html("Please Enter State").show();
                    $(".form_ziperror_"+fromidobj.fromid).html("Please Enter Zip Code").show();
                    $(".form_gifted_byerror_"+fromidobj.fromid).html("Please Enter Gifted By").show();
                    $(".form_gift_msgerror_"+fromidobj.fromid).html("Please Enter Gift Message").show();
                    if($(".form_fname_"+fromidobj.fromid).val()!="") {
                        $(".form_fnameerror_"+fromidobj.fromid).hide(); 
                    }
                    if($(".form_lname_"+fromidobj.fromid).val()!="") {
                        $(".form_lnameerror_"+fromidobj.fromid).hide(); 
                    }
                    if($(".form_address_"+fromidobj.fromid).val()!="") {
                        $(".form_addresserror_"+fromidobj.fromid).hide(); 
                    }
                    if($(".form_address2_"+fromidobj.fromid).val()!="") {
                        $(".form_address2error_"+fromidobj.fromid).hide(); 
                    }
                    if($(".form_city_"+fromidobj.fromid).val()!="") {
                        $(".form_cityerror_"+fromidobj.fromid).hide(); 
                    }
                    if($(".form_state_"+fromidobj.fromid).val()!="") {
                        $(".form_stateerror_"+fromidobj.fromid).hide(); 
                    }
                    if($(".form_zip_"+fromidobj.fromid).val()!="") {
                        $(".form_ziperror_"+fromidobj.fromid).hide(); 
                    }
                    if($(".form_gifted_by_"+fromidobj.fromid).val()!="") {
                        $(".form_gifted_byerror_"+fromidobj.fromid).hide(); 
                    }
                    if($(".form_gift_msg_"+fromidobj.fromid).val()!="") {
                        $(".form_gift_msgerror_"+fromidobj.fromid).hide(); 
                    }
                    $('.tabcontent_DELIVERY').show();
                    $('.timingdetail').hide();
                }  else {
                    $(".form_fnameerror_"+fromidobj.fromid).hide(); 
                    $(".form_lnameerror_"+fromidobj.fromid).hide(); 
                    $(".form_addresserror_"+fromidobj.fromid).hide(); 
                    $(".form_address2error_"+fromidobj.fromid).hide(); 
                    $(".form_cityerror_"+fromidobj.fromid).hide(); 
                    $(".form_stateerror_"+fromidobj.fromid).hide(); 
                    $(".form_ziperror_"+fromidobj.fromid).hide(); 
                    $(".form_gifted_byerror_"+fromidobj.fromid).hide(); 
                    $(".form_gift_msgerror_"+fromidobj.fromid).hide(); 
                    $('.tabcontent_TIMING').show();
                    $(".form"+fromidobj.fromid).hide();
                    $(".deliverydetail").hide();
                    $('.timingdetail').show();
                    sltdeliveryobj = { "fromid":fromidobj.fromid,"form_fname" : $(".form_fname_"+fromidobj.fromid).val(),"form_lname" : $(".form_lname_"+fromidobj.fromid).val(),"form_address" : $(".form_address_"+fromidobj.fromid).val(),"form_address2" : $(".form_address2_"+fromidobj.fromid).val(),"form_city" : $(".form_city_"+fromidobj.fromid).val(),"form_state" : $(".form_state_"+fromidobj.fromid).val(),"form_zip" : $(".form_zip_"+fromidobj.fromid).val(),"form_gifted_by" : $(".form_gifted_by_"+fromidobj.fromid).val() ,"form_gift_msg" : $(".form_gift_msg_"+fromidobj.fromid).val() };
                    console.log(sltdeliveryobj);
                }
            }
            if(fromidobj.fromid=='3')
            {
                if(($(".form_fname_"+fromidobj.fromid).val()=="")||($(".form_lname_"+fromidobj.fromid).val()=="")||($(".form_you_email_"+fromidobj.fromid).val()=="")||($(".form_rec_fname_"+fromidobj.fromid).val()=="")||($(".form_rec_lname_"+fromidobj.fromid).val()=="")||($(".form_rec_email_"+fromidobj.fromid).val()=="")||($(".form_gift_msg_"+fromidobj.fromid).val()=="")) {
                    $(".form_fnameerror_"+fromidobj.fromid).html("Please Enter First Name").show();
                    $(".form_lnameerror_"+fromidobj.fromid).html("Please Enter Last Name").show();
                    $(".form_you_emailerror_"+fromidobj.fromid).html("Please Enter Email Address").show();
                    $(".form_rec_fnameerror_"+fromidobj.fromid).html("Please Enter First Name").show();
                    $(".form_rec_lnameerror_"+fromidobj.fromid).html("Please Enter Last Name").show();
                    $(".form_rec_emailerror_"+fromidobj.fromid).html("Please Enter Email Address").show();
                    $(".form_gift_msgerror_"+fromidobj.fromid).html("Please Enter Message").show();
                    if($(".form_fname_"+fromidobj.fromid).val()!="") {
                        $(".form_fnameerror_"+fromidobj.fromid).hide(); 
                    }
                    if($(".form_lname_"+fromidobj.fromid).val()!="") {
                        $(".form_lnameerror_"+fromidobj.fromid).hide(); 
                    }
                    if($(".form_you_email_"+fromidobj.fromid).val()!="") {
                        $(".form_you_emailerror_"+fromidobj.fromid).hide(); 
                    }
                    if($(".form_rec_fname_"+fromidobj.fromid).val()!="") {
                        $(".form_rec_fnameerror_"+fromidobj.fromid).hide(); 
                    }
                    if($(".form_rec_lname_"+fromidobj.fromid).val()!="") {
                        $(".form_rec_lnameerror_"+fromidobj.fromid).hide(); 
                    }
                    if($(".form_rec_email_"+fromidobj.fromid).val()!="") {
                        $(".form_rec_emailerror_"+fromidobj.fromid).hide(); 
                    }
                    if($(".form_gift_msg_"+fromidobj.fromid).val()!="") {
                        $(".form_gift_msgerror_"+fromidobj.fromid).hide(); 
                    }
                    $('.tabcontent_DELIVERY').show();
                    $('.timingdetail').hide();
                } else {
                    $(".form_fnameerror_"+fromidobj.fromid).hide(); 
                    $(".form_lnameerror_"+fromidobj.fromid).hide(); 
                    $(".form_you_emailerror_"+fromidobj.fromid).hide(); 
                    $(".form_rec_fnameerror_"+fromidobj.fromid).hide(); 
                    $(".form_rec_lnameerror_"+fromidobj.fromid).hide(); 
                    $(".form_rec_emailerror_"+fromidobj.fromid).hide(); 
                    $(".form_gift_msgerror_"+fromidobj.fromid).hide(); 
                    $('.tabcontent_TIMING').show();
                    $(".form"+fromidobj.fromid).hide();
                    $(".deliverydetail").hide();
                    $('.timingdetail').show();
                     sltdeliveryobj = { "fromid":fromidobj.fromid,"form_fname" : $(".form_fname_"+fromidobj.fromid).val(),"form_lname" : $(".form_lname_"+fromidobj.fromid).val(),"form_you_email" : $(".form_you_email_"+fromidobj.fromid).val(),"form_rec_fname" : $(".form_rec_fname_"+fromidobj.fromid).val(),"form_rec_lname" : $(".form_rec_lname_"+fromidobj.fromid).val(),"form_rec_email" : $(".form_rec_email_"+fromidobj.fromid).val(),"form_gift_msg" : $(".form_gift_msg_"+fromidobj.fromid).val() };
                }
            }   
        }
    });
    $(".chooseform3_1").change(function(){
        if($(this).val()=='3_2') {
            $(".rec_email").show();
            $(".cond_email_address").addClass("form_rec_email_"+fromidobj.fromid);
            $(".form_rec_emailerror_"+fromidobj.fromid).hide();
        } else {
            $(".rec_email").hide();
            $(".cond_email_address").removeClass("form_rec_email_"+fromidobj.fromid);
        }    
    });
    var alldetailobj = {}; var country_obj = {};  var grindtypeobj = {}; var gearobj = {}; var addontotalobj = {}; var us_cost_methad_obj = {};
    var non_branded_mailerobj = {}; var total_mailerobj = {}; var total_us_cost_methadobj = {}; 
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
        $('.empty_for_country_ch').removeAttr('value');
        $.ajax({
            url: customurl,
            type: "GET",
            dataType: 'json',
            data: {  zone_id: zone_id, productid: productid, },
            cache: false,
            success: function(dataResult)
            {
                if(zone_id=='1') {
                    allconditionscheck(zone_id,terms_data,productsize,productduration,productfrequency);
                } else {
                    allconditionscheck(zone_id,dataResult.dataterm,productsize,productduration,productfrequency);
                }
                if(dataResult !=="null") {
                    country_obj[zone_id] = dataResult;
                }
                if(Object.keys(dataResult.states).length>0) {
                    if(fromidobj.fromid>0) {
                        $(".statebycountry").addClass("form_state_"+fromidobj.fromid);
                    }
                    $(".statehideshow").show();
                    var stateoutput = [];
                    stateoutput.push('<option value="">Select State</option>');
                    $.each(dataResult.states, function(key, value)
                    {
                        stateoutput.push('<option value="'+ key +'">'+ value +'</option>');
                    });
                    $('.statebycountry').html(stateoutput.join(''));
                } else {
                    $(".statebycountry").removeClass("form_state_1 form_state_2");
                    $(".statehideshow").hide(); 
                }
                var countryoutput = [];
                 countryoutput.push('<label class="control-label" >COUNTRY *</label><select name="country" disabled class="form-control" ><option value="'+ zone_id +'" selected>'+ dataResult.selected_country_name +'</option></select>');
                $('.selectedcountry').html(countryoutput.join('')); 
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
        } else {
            $("#durationsh_two-months").hide();
        }
        if((productfrequency=='every-two-weeks')&&(productduration=='two-months')) {    
            $("input[value='every-month']").attr('disabled', true);
        } else {
            $("input[value='every-month']").attr('disabled', false);
        }
        if((productsize=='world-coffee-sampler')&&(productduration=='two-months')) {
            $("input[value='one-year']").attr('checked', true);
            $("input[value='every-month']").attr('disabled', false);
            $("input[value='every-month']").attr('checked', true);
            
            if(zone_id !=='1') {
                var productsize = 'world-coffee-sampler';
                var productduration = 'one-year';
                allconditionscheck(zone_id,country_obj[zone_id].dataterm,productsize,productduration,productfrequency);
            } else {
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
                allconditionscheck(zone_id,country_obj[zone_id].dataterm,productsize,productduration,productfrequency);
            } else {
                var productsize = 'world-coffee-sampler';
                var productfrequency = 'every-month';
                allconditionscheck(zone_id,terms_data,productsize,productduration,productfrequency);
            }        
        } else  {
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
            }  else {
                $("#durationsh_"+value).hide();
            }
        });
        $.each(productallfrequency, function (index, value) {
            if(frequency_arr.indexOf(value)!=-1) {
                $("#frequencysh_"+value).show();
            } else {
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
            allconditionscheck(zone_id,country_obj[zone_id].dataterm,productsize,productduration,productfrequency);
        } else {
            allconditionscheck(zone_id,terms_data,productsize,productduration,productfrequency);
        } /*for third step work*/      
    }
    $(".variationconnect,.ground_grind_type_value").on("change",variationchangeandbydefault);
    function allconditionscheck(zone_id,terms_data,productsize,productduration,productfrequency) {  /*for first step work*/
        var resultvariation = checkedvariation.filter(firstobject => firstobject.attributes.attribute_pa_size === productsize && firstobject.attributes.attribute_pa_duration === productduration && firstobject.attributes.attribute_pa_frequency === productfrequency)[0];
        if(resultvariation) {
            if((addontotalobj.prodaddtol>0)&&(zone_id=='1')) {
                if(us_cost_methad_obj.us_cost_of_method>0) {
                    if($('.form_non_branded_mailer').is(':checked')) {
                        $("#showzonevariation").html("$"+(resultvariation.display_price + parseFloat(addontotalobj.prodaddtol) + parseFloat(non_branded_mailerobj[fromidobj.fromid].form_non_branded_mailer) + parseFloat(us_cost_methad_obj.us_cost_of_method)));
                    } else {
                       $("#showzonevariation").html("$"+(resultvariation.display_price+parseFloat(addontotalobj.prodaddtol))); 
                    }
                } else {
                    if($('.form_non_branded_mailer').is(':checked')) {
                        $("#showzonevariation").html("$"+(resultvariation.display_price + parseFloat(addontotalobj.prodaddtol) + parseFloat(non_branded_mailerobj[fromidobj.fromid].form_non_branded_mailer)));
                    } else {
                       $("#showzonevariation").html("$"+(resultvariation.display_price+parseFloat(addontotalobj.prodaddtol))); 
                    }
                }        
            } else {
                if((us_cost_methad_obj.us_cost_of_method>0)&&(zone_id=='1')) {
                    if($('.form_non_branded_mailer').is(':checked')) { 
                        $("#showzonevariation").html("$"+(resultvariation.display_price + parseFloat(us_cost_methad_obj.us_cost_of_method) + parseFloat(non_branded_mailerobj[fromidobj.fromid].form_non_branded_mailer)));
                    } else {
                        $("#showzonevariation").html("$"+(resultvariation.display_price+parseFloat(us_cost_methad_obj.us_cost_of_method)));
                    }
                } else {
                    if($('.form_non_branded_mailer').is(':checked')) {
                        $("#showzonevariation").html("$"+(resultvariation.display_price + parseFloat(non_branded_mailerobj[fromidobj.fromid].form_non_branded_mailer)));
                    } else {
                        $("#showzonevariation").html("$"+(resultvariation.display_price));
                    }                   
                }    
            } /*for second step work*/
            var term_id = shipping_term_id[resultvariation.variation_id];
            if(terms_data) {
                var resultterms = terms_data.filter(termobject => termobject.term_id === term_id)[0];
                var totalprice = (parseInt(resultvariation.display_price) + parseInt(resultterms.cost));
                alldetailobj = { 'zone_id' : zone_id,'productsize' : productsize,'productfrequency' : productfrequency,'productduration':productduration,'totalprice':totalprice }; /*for second step work*/
                console.log(alldetailobj); console.log(grindtypeobj);
                $(".geartab").hide();
                $("#showzonevariationtotal").html("total $" + totalprice);
            } else {
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
        } else {
            prodaddtol -= parseFloat($(this).val());
            $(".changedata_"+pdtidaddon).html("ADD");
            delete gearobj[pdtidaddon];
        } console.log(gearobj);
        if(Object.keys(gearobj).length>0) {
            $(".panelform3").hide();
        } else {
            $(".panelform3").show();
        }
        if(us_cost_methad_obj.us_cost_of_method>0) {
            if($('.form_non_branded_mailer').is(':checked')) {
                var addonvartotal = alldetailobj.totalprice + prodaddtol + parseFloat(us_cost_methad_obj.us_cost_of_method) + parseFloat(non_branded_mailerobj[fromidobj.fromid].form_non_branded_mailer);
                addontotalobj = { 'totalprice' : addonvartotal ,'prodaddtol' : prodaddtol };
                $("#showzonevariation").html("$"+addonvartotal);  console.log(addontotalobj);
            } else {
                var addonvartotal = alldetailobj.totalprice + prodaddtol + parseFloat(us_cost_methad_obj.us_cost_of_method);
                addontotalobj = { 'totalprice' : addonvartotal ,'prodaddtol' : prodaddtol };
                $("#showzonevariation").html("$"+addonvartotal);  console.log(addontotalobj);
            }   
        } else {
            
            if($('.form_non_branded_mailer').is(':checked')) {
                var addonvartotal = alldetailobj.totalprice + prodaddtol + parseFloat(non_branded_mailerobj[fromidobj.fromid].form_non_branded_mailer);
                addontotalobj = { 'totalprice' : addonvartotal ,'prodaddtol' : prodaddtol };
                $("#showzonevariation").html("$"+addonvartotal);  console.log(addontotalobj);
            } else {
                var addonvartotal = alldetailobj.totalprice + prodaddtol;
                addontotalobj = { 'totalprice' : addonvartotal ,'prodaddtol' : prodaddtol };
                $("#showzonevariation").html("$"+addonvartotal);   console.log(addontotalobj);
            }
        }
    }); /* function for product product show by category  and sub category */
    $('.selectprosubcat').click(function() {
        if($(this).attr('data-subcategory')=='allproducts') {
            $('.autohideshow').show();
        } else {
            $('.autohideshow').hide();
            $('.subcats_' + $(this).attr('data-subcategory')).show();
        }
    });
    $('.form_non_branded_mailer').click(function() {
        if(alldetailobj.zone_id=='1') {
            if($(this).is(":checked")) {
                if((addontotalobj.totalprice>0)&&(addontotalobj.prodaddtol>0)) {
                    if(us_cost_methad_obj.us_cost_of_method>0) {
                        $("#showzonevariation").html("$"+(addontotalobj.totalprice + parseFloat($(this).val()) + parseFloat(us_cost_methad_obj.us_cost_of_method)));
                    } else {
                        $("#showzonevariation").html("$"+(addontotalobj.totalprice + parseFloat($(this).val())));
                    }
                    var total_mailer =  addontotalobj.totalprice  + parseFloat($(this).val());
                } else {
                    if(us_cost_methad_obj.us_cost_of_method>0) {
                        $("#showzonevariation").html("$"+(alldetailobj.totalprice + parseFloat($(this).val()) + parseFloat(us_cost_methad_obj.us_cost_of_method)));
                    } else {
                        $("#showzonevariation").html("$"+(alldetailobj.totalprice + parseFloat($(this).val())));
                    }
                    var total_mailer =  alldetailobj.totalprice  + parseFloat($(this).val());
                }        
                non_branded_mailerobj[fromidobj.fromid] = {"form_non_branded_mailer" : $(this).val()};  console.log(non_branded_mailerobj); 
                total_mailerobj = {'totalprice':total_mailer}; 
                console.log(total_mailerobj);
            }  else  {
                delete  non_branded_mailerobj[fromidobj.fromid];
                if(addontotalobj.totalprice>0) {
                    var total_mailer =  addontotalobj.totalprice;
                    total_mailerobj = {'totalprice':total_mailer};
                    console.log(total_mailerobj);
                    if(us_cost_methad_obj.us_cost_of_method>0) {
                        $("#showzonevariation").html("$"+(total_mailerobj.totalprice + parseFloat(us_cost_methad_obj.us_cost_of_method)));    
                    } else {
                        $("#showzonevariation").html("$"+(total_mailerobj.totalprice));
                    }
                } else {
                    var total_mailer =  alldetailobj.totalprice;
                    total_mailerobj = {'totalprice':total_mailer};
                   if(us_cost_methad_obj.us_cost_of_method>0) {
                        $("#showzonevariation").html("$"+(total_mailerobj.totalprice + parseFloat(us_cost_methad_obj.us_cost_of_method)));    
                    } else {
                        $("#showzonevariation").html("$"+(total_mailerobj.totalprice));
                    }
                }      
            }
        } else {
                $("#showzonevariation").html("$"+(alldetailobj.totalprice + parseFloat($(this).val())));
            }
    });
    function datepickerfunct(fromid) {
        if(fromid!='3') {
            if(alldetailobj.zone_id=='1') {
                if(us_free_shipping_method_id>0) {
                    $(".datepicker").datepicker("destroy");
                    datesArray = us_free_shipping_cal.split(", ");
                } else {    
                    $(".datepicker").datepicker("destroy");
                    datesArray = express_priority.split(", ");
                }    
            } else {
                $(".datepicker").datepicker("destroy");
                datesArray = intl_calendar.split(", ");
            }
            var availableDates = [];
            var todaydate = ("0" + new Date().getMonth()+1).slice(-2) + "/" + ("0" + new Date().getDate()).slice(-2) + "/" + new Date().getFullYear();
            datesArray.forEach(function (val) {
                if(todaydate<val) { /* current date se agge  ki sari dates condition */
                    availableDates.push(val); 
                }
                if(todaydate==val) { /* current date  ki  condition */
                    var dt = new Date(todaydate);                    
                    dt.setHours(dt.getHours() + gifthour);
                    dt.setMinutes(dt.getMinutes() + giftmin);
                    if(dt.getTime() > new Date().getTime() ) {
                        availableDates.push(val);
                    }
                }
            });
            function availabledate(date) { /* for available dates */
                alldmy = ("0" + date.getMonth()+1).slice(-2) + "/" + ("0" + date.getDate()).slice(-2) + "/" + date.getFullYear();
                if ($.inArray(alldmy, availableDates) !== -1) {
                    return [true, "","Available"];
                } else {
                    return [false,"","unAvailable"];
                }
            }
            function get_default_date() { /* for default date */
                var date = new Date(availableDates[0]);
                return date;
            }
            $(".datepicker").datepicker({
                minDate:'0',
                beforeShowDay: availabledate,
                defaultDate: get_default_date()
            });
        }
        else {
            $(".datepicker").datepicker("destroy");
            $(".datepicker").datepicker({ minDate:'0' });
        }
    }
    $('.select_shipping_method').change(function() {  
        var us_cost_method = $(this).attr('data-uscostofmethod');
        var value_of_mailer  =  $('.form_non_branded_mailer').val();
        (value_of_mailer) ? value_of_mailer : 0;
        if(us_cost_method>0) {
            us_cost_methad_obj = {'us_cost_of_method':us_cost_method};
            if((addontotalobj.totalprice>0)&&(alldetailobj.zone_id=='1')) {
                if($('.form_non_branded_mailer').is(':checked')) {
                    $("#showzonevariation").html("$"+(parseFloat(us_cost_method) + parseFloat(addontotalobj.totalprice) + parseFloat(value_of_mailer) ));
                    total_us_cost_methadobj = {'totalprice':addontotalobj.totalprice + parseFloat(us_cost_method) + parseFloat(value_of_mailer)};
                } else {
                   $("#showzonevariation").html("$"+(parseFloat(us_cost_method) + parseFloat(addontotalobj.totalprice) ));
                   total_us_cost_methadobj = {'totalprice':addontotalobj.totalprice + parseFloat(us_cost_method)}; 
                }   
            } else {
                if($('.form_non_branded_mailer').is(':checked')) {
                    $("#showzonevariation").html("$"+(alldetailobj.totalprice + parseFloat(us_cost_method) + parseFloat(value_of_mailer)));
                    total_us_cost_methadobj = {'totalprice':alldetailobj.totalprice + parseFloat(us_cost_method) + parseFloat(value_of_mailer)};
                } else {
                    $("#showzonevariation").html("$"+(alldetailobj.totalprice + parseFloat(us_cost_method)));
                    total_us_cost_methadobj = {'totalprice':alldetailobj.totalprice + parseFloat(us_cost_method) + parseFloat(value_of_mailer)};
                }    
            }
        } else {
            delete us_cost_methad_obj.us_cost_of_method; /* when you select the free shipping */
            if((addontotalobj.totalprice>0)&&(alldetailobj.zone_id=='1')) {
                var total =  addontotalobj.totalprice;
                total_us_cost_methadobj = {'totalprice':total};
                if($('.form_non_branded_mailer').is(':checked')) {
                    $("#showzonevariation").html("$"+(total_us_cost_methadobj.totalprice + parseFloat(value_of_mailer)));
                } else {
                    $("#showzonevariation").html("$"+(total_us_cost_methadobj.totalprice));
                }
            } else {
                var total =  alldetailobj.totalprice;
                if($('.form_non_branded_mailer').is(':checked')) {
                    $("#showzonevariation").html("$"+(total_us_cost_methadobj.totalprice + parseFloat(value_of_mailer)));
                } else {
                   $("#showzonevariation").html("$"+total_us_cost_methadobj.totalprice); 
                }  
            }
               
        }    
    });    
});