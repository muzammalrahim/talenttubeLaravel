
<div class="js_star" style="display: contents;">
	@if($application->goldstar)
		<div class="goldstar d-inline-block">

            @for ($i = 0; $i < $application->goldstar && $i<=5; $i++)
            <div class="d-inline-block">
                <img src="{{asset('images/site/gold_star_icon.png')}}"  >
            </div>
			@endfor
		</div>
	@endif

	@if($application->preffer)
		<div class="silverstar d-inline-block" >
            @for ($j = 0; $j < $application->preffer && $j<=5; $j++)
                <div class="d-inline-block">
                	<img src="{{asset('images/site/silver_star_icon.png')}}"  >
            	</div>
			@endfor
		</div>
	@endif


</div>

