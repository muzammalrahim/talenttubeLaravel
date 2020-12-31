@extends('adminlte::page')

@section('title',$title)

@section('content_header')
@stop

@section('content')

<div class="container">
    @include('admin.errors',[ 'error' => $errors, ])
    @if ($record)
        {!! Form::model($record, array('url' => route('interview.update',['id' => $record->id]), 'method'=>'PATCH', 'files' => true, 'name'=>'formInterview', 'novalidate'=>'')) !!}
    @else
        {!! Form::open(array('url' => route('interview.store'), 'method' => 'POST', 'files' => true, 'name'=>'formJob', 'novalidate'=>'')) !!}
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5"><h4 class="card-title mb-0">{{ __('Interview Management') }} <small class="text-muted">Edit Interview</small></h4></div>
            </div>
            <hr>
            <div class="row mt-4 mb-4">
                <div class="col">

                    {{-- Adding Tab Start --}}

          <div class="col-12 col-sm-6 col-lg-12">
            <div class="card card-primary card-tabs">

              <div class="card-header p-0 pt-1 tabColor"style="background: #6c757d;">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                  <li class="nav-item col-lg-6">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true"><b>Interview</b></a>
                  </li>

                  <li class="nav-item col-lg-6">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><b>Slots</b></a>
                  </li>

              {{--     <li class="nav-item col-lg-3">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false"><b>Questions</b></a>
                  </li>

                  <li class="nav-item col-lg-3">
                    <a class="nav-link" id="custom-tabs-one-private-tab" data-toggle="pill" href="#custom-tabs-one-private" role="tab" aria-controls="custom-tabs-one-private" aria-selected="false"><b>Private Gallery</b></a>
                  </li> --}}

                </ul>
              </div>

              <div class="card-body">

                <div class="tab-content" id="custom-tabs-one-tabContent">

                  @include('admin.interviewConcierge.createTabs.tab1')   {{-- admin/interviewConcierge/tabs/tab1 --}}
                  @include('admin.interviewConcierge.createTabs.tab2')   {{-- admin/interviewConcierge/tabs/tab2 --}}

                </div> <!-- tab-content end -->
              </div>

              <!-- /.card -->
            </div>
          </div>
                    {{-- Adding Tab End --}}

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col"><a class="btn btn-danger btn-sm" href=" {!! route('users') !!}">Cancel</a></div>
                <div class="col text-right"><button class="btn btn-success btn-sm pull-right" type="submit">Update</button></div>
            </div>
        </div><!--card-footer-->

    </div><!--card-->

    {!! Form::close() !!}

</div>

@include('admin.interviewConcierge.modals.deleteSlotModal')
@stop

@section('css')
    <link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@stop

