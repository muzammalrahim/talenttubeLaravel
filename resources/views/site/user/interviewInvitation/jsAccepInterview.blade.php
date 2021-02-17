




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
        {{-- <p class="p0 qualifType"> Template Name: <b>  {{$UserInterview->template->template_name}} </b> </p> --}}
        @if ($UserInterview->template->type = 'phone_screeen')
          <p class="p0 qualifType"> Interview Type: <b> Phone Screen</b> </p>
        @else
          <p class="p0 qualifType"> Template Type: <b> {{$UserInterview->template->type}} </b> </p>
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
                {{-- @dump($quest->question) --}}
                <p class="p0 qualifType" name = ""> {{$quest->question}} </p>
                <input type="text" class="w100" name="answer[{{$quest->id}}]">
              @endforeach
          </div>
        </div>
        <div class="actionButton mt20">
          <button class="btn small leftMargin turquoise saveResponseAsJobseeker" data_url = "{{$UserInterview->url}}">Save Reponse</button>
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
/*    $('.acceptButton').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
    $('.general_error1').html('');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/accept/interview/invitation',
         data:{url:acceptUrl},

        success: function(data){
            console.log(' data ', data);
            $('.acceptButton').html('Accepted').prop('disabled',false);
            if( data.status == 1 ){
                $('.errorsInFields').text('Interview accepted successfully');
                setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                window.location.href = "{{ route('intetviewInvitation')}}" ;

            }else{
                // $('.errorsInFields').text('Error occured');
               setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
            }

        }
    });*/

});



$('.rejectButton').on('click',function() {
    event.preventDefault();
    // var formData = $('.crossReference').serializeArray();
    var rejectUrl = $(this).attr('data_url');

    $('.rejectButton').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
    // console.log(' formData ', formData);
    $('.general_error1').html('');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/reject/interview/invitation',
        // data: formData,
         data:{url:rejectUrl},

        success: function(data){
            console.log(' data ', data);
            $('.rejectButton').html('Rejected').prop('disabled',false);
            if( data.status == 1 ){
                $('.errorsInFields').text('Interview rejected successfully');
                setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
                window.location.href = "{{ route('intetviewInvitation')}}" ;
            }else{
                // $('.errorsInFields').text('Error occured');
               setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
            }

        }
    });
});

</script>