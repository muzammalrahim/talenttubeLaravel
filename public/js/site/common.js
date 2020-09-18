var CommonScript = function() {


    this.GetLocation = function(type, elem){
        console.log(' GetStateList ');
        var location = $(elem).closest('.geo_location_cont');
        var geo_country_elem = location.find('select.geo_country');
        var geo_state_elem = location.find('select.geo_states'); //.val();
        var geo_city_elem = location.find('select.geo_cities'); //.val();
        $.ajax({
            type: 'POST',
                url: base_url+'/ajax/'+type,
                data: { cmd:type,
                        select_id: (type === 'geo_states')? geo_country_elem.val() : geo_state_elem.val(),
                        filter:'1',
                        list: 0},
                        beforeSend: function(){
                            geo_country_elem.prop('disabled', true).trigger('refresh');
                            geo_city_elem.prop('disabled', true).trigger('refresh');
                            // preloader
                        },
                        success: function(data){
                            console.log(' data ', data);
                            geo_country_elem.prop('disabled', false).trigger('refresh');
                            geo_city_elem.prop('disabled', false).trigger('refresh');

                            // $jq('.geo, #city', pp_profile_edit_main_frm).prop('disabled', false).trigger('refresh');
                            // $this.disabledProfileEditMain(false);
                            if (data.status) {

                                console.log(' geo_state_elem ', geo_state_elem );
                                console.log(' data.list ', data.list);

                                switch (type) {
                                    case 'geo_states':
                                        geo_state_elem.html(data.list).trigger('refresh');
                                        geo_city_elem.html('<option value="0">Select City</option>').trigger('refresh');
                                        break
                                    case 'geo_cities':
                                        geo_city_elem.html(data.list).trigger('refresh');
                                        break
                                }
                            }
                        }
        });
    }
    // GetLocation end here.

    // saveNewJob = function(){
    //     console.log(' saveNewJob ');
    //     event.preventDefault();
    // }


    profileVideoShow =  function(video_url){
        console.log(' showVideoModal ', video_url);
        var videoElem  = '<video id="player" controls>';
        videoElem     += '<source src="'+video_url+'" type="video/mp4">';
        videoElem     += '</video>';
        $('#videoShowModal .videoBox').html(videoElem);
        $('#videoShowModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
        });
       //  const player = new Plyr('#player');
    }

}


$(function () {
    CommonScript = new CommonScript();

});

$(document).ready(function(){

    //====================================================================================================================================//
        // Initlize Datepicker
    //====================================================================================================================================//
    $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });

    // Save New job button click //
    /////////////////////////////////////////////////////////////////
    $('.saveNewJob').on('click',function() {

        event.preventDefault();
        var formData = $('.new_job_form').serializeArray();
        $('.saveNewJob').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
        console.log(' formData ', formData);
        $('.general_error').html('');
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/job/new',
            data: formData,
            success: function(data){
                console.log(' data ', data);
                $('.saveNewJob').html('Save').prop('disabled',false);
                if( data.status == 1 ){
                    // that.hideMainEditor();
                    $('.add_new_job').html(data.message);
                }else{
                    $('.general_error').html('<p>Error Creating new job</p>').removeClass('to_hide').addClass('to_show');
                    if(data.validator != undefined){
                        const keys = Object.keys(data.validator);
                        for (const key of keys) {
                            if($('#'+key+'_error').length > 0){
                                $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(data.validator[key][0]);
                            }
                        }
                    }
                   if(data.error != undefined){
                     $('.general_error').append(data.error);
                   }
                   setTimeout(() => { $('.general_error').removeClass('to_show').addClass('to_hide').text(''); },3000);
                }

            }
        });
    })



    //====================================================================================================================================//
    // Function to like user.
    //====================================================================================================================================//

    $(document).on('click','.jsLikeUserBtn',function(){
        var btn = $(this);
        var jobseeker_id = $(this).data('jsid');
        console.log(' jsLikeUserBtn jobseeker_id ', jobseeker_id);
        // $(this).html(getLoader('blockJobSeekerLoader'));
        $(this).html('..');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/likeJobSeeker/'+jobseeker_id,
            success: function(data){
                btn.prop('disabled',false);
                if( data.status == 1 ){
                    btn.html('Liked');
                    btn.addClass('active');
                    // $('.jobSeeker_row.js_'+jobseeker_id).remove();
                }else{
                    btn.html('error');
                }
            }
        });
    });


    // ========== Function to show popup when click on jobApplyBtn ==========//

    $('#jobApplyModal').on($.modal.OPEN, function(event, modal) {
        var job_id = $('#openModalJobId').val();
        console.log(' job_id ', job_id);
        console.log(' after open ', event);
        $('.jquery-modal.blocker.current').off('click');
        $.ajax({
        type: 'GET',
            url: base_url+'/ajax/jobApplyInfo/'+job_id,
            success: function(data){
                $('#jobApplyModal .cont').html(data);
            }
        });
    });

    $(document).on('click','.jobApplyBtn', function(){
        var job_id = $(this).attr('data-jobid');
        $('#openModalJobId').val(job_id);
        $('#jobApplyModal .cont').html(getLoader('css_loader loader_edit_popup'));
        $('#jobApplyModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5
        });
    });


    //========== jobApplyBtn clck end. ==========

    // ========== Function to submit job application ==========//

    $(document).on('click','.submitApplication',function(){
        event.preventDefault();
        console.log(' submitApplication submit click ');
        $('.submitApplication').html(getLoader('jobSubmitBtn')).prop('disabled',true);
        var applyFormData = $('#job_apply_form').serializeArray()
        $.ajax({
        type: 'POST',
            url: base_url+'/ajax/jobApplySubmit',
            data: applyFormData,
            success: function(data){
                $('.submitApplication').html('Submit').prop('disabled',false);
                console.log(' data ', data );
                if (data.status == 1){
                     $('#job_apply_form').html(data.message);
                }else {
                     $('#job_apply_form').html(data.error);
                }
            }
        });
    });

    //========== jobSubmitApplyBtn clck end. ==========


    $(document).on('keyup','textarea[name="application_description"]',function(){
         console.log(' application_description changed ');
         var application_description = $.trim($('textarea[name="application_description"]').val());
         $('.characterCount .count').text(application_description.length);
         if(application_description.length < 250){
            $('.submitApplication').prop('disabled', true);
            $('.characterCount').removeClass('hide_it');
         }else{
            $('.submitApplication').prop('disabled', false);
            $('.characterCount').addClass('hide_it');
         }

         console.log(' application_description ', application_description);
    });

