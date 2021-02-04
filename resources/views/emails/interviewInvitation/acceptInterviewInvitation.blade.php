

<h1>Interview Accepted</h1>

<div>
    <p>Hi <b>{{$company}} </b></p>
	<p>
	

		<b> {{$name}} </b> has has accpted your interview proposal 
		
		<p>Please follow the below link to submit your response </p>
		{{route('interviewInvitationUrl', ['url' => $url])}}

	</p>
	<p> Regards</p>
	<p> <b>The Talent Tube Team</b></p>


</div>
