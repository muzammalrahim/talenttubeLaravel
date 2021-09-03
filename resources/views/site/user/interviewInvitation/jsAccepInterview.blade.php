




<div class="job_row acceptDiv interviewBookingsRow_{{$UserInterview->id}}">
  <div class="job_heading p10">
    <div class="w_80p"> <h3 class=" job_title"><a> <b>Invitation 1: </b> Inerview from {{$UserInterview->employer->company}}</a></h3> </div>
    <div class="fl_right">
      <div class="j_label bold">Status:</div>
      <div class="j_value text_capital"> {{$UserInterview->status}} </div>
    </div>
  </div>


  <div class="job_info row p10 dblock">
    <div class="IndustrySelect mb20">
      @if (isset($UserInterview->interview_type))
        <p class="p0 qualifType"> Interview Type: <b>  {{$UserInterview->interview_type}} </b> </p>
        @else
          @if ($UserInterview->template->type == 'phone_screeen')
            <p class="p0 qualifType"> Interview Type: <b> Phone Screen</b> </p>
          @else
            <p class="p0 qualifType"> Interview Type: <b> {{$UserInterview->template->type}} </b> </p>
          @endif
      @endif
    </div>

    <div class="actionButton">
        <button class="btn small leftMargin turquoise acceptButton" data_url = "{{$UserInterview->url}}">Accept</button>
        <button class="btn small leftMargin turquoise rejectButton ml20" data_url = "{{$UserInterview->url}}">Reject</button>
    </div>

    <p class="errorsInFields"></p>
  </div>

</div>


{{-- ===================================================== Accept hide show =====================================================  --}}


