
<div class="newJobCont">
  {{-- <div class="head icon_head_browse_matches">Received Interview Invitations <a href="{{ route('unhideInterviews') }}" class="unhideInterviews"> Click here to Un-Hide your interviews </a> </div>
 --}}
  @if ($UserOnlineTest->count() > 0)
  @foreach ($UserOnlineTest   as $test)

  {{-- @dd($Int_booking->template->template_name); --}}
  <div class="job_row test_{{$test->id}}">
    
    <div class="job_heading p10">
      <div class="w70 dinline_block">
        <h3 class=" job_title"><a> <b>Online Test {{$loop->index+1}}: </b>  {{-- {{$test->jobApp_id}} --}} </a></h3>
        @if ($test->jobApplication != NULL)
          {{-- expr --}}

          <p class="p0 qualifType"> Online Test against your "job application" <b> {{$test->jobApplication->job->title}} </b> </p>

        @endif
      </div>

      <div class="fl_right">
          <div class="j_label bold">Status:</div>
          <div class="j_value text_capital">{{$test->status}}</div>
      </div>
    </div>

    <div class="job_info row p10 dblock">
        <div class="IndustrySelect">
          <p class="p0 qualifType"> Test Name: <b> {{$test->onlineTest->name}} </b> </p>
          <p class="p0 qualifType"> Test Duration: <b> {{$test->onlineTest->time}} Minutes </b> </p>
          @if ($test->status == 'complete')
          <p class="p0 qualifType"> Your Score: <b> {{$test->test_result}} % </b> </p>
          @else
          <div class="j_button pb20 mt20">
                <a class="jobApplyBtn graybtn jbtn seeDetailOfInterview" href="{{ route('proceedTesting' , ['id' => $test->id] ) }}">Proceed to Test</a>
          </div>
          @endif
          
        </div>
    </div>
  </div>

@endforeach  
@else
<h3> You have not received any test yet.</h3>
@endif

<div class="cl"></div>
</div>