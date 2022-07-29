

@extends('site.employer.employermaster')

@section('content')
@section('custom_css')
<style type="text/css">
  @media only screen and (min-width: 480px) and (max-width: 991px) {
    .sidebaricontoggle {
      right: 47px !important;
    }
  }
</style>
@stop
{{--   <div class="head icon_head_browse_matches">Interview Detail 
    @if (isEmployer())
      <a href="{{ route('jobSeekerInfo' ,['id'=> $UserInterview->js->id] ) }}" class="unhideInterviews"> Click here to go to Job Seeker profile </a> 
    @endif
  </div>
  @if ($UserInterview->status == 'pending')
    @if (isEmployer())
      <h3> <b> {{$UserInterview->js->name}} </b> has not accepted your interview proposal yet. </h3>
    @endif
  @elseif($UserInterview->status == 'Interview Confirmed' )
    @php
      $tempQuestions = App\InterviewTempQuestion::where('temp_id', $UserInterview->temp_id)->get();
    @endphp
      @if (isEmployer())
          @foreach ($tempQuestions as $question)
          <p class="qualifType p0"> <b>Question {{$loop->index+1}}:</b> {{$question->question}} </p>
          @php
            $answers = App\UserInterviewAnswers::where('question_id', $question->id)->where('userInterview_id', $UserInterview->id)->where('emp_id' ,$user->id)->where('user_id' , $UserInterview->js->id)->first();   
          @endphp
            @if ($question->video_response == 1)
            <div class="video_div pointer"  onclick="showVideoModal12('{{assetVideo_response($answers->answer)}}')"> 
              <div id="v_123456"> <img src="https://img.icons8.com/color/48/000000/video.png"/></div>
            </div>
            @else
            <p class="qualifType p0 mb10"> <b>Your Response:</b> {{$answers->answer}} </p>
            @endif
          @endforeach
      @endif
    
    @else

    <h3> <b> {{$UserInterview->js->name}} </b> has not accepted your interview proposal yet. </h3>

  @endif

<div class="cl"></div>

<div style="display:none;">
    <div id="videoShowModal" class="modal p0 videoShowModal">
        <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
            <div class="cont">
                <div class="videoBox"></div>

            </div>
        </div>
    </div>
</div>
 --}}

{{-- html for interview detail page --}}
<section class="row profile profile-section">
                <div class="col-md-12 ">
                  <div class="profile profile-section interview-details-page">
                    <div class="row">
                      <h2 class="col-12 col-md-4 ps-3">Interview Detail</h2>
                      <h2 class="col-12 col-md-7 col-lg-8 py-3 py-md-0">
                        @if (isEmployer())
                        <a href="{{ route('jobSeekerInfo' ,['id'=> $UserInterview->js->id] ) }}" class="unhideInterviews blue_btn pt-2 text-decoration-none"> Click here to go to the Job Seeker's profile
                         </a> 
                        @endif
                      </h2>
                    </div>
                       <div class="row">
                        <div class="col-md-12">
                         @if ($UserInterview->status == 'pending')
                          @if (isEmployer())
                            <h3> <b> {{$UserInterview->js->name}} </b> has not accepted your interview proposal yet. </h3>
                          @endif
                        @elseif($UserInterview->status == 'Interview Confirmed' )
                          @php
                            $tempQuestions = App\InterviewTempQuestion::where('temp_id', $UserInterview->temp_id)->get();
                          @endphp
                            @if (isEmployer())
                            @foreach ($tempQuestions as $question)
                        
                          <div class="question-ans">
                              <p class="accordionone text-light"><b>Question  {{$loop->index+1}}:</b>{{$question->question}} </p>
                              <div class="panel">
                                 @php
                                  $answers = App\UserInterviewAnswers::where('question_id', $question->id)->where('userInterview_id', $UserInterview->id)->where('emp_id' ,$user->id)->where('user_id' , $UserInterview->js->id)->first();   
                                @endphp
                                 @if ($question->video_response == 1)
                                <h1 data-target = "#employerVideoIntroModal" data-toggle = "modal" onclick="showEmployerVideoIntro( '{{userInterview_answer_video($answers->answer)}}')"><i class="fas fa-photo-video"></i></h1>

                                @else
                                <p class="qualifType p0 mb10"> <b>Your Response:</b> {{$answers->answer}} </p>
                                 @endif
                              </div>
                            </div>
                             @endforeach
                                @endif
                              @else
                              <h3> <b> {{$UserInterview->js->name}} </b> has not accepted your interview proposal yet. </h3>
                            @endif
                          </div>
                       </div>
                  </div>
                </div>
              </section>

<!-- ================================Modal for video=================================== -->
<!-- Button trigger modal -->

  

<!-- Modal -->

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
<!-- ================================Modal for video ends=================================== -->




@stop

@section('custom_footer_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/profile.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}


@stop


@section('custom_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{asset('js/dropzone/dist/min/dropzone.min.css')}}"> --}}

@stop

@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/jquery-ui.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/common.js') }}"></script> --}}

{{-- <script src="{{ asset('js/site/userProfile.js') }}"></script> --}}

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



// ============================================================== Save Response As Jobseeker ==============================================================


this.showVideoModal12 = function(video_url){


        console.log(' hassan here ', video_url);
        var videoElem  = '<video id="player" controls>';
        videoElem     += '<source src="'+video_url+'" type="video/mp4">';
        videoElem     += '</video>';
        $('#videoShowModal .videoBox').html(videoElem);
        $('#videoShowModal').modal({
            fadeDuration: 200,
            fadeDelay: 2.5,
            escapeClose: false,
            clickClose: false,
                });


        $('#videoShowModal').on($.modal.CLOSE, function(event, modal) {
          $(this).find(".videoBox video").remove();
      });

    }





</script>
@stop

