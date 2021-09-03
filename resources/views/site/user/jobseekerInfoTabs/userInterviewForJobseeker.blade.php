


<div class="newJobCont">

  @if ($UserInterview->count() > 0)
  <div class="job_heading p10 mb10"> <b> {{$jobSeeker->name}} </b> has given below interview </div>
  
  @foreach ($UserInterview as $userInt)
  <div class="job_row interviewBookingsRow_{{$userInt->id}}">
    <div class="job_heading p10">
      <div class="w_80p">
        <p class="qualifType"><b>Interview {{$loop->index+1}}:  </b> <span class="ml20"> Employer: <b>{{$userInt->employer->company}}</b> </span> </p>
      </div>
      <div class="fl_right">
          <div class="j_label bold">Status:</div>
          <div class="j_value text_capital">{{$userInt->status}}</div>
      </div>

      <div class="job_info employerResponseDiv row dblock">
        <p class="qualifType"><a><b>Type:</b> {{$userInt->template->type}}</a>  <b>Template:</b> {{$userInt->template->template_name}}  </p>

          @if ($userInt->status == 'Interview Confirmed' )
            <div class="j_button pb20">
               <a class="jobApplyBtn graybtn jbtn seeEmployerResponse">See Candidate's Response</a>
            </div>
            @php
              $temp_id = $userInt->temp_id;
              $emp_id = $userInt->employer->id;
              // dd($emp_id);
              $tempQuestions = App\InterviewTempQuestion::where('temp_id', $temp_id)->get();
            @endphp
            <div class="employerResponse hide"  >
              @foreach ($tempQuestions as $question)
                <p class="qualifType p0"> <b>Question {{$loop->index+1}})</b> {{$question->question}} </p>
                @php
                  $answers = App\UserInterviewAnswers::where('question_id', $question->id)->where('user_id', $jobSeeker->id)
                  ->where('emp_id', $emp_id)->where('userInterview_id', $userInt->id)->first();   
                @endphp

                @if ($question->video_response == 1)
                  <div class="video_div pointer"  onclick="showVideoModal12( '{{assetVideo_response($answers->answer)}}')"> 
                    <div id="v_123456"> <img src="https://img.icons8.com/color/48/000000/video.png"/></div>
                  </div>

                @else
                  <p class="qualifType p0 mb10"> <b>Candidate Response:</b> {{$answers->answer}} </p>
              @endif

                {{-- <p class="qualifType p0 mb10"> <b>Candidate's Response:</b> {{$answers->answer}} </p> --}}
              
              @endforeach
            </div>
          @endif
      </div>


    </div>
  </div>
@endforeach  
@else
      <p> <b>{{$jobSeeker->name}}</b> has not given any interview yet.</p>
@endif

<div class="cl"></div>
</div>


<div style="display:none;">
    <div id="videoShowModal" class="modal p0 videoShowModal">
        <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
            <div class="cont">
                <div class="videoBox"></div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
  
  this.showVideoModal12= function(video_url){

  console.log(' hassan here ', video_url);
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


</script>