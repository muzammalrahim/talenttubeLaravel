    
@extends('site.employer.referencemaster')  {{-- site/employer/uniqueUrlUnregisteredUse --}}

@section('content')

<div class="container py-3">
	<div class="initialQuestions">
		{{-- <div class="row"> <h2> Hi {{$crossreference->refName}}</h2> </div> --}}
		<div class="row"><b class="mx-2">{{$crossreference->userName}}</b> has provided your name as referee and <span class="font-weight-bold mx-1"> Talenttube </span> helps you complete the referencing process quickly and securely online. </div>

		<div class="center1" style="margin-left: 10%;">
			<p class="m-0 p-0"> You will be asked to: </p>
			<p class="m-0 p-0"><i class="fas fa-arrow-right arrowRight"></i> Confirm your detail</p>
			<p class="m-0 p-0"><i class="fas fa-arrow-right arrowRight"></i> Agree to TalenTube's privacy policy </p>
			<p class="m-0 p-0"><i class="fas fa-arrow-right arrowRight"></i> Verify {{$crossreference->userName}}'s information </p>
			<p class="m-0 p-0"><i class="fas fa-arrow-right arrowRight"></i> Answer a questionnaire about {{$crossreference->userName}}</p>

			<div class="row">
				<button class="col-md-2 btn btn-outline-danger declineButton border border-danger text-danger" name="refID" value="{{$crossreference->id}}"> Decline</button>
				<div class="col-md-1">
					<div class="spinner-border declinedSpinner d-none" role="status">
					  <span class="sr-only">Loading...</span>
					</div>
				</div>
				<button class="col-md-2 btn btn-sm btn-primary letsGoButton"> Let's Go</button>
			</div>
		</div>

	</div>
	<div class="workreference d-none">
		<div class="header1">
			<h4 class="pt-4 font-weight-bold">Cross ({{$crossreference->refType}}) </h4>
		</div> 
	    <form method="POST" name="newRerenceForm" class="newRerenceForm newJob job_validation">
	    	@csrf

		   <h5 class="font-weight-bold text-center"> Verification Details </h5>
		   		<input type="hidden" name="refID" value="{{$crossreference->id}}">
		   		<input type="hidden" name="refTypeHidden" value="{{$crossreference->refType}}">


			    <div class="form-group">
			      <label for="inputEmail4">What is your full name</label>
			      <input type="text" class="form-control" id="inputEmail4" name="refereeName">
			    </div>

			    <div class="form-group">
			    <label for="inputPhone">What is your best contact number</label>
			    <input type="text" class="form-control" id="inputPhone" name="refereePhone">
			  </div>

			    <div class="form-group">
			      <label for="inputPassword4">What is your best email address (personal email address is fine): </label>
			      <input type="text" class="form-control" id="inputPassword4" name="refereeEmail">
			    </div>
			  
			  <div class="form-group">
			    <label for="inputEducational">What was the name of the educational institution or organisation yourself and the candidate attended?</label>
			    <input type="text" class="form-control" id="inputEducational" name="refereeEducational">
			  </div>
			  <div class="form-group">
			    <label for="inputDates">Roughly, how long ago did you did you first meet the candidate (approximate dates are sufficient)?</label>
			    <input type="text" class="form-control" id="inputDates" name="refereeDates">
			  </div>

			  <div class="form-group">
			    <label for="inputParticular">What was your education relationship to the candidate (eg: career advisor, principle, maths tutor, physics professor, Tafe teacher etc)? Was there a particular class, course or subject you taught the candidate (eg; HSC Biology, Bachelor of Business, Tafe Mechanic Apprenticeship etc)?</label>
			    <input type="text" class="form-control" id="inputParticular" name="refereeParticularClass">
			  </div>
			  
			<h5 class="font-weight-bold text-center">Educational Related Questions </h5>

			<div class="form-group">
			    <label for="inputPunctual">During your relationship with the candidate, did you find them to be generally on time and punctual to class or any appointments?</label>
			    <select class="form-control" id="inputPunctual" name="refereePunctual">
			    	<option>Unsatisfactory </option>
			    	<option selected="selected">Met expectations </option>
			    	<option>Exceeded expectations </option>
			    </select>

			    <input type="text" class="form-control" id="dd1" name="ddText1" placeholder="Any Comment about this">

			 </div>

			 <div class="form-group">
			    <label for="inputCommunication">How do you rate the candidate’s communication skills, based on any verbal and written correspondence/assignments you’ve had with them?</label>
			    <select class="form-control" id="inputCommunication" name="refereeCommunication">
			    	<option>Unsatisfactory </option>
			    	<option selected="selected">Met expectations </option>
			    	<option>Exceeded expectations </option>
			    </select>

			    <input type="text" class="form-control" id="dd2" name="ddText2" placeholder="Any Comment about this">

			 </div>

			 <div class="form-group">
			    <label for="inputInitiative">Did the candidate show good educational initiative, such as doing good research & completing any assigned homework or tasks?</label>
			    <select class="form-control" id="inputInitiative" name="refereeInitiative">
			    	<option>Unsatisfactory </option>
			    	<option selected="selected">Met expectations </option>
			    	<option>Exceeded expectations </option>
			    </select>

			    <input type="text" class="form-control" id="dd3" name="ddText3" placeholder="Any Comment about this">


			 </div>

			 <div class="form-group">
			    <label for="inputDemonstrate">Was the candidate able to demonstrate good focus and stay on task, while avoiding any unnecessary disruptions to the lesson or class? </label>

			    <select class="form-control" id="inputDemonstrate" name="refereeDemonstrate">
			    	<option>Unsatisfactory </option>
			    	<option selected="selected">Met expectations </option>
			    	<option>Exceeded expectations </option>
			    </select>

			    <input type="text" class="form-control" id="dd4" name="ddText4" placeholder="Any Comment about this">

			 </div>

			 <div class="form-group">
			    <label for="inputLearning">Did the candidate demonstrate good learning outcomes & adequate academic performance during their studies?  </label>

			    <select class="form-control" id="inputLearning" name="refereeLearning">
			    	<option>Unsatisfactory </option>
			    	<option selected="selected">Met expectations </option>
			    	<option>Exceeded expectations </option>

			    </select>

			    <input type="text" class="form-control" id="dd5" name="ddText5" placeholder="Any Comment about this">

			 </div>

			 <div class="form-group">
			    <label for="inputInteraction">In your interactions with the candidate, do you believe they showed good honesty and integrity during their studies?  </label>

			    <select class="form-control" id="inputInteraction" name="refereeInteractions">
			    	<option>Unsatisfactory </option>
			    	<option selected="selected">Met expectations </option>
			    	<option>Exceeded expectations </option>
			    </select>

			    <input type="text" class="form-control" id="dd6" name="ddText6" placeholder="Any Comment about this">

			 </div>

			<h5 class="font-weight-bold text-center">Final Questions</h5>

			<div class="form-group">
			    <label for="inputManagement">Based on your experience, what would be the best way to get the most of this candidate? Is there a particular management style you think they would best respond to? </label>
			    <input type="text" class="form-control" id="inputManagement" name="refereeManagementr">
			</div>

			<div class="form-group">
			    <label for="inputCurricular">Was the candidate involved in extra curricular activities during their time at this academic institution? 
 </label>
			    <input type="text" class="form-control" id="inputCurricular" name="refereeCurricular">
			</div>

			<div class="form-group">
			    <label for="inputRelatedProject">If there was any group related projects, did the candidate demonstrate good team building skills?  </label>
			    <input type="text" class="form-control" id="inputRelatedProject" name="refereeRelatedProject">
			</div>


			<div class="form-group">
			    <label for="inputProspective">Would you recommend the candidate to prospective employers for a role  ? </label>
			    <input type="text" class="form-control" id="inputProspective" name="refereeProspective">
			</div>

			<div class="form-group">
			    <label for="inputCandidateBest">What industry or role do you think the candidate would be best suited for? </label>
			    <input type="text" class="form-control" id="inputCandidateBest" name="refereeCandidateBest">
			</div>

			<div class="form-group">
			    <label for="inputComments">Please feel free to add any additional final comments for the reference check ? </label>
			    <input type="text" class="form-control" id="inputComments" name="refereeComments">
			</div>

			<p class="errorsInFields text-danger"></p>


			<div class="form-group row  mt-4">
				<div class="text-center col-md-4">
					  <button type="submit" class="btn btn-primary sendReference">Send Reference</button>
				</div>

				<div class="col-md-1">
					<div class="spinner-border sendreferenceSpinner d-none" role="status">
							  <span class="sr-only">Loading...</span>
					</div>
				</div>
			</div>

    </form>

   </div>

