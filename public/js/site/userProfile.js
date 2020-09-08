var CProfile = function() {

    var $this=this;
    var pp_profile_edit_main=$jq('#pp_profile_main_editor');
    // var $userProfileEditPopup=$('#pp_profile_main_editor').modalPopup({shClass: ''});
    var userProfileEditPopup;
    var hideErrortListner = false;

    /* Edit looking for */
    /* Edit main */
    this.showMainEditor = function(){ 
        console.log(' showMainEditor '); 

        this.userProfileEditPopup = $('#pp_profile_main_editor').modalPopup({shClass: ''});
        this.userProfileEditPopup.open();
        this.initlizeLocationMap();

         console.log(' showMainEditor ', this.userProfileEditPopup); 

        if(!this.hideErrortListner){
            this.hideErrortListner = true;
            $('input,select',pp_profile_edit_main).on('change', this.hideElementError );
            var that = this;
            $('.pp_body').on('click', function(e){
                console.log('pp_body click ');
                if(e.target == this && that.userProfileEditPopup.is(':visible')) {
                    $('.icon_close', this.userProfileEditPopup).click()
                    console.log(' hideMainEditor  ');
                    that.hideMainEditor();
                }
            });
        }
    }

    this.hideMainEditor = function(){
        console.log(' hide  userProfileEditPopup ', this.userProfileEditPopup);
        this.userProfileEditPopup.close();
    }

    this.hideElementError = function(){
        console.log(' event ', this);
        var elem = $(this);
        var attr = $(this).attr('name');
        if (typeof attr !== typeof undefined && attr !== false) {
            if($('#'+attr+'_error').length > 0){
                $('#'+attr+'_error').removeClass('to_show').addClass('to_hide').text('');
            }
        }
    }

    this.GetLocation = function(type){
        console.log(' GetStateList ');
        // $('.geo', pp_profile_edit_main_frm).change(function() {
        //     console.log(' geo chagne ');
        // var type=$(this).data('location');
        var pp_profile_edit_main_frm=$('#frm_profile_edit_main', pp_profile_edit_main)
        pp_profile_edit_main_country=$('#country', pp_profile_edit_main_frm),
        pp_profile_edit_main_state=$('#state', pp_profile_edit_main_frm),
        pp_profile_edit_main_city=$('#city', pp_profile_edit_main_frm);
        // console.log(' pp_profile_edit_main_country.value ', pp_profile_edit_main_country.val());

        $.ajax({
            type: 'POST',
                url: base_url+'/ajax/'+type,
                data: { cmd:type,
                        select_id: (type === 'geo_states')? pp_profile_edit_main_country.val() : pp_profile_edit_main_state.val(),
                        filter:'1',
                        list: 0},
                        beforeSend: function(){
                            $jq('.geo, #city', pp_profile_edit_main_frm).prop('disabled', true).trigger('refresh');
                            // preloader
                        },
                        success: function(data){
                            $jq('.geo, #city', pp_profile_edit_main_frm).prop('disabled', false).trigger('refresh');
                            $this.disabledProfileEditMain(false);
                            if (data.status) {
                                console.log(i18n.site);
                                var option='<option value="0">'+i18n.site.choose_a_city+'</option>';
                                switch (type) {
                                    case 'geo_states':
                                        pp_profile_edit_main_state.html(data.list).trigger('refresh');
                                        pp_profile_edit_main_city.html(option).trigger('refresh');
                                        break
                                    case 'geo_cities':
                                        $jq('#city').html(data.list).trigger('refresh');
                                        break
                                }
                            }
                        }
        });
    }



   this.refreshSelectBirthdayEditMain =  function (){
       var pp_profile_edit_main_day = $('#profile_edit_main_day');
       pp_profile_edit_main_day.trigger('refresh');
    }

    this.saveProfile =  function (){
        console.log(' saveProfile ');
        var frm_profile_edit_main = $('#frm_profile_edit_main').serializeArray();
        console.log(' frm_profile_edit_main ', frm_profile_edit_main);
        this.disabledProfileEditMain(true);
        var that = this;
        $.ajax({
            type: 'POST',
            url: base_url+'/saveUserProfile',
            data: frm_profile_edit_main,
            success: function(data){
                console.log(' data ', data);
                console.log('  this ', this);
                console.log('  that ', that);
                $this.disabledProfileEditMain(false);
                if( data.status ){
                    that.hideMainEditor();
                    $('ul.list_info.userProfileLocation').replaceWith(data.html_location);
                }else{
                    if(data.validator != undefined){
                        const keys = Object.keys(data.validator);
                        for (const key of keys) {
                            if($('#'+key+'_error').length > 0){
                                $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(data.validator[key][0]);
                            }
                        }
                    }
                   if(data.error != undefined){
                     $('#general_error').removeClass('to_hide').addClass('to_show').text(data.error);
                     setTimeout(() => {
                        $('#general_error').removeClass('to_show').addClass('to_hide').text('');
                     }, 3000);
                   }
                }
            }
        });
    }


   this.disabledProfileEditMain = function(is){
        var   pp_profile_edit_main_frm=$('#frm_profile_edit_main', pp_profile_edit_main),
         pp_profile_edit_main_btn_save= $('.frm_editor_save', pp_profile_edit_main),
         pp_profile_edit_main_btn_cancel=$('.frm_editor_cancel', pp_profile_edit_main);

        if(is){
            pp_profile_edit_main_btn_save.html(getLoader('pp_profile_edit_main_loader')).prop('disabled',is);
        }else{
            pp_profile_edit_main_btn_save.html('Save').prop('disabled', is);
        }
        $('input', pp_profile_edit_main_frm).prop('disabled',is)
        $('select.select_main', pp_profile_edit_main_frm).prop('disabled',is).each(function(){
            $(this).trigger('refresh')//;  - тормозит сильно из-за этого, вроде не кретично
        });
        pp_profile_edit_main_btn_cancel.prop('disabled',is);
    }




    this.updateStatusText = function(){
        var statusText = $('#statusText').val();
        $('.statusText').removeClass('hide_it').text(statusText);
        $('#statusText').addClass('hide_it');
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/changeUserStatusText',
            data: {'status': statusText},
            success: function(data){
            }
        });
    }
    
    this.enableStatusTextEdit = function(){
        $('.statusText').addClass('hide_it');
        $('#statusText').removeClass('hide_it');
    }


    this.updateRecentJob = function(){
        var recentJobField = $('.recentJobField').val();
        $('.recentJobValue').removeClass('hide_it').text(recentJobField);
        $('.recentJobField').addClass('hide_it');
        $('.recentJobEdit').after(getLoader('smallSpinner recentJobSpinner'));
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/updateRecentJob',
            data: {'recentjob': recentJobField},
            success: function(data){
                if(data.status){
                    $('.recentJobSpinner').remove();
                }
            }
        });
    }

    this.enableRecentJobEdit = function(){
        $('.recentJobValue').addClass('hide_it');
        $('.recentJobField').removeClass('hide_it');
    }



 

