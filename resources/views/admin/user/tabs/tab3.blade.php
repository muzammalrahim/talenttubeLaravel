  
  <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
    <div class="form-group row">
        {{ Form::label('questions', null, ['class' => 'col-md-2 form-control-label']) }}
        <div class="col-md-10">
      
        @php  
            $userQuestions = !empty($record->questions)?(json_decode($record->questions, true)):(array()); 

        @endphp

     {{--    @dump($userQuestions)
        @dump($userquestion)
 --}}
        @if(!empty($userquestion))
            @foreach($userquestion as $qk => $question)
            {{$question}} 
                <p>
                <input 
                type="radio" 
                class="btn btn-primary" 
                name="questions[{{$qk}}]" 
                value="yes"
                {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'yes'))?'checked':''}} /> Yes &nbsp; &nbsp;

                <input 
                type="radio" 
                name="questions[{{$qk}}]" 
                value="no" 
                {{(isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'no'))?'checked':''}}> No

            </p>
            @endforeach
        @endif
        </div> 
        </div>
         
         <a class="btn btn-primary btnPrevious text-white text-white" onclick="scrollToTop()" >Previous</a>
         <a class="btn btn-primary btnNext text-white" style="float:right;"onclick="scrollToTop()">Next</a>
         

  </div>