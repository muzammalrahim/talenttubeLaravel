$(document).ready(function(){

    this.showFieldEditor = function(field){
        // console.log('.save'+field+'button');
        if (field == 'question') {
            console.log('Questions are here');
            $('.QuestionsKeyPTag').toggleClass('d-none');
            $('.questionSelect').toggleClass('d-none');

        }
        else{
            $('.sec_'+field).removeAttr('readonly');
            $('.sec_'+field).focus();
            $('.sec_'+field).removeClass('bg-white border-0 d-none');
            $('.text_'+field).addClass('d-none');
        }

        $('.button_'+field).removeClass('d-none');


    }

    this.hideFieldEditor = function(field){
        console.log('.save'+field+'button');

        if (field == 'question') {
            console.log('Questions are here');
            $('.QuestionsKeyPTag').toggleClass('d-none');
            $('.questionSelect').toggleClass('d-none');

        }

        $('.sec_'+field).attr('readonly', 'true');
        $('.sec_'+field).blur();
        $('.sec_'+field).addClass('bg-white border-0 d-none');
        $('.button_'+field).addClass('d-none');
        $('.text_'+field).removeClass('d-none');

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
                    $('.sec_'+field).attr('readonly', 'true');
                    $('.sec_'+field).blur();
                    $('.sec_'+field).addClass('bg-white border-0 d-none');
                    $('.button_'+field).addClass('d-none');
                    $('.alert_'+field).show().delay(3000).fadeOut('slow');
                    $('.text_'+field).removeClass('d-none');
                    $('.text_'+field).text(val);

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
        var recentJobField = $('#recentJobInput').val();
        var organHeldTitleField  = $('.organHeldTitleField').val();
        console.log(recentJobField);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/update/recentJob',
            data: {'recentjob': recentJobField, 'organHeldTitle':organHeldTitleField},
            success: function(data){
                if(data.status == 1){
                    $('.organizationSpan').text(data.organHeldTitle);
                    $('.recentjobSpan').text(data.recentjob);
                    // $('.recentjob').removeClass('d-none');
                    // $('.sec_recentJob').addClass('d-none');
                    // $('.button_recentJob').addClass('d-none');
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
       $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/updateSalaryRange',
            data: {'salaryRange': salaryRangeField},
            success: function(data){
                if(data.status){
                    $('.salaryRangeValue').text(data.data);
                    // $('.salaryRangeFieldnew').addClass('d-none');
                    $('.alert_salayRange').show().delay(3000).fadeOut('slow');

                    // $('.button_salaryRange').addClass('d-none');
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
                    attach_html += '<span class="attach_title">'+attachments.name+'</span>';
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
            url: App_url+'/ajax/removeAttachment/',
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


    this.showVideoModalFunction = function(video_url,video_title=null){

        console.log(' showVideoModal ', video_url);
        var videoElem  = '<video id="player" class ="w-100" controls>';
        videoElem     += '<source src="'+video_url+'" type="video/mp4">';
        videoElem     += '</video>';
        $('#videoShowModal .videoBox').html(videoElem);
        // $('#videoTitle').text(video_title);

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

    // ====================================== send reference from jobseeker's profile ======================================

    this.sendReferrenceNotification = function(){

        console.log('clicked send Notification for crossReference');    
    // $('.sendNotification').on('click',function() {
        event.preventDefault();
        var formData = $('.crossReference').serializeArray();
        // $('.sendNotification').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
        console.log(' formData ', formData);
        $('.general_error1').html('');
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/crossReference/sendEmailReferee',
            data: formData,
            success: function(response){
                console.log(' data ', data);
                $('.sendNotification').html('Send Email').prop('disabled',false);
                if( response.status == 1 ){
                    // $('.errorsInFields').text('Notification sent sucessfully');
                    setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                    swal("Good job!", "Email sent successfully!", "success");

                }else{

                      var errorss =  response.validator;
                           var nameError = errorss['name'];
                           var emailError = errorss['email'];
                           var mobileError = errorss['mobile'];
                           
                           // Name Error 
                           if(nameError) {
                                var nameError2 = nameError.toString();
                                $('.errorsInFields').text(nameError2);
                            }       
                           // Email Error 
                           if(emailError){
                               var emailError2 = emailError.toString();
                               $('.errorsInFields').text(emailError2);
                            }
                            // Email Error 
                           if(mobileError){
                           var mobileError2 = mobileError.toString();
                           $('.errorsInFields').text(mobileError2);
                           }

                    // $('.errorsInFields').text('Error occured');
                   setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
                }

            }
        });
    // });

    }


    // ====================================== Update user's profile right side bar fiels ======================================

    this.editMultipleFields = function(){

        // alert('Hi How are you');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'GET',
            url: base_url+'/ajax/editMultipleFields',
            success: function(data){
                $('.multiFields').html(data);
            }
        });

        


        // $('.recentJobField').removeClass('d-none');
        // $('.organHeldTitleField').removeClass('d-none');
        // $('.recentjobSpan').addClass('d-none');
        // $('.organizationSpan').addClass('d-none');
        // $('.location_search_cont').removeClass('hide_it');

        



        // $('#salaryRangeFieldnew').removeClass('d-none');
        // $('.salaryRangeValue').addClass('d-none');
        // $('.recentjob').addClass('d-none');
        // $('.sec_recentJob').removeClass('d-none');

    }

    // ====================================== update jobseeker's questions ======================================

    this.updateUserQuestions = function(fiels){
        var items = {};
        $('select.jobSeekerRegQuestion').each(function(index,el){
        // console.log(index, $(el).attr('name')  , $(el).val()   );
            // items.push({name:  $(el).attr('name') , value: $(el).val()});
            var elem_name = $(el).attr('name');
            var elem_val = $(el).val();
            items[elem_name] = elem_val;
            // items.push({elem_name : elem_val });
        });

        // console.log(items); return;
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // $('.SaveQuestionsLoader').after(getLoader('smallSpinner SaveQuestionsSpinner'));
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/updateQuestions',
            data: {'questions': items},

            success: function(data){
                $('.QuestionsKeyPTag').removeClass('d-none');
                $('.questionSelect').addClass('d-none');
                $('.alert_'+fiels).show().delay(3000).fadeOut('slow');
                    if(data.status==1){
                        // $(".questionsOfUser").load(" .questionsOfUser");
                        // $(".SaveQuestionsSpinner").remove();
                        $('.questionsOfUser').html(data.data);

                }
            }
        });
    }

    // ====================================== Delete Job Application ======================================

    this.deleteJobApp = function(jobApp_id){
        // console.log(' confirmJobAppRemoval click  job_id ', jobApp_id, $(this) );
        $('#deleteConfirmJobAppId').val(jobApp_id);
    }

    this.confirmDeleteJobApp = function(){

        // $('.deleteJobAppLoader').removeClass('d-none');
        // $('.modalBody').addClass('d-none');

        var job_app_id = $('#deleteConfirmJobAppId').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/deleteJobApplication/'+job_app_id,
            success: function(data){
                $('.jobAppDeleteModal').removeClass('showLoader').addClass('showMessage');
                if( data.status == 1 ){
                    $('.jobAppDeleteModal .apiMessage').html(data.message);
                    $('.jobApp_'+job_app_id).remove();
                }else{
                    $('.jobAppDeleteModal .apiMessage').html(data.error);
                }
            }
        });
    }


    // ============================================ Like user (jobseeker info page)

    // $(document).on('click', '.like-btn', function(){

    this.likeFunction = function(jobseeker_id){
        console.log( ' Like User button profile.js new file' );
        $(this).html('Liked');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/likeJobSeeker/'+jobseeker_id,
            success: function(res){
                if( res.status == 1 ){
                    var html = '<button class="unlike-btn" onclick="unlikefunction('+jobseeker_id+')" data-toggle="modal" data-target="#unlikeModal"><i class="fas fa-thumbs-up"> </i> UnLike</button>';
                    $('.js_'+jobseeker_id+' .like-div').html(html);
                    $('.js_'+jobseeker_id+' .like-div').removeClass('like-div').addClass('unlike-div');
                    
                }else{
                    // btn.html('error');
                }
            }
        });
    }

    // })


    // =============================================== unlike user ===============================================

    this.unlikefunction = function(jobseeker_id){
        console.log('jsBlockUserBtn click jobseeker_id = ', jobseeker_id);
        $('#jobSeekerBlockId').val(jobseeker_id);
    }

    this.unlikeConfirm = function(){
        console.log('unlike button new');
        // $('#jobSeekerBlockId').val(jobseeker_id);
        var jobseeker_id = $('#jobSeekerBlockId').val();
        var btn = $(this); 
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/unLikeUser',
            data: {id: jobseeker_id},
            success: function(data){
                if( data.status == 1 ){
                  var html = '<button class="like-btn" onclick="likeFunction('+jobseeker_id+')" data-jsid = "'+jobseeker_id+'}}"><i class="fas fa-thumbs-up"></i> Like</button>';
                  $('.js_'+jobseeker_id+' .unlike-div').html(html);
                  $('.js_'+jobseeker_id+' .unlike-div').removeClass('unlike-div').addClass('like-div');
                  $('.removeJs_'+jobseeker_id).remove();

                }else{
                  $('.jobSeekerBlockId .apiMessage').html(data.error);
                }
            }
        });

    }

    // ============================================ block functions ============================================

    this.blockFunction = function(jobseeker_id){
        console.log('jobseeker block 13-01-2021 ', jobseeker_id);
        // $('#jobSeekerBlockId').val(jobseeker_id);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/blockJobSeeker/'+jobseeker_id,
            success: function(data){
                // btn.prop('disabled',false);
                if( data.status == 1 ){
                    var html = '<a onclick="unblockUser('+jobseeker_id+')"><button class="unblock-btn" data-toggle="modal" data-target="#unBlockModal"><i class="fas fa-ban"></i> UnBlock</button></a>';
                    $('.js_'+jobseeker_id+' .block-div' ).html(html);
                }else{
                    // $('#confirmJobSeekerBlockModal .img_chat').html(data.error);
                }
            }
        });

        
    }


    // =============================================== unblock user ===============================================

    this.unblockUser = function(jobseeker_id){
        $('#jobSeekerBlockId').val(jobseeker_id);

    }

    this.confirmUnBlockUser = function(){
        // console.log(' 14-01-2021 ');
        var jobseeker_id = $('#jobSeekerBlockId').val();
        $('.confirmJobSeekerBlockModal').addClass('showLoader');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/unBlockUser',
            data: {id: jobseeker_id},
            success: function(data){
                if( data.status == 1 ){
                    var html = '<a onclick="blockFunction('+jobseeker_id+')"><button class="unblock-btn" data-toggle="modal" data-target="#blockModal"><i class="fas fa-ban"></i> Block</button></a>';
                    $('.js_'+jobseeker_id+' .block-div' ).html(html);
                    $('.removeJs_'+jobseeker_id).remove();

                }else{
                    $('.confirmJobSeekerBlockModal .apiMessage').html(data.error);
                }
            }
        });
    // });
    }


    // ============================================ block functions(Employer) ============================================

    this.blockEmployerFunction = function(jobseeker_id){
        console.log('jobseeker block 13-01-2021 ', jobseeker_id);
        // $('#jobSeekerBlockId').val(jobseeker_id);

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/blockEmployer/'+jobseeker_id,
            success: function(data){
                // btn.prop('disabled',false);
                if( data.status == 1 ){
                    var html = '<a onclick="unblockEmployer('+jobseeker_id+')"><button class="unblock-btn" data-toggle="modal" data-target="#unblockUserModal"><i class="fas fa-ban"></i> UnBlock</button></a>';
                    $('.js_'+jobseeker_id+' .block-div' ).html(html);
                }else{
                    // $('#confirmJobSeekerBlockModal .img_chat').html(data.error);
                }
            }
        });

        
    }

    this.unblockEmployer = function(jobseeker_id){
        $('#jobSeekerBlockId').val(jobseeker_id);
    }

    this.confirmUnBlockEmployer = function(){
        var jobseeker_id = $('#jobSeekerBlockId').val();
        console.log(jobseeker_id);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/unBlockUser/',
            data: {id: jobseeker_id},
            success: function(data){
                // btn.prop('disabled',false);
                if( data.status == 1 ){
                    var html = '<a onclick="blockEmployerFunction('+jobseeker_id+')"><button class="unblock-btn"><i class="fas fa-ban"></i> Block</button></a>';
                    $('.js_'+jobseeker_id+' .block-div' ).html(html);
                    $('.remjs_'+jobseeker_id).remove();

                }else{
                    // $('#confirmJobSeekerBlockModal .img_chat').html(data.error);
                }
            }
        });
    }

    
    

    // =============================================== interview concierge delete function ===============================================

    this.interviewConciergeDelete = function(interviewConcierge_id){
        console.log('Interview concierge id = ', interviewConcierge_id);
        $('#deleteConfirmInterviewConcierge').val(interviewConcierge_id);
    }


    this.confirmDeleteInterviewConcierge = function(){
    // $('.confirmDeleteInterview').click(function(){
        var confirmDelete = $('#deleteConfirmInterviewConcierge').val();
        console.log(confirmDelete);
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
        type: 'POST',
        url: base_url+'/ajax/booking/deleteInterviewBooking',
        data:{id: confirmDelete},
        success: function(data){
          console.log(' data ', data);
          if( data.status == 1 ){
            $('.DeleteInterviewModal .apiMessage').html(data.message);
            $('.intBooking_'+confirmDelete).remove();
            
          }else{
            // $('#overlay').addClass('d-none');
                $('#DeleteInterviewModal').hide();


          }
        }
        });

    // });
    }






});