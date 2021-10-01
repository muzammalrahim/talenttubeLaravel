
{{-- @dump($UserInterview) --}}
@extends('web.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')

<div class="newJobCont">
  <div class="head icon_head_browse_matches">Interview Invitations <a href="{{ route('unhideInterviews') }}" class="unhideInterviews"> Click here to Un-Hide your interviews </a> </div>
  @if ($UserInterview->count() > 0)
  @foreach ($UserInterview   as $interview)

  @dd($interview->template->template_name)
  <div class="job_row interviewBookingsRow_{{$interview->id}}">
    
    <div class="job_heading p10">
      <div class="w70 dinline_block">
        <h3 class=" job_title"><a> <b>Invitation {{$loop->index+1}}: </b> Interview with {{$interview->js->name}}</a></h3>
      </div>


      <div class="w10 selectStatus d-contents">

        <form class="statusOfInterview d-contents" name="statusOfInterview">  
          @csrf
          <select name="hide">
            <option value= "0"> Select Status   </option> 
            <option value= "yes"> Hide Interview </option> 
            @if ($interview->status == 'pending')
              <option value= "decline"> Decline Interview </option> 
            @endif
          </select>
          <input type="hidden" class="interview_id" name="interview_id" value="{{$interview->id}}">
        </form>

      </div>

      <div class="fl_right">
        <div class="j_label bold">Status:</div>
          <div class="j_value text_capital">{{$interview->status}}</div>
      </div>
    </div>

    <div class="job_info row p10 dblock">
      <div class="timeTable">
        <div class="IndustrySelect">
          <p class="p0 qualifType m5"> Template Name: <b> {{$interview->template->template_name}} </b> </p>
          @if ($interview->template->type == "phone_screeen")
            <p> Template Type: <b> Phone Screen</b> </p>
          @else
            <p class="p0 qualifType m5"> Template Type: <b> {{$interview->template->type}} </b> </p>
          @endif
           <div class="j_button pb20">
               <a class="jobApplyBtn graybtn jbtn seeDetailOfInterview" href="{{ route('interviewInvitationUrl',['url' =>$interview->url]) }}" data-jobid="{{$interview->id}}">Click here to See the response</a>
           </div>
        </div>
      </div>


    </div>
  </div>

@endforeach  
@else
<h3> You have not booked any interview yet</h3>
@endif

<div class="cl"></div>
</div>
{{-- @include('site.user.interview.popup') --}}
@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<style>

.timeTable{width: 33%;display: block;}
.width75p{width: 75%;display: inline-block;}
.bgColor{background: #dddfe3;}
.confirmInterview{margin: 15px 0 !important;}


</style>

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>

<script type="text/javascript">

$(document).ready(function(){

  $(document).on("click" , ".seeDetailOfInterview" , function(){
    // console.log("Hi Interview Invitaion Button");
    $(this).parents('.job_row').find('.timeTable11').toggleClass('hide_it');
  });

  $(document).on("click" , ".confirmInterview" , function(){
    var abcdef = $(this).attr('data-intId');
    // console.log(abcdef);

    var formdate = $(this).parents('.confirmSubmitInterview').serializeArray();
    console.log(formdate);
    
    // Ajax call

    $('.general_error').html('');
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/confirmInterInvitation',
        data: formdate,
        success: function(data){

            $('.loginEditInterview').html('Save').prop('disabled',false);
            if( data.status == 1 ){
                window.location.replace(data.route);
            }else{

                if(data.validator != undefined){
                    const keys = Object.keys(data.validator);
                    for (const key of keys) {
                        if($('#'+key+'_error').length > 0){
                            $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(data.validator[key][0]);
                        }
                    }

                    setTimeout(() => {
                        for (const key of keys) {
                            if($('#'+key+'_error').length > 0){
                                $('#'+key+'_error').removeClass('to_show').addClass('to_hide');
                            }
                        }
                    }
                        ,3000);
                }
               if(data.error != undefined){
                 //$('.general_error').html('<p>Error Creating new Booking</p>').removeClass('to_hide').addClass('to_show');
                 $('.general_error').append(data.error);
               }
               setTimeout(() => { $('.general_error').removeClass('to_show').addClass('to_hide').text(''); },3000);
            }

        }
    });

    // Ajax call end here
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
        url: base_url+'/ajax/userInterview/hide',
        data: formData,
        success: function(response){
            console.log(' response ', response);
            // $('.selectStatus').html('Send Email').prop('disabled',false);
            $('.interviewBookingsRow_'+interview_id).remove();
            if( response.status == 1 ){
                // $('.errorsInFields').text('Notification sent sucessfully');
                // setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
            }else{

                  
            }

        }
    });
  });

  // ========================================================= Change Status of interview =========================================================






});

</script>
@stop

