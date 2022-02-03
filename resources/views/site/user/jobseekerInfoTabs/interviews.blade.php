@if ($interview_booking->count() > 0)
@foreach ($interview_booking as $booking)
<p> <span class="bold">{{$loop->index+1}})  {{$jobSeeker->name}} </span>  has booked interview for the position of <span class="bold"> {{$booking->interview->positionname}} </span> </p>
@endforeach
@else
<p> This user has not any booking yet</p>
@endif
{{-- @dump($UserInterview) --}}
{{-- ========================================================== User Interviews ========================================================== --}}
@include('site.user.jobseekerInfoTabs.userInterviewForJobseeker')   {{-- site/user/jobseekerInfoTabs/userInterviewForJobseeker --}}

<p> To conduct an interview with <b> {{$jobSeeker->name}} </b>, please <span style="text-decoration: underline" class="pointer displayInterviewTemplate"> click here </span> to see the available interview templates </p>
{{-- <p> If you want to conduct interview of <b> {{$jobSeeker->name}} </b> <span style="text-decoration: underline" class="pointer displayInterviewTemplate">  Click Here </span>  to see the available templates.</p> --}}
<div class="tempDisplayforemployer hide_it job_row col-md-12 col-12 job-box-info concigerge-box clearfix p-0" style="background-color: #f8f8f8;">
   <form method="POST" name="interviewTemplate" class="interviewTemplate newJob job_validation">
      @csrf
      <div class="row box-head m-0 ">
         <h3 class="col-3 bold m-auto text-white">Interview Template:</h3>
         <select class="templateSelect col-9 form-control icon_show" name="templateSelect">
            <option value="0"> Select Template</option>
            @foreach ($interviewTemplate as $template)
            <option value="{{ $template->id }}"> 
               {{$template->template_name}} 
            </option>
            @endforeach
         </select>
         <span class="btn small leftMargin turquoise interviewLoader"></span>
      </div>
   </form>
   {{-- ========================== Get Template and questions through aja and embed them in below div ========================== --}} 
   <form method="POST" name="interviewTemplateSave" class="interviewTemplateSave newJob job_validation">
      <div class="templateData p10"></div>
      <input type="hidden" name="user_id" value="{{$jobSeeker->id}}" class="jsId">
      {{-- <button type="button"> Save response</button> --}}
   </form>
