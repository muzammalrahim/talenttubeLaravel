 
<div class="application_qa">
@php
    // dd( $application->answers->first()  );
    $answers = $application->answers;     
@endphp

 @if (!empty($answers))
        @php
            // $questions = $job->questions;
        @endphp

        <div class="jobAnswers">
            @foreach ($answers as $answer)
            <div class="job_answers">
                <div class="jqa_q">{{$answer->question->title}}</div>
                <div class="jqa_a">{{$answer->answer}}</div>
            </div>
            @endforeach
        </div>         
 @endif

</div>
