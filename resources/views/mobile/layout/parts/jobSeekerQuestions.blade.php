@php  
    $userQuestions = !empty($user->questions)?(json_decode($user->questions, true)):(array()); 
@endphp
  @if(!empty($userquestion))
      @foreach($userquestion as $qk => $question)
        <div>
          <p class="mb-1">{{$question}} </p>
           <p class="QuestionsKeyPTag mb-1"><b>{{$userQuestions[$qk]}}</b></p>
            <select name="{{$qk}}" class="jobSeekerRegQuestion custom-select custom-select mb-2 d-none">
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