
@extends('mobile.user.usermaster')
@section('content')

 
<h6 class="h6 jobAppH6">Submit Proposal</h6>

@include('mobile.jobs.jobsModal')


{{-- @if ($jobs->count() > 0)
@foreach ($jobs as $job) --}}

{{-- @dump( $job->questions ) --}}
    {{-- @dump($job->jobEmployer->name) --}}


 {{-- @dump(jobApplicationMandatoryQuestion()) --}}

<form method="POST" name="job_apply_form1" id="job_apply_form1" class="job_apply_form1 jobApply jobApply_validation">

    <div class="card border-info mb-3 shadow mb-3 bg-white rounded job_row jobApp_{{-- {{$application->id}} --}}">

        <div class="card">
            <div class="card-header jobAppHeader p-2 jobInfoFont">
                <a>{{$job->title}}</a>
            </div>

            <div class="card-body jobAppBody pt-2">

                <div class="row jobInfo">

                    <div class="col p-0 pl-3">
                        
                    </div>

                </div> 

                <p class="card-text jobDetail row">{{jobApplicationMandatoryQuestion()}}</p>
                <div class="form-group shadow-textarea row">
                    {{-- <label for="exampleFormControlTextarea6">Shadow and placeholder</label> --}}
                    <textarea class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="3" placeholder="your Answer..."></textarea>
                </div>

            @if (!empty($job->questions))
            @php
                $questions = $job->questions;
            @endphp

            {{-- @dump($questions) --}}

            @if (count($questions) > 0)
            <p class="card-text jobDetail row">Almost done, few questions before your resume is accepted for this job.</p>
                @foreach ($questions as $question)

                     <input type="hidden" name="answer[{{$question['id']}}][question_id]" value="{{$question['id']}}" />
                    <div class="form_ qstn">
                        <span class="card-text jobDetail row">{{$question['title']}}</span>
                    </div>
                    <div class="form_qstn_options row">
                        @if(!empty($question->options))
                            <select name="answer[{{$question['id']}}][option]" class="mdb-select md-form colorful-select dropdown-primary mb-2 mt-2">
                                @foreach($question->options as $option)
                                    <option value="{{$option}}">{{$option}}</option>
                                @endforeach
                            </select>

                        @endif
                    </div>

                @endforeach
            @endif

            @endif



            </div>

            <div class="card-footer text-muted jobAppFooter">

                <div class="text-center">

                        <a class="submitJobApplication graybtn jbtn btn btn-sm btn-primary mr-0 btn-xs" job-id ="{{$job->id}}" job-title="{{$job->title}}" {{-- data-toggle="modal" data-target="#modalJobApply" --}} > Submit </a>
                </div>
        

            </div>

        </div>

    </div> 
</form>

    


{{-- @endforeach
@endif   --}}   



@stop


@section('custom_footer_css')
<style type="text/css">


</style>
@stop

@section('custom_js')

<script type="text/javascript">
    
    $(document).ready(function() {
$('.mdb-select').materialSelect();
});


    $(document).on('click','.submitJobApplication',function(){
        event.preventDefault();
        console.log(' submitApplication submit click ');        
        // $('.submitApplication').html(getLoader('jobSubmitBtn')).prop('disabled',true);
        var applyFormData = $('#job_apply_form1').serializeArray()

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
                $('.submitJobApplication').html('Submit').prop('disabled',false);
                console.log(' data ', data );
                if (data.status == 1){
                     $('#job_apply_form1').html(data.message);
                }else {
                     $('#job_apply_form1').html(data.error);
                }
            }
        });

    });



</script>

@stop

