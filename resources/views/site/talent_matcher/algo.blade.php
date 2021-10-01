

<div class=""> 

		

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