@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-2"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>

    {{-- testing --}}
    <div class="block row col-md-10 text-white">

      <div class="col-md-2">
        <select class="filter_status browser-default custom-select">
            <option value="">Select Status</option>
            <option value="verified" {!! ($filter_status == 'verified')?('selected'):'' !!}>Approved</option>
            <option value="pending" {!! ($filter_status == 'pending')?('selected'):'' !!}>Pending</option>
        </select>
      </div>
      
      <div class="col-md-2"><a class="btn btn-block btn-primary btnBulkApproved">Bulk Approved</a></div>
      <div class="col-md-2"><a class="btn btn-block btn-primary btnBulkPDFGenerate">Bulk Compile CV</a></div>
      <div class="col-md-2"><a class="btn btn-block btn-primary btnBulkCSVExport">Bulk Export CSV</a></div>
      <div class="col-md-2"><a href="{{route('bulkEmail.new')}}" class="btn btn-block btn-primary ">Bulk Email</a></div>
      {{-- <div class="col-md-2"><a class="btn btn-block btn-primary ">Bulk Apply To Job</a></div> --}}

    </div>
    {{-- testing --}}
    <div class="col-md-1">
     {{--    <div class="float-right">
            <a href="{!! route('users.create') !!}" class="btn btn-block btn-success">Add New</a>
        </div> --}}
    </div>

</div>


@stop


{{-- @include('admin.errors',[ 'error' => $errors, 'record' => $record ]) --}}

@section('content')

@include('admin.errors')
@include('admin.success')


<table class="table table-bordered" id="dataTable">
    <thead>
        <tr style = "text-align: center">
            {{-- <th>select</th> --}}
            <th><input name="select_all" value="1" id="cbx_all" type="checkbox" /></th>
            <th>name</th>
            <th>city</th>
            <th>email</th>
            <th>phone</th>
            <th>created_at</th>
            <th>profile</th>
            <th>View Video</th>
            <th>View Resume</th>
            <th>action</th>
            
        </tr>
    </thead>
  </table>

{{-- User Deleting Pop Up --}}

  <div id="deleteModaluser" class="modal fade" role="dialog">
    <div class="modal-dialog">
                 <!-- Modal content-->
        <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">

                <div class="modalContentUser">
                    <p>Do you want to Delete <b><span id="delConfirmIdUser"></span></b> User ?</p>
                    
                </div>

                <div class="modelProcessingUser" style="display: none;">
                        <h4>Deleting User...</h4>    
                 </div>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger" id="removeuser" style="margin: 0 auto">Yes</button>
              <input type="hidden" name="deleteConfirmUser" id="deleteConfirmUser" value="">
             </div>

        </div>
    </div>
</div>

{{-- User Deleting Pop Up End Here --}}

{{-- User Info Pop Up --}}
<div id="ModaluserInfo" class="modal fade ModaluserInfo" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
         <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <div class="modalContentUser text-center"><i class="fa fa-spinner fa-pulse" style="font-size: 35px;"></i></div>
            {{-- <div class="modelProcessingUser" style="display: none;">
                    <h4>Deleting User...</h4>    
            </div> --}}
         </div>
         <div class="modal-footer">
             {{-- <button type="button" class="btn btn-danger" id="removeuser" style="margin: 0 auto">Yes</button> --}}
          {{-- <input type="hidden" name="deleteConfirmUser" id="deleteConfirmUser" value=""> --}}
         </div>
    </div>
  </div>
</div>
{{-- User Info Pop Up End Here --}}


{{-- Bulk Approved Pop Up --}}
<div id="ModalBulkApprovedInfo" class="modal fade ModalBulkApprovedInfo" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
         {{-- <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button></div> --}}
         <div class="modal-body p-3">
            <div class="modalContentUser">
                <h3>Are you sure to approve <span class="bulkCount"></span> JobSeekers.</h3>
              
            </div>
         </div>
         <div class="modal-footer text-center margin_auto">
                <button type="button" class="btn btn-primary btn-md modelConfirmAction">Yes</button>
                <button type="button" class="btn btn-default btn-md modelCancelAction" data-dismiss="modal">Cancel</button>
         </div>
    </div>
  </div>
</div>
{{-- Bulk Approved Pop Up End --}}

{{-- BulkCSV download --}}
<div class="d-none">
  <form method="POST" class="bulkCSVExportForm" action="{{route('bulk.GenerateCVS')}}">
    @csrf
    <div class="cbx_list">
    </div>
  </form>
</div>
{{-- BulkCSV download end --}}


{{-- BulkCSV download --}}
<div class="d-none">
  <form method="POST" class="bulkPDFExportForm" action="{{route('bulk.GeneratePDF')}}">
    @csrf
    <div class="cbx_list">
    </div>
  </form>
</div>
{{-- BulkCSV download end --}}

@stop


