var allCities={},
    responseRecaptcha='',
    isRecaptcha=false,
    usersAge=0,
    passwordLengthMin=6,
    passwordLengthMax=0,
    nameLengthMin=0,
    nameLengthMax=0;
var isUploadPhotoJoinAjax=false,
    isUploadPhotoJoin=false;

var step2_formData = new FormData();

var dataIndustryExp = [];
var userQualificationList = [];
var userSalaryRange = '';
var profile_img_selected = false;
var userSelectedTagsList = [];

// var isUploadPhotoJoinAjax=false, isUploadPhotoJoin=false;
var currentPage = 'join.php';
$(function(){
    /* STEP 1 */
    $('.geo', '#step-1').change(function() {
        console.log(' change  ', this);
        var type=$(this).data('location');
        $.ajax({type: 'POST',
                url: base_url + '/ajax/' + type,
                data: { cmd:type,
                        select_id:this.value,
                        filter:'1',
                        list: 0},
                        beforeSend: function(){
                            $jq('#css_loader_location').removeClass('hidden');
                            $jq('.location').prop('disabled', true).trigger('refresh');
                        },
                        success: function(data){
                            console.log('data ', data);
                            // var data=checkDataAjax(res);
                            // var data = jQuery.parseJSON(res);
                            if (data.status) {
                                var option='<option value="0">'+i18n.site.choose_a_city+'</option>';
                                switch (type) {
                                    case 'geo_states':
                                        $jq('#state').html(data.list).trigger('refresh');
                                        $jq('#city').html(option).trigger('refresh');
                                        break
                                    case 'geo_cities':
                                        $jq('#city').html(data.list).trigger('refresh');
                                        break
                                }
                            }
                            $jq('#css_loader_location').addClass('hidden');
                            $jq('.location').prop('disabled', false).trigger('refresh');
                            setDisabledSubmitJoin();
                        }
                    });
        return false;
    })

    $('#city').change(function() {
        setDisabledSubmitJoin();
    })

    $('select.i_am').change(function() {
        setDisabledSubmitJoin();
    })

    $('#phone').change(function() {
         setDisabledSubmitJoin();
    })

    /* Email */
    $jq('#email').on('change propertychange input',validateEmail);
    function validateEmail(f){
								var val=$.trim($jq('#email').val()),res=false,f=f||1;
        if(!checkEmail(val)){
												var msg=isFrmSubmit?joinLangParts.incorrect_email:'&nbsp;';
												console.log('check msg', msg)
            showError('email',msg)
        } else {
            hideError('email',false);
        }
        return res;
    }
    /* Email */
    /* Birth */
    // $jq('.birthday').styler({singleSelectzIndex: '12',
    //     selectAutoWidth : false,
    //     selectAnimation: true,
    //     selectAppearsNativeToIOS: false,
    //     onSelectOpened: function(){},
    //     onFormStyled: function(){
    //         $jq('.inp_birth').addClass('to_show');
    //     }
    // })

    // $jq('.birthday').change(function() {
    //     if(this.id!='day'){
    //         updateDay('month','frm_date','year','month','day');
    //         $jq('#day').trigger('refresh');
    //     }
    //     validateBirthday();
    // })

    // $jq('#month').change();
    /* Birth */
    $jq('#password').on('change propertychange input',validatePassword);
    function validatePassword(){
        var val=$jq('#password').val(),l=val.length,msg='&nbsp;';
        if(~val.indexOf("'")<0){
            if(isFrmSubmitStep2)msg=joinLangParts.incorrect_password_contain;
            showError('password',msg,'#step-1');
        } else if(l<passwordLengthMin||l>passwordLengthMax) {
            if(isFrmSubmitStep2)joinLangParts.incorrect_password_length;
            showError('password',msg,'#step-1');
        } else {
            hideError('password',true,'#step-1');
        }
    }

    $jq('#name').on('change propertychange input',validateUserName);
    function validateUserName(){
        var val=$jq('#name').val(),l=$.trim(val).length,msg='&nbsp;';
        if (/[#&'"\/\\<]/.test(val)){
            if(isFrmSubmitStep2)msg=joinLangParts.incorrect_name;
            showError('name',msg,'#step-1');
        }else if((l<nameLengthMin||l>nameLengthMax)){
            if(isFrmSubmitStep2)msg=joinLangParts.incorrect_name_length;
            showError('name',msg,'#step-1');
        } else {
            hideError('name',true,'#step-1');
        }
    }

    $jq('#agree').on('change',function(){
        if($(this).prop('checked')){
            hideError('agree');
        }else{
            showError('agree')
        }
    })

    function disabledControl(state, context){
        $jq('select', context).prop('disabled', state).trigger('refresh');
        $jq('input, textarea', context).prop('disabled', state);
    }

    var dataFrm={},
        isFrmSubmit=false;
    $jq('#frm_register_submit').mouseenter(function(){
								// $jq('#city').blur();
    }).click(function(){
        isFrmSubmit=true;
        if($jq('#frm_register_submit').is('.disabled')){
           $jq('#agree').change();
           return false;
        }
        if(setDisabledSubmitJoin(false,true,true)){
            return false;
        }
								$jq('#frm_register_submit').html(getLoader('css_loader_btn', false, true)).prop('disabled',true);
        $jq('input:not([type="search"]), select', '#step-1').each(function(){
            dataFrm[this.name]=$.trim(this.value);
        })
        disabledControl(true, '#step-1');
        // url: base_url + '/ajax/' + type,
        $.post(base_url+'/register',dataFrm,
                function(data){
                    console.log(' register data ', data);
                    if(!data.status){
                        disabledControl(false, '#step-1');
                        const keys = Object.keys(data.validator);
                        for (const key of keys) {
                            // console.log('key = ', key);
                            // console.log('data.validator.key = ',  data.validator[key] );
                            if($('#'+key+'_error').length > 0){

                                $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(data.validator[key][0]);
                            }
                        }
                        $jq('#frm_register_submit').html(i18n.site.Next_btn);

                    }else{
                        $jq('#step-1').fadeOut(400,function(){
                            $jq('#frm_register_submit_2').prop('disabled',true);
                            $jq('#success-step-1').show(1).addClass('to_show').html(data.message);
                            $jq('#frm_register_submit').html(i18n.site.Next_btn);
                            // setTimeout(() => {
                            //     location.href = data.redirect;
                            // }, 3000);
                        });
                    }

                        // if (!showErrorResponseForm(data,['name','password','captcha','recaptcha'])) {
                        //     if(!isFrmSubmitStep2){
                        //         $jq('#password').val('');
                        //         //$jq('#name').val('');
                        //     }
                        //     hideCheck('name');
                        //     hideCheck('password');
                        //     $jq('#step-1').fadeOut(400,function(){
                        //         $jq('#frm_register_submit_2').prop('disabled',true);
                        //         $jq('#step-2').show(1).addClass('to_show');
                        //         $jq('#frm_register_submit').html(joinLangParts.next);
                        //         disabledControl(false, '#step-1');
                        //     })
                        // }else{
                        //     disabledControl(false, '#step-1');
                        //     $jq('#frm_register_submit').html(joinLangParts.next);
                        // }
                        $jq('#frm_register_submit').prop('disabled',false);

        })


    });




    $jq('#frm_emp_register_submit').click(function(){
        event.preventDefault();
        var dataFrm={},
        isFrmSubmit=true,
        validate_for = true;

        if($jq('#frm_register_submit').is('.disabled')){
           $jq('#agree').change();
           return false;
        }
        if(setDisabledSubmitJoin(false,true,true)){  return false; }
        $jq('#frm_register_submit').html(getLoader('css_loader_btn', false, true)).prop('disabled',true);
        $jq('input:not([type="search"]), select', '#step-1.emp-step-1').each(function(){

            dataFrm[this.name]  = $.trim(this.value);

            var trim_value = $.trim(this.value);
            var is_required = ($(this).attr('required') == 'required')?true:false;

            // console.log(' this.name ', this, this.name );
            // console.log(' requied  ', $(this).attr('required') );
            // console.log(' trim_value  ',  trim_value );
            // console.log(' is_required  ',  is_required );


            if ( is_required && trim_value == '') {
                console.log(' validation error  ');
                var field_name = this.name;
                $('#'+field_name+'_error').removeClass('to_hide').addClass('to_show').text('Required');
                validate_for = false;
            }

        })
        // disabledControl(true, '#step-1');

        // check if all field not empty
        // var requiredField = ['']

        if(!validate_for){ return false; }

        $.post(base_url+'/register/employer',dataFrm,
        function(data){
            console.log(' register data ', data);

            if(!data.status){
                // disabledControl(false, '#emp-step-1');
                const keys = Object.keys(data.validator);
                for (const key of keys) {
                    if($('#'+key+'_error').length > 0){
                        $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(data.validator[key][0]);
                    }
                }
                $jq('#frm_register_submit').html(i18n.site.Next_btn);
            }else{
                $jq('#step-1.emp-step-1').fadeOut(400,function(){
                    $jq('#frm_register_submit_2').prop('disabled',true);
                    $jq('#success-step-1').show(1).addClass('to_show').html(data.message);
                    $jq('#frm_register_submit').html(i18n.site.Next_btn);
                    // setTimeout(() => {
                    //     location.href = data.redirect;
                    // }, 5000);
                });
            }

            $jq('#frm_register_submit').prop('disabled',false);

        })
    });




    $jq('#resendVerificationEmail').on('change propertychange input',validateResendEmail);
    function validateResendEmail(){
        console.log(' validateResendEmail ');
        var val=$.trim($jq('#resendVerificationEmail').val());
        if( val == '' ){
            $jq('#resendVerificationEmail_error').removeClass('to_hide').addClass('to_show').text('Required');
            return false;
        }else if(!checkEmail(val)){
           $jq('#resendVerificationEmail_error').removeClass('to_hide').addClass('to_show').text('Incorrect Email Address')
           return false;
        } else {
            $jq('#resendVerificationEmail_error').removeClass('to_show').addClass('to_hide');
            $jq('#emp_email_verification_resend').prop('disabled',false);
            return true;
        }

    }

    $jq('#emp_email_verification_resend').click(function(){
        event.preventDefault();
        console.log(' emp_email_verification_resend ');
        $jq('#emp_email_verification_resend').html(getLoader('css_loader_btn', false, true)).prop('disabled',true);

        var dataFrm = $('#employer_verification_resend').serializeArray();
        $.post(base_url+'/employer/verification',dataFrm,
        function(data){
            console.log(' verification/data = ', data);
            console.log(' message = ', data.message);
            console.log(' employer_verification_resend = ', $('#employer_verification_resend') );

            $('#employer_verification_resend').html(data.message);
        })
    });


    /* STEP 1 */
    /* STEP 2 */
    var isFrmSubmitStep2=false;
    // $jq('#frm_register_submit_2').click(function(){
    //     isFrmSubmitStep2=true;
    //     //if(setDisabledSubmitJoin('#step-2',true)){
    //         //return false;
    //     //}
    //     $jq('#frm_register_submit_2').html(getLoader('css_loader_btn', false, true))
    //                                  .prop('disabled',true);
    //     $jq('input', '#step-2').each(function(){
    //         dataFrm[this.name]=$.trim(this.value);
    //     })
    //     disabledControl(true, '#step-2');
    //     $.post(urlMain+'join.php?cmd=register&ajax=1',dataFrm,
    //             function(data){
    //                 var not=['mail','birthday','location','captcha','recaptcha'];
    //                 $('span','<div>'+data+'</div>').each(function(){
    //                     if(in_array($(this).attr('class'),not)){
    //                         $jq('#step-2').fadeOut(400,function(){
    //                             $jq('#step-1').fadeIn(400);
    //                         })
    //                         showErrorResponseForm(data,['name','password','captcha','recaptcha']);
    //                         return false;
    //                     }
    //                 })
    //                 if(showErrorResponseForm(data,not,'#step-2')){
    //                     $jq('#frm_register_submit_2').html(joinLangParts.done);
    //                     disabledControl(false, '#step-2');
    //                 }
    //                 $jq('#frm_register_submit_2').prop('disabled',true);

    //     })
    // })


    /* STEP 2 */

    /* STEP 4 */
    /* Captcha */
    var isFrmSubmitStep3=false;
    // $jq('#captcha').on('change propertychange input', function(){
    //     var val=trim($jq('#captcha').val());
    //     if(val){
    //         hideError('captcha',true,'#frm_card_join');
    //     }else{
    //         var msg=isFrmSubmitStep3?joinLangParts.incorrect_captcha:'&nbsp;';
    //         showError('captcha',msg,'#frm_card_join');
    //     }
    // }).keydown(function(e){
    //     if (e.keyCode==13&&!$jq('#join_done').prop('disabled')) {
    //         $jq('#join_done').click();
    //         return false;
    //     }
    // })
    /* Captcha */



    $jq('.fl_basic').on('change propertychange input', function(){
        hideError(this.id,false,'#frm_card_join');
        //setDisabledSubmitJoin('#frm_card_join');
    })


    $jq('#step3_done').click(function(){
        console.log(' step3_done ', dataAnswerJoin);
        step2_formData.append('questions',JSON.stringify(dataAnswerJoin));
        console.log(' step2_formData ', step2_formData.entries());

        $jq('#about_me_error,#interested_in_error,.part_photo .name_info').addClass('to_hide');
        $jq('#about_me,#interested_in,.upload_file').removeClass('validation_error');

        //validation
        var s3_validation = true;
        var about_me = $.trim($('#about_me').val());
        var interested_in = $.trim($jq('#interested_in').val());

        if ( about_me == ''){
            s3_validation = false;
            $jq('#about_me_error').removeClass('to_hide').text('Required');
            $jq('#about_me').addClass('validation_error');
        }

        if (interested_in == ''){
            s3_validation = false;
            $jq('#interested_in_error').removeClass('to_hide').text('Required');
            $jq('#interested_in').addClass('validation_error');
        }

        if(!profile_img_selected){
            s3_validation = false;
            $jq('.part_photo .name_info').removeClass('to_hide').text('Required');
            $jq('.upload_file').addClass('validation_error');
        }

        if(s3_validation){
            step2_formData.append('about_me', about_me);
            step2_formData.append('interested_in', interested_in );
            showEmployStep4();
        }

    });



     $jq('#user_step3_done').click(function(){
        console.log(' user_step3_done ', dataAnswerJoin);
        step2_formData.append('questions',JSON.stringify(dataAnswerJoin));
        console.log(' step2_formData ', step2_formData.entries());

        $jq('#about_me_error,#interested_in_error,.part_photo .name_info,#recentJob_error').addClass('to_hide');
        $jq('#about_me,#interested_in,.upload_file,#recentJob').removeClass('validation_error');

        //validation
        var s3_validation = true;
        var about_me = $.trim($('#about_me').val());
        var interested_in = $.trim($jq('#interested_in').val());
        var recentJob = $.trim($jq('#recentJob').val());

        if ( about_me == ''){
            s3_validation = false;
            $jq('#about_me_error').removeClass('to_hide').text('Required');
            $jq('#about_me').addClass('validation_error');
        }

        if (interested_in == ''){
            s3_validation = false;
            $jq('#interested_in_error').removeClass('to_hide').text('Required');
            $jq('#interested_in').addClass('validation_error');
        }

        if (recentJob == ''){
            s3_validation = false;
            $jq('#recentJob_error').removeClass('to_hide').text('Required');
            $jq('#recentJob').addClass('validation_error');
        }

        if(!profile_img_selected){
            s3_validation = false;
            $jq('.part_photo .name_info').removeClass('to_hide').text('Required');
            $jq('.upload_file').addClass('validation_error');
        }

        if(s3_validation){
            step2_formData.append('about_me', about_me);
            step2_formData.append('interested_in', interested_in );
            step2_formData.append('recentJob', recentJob );
            // console.log('form data', step2_formData);
            userStep2Update(step2_formData, 3);
            showUserStep4();
        }
        // console.log(base_url);

         // $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
         // $.ajax({
         //     url: base_url+'/step2',
         //     type : 'POST',
         //     data : step2_formData,
         //     processData: false,
         //     contentType: false,
         //     success : function(resp) {
         //         console.log('resp ', resp);
         //         $jq('#join_done').html('Done').prop('disabled',false);
         //         if(resp.status){
         //             setTimeout(() => {
         //                 location.href = resp.redirect;
         //             }, 1000);
         //         }else{
         //             $jq('#full_step_8').html('<div class="full_step_error center"><p>Error Updating data.</p></div>');
         //             if(resp.validator != undefined){
         //                 const keys = Object.keys(resp.validator);
         //                 for (const key of keys) {
         //                     var error_html = '<p>'+resp.validator[key][0]+'</p>';
         //                     $('.full_step_error').append(error_html);
         //                 }
         //             }else if(resp.error != undefined ){
         //                 var error_html = '<p>'+resp.error+'</p>';
         //                 $('.full_step_error').append(error_html);
         //             }
         //
         //             $('.full_step_error').append('<h3 class="mt20"><a class="pointer" onclick="location.reload()" style="color: #ffa200;">Click here to update</a></h3>');
         //         }
         //     }
         // });

    });



function showUserStep4(){

    $jq('#join_slogan').text('Qualification');
    $jq('#join_step ul li').removeClass('selected');
    $jq('#join_step ul li:eq(2)').addClass('selected').css('display','block');
     $jq('#full_step_3').fadeOut(400,function(){
        $jq('#full_step_4').fadeIn(400,function(){
        });
     });

     $jq('#qualification_type').on('change',function(){
        console.log(' qualification_type ');
        userQualificationList = [];
        jQuery('.qualification_ul li.selected').removeClass('selected');
        var qualif_type = $jq(this).val();
        console.log(' qualif_type ', qualif_type);
        if(qualif_type != ''){
            $jq('.select_qualification_list').removeClass('trade').removeClass('degree');
            $jq('.select_qualification_list').addClass( (qualif_type == 'trade')?'trade':'degree');
            $jq('.select_qualification_list').fadeIn(400,function(){});
        }else{
            $jq('.select_qualification_list').fadeOut(400,function(){});
        }

     });
}


function showEmployStep4(){

    $jq('#join_slogan').text('Industry Experience');
    $jq('#join_step ul li').removeClass('selected');
    $jq('#join_step ul li:eq(2)').addClass('selected').css('display','block');

     $jq('#full_step_3').fadeOut(400,function(){
        $jq('#full_step_4').fadeIn(400,function(){
            // var $baseField=$jq('#full_step_3').find('.placeholder_always');
            // if($baseField[0])$baseField.eq(0).focus();
        });
     })
}

    // add the selected one to Employer Industry list selection.
    jQuery('.industry_ul').on('click','li', function(){
        var industry_id = jQuery(this).attr('data-id');
        if (dataIndustryExp.indexOf(industry_id) == -1){
            if(dataIndustryExp.length < 5 ){
                dataIndustryExp.push(industry_id);
                jQuery(this).addClass('selected');
            }
        }else{
            dataIndustryExp.splice(dataIndustryExp.indexOf(industry_id),1);
            jQuery(this).removeClass('selected');
        }
        $('.join_industry_error').removeClass('error').text('');
        console.log('dataIndustryExp ', dataIndustryExp );
        if (dataIndustryExp.length > 0){
             jQuery('.industryExpBtn_done').prop('disabled',false);
        }else{
            jQuery('.industryExpBtn_done').prop('disabled',true);
        }
    });


     // add the selected one to User Qualification selection list.
    jQuery('.qualification_ul').on('click','li', function(){
        $('.join_industry_error').removeClass('error').text('');
         var qualification_id = jQuery(this).attr('data-id');
         if ( userQualificationList.indexOf(qualification_id) == -1 ){
             if(userQualificationList.length < 5 ){
               userQualificationList.push(qualification_id);
               jQuery(this).addClass('selected');
             }
         }else{
            userQualificationList.splice(userQualificationList.indexOf(qualification_id),1);
            jQuery(this).removeClass('selected');
        }

        if (userQualificationList.length > 0){
             jQuery('#user_step4_done').prop('disabled',false);
        }else{
            jQuery('#user_step4_done').prop('disabled',true);
        }
        console.log('userQualificationList ', userQualificationList );
    });


    // add the selected one to User Qualification selection list.
    jQuery('.salary_ul').on('click','li', function(){
         var salary_id = jQuery(this).attr('data-id');
         jQuery('.salary_ul li.selected').removeClass('selected');
         jQuery(this).addClass('selected');
         userSalaryRange = salary_id;
         if (userSalaryRange != '' ){ jQuery('#user_step6_done').prop('disabled',false); }
        console.log('userSalaryRange ', userSalaryRange );
    });


    // tagging system Script
    jQuery('.tagCategory.tagItem').on('click',function(){
        console.log(' tagCategory tagItem click ');
        jQuery('.tagCategory.tagItem').removeClass('selected');
        jQuery(this).addClass('selected');

        jQuery('.tagListCont .tagListBox').html('');
        jQuery('.tagListCont').addClass('loadingList');


        var tagCatId = jQuery(this).attr('data-id');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            url: base_url+'/ajax/getTags/'+tagCatId,
            type : 'GET',
            success : function(resp) {
               console.log('getTags ', resp);
               jQuery('.tagListCont').removeClass('loadingList');
               if(resp.status){
                    jQuery('.tagListCont .tagListBox').html(resp.data);
               }
            }
        });

    });


     jQuery('.tagListBox').on('click','li a.loadMoreTags', function(){
        console.log(' loadMoreTags click ');
        jQuery('.tagListCont .tagListBox').html('');
        jQuery('.tagListCont').addClass('loadingList');
        var offset = jQuery(this).attr('data-offset');
        var tagCatId = jQuery('.tagCategory.tagItem.selected').attr('data-id');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            url: base_url+'/ajax/getTags/'+tagCatId+'/'+offset,
            type : 'GET',
            success : function(resp) {
               console.log('getTags ', resp);
               jQuery('.tagListCont').removeClass('loadingList');
               if(resp.status){
                    jQuery('.tagListCont .tagListBox').html(resp.data);
               }
            }
        });
    });




    jQuery('html').click(function(e) {
      //if clicked element is not your element and parents aren't your div
      if (e.target.id != 'newTag' && $(e.target).parents('#newTag').length == 0) {
         jQuery('.tagSuggestionCont').hide();
      }else{
         console.log(' 2 focusin out ');
         jQuery('.tagSuggestionCont').show();
      }
    });

    // jQuery('.newTag').focusin(function(){
    //     console.log(' focusin out ');
    //     jQuery('.tagSuggestionCont').show();
    // });

    jQuery('.newTag input').on('keyup',function() {
        var query =  jQuery.trim(jQuery(this).val());
        console.log(' newTag keyup ', query);
        if ( query == '' ){
           jQuery('.tagSuggestionCont').hide();
           jQuery('ul.tagSuggestion').html('');
        }

        jQuery.ajax({
            url: base_url+"/ajax/searchTags",
            type:"GET",
            data:{'search':query, 'exclude': userSelectedTagsList},
            success:function (resp) {
                console.log(' resp ', resp);
                //$('#country_list').html(data);
                if(resp.status){
                    console.log(' resp data ', resp.data);
                    if(resp.data.length > 0){
                        jQuery('.tagSuggestionCont').show();
                        var suggestionArray = resp.data;
                        var suggestion = '';
                        jQuery.each( suggestionArray, function( index, value ){
                            suggestion += '<li class="suggestTagItem tagItem" data-id="'+value.id+'"><i class="tagIcon fa fa-box-open"></i><span>'+value.title+'</span></li>';
                        });
                        jQuery('ul.tagSuggestion').html(suggestion);
                    }
                }
            }
        })
        // end of ajax call
    });

    jQuery('.tagSuggestionCont').on('click','.suggestTagItem', function(){
        addNewTag(this);
    });


    jQuery('.tagListBox').on('click','.tag.tagItem', function(){
        addNewTag(this);
        // jQuery(this).remove();
    });

    var addNewTag = function(elem){
        var tagId = jQuery(elem).attr('data-id');
        console.log('suggestTagItem click ', tagId);
        if (userSelectedTagsList.indexOf(tagId) == -1){
             userSelectedTagsList.push(tagId);
             var tag_clone = elem;
             console.log(' tag_clone ', tag_clone);
            jQuery('.selectTagList ul').append(tag_clone);
        }
        console.log(' userSelectedTagsList ', userSelectedTagsList);
        if (userSelectedTagsList.length > 0 ){
            jQuery('#user_step7_done').prop('disabled',false);
        }else{
           jQuery('#user_step7_done').prop('disabled',true);
        }
    }


    jQuery('.selectTagList').on('click','li.tagItem', function(){
        console.log(' selectTagList click ');
        var tagId = jQuery(this).attr('data-id');
         if ( userSelectedTagsList.indexOf(tagId) != -1 ){
              userSelectedTagsList.splice(userSelectedTagsList.indexOf(tagId),1);
              jQuery(this).remove();
         }
    });



    jQuery('button#addNewTag').on('click',function(){
        console.log(' button#addNewTag ');
        var newTagTitle = jQuery.trim(jQuery('.newTagInput input').val());
        jQuery('.addNewTagModal .form_input input').val(newTagTitle);
        jQuery('.addNewTagModalBox').removeClass('loading');
        jQuery('.addNewTagModal .apiMessage').hide();
        jQuery('.addNewTagModal .error').html('&nbsp;');

       jQuery('#addNewTagModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
        });
    });


    jQuery('.addNewTagModal .newTagAdd').on('click',function(){
        console.log(' newTagAdd click ');
        jQuery('.addNewTagModalBox').addClass('loading');

        var newTagTitle = jQuery('.addNewTagModal .form_input input').val();
        var newTagCat   = jQuery('.addNewTagModal .form_input select[name="newTagCategory"]').val();
        var newTagIcon  = jQuery('.addNewTagModal .form_input select[name="newTagIcon"]').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        jQuery.ajax({
            url: base_url+"/ajax/addNewTag",
            type:"POST",
            data:{'newTagtitle':newTagTitle, 'newTagCategory': newTagCat, 'newTagIcon': newTagIcon},
            success:function (resp) {
                console.log(' resp ', resp);
                //$('#country_list').html(data);
                if(resp.status){
                    console.log(' resp data ', resp.data);
                    var newTagElem = resp.data;
                    var newTagHtml = '<li class="tagItem" data-id="'+newTagElem.id+'"><i class="tagIcon fa '+newTagElem.icon+'"></i><span>'+newTagElem.title+'</span></li>';
                    var dom_nodes = jQuery(jQuery.parseHTML(newTagHtml));
                    addNewTag(dom_nodes);

                    // jQuery('.selectTagList ul').append(newTagHtml);
                    jQuery('.addNewTagModal .apiMessage').html('Tag Succesfully Added').show();
                    setTimeout(function() {
                        jQuery.modal.close();
                        jQuery('.newTagInput input').val('');
                    }, 1000);
                }else{
                    jQuery('.addNewTagModalBox').removeClass('loading');
                     if(resp.validator != undefined){
                        const keys = Object.keys(resp.validator);
                        for (const key of keys) {
                            if($('#'+key+'_error').length > 0){
                                $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(resp.validator[key][0]);
                            }
                        }
                    }

                   if(resp.error != undefined){
                     $('.addNewTagModalBox .apiMessage').show().text(resp.error);
                      setTimeout(function() {
                        jQuery('.addNewTagModal .apiMessage').html('').hide();
                    }, 3000);

                   }

                }
            }
        })

    });




    jQuery('.submit-document').on('submit',(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('submit', true);
        jQuery.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        jQuery.ajax({
            type:'POST',
            url: '/ajax/userUploadResume',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                jQuery('.save-resume-btn').html('Saving... <i class="fa fa-spinner fa-spin"></i>');
            },
            success:function(data){
                jQuery('.save-resume-btn').html('Save');
                console.log("success data ", data);
                if(data && data.attachments) {
                    var attachments = data.attachments;
                    var attach_html = '';
                    if( attachments.length > 0 ){
                        for (let ai = 0; ai < attachments.length; ai++) {
                            attach_html += '<div class="attachment_'+attachments[ai].id+' attachment_file">';
                            attach_html +=   '<div class="attachment"><img src="'+base_url+'/images/site/icons/cv.png" /></div>';
                            attach_html +=   '<span class="attach_title">'+attachments[ai].name+'</span>';
                            attach_html +=   '<div class="attach_btns">';
                            attach_html +=      '<a class="attach_btn downloadAttachBtn" href="'+base_url+'/'+attachments[ai].file+'">Download</a>';
                            attach_html +=      '<a class="attach_btn removeAttachBtn" data-attachmentid="'+attachments[ai].id+'" onclick="UProfile.confirmAttachmentDelete('+attachments[ai].id+');">Remvoe</a>';
                            attach_html +=    '</div>';
                            attach_html +=  '</div>';
                        }
                    }
                    jQuery('.private_attachments').html(attach_html);
                }
                console.log(data);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));


    jQuery('#photo_add_video').on('click', function(){
        var input = document.createElement('input');
        input.type = 'file';
        input.onchange = e => {
            var file = e.target.files[0];
            console.log(' onchange file  ', file );
            var formData = new FormData();
            formData.append('video',file);
            var that        = this;
            var item_id     =  Math.floor((Math.random() * 1000) + 1);
            var video_item = '';
            video_item  += '<div id="v_'+item_id+'" class="item profile_photo_frame item_video" style="display: inline-block;">';
            video_item  +=  '<a class="show_photo_gallery video_link" href="">';
            video_item  +=  '</a>';
            video_item  +=  '<span class="v_title">Video title</span>';
            video_item  +=  '<span title="Delete video" class="icon_delete">';
            video_item  +=      '<span class="icon_delete_photo"></span>';
            video_item  +=      '<span class="icon_delete_photo_hover"></span>';
            video_item  +=  '</span>';
            video_item  +=  '<div class="v_error error hide_it"></div>';
            video_item  +=  '<div class="v_progress"></div>';
            video_item  += '</div>';

            $('.list_videos').append(video_item);
            var updateForm = document.querySelector('form');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var request = new XMLHttpRequest();
            request.upload.addEventListener('progress', function(e){
               var percent = Math.round((e.loaded / e.total) * 100);
                 console.log(' progress-bar ', percent+'%' );
                 $('#v_'+item_id+' .v_progress').css('width',  percent+'%');
            }, false);
            request.addEventListener('load', function(e){
               console.log(' load e ', e);
               var res = JSON.parse(e.target.responseText);
               console.log(' jsonResponse ', res);
               $('#v_'+item_id+' .v_progress').remove();
                if(res.status == 1) {
                    // $('#v_'+item_id+' .v_title').text(res.data.title);
                    // $('#v_'+item_id+' .video_link').attr('href', base_url+'/'+res.data.file);
                    $('#v_'+item_id).replaceWith(res.html);
                }else {
                    console.log(' video error ');
                    if(res.validator != undefined){
                        $('#v_'+item_id+' .error').removeClass('hide_it').addClass('to_show').text(res.validator['video'][0]);
                    }
                }
            }, false);
            request.open('post',base_url+'/ajax/uploadVideo');
            request.send(formData);
        }
        input.click();


    });



    $jq('#user_step4_done').click(function(){
        $jq('#join_slogan').text('Industry Experience');
        $jq('#join_step ul li').removeClass('selected');
        $jq('#join_step ul li:eq(3)').addClass('selected').css('display','block');
        step2_formData.append('qualification', JSON.stringify(userQualificationList));
        userStep2Update(step2_formData, 4);
         $jq('#full_step_4').fadeOut(400,function(){
            $jq('#full_step_5').fadeIn(400,function(){
            });
         });
    });

    $jq('#user_step5_done').click(function(){
        $jq('#join_slogan').text('Salary Range');
        $jq('#join_step ul li').removeClass('selected');
        $jq('#join_step ul li:eq(4)').addClass('selected').css('display','block');
        step2_formData.append('industry_experience', JSON.stringify(dataIndustryExp));
        userStep2Update(step2_formData, 5);
         $jq('#full_step_5').fadeOut(400,function(){
            $jq('#full_step_6').fadeIn(400,function(){
            });
         });
    });

    $jq('#user_step6_done').click(function(){
        $jq('#join_slogan').text('Tagging');
        $jq('#join_step ul li').removeClass('selected');
        $jq('#join_step ul li:eq(5)').addClass('selected').css('display','block');
        step2_formData.append('salaryRange', userSalaryRange);
        userStep2Update(step2_formData, 6);
         $jq('#full_step_6').fadeOut(400,function(){
            $jq('#full_step_7').fadeIn(400,function(){
            });
         });
    });

    $jq('#user_step7_done').click(function(){
        $jq('#join_slogan').text('Final Section');
        $jq('#join_step ul li').removeClass('selected');
        $jq('#join_step ul li:eq(6)').addClass('selected').css('display','block');
        step2_formData.append('tags', userSelectedTagsList);
        userStep2Update(step2_formData, 7);
         $jq('#full_step_7').fadeOut(400,function(){
            $jq('#full_step_8').fadeIn(400,function(){
            });
         });
    });

    jQuery('#user_step8_done').click(function(){
        console.log(' user_step8_done ', dataAnswerJoin);

        userStep2Update(step2_formData, 8);
        // $jq('#full_step_8').html(getLoader('css_loader_btn', false, true));

        // step2_formData.append('industry_experience', JSON.stringify(dataIndustryExp));
        // step2_formData.append('qualification', JSON.stringify(userQualificationList));
        // step2_formData.append('salaryRange', userSalaryRange);
        // step2_formData.append('tags', userSelectedTagsList);
        // step2_formData.append('qualification_type', jQuery('#qualification_type').val());
        //
        // $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        // $.ajax({
        //     url: base_url+'/step2',
        //     type : 'POST',
        //     data : step2_formData,
        //     processData: false,
        //     contentType: false,
        //     success : function(resp) {
        //         console.log('resp ', resp);
        //         $jq('#join_done').html('Done').prop('disabled',false);
        //         if(resp.status){
        //             setTimeout(() => {
        //                 location.href = resp.redirect;
        //             }, 1000);
        //         }else{
        //             $jq('#full_step_8').html('<div class="full_step_error center"><p>Error Updating data.</p></div>');
        //             if(resp.validator != undefined){
        //                 const keys = Object.keys(resp.validator);
        //                 for (const key of keys) {
        //                     var error_html = '<p>'+resp.validator[key][0]+'</p>';
        //                     $('.full_step_error').append(error_html);
        //                 }
        //             }else if(resp.error != undefined ){
        //                 var error_html = '<p>'+resp.error+'</p>';
        //                 $('.full_step_error').append(error_html);
        //             }
        //
        //             $('.full_step_error').append('<h3 class="mt20"><a class="pointer" onclick="location.reload()" style="color: #ffa200;">Click here to update</a></h3>');
        //         }
        //     }
        // });
    });

    // added by Akmal

    function userStep2Update(data, step){
        console.log(' userStep2Update data ', data );
        console.log(' userStep2Update step ', step );
        // first way.

        // send ajax call.
        // switch (step) {
        //     case "step2":
        //         $jq("#full_step_1").html(getLoader('css_loader_btn', false, true));
        // }

        // var postData = { "data": data, "step" : step };
        // var postData =  {fkey: 'xsrf key'};
        // console.log(' postData ', postData);
        if (step == 4 || step == 3){
            data.append('qualification_type', jQuery('#qualification_type').val());
        }
        data.append('step',step);

        $jq("#full_step_"+ step).html(getLoader('css_loader_btn', false, true));
        // console.log('step ', $jq("#full_step_"+ step));
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $(   'meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            url: base_url+'/step2',
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            // dataType: 'json',
            success : function (resp) {
                console.log('resp', resp);
                if (resp.step == 8){
                    setTimeout(() => {
                        location.href = resp.redirect;
                        }, 1000);
                }
            }
        });

        // second way.

    }


      $jq('#join_done').click(function(){
        console.log(' join_done ', dataAnswerJoin);

            $jq('#join_done').html(getLoader('css_loader_btn', false, true)).prop('disabled',true);
            step2_formData.append('industry_experience', JSON.stringify(dataIndustryExp));
            console.log(' step2_formData ', step2_formData.entries());

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url: base_url+'/employer/step2',
                type : 'POST',
                data : step2_formData,
                processData: false,
                contentType: false,
                success : function(resp) {
                    console.log('resp ', resp);
                    $jq('#join_done').html('Done').prop('disabled',false);

                    if(resp.status){
                        setTimeout(() => {
                            location.href = resp.redirect;
                        }, 3000);
                    }else{
                        $('.full_step_error').removeClass('to_hide').addClass('to_show').text('Error Adding Employer Information');
                        if(resp.validator != undefined){
                            const keys = Object.keys(resp.validator);
                            for (const key of keys) {
                                // if($('#'+key+'_error').length > 0){
                                //     $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(resp.validator[key][0]);
                                // }
                                var error_html = '<p>'+validator[key][0]+'</p>';
                                $('.full_step_error .error').append(error_html);
                            }
                        }

                    }
                }
            });







    });




    $('input.file','#photo_upload').click(function(){
        $jq('#photo_upload_error').removeClass('to_show');
        $jq('#photo_upload').data('id','');
        // $jq('#photo_upload_reset').click();
    });

    function showUploadPhotoError(error){
        isUploadPhotoJoinAjax=false;
        $jq('#photo_loader').addClass('to_hide');
        $jq('.upload > .photo_add, .upload_pic').stop().fadeIn(200);
        $jq('.file').show();
        $jq('#photo_upload_error').html(error).attr('title',error).addClass('to_show');
    }

    $jq('.upload_file').on('click',function(){
        console.log(' upload_file ');
        var input = document.createElement('input');
        input.type = 'file';
        input.setAttribute('accept', 'image/x-png,image/gif,image/jpeg');
        input.onchange = e => {

            $jq('.part_photo .name_info').addClass('to_hide').text('');
            $jq('.upload_file').removeClass('validation_error');

            var file = e.target.files[0];
            console.log(' onchange file  ', file );
            step2_formData.append('file',file);
            $jq('.bl_card_profile .name').text(file.name);

            // check file type
            if( file.type == 'image/jpeg' || file.type == 'image/gif' || file.type == 'image/png' || file.type == 'image/x-png' ) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    profile_img_selected = true;
                    $jq('.bl.photo_add').text('');
                    $jq('.bl.photo_add').css('background-image','url("'+e.target.result+'")');
                    $jq('.bl.photo_add').css('background-position','center');
                    $jq('.bl.photo_add').css('background-size','cover');
                };
                // read the image file as a data URL.
                reader.readAsDataURL(file);
            }

        }
        input.click();
    });

    var fileNameUpload='';
    $jq('#photo_upload').submit(function(e){
        if(isUploadPhotoJoinAjax)return false;
        isUploadPhotoJoinAjax=true;
        var fileName = $jq('#photo_upload').data('id'),
            file = $jq('#'+fileName),
            url = this.action + '?cmd=photo_upload&ajax=1&file=' + fileName,
            formData=new FormData(),
            error='',dur=200;
        $.each(file[0].files, function(i, file){
            var acceptTypes='image/jpeg,image/png,image/gif';
            if (acceptTypes.indexOf(file.type) === -1) {
                error=joinLangParts.acceptFileTypes;
                return false;
            }else if (file.size > fileSizeLimit) {
                error=joinLangParts.errorFileSizeLimit;
                return false;
            }
            formData.append(fileName, file);
        });
        if(error){
            showUploadPhotoError(error);
            return false;
        }

        var isRequest=false;
        $jq('.upload > .photo_add, .upload_pic').fadeOut(dur,function(){
            !isRequest&&$jq('#photo_loader').removeClass('to_hide')
        });

        var xhr = new XMLHttpRequest();
        xhr.open("POST", url);
        xhr.onerror = function(){
            isRequest=true;
            showUploadPhotoError(joinLangParts.errorFileUploadFailed);
        };
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if(xhr.status == 200) {
                    isRequest=true;
                    var data = xhr.responseText;
                    data=checkDataAjax(data);
                    if(data){
                        if(data.error){
                            showUploadPhotoError(data.error);
                        } else {
                            $jq('#photo_loader').addClass('to_hide');
                            fileNameUpload=data;
                            $jq('#photo_img')[0].src =urlFiles+'temp/'+data+'m.jpg';
                            $jq('#photo_img').fadeIn(500);
                            isUploadPhotoJoin=true;
                            //setDisabledSubmitJoin('#frm_card_join');
                        }
                    }else{
                        showUploadPhotoError(joinLangParts.errorFileUploadFailed);
                    }
                }
            }
        };
        xhr.send(formData);
        return false;
    });

    var isFrmSubmitStep3Ajax=false;
    // function checkCaptcha(){
    //     var isError=false;
    //     if (!isUploadPhotoJoin) {
    //         $jq('#photo_upload_error').html(l('upload_profile_photo')).attr('title',l('upload_profile_photo')).addClass('to_show');
    //         isError=true;
    //     }
    //     $jq('input, textarea', '#frm_card_join').each(function(){
    //         var val=$.trim(this.value), is=(val==0||val=='');
    //         if(is)showError(this.id);
    //         isError|=is;
    //     })
    //     if(isRecaptcha){
    //         if(grecaptcha.getResponse(recaptchaWd)==''){
    //             isError = true;
    //             showError('captcha','','#frm_card_join');
    //         }
    //     }
    //     if(isError){
    //        return false;
    //     }

    //     if(isFrmSubmitStep3Ajax) return false;
    //     isFrmSubmitStep3Ajax=true;
    //     isFrmSubmitStep3=true;
    //     var val=isRecaptcha?grecaptcha.getResponse(recaptchaWd):trim($jq('#captcha').val());
    //     $jq('#join_done').html(getLoader('css_loader_btn', false, true)).prop('disabled',true);
    //     disabledControl(true, '#frm_card_join');
    //     var data={captcha:val,photo:fileNameUpload};
    //     $('.fl_basic').each(function(){
    //         data[this.name]=this.value;
    //     })
    //     data.join_answers=dataAnswerJoin;
    //     data.users_like=joinLikeUser;
    //     $.post(urlMain+'join2.php?cmd=check_captcha&ajax=1',data,
    //     function(data){
    //         isFrmSubmitStep3Ajax=false;
    //         data=getDataAjax(data,'data');
    //         $jq('#join_done').html(joinLangParts.done).prop('disabled',false);
    //         if(data!==false){
    //             var $data=$(data),
    //                 $exEmail=$data.filter('.exists_email'),
    //                 $waitApproval=$data.filter('.wait_approval'),
    //                 $redirect=$data.filter('.redirect');
    //             if ($exEmail[0]) {
    //                 alertCustomRedirect($exEmail.html(),joinLangParts.existsEmail)
    //             }else if ($waitApproval[0]) {
    //                 alertCustomRedirect($waitApproval.html(),joinLangParts.noConfirmationAccount)
    //             }else if ($redirect[0]) {
    //                 redirectUrl($redirect.text());
    //             }else if ($data.filter('.error_captcha')[0]) {
    //                 disabledControl(false, '#frm_card_join');
    //                 if(isRecaptcha){
    //                     grecaptcha.reset(recaptchaWd);
    //                 }else{
    //                     $jq('#img_join_captcha').click();
    //                     $jq('#captcha').val('').focus();
    //                 }
    //                 showError('captcha','','#frm_card_join');
    //             }
    //         }
    //     })
    // }

    $jq('.btn_question').click(function(){
        questionAnswer($(this).data('action'));
    })

    $('.card_question.first').css('z-index',4);
    function questionAnswer(action){
        console.log(' questionAnswer ', action, dataAnswerJoin);
        if(isAnswerSend)return;
        isAnswerSend=true;
        var $el=$('.card_question.first:not(.answer)');
        var c=$('.card_question:not(.answer)').length-1;
        if($el[0]){
            dataAnswerJoin[$el.data('field')]=action?'yes':'no';
        }
        // dev22 test
        if(!c){
            step2_formData.append('questions',JSON.stringify(dataAnswerJoin));
            userStep2Update(step2_formData, 1);

            $jq('#step_loader').fadeIn(400);
            $jq('#full_step_1').fadeOut(400,function(){
                // getListUsersLike();
                showStep3();
            })
            return;
            // stepMade(0);
            // $jq('#full_step_1').fadeOut(400,function(){
            //     $jq('#full_step_2').fadeIn(400,function(){
            //         getListUsersLike();
            //     })
            // })
            // return;
        }
        var cl=action?'to_move_right':'to_move_left',
            cla=action?'yes':'no';
        $el.oneTransEnd(function(){
            $el.removeAttr('style');
            $el.oneTransEnd(function(){
                var $prev=$el.addClass('answer').prev('.card_question').addClass('first');
                $jq('#card_question_'+cla).oneTransEnd(function(){
                    isAnswerSend=false;
                    $prev.css('z-index',4);
                }).toggleClass('show hide');
            }, 'transform').toggleClass(cl+' to_hide');
        },'transform').addClass(cl,0);
        $jq('#card_question_'+cla).toggleClass('hide show');
    }
    /* STEP 4 */

    function showErrorResponseForm(data, not, context){
        context=context||'#step-1';
        not=not||[];
        var isError=false,
            blocks={mail:'email',
                    location:'city',
                    birthday:'birth'};
        $('span','<div>'+data+'</div>').each(function(){
            var $el=$(this),cl=$el.attr('class');
            if(!in_array(cl,not)){
                var s=blocks[cl]?blocks[cl]:cl,
                    msg=$el.text();
                if(s=='city')msg=joinLangParts.incorrect_city;
                if(s=='redirect'){
                    redirectUrl(msg);
                    return false;
                }
                showError(s,msg,context,true);
                //(name,msg,context,isSubmitDisabled)
                isError=true;
            }
        })
        return isError;
    }

    if (currentPage == 'join.php' || currentPage == 'join_facebook.php') {
        $jq('.location').styler({singleSelectzIndex: '11',
            selectAutoWidth : false,
            selectAnimation: true,
            selectAppearsNativeToIOS: false,
            onSelectOpened:function(){},
            onFormStyled: function(){
                $('.bl_location, .bl_inp_pos').addClass('to_show');
            }
        })
        $('.i_am').styler({
            singleSelectzIndex: '11',
            selectAutoWidth: false,
            selectAnimation: true,
            selectAppearsNativeToIOS: false,
            onFormStyled: function(){
                $jq('bl_i_am').addClass('to_show');
            }
        })
        /* Info */
        $jq('#pp_terms').modalPopup({shClass:'pp_shadow'});
        $('#terms_close').click(function(){
            $jq('#pp_terms').close(durOpenPpInfo);
            $jq('#agree').prop('checked',true).change();
        })

        $jq('#pp_priv').modalPopup({shClass:'pp_shadow'});
        $('#priv_close').click(function(){
            $jq('#pp_priv').close(durOpenPpInfo);
            $jq('#agree').prop('checked',true).change();
        })

        $jq('.scroll-info-terms, .scroll-info-priv').jScrollPane({
            verticalDragMinHeight: 50,
            verticalDragMaxHeight: 100,
            mouseWheelSpeed: 200,
            //autoReinitialise: true
        })
        /* Info */
    } else if(currentPage == 'join2.php'){
        $('.styler_looking').styler()
    }
    //setStep();
})

