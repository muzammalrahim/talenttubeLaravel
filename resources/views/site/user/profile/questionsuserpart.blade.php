
@if(!empty($userquestion))
    @foreach ($userquestion as $qk => $question)
    <div class="question-ans">
         <h4 {{-- class="accordionone" --}}>{{($question)}}</h4>
          <div {{-- class="panel" --}}>
            <b><p {{-- class="QuestionsKeyPTag" --}}>
                {{-- {{$userQuestions[$qk]}} --}}
                @if ($userQuestions[$qk] == 'yes')
                    Yes
                @else
                    No
                @endif
            </p></b>
        </div>
    </div>

            <select name="{{$qk}}" class="jobSeekerRegQuestion hide_it">
                <option value="yes"
                {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'yes'))?'selected':''}}
                >Yes</option>
                <option value="no"
                {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'no'))?'selected':''}}
                >No</option>
            </select>
    @endforeach
@endif


