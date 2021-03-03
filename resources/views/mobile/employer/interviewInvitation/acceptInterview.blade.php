


<div class="card">

  <div class="card-header jobAppHeader p-2 jobInfoFont acceptDiv interviewBookingsRow_{{$UserInterview->id}}">
    <div class="font11 m-0 p-0">      
      <p class="m-0"> <b>Invitation 1: </b> Inerview from {{$UserInterview->employer->company}}</p>
      <p class="m-0"> <b> Inerview Status: </b> {{$UserInterview->status}}</p>
    </div>
  </div>

  <div class="card-body jobAppBody p-2">
    <div class="questionBody">
      <div class="p10 dblock">
        <div class="IndustrySelect mb20">
              @if ($UserInterview->template->type = 'phone_screeen')
                <p class="p0 font11 m-0 mb-1"> Interview Type: <b> Phone Screen</b> </p>
              @else
                <p class="p0 font11 m-0 mb-1"> Template Type: <b> {{$UserInterview->template->type}} </b> </p>
              @endif
        </div>
      </div>

      <div class="actionButton">
          <button class="btn btn-sm btn-primary acceptButton" data_url = "{{$UserInterview->url}}">Accept</button>
          <button class="btn btn-sm btn-danger rejectButton ml20" data_url = "{{$UserInterview->url}}">Reject</button>
      </div>
    </div>

    {{-- <p class="errorsInFields"></p> --}}




    {{-- ===================================================== Accept hide show =====================================================  --}}


    <form method="POST" name="saveInterviewResponse" class="saveInterviewResponse">

          <div class="interviewDetail d-none">
              <div class="IndustrySelect">
                <p class="p0 font11 m-0 mb-1"> Template Name: <b>  {{$UserInterview->template->template_name}} </b> </p>
                <input type="hidden" name="userInterviewId" value="{{$UserInterview->id}}">
                <input type="hidden" name="temp_id" value="{{$UserInterview->template->id}}">
                <input type="hidden" name="emp_id" value="{{$UserInterview->employer->id}}">
                  <div class="IndustrySelect">
                    <h6 class="p0 m-0 mb-1 text-center font-weight-bold"> Template Questions </h6>
                      @foreach ($InterviewTempQuestion as $key=> $quest)
                        <p class="p0 font11 m-0 my-1" name = ""> {{$quest->question}} </p>
                        <input type="text" class="form-control" name="answer[{{$quest->id}}]">
                      @endforeach
                  </div>
                </div>

             <div class="save mt20">
              <button class="btn btn-sm btn-primary saveResponseAsJobseeker" data_url = "{{$UserInterview->url}}">Save Reponse</button>
            </div>
            <p class="errorsInFields font11 m-0"></p>
          </div>
    </form>
  </div>


</div>

<script type="text/javascript">

$('.acceptButton').on('click',function() {
  event.preventDefault();
  var acceptUrl = $(this).attr('data_url');
  $('.actionButton').addClass('d-none');
  $('.interviewDetail').removeClass('d-none');

});



// ============================================================== Save Response As Jobseeker ==============================================================


$('.saveResponseAsJobseeker').on('click',function() {
    event.preventDefault();
    var formData = $('.saveInterviewResponse').serializeArray();
    // $('.saveResponseAsJobseeker').html(getLoader('pp_profile_edit_main_loader responseLoader')).prop('disabled',true);
    $('.general_error1').html('');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/confirmInterInvitation/js',
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