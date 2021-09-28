{{-- @extends('site.user.usertemplate') --}}
{{-- 
@if ($controlsession->count() > 0)
<div class="adminControl">
        <p>You are in control of <span class="bold">{{$user->name}} </span>, click <a href="{{ route('logoutRouteForAdmin') }}" class="adminLogin" > HERE </a> to end control</p>
</div>
@endif
 --}}
@extends('web.user.usermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop


{{-- <div class="newJobCont">
  <div class="head icon_head_browse_matches">Welcome to Interview Concierge</div>
 
  <div class="job_row interviewBookingsRow_{{$Int_booking->id}}">
    <div class="job_heading p10">
      <h3 class=" job_title"><a>{{$Int_booking->interview->positionname}}</a></h3>
    </div>

    <div class="job_info row p10 dblock">
      <div class="timeTable">
        <div class="j_label bold mb10">Your slot for interview is with below timetable</div>
        <div class="IndustrySelect">
          <p> From {{ Form::text('Start Time', $value = $Int_booking->slot->starttime, $attributes = array('class'=>'form-control bgColor', 'readonly'=>'true')) }}
            To {{ Form::text('Start Time', $value = $Int_booking->slot->endtime, $attributes = array('class'=>'form-control bgColor', 'readonly'=>'true')) }}
          </p>
          <p> Date: {{ Form::text('date',Carbon\Carbon::parse($Int_booking->slot->date)->format('Y-m-d'), $attributes = array('class'=>'form-control bgColor', 'readonly'=>'true')) }}
          </p>

           <div class="j_button pb20"><a class="jobApplyBtn graybtn jbtn deleteInterviewButton1" data-jobid="{{$Int_booking->id}}">Click here to cancel your interview</a></div>
          <div class="j_button pb20"><a class="jobDetailBtn graybtn jbtn" data-slotId = "{{$Int_booking->slot->id}}">Click here to reschedule you time slot</a></div>

        </div>

      </div>

      <div class="timeTable">
        <div class="title"><div class="w_25p"> <p class="IndustrySelect bold"> Booking Title </p> </div>
          <div class="width75p"><div class="IndustrySelect"> {{$Int_booking->interview->title}} </div> </div>
        </div>
        <div class="title">
          <div class="w_25p"> <p class="IndustrySelect bold"> Company</p> </div>
          <div class="width75p"><div class="IndustrySelect">{{$Int_booking->interview->companyname}}</div></div>
        </div>
        <div class="title"><div class="w_25p"> <p class="IndustrySelect bold"> Position </p></div>
          <div class="width75p"> <div class="IndustrySelect">{{$Int_booking->interview->positionname}}</div></div>
        </div>
        <div class="title"><div class="w_25p"><p class="IndustrySelect bold"> Insructions </p></div>
          <div class="width75p"><div class="IndustrySelect">{{$Int_booking->interview->instruction}}</div></div>
        </div>
      </div>
    </div>
  </div>
@endforeach  
@else
<h5> You have not booked any interview yet</h5>
@endif

<div class="cl"></div>
</div>
@include('site.user.interview.popup') --}}



{{-- html for interview concerge --}}
@section('content')
<section class="row">
                <div class="col-md-12">
                  <div class="profile profile-section">
                    <h2>Welcome To Interview Concierge</h2>
                     <div class="row">
                       @if ($Interviews_booking->count() > 0)
                       @foreach ($Interviews_booking   as $Int_booking)
                       <div class="col-sm-12 col-md-6">
                        <div class="job-box-info concigerge-box clearfix">
                          <div class="box-head">
                            <h4>{{$Int_booking->interview->positionname}}</h4>                          
                          </div>
                          <p class="slot-para">Your slot for interview is with below timetable.</p>
                             <ul class="job-box-text concigerge clearfix">
                                <li class="text-info-detail clearfix">
                                  <label>From:</label>
                                  <span>{{ Form::text('Start Time', $value = $Int_booking->slot->starttime, $attributes = array('class'=>'form-control bgColor', 'readonly'=>'true')) }}</span>
                                </li>
                                <li class="text-info-detail clearfix">
                                 <label>Booking Title:</label>
                                 <span> {{$Int_booking->interview->title}}</span>
                                </li>
                               <li class="text-info-detail clearfix">
                                 <label>To:</label>
                                 <span> {{ Form::text('Start Time', $value = $Int_booking->slot->endtime, $attributes = array('class'=>'form-control bgColor', 'readonly'=>'true')) }}</span>
                               </li>
                               <li class="text-info-detail clearfix">
                                 <label>Company:</label>
                                 <span>{{$Int_booking->interview->companyname}}</span>
                               </li>
                               <li class="text-info-detail clearfix">
                                <label>Date:</label>
                                <span> {{ Form::text('date',Carbon\Carbon::parse($Int_booking->slot->date)->format('Y-m-d'), $attributes = array('class'=>'form-control bgColor', 'readonly'=>'true')) }}</span>
                              </li>
                              <li class="text-info-detail clearfix">
                                <label>Position:</label>
                                <span>{{$Int_booking->interview->positionname}}</span>
                              </li>
                              <li class="text-info-detail clearfix">
                                <label>Insructions:</label>
                                <span>{{$Int_booking->interview->instruction}}</span>
                              </li>
                            </ul>
                            <button type="button" class="click-here-tag">Click here To Cancel Your Interview</button>
                       </div>
                     </div> 
                     @endforeach  
                        @else
                        <h6> You have not booked any interview yet</h6>
                        @endif
                  </div>
                </div>
              </section>
         @stop

@include('site.user.interview.popup')



{{-- html for interview invitations --}}

 

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

.timeTable{
  width: 33%;
  display: table-cell;
}
.width75p{
  width: 75%;
  display: inline-block;
}
.bgColor{
  background: #dddfe3;
}
</style>

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/login_form.js') }}"></script>

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

