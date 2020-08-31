{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')
@section('content')

 

<div class="card shadow mb-3 bg-white rounded">

  <h6 class="card-header h6">Company Information <i class="fas fa-edit float-right"></i></h6>

      <div class="card-body p-2 cardBody">
        <div id="over" style="/*position:absolute; */width:auto; height:150px">
          <img src="https://p16-tiktokcdn-com.akamaized.net/aweme/720x720/tiktok-obj/1646491669975042.jpeg">
        </div>

        <div class="personalInfo">{{$user->name}} {{$user->surname}}</div>
        <div class="personalInfo"><b>Email:</b> {{$user->email}}</div>
        <div class="personalInfo"><b>Phone:</b> {{$user->phone}}</div>
        <div class="personalInfo"><b>Location: </b>{{$user->location}}</div>
        <div class="aboutMeSection"><b>Interested In: </b>{{$user->interested_in}}</div>

        <div class="aboutMeSection"><b>About Me: </b>{{$user->about_me}}</div>
            <div class="cardContent"></div>
            <div class="cardEdit" style="display: none;"></div> 

        {{-- @dump($user); --}}

      </div>

</div> 


<div class="card shadow mb-3 bg-white rounded">

    <h6 class="card-header h6">Questions<i class="fas fa-edit float-right editQuestions"></i></h6>

    <div class="card-body p-2 cardBody">

            <p class="loader SaveQuestionsLoader"style="float: left;"></p>
              <div class="cl"></div>
                <div class="questionsOfUser">
            
                    @php  
                        $userQuestions = !empty($user->questions)?(json_decode($user->questions, true)):(array()); 
                    @endphp
                      @if(!empty($empquestion))
                          @foreach($empquestion as $qk => $question)
                            <div>
                              <p>{{$question}} </p>
                               <p class="QuestionsKeyPTag"><b>{{$userQuestions[$qk]}}</b></p>
            {{--                     <select name="{{$qk}}" class="jobSeekerRegQuestion hide_it">
                                    <option value="yes"
                                    {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'yes'))?'selected':''}}
                                    >Yes</option>
                                    <option value="no"
                                    {{( isset($userQuestions[$qk]) && ($userQuestions[$qk] == 'no'))?'selected':''}}
                                    >No</option>
                                </select> --}}
                            </div>
                          @endforeach
                      @endif
                          <div class="col-md-12 text-center mt-3">
                              <a class="btn btn-sm btn-success saveQuestionsButton d-none" onclick="UProfile.updateQuestions()">Save</a>
                          </div>  
                </div>


            <div class="alert alert-success questionsAlert d-none mt-2" role="alert">
              <strong>Success!</strong> Questions have been updated successfully!
            </div>
    </div>

</div> 



@stop


@section('custom_footer_css')
<style type="text/css">


</style>
@stop

@section('custom_js')

<script type="text/javascript">



//===================================================== Employer Questions Edit =====================================================

 $(".editQuestions").click(function(){
    // console.log("hi");
 $('.saveQuestionsButton').removeClass("d-none");
 $('.questionsAlert').removeClass("d-none");
 $('.QuestionsKeyPTag').addClass('hide_it');
});

//================================================ Employer Questions Editing end here ================================================


</script>
@stop

