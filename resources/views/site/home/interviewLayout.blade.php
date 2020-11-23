    
@extends('site.employer.uniqueUrlUnregisteredUser')

@section('content')

<div class="container p-0">
	<div class="header_Con text-center">
		<h4 class="font-weight-bold text-white">Interview Concierge Bookings</h4>
	</div> 

	{{-- @dump( $data['Interviews_booking']); --}}
    
    <div class="successMsgDeleteBooking alert alert-success d-none" role="alert">
      Your interview booking has been cancelled successfully.
    </div>
    
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
                    <div class="col-md-1">
                        <div class="deletingSpinner spinner-border text-primary d-none" role="status">
                          {{-- <span class="sr-only">Loading...</span> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                      <a class="emailSendButton btn btn-primary" data-toggle="modal" data-target="#emailSendingModal"> Click here to send an email to the interviewer with your preferred time</a>
                    </div>
                </div>

                <input type="hidden" class="intBookingHidden" name="" value="{{$int_booking->id}}">
                <input type="hidden" class="intIDHidden" name="" value="{{$int_booking->interview->id}}">

            </div>

            {{-- <hr class="new1"> --}}


            
        @endforeach
    </div>



	<div class="goHome text-center pb-3"> 
		<a href="{{route('homepage')}}"> Click here to go home page</a>
	</div>

{{-- =================================================== Booking deleting Modal ===================================================--}}

<!-- Modal -->
<div class="modal fade" id="bookingDeletingModal" tabindex="-1" role="dialog" aria-labelledby="sendemail1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 70%;">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteBooking1">Cancel Interview Booking</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <input type="hidden" name="" class="intBookingInModal">
        <p>Are you sure you wish to continue ?</p>
        <h1><i class="far fa-question-circle"></i></h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="confirmDeleteBooking btn btn-primary" data-dismiss="modal">Yes</button>
      </div>
    </div>
  </div>
</div>


{{-- =================================================== Booking deleting Modal End Here ===================================================--}}

{{-- =================================================== Sending email Modal ===================================================--}}

<!-- Modal -->

<div class="modal fade" id="emailSendingModal" tabindex="-1" role="dialog" aria-labelledby="sendemail" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sendemail">Send Your Preferred Slot</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        {{-- <input type="text" name="" class="intConInModal"> --}}
        <div class="ajaxDataOfSlots"></div>
      </div>
      <div class="modal-footer text-center d-block">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        {{-- <button type="button" class="confirmSendEmail btn btn-primary" data-dismiss="modal">Confirm</button> --}}

        <div class="pb-3"> 
            <a href="{{route('homepage')}}"> Click here to go home page</a>
        </div>

      </div>
    </div>
  </div>
</div>


{{-- =================================================== Sending email Modal End Here ===================================================--}}


</div>


@stop

@section('custom_js')

<script type="text/javascript">
    
$(document).ready(function(){

    $('.deleteInterview').click(function(){
        console.log('Deleting Interview Booking');
        var intBookingID = $(this).parents('.interviewBooking').find('.intBookingHidden').val();
        console.log(intBookingID);
        var intBookingInModal = $('.intBookingInModal').val(intBookingID);
        console.log(intBookingInModal);

    });
        $('.confirmDeleteBooking').click(function(){
            var intConConfID = $('.intBookingInModal').val();
            $('.deletingSpinner').removeClass('d-none');
            $.ajaxSetup({
            headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });

        $.ajax({
        type: 'POST',
        url: base_url+'/ajax/booking/deleteBooking',
        data:{id: intConConfID},
        success: function(data){
            console.log(' data ', data);
            // $('.sendNotification').html('Save').prop('disabled',false);
            if( data.status == 1 ){
                $('.deletingSpinner').addClass('d-none');
                $('.successMsgDeleteBooking').removeClass('d-none');
                setTimeout(function() {
                   $('.successMsgDeleteBooking') .addClass('d-none');
                   location.reload();
                }, 3000);

            }else{
               
            }

        }
    });
    
    });

        // Sending email to employer

    $('.emailSendButton').click(function(){
        console.log('Deleting Interview Booking');
        var intConID = $(this).parents('.interviewBooking').find('.intIDHidden').val();
        console.log(intConID);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/booking/sendEmailEmployer',
            data:{id: intConID},
            success: function(data){
                console.log(' data ', data);
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
    width: 50% !important;
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
</style>

@stop