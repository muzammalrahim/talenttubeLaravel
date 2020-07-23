

<div class="js_star">
	{{-- @dump( $application )	 --}}

	@if($application->goldstar)
		<div class="goldstar">
			@for ($i = 0; $i < $application->goldstar; $i++)
				<img src="{{asset('images/site/gold_star_icon.png')}}" />
			@endfor
		</div>
	@endif 

	@if($application->preffer)
		<div class="silverstar">
			@for ($i = 0; $i < $application->preffer; $i++)
				<img src="{{asset('images/site/silver_star_icon.png')}}" />
			@endfor
		</div>
	@endif


</div>

