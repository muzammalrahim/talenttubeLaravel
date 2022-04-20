

<div class="jobApplyform bl_frm">
    <div class="row Apply-modal-body">
        <form method="POST" name="job_apply_form" id="job_apply_form" class="job_apply_form jobApply jobApply_validation">
            @csrf
                <h4 class="first-heading">{{$job->title}}</h4>
            @if (!empty($job->questions))
                @php
                    $questions = $job->questions;
                @endphp
                @if (count($questions) > 0)
                    <p>Please complete the below questions in order to submit your job application</p>
                <div class="jobQuestions">
                    @foreach ($questions as $question)
                    <div class="job_question form_field col-md-12 Apply-job-modal-form">
                         <input type="hidden" name="answer[{{$question['id']}}][question_id]" value="{{$question['id']}}" />
                        <div class="form_qstn">
                            @php 
                                $remSpecialCharQues = str_replace("\&#39;","'",$question['title']);
                            @endphp
                            <span class="">{{$remSpecialCharQues}}</span>
                        </div>
                        <div class="form_qstn_options my-2">
                            @if(!empty($question->options && !empty($question) ))
                                
                                <select name="answer[{{$question['id']}}][option]" class="w-100 selectpicker">
                                    @foreach($question->options as $option)
                                        @php
                                            $remSpecialChar = str_replace("\&#39;","'",$option);
                                        @endphp
                                        <option value="{{$option}}">{{$remSpecialChar}}</option>
                                    @endforeach
                                </select>

                                {{-- <ul class="question-radiobtn">
                                    @foreach($question->options as $option)
                                        @php
                                            $remSpecialChar = str_replace("\&#39;","'",$option);
                                        @endphp
                                        <li>
                                            <div class="form-check emp-redio">
                                                <input type="radio" value="{{$option}}" id="test1" name="answer[{{$question['id']}}][option]" checked>
                                                <label for="test1"> {{ $remSpecialChar }}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul> --}}

                            @endif
                        </div>
                    </div>

                    @endforeach
                </div>
                @endif
            @endif

            <div class="ja_description">
                <div class="form_qstn my-2">
                     {{ jobApplicationMandatoryQuestion() }}
                </div>

                <div class="ja_descriptionAnswer">
                    <textarea name="application_description" class="form-control" id="application_description" maxlength="300" max class="w100" title="Add a 250 character word minimum" style="height: 100px;"></textarea>
                    {{-- <div class="characterCount"><span class="count">0</span> / 300 minimum character</div> --}}

                    <div id="charNum" class="mt10">  Maximum 300 Characters  </div> 

                </div>
            </div>


            <input type="hidden" name="job_id" value="{{$job->id}}" />
            <input type="hidden" name="test_id" value="{{$job->onlineTest_id}}" />

            {{-- ========================================== If online test exists ========================================== --}}
            
            @if (!isset($onlineTest))
                <div class="fomr_btn act_field center">
                    <button class="btn small turquoise orange_btn" onclick="submitApplication()">Submit</button>
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
</div>

    <script type="text/javascript">
      jQuery(document).ready(function(){
        $('.jobApplyform input, .jobApplyform select').styler({ selectSearch: true,});
      });

    $(document).on('click' , '.proceedTest', function(){
        $('.applyData').addClass('hide_it');
    }); 


    // ===================================== Character count while applying for job =====================================

    $('#application_description').keyup(function () {
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

    // ===================================== Character count while applying for job =====================================



    

    // });

    </script>

</div>
