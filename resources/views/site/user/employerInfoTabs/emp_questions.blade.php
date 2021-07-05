<div class="tab_photos tab_cont">
        <div class="galleryCont">
            @php
                $empQuestions = !empty($employer->questions)?(json_decode($employer->questions, true)):(array());
            @endphp
                {{-- @dump($empQuestions) --}}
                    @if(!empty(getEmpRegisterQuestions()))
                        @foreach (getEmpRegisterQuestions() as $qk => $empq)

                                {{($empq)}}
                                <b><p>
                                    @if(!empty($empQuestions[$qk]))

                                        @if ($empQuestions[$qk] == 'yes')
                                            Yes
                                            @else

                                            No
                                        @endif


                                    {{-- {{$empQuestions[$qk]}} --}}
                                    @elseif(empty($empQuestions[$qk]))
                                    {{'Not Answered'}}
                                    @endif
                                </p></b>
                         @endforeach
                    @endif
            {{-- @dump($employer->questions) --}}
        </div>
        <!-- /photos -->
    </div>