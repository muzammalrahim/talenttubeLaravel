    
@extends('mobile.reference.refMobileMaster')  {{-- mobile/reference/refMobileMaster --}}

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
		   			We require the below details, should any prospective employer wish to verify the authenticity of this reference check or require additional information about their hiring decision.
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
			    <label for="inputOrganization">What is the name of organization you and candidate worked for ?</label>
			    <input type="text" class="form-control" id="inputOrganization" name="refereeOrganization">
			  </div>

			  <div class="form-group">
			    <label for="inputTitle">What was the candidates job title at the organisation you worked together? </label>
			    <input type="text" class="form-control" id="inputTitle" name="candidateTitle">
			  </div>


			  <div class="form-group">
			    <label for="inputDates">What dates did you work together ?</label>
			    <input type="text" class="form-control" id="inputDates" name="refereeDates">
			  </div>

			  <div class="form-group">
			    <label for="inputOrgTitle">What was your title at the organisation ?</label>
			    <input type="text" class="form-control" id="inputOrgTitle" name="refereeOrganizationTitle">
			  </div>
			  <div class="form-group">
			    <label for="inputReport">Did the candidate report to you ?</label>
			    <input type="text" class="form-control" id="inputReport" name="refereeReport">
			  </div>

			  <div class="form-group">
			    <label for="inputLeaving">Is the candidate still working at this organisation? If not, what was their reason for leaving? </label>
			    <input type="text" class="form-control" id="inputLeaving" name="refereeLeaving">
			  </div>
			
			<h5 class="font-weight-bold text-center"> Work Related Questions </h5>

			<p>
				Please note, each of these questions requires a rating (unsatisfactory, met expectations, exceeded expectations) and verbatim commentary
			</p>

			<div class="form-group">
			    <label for="inputPerExpectation">Did the candidate meet their performance expectations in the role?</label>

			    <select class="form-control" id="inputPerExpectation" name="refereePerformance">
			    	<option>Unsatisfactory </option>
			    	<option selected="selected">Met expectations </option>
			    	<option>Exceeded expectations </option>
			    </select>

			    <input type="text" class="form-control" id="dd1" name="ddText1" placeholder="Please provide futhur detail here">

			 </div>

			 <div class="form-group">
			    <label for="inputRequirement">Was the candidate on time & punctual? Did they provide adequate notice & acceptable reasons for any leave requirements?</label>

			    <select class="form-control" id="inputRequirement" name="refereeRequirements">
			    	<option>Unsatisfactory </option>
			    	<option selected="selected">Met expectations </option>
			    	<option>Exceeded expectations </option>
			    </select>

			    <input type="text" class="form-control" id="dd2" name="ddText2" placeholder="Please provide futhur detail here">

			 </div>

			 <div class="form-group">
			    <label for="inputBehaviour">Did the candidate display good values and behaviours at work?</label>

			    <select class="form-control" id="inputBehaviour" name="refereeBehaviours">
			    	<option>Unsatisfactory </option>
			    	<option selected="selected">Met expectations </option>
			    	<option>Exceeded expectations </option>
			    </select>

			    <input type="text" class="form-control" id="dd3" name="ddText3" placeholder="Please provide futhur detail here">

			 </div>

			 <div class="form-group">
			    <label for="inputTeamPlayer">In terms of working in a group, was the candidate a team player and able to work well with others?</label>

			    <select class="form-control" id="inputTeamPlayer" name="refereeTeamplayer">
			    	<option>Unsatisfactory </option>
			    	<option selected="selected">Met expectations </option>
			    	<option>Exceeded expectations </option>
			    </select>

			    <input type="text" class="form-control" id="dd4" name="ddText4" placeholder="Please provide futhur detail here">

			 </div>

			<h5 class="font-weight-bold text-center">Final Questions</h5>

			<div class="form-group">
			    <label for="inputManagement">What’s the best management advice you could provide to the candidate’s next Leader? Does the candidate best respond to any particular management style?</label>
			    <input type="text" class="form-control" id="inputManagement" name="refereeManagementr">
			</div>

			<div class="form-group">
			    <label for="inputProspectives">Would you recommend the candidate to prospective employers for a role? </label>
			    <input type="text" class="form-control" id="inputProspectives" name="refereeProspective">
			</div>

			<div class="form-group">
			    <label for="inputPotentially">Would you potentially rehire the candidate?  </label>
			    <input type="text" class="form-control" id="inputPotentially" name="refereePotentially">
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

				{{-- <div class="col-md-1 text-center">
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

	// ================================================ Ajax for savinf reference ================================================

    $('.sendReference').on('click',function() {
        event.preventDefault();
        var formData = $('.newRerenceForm').serializeArray();
        // console.log(' formData ', formData);
        $('#centralModalSuccess').show();
        $.ajax({
            type: 'POST',
            url:  '{{route('sendReferenceW')}}',
            data: formData,
            success: function(response){
                // console.log(' data ', response);
         	if(response.status == 1)
         	{
         		$('.alreadyBookedInerview').removeClass('d-none');
        			setTimeout(function() {
        			location.href = base_url + '/reference/completed'; 
        			}, 4000);
        			$('#centralModalSuccess').hide();
         	}
        	else{
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

{{-- <link rel="stylesheet" href="{{ asset('css/master.css') }}"> --}}


<style type="text/css">
	

</style>

@stop