
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class=" ">
  <div class="head icon_head_browse_matches">Send url to job seeker</div>

<div class="">
    <div class=""style="margin-top: 15px"> <h3> Click on the link to copy it to your clipboard </h3></div>
    <div class="link">
        <a  class="w60 copy_text button" href="{{route('userinterviewconcierge.url', ['url' => $interview->url])}}">{{route('userinterviewconcierge.url', ['url' => $interview->url])}}</a>
          {{-- <a  class="button w50" href="{{$interview->url}}">{{$interview->url}}</a> --}}
    </div>

</div>

    <a href="{{ url()->previous() }}" class="btn btn-default backToCreated">Back</a>
@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}"> --}}

<style>
.text-underline{
  text-decoration: underline;
}
.heading.icon_head_browse_matches {
    font-size: 14px;
}


.button {
  background-color: rgb(31, 120, 236);
  border-radius: 5px;
  color: white;
  padding: .5em;
  text-decoration: none;
  margin-top: 20px !important;
  margin-bottom: 20px !important;
  display:block
}

.button:focus,
.button:hover {
  background-color: rgb(52, 49, 238);
  color: White;
}
.link{
  margin-bottom: 20px;
}
</style>
@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}

<script type="text/javascript">

$('.copy_text').click(function (e) {
   e.preventDefault();
   var copyText = $(this).attr('href');

   document.addEventListener('copy', function(e) {
      e.clipboardData.setData('text/plain', copyText);
      e.preventDefault();
   }, true);

   document.execCommand('copy');
   console.log('Link Copied : ', copyText);
   alert('Link Copied: ' + copyText);
 });

</script>
@stop

