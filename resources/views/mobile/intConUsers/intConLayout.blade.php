    
@extends('mobile.intConUsers.intConMaster')

@section('content')


<div class="card font-14">

    <h6 class="card-header h6">Interview Concierge Bookings</h6>

     <div class="row ml-2">
        <div class="successMsgDeleteBooking alert alert-success d-none" role="alert">
            Your interview booking has been cancelled successfully.
        </div>
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


    <div class="card-body p-0 cardBody">
        <div class="row">
            <div class="col-sm-2">  </div>
        </div>

        {{-- @dump( $data['Interviews_booking']); --}}

        <div class="interviewBookings">
            @foreach ($data['Interviews_booking'] as $int_booking )
                <div class="interviewBooking p-2 mb-2">
                    {{-- @dump($int_booking->slot->starttime); --}}
                   
                    <div class="row">
                        <div class="col-12">
                             <p class="p-0 m-0"> You have applied for the position of : <b>{{$int_booking->interview->positionname}}</b></p>
                        </div>
                    </div>
                    
                    <div class="row">
                        {{ Form::label('Booking Title', null, ['class' => 'col-4 form-control-label']) }}
                        <div class="col-8">
                          <p>{{$int_booking->interview->title}}</p>
                        </div>
                    </div>

                    <div class="row">
                         {{ Form::label('Company', null, ['class' => 'col-4 form-control-label']) }}
                        <div class="col-8">
                          <p>{{$int_booking->interview->companyname}}</p>
                        </div>

                    </div>
                    <div class="row">
                         {{ Form::label('Position', null, ['class' => 'col-4 form-control-label']) }}
                        <div class="col-8">
                          <p>{{$int_booking->interview->positionname}}</p>
                        </div>
                    </div>
                    <div class="row">
                        {{ Form::label('Instructions', null, ['class' => 'col-4 form-control-label']) }}
                        <div class="col-8">
                          <p>{{$int_booking->interview->instruction}}</p>
                        </div>
                    </div>

                    <div class="slot1 row"> 
                        <div class="col-12 font-weight-bold"> <p> Your slot for interview is with below timetable </p> </div>
                       
                    </div>
                    <div class="form-group row">
                        {{ Form::label('From', null, ['class' => 'col-4 form-control-label']) }}
                        <div class="col-8">
                          {{ Form::text('Start Time', $value = $int_booking->slot->starttime, $attributes = array('class'=>'form-control', 'readonly'=>'true')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                         {{ Form::label('To', null, ['class' => 'col-4 form-control-label']) }}
                        <div class="col-8">
                          {{ Form::text('End TIme', $int_booking->slot->endtime, $attributes = array('class'=>'form-control', 'readonly'=>'true')) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('Date', null, ['class' => 'col-4 form-control-label']) }}
                        <div class="col-8">
                        {{ Form::text('date',Carbon\Carbon::parse($int_booking->slot->date)->format('Y-m-d'), $attributes = array('class'=>'form-control', 'readonly'=>'true')) }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-10"><a class="deleteInterview btn btn-danger" data-toggle="modal" data-target="#bookingDeletingModal"> Click here to cancel your interview</a>
                        </div>
                        {{-- <div class="col-2">
                            <div class="deletingSpinner spinner-border text-primary d-none" role="status">
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div class="row ml-2">
                        <div class="successMsgDeleteBooking alert alert-success d-none" role="alert">
                          Your interview booking has been cancelled successfully.
                        </div>
                    </div> --}}  
                    <div class="row">
                        <div class="col-12">
                          <a class="emailSendButton btn btn-primary" data-toggle="modal" data-target="#emailSendingModal"> Click here to send an email to the interviewer with your preferred time</a>
                        </div>
                    </div>
                    {{-- <div class="row ml-2">
                        <div class="successMsgUpdatingBooking alert alert-success d-none" role="alert">
                          Your interview booking has been cancelled successfully.
                        </div>
                    </div> --}} 

                    <input type="hidden" class="intBookingHidden" name="" value="{{$int_booking->id}}">
                    <input type="hidden" name="interviewid" class="interviewIDHidden" value="{{$int_booking->interview->id}}">

                </div>
            @endforeach
        </div>

        <div class="goHome text-center pb-3"> 
            <a href="{{route('homepage')}}"> Click here to go home page</a>
        </div>
    </div>
</div>

{{-- =================================================== Booking deleting Modal ===================================================--}}

<!-- Modal -->
<div class="modal fade" id="bookingDeletingModal" tabindex="-1" role="dialog" aria-labelledby="sendemail1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteBooking1">Cancel Interview Booking</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <input type="hidden" name="" class="bookingIdINModal">
        <input type="hidden" name="" class="intBookingInModal">
        <p>Are you sure you wish to continue ?</p>
        <h1><i class="far fa-question-circle"></i></h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
        <button type="button" class="confirmDeleteBooking btn btn-sm btn-primary" data-dismiss="modal">Yes</button>
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
        <input type="hidden" name="" class="bookingIdINModal">
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
        $('#overlay').removeClass('d-none');
        var intConConfID = $('.intBookingInModal').val();
        $('.deletingSpinner').removeClass('d-none');
            $.ajaxSetup({
            headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });

        $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/booking/MdeleteBooking',
        data:{id: intConConfID},
        success: function(data){
            console.log(' data ', data);
            // $('.sendNotification').html('Save').prop('disabled',false);
            if( data.status == 1 ){
                $('.deletingSpinner').addClass('d-none');
                $('#overlay').addClass('d-none');

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

    // ============================================== Sending email to employer ==============================================

    $('.emailSendButton').click(function(){
        console.log('Email Send Button');

        var bookingID = $(this).parents('.interviewBooking').find('.intBookingHidden').val();
        var bookingIDinModal = $('.bookingIdINModal').val(bookingID);
        // console.log(bookingIDinModal);
        var interviewID = $(this).parents('.interviewBooking').find('.interviewIDHidden').val();

        console.log(' bookingID ' + bookingID + '  interviewID = '+interviewID  );
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/booking/MsendEmailEmployer',
            data:{bookingID: bookingID, interviewID: interviewID},
            success: function(data){
                // console.log(' data ', data);
                $('.ajaxDataOfSlots').html(data);
        
            }
        });
    });


// ============================================== Sending email to employer end here ==============================================




});

</script>
@stop

@section('custom_css')

<style type="text/css">

.interviewBooking:nth-child(even) { background-color:#d7dedff0;}

.modal-header{
    background: #254c8e;
    color: white;
}
.slotData:nth-child(odd) { background-color:#e0e0e0}

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


.overlayLoader{
    position: absolute;
    top: 50%;
    left: 50%;
}

</style>

@stop