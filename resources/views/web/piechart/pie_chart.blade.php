


<div class="pb-4 piechart-div" style="width:204px;margin-top: 5px;">
  <div id="piechart_{{$js->id}}" class="job-box-info"></div>
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

    var options = { 'width':200, 'height':160, legend:{position: 'bottom'}, tooltip: { isHtml: true },};

    var chart = new google.visualization.PieChart(document.getElementById('piechart_'+{{$js->id}}));
    chart.draw(data, options);
  }
  
</script>