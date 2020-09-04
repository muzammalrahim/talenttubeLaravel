@extends('mobile.master')

@section('title', $title)

@section('custom_css')
    {{-- <link rel="stylesheet" href="{{ asset('css/site/register.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site/jquery.formstyler.css')}}"/> --}}

@stop

@section('classes_body', 'register user')

@section('body')


<!-- main -->
<div class="main">
	<div class="homeBg">
		<div class="shadeBg">
			<div class="wrapper">
				@include('mobile.header.header1')
			</div>
			@include('mobile.register.employer_step1')
		</div>
		@include('mobile.home.loginPopup')
	</div>
	@include('mobile.footer')
</div>
<!-- /main -->
@stop


@section('custom_js')
<script type="text/javascript" src="{{ asset('js/mobile/mjoin.js') }}"></script>
{{-- <script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script> --}}
@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/mobile/homepage.css') }}">
@stop
