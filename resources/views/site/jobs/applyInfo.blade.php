

<div class="jobApplyform bl_frm">
<div class="p20">
    <form method="POST" name="job_apply_form" id="job_apply_form" class="job_apply_form jobApply jobApply_validation">
    @csrf
    <div class="ja_header">
        <h3>{{$job->title}}</h3>
        <p>Almost done, few questions before your resume is accepted for this job.</p>
    </div>

    <div class="jobQuestions">

        <div class="job_question form_field">
            <div class="form_qstn">
                <span class="">Do you have any of the following or equivalent qualification ?</span>
            </div>
            <div class="form_qstn_input">
                <input type="text" value="" name="applyAnswer[]" class="w100">
            </div>
        </div>

        <div class="job_question form_field">
            <div class="form_qstn"><span class="">Do you have work experience of 1 Year ?</span></div>
            <div class="form_qstn_input">
                <input type="text" value="" name="applyAnswer[]" class="w100">
            </div>
        </div>

        <div class="job_question form_field">
            <div class="form_qstn"><span class="">Do you have the following skills? </span></div>
            <div class="form_qstn_input">
                <input type="text" value="" name="applyAnswer[]" class="w100">
            </div>
        </div>

        <div class="job_question form_field">
            <div class="form_qstn"><span class="">Are you located in Lahore or willing to relocate? </span></div>
            <div class="form_qstn_input">
                <input type="text" value="" name="applyAnswer[]" class="w100">
            </div>
        </div>


        <div class="job_question form_field">
            <div class="form_qstn"><span class="">Your Proposal</span></div>
            <div class="form_qstn_input">
                <textarea name="applyProposal" class="form_editor w100" maxlength="1000" style="min-height: 120px;"></textarea>
            </div>
        </div>

        <input type="hidden" name="job_id" value="{{$job->id}}" />

        <div class="fomr_btn act_field center">
            <button class="btn small turquoise submitApplication">Submit</button>
        </div>

    </div>
    </form>
</div>
</div>
