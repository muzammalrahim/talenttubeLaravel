
$(document).ready(function(){

	var timedb = $('.timedb').val();

	// console.log(timedb);
	var timer2 = timedb;
	// var timer2 = "5:01";
	var interval = setInterval(function() {
		var timer = timer2.split(':');
		//by parsing integer, I avoid all extra string processing
		var minutes = parseInt(timer[0], 10);
		var seconds = parseInt(timer[1], 10);
		--seconds;
		minutes = (seconds < 0) ? --minutes : minutes;
		if (minutes < 0) clearInterval(interval);
		seconds = (seconds < 0) ? 59 : seconds;
		seconds = (seconds < 10) ? '0' + seconds : seconds;
		//minutes = (minutes < 10) ?  minutes : minutes;
		$('.countdown').html(minutes + ':' + seconds);
		timer2 = minutes + ':' + seconds;
	}, 1000);

	

});

// =========================================================================================================================
// Next Question 
// =========================================================================================================================
$(document).on('click' , '.nextQuestion' , function(){
	var currentTime = $('.countdown').text();
	// console.log(currentTime);
	var formData = $('.usersAnswer').serializeArray();
	console.log(formData , currentTime);
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/saveQuestion/nextQuestion/' + currentTime,
            data:formData,
            success: function(data){
                $('.sendTestButton').html('Send Test').prop('disabled',false);
                $('.questionData').html(data);
            }
        });
});

// =========================================================================================================================
// Save Test 
// =========================================================================================================================
$(document).on('click' , '.saveTestAndResult' , function(){
	var currentTime = $('.countdown').text();
	var formData = $('.usersAnswer').serializeArray();
	console.log(formData , currentTime);
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/saveQuestion/result/' + currentTime,
            data:formData,
            success: function(data){
                // $('.sendTestButton').html('Send Test').prop('disabled',false);
                $('.submitBuutonDiv').removeClass('hide_it');
                var appendIngButton = '<button class = "btn small turquoise submitApplication"> Submit Application </button>';
                $('.submitBuutonDiv').append(appendIngButton);
                $('.questionOnlineTest').addClass('hide_it');
                // window.location.href = "{{ route('testing')}}" ;
            }
        });
});


// =========================================================================================================================
// Save Test on ending duration
// =========================================================================================================================

setInterval(function() {
	var currentTime = $('.countdown').text();
	// console.log(currentTime);
	if (currentTime == 0+':01') {
		var formData = $('.usersAnswer').serializeArray();
		console.log(formData , currentTime);
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	        $.ajax({
	            type: 'POST',
	            url: base_url+'/ajax/saveQuestion/result/' + currentTime,
	            data:formData,
	            success: function(response){
	                // $('.sendTestButton').html('Send Test').prop('disabled',false);
	                // $('.questionData').html(data);
	                if (response.status == 1) {
	                	window.location.href = "{{ route('testing')}}" ;
	                }
	            }
	        });
	}
         
}, 1000);

