{{-- @extends('adminlte::master') --}}
@extends('mobile.master')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Register</h1>
@stop

@section('custom_css')
				{{-- <link rel="stylesheet" href="{{ asset('css/mobile/mdb/addons-pro/steppers.min.css') }}"> --}}
				<link rel="stylesheet" href="{{ asset('css/site/card.css') }}">
				<link rel="stylesheet" href="{{ asset('css/mobile/mjoin.css') }}">
@stop

@section('classes_body', 'register step2')

@section('body')
<!-- Header Start -->
<div class="jumbotron text-white bg-dark text-center">
	<input type="hidden" id="userType" name="userType" value="user" />
	<div class="container">
		<a href="./index"><img src="{{asset('/images/site/logo.png')}}" style="max-height:45px;  max-width:238px;" alt="" /></a>
	</div>
</div>
<div class="container text-center" style="background: transparent;">
	<div class="row">
		<div id="join_step" class="step col">
			<ul class="list-group">
				<li class="list-group-item active"><span class="rounded p-4 bg-dark mr-2 d-inline-block h3">1</span> Answer 6 questions to calculate your best matches.</li>
				<li class="list-group-item d-none"><span class="rounded p-4 bg-dark mr-2 d-inline-block h3">2</span> Update your profile</li>
				<li class="list-group-item d-none"><span class="rounded p-4 bg-dark mr-2 d-inline-block h3">3</span> Qualification</li>
				<li class="list-group-item d-none"><span class="rounded p-4 bg-dark mr-2 d-inline-block h3">4</span> Industry Experience</li>
				<li class="list-group-item d-none"><span class="rounded p-4 bg-dark mr-2 d-inline-block h3">5</span> Salary Range</li>
				<li class="list-group-item d-none"><span class="rounded p-4 bg-dark mr-2 d-inline-block h3">6</span> Upload Video</li>
				<li class="list-group-item d-none"><span class="rounded p-4 bg-dark mr-2 d-inline-block h3">7</span> Upload Resume</li>
				<li class="list-group-item d-none"><span class="rounded p-4 bg-dark mr-2">8</span></li>
				<li class="list-group-item d-none"><span class="rounded p-4 bg-dark mr-2">9</span></li>
			</ul>
		</div>
	</div>
	</div>
<!-- Header End -->
<div class="container">
	<div class="full_step_error"></div>
