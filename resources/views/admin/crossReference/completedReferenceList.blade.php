@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-4"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>
    {{-- <div class="col-md-5"></div> --}}

    {{-- <div class="col-md-8">
      <div class="float-right">
          <a href="{!! route('reference.create') !!}" class="btn btn-block btn-success">Add Reference</a>
      </div>
    </div> --}}

</div>

@stop


{{-- @include('admin.errors',[ 'error' => $errors, 'record' => $record ]) --}}



@section('content')

@include('admin.errors')
@include('admin.success')

<table class="table table-bordered text-center cbxDataTable" id="dataTable">

	<thead>
        <tr style = "text-align: center">
            <th>ID</th>
            <th>Job Seeker</th>
            <th>Ref-Type</th>
            <th>Ref-Status</th>
	        <th>Ref-Email</th>
            <th>Js-IP</th>
	        <th>Ref-IP</th>
            <th>JS Browser</th>
	        <th>Referee Browser</th>
            <th>Js Sytem</th>
	        <th>Ref-Sytem</th>
	        {{-- <th>Url</th> --}}
	        {{-- <th>Created_at</th> --}}
	        <th>Action</th>

	    </tr>
	</thead>
</table>


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
    ajax: '{!! route('completedReference.dataTable') !!}',

    columns: [
        { data: 'id', name: 'id' },
        { data: 'userName', name: 'userName' },
        { data: 'refType', name: 'refType' },
        { data: 'refStatus', name: 'refStatus' },
        { data: 'refEmail', name: 'refEmail' },
        { data: 'jsIP', name: 'jsIP' },
        { data: 'refereeIP', name: 'refereeIP' },
        { data: 'jsBrowser', name: 'jsBrowser' },
        { data: 'refereeBrowser', name: 'refereeBrowser' },
        { data: 'jsSysyem', name: 'jsSysyem' },
        { data: 'refSystem', name: 'refSystem' },
        // { data: 'refURL', name: 'refURL' },
        // { data: 'created_at', name: 'created_at' },
        { data: 'action', name: 'action'},
    ]
});

//========================================================================//
// Click to open model to confirm before delete.
//========================================================================//
$(document).on('click', '.deleteIntButton', function() {
    console.log(' deleteIntButton ');
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
$('#removeinterview').on('click', function() {
    var del_id = $('#deleteConfirmId').val();
    console.log("job Delete"+del_id);
    var html = '<div class="modelProcessing"><h4>Deleting Interview...</h4></div>';
    $('#deleteModal .modalContent').html(html);
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url:  '/ajax/booking/adminDeleteSlot/' + del_id,
        data: {del_id},
        beforeSend: function(){
           $("#removeinterview").prop("disabled", true);
        },
        success: function(data) {
          console.log(' data ', data);
            if(data.status === 1 )
             $('#deleteModal').modal('hide');
             $("#removeinterview").prop("disabled", false);
            jQuery('#dataTable').DataTable().ajax.reload();
        }
    });
});

// =============================================== Delete Interview Pop End here ===============================================

});

</script>
@stop



