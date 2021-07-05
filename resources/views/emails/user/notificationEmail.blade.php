

<h1>Interview Booking</h1>

<div>
    <p>Dear <b> {{$name}} </b> </p>
    <p>
    Good news, you have been selected by <b>{{$employerName}}</b> to interview for the position of <b>{{$positionname}} </b>. Please follow the link below to select from a number of available times and dates for your interview. After selecting your preferred time, you will receive a confirmation email with you interview details. On behalf of Talent Tube, we wish you all the best of luck for your interview.<br>
	<p>Regards,</p>
	<p><b>The Talent Tube Team</b></p>
	</p>
	{{route('userinterviewconcierge.url', ['url' => $url])}}
</div>
