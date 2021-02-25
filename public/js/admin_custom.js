function getLoader(cl,isHide,isWhite){
    cl=cl||'';
    isHide&&cl+' hidden';
    var spinner_html = `<div class="spinner center">
    <div class="spinner-blade"></div>
    <div class="spinner-blade"></div>
    <div class="spinner-blade"></div>
    <div class="spinner-blade"></div>
    <div class="spinner-blade"></div>
    <div class="spinner-blade"></div>
    <div class="spinner-blade"></div>
    <div class="spinner-blade"></div>
    <div class="spinner-blade"></div>
    <div class="spinner-blade"></div>
    <div class="spinner-blade"></div>
    <div class="spinner-blade"></div>
    </div>`;
    var $loader = $("<div>").html(spinner_html).addClass(cl).removeAttr('id');

    isWhite&&$loader.find('.spinner').addClass('spinnerw');
    var key='loader_'+cl;

    return $loader;
}

$(document).ready(function() {
    $(".alert-autoclose").fadeTo(5000, 500).slideUp(500, function() {
        $(".alert-autoclose").slideUp(500);
    });
});

// Job Deleting Code
// $(document).on('click', '#itemdel', function() {
// 	var jobdelid = parseInt($(this).attr('data-id'));

// 	var jobtitle = $(this).attr('data-title');
// 	$('#deleteConfirm').val(jobdelid);
// 	$('#deleteModal').modal('show');
// 	$('#delConfirmId').html(jobtitle);
// });

	// Job Deleting ajax
   // $('#removejob').on('click', function() {
   // 	var delid = $('#deleteConfirm').val();
   // 	console.log("Jobs Delete"+delid);

   // 	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
   //  $.ajax({
   //      type: 'POST',
   //      url: 'jobs/delete/' + delid,
   //      data: {delid},
   //      beforeSend: function(){
   //         $(".modelProcessing").show();
   //         $(".modalContent p").hide();
   //         $("#removejob").prop("disabled", true);
   //      },
   //      success: function(data) {
   //      	console.log(' data ', data);
   //          if(data.status === 1 )
   //           $('#deleteModal').modal('hide');
   //           $(".modelProcessing").hide();
   //           $(".modalContent p").show();
   //           $("#removejob").prop("disabled", false);
   //          jQuery('#dataTable').DataTable().ajax.reload();
   //      }
   //  });

   //  });

	// Job Deleting ajax end

// User Deleting Code

$(document).on('click', '#userdel', function() {
  var userdelid = parseInt($(this).attr('user-id'));
  var usertitle = $(this).attr('user-title');
  $('#deleteConfirmUser').val(userdelid);
  $('#deleteModaluser').modal('show');
  $('#delConfirmIdUser').html(usertitle);

});

  // Ajax for deleting User
$('#removeuser').on('click', function() {
    var deliduser = $('#deleteConfirmUser').val();
    console.log("User Delete"+deliduser);

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url:  'delete/' + deliduser,
        data: {deliduser},
        beforeSend: function(){
           $(".modelProcessingUser").show();
           $(".modalContentUser p").hide();
           $("#removeuser").prop("disabled", true);
        },
        success: function(data) {
          console.log(' data ', data);
            if(data.status === 1 )
             $('#deleteModaluser').modal('hide');
           $(".modelProcessingUser").hide();
           $(".modalContentUser p").show();
             $("#removeuser").prop("disabled", false);
            jQuery('#dataTable').DataTable().ajax.reload();
        }
    });
});


// JavaScript For Next and Previous Tab

 $('.btnNext').click(function(){
  $('.nav-tabs > .active').next('li').find('a').trigger('click');
});

$('.btnPrevious').click(function(){
  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});




 // Handle click on "Select all" control
 $('#cbx_all').on('click', function(event){
   var checked_status = this.checked;
   console.log(' checked_status ', checked_status, this );
    // Check/uncheck all checkboxes in the table
    // var rows =  jQuery('#dataTable').DataTable().rows().nodes();

    $.each($("input[name='cbx[]'"), function(){
       $(this).prop('checked', checked_status);

    });
    // event.preventDefault();
 });

 $('#cxx_all').on('click', function(event){
    var checked_status = this.checked;
    console.log(' checked_status ', checked_status, this );
     // Check/uncheck all checkboxes in the table
     // var rows =  jQuery('#dataTable').DataTable().rows().nodes();
     $.each($("input[name='cxx']"), function(){
        $(this).prop('checked', checked_status);

     });

     $.each($("input[name='cyx']"), function(){
        $(this).prop('checked', false);

     });

     $.each($("input[name='czx']"), function(){
        $(this).prop('checked', false);

     });
     // event.preventDefault();
  });

  $('#cyx_all').on('click', function(event){
    var checked_status = this.checked;
    console.log(' checked_status ', checked_status, this );
     // Check/uncheck all checkboxes in the table
     // var rows =  jQuery('#dataTable').DataTable().rows().nodes();
     $.each($("input[name='cxx']"), function(){
        $(this).prop('checked', false);

     });

     $.each($("input[name='cyx']"), function(){
        $(this).prop('checked', checked_status);

     });

     $.each($("input[name='czx']"), function(){
        $(this).prop('checked', false);

     });
     // event.preventDefault();
  });

  $('#czx_all').on('click', function(event){
    var checked_status = this.checked;
    console.log(' checked_status ', checked_status, this );
     // Check/uncheck all checkboxes in the table
     // var rows =  jQuery('#dataTable').DataTable().rows().nodes();
     $.each($("input[name='cxx']"), function(){
        $(this).prop('checked', false);

     });

     $.each($("input[name='cyx']"), function(){
        $(this).prop('checked', false);

     });

     $.each($("input[name='czx']"), function(){
        $(this).prop('checked', checked_status);

     });
     // event.preventDefault();
  });


