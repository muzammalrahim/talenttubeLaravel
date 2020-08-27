(function(){
	'use strict';
	window.addEventListener('load', function(){
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form){
			form.addEventListener('submit', function(event){
				
				console.log(' form submit ', form.checkValidity() );

				if (form.checkValidity() === false) {
					console.log(' checkValidity false ', form.checkValidity() );
					event.preventDefault();
					event.stopPropagation();
				} else {
					console.log(' checkValidity true ', form.checkValidity() );
					event.preventDefault();
					event.stopPropagation();
					// Register step1 form submit
					var formData = {};
						$('#frm_register_submit').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>').prop('disabled', true);
						$('input:not([type="search"]), select', '#step-1').each(function(){
							formData[this.name] = $.trim(this.value);
						});
						var layout = $('#layout').val();
						formData.layout = layout;
					$.post(base_url+'/register', formData, 
					function(data){
						console.log('register data', data);
						if(!data.status){
							const keys = Object.keys(data.validator);
							for(const key of keys){
								console.log('key = ', key);
								console.log('data.validator.key = ',  data.validator[key] );
								if($('#'+key+'_error').length > 0){
									$('#'+key+'_error').removeClass('d-none').addClass('d-block').text(data.validator[key][0]);
									$('#field_privacy_policy').prop('checked', false);
									$('#frm_register_submit').text('Next');
								}
							}
						} else {
							$('#step-1').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>').prop('disabled', true);
							$('#success-step-1').html(data.message);
							console.log('location', data.redirect);
							setTimeout(() => {
								location.href = data.redirect;
							}, 2000);
						}
					});
					 


				}
				form.classList.add('was-validated');
			}, false);
		});
	}, false);
})();

$(document).ready(function(){
	// Disable Next Button
	$('#field_privacy_policy').on('change', function(){
		if ($(this).prop('checked')){
			$('#frm_register_submit').prop('disabled', false);
		} else {
			$('#frm_register_submit').prop('disabled', true);
		}
	});
});