<!-- Step 1 Start -->
	<div class="row py-3 bl_card_question" id="full_step_1" style="display:none;">
		<div class="col">
							<div class="card_question_cont">
								<div id="card_question_no" class="card_question no hide answer">
												<div class="question_vh"><img src="../images/icon_card_answer_no.png" width="224" height="224" alt="" /><span>No</span></div>
								</div>
								<div id="card_question_yes" class="card_question yes hide answer">
												<div class="question_vh"><img src="../images/icon_card_answer_yes.png" width="224" height="224" alt="" /><span>Yes</span></div>
								</div>
	
								<div data-field="graduate_intern" class="card_question card">
												<div class="count">6 of 6</div><div class="question_txt">Are you seeking a Graduate Program or Internship?</div>
								</div>
	
								<div data-field="part_time" class="card_question card">
												<div class="count">5 of 6</div><div class="question_txt">Are you open to Part Time or Casual work?</div>
								</div>
	
								<div data-field="temporary_contract" class="card_question card">
												<div class="count">4 of 6</div><div class="question_txt">Are you open to temporary and contract work?</div>
								</div>
	
								<div data-field="fulltime" class="card_question card">
												<div class="count">3 of 6</div><div class="question_txt">Are you looking for Full Time Employment?</div>
								</div>
	
								<div data-field="relocation" class="card_question card">
												<div class="count">2 of 6</div><div class="question_txt">Are you looking or willing to relocate for your next job opportunity?</div>
								</div>
	
								<div data-field="resident" class="card_question first card">
												<div class="count">1 of 6</div><div class="question_txt">Are you a Permanent Resident or Citizen of Australia or New Zealand?</div>
								</div>
	
								<div class="card_decor_left1"></div>
								<div class="card_decor_left2"></div>
								<div class="card_decor_right1"></div>
				</div>
				<div class="card_question_btn">
					<button data-action="0" class="btn large pink fl_left btn_question">No</button>
					<button data-action="1" class="btn large turquoise fl_right btn_question">Yes</button>
					<div class="cl"></div>
				</div>
		</div>
	</div>
	<!-- Step 1 End -->
	
	<!-- Step 3 Start -->
		<div class="row py-3" id="full_step_3" style="display: none">
			<div class="col">
				<div class="card_profile">
					<div class="part_photo">
									<div class="upload_file"><div class="upload"><div class="bl photo_add">Add a Photo</div></div></div>
									<div class="name d-none"></div>
									<div class="name_info d-none text-danger">Required field!</div>
									<div class="recent_job m5 mt20 relative">
														<div class="title">Your current or most recent job title and employer</div>
														<input type="text" id="recentJob" name="recentJob" value="" />
														<div id="recentJob_error" class="d-none text-danger">Required field!</div>
									</div>
	
					</div>
	
					<div id="frm_card_join" class="card_profile_info card_join">
	
									<div class="bl bl_basic">
									<div class="title">About me</div>
									<div id="about_me_error" class="error to_hide">Required field!</div>
									<textarea id="about_me" class="placeholder_always fl_basic" name="about_me" placeholder="Summarise your career, studies & skills here" maxlength="1000"></textarea>
									</div>
	
									<div class="bl bl_basic">
									<div class="title">Interested in</div>
									<div id="interested_in_error" class="error to_hide">Required field!</div>
	
									<textarea id="interested_in" class="placeholder_always fl_basic" name="interested_in" placeholder="What opportunities are you open to" maxlength="1000"></textarea>
									</div>
									<div class="text-center">
										<button id="user_step3_done" class="btn turquoise small btn_join_submit">Done</button>
									</div>
					</div>
				</div>
			</div>
		</div>
	<!-- Step 3 End -->
	<!-- Step 4 Start -->
	<div id="full_step_4" class="row py-3" style="display: none">
		<div class="col">
			<div class="card wider">
				<div class="card-body text-center">
					<h4 class="card-title"><strong>Please select the highest level of tertiary studies you have completed or currently enrolled in and completing (You can only select 1 option)</strong></h4>
					<div class="qualification_selected_type mb20 center mb-2">
						<div class="qualification_type_cont">
										<select class="qualification_type mdb-select md-form dropdown-success colorful-select" id="qualification_type" name="qualification_type" data-placeholder="Select Qalification & Trades">
															<option value="">Select Qalification & Trades</option>
															<option value="certificate">Certificate or Advanced Diploma</option>
															<option value="trade">Trade Certificate </option>
															<option value="degree">University Degree</option>
															<option value="post_degree">University Post Graduate (Masters or PHD) </option>
										</select>
						</div>
					</div>
					<div class="select_qualification_list" style="display: none;">
						<div class="qualification_list">
										<div class="qualification_ul_cont">
														<ul class="qualification_ul item_ul list-group">
																			@php
																						$qualifications = getQualificationsList();
																		@endphp

																			@if (!empty($qualifications))
																				@foreach ($qualifications as $qkey => $quaf)
																						<li class="{{$quaf['type']}} list-group-item" data-id="{{$quaf['id']}}"> {{$quaf['title']}} </li>
																				@endforeach                                                 
																		@endif
														</ul>
										</div>
						</div>
					</div>
					<div class="join_btn mt20 center">
						<div class="join_industry_error"></div>
						<button id="user_step4_done" class="btn turquoise small btn_join_submit" disabled="true">Done</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Step 4 End -->
	<!-- Step 5 Start -->
	<div class="row py-3" id="full_step_5" style="display: none">
		<div class="col">
			<div class="card wider">
				<div class="card-body">
					<h4 class="card-title text-center"><strong>Please select from the industries and role types below, that best describe the type of candidates you’d like to match with. You can select up to 5 and change these at any time.</strong></h4>
					<div class="industry_list">
						<div class="industry_ul_cont">
										<ul class="industry_ul item_ul list-group">
															@php
																		$industries = getIndustries();
														@endphp

															@if (!empty($industries))
																@foreach ($industries as $ikey => $industry)
																		<li data-id="{{$ikey}}" class="list-group-item"> {{$industry}} </li>
																@endforeach                                                 
														@endif
										</ul>
						</div>
					</div>

					<div class="join_btn mt20 text-center mt-4">
									<div class="join_industry_error"></div>
									<button id="user_step5_done" class="btn turquoise small btn_join_submit industryExpBtn_done" disabled="true">Done</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Step 5 End -->

	<!-- Step 6 Start -->
	<div class="row py-3" id="full_step_6" style="display: none">
		<div class="col">
			<div class="card wider">
				<div class="card-body">
					<h4 class="card-title text-center"><strong>What’s a rough idea of the salary range you are open to?</strong></h4>
						<div class="salary_list">
							<div class="salary_list_cont">
									<ul class="salary_ul item_ul list-group">
											@php
													$salaries = getSalariesRange();
											@endphp
											@if (!empty($salaries))
													@foreach ($salaries as $ikey => $salary)
															<li data-id="{{$ikey}}" class="list-group-item"> {{$salary}} </li>
													@endforeach                                                 
											@endif
								</ul>
							</div>
					</div>
					<div class="join_btn mt-3 text-center">
									<button id="user_step6_done" class="btn turquoise small btn_join_submit " disabled="true">Done</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Step 6 End -->

	<!-- Step 7 Start -->
	<div class="row py-3" id="full_step_7" style="display: none">
		<div class="col">
			<div class="card wider">
				<div class="card-body">
					<h4 class="text-center"><strong>Well done candidates, To complete your application, all you need to upload a 30-60 second video...</strong></h4>
					<p class="text-center">Record a short 30-60 second video of yourself, and upload it in the portal below. Be sure to say hi, tell us about what you’ve done in your career, any key skills/studies/attributes you have, and very briefly the kind of opportunities you’re interested in. You can be as casual as you like, this is more about employers getting an idea of your personality and culture fit.</p>
					<div class="userUpload">
						<div class="userVideoCont">
										<div class="userVideo">
														<div class="title_private_photos title_videos">Upload Videos</div>
														<div id="list_videos_public" class="list_videos_public">
																		<div id="photo_add_video" class="item add_photo add_video_public item_video">
																						<a class="add_photo">
																										<img id="video_upload_select" class="transparent is_video" src="{{ asset('images/site/icons/add_video160x120.png') }}" style="opacity: 1">
																						</a>
																		</div>
														</div>
														<div class="list_videos mt-3"></div>
										</div>
						</div>
					</div>
					<div class="join_btn text-center">
									<button id="user_step7_done" class="btn mt-3 turquoise small btn_join_submit">Done</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Step 7 End -->
	<!-- Step 8 Start -->
	<div class="row py-3" id="full_step_8" style="display: none">
		<div class="col">
			<div class="card wider">
				<div class="card-body">
					<h4 class="text-center">Well done candidates, you’re at the final stage. To complete your application, all you need to do is 2 things:</h4>
					<p class="text-center">1. Upload your most current resume. Please feel free to remove your full name, address and contact details if you prefer to keep this confidential form prospective employers.</p>
					<p class="text-center">2. Record a short 30-60 second video of yourself, and upload it in the portal below. Be sure to say hi, tell us about what you’ve done in your career, any key skills/studies/attributes you have, and very briefly the kind of opportunities you’re interested in. You can be as casual as you like, this is more about employers getting an idea of your personality and culture fit. </p>
					<p class="h5 text-center">You can chose to save and exit here, and return to upload your resume and video when you’re ready. Please note your application will only become active and viewable to prospective employers, after your video and resume are uploaded.</p>
				</div>
			</div>
		</div>
	</div>
	<!-- Step 8 End -->
