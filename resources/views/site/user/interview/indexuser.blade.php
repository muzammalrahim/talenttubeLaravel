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
         <div class="col-sm-12 col-md-6 intBooking_{{ $Int_booking->id }}">
          <div class="job-box-info concigerge-box clearfix">
            <div class="box-head">
              <h4>{{$Int_booking->interview->positionname}}</h4>                          
            </div>
            <p class="slot-para">Your booking confirmation details are below</p>
               <ul class="job-box-text concigerge clearfix">
                  <div class="text-info-detail clearfix row">
                    <div class="col-12 col-sm-4">   
                      <div class="row"> 
                        <span class="col-4 py-2 font-weight-bold text-dark">From:</span>
                        <span class="col-8 py-2"> {{$Int_booking->slot->starttime}}</span>
                        <span class="col-4 py-2 font-weight-bold text-dark">To:</span>
                        <span class="col-8 py-2"> {{$Int_booking->slot->endtime}} </span>
                        <span class="col-4 py-2 font-weight-bold text-dark">Date:</span>
                        <span class="col-8 py-2"> {{ Carbon\Carbon::parse($Int_booking->slot->date)->format('d-m-Y') }} </span>
                      </div>
                    </div>
                    {{-- <span>{{ Form::text('Start Time', $value = $Int_booking->slot->starttime, $attributes = array('class'=>'form-control bgColor', 'readonly'=>'true')) }}
                    </span> --}}
                    <div class="col-12 col-sm-8">   
                      <div class="row"> 
                        <span class="col-4 py-2 font-weight-bold text-dark">Booking:</span>
                        <span class="col-8 py-2"> {{$Int_booking->interview->title}}</span>
                        <span class="col-4 py-2 font-weight-bold text-dark">Company:</span>
                        <span class="col-8 py-2">{{$Int_booking->interview->companyname}}</span>
                        <span class="col-4 py-2 font-weight-bold text-dark">Position:</span>
                        <span class="col-8 py-2">{{$Int_booking->interview->positionname}}</span>
                      </div>
                    </div>
                  </div>
                 <div class="text-info-detail clearfix row">
                  <div class="col-4">
                    <div class="row"> 
                      
                    </div>
                  </div>
                   {{-- <span> {{ Form::text('Start Time', $value = $Int_booking->slot->endtime, $attributes = array('class'=>'form-control bgColor', 'readonly'=>'true')) }}
                   </span> --}}
                  
                  <div class="col-8">
                    <div class="row"> 
                      
                    </div>
                  </div>
                 </div>
                 <div class="text-info-detail clearfix row">
                  <div class="col-4">
                    <div class="row"> 
                      
                    </div>
                  </div>

                  {{-- <span> {{ Form::text('date',Carbon\Carbon::parse($Int_booking->slot->date)->format('Y-m-d'), $attributes = array('class'=>'form-control bgColor', 'readonly'=>'true')) }}
                  </span> --}}
                  <div class="col-8">
                    <div class="row"> 
                      
                    </div>
                  </div>
                </div>
                <div class="text-info-detail clearfix row">
                  {{-- <div class="row">  --}}
                    <span class="col-lg-2 col-4 font-weight-bold text-dark">Instructions:</span>
                    <p class="col-lg-8 col-8 font-14 pl-lg-4">{{$Int_booking->interview->instruction}}</p>
                  {{-- </div> --}}
                </div>
              </ul>
              <button type="button" onclick="interviewConciergeDelete('{{ $Int_booking->id }}')" class="ml-3 orange_btn" data-toggle="modal" data-target="#interviewConciergeModal">Click here To Cancel Your Interview</button>
         </div>
       </div> 
       @endforeach  
          @else
          <h6> You have not booked any interview yet</h6>
          @endif
    </div>
  </div>
</section>


<div class="modal fade px-3 px-md-0" id="interviewConciergeModal" role="dialog">
    <div class="modal-dialog delete-applications">
        <!-- Modal content-->
        <div class="modal-content border-0">
            <div class="modal-header">
                <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
                <h1 class="modal-title"><i class="fa fa-trash trash-icon"></i>Cancel Interview Concierge</h1>
            </div>
            {{-- <div class="modalBody"> --}}
                <div class="modal-body">
                    <strong>Are you sure you wish to continue?</strong>
                </div>
                <input type="hidden" id="deleteConfirmInterviewConcierge" name="">

                <div class="dual-footer-btn mx-3 mx-md-0">
                    <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                    <button type="button" class="orange_btn float-none" onclick="confirmDeleteInterviewConcierge()" data-dismiss="modal" ><i class="fa fa-check"></i>OK</button>
                </div>
            {{-- </div> --}}

            {{-- <div class="modalFooter my-4 text-center">
                <div class="apiMessage"></div>
                <div class="spinner-grow text-primary deleteJobAppLoader d-none" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
            </div> --}}
        </div>
    </div>
</div>

@stop





{{-- @include('site.user.interview.popup') --}}



{{-- html for interview invitations --}}

 

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">

<style>
 @media only screen and (max-width: 479px) {
    .sidebaricontoggle{
        top: 4rem !important;
    }
}
@media only screen and (min-width: 480px) and (max-width: 991px){
   .sidebaricontoggle{
        top: 5rem !important;
    } 
}

</style>

@stop

@section('custom_js')

<script type="text/javascript" src="{{ asset('js/web/profile.js') }}"></script>

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

