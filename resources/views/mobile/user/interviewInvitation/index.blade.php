

@extends('mobile.user.usermaster')


@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')

<div class="newJobCont">
  {{-- <div class="head icon_head_browse_matches">Received Interview Invitations</div> --}}

  <h6 class="h6 jobAppH6">Received Interview Invitations</h6>


  @if ($Interviews_booking->count() > 0)
  @foreach ($Interviews_booking   as $Int_booking)

  <div class="card mb-3 interviewBookingsRow_{{$Int_booking->id}}">

    <div class="card-header jobAppHeader p-2 jobInfoFont">
      <p class="font11 m-0"><b>Invitation {{$loop->index+1}}: </b> Inerview from {{$Int_booking->employer->comany}}</p>
      <p class="font11 m-0"><b>Status : </b> {{$Int_booking->status}}</p>
    </div>

    <div class="card-body jobAppBody p-2">
          <p class="font11 m-0"> Template Name: <b> {{$Int_booking->template->template_name}} </b> </p>
          @if ($Int_booking->template->type == "phone_screeen")
            <p class="font11 m-0"> Template Type: <b> Phone Screen</b> </p>
          @else
            <p class="font11 m-0"> Interview Type: <b> {{$Int_booking->template->type}} </b> </p>
          @endif
           <div class="j_button pb20 mt20">
               <a class="btn btn-sm btn-primary seeDetailOfInterview" href="{{ route('MinterviewInvitationUrl',['url' =>$Int_booking->url]) }}" data-jobid="{{$Int_booking->id}}">Click here to respond to this interview</a>
           </div>
      @php
        $question = $Int_booking->tempQuestions;
      @endphp
    </div>



  </div>

@endforeach  
@else
<h3> You have not received any interview invitation yet.</h3>
@endif

<div class="cl"></div>
</div>
{{-- @include('site.user.interview.popup') --}}
@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">


@stop

@section('custom_js')

<script src="{{ asset('js/site/common.js') }}"></script>

<script type="text/javascript">

$(document).ready(function(){

  $(document).on("click" , ".seeDetailOfInterview" , function(){
    // console.log("Hi Interview Invitaion Button");
    $(this).parents('.job_row').find('.timeTable11').toggleClass('hide_it');
  });

  $(document).on("click" , ".confirmInterview" , function(){

  });

</script>
@stop

