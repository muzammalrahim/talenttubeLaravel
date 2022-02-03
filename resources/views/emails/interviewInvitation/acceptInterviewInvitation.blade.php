

<h1>Interview Accepted</h1>

<div>
    <p>Hi <b>{{$company}} </b></p>
	<p>
	

		<b> {{$name}} </b> has completed & submitted their response to your correspondence interview request. 
		
		<p> Please follow the below link to view their response: </p>
		{{route('interviewInvitationUrl', ['url' => $url])}}

	</p>
	<p> Regards</p>
	<p> <b>The Talent Tube Team</b></p>


</div>
