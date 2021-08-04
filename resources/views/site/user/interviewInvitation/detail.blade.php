

@extends('site.employer.employermaster')


@section('content')
  <div class="head icon_head_browse_matches">Interview Detail 
    
  </div>
  
  @if ($UserInterview->status == 'pending')


    {{-- ========================================= if jobseeker has not accepted the interview yet ========================================= --}}
     
    @include('site.user.interviewInvitation.jsAccepInterview') {{-- site/user/interviewInvitation/jsAccepInterview --}}

  @elseif($UserInterview->status == 'Interview Confirmed' ) 
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
        
      @endforeach

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


@stop


@section('custom_css')

<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('js/dropzone/dist/min/dropzone.min.css')}}">

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">

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

