

@if(!empty($empquestion))
        @foreach ($empquestion as $qk => $empq)
            <p>{{($empq)}}</p>
                <b><p class="employerQuestionsPtag">
                    @if ($userQuestions[$qk] == 'no')
                        No
                    @else
                        Yes
                    @endif
                    {{-- {{$userQuestions[$qk]}} --}}
                </p></b>
                <select name="{{$qk}}" class="EmployerRegQuestion hide_it">
                    <option value="yes"
                    {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'yes'))?'selected':''}}
                    >Yes</option>
                    <option value="no"
                    {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'no'))?'selected':''}}
                    >No</option>
                </select>
@endforeach
@endif
