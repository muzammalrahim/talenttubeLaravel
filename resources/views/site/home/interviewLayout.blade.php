    
@extends('site.employer.uniqueUrlUnregisteredUser')

@section('content')

<div class="container p-0">
	<div class="header_Con text-center">
		<h4 class="font-weight-bold text-white">Interview Concierge Bookings</h4>
	</div>

  <div class="row ml-2">
    <div class="successMsgUpdatingBooking alert alert-success d-none" role="alert">
    Your interview booking has been rescheduled successfully. 
    </div>
  </div>

  <div class="row d-none" id="overlay">
    <div class="spinner-border text-primary overlayLoader" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

	<div class="row">
		<div class="col-md-2">  </div>
	</div>
	{{-- @dump($data['ab']); --}}
	
	<!-- ( $data ); -->

	{{-- @dump( $data['Interviews_booking']); --}}
    
    <div class="interviewBookings">
        @foreach ($data['Interviews_booking'] as $int_booking )
            <div class="interviewBooking p-4 mb-2">
                {{-- @dump($int_booking->slot->starttime); --}}

                <div class="row ">
                    <div class="col-md-6">
                         <p class="p-0 m-0"> You have applied for the position of : <b>{{$int_booking->interview->positionname}}</b></p>
                    </div>

                    {{ Form::label('Booking Title', null, ['class' => 'col-md-2 form-control-label']) }}
                    <div class="col-md-4">
                      <p>{{$int_booking->interview->title}}</p>
                    </div>

                </div>
                
                <div class="slot1 row"> 
                    <div class="col-md-6"> <p> Your slot for interview is with below timetable </p> </div>
                    {{ Form::label('Company', null, ['class' => 'col-md-2 form-control-label']) }}
                    <div class="col-md-4">
                      <p>{{$int_booking->interview->companyname}}</p>
                    </div>

                </div>
                    {{-- <button class="deleteSlotButton float-right "> Hi How are</button> --}}

                <div class="form-group row">
                    {{ Form::label('From', null, ['class' => 'col-md-1 form-control-label']) }}
                    <div class="col-md-2">
                      {{ Form::text('Start Time', $value = $int_booking->slot->starttime, $attributes = array('class'=>'form-control', 'readonly'=>'true')) }}
                    </div>

                    {{ Form::label('To', null, ['class' => 'col-md-1 form-control-label']) }}
                    <div class="col-md-2">
                      {{ Form::text('End TIme', $int_booking->slot->endtime, $attributes = array('class'=>'form-control', 'readonly'=>'true')) }}
                    </div>

                    {{ Form::label('Position', null, ['class' => 'col-md-2 form-control-label']) }}
                    <div class="col-md-4">
                      <p>{{$int_booking->interview->positionname}}</p>
                    </div>

                </div>

                <div class="form-group row">
                    {{ Form::label('Date', null, ['class' => 'col-md-1 form-control-label']) }}
                    <div class="col-md-5">
                    {{ Form::text('date',Carbon\Carbon::parse($int_booking->slot->date)->format('Y-m-d'), $attributes = array('class'=>'form-control', 'readonly'=>'true')) }}

                    </div>

                    {{ Form::label('Instructios', null, ['class' => 'col-md-2 form-control-label']) }}
                    <div class="col-md-4">
                      <p>{{$int_booking->interview->instruction}}</p>
                    </div>

                </div>

                <div class="row mb-2">
                    <div class="col-md-5"><a class="deleteInterview btn btn-danger" data-toggle="modal" data-target="#bookingDeletingModal"> Click here to cancel your interview</a>
                    </div>
                </div>
                 
                <div class="row">
                    <div class="col-md-5">
                      <a class="emailSendButton btn btn-primary" data-toggle="modal" data-target="#emailSendingModal"> Click here to reschedule you time slot</a>
                    </div>
                </div>

               {{--  <div class="row ml-2">
                  <div class="successMsgDeleteBooking alert alert-success d-none" role="alert">
                  Your interview booking has been cancelled successfully.
                  </div>
                </div> --}}

                <input type="hidden" class="intBookingHidden" name="" value="{{$int_booking->id}}">
                <input type="hidden" class="intConHidden" name="" value="{{$int_booking->interview->id}}">
                <input type="hidden" class="intSlotHidden" name="" value="{{$int_booking->slot->id}}">

            </div>
            
        @endforeach
    </div>



	<div class="goHome text-center pb-3"> 
		<a href="{{route('homepage')}}"> Click here to go home page</a>
	</div>

  {{-- =================================================== Booking deleting Modal ===================================================--}}

  @include('web.modals.bookingDeleting')

  {{-- =================================================== Sending email Modal ===================================================--}}

  @include('web.modals.rescedulingSlot')

  {{-- =================================================== Booking Deleted Success Modal ===================================================--}}

  @include('web.modals.bookingDeleted')

  {{-- =================================================== Booking Deleted Success Modal ===================================================--}}

  @include('web.modals.slotUpdated')

  {{-- =================================================== Booking Deleted Success Modal ===================================================--}}

  @include('web.modals.errorReschedulingSlot')



