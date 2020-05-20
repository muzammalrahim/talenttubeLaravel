

<div class="jobApplyform bl_frm">
<div class="p20">
    <form method="POST" name="job_apply_form" id="job_apply_form" class="job_apply_form jobApply jobApply_validation">
    @csrf
    <div class="ja_header">
        <h3>{{$job->title}}</h3>
    </div>

    @if (!empty($job->questions))
        @php
            $questions = json_decode($job->questions, true);
        @endphp

        @if (count($questions) > 0)
        <div class="ja_header"><p>Almost done, few questions before your resume is accepted for this job.</p></div>
        <div class="jobQuestions">
            @foreach ($questions as $question)
            <div class="job_question form_field">
                <div class="form_qstn">
                    <span class="">{{$question}}</span>
                </div>
                <div class="form_qstn_input">
                    <input type="text" value="" name="applyAnswer[]" class="w100">
                </div>
            </div>
            @endforeach
        </div>
        @endif
    @endif




    <input type="hidden" name="job_id" value="{{$job->id}}" />
    <div class="fomr_btn act_field center">
        <button class="btn small turquoise submitApplication">Submit</button>
    </div>

    </form>
</div>
</div>