</div>
<input type="hidden" name="" value="{{$jobSeeker->id}}" class="jsId">
<script type="text/javascript">
   {{-- ===================================== Hide Show interview Template on click ===================================== --}}
   $(document).on("click" , ".displayInterviewTemplate" , function(){
    $('.tempDisplayforemployer').toggleClass('hide_it');
   });
   {{-- ===================================== Hide Show interview Template on click ===================================== --}}
   $('.interviewTemplate').on('change',function() {
      event.preventDefault();
      var formData = $('.interviewTemplate').serializeArray();
      $('.interviewLoader').html(getLoader('pp_profile_edit_main_loader interviewTemplateLoader')).prop('disabled',true);
      console.log(' formData ', formData);
      $('.general_error1').html('');
        $.ajax({
            type: 'POST',
                url: base_url+'/ajax/interview/template',
            data: formData,
              success: function(data){
                  // console.log(' data ', data);
                  $('.interviewTemplateLoader').addClass('hide_it');
                  $('.interviewLoader').prop('disabled',false);
                  $('.templateData').html(data);
              }
        });
   });
      // ============================================ Conduct Interview ============================================
      $(document).on("click" , ".conductInterview123" , function(){
          var inttTempId = $('.conductInterview123').val();
          var employers_instruction = $('.employers_instruction').val();
          var user_id = $('.jsId').val();
          // console.log(user_id);
          $('.conductInterview123').html(getLoader('pp_profile_edit_main_loader conductInterviewLoader')).prop('disabled',true);
          $('.general_error1').html('');
          $.ajaxSetup({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
          $.ajax({
              type: 'POST',
              url: base_url+'/ajax/conduct/interview',
              data: {inttTempId,user_id,employers_instruction},
              success: function(response){
                  if(response.status == 1){
                      var message = response.message;
                      $('.recordalreadExist').removeClass('hide_it').text(message);
                      $('.conductInterviewLoader').addClass('hide_it');
                      $('.interviewTemplateLoader').addClass('hide_it');
                      $('.conductInterview123').html('Interview Conducted').prop('disabled',false);
                      setTimeout(function(){
                      $('.recordalreadExist').addClass('hide_it'); },
                      3000);  
                      location.reload();
                      // window.location.href = "{{ route('intetviewInvitationEmp')}}" ;
                  }
                  /*else if(response.status == 2){
                      var inst_error = response.validator['employers_instruction'].toString();
                      // var error = inst_error.toString();
                      console.log(inst_error);
                      $('.liveInterviewError').removeClass('hide_it');
                      $('.liveInterviewError').text(inst_error);
                      $('.conductInterview123').html('Correspondance Interview').prop('disabled',false);
                      setTimeout(function(){
                          $('.liveInterviewError').addClass('hide_it');
                      }, 4000);
                  } */
                  else if(response.status == 0){ 
                      var inst_error = response.message;
                      // var error = inst_error.toString();
                      console.log(inst_error); 
                      $('.liveInterviewError').removeClass('hide_it');
                      $('.liveInterviewError').text(inst_error);
                      $('.conductInterview123').html('Correspondance Interview').prop('disabled',false);
                      setTimeout(function(){
                          $('.liveInterviewError').addClass('hide_it');
                      }, 4000);
                  } 
                  else{ 
                      var message = response.message;
                      // var abc = response.messge
                      $('.recordalreadExist').removeClass('hide_it').text(message); 
                      $('.interviewTemplateLoader').addClass('hide_it');
                      $('.conductInterview123').html('Error Occured').prop('disabled',false);
                      setTimeout(function(){
                      $('.recordalreadExist').addClass('hide_it'); },
                      3000);
                  }
              }
          });
      });
      // ============================================ Live Interview button ============================================
      $(document).on('click' , '.liveInterviewButton', function (){
          $('.answersInput').removeClass('hide_it');
          $('.liveInterview').removeClass('hide_it'); 
          $('.liveInterviewButton').addClass('hide_it'); 
          $('.conductInterview123').addClass('hide_it');
      });
   
      // ============================================ Live Interview ============================================
      $(document).on("click" , ".liveInterview" , function(){
          var formData = $('.interviewTemplateSave').serializeArray();
          $('.liveInterview').html(getLoader('pp_profile_edit_main_loader liveInterviewTemplateLoader')).prop('disabled',true);
          console.log(' formData ', formData);
          // return;
          $('.general_error1').html('');
          $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
              $.ajax({
                  type: 'POST',
                  url: base_url+'/ajax/live/interview',
                  data: formData,
                  success: function(response){
                  if(response.status == 1){
                      var message = response.message;
                      // console.log(message);
                      $('.liveInterviewError').removeClass('hide_it').text(message);
                      $('.conductInterviewLoader').addClass('hide_it');
                      $('.liveInterviewTemplateLoader').addClass('hide_it');
                      $('.liveInterview').html('Interview Saved').prop('disabled',false);
                      location.reload();
                      setTimeout(function(){
                      $('.liveInterviewError').addClass('hide_it'); },
                      3000);  
                      // window.location.href = "{{ route('intetviewInvitationEmp')}}" ;
                  }
                  else{
                      var message = response.message;
                      $('.liveInterviewError').removeClass('hide_it').text(message);
                      $('.liveInterviewTemplateLoader').addClass('hide_it');
                      $('.liveInterview').html('Live Interview').prop('disabled',false);
                      setTimeout(function(){
                      $('.liveInterviewError').addClass('hide_it'); },
                      3000);
   
                  }
              }
              });
      });
   
</script>