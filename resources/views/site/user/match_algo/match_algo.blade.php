

<div class="dflex"> 
	@php
		$dist = calculate_distance($js, $user);
		$ind_exp = cal_ind_exp($js,$user);
		$compatibility = compatibility($js, $user); 
		$user_compat = $compatibility*16.6; 
	@endphp
	@if ($dist < 50 && !empty($ind_exp))
		<div class="text-green bold w50"> Strong Match Potential </div>

	@elseif($dist < 50 )
		<div class="text-orange bold w50"> Moderate Match Potential  </div>

	@elseif(!empty($ind_exp))
		<div class="text-orange w50"> Moderate Match Potential </div>
	@else

		<div class="text-danger bold w50"> No Match Found </div>
	@endif

	{{-- <div class="w30"> {{ $user_compat }}  </div> --}}

    	<div class="w50">
    		<div id="piechart_{{$js->id}}"></div>
    	</div>
    	<script type="text/javascript">
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);
				function drawChart() {
				  var data = google.visualization.arrayToDataTable([
				  ['Task', 'Potenial'],
				  ['Match', {{ $user_compat }}],
				  ['Unmatch',100-{{ $user_compat }}],
				]);
			  var options = { 'width':300, 'height':160};
			  var chart = new google.visualization.PieChart(document.getElementById('piechart_'+{{$js->id}}));
			  chart.draw(data, options);
			}
		
		</script>
</div>