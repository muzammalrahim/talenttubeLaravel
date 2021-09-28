{{-- 
<div class="newJobCont">
  <div class="head icon_head_browse_matches">Received Interview Invitations <a href="{{ route('unhideInterviews') }}" class="unhideInterviews"> Click here to Un-Hide your interviews </a> </div>

  @if ($UserOnlineTest->count() > 0)
  @foreach ($UserOnlineTest   as $test)

  @dd($Int_booking->template->template_name);
  <div class="job_row test_{{$test->id}}">
    
    <div class="job_heading p10">
      <div class="w70 dinline_block">
        <h3 class=" job_title"><a> <b>Online Test {{$loop->index+1}}: </b>  {{$test->jobApp_id}} </a></h3>
        @if ($test->jobApplication != NULL)
          expr

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
</div> --}}



{{-- html for testing --}}
   @if ($UserOnlineTest->count() > 0)
  @foreach ($UserOnlineTest   as $test)
           <div class="col-sm-12 col-md-6">
            <div class="job-box-info concigerge-box clearfix">
              <div class="box-head">
                <h4><b>Online Test {{$loop->index+1}}: </b></h4>                          
              </div>
               @if ($test->jobApplication != NULL)
              <p class="slot-para">Online Test against your "job application" <b> {{$test->jobApplication->job->title}} </b></p>
                 <ul class="job-box-text concigerge clearfix">
                    <li class="text-info-detail clearfix">
                      <label>Test Name: </label>
                      <span><b> {{$test->onlineTest->name}} </b></span>
                    </li>
                    <li class="text-info-detail clearfix">
                     <label>Test Duration:</label>
                     <span><b> {{$test->onlineTest->time}} Minutes </b></span>
                    </li>
                </ul>
                <div class="dual-tags testing-tag clearfix">
                  <a href="{{ route('proceedTesting' , ['id' => $test->id] ) }}" class="proceed-test used-tag">Proceed To Test</a>
                  <span class="pendinginterview-tag used-tag">{{$test->status}}</span>
                </div>
                 @endif
           </div>
         </div>   
    @endforeach  
@else
<h3> You have not received any test yet.</h3>
@endif