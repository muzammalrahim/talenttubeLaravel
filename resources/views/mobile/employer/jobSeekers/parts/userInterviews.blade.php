

<div class="text-dark card shadow bg-white rounded" style="margin: 0px -15px 0px -15px;">
  @if ($UserInterview->count() > 0)
  
  <div class="card-header jobInfoFont jobAppHeader p-2"> <b> {{$jobSeeker->name}} </b> has given below interview </div>
  @foreach ($UserInterview as $Int_booking)
  <div class="interviewrow py-2 interviewBookingsRow_{{$Int_booking->id}}">
    <div class="row m-0">
      <div class="col p-0 mx-3">
        <p class="font11 mb-1"><b>Invitation {{$loop->index+1}}: </b></p>
      </div>
      <div class="col p-0 mx-3 float-right">
          <div class="font11 mb-1 font-weight-bold float-left mr-2">Status:</div>
          <div class="font11 mb-1 text_capital">{{$Int_booking->status}}</div>
      </div>
    </div>


    <div class="job_info d-block mx-3">
        <p class="font11 mb-1"><a><b>Type:</b> {{$Int_booking->template->type}}</a> </p>
         <p class="font11 mb-1"> <b>Template:</b> {{$Int_booking->template->template_name}}  </p>
    </div>

    <div class="employerResponseDiv d-block mx-3">
        @if ($Int_booking->status == 'Interview Confirmed' )
            <div class="pb20">
               <a class="btn btn-sm btn-primary seeEmployerResponse">See Employer's Response</a>
            </div>
            @php
              $temp_id = $Int_booking->temp_id;
              $tempQuestions = App\InterviewTempQuestion::where('temp_id', $temp_id)->get();
            @endphp
            <div class="employerResponse hide">
              @foreach ($tempQuestions as $question)
                <p class="font11 mb-1"> <b>Question {{$loop->index+1}})</b> {{$question->question}} </p>
                @php
                  $answers = App\UserInterviewAnswers::where('question_id', $question->id)->where('user_id', $jobSeeker->id)->first();   
                @endphp
                <p class="font11 mb-1"> <b>Employer's Response:</b> {{$answers->answer}} </p>
              @endforeach
            </div>
        @endif
    </div>

  </div>
@endforeach  
@else
      <p class="mx-3"> {{$jobSeeker->name}} have not given any interview yet.</p>
@endif

</div>






<p class="text-dark mt-3"> If you want to conduct interview of <b> {{$jobSeeker->name}} </b> <span style="text-decoration: underline" class="cursor-pointer displayInterviewTemplate">  Click Here </span>  to see the available templates.</p>

<div class="tempDisplayforemployer d-none job_row text-dark">
  <form method="POST" name="interviewTemplate" class="interviewTemplate newJob job_validation">
  @csrf
    <div class="job_title form_field job_heading p10">
      <p class="font11 float-left mb-1">Interview Template:</p>
      <select class="templateSelect form-control" name="templateSelect" >
        <option value="0"> Select Template</option>
        @foreach ($interviewTemplate as $template)
          <option value="{{ $template->id }}"> 
            {{$template->template_name}} 
          </option>
        @endforeach
      </select>

      <div class="itntLoader d-none text-center mt-2" >
        <div class="interviewLoader spinner-border text-primary text-primary" role="status"></div>
      </div>

    </div>
  </form>

  {{-- ========================== Get Template and questions through aja and embed them in below div ========================== --}}

  <div class="templateData p10"></div>

  <input type="hidden" name="" value="{{$jobSeeker->id}}" class="jsId">


</div>

<script type="text/javascript">
  
  {{-- ===================================== Hide Show interview Template on click ===================================== --}}

  $(document).on("click" , ".displayInterviewTemplate" , function(){
    $('.tempDisplayforemployer').toggleClass('d-none');
  });

  $('.interviewTemplate').on('change',function() {
    event.preventDefault();
    var formData = $('.interviewTemplate').serializeArray();
    // $('.interviewLoader').html(getLoader('pp_profile_edit_main_loader interviewTemplateLoader')).prop('disabled',true);
    $('.itntLoader').removeClass('d-none');
    console.log(' formData ', formData);
    $('.general_error1').html('');
      $.ajax({
          type: 'POST',
          url: base_url+'/m/ajax/interview/template',
          data: formData,
            success: function(data){
                // console.log(' data ', data);
              $('.itntLoader').addClass('d-none');
              // $('.interviewTemplateLoader').addClass('hide_it');
              $('.interviewLoader').prop('disabled',false);
              $('.templateData').html(data);
            }
      });
  });


  // ============================================ Conduct Interview ============================================

  $(document).on("click" , ".conductInterview123" , function(){
      var inttTempId = $('.conductInterview123').val();
      var user_id = $('.jsId').val();
      console.log(user_id);
      // $('.conductInterview123').html(getLoader('pp_profile_edit_main_loader conductInterviewLoader')).prop('disabled',true);
      $('.conductIntLoader').removeClass('d-none');
      $('.general_error1').html('');
      $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
          type: 'POST',
          url: base_url+'/m/ajax/conduct/Minterview',
          data: {inttTempId,user_id},
          success: function(response){
              if(response.status == 1){
                  
                  var message = response.message;
                  $('.recordalreadExist').removeClass('d-none').text(message);
                  // $('.conductInterviewLoader').addClass('hide_it');
                  // $('.interviewTemplateLoader').addClass('hide_it');

                  $('.conductIntLoader').addClass('d-none');

                  $('.conductInterview123').html('Interview Conducted').prop('disabled',false);
                  setTimeout(function(){
                  $('.recordalreadExist').addClass('d-none'); },
                  3000);  

                  window.location.href = "{{ route('MintetviewInvitationEmp')}}" ;

              }
              else{

                  var message = response.message;
                  // var abc = response.messge
                  $('.recordalreadExist').removeClass('d-none').text(message);
                  // $('.interviewTemplateLoader').addClass('hide_it');
                  $('.conductInterview123').html('Error Occured').prop('disabled',false);
                  $('.conductIntLoader').addClass('d-none');

                  setTimeout(function(){
                  $('.recordalreadExist').addClass('d-none'); },
                  6000);

              }
              

          }
      });

  });

</script>