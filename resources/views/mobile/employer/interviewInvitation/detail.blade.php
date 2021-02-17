

@extends('mobile.user.usermaster')


@section('custom_css')

@stop

@section('content')

  <h6 class="h6 jobAppH6">Interview's Detail</h6>  
  
  @if ($UserInterview->status == 'Accepted' )

  <form method="POST" name="saveInterviewResponse" class="saveInterviewResponse">
    <div class="card mb-3 interviewBookingsRow">
    <div class="card-header jobAppHeader p-2 jobInfoFont">
      <p class="font11 m-0"><b>Interview Invitation: </b> Inerview of {{$UserInterview->js->name}}</p>
      <p class="font11 m-0"><b>Status : </b> {{$UserInterview->status}}</p>
    </div>

      <div class="card-body jobAppBody p-2">
        <div class="timeTable">
          <div class="IndustrySelect">
            <p class="m-0 font11"> Template Name: <span>  {{$UserInterview->template->template_name}} </span> </p>
            @if ($UserInterview->template->type == 'phone_screeen' )
              <p class="m-0 font11"> Template Type: <span> Phone Screen</span> </p>
            @else
              <p class="m-0 font11"> Template Type: <span> {{$UserInterview->template->type}} </span> </p>
            @endif
            <p class="m-0 font11"> Interviewee Name: <span> {{$UserInterview->js->name}} </span> </p>
          </div>
        </div>

        <input type="hidden" name="userInterviewId" value="{{$UserInterview->id}}">
        <input type="hidden" name="temp_id" value="{{$UserInterview->template->id}}">
        <input type="hidden" name="user_id" value="{{$UserInterview->js->id}}">
        <div class="timeTable">
          <div class="IndustrySelect">
            <h6 class="m-2 text-center font-weight-bold"> Template Questions </h6>
              {{-- @dump($UserInterview->tempQuestions) --}}
              @foreach ($InterviewTempQuestion as $key=> $quest)
                <p class="my-1 font11 " name = ""> {{$quest->question}} </p>
                <input type="text" class="form-control" name="answer[{{$quest->id}}]">
              @endforeach
          </div>
        </div>
        <div class="actionButton mt20">
          <button class="btn btn-sm btn-primary saveResponse" data_url = "{{$UserInterview->url}}">Save Reponse</button>
        </div>
        <p class="errorsInFields m-0 font11"></p>
      </div>
    </div>
  </form>
  @elseif($UserInterview->status == 'Interview Confirmed' )
    @php
      $temp_id = $UserInterview->temp_id;
      $tempQuestions = App\InterviewTempQuestion::where('temp_id', $temp_id)->get();
    @endphp
    @foreach ($tempQuestions as $question)
      <p class="font11 my-1"> <span class="font-weight-bold">Question {{$loop->index+1}}:</span> {{$question->question}} </p>
    @php
      $answers = App\UserInterviewAnswers::where('question_id', $question->id)->where('emp_id' ,$user->id)->where('user_id' , $UserInterview->js->id)->first();   
    @endphp
      <p class="font11 mb-2"> <span class="font-weight-bold">Your Response:</span> {{$answers->answer}} </p>
    @endforeach
    @else
    <h6> <span class="font-weight-bold"> {{$UserInterview->js->name}} </span> has not accepted your interview proposal yet. </h6>
  @endif

<div class="cl"></div>

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<style>



</style>

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>

<script type="text/javascript">

$('.saveResponse').on('click',function() {
    event.preventDefault();
    var formData = $('.saveInterviewResponse').serializeArray();
    // $('.saveResponse').html(getLoader('pp_profile_edit_main_loader responseLoader')).prop('disabled',true);
    $('.general_error1').html('');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MconfirmInterInvitation',
        data:formData,
        success: function(response){
            console.log(' response ', response);
            $('.saveResponse').html('Response Saved').prop('disabled',false);
            if( response.status == 1 ){
                $('.errorsInFields').text('Response addedd successfully');
                setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                window.location.href = "{{ route('MintetviewInvitationEmp')}}" ;
            }
            else{
                $('.saveResponse').html('Save Response');
               setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
               $('.errorsInFields').text(response.error);
            }
        }
    });

});



</script>
@stop