function showError(name,msg,context,isSubmitDisabled){
    context=context||'#step-1';
    if(msg){
        $jq('#'+name+'_error').html(msg);
    }
    $jq('#'+name+'_error').removeClass('to_hide');
    hideCheck(name);
    setDisabledSubmitJoin(context,false,isSubmitDisabled);
}

function hideError(name,isShowCheck,context){
    context=context||'#step-1';
    $jq('#'+name+'_error').addClass('to_hide');
    if(isShowCheck){
        showCheck(name);
    }
    setDisabledSubmitJoin(context);
}

function showCheck(name){
    $jq('#'+name+'_check').removeClass('to_hide');
}

function hideCheck(name){
    $jq('#'+name+'_check').addClass('to_hide');
}

var durOpenPpInfo=350;
function infoOpen(name){
    $jq('#pp_'+name).open(durOpenPpInfo);
    setTimeout(function(){
        $jq('.scroll-info-'+name).data('jsp').reinitialise();
    },1)
}

function refreshCaptcha(captcha){
    var captcha=captcha||'#img_join_captcha';
    $jq(captcha).attr('src', url_main+'_server/securimage/securimage_show_custom.php?sid=' + Math.random());
    $jq('#captcha').val('').change();
    return false;
}

function changeUploadPhoto($el){
    $jq('.file').hide();
    $jq('#photo_upload').data('id', $el[0].id);
    // $jq('#photo_upload_submit').click();
}

