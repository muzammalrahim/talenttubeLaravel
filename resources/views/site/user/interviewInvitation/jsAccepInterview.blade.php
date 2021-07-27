




<div class="job_row acceptDiv interviewBookingsRow_{{$UserInterview->id}}">
  <div class="job_heading p10">
    <div class="w_80p"> <h3 class=" job_title"><a> <b>Invitation 1: </b> Inerview from {{$UserInterview->employer->company}}</a></h3> </div>
    <div class="fl_right">
      <div class="j_label bold">Status:</div>
      <div class="j_value text_capital"> {{$UserInterview->status}} </div>
    </div>
  </div>


  <div class="job_info row p10 dblock">
    <div class="IndustrySelect mb20">
      @if (isset($UserInterview->interview_type))
        <p class="p0 qualifType"> Interview Type: <b>  {{$UserInterview->interview_type}} </b> </p>
        @else
          @if ($UserInterview->template->type == 'phone_screeen')
            <p class="p0 qualifType"> Interview Type: <b> Phone Screen</b> </p>
          @else
            <p class="p0 qualifType"> Interview Type: <b> {{$UserInterview->template->type}} </b> </p>
          @endif
      @endif
    </div>

    <div class="actionButton">
        <button class="btn small leftMargin turquoise acceptButton" data_url = "{{$UserInterview->url}}">Accept</button>
        <button class="btn small leftMargin turquoise rejectButton ml20" data_url = "{{$UserInterview->url}}">Reject</button>
    </div>

    <p class="errorsInFields"></p>
  </div>

</div>


{{-- ===================================================== Accept hide show =====================================================  --}}


<form method="POST" name="saveInterviewResponse" class="saveInterviewResponse">

    <div class="job_row interviewBookingsRow hide_it">
      <div class="mb20"></div>
      <div class="job_heading p10">
        <div class="w_80p">
          <h3 class=" job_title"><a> <b>Invitation 1: </b> Interview from {{$UserInterview->employer->name}}</a></h3>
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

      {{-- @dd($UserInterview->template->type); --}}
      <div class="job_info row p10 dblock">
        <div class="timeTable">
          <div class="IndustrySelect">
            <p class="p0 qualifType"> Template Name: <b>  {{$UserInterview->template->template_name}} </b> </p>
            @if ($UserInterview->template->type == 'phone_screeen' )
              <p class="p0 qualifType"> Template Type: <b> Phone Screen</b> </p>
            @else
              <p class="p0 qualifType"> Template Type: <b> {{$UserInterview->template->type}} </b> </p>
            @endif
            <p class="p0 qualifType"> Interviewer Name: <b> {{$UserInterview->employer->name}} </b> </p>
          </div>
        </div>

        <input type="hidden" name="userInterviewId" value="{{$UserInterview->id}}">
        <input type="hidden" name="temp_id" value="{{$UserInterview->template->id}}">
        <input type="hidden" name="emp_id" value="{{$UserInterview->employer->id}}">
        <div class="timeTable">
          <div class="IndustrySelect">
            <p class="p0 qualifType center bold"> Template Questions </p>
              {{-- @dump($UserInterview->tempQuestions) --}}
              @foreach ($InterviewTempQuestion as $key=> $quest)
                {{-- @dump($quest)  --}}
                <p class="p0 qualifType" name = ""> {{$quest->question}} </p>
                @if ($quest->video_response == 1)

                    <p> Upload video to answer this question </p> 

                    <input type="hidden" name="answer[{{$quest->id}}]">
                    {{-- <input type="text" class="w100" name="answer[{{$quest->id}}]"> --}}
                    {{-- <div id="list_videos_public" class="list_videos_public">
                        <div id="photo_add_video" class="item add_photo add_video_public item_video">
                            <a class="add_photo" onclick="SelectVideoFileForInterview();">
                                <img id="video_upload_select" class="transparent is_video" onload="$(this).fadeTo(100,1);" src="{{asset('images/site/icons/add_video160x120.png')}}" style="opacity: 1;">
                            </a>
                        </div>
                    </div> --}}
                   {{--  <a class="add_photo" onclick="SelectVideoFileForInterview();">
                        <img id="video_upload_select" class="transparent is_video" onload="$(this).fadeTo(100,1);" src="{{asset('images/site/icons/add_video160x120.png')}}" style="opacity: 1;">
                    </a> --}}

                    <img src="https://img.icons8.com/color/48/000000/video.png"/>
                    
                    {{-- <input type="file" name="answer[{{$quest->id}}]"> --}}

                  @else

                    <input type="text" class="w100" name="answer[{{$quest->id}}]">

                @endif
              @endforeach
          </div>
        </div>
        <div class="actionButton mt20">
          <a class="jobApplyBtn graybtn jbtn" onclick="saveResponseAsJobseeker()" data_url = "{{$UserInterview->url}}" >Save Reponse</a>
        </div>
        <p class="errorsInFields qualifType"></p>
      </div>
    </div>
