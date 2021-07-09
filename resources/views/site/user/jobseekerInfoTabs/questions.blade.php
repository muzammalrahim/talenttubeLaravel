

@php
$userQuestions = !empty($js->questions)?(json_decode($js->questions, true)):(array());
@endphp
        {{-- @dump($userQuestions) --}}
@if(!empty(getUserRegisterQuestions()))
@foreach (getUserRegisterQuestions() as $qk => $empq)

    {{($empq)}}
        <b><p>
            @if(!empty($userQuestions[$qk]))
                @if ($userQuestions[$qk] == 'yes')
                    yes
                    @else
                    No
                @endif
             {{-- {{$userQuestions[$qk]}} --}}
            @elseif(empty($userQuestions[$qk]))
                {{'Not Answered'}}
            @endif
        </p></b>
@endforeach
@endif