function birthDateToAge() {
    var birth=new Date($('#year').val(), $('#month').val()-1, $('#day').val()),
        now = new Date(),
        age = now.getFullYear() - birth.getFullYear();
        age = now.setFullYear(1972) < birth.setFullYear(1972) ? age - 1 : age;
    return age >= usersAge;
}

function validateBirthday(){
    if(birthDateToAge()){
        hideError('birth');
    }else{
        showError('birth',joinLangParts.incorrect_date);
    }
}

function setDisabledSubmitJoin(context, setError, notSubmitDisabled){

        // console.log(' setDisabledSubmitJoin ', context);

        notSubmitDisabled=notSubmitDisabled||0;
        context=context||'#step-1';
        setError=setError||0;
        var is=0,isError;
        $jq('input:not([type="hidden"]), select, textarea', context).not('.not_frm').each(function(){
            // console.log(' setDisabledSubmitJoin each element  ', jQuery(this));
            var val=$.trim(this.value);
            if(this.id=='email'){
                isError=!checkEmail(val);
            }else{
                isError=(val==0||val=='');
            }
            /*if(isError&&setError){
                var k=this.id;
                if(k=='city'||k=='state'||k=='country')k='city';
                showError(k,joinLangParts['incorrect_'+k]);
            }*/
            is|=isError;
        })
        var $sb=$jq('#frm_register_submit_2');
        if(context=='#step-1'){
            //isError=!birthDateToAge();
            if(isError&&setError){
                showError('birth',joinLangParts['incorrect_date']);
            }
            is|=isError;
            //console.log('is',is);
            $sb=$jq('#frm_register_submit');
            //is|=!$jq('#agree').prop('checked');
            $sb[$jq('#agree').prop('checked')?'removeClass':'addClass']('disabled');
        }else if(context=='#frm_card_join'){
            is=0;
            /*is|=isError;
            if(isJoinWithPhotoOnly){ is|=!isUploadPhotoJoin; }
            if(isRecaptcha){is|=(grecaptcha.getResponse(recaptchaWd)=='')}
            $sb=$jq('.btn_join_submit');
            notSubmitDisabled=true;*/
        }
        !notSubmitDisabled&&$sb.prop('disabled',is);
        return is;
}

