
@extends('mobile.user.usermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')








<div class="head icon_head_browse_matches">

  <h6 class="h6 jobAppH6">Respond to Interview</h6>

    @if (isEmployer())
      <a href="{{ route('jobSeekerInfo' ,['id'=> $UserInterview->js->id] ) }}" class="unhideInterviews"> Click here to go to Job Seeker profile </a> 
    @endif

  </div>
  
  @if ($UserInterview->status == 'pending')

    @if (isEmployer())
      <h3> <b> {{$UserInterview->js->name}} </b> has not accepted your interview proposal yet. </h3>
    @else

    @include('mobile.employer.interviewInvitation.acceptInterview')


    @endif


{{-- 
    @elseif ($UserInterview->status == 'Accepted')

    @if (isEmployer())
     
     @include('mobile.employer.interviewInvitation.acceptInterview')

    @else

     @include('site.user.interviewInvitation.userAddResponse')

     @include('mobile.employer.interviewInvitation.empAddResponse')

    
    @endif --}}

  
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
























































{{-- <div class="newJobCont">
  <h6 class="h6 jobAppH6">Respond to Interview</h6>
  @if ($UserInterview->status =='pending')
  <div class="card mb-3 interviewBookingsRow_{{$UserInterview->id}}">
    <div class="card-header jobAppHeader p-2 jobInfoFont">
      <p class="font11 m-0"><b>Interview Invitation: </b> Inerview from {{$UserInterview->employer->company}}</p>
      <p class="font11 m-0"><b>Status : </b> {{$UserInterview->status}}</p>
    </div>
    <div class="card-body jobAppBody p-2">
      @if ($UserInterview->template->type = 'phone_screeen')
        <p class="font11 m-0"> Interview Type: <b> Phone Screen</b> </p>
      @else
        <p class="font11 m-0"> Template Type: <b> {{$UserInterview->template->type}} </b> </p>
      @endif
      <div class="actionButton mt-4">
        <button class="btn btn-sm btn-primary acceptButton" data_url = "{{$UserInterview->url}}">Accept</button>
        <button class="btn btn-sm btn-danger rejectButton ml20" data_url = "{{$UserInterview->url}}">Reject</button>
      </div>
      <p class="errorsInFields font11 m-0"></p>
    </div>
  </div>
  @elseif()
  @else
    <h6> You have already responded to this interview </h6>
  @endif
</div> --}}



@stop





































































@section('custom_footer_css')

@stop

@section('custom_js')

<script type="text/javascript">

// ====================================================- Accept Interview Proposal ====================================================

/*$('.acceptButton').on('click',function() {
  event.preventDefault();
  var acceptUrl = $(this).attr('data_url');

    $('.general_error1').html('');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/accept/interview/Minvitation',
         data:{url:acceptUrl},

        success: function(data){
            console.log(' data ', data);
            $('.acceptButton').html('Accepted').prop('disabled',false);
            if( data.status == 1 ){
                $('.errorsInFields').text('Interview accepted successfully');
                setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                window.location.href = "{{ route('MintetviewInvitation')}}" ;

            }else{
                // $('.errorsInFields').text('Error occured');
               setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
            }

        }
    });

});*/


// ====================================================- Reject Interview Proposal ====================================================

/*$('.rejectButton').on('click',function() {
    event.preventDefault();
    var rejectUrl = $(this).attr('data_url');
    $('.general_error1').html('');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/reject/interview/Minvitation',
         data:{url:rejectUrl},
        success: function(data){
            console.log(' data ', data);
            $('.rejectButton').html('Rejected').prop('disabled',false);
            if( data.status == 1 ){
                $('.errorsInFields').text('Interview rejected successfully');
                setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                window.location.href = "{{ route('MintetviewInvitation')}}" ;
            }else{
                // $('.errorsInFields').text('Error occured');
               setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
            }

        }
    });
});*/

</script>



@stop

