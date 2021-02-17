

<h1>Interview Invitation</h1>

<div>
    <p>Hi <b>jobseeker</b> </p>
	<p>
	

		<b> {{$empName}} </b> has has invited you for interview.
		<p> Please log in to your talentube account and go to <b> " Interview Invitation Menu " </b> to respond to the invitaion </p> 

		<p>You can also follow the below link to confirm your interview. </p>
		<p>
			{{route('interviewInvitationUrl', ['url' => $url])}}
		</p>
	</p>
	<p> Regards</p>
	<p> <b>The Talent Tube Team</b></p>

	{{-- {{route('userinterviewconcierge.url', ['url' => $url])}} --}}
</div>
