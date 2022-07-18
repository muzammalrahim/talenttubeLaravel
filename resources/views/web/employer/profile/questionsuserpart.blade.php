{{-- 
@php  
    $userQuestions = !empty($user->questions)?(json_decode($user->questions, true)):(array()); 
@endphp --}}

<div class="questionsOfUser">
    @if(!empty($empquestion))
    @foreach($empquestion as $qk => $question)
        <div >
          <p class="mb-1">{{$question}} </p>
           <p class="QuestionsKeyPTag  mb-1">
              @if ($userQuestions[$qk] == 'yes' )
                <b> Yes </b>
                @else
                <b> No </b>
              @endif
              {{-- <b>{{$userQuestions[$qk]}}</b> --}}
            </p>

            {{-- @dump($userQuestions[$qk]) --}}
            <div class="row questionSelect d-none">
               <div class="col-12">
                  <select type="text" name="{{$qk}}" class="jobSeekerRegQuestion w-100 px-2 form-control icon_show" onclick="showFieldEditor()">
                        <option value="yes" {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'yes'))? 'selected': ''}}
                                >Yes</option>
                         <option value="no" {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'no'))? 'selected': ''}}
                                >No</option>
                    </select>
               </div>
            </div> 

        </div>
    @endforeach
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="float-right button_question d-none mt-2">
                <button class="cancel-button ms-2" onclick="hideFieldEditor('question');">Cancel</button>
                <button class="orange_btn" onclick="updateUserQuestions('question')">Save</button> 
            </div>                           
        </div>
    </div>

</div>
<div class="alert alert-success alert_question hide_me" role="alert">
    <strong>Success!</strong> Questions has been updated successfully!
</div>