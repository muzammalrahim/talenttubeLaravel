
@if(!empty($userquestion))
        @foreach ($userquestion as $qk => $question)
            <p>{{($question)}}</p>
                <b><p class="QuestionsKeyPTag">
                    {{$userQuestions[$qk]}}
                </p></b>
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


