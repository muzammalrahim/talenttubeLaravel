{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')
@section('content')

 

<div class="card shadow mb-3 bg-white rounded">

  <h6 class="card-header h6">Personal Information <i class="fas fa-edit float-right"></i></h6>

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

  	<h6 class="card-header h6">Qualification<i class="fas fa-edit float-right editQualification"></i></h6>

	<div class="card-body p-2 cardBody">
	  	<div class="bl qualificationBox">     
	    	<div class="title qualificationList">
	        	<p class="loader SaveQualification"style="float: left;"></p>
	        	<div class="cl"></div>
	      
		        <div class="jobSeekerQualificationList">
		        	@php
					  $qualificationsData =  ($user->qualification)?(getQualificationsData($user->qualification)):(array());
					@endphp
					@if(!empty($qualificationsData))
					   @foreach($qualificationsData as $qualification)
					      <div class="QualificationSelect">
					          <input type="hidden" name="qualification[]" class="userQualification" value="{{$qualification['id']}}">
					          <p>{{$qualification['title']}} <i class="fa fa-trash removeQualification hide_it2 float-right"></i></p>
					      </div>
					   @endforeach
					 @endif 
		        </div>  
	    	</div>
		         <a class="addQualification btn btn-sm btn-primary text-white hide_it2"style = "cursor:pointer;">Add New</a>
		         <a class="qualificationSaveButton btn btn-sm btn-success hide_it2" onclick="UProfile.updateQualifications()">Save</a>
		</div>

	    <div class="alert alert-success QualifAlert hide_it2" role="alert">
	        <strong>Success!</strong> Qualification have been updated successfully!
	    </div>
	</div>

</div> 

<div class="card shadow mb-3 bg-white rounded">

  	<h6 class="card-header h6">Industry Experience<i class="fas fa-edit float-right editIndustry"></i></h6>

	<div class="card-body p-2 cardBody">
		<div class="title IndusListBox">

		    {{-- <div id="basic_anchor_industry_experience">Industry Experience <i class="editIndustry fas fa-edit "></i>
		  <p class="loader SaveIndustryLoader"style="float: left;"></p></div>
		  <div class="cl"></div> --}}
		      <p class="loader SaveindustryExperience"style="float: left;"></p>
		        <div class="cl"></div>
			        <div class="IndusList">
			         	@if(!empty($user->industry_experience))
						    @foreach($user->industry_experience as  $industry )
						    	<div class="IndustrySelect">
						              <input type="hidden" name="industry_experience[]" class="industry_experience" value="{{$industry}}">
						              <p>
						              	{{getIndustryName($industry)}}
						              	<i class="fa fa-trash removeIndustry float-right hide_it2"></i></p>
						        </div>
						    @endforeach
						@endif  
			        </div> 
		            <span class="addIndus btn btn-sm btn-primary hide_it2"style = "cursor:pointer;">Add New</span>
		            <a class="btn btn-sm btn-success hide_it2 saveIndus buttonSaveIndustry"style = "cursor:pointer;" onclick="UProfile.updateIndustryExperience()">Save</a> 
		</div>

		  <div class="alert alert-success IndusAlert hide_it2" role="alert">
		  {{--    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
		    <strong>Success!</strong> Industry Experience have been updated successfully!
		  </div>

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
                      @if(!empty($userquestion))
                          @foreach($userquestion as $qk => $question)
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


            <div class="alert alert-success questionsAlert d-none" role="alert">
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

{{-- ==================================================== Edit Qualification ==================================================== --}}

  $(document).ready(function(){
  
  $(".editQualification").click(function(){
        $(this).closest('.qualificationBox').addClass('editQualif');
        $('.removeQualification').removeClass('hide_it2');
        $('.addQualification').removeClass('hide_it2');
        $('.qualificationSaveButton').removeClass('hide_it2');

        // console.log('Testing Qualification');
  });

   $('.qualificationBox').on('click','.removeQualification', function(){
      console.log('removeQualification');
     $(this).closest('.QualificationSelect').remove();
   });

 })
   $(document).on('click','.addQualification', function(){
    console.log(' addQualification ');
    var newQualificationHtml = '<div class="QualificationSelect"><select name="qualification[]" class="userQualification">'; 
    @if(!empty($qualificationList))
        @foreach($qualificationList as $lk=>$qualification)
            newQualificationHtml += '<option value="{{$qualification['id']}}">{{$qualification['title']}}</option>'; 
        @endforeach
    @endif
    newQualificationHtml += '</select>';  
    newQualificationHtml += '<i class="fa fa-trash removeQualification"></i>';
    newQualificationHtml += '</div>';
    $('.qualificationList').append(newQualificationHtml);
   });

// ==================================================== Edit Qualification ==================================================== 

//===================================================== add remove industry ===================================================

 $(".editIndustry").click(function(){
    $(this).closest('.IndusListBox').addClass('edit');   

    $('.removeIndustry').removeClass('hide_it2');
    $('.addIndus').removeClass('hide_it2');
    $('.buttonSaveIndustry').removeClass('hide_it2');
    
    // console.log('welcome');
  });
 
// add and remove Industry code
$(document).ready(function(){
   $(document).on('click','.removeIndustry', function(){
    $(this).closest('.IndustrySelect').remove();
   });

   $(document).on('click','.addIndus', function(){
    console.log(' addIndus ');
    var newIndusHtml = '<div class="IndustrySelect"><select name="industry_experience[]" class="industry_experience userIndustryExperience">'; 
    @if(!empty($industriesList))
        @foreach($industriesList as $lk=>$lv)
            newIndusHtml += '<option value="{{$lk}}">{{$lv}}</option>'; 
        @endforeach
    @endif
    newIndusHtml += '</select>';  
    newIndusHtml += '<i class="fa fa-trash removeIndustry"></i>';
    newIndusHtml += '</div>';

    $('.IndusList').append(newIndusHtml);
   });
}); 

//===================================================== add remove industry =====================================================

//===================================================== User Questions Edit =====================================================

 $(".editQuestions").click(function(){
 $('.hide2').css("display","inline-block");
 $('.jobSeekerRegQuestion').removeClass('hide_it');
 $('.QuestionsKeyPTag').addClass('hide_it');
});

//================================================ User Questions Editing end here ================================================


</script>
@stop

