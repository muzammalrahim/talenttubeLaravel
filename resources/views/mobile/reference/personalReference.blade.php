    
@extends('mobile.reference.refMobileMaster')  {{-- site/employer/referencemaster --}}

@section('content')

<div class="container">
	<div class="initialQuestions">
		<p class="row123 m-0">Hi <span class="font-weight-bold"> {{$crossreference->refName}} </span> </p>
		<p class="row123"><b>{{$crossreference->userName}}</b> has provided your name as referee and <span class="font-weight-bold"> Talenttube </span> helps you complete the referencing process quickly and securely online. </p>

		<div class="center1">

			<p class="font-weight-bold mb-3 m-0 p-0"> You will be asked to: </p>
			<p class="m-0 p-0"> <i class="fas fa-arrow-right arrowRight"></i> Confirm your details & relationship with the candidate</p>
			<p class="m-0 p-0"> <i class="fas fa-arrow-right arrowRight"></i> Answer questions relating to your experience and interactions with the candidate </p>
			{{-- <p class="m-0 p-0"> <i class="fas fa-arrow-right arrowRight"></i> Verify {{$crossreference->userName}}'s information </p> --}}
			<p class="m-0 p-0"> <i class="fas fa-arrow-right arrowRight"></i> Provide a potential recommendation for {{$crossreference->userName}}, if you think they would be suitable for a role</p>
		</div>

		<div class="row123">
				<button class="col-md-2 btn btn-outline-danger declineButton border border-danger text-danger" name="refID" value="{{$crossreference->id}}"> Decline</button>
				<div class="col-md-1 text-center mt-3">
					<div class="spinner-border declinedSpinner d-none text-center mt-3" role="status">
					  <span class="sr-only">Loading...</span>
					</div>
				</div>
			</div>
		<div class="row123">
				<button class="col-md-2 btn btn-sm btn-primary letsGoButton"> Let's Go</button>
				
		</div>

	</div>
	<div class="workreference d-none">
		<div class="header1">
			<h4 class="pt-4 font-weight-bold">Cross Ref ({{$crossreference->refType}}) </h4>
		</div> 
	    <form method="POST" name="newRerenceForm" class="newRerenceForm newJob job_validation">
	    	@csrf

		   <h5 class="font-weight-bold text-center"> Verification Details </h5>
		   		<input type="hidden" name="refID" value="{{$crossreference->id}}">
		   		<input type="hidden" name="refTypeHidden" value="{{$crossreference->refType}}">

		   		<p>
		   			We require the below details, should any prospective employer wish to verify the authenticity of this reference check or require additional information about their hiring decision 
		   		</p>

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
			    <label for="inputKnowing">How do you know the candidate ? Was there a particular institution, event or association you where involved with the candidate? Examples include charity, sporting club, religious or community organisation etc</label>
			    <input type="text" class="form-control" id="inputKnowing" name="refereeKnowing">
			  </div>

			  <div class="form-group">
			    <label for="inputMeet">When did you first meet them?</label>
			    <input type="text" class="form-control" id="inputMeet" name="refereeMeet">
			  </div>

			  {{-- <div class="form-group">
			    <label for="inputParticularIns"></label>
			    <input type="text" class="form-control" id="inputParticularIns" name="refereeParticularIns">
			  </div>
			   --}}
			
			<h5 class="font-weight-bold text-center">Values & Skill Related Questions</h5>

			<div class="form-group">
			    <label for="inputInteraction">In your interactions with the candidate, do you believe they showed good honesty and integrity?</label>

			    <select class="form-control" id="inputInteraction" name="refereeInteractions">
			    	<option>Unsatisfactory </option>
			    	<option selected="selected">Met expectations </option>
			    	<option>Exceeded expectations </option>
			    </select>

			    <input type="text" class="form-control" id="dd1" name="ddText1" placeholder="Please provide furthur detail here">


			 </div>

			 <div class="form-group">
			    <label for="inputPuntual">During your relationship with the candidate, have you found them to be generally on time and punctual? </label>

			    <select class="form-control" id="inputPuntual" name="refereePunctual">
			    	<option>Unsatisfactory </option>
			    	<option selected="selected">Met expectations </option>
			    	<option>Exceeded expectations </option>
			    </select>

			    <input type="text" class="form-control" id="dd2" name="ddText2" placeholder="Please provide furthur detail here">


			 </div>

			 <div class="form-group">
			    <label for="inputCoomunication">How do you rate the candidate’s communication skills, based on the interactions you’ve had with them? </label>

			    <select class="form-control" id="inputCoomunication" name="refereeCommunication">
			    	<option>Unsatisfactory </option>
			    	<option selected="selected">Met expectations </option>
			    	<option>Exceeded expectations </option>
			    </select>

			    <input type="text" class="form-control" id="dd3" name="ddText3" placeholder="Please provide furthur detail here">

			 </div>

			 <div class="form-group">
			    <label for="inputMotivation">Does the candidate display good personal drive and motivation?</label>

			    <select class="form-control" id="inputMotivation" name="refereeMotivation">
			    	<option>Unsatisfactory </option>
			    	<option selected="selected">Met expectations </option>
			    	<option>Exceeded expectations </option>
			    </select>

			    <input type="text" class="form-control" id="dd4" name="ddText4" placeholder="Please provide furthur detail here">

			 </div>


			 <div class="form-group">
			    <label for="inputRelatively">Have you found the candidate to be relatively bright and able to follow instructions? </label>

			    <select class="form-control" id="inputRelatively" name="refereeRelatively">
			    	<option>Unsatisfactory </option>
			    	<option selected="selected">Met expectations </option>
			    	<option>Exceeded expectations </option>
			    	
			    </select>

			    <input type="text" class="form-control" id="dd5" name="ddText5" placeholder="Please provide furthur detail here">


			 </div>

			<h5 class="font-weight-bold text-center">Final Questions</h5>

			<div class="form-group">
			    <label for="inputBasedExp">Based on your experience, what would be the best way to get the most of this candidate? Is there a particular management style you think they would best respond to</label>
			    <input type="text" class="form-control" id="inputBasedExp" name="refereeBasedExp">
			</div>

			<div class="form-group">
			    <label for="inputProspective">Would you recommend the candidate to prospective employers for a role? </label>
			    <input type="text" class="form-control" id="inputProspective" name="refereeProspective">
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

				{{-- <div class="col-md-1">
					<div class="spinner-border sendreferenceSpinner d-none" role="status">
							  <span class="sr-only">Loading...</span>
					</div>
				</div> --}}
			</div>

    </form>

   </div>

</div>


@stop

@section('custom_js')



<script type="text/javascript">

$(document).ready(function(){


	// ================================================ Ajax for saving reference ================================================

    $('.sendReference').on('click',function() {
        event.preventDefault();
        var formData = $('.newRerenceForm').serializeArray();
        // console.log(' formData ', formData);
        $('#centralModalSuccess').show();
        $.ajax({
            type: 'POST',
            url:  '{{route('sendReferenceP')}}',
            data: formData,
            success: function(response){
                // console.log(' data ', response);
         	if(response.status == 1){
         		$('.alreadyBookedInerview').removeClass('d-none');
        			$('#centralModalSuccess').hide();
        			setTimeout(function() {
        			location.href = base_url + '/reference/completed'; 
        			}, 1000);
         	}else{

        			$('#centralModalSuccess').hide();
                   var errorss =  response.validator;
                   var nameError = errorss['refereeName'];
                   var emailError = errorss['refereeEmail'];
                   var mobileError = errorss['refereePhone'];
                   
                   // Name Error 
                   if(nameError) {
                   		var nameError2 = nameError.toString();
                   		$('.errorsInFields').show().text(nameError2).delay(3000).fadeOut('slow');
                   	}		
                   // Email Error 
                   if(emailError){
	                   var emailError2 = emailError.toString();
	                   $('.errorsInFields').show().text(emailError2).delay(3000).fadeOut('slow');
					}
                    // Email Error 
                   if(mobileError){
                   var mobileError2 = mobileError.toString();
                   $('.errorsInFields').show().text(mobileError2).delay(3000).fadeOut('slow');
        
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



<style type="text/css">
	

	
</style>

@stop