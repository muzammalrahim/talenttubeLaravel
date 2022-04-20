{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')
@section('custom_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}"> --}}
@stop
@section('content')
<div class="row profile profile-section" style="height:auto !important">
   <div class="heading icon_head_browse_matches">
      <p class="bookingCreated ">Good news, your booking is now created, booking ID {{$interview->uniquedigits}}. You can now select Job Seekers from your liked list to invite them to book in for an interview slot with you. You can also manually enter your own Job Seeker details or send the link directly to anyone you'd like interview (including those that don’t have a Talent Tube profile).</p>
   </div>

   <div class="row">
      <hr class="new">
   </div>
   <div class="row">
      <a class="blue_btn mb-3 p-2 col-7" href="{{route('interviewconcierge.getlikedlistjobseekers')}}">Click here to invite job Seekers from your liked list</a>
      <a class="blue_btn mb-3 p-2 col-7"  href="{{route('interviewconcierge.manualjobseekers')}}">Click here to manually enter Job Seeker contact details</a>
      <a class="blue_btn mb-3 p-2 col-7"  href="{{route('interviewconcierge.url')}}">Click here to access the unique URL to send to Job Seekers</a>
      @php
      session()->put('bookingid',$interview->id);
      @endphp
      <a  class="blue_btn mb-3 p-2 col-7"  href="{{route('unidigitEditUrl')}}">Click here to edit Booking ID Number</a>
   </div>
</div>
@stop
@section('custom_footer_css')
{{-- <link rel="stylesheet" href="{{ asset('css/site/profile.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">


@stop
@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/jquery-ui.js') }}"></script> --}}
{{-- <script src="{{ asset('js/site/common.js') }}"></script> --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}
<script type="text/javascript"></script>
@stop