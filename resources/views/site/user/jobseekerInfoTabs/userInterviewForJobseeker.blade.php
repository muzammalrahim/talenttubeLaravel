


<div class="newJobCont">
  <div class="job_heading p10 mb10"> <b> {{$jobSeeker->name}} </b> has given below interview </div>
  @if ($UserInterview->count() > 0)
  @foreach ($UserInterview as $Int_booking)
  <div class="job_row interviewBookingsRow_{{$Int_booking->id}}">
    <div class="job_heading p10">
      <div class="w_80p">
        <p class="qualifType"><b>Invitation {{$loop->index+1}}: </b></p>
      </div>
      <div class="fl_right">
          <div class="j_label bold">
            Status:
          </div>
          <div class="j_value text_capital">
            {{$Int_booking->status}}
          </div>
      </div>
      <div class="job_info row dblock">

        <p class="qualifType"><a><b>Type:</b> {{$Int_booking->template->type}}</a>  <b>Template:</b> {{$Int_booking->template->template_name}}  </p>
        {{-- @dump($Int_booking->status ==  'Interview Confirmed'); --}}
          
          {{-- <span class="qualifType jobDetailBtn graybtn jbtn" > Click here to see the detail </span> --}}
          @foreach ($Int_booking->tempQuestions as $question)
            {{-- <p class="qualifType" style="margin: 15px 0px;"> {{ $question->question }} </p> --}}
            {{-- <p> {{ $question->answers1->answer}} </p> --}}


          @endforeach
          {{-- {{question}} --}}
      </div>
    </div>
  </div>
@endforeach  
@else
  @if (!isAdmin())
      <p> You have not booked any interview yet</p>
  @endif
@endif

<div class="cl"></div>
</div>