{{-- @extends('adminlte::master') --}}
@extends('mobile.master')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Register</h1>
@stop


@section('custom_css')
				<link rel="stylesheet" href="{{ asset('css/site/card.css') }}">
				<link rel="stylesheet" href="{{ asset('css/mobile/mjoin.css') }}">

@stop

@section('classes_body', 'register step2')

@section('body')

<!-- Header Start -->
<div class="jumbotron text-white bg-dark text-center">
	<input type="hidden" name="userType" id="userType" value="employer" />
	<div class="container">
		<a href="./index"><img src="{{asset('/images/site/logo.png')}}" style="max-height:45px;  max-width:238px;" alt="" /></a>
	</div>
</div>
<!-- Header End -->

<!-- Main Start -->
<div class="container">
	<!-- Step 1 Start -->
	<div class="row">
		<div class="step col" id="join_step">
			<ul class="list-group">
				<li class="list-group-item active text-white"><span class="rounded p-4 bg-dark mr-2 d-inline-block h3">1</span> Answer 6 questions to calculate your best matches.</li>
				<li class="list-group-item d-none"><span class="rounded p-4 bg-dark mr-2 d-inline-block h3">2</span> </li>
				<li class="list-group-item d-none"><span class="rounded p-4 bg-dark mr-2 d-inline-block h3">3</span> Industry Experience</li>
			</ul>
		</div>
	</div>
	<!-- Show Error -->
	<div class="full_step_error"></div>
	<div class="row py-3 bl_card_question" id="full_step_1" style="display: none;">
		<div class="col">
			<div class="card_question_cont">
				<div id="card_question_no" class="card_question no hide answer">
					<div class="question_vh"><img src="../images/icon_card_answer_no.png" width="224" height="224" alt="" /><span>No</span></div>
				</div>
				<div id="card_question_yes" class="card_question yes hide answer">
					<div class="question_vh"><img src="../images/icon_card_answer_no.png" width="224" height="224" alt="" /><span>No</span></div>
				</div>

				<div data-field="graduate_intern" class="card_question card">
					<div class="count">6 of 6</div><div class="question_txt">Does you company hire Graduates or Intern?</div>
				</div>

				<div data-field="part_time" class="card_question card">
								<div class="count">5 of 6</div><div class="question_txt">Are you open to Part Time or Casual workers?</div>
				</div>

				<div data-field="temporary_contract" class="card_question card">
								<div class="count">4 of 6</div><div class="question_txt">Does you organisation offer temporary or contract type work?</div>
				</div>

				<div data-field="fulltime" class="card_question card">
								<div class="count">3 of 6</div><div class="question_txt">Are you looking for Full Time candidates?</div>
				</div>

				<div data-field="relocation" class="card_question card">
								<div class="count">2 of 6</div><div class="question_txt">Are you willing to repay relocation expenses for a strong candidate?</div>
				</div>

				<div data-field="resident" class="card_question first card">
								<div class="count">1 of 6</div><div class="question_txt">Does your organisation ever hire candidates who are not Permanent Resident or Citizen?</div>
				</div>

				<div class="card_decor_left1"></div>
				<div class="card_decor_left2"></div>
				<div class="card_decor_right1"></div>
			</div>
			<div class="card_question_btn">
				<button data-action="0" class="btn large pink fl_left btn_question step2Css">No</button>
				<button data-action="1" class="btn large turquoise fl_right btn_question step2Css">Yes</button>
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
						<div class="upload_file"><div class="upload"><div class="bl photo_add">Add Company Logo</div></div></div>
						<div class="name d-none"></div>
						<div class="name_info d-none text-danger">Required field!</div>
					</div>
					<div id="frm_card_join" class="card_profile_info card_join">

						<div class="bl bl_basic">
						<div class="title">About Our Organisation</div>
						<div id="about_me_error" class="error to_hide">Required field!</div>
						<textarea id="about_me" class="placeholder_always fl_basic" name="about_me" placeholder="Give us a brief overview of what your company does" maxlength="1000"></textarea>
						</div>

						<div class="bl bl_basic">
						<div class="title">Interested in</div>
						<div id="interested_in_error" class="error to_hide">Required field!</div>

						<textarea id="interested_in" class="placeholder_always fl_basic" name="interested_in" placeholder="Whom would you like to find?" maxlength="1000"></textarea>
						</div>

						<button id="step3_done" class="btn turquoise small btn_join_submit">Done</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Step 3 End -->

		<!-- Step 4 Start -->
		<div class="row py-3" id="full_step_4" style="display: none">
			<div class="col">
				<div class="card wider">
					<div class="card-body">
						<h4 class="card-title text-center">Please select from the industries and role types below, that best describe the type of candidates you’d like to match with. You can select up to 5 and change these at any time</h4>
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

			<div class="join_btn mt-3 text-center">
							<div class="join_industry_error"></div>
							<button id="join_done" class="btn turquoise small btn_join_submit industryExpBtn_done" disabled="true">Done</button>
			</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Step 4 End -->
</div>
<!-- Main End -->


@stop


@section('custom_js')

<script type="text/javascript" src="{{ asset('js/mobile/mjoin.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/lib.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/modernizr.js') }}"></script>
<script type="text/javascript">
    $(function(){
								var currentStep = {{ !empty($user->step2)?($user->step2):'1'}};
        employerStepReload(currentStep);
				});
</script>

@stop

@section('custom_footer_css')
@stop