// ======================== Edit Salary Range ========================

        this.updateSalaryRange = function(){
        var salaryRangeField = $('#salaryRangeFieldnew option:selected').val();
        // var salaryRangeField = this.val
        // console.log(salaryRangeField);
        $('.salaryRangeValue').removeClass('hide_it').text(salaryRangeField);
        $('#salaryRangeFieldnew').addClass('hide_it');
        

           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/updateSalaryRange',
            data: {'salaryRange': salaryRangeField},
            success: function(data){
                if(data.status){
                    $('.salaryRangeSpinner').remove();
                    $('.salaryRangeField').addClass('hide_it');
                }
            }
        });
 }

    this.enableSalaryRangeEdit = function(){
        $('.salaryRangeValue').addClass('hide_it');
        $('.salaryRangeField').removeClass('hide_it');
        // var  abc = $('');
        // console.log(abc);
    }

// ======================== Edit Salary Range End Here ======================== 

// ======================== Edit Qualification ======================== 

    this.updateQualifications = function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var qualification = jQuery('.userQualification').map(function(){ return $(this).val()}).get(); 

        $('.SaveQualification').after(getLoader('smallSpinner SaveQualificationSpinner'));

        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/updateQualification',
            data: {'qualification': qualification},
            success: function(resp){
                if(resp.status){
                    $('.SaveQualificationSpinner').remove();
                    $('.jobSeekerQualificationList').html(resp.data);
                    $('.qualificationBox').removeClass('editQualif'); 
                    $('.QualifAlert').show().delay(3000).fadeOut('slow');
                    $('.userQualification').hide();
                    $('.removeQualification').hide();
                }
            }
        });
}