</div>

<!-- main -->
{{-- <div class="main  above">
    <input type="hidden" id="userType" name="userType" value="user" />
    <div class="content">
        <div class="mw50 dtable margin_auto" style="display: none">

            <div id="full_step_8" class="bl_card_Final full_step_8"  style="display:none;">
                <div class="ind_exp">
                    <div class="ind_exp_h">
                        <p>Well done candidates, you’re at the final stage. To complete your application, all you need to do is 2 things:</p>
                        <div class="step2_uplod_info">
                            <p>1. Upload your most current resume. Please feel free to remove your full name, address and contact details if you prefer to keep this confidential form prospective employers.</p>
                            
                            <p>2. Record a short 30-60 second video of yourself, and upload it in the portal below. Be sure to say hi, tell us about what you’ve done in your career, any key skills/studies/attributes you have, and very briefly the kind of opportunities you’re interested in. You can be as casual as you like, this is more about employers getting an idea of your personality and culture fit. </p>
                        </div>

                        <p class="info">You can chose to save and exit here, and return to upload your resume and video when you’re ready. Please note your application will only become active and viewable to prospective employers, after your video and resume are uploaded.</p>
                    </div>

                    <div class="userUpload">
                       <div class="userResumeCont">
                        <div class="userResume">
                         <div class="title_private_photos title_videos">Resume & Contact Details</div>
                            <form id="frm_upload" class=" submit-document" action="route('userUploadResume')" method="post" enctype="multipart/form-data">
                              {{csrf_field()}} <br>
                              <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx">
                              <button class="btn violet save-resume-btn valign-top" name="submit" style="padding: 5px;">Save</button>
                            </form>
                            <div class="private_attachments"></div>
                        </div>
                       </div>

                       <div class="userVideoCont">
                           <div class="userVideo">
                           <div class="title_private_photos title_videos">Upload Videos</div>
                           <div id="list_videos_public" class="list_videos_public">
                            <div id="photo_add_video" class="item add_photo add_video_public item_video">
                                <a class="add_photo" >
                                    <img id="video_upload_select" class="transparent is_video" src="{{asset('images/site/icons/add_video160x120.png')}}" style="opacity: 1;">
                                </a>
                            </div>
                           </div>
                            
                           <div class="list_videos"></div>
                           </div>
                       </div>
                    </div>

                    <div class="join_done"></div>

                    <div class="join_btn mt20 center">
                        <button id="user_step8_done" class="btn turquoise small btn_join_submit">Done</button>
                    </div>

                </div>
            </div>




        </div>
    </div>

 

 

</div> --}}
<!-- /main -->
@stop

@section('custom_footer_css')


<style>
/* .header, .main.above .wrapper {
    background: #5b0079;
} */
</style>
@stop

@section('custom_js')
{{-- <script type="text/javascript" src="{{ asset('js/mobile/mdb/addons-pro/steppers.min.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('js/mobile/mjoin.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/lib.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/modernizr.js') }}"></script>
<script type="text/javascript">
    $(function(){
								var currentStep = {{ !empty($user->step2)?($user->step2):'1'}};
        userStepReload(currentStep);
				}); 
// function someFunction22(){
// 	setTimeout(function(){
// 		$('#horizontal-stepper-fix').nextStep();
// 	}, 2000);
// }
</script>

@stop