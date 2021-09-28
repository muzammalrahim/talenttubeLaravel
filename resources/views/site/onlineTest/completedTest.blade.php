

@extends('web.user.usermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')




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

      <div class="fl_right">
          <div class="j_label bold">Status:</div>
          <div class="j_value text_capital">{{$test->status}}</div>
      </div>
    </div>

    <div class="job_info row p10 dblock">
        <div class="IndustrySelect">
          <p class="p0 qualifType"> Test Name: <b> {{$test->onlineTest->name}} </b> </p>
          <p class="p0 qualifType"> Test Duration: <b> {{$test->onlineTest->time}} Minutes </b> </p>
          <p class="p0 qualifType"> Candidate's Score: <b> {{$test->test_result}} % </b> </p>
        </div>
    </div>
  </div>

@endforeach  
@else
<h3> This user has not taken any test yet</h3>
@endif

<div class="cl"></div>
</div>



{{-- @include('site.user.interview.popup') --}}
@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<style>

.width75p{width: 75%;display: inline-block;}
.bgColor{background: #dddfe3;}
.confirmInterview{margin: 15px 0 !important;}
.hide{display: none;}


</style>

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>

<script type="text/javascript">



</script>

@stop

