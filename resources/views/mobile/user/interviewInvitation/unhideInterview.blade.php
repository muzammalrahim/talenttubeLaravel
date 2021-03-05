

@extends('mobile.user.usermaster')


@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')

<div class="newJobCont">
  {{-- <div class="head icon_head_browse_matches">Received Interview Invitations</div> --}}

  <h6 class="h6 jobAppH6">Hidden Interview Invitations</h6>

  {{-- <div class="font11 my-3"><a href="{{ route('MunhideInterviews') }}" class="unhideInterviews"> Click here to Un-Hide your interviews </a> </div> --}}


  @if ($UserInterview->count() > 0)
  @foreach ($UserInterview   as $Int_booking)

  <div class="card mb-3 interviewBookingsRow_{{$Int_booking->id}}">

    <div class="card-header jobAppHeader p-2 jobInfoFont">
      <div class="invitation float-left">
        <p class="font11 m-0"><b>Invitation {{$loop->index+1}}: </b> Inerview from {{$Int_booking->employer->company}}</p>
        <p class="font11 m-0"><b>Status : </b> {{$Int_booking->status}}</p>
      </div>
    </div>

    <div class="card-body jobAppBody p-2">

      <p class="font11 m-0"> Template Name: <b> {{$Int_booking->template->template_name}} </b> </p>
      @if ($Int_booking->template->type == "phone_screeen")
        <p class="font11 m-0"> Template Type: <b> Phone Screen</b> </p>
      @else
        <p class="font11 m-0"> Interview Type: <b> {{$Int_booking->template->type}} </b> </p>
      @endif

      @if ($Int_booking->status == 'Interview Confirmed')
        <div class="j_button pb20 mt20 float-left">
          <a class="btn btn-sm btn-primary seeDetailOfInterview" href="{{ route('MinterviewInvitationUrl',['url' =>$Int_booking->url]) }}" data-jobid="{{$Int_booking->id}}">View My Response</a>
        </div>
      @else
        <div class="j_button pb20 mt20 float-left">
          <a class="btn btn-sm btn-primary seeDetailOfInterview" href="{{ route('MinterviewInvitationUrl',['url' =>$Int_booking->url]) }}" data-jobid="{{$Int_booking->id}}">Click here to respond</a>
        </div>
      @endif

      <div class="font11 float-right mt-1">
        <form class="statusOfInterview" name="statusOfInterview">  
          @csrf
          <select name="hide" class="form-control font11">
            <option value= "0"> Select Status   </option> 
            <option value= "yes"> un-Hide Interview </option> 
            @if ($Int_booking->status == 'pending')
              <option value= "decline"> Decline Interview </option> 
            @endif
          </select>
          <input type="hidden" class="interview_id" name="interview_id" value="{{$Int_booking->id}}">
        </form>
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

<style type="text/css">
  

</style>

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


  // ========================================================= Change Status of interview =========================================================

  $('.statusOfInterview').on('change',function() {
    event.preventDefault();
    var formData = $(this).serializeArray();
    var interview_id = $(this).closest('.statusOfInterview').find('.interview_id').val();
    console.log(' formData ', formData);
    $('.general_error1').html('');
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/userInterview/hide/js',
        data: formData,
        success: function(response){
            console.log(' response ', response);
            if( response.status == 1 ){
              $('.interviewBookingsRow_'+interview_id).remove();
            }else{
                alert('Error Occured');
            }

        }
    });
  });

});


</script>
@stop

