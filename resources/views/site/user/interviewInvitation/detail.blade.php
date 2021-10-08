

@extends('site.employer.employermaster')


@section('content')
  <div class="head icon_head_browse_matches">Interview Detail 
    
  </div>
  
  @if ($UserInterview->status == 'pending')


    {{-- ========================================= if jobseeker has not accepted the interview yet ========================================= --}}
     
    @include('site.user.interviewInvitation.jsAccepInterview') {{-- site/user/interviewInvitation/jsAccepInterview --}}



  @elseif($UserInterview->status == 'Interview Confirmed' )


    {{-- @include('site.user.interviewInvitation.confirmed_interview')  --}}
    {{-- site/user/interviewInvitation/jsAccepInterview --}}
{{-- 
    <div class="IndustrySelect">
      <p class="p0 qualifType"> Template Name: <b>  {{$UserInterview->template->template_name}} </b> </p>
      @if ($UserInterview->template->type == 'phone_screeen' )
        <p class="p0 qualifType"> Template Type: <b> Phone Screen</b> </p>
      @else
        <p class="p0 qualifType text_capital"> Template Type: <b> {{$UserInterview->template->type}} </b> </p>
        <p class="p0 qualifType"> Employer's Instructions: <b> {{$UserInterview->template->employers_instruction}} </b> </p>
      @endif
      <p class="p0 qualifType text_capital"> Interviewer Name: <b> {{$UserInterview->employer->company}} </b> </p>

      @if ($UserInterview->template->employer_video_intro)
        
        <div class="dflex">
            <div class="w20">
              <p class="p0 qualifType text_capital"> Employer's Intro: </p>
            </div>
            <div class="w80">
              <div class="video_div pointer"  onclick="showVideoModal12( '{{template_video($UserInterview->template->employer_video_intro)}}')"> 
                <div id="v_123456"> <img src="https://img.icons8.com/color/48/000000/video.png"/></div>
              </div>      
            </div>

        </div>

      @endif

    </div>

    @php
      $tempQuestions = App\InterviewTempQuestion::where('temp_id', $UserInterview->temp_id)->get();
    @endphp

      @foreach ($tempQuestions as $question) 
      <p class="qualifType p0"> <b>Question {{$loop->index+1}}:</b> {{$question->question}} </p>
        
        @php
          $answers = App\UserInterviewAnswers::where('question_id', $question->id)->where('userInterview_id', $UserInterview->id)->
          where('user_id' , $user->id)->first();   
        @endphp
        @if ($question->video_response == 1)
            <div class="video_div pointer"  onclick="showVideoModal12( '{{assetVideo_response($answers->answer)}}')"> 
              <div id="v_123456"> <img src="https://img.icons8.com/color/48/000000/video.png"/></div>
            </div>

          @else
            <p class="qualifType p0 mb10"> <b>Your Response:</b> {{$answers->answer}} </p> 
        @endif
        
      @endforeach --}}



      {{-- html for interview detail page --}}

<section class="row">
                <div class="col-md-12 ">
                  <div class="profile profile-section interview-details-page">
                    <h2>Interview Detail</h2>
                    <hr>
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
                           <p class="text-dark">Employr's Intro: <h1 data-toggle="modal" data-target="#exampleModalCenter1"><i class="fas fa-photo-video"></i></h1> </p>
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
                                 @if ($question->video_response == 1)
                                <p><h1 data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-photo-video"></i></h1></p>
                                @else
                                 <p class="text-dark"><b>Your Response:</b> {{$answers->answer}} </p>
                                 @endif
                              </div>
                            </div>
                            @endforeach
                            <div class="question-ans">
                              <p class="accordionone text-light"><b>Question 2:</b> Are You aware median house price in Sydney is over 1 million dollars? </p>
                              <div class="panel">
                                  <p class="text-dark"><b>Your Response:</b> dsdofsdbkfjsfb </p>
                              </div>
                            </div>
                           
                            <div class="question-ans">
                              <p class="accordionone text-light"><b>Question 3:</b> Are You aware this question is not timed? </p>
                              <div class="panel">
                                  <p class="text-dark"><b>Your Response:</b> dsdofsdbkfjsfb </p>
                              </div>
                            </div>
                          </div>
                       </div>
                  </div>
                </div>
              </section>

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


<!-- ================================Modal for video=================================== -->
<!-- Button trigger modal -->

  

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <!-- <div class="modal-header"> -->
       <!--  -->
        <!-- </div> -->
      <div class="modal-body">
        <i data-dismiss="modal" aria-label="Close" class="close-box fa fa-times"></i>
        <iframe width="100%" height="215" src="https://www.youtube-nocookie.com/embed/nknwAOtmtDk" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <!-- <div class="modal-header"> -->
       <!--  -->
        <!-- </div> -->
      <div class="modal-body">
        <i data-dismiss="modal" aria-label="Close" class="close-box fa fa-times"></i>
        <iframe width="100%" height="215" src="https://www.youtube-nocookie.com/embed/nknwAOtmtDk" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>
<!-- ================================Modal for video ends=================================== -->


@stop



@section('custom_css')

<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('js/dropzone/dist/min/dropzone.min.css')}}">

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
<script src="{{ asset('js/site/userProfile.js') }}"></script>


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


this.showVideoModal12= function(video_url){

  console.log(' =============== hassan here ================ ', video_url);
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

