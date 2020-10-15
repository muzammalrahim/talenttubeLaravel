@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-2"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>



    {{-- <div class="block row col-md-6 text-white">


        <div class="col-md-1.5 bulkButton mr-1"><a class="btn btn-block btn-primary btnBulkApproved" style="margin-right: 5px;">Bulk Assign Job</a></div>
        <div class="col-md-1.5 bulkButton mr-1"><a class="btn btn-block btn-primary btnBulkPDFGenerate">Bulk Snapshot</a></div>
        <div class="col-md-1.5 bulkButton mr-1"><a class="btn btn-block btn-primary btnBulkCSVExport">Bulk Export CSV</a></div>
        <div class="col-md-1.5 bulkButton mr-1"><a href="{{route('bulkEmail.new')}}" class="btn btn-block btn-primary ">Bulk Email</a></div>

    </div> --}}



    {{-- <div class="col-md-10">
        <div class="float-right">
            <a href="{!! route('jobs.create') !!}" class="btn btn-block btn-success">Add New</a>
        </div>
    </div> --}}




</div>

@stop


{{-- @include('admin.errors',[ 'error' => $errors, 'record' => $record ]) --}}

@section('content')

@include('admin.errors')
@include('admin.success')

<table class="table table-bordered" id="dataTable">
    <thead>
        <tr style = "text-align: center">
            <th>id.</th>
            <th>title</th>
            <th>country</th>
            <th>state</th>
            <th>city</th>
            <th>created_at</th>
            {{-- <th>created_by</th> --}}
            <th>action</th>
        </tr>
    </thead>
  </table>

<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
                 <!-- Modal content-->
        <div class="modal-content">
             <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
             <div class="modal-body">
                <div class="modalContent"></div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger" id="removejob" style="margin: 0 auto">Yes</button>
             </div>

        </div>
    </div>
</div>


@stop


@section('css')
    <link rel="stylesheet"  href="{{ asset('css/admin_custom.css') }}">
    <style type="text/css">

        .modal.showProcessing  .modalContent{ display: none;  }
        .modal.showProcessing  .modelProcessing{ display: block !important;  }

        #delConfirmId{
            color:red;
        }

        td{
            text-align: center;
        }
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
    ajax: '{!! route('jobs.dataTable') !!}',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        // { data: 'description', name: 'description' },
        // { data: 'type', name: 'type' },
        { data: 'country', name: 'country' },
        { data: 'state', name: 'state' },
        { data: 'city', name: 'city' },
        { data: 'created_at', name: 'created_at' },
        // { data: 'created_by', name: 'created_by' },
        { data: 'action', name: 'action'},
    ]
});


//========================================================================//
// Click to open model to confirm before delte.
//========================================================================//
$(document).on('click', '.btnJobDelete', function() {
    console.log(' btnJobDelete ');
  var item_id = parseInt($(this).attr('data-id'));
  var job_title = $(this).attr('data-title');
  // $('#deleteConfirmId').val(item_id);

  var   delete_modalContent =  '<div style="text-align:center;">';
        delete_modalContent += '<input type="hidden" name="deleteConfirmId" id="deleteConfirmId" value="'+item_id+'"  />';
        delete_modalContent += '<p>Are you sure to delete job "'+job_title+'"</p>';
        delete_modalContent += '</div>';


  $('#deleteModal .modalContent').html(delete_modalContent);
  $('#deleteModal').modal('show');


});

 // btnJobDelete
 // Ajax for deleting User
$('#removejob').on('click', function() {
    var del_id = $('#deleteConfirmId').val();
    console.log("job Delete"+del_id);
    var html = '<div class="modelProcessing"><h4>Deleting Job...</h4></div>';
    $('#deleteModal .modalContent').html(html);
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url:  'jobs/delete/' + del_id,
        data: {del_id},
        beforeSend: function(){
           $("#removejob").prop("disabled", true);
        },
        success: function(data) {
          console.log(' data ', data);
            if(data.status === 1 )
             $('#deleteModal').modal('hide');
             $("#removejob").prop("disabled", false);
            jQuery('#dataTable').DataTable().ajax.reload();
        }
    });
});




});
</script>
@stop
