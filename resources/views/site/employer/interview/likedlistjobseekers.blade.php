{{-- @extends('site.user.usertemplate') --}}
@extends('site.employer.employermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="">
    <div class="heading icon_head_browse_matches">Select Job Seekers to send them notifications</div>

    <hr class="new">
      {{-- @dump($title); --}}
    @php
    session()->put('bookingid',$interview->id);
    @endphp
    <a class="button w10 small turquoise" href="{{route('interviewconcierge.created')}}">Go Back</a>
    <table class="table table-bordered cbxDataTable" id="dataTable">
        <thead>
            <tr style="text-align: center" >
                <th><input name="select_all" value="0" id="cbx" type="checkbox" /></th>
                <th>Surname</th>
                <th>city</th>
                <th>email</th>
                <th>phone</th>
                <th>profile</th>
            </tr>
        </thead>
      </table>

      <butto class="button small colorSendButton sendNotification turquoise">Send notifications</butto>
</div>

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
    </form>
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

.d-none{
    display: none;
}

.notbrak{
    display: inline-block;
}

.leftMargin{
    margin-left: 10px;
}

.topMargin{
    margin-top: 10px;
}

.textCenter{
   margin-left: 40%;
   padding-bottom: 10px !important;
}

.dynamicTextStyle{
    margin-left: 5px;
    margin-right: 5px;
}

.heading{

    font-size: 1.4em !important;
    margin-bottom: 10px;
    line-height: 26pt;
}

hr.new{
    border-top: 1px dotted #8c8b8b;
	border-bottom: 1px dotted #fff;

}

.textCenterButton {

text-align: center;
}

.button {
  background: rgb(31, 120, 236);
  border-radius: 5px;
  color: white;
  padding: .5em 1.5em .5em 1.5em;
  text-decoration: none;
  margin-top: 20px !important;
  margin-bottom: 20px !important;
  display:block;
  width: fit-content;
  cursor: pointer;
}


.colorSendButton{
    background-color: rgb(102, 123, 150);
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

$('.sendNotification').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
$('.general_error').html('');

$.ajax({
        type: 'POST',
        url: base_url+'/ajax/booking/sendnotification',
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
          url: '{!! route('interviewconcierge.getlikedlistjobseekersdatatable') !!}',
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

</script>
@stop