@section('css')
<link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
<style type="text/css">
    .modal.showProcessing  .modalContentUser{ display: none;  }
    .modal.showProcessing  .modelProcessingUser{ display: block !important; }
    #delConfirmIdUser{ color:red; }
    td{ text-align: center; }
</style>
@stop



@section('plugins.Datatables') @stop


@section('js')
<script src="{{ asset('js/admin_custom.js') }}"></script>
<script>
jQuery(function() {
    var table = jQuery('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: '{!! route('users.dataTable') !!}',
          data: function (d) {
                d.status = $('.filter_status').val()
            }
        },
        // ajax: '{!! route('users.dataTable') !!}',
        // data: function (d) {
        //         d.status = $('.filter_status').val(),
        // },
        columns: [
            // { data: 'select', name: 'select' },
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'city', name: 'city' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'created_at', name: 'created_at' },
            { data: 'profile', name: 'profile' },
            { data: 'videoInfo', name: 'videoInfo' },
            { data: 'resume', name: 'resume' },
            { data: 'action', name: 'action' }
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


   $('.filter_status').on('change', function(){
      var filter_status = $(this).val();
      // console.log('filter_status ', filter_status); 
      var newpath = '{!! route('users') !!}/'+filter_status;
      window.location.href = newpath;
   });

   // Handle click on "Select all" control
   $('#cbx_all').on('click', function(){
      // Check/uncheck all checkboxes in the table
      var rows = table.rows({ 'search': 'applied' }).nodes();
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });

   // Handle click on checkbox to set state of "Select all" control
   $('#dataTable tbody').on('change', 'input[type="checkbox"]', function(){ 
      console.log(' dataTable tbody '); 
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#cbx_all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked){el.checked=false;}
      }
   });
    
   // $('#frm-example').on('submit', function(e){
   //    var form = this;

   //    // Iterate over all checkboxes in the table
   //    table.$('input[type="checkbox"]').each(function(){
   //       // If checkbox doesn't exist in DOM
   //       if(!$.contains(document, this)){
   //          // If checkbox is checked
   //          if(this.checked){
   //             // Create a hidden element 
   //             $(form).append(
   //                $('<input>')
   //                   .attr('type', 'hidden')
   //                   .attr('name', this.name)
   //                   .val(this.value)
   //             );
   //          }
   //       } 
   //    });

   //    // FOR TESTING ONLY
      
   //    // Output form data to a console
   //    $('#example-console').text($(form).serialize()); 
   //    console.log("Form submission", $(form).serialize()); 
       
   //    // Prevent actual form submission
   //    e.preventDefault();
   // });


     
     // script to show user info PopupBox 
     // 0-> empty the popup html.  jQuery(popupBoday tag ).html(getLoader()'');
     // 0.5 --> show animation in popup. 
     // 1-> show popup. 
     // 2--> send ajax call to render userinfo html.
     // 3--> show that html in the popup. 
     // 4 --> jQuery(popupBoday tag ).html(succss data );

// Start user Info 

$(document).on('click', '.btnUserInfo', function() {
  var UserInfoId = parseInt($(this).attr('user-id'));
   
  console.log("UserInfoId"+UserInfoId);

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'GET',
        url: '{!! route('users.profilePopup') !!}',
        data: {'id': UserInfoId},
        beforeSend: function(){
           $('#ModaluserInfo').modal('show');  
        },
        success: function(data) {
          console.log(' data ', data);
          $('.ModaluserInfo .modalContentUser').html(data);  
          
        }
    });

});


//========================================================================//
//========================================================================//
$(document).on('click', '.btnUserVideoInfo', function() {
  var UserInfoId = parseInt($(this).attr('user-id'));
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
      type: 'GET',
      url: '{!! route('users.profileVideoPopup') !!}',
      data: {'id': UserInfoId},
      beforeSend: function(){
         $('#ModaluserInfo').modal('show');  
      },
      success: function(data) {
        console.log(' data ', data);
        $('.ModaluserInfo  .modalContentUser').html(data);  
      }
  });
});


//========================================================================//
// ModaluserInfo script to show full image when click on thumb
//========================================================================// 
 $('.ModaluserInfo').on('click','.profleMediaGalleryImage img', function(){
  console.log(' profleMediaGalleryImage click ');  
    var imageFullPath = $(this).attr('data-fullpath');
    var imgTag = '<img src="'+imageFullPath+'" />';
    $('.ModaluserInfo .profileImg').html(imgTag); 
 }); 
$('.ModaluserInfo').on('click','.profleVideos img', function(){
    console.log(' profleVideos click '); 
    var videoFullPath = $(this).attr('data-src');
    var videoTag = '<video class="videoPlayer" controls="true"><source src="'+videoFullPath+'"></video>';
    $('.ModaluserInfo .profileVideoShow').html(videoTag);  // attr('src', videoFullPath);//
    $(".profileVideoShow video")[0].load(); 
    $(".profileVideoShow video")[0].play(); 
 }); 