function verifyCallback(response) {
    //setDisabledSubmitJoin('#frm_card_join');
    $jq('#captcha_error').addClass('to_hide');
}

/* Step 3*/
function setSlogan(n){
    n=n||$jq('#join_step').find('li:visible').length;
    if(n==0)n=3;
    $jq('#join_slogan').text(joinLangParts['slogan_'+n]);
}

function setStepJoin(){
    var i=1;
    $jq('#join_step').find('li').each(function(){
        $(this).text(i++);
    })
}

function stepSelected(n){
    setSlogan(n);
    $jq('#join_step').find('li').eq(n-1).addClass('selected');
}

function stepChecked(num){
    $jq('#join_step').find('li').eq(num).text('').toggleClass('selected checked');
}

function stepMade(num,n){
    stepChecked(num);
    stepSelected(n);
}

var joinLikeUser={},numJoinLikeUser=0,maxJoinLikeUser=0;
function joinLike(uid,$btn){
    if(joinLikeUser[uid]==undefined){
        joinLikeUser[uid]=1;
        numJoinLikeUser++;
    }else{
        delete joinLikeUser[uid];
        numJoinLikeUser--;
    }
    if(joinLikeUser[uid]==undefined){
        $btn.attr('title', joinLangParts['like']).removeClass('active');
    }else{
        $btn.attr('title', joinLangParts['unlike']).addClass('active');
    }
    if(numJoinLikeUser==numberPhotoLikes||numJoinLikeUser==maxJoinLikeUser){
        stepMade(1,3);
        $jq('#join_step').find('li').eq(2).delay(100).fadeIn(600);
        $jq('#full_step_2').fadeOut(400,showStep3)
    }
}

