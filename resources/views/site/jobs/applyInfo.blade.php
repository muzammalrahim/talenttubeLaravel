

<div class="jobApplyform bl_frm">
<div class="p20">
    <form method="POST" name="job_apply_form" id="job_apply_form" class="job_apply_form jobApply jobApply_validation">
    @csrf
    <div class="ja_header">
        <h3>{{$job->title}}</h3>
    </div>
    {{-- @dd( $job->questions ) --}}
    @if (!empty($job->questions))
        @php
            $questions = $job->questions;
        @endphp

        {{-- @dump($questions) --}}

        @if (count($questions) > 0)
        <div class="ja_header"><p>Almost done, few questions before your resume is accepted for this job.</p></div>
        <div class="jobQuestions">
            @foreach ($questions as $question)
            <div class="job_question form_field">
                 <input type="hidden" name="answer[{{$question['id']}}][question_id]" value="{{$question['id']}}" />
                <div class="form_qstn">
                    <span class="">{{$question['title']}}</span>
                </div>
                <div class="form_qstn_options">
                    @php
                        $q_options = !empty($question['options'])?(json_decode($question['options'],true)):array();
                    @endphp
                        {{-- @dump(  $q_options ) --}} 
                        {{-- <input type="text" value="" name="applyAnswer[]" class="w100"> --}}
                    {{-- @dd( $question ) --}}

                    @if(!empty($q_options))
                         <select name="answer[{{$question['id']}}][option]">
                            @foreach($q_options as $option)
                            {{-- <option value="{{$option['text']}}">{{$option['text']}} {{(isset($option['preffer']))?'(preffer)':''}} {{(isset($option['goldstar']))?'(goldstar)':''}} </option> --}}
                            <option value="{{$option}}">{{$option}}</option>
                            @endforeach
                        </select>
                    @endif
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

<script type="text/javascript">
  jQuery(document).ready(function(){
    $('.jobApplyform input, .jobApplyform select').styler({ selectSearch: true,});
  });    
</script>

</div>

