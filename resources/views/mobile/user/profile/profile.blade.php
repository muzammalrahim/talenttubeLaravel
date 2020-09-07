{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')
@section('content')

 

<div class="card shadow mb-3 bg-white rounded">

  <h6 class="card-header h6">Personal Information {{-- <i class="fas fa-edit float-right"></i> --}}</h6>

	  <div class="card-body p-2 cardBody">
		<div id="over" style="/*position:absolute; */width:auto; height:150px">
		  <img src="https://p16-tiktokcdn-com.akamaized.net/aweme/720x720/tiktok-obj/1646491669975042.jpeg">
		</div>

		<div class="personalInfo">{{$user->name}} {{$user->surname}}</div>
		<div class="personalInfo"><b>Email:</b> {{$user->email}}</div>
		<div class="personalInfo"><b>Phone:</b> {{$user->phone}}</div>
		<div class="personalInfo"><b>Location: </b>{{$user->location}}</div>

        {{-- Interested In --}}
		<div class="aboutMeSection"><b>Interested In: </b>
            <div class="spinner-border spinner-border-sm text-primary IntsdInLoader ml-2" role="status" style="display:none;"></div>
            <i class="fas fa-edit float-right intInSecButton"></i> <p class="interestedInSec">{{$user->interested_in}}</p>
        </div>

		<div class="col-md-12 text-center my-2">
                              <a class="btn btn-sm btn-success saveInterestedInButton d-none">Save</a>
        </div>

        <div class="alert alert-success interestedInAlert" role="alert" style="display:none;">
          <strong>Success!</strong> Interested In have been updated successfully!
        </div>

        {{-- Interested In --}}

		<div class="aboutMeSection"><b>About Me: </b>
            <div class="spinner-border spinner-border-sm text-primary AboutMeLoader ml-2" role="status" style="display:none;"></div>
            <i class="fas fa-edit float-right aboutMeSecButton"></i> <p class="aboutMeSec">{{$user->about_me}}</p>
        </div>

        <div class="col-md-12 text-center my-2">
            <a class="btn btn-sm btn-success saveAboutMeButton d-none">Save</a>
        </div>

        <div class="alert alert-success AboutMeAlert" role="alert" style="display:none;">
          <strong>Success!</strong> About Me have been updated successfully!
        </div>

		    <div class="cardContent"></div>
		    <div class="cardEdit" style="display: none;"></div>
		{{-- @dump($user); --}}

	  </div>

</div> 

<div class="card shadow mb-3 bg-white rounded">

  	<h6 class="card-header h6">Qualification <div class="spinner-border spinner-border-sm text-light qualifExpLoader ml-2" role="status" style="display:none;"></div>
        <i class="fas fa-edit float-right editQualification"></i></h6>

	<div class="card-body p-2 cardBody">
	  	<div class="bl qualificationBox">     
	    	<div class="title qualificationList">
	        	<p class="loader SaveQualification"style="float: left;"></p>
	        	<div class="cl"></div>
	      
		        <div class="jobSeekerQualificationList">

		        	{{-- @php
					  $qualificationsData =  ($user->qualification)?(getQualificationsData($user->qualification)):(array());
					@endphp
					@if(!empty($qualificationsData))
					   @foreach($qualificationsData as $qualification)
					      <div class="QualificationSelect">
					          <input type="hidden" name="qualification[]" class="userQualification" value="{{$qualification['id']}}">
					          <p>{{$qualification['title']}} <i class="fa fa-trash removeQualification hide_it2 float-right"></i></p>
					      </div>
					   @endforeach
					 @endif  --}}

                    @include('mobile.layout.parts.jobSeekerQualificationList')


		        </div>  
	    	</div>
		         <a class="addQualification btn btn-sm btn-primary text-white hide_it2"style = "cursor:pointer;">Add New</a>
		         <a class="qualificationSaveButton btn btn-sm btn-success hide_it2">Save</a>
		</div>

	    <div class="alert alert-success QualifAlert hide_it2" role="alert">
	        <strong>Success!</strong> Qualification have been updated successfully!
	    </div>
	</div>

</div> 

<div class="card shadow mb-3 bg-white rounded">

  	<h6 class="card-header h6">Industry Experience <div class="spinner-border spinner-border-sm text-light indusExpLoader ml-2" role="status" style="display:none;">
  				{{-- <span class="sr-only">Loading...</span> --}}</div>

	<i class="fas fa-edit float-right editIndustry"></i></h6>

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
		            <a class="btn btn-sm btn-success hide_it2 saveIndus buttonSaveIndustry"style = "cursor:pointer;">Save</a> 
		</div>

		  <div class="alert alert-success IndusAlert" role="alert" style="display:none;">
		    <strong>Success!</strong> Industry Experience have been updated successfully!
		  </div>

	</div>

</div> 

<div class="card shadow mb-3 bg-white rounded">

  	<h6 class="card-header h6">Questions <div class="spinner-border spinner-border-sm text-light userQuesLoader ml-2" role="status" style="display:none;"></div>
  	<i class="fas fa-edit float-right editQuestions"></i></h6>

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
                          <div class="col-md-12 text-center mt-3">
                              <a class="btn btn-sm btn-success saveQuestionsButton d-none">Save</a>
                          </div>  
                </div>

            <div class="alert alert-success questionsAlert" role="alert" style="display:none;">
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

{{-- <script src="{{ asset('js/mobile/jobSeekerProfile.js') }}"></script> --}}

<script type="text/javascript">
	

// {{-- ==================================================== Edit Interested IN ==================================================== --}}

$('.intInSecButton').click(function(){

        $('.interestedInSec').attr("contentEditable", "true");
        $('.interestedInSec').addClass('interestedInEditColor').css("border","2px solid #dc9f4a");
        $('.interestedInSec').addClass('editable');
		$('.saveInterestedInButton').removeClass('d-none');

		
});

$(".saveInterestedInButton").click(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var interestedIn = $('.interestedInSec').text(); 
    console.log(interestedIn);
        $('.IntsdInLoader').show();
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MupdateInterested_in',
        data: {'interestedIn': interestedIn},
        success: function(resp){
            if(resp.status){
                $('.IntsdInLoader').hide(); 
                $('.saveInterestedInButton').addClass('d-none'); 
                $('.interestedInSec').attr("contentEditable", "false");
                $('.interestedInSec').removeClass('interestedInEditColor').css("border","none");
                $('.interestedInAlert').show().delay(3000).fadeOut('slow');


            }
        }
    });
});