function showStep3(){

    var step3_slogan =  ($('#userType').val() == 'user')?('Update your profile'):('Give us a brief overview');
    $jq('#join_slogan').text(step3_slogan);
    $jq('#join_step ul li').removeClass('selected');
    $jq('#join_step ul li:eq(1)').addClass('selected').css('display','block');

    $jq('#full_step_3').fadeIn(400,function(){
        var $baseField=$jq('#full_step_3').find('.placeholder_always');
        if($baseField[0])$baseField.eq(0).focus();
    })
}

var isAnswerSend=false;
var dataAnswerJoin={};

// function getListUsersLike(){
//     $.post('search_results.php?join_search_page=1&ajax=1',
//            {with_photo:1,
//             join_answers:dataAnswerJoin},
//             function(data){
//                         stepMade(0,2);
//                         $jq('#join_step').find('li').eq(1).delay(100).fadeIn(600);
//                         var $data=$(data),$items=$data.find('.item');
//                         $jq('#step_loader').fadeOut(200);
//                         if($items[0]){
//                             maxJoinLikeUser=$items.length;
//                             if(maxJoinLikeUser!=maxUsersPagesJoin){
//                                 var num=4,n=Math.floor(maxJoinLikeUser/num),d=0,html='';
//                                 if(n){
//                                     if(maxJoinLikeUser>num){
//                                         d=num-(maxJoinLikeUser-n*num);
//                                     }
//                                 }else{
//                                     d=num-maxJoinLikeUser;
//                                 }
//                                 if (d) {
//                                     for(var i=0;i<d;i++) {
//                                         html +='<div class="item"></div>';
//                                     }
//                                 }
//                                 if(html)$items=$data.append(html).find('.item');
//                             }
//                             $('#list_photos_card').prepend($items).closest('.bl_card_question').fadeIn(400);
//                         }else{
//                             setSlogan(3);
//                             showStep3();
//                         }

