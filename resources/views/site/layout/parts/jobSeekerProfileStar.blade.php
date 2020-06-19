

<div class="js_star">
	{{-- @dump( $application )	 --}}

	@if($application->goldstar)
		<div class="goldstar"><img src="{{asset('images/site/gold_star_icon.png')}}" /></div>
	@elseif($application->preffer)
		<div class="silverstar"><img src="{{asset('images/site/silver_star_icon.png')}}" /></div>
	@endif


</div>

