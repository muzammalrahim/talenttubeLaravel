   

<form method="POST" name="job_apply_form" id="job_apply_form" class="job_apply_form jobApply jobApply_validation">

    <div class="applyJobFormField row m-0">  
            <div class="text-center jobInfoFont mb-3">
              <strong>What motivated you to apply for this job and why do you think will be suitable?</strong>
            </div>
    </div>

    <div class="applyJobFormField mb-3">
        <textarea type="text" id="field" maxlength="300" name="application_description" class="md-textarea form-control" rows="3" placeholder="Answer"></textarea>


        <div id="charNum">  Maximum 300 Characters  </div>
    </div>

        @if (!empty($job->questions))
        @php
        $questions = $job->questions;
        @endphp
      
        @if (count($questions) > 0)
        @foreach ($questions as $question)

        <input type="hidden" name="answer[{{$question['id']}}][question_id]" value="{{$question['id']}}" />
        
        <div class="form_ qstn">
           <span class="m-0 row jobInfoFont font-weight-normal">{{$question['title']}}</span>
        </div>

        <div class="form_qstn_options row m-0">
           @if(!empty($question->options))

           <select name="answer[{{$question['id']}}][option]" class="browser-default custom-select custom-select mb-3 mb-2 mt-2">
              @foreach($question->options as $option)
              <option value="{{$option}}">{{$option}}</option>
              @endforeach
           </select>
           
           @endif
        </div>

        @endforeach
        @endif
        @endif

        <input type="hidden" name="job_id" value="{{$job->id}}">

        <input type="hidden" name="test_id" value="{{$job->onlineTest_id}}" />



        {{-- ========================================== If online test exists ========================================== --}}
        
        @if (!isset($onlineTest))

        <div class="fomr_btn act_field text-center">
            <a class="btn btn-sm btn-primary submitApplication">Submit</a>
        </div>

        @else
            <div class="fomr_btn act_field center submitBuutonDiv hide_it">
            </div>

        @endif

            <div class="error_applyingJob text-danger d-none"></div>

        </form>

            {{-- ========================================== If online test exists ========================================== --}}
        
        @if (isset($onlineTest))
            @include('mobile.jobs.onlineTest') {{-- mobile/jobs/onlineTest --}}
        @endif

        {{-- <div class="modal-footer justify-content-center">

        <a type="button" class="submitApplication btn btn-primary waves-effect waves-light">Submit
          <i class="fa fa-paper-plane ml-1"></i>
        </a> --}}



      </div>

   
{{-- </form> --}}





<script type="text/javascript">


  $('.submitApplication').click(function(){
    console.log('submit application');
      var applyFormData = $('#job_apply_form').serializeArray()

      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
        });
        $.ajax({
        type: 'POST',

            url: base_url+'/m/ajax/MjobApplySubmit',
            data: applyFormData,
            success: function(data){
                $('.submitApplication').html('Submit').prop('disabled',false);
                console.log(' data ', data );
                if (data.status == 1){
                     $('#job_apply_form').html(data.message);

                }else {
                    // $('#job_apply_form').html(data.error);

                    $('.error_applyingJob').removeClass('d-none');
                    $('.error_applyingJob').text(data.error);

                    setTimeout(function(){
                         $('.error_applyingJob').addClass('d-none');
                    },5000 );
                }
            }
        });

  });


  this.usePreviousResult = function (){
    event.preventDefault();
      console.log(' use previous result clicked ');
      var applyFormData = $('#job_apply_form').serializeArray()
      $.ajax({
      type: 'POST',
          url: base_url+'/m/ajax/use-mPrevious-result',
          data: applyFormData,
          success: function(data){
              console.log(' data ', data );
              if (data.status == 1){
                   $('#job_apply_form').html(data.message);
                   // var link = parseInt(data.userTest_id);
                   var jobApp_id = '<p class = "mt10"> Your test result has been submitted </p>';
                   $('.onlineTestBox').html(jobApp_id);

              }else {

                    $('.error_applyingJob').removeClass('d-none');
                    $('.error_applyingJob').text(data.error);

                    setTimeout(function(){
                         $('.error_applyingJob').addClass('d-none');
                    },5000 );
                    
                   // $('#job_apply_form').html(data.error);
                   $('.onlineTestBox').addClass('hide_it');
              }
          }
      });
  }
  // $(document).on('click','.usePreviousResult',function(){
      
  // });


  this.proceedtoTest = function(){
    console.log(' submitApplication submit click ');
    var applyFormData = $('#job_apply_form').serializeArray()
    $.ajax({
    type: 'POST',
        url: base_url+'/m/ajax/reject/test',
        data: applyFormData,
        success: function(data){
            // $('.submitApplication').html('Submit').prop('disabled',false);
            console.log(' data ', 'Hassaan is here' );
            if (data.status == 1){
                 $('#job_apply_form').html(data.message);
                 // $('.error_applyingJob').html(data.message).fadeOut('3000');

                 var link = parseInt(data.userTest_id);
                 var jobApp_id = '<a class = "mt10" href = "'+base_url+'/m/mProceed/test/'+link+'"> Click Here to Complete test  </a>';
                 $('.onlineTestBox').html(jobApp_id);

            }else {
                 // $('#job_apply_form').html(data.error);

                 console.log(data.error);
                 $('.error_applyingJob').removeClass('d-none');
                 $('.error_applyingJob').text(data.error);

                 setTimeout(function(){
                     $('.error_applyingJob').addClass('d-none');
                 },5000 );

                 $('.onlineTestBox').addClass('hide_it');
            }
        }
    });
  }


  this.rejectTest = function(){

    event.preventDefault();
    console.log(' submitApplication submit click ');
    // $('.submitApplication').html(getLoader('jobSubmitBtn')).prop('disabled',true);
    var applyFormData = $('#job_apply_form').serializeArray();
    console.log(applyFormData);
    $.ajax({
    type: 'POST',
        url: base_url+'/m/ajax/reject/test',
        data: applyFormData,
        success: function(data){
            $('.submitApplication').html('Submit').prop('disabled',false);
            console.log(' data ', data );
            if (data.status == 1){
                 // $('.error_applyingJob').html(data.message).fadeOut('3000');
                 $('.onlineTestBox').addClass('hide_it');
                 var jobApp_id = '<p class = "mt10" > Your application has been submitted, you can complete your test later </p';
                 $('.onlineTestBox').html(jobApp_id);

            }else {
                 $('.error_applyingJob').removeClass('d-none');
                 $('.error_applyingJob').html(data.error);
                 setTimeout(function(){
                     $('.error_applyingJob').addClass('d-none');
                 },5000 );

                 $('.onlineTestBox').addClass('hide_it');
            }
        }
    });
  }


  // $(document).on('click','.rejectTest',function(){
    
// });


$('#field').keyup(function () {
  var max = 300;
  var len = $(this).val().length;
  if (len >= max) {
    $('#charNum').text(' 0 Character left');
    // $('#charNum').css('disabled' , 'disabled');

  } else {
    var char = max - len;
    $('#charNum').text(char + ' characters left');
  }
});


</script>