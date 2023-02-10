
<div class="application_qa pt-2">
    @php
        // dd( $application  );
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
                    <p class="jqa_q m-0"> <b> Question: {{ $loop->index+1 }} </b> {{$answer->question->title}}</p>
                    <p class="jqa_a m-0"> <b> Answer: </b> {{$answer->answer}}</p>
                </div>
                @endforeach
            </div>
     @endif

    <div class="jobAppDescriptionBox">
        <p class="m-0">{{jobApplicationMandatoryQuestion()}}</p>
        <p class="m-0">{{ $application->description}}</p>
    </div>

</div>