//     })
// }
/* Step 3*/





function checkEmail(emailStr) {

	var emailPat=/^(.+)@(.+)$/;
	var specialChars="\\(\\)><@,;:\\\\\\\"\\.\\[\\]!%";
	var validChars="\[^\\s" + specialChars + "\]";
	var quotedUser="(\"[^\"]*\")";
	var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
	var atom=validChars + '+';
	var word="(" + atom + "|" + quotedUser + ")";
	var userPat=new RegExp("^" + word + "(\\." + word + ")*$");
	var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");

	var matchArray=emailStr.match(emailPat);

	if (matchArray==null) {
		return false;
	}
	var user=matchArray[1];
	var domain=matchArray[2];
	for (i=0; i<user.length; i++) {
		if (user.charCodeAt(i)>127) {
			return false;
		}
	}
	for (i=0; i<domain.length; i++) {
		if (domain.charCodeAt(i)>127) {
			return false;
		}
	}
	if (user.match(userPat)==null) {
		return false;
	}

	var IPArray=domain.match(ipDomainPat);
	if (IPArray!=null) {
		for (var i=1;i<=4;i++) {
			if (IPArray[i]>255) {
				return false;
			}
		}
		return true;
	}

	var atomPat=new RegExp("^" + atom + "$");
	var domArr=domain.split(".");
	var len=domArr.length;
	for (i=0;i<len;i++) {
		if (domArr[i].search(atomPat)==-1) {
			return false;
		}
	}
	if (domArr[len-1].length < 2) {
		return false;
	}
	if (len<2) {
		return false;
	}
	/*mask=/^(root|abuse|webmaster|help|postmaster|sales|resumes|contact|advertising|spam|spamtrap|nospam|noc|admin|support|daemon|listserve|listserver|autoreply)@/i;
	if (mask.test(emailStr.toLowerCase())) {
		return false;
	}*/

	return true;
}