// ======================== End Qualification end here ======================== 

// ======================== Edit Industry Experience ========================

this.updateIndustryExperience = function(){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var industry_experience = jQuery('.industry_experience').map(function(){ return $(this).val()}).get(); 
         $('.SaveindustryExperience').after(getLoader('smallSpinner SaveIndustrySpinner'));
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/updateIndustryExperience',
            data: {'industry_experience': industry_experience},
            success: function(resp){
                if(resp.status){
                    $('.IndusListBox').removeClass('edit'); 
                    $('.IndusAlert').show().delay(3000).fadeOut('slow');
                    $('.SaveIndustrySpinner').remove(); 
                    $('.IndusList').html(resp.data); 

                    }
            }
    });
 }

// ======================== Edit Industry Experience End Here ======================== 

//  ======================================= Edit User Questions Start =======================================

    this.updateQuestions = function(){
        var items = {}; 
        $('select.jobSeekerRegQuestion').each(function(index,el){  
        // console.log(index, $(el).attr('name')  , $(el).val()   );  
            // items.push({name:  $(el).attr('name') , value: $(el).val()});
            var elem_name = $(el).attr('name'); 
            var elem_val = $(el).val(); 
            items[elem_name] = elem_val; 
            // items.push({elem_name : elem_val });
        });
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.SaveQuestionsLoader').after(getLoader('smallSpinner SaveQuestionsSpinner'));
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/updateQuestions',
            data: {'questions': items},
            
            success: function(data){
                    $('.questionsAlert').show().delay(3000).fadeOut('slow');
                    $('.saveQuestionsButton').hide(); 
                    $('.jobSeekerRegQuestion').addClass('hide_it');
                    $('.QuestionsKeyPTag').removeClass('hide_it');
                    if(data){
                        // $(".questionsOfUser").load(" .questionsOfUser");
                        $(".SaveQuestionsSpinner").remove();
                       
                }
            }
        });
    }

//  ======================================= Edit User Questions End  =======================================


//  ======================================= Edit Employer Questions Start =======================================

    this.updateEmployerQuestions = function(){
        var items = {}; 
        $('select.EmployerRegQuestion').each(function(index,el){  
        // console.log(index, $(el).attr('name')  , $(el).val()   );  
            // items.push({name:  $(el).attr('name') , value: $(el).val()});
            var elem_name = $(el).attr('name'); 
            var elem_val = $(el).val(); 
            items[elem_name] = elem_val; 
            // items.push({elem_name : elem_val });
        });
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.SaveEmployerQuestionsLoader').after(getLoader('smallSpinner SaveEmployerQuestionsSpinner'));
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/updateEmployerQuestions',
            data: {'questions': items},
            
            success: function(resp){
                    // $('.EmployerQuestionsAlert').removeClass('hide_it').delay(3000).fadeOut('slow');
                    $('.hide_it2').show().delay(3000).fadeOut('slow');

                    $('.saveEmployerQuestionsButton').hide(); 
                    $('.EmployerRegQuestion').addClass('hide_it');
                    $('.employerQuestionsPtag').removeClass('hide_it');

                    if(resp.status){
                        $(".SaveEmployerQuestionsSpinner").remove();
                        $('.EmpQuestionList').html(); 
                        $(".employerRegisterQuestions").load(true);

                       
                }
            }


        });
    }

