
{{-- @dump($UserInterview) --}}
@extends('mobile.user.usermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')

<h6 class="h6 jobAppH6">Interview Invitations</h6>

  @if ($UserInterview->count() > 0)
  @foreach ($UserInterview   as $interview)

  <div class="card mb-3 interviewBookingsRow_{{$interview->id}}">
    <div class="card-header jobAppHeader p-2 jobInfoFont">
      <p class="font11 m-0"><b>Invitation {{$loop->index+1}}: </b> Inerview of {{$interview->js->name}}</p>
      <p class="font11 m-0"><b>Status : </b> {{$interview->status}}</p>
    </div>

    <div class="card-body jobAppBody p-2">
          <p class="font11 m-0"> Template Name: <b> {{$interview->template->template_name}} </b> </p>
          @if ($interview->template->type == "phone_screeen")
            <p class="font11 m-0"> Template Type: <b> Phone Screen</b> </p>
          @else
            <p class="font11 m-0"> Template Type: <b> {{$interview->template->type}} </b> </p>
          @endif
           <div class="j_button pb20">
               <a class="btn btn-sm btn-primary seeDetailOfInterview" href="{{ route('MinterviewInvitationUrl',['url' =>$interview->url]) }}" data-jobid="{{$interview->id}}">Click here to See the full detail of invitation</a>
           </div>
    </div>
  </div>

@endforeach  
@else
<h3> You have not booked any interview yet</h3>
@endif

<div class="cl"></div>

@stop

@section('custom_footer_css')

<style>

</style>

@stop

@section('custom_js')

<script type="text/javascript">

$(document).ready(function(){

  $(document).on("click" , ".seeDetailOfInterview" , function(){
    // console.log("Hi Interview Invitaion Button");
    $(this).parents('.job_row').find('.timeTable11').toggleClass('hide_it');
  });



});

</script>
@stop

