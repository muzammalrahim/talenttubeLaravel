<div class="row">
@if ($UserOnlineTest->count() > 0)
 @foreach ($UserOnlineTest   as $test)
 <div class="col-sm-12 col-md-6">
  <div class="job-box-info concigerge-box clearfix">
    <div class="box-head">
      <h4>Online Test {{$loop->index+1}}:</h4>
       @if ($test->jobApplication != NULL)
        <p class="p0 qualifType text-white"> Online Test against <b> {{$test->jobApplication->job->title}} </b> </p>
        @endif                          
    </div>
    <p class="slot-para">Your slot for test is with below timetable.</p>
       <ul class="job-box-text concigerge clearfix">
          <li class="text-info-detail clearfix">
            <label>Test Name:</label>
            <span>Culture Test</span>
          </li>
          <li class="text-info-detail clearfix">
           <label>Test Duration:</label>
           <span>20:00 Min</span>
          </li>
           <li class="text-info-detail clearfix">
           <label>Test Date:</label>
           <span>{{ $test->updated_at ->format('d-m-Y')}}</span>
          </li>
            @if ($test->status == 'complete')
          <li class="text-info-detail clearfix">
           <label>Candidate's Score:</label>
           <span class="pl-2">{{$test->test_result}} %</span>
          </li>
          @endif
      </ul>
      <div class="dual-tags testing-tag clearfix">
        <span class="pendinginterview-tag used-tag text-capitalize">{{$test->status}}</span>
      </div>
 </div>
</div>
@endforeach  
@else
<h3> <b>{{$jobSeeker->name}}</b> has not taken any test yet</h3>
@endif   
</div>