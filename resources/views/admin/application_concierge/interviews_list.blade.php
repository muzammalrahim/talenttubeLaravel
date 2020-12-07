@extends('adminlte::page')

@section('title',$title)

@section('content_header')

<div class="block row">
    <div class="col-md-4"><h1 class="m-0 text-dark">{{$content_header}}</h1></div>


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
	        <th>Title</th>
	        <th>Company Name</th>
	        <th>Position Name</th>
	        <th>Unique Digits</th>
	        <th>Url</th>
	        <th>Instruction</th>
	        <th>Additional Manager</th>
	        <th>Number Of Slots</th>
	        <th>Created_at</th>
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
                 <button type="button" class="btn btn-danger" id="removeinterview" style="margin: 0 auto">Yes</button>
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
    ajax: '{!! route('interviews.dataTable') !!}',

    columns: [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'companyname', name: 'company_name' },
        { data: 'positionname', name: 'position_name' },
        { data: 'uniquedigits', name: 'unique_digits' },
        { data: 'url', name: 'url' },
        { data: 'instruction', name: 'created_at' },
        { data: 'additionalmanagers', name: 'additional_managers' },
        { data: 'slots_count', name: 'slots' },
        { data: 'created_at', name: 'created_at' },
        { data: 'action', name: 'action'},
    ]
});

});

</script>
@stop