function l(key) {
    if(typeof siteLangParts!=='object')return '';
    var page='all';
    if(typeof currentPage!=='undefined')page=currentPage;
    if(siteLangParts[page]&&siteLangParts[page][key]) {
        return siteLangParts[page][key];
    }
    if(page!=='all'&&siteLangParts['all']&&siteLangParts['all'][key]){
        return siteLangParts['all'][key];
    }
    return '';
}














//====================================================================================================================================//
// Google map location script
//====================================================================================================================================//
var map;
jQuery(document).ready(function() {

    var input = document.getElementById('location_search');
    var autocomplete = new google.maps.places.Autocomplete(input);

    // var service = new google.maps.places.AutocompleteService();
    var geocoder = new google.maps.Geocoder();
    var hasLocation = false;
    var latlng = new google.maps.LatLng(-31.2532183, 146.921099);
    var marker = "";

    var options = {
        zoom: 14,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    if(jQuery("#location_map").length > 0) {
        map = new google.maps.Map(document.getElementById("location_map"), options);
        autocomplete.bindTo('bounds', map);
        autocomplete.setFields(['address_components', 'geometry', 'icon', 'name']);
        if(!hasLocation) { map.setZoom(14); }

        // add listner on map, when click on map change the latlong and put a marker over there.
        google.maps.event.addListener(map, "click", function(event) {
            console.log(' addListener click  ');
            reverseGeocode(event.latLng);
        })

        // get the location (city,state,country) on base of text enter in search.
        jQuery("#location_search_load").click(function() {
            if(jQuery("#location_search").val() != "") {
                geocode(jQuery("#location_search").val());
                return false;
            } else {
                // marker.setMap(null);
                return false;
            }
            return false;
        })
        jQuery("#location_search").keyup(function(e) {
            if(e.keyCode == 13)
                jQuery("#location_search_load").click();
        })

        // when click on the Autocomplete suggested locations list
        autocomplete.addListener('place_changed', function() {
             console.log(' autocomplete place_changed ');

              var place = autocomplete.getPlace();
              console.log(' place ', place);

              if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
              }

              // If the place has a geometry, then present it on a map.
              if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
              } else {
                map.setCenter(place.geometry.location);
                map.setZoom(14);  // Why 14? Because it looks good.
              }


              // var address = '';
              // if (place.address_components) {
              //   address = [
              //     (place.address_components[0] && place.address_components[0].short_name || ''),
              //     (place.address_components[1] && place.address_components[1].short_name || ''),
              //     (place.address_components[2] && place.address_components[2].short_name || '')
              //   ].join(' ');
              // }


              // console.log(' auto place --- ', place);
              // console.log(' auto address --- ', address);

                var address, city, country, state;
                var address_components = place.address_components;
                for ( var j in address_components ) {
                    var types = address_components[j]["types"];
                    var long_name = address_components[j]["long_name"];
                    var short_name = address_components[j]["short_name"];
                    // console.log(' address_components ', address_components);
                    if ( jQuery.inArray("locality", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                        city = long_name;
                    }
                    else if ( jQuery.inArray("administrative_area_level_1", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                        state = long_name;
                    }
                    else if ( jQuery.inArray("country", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                        country = long_name;
                    }
                }

                if((city) && (state) && (country))
                    address = city + ", " + state + ", " + country;
                else if((city) && (state))
                    address = city + ", " + state;
                else if((state) && (country))
                    address = state + ", " + country;
                else if(country)
                    address = country;

                 if((place) && (place.name))
                    address = place.name + ',' + address;

                    // console.log(' reverseGeocode place ', place);
                    // console.log(' reverseGeocode city/state/country = ', city,'/',state,'/',country );
                    updateLocationInputs(place.name,city,state,country);
                    jQuery("#location_search").val(address);
                    placeMarker(place.geometry.location);
            });

        }
        // location_map length.

    function placeMarker(location) {
        console.log(' placeMarker location ',location);

        if (marker == "") {
            marker = new google.maps.Marker({
                position: latlng,
                map: map,
                draggable:true,
                title: "Drag me"
            })
            google.maps.event.addListener(marker, "dragend", function() {
            var point = marker.getPosition();
            map.panTo(point);
                jQuery("#location_lat").val(point.lat());
                jQuery("#location_long").val(point.lng());
            });
        }
        marker.setPosition(location);
        marker.setVisible(true);
        map.setCenter(location);
        map.setZoom(14);
        if((location.lat() != "") && (location.lng() != "")) {
            jQuery("#location_lat").val(location.lat());
            jQuery("#location_long").val(location.lng());
        }
    }

    function geocode(address) {
        // console.log('---2-- geocode ', address);
        if (geocoder) {
            geocoder.geocode({"address": address}, function(results, status) {
                if (status != google.maps.GeocoderStatus.OK) {
                    alert("Cannot find address");
                    return;
                }
                placeMarker(results[0].geometry.location);
                reverseGeocode(results[0].geometry.location);
                if(!hasLocation) {
                    map.setZoom(14);
                    hasLocation = true;
                }
            })
        }
    }

    function reverseGeocode(location) {
        console.log(' reverseGeocode ', location);
        if (geocoder) {
            geocoder.geocode({"latLng": location}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var address, city, country, state;
                    for ( var i in results ) {
                        var address_components = results[i]["address_components"];
                        for ( var j in address_components ) {
                            var types = address_components[j]["types"];
                            var long_name = address_components[j]["long_name"];
                            var short_name = address_components[j]["short_name"];

                            // console.log(' address_components ', address_components);

                            if ( jQuery.inArray("locality", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                                city = long_name;
                            }
                            else if ( jQuery.inArray("administrative_area_level_1", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                                state = long_name;
                            }
                            else if ( jQuery.inArray("country", types) >= 0 && jQuery.inArray("political", types) >= 0 ) {
                                country = long_name;
                            }
                        }
                    }
                    if((city) && (state) && (country))
                        address = city + ", " + state + ", " + country;
                    else if((city) && (state))
                        address = city + ", " + state;
                    else if((state) && (country))
                        address = state + ", " + country;
                    else if(country)
                        address = country;

                    // console.log(' reverseGeocode results ', results);
                    // console.log(' reverseGeocode city/state/country = ', city,'/',state,'/',country );
                    updateLocationInputs('',city,state,country);
                    jQuery("#location_search").val(address);
                    placeMarker(location);
                    return true;
                }
            })
        }
        return false;
    }





    function updateLocationInputs(place,city,state,country){
        jQuery('#location_name').val(place);
        jQuery('#location_city').val(city);
        jQuery('#location_state').val(state);
        jQuery('#location_country').val(country);

    }


    // by default show this location;
    geocode('Sydney New South Wales, Australia');



});