// {{-- ==================================================== Edit Interested IN End ==================================================== --}}

// {{-- ==================================================== Edit About Me  ==================================================== --}}

$('.aboutMeSecButton').click(function(){

        $('.aboutMeSec').attr("contentEditable", "true");
        $('.aboutMeSec').addClass('interestedInEditColor').css("border","2px solid #dc9f4a");
        $('.aboutMeSec').addClass('editable');
        $('.saveAboutMeButton').removeClass('d-none');
});

$(".saveAboutMeButton").click(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var aboutMe = $('.aboutMeSec').text(); 
    console.log(aboutMe);
    $('.AboutMeLoader').show();
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/Mabout_me',
        data: {'aboutMe': aboutMe},
        success: function(resp){
            if(resp.status){
                $('.AboutMeLoader').hide(); 
                $('.saveAboutMeButton').addClass('d-none'); 
                $('.aboutMeSec').attr("contentEditable", "false");
                $('.aboutMeSec').removeClass('interestedInEditColor').css("border","none");
                $('.AboutMeAlert').show().delay(3000).fadeOut('slow');

            }
        }
    });
});

// {{-- ==================================================== Edit About Me End ==================================================== --}}


// {{-- ==================================================== Edit Qualification ==================================================== --}}


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
    $('.jobSeekerQualificationList').append(newQualificationHtml);
   });



