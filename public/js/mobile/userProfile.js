var CProfile = function() {

    var $this=this;
    var pp_profile_edit_main=$('#pp_profile_main_editor');
    // var $userProfileEditPopup=$('#pp_profile_main_editor').modalPopup({shClass: ''});
    var userProfileEditPopup;
    var hideErrortListner = false;


    this.confirmPhotoDelete = function(gallery_id){
        console.log(' confirmPhotoDelete ', gallery_id);
        $('#confirmDeleteModal').modal('show');
        $('#deleteConfirmId').val(gallery_id);
    }

    




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
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
               url: base_url+'/m/ajax/uploadUserGallery',
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

    this.deleteGallery = function(){
        var gallery_id =  $('#deleteConfirmId').val();
        $('#confirmDeleteModal').modal('hide')
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/deleteGallery/'+gallery_id,
            success: function(data){
                if(data.status == 1){
                $('.profile_photo_frame.gallery_'+gallery_id).remove();
                }
            }
        });
    }
    this.setPrivateAccess = function(gallery_id){
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/setGalleryPrivateAccess/'+gallery_id,
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


    this.confirmPurchase = function(user_id){
        $('#confirmPurchaseModal').modal('show');
        $('#user_id').val(user_id);
    }

    this.deleteAttachment = function(){
        $.modal.close();
        var attachment_id = $('#deleteAttachmentId').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type:'GET',
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
    this.purchase = function(){
        $('#confirmPurchaseModal').modal('hide');
        var user_id = $('#user_id').val();
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type:'GET',
            url: base_url+'/m/ajax/purchaseUserInfo/',
            data: {user_id: user_id},
            success: function(data){
                console.log(' data ', data);
                if(data.status == 1){
                    location.reload();
                }

                if(data.status == 2){
                    $('#lowPointsModal').modal('show');
                }
            }
        });
    }

    this.setAsProfile = function(gallery_id){
        var bl_pic = $('.bl_pic .pic .profile_pic_one').html();
       // $('.avatar').html('<div class="profile_pic_one profile_pic_spinner to_show"><i class="fa fa-spinner fa-spin"></i></div>');
        console.log(' setAsProfile ', gallery_id);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/setImageAsProfile/'+gallery_id,
            success: function(res){
                console.log(' res ', res);
                if(res.status == 1){
                    // $('.attachment_file.attachment_'+attachment_id).remove();
                    var data = res.data;
                    var pp_html =  '<img class="rounded-circle img-fluid" src="'+data.large+'">';
                    $('.avatarimg').html(pp_html);
                }
            }
        });
    }







};


$(function () {
    UProfile = new CProfile();
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