</form>

{{-- <p class="errorsInFields"></p> --}}


<script type="text/javascript">

$('.acceptButton').on('click',function() {
  event.preventDefault();
  var acceptUrl = $(this).attr('data_url');
  $('.interviewBookingsRow').removeClass('hide_it');
  $('.acceptDiv').addClass('hide_it');
});



$('.rejectButton').on('click',function() {
    event.preventDefault();
    // var formData = $('.crossReference').serializeArray();
    var rejectUrl = $(this).attr('data_url');
    $('.rejectButton').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
    $('.general_error1').html('');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/reject/interview/invitation',
         data:{url:rejectUrl},
        success: function(data){
            console.log(' data ', data);
            $('.rejectButton').html('Rejected').prop('disabled',false);
            if( data.status == 1 ){
                $('.errorsInFields').text('Interview rejected successfully');
                setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                window.location.href = "{{ route('intetviewInvitation')}}" ;
            }else{
               setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
            }

        }
    });
});

// ======================================================= Save Response as jobseeker =======================================================

// $('.saveResponseAsJobseeker').on('click',function() {

this.saveResponseAsJobseeker = function($url){
  console.log('button clicked beautifully');
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
}


// });


// video upload option
    this.SelectVideoFileForInterview = function(){
        // console.log(' Clicked on upload video ');return;
        var input = document.createElement('input');
        input.type = 'file';
        input.onchange = e => {
            var file = e.target.files[0];
            console.log(' onchange file  ', file );
            var formData = new FormData();
            formData.append('video',file);
            var that        = this;
            var item_id     =  Math.floor((Math.random() * 1000) + 1);
            var video_item = '';
            video_item  += '<div id="v_'+item_id+'" class="item profile_photo_frame item_video" style="display: inline-block;">';
            video_item  +=  '<a class="show_photo_gallery video_link" href="">';
            // video_item  +=   '<img src="'+base_url+'/images/site/icons/cv.png" style="opacity: 1; display: inline;" title="vvtt11" class="photo" id="video_v_1" data-video-id="v_1">';
            video_item  +=  '</a>';
            video_item  +=  '<span class="v_title">Video title</span>';
            video_item  +=  '<span title="Delete video" class="icon_delete">';
            video_item  +=      '<span class="icon_delete_photo"></span>';
            video_item  +=      '<span class="icon_delete_photo_hover"></span>';
            video_item  +=  '</span>';
            video_item  +=  '<div class="v_error error hide_it"></div>';
            video_item  +=  '<div class="v_progress"></div>';
            video_item  += '</div>';

            $('.list_videos').append(video_item);
            var updateForm = document.querySelector('form');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var request = new XMLHttpRequest();
            request.upload.addEventListener('progress', function(e){
               var percent = Math.round((e.loaded / e.total) * 100);
                 console.log(' progress-bar ', percent+'%' );
                 $('#v_'+item_id+' .v_progress').css('width',  percent+'%');
            }, false);
            request.addEventListener('load', function(e){
               console.log(' load e ', e);
               var res = JSON.parse(e.target.responseText);
               console.log(' jsonResponse ', res);
               $('#v_'+item_id+' .v_progress').remove();
                if(res.status == 1) {
                    // $('#v_'+item_id+' .v_title').text(res.data.title);
                    // $('#v_'+item_id+' .video_link').attr('href', base_url+'/'+res.data.file);
                    $('#v_'+item_id).replaceWith(res.html);
                }else {
                    console.log(' video error ');
                    if(res.validator != undefined){
                        $('#v_'+item_id+' .error').removeClass('hide_it').addClass('to_show').text(res.validator['video'][0]);
                    }
                }
            }, false);
            request.open('post',base_url+'/ajax/interview-response/uploadVideo');
            request.send(formData);
        }
        input.click();

    }


</script>