//  ======================================= Edit Employer Questions End  =======================================

    // this.showBasicFieldEditor = function(item){
    //     console.log(' showBasicFieldEditor ', item);
    // }

    this.showBasicFieldEditor = function(field){
        console.log(' showBasicFieldEditor ', field);
        var $editor=$jq('#basic_editor_'+field);
        if($editor.is('.to_show')) {
            $this.closeBasicFieldEditor(field);
            return;
        }
        var $field=$jq('#basic_editor_text_'+field);
        if($field.data('desc')==$field.val())$field.val('');
        // $this.cacheData[field+'_value']=$field.val();
        $field.addClass('active').prop('disabled',false).oneTransEnd(function(){
            $field.focus();
        }).addClass('focus');
        $editor.addClass('to_show');
    }

    this.closeBasicFieldEditor = function(field){
        var $field = $jq('#basic_editor_text_'+field);
        var val = $field.val();
        // $this.cacheData[field+'_value'];
        // if(!trim($field.val())&&$field.data('desc')){
        //     val=$field.data('desc');
        // }

        if ($field.val()) {
            $field.prop('disabled',false).removeClass('focus');
            $jq('#basic_editor_'+field).removeClass('to_show');
        }
        $jq('#basic_editor_save_'+field).prop('disabled', false);
        $jq('#basic_editor_cancel_'+field).text('cancel');
        $field.val(val).trigger('autosize');
    }


    this.saveBasicFieldEditor = function(field, uid){
        var uid = uid || 0;
        var value=$jq('#basic_editor_text_'+field).val();
        // $this.cacheData[field+'_old_value']=$this.cacheData[field+'_value'];
        // $this.cacheData[field+'_value']=value;
        var $loader=getLoader('loader_edit_field');
        $jq('#basic_anchor_'+field).after($loader);
        $this.closeBasicFieldEditor(field);
        var data={ajax: 1, name: field};
        var cmd = 'update_about_field';

        if(uid) {
            cmd = 'update_private_note';
            data['uid'] = uid;
            data['comment'] = trim(value);
        } else {
            data[field]=trim(value);
        }

        $.post(base_url+'/ajax/'+cmd,data,function(res){
            $loader.remove();
            console.log(' post response  ', res );
            if(res.status==1){ $jq('#basic_editor_text_'+field).val(res.data).trigger('autosize'); }
        });
    }

    this.confirmPhotoDelete = function(gallery_id){
        console.log(' confirmPhotoDelete ', gallery_id);
        $('#confirmDeleteModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
        });
        $('#deleteConfirmId').val(gallery_id);
    }

    this.cancelGalleryConfirm = function(){ $.modal.close(); }
    this.deleteGallery = function(){
        var gallery_id =  $('#deleteConfirmId').val();
        $.modal.close();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/deleteGallery/'+gallery_id,
            success: function(data){
                $('.profile_photo_frame.gallery_'+gallery_id).remove();
            }
        });
    }
    this.setPrivateAccess = function(gallery_id){
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/setGalleryPrivateAccess/'+gallery_id,
            success: function(data){
                if(data.status == 1){
                    var access_type = (data.access == 2)?'private':'public';
                    $('.item.profile_photo_frame.gallery_'+gallery_id).removeClass('private').addClass(access_type);
                }
            }
        });
    }

    this.confirmAttachmentDelete = function(attachment_id){
        $('#confirmDeleteAttachmentModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
        });
        $('#deleteAttachmentId').val(attachment_id);
    }

    this.deleteAttachment = function(){
        $.modal.close();
        var attachment_id = $('#deleteAttachmentId').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/removeAttachment/',
            data: {attachment_id: attachment_id},
            success: function(data){
                console.log(' data ', data);
                if(data.status == 1){
                    $('.attachment_file.attachment_'+attachment_id).remove();
                }
            }
        });
    }

    this.setAsProfile = function(gallery_id){
        var bl_pic = $('.bl_pic .pic .profile_pic_one').html();
        $('.bl_pic .pic').html('<div class="profile_pic_one profile_pic_spinner to_show"><i class="fa fa-spinner fa-spin"></i></div>');
        console.log(' setAsProfile ', gallery_id);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/setImageAsProfile/'+gallery_id,
            success: function(res){
                console.log(' res ', res);
                if(res.status == 1){
                    // $('.attachment_file.attachment_'+attachment_id).remove();
                    var data = res.data;
                    var pp_html =  '<a class="show_photo_gallery" href="'+data.large+'" data-lcl-thumb="'+data.small+'">';
                        pp_html +=  '<img class="photo" id="pic_main_img" src="'+data.large+'">';
                        pp_html += '</a>';
                        $('.bl_pic .pic').html(pp_html);
                }
            }
        });
    }

    this.showNewActivity    = function(activity_type){
        $('.add_new_activity').addClass('visible_it');
        $('.add_new_activity input[name="title"]').val('');
        $('.add_new_activity textarea').val('');

    }
    this.cancelNewActivity  = function(){ event.preventDefault();  $('.add_new_activity').removeClass('visible_it'); }
    this.saveNewActivity    = function(activity_type){
        event.preventDefault();
        var thisClass = this;
        if(activity_type === 'academic'){
            console.log(' addNewActivity ', activity_type);
            var activity_form = $('.new_activity_form').serialize();
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'POST',
                url: base_url+'/ajax/saveNewActivity',
                data: activity_form,
                success: function(res){
                    console.log(' res ', res);
                    if(res.validator != undefined){
                        const keys = Object.keys(res.validator);
                        for (const key of keys) {
                            if($('.act_validation #'+key+'_error').length > 0){
                                $('.act_validation #'+key+'_error').removeClass('to_hide').addClass('to_show').text(res.validator[key][0]);
                            }
                        }
                    }else if(res.status == 1){
                        $('.activity_list').append(res.activity_html);
                        thisClass.cancelNewActivity();
                    }
                }
            });
        }
    }
    this.removeActivity = function(type, activity_id){
        console.log(' removeActivity ', activity_id);
        $('.activity.activity_'+activity_id+' .act_action').remove();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/removeActivity',
            data: {id: activity_id, type: type},
            success: function(res){
                console.log(' res ', res);
                if(res.status == 1){
                    $('.activity.activity_'+activity_id).remove();
                }
            }
        });
    }

    // video upload option
    this.SelectVideoFile = function(){
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
            // video_item  +=   '<img src="'+base_url+'/images/site/icons/cv.png" style="opacity: 1; display: inline;" title="vvtt11" class="photo" id="video_v_1" data-video-id="v_1">';
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

    }
    // video upload end here.


    this.delteVideo = function(video_id){
        console.log(' delteVideo  ', video_id);
        $('#confirmDeleteVideoModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
        });
        $('#deleteVideoConfirmId').val(video_id);
    }

    this.deleteVideoConfirm = function(){
        $.modal.close();
        var video_id = $('#deleteVideoConfirmId').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/deleteVideo',
            data: {video_id: video_id},
            success: function(data){
                console.log(' data ', data);
                if(data.status == 1){
                    $('#v_'+video_id).remove();
                }
            }
        });
    }



    this.showVideoModal = function(video_url){
							
							
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
								

								$('#videoShowModal').on($.modal.CLOSE, function(event, modal) {
									$(this).find(".videoBox video").remove();
							});
      
    }



    this.initlizeLocationMap = function(){

    
            var input = document.getElementById('location_search');
            var autocomplete = new google.maps.places.Autocomplete(input);
            // var service = new google.maps.places.AutocompleteService();
            var geocoder = new google.maps.Geocoder();
            var hasLocation = false;
            var user_lat  = (jQuery('#location_lat').val() != '')?(jQuery('#location_lat').val()):'-31.2532183'; 
            var user_long = (jQuery('#location_long').val() != '')?(jQuery('#location_long').val()):'146.921099'; 
 
            var latlng = new google.maps.LatLng(user_lat,user_long);
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
                // console.log(' reverseGeocode ', location); 
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
            var location_search = jQuery('#location_search').val(); 
            geocode(location_search); 
            console.log(' location_search ', location_search); 

    
    }

}


