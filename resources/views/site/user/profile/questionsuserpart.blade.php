{{-- 
@if(!empty($userquestion))
    @foreach ($userquestion as $qk => $question)
    <div class="question-ans">
         <h6  class="accordionone">{{($question)}}</h6>
          <div class="panel">
            <b><p class="QuestionsKeyPTag">
                {{$userQuestions[$qk]}}
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
@endif  --}}

{{--  <div class="about-infomation">
                        <h2>Recent Job</h2>
                            <button type="button"  onclick="showFieldEditor('recentJob');" class="edited-text"><i class="fas fa-edit"></i></button>
                        
                        <div class="recentjob">
                           <span class="recentjobSpan"> {{$user->recentJob}} </span>
                              <b class="mx-2">at</b>
                           <span class="organizationSpan"> {{$user->organHeldTitle}} </span>
                        </div>

                        <div class="row sec_recentJob d-none">
                           <div class="col-5">
                              <input type="text" name="recentJobField" class="form-control recentJobField" value="{{$user->recentJob}}">
                           </div>
                           <div class="col-1">  <span> at </span>  </div>
                           <div class="col-6">
                              <input type="text" name="organHeldTitleField" class="form-control organHeldTitleField" value="{{$user->organHeldTitle}}" onclick="showFieldEditor()">
                           </div>
                        </div>           

                        <div class="row">
                           <div class="col-md-12">
                              <div class="float-right button_recentJob d-none">
                                 <button class="cancel-button" onclick="hideFieldEditor('recentJob');">Cancel</button>
                                 <button class="orange_btn mt-2" onclick="updateRecentJob()">Save</button> 
                              </div>
                           </div>
                        </div>

                        <div class="alert alert-success alert_recentJob hide_me" role="alert">
                          <strong>Success!</strong> Recent Job has been updated successfully!
                        </div>
        </div> --}}

                     @php  
    $userQuestions = !empty($user->questions)?(json_decode($user->questions, true)):(array()); 
@endphp
  @if(!empty($userquestion))
      @foreach($userquestion as $qk => $question)
        <div >
          <p class="mb-1">{{$question}} </p>
           <p class="{{-- QuestionsKeyPTag --}} mb-1 recentjob">
              @if ($userQuestions[$qk] == 'yes' )
                <b> Yes </b>
                @else

                <b> No </b>

              @endif
              {{-- <b>{{$userQuestions[$qk]}}</b> --}}

            </p>

                        <div class="row sec_recentJob d-none">
                           <div class="col-12">
                              <select type="text" name="{{$qk}}" class="form-control recentJobField" onclick="showFieldEditor()">
                                    <option value="yes" {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'yes'))}}
                                            >Yes</option>
                                     <option value="no" {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'no'))}}
                                            >No</option>
                                </select>
                           </div>
                  

                        </div> 


          {{--   <select name="{{$qk}}" class="jobSeekerRegQuestion custom-select custom-select mb-2 d-none">
                <option value="yes"
                {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'yes'))?'selected':''}}
                >Yes</option>
                <option value="no"
                {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'no'))?'selected':''}}
                >No</option>
            </select> --}}
        </div>
      @endforeach
               <div class="row">
                           <div class="col-md-12">
                               <div class="float-right button_recentJob d-none">
                                 <button class="cancel-button" onclick="hideFieldEditor('recentJob');">Cancel</button>
                                 <button class="orange_btn mt-2" onclick="updateRecentJob()">Save</button> 
                              </div>                           
                            </div>
                        </div>
                        <div class="alert alert-success alert_recentJob hide_me" role="alert">
                          <strong>Success!</strong> Questions has been updated successfully!
                        </div>
  @endif