

<div class="js_star" style="position: absolute;left: 20px; top:10px;">
	@if($application->goldstar)
		<div class="goldstar">

            @for ($i = 0; $i < $application->goldstar && $i<=5; $i++)
            <div >
                <img src="{{asset('images/site/gold_star_icon.png')}}"  >
            </div>
			@endfor
		</div>
	@endif

	@if($application->preffer)
		<div class="silverstar" >
            @for ($j = 0; $j < $application->preffer && $j<=5; $j++)
                <div >
                <img src="{{asset('images/site/silver_star_icon.png')}}"  >
            </div>
			@endfor
		</div>
	@endif


</div>

