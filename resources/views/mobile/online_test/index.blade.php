{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')
@section('content')


<h6 class="h6 jobAppH6">Online Tests</h6>



@if ($UserOnlineTest->count() > 0)
@foreach ($UserOnlineTest as $test)
    {{-- @dump($applications) --}}

    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row test_{{$test->id}}">

        <div class="card">
            <div class="card-header jobAppHeader p-2">
              <span class="font11 m-0"><a> <b>Online Test {{$loop->index+1}}: </b></a></span>                    
              <div class="jobAppStatus float-right">
                  <div class=""> Status</div>
                  <div class="jobAppStatus">{{$test->status}}</div>
              </div>
              @if ($test->jobApplication != NULL)
              <p class="font11">Online Test against your "job application"  <b> {{$test->jobApplication->job->title}} </b> </p>
              @endif

            </div>

            <div class="card-body jobAppBody p-2 font11">

                <div class="IndustrySelect">
                  <p class="m-0"> Test Name: <b> {{$test->onlineTest->name}} </b> </p>
                  <p class="m-0"> Test Duration: <b> {{$test->onlineTest->time}} Minutes </b> </p>
                  @if ($test->status == 'complete')
                  <p class="m-0"> Your Score: <b> {{$test->test_result}} % </b> </p>
                  @else
                  <div class="j_button pb20 mt20">
                        <a class="btn btn-sm btn-primary" href="{{ route('mProceedTesting' , ['id' => $test->id] ) }}">Proceed to Test</a>
                  </div>
                  @endif
                  
                </div>
              
            </div>

        </div>

    </div>



@endforeach

@else

<h3 class="h6 jobAppH6 mt-3">You have not received any test yet.</h3>




@endif



@stop


@section('custom_footer_css')
<style type="text/css">


</style>
@stop

@section('custom_js')


<script type="text/javascript">


</script>

@stop

