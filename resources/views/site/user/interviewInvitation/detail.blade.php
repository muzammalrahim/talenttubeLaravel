{{--  --}}

@extends('web.user.usermaster')


@section('content')

<section class="row">
  <div class="col-md-12">
    
    <div class="profile profile-section">

      <h2>Interview Detail</h2> 
        
      @if ($UserInterview->status == 'Accepted')


      {{-- ========================================= if jobseeker has not accepted the interview yet ========================================= --}}
       
      @include('site.user.interviewInvitation.jsAccepInterview') {{-- site/user/interviewInvitation/jsAccepInterview --}}

      {{-- ========================================= if inteview is confirmed ========================================= --}}


      @elseif($UserInterview->status == 'Interview Confirmed' )

         <div class="row">
            <div class="col-sm-12 col-md-6">
               <p class="text-dark">Template Name: <b>{{$UserInterview->template->template_name}}</b></p>
            </div>
            <div class="col-sm-12 col-md-6">
               @if ($UserInterview->template->type == 'phone_screeen' )
               <p class="text-dark"> Template Type: <b> Phone Screen</b> </p>
               @else
               <p class="text-dark">Template Type: <b>{{$UserInterview->template->type}}</b></p>
            </div>
            <div class="col-sm-12 col-md-6">
               <p class="text-dark">Employer Instructions: <b>{{$UserInterview->template->employers_instruction}}</b></p>
            </div>
            @endif
            <div class="col-sm-12 col-md-6">
               <p class="text-dark">Interviewer Name: <b>{{$UserInterview->employer->company}}</b> </p>
            </div>
            @if ($UserInterview->template->employer_video_intro)
            <div class="col-sm-12 col-md-6">
               <p class="text-dark">Employr's Intro: 
               <h1 data-target = "#employerVideoIntroModal" data-toggle = "modal" onclick="showEmployerVideoIntro( '{{template_video($UserInterview->template->employer_video_intro)}}')"><i class="fas fa-photo-video"></i></h1>
               </p>
            </div>
            @endif
         </div>
         <div class="row">
            <div class="col-md-12">
               @php
               $tempQuestions = App\InterviewTempQuestion::where('temp_id', $UserInterview->temp_id)->get();
               @endphp
               @foreach ($tempQuestions as $question)
               <div class="question-ans">
                  <p class="accordionone text-light"><b>Question {{$loop->index+1}}:</b>{{$question->question}}</p>
                  @php
                  $answers = App\UserInterviewAnswers::where('question_id', $question->id)->where('userInterview_id', $UserInterview->id)->
                  where('user_id' , $user->id)->first();   
                  @endphp
                  <div class="panel">
                     @if ($question->video_response == 1 )
                     <p>
                     <h1 data-toggle="modal" onclick="showEmployerVideoIntro( '{{userInterview_answer_video($answers->answer)}}')" data-target="#employerVideoIntroModal"><i class="fas fa-photo-video"></i></h1>
                     </p>
                     @else
                     <p class="text-dark"><b>Your Response:</b> {{$answers->answer}} </p>
                     @endif
                  </div>
               </div>
               @endforeach
            </div>
         </div>
        @else

        <h3> <b> {{$UserInterview->js->name}} </b> has not accepted your interview proposal yet. </h3>

      @endif

      <div class="cl"></div>

    </div>

  </div>   

</section>


{{-- ===================================== employer video intro showing modal ===================================== --}}

{{-- <div class="modal fade" id="employerVideoIntroModal" tabindex="-1" aria-labelledby="exampleModalLabel" 
   aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="videoTitle">Video</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="videoBox"></div>
      </div>
    </div>
  </div>
</div> --}}


<div class="modal fade" id="employerVideoIntroModal" role="dialog">
    <div class="modal-dialog delete-applications">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <i data-dismiss="modal" class="close-box fa fa-times"></i><i ></i>                      
          {{-- <h1 class="modal-title"><i class="fas fa-thumbs-down trash-icon"></i>Video</h1> --}}
        </div>
        <div class="modal-body">
          {{-- <strong>Are you sure you wish to continue?</strong> --}}
            <div class="videoBox"></div>
        </div>
        <div class="dual-footer-btn">
          <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
          {{-- <button type="button" class="orange_btn" onclick="confirmUnlikeFunction()" data-dismiss="modal"><i class="fa fa-check" ></i>OK</button> --}}
        </div>
      </div>
      
    </div>
</div>


@stop



@section('custom_css')

<link rel="stylesheet" type="text/css" href="{{asset('js/dropzone/dist/min/dropzone.min.css')}}">

@stop

@section('custom_footer_css')

@stop

@section('custom_js')
<script src="{{ asset('js/web/interview.js') }}"></script>


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





</script>
@stop

