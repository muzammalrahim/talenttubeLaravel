

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
                        <textarea name="application_description" id="application_description" maxlength="300" max class="w100" title="Add a 250 character word minimum" style="height: 100px;"></textarea>
                        {{-- <div class="characterCount"><span class="count">0</span> / 300 minimum character</div> --}}

                        <div id="charNum" class="mt10">  Maximum 300 Characters  </div> 

                    </div>
                </div>

            </div>

            <input type="hidden" name="job_id" value="{{$job->id}}" />
            <input type="hidden" name="test_id" value="{{$job->onlineTest_id}}" />

            {{-- ========================================== If online test exists ========================================== --}}
            
            @if (!isset($onlineTest))
                <div class="fomr_btn act_field center">
                    <button class="btn small turquoise submitApplication">Submit</button>
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



    // ================================================================================================
    //  User previous result of test while applying to job
    // =================================================================================================


    // $(document).on('click','.usePreviousResult',function(){
        // event.preventDefault();

    this.usePreviousResult = function($job_id){
        console.log(' use previous result clicked ');
        $('.submitApplication').html(getLoader('jobSubmitBtn')).prop('disabled',true);
        var applyFormData = $('#job_apply_form').serializeArray()
        $.ajax({
        type: 'POST',
            url: base_url+'/ajax/use-previous-result',
            data: applyFormData,
            success: function(data){
                $('.submitApplication').html('Submit').prop('disabled',false);
                console.log(' data ', data );
                if (data.status == 1){
                     $('#job_apply_form').html(data.message);
                     // var link = parseInt(data.userTest_id);
                     var jobApp_id = '<p class = "mt10"> Your test result has been submitted </p>';
                     $('.onlineTestBox').html(jobApp_id);

                }else {
                     $('#job_apply_form').html(data.error);
                     $('.onlineTestBox').addClass('hide_it');
                }
            }
        });
    }

    // });

    </script>

</div>