$('.ModaluserInfo').on('hidden.bs.modal', function () {
  $('.ModaluserInfo  .modalContentUser').html(getLoader('smallSpinner'));  
})

//========================================================================//
// Click on btnUserResumeInfo function downalod JobSeeker CV. 
//========================================================================// 
$(document).on('click','.btnUserResumeInfo', function(){
  console.log(' btnUserResumeInfo click '); 
  var UserInfoId = parseInt($(this).attr('user-id'));
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
      type: 'GET',
      url: '{!! route('users.resumeData') !!}',
      data: {'id': UserInfoId},
      beforeSend: function(){
         // $('#ModaluserInfo').modal('show');  
      },
      success: function(data) {
        console.log('data ', data);
        if(data != ''){
          window.open(data, '_blank')
        }
        // $('.ModaluserInfo  .modalContentUser').html(data);  
      }
  });
});


//========================================================================//
// Click on btnBulkApproved Button show confirmation popup. 
//========================================================================// 
$(document).on('click','.btnBulkApproved', function(){
  console.log(' btnBulkApproved click '); 
  var UserInfoId = parseInt($(this).attr('user-id'));
  jQuery('input[name="cbx[]"]:checked').each(function(i,el){ console.log('i', i, 'el', $(el).val()); });
  var cbx = $('input[name="cbx[]"]:checked').map(function(){return $(this).val(); });
  $('.ModalBulkApprovedInfo .bulkCount').html(cbx.length);
   $('#ModalBulkApprovedInfo').modal('show');
});

$(document).on('click','.modelConfirmAction', function(){
  var cbx = $('input[name="cbx[]"]:checked').map(function(){return $(this).val(); }).toArray();
   console.log(' modelConfirmAction cbx ', cbx);  
 
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
      type: 'POST',
      url: '{!! route('users.confirmAccount') !!}',
      data: {'cbx': cbx},
      beforeSend: function(){
         $('#ModalBulkApprovedInfo .modalContentUser').html(getLoader('smallSpinner'));  
         $('#ModalBulkApprovedInfo .modelConfirmAction').prop('disabled', true); 
      },
      success: function(data) {
        console.log('data ', data);
        console.log('data ', data.status);
        if(data.status){
           $('#ModalBulkApprovedInfo .modalContentUser').html(data.message); 
        }else{
           $('#ModalBulkApprovedInfo .modalContentUser').html('Error'); 
        }
      }
  });
});

 

//========================================================================//
// Click on btnVerifyUser Button show confirmation popup. 
//========================================================================//
$(document).on('click','.btnVerifyUser', function(){
  console.log(' btnVerifyUser click '); 
  var user_id = parseInt($(this).attr('user-id'));
  var elem = $(this);
  elem.html(getLoader('smallSpinner btnSpinner',false,true));
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
      type: 'POST',
      url: '{!! route('users.confirmAccount') !!}',
      data: {'cbx': [user_id]},
      success: function(data) {
        console.log('data ', data); 
        if(data.status){
          setTimeout(function(){ elem.text('verified');}, 1000); 
          setTimeout(function(){ elem.remove();}, 1500);
        }else{
            elem.text('Error'); 
        }
      }
  });
});
 




//========================================================================//
// Click on btnBulkApproved Button show confirmation popup. 
//========================================================================// 
$(document).on('click','.btnBulkCSVExport', function(){
  console.log(' btnBulkCSVExport click '); 
  var cbx = $('input[name="cbx[]"]:checked').map(function(){return $(this).val(); }).toArray();
    if(cbx.length <= 0){
      alert('Please Select Checkboxes');
      return false; 
    }
    var cbx_hidden =  ''; 
    cbx.forEach(function(id){ cbx_hidden += '<input type="hidden" name="cbx[]" value="'+id+'" />'  });
    $('.bulkCSVExportForm .cbx_list').html(cbx_hidden);
    $('.bulkCSVExportForm').submit();
});

//========================================================================//
// Click on btnBulkApproved Button show confirmation popup. 
//========================================================================// 
$(document).on('click','.btnBulkPDFGenerate', function(){
  console.log(' btnBulkPDFGenerate click '); 
  var cbx = $('input[name="cbx[]"]:checked').map(function(){return $(this).val(); }).toArray();
    if(cbx.length <= 0){
      alert('Please Select Checkboxes');
      return false; 
    }
    var cbx_hidden =  ''; 
    cbx.forEach(function(id){ cbx_hidden += '<input type="hidden" name="cbx[]" value="'+id+'" />'  });
    $('.bulkPDFExportForm .cbx_list').html(cbx_hidden);
    $('.bulkPDFExportForm').submit();
});







});
</script>
@stop
