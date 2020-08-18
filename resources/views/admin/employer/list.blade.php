@extends('adminlte::page')

@section('title',$title)

@section('content_header')
<div class="block row">
    <div class="col-md-3"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>


     <div class="block row col-md-5 text-white">
      <div class="col-md-5">
        <select class="filter_status browser-default custom-select">
            <option value="">Select Status</option>
            <option value="verified" {!! ($filter_status == 'verified')?('selected'):'' !!}>Approved</option>
            <option value="pending" {!! ($filter_status == 'pending')?('selected'):'' !!}>Pending</option>
        </select>
      </div>
      
      {{-- <div class="col-md-2"><a class="btn btn-block btn-primary btnBulkApproved">Bulk Approved</a></div>
      <div class="col-md-2"><a class="btn btn-block btn-primary btnBulkPDFGenerate">Bulk Compile CV</a></div>
      <div class="col-md-2"><a class="btn btn-block btn-primary btnBulkCSVExport">Bulk Export CSV</a></div>
      --}}
    </div>

    <div class="col-md-4">
        <div class="float-right">
            <a href="{!! route('employers.create') !!}" class="btn btn-block btn-success">Add New</a>
        </div>
    </div>
</div>
@stop

@section('content')

<table class="table table-bordered" id="dataTable">
    <thead>
        <tr style = "text-align: center">
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Profile</th>
            <th>Created_at</th>
            <th>Action</th>
            {{-- <th>delete</th> --}}
        </tr>
    </thead>
  </table>

<div id="deleteModalemp" class="modal fade" role="dialog">
    <div class="modal-dialog">
                 <!-- Modal content-->
        <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">

                <div class="modalContentEmp">
                    <p>Do you want to Delete <b><span id="delConfirmIdEmp"></span></b> Employer ?</p>
                    
                </div>

                <div class="modelProcessingEmp" style="display: none;">
                        <h4>Deleting Employer...</h4>    
                 </div>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger" id="removeEmp" style="margin: 0 auto">Yes</button>
              <input type="hidden" name="deleteConfirmEmp" id="deleteConfirmEmp" value="">
             </div>

        </div>
    </div>
</div>


{{-- User Info Pop Up --}}
<div id="ModaluserInfo" class="modal fade ModaluserInfo" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
         <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <div class="modalContentUser text-center"><i class="fa fa-spinner fa-pulse" style="font-size: 35px;"></i></div>
         </div>
         <div class="modal-footer"></div>
    </div>
  </div>
</div>
{{-- User Info Pop Up End Here --}}


@stop

@section('css')
    <link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">

    <style type="text/css">
        
        .modal.showProcessing  .modalContentEmp{
         display: none;  

        }
        
        .modal.showProcessing  .modelProcessingEmp{ 
            display: block !important;  
        }

        #delConfirmIdEmp{
            color:red;
        }

        td{
          text-align: center;
        }
    </style>

@stop

@section('plugins.Datatables')

@stop

@section('js')
<script src="{{ asset('js/admin_custom.js') }}"></script>
<script src="{{asset('js/admin_employerdelete.js')}}"></script>

<script>
jQuery(function() {
  jQuery('#dataTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
          url: '{!! route('employers.dataTable') !!}',
          data: function (d) {
                d.status = $('.filter_status').val()
            }
        },
      columns: [
          { data: 'id', name: 'id' },
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
          { data: 'profile', name: 'profile' },
          { data: 'created_at', name: 'created_at' },
          { data: 'action', name: 'action', },
          // { data: 'action', name: 'action', },
      ]
  });

//========================================================================//
// Change filter_status append value to url 
//========================================================================//
$('.filter_status').on('change', function(){
  var filter_status = $(this).val();
  var newpath = '{!! route('adminEmployers') !!}/'+filter_status;
  window.location.href = newpath;
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
// Click on btnVerifyUser Button show confirmation popup. 
//========================================================================//
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



 
});
</script>
@stop
