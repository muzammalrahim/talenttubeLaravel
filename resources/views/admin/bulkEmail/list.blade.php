@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-6"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>
    <div class="col-md-6">
        <div class="float-right">
            <a href="{!! route('jobs.create') !!}" class="btn btn-block btn-success">Add New</a>
        </div>
    </div>
</div>



{{-- Bulk Approved Pop Up --}}
<div id="ModalBulkApprovedInfo" class="modal fade ModalBulkApprovedInfo" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
         {{-- <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button></div> --}}
         <div class="modal-body p-3 text-center">
            <div class="modalContentUser">
                <h3>Are you sure to Send Bulk Email.</h3>
                <p class="bulkTitle"></p>
            </div>
            <div class="modalProcessing hidden"></div>
         </div>
         <div class="modal-footer text-center margin_auto">
                <input type="hidden" name="bulkConfirmId" id="bulkConfirmId" value="">
                <button type="button" class="btn btn-primary btn-md modelConfirmAction">Yes</button>
                <button type="button" class="btn btn-default btn-md modelCancelAction" data-dismiss="modal">Cancel</button>
         </div>
    </div>
  </div>
</div>
{{-- Bulk Approved Pop Up End --}}


@stop

@section('content')
@include('admin.errors')
@include('admin.success')

<table class="table table-bordered" id="dataTable">
    <thead>
        <tr style = "text-align: center">
            <th>ID</th>
            <th>title</th>
            <th>Content</th>
            <th>Status</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
    </thead>
  </table>
@stop


@section('css')
<link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
<style type="text/css">

</style>
@stop

@section('plugins.Datatables') @stop

@section('js')
<script src="{{ asset('js/admin_custom.js') }}"></script>
<script>
jQuery(function() {
    jQuery('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('bulkEmail.dataTable') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'content', name: 'content' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action'},
        ]
    });

    //========================================================================//
    // Click on btnBulkApproved Button show confirmation popup. 
    //========================================================================// 
    $(document).on('click','.BulkEmailConfirmEmail', function(){
      console.log(' btnBulkApproved click '); 
      var bulkId = parseInt($(this).attr('data-id'));
      var bulkTitle = $(this).attr('data-title');

      $('.ModalBulkApprovedInfo .modalContentUser').removeClass('d-none');
      $('.ModalBulkApprovedInfo .modalProcessing').addClass('d-none');

      $('#bulkConfirmId').val(bulkId);
      $('.ModalBulkApprovedInfo .bulkTitle').html(bulkTitle);
      $('#ModalBulkApprovedInfo').modal('show');
    });


   $(document).on('click','.modelConfirmAction', function(){
      var bulkConfirmId = $('#bulkConfirmId').val();
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
          type: 'POST',
          url: '{!! route('bulkEmail.SendEmail') !!}',
          data: {'id': bulkConfirmId},
          beforeSend: function(){
             $('.ModalBulkApprovedInfo .modalContentUser').addClass('d-none');
             $('.ModalBulkApprovedInfo .modalProcessing').removeClass('d-none');
             $('#ModalBulkApprovedInfo .modalProcessing').html(getLoader('smallSpinner'));

             $('#ModalBulkApprovedInfo .modelConfirmAction').prop('disabled', true); 
          },
          success: function(data) {
            $('#ModalBulkApprovedInfo .modelConfirmAction').prop('disabled', false); 
            console.log('data ', data);
            console.log('data ', data.status);
            if(data.status){
               $('#ModalBulkApprovedInfo .modalProcessing').html(data.message); 
            }else{
               $('#ModalBulkApprovedInfo .modalProcessing').html('Error'); 
            }
          }
      });
   });



});
</script>
@stop
