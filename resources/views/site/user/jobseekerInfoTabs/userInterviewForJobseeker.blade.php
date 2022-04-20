
<div class="row">
   @if ($UserInterview->count() > 0)
   <div class="job_heading p10 mb10"> <b> {{$jobSeeker->name}} </b> has given below interview </div>
   @foreach ($UserInterview as $userInt)
   <div class="col-sm-12 col-md-6">
      <div class="job-box-info concigerge-box clearfix">
         <div class="box-head">
            <h4><b>Interview {{$loop->index+1}}:</b> <span> Employer: <b>{{$userInt->employer->company}}</b> </span></h4>
         </div>
         <p class="mx-3 mt-3 mb-0">Your slot for interview is with below timetable.</p>
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
             <a  class="proceed-test used-tag h-auto font-unset seeEmployerResponse float-none">See Candidate Response</a>
            @php
            $temp_id = $userInt->temp_id;
            $emp_id = $userInt->employer->id;
            $tempQuestions = App\InterviewTempQuestion::where('temp_id', $temp_id)->get();
            @endphp
            {{-- @endif  --}}
               
            <div class="employerResponse" style="display: none;">
               @foreach ($tempQuestions as $question)
               <p class="qualifType p0 mt-3"> <b>Question {{$loop->index+1}})</b> {{$question->question}} </p>
               @php
               $answers = App\UserInterviewAnswers::where('question_id', $question->id)->where('user_id', $jobSeeker->id)
               ->where('emp_id', $emp_id)->where('userInterview_id', $userInt->id)->first();   
               @endphp
               @if ($question->video_response == 1)
               <a class="video_div pointer" target="_blank" href="{{assetVideo_response($answers->answer)}}" 
                  {{-- onclick="showVideoModalFunction('{{assetVideo_response($answers->answer)}}' )"  --}}
                  >
                  <div id="v_123456"> <img src="https://img.icons8.com/color/48/000000/video.png"/></div>
               </a>
               @else
               <p class="qualifType p0 mb10"> <b>Candidate Response:</b> {{$answers->answer}} </p>
               @endif
               @endforeach
               @endif
            </div>
           
            <span class="pendinginterview-tag used-tag h-auto font-unset text-capitalize">{{$userInt->status}}</span>
         </div>
      </div>
   </div>
   @endforeach  
   @else
   <p> <b>{{$jobSeeker->name}}</b> has not given any interview yet.</p>
   @endif  
</div>




@include('web.modals.show_video')
<script type="text/javascript">
   

   $(this).siblings(".employerResponse").slideToggle();
   jQuery('.seeEmployerResponse').click(function(){
      jQuery(this).parent('.testing-tag').find('.employerResponse').slideToggle();
   })
   


   
   
</script>