$(function () {
    UProfile = new CProfile();
});



$(document).ready(function() {

    if($('#personalInfoModal').length > 0){
        $('#personalInfoModal').on($.modal.OPEN, function(event, modal) {
            console.log(' after open ');
            $.ajax({
            type: 'GET',
                url: base_url+'/ajax/getUserPersonalInfo',
                success: function(data){
                    $('#pp_profile_personal_editor .cont').html(data);
                    $('#frm_profile_edit_personal input, #frm_profile_edit_personal select').on('change', function(){
                        var elem = $(this);
                        var attr = $(this).attr('name');
                        attr =  attr.replace("[]", "");
                        if (typeof attr !== typeof undefined && attr !== false) {
                            if($('#'+attr+'_error').length > 0){
                                $('#'+attr+'_error').removeClass('to_show').addClass('to_hide').text('');
                            }
                        }
                    });

                }
            });
        });
    }


    $('#personalInfoModalBtn').on('click', function() {
        $('#personalInfoModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5
        });
    });


    $(document).on('click','.frm_editor_cancel', function(){
        event.preventDefault();
        $.modal.close();
    });

    // submit personal profile form.
    $(document).on('click','.frm_editor_save', function(){
        event.preventDefault();
        $('.ppform_save_loader').removeClass('hide_it');
        var ppform =  $('#frm_profile_edit_personal').serialize();
        var that = this;
        $.ajax({
            type: 'POST',
            url: base_url+'/saveUserPersonalSetting',
            data: ppform,
            success: function(data){
                console.log(' success data ', data);
                $('.ppform_save_loader').addClass('hide_it');
                if( data.status ){
                    $.modal.close();
                    $('#personal_items').replaceWith(data.html);
                }else{
                    if(data.validator != undefined){
                        const keys = Object.keys(data.validator);
                        for (const key of keys) {
                            if($('#'+key+'_error').length > 0){
                                $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(data.validator[key][0]);
                            }
                        }
                    }
                   if(data.error != undefined){
                     $('#general_error').removeClass('to_hide').addClass('to_show').text(data.error);
                     setTimeout(() => {
                        $('#general_error').removeClass('to_show').addClass('to_hide').text('');
                     }, 3000);
                   }
                }
            }
        });
    });


    // tab script
     $('.customTab li.switch_tab a').on('click',function(){
         console.log(' tab switch click  ');
         var tab = $(this);
         var tabId = $(this).attr('href');
         $('.tabs_content .tab_link.target').removeClass('target');
         $('.tabs_content a'+tabId).addClass('target');

         $('.tab .switch_tab.selected').removeClass('selected');
         $(this).parent().addClass('selected');
     });


     $('.uploadProgressModalBtn').on('click', function() {
            var input = document.createElement('input');
			input.type = 'file';
			input.onchange = e => {
				var file = e.target.files[0];
				console.log(' onchange file  ', file );
                var formData = new FormData();
                formData.append('file',file);
                var that = this;
               var item_id =  Math.floor((Math.random() * 1000) + 1);
            var gallery_item = '<div class="item profile_photo_frame photo_item_'+item_id+'" id="'+item_id+'">';
                gallery_item += '<a class="show_photo_gallery" style="opacity:0;">';
                gallery_item += '<img data-photo-id="'+item_id+'" class="photo" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"\>';
                gallery_item += '</a>';
                gallery_item += '<div class="uploadingImage">';
                gallery_item += '<span>FileName: '+file.name+'</span>';
                gallery_item += '<span>FileSize: '+file.size+'</span>';
                gallery_item += '<span>FileType: '+file.type+'</span>';
                gallery_item += '</div>';
                gallery_item += '</div>';
                $('.list_photos_trans').append(gallery_item);
			    $.ajax({
			       url: base_url+'/ajax/uploadUserGallery',
			       type : 'POST',
			       data : formData,
			       processData: false,  // tell jQuery not to process the data
			       contentType: false,  // tell jQuery not to set contentType
			       success : function(resp) {
			           console.log('upload_chat_front resp ', resp);
			          if(resp.status == 1){
                            $('.photo_item_'+item_id).replaceWith(resp.html);
                            // $('.photo_item_'+item_id).find('img').attr('src',resp.image);
                            // $('.photo_item_'+item_id).find('.uploadingImage').remove();
					  }
			       }
			    });
			}
            input.click();
    });

    if($('.show_photo_gallery').length > 0){
        lc_lightbox('.show_photo_gallery', {
            wrap_class: 'lcl_fade_oc',
            gallery : true,
            thumb_attr: 'data-lcl-thumb',
            mousewheel: false,
            fullscreen: false,

            socials: false,
            skin: 'dark',
            radius: 0,
            padding	: 0,
            border_w: 0,
        });
    }


    $('.submit-document').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('submit', true);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type:'POST',
            url: '/ajax/userUploadResume',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $('.save-resume-btn').html('Saving... <i class="fa fa-spinner fa-spin"></i>');
            },
            success:function(data){
                $('.save-resume-btn').html('Save');
                console.log("success data ", data);
                if(data && data.attachments) {
                    // data = JSON.parse(data);
                    // $('.view-resume').attr('href', '/talenttube/_files/resumeUpload/'+data['attachment']).show();
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

                    $('.private_attachments').html(attach_html);


                }
                console.log(data);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));


   

    // var vloop = null;
    // var num = 0; 
    // $('.item.item_video').on('mouseenter', function(){
    //     console.log(' mouseover '); 
    //     var video_thumb = $(this).find('img'); 
    //      vloop = setInterval(function() {
    //         // loop - one, two, trÃ­
    //          console.log(' change video image  ', num); 
    //         if(num == 3) {
    //             num = 1;
    //         } else {
    //             num++;
    //         }
            
    //         console.log(' video_thumb ', video_thumb); 

    //         video_thumb.attr('src', video_thumb.attr('data-thumb'+num));
    //         // set the image source on the element
    //         // $this.attr("src", imgSrc.replace(/(\d\.jpg|\w*\.jpg)$/, +num + '.jpg'));

    //     }, 500);


    // }).on('mouseleave',function(){
    //     console.log(' mouseout >>  '); 
    //     clearInterval(vloop);
    // });


 





});

























