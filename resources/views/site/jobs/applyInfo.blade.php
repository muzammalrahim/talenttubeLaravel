

<div class="jobApplyform bl_frm">
    <div class="p20">
        <form method="POST" name="job_apply_form" id="job_apply_form" class="job_apply_form jobApply jobApply_validation">
            @csrf
            <div class="applyData"> <div class="ja_header"> <h3 class="jobTitle">{{$job->title}}</h3> </div>
                @if (!empty($job->questions))
                    @php
                        $questions = $job->questions;
                    @endphp
                    @if (count($questions) > 0)
                    <div class="ja_header"><p>Almost done, few questions before your resume is accepted for this job.</p></div>
                    <div class="jobQuestions">
                        @foreach ($questions as $question)
                        <div class="job_question form_field">
                             <input type="hidden" name="answer[{{$question['id']}}][question_id]" value="{{$question['id']}}" />
                            <div class="form_qstn">
                                @php 
                                    $remSpecialCharQues = str_replace("\&#39;","'",$question['title']);
                                @endphp
                                <span class="">{{$remSpecialCharQues}}</span>
                            </div>
                            <div class="form_qstn_options">
                                @if(!empty($question->options && !empty($question) ))
                                    <select name="answer[{{$question['id']}}][option]">
                                        @foreach($question->options as $option)
                                            @php
                                                $remSpecialChar = str_replace("\&#39;","'",$option);
                                            @endphp
                                            <option value="{{$option}}">{{$remSpecialChar}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>

                        @endforeach
                    </div>
                    @endif
                @endif

                <div class="ja_description">
                    <div class="form_qstn">
                         {{ jobApplicationMandatoryQuestion() }}
                    </div>
                    <div class="ja_descriptionAnswer">
                        <textarea name="application_description" class="w100" title="Add a 250 character word minimum" style="height: 100px;"></textarea>
                        <div class="characterCount"><span class="count">0</span> / 150 minimum character</div>
                    </div>
                </div>

            </div>

            <input type="hidden" name="job_id" value="{{$job->id}}" />
            <input type="hidden" name="test_id" value="{{$job->onlineTest_id}}" />

            {{-- ========================================== If online test exists ========================================== --}}
            
            @if (!isset($onlineTest))
                <div class="fomr_btn act_field center">
                    <button class="btn small turquoise submitApplication" disabled>Submit</button>
                </div>
            @else
                <div class="fomr_btn act_field center submitBuutonDiv hide_it"> </div>
            @endif

        </form>

        {{-- ========================================== If online test exists ========================================== --}}
        
        @if (isset($onlineTest))
            @include('site.jobs.onlineTest') {{-- site/jobs/onlineTest --}}
        @endif

    </div>

    <script type="text/javascript">
      jQuery(document).ready(function(){
        $('.jobApplyform input, .jobApplyform select').styler({ selectSearch: true,});
      });

    $(document).on('click' , '.proceedTest', function(){
        $('.applyData').addClass('hide_it');
    }); 
    </script>

</div>
