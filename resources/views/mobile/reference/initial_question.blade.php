<div class="initialQuestions">
	<p class="row123 m-0">Hi <span class="font-weight-bold"> {{$crossreference->refName}} </span> </p>
	<p class="row123"><b>{{$crossreference->userName}}</b> has provided your name & details as a referee for their <span class="font-weight-bold"> Talenttube.org </span> profile </p>

	<div class="center1">

		<p class="font-weight-bold mb-3 m-0 p-0"> You will be asked to: </p>
		<p class="m-0 p-0"> <i class="fas fa-arrow-right arrowRight"></i> Confirm your details & relationship with the candidate</p>
		<p class="m-0 p-0"> <i class="fas fa-arrow-right arrowRight"></i> Answer questions relating to your experience and interactions with the candidate </p>
		{{-- <p class="m-0 p-0"> <i class="fas fa-arrow-right arrowRight"></i> Verify {{$crossreference->userName}}'s information </p> --}}
		<p class="m-0 p-0"> <i class="fas fa-arrow-right arrowRight"></i> Provide a potential recommendation for {{$crossreference->userName}}, if you think they would be suitable for a role</p>
	</div>

	<p class="m-0 mt-3">
		All information you provide will be accessible on the Talenttube.org platform. Your reference check will be open to Employers and their networks to help make hiring decisions about the candidate, if you wish to proceed. 
	</p>

	<p>
		Please refer <a href="{{ route('ref_terms') }}" target="_blank"> here </a> for more detailed information about our Reference Check Terms and Conditions. 
	</p>
	
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