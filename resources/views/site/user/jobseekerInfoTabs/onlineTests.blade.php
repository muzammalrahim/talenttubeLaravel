
<div class="newJobCont">

  @if ($UserOnlineTest->count() > 0)
  @foreach ($UserOnlineTest   as $test)
  <div class="job_row test_{{$test->id}}">
    
    <div class="job_heading p10">
      <div class="w70 dinline_block">
        <h3 class=" job_title"><a> <b>Online Test {{$loop->index+1}}: </b> </a>
        </h3>

        @if ($test->jobApplication != NULL)
        <p class="p0 qualifType"> Online Test against "job application" <b> {{$test->jobApplication->job->title}} </b> </p>
        @endif
      </div>

      <span class="bold font15"> {{ $test->updated_at ->format('d-m-Y')}} </span>

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
            <p class="p0 qualifType"> Candidate's Score: <b> {{$test->test_result}} % </b> </p>
          @endif
        </div>
    </div>
  </div>

@endforeach  
@else
<h3> <b>{{$jobSeeker->name}}</b> has not taken any test yet</h3>
@endif

<div class="cl"></div>
</div>