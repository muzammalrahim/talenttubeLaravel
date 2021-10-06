$(document).ready(function(){

    this.showFieldEditor = function(field){
        console.log('.save'+field+'button');
        if (field == 'salaryRange') {
            $('#salaryRangeFieldnew').removeClass('d-none');
            $('.salaryRangeValue').addClass('d-none');
        }
        if (field =='recentJob') {
            $('.recentjob').addClass('d-none');
            $('.sec_recentJob').removeClass('d-none');
        }
        $('.sec_'+field).removeAttr('readonly');
        $('.sec_'+field).focus();
        $('.sec_'+field).removeClass('bg-white border-0');
        $('.button_'+field).removeClass('d-none');
    }

    this.hideFieldEditor = function(field){
        console.log('.save'+field+'button');
        $('.sec_'+field).attr('readonly', 'true');
        $('.sec_'+field).blur();
        $('.sec_'+field).addClass('bg-white border-0');
        $('.button_'+field).addClass('d-none');
        if (field == 'salaryRange') {
            $('.sec_salaryRange').removeClass('d-none');
            $('.newSalary').addClass('d-none');
        }
        if (field =='recentJob') {
            $('.recentjob').removeClass('d-none');
            $('.sec_recentJob').addClass('d-none');
        }
    }

    // ======================================== Update About me, Interested in and salary ========================================

    this.updateProfile = function(field){
        console.log(field);
        var val = $('.sec_'+field).val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type:'POST',
            url: base_url+'/ajax/update/'+field,
            data: {val:val,name:field},
            success: function(data){
                console.log(' data ', data);
                if(data.status == 1){
                    // $('.attachment_file.attachment_'+attachment_id).remove();
                    $('.sec_'+field).attr('readonly', 'true');
                    $('.sec_'+field).blur();
                    $('.sec_'+field).addClass('bg-white border-0');
                    $('.button_'+field).addClass('d-none');
                    $('.alert_'+field).show().delay(3000).fadeOut('slow');

                    if (field =='recentJob') {
                       $('.recentjob').removeClass('d-none');
                       $('.sec_recentJob').addClass('d-none');
                       // ('.alert_recentJob').show().delay(3000).fadeOut('slow');

                    }
                }
            }
        });
    }
    
    // ================================================ Update Recent Job ================================================

    this.updateRecentJob = function(){
        var recentJobField = $('.recentJobField').val();
        var organHeldTitleField  = $('.organHeldTitleField').val();
        // console.log(organHeldTitleField);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/update/recentJob',
            data: {'recentjob': recentJobField, 'organHeldTitle':organHeldTitleField},
            success: function(data){
                if(data.status == 1){
                    $('.organizationSpan').text(data.organHeldTitle);
                    $('.recentjobSpan').text(data.recentjob);
                    $('.recentjob').removeClass('d-none');
                    $('.sec_recentJob').addClass('d-none');
                    $('.button_recentJob').addClass('d-none');
                    $('.alert_recentJob').show().delay(3000).fadeOut('slow');


                }
            }
        });
    }

    // ================================================ Edit and delete qualification ================================================

    this.showQualificationEditor = function(){
        $(this).closest('.qualificationBox').addClass('editQualif');
        $('.removeQualification').removeClass('d-none');
        $('.button_qualification').removeClass('d-none');
    }

   $('.qualificationBox').on('click','.removeQualification', function(){
      console.log('removeQualification');
     $(this).closest('.QualificationSelect').remove();

   });


   // ================================================ Update Qualification ================================================

    this.updateQualification = function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var qualification = jQuery('.userQualification').map(function(){ return $(this).val()}).get();

        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/updateQualification',
            data: {'qualification': qualification},
            success: function(resp){
                if(resp.status){
                    $('.jobSeekerQualificationList').html(resp.data);
                    $('.qualificationBox').removeClass('editQualif');
                    $('.QualifAlert').show().delay(3000).fadeOut('slow');
                    $('.userQualification').hide();
                    $('.removeQualification').addClass('d-none');
                    $('.button_qualification').addClass('d-none');

                }
            }
        });
    }

    // ================================================ Update Industry Experience ================================================

    this.showIndustryExpEditor = function(){
        $(this).closest('.IndusListBox').addClass('edit');
        $('.removeIndustry').removeClass('d-none');
        $('.button_industryExperience').removeClass('d-none');
    }

    this.updateIndusExperience = function(){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var industry_experience = jQuery('.industry_experience').map(function(){ return $(this).val()}).get();
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/updateIndustryExperience',
            data: {'industry_experience': industry_experience},
            success: function(resp){

                if(resp.status){
                    $('.IndusListBox').removeClass('edit');
                    $('.IndusAlert').show().delay(3000).fadeOut('slow');
                    // $('.SaveIndustrySpinner').remove();
                    $('.IndusList').html(resp.data);
                    $('.button_industryExperience').addClass('d-none');

                }
            }
        });
     }


    // ================================================ Update Salary Range ================================================

     this.updateSalaryRangeValue = function(){
        var salaryRangeField = $('#salaryRangeFieldnew option:selected').val();
        $('#salaryRangeFieldnew').addClass('d-none');
       $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/updateSalaryRange',
            data: {'salaryRange': salaryRangeField},
            success: function(data){
                if(data.status){
                    $('.salaryRangeValue').removeClass('d-none').text(data.data);
                    $('.salaryRangeFieldnew').addClass('d-none');
                    $('.button_salaryRange').addClass('d-none');
                }
            }
        });
    }

    // ================================================ Update Location ================================================

    this.updateLocation = function(){
        console.log('location save button clicked');
        showMap();
        event.preventDefault();
        var formData = $('.location_latlong :input').serializeArray();
        console.log(' formData ', formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/addNewLocation',
            data: formData,
            success: function(data){
                console.log(' data ', data);
                $('.saveNewJob').html('Save').prop('disabled',false);
                if( data.status == 1 ){
                    // that.hideMainEditor();
                    $(".userLocationSpan").html(data.data);
                }else{
                }
            }
        });
    }

    // ================================================ Update Profile Picture ================================================


    this.setProfilePicture = function(gallery_id){
        var bl_pic = $('.profile-img-wrapper').html();
        // $('.bl_pic .pic').html('<div class="profile_pic_one profile_pic_spinner to_show"><i class="fa fa-spinner fa-spin"></i></div>');
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
                    // var pp_html =  '<a class="show_photo_gallery" href="'+data.large+'" data-lcl-thumb="'+data.small+'">';
                        var pp_html =  '<img class="profile_img" width="150" height="200" alt="profile" src="'+data.large+'">';
                        // pp_html += '</a>';
                        $('.profileimgContainer').html(pp_html);
                }
            }
        });
    }

    // ================================================ Upload Photo ================================================

    this.uploadPhoto = function(){

        // $('.uploadProgressModalBtn').on('click', function() {
            var input = document.createElement('input');
            input.type = 'file';
            input.onchange = e => {
                var file = e.target.files[0];
                console.log(' onchange file  ', file );
                var formData = new FormData();
                formData.append('file',file);
                var that = this;
               var item_id =  Math.floor((Math.random() * 1000) + 1);
            var gallery_item = '<div class="photo_item_'+item_id+'" id="'+item_id+'">';
                gallery_item += '<span class = "pip imgContainer_'+item_id+'"> ';
                // gallery_item += '<a class="show_photo_gallery" style="opacity:0;">';
                gallery_item += '<img data-photo-id="'+item_id+'" class="photo" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"\>';
                // gallery_item += '</a>';
                gallery_item += '</span>';
                gallery_item += '<div class="uploadingImage">';
                gallery_item += '<span>FileName: '+file.name+'</span>';
                gallery_item += '<span>FileSize: '+file.size+'</span>';
                gallery_item += '<span>FileType: '+file.type+'</span>';
                gallery_item += '</div>';
                gallery_item += '</div>';



                $('.uploaded-photo').append(gallery_item);
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
    // });

    }


    // ================================================ Delete photo ================================================


    this.deletePhotoPopUp = function(gallery_id){
        console.log(' confirmPhotoDelete ', gallery_id);
        $('#deleteConfirmId').val(gallery_id);
    }

    this.deletePhotConfirm = function(){
        var gallery_id =  $('#deleteConfirmId').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/deleteGallery/'+gallery_id,
            success: function(data){
                $('.imgContainer_'+gallery_id).remove();
                // $('#deletePhotModal').modal('toggle');
            }
        });
    }


    // ================================================ Private Access ================================================

    this.makePhotoPrivate = function(gallery_id){
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

    // ================================================ USer upload resume ================================================


    // this.userResumeUpload = function(){
        $('.submit-document').on('submit',(function(e) {
        console.log('User resume upload button');
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('submit', true);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type:'POST',
            url: base_url+'/ajax/userUploadResume',
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
                    var attachments = data.attachments;
                    console.log("Hassaan doing this job : " + attachments );
                    var attach_html = '';
                    attach_html += '<li class="attachment_'+attachments.id+' uploaded-file-resume">';
                    attach_html += '<span class="attach_title">Talent Tube Video Iteration bugs 11.08B (2) (1).docx</span>';
                    attach_html += '<div class="attach_btns">';
                    attach_html += '<a class="attach_btn downloadAttachBtn" href="'+data.file+'"><i class="fas fa-download"></i></a>';
                    attach_html += '<a class="attach_btn removeAttachBtn" data-attachmentid="'+attachments.id+'" data-toggle="modal" data-target="#deleteresumeModal" onclick="removeAttachmentModal('+attachments.id+');">X</a>';
                    attach_html += '</div>';
                    attach_html += '</li>';


                    $('.private_attachments').append(attach_html);

                }
                console.log(data);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));
    // }


    // ================================================ Delete Resume ================================================


    this.removeAttachmentModal = function(attachment_id){
        $('#deleteAttachmentId').val(attachment_id);
    }

    this.removeAttachmentConfirm = function(){
        var attachment_id = $('#deleteAttachmentId').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type:'GET',
            url: base_url+'/ajax/removeAttachment/',
            data: {attachment_id: attachment_id},
            success: function(data){
                console.log(' data ', data);
                if(data.status == 1){
                    $('.attachment_'+attachment_id).remove();
                }
            }
        });
    }


    // ======================================================= Upload Video =======================================================

    this.uploadVideoFunction = function(){
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

    // ====================================== Showing uploaded video ======================================


    this.showVideoModalFunction = function(video_url,$video_title=null){

        console.log(' showVideoModal ', video_url);
        var videoElem  = '<video id="player" class ="w-100" controls>';
        videoElem     += '<source src="'+video_url+'" type="video/mp4">';
        videoElem     += '</video>';
        $('#videoShowModal .videoBox').html(videoElem);
        $('#videoTitle').text(video_title);

    }


    // ====================================== Closing video Modal ======================================


    // ====================================== Delete Video video ======================================


    this.deleteVideoFun = function(video_id){
        console.log(' confirmPhotoDelete ', video_id);
        $('#deleteVideoId').val(video_id);
    }

    this.removeVideoConfirm = function(){

        var video_id = $('#deleteVideoId').val();
        console.log(video_id);
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











});