{{-- <form method="POST" name="saveInterviewResponse" class="saveInterviewResponse"> --}}

  <div class="job_row interviewBookingsRow hide_it">
    <div class="mb20"></div>
    <div class="job_heading p10">
      <div class="w_80p"> <h3 class=" job_title"><a> <b>Invitation 1: </b> Interview from {{$UserInterview->employer->name}}</a></h3> </div>
      <div class="fl_right"> <div class="j_label bold">Status:</div> <div class="j_value text_capital">{{$UserInterview->status}}</div> </div>
    </div>

    <div class="job_info row p10 dblock">
      <div class="timeTable">
        <div class="IndustrySelect">
          <p class="p0 qualifType"> Template Name: <b>  {{$UserInterview->template->template_name}} </b> </p>
          @if ($UserInterview->template->type == 'phone_screeen' )
            <p class="p0 qualifType"> Template Type: <b> Phone Screen</b> </p>
          @else
            <p class="p0 qualifType text_capital"> Template Type: <b> {{$UserInterview->template->type}} </b> </p>
            <p class="p0 qualifType"> Employer's Instructions: <b> {{$UserInterview->template->employers_instruction}} </b> </p>
          @endif
          <p class="p0 qualifType text_capital"> Interviewer Name: <b> {{$UserInterview->employer->company}} </b> </p>

          @if ($UserInterview->template->employer_video_intro)
            
            <div class="dflex">
                <div class="w20">
                  <p class="p0 qualifType text_capital"> Employer's Intro: </p>
                </div>
                <div class="w80">
                  <div class="video_div pointer"  onclick="showVideoModal12( '{{template_video($UserInterview->template->employer_video_intro)}}')"> 
                    <div id="v_123456"> <img src="https://img.icons8.com/color/48/000000/video.png"/></div>
                  </div>      
                </div>

            </div>

          @endif

        </div>
      </div>

      <div class="timeTable">
        <div class="IndustrySelect">
          <p class="p0 qualifType center bold"> Template Questions </p>
            {{-- @foreach ($InterviewTempQuestion as  $quest)
              <p class="p0 qualifType bold mt10" name = ""> <span> Question ({{$loop->index+1}}):   </span> {{$quest->question}} </p>
              @if ($quest->video_response == 1)

                  <div class="video_response"> 
                    <p> Upload video to answer this question </p> 

                    <form action="#" id ="dropzone_{{ $loop->index }}" class='dropzone'>
                      <input type="hidden" class="question_id" value="{{ $quest->id }}" name="question_id">
                      <input type="hidden" name="userInterviewId" class="userInterviewId" value="{{$UserInterview->id}}"> 
                      @csrf
                    </form>
                  </div>

                @else

                <input type="text" class="w100 mt10 jobseekersAnswer_{{ $loop->index }}" onchange="get_jobseekersAnswer({{ $loop->index }})" name="answer[{{$quest->id}}]">

              @endif
            @endforeach

            <input type="hidden" name="userInterviewId" value="{{$UserInterview->id}}"> --}}


            {{-- 2nd way of saving form data --}}

              <form method="POST" action="{{ route('save_jobSeeker_response_interview') }}" enctype="multipart/form-data" name="saveInterviewResponse" class="saveInterviewResponse">
                @csrf
                @foreach ($InterviewTempQuestion as  $quest)
                  <p class="p0 qualifType bold mt10" name = ""> <span> Question ({{$loop->index+1}}):   </span> {{$quest->question}} </p>
                  @if ($quest->video_response == 1)
                      <div class="video_response"> 
                        <p> Upload video to answer this question </p> 
                          <input type="file" class="question_id" name="answer[{{$quest->id}}][img]" accept="video/mp4,video/x-m4v,video/*">
                      </div>
                    @else
                    <input type="text" class="w100 mt10 jobseekersAnswer_{{ $loop->index }}" name="answer[{{$quest->id}}]">
                  @endif
                @endforeach

                <input type="hidden" name="userInterviewId" class="userInterviewId" value="{{$UserInterview->id}}"> 


                
                <p class="errorsInFields qualifType"></p>

                <div class="actionButton mt20">
                  <button class="jobApplyBtn graybtn jbtn" onclick="check_ansers()" >Save Reponse</button>
                </div>
              
              </form>

            {{-- 2nd way of saving form data end here --}}

            {{-- ==================================== For saving jobseekers all the answers in database ==================================== --}}

            {{-- <form method="POST" name="saveInterviewResponse" class="saveInterviewResponse">

              @foreach ($InterviewTempQuestion as $quest)
                
                <input type="hidden" class="vide_response_url_{{ $loop->index }}" data-question_id = "{{ $quest->id }}" name="answer[{{$quest->id}}]">

              @endforeach

              <input type="hidden" name="userInterviewId" class="userInterviewId" value="{{$UserInterview->id}}"> 

              <div class="actionButton mt20">
                <a class="jobApplyBtn graybtn jbtn" onclick="saveResponseAsJobseeker()" data_url = "{{$UserInterview->url}}" >Save Reponse</a>
              </div>
              <p class="errorsInFields qualifType"></p>
            
            </form> --}}
            
            {{-- ==================================== For saving jobseekers all the answers in database end here ==================================== --}}


        </div>
      </div>
      
    </div>
  </div>
{{-- </form> --}}



<script src="{{ asset('js/dropzone/dist/min/dropzone.min.js') }}"></script>

@include('site.user.interviewInvitation.video_responseJs')   

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js" ></script>
<script type="text/javascript">


$('.acceptButton').on('click',function() {
  event.preventDefault();
  var acceptUrl = $(this).attr('data_url');
  $('.interviewBookingsRow').removeClass('hide_it');
  $('.acceptDiv').addClass('hide_it');
});

$('.rejectButton').on('click',function() {
    event.preventDefault();
    // var formData = $('.crossReference').serializeArray();
    var rejectUrl = $(this).attr('data_url');
    $('.rejectButton').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
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
                $('.errorsInFields').text('Interview rejected successfully');
                setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                window.location.href = "{{ route('intetviewInvitation')}}" ;
            }else{
               setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
            }

        }
    });
});

// ======================================================= Save Response as jobseeker =======================================================

// $('.saveResponseAsJobseeker').on('click',function() {

this.saveResponseAsJobseeker = function($url){
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
}



// });



this.get_jobseekersAnswer = function(loop_index){
  // console.log(loop_index);
  var answer = $('.jobseekersAnswer_'+loop_index).val();
  // console.log(answer);
  $('.vide_response_url_'+loop_index).val(answer);

  // vide_response_url_
}



// this.check_ansers = function(){

//   var data = new FormData();

//   var response = $('.saveInterviewResponse').serializeArray();
  
  
//   $( ".saveInterviewResponse" ).validate({
//   rules: {
//       answer: {
//         required: true,
//         accept: "video/*"
//       }
//     }
//   });


// }

</script>


