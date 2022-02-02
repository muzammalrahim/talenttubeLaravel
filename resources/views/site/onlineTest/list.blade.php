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

<div class="row">

  @if ($UserOnlineTest->count() > 0)
    @foreach ($UserOnlineTest   as $test)
      <div class="col-sm-12 col-md-6 col-12">
        <div class="job-box-info concigerge-box clearfix h_330">
            <div class="box-head">
              <h4 class="text-white"><b>Online Test {{$loop->index+1}}: </b></h4>                          
            </div>

            <h4 class="p-3 font-weight-bold"> Testing Information </h4>
            
              {{-- <p class="slot-para">Online Test against your "job application" <b> {{$test->jobApplication->job->title}} </b></p> --}}
              <ul class="job-box-text concigerge clearfix py-0">
                <li class="text-info-detail clearfix">
                  <label>Test Name: </label>
                  <span><b> {{$test->onlineTest->name}} </b></span>
                </li>


                  <li class="text-info-detail clearfix">
                    <label>Score:</label>
                      @if ($test->status == 'complete')
                      <span><b> {{$test->test_result}} % </b></span>
                      @else
                        <span> <b> Test Not Attempted Yet </b> </span>
                      @endif

                  </li>

                  {{-- <div class="dual-tags testing-tag clearfix"></div> --}}
                

                <li class="text-info-detail clearfix">
                 <label>Time:</label>
                 <span><b> {{$test->onlineTest->time}} Minutes </b></span>
                </li>

                <li class="text-info-detail clearfix">
                 <label>Date:</label>
                 <span><b> {{$test->updated_at->format('d-m-y')}} </b></span>
                </li>


                @if ($test->jobApplication != NULL)

                  <li class="text-info-detail clearfix">
                    <label>Application:</label>
                   <span><b> {{$test->jobApplication->job->title}} </b></span>
                  </li>

                  <li class="text-info-detail clearfix">
                    <label>Employer:</label>
                   <span><b> {{$test->jobApplication->job->jobEmployer->company}} </b></span>
                  </li>
                @else

                  

                @endif

                @if ($test->status != 'complete')
                  <a href="{{ route('proceedTesting' , ['id' => $test->id] ) }}" class="proceed-test used-tag " >Proceed To Test</a>
                @endif
                <span class="pendinginterview-tag used-tag">{{$test->status}}</span>

              </ul>            

              {{-- <ul class="job-box-text concigerge clearfix py-0">
                <li class="text-info-detail clearfix">
                  <label>Test Name: </label>
                  <span><b> {{$test->onlineTest->name}} </b></span>
                </li>

                <li class="text-info-detail clearfix">
                 <label>Time :</label>
                 <span><b> {{$test->onlineTest->time}} Minutes </b></span>
                </li>


                <li class="text-info-detail clearfix">
                 <label>Date :</label>
                 <span><b> {{$test->updated_at->format('d-m-y')}} </b></span>
                </li>

                @if ($test->status == 'complete')
                  <li class="text-info-detail clearfix">
                    <label>Score:</label>
                   <span><b> {{$test->test_result}} % </b></span>
                  </li>
                  <div class="dual-tags testing-tag clearfix"></div>
                @else
                  <a href="{{ route('proceedTesting' , ['id' => $test->id] ) }}" class="proceed-test used-tag " >Proceed To Test</a>
                @endif
                  <span class="pendinginterview-tag used-tag">{{$test->status}}</span>
              </ul> --}}
        </div>  
      </div> 
    @endforeach  
  @else
  <h3> You have not received any test yet.</h3>
  @endif
</div>


<style type="text/css">
  .proceed-test{
    background:#FF9400; 
    float: left;
   color: white;
  border-radius: 5px;
  border:1px solid #FF9400;
  }
  .proceed-test:hover{
    background-color: white;
    border-radius: 1px solid #FF9400;
    color: #FF9400;
    }
</style>