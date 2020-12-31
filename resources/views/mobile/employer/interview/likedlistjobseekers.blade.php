{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="card">
  <h6 class="card-header h6">Select Job Seekers to send them notifications</h6>
    <div class="card-body p-2 cardBody">
        {{-- @dump($title); --}}
        @php
        session()->put('bookingid',$interview->id);
        @endphp
        <a class="btn btn-sm btn-primary small turquoise" href="{{route('interviewconcierge.created')}}">Go Back</a>

        <div class="table-responsive">
          <table class="tableResponsive table table-bordered cbxDataTable " id="dataTable">
              <thead>
                  <tr style="text-align: center" >
                      <th scope="col"><input name="select_all" value="0" id="cbx" type="checkbox" /></th>
                      <th scope="col">Surname</th>
                      <th>city</th>
                      <th scope="col">email</th>
                      <th>phone</th>
                      <th>profile</th>    
                  </tr>
              </thead>
            </table>
        </div>
        <button class="btn btn-sm btn-primary colorSendButton sendNotification turquoise">Send notifications</button>
        <div class="form_field">
            <span class="form_label"></span>
            <div class="form_input">
                <div class="general_error error to_hide">&nbsp;</div>
            </div>
        </div>
        <div class="d-none">
            <form method="POST" class="notificationForm" action="{{route('bulk.BulkGenerateCVPDF')}}">
              @csrf
              <div class="cbx_list">
              </div>
              <input type="hidden" name="url" id="url" value="{{$interview->url}}">
              <input type="hidden" value="{{$interview->positionname}}" name="positionname" class="w20" required>
              <input type="hidden" value="{{$interview->employerData->name}}" name="employerName" class="w20" required>
            </form>
        </div>
    </div>
</div>
@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/magnific-popup.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}"> --}}

<style>
h6.card-header.h6{
  font-size: 15px !important;
}
[type="checkbox"]:not(:checked), [type="checkbox"]:checked {
    position: absolute;
    pointer-events: auto;
    opacity: 1;
}

@media only screen and (max-width: 500px) {
.tableResponsive{
    width: 495px !important;
    margin: 0 auto !important;

}
}

</style>
@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

{{-- <script src="{{ asset('js/site/profile_photo.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/jquery.magnific-popup.js') }}"></script>  --}}
{{-- <script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script> --}}

<script type="text/javascript">

 $( document ).ready(function() {
    var checked = false;

    $('#cbx-styler').on('click', function(event){

        if (checked) {
        $(':checkbox').each(function() {
                this.checked = false;
        });
        checked = false;
        } else {
            $(':checkbox').each(function() {
                this.checked = true;
            });
            checked = true;
        }
        return false;
    });

$(document).on('click','.sendNotification', function(){
var cbx = $('input[name="cbx[]"]:checked').map(function(){return $(this).val(); }).toArray();
if(cbx.length <= 0){
    alert('Please Select Checkboxes');
    return false;
}
var cbx_hidden =  '';
cbx.forEach(function(id){ cbx_hidden += '<input type="hidden" name="cbx[]" value="'+id+'" />'  });
$('.notificationForm .cbx_list').html(cbx_hidden);
// $('.BulkCompileCVForm').submit();


var formData = $('.notificationForm').serializeArray();

// $('.sendNotification').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
$('.general_error').html('');

$.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/booking/Msendnotification',
        data: formData,
        success: function(data){
            console.log(' data ', data);
            $('.sendNotification').html('Save').prop('disabled',false);
            if( data.status == 1 ){

                $('.general_error').html('<p>Notifications sent to job seekers</p>').removeClass('to_hide').addClass('to_show');
                setTimeout(() => { $('.general_error').removeClass('to_show').addClass('to_hide').text(''); },3000);
            }else{
                $('.general_error').html('<p>Error sending notifications.</p>').removeClass('to_hide').addClass('to_show');

                setTimeout(() => { $('.general_error').removeClass('to_show').addClass('to_hide').text(''); },3000);
            }

        }
    });

});

});

var table = jQuery('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: '{!! route('Minterviewconcierge.getlikedlistjobseekersdatatable') !!}',
          data: function (d) {
                d.status = $('.filter_status').val()
            }
        },

        columns: [
            // { data: 'select', name: 'select' },
            { data: 'like', name: 'id' },
            { data: 'surname', name: 'surname' },
            { data: 'city', name: 'city' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'profile', name: 'profile' },
        ],
     columnDefs: [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox" name="cbx[]" value="'+ $('<div/>').text(data).html() + '">';
         }
      }],
    });



jQuery(function(){
function rescaletable(){
var width = jQuery('.table-responsive').width();
var scale;
if (width < 620) 
{
scale = width / 620;
} else{
                            scale = 1.0;
                    }
jQuery('.tableResponsive').css('transform', 'scale(' + scale + ')');
jQuery('.tableResponsive').css('-webkit-transform', 'scale(' + scale + ')');
jQuery('.tableResponsive').css('transform-origin', '0 0');
jQuery('.tableResponsive').css('-webkit-transform-origin', '0 0');
}
rescaletable();
jQuery( window ).resize(function() { rescaletable(); });

});




</script>
@stop

