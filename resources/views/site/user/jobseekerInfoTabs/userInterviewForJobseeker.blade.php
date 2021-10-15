{{-- @if ($UserInterview->count() > 0) --}}
{{--   
<div class="job_heading p10 mb10"> <b> {{$jobSeeker->name}} </b> has given below interview </div>
--}}
{{--   
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
</div> --}}
{{-- 
<div>
--}}
<div class="row">
   @if ($UserInterview->count() > 0)
   <div class="job_heading p10 mb10"> <b> {{$jobSeeker->name}} </b> has given below interview </div>
   @foreach ($UserInterview as $userInt)
   <div class="col-sm-12 col-md-6">
      <div class="job-box-info concigerge-box clearfix">
         <div class="box-head">
            <h4><b>Interview {{$loop->index+1}}:</b> <span> Employer: <b>{{$userInt->employer->company}}</b> </span></h4>
         </div>
         <p class="slot-para">Your slot for interview is with below timetable.</p>
         <ul class="job-box-text concigerge clearfix">
            <li class="text-info-detail clearfix">
               <label>Type:</label>
               <span>{{$userInt->template->type}}</span>
            </li>
            <li class="text-info-detail clearfix">
               <label>Template:</label>
               <span>{{$userInt->template->template_name}}</span>
            </li>
         </ul>
         <div class="dual-tags testing-tag clearfix">
            @if ($userInt->status == 'Interview Confirmed' )
            <a  class="proceed-test used-tag seeEmployerResponse">See Candidate Response</a>
            @php
            $temp_id = $userInt->temp_id;
            $emp_id = $userInt->employer->id;
            $tempQuestions = App\InterviewTempQuestion::where('temp_id', $temp_id)->get();
            @endphp
            @endif 
            {{--    
            <div class="employerResponse hide">
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
               @endforeach
               @endif
            </div>
            --}}
            <span class="pendinginterview-tag used-tag">{{$userInt->status}}</span>
         </div>
      </div>
   </div>
   @endforeach  
   @else
   <p> <b>{{$jobSeeker->name}}</b> has not given any interview yet.</p>
   @endif  
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