$('input[type="checkbox"]').on('change', function() {
    $(this).siblings('input[type="checkbox"]').prop('checked', false);
 });

$(document).on("click",'input[type="checkbox"]', function() {
    $(this).siblings('input[type="checkbox"]').prop('checked', false);
});


 // Handle click on checkbox to set state of "Select all" control
 $('.cbxDataTable tbody').on('change', 'input[type="checkbox"]', function(event){
    console.log(' dataTable tbody ');
    // If checkbox is not checked
    if(!this.checked){
       var el = $('#cbx_all').get(0);
       // If "Select all" control is checked and has 'indeterminate' property
       if(el && el.checked){el.checked=false;}
    }
     // event.preventDefault();
 });





// =============================================== iteration-8 Interview Booking in job_applications page ===============================================

$('.interviewTemplate').on('change',function() {
  event.preventDefault();
  var formData = $('.interviewTemplate').serializeArray();
  // $('.interviewLoader').html(getLoader('pp_profile_edit_main_loader interviewTemplateLoader')).prop('disabled',true);
  console.log(' formData ', formData);
    $('.general_error1').html('');
//     $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

      $.ajax({
          type: 'POST',
          url: base_url+'/ajax/interview/template',
          data: formData,
            success: function(data){
                // console.log(' data ', data);
                // $('.interviewTemplateLoader').addClass('hide_it');
              $('.interviewLoader').prop('disabled',false);
                $('.templateData').html(data);
            }
      });
});

    // ============================================ Conduct Interview ============================================

    $(document).on("click" , ".conductInterview123" , function(){
        var inttTempId = $(this).attr('data-tempId');
        console.log(inttTempId);
        var user_id = $('.jsId').val();
        console.log(user_id);
        $('.conductInterview123').html(getLoader('pp_profile_edit_main_loader conductInterviewLoader')).prop('disabled',true);
        $('.general_error1').html('');
        $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/conduct/interview',
            data: {inttTempId,user_id},
            success: function(response){
                if(response.status == 1){
                    
                    var message = response.message;
                    $('.recordalreadExist').removeClass('d-none').text(message);
                    $('.conductInterviewLoader').addClass('d-none');
                    $('.interviewTemplateLoader').addClass('d-none');
                    $('.conductInterview123').html('Interview Conducted').prop('disabled',false);
                    setTimeout(function(){
                    $('.recordalreadExist').addClass('d-none'); },
                    3000);  
                    location.reload();

                    // window.location.href = "{{ route('intetviewInvitationEmp')}}" ;

                }
                else{

                    var message = response.message;
                    // var abc = response.messge
                    $('.recordalreadExist').removeClass('d-none').text(message);
                    $('.interviewTemplateLoader').addClass('d-none');
                    $('.conductInterview123').html('Error Occured').prop('disabled',false);
                    setTimeout(function(){
                    $('.recordalreadExist').addClass('d-none'); },
                    3000);

                }
                

            }
        });

    });





    // ============================================ Live Interview button ============================================

    $(document).on('click' , '.liveInterviewButton', function (){
        $('.answersInput').removeClass('d-none');
        $('.liveInterview').removeClass('d-none'); 
        $('.liveInterviewButton').addClass('d-none'); 
        $('.conductInterview123').addClass('d-none');
    });

    // ============================================ Live Interview ============================================
    

    $(document).on("click" , ".liveInterview" , function(){
        var formData = $('.interviewTemplateSave').serializeArray();
        $('.liveInterview').html(getLoader('pp_profile_edit_main_loader liveInterviewTemplateLoader')).prop('disabled',true);
        console.log(' formData ', formData);
        // return;
        $('.general_error1').html('');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'POST',
                url: base_url+'/ajax/live/interview',
                data: formData,
                success: function(response){
                if(response.status == 1){
                    var message = response.message;
                    // console.log(message);
                    $('.liveInterviewError').removeClass('d-none').text(message);
                    $('.conductInterviewLoader').addClass('d-none');
                    $('.liveInterviewTemplateLoader').addClass('d-none');
                    $('.liveInterview').html('Interview Saved').prop('disabled',false);
                    location.reload();
                    setTimeout(function(){
                    $('.liveInterviewError').addClass('d-none'); },
                    3000);  
                    // window.location.href = "{{ route('intetviewInvitationEmp')}}" ;
                }
                else{
                    var message = response.message;
                    $('.liveInterviewError').removeClass('d-none').text(message);
                    $('.liveInterviewTemplateLoader').addClass('d-none');
                    $('.liveInterview').html('Live Interview').prop('disabled',false);
                    setTimeout(function(){
                    $('.liveInterviewError').addClass('d-none'); },
                    3000);

                }
            }
            });



    });


