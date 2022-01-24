
$(document).ready(function(){

    // ========================================= Hide interview =========================================
    
    $('.statusOfInterview').on('change',function() {
        event.preventDefault();
        var formData = $(this).serializeArray();
        var interview_id = $(this).closest('.statusOfInterview').find('.interview_id').val();
        console.log(' formData ', formData);
        $('.general_error1').html('');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/userInterview/hide/js',
            data: formData,
            success: function(response){
                console.log(' response ', response);
                if( response.status == 1 ){
                  $('.interviewBookingsRow_'+interview_id).remove();
                }else{
                    alert('Error Occured');
                }
            }
        });
    });


    // ========================================= unhide interview =========================================
   
    $('.statusOfInterviewHidden').on('change',function() {
        event.preventDefault();
        var formData = $(this).serializeArray();
        var interview_id = $(this).closest('.statusOfInterviewHidden').find('.interview_id').val();
        console.log(' formData ', formData);
        $('.general_error1').html('');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/userInterview/unhide',
            data: formData,
            success: function(response){
                if( response.status == 1 ){
                    $('.interviewBookingsRow_'+interview_id).remove();
                }else{
                }
            }
        });
    });
   
    // ========================================= unhide Interview detail responding to interview =========================================

    this.acceptInterviewButton = function(){
        // $('.interviewBookingsRow').removeClass('d-none');
        // $('.acceptDiv').addClass('d-none');

        // console.log(rejectUrl);
        var rejectUrl = $('#interviewUrl').val();
        var interview_id = $('#interviewId').val();
        console.log(rejectUrl , interview_id);
        $('.general_error1').html('');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/accept/interview/invitation',
             data:{url:rejectUrl},
            success: function(data){
                console.log(' data ', data);
                $('.rejectButton').html('Rejected').prop('disabled',false);
                if( data.status == 1 ){ 
                    $('.acceptInterviewDiv_'+interview_id).html('<a href = "http://talenttube.org/interview-invitation/'+rejectUrl+'" class="blue_btn px-2 py-1"> Click Here to Respond to this interview </a>')
                    $('.intStatus_'+interview_id).text('Accepted');
                    $('.errorsInFields').text('Interview rejected successfully');
                    setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                    // window.location.href = "{{ route('intetviewInvitation')}}" ;
                    window.location.href = base_url+'/interview-invitation/'+ rejectUrl;

                }else{
                   setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
                }

            }
        });

    }  

    // ========================================= reject interview invitation =========================================

    this.rejectInterviewInvitation = function(){
        // console.log(rejectUrl);
        var rejectUrl = $('#interviewUrl').val();
        var interview_id = $('#interviewId').val();
        console.log(rejectUrl , interview_id);
        $('.general_error1').html('');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/reject/interview/invitation',
             data:{url:rejectUrl},
            success: function(data){
                console.log(' data ', data);
                $('.rejectButton').html('Rejected').prop('disabled',false);
                if( data.status == 1 ){ 
                    $('.intStatus_'+interview_id).text('Rejected');
                    $('.errorsInFields').text('Interview rejected successfully');
                    setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                    // window.location.href = "{{ route('intetviewInvitation')}}" ;
                }else{
                   setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
                }

            }
        });
    }

    // ========================================= unhide Interview detail end here =========================================

    this.showEmployerVideoIntro= function(video_url){
        console.log(' =============== hassan here ================ ', video_url);
        var videoElem  = '<video id="player" style="width: -webkit-fill-available;" controls>';
        videoElem     += '<source src="'+video_url+'" type="video/mp4">';
        videoElem     += '</video>';
        $('#employerVideoIntroModal .videoBox').html(videoElem);

    }

    // ========================================= save js's response of interview =========================================

    /*this.saveResponseAsJs = function($url){
        console.log('button clicked beautifully');
        event.preventDefault();
        var formData = $('.saveInterviewResponse').serializeArray();
        // $('.saveResponseAsJobseeker').html(getLoader('pp_profile_edit_main_loader responseLoader')).prop('disabled',true);
        $('.general_error1').html('');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/confirmInterInvitation/js',
            data:formData,
            success: function(response){
                console.log(' response ', response);
                $('.saveResponseAsJobseeker').html('Response Saved').prop('disabled',false);
                if( response.status == 1 ){
                    $('.errorsInFields').text('Response addedd successfully');
                    location.href = base_url + '/intetview-invitations';
                    setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                    // window.location.href = "{{ route('intetviewInvitation')}}" ;
                }
                else{
                    $('.saveResponseAsJobseeker').html('Save Response');
                    setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
                    $('.errorsInFields').text(response.error);
                }
            }
        });
    }*/

    this.acceptInterviewFun = function(interview_url, interview_id){
        console.log(interview_url, interview_id);
        $('#interviewUrl').val(interview_url);
        $('#interviewId').val(interview_id);

    }

    // =========================================================================================
    // Employer (Interview Concierge) 
    // =========================================================================================
    
    // ============================================= Common Date Picker =============================================

    jQuery('.datepicker').datepicker({
        // minDate: +1, // this will disable today date and previous date
        minDate: 0, 
        dateFormat: "dd-mm-yy", minDate: 0, 
    });


    $('input.timepicker').timepicker({
        // closeOnWindowScroll: true,
        scrollbar: true
    });







}); 