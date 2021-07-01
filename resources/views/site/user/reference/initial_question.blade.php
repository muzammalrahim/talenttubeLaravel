<div class="initialQuestions">
	<div class="row123 m-0"> <span class="font-weight-bold"> Hi {{$crossreference->refName}}</span> </div>
	<div class="row123"><b class="">{{$crossreference->userName}}</b> has provided your name & detail as a referee for their <span class="font-weight-bold"> Talenttube.org </span> profile</div>

	<div class="center1" style="margin-left: 10%;"> 
		<p class="m-0 p-0 mt-3"> You will be asked to: </p>
		<p class="m-0 p-0"> <i class="fas fa-arrow-right arrowRight"></i> Confirm your details & relationship with the candidate</p>
		<p class="m-0 p-0"> <i class="fas fa-arrow-right arrowRight"></i> Answer questions relating to your experience and interactions with the candidate </p>
		<p class="m-0 p-0"> <i class="fas fa-arrow-right arrowRight"></i> Provide a potential recommendation for {{$crossreference->userName}}, if you think they would be suitable for a role</p>
		{{-- <p class="m-0 p-0"> <i class="fas fa-arrow-right arrowRight"></i> Verify {{$crossreference->userName}}'s information </p> --}}
	</div>

	<p class="m-0 mt-3">
		All information you provide will be accessible on the Talenttube.org platform. Your reference check will be open to Employers and their networks to help make hiring decisions about the candidate, if you wish to proceed. 
	</p>

	<p>
		Please refer <a href="{{ route('ref_terms') }}" target="_blank"> here </a> for more detailed information about our Reference Check Terms and Conditions. 
	</p>

	<div class="row mt-3"style="margin-left: 10%;">
			<button class="col-md-2 btn btn-outline-danger declineButton border border-danger text-danger" name="refID" value="{{$crossreference->id}}"> Decline</button>
			<div class="col-md-1">
				<div class="spinner-border declinedSpinner d-none" role="status">
				  <span class="sr-only">Loading...</span>
				</div>
			</div>
			<button class="col-md-2 btn btn-sm btn-primary letsGoButton"> Let's Go</button>
	</div>
</div>