//====================================================================================================================================//
// Function to display sub qualification on base of qualification type.
//====================================================================================================================================//

$(document).on('change','select.filter_qualification_type', function() {
    var degreeType =  $(this).val();
     if (degreeType != ''){ degreeType = (degreeType == 'trade')?'trade':'degree';}
     $(this).closest('.searchField_qualification').attr('class','searchField_qualification '+degreeType);
     $('.dot_list li').removeClass('active');
     $('.searchField_qualification .dot_list_li_hidden').remove();
});
$(document).on('click','.dot_list li', function(){
    console.log(' dot_list li click ');
    if($(this).hasClass('active')){
        $(this).removeClass('active');
        $(this).find('.dot_list_li_hidden').remove();
    }else{
        $(this).addClass('active');
        var type = $(this).attr('data-type');
        var qualif_value = $(this).attr('data-id');
        var input_hidden_html = '<input type="hidden" class="dot_list_li_hidden" name="'+type+'" value="'+qualif_value+'" />';
        $(this).append(input_hidden_html);
    }

});


//====================================================================================================================================//
// Function to display Industry experience list.
//====================================================================================================================================//

$('input[name="filter_industry_status"]').change(function() {
    console.log(' filter_industry_status ');
    (this.checked)?(jQuery('.filter_industryList').removeClass('hide_it')):(jQuery('.filter_industryList').addClass('hide_it'));
});


});


    $('body').on('click', '.wrapper', function(e){
        if($(e.target).is('.wrapper')){
            // signInClose();
            forgotPassClose();
        }
    })

 // ========== Function to show Block popup when click on ==========//
 $(document).ready(function(){
 $(document).on('click','.jsBlockUserBtn',function(){
    var jobseeker_id = $(this).data('jsid');
    console.log('jsBlockUserBtn click jobseeker_id = ', jobseeker_id);
    console.log('Block user in employer list', jobseeker_id);
    $('.apiMessageForBlockingEmp').css("display","none");
    $('.img_chat').show();


    $('.double_btn').show();


    // $('.confirmJobSeekerBlockModal .img_chat').remove(data.message);

     // $('.img_chat').show();
     $('#jobSeekerBlockId').val(jobseeker_id);
     $('#confirmJobSeekerBlockModal').modal({
        fadeDuration: 200,
        fadeDelay: 2.5,
        escapeClose: false,
        clickClose: false,
    });
 });

 // ========== Block Employer Ajax call  ==========//
 $(document).on('click','.confirm_JobSeekerBlock_ok',function(){
    console.log(' confirm_JobSeekerBlock_ok ');
    var jobseeker_id = $('#jobSeekerBlockId').val();

    $('#confirmJobSeekerBlockModal .showError').html(getLoader('blockJobSeekerLoader')).show();
    var btn = $(this); //
    btn.prop('disabled',true);
    $('.img_chat').hide();

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/blockEmployer/'+jobseeker_id,
        success: function(data){
            btn.prop('disabled',false);
            if( data.status == 1 ){
                $('.showError').addClass('apiMessageForBlockingEmp').css("display","block");
                $('.apiMessageForBlockingEmp').html(data.message);
                $('.jobSeeker_row.js_'+jobseeker_id).remove();
                $('.blockJobSeekerLoader').hide();

                $('.double_btn').hide();





            }else{
                $('#confirmJobSeekerBlockModal .img_chat').html(data.error);
            }
        }
    });
});
});
