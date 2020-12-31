

<h1>Reference</h1>

<div>
    <p>Hi {{$name}}</p>
	<p>
	

		<b> {{$username}} </b> has provided your name & details to complete a short reference check on their behalf.  The reference check should only take 5 minutes to complete and can be accessed by prospective employers in the Talent Tube network, who may be interested in considering  <b> {{$username}} </b>for a potential job opportunity.

		<p>
			You will be asked to:
		</p>

		<ul>
			<li> Confirm your details & relationship with the candidate</li>
			<li> Answer questions relating to your experience and interactions with the candidate</li>
			<li> Provide a potential recommendation for <b>{{$username}}</b>, if you think they would be suitable</li>
		
		</ul>
		
		<p>Please follow the link below to submit your reference for <b> {{$username}} </b>. </p>
		<p>
			{{route('crosssreference', ['url' => $refURL])}}
		</p>
	</p>
	<p> Regards</p>
	<p> <b>The Talent Tube Team</b></p>

	{{-- {{route('userinterviewconcierge.url', ['url' => $url])}} --}}
</div>