// Profile.setTabs('#tabs-1');


// $(location.hash).addClass('target');

// $('.submit-document').on('submit',(function(e) {
//     e.preventDefault();
//     var formData = new FormData(this);
//     formData.append('submit', true);
//     $.ajax({
//         type:'POST',
//         url: '/talenttube/resume.php',
//         data:formData,
//         cache:false,
//         contentType: false,
//         processData: false,
//         beforeSend:function(){
//             $('.save-resume-btn').html('Saving... <i class="fa fa-spinner fa-spin"></i>');
//         },
//         success:function(data){
//             $('.save-resume-btn').html('Save');
//             console.log("success");
//             if(data) {
//                 data = JSON.parse(data);
//                 $('.view-resume').attr('href', '/talenttube/_files/resumeUpload/'+data['attachment']).show();
//             }
//             console.log(data);
//         },
//         error: function(data){
//             console.log("error");
//             console.log(data);
//         }
//     });
// }));

// getResume();

// let user_id = '26';
// let login_user_id = '26';

// if(user_id !== login_user_id) {
//     $('#frm_upload').remove();
// }

// let isPaidUser = '1';
// console.log(isPaidUser);
// if(isPaidUser != '1') {
//     $('.list_interest_c').remove();
// }

// function getResume(){
//     $.ajax({
//         type:'GET',
//         data:{action:'get_resume', user_id:'26'},
//         url: '/talenttube/resume.php',
//         success:function(data){
//             if(data) {
//                 data = JSON.parse(data);
//                 $('.view-resume').attr('href', '/talenttube/_files/resumeUpload/'+data['attachment']).show();
//             }
//             console.log(data);
//         },
//         error: function(data){
//             console.log("error");
//             console.log(data);
//         }
//     });
// }
