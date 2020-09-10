   

<form method="POST" name="job_apply_form" id="job_apply_form" class="job_apply_form jobApply jobApply_validation">

    <div class="applyJobFormField row m-0">  
            <div class="text-center jobInfoFont mb-3">
              <strong>What motivated you to apply for this job and why do you think will be suitable?</strong>
            </div>
    </div>

    <div class="applyJobFormField mb-3">
        <textarea type="text" id="form79textarea" name="application_description" class="md-textarea form-control" rows="3" placeholder="Answer"></textarea>
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


        <div class="modal-footer justify-content-center">

        <a type="button" class="submitApplication btn btn-primary waves-effect waves-light">Submit
          <i class="fa fa-paper-plane ml-1"></i>
        </a>
        {{-- <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancel</a> --}}
      </div>

   
</form>





<script type="text/javascript">


  $('.submitApplication').click(function(){
    console.log('submit application');
      var applyFormData = $('#job_apply_form').serializeArray()
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
                     $('#job_apply_form').html(data.error);
                }
            }
        });

  });

</script>