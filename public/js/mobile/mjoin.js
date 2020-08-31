var step2_formData = new FormData();
var step3_formData = new FormData();
var step4_formData = new FormData();
var step5_formData = new FormData();
var step6_formData = new FormData();
var step7_formData = new FormData();
var dataIndustryExp = [];
var userQualificationList = [];
var userSalaryRange = '';
var profile_img_selected = false;
var userSelectedTagsList = [];

var isAnswerSend=false;
var dataAnswerJoin={};
var isUploadPhotoJoinAjax=false,
				isUploadPhotoJoin=false;
var profile_img_selected = false;

// Step1 Form Registration Validations User And Ajax
(function(){
	'use strict';
	window.addEventListener('load', function(){
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form){
			form.addEventListener('submit', function(event){
				if (form.checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				} else {
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
								if($('#'+key+'_error').length > 0){
									$('#'+key+'_error').removeClass('d-none').addClass('d-block').text(data.validator[key][0]);
									$('#field_privacy_policy').prop('checked', false);
									$('#frm_register_submit').text('Next');
								}
							}
						} else {
							$('#step-1').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>').prop('disabled', true);
							$('#success-step-1').html(data.message);
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

// Jquery
$(document).ready(function(){
	// Disable Next Button Step1 Registration User Privacy Policy
	$('#field_privacy_policy').on('change', function(){
		if ($(this).prop('checked')){
			$('#frm_register_submit').prop('disabled', false);
		} else {
			$('#frm_register_submit').prop('disabled', true);
		}
		});

		// Step2 Start
		$('.btn_question').click(function(){
			questionAnswer($(this).data('action'));
			})

			$('.card_question.first').css('z-index',4);
			function questionAnswer(action){
				console.log(' questionAnswer ', action, dataAnswerJoin);
				if (isAnswerSend) return;
				isAnswerSend = true;
				var $el = $('.card_question.first:not(.answer)');
				var c = $('.card_question:not(.answer)').length-1;
				if ($el[0]) {
					dataAnswerJoin[$el.data('field')]=action?'yes':'no';
				}
				if (!c) {
					step2_formData.append('questions', JSON.stringify(dataAnswerJoin));
					userStep2Update(step2_formData, 2);
				}
				var cl = action?'to_move_right': 'to_move_left',
								cla = action?'yes':'no';
				$el.oneTransEnd(function(){
					$el.removeAttr('style');
					$el.oneTransEnd(function(){
						var $prev = $el.addClass('answer').prev('.card_question').addClass('first');
						$('#card_question_'+cla).oneTransEnd(function(){
							isAnswerSend = false;
							$prev.css('z-index', 4);
						}).toggleClass('show hide');
					}, 'transform').toggleClass(cl+' to_hide');
				}, 'transform').addClass(cl,0);
				$('#card_question_'+cla).toggleClass('hide show');
			}
			// Step2 End

			// User Step3 Done Start
			$('#user_step3_done').click(function(){
				console.log(' step3_formData ', step3_formData.entries());

				$('#about_me_error,#interested_in_error,.part_photo .name_info,#recentJob_error').addClass('to_hide');
				$('#about_me,#interested_in,.upload_file,#recentJob').removeClass('validation_error');
				
				//validation
				var s3_validation = true;
				var about_me = $.trim($('#about_me').val());
				var interested_in = $.trim($('#interested_in').val());
				var recentJob = $.trim($('#recentJob').val());

				if ( about_me == ''){
					s3_validation = false;
					$('#about_me_error').removeClass('to_hide').text('Required');
					$('#about_me').addClass('validation_error');
					}

					if (interested_in == ''){
						s3_validation = false;
						$('#interested_in_error').removeClass('to_hide').text('Required');
						$('#interested_in').addClass('validation_error');
						}

						if (recentJob == ''){
							s3_validation = false;
							$('#recentJob_error').removeClass('d-none').addClass('d-block');
							$('#recentJob').addClass('validation_error');
						}

						if(!profile_img_selected){
							s3_validation = false;
							$('.part_photo .name_info').removeClass('d-none').addClass('d-block');
							$('.upload_file').addClass('validation_error');
						}

						if(s3_validation){
							step3_formData.append('about_me', about_me);
							step3_formData.append('interested_in', interested_in );
							step3_formData.append('recentJob', recentJob );
							userStep2Update(step3_formData, 3);
							showUserStep4();
					}
			});
			// Profile Image Upload Start
			$('.upload_file').on('click', function(){
				console.log(' upload_file ');
				var input = document.createElement('input');
				input.type = 'file';
				input.setAttribute('accept', 'image/x-png,image/gif,image/jpeg');
				input.onchange = e => {
					$('.part_photo .name_info').addClass('to_hide').text('');
					$('.upload_file').removeClass('validation_error');

					var file = e.target.files[0];
					console.log(' onchange file  ', file );
					step3_formData.append('file', file);
					$('#full_step_3 .name').text(file.name);

					// check file type
					if( file.type == 'image/jpeg' || file.type == 'image/gif' || file.type == 'image/png' || file.type == 'image/x-png' ) {
						var reader = new FileReader();
						reader.onload = function (e) {
										profile_img_selected = true;
										$('.bl.photo_add').text('');
										$('.bl.photo_add').css('background-image','url("'+e.target.result+'")');
										$('.bl.photo_add').css('background-position','center');
										$('.bl.photo_add').css('background-size','cover');
						};
						// read the image file as a data URL.
						reader.readAsDataURL(file);
					}
				}
				input.click();
			});
			// Profile Image Upload End
			// User Step3 End

			// User Step4 Start
			$('.mdb-select').materialSelect();
			$('.qualification_ul').on('click', 'li', function(){
				$('.join_industry_error').removeClass('error').text('');
				var qualification_id = $(this).attr('data-id');
				if (userQualificationList.indexOf(qualification_id) == -1) {
					if (userQualificationList.length < 5) {
						userQualificationList.push(qualification_id);
						$(this).addClass('selected');
					}
				} else {
					userQualificationList.splice(userQualificationList.indexOf(qualification_id), 1);
					$(this).removeClass('selected');
				}
				if (userQualificationList.length > 0){
					$('#user_step4_done').prop('disabled', false);
				} else {
					$('#user_step4_done').prop('disabled', true);
				}
				console.log('userQualificationList', userQualificationList);
			});

			$('#user_step4_done').click(function(){
				step4_formData.append('qualification_type', $('#qualification_type').val());
				step4_formData.append('qualification', JSON.stringify(userQualificationList));
				userStep2Update(step4_formData, 4);
			});
			// User Step4 End

			// User Step5 Start
			jQuery('.industry_ul').on('click','li', function(){
				var industry_id = jQuery(this).attr('data-id');
				if (dataIndustryExp.indexOf(industry_id) == -1){
								if(dataIndustryExp.length < 5 ){
												dataIndustryExp.push(industry_id);
												jQuery(this).addClass('selected');
								}
				}else{
								dataIndustryExp.splice(dataIndustryExp.indexOf(industry_id),1);
								jQuery(this).removeClass('selected');
				}
				$('.join_industry_error').removeClass('error').text('');
				console.log('dataIndustryExp ', dataIndustryExp );
				if (dataIndustryExp.length > 0){
								jQuery('.industryExpBtn_done').prop('disabled',false);
				}else{
								jQuery('.industryExpBtn_done').prop('disabled',true);
				}
				});
				$('#user_step5_done').click(function(){
					step5_formData.append('industry_experience', JSON.stringify(dataIndustryExp));
     userStep2Update(step5_formData, 5);
				});
			// User Step5 End

			// User Step6 Start
			    // add the selected one to User Qualification selection list.
							jQuery('.salary_ul').on('click','li', function(){
        var salary_id = jQuery(this).attr('data-id');
        jQuery('.salary_ul li.selected').removeClass('selected');
        jQuery(this).addClass('selected');
        userSalaryRange = salary_id;
        if (userSalaryRange != '' ){ jQuery('#user_step6_done').prop('disabled',false); }
        console.log('userSalaryRange ', userSalaryRange );
				});
				$('#user_step6_done').click(function(){
					step6_formData.append('salaryRange', userSalaryRange);
     userStep2Update(step6_formData, 6);
				});
			// User Step6 End
			
			// User Step7 Start
			$('#photo_add_video').on('click', function(){
				var input = document.createElement('input');
				input.type = 'file';
				input.onchange = e => {
					var file = e.target.files[0];
					console.log(' onchange file  ', file);
					var formData = new FormData();
					formData.append('video', file);
					var item_id = Math.floor((Math.random() * 1000) + 1);
					var video_item = '';
					video_item += '<div id="v_'+item_id+'" class="item profile_photo_frame item_video" style="display: inline-block;">';
					video_item  +=  '<a class="show_photo_gallery video_link" href="">';
					video_item  +=  '</a>';
					video_item  +=  '<span class="v_title">Video title</span>';
					video_item  +=  '<span title="Delete video" class="icon_delete">';
					video_item  +=      '<span class="icon_delete_photo"></span>';
					video_item  +=      '<span class="icon_delete_photo_hover"></span>';
					video_item  +=  '</span>';
					video_item  +=  '<div class="v_error error hide_it"></div>';
					video_item  +=  '<div class="v_progress"></div>';
					video_item  += '</div>';
					$('.list_videos').append(video_item);
					var updateForm = document.querySelector('form');
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					var request = new XMLHttpRequest();
					request.upload.addEventListener('progress', function(e){
						var percent = Math.round((e.loaded / e.total) * 100);
						console.log(' progress-bar ', percent+'%' );
						$('#v_'+item_id+' .v_progress').css('width', percent+'%');
					}, false);
					request.addEventListener('load', function(e){
						console.log(' load e ', e);
						var resp = JSON.parse(e.target.responseText);
						console.log(' jsonResponse ', resp);
						$('#v_'+item_id+' .v_progress').remove();
						if (resp.status == 1) {
							$('#v_'+item_id).replaceWith(res.html);
						} else {
							console.log(' video error ');
							if (resp.validator != undefined) {
								$('#v_'+item_id+' .error').removeClass('hide_it').addClass('to_show').text(res.validator['video'][0]);
							}
						}
					}, false);
					request.open('post', base_url+'/m/ajax/uploadVideo');
					request.send(formData);
				}
				input.click();
			});
			$('#user_step7_done').click(function(){
				userStep2Update(step6_formData,7);
			});
			// User Step7 End
			// Step2 Send Ajax Request Start
			var userType = $('#userType').val();
			function userStep2Update(data, step){
				console.log(' userStep2Update data ', data );
				console.log(' userStep2Update step ', step );
				$('.full_step_error').html('');
				data.append('step', step);
				if (userType == 'user') {
					var currentButtonText =   $("#user_step"+step+"_done").html();
					$("#user_step"+step+"_done").html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>');
					$.ajaxSetup({headers: {'X-CSRF-TOKEN': $(   'meta[name="csrf-token"]').attr('content')}});
					$.ajax({
						url: base_url+'/m/step2',
						type: 'POST',
						data: data,
						processData: false,
						contentType: false,
						success: function(resp) {
							console.log('response', resp);
							if (resp.status == 1) {
								switch (step) {
									case 2:
										showUserStep3();
										break;
									case 3:
										showUserStep4();
										break;
									case 4:
										showUserStep5();
										break;
									case 5:
										showUserStep6();
										break;
									case 6:
										showUserStep7();
										break;
									case 7:
										showUserStep8();
										break;
									default:
										break;
								}
							} else {
								// stop the loader.
								$("#user_step"+step+"_done").html(currentButtonText);
								// if validation error occure.
								if (resp.validator !== undefined) {
									const keys = Object.keys(resp.validator);
									console.log(keys);
									for(const key of keys){
										var error_html = '<p>'+resp.validator[key][0]+'</p>';
										$('.full_step_error').append(error_html);
									}
								}
							}
						}
					});
				}
			}
			// Step2 Send Ajax Request End
});

function showUserStep2(){
	$('#full_step_1').delay(150).fadeIn(500);
}

function showUserStep3(){
	$('#join_step ul li').removeClass('active').addClass('d-none');
    $('#join_step ul li:eq(1)').addClass('active').removeClass('d-none');;
    $('#full_step_1').fadeOut(400,function(){
        $('#full_step_3').fadeIn(400,function(){
            var $baseField=$('#full_step_3').find('.placeholder_always');
            if($baseField[0])$baseField.eq(0).focus();
        });
    });
}

function showUserStep4(){
	$('#join_step ul li').removeClass('active').addClass('d-none');
	$('#join_step ul li:eq(1)').removeClass('d-block');
	$('#join_step ul li:eq(2)').addClass('active').removeClass('d-none');
	$('#full_step_3').fadeOut(400,function(){
					$('#full_step_4').fadeIn(400,function(){
					});
	});

	$('#qualification_type').on('change',function(){
					console.log(' qualification_type ');
					userQualificationList = [];
					$('.qualification_ul li.selected').removeClass('selected');
					var qualif_type = $(this).val();
					console.log(' qualif_type ', qualif_type);
					if(qualif_type != ''){
									$('.select_qualification_list').removeClass('trade').removeClass('degree');
									$('.select_qualification_list').addClass( (qualif_type == 'trade')?'trade':'degree');
									$('.select_qualification_list').fadeIn(400,function(){});
					}else{
									$('.select_qualification_list').fadeOut(400,function(){});
					}

	});
}

function showUserStep5(){
	$('#join_step ul li').removeClass('active').addClass('d-none');
	$('#join_step ul li:eq(1), #join_step ul li:eq(2)').removeClass('d-block');
	$('#join_step ul li:eq(3)').addClass('active').removeClass('d-none');
	$('#full_step_4').fadeOut(400,function(){
					$('#full_step_5').fadeIn(400,function(){
					});
	});
}

function showUserStep6(){
	$('#join_step ul li').removeClass('active').addClass('d-none');
	$('#join_step ul li:eq(1), #join_step ul li:eq(2), #join_step ul li:eq(3)').removeClass('d-block');
	$('#join_step ul li:eq(4)').addClass('active').removeClass('d-none');
	$('#full_step_5').fadeOut(400,function(){
					$('#full_step_6').fadeIn(400,function(){
					});
	});
}

function showUserStep7(){
	$('#join_step ul li').removeClass('active').addClass('d-none');
	$('#join_step ul li:eq(1), #join_step ul li:eq(2), #join_step ul li:eq(3), #join_step ul li:eq(4)').removeClass('d-block');
	$('#join_step ul li:eq(5)').addClass('active').removeClass('d-none');
	$('#full_step_6').fadeOut(400,function(){
					$('#full_step_7').fadeIn(400,function(){
					});
	});
}

function showUserStep8(){
	$('#join_step ul li').removeClass('active').addClass('d-none');
	$('#join_step ul li:eq(1), #join_step ul li:eq(2), #join_step ul li:eq(3), #join_step ul li:eq(4), #join_step ul li:eq(5)').removeClass('d-block');
	$('#join_step ul li:eq(6)').addClass('active').removeClass('d-none');
	$('#full_step_7').fadeOut(400,function(){
					$('#full_step_8').fadeIn(400,function(){
					});
	});
}
// After reload the user window
function userStepReload(currentStep) {
	switch (currentStep) {
					case 2:
									showUserStep3();
									break;
					case 3:
									showUserStep4();
									break;
					case 4:
									showUserStep5();
									break;
					case 5:
									showUserStep6();
									break;
					case 6:
									showUserStep7();
									break;
					case 7:
									showUserStep8();
									break;
					case 8:
									showUserStep9();
									break;
					case 9:
									showUserStep10();
									break;
					case 10:
									showUserStep10();
									break;
					default:
									showUserStep2();
									break;
	}
}