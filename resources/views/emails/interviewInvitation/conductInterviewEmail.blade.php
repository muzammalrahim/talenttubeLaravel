

<h1>Interview Invitation</h1>

<div>
    <p>Hi jobseeker</p>
	<p>
	

		<b> {{$empName}} </b> has has invited you for interview 
		
		<p>Please follow the link below to confirm your interview </p>
		<p>
			{{route('interviewInvitationUrl', ['url' => $url])}}
		</p>
	</p>
	<p> Regards</p>
	<p> <b>The Talent Tube Team</b></p>

	{{-- {{route('userinterviewconcierge.url', ['url' => $url])}} --}}
</div>