// ====================================================== Edit Qualification Ajax ====================================================== 

    $(".qualificationSaveButton").click(function(){
    	console.log('hi qualification');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var qualification = jQuery('.userQualification').map(function(){ return $(this).val()}).get(); 
        $('.qualifExpLoader').show();           //indusExpLoader
        // $('.SaveQualification').after(getLoader('smallSpinner SaveQualificationSpinner'));

        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/MupdateQualification',
            data: {'qualification': qualification},
            success: function(resp){
                if(resp.status){
                    $('.removeQualification ').addClass('hide_it2');
                    $('.addQualification').addClass('hide_it2');
                    $('.qualificationSaveButton').addClass('hide_it2');
                    $('.qualifExpLoader').hide(); 
                    $('.jobSeekerQualificationList').html(resp.data); 

                    // location.reload();
                }
            }
        });
})


// ====================================================== End Qualification Ajax end here ====================================================== 

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

// ======================== Edit Industry Experience for Ajax ========================

$(".saveIndus").click(function(){ 
	// console.log('hi industry');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var industry_experience = jQuery('.industry_experience').map(function(){ return $(this).val()}).get(); 

         // $('.indusExpLoader').after(getLoader('smallSpinner indusExpLoader'));
        $('.indusExpLoader').show();           //indusExpLoader


        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/MupdateIndustryExperience',
            data: {'industry_experience': industry_experience},
            // $('.IndusAlert').hide();
            
			
            success: function(resp){
                if(resp.status){
                    // $('.IndusListBox').removeClass('edit'); 
                    $('.IndusAlert').show().delay(3000).fadeOut('slow');
                    // $('.SaveIndustrySpinner').remove(); 

                    $('.IndusList').html(resp.data); 
                    $('.removeIndustry').addClass('hide_it2'); 
				    $('.addIndus').addClass('hide_it2');
				    $('.buttonSaveIndustry').addClass('hide_it2');
                    $('.indusExpLoader').hide(); 


                    }
            }
    });
 });

// ======================================= Edit Industry Experience For Ajax End Here ======================================= 


//===================================================== add remove industry end  =====================================================



//===================================================== User Questions Edit =====================================================

 $(".editQuestions").click(function(){      
     $('.hideme').show();
     $('.saveQuestionsButton').removeClass('d-none');
     $('.QuestionsKeyPTag').addClass('d-none');
     $('.jobSeekerRegQuestion').removeClass('d-none');


});

//  ======================================= User Questions Ajax saveQuestionsButton =======================================

    $(".saveQuestionsButton").click(function(){
        var items = {}; 
        $('select.jobSeekerRegQuestion').each(function(index,el){  
        // console.log(index, $(el).attr('name')  , $(el).val()   );  
            // items.push({name:  $(el).attr('name') , value: $(el).val()});
            var elem_name = $(el).attr('name'); 
            var elem_val = $(el).val(); 
            items[elem_name] = elem_val; 
            // items.push({elem_name : elem_val });
        $('.userQuesLoader').show();           //indusExpLoader

        });
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // $('.SaveQuestionsLoader').after(getLoader('smallSpinner SaveQuestionsSpinner'));
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/MupdateQuestions',
            data: {'questions': items},
            
            success: function(data){
                    $('.questionsAlert').show().delay(3000).fadeOut('slow');
                    $('.saveQuestionsButton').addClass('d-none'); 
                    $('.userQuesLoader').hide();
                    // $('.QuestionsKeyPTag').removeClass('hide_it');
                    if(data){
                        // $(".questionsOfUser").load(" .questionsOfUser");
                        // $(".SaveQuestionsSpinner").remove();
                       
                }
            }
        });
    });

//  ======================================= User Questions Ajax End  =======================================

//================================================ User Questions Editing end here ================================================

</script>


@stop

