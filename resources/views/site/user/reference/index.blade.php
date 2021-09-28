{{-- @extends('site.user.usertemplate') --}}
{{-- 
@if ($controlsession->count() > 0)
<div class="adminControl">
        <p>You are in control of <span class="bold">{{$user->name}} </span>, click <a href="{{ route('logoutRouteForAdmin') }}" class="adminLogin" > HERE </a> to end control</p>
</div>
@endif --}}

@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<section class="row">
  <div class="col-md-12">
    <div class="profile profile-section cross-ref">
      <h2>Cross References</h2>
                        <div class="row">
        {{-- @dump($interview); --}}
          @if ($crossreference->count() > 0)
          @foreach ($crossreference as $reference)
           <div class="col-sm-12 col-md-6">
              <div class="job-box-info interview-box clearfix">
                     <div class="box-head">
                          <h4><span class="bold">Reference </span> <span> ({{ $loop->index+1 }})</span></h4>
                           </div>
                             <ul class="job-box-text clearfix">
                                <li class="text-info-detail clearfix">
                                  <label>Refered By:</label>
                                  <span><span> {{ $reference->refName }} </span></span>
                                 </li>
                                   <li class="text-info-detail clearfix">
                                   <label>Type:</label>
                                   <span><span> {{ $reference->refType }} </span></span>
                                                      </li>
                                  @if ($reference->refStatus == "Reference Fraud")
                                    <p> <span class="bold">Status: </span> <span> Awaiting Response</span></p>
                                  @else
                                        <li class="text-info-detail clearfix">
                                              <label>Status:</label> <span> {{ $reference->refStatus }} </span>
                                       </li>
                                  @endif
                               
                                  <li class="text-info-detail clearfix">
                                  <label>Phone:</label>
                                  <span><span> {{ $reference->refPhone }} </span></span>
                                  </li>

                                   <li class="text-info-detail clearfix">
                                  <label>Email:</label>
                                  <span> <span> {{ $reference->refEmail }} </span></span>
                                   </li>
              {{-- @dump($reference) --}}
                               </ul>
                         </div>
            {{-- expr --}}
                      @endforeach
                       @else
                        <div class="add_new_job">
                          <div class="job_row_heading jobs_filter"></div>
                          <h3>You have not added any reference yet</h3>
                      </div>
                      @endif
      
                  </div>
              </div>
           </div>
      </section>


@stop
@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}"> --}}
<style>

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


</style>

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}

<script type="text/javascript">

$('.loginEditInterview').on('click',function() {

event.preventDefault();
var formData = $('.login_booking_form').serializeArray();
$('.loginEditInterview').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
console.log(' formData ', formData);
$('.general_error').html('');
$.ajax({
    type: 'POST',
    url: base_url+'/ajax/userbooking/login',
    data: formData,
    success: function(data){

        $('.loginEditInterview').html('Save').prop('disabled',false);
        if( data.status == 1 ){
            window.location.replace(data.route);
        }else{

            if(data.validator != undefined){
                const keys = Object.keys(data.validator);
                for (const key of keys) {
                    if($('#'+key+'_error').length > 0){
                        $('#'+key+'_error').removeClass('to_hide').addClass('to_show').text(data.validator[key][0]);
                    }
                }

                setTimeout(() => {
                    for (const key of keys) {
                        if($('#'+key+'_error').length > 0){
                            $('#'+key+'_error').removeClass('to_show').addClass('to_hide');
                        }
                    }
                }
                    ,3000);
            }
           if(data.error != undefined){
             //$('.general_error').html('<p>Error Creating new Booking</p>').removeClass('to_hide').addClass('to_show');
             $('.general_error').append(data.error);
           }
           setTimeout(() => { $('.general_error').removeClass('to_show').addClass('to_hide').text(''); },3000);
        }

    }
});
});



</script>
@stop

