

@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
  <div class="head icon_head_browse_matches">Interview Detail 
    @if (isEmployer())
      <a href="{{ route('jobSeekerInfo' ,['id'=> $UserInterview->js->id] ) }}" class="unhideInterviews"> Click here to go to Job Seeker profile </a> 
    @endif
  </div>
  
  @if ($UserInterview->status == 'pending')

    @if (isEmployer())
      <h3> <b> {{$UserInterview->js->name}} </b> has not accepted your interview proposal yet. </h3>
    @else

     @include('site.user.interviewInvitation.jsAccepInterview')

    @endif

  @elseif ($UserInterview->status == 'Accepted')

    @if (isEmployer())
     
     @include('site.user.interviewInvitation.empAddResponse')

    @else

     @include('site.user.interviewInvitation.userAddResponse')
    
    @endif

  
  @elseif($UserInterview->status == 'Interview Confirmed' )
    {{-- <h3> Interview has been confirmed. </h3> --}}
    @php
      $temp_id = $UserInterview->temp_id;
      $tempQuestions = App\InterviewTempQuestion::where('temp_id', $temp_id)->get();
    @endphp

      @if (isEmployer())
        
          @foreach ($tempQuestions as $question)
          <p class="qualifType p0"> <b>Question {{$loop->index+1}}:</b> {{$question->question}} </p>
          @php
            $answers = App\UserInterviewAnswers::where('question_id', $question->id)->where('emp_id' ,$user->id)->where('user_id' , $UserInterview->js->id)->first();   
          @endphp
            <p class="qualifType p0 mb10"> <b>Your Response:</b> {{$answers->answer}} </p>
          @endforeach

        @else

          @foreach ($tempQuestions as $question)
          <p class="qualifType p0"> <b>Question {{$loop->index+1}}:</b> {{$question->question}} </p>
          @php
            $answers = App\UserInterviewAnswers::where('question_id', $question->id)->where('emp_id' ,$UserInterview->employer->id)->where('user_id' , $user->id)->first();   
          @endphp
            <p class="qualifType p0 mb10"> <b>Your Response:</b> {{$answers->answer}} </p>
          @endforeach

      @endif
    
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
            else{
                $('.saveResponse').html('Save Response');
               setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
               $('.errorsInFields').text(response.error);
            }

        }
    });

});



// ============================================================== Save Response As Jobseeker ==============================================================


$('.saveResponseAsJobseeker').on('click',function() {
    event.preventDefault();
    var formData = $('.saveInterviewResponse').serializeArray();
    $('.saveResponseAsJobseeker').html(getLoader('pp_profile_edit_main_loader responseLoader')).prop('disabled',true);
    $('.general_error1').html('');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/confirmInterInvitation/js',
        data:formData,
        success: function(response){
            console.log(' response ', response);
            $('.saveResponseAsJobseeker').html('Response Saved').prop('disabled',false);
            if( response.status == 1 ){
                $('.errorsInFields').text('Response addedd successfully');
                location.href = base_url + '/Intetview/Invitation';
                setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                // window.location.href = "{{ route('intetviewInvitation')}}" ;
            }
            else{
                $('.saveResponseAsJobseeker').html('Save Response');
               setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
               $('.errorsInFields').text(response.error);
            }

        }
    });

});

</script>
@stop

