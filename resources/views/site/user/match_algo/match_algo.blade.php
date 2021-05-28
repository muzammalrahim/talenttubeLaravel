

<div class="dflex"> 
	@php
		$dist = calculate_distance($js, $user);
		$ind_exp = cal_ind_exp($js,$user);
		$compatibility = compatibility($js, $user); 
		$user_compat = $compatibility*20;
		// dump($user_compat);
		// $resident = initial_last_question($js,$user);

		// ========================= excluded 6th question ========================= 
		
		
		$emp_questions = json_decode($js->questions , true);
        $user_questions = json_decode($user->questions , true);

        // dump($emp_questions);




        // {"resident":"no","relocation":"yes","fulltime":"yes","temporary_contract":"yes","part_time":"no","graduate_intern":"yes"}


        // $checkLastQuestion = end($emp_questions);

        // dump($checkLastQuestion);


        $emp_resident = '';
        $user_resident = '';
        
        if ($emp_questions != null && $user_questions != null) {
            $emp_match = array_slice($emp_questions, 5, 6, true);
            foreach ($emp_match as $key => $value) {
                $emp_resident .= $value;
            }
            $user_match = array_slice($user_questions, 5, 6, true);
            foreach ($user_match as $key => $value) {
                $user_resident .= $value;
            }


        }

	@endphp

		{{-- @dump($emp_resident) --}}

	@if ($emp_resident == 'no' && $user_resident == 'no')

		<div class="text-danger bold w50"> No Match Potential </div>

		@else

			@if ($dist < 50 && !empty($ind_exp))
				<div class="text-green bold w50"> Strong Match Potential </div>

			@elseif($dist < 50 )
				<div class="text-orange bold w50"> Moderate Match Potential  </div>

			@elseif(!empty($ind_exp))
				<div class="text-orange w50"> Moderate Match Potential </div>
			@else

				<div class="text-danger bold w50"> No Match Potential </div>
			@endif


	@endif


		
		
	{{-- @endif --}}

		

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