
var isUploadPhotoJoinAjax=false,
    isUploadPhotoJoin=false;
var step2_formData = new FormData();
var step3_formData = new FormData();
var step4_formData = new FormData();
var step5_formData = new FormData();
var step6_formData = new FormData();
var step7_formData = new FormData();
var dataIndustryExp = [];
var userQualificationList = [];
var userSalaryRange = '';
var profile_img_selected = false;
var userSelectedTagsList = [];

var isAnswerSend=false;
var dataAnswerJoin={};

$(function(){

    function disabledControl(state, context){
        $jq('select', context).prop('disabled', state).trigger('refresh');
        $jq('input, textarea', context).prop('disabled', state);
    }

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
        // var organHeldTitle = $.trim($jq('#organHeldTitle').val());
        // console.log(organHeldTitle);

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

        // if (organHeldTitle == ''){
        //     s3_validation = false;
        //     $jq('#organHeldTitle_error').removeClass('to_hide').text('Required');
        //     $jq('#organHeldTitle').addClass('validation_error');
        // }

        if(!profile_img_selected){
            s3_validation = false;
            $jq('.part_photo .name_info').removeClass('to_hide').text('Required');
            $jq('.upload_file').addClass('validation_error');
        }

        if(s3_validation){
            step3_formData.append('about_me', about_me);
            step3_formData.append('interested_in', interested_in );
            // step3_formData.append('organHeldTitle', organHeldTitle );
            userStep2Update(step3_formData, 3);
            showEmployStep4();
        }

    });

    // User Step 3 Done
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
        var organHeldTitle = $.trim($jq('#organHeldTitle').val());
        // console.log(organHeldTitle);

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

        if (organHeldTitle == ''){
            s3_validation = false;
            $jq('#organHeldTitle_error').removeClass('to_hide').text('Required');
            $jq('#organHeldTitle').addClass('validation_error');
        }

        if(!profile_img_selected){
            s3_validation = false;
            $jq('.part_photo .name_info').removeClass('to_hide').text('Required');
            $jq('.upload_file').addClass('validation_error');
        }

        if(s3_validation){
            step3_formData.append('about_me', about_me);
            step3_formData.append('interested_in', interested_in );
            step3_formData.append('recentJob', recentJob );
            step3_formData.append('organHeldTitle', organHeldTitle );
            
            userStep2Update(step3_formData, 3);
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
            jQuery('#user_step9_done').prop('disabled',false);
            jQuery('#tag_skip_btn').fadeOut();
        }else{
            jQuery('#user_step9_done').prop('disabled',true);
        }
    }


    jQuery('.selectTagList').on('click','li.tagItem', function(){
        // console.log(' selectTagList click ');
        var tagId = jQuery(this).attr('data-id');
        // console.log('selected tags', userSelectedTagsList.indexOf(tagId));
        if ( userSelectedTagsList.indexOf(tagId) != -1 ){
            userSelectedTagsList.splice(userSelectedTagsList.indexOf(tagId),1);
            jQuery(this).remove();
        } if (userSelectedTagsList.length == 0)  {
            jQuery('#user_step9_done').prop('disabled',true);
            jQuery('#tag_skip_btn').fadeIn();
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
        // $jq('#join_slogan').text('Industry Experience');
        // $jq('#join_step ul li').removeClass('selected');
        // $jq('#join_step ul li:eq(3)').addClass('selected').css('display','block');
        step4_formData.append('qualification_type', jQuery('#qualification_type').val());
        step4_formData.append('qualification', JSON.stringify(userQualificationList));
        userStep2Update(step4_formData, 4);
        // $jq('#full_step_4').fadeOut(400,function(){
        //     $jq('#full_step_5').fadeIn(400,function(){
        //     });
        // });
    });




    $jq('#user_step5_done').click(function(){
        // $jq('#join_slogan').text('Salary Range');
        // $jq('#join_step ul li').removeClass('selected');
        // $jq('#join_step ul li:eq(4)').addClass('selected').css('display','block');
        step5_formData.append('industry_experience', JSON.stringify(dataIndustryExp));
        userStep2Update(step5_formData, 5);
        // $jq('#full_step_5').fadeOut(400,function(){
        //     $jq('#full_step_6').fadeIn(400,function(){
        //     });
        // });
    });

    $jq('#user_step6_done').click(function(){
        // $jq('#join_slogan').text('Tagging');
        // $jq('#join_step ul li').removeClass('selected');
        // $jq('#join_step ul li:eq(5)').addClass('selected').css('display','block');
        step6_formData.append('salaryRange', userSalaryRange);
        userStep2Update(step6_formData, 6);
        // $jq('#full_step_6').fadeOut(400,function(){
        //     $jq('#full_step_7').fadeIn(400,function(){
        //     });
        // });
    });

    $jq('#user_step7_done').click(function(){
        // $jq('#join_slogan').text('Final Section');
        
        var check = $('.profile_photo_frame').hasClass('item_video'); 
        if(!check){
            alert('Please add video');
        }
        else{
            userStep2Update(step6_formData, 7);
        }


        // userStep2Update(step6_formData, 7);

        // $jq('#join_step ul li').removeClass('selected');
        // $jq('#join_step ul li:eq(6)').addClass('selected').css('display','block');
        // $jq('#full_step_7').fadeOut(400,function(){
        //     $jq('#full_step_8').fadeIn(400,function(){
        //     });
        // });
    });

    jQuery('.submit-document').on('submit',(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        console.log(formData);
        formData.append('submit', true);
        jQuery.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        jQuery.ajax({
            type:'POST',
            url: base_url+'/ajax/userUploadResume',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            // beforeSend:function(){
            //     jQuery('.save-resume-btn').html('Saving... <i class="fa fa-spinner fa-spin"></i>');
            // },
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

                    setTimeout(function(){ showUserStep9(); }, 1000);
                }
                console.log(data);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

    jQuery('#user_step8_done').click(function(){
        $('.upload_resume_error').html('');
        $('.upload_resume_error').show();
        var resumeFileLength = $('#resume')[0].files.length;
        console.log('check length', resumeFileLength);
        if (resumeFileLength === 0){
            $('.upload_resume_error').append('<p>please select resume</p>');
            setTimeout(function () {
                $('.upload_resume_error').fadeOut();
            }, 1000);
        } else {
            jQuery('.submit-document').submit();
        }
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

    $jq('#user_step9_done').click(function () {
        step7_formData.append('tags', userSelectedTagsList);
        userStep2Update(step7_formData, 9);
    });

    $('#tag_skip_btn').click(function () {
        userStep2Update(step7_formData, 9);
    });

    $('#user_step10_done').click(function () {
        userStep2Update(step7_formData, 10);
    });

    // added by Akmal step2
    // var isSendStep2 = false;
    var userType = $('#userType').val();
    // console.log('usertype', userType);
    function userStep2Update(data, step){
        console.log(' userStep2Update data ', data );
        console.log(' userStep2Update step ', step );
        // first way.

        $('.full_step_error').html('');

        // send ajax call.
        // switch (step) {
        //     case "step2":
        //         $jq("#full_step_1").html(getLoader('css_loader_btn', false, true));
        // }

        // var postData = { "data": data, "step" : step };
        // var postData =  {fkey: 'xsrf key'};
        // console.log(' postData ', postData);

        // if (step == 4){
        //     data.append('qualification_type', jQuery('#qualification_type').val());
        // }

        // console.log('qualification type', step2_formData.has('qualification_type'));
        // console.log('tags', step2_formData.has('tags'));
        // console.log('isstep2', isSendStep2);
        // console.log()
        // if (!step2_formData.has('qualification_type') || !step2_formData.has('qualification') || !step2_formData.has('industry_experience') || !step2_formData.has('salaryRange') || !step2_formData.has('tags') || isSendStep2){
        //     isSendStep2 = true;
        //     console.log('form data', step2_formData);
        // } else {
        //     isSendStep2 = false;
        // }
        data.append('step',step);
        if (userType == 'user')
        {
            var currentButtonText =   $jq("#user_step"+step+"_done").html();
            $jq("#user_step"+step+"_done").html(getLoader('smallSpinner css_loader_btn', false, true));
            // console.log('step ', $jq("#full_step_"+ step));
            // if (isSendStep2) {
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
                    if(resp.status == 1){
                        // var nextStep = step+1;
                        switch (step) {
                            case 2:
                                showUserStep3();
                                break;
                            case 3:
                                showUserStep4();
                                break;
                            case 4:
                                showUserStep5();
                                break;
                            case 5:
                                showUserStep6();
                                break;
                            case 6:
                                showUserStep7();
                                break;
                            case 7:
                                showUserStep8();
                                break;
                            case 8:
                                showUserStep9();
                                break;
                            case 9:
                                showUserStep10();
                                break;
                            case 10:
                                setTimeout(() => {
                                    location.href = resp.redirect;
                                }, 1000);
                                break;
                            default:
                                showUserStep2();
                                break;
                        }
                        // isSendStep2 = true;
                    }else{
                        // stop the loader.
                        $jq("#user_step"+step+"_done").html(currentButtonText);
                        // if validation error occure.
                        if(resp.validator !== undefined){
                            const keys = Object.keys(resp.validator);
                            console.log(keys);
                            for (const key of keys) {
                                var error_html = '<p>'+resp.validator[key][0]+'</p>';
                                $('.full_step_error').append(error_html);
                            }
                        }
                        // isSendStep2 = false;
                        // console.log(isSendStep2);
                    }
                }
            });
            // }
            // else {
            //     $jq("#user_step"+step+"_done").html(currentButtonText);
            // }
        } else {
            if (step == 3){
                $jq('#step3_done').html(getLoader('css_loader_btn', false, true));
            } else {
                $jq('#join_done').html(getLoader('css_loader_btn', false, true)).prop('disabled',true);
            }
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url: base_url+'/employer/step2',
                type : 'POST',
                data : data,
                processData: false,
                contentType: false,
                success : function(resp) {
                    console.log('resp ', resp);
                    if (step == 3){
                        $jq('#step3_done').html('Done').prop('disabled', false);
                    }
                    $jq('#join_done').html('Done').prop('disabled',false);

                    if(resp.status == 1){
                        switch (step) {
                            case 2:
                                showUserStep3();
                                break;
                            case 3:
                                showEmployStep4();
                                break;
                            case 4:
                                setTimeout(() => {
                                    location.href = resp.redirect;
                                }, 1000);
                                break;
                            default:
                                showUserStep2();
                                break;
                        }
                    }else{
                        // $('#full_step_error').removeClass('to_hide').addClass('to_show').text('Error Adding Employer Information');
                        if(resp.validator != undefined){
                            const keys = Object.keys(resp.validator);
                            for (const key of keys) {
                                // if($('#'+key+'_error').length > 0){
                                //     $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(resp.validator[key][0]);
                                // }
                                var error_html = '<p>'+resp.validator[key][0]+'</p>';
                                console.log(error_html);
                                $('.full_step_error').append(error_html);
                            }
                        }

                    }
                }
            });
        }

    }



    $jq('#join_done').click(function(){
        console.log(' join_done ', dataAnswerJoin);

        step4_formData.append('industry_experience', JSON.stringify(dataIndustryExp));
        userStep2Update(step4_formData, 4);
        // $jq('#join_done').html(getLoader('css_loader_btn', false, true)).prop('disabled',true);
        // step2_formData.append('industry_experience', JSON.stringify(dataIndustryExp));
        // console.log(' step2_formData ', step2_formData.entries());
        //
        // $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        // $.ajax({
        //     url: base_url+'/employer/step2',
        //     type : 'POST',
        //     data : step2_formData,
        //     processData: false,
        //     contentType: false,
        //     success : function(resp) {
        //         console.log('resp ', resp);
        //         $jq('#join_done').html('Done').prop('disabled',false);
        //
        //         if(resp.status){
        //             setTimeout(() => {
        //                 location.href = resp.redirect;
        //             }, 3000);
        //         }else{
        //             $('.full_step_error').removeClass('to_hide').addClass('to_show').text('Error Adding Employer Information');
        //             if(resp.validator != undefined){
        //                 const keys = Object.keys(resp.validator);
        //                 for (const key of keys) {
        //                     // if($('#'+key+'_error').length > 0){
        //                     //     $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(resp.validator[key][0]);
        //                     // }
        //                     var error_html = '<p>'+validator[key][0]+'</p>';
        //                     $('.full_step_error .error').append(error_html);
        //                 }
        //             }
        //
        //         }
        //     }
        // });







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
            step3_formData.append('file',file);
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





    $jq('.btn_question').click(function(){
        questionAnswer($(this).data('action'));
    })

    $('.card_question.first').css('z-index',4);
    function questionAnswer(action){
        // console.log(' questionAnswer ', action, dataAnswerJoin);
        if(isAnswerSend)return;

			isAnswerSend=true;
			var $el=$('.card_question.first:not(.answer)');
			var c=$('.card_question:not(.answer)').length-1;

            // console.log(dataAnswerJoin[$el.data('field')]);


        if($el[0]){
            // console.log($el[0]);
            dataAnswerJoin[$el.data('field')]=action?'yes':'no';
        }
        if(!c){
            step2_formData.append('questions',JSON.stringify(dataAnswerJoin));
            userStep2Update(step2_formData, 2);
        }

        var cl=action?'to_move_right':'to_move_left',
            cla=action?'yes':'no';
        $el.oneTransEnd(function(){
            $el.removeAttr('style');
            $el.oneTransEnd(function(){
                
                $el.removeClass('active1');

                var $prev=$el.addClass('answer').prev('.card_question').addClass('first active1');
                $jq('#card_question_'+cla).oneTransEnd(function(){
                    isAnswerSend=false;
                    $prev.css('z-index',4);
                }).toggleClass('show hide');
            }, 'transform').toggleClass(cl+' to_hide');
        },'transform').addClass(cl,0);
        $jq('#card_question_'+cla).toggleClass('hide show');
    }

    // ======================== Next and previous question by clicking on button ======================== 

    // $jq('.questionNaviateTo').click(function(){
    //     questionNaviateTo($(this).data('action'));
    // })
    // function questionNaviateTo(action){
    //     console.log(' questionNaviateTo ', action, dataAnswerJoin);
         
    //      if( action == 'next' ){
    //         if(dataAnswerJoin.length <=0 ){
    //             console.log(' --<< can not next  ');
    //             return false; 
    //         }
    //      }

    //     var $el =   $('.card_question.first:not(.answer)');
    //     var c   =   $('.card_question:not(.answer)').length-1; // remaning questions
    //     var cl = 'to_move_left'; 
    //     var cla = action?'yes':'no';
    //     $el.oneTransEnd(function(){
    //         $el.removeAttr('style');
    //         $el.oneTransEnd(function(){
    //             // var $prev = $el.addClass('answer').prev('.card_question').addClass('first');
    //             var $prev = $el.removeClass('first').next('.card_question').removeClass('to_hide').addClass(' first ');
    //                 $prev.css('z-index',4);
    //             $jq('#card_question_'+cla).oneTransEnd(function(){
    //                 isAnswerSend=false;
    //                 $prev.css('z-index',4);
    //             }).toggleClass('show hide');

    //         }, 'transform').toggleClass(cl+'  to_hide test123 first');
    //     },'transform').addClass(cl,0);

    //     $jq('#card_question_'+cla).toggleClass('hide show');

    // }


    // Second way Start here 16-06-2021

    /*$jq('.questionNaviateTo').click(function(){
        questionNavigateTo($(this).data('action'));
    })
    function questionNavigateTo(action){
        if(action == 'next'){
            var  firstButton = $('#graduate_intern').hasClass("active1");
            console.log(firstButton);
            if (!firstButton) {
                $('.initialNextQuestion > h1 > i').removeAttr('disabled');
                var $check = $('.card_question').siblings('.active1').removeClass('active1');
                $check.removeAttr('style').prev('.card_question').addClass('active1').css('z-index',4);
            }
            else{
                $('.initialNextQuestion > h1 > i').attr('disabled', 'disabled');
            }
        }
        else{
            var firstButton = $('#resident').hasClass("active1");
            console.log(firstButton);
            if (!firstButton) {
                $('.initialPrevQuestion > h1 > i').removeAttr('disabled');
                var $check = $('.card_question').siblings('.active1').removeClass('active1');
                $check.removeAttr('style').next('.card_question').addClass('active1').css('z-index',4);
            }
            else{
                $('.initialPrevQuestion > h1 > i').attr('disabled', 'disabled');
            }
        }

    }*/

    // Second way end here 16-06-2021


    $jq('.questionNaviateTo').click(function(){
        questionNavigateTo($(this).data('action'));
    })
    function questionNavigateTo(action){
        if(action == 'next'){
            var  firstButton = $('#graduate_intern').hasClass("active1");
            console.log(firstButton);
            if (!firstButton) {
                $('.initialNextQuestion > h1 > i').removeAttr('disabled');
                var $check = $('.card_question').siblings('.active1').removeClass('active1');
                $check.removeAttr('style').prev('.card_question').addClass('active1').css('z-index',4);
            }
            else{
                $('.initialNextQuestion > h1 > i').attr('disabled', 'disabled');
            }
        }
        else{
            var firstButton = $('#resident').hasClass("active1");
            console.log(firstButton);
            if (!firstButton) {
                $('.initialPrevQuestion > h1 > i').removeAttr('disabled');
                var $check = $('.card_question').siblings('.active1').removeClass('active1 first');
                $check.removeAttr('style').next('.card_question').addClass('active1').toggleClass('answer to_hide').css('z-index',4);
            }
            else{
                $('.initialPrevQuestion > h1 > i').attr('disabled', 'disabled');
            }
        }

    }



    

    // ======================== Next and previous question by clicking on button ======================== 
    


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

    // if (currentPage == 'join.php' || currentPage == 'join_facebook.php') {
    //     $jq('.location').styler({singleSelectzIndex: '11',
    //         selectAutoWidth : false,
    //         selectAnimation: true,
    //         selectAppearsNativeToIOS: false,
    //         onSelectOpened:function(){},
    //         onFormStyled: function(){
    //             $('.bl_location, .bl_inp_pos').addClass('to_show');
    //         }
    //     })
    //     $('.i_am').styler({
    //         singleSelectzIndex: '11',
    //         selectAutoWidth: false,
    //         selectAnimation: true,
    //         selectAppearsNativeToIOS: false,
    //         onFormStyled: function(){
    //             $jq('bl_i_am').addClass('to_show');
    //         }
    //     })
    //     /* Info */
    //     $jq('#pp_terms').modalPopup({shClass:'pp_shadow'});
    //     $('#terms_close').click(function(){
    //         $jq('#pp_terms').close(durOpenPpInfo);
    //         $jq('#agree').prop('checked',true).change();
    //     })
    //
    //     $jq('#pp_priv').modalPopup({shClass:'pp_shadow'});
    //     $('#priv_close').click(function(){
    //         $jq('#pp_priv').close(durOpenPpInfo);
    //         $jq('#agree').prop('checked',true).change();
    //     })
    //
    //     $jq('.scroll-info-terms, .scroll-info-priv').jScrollPane({
    //         verticalDragMinHeight: 50,
    //         verticalDragMaxHeight: 100,
    //         mouseWheelSpeed: 200,
    //         //autoReinitialise: true
    //     })
    //     /* Info */
    // } else if(currentPage == 'join2.php'){
    //     $('.styler_looking').styler()
    // }
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

// var currentStep = $('#userStep').val();
// console.log('current step', currentStep);
// var nextStepLoader = $jq("#full_step_"+ currentStep).html(getLoader('css_loader_btn', false, true));

function showUserStep2() {
    $jq('#full_step_1').delay(150).fadeIn(500);
}

function showUserStep3(){
    var step3_slogan =  ($('#userType').val() == 'user')?('Update your profile'):('Give us a brief overview');
    $jq('#join_slogan').text(step3_slogan);
    $jq('#join_step ul li').removeClass('selected');
    $jq('#join_step ul li:eq(1)').addClass('selected').css('display','block');
    $jq('#full_step_1').fadeOut(400,function(){
        // nextStepLoader;
        $jq('#full_step_3').fadeIn(400,function(){
            var $baseField=$jq('#full_step_3').find('.placeholder_always');
            if($baseField[0])$baseField.eq(0).focus();
        });
    });
}

function showUserStep4(){
    $jq('#join_slogan').text('Qualification');
    $jq('#join_step ul li').removeClass('selected');
    $jq('#join_step ul li:eq(1)').css('display','block');
    $jq('#join_step ul li:eq(2)').addClass('selected').css('display','block');
    $jq('#full_step_3').fadeOut(400,function(){
        // nextStepLoader;
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

function showUserStep5(){
    $jq('#join_slogan').text('Industry Experience');
    $jq('#join_step ul li').removeClass('selected');
    $jq('#join_step ul li:eq(1), #join_step ul li:eq(2)').css('display','block');
    $jq('#join_step ul li:eq(3)').addClass('selected').css('display','block');
    $jq('#full_step_4').fadeOut(400,function(){
        // nextStepLoader;
        $jq('#full_step_5').fadeIn(400,function(){
        });
    });
}

function showUserStep6(){
    $jq('#join_slogan').text('Salary Range');
    $jq('#join_step ul li').removeClass('selected');
    $jq('#join_step ul li:eq(1), #join_step ul li:eq(2), #join_step ul li:eq(3)').css('display','block');
    $jq('#join_step ul li:eq(4)').addClass('selected').css('display','block');
    $jq('#full_step_5').fadeOut(400,function(){
        // nextStepLoader;
        $jq('#full_step_6').fadeIn(400,function(){
        });
    });
}

function showUserStep7(){
    $jq('#join_slogan').text('Upload Video');
    $jq('#join_step ul li').removeClass('selected');
    $jq('#join_step ul li:eq(1), #join_step ul li:eq(2), #join_step ul li:eq(3), #join_step ul li:eq(4)').css('display','block');
    $jq('#join_step ul li:eq(5)').addClass('selected').css('display','block');
    $jq('#full_step_6').fadeOut(400,function(){
        // nextStepLoader;
        $jq('#full_step_7').fadeIn(400,function(){
        });
    });
}

function showUserStep8(){
    $jq('#join_slogan').text('Upload Resume');
    $jq('#join_step ul li').removeClass('selected');
    $jq('#join_step ul li:eq(1), #join_step ul li:eq(2), #join_step ul li:eq(3), #join_step ul li:eq(4), #join_step ul li:eq(5)').css('display','block');
    $jq('#join_step ul li:eq(6)').addClass('selected').css('display','block');
    $jq('#full_step_7').fadeOut(400,function(){
        // nextStepLoader;
        $jq('#full_step_8').fadeIn(400,function(){
        });
    });
}

function showUserStep9() {
    $jq('#join_slogan').text('Tagging');
    $jq('#join_step ul li').removeClass('selected');
    $jq('#join_step ul li:eq(1), #join_step ul li:eq(2), #join_step ul li:eq(3), #join_step ul li:eq(4), #join_step ul li:eq(5), #join_step ul li:eq(6)').css('display','block');
    $jq('#join_step ul li:eq(7)').addClass('selected').css('display','block');
    $jq('#full_step_8').fadeOut(400,function(){
        // nextStepLoader;
        $jq('#full_step_9').fadeIn(400,function(){
        });
    });
}

function showUserStep10() {
    $jq('#join_slogan').text('Browse Jobs');
    $jq('#join_step ul li').removeClass('selected');
    $jq('#join_step ul li:eq(1), #join_step ul li:eq(2), #join_step ul li:eq(3), #join_step ul li:eq(4), #join_step ul li:eq(5), #join_step ul li:eq(6), #join_step ul li:eq(7)').css('display','block');
    $jq('#join_step ul li:eq(8)').addClass('selected').css('display','block');
    $jq('#full_step_9').fadeOut(400,function(){
        $jq('#full_step_10').fadeIn(400,function(){
        });
    });
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    var url = './step2Jobs';
    $.get(url, function (data) {
        $('.jobs_list').html(data);
    });
}

// Employ Step4

function showEmployStep4(){
    $jq('#join_slogan').text('Industry Experience');
    $jq('#join_step ul li').removeClass('selected');
    $jq('#join_step ul li:eq(1)').css('display','block');
    $jq('#join_step ul li:eq(2)').addClass('selected').css('display','block');

    // step4_formData.append('industry_experience', JSON.stringify(dataIndustryExp));
    // userStep2Update(step4_formData, 4);
    $jq('#full_step_3').fadeOut(400,function(){
        $jq('#full_step_4').fadeIn(400,function(){
            // var $baseField=$jq('#full_step_3').find('.placeholder_always');
            // if($baseField[0])$baseField.eq(0).focus();
        });
    })
}
// After reload the user window
function userStepReload(currentStep) {
    switch (currentStep) {
        case 2:
            showUserStep3();
            break;
        case 3:
            showUserStep4();
            break;
        case 4:
            showUserStep5();
            break;
        case 5:
            showUserStep6();
            break;
        case 6:
            showUserStep7();
            break;
        case 7:
            showUserStep8();
            break;
        case 8:
            showUserStep9();
            break;
        case 9:
            showUserStep10();
												break;
								case 10:
												showUserStep10();
												break;
        default:
            showUserStep2();
            break;
    }
}

// After reload the employer window
function employerStepReload(currentStep) {
    switch (currentStep) {
        case 2:
            showUserStep3();
            break;
        case 3:
            showEmployStep4();
            break;
        case 4:
            showEmployStep4();
            break;
        default:
            showUserStep2();
            break;
    }
}


