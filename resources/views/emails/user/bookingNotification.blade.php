

<h1>Slot Booked</h1>

<div>
    <p><b> {{$name}} </b> has booked interview slot for the position of <b> {{$position}} </b></p>
	{{-- {{route('userinterviewconcierge.url', ['url' => $url])}} --}}
	{{-- <p>	Good news, your interview is now confirmed. Please find below confirmation details for your interview.</p> --}}
	<p> <b>Interview name: </b> {{$bookingTitle}} </p>
	{{-- <p> <b>Company:</b> {{$companyname}}    </p> --}}
	{{-- <p> <b>Position title:</b> {{$position}}  		</p> --}}
	<p> <b>Instructions: </b> {{$instruction}} </p>
	<p> <b>Interview Date: </b>{{$datepicker}} </p>
	<p> <b>Interview Time: </b> {{$timepicker}} to {{$timepicker1}} </p>

</div>
