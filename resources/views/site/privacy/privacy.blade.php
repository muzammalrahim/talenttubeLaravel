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
	<h1 class="text-center">Privacy Policy</h1>
	<p class=""><b>What is Talent Tube?</b></p>
	<p>
		Talent Tube is where social media meets an ATS (Applicant Tracking System), providing a 360 degree talent solution for both Employers and Job Seekers alike. The purpose of Talent Tube is to showcase your professional profile to the world, in hopes of catching the eye of a prospective Employer or Job Seeker, for your next role. We believe there is no substitute for exposure, so we want your profile to go viral, shared by our users, with their network and beyond.  
	</p>

	<p class=""><b>What’s in it for me? (Employer)</b></p>
	<p>
		As founder of Talenttube.org, I can confidently say there is more to a candidate than just a resume. The purpose of Talent Tube is to showcase our Job Seeker’s soft talents, particularly the desirable traits that can’t be seen in a resume. Talent Tube offers the best way for Employers to get meaningful summaries of their best matching candidates, with easy to search and sort functionality. An ATS is often short of all the tools Recruiters need to help find & vet suitable candidates, so Talent Tube offers all the bells and whistles of the latest recruitment technologies. This means you don’t have to rely on costly and poorly matching integration for video, testing, reference check or interview coordination, as we offer it all in 1 package.

	</p>

	<p class=""><b>What’s in it for me? (Job Seeker)</b></p>

	<p>
		Tired of spending hours every week applying for multiple jobs, answering the same boring application questions, uploading the same CV, and answering the same video interview questions for each and every company you are interested in? If so, Talent Tube offers you the opportunity to create 1 profile, where your experience, qualifications, personality and more is accessible by our Employers and beyond. Create a profile, put yourself out there, and let Employers do all the searching to find you. Even if you aren’t actively looking for a job, we recommend you keep your profile, as it doesn’t hurt to hear about potential opportunities from Employers who are interested in you.
	</p>

	<p class=""><b>What’s in it for us? (Talent Tube)</b></p>
	<p>
		We like money, but we’re not prepared to do anything dishonest or underhanded to make it. All our potential profits (if we ever make any) will come directly from Employers who opt for a paid subscription to search and access contact details of our Job Seekers, or Employers who wish to pay us an agency fee for hiring you. If you are a Job Seeker, we will never ask you for money. If anyone claiming to be from Talent Tube is asking you for money, please know this is a scam & refrain from sharing. I personally hate telemarketing calls, so we promise to never sell your raw data to any marketing companies. If we decide to change this in the future (unlikely), we will advise you in writing and allow you to opt out or delete your profile before we make that transition.

	</p>

	<p class=""><b>What about Privacy?</b></p>
	<p>
		Talent Tube is the name of our inhouse candidate database, designed to help connect our professionals with quality employers in our network. 
		Unlike many traditional recruitment agency databases, Talent Tube seeks to add a Social Media spin to the process, allowing for a 3-dimentional interactive platform to help show case our professionals. The purpose is to increase your prospects of making a memorable impression on a prospective employer, to help land your next dream job.  
		We can showcase both full profiles and limited profiles to our Employers, to help generate interest in your experience & suitability for potential roles


	</p>

	<p class=""><b> What information is available on my full profile  </b></p>

	<p>
		To create a profile on our Talent Tube system, we’ll use the information made available to us, such as your resume, information provided during our phone chat or virtual conference chat, as well data we can find on your LinkedIn & online foot print. We’ll also upload the video you submit, or audio recording that you consented to create with us. If you created the profile on your own, all the information you submitted will be available on your full profile. <br>

	</p>

	<p class=""><b> Who can access the link to my full profile?  </b></p>

	<p>
		Recruiters at Talent Tube, and recruiters from our affiliated networks (such as the Digital Professionals Hub) will have admin access to your full profile. We’ll use this information as a record for us regarding your skills/experience/qualifications and ideal roles, to help us show case and connect you with potential employment opportunities that may interest you.  <br>
		In the event an Employer takes an interest to your profile, we will contact you to gage your interest. If you’d like to be considered for the role, we will advise the Employer of your interest & send them a direct link with your full profile, as well as find out the next steps to formalize your application with the Employer.<br>


	</p>


	<p class=""><b> What information is available on my limited profile?  </b></p>

	<p>
		We remove your full name, profile photo, contact details and resume from the limited profile. The limited profile is how Employers can browse our database, without the supervision of a Recruiter from our network. If there is some interest in your limited profile from an Employer, we can then contact you to see if you consent to sharing the link to your full profile with that specific Employer. <br>


	</p>

	<p class=""><b>What measures are in place to stop my current Employer from finding my profile? </b></p>

	<p>
		While we can’t guarantee that this won’t happen, we have both technical and process controls in place to reduce the likelihood of this occurring.  
		On the technical side, when you or our consultant create your account, the system will pick up the organization entered on your profile. This means that any Employer account from that same organization will be unable to view your profile, regardless of their access level. <br>
		On the process side, we will not send a link to your full profile to any employer, until we have spoken to you about the opportunity and you consent. If you provide consent to share your full profile, the employer will have direct access to your resume, full name, video interview & contact details.


	</p>

	<p class=""><b> Who can I speak to if I have questions?  </b></p>

	<p>
		If you have any questions about your profile, wish to make changes to your profile or wish to delete your profile with us, please contact us at admin@talenttube.org 

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
