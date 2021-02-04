


<div class="newJobCont">
  @if ($UserInterview->count() > 0)
  <div class="job_heading p10 mb10"> <b> {{$jobSeeker->name}} </b> has given below interview </div>
  
  @foreach ($UserInterview as $Int_booking)
  <div class="job_row interviewBookingsRow_{{$Int_booking->id}}">
    <div class="job_heading p10">
      <div class="w_80p">
        <p class="qualifType"><b>Interview {{$loop->index+1}}: </b></p>
      </div>
      <div class="fl_right">
          <div class="j_label bold">Status:</div>
          <div class="j_value text_capital">{{$Int_booking->status}}</div>
      </div>

      <div class="job_info employerResponseDiv row dblock">
        <p class="qualifType"><a><b>Type:</b> {{$Int_booking->template->type}}</a>  <b>Template:</b> {{$Int_booking->template->template_name}}  </p>

          @if ($Int_booking->status == 'Interview Confirmed' )
            <div class="j_button pb20">
               <a class="jobApplyBtn graybtn jbtn seeEmployerResponse">See Employer's Response</a>
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
                <p class="qualifType p0 mb10"> <b>Employer's Response:</b> {{$answers->answer}} </p>
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
