
@extends('mobile.user.usermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="card mb-3 shadow mb-3 bg-white rounded job_row jobApp_">
  <div class="card-header jobAppHeader p-2 jobInfoFont text-center">
    <h5>Send url to job seeker</h5>
  </div>

  <div class="card-body">
    <div class="heading icon_head_browse_matches mb-2">Click on the link to copy it to your clipboard</div>
    <div class="text-underline">
    <a  class="w60 copy_text" href="{{route('userinterviewconcierge.url', ['url' => $interview->url])}}">{{route('userinterviewconcierge.url', ['url' => $interview->url])}}</a>
    {{-- <a  class="button w50" href="{{$interview->url}}">{{$interview->url}}</a> --}}
    </div>

    <a href="{{ url()->previous() }}" class="btn btn-default backToCreated">Back</a>
    
</div>




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

.backToCreated {
    background: blue;
    color: white;
    width: fit-content;
    padding: 5px 20px 5px 20px;
    border-radius: 3px;
    font-size: 16px;
    opacity: 0.7;
}
.backToCreated:hover{
  opacity: 1.0;
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

