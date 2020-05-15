var CProfile = function() {

    var $this=this;
    var pp_profile_edit_main=$jq('#pp_profile_main_editor');
    // var $userProfileEditPopup=$('#pp_profile_main_editor').modalPopup({shClass: ''});
    var userProfileEditPopup;
    var hideErrortListner = false;

    /* Edit looking for */
    /* Edit main */
    this.showMainEditor = function(){
        this.userProfileEditPopup = $('#pp_profile_main_editor').modalPopup({shClass: ''});
        this.userProfileEditPopup.open();

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

    this.showNewActivity    = function(activity_type){  $('.add_new_activity').addClass('visible_it'); }
    this.cancelNewActivity  = function(){ event.preventDefault();  $('.add_new_activity').removeClass('visible_it'); }
    this.saveNewActivity    = function(activity_type){
        event.preventDefault();
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

                    }
                }
            });
        }
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

            $('.list_videos_public').append(video_item);
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
                    $('#v_'+item_id+' .v_title').text(res.data.title);
                    $('#v_'+item_id+' .video_link').attr('href', base_url+'/'+res.data.file);
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

}


$(function () {
    UProfile = new CProfile();
});



$(document).ready(function() {
    $('#personalInfoModalBtn').on('click', function() {
        $('#personalInfoModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5
        });

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
                        if (typeof attr !== typeof undefined && attr !== false) {
                            if($('#'+attr+'_error').length > 0){
                                $('#'+attr+'_error').removeClass('to_show').addClass('to_hide').text('');
                            }
                        }
                    });

                }
            });
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
                            $('.photo_item_'+item_id).find('a').css('opacity', '1');
                            $('.photo_item_'+item_id).find('img').attr('src',resp.image);
                            $('.photo_item_'+item_id).find('.uploadingImage').remove();
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


    // $(document).on('click','.removeAttachBtn', function(){
    //     console.log(' removeAttachBtn click  ');
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
