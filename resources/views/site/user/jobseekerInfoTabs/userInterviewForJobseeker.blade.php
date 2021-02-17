


<div class="newJobCont">
  @if ($UserInterview->count() > 0)
  <div class="job_heading p10 mb10"> <b> {{$jobSeeker->name}} </b> has given below interview </div>
  
  @foreach ($UserInterview as $Int_booking)
  <div class="job_row interviewBookingsRow_{{$Int_booking->id}}">
    <div class="job_heading p10">
      <div class="w_80p">
        <p class="qualifType"><b>Interview {{$loop->index+1}}:  </b> <span class="ml20"> Employer: <b>{{$Int_booking->employer->company}}</b> </span> </p>
      </div>
      <div class="fl_right">
          <div class="j_label bold">Status:</div>
          <div class="j_value text_capital">{{$Int_booking->status}}</div>
      </div>

      <div class="job_info employerResponseDiv row dblock">
        <p class="qualifType"><a><b>Type:</b> {{$Int_booking->template->type}}</a>  <b>Template:</b> {{$Int_booking->template->template_name}}  </p>

          @if ($Int_booking->status == 'Interview Confirmed' )
            <div class="j_button pb20">
               <a class="jobApplyBtn graybtn jbtn seeEmployerResponse">See Candidate's Response</a>
            </div>
            @php
              $temp_id = $Int_booking->temp_id;
              $tempQuestions = App\InterviewTempQuestion::where('temp_id', $temp_id)->get();
            @endphp
            <div class="employerResponse hide"  >
              @foreach ($tempQuestions as $question)
                <p class="qualifType p0"> <b>Question {{$loop->index+1}})</b> {{$question->question}} </p>
                @php
                  $answers = App\UserInterviewAnswers::where('question_id', $question->id)->where('user_id', $jobSeeker->id)->first();   
                @endphp
                <p class="qualifType p0 mb10"> <b>Candidate's Response:</b> {{$answers->answer}} </p>
              @endforeach
            </div>
          @endif
      </div>




     {{--  <div class="job_info employerResponseDiv row dblock">

          @if ($Int_booking->status == 'Accepted' )

          @if ($Int_booking->employer->id == $user->id)
            

            <div class="j_button pb20">
               <a class="jobApplyBtn graybtn jbtn seeEmployerResponse">Add Response</a>
            </div>

            <form method="POST" name="saveInterviewResponse" class="saveInterviewResponse">


              <input type="hidden" name="userInterviewId" value="{{$UserInterview->id}}">
              <input type="hidden" name="temp_id" value="{{$UserInterview->template->id}}">
              <input type="hidden" name="user_id" value="{{$UserInterview->js->id}}">
            


            @php
              $temp_id = $Int_booking->temp_id;
              $tempQuestions = App\InterviewTempQuestion::where('temp_id', $temp_id)->get();
            @endphp
            <div class="employerResponse hide"  >
              @foreach ($tempQuestions as $key=> $quest)
                <p class="qualifType p0"> <b>Question {{$loop->index+1}})</b> {{$quest->question}} </p>
                
                <input type="text" class="w100" name="answer[{{$quest->id}}]">

                @php
                @endphp
              @endforeach
            </div>


          </form>
          



          @endif


          @endif
            
      </div> --}}







    </div>
  </div>
@endforeach  
@else
      <p> <b>{{$jobSeeker->name}}</b> has not given any interview yet.</p>
@endif

<div class="cl"></div>
</div>
