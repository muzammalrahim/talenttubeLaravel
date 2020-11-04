

<h1>Interview Booking</h1>

<div>
    <p>Respected candidate {{$name}}, you have been seleted for an interview. Please, follow the link below to book your slot</p>
	{{route('userinterviewconcierge.url', ['url' => $url])}}
</div>