@section('js')
    <script src="{{ asset('js/admin_custom.js') }}"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=places&key={{env('GOOGLE_API')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    {{-- <script type="text/javascript" src="http://creativedev22.xyz/js/site/jquery.formstyler.js"></script> --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript"> var base_url = '{!! url('/') !!}';</script>
    <script type="text/javascript">
    $(document).ready(function(){

    // ============================= Next and Previous tab button start =============================
     $('#custom-tabs-one-home .btnNext').on('click', function (e) {
      e.preventDefault()
      $('#custom-tabs-one-profile-tab').tab('show')
    });

     $('#custom-tabs-one-profile .btnPrevious').on('click', function (e) {
      e.preventDefault()
      $('#custom-tabs-one-home-tab').tab('show')
    });
    // ============================= Next and Previous tab button start =============================
jQuery('.datepicker').datepicker({
      // minDate: +1, // this will disable today date and previous date
      minDate: 0, 
      dateFormat: 'yy-mm-dd',  
     
});
 

// For Scrolling to top end
});

  function scrollToTop() {
          window.scrollTo(0, 0);
      }

// =============================== Interview Concierge ============================ 

var i = 2;
$(".addSlot").bind('click', function(){
 
   

    var timeValue = $('.checkstatus').val();
    var timeEndValue = $('.checkstatus1').val();
    var timeDateValue = $('.checkstatusDate').val();
    var checkstatusjq = $('.checkstatusjq').last().val();

    // console.log("This is the vlaue" , timeValue);
    // console.log("This is the vlaue" , timeEndValue);
    // console.log("This is the vlaue" , timeDateValue);
    // console.log("This is the vlaue" , checkstatusjq);

    var array = [timeValue,timeEndValue,timeDateValue];
    // const obj = Object.assign({}, array);
    console.log(array);

if($.inArray(checkstatusjq, array)){
    if(($('.ui-timepicker-viewport li a').text()) == timeValue ){
        $(this).css('display', 'block');
  
    }
}
    // if(timeValue != "" && timeEndValue != "" && timeDateValue != "")
    // {

    if(i <= 20){
        i=i;
            var slot  = '<div class="slot s'+i+' notbrak  leftMargin topMargin padding slotBorder">';
                slot  += '<div class="mb10 dynamicTextStyle">Interview Slot '+i+' ';
                slot  += '<i id = "deleteSlot" class="fas fa-trash deleteSlot'+i+' fl_right">';
                slot  += '</i>';                                  
                slot  += '</div>';                                                                                                      
                slot  += '<div class="time">';
                slot  += '<div class="notbrak dynamicTextStyle">Time</div>';
                slot  += '<div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center checkstatusjq" autocomplete="off" name="slot['+i+'][start]" size="8" required /></div>';
                slot  += '<div class="notbrak dynamicTextStyle">To</div>';
                slot  += '<div class="notbrak"><input type="text" class="timepicker timepicker-without-dropdown text-center" autocomplete="off" name="slot['+i+'][end]" size="8" required /></div>';
                slot  += '</div>';
                slot  += '<div class="date topMargin">';
                slot  += '<span class="notbrak dynamicTextStyle">Date</span>';
                slot  += '<input type="text" name="date['+i+']" class="datepicker notbrak" autocomplete="off" size="8" required />';
                slot  += '</div>';
                slot  += '<div class="m_no_i">';
                    slot  += '<label class="w50 notbrak my10" style="margin-left: 5px;">Maximum number of interviewees:</label>';
                    slot  += ' <div class="form_input form_input_C2">';
                        slot  += ' <select name="maximumnumber['+i+']" class="form_select" >';
                            slot  += '                      <option value="1">1</option>';
                            slot  += '                       <option value="2">2</option>';
                            slot  += '                       <option value="3">3</option>';
                            slot  += '                       <option value="4">4</option>';
                            slot  += '             <option value="5">5</option>';
                            slot  += '           <option value="6">6</option>';
                            slot  += '              <option value="7">7</option>';
                            slot  += '              <option value="8">8</option>';
                            slot  += '               <option value="9">9</option>';
                            slot  += '              <option value="10">10</option>';
                            slot  += '              <option value="11">11</option>';
                            slot  += '             <option value="12">12</option>';
                            slot  += '             <option value="13">13</option>';
                            slot  += '             <option value="14">14</option>';
                            slot  += '            <option value="15">15</option>';
                            slot  += '            <option value="16">16</option>';
                            slot  += '           <option value="17">17</option>';
                            slot  += '           <option value="18">18</option>';
                            slot  += '           <option value="19">19</option>';
                            slot  += '           <option value="20">20</option>';
                            slot  += '       </select>';
                            slot  += '       </div>';
                            slot  += '   </div>';
                            slot  += '  </div>';
                slot  += '</div>';
                slot  += '<div class="checkStatusError hide_it2"> <span>Fill all fields before proceeding to next slot</span> </div>';
                                                                     i++;
        $('.slots').append(slot);
        $(".datepicker").datepicker({ dateFormat: "yy-mm-dd" });
        $('input.timepicker').timepicker({});
        $('#slotsCounter').val(this.value);
        $('input, select').styler();


    }

    else  {
        return false;
    }

// }

// else{

//     timeValue = '';
//     $( ".checkStatusError" ).show().delay(4000).fadeOut('slow');
//     console.log(timeValue);
// }

$('i').click(function(){
    $(this).closest('.slot').remove();
});


});

// ============================================= Add new buttton end here =============================================



// ============================================= Deleting Slot FUnction =============================================

 $('.deleteSlot').click(function(){


    $(this).closest('.slot').remove();

//    // var parentSlot =  $('.slot').parent();
//    // var childSlot = parentSlot.children();
//    // $(childSlot).remove();
//    // var childSlot =  parentSlot.children();
//    // $(this).remove(childSlot);
//    // console.log(childSlot);
});


// ============================================= Delete Slot JS end here =============================================



// ================================= Delete Slot Popup Open onClick =================================

    $('.deleteSlotClck').click(function(){
        console.log(' open ');
        // $deleteSlot.open();
        var deleteSlot2 = $(this).closest('.slot').find('.SlotIDInputHidden').val();
        var companyName = $(this).closest('.slot').find('.companynameInSlot').val();
        var useremail = $(this).closest('.slot').find('.useremails').val();
        var psnameinSlot = $(this).closest('.slot').find('.positionnameInSlot').val();
        console.log(psnameinSlot);
        var slotIDPopup = $('.slotIDPopUp').val(deleteSlot2);
        var comnamePopUp = $('.comnameInPopUp').val(companyName);
        var uEmail = $('.useremailInPopup').val(useremail);
        var psname = $('.posNamePopup').val(psnameinSlot);
        console.log(uEmail);return;
        return false;
    });

    $('#deleteSlot_confirm').click(function(){

        var slotID = $('.slotIDPopUp').val();
        var companyName = $('.comnameInPopUp').val();
        var usEmail = $('.useremailInPopup').val();
        var positionamae = $('.posNamePopup').val();
        var url = base_url+'/ajax/booking/adminDeleteSlot';
        // console.log(url);
        // console.log(companyName);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
            type: 'POST',
            url: "{{ route('adminDeleteSlot') }}",
            data:{id: slotID,company:companyName,useremail:usEmail,position:positionamae},
            success: function(data){
                console.log(' data ', data);

                if( data.status == 1 ){

                // $('#deleteSlotModal').close();

                    location.reload();

                }else{
                   
                }

            }
        });

    });

// ================================= Delete Slot Pop up close onClick =================================

    $('.close_hover').click(function() {
        $('#deleteSlotModal').close();

    });

// ================================= Delete Slot Popup Open onClick =================================


// =============================== Interview Concierge End here ========================
</script>
{{-- country state city--}}

    <!-- added by Hassan -->
    <script type="text/javascript"> var base_url = '{!! url('/') !!}';</script>
@stop

@section('plugins.Datatables')

@stop

@section('custom_css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<style type="">
select{
    display: block;
    width: 100%;
    height: calc(2.25rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    box-shadow: inset 0 0 0 transparent;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.questionbox {
    background: rgba(0, 0, 0, 0.08);
    margin: 10px 0px;
    padding: 10px;
}
.option_goldstar, .option_preffer { display: inline-block; }

</style>