</div>


@stop

@section('custom_js')

<script type="text/javascript" src="{{ asset('js/site/jquery.popup.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/login_form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/lib.js') }}"></script>


<script type="text/javascript">
	function topFunction() {
  	window.scrollTo({top: 0, behavior: 'smooth'});
}


// =========================================================== Ajax for saving slot ===========================================================

$(document).ready(function(){

	$('.letsGoButton').click(function(){
		$('.initialQuestions').addClass('d-none');
		$('.workreference').removeClass('d-none');
	});

	$('.declineButton').click(function(){

		$('.declinedSpinner').removeClass('d-none');
		var refID = $('.declineButton').val();
		console.log(refID);
    	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

		$.ajax({
	        type: 'POST',
	        id: refID,

	        url: base_url+'/ajax/crossreference/declineReference/' + refID ,
	        success: function(data){
	            console.log(' data ', data);
	            $('.declineButton').html('Declined').prop('disabled',true);
	            
				$('.declinedSpinner').addClass('d-none');
				setTimeout(function() {
        			location.href = base_url + '/reference/declined'; 
        			}, 4000);
	          

	        }
    	});
	});



	// ================================================ Ajax for savinf reference ================================================

    $('.sendReference').on('click',function() {
        event.preventDefault();
        var formData = $('.newRerenceForm').serializeArray();
        console.log('hi how are you');
        // console.log(' formData ', formData);
        $('.sendreferenceSpinner').removeClass('d-none');
        
        // setTimeout(function() { $(".saveSlotSpinner").addClass('d-none'); }, 4000);

        // return;
        $.ajax({
            type: 'POST',
            url:  '{{route('sendReferenceE')}}',
            data: formData,
            success: function(response){
                // console.log(' data ', response);
         	if(response.status == 1)
         	{
         		$('.alreadyBookedInerview').removeClass('d-none');
                	$('.sendreferenceSpinner').addClass('d-none');
        			setTimeout(function() {
        			location.href = base_url + '/reference/completed'; 
        			}, 4000);
         	}

                	
        	else{

        			// $('.errors').removeClass('d-none');
                	$('.sendreferenceSpinner').addClass('d-none');

                   var errorss =  response.validator;
                   var nameError = errorss['refereeName'];
                   var emailError = errorss['refereeEmail'];
                   var mobileError = errorss['refereePhone'];
                   
                   // Name Error 
                   if(nameError) {
                   		var nameError2 = nameError.toString();
                   		$('.errorsInFields').text(nameError2);
                   	}		
                   // Email Error 
                   if(emailError){
	                   var emailError2 = emailError.toString();
	                   $('.errorsInFields').text(emailError2);
					}
                    // Email Error 
                   if(mobileError){
                   var mobileError2 = mobileError.toString();
                   $('.errorsInFields').text(mobileError2);
                   }

        	}


            }
        });
    });


// ================================================ Ajax for saving referenceend here ================================================

});



</script>
@stop

@section('custom_css')

    {{-- <link rel="stylesheet" href="{{ asset('css/common.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('css/master.css') }}">


<style type="text/css">
	
	.errorInName{
		color: red;
	}
	.clickHere{
		text-decoration: underline;
	    color: black;
    	cursor: pointer;
	}
	.alreadyBookedInerview{
	text-align: center;
    position: relative;
    bottom: 100px;
    color: red;
	}
	/*body{
		background-image: url(https://images.pexels.com/photos/34092/pexels-photo.jpg?auto=compress&cs=tinysrgb&h=750&w=1260) !important;
	}*/
</style>

@stop