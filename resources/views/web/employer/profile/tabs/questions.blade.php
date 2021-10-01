<div class="tab_about tab_cont">

    <div class="employerRegisterQuestions">
        <div id="basic" class="title_icon_edit"style="float:left;">Questions
              </div><i class="editEmployerQuestions fas fa-edit "></i><p class="loader SaveEmployerQuestionsLoader"style="float: left;"></p>
              <div class="cl"></div>
        @php
            $userQuestions = !empty($user->questions)?(json_decode($user->questions, true)):(array());
            $empquestion = getEmpRegisterQuestions();
        @endphp

            {{-- @dump($userQuestions) --}}

            <div class="EmpQuestionList">
                 @include('site.layout.parts.EmployerQuestionsList') {{-- site/layout/parts/EmployerQuestionsList --}}
            </div>
            <div class="col-md-12 text-center text-white"style="margin-top: 60px;text-align: center;">
                  <button class="button saveEmployerQuestionsButton"onclick="UProfile.updateEmployerQuestions()">Save</button>
            </div>
    </div>

    <div class="alert alert-success EmployerQuestionsAlert hide_it2" role="alert">
     {{--  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
      <strong>Success!</strong> Questions have been updated successfully!
    </div>

</div>