{{-- @extends('adminlte::master') --}}
@extends('site.master')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Register</h1>
@stop


@section('custom_css')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

@stop

@section('classes_body', 'register user')

@section('body')


<div class="container">
	<h1 class="text-center">Reference Terms & Condition</h1>
	<p class=""><b>What is the purpose of the Talenttube.org reference check?</b></p>
	<p>
		Many Employers opt to conduct reference checks for prospective candidates they are looking to hire. A positive reference check provides a great deal of confidence to employers, as well as potential coaching information to help get the best of their new employee. <br>

		For this reason, Talent Tube offers a proactive/online solution to have a transparent reference check for our Job Seekers, which can be used to help champion their applications, even before a potential job offer has been made. 

	</p>

	<p class=""><b>What’s in it for me?</b></p>
	<p>
		If you feel strongly about the Job Seeker who is requesting your formal reference, Talent Tube offers you an online platform to advocate and support their future employment. Ideally, you only need to complete the reference check once with Talent Tube, and it can be used for all prospective employers, saving you potential time if the Job Seeker has applied for multiple opportunities that require a reference check.

	</p>

	<p class=""><b>What if I don’t recommend the Job Seeker?</b></p>

	<p>
		In this instance, we recommend you be honest with the Job Seeker first, before completing the reference check at Talent Tube. <br>
		Sometimes a Job Seeker may not have been the best fit for a role, but offers much potential for other opportunities that better suit their skills or lifestyles. These situations often result in mixed feedback, but the Job Seeker may appreciate that as it reflects the kind of opportunities they may be interested in. 
	</p>

	<p class=""><b>How do I complete the reference check?</b></p>
	<p>
		If you agree to our terms and conditions, and are over 18, simply follow the email we sent you, and select ‘Let’s go’ in the blue, to complete the reference check. You will be directed to a new page where you will fill in your details, relationship with the job seeker, as well as provide written feedback on a number of fields that will be of relevance to perspective job seekers. 

	</p>

	<p class=""><b>What are the terms and conditions? How will my reference check be accessed? What about my privacy? </b></p>
	<p>
		You must be 18 or above in order to complete this reference check. <br><br>
		The information you provide as part of the reference check will be accessible on the Talent Tube platform at talenttue.org. This includes all the commentary you enter about the Job Seeker, as well as the verification contact details you submit as part of the check.<br><br> 

		All information you provide will be viewable online on the Job Seekers Talent Tube profile. Registered Employers on our network will have full access to the reference check you submit. The reference check will also have a unique URL generated that can be shared by employers and our administrators with our relevant networks. <br><br>

		If you are not comfortable having your reference check or the details you submit being accessed publicly online, please decline the invitation and avoid completing the reference check. By completing the reference check, you agree to not hold us responsible for any potential damages that may result from your reference check.<br><br>
		


	</p>

	<p class=""><b>What if I initially agree to complete the reference check, but later change my mind?</b></p>

	<p>
		Please contact us to organise to have your reference check manually deleted. 

	</p>


</div>


@stop


@section('custom_js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@stop

@section('custom_footer_css')
<style>
	body{overflow: scroll;}
	p {text-align: justify;}
</style>
@stop
