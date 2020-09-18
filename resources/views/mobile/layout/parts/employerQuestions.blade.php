@php  
    $userQuestions = !empty($user->questions)?(json_decode($user->questions, true)):(array()); 
@endphp
  @if(!empty($empquestion))
      @foreach($empquestion as $qk => $question)
        <div>
          <p class="mb-1">{{$question}} </p>
           <p class="QuestionsKeyPTag mb-1"><b>{{$userQuestions[$qk]}}</b></p>
            <select name="{{$qk}}" class="jobSeekerRegQuestion custom-select custom-select hideme mb-2 d-none">
                <option value="yes"
                {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'yes'))?'selected':''}}
                >Yes</option>
                <option value="no"
                {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'no'))?'selected':''}}
                >No</option>
            </select>
        </div>
      @endforeach
  @endif