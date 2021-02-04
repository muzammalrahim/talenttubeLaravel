

@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
  <div class="head icon_head_browse_matches">Interview Detail</div>
  
  @if ($UserInterview->status == 'Accepted' )

  <form method="POST" name="saveInterviewResponse" class="saveInterviewResponse">

    <div class="job_row interviewBookingsRow_24">
      <div class="mb20"></div>
      <div class="job_heading p10">
        <div class="w_80p">
          <h3 class=" job_title"><a> <b>Invitation 1: </b> Inerview of {{$UserInterview->js->name}}</a></h3>
        </div>
        <div class="fl_right">
            <div class="j_label bold">
              Status:
            </div>
            <div class="j_value text_capital">
              {{$UserInterview->status}}
            </div>
        </div>
      </div>

      <div class="job_info row p10 dblock">
        <div class="timeTable">
          <div class="IndustrySelect">
            <p class="p0 qualifType"> Template Name: <b>  {{$UserInterview->template->template_name}} </b> </p>
            @if ($UserInterview->template->type == 'phone_screeen' )
              <p class="p0 qualifType"> Template Type: <b> Phone Screen</b> </p>
            @else
              <p class="p0 qualifType"> Template Type: <b> {{$UserInterview->template->type}} </b> </p>
            @endif
            <p class="p0 qualifType"> Interviewee Name: <b> {{$UserInterview->js->name}} </b> </p>
          </div>
        </div>

        <input type="hidden" name="userInterviewId" value="{{$UserInterview->id}}">
        <input type="hidden" name="temp_id" value="{{$UserInterview->template->id}}">
        <input type="hidden" name="user_id" value="{{$UserInterview->js->id}}">
        <div class="timeTable">
          <div class="IndustrySelect">
            <p class="p0 qualifType center bold"> Template Questions </p>
              {{-- @dump($UserInterview->tempQuestions) --}}
              @foreach ($InterviewTempQuestion as $key=> $quest)
                {{-- @dump($quest->question) --}}
                <p class="p0 qualifType" name = ""> {{$quest->question}} </p>
                <input type="text" class="w100" name="answer[{{$quest->id}}]">
              @endforeach
          </div>
        </div>
        <div class="actionButton mt20">
          <button class="btn small leftMargin turquoise saveResponse" data_url = "{{$UserInterview->url}}">Save Reponse</button>
        </div>
        <p class="errorsInFields qualifType"></p>
      </div>
    </div>
  </form>
  @elseif($UserInterview->status == 'Interview Confirmed' )
    {{-- <h3> Interview has been confirmed. </h3> --}}
    @php
      $temp_id = $UserInterview->temp_id;
      $tempQuestions = App\InterviewTempQuestion::where('temp_id', $temp_id)->get();
    @endphp
    @foreach ($tempQuestions as $question)
      <p class="qualifType p0"> <b>Question {{$loop->index+1}}:</b> {{$question->question}} </p>
    @php
      $answers = App\UserInterviewAnswers::where('question_id', $question->id)->where('emp_id' ,$user->id)->where('user_id' , $UserInterview->js->id)->first();   
    @endphp
      <p class="qualifType p0 mb10"> <b>Your Response:</b> {{$answers->answer}} </p>
    @endforeach

    @else
    <h3> <b> {{$UserInterview->js->name}} </b> has not accepted your interview proposal yet. </h3>
  @endif

<div class="cl"></div>

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<style>

.button {
  background-color: rgb(31, 120, 236);
  border-radius: 5px;
  color: white;
  padding: .5em;
  text-decoration: none;
  margin-top: 20px !important;
  margin-bottom: 20px !important;
  display:block
}

.button:focus,
.button:hover {
  background-color: rgb(52, 49, 238);
  color: White;
}


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
    // console.log(formData);
    $('.saveResponse').html(getLoader('pp_profile_edit_main_loader responseLoader')).prop('disabled',true);
    $('.general_error1').html('');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/confirmInterInvitation',
        data:formData,
        success: function(response){
            console.log(' response ', response);
            $('.saveResponse').html('Response Saved').prop('disabled',false);
            if( response.status == 1 ){
                $('.errorsInFields').text('Response addedd successfully');
                location.href = base_url + '/Intetview/Invitation/emp/';
                
                setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                window.location.href = "{{ route('intetviewInvitation')}}" ;
            }
            // else if(response.status == 0){

            //     var answer = response.validator['answer[]'];
            //     var error = answer.toString();
            //     // console.log(error);
            //     $('.errorsInFields').text(error);
            //     setTimeout(() => { $('.errorsInFields').css("color" , "red").removeClass('to_show').addClass('to_hide').text(''); },3000);



            // }
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