</div>


@stop

@section('custom_js')

<script type="text/javascript">
    
$(document).ready(function(){

  {{-- =================================================== Delete Interview Booking Start Here ===================================================--}}

    $('.deleteInterview').click(function(){
        console.log('Deleting Interview Booking');
        var intBookingID = $(this).parents('.interviewBooking').find('.intBookingHidden').val();
        console.log(intBookingID);
        var intBookingInModal = $('.intBookingInModal').val(intBookingID);
        console.log(intBookingInModal);

    });

    $('.confirmDeleteBooking').click(function(){
      var intConConfID = $('.intBookingInModal').val();
      console.log(intConConfID);
      $('#overlay').removeClass('d-none');
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

      $.ajax({
        type: 'POST',
        url: base_url+'/ajax/booking/deleteBooking',
        data:{id: intConConfID},
        success: function(data){
          console.log(' data ', data);
          if( data.status == 1 ){
            $('#overlay').addClass('d-none');
            $('#bookingDeletedModal').modal('show');

            $('.successMsgDeleteBooking').removeClass('d-none');
            // setTimeout(function() {
            //   $('.successMsgDeleteBooking') .addClass('d-none');
            //   location.reload();
            // }, 3000);
          }else{
            $('#overlay').addClass('d-none');

          }
        }
      });
    });

    $('.bookingDeletedClodeModal').click(function(){
      location.reload();
    });

    {{-- =================================================== Delete Interview Booking End Here ===================================================--}}


        // Sending email to employer

    $('.emailSendButton').click(function(){
        console.log('Email Send Booking');
        $('.preferredSlotLoader').removeClass('d-none');
        var intBookingID = $(this).parents('.interviewBooking').find('.intBookingHidden').val();
        var intConID = $(this).parents('.interviewBooking').find('.intConHidden').val();
        var bookingIDinModal = $('.bookingIdINModal').val(intBookingID);

        console.log(intBookingID);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/booking/sendEmailEmployer',
            data:{booking_id: intBookingID,intConID:intConID},
            success: function(data){
                // console.log(' data ', data);
                $('.preferredSlotLoader').addClass('d-none');
                $('.ajaxDataOfSlots').html(data);
        
            }
        });
    });

    // Sending email to employer
});


</script>
@stop

@section('custom_css')

<style type="text/css">
	
.col_center{
    /*width: 50% !important;*/
    padding-top: 0px;
}
.interviewBooking:nth-child(odd) { background-color:#d7dedff0;}
.header_Con{
    background: #254c8e;
    padding: 20px;
    height: 60px;
}
.modal-header{
    background: #254c8e;
    color: white;
}
#overlay{
  position: fixed;
  /*display: none;*/
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}


.overlayLoader{ position: absolute;top: 50%;left: 50%;}
